<table class="table table-striped table-sm table-hover w-100">
		<thead>
			<tr>
				<th class="card-text">#</th>
				<th class="card-text">User</th>
				<th class="card-text">Report</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($report as $key => $value): ?>
			<tr>
				<td class="card-text"><?php echo $key+1 ?></td>	
				<td class="card-text "><a class="text-primary" href="<?php echo site_url('admin/profile/'.$value['user_id']) ?>"><?php echo $value['full_name'] ?></a></td>	
				
				<td class="card-text">
					<?php $info = explode(",", $value['information']); 
					foreach ($info as $key => $value) {
						echo "<li>".$value."</li>";
					}?>
					
				</td>
			</tr>
			<?php endforeach ?>
		</tbody>
	</table>