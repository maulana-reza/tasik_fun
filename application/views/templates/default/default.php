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
	<?= @$content;?>
</body>
</html>