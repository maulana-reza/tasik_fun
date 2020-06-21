<div class="card-columns">
<?= $documentation ;?>

</div>
<style>
	.text-sm{
		font-size: x-small !important;
	}
	.card-text{
		font-size: small !important;
	}
	.card:hover {
		transform: scale(1.02);
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
		margin-top: 50%;
	}
	.card:hover > .cover-card{
		margin-top: 40%;
		transition: 0.3s;
	}
	@media screen and (max-width: 480px) {

		.card .cover-card{
			margin-top: 40%;
			transition: 0.3s;
		}	
	}
</style>