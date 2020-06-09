<?php $no = ($this->uri->segment(4) ? $this->uri->segment(4) : 0 ); ?>
<?php foreach ($users as $user):?>
		<tr>
			<td class="card-text"><?php echo $no+=1; ?></td>
            <td class="card-text"><?php echo anchor("admin/profile/".$user->id,htmlspecialchars($user->full_name,ENT_QUOTES,'UTF-8'));?></td>
			<td class="card-text">
				<?php foreach ($user->groups as $group):?>
					<!-- <?php //echo anchor("admin/users/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br /> -->
					<?php echo htmlspecialchars($group->name,ENT_QUOTES,'UTF-8') ;?><br />

                <?php endforeach?>
			</td>
			<td class="card-text"><?php echo ($user->active) ? anchor("admin/users/deactivate/".$user->id, lang('index_active_link'),'onclick="get_option(this)" data-toggle="modal" data-target="#modal-report"') : anchor("admin/users/activate/". $user->id, lang('index_inactive_link'),'data-toggle="modal" onclick="get_option(this)" data-target="#modal-report"');?></td>
			<td class="card-text"><?php echo anchor("admin/profile/".$user->id, '<p class="btn-sm btn btn-primary"><i class="fa fa-eye"></i></p>') ;?></td>
		</tr>
	<?php endforeach;?>