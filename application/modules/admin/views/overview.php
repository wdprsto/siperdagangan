<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Header -->
<div class="header bg-transparent pb-6">
	<div class="container-fluid">
		<div class="header-body">
			<div class="row align-items-center py-4">
				<div class="col-lg-6 col-7">
					<h6 class="h2 d-inline-block mb-0">Dashboard</h6>
				</div>
				<div class="col-lg-6 col-5 text-right">
					<?php if ($flash) : ?>
						<?php echo "<script>toastr.success('" . $flash . "')</script>"; ?>
					<?php endif; ?>
					<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
						<ol class="breadcrumb breadcrumb-links">
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
						</ol>
					</nav>
				</div>
			</div>

			<!-- CARD SEKILAS INFO -->
			<div class="row">
				<div class="col-xl-3 col-md-6">
					<div class="card bg-gradient-primary border-0">
						<!-- Card body -->
						<div class="card-body">
							<div class="row">
								<div class="col">
									<h5 class="card-title text-uppercase text-muted mb-0 text-white">BARANG</h5>
									<span class="h2 font-weight-bold mb-0 text-white"><?php echo $total_products; ?></span>
								</div>
								<div class="col-auto">
									<a href="<?php echo site_url('admin/products'); ?>" class="btn btn-sm btn-neutral mr-0">
										<i class="fas fa-ellipsis-h"></i>
									</a>
								</div>
							</div>
							<p class="mt-3 mb-0 text-sm">
								<span class="text-nowrap text-white font-weight-600">Jumlah Barang</span>
							</p>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-md-6">
					<div class="card bg-gradient-info border-0">
						<!-- Card body -->
						<div class="card-body">
							<div class="row">
								<div class="col">
									<h5 class="card-title text-uppercase text-muted mb-0 text-white">KATEGORI</h5>
									<span class="h2 font-weight-bold mb-0 text-white"><?php echo $total_category; ?></span>
								</div>
								<div class="col-auto">
									<a href="<?php echo site_url('admin/products/category'); ?>" class="btn btn-sm btn-neutral mr-0">
										<i class="fas fa-ellipsis-h"></i>
									</a>
								</div>
							</div>
							<p class="mt-3 mb-0 text-sm">
								<span class="text-nowrap text-white font-weight-600">Jumlah Kategori</span>
							</p>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-md-6">
					<div class="card bg-gradient-danger border-0">
						<!-- Card body -->
						<div class="card-body">
							<div class="row">
								<div class="col">
									<h5 class="card-title text-uppercase text-muted mb-0 text-white">PENJUALAN SELESAI</h5>
									<span class="h2 font-weight-bold mb-0 text-white"><?php echo $total_finished_transaction; ?></span>
								</div>
								<!-- <div class="col-auto">
                  <a href="<?php //echo site_url('admin/products/category'); 
														?>" class="btn btn-sm btn-neutral mr-0" >
                    <i class="fas fa-ellipsis-h"></i>
									</a>
                </div> -->
							</div>
							<p class="mt-3 mb-0 text-sm">
								<span class="text-nowrap text-white font-weight-600">Jumlah Penjualan </span>
							</p>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-md-6">
					<div class="card bg-gradient-default border-0">
						<!-- Card body -->
						<div class="card-body">
							<div class="row">
								<div class="col">
									<h5 class="card-title text-uppercase text-muted mb-0 text-white">PENDAPATAN</h5>
									<span class="h2 font-weight-bold mb-0 text-white">Rp<?php echo format_rupiah($sum_finished_transaction); ?></span>
								</div>
								<!-- <div class="col-auto">
                  <a href="<?php //echo site_url('admin/products/category'); 
														?>" class="btn btn-sm btn-neutral mr-0" >
                    <i class="fas fa-ellipsis-h"></i>
									</a>
                </div> -->
							</div>
							<p class="mt-3 mb-0 text-sm">
								<span class="text-nowrap text-white font-weight-600">Total Penjualan </span>
							</p>
						</div>
					</div>
				</div>
			</div>


		</div>
	</div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">

