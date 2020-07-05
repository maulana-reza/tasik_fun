<div class="container ">

	<div class="col-md-12 text-center heading-wrap">
		<h2>	<?= getenv('APP_NAME');?>
		</h2>
		<span class="back-text-dark">Temukan Informasi Tempat Wisata Di Tasikmalaya disini</span>
	</div>
	<?= form_open('','method="get"');?>
	<div class="input-group mb-5">
		<input type="text" class="form-control rounded" name="search" placeholder="Cari..." aria-label="Recipient's username" aria-describedby="basic-addon2">
		<div class="input-group-append">
			<button class="btn btn-white m-0 rounded-circle pt-0 pb-0 ml-2" type="submit" style="box-radius:0px !important;"><i class="fa fa-search"></i></button>
		</div>
	</div>
	<?= form_close();?>
	<?php if ($this->input->get('search')){

		?>
		<div class="pl-0 m-0 pb-3">Hasil Pencarian '<?= $this->input->get('search');?></div>

		<?php
	}else{
	?>
		<div class="pl-0 m-0 pb-3">Rekomendasi Artikel Terpopuler</div>

		<?php
	}?>
	<div class="card-columns row">
		<?= $article ;?>
	</div>

</div>
