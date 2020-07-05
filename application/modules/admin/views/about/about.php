<link rel="stylesheet" href="<?= base_url();?>node_modules/jquery.filer/css/jquery.filer.css">
<link rel="stylesheet" href="<?= base_url();?>node_modules/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css">

<?= form_open_multipart(); ?>
<div class="card p-3 mb-3">
	<div class="form-group">
		<label for="description">Deskripsi</label>
		<?= form_textarea($description);?>
	</div>
</div>

	<div class="text-right">
		<button type="submit" name="submit" class="btn btn-primary ml-0 mr-0 mt-3" style="bottom:0; right:0; border-radius: 5px !important;" value="submit">Ubah</button>
	</div>
<?= form_close(); ?>
    <script src="<?= base_url();?>node_modules/ckeditor4/ckeditor.js" ></script>

<!-- <script src="<?= base_url();?>node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js" ></script> -->
<script src="<?= base_url();?>node_modules/jquery.filer/js/jquery.filer.js" ></script>
<style>
	.item{
		transform: scale(1.02);
	}
</style>
<script type="text/javascript">
	CKEDITOR.replace('description');
   
</script>
