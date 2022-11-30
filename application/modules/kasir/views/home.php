<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2 ">
				<div class="col-sm-6">
					<h6 class="h3 d-inline-block mb-0">Dasbor</h6>

				</div><!-- /.col -->
				<div class="col-sm-6">
					<?php if ($flash) : ?>
						<?php echo "<script>toastr.success('" . $flash . "')</script>"; ?>
					<?php else : ?>
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="<?php echo  base_url(); ?>">Home</a></li>
							<li class="breadcrumb-item active">Dasbor</li>
						</ol>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-gradient-success">
						<div class="inner">
							<h3><?php echo $total_transaction; ?></h3>

							<p>Transaksi Saya</p>
						</div>
						<div class="icon">
							<i class="fas fa-shopping-cart"></i>
						</div>
						<a href="<?php echo site_url('kasir/transactions'); ?>" class="small-box-footer">Lihat Transaksi <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>

				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-gradient-primary">
						<div class="inner">
							<h3><?php echo $pending_transaction; ?></h3>

							<p>Transaksi Belum Selesai</p>
						</div>
						<div class="icon">
							<i class="fas fa-concierge-bell"></i>
						</div>
						<a href="<?php echo site_url('kasir/transactions'); ?>" class="small-box-footer">Lihat Transaksi <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>

				<div class="<?php echo strlen($total_payment)>6?'col-lg-4':'col-lg-3'; ?> col-6">
					<!-- small box -->
					<div class="small-box bg-gradient-warning">
						<div class="inner">
							<h3><?php echo 'Rp' . format_rupiah($total_payment); ?></h3>

							<p>Pembayaran Selesai</p>
						</div>
						<div class="icon">
							<i class="fas fa-money-bill-wave-alt"></i>
						</div>
						<a href="<?php echo site_url('kasir/transactions'); ?>" class="small-box-footer">Lihat Transaksi <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>

				</div>
			</div>

		</div>
	</section>
</div>
