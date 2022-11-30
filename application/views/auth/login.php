<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="id-ID">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">

    <title><?php echo get_store_name(); ?></title>


    <link rel="icon" href="<?php echo base_url('assets/uploads/sites/Logo.png'); ?>">

    <link href="<?php echo get_theme_uri('custom/auth/login/css/owl.carousel.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo get_theme_uri('custom/auth/login/css/bootstrap.min.css'); ?>" rel="stylesheet" />
    <link href="<?php echo get_theme_uri('custom/auth/login/css/style.css'); ?>" rel="stylesheet" type="text/css" />

    
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  </head>
  
  <body>
  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url(<?php echo get_theme_uri('custom/auth/login/images/bg_1.jpg'); ?>);"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <h3>Login Sindag</h3>
            <p class="mb-4">SI Perdagangan <strong><?php echo get_store_name(); ?></strong></p>
            
            <?php if ($change_uname_notice) : ?>
            <div class="flash-message">
                <?php echo $change_uname_notice; ?>
            </div>

            <?php elseif ($flash_message) : ?>
            <div class="flash-message">
                <?php echo $flash_message; ?>
            </div>
            <?php endif; ?>

            <?php if ($redirection) : ?>
            <div class="flash-message">
                Login untuk melanjutkan
            </div>
            <?php endif; ?>
            
            <?php echo form_open('auth/login/do_login'); ?>
              <div class="form-group first">
                <label for="username">Username</label>
                <input type="text" name="username" value="<?php echo set_value('username', $old_username); ?>" class="form-control" placeholder="Username" minlength="4" maxlength="16" required>
                <?php echo form_error('username'); ?>
              </div>
              <div class="form-group last mb-3">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <?php echo form_error('password'); ?>
              </div>
              
              <div class="d-flex mb-5 align-items-center">
                <span class="ml-auto"><a href="<?php echo site_url('auth/register'); ?>" class="forgot-pass">Buat akun baru</a></span> 
              </div>

              <input type="submit" value="Log In" class="btn btn-block btn-primary">
              <?php echo form_close(); ?>
            </form>
          </div>
        </div>
      </div>
    </div>

    
  </div>
    <script src="<?php echo get_theme_uri('custom/auth/login/js/jquery-3.3.1.min.js'); ?>"></script>
    <script src="<?php echo get_theme_uri('custom/auth/login/js/popper.min.js'); ?>"></script>
    <script src="<?php echo get_theme_uri('custom/auth/login/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo get_theme_uri('custom/auth/login/js/main.js'); ?>"></script>
  </body>
</html>
