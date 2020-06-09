
            <div class="pt-5">
            
				<?php if (is_array(@$btn)): ?>
					<?php foreach ($btn as $key => $value): ?>
		            <a href="<?= $value['href'];?>" class="btn bg-white font-weight-bold mt-3 float-right"><?= $value['text']; ?></a>
					<?php endforeach ?>
				<?php endif ?>				
            	<?php if (@$btn_back): ?>
					
		            <a href="<?= site_url($btn_back);?>" class="btn bg-white font-weight-bold mt-3 float-right"><?=(!empty(@$btn_back_name) ? $btn_back_name :'Kembali' )?></a>
				<?php endif ?>


            </div>

<div class="row row-eq-height pb-2  heading-title mt-1">

<div class=" ml-3  " style="width: 50px; height: 50px;">

<img src="<?= base_url('assets/templates/puskeswan-admin/img/home.png'); ?>" alt="" style="width: 50px;">	
</div>	
<div class="ml-0 heading-content-title ml-3 mt-0 ">	
<?php 
	if(@$content_title){
		echo strtoupper(@$content_title);
	}else{
		echo strtoupper("Dashboard");
	}

?><br>
<p ><?php 
	if(@$content_sub_title){
		echo @$content_sub_title;
	}else{
		echo "Dashboard";
	}

?></p>
</div>
</div>