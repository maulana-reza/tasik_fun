

<!-- Material form login -->
      <div class=" mt-5 mb-5 ml-3 mr-3 pb-2">
        <?php echo form_open();?>
            <div class="form-group  ">
            	<label class="card-text" for="identity"><?php echo lang_line('forgot_password_email_identity_label','auth');?></label>
              <div class="input-group mb-2 waves-effect">
                <div class="input-group-prepend">
                  <span class="input-group-text border-primary bg-transparent border-0 border-left border-top border-bottom" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                </div>
                <?php echo form_input($identity);?>
              </div>
            </div>
            <div class="form-group mb-2 w-100">
              <button type="submit" class="btn btn-outline-primary link-move w-100 waves-effect m-0 pb-2 pt-2" name="masuk" value="CONFIRM"><?php echo lang_line('forgot_password_submit_btn','auth'); ?></button>
            </div>
            <?php echo form_close();?>
          </div>
<!-- Material form login -->
