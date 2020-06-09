<script>

function prepare_map(add_data,lat,long) {
    let range  = parseInt($('[name="range"]').val());
    $.ajax({
          type   : "POST",
          url    : "<?php echo site_url('content/prepare_map') ?>",
          data   :{add_data:add_data,lat:lat,long:long,range:range},
          success:function(html){
            position    = {latitude:parseFloat(lat),longitude:parseFloat(long)}; 
            console.log("prepare_map",html,position);
            initMap(html,position);
            
          },
          error:function(data){
              console.log(data);      
          }
    });
}

function prepare_content(add_data = false,page = 0,lat = false,long = false,is_replace = false) {
    if (!page) {
        page = 0;
    }
    console.log("prepare content")
    if (!lat && !long) {
        long    = $(document).find('[name="long"]').val()
        lat     = $(document).find('[name="lat"]').val()
    }
    add_data  = '<?php echo @$query; ?>';
    var range = $('[name="range"]').val();

    $.ajax({
          type  : "POST",
          url   : "<?php echo site_url('content/load/') ?>"+page,
          data  :{
                add_data    :add_data,
                lat         :lat,
                long        :long,
                range       :range,
            },
          success:function(html){
            not_found = html.search("<?php echo lang_line('not_found','alert'); ?>");
            console.log(html)
            if (not_found > 0) {
                if (is_replace) {
                    $(".content-list").html("");   
                    $('.loader-content').html(html);

                }else{
                    $('.loader-content').html(html);

                }
            }else{
                if (is_replace) {
                    $(".content-list").html(html);   
                }else{
                    $(".content-list").append(html);   
                }
            }
          },
          error:function(data){
            $(".loader-content").html('<div class="text-center card-text"> <?php echo lang_line('not_found','alert') ?></div>');   
              // console.log(data);
          }
    });
}
var tryAPIGeolocation = function() {
    jQuery.post( "https://www.googleapis.com/geolocation/v1/geolocate?key=<?php echo $_SESSION['map_api'] ?>", function(success) {

    $('[name="lat"]').val(success.location.lat)
    $('[name="long"]').val(success.location.lng)
        // console.log({latitude: success.location.lat, longitude: success.location.lng})
        prepare_map(false,success.location.lat,success.location.lng);
        // console.log("atas");
        prepare_content(false, 0,success.location.lat,success.location.lng,is_replace = true)

        // initMap({latitude: success.location.lat, longitude: success.location.lng});
  })
  .fail(function(err) {
    console.log("API Geolocation error! \n\n"+err);
  });
};

var browserGeolocationSuccess = function(position) {
    $('[name="lat"]').val(position.coords.latitude)
    $('[name="long"]').val(position.coords.longitude)
    console.log({latitude: position.coords.latitude, longitude: position.coords.longitude})
    prepare_map(false,position.coords.latitude,position.coords.longitude);
    prepare_content(false, 0,position.coords.latitude,position.coords.longitude,is_replace = true)
    // initMap({latitude: position.coords.latitude, longitude: position.coords.longitude});

};

var browserGeolocationFail = function(error) {
  switch (error.code) {
    case error.TIMEOUT:
      console.log("Browser geolocation error !\n\nTimeout.");
      break;
    case error.PERMISSION_DENIED:
      if(error.message.indexOf("Only secure origins are allowed") == 0) {
        tryAPIGeolocation();
      }
      break;
    case error.POSITION_UNAVAILABLE:
      console.log("Browser geolocation error !\n\nPosition unavailable.");
      break;
  }
};

      var tryGeolocation = function() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(
            browserGeolocationSuccess,
            browserGeolocationFail,
            {maximumAge: 500000, timeout: 200000, enableHighAccuracy: true});
        }
      };


      function initMap(cluster,position) 
      {
        my_location = {lat: position.latitude, lng: position.longitude};
        var myOptions  = {
          zoom            : 16,
          center          : my_location,
          disableDefaultUI: true,
          mapTypeId       : google.maps.MapTypeId.ROADMAP,
          zoomControl     : false
        }
        var map = new google.maps.Map(document.getElementById('pills-map'), myOptions);
        var marker = new google.maps.Marker({
                position  : my_location, 
                map       : map,
        });
        // Try HTML5 geolocation
        // Create an array of alphabetical characters used to label the markers.
        // Add some markers to the map.
        // Note: The code uses the JavaScript Array.prototype.map() method to
        // create an array of markers based on a given "locations" array.
        // The map() method here has nothing to do with the Google Maps API.
        
        var infoWin = new google.maps.InfoWindow();
        // marker clustering
        // console.log(cluster);
        if (cluster[0] != undefined) {
            console.log("cluster",cluster[0])

            var bounds = new google.maps.LatLngBounds();
            for (var i = 0; i < cluster.length; i++) {
              bounds.extend(cluster[i]);
            }
            bounds.extend(my_location);
            map.fitBounds(bounds);

          }
        map.setCenter(my_location);

        var markers = cluster.map(function(location, i) {
          var marker = new google.maps.Marker({
            position      : location,
            icon          :"<?php echo base_url();?>assets/templates/car-sell/image/marker.png",
          });
          google.maps.event.addListener(marker, 'click', function(evt) {
            infoWin.setContent(location.info);
            infoWin.open(map, marker);
          })
          return marker;
        });
          
        // console.log(markers);

        // Add a marker clusterer to manage the markers.
        var markerCluster = new MarkerClusterer(
          map, 
          markers,
          {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'}
          );
        }
        // function setMarkers(map, locations) {

        // var marker, i
        //   for (i = 0; i < locations.length; i++) {
        //     var loan    = locations[i][0]
        //     var lat     = locations[i][1]
        //     var long    = locations[i][2]
        //     var add     = locations[i][3]
        //     latlngset   = new google.maps.LatLng(lat, long);
        //     var marker  = new google.maps.Marker({
        //         map     : map, 
        //         title   : loan, 
        //         position: latlngset
        //     });
        //     map.setCenter(marker.getPosition())

        //     var content    = "Loan Number: " + loan + '</h3>' + "Address: " + add
        //     var infowindow = new google.maps.InfoWindow()

        //     google.maps.AddListener(marker, 'click', function (map, marker) {
        //         infowindow.setContent(content)
        //         infowindow.open(map, marker)
        //     });
        //   }
        // }
        // var locations = data;
    // end var marker cluser
      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
      function onTouchStart() {
        window.addEventListener("touchmove", handleTouchMove, {
          passive: false
        });
      }

      function onTouchEnd() {
        window.removeEventListener("touchmove", handleTouchMove, {
          passive: true
        });
      }

      function handleTouchMove(e) {
        e.preventDefault();
      }
    </script>
<script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js">
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=<?php echo $_SESSION['map_api'] ?>&callback=tryGeolocation">
</script>