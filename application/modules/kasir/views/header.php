<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="ID-id">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title; ?> | <?php echo get_store_name(); ?></title>
  
		<style>
			td.details-control {
				background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M384 240v32c0 6.6-5.4 12-12 12h-88v88c0 6.6-5.4 12-12 12h-32c-6.6 0-12-5.4-12-12v-88h-88c-6.6 0-12-5.4-12-12v-32c0-6.6 5.4-12 12-12h88v-88c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v88h88c6.6 0 12 5.4 12 12zm120 16c0 137-111 248-248 248S8 393 8 256 119 8 256 8s248 111 248 248zm-48 0c0-110.5-89.5-200-200-200S56 145.5 56 256s89.5 200 200 200 200-89.5 200-200z" fill="grey" /></svg>') no-repeat center center;
				background-size: 1.5rem;
				cursor: pointer;
				margin-left:2rem;
			}
			
			tr.shown td.details-control {
				background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M140 284c-6.6 0-12-5.4-12-12v-32c0-6.6 5.4-12 12-12h232c6.6 0 12 5.4 12 12v32c0 6.6-5.4 12-12 12H140zm364-28c0 137-111 248-248 248S8 393 8 256 119 8 256 8s248 111 248 248zm-48 0c0-110.5-89.5-200-200-200S56 145.5 56 256s89.5 200 200 200 200-89.5 200-200z" fill="grey"/></svg>') no-repeat center center;
				background-size: 1.5rem;
			}

			/* tweaking select2 */
			.select2-selection--single {
				height: 100% !important;
			}

			.select2-selection__rendered {
				font-size: 14px !important;
				font-family: 'Open sans', Helvetica, sans-serif;
			}

			/* custom scrollbar */
			::-webkit-scrollbar {
				width: 20px;
			}

			::-webkit-scrollbar-track {
				background-color: transparent;
			}

			::-webkit-scrollbar-thumb {
				background-color: #d6dee1;
				border-radius: 20px;
				border: 6px solid transparent;
				background-clip: content-box;
			}

			::-webkit-scrollbar-thumb:hover {
				background-color: #a8bbbf;
			}
			
			/* MEMBERIKAN EFEK DISABLED */
			div.disabled
			{
				pointer-events: none;

				/* for "disabled" effect */
				opacity: 0.5;
				
			}
			html {
				scroll-behavior: smooth;
			}



	 </style>

    <link rel="stylesheet" href="<?php echo get_theme_uri('plugins/fontawesome-free/css/all.min.css', 'adminlte'); ?>">
    <link rel="stylesheet" href="<?php echo get_theme_uri('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css', 'adminlte'); ?>">
    <link rel="stylesheet" href="<?php echo get_theme_uri('css/adminlte.min.css', 'adminlte'); ?>">
    <link rel="stylesheet" href="<?php echo get_theme_uri('plugins/toastr/toastr.min.css', 'adminlte'); ?>">
    <link rel="stylesheet" href="<?php echo get_theme_uri('plugins/air-datepicker/dist/css/datepicker.min.css', 'adminlte'); ?>">

    <link rel="icon" href="<?php echo base_url('assets/uploads/sites/Logo.png'); ?>">
    <link href='https://fonts.googleapis.com/css?family=Parisienne' rel='stylesheet'>


    <script src="<?php echo get_theme_uri('plugins/jquery/jquery.min.js', 'adminlte'); ?>"></script>
    <script src="<?php echo get_theme_uri('plugins/bootstrap/js/bootstrap.bundle.min.js', 'adminlte'); ?>"></script>

		<!-- //sweetalert -->
		<link rel="stylesheet" href="<?php echo base_url('assets/plugins/sweetalert2/sweetalert2.min.css'); ?>">
		<script src="<?php echo base_url('assets/plugins/sweetalert2/sweetalert2.min.js'); ?>"></script>
	
    <script src="<?php echo base_url('assets/plugins/toastr/toastr.min.js'); ?>"></script>
    <script>
      toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }
    </script>

		<!-- SELECT2 LIBRARIES -->
		<link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2/css/select2.min.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2/css/select2-bootstrap4.min.css'); ?>">
		<script src="<?php echo base_url('assets/plugins/select2/js/select2.min.js'); ?>"></script>	
		<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/i18n/id.js"></script>
			
  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
          </li>
        </ul>

    <ul class="navbar-nav ml-auto">

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" aria-expanded="false" href="#" style='text-align:center;'>
          <i class="fas fa-ellipsis-v" style="display: inline-block; width: 100%;"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="left: inherit; right: 0px;">
          <a href="<?php echo site_url('kasir/profile');?>" class="dropdown-item">
          <i class="fas fa-user-alt mr-2"></i></i> Profil

          </a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo site_url('auth/logout'); ?>" class="dropdown-item">
          <i class="fas fa-sign-out-alt mr-2"></i></i> Logout

          </a>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-2">
    <!-- Brand Logo -->
    

      <a href="<?php echo base_url(); ?>" class="brand-link">
        <img src="<?php echo get_store_logo(); ?>" alt="<?php echo get_store_name(); ?> Logo" class="brand-image img-circle" style="opacity: .8">
        <br>
      </a>
  
   

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo get_user_image(); ?>" class="img-circle" alt="Foto profil <?php echo get_kasir_name(); ?>">
        </div>
        <div class="info">
          <a href="<?php echo site_url('kasir/profile'); ?>" class="d-block"><strong><?php echo get_kasir_name(); ?></strong></a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?php echo site_url('kasir'); ?>" class="nav-link <?php echo $active_page == 'dashboard' ? 'active font-weight-bold' : '' ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo site_url('kasir/transactions'); ?>" class="nav-link <?php echo $active_page == 'transaksi' ? 'active font-weight-bold' : '' ?>">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Transaksi
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
