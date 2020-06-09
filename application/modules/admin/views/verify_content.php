<?php $no = ($this->uri->segment(4) ? $this->uri->segment(4) : 0 ); ?>
<?php foreach ($users as $key => $value): ?>
			<tr>
				<td class="card-text"><?php echo $no+1 ?></td>	
				<td class="card-text "><a class="text-primary" href="<?php echo site_url('admin/profile/'.$value['user_id']) ?>"><?php echo $value['full_name'] ?></a></td>	
				<td class="card-text "><a class="text-primary" href="<?php echo $this->config->item('img_path')."/".$value['document']; ?>"
					data-toggle="modal" 
					data-target="#frameModalBottom"
					onclick="get_image(event,this)" >document</a></td>	
				<td class="card-text">
					<?php if (!$value['prove_id']){ ?>
					<button type="submit" name="user_id" class="btn btn-outline-primary bg-white card-text p-1 m-0 waves-effect" value="<?php echo $value['user_id']; ?>">verify</button>
					<?php }else{
						?>
						upgraded
						<?php
					} ?>

				</td>
			</tr>

<?php endforeach ?>