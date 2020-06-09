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
  
<body>
  
    <div class="wrapper">
        <!-- Sidebar Holder -->

        <!-- Page Content Holder -->
        <div id="content">
            <div class="bg-content">    
            </div>
    

            <?php @$this->load->view('templates/puskeswan-view/page-title');?>
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

<footer style="width: 100%;" height="auto">
    
</footer>
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
    

