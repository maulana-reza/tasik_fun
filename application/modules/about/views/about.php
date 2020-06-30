
    
    <div class="container">
        <div class="row p-2">
            <h2 class="text-center"><?= getenv('APP_NAME');?></h2>

          <div class="col-md-12 p-0">
            <?=
            $this->session->userdata('description'); 
            ?>
            </div>

        </div>
      </div>

