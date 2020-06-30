<div class="card p-3">
	<?= form_open_multipart();?>
<div class="form-group">
	<label for="title">Nama Tempat</label>
	<?= form_input($title); ?>
</div>
<div class="form-group">
	<label for="address">Alamat</label>
	<?= form_input($address); ?>
</div>
<?= form_close();?>
</div>