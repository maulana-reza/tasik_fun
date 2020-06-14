<link rel="stylesheet" href="<?= base_url();?>node_modules/jquery.filer/css/jquery.filer.css">
<link rel="stylesheet" href="<?= base_url();?>node_modules/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css">

<?= form_open_multipart(); ?>
<div class="card p-3 mb-3">
	<div class="form-group">
		<label for="company_name">Nama Perusahaan</label>
		<?= form_input($company_name); ?>
	</div>
	<div class="form-group">
		<label for="description">Deskripsi</label>
		<?= form_textarea($description);?>
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
	<div class="form-group">
		<label for="medsos">Social Media</label>
		<?= form_input($medsos); ?>
	</div>
</div>

<div class="card p-3">
	<label for="">Sosial media</label>
	<div class="">
		<?= $sosmed ;?>
	</div>
</div>
	<div class="text-right">
		<button type="submit" name="submit" class="btn btn-primary ml-0 mr-0 mt-3" style="bottom:0; right:0; border-radius: 5px !important;" value="submit">Ubah</button>
	</div>
<?= form_close(); ?>
<script src="<?= base_url();?>node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js" ></script>
<script src="<?= base_url();?>node_modules/jquery.filer/js/jquery.filer.js" ></script>
<style>
	.item{
		transform: scale(1.02);
	}
</style>
<script type="text/javascript">
ClassicEditor
    .create( document.querySelector('[name="description"]') )
    .then( editor => {;
    } )
    .catch( error => {
        console.error( error );
    } );
    ClassicEditor
    .create( document.querySelector('[name="address"]') )
    .then( editor => {;
    } )
    .catch( error => {
        console.error( error );
    } );
    $(document).ready(function(){
	let item = '<li class="jFiler-item col-12 col-md-3 p-0">\
						<div class="jFiler-item-container w-100 mb-2">\
							<div class="jFiler-item-inner">\
								<div class="jFiler-item-thumb w-100">\
									<div class="jFiler-item-status"></div>\
									<div class="jFiler-item-thumb-overlay">\
										<div class="jFiler-item-info">\
											<div style="display:table-cell;vertical-align: middle;">\
												<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
												<span class="jFiler-item-others">{{fi-size2}}</span>\
											</div>\
										</div>\
									</div>\
									{{fi-image}}\
								</div>\
								<div class="jFiler-item-assets jFiler-row">\
									<ul class="list-inline pull-right w-25">\
									<li class="pt-4 pr-3">\
											<a class="bg-transparent"><i class="icon-jfi-trash jFiler-item-trash-action"></i></a>\
									</li>\
									</ul>\
									<ul class="list-inline pull-right w-75">\
									<li class="p-0">\
									<input type="text" class="form-control"  name="id_sosmed[{{fi-id}}]" placeholder="Nama Account Sosial media"/>\
									<input type="text" class="form-control"  name="url_sosmed[{{fi-id}}]"  placeholder="link Sosial media"/>\
									</li>\
									</ul>\
								</div>\
							</div>\
						</div>\
					</li>';
	$(".upload").filer({
		limit: null,
		maxSize: null,
		extensions: null,
		changeInput: '<div class="jFiler-input-dragDrop w-100"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div><div class="jFiler-input-text"><h3>Drag&Drop files here</h3><span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn blue text-white">Browse Files</a></div></div>',
		showThumbs: true,
		theme: "dragdropbox",
		templates: {
			box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
			item: item,
			itemAppend: item,
			progressBar: '<div class="bar"></div>',
			itemAppendToEnd: false,
			canvasImage: true,
			removeConfirmation: true,
			_selectors: {
				list: '.jFiler-items-list',
				item: '.jFiler-item',
				progressBar: '.bar',
				remove: '.jFiler-item-trash-action'
			}
		},
		dragDrop: {
			dragEnter: null,
			dragLeave: null,
			drop: null,
			dragContainer: null,
		},
		files: null,
		addMore: true,
		allowDuplicates: true,
		clipBoardPaste: true,
		excludeName: null,
		beforeRender: null,
		afterRender: null,
		beforeShow: null,
		beforeSelect: null,
		onSelect: null,
		afterShow: null,
		onRemove: function(itemEl, file, id, listEl, boxEl, newInputEl, inputEl){
			console.log(filerKit)
			var filerKit = inputEl.prop("jFiler"),
		        file_name = filerKit.files_list[id].name;

		},
		onEmpty: null,
		options: null,
		dialogs: {
			alert: function(text) {
				return alert(text);
			},
			confirm: function (text, callback) {
				confirm(text) ? callback() : null;
			}
		},
		captions: {
			button: "Choose Files",
			feedback: "Choose files To Upload",
			feedback2: "files were chosen",
			drop: "Drop file here to Upload",
			removeConfirmation: "Are you sure you want to remove this file?",
			errors: {
				filesLimit: "Only {{fi-limit}} files are allowed to be uploaded.",
				filesType: "Only Images are allowed to be uploaded.",
				filesSize: "{{fi-name}} is too large! Please upload file up to {{fi-maxSize}} MB.",
				filesSizeAll: "Files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB."
			}
		}
	});
});
</script>