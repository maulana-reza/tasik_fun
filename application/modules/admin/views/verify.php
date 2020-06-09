<?php if (!@$users[0]): ?>

		<div class="md-form h-100 w-100 p-auto position-fixed align-middle d-flex align-items-center justify-content-center m-auto" style="z-index: 0;left:0;">
		<div class="form-group file-field mb-5 align-center">
		<div class="label card-text"><?php echo lang_line('empty','alert') ?></div>
		</div>
		</div>
<?php return false ?>
  <?php endif ?>
<div class="">
	<table class="table table-striped table-sm mb-0 table-hover w-100">
		<thead>
			<tr>
				<th class="card-text">#</th>
				<th class="card-text">Nama</th>
				<th class="card-text">Document ID</th>
				<th class="card-text">aksi</th>
			</tr>
		</thead>
		<tbody class="content-list">
			<?php echo form_open(''); ?>
			<?php $this->load->view('verify_content', ['users' => $users], FALSE); ?>
			<?php echo form_close(); ?>
		</tbody>
	</table>

		<div class="loader-content text-center">
			
		</div>
</div>

<!-- Frame Modal Bottom -->
<div class="modal fade bottom" id="frameModalBottom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">

  <!-- Add class .modal-frame and then add class .modal-bottom (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-frame modal-bottom m-0 w-100" role="document" style="max-width:100% !important;bottom:0 !important;position: absolute;">


    <div class="modal-content rounded-0">
      <div class="modal-body">
        <div class="row see d-flex justify-content-center align-items-center rounded-0">
        </div>
  
          <button type="button" class="btn btn-secondary btn-sm float-right" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script>
	
function get_image(e,el) {
	e.preventDefault();
	var id = $(el).data("id");
	var img = $(el).attr("href");
	console.log(img);
	$(".btn-verify").val(id);

	$.ajax({
	    type: "POST",
	    url: "<?=site_url('admin/cars/image/');?>",
	    data:{img:img},
	    beforeSend:function(data){
	    	loader_in();
	    },
	    success:function(data){
	    	$('.see').html(data);
	    },
	    error:function(data){
	    	console.log(data);	
	    }

	});

	loader_out();
}

$(document).ready(function(){
    $(document.body).on('touchmove', onScroll); // for mobile
    $(window).on('scroll', onScroll); 

    var addition_constant = 0;
    var search  = "<?php echo @$search; ?>";
    var page    = <?php echo $this->config->item("pagination_perpage") ?>;

    function onScroll() {
        var addition      = ($(window).scrollTop() + window.innerHeight);
        var scrollHeight  = (document.body.scrollHeight - 1);

        if (addition > scrollHeight && addition_constant < addition) {
        
        $(".loader-content").load("<?php echo base_url('assets/templates/car-sell/loader/verify.html'); ?>");
        
        addition_constant = addition;
        data_loader       = $(".loader-content").find('.text-center').html();
            
            if (!data_loader) {
              $.ajax({
              type: "POST",
              url: "<?php echo site_url('admin/verify/load/') ?>"+page,
              data:{search:search},
              success:function(data){
                page += <?php echo $this->config->item("pagination_perpage"); ?>;
                not_found = data.search("<?php echo lang_line('not_found','alert'); ?>");

                if (not_found > 0) {
                    $('.loader-content').html(data);
                }else{
                    $(".content-list").append(data);   
                }
              },
              error:function(data){
                $(".loader-content").html('<div class="text-center card-text"> <?php echo lang_line('not_found','alert') ?></div>');   
                  console.log(data);      
              }
              });
            }
       }
    }
});
</script>