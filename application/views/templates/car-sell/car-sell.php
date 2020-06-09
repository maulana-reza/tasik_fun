<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/templates/car-sell/custom/font-awesome/css/all.min.css">
        <link reunl="stylesheet" href="<?php echo base_url(); ?>/assets/templates/car-sell/custom/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/templates/car-sell/custom/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/templates/car-sell/custom/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/templates/car-sell/custom/mdb/css/mdb.min.css">
        <script src="<?php echo base_url(); ?>/assets/templates/car-sell/custom/jquery-3.4.1.slim.min.js"></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>
        <?php
        $ex = explode("/",uri_string());
        $last = count($ex);
        $string = $ex[$last-1];
        echo @$_SESSION['app_name']." | ".strtoupper((!@$page_title ? preg_replace('~[\\\\/:*?"<>|_]~', ' ', $string) : $page_title)); ?>
        </title>
        <style>
        </style>
    </head>
    <body>
        <!-- loader -->
        <div class="position-fixed h-100 w-100 loader" style="z-index: 1000000;">
            <div class="d-flex justify-content-center border-primary h-100 w-100 bg-white">
                <div class="spinner-grow text-primary m-auto " role="status" style="width: 3rem; height: 3rem;" >
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
        <!-- end loader -->
        <!-- bottom navbar -->
        <?php if (!@$btn_bottom_menu): ?>
        <?php
        ?>
        <div class=" shadow-lg bg-white fixed-bottom bottom-nav">
            <nav class="nav nav-pills nav-fill text-sm" id="pills-tab" role="tablist">
                <a class="nav-item link-move nav-link text-dark waves-effect rounded-0 border-0 <?= @$menu['content']?>"  href="<?= site_url('content'); ?>">
                    <i class="fa fa-home fa-2x" ></i>
                    <p><?php echo lang_line('l_menu_home','label_input'); ?></p>
                </a>
                <a class="nav-item link-move nav-link text-dark waves-effect rounded-0 border-0 <?= @$menu['bid']?> position-relative"  href="<?= site_url('bid'); ?>" >
                    <i class="fa fa-car-alt fa-2x"></i>
                    <p><?php echo lang_line('l_menu_history','label_input'); ?></p>
                    <?php  if (@$history_count): ?>
                    
                    <span class="badge badge-success waves-effect position-absolute notif-right" style="   top: 0;  margin:auto; z-index: 100;"><?php echo @$history_count; ?></span>
                    <?php endif ?>
                    
                </a>
                <a class="nav-item link-move nav-link text-dark rounded-0 waves-effect border-0 <?= @$menu['profile']?>"  href="<?= site_url('profile'); ?>" >
                    <i class="fa fa-user fa-2x"></i>
                    <p><?php echo lang_line('l_menu_profile','label_input'); ?></p>
                </a>
            </nav>
        </div>
        <?php endif ?>
        <!-- end bottom navbar -->
        <?php if (!@$btn_back): ?>
        
        <div class="" style="margin-top: 3.5em;">
            
            <a data-role="button" data-inline="true" data-rel="back" href="<?php echo @$prev_uri; ?>" <?= @$prev_uri ? '':'onclick="goBack(event,this)"'; ?>>
                <div class="button-back link-move text-left position-absolute" style="z-index: 1001;" >
                    <div class="align-middle p-2 text-dark rounded bg-white m-2 waves-effect position-fixed fixed-top  " style="height: 40px !important; width: 40px !important;"><i class="fa fa-arrow-left w-100 h-100 "></i></div>
                </div>
            </a>
            <div class="position-fixed bg-white shadow p-3 font-weight-bold pl-5"><p class="pl-2 m-0 "><?php
            echo strtoupper((!@$page_title ? preg_replace('~[\\\\/:*?"<>|_]~', ' ', $string) : $page_title)); ?></p>
        </div>
        <?php  if (@$search_page): ?>
        <div class="button-back text-left position-absolute" style="z-index: 1001;" >
            <div class="align-middle p-2 text-dark rounded bg-white m-2 waves-effect position-fixed  " style="height: 40px !important; width: 40px !important;right: 0 !important;"  data-toggle="modal" data-target="#modal_search">
                <i class="fa fa-search w-100 h-100"></i>
            </div>
        </div>
        <!-- modal search -->
        <div class="modal fade top  rounded-0" id="modal_search" tabindex="-1" role="dialog" aria-labelledby="modal_searchLabel" aria-hidden="true" data-backdrop="true" >
            <div class="modal-dialog modal-frame modal-top m-0  rounded-0" role="document">
                <div class="modal-content rounded-0">
                    <div class="modal-body p-0">
                        <!-- form -->
                        <?php echo form_open('','method="get"'); ?>
                        
                        <div class="form-group">
                            
                            <div class="input-group pt-2 pb-2">
                                <input type="text" class="form-control validate grey pl-2 lighten-2 rounded-0 p-0 border-0"  placeholder="<?php echo ucfirst(strtolower(lang_line('l_search_button','label_input'))); ?>" name="search" value="<?php echo @$search ?>">
                                <div class="input-group-append">
                                    <button class="btn btn-md btn-primary m-0 px-3" type="submit" id="MaterialButton-addon2">
                                    <?php echo lang_line('l_search_button','label_input'); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <?php echo form_close(); ?>
                        
                        <!-- end form -->
                    </div>
                </div>
            </div>
        </div>
        <?php  endif ?>
        <!-- end modal search -->
    </div>
    <?php  endif ?>
    <?php
    $array = ["content/index","content/search","content"];
    if (in_array(uri_string(), $array)): ?>
    <div class="" style="margin-top:5.4em">
    </div>
    <?php endif ?>
    <?php if (!is_null(show_alert()) && !strpos(uri_string(), "Incorrect Login")): ?>
    <?php echo show_alert(); ?>
    <?php endif ?>
    <!-- <div class="row"> -->
    <!-- <div class="p-0 m-0" style="height: 100%"> -->
    <?= @$content; ?>
    <!-- </div> -->
    <!-- </div> -->
</div>
</div>
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-body">
            <?php echo lang_line('delete','alert') ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
    </div>
</div>
</div>
</body>
</html>
<script src="<?php echo base_url(); ?>/assets/templates/car-sell/custom/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/templates/car-sell/custom/font-awesome/js/all.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/templates/car-sell/custom/custom.js"></script>
<script src="<?php echo base_url(); ?>/assets/templates/car-sell/custom/mdb/js/mdb.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="https://sdk.accountkit.com/en_US/sdk.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
<?php if (@$map): ?>
<?php $this->load->view('map', ['map'=>$map]); ?>
<?php endif ?>
<script>
$('input').attr("autocomplete","off");
loader_out();
function loader_in() {
$(".loader").fadeIn()
}
function loader_out() {
$(".loader").fadeOut()
}
function goBack(e,el) {
e.preventDefault()
// var uri = document.referrer
// window.location = uri
window.history.back();
}
$('.alert-delete').on('click',function(e){
e.preventDefault();
link = $(this).attr('href');
bootbox.confirm({
title   : 'Confirm',
message : "<div class='text-center'><?php echo lang_line("delete_message","alert") ?></div>",
buttons : {
confirm : {
label : 'Yes',
className: 'btn-outline-danger btn-sm'
},
cancel : {
label : 'No',
className : 'btn-outline-primary btn-sm'
}
},
callback : function (result) {
if (result)
{
window.location.href = link;
}
}
});
})
$('[name="price"]').mask('000,000,000,000,000', {reverse: true});
$(document).on('click','.link-move',function(){
loader_in();
setTimeout(function() { loader_out() }, 10000);
})
</script>