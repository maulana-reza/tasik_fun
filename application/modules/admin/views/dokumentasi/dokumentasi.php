<div class="card-columns">

	<a href="<?= site_url(uri_string()."/add"); ?>">
	<div class="card p-3 waves-effect text-center shadow ml-0 mb-3 position-relative" style="height: 15em;">
		<i class="fa fa-plus fa-2x m-auto position-absolute" style="left:0; right:0;top:0;bottom:0;"></i>	
	</div>
	</a>

	<?= $list; ?>
</div>
<style>
	.text-sm{
		font-size: x-small !important;
	}
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