<!DOCTYPE html>
<html >
<head>

  <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="<?= base_url('assets/templates/puskeswan-admin/');?>tool/bootstrap.min.css" >
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/templates/puskeswan-admin/');?>tool/style-login.css">
    <!-- Font Awesome JS -->
    <script defer src="<?= base_url('assets/templates/puskeswan-admin/');?>tool/solid.js" ></script>
    <script defer src="<?= base_url('assets/templates/puskeswan-admin/');?>tool/fontawesome.js" ></script>
  <title>
    <?php @$this->load->view('templates/puskeswan-admin/title');?>
    
  </title>
</head>
<body class="text-center pt-2 bg-bottom-blue"  style="" >
  <img class="mb-2" src="<?= base_url('assets/templates/puskeswan-admin/');?>img/<?= getenv('APP_LOGO'); ?>" alt="" width="72">
      <div class="title text-center m-auto p-auto font-weight-bold  text-blue" style="width: 170px;">
      <h1 class="h3 font-weight-bold"><?= getenv("APP_NAME");?></h1>
      </div>

    <?php if (!is_null(show_alert())): ?>
    <?php echo show_alert(); ?>
    <?php endif ?>
      <?= @$content ?>
      

</body>
</html>

    <script src="<?= base_url('assets/templates/puskeswan-admin/');?>tool/jquery-3.3.1.slim.min.js" ></script>
    <script src="<?= base_url('assets/templates/puskeswan-admin/');?>tool/popper.min.js" ></script>
    <script src="<?= base_url('assets/templates/puskeswan-admin/');?>tool/bootstrap.min.js" ></script>
