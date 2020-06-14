
    
    <div class="section container">
        <div class="row">
          <div class="col-lg-6">
            <p><img src="img/hero_2.jpg" alt="" class="img-fluid"></p>
            <p class="mb-5"><img src="img/hero_1.jpg" alt="" class="img-fluid"></p>
          </div>
          
          <div class="col-lg-6 pl-2 pl-lg-5">
            <h2 class="mb-5"><?= getenv('APP_NAME');?></h2>
            <?=
            $this->session->userdata('description'); 
            ?>

          </div>
        </div>
      </div>

    </section>
