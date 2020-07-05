
            <div class="pt-5">
            
				<?php
				if (is_array(@$btn)): ?>
					<?php foreach ($btn as $key => $value): ?>
		            <a href="<?= $value['href'];?>" class="btn bg-white font-weight-bold mt-3 float-right text-dark"><?= $value['text']; ?></a>
					<?php endforeach ?>
				<?php endif ?>				
            	<?php if (@$btn_back): ?>
					
		            <a href="<?= site_url($btn_back);?>" class="btn bg-white text-dark font-weight-bold mt-3 float-right"><?=(!empty(@$btn_back_name) ? $btn_back_name :'Kembali' )?></a>
				<?php endif ?>


            </div>

<div class="row row-eq-height pb-2  heading-title mt-1 pt-5 pt-md-0">

<div class=" ml-3  " style="width: 50px; height: 50px;">

</div>
<div class="ml-0 heading-content-title ml-3 mt-2 mt-md-0 pt-2 pt-md-0">	
<?php 
$this->load->view('title');
?><br>
<p ></p>
</div>
</div>
