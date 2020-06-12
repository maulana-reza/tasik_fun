<?= form_open(); ?>
<div class="card p-3">
	<div class="form-group">
		<label for="company_name">Nama Perusahaan</label>
		<?= form_input($company_name); ?>
	</div>

	<div class="form-group">
		<label for="email">Email</label>
		<?= form_input($email); ?>
	</div>

	<div class="form-group">
		<label for="phone_number">Nomor Handphone</label>
		<?= form_input($phone_number); ?>
	</div>

	<div class="form-group">
		<label for="address">Address</label>
		<?= form_textarea($address); ?>
	</div>
</div>

	<div class="text-right">
		<button type="submit" name="submit" class="btn btn-primary ml-0 mr-0 mt-3" style="bottom:0; right:0; border-radius: 5px !important;" value="submit">Ubah</button>
	</div>
<?= form_close(); ?>
	
<script src="<?= base_url();?>node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js" ></script>

<script type="text/javascript">
ClassicEditor
    .create( document.querySelector('.address-text') )
    .then( editor => {;
    } )
    .catch( error => {
        console.error( error );
    } );
	    
</script>