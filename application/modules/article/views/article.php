
<section class="section element-animate">

	<div class="container" id="dokumentasi">
		<div class="pl-0">Rekomendasi Artikel Terpopuler</div>
		<div class="card-columns row">
			<?= $article ;?>
		</div>

		<div class="text-right">
			<?php
			echo $this->pagination->create_links();
			?>
		</div>
	</div>

</section> <!-- .section -->


