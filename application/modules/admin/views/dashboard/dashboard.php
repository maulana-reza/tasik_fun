<div class="card-columns">

	<a href="<?= site_url(uri_string()."/add"); ?>">
	<div class="card p-3 waves-effect text-center shadow ml-0 mb-0 position-relative" style="height: 15em;">
		<i class="fa fa-plus fa-2x m-auto position-absolute" style="left:0; right:0;top:0;bottom:0;"></i>	
	</div>
	</a>

	<div class="card p-3 waves-effect text-center shadow ml-0 mb-0 position-relative overflow-hidden" style="height: 15em;">
		<img src="<?php echo base_url(); ?>/assets/uploads/bmw.jpg" alt="gambar-dokumentasi" class="position-absolute h-100" style="left:0; right:0;top:0;bottom:0;">
		<div class="position-absolute cover-card h-100 w-100 text-white bg-dark text-left p-2" style="left:0; right:0;top:0;bottom:0;">
				<div class="label">
					TEXT-JUDUL
				</div>
				<div class="description card-text">
					<?php $text = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, molestias, veritatis! Tempore illum nam nisi molestias dolorum voluptas officia? Laudantium dolore hic aut error corporis voluptatem repudiandae, quos, nulla odio";
					$text =  strlen($text) > 80 ? substr($text, 0, 80) . '...' : $text;
					echo $text;
					?>
				</div>
				<i class="fa fa-trash fa-2x m-auto position-absolute" style="left:0; right:0;top:0;bottom:0;"></i>
		</div>
	</div>
</div>
<style>

	.card-text{
		font-size: small !important;
	}
	.card:hover > .fa-trash{
		display: block !important;
	}

	.card:hover {
		-webkit-box-shadow: inset 0px -200px 52px -53px rgba(0,0,0,0.75);
		-moz-box-shadow: inset 0px -200px 52px -53px rgba(0,0,0,0.75);
		box-shadow: inset 0px -200px 52px -53px rgba(0,0,0,0.75);
		transition: 0.2s;
	}
	.card .cover-card{
		box-shadow: 10 10 0 0 black;
		opacity: 0.7;
		margin-top: 100%;
	}
	.card:hover > .cover-card{
		margin-top: 50%;
		transition: 0.3s;
	}
	@media screen and (max-width: 480px) {

		.card .cover-card{
			margin-top: 50%;
			transition: 0.3s;
		}	
	}
</style>