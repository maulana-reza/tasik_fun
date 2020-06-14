<link rel="stylesheet" href="<?= base_url();?>node_modules/jquery.filer/css/jquery.filer.css">
<link rel="stylesheet" href="<?= base_url();?>node_modules/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css">
  <?= form_open_multipart(site_url(uri_string())."?back=".$this->input->get('back')); ?>

<div class="card p-3">
  <label for="category">Kategori</label>
  <input type="file" name="category[]" class="category-input">
</div>
<div class="text-right">
    <button type="submit" name="submit" class="btn btn-primary ml-0 mr-0 mt-3" style="bottom:0; right:0; border-radius: 5px !important;" value="submit">SUBMIT</button>
    </div>
  <?= form_close(); ?>

<script src="<?= base_url();?>node_modules/jquery.filer/js/jquery.filer.js" ></script>

<script type="text/javascript">
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
                  <ul class="list-inline pull-right">\
                  <li class="p-0">\
                      <input type="text" name="desc[{{fi-id}}]" value="" class="form-control w-75 m-0 d-inline" placeholder="Nama Kategori">\
                      <div class="d-inline w-25 m-0 text-center">\
                        <a class="bg-transparent"><i class="icon-jfi-trash jFiler-item-trash-action"></i></a>\
                      </div>\
                  </li>\
                  </ul>\
                </div>\
              </div>\
            </div>\
          </li>';
  $(".category-input").filer({
    limit: null,
    maxSize: null,
    extensions: null,
    changeInput: '<div class="jFiler-input-dragDrop w-100"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div><div class="jFiler-input-text"><h3>Drag&Drop files here</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn blue text-white">Browse Files</a></div></div>',
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
    addMore: <?= $this->uri->segment(4) ? 'false' : 'true';?>,
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