<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title><?php echo $title; ?> | <?php echo get_store_name(); ?></title>
	<!-- Favicon -->
	<link rel="icon" href="<?php echo base_url('assets/uploads/sites/Logo.png'); ?>">
	<!-- Fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
	<!-- Icons -->
	<link rel="stylesheet" href="<?php echo get_theme_uri('js/plugins/nucleo/css/nucleo.css', 'argon'); ?>" type="text/css">
	<link rel="stylesheet" href="<?php echo get_theme_uri('js/plugins/@fortawesome/fontawesome-free/css/all.min.css', 'argon'); ?>" type="text/css">
	<style>
		td.details-control {
			background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M384 240v32c0 6.6-5.4 12-12 12h-88v88c0 6.6-5.4 12-12 12h-32c-6.6 0-12-5.4-12-12v-88h-88c-6.6 0-12-5.4-12-12v-32c0-6.6 5.4-12 12-12h88v-88c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v88h88c6.6 0 12 5.4 12 12zm120 16c0 137-111 248-248 248S8 393 8 256 119 8 256 8s248 111 248 248zm-48 0c0-110.5-89.5-200-200-200S56 145.5 56 256s89.5 200 200 200 200-89.5 200-200z" fill="grey" /></svg>') no-repeat center center;
			background-size: 1.6rem;
			cursor: pointer;
		}

		tr.shown td.details-control {
			background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M140 284c-6.6 0-12-5.4-12-12v-32c0-6.6 5.4-12 12-12h232c6.6 0 12 5.4 12 12v32c0 6.6-5.4 12-12 12H140zm364-28c0 137-111 248-248 248S8 393 8 256 119 8 256 8s248 111 248 248zm-48 0c0-110.5-89.5-200-200-200S56 145.5 56 256s89.5 200 200 200 200-89.5 200-200z" fill="grey"/></svg>') no-repeat center center;
			background-size: 1.6rem;
		}

		/* tweaking select2 */
		.select2-selection--single {
			height: 100% !important;
		}

		.select2-selection__rendered {
			word-wrap: break-word !important;
			text-overflow: inherit !important;
			white-space: normal !important;
			font-size: 14px !important;
			font-family: 'Open sans', Helvetica, sans-serif;
			margin-top: -9.1px;
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
		div.disabled {
			pointer-events: none;

			/* for "disabled" effect */
			opacity: 0.5;

		}

		html {
			scroll-behavior: smooth;
		}
	</style>

	<!-- Argon CSS -->
	<link rel="stylesheet" href="<?php echo get_theme_uri('css/argon9f1e.css?v=1.1.0', 'argon'); ?>" type="text/css">

	<script src="<?php echo get_theme_uri('vendor/jquery/dist/jquery.min.js', 'argon'); ?>"></script>
	<script src="<?php echo get_theme_uri('vendor/bootstrap/dist/js/bootstrap.bundle.min.js', 'argon'); ?>"></script>

	<!-- TOASTR JS LIBRARIES -->
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/toastr/toastr.min.css'); ?>">
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
	<!-- <script src="</?php echo base_url('assets/plugins/select2/js/select2-bootstrap4.min.js'); ?>"></script> -->
</head>

<body class="@yield('sidebar_type')">
	<!-- Sidenav -->
	<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
		<div class="scrollbar-inner">
			<!-- Brand -->
			<div class="sidenav-header d-flex align-items-center">
				<a class="navbar-brand" href="<?php echo base_url(); ?>">
					<img src="<?php echo get_store_logo(); ?>" class="navbar-brand-img" alt="Logo <?php echo get_store_name(); ?>">
				</a>
				<div class="ml-auto">
					<!-- Sidenav toggler -->
					<div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
						<div class="sidenav-toggler-inner">
							<i class="sidenav-toggler-line"></i>
							<i class="sidenav-toggler-line"></i>
							<i class="sidenav-toggler-line"></i>
						</div>
					</div>
				</div>
			</div>
			<div class="navbar-inner">
				<!-- Collapse -->
				<div class="collapse navbar-collapse" id="sidenav-collapse-main">
					<!-- Nav items -->
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link <?php echo $active_page == 'dashboard' ? 'active font-weight-bold' : '' ?>" href="<?php echo site_url('admin'); ?>">
								<i class="ni ni-tv-2 text-primary"></i>
								<span class="nav-link-text">Dashboard</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?php echo $active_page == 'category' ? 'active font-weight-bold' : '' ?>" href="<?php echo site_url('admin/products/category'); ?>">
								<i class="ni ni-bullet-list-67 text-info"></i>
								<span class="nav-link-text">Kategori Barang</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?php echo $active_page == 'product' ? 'active font-weight-bold' : '' ?>" href="<?php echo site_url('admin/products'); ?>">
								<i class="fa fa-box-open text-success"></i>
								<span class="nav-link-text">Barang</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?php echo $active_page == 'edit_product_price' ? 'active font-weight-bold' : '' ?>" href="<?php echo site_url('admin/products/edit_product_price'); ?>">
								<i class="fa fa-edit text-success"></i>
								<span class="nav-link-text">Ubah Harga Barang</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?php echo $active_page == 'po' ? 'active font-weight-bold' : '' ?>" href="<?php echo site_url('admin/orders'); ?>">
								<i class="fa fa-file-invoice text-danger"></i>
								<span class="nav-link-text">PO</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?php echo $active_page == 'supplier' ? 'active font-weight-bold' : '' ?>" href="<?php echo site_url('admin/suppliers'); ?>">
								<i class="fa fa-people-carry text-info"></i>
								<span class="nav-link-text">Supplier</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?php echo $active_page == 'reports' ? 'active font-weight-bold' : '' ?>" href="<?php echo site_url('admin/reports'); ?>">
								<i class="fa fa-money-bill-alt text-warning"></i>
								<span class="nav-link-text">Laporan</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?php echo $active_page == 'password' ? 'active font-weight-bold' : '' ?>" href="<?php echo site_url('admin/passwords'); ?>">
								<i class="fa fa-key text-primary"></i>
								<span class="nav-link-text">Kelola Password</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
	<!-- Main content -->
	<div class="main-content" id="panel">
		<!-- Topnav -->
		<nav class="navbar navbar-top navbar-expand navbar-light bg-secondary border-bottom">
			<div class="container-fluid">
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<!-- Search form -->
					<!-- <form class="navbar-search navbar-search-dark form-inline mr-sm-3" id="navbar-search-main" action="<?php echo site_url('admin/products/search'); ?>" required>
             <div class="form-group mb-0">
               <div class="input-group input-group-alternative input-group-merge">
                 <div class="input-group-prepend">
                   <span class="input-group-text"><i class="fas fa-search"></i></span>
                 </div>
                 <input class="form-control" value="<?php echo (isset($query) ? $query : ''); ?>" name="search_query" placeholder="Cari..." type="text" required>
               </div>
             </div>
             <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
               <span aria-hidden="true">×</span>
             </button>
           </form> -->
					<!-- Navbar links -->
					<ul class="navbar-nav align-items-center ml-md-auto">
						<li class="nav-item d-xl-none">
							<!-- Sidenav toggler -->
							<div class="pr-3 sidenav-toggler sidenav-toggler-light" data-action="sidenav-pin" data-target="#sidenav-main">
								<div class="sidenav-toggler-inner">
									<i class="sidenav-toggler-line"></i>
									<i class="sidenav-toggler-line"></i>
									<i class="sidenav-toggler-line"></i>
								</div>
							</div>
						</li>

					</ul>
					<ul class="navbar-nav align-items-center ml-auto ml-md-0">
						<li class="nav-item dropdown">
							<a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<div class="media align-items-center">
									<span class="avatar avatar-sm rounded-circle">
										<img src="<?php echo get_admin_image(); ?>">
									</span>
									<div class="media-body ml-2 d-none d-lg-block">
										<span class="mb-0 text-sm  font-weight-bold"><?php echo get_admin_name(); ?></span>
									</div>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<div class="dropdown-header noti-title">
									<h6 class="text-overflow m-0">Welcome!</h6>
								</div>
								<a href="<?php echo site_url('admin/settings/profile'); ?>" class="dropdown-item">
									<i class="ni ni-single-02"></i>
									<span>Profil</span>
								</a>
								<a href="<?php echo site_url('admin/settings'); ?>" class="dropdown-item">
									<i class="ni ni-settings-gear-65"></i>
									<span>Pengaturan</span>
								</a>
								<div class="dropdown-divider"></div>
								<a href="<?php echo site_url('auth/logout'); ?>" class="dropdown-item">
									<i class="ni ni-user-run"></i>
									<span>Logout</span>
								</a>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</nav>
