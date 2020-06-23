<!Doctype html>
<html lang="en">
  <head>
    <title><?= getenv('APP_NAME').' >> '.@$page_title;?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('assets/templates/eatery/');?>css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url('assets/templates/eatery/');?>css/animate.css">
    <link rel="stylesheet" href="<?= base_url('assets/templates/eatery/');?>css/owl.carousel.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/templates/eatery/');?>css/magnific-popup.css">


    <link rel="stylesheet" href="<?= base_url('assets/templates/eatery/');?>fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/templates/eatery/');?>fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/templates/eatery/');?>fonts/flaticons/font/flaticon.css">

    <!-- Theme Style -->
    <link rel="stylesheet" href="<?= base_url('assets/templates/eatery/');?>css/style.css">
  </head>
  <body>
    
    <header role="banner">
      <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
          <a class="navbar-brand" href="index.html">
              <img src="<?= $this->config->item('logo_path');?>" alt="" class="w-25 position-absolute" style="top:-35px; left: 0;">
            </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarsExample05">
            <ul class="navbar-nav ml-auto pl-lg-5 pl-0">
              <?php foreach (menu_client() as $key => $value): ?>
              
              <li class="nav-item">
                <a class="nav-link active" href="<?= $value['url'] ?>"><?= strtoupper($value['name']) ;?></a>
              </li>
            <?php endforeach ?>
            </ul>

            <ul class="navbar-nav ml-auto">
              <li class="nav-item cta-btn">
                <a class="nav-link" href="<?= site_url('about/contact');?>">HUBUNGI KAMI</a>
              </li>
            </ul>
            
          </div>
        </div>
      </nav>
    </header>
    <!-- END header -->
  <?php if (@$remove_banner): ?>
    
    <section class="home-slider-loop-false  inner-page owl-carousel">
      <div class="slider-item" style="background-image: url('<?= base_url('assets/logo/bg.png');?>');">
        
        <div class="container">
          <div class="row slider-text align-items-center justify-content-center">
            <div class="col-md-8 text-center col-sm-12 element-animate">
              <h1><?= @$page_title;?></h1>
              <p><?= @$page_sub_title;?></p>
            </div>
          </div>
        </div>

      </div>

    </section>
  <?php endif ?>

    <?= $content;?>

    <footer class="site-footer" role="contentinfo">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-4 mb-5">
            <h3>Sosial Media Kami</h3>
            <p class="mb-5"><?=  $this->session->userdata('description'); ?></p>
            <ul class="list-unstyled footer-link ">
              <?php foreach ($this->session->userdata('sosial_media') as $key => $value): ?>
                <li class="d-block">
                  <a href="<?= $value['url'];?>"><span class="text-white"><?= $value['id']; ?></span></a>
                </li>
              <?php endforeach ?>

            </ul>

          </div>
          <div class="col-md-5 mb-5">
            
            <div>
              <h3>Contact Info</h3>
              <ul class="list-unstyled footer-link">
                <li class="d-block">
                  <span class="d-block">Address:</span>
                  <span class="text-white"><?= $this->session->userdata('address'); ?></span></li>
                <li class="d-block"><span class="d-block">Telephone:</span><span class="text-white"><?= $this->session->userdata('phone_number');?></span></li>
                <li class="d-block"><span class="d-block">Email:</span><span class="text-white"><?= $this->session->userdata('email'); ?></span></li>
              </ul>
            </div>
          </div>
          <div class="col-md-3 mb-5">
            <h3>Quick Links</h3>
            <ul class="list-unstyled footer-link">
              <?php foreach (menu_client() as $key => $value): ?>
                
              <li><a href="<?= $value['url'] ?>"><?= ucfirst(strtolower($value['name'])) ?></a></li>
              <?php endforeach ?>
              <li><a href="<?= site_url('auth') ?>"><?= ucfirst(strtolower('sign-in')) ?></a></li>

            </ul>
          </div>
          <div class="col-md-3">
          
          </div>
        </div>
        <div class="row">
          <div class="col-12 text-md-center text-left">
            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
          </div>
        </div>
      </div>
    </footer>
    <!-- END footer -->

    <!-- loader -->
    <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#cf1d16"/></svg></div>

    <script src="<?= base_url('assets/templates/eatery/');?>js/jquery-3.2.1.min.js"></script>
    <script src="<?= base_url('assets/templates/eatery/');?>js/popper.min.js"></script>
    <script src="<?= base_url('assets/templates/eatery/');?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/templates/eatery/');?>js/owl.carousel.min.js"></script>
    <script src="<?= base_url('assets/templates/eatery/');?>js/jquery.waypoints.min.js"></script>

    <script src="<?= base_url('assets/templates/eatery/');?>js/jquery.magnific-popup.min.js"></script>
    <script src="<?= base_url('assets/templates/eatery/');?>js/magnific-popup-options.js"></script>
    

    <script src="<?= base_url('assets/templates/eatery/');?>js/main.js"></script>
  </body>
</html>