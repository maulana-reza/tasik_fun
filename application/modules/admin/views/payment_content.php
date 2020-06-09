<?php $no = ($this->uri->segment(4) ? $this->uri->segment(4) : 0 ); ?>
<?php foreach ($users as $key => $value): ?>
<tr>
	<td class="card-text"><?php echo $no+=1 ?></td>
	<td class="card-text "><a class="text-primary" href="<?php echo site_url('content/view/'.$value['content_id']) ?>"><?php echo substr($value['title'],0,10) .(strlen($value['title']) > 10 ? "..." : "" ); ?></a></td>
	<td class="card-text "><a
		class="text-primary"
		data-id="<?php echo $value['id_payment']; ?>"
		href="<?php echo $this->config->item('img_path')."/".$value['image']; ?>"
		data-toggle="modal"
		data-target="#frameModalBottom"
		onclick="get_image(event,this)"
	>document</a></td>
	<td class="card-text">
		<?php if (!$value['prove_id']){ ?>
		
		<button type="submit" class="btn btn-outline-primary bg-white card-text p-1 m-0 waves-effect"
		data-id="<?php echo $value['id_payment']; ?>"
		data-toggle="modal"
		data-target="#frameModalBottom"
		onclick="get_detail(event,this)"
		>DETAIL</button>
		<?php }else{
			echo "paid";
		} ?>
	</td>
</tr>
<?php endforeach ?>