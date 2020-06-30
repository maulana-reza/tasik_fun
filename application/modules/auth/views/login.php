
<!-- <div id="infoMessage" class="alert alert-info col-md-5 col-lg-3 col-sm-8 ml-auto mr-auto mb-auto mt-2" style="border-radius: 20px;"></div> -->

  <div class="col-md-5 col-lg-3 col-sm-8 col-10 mr-auto ml-auto card shadow-lg bg-top-blue  p-md-5 p-3 ml-md-auto mr-md-auto mr-sm-auto ml-sm-auto bg-login-card border-0" style="border-radius: 10px; position: relative; background-image: url(); ?>');">
      
    <?= form_open("","class='mt-0'");?>
    <!-- <form class="form-signin" class="" align="center"> -->
      
      <label for="identity" class="sr-only mt-4">Username</label>
       <?php echo form_input($identity);?>
      <label for="password" class="sr-only">Password</label>
    <?php echo form_input($password);?>
    
      <div class="text-left">
        <input type="checkbox" name="remember" class=""> Remember me?
      </div>
      <div class="mt-3 text-right">

      <?php echo form_submit('submit', lang('login_submit_btn'),'class=" pl-5 pr-5 pt-2 pb-2 text-uppercase text-center b-r-100 shadow bg-white border-0 text-blue font-weight-bold  pl-0"');?>
      <!-- <button class="pl-5 pr-5 pt-2 pb-2 text-center b-r-100 shadow bg-white border-0 text-blue font-weight-bold  pl-0"  type="submit" >LOGIN</button> -->
      </div>


    <?= form_close(); ?>
    <div class="bg-bottom-blue">
      
    </div>
  </div>
  <br>
  <div class="text-center">
    <?= anchor(base_url(), 'kembali ke halaman utama','class=""');?>
  </div>
