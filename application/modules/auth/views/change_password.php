
<div class="m-3">
<?php echo form_open("profile/change_password");?>

      <p>
            
            <div class="card-text">
                  <?php echo lang_line('change_password_old_password_label', 'auth');?> 
      </div>
            <?php echo form_input($old_password);?>
      </p>

      <p>
            <label for="new_password" class="card-text"><?php echo sprintf(lang_line('change_password_new_password_label','auth'), $min_password_length);?></label> 
            <?php echo form_input($new_password);?>
      </p>

      <p>
            <div class="card-text">
      <?php echo lang_line('change_password_new_password_confirm_label', 'auth');?> 
            </div>
            <?php echo form_input($new_password_confirm);?>
      </p>

      <?php echo form_input($user_id);?>
        <button type="submit" class="btn btn-primary link-move w-100 waves-effect m-0 p-2" name="submit" value="submit"><?php echo lang_line('change_password_submit_btn','auth') ?></button>
      

<?php echo form_close();?>
</div>
