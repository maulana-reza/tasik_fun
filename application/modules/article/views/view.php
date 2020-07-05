
<section class="section">
      <div class="container">

		  <div class="col-md-12 text-center heading-wrap border mb-2 pt-3" style=" height:70vh;background-position:center;background-size:cover; background-repeat: no-repeat; background-image: url(<?= $this->config->item('img_path').'/'.$image;?>")" >
			  <h2>	<?= $title;?>
			  </h2>
			  <span class="back-text-dark"><?= convert_date($date_create,"d / F / Y , H : i");?></span>
		  </div>
        <div class="row justify-content-center">
          <div class="col-md-12 mb-5">
            <?= $description ;?>

			  <div class="label mb-2 mt-5">Galeri</div>
			  <?= $gallery;?>
          </div>

        </div>
      </div>
    </section>
