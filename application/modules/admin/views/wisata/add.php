<div class="card p-3">
	<?= form_open_multipart();?>
	<div class="form-group">
		<label for="image">Image</label>
		<?= form_input($file); ?>

	</div>
<div class="form-group">
	<label for="title">Nama Tempat</label>
	<?= form_input($title); ?>
</div>
<div class="form-group">
	<label for="address">Alamat</label>
	<?= form_input($address); ?>
</div>
<div class="form-group text-right">
	<input type="submit" name="submit" value="submit" class="btn btn-primary">
</div>
<?= form_close();?>
</div>