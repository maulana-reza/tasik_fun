
    <section class="home-slider owl-carousel">
     <?= @$banner ;?>
    </section>
    <section class="section element-animate">
      
      <div class="container" id="dokumentasi">
        <div class="row">
          <?= $documentation ;?>

        </div>
        <div class="text-right">
          <?php
          echo $this->pagination->create_links();
          ?>
        </div>
      </div>

    </section> <!-- .section -->

    
