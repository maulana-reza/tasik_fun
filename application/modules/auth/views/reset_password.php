
 <div class=" mt-5 mb-5 ml-3 mr-3 pb-2 pt-3">
        <?php echo form_open();?>
          <div class="form-group  ">
            	<label class="card-text" for="identity"><?php echo sprintf(lang_line('reset_password_new_password_label','auth'), $min_password_length);?></label>
              <div class="input-group mb-2 waves-effect">
                <div class="input-group-prepend">
                  <span class="input-group-text border-primary bg-transparent border-0 border-left border-top border-bottom" id="basic-addon1"><i class="fa fa-lock"></i></span>
                </div>
                <?php echo form_input($new_password);?>
              </div>
            </div>
            <div class="form-group  ">
            	<label class="card-text" for="identity"><?php echo sprintf(lang_line('reset_password_new_password_confirm_label','auth'), $min_password_length);?></label>
              <div class="input-group mb-2 waves-effect">
                <div class="input-group-prepend">
                  <span class="input-group-text border-primary bg-transparent border-0 border-left border-top border-bottom" id="basic-addon1"><i class="fa fa-lock"></i></span>
                </div>
                <?php echo form_input($new_password_confirm);?>
              </div>
            </div>
              <div class="form-group mb-2 w-100">
              <button type="submit" class="btn btn-outline-primary w-100 waves-effect m-0 pb-2 pt-2" name="masuk" value="CONFIRM"><?php echo lang_line('reset_password_submit_btn','auth'); ?></button>
            </div>
	

	<?php echo form_input($user_id);?>
	<?php echo form_hidden($csrf); ?>

<?php echo form_close();?>
</div>