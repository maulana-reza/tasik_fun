
<?php echo form_open("admin/users/deactivate/".$user->id);?>
<div class="setting">
	<h4 class="pt-3 pb-3 "><?php echo lang('deactivate_heading');?></h4>
	<div class="label card-text text-center pb-2">
	<?php echo sprintf(lang('deactivate_subheading'), '<b class="text-danger">'.$user->username.'</b>');?></div>
	<div class="text-center">
		<div class="switch">
  <label>
    No
    <input type="checkbox" name="confirm" value="yes" >
    <span class="lever"></span> Yes
  </label>
</div>
	</div>
</div>
</div>
<div class="text-right">
	<button type="submit" name="submit" class="btn btn-primary btn-sm">SUBMIT</button>
</div>
<?php echo form_hidden($csrf); ?>
<?php echo form_hidden(['id' => $user->id]); ?>
<?php echo form_close();?>