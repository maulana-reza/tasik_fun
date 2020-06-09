<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
    <meta name="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="<?= base_url();?>assets/templates/puskeswan-admin/tool/bootstrap.min.css" >
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="<?= base_url();?>assets/templates/puskeswan-admin/tool/style.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/templates/puskeswan-admin/tool/chart.css">
    <!-- Font Awesome JS -->
    <script defer src="<?= base_url();?>assets/templates/puskeswan-admin/tool/solid.js" ></script>
    <script defer src="<?= base_url();?>assets/templates/puskeswan-admin/tool/fontawesome.js" ></script>
    <title>
    <?php @$this->load->view('templates/puskeswan-admin/title');?>
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
    <?= form_open('');?>
    <?= form_close();?>

    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar" class="shadow bg-bottom-blue" style=" background-image: url('<?= base_url('assets/templates/puskeswan-admin/img/bg-bottom-admin.svg'); ?>');" >
            <div class="sidebar-header">
            	<div class="sidebar-image d-inline-block">	
            	<img src="" class="float-left" >
            	</div>
            	<div class="sidebar-title d-inline-block p-1">
                <h3 class="p-0 m-0"><?= getenv("APP_NAME") ;?></h3>
            	</div>
                    <button type="button" id="sidebarCollapse" class="navbar-btn float-right" style="width: 40px;">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
            </div>

            <ul class="list-unstyled components">
                <li class="<?= @$menu['dashboard']?>">
                    <a class="menu " href="<?= site_url('admin/dashboard') ?>" data-name="puskeswan" >Dashboard</a>
                </li>
                <li class="<?= @$menu['article']?>">
                    <a class="menu " href="<?= site_url('admin/article') ?>" data-name="puskeswan" >Dokumentasi</a>
                </li>
                <li class="<?= @$menu['about']?>">
                    <a class="menu " href="<?= site_url('admin/about') ?>" data-name="puskeswan" >Tentang kami</a>
                </li>
                <li class="<?= @$menu['privacy_policy']?>">
                    <a class="menu " href="<?= site_url('admin/privacy_policy') ?>" data-name="privacy_policy">Kebijakan</a>
                </li>
            </ul>

        </nav>

        <!-- Page Content Holder -->
        <div id="content">
            <div class="bg-content">    
            </div>

            <nav class="navbar navbar-expand-lg navbar-inverse navbar-light bg-light m-0 p-absolute d-lg-none d-md-none fixed-top">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse2" class="navbar-btn2 ml-3" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <a class="delete" href="<?= site_url('auth/logout')?>" >
                    <button class="navbar-btn mr-3 " style="font-size: 20px;"><i class="fa fa-power-off fa-lg"></i></button></a>


                    <div class="collapse navbar-collapse" id="navbarSupportedContent" >
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item ml-3 mt-2 mb-2 <?= @$menu['puskeswan']?>">
                                <a class="nav-link menu" href="<?= site_url('puskeswan') ?>" data-name="puskeswan">Puskeswan</a>
                            </li>
                            <li class="nav-item ml-3 mt-2 mb-2 <?= @$menu['sipoteko']?>">
                                <a class="nav-link menu" href="<?= site_url('sipoteko') ?>" data-name="sipoteko">Sipoteko</a>
                            </li>
                            <li class="nav-item ml-3 mt-2 mb-2 <?= @$menu['sipolahnak']?>">
                                <a class="nav-link menu" href="<?= site_url('sipolahnak') ?>" data-name="sipolahnak">Sipolahnak</a>
                            </li>
                            <li class="nav-item ml-3 mt-2 mb-2 <?= @$menu['super_admin']?>">
                                <a class="nav-link menu" href="<?= site_url('super_admin') ?>" data-name="super_admin">Super Admin</a>
                            </li>

                            <li class="nav-item ml-3 mt-2 mb-2 <?= @$menu['data_reference']?>">
                                <a class="nav-link menu" href="<?= site_url('data_reference') ?>" data-name="data_reference">Data Referensi</a>
                            </li>

                            <li class="nav-item ml-3 mt-2 mb-2 <?= @$menu['privacy_policy']?>">
                                <a class="nav-link menu" href="<?= site_url('privacy_policy') ?>" data-name="privacy_policy">Kebijakan Pribadi</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <a href="<?= site_url('auth/logout')?>" >
            <button class="navbar-btn mr-3 float-right text-white"  style="font-size: 20px;"><i class="fa fa-power-off fa-lg"></i></button></a>
            <?php @$this->load->view('templates/puskeswan-admin/page-title');?>
            <div class="col-md-12 heading-content-sub-title">
             <?= @$title_card ? "Data ".$title_card: ""; ?>
            </div>
            <?php
            $messages=$this->session->flashdata('messages'); 
            if (is_array(@$messages)): ?>
                <?php foreach ($messages as $key => $message): ?>
                   <?php echo $message ;?> 
                <?php endforeach ?>
            <?php endif ?>
			<?= @$content ?>

        </div>
    </div>

</body>
</html>
 
<!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="<?= base_url();?>assets/templates/puskeswan-admin/tool/jquery-3.4.1.min.js" ></script>
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
            $('.delete').on('click', function(e){
                e.preventDefault();
                link=$(this).attr('href');
                if(confirm('Apakah kau yakin?')){
                    window.location=link;
                }
            })
        });
    </script>
    <script src="<?= base_url();?>assets/templates/puskeswan-admin/tool/popper.min.js" ></script>
    <!-- <script src="<?= base_url();?>assets/templates/puskeswan-admin/tool/chart.js" ></script> -->
    
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <!-- Bootstrap JS -->
    <script src="<?= base_url();?>assets/templates/puskeswan-admin/tool/bootstrap.min.js" ></script>
    
  <?= @$javascript; ?>
    

