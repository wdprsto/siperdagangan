<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><?php echo anchor(base_url(), 'Home'); ?></li>
              <li class="breadcrumb-item active">Profil</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline card-dark">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?php echo get_user_image(); ?>"
                       alt="<?php echo get_kasir_name(); ?>?>">
                </div>
                <h3 class="profile-username text-center"><?php echo get_kasir_name(); ?></h3>
                <p class="text-muted text-center"><?php echo $user->ksr_id; ?> | <?php echo $user->ksr_nohp; ?></p>
                <?php if ($flash) : ?>
                    <p class="text-center text-success"><?php echo $flash; ?></p>
                <?php endif; ?>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link profil active" href="#profile" data-toggle="tab">Profil</a></li>
                  <li class="nav-item"><a class="nav-link akun " href="#akun" data-toggle="tab">Akun</a></li>
                  <!-- <li class="nav-item"><a class="nav-link email" href="#email" data-toggle="tab">Email</a></li> -->
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="profile">
                    <?php echo form_open_multipart('kasir/profile/edit_name'); ?>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Nama:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" name="name" value="<?php echo set_value('name', $user->ksr_nama); ?>" >
                          <?php echo form_error('name', '<div class="text-danger font-weight-bold">', '</div>'); ?>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputHP" class="col-sm-2 col-form-label">No. HP:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputHP" name="phone_number" value="<?php echo set_value('phone_number', $user->ksr_nohp); ?>" >
                          <?php echo form_error('phone_number', '<div class="text-danger font-weight-bold">', '</div>'); ?>
                        </div>
                      </div>
                      <!-- <div class="form-group row">
                        <label for="inputAddr" class="col-sm-2 col-form-label">Alamat:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputAddr" name="address" value="</?php echo set_value('address', $user->address); ?>" required>
                        </div>
                        </?php echo form_error('address', '<div class="text-danger font-weight-bold">', '</div>'); ?>
                      </div> -->

                      <!-- <div class="form-group row">
                        <label for="inputFoto" class="col-sm-2 col-form-label">Foto profil:</label>
                        <div class="col-sm-10">
                          <input type="file" class="form-control" id="inputFoto" name="file">
                        </div>
                        </?php echo form_error('name', '<div class="text-danger font-weight-bold">', '</div>'); ?>
                      </div> -->
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-secondary">Perbarui</button>
                        </div>
                      </div>
                      <?php echo form_close(); ?>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="akun">
                <?php echo form_open('kasir/profile/edit_account', array('autocomplete' => 'off')); ?>
                    <div class="form-group row">
                        <label for="inputUserName" class="col-sm-2 col-form-label">Username:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputUserName" name="username" value="<?php echo set_value('username', $user->ksr_id); ?>">
                          <?php echo form_error('username', '<div class="text-danger font-weight-bold">', '</div>'); ?>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password:</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password Baru">
                          <?php echo form_error('password', '<div class="text-danger font-weight-bold">', '</div>'); ?>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-secondary">Perbarui</button>
                        </div>
                      </div>
                      <?php echo form_close(); ?>
                  </div>
                  <!-- /.tab-pane -->

                  <!-- <div class="tab-pane" id="email">
                    </?php echo form_open('kasir/profile/edit_email'); ?>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email:</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" name="email" value="</?php echo set_value('email', $user->email); ?>" required>
                        </div>
                        </?php echo form_error('email', '<div class="text-danger font-weight-bold">', '</div>'); ?>
                      </div>
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-secondary">Perbarui</button>
                        </div>
                      </div>
                      </?php echo form_close(); ?>
                  </div> -->
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
