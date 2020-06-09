<div id="infoMessage"><?php echo $message;?></div>

<table cellpadding=0 cellspacing=10 class="table table-striped table-sm table-hover w-100 mb-0">
	<thead>
	<tr>
		<th class="card-text">#</th>
		<th class="card-text"><?php echo lang('index_fname_th');?></th>
		<th class="card-text"><?php echo lang('index_groups_th');?></th>
		<th class="card-text"><?php echo lang('index_status_th');?></th>
		<th class="card-text"><?php echo lang('index_action_th');?></th>
	</tr>
</thead>
<tbody class="content-list">
<?php $this->load->view('users_content', ['users'=>$users], FALSE); ?>
</tbody>
	
</table>
<div class="loader-content">
	
</div>


<div class="modal fade bottom" id="modal-report" tabindex="-1" role="dialog" aria-labelledby="report"
  aria-hidden="true">
  <div class="modal-dialog round-0 m-0 w-100" role="document" style="max-width:100% !important;bottom:0 !important;position: absolute;">
    <div class="modal-content round-0">
      <div class="modal-body text-center">
        <p class="text-center p-5">
        	<?php echo lang_line('delete','alert'); ?>
        </p>
      <div class="form-group text-right">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
        <button class="btn btn-primary btn-sm" type="submit">Yes</button>
      </div>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
<script>
	$(document).ready(function(){
    $(document.body).on('touchmove', onScroll); // for mobile
    $(window).on('scroll', onScroll); 

    var addition_constant = 0;
    var search            = "<?php echo @$search; ?>";
    var page              = <?php echo $this->config->item("pagination_perpage") ?>;

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
              url: "<?php echo site_url('admin/users/load/') ?>"+page,
              data:{search:search},
              success:function(data){
                page      += <?php echo $this->config->item("pagination_perpage"); ?>;
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
	
    function get_option(el) {
    	var url = $(el).attr("href");
    	 $.ajax({
              type: "GET",
              url: url,
              success:function(data){
              	$("#modal-report").find(".modal-body").html(data);
              },
              error:function(data){
              	console.log(data);      
              }
      });
    }
</script>
<!-- <p><?php //echo anchor('admin/users/create_user', lang('index_create_user_link'))?> | <?php //echo anchor('admin/users/create_group', lang('index_create_group_link'))?></p> -->