<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
    <meta name="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="<?= base_url();?>assets/templates/puskeswan-admin/tool/bootstrap.min.css" >
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/templates/car-sell/custom/mdb/css/mdb.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="<?= base_url();?>assets/templates/puskeswan-admin/tool/style.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/templates/puskeswan-admin/tool/chart.css">
    <!-- Font Awesome JS -->

    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/templates/car-sell/custom/font-awesome/css/all.min.css">
    <script src="<?php echo base_url(); ?>/assets/templates/car-sell/custom/font-awesome/js/all.min.js"></script>
    
    <script defer src="<?= base_url();?>assets/templates/puskeswan-admin/tool/solid.js" ></script>
    <script src="<?= base_url();?>assets/templates/puskeswan-admin/tool/jquery-3.4.1.min.js" ></script>

    <title>
    <?php @$this->load->view('templates/default-article/title');?>
    </title>
</head>
     <?php
if (@$modals[0]) {
foreach ($modals as $key => $modal) {
    echo $modal;
}
}
?>
<body>
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar" class="shadow bg-bottom-blue" style=" " >
            <div class="sidebar-header">
            	<div class="sidebar-image d-inline-block w-75">	

                </div>
            	<div class="sidebar-title d-inline-block p-1">
                <a href="<?= site_url('') ?>"><h3 class="p-0 m-0"><?= getenv("APP_NAME") ;?></h3></a>
            	</div>
                    <button type="button" id="sidebarCollapse" class="navbar-btn float-right" style="width: 40px;">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
            </div>

            <ul class="list-unstyled components">
                <?php $menus = menu_client(); ?>
                <?php foreach ($menus as $key => $item): ?>    
                <li class="<?= @$menu[$item['name']]?>">
                    <a class="menu " href="<?= $item['url'] ?>" data-name="<?= $item['name'] ?>" ><?= ucfirst($item['name']);?></a>
                </li>
                <?php endforeach ?>
            </ul>

        </nav>

        <!-- Page Content Holder -->
        <div id="content">
            <div class="bg-content">    
            </div>

            <nav class="navbar navbar-expand-lg navbar-inverse navbar-light bg-light m-0 position-fixed d-lg-none d-md-none fixed-top">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse2" class="navbar-btn2 ml-3" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent" >
                        <ul class="nav navbar-nav ml-auto ">
                            <?php foreach ($menus as $key => $item): ?>    
                                <li class="nav-item ml-3 mt-2 mb-2 <?= @$menu[$item['name']]?>">
                                    <a class="nav-link menu " href="<?= $item['url'] ?>" data-name="<?= $item['name'] ?>"><?= ucfirst($item['name']);?></a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </nav>
			<?php
			$uri_string = uri_string();

			switch (true) {
        case $uri_string=="auth/login":
            echo "Login";
            break;
        default :
            $text = str_ireplace("_", " ", $uri_string);
            $text = str_ireplace("/", " >> ", $text);
            echo ucwords($text);
            break;
    }
    ?>
			<div class="pull-right float-right">
				<?= anchor('auth','sign-in');?>
			</div>
			<hr>
            <div class="col-md-12 heading-content-sub-title">
            </div>

    <?php if (!is_null(show_alert())): ?>
        <?php echo show_alert(); ?>
    <?php endif ?>
			<?= @$content ?>

    <footer class="text-center content w-100 mt-5 pt-5" style="margin-top:14em !important;">
        <p>Design by <a href="mailto:7392maulana@gmail.com" class="text-cyan "></a></p>
    </footer>
        </div>


    </div>
</body>
</html>
 
<!-- jQuery CDN - Slim version (=without AJAX) -->
    <!-- Popper.JS -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
            $('#sidebarCollapse2').on('click', function() {
                $(this).toggleClass('active');
            });
            $('[data-toggle="modal"]').on('click', function(e){
                e.preventDefault();
            });

            $('.banner').on('click', function(e){
                e.preventDefault();
                link=$(this).attr('href');
                if(confirm('Pasang ke banner?')){
                    window.location=link;
                }
            })

            $('.remove-banner').on('click', function(e){
                e.preventDefault();
                link=$(this).attr('href');
                if(confirm('Hapus dari banner?')){
                    window.location=link;
                }
            })
            $('.delete').on('click', function(e){
                e.preventDefault();
                link=$(this).attr('href');
                if(confirm('Apakah kau yakin?')){
                    window.location=link;
                }
            })
        });
    </script>
    
<script src="<?php echo base_url(); ?>/assets/templates/car-sell/custom/mdb/js/mdb.min.js"></script>
    <script src="<?= base_url();?>assets/templates/puskeswan-admin/tool/popper.min.js" ></script>
    <!-- <script src="<?= base_url();?>assets/templates/puskeswan-admin/tool/chart.js" ></script> -->
    
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <!-- Bootstrap JS -->
    <script src="<?= base_url();?>assets/templates/puskeswan-admin/tool/bootstrap.min.js" ></script>
    
  <?= @$javascript; ?>
    

