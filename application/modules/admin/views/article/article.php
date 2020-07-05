<link rel="stylesheet" href="<?= base_url();?>node_modules/jquery.filer/css/jquery.filer.css">
<link rel="stylesheet" href="<?= base_url();?>node_modules/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css">
<?php echo anchor('admin/article/add',' Tambah Artikel','class="btn btn-white font-weight-bold"');?>
<br>
	<label for="">List Artikel</label>

	<a href="<?= site_url(uri_string()."/add"); ?>">
	<?= $list; ?>

<div class="w-100 text-center">
	<?= $this->pagination->create_links(); ?>
</div>
