
    
    <div class="section container">
        <div class="row">

          <div class="col-md-12 p-2 text-center">
            <h2><?= getenv('APP_NAME');?></h2>
            <?=
            $this->session->userdata('description'); 
            ?>
            </div>

        </div>
      </div>

    </section>
