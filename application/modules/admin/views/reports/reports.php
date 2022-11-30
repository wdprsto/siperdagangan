<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Header -->
<div class="header bg-transparent pb-6">
	<div class="container-fluid">
		<div class="header-body">
			<div class="row align-items-center py-4">
				<div class="col-lg-6 col-7">
					<h6 class="h2 d-inline-block mb-0">Kelola Laporan</h6>
				</div>
				<div class="col-lg-6 col-5 text-right">
					<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
						<ol class="breadcrumb breadcrumb-links">
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item active" aria-current="page">Laporan</li>
						</ol>
					</nav>
				</div>
			</div>


		</div>
	</div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
	<!-- DIAGRAM BATANG, DIAGRAM GARIS, DAN -->
	<div class="row">
		<div class="col-xl-6">
			<div class="card">
				<div class="card-header bg-transparent">
					<div class="row align-items-center">
						<div class="col">
							<h6 class="text-uppercase text-muted ls-1 mb-1">Ringkasan</h6>
							<h5 class="h3 mb-0">Grafik Omzet Penjualan</h5>
						</div>
					</div>
				</div>
				<div class="card-body">
					<!-- Chart -->
					<div class="chart">
						<canvas id="chart-bars" class="chart-canvas"></canvas>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-6">
			<div class="card">
				<div class="card-header bg-transparent">
					<div class="row align-items-center">
						<div class="col">
							<h6 class="text-uppercase text-muted ls-1 mb-1">Ringkasan</h6>
							<h5 class="h3 mb-0">Grafik Jumlah Penjualan</h5>
						</div>
					</div>
				</div>
				<div class="card-body">
					<!-- Chart -->
					<div class="chart">
						<!-- Chart wrapper -->
						<canvas id="chart-sales-dark" class="chart-canvas"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-12">
			<div class="card">
				<div class="card-header bg-transparent">
					<div class="row align-items-center">
						<div class="col">
							<h5 class="h3 mb-0">Cetak Laporan</h5>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="report-nav">
						<ul class="nav nav-pills nav-fill">
							<li class="nav-item">
								<a class="nav-link active btn-laporan-stok-barang" href="#/">Lap. Stok Barang</a>
							</li>
							<li class="nav-item">
								<a class="nav-link btn-laporan-harian" href="#/">Lap. Harian</a>
							</li>
							<li class="nav-item">
								<a class="nav-link btn-laporan-bulanan" href="#/">Lap. Bulanan</a>
							</li>
							<li class="nav-item">
								<a class="nav-link btn-laporan-tahunan" href="#/">Lap. Tahunan</a>
							</li>
							<li class="nav-item">
								<a class="nav-link btn-laporan-hasil-penjualan-kasir" href="#/">Lap. Kasir</a>
							</li>
							<li class="nav-item">
								<a class="nav-link btn-barang-terlaris-kurang-laris" href="#/">Barang Laris/Kurang Laris</a>
							</li>
						</ul>
					</div>

					<div class="laporan-stok-barang mb-2">
						<div class="row mt-4 border border-primary rounded p-4 mx-auto ">
							<label class="col-4 col-form-label form-control-label">Daftar Semua Barang</label>
							<div class="col-8 text-right">
								<button class="btn btn-icon btn-primary btn-cetak-daftar-semua-barang" type="button">
									<span class="btn-inner--icon"><i class="fas fa-print"></i></span>
									<span class="btn-inner--text">Cetak</span>
								</button>
							</div>
						</div>
						<div class="row mt-4 border border-primary rounded p-4 mx-auto">
							<label class="col-4 col-form-label form-control-label">Daftar Barang Menurut Kategori</label>
							<div class="col-4">
								<form action="<?php echo site_url('admin/reports/cetak_barang_menurut_kategori'); ?>" method="POST" target="_blank">
									<select name="kategori" class="form-control" id="kategori" required>
										<option value="" disabled selected>Pilih Kategori</option>
										<?php foreach ($data_kategori as $kategori) : ?>
											<option value="<?php echo $kategori->kat_id ?>"><?php echo $kategori->kat_nama ?></option>
										<?php endforeach; ?>
									</select>
							</div>
							<div class="col-4 text-right">
								<button class="btn btn-icon btn-primary btn-cetak-barang-menurut-kategori" type="submit">
									<span class="btn-inner--icon"><i class="fas fa-print"></i></span>
									<span class="btn-inner--text">Cetak</span>
								</button>
								</form>
							</div>
						</div>
					</div>

					<div class="laporan-harian mb-2  d-none">
						<div class="row mt-4 border rounded p-4 mx-auto">
							<label class="col-4 col-form-label form-control-label">Hari</label>
							<div class="col-8">
								<input type="date" class= "form-control" name="laphar-tanggal-input" id="laphar-tanggal-input" required placeholder="dd-mm-yyyy" >
							</div>
							<label class="col-12 mt-4 d-none text-info-laphar-butuh-tanggal"><span class="text-danger text-sm-left font-weight-bold" style="font-size:.875rem">*Pastikan tanggal telah terpilih sebelum anda mencetak laporan yang ada</span></label>
						</div>
						<div class="row mt-4 border border-primary rounded p-4 mx-auto ">
							<label class="col-4 col-form-label form-control-label">Laporan Harian</label>
							<div class="col-8 text-right">
								<form action="<?php echo site_url('admin/reports/cetak_laporan_harian'); ?>" method="POST" target="_blank">
									<input type="hidden" class="data-tanggal-laphar-hidden" name="data-tanggal-laphar-hidden">
									<button class="btn btn-icon btn-primary btn-cetak-laporan-harian btn-submit-laphar" type="submit">
										<span class="btn-inner--icon"><i class="fas fa-print"></i></span>
										<span class="btn-inner--text">Cetak</span>
									</button>
								</form>
							</div>
						</div>
						<div class="row mt-4 border border-primary rounded p-4 mx-auto ">
							<label class="col-4 col-form-label form-control-label">Rekapitulasi per Kategori</label>
							<div class="col-8 text-right">
								<form action="<?php echo site_url('admin/reports/cetak_rekapitulasi_per_kategori'); ?>" method="POST" target="_blank">
									<input type="hidden" class="data-tanggal-laphar-hidden" name="data-tanggal-laphar-hidden">
									<button class="btn btn-icon btn-primary btn-cetak-rekapitulasi-per-kategori btn-submit-laphar" type="submit">
										<span class="btn-inner--icon"><i class="fas fa-print"></i></span>
										<span class="btn-inner--text">Cetak</span>
									</button>
								</form>
							</div>
						</div>
						<div class="row mt-4 border border-primary rounded p-4 mx-auto ">
							<label class="col-4 col-form-label form-control-label">Rekapitulasi per Nota</label>
							<div class="col-8 text-right">
								<form action="<?php echo site_url('admin/reports/cetak_rekapitulasi_per_nota'); ?>" method="POST" target="_blank">
									<input type="hidden" class="data-tanggal-laphar-hidden" name="data-tanggal-laphar-hidden">
									<button class="btn btn-icon btn-primary btn-cetak-rekapitulasi-per-nota btn-submit-laphar" type="submit">
										<span class="btn-inner--icon"><i class="fas fa-print"></i></span>
										<span class="btn-inner--text">Cetak</span>
									</button>
								</form>
							</div>
						</div>
					</div>

					<div class="laporan-bulanan mb-2  d-none">
						<div class="row mt-4 border rounded p-4 mx-auto">
							<label class="col-4 col-form-label form-control-label">Tahun/Bulan</label>
							<div class="col-4">
								<select name="lapbul-tahun-input" class="form-control" id="lapbul-tahun-input" required="">
									<option value="" disabled selected>Tahun</option>
									<?php for ($i = 2021; $i <= date('Y'); $i++) { ?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									<?php }; ?>
								</select>
							</div>
							<div class="col-4">
								<select name="lapbul-bulan-input" class="form-control" id="lapbul-bulan-input" required="">
									<option value="" disabled selected>Bulan</option>
									<option value="1">Januari</option>
									<option value="2">Februari</option>
									<option value="3">Maret</option>
									<option value="4">April</option>
									<option value="5">Mei</option>
									<option value="6">Juni</option>
									<option value="7">Juli</option>
									<option value="8">Agustus</option>
									<option value="9">September</option>
									<option value="10">Oktober</option>
									<option value="11">November</option>
									<option value="12">Desember</option>
								</select>
							</div>
							<label class="col-12 mt-4 d-none text-info-lapbul-butuh-tanggal"><span class="text-danger text-sm-left font-weight-bold" style="font-size:.875rem">*Pastikan bulan dan tanggal telah terpilih sebelum anda mencetak laporan yang ada</span></label>
						</div>
						<div class="row mt-4 border border-primary rounded p-4 mx-auto ">
							<label class="col-4 col-form-label form-control-label">Laporan Bulanan</label>
							<div class="col-8 text-right">
								<form action="<?php echo site_url('admin/reports/cetak_laporan_bulanan'); ?>" method="POST" target="_blank">
									<input type="hidden" class="data-bulan-lapbul-hidden" name="data-bulan-lapbul-hidden">
									<input type="hidden" class="data-tahun-lapbul-hidden" name="data-tahun-lapbul-hidden">
									<button class="btn btn-icon btn-primary btn-cetak-laporan-bulanan btn-submit-lapbul" type="submit">
										<span class="btn-inner--icon"><i class="fas fa-print"></i></span>
										<span class="btn-inner--text">Cetak</span>
									</button>
								</form>
							</div>
						</div>
						<div class="row mt-4 border border-primary rounded p-4 mx-auto ">
							<label class="col-4 col-form-label form-control-label">Rekapitulasi per Tanggal</label>
							<div class="col-8 text-right">
								<form action="<?php echo site_url('admin/reports/cetak_rekapitulasi_per_tanggal'); ?>" method="POST" target="_blank">
									<input type="hidden" class="data-bulan-lapbul-hidden" name="data-bulan-lapbul-hidden">
									<input type="hidden" class="data-tahun-lapbul-hidden" name="data-tahun-lapbul-hidden">
									<button class="btn btn-icon btn-primary btn-cetak-rekapitulasi-per-tanggal btn-submit-lapbul" type="submit">
										<span class="btn-inner--icon"><i class="fas fa-print"></i></span>
										<span class="btn-inner--text">Cetak</span>
									</button>
								</form>
							</div>
						</div>
					</div>

					
					<div class="laporan-tahunan mb-2  d-none">
						<div class="row mt-4 border rounded p-4 mx-auto">
							<label class="col-4 col-form-label form-control-label">Tahun</label>
							<div class="col-4">
								<select name="laphun-tahun-input" class="form-control" id="laphun-tahun-input" required="">
									<option value="" disabled selected>Tahun</option>
									<?php for ($i = 2021; $i <= date('Y'); $i++) { ?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									<?php }; ?>
								</select>
							</div>
							<label class="col-12 mt-4 d-none text-info-laphun-butuh-tanggal"><span class="text-danger text-sm-left font-weight-bold" style="font-size:.875rem">*Pastikan bulan dan tanggal telah terpilih sebelum anda mencetak laporan yang ada</span></label>
						</div>
						<div class="row mt-4 border border-primary rounded p-4 mx-auto ">
							<label class="col-4 col-form-label form-control-label">Laporan Tahunan</label>
							<div class="col-8 text-right">
								<form action="<?php echo site_url('admin/reports/cetak_laporan_tahunan'); ?>" method="POST" target="_blank">
									<input type="hidden" class="data-tahun-laphun-hidden" name="data-tahun-laphun-hidden">
									<button class="btn btn-icon btn-primary btn-cetak-laporan-tahunan btn-submit-laphun" type="submit">
										<span class="btn-inner--icon"><i class="fas fa-print"></i></span>
										<span class="btn-inner--text">Cetak</span>
									</button>
								</form>
							</div>
						</div>
						<div class="row mt-4 border border-primary rounded p-4 mx-auto ">
							<label class="col-4 col-form-label form-control-label">Rekapitulasi per Bulan</label>
							<div class="col-8 text-right">
								<form action="<?php echo site_url('admin/reports/cetak_rekapitulasi_per_bulan'); ?>" method="POST" target="_blank">
									<input type="hidden" class="data-tahun-laphun-hidden" name="data-tahun-laphun-hidden">
									<button class="btn btn-icon btn-primary btn-cetak-rekapitulasi-per-bulan btn-submit-laphun" type="submit">
										<span class="btn-inner--icon"><i class="fas fa-print"></i></span>
										<span class="btn-inner--text">Cetak</span>
									</button>
								</form>
							</div>
						</div>
					</div>

					<div class="laporan-hasil-penjualan-kasir mb-2  d-none">
						<div class="row mt-4 border rounded p-4 mx-auto">
							<label class="col-4 col-form-label form-control-label">Hari</label>
							<div class="col-8">
								<input class="form-control" name="tanggal_laporan_kasir" type="date" id="tanggal_laporan_kasir" required="">
							</div>
							<label class="col-4 col-form-label form-control-label mt-4">Kasir</label>
							<div class="col-8  mt-4">
								<select name="kasir_laporan" class="form-control" id="kasir_laporan" required="">
									<option value="" disabled selected>Pilih Kasir</option>
									<?php foreach ($data_kasir as $kasir) : ?>
										<option value="<?php echo $kasir->ksr_id ?>"><?php echo $kasir->ksr_nama ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<label class="col-12 mt-4 d-none text-info-laporan-kasir"><span class="text-danger text-sm-left font-weight-bold" style="font-size:.875rem">*Pastikan tanggal/kasir telah terpilih sebelum anda mencetak laporan yang ada</span></label>
						</div>
						<div class="row mt-4 border border-primary rounded p-4 mx-auto">
							<label class="col-8 col-form-label form-control-label">Hasil Penjualan Detail</label>
							<div class="col-4 text-right">
							<form action="<?php echo site_url('admin/reports/cetak_hasil_penjualan_kasir_detail'); ?>" method="POST" target="_blank" >
								<input type="hidden" class="data-tanggal-lapsir-hidden" name="data-tanggal-lapsir-hidden">
								<input type="hidden" class="data-kasir-lapsir-hidden" name="data-kasir-lapsir-hidden">
								<button class="btn btn-icon btn-primary btn-submit-laporan-kasir" type="submit">
									<span class="btn-inner--icon"><i class="fas fa-print"></i></span>
									<span class="btn-inner--text">Cetak</span>
								</button>
							</form>
							</div>
						</div>
						<div class="row mt-4 border border-primary rounded p-4 mx-auto">
							<label class="col-8 col-form-label form-control-label">Rekap per Nota</label>
							<div class="col-4 text-right">
							<form action="<?php echo site_url('admin/reports/cetak_rekapitulasi_per_nota_kasir'); ?>" method="POST" target="_blank">
							<input type="hidden" class="data-tanggal-lapsir-hidden" name="data-tanggal-lapsir-hidden">
								<input type="hidden" class="data-kasir-lapsir-hidden" name="data-kasir-lapsir-hidden">
								<button class="btn btn-icon btn-primary btn-submit-laporan-kasir" type="submit">
									<span class="btn-inner--icon"><i class="fas fa-print"></i></span>
									<span class="btn-inner--text ">Cetak</span>
								</button>
							</form>
							</div>
						</div>
						<div class="row mt-4 border border-primary rounded p-4 mx-auto">
							<label class="col-8 col-form-label form-control-label">Rekap Jumlah Penjualan per Kasir</label>
							<div class="col-4 text-right">
							<form action="<?php echo site_url('admin/reports/cetak_rekapitulasi_per_kasir'); ?>" method="POST" target="_blank">
								<input type="hidden" class="data-tanggal-lapsir-hidden" name="data-tanggal-lapsir-hidden">
								<input type="hidden" class="data-kasir-lapsir-hidden" name="data-kasir-lapsir-hidden">
								<button class="btn btn-icon btn-primary btn-submit-laporan-kasir-pertanggal" type="submit">
									<span class="btn-inner--icon"><i class="fas fa-print"></i></span>
									<span class="btn-inner--text ">Cetak</span>
								</button>
							</form>
							</div>
						</div>
					</div>

					<div class="barang-terlaris-kurang-laris mb-2  d-none">
						<div class="row mt-4 border rounded p-4 mx-auto">
							<label class="col-4 col-form-label form-control-label">Tahun/Bulan</label>
							<div class="col-4">
								<select name="tahun-input" class="form-control" id="tahun-input" required="">
									<option value="" disabled selected>Tahun</option>
									<?php for ($i = 2021; $i <= date('Y'); $i++) { ?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									<?php }; ?>
								</select>
							</div>
							<div class="col-4">
								<select name="bulan-input" class="form-control" id="bulan-input" required="">
									<option value="" disabled selected>Bulan</option>
									<option value="1">Januari</option>
									<option value="2">Februari</option>
									<option value="3">Maret</option>
									<option value="4">April</option>
									<option value="5">Mei</option>
									<option value="6">Juni</option>
									<option value="7">Juli</option>
									<option value="8">Agustus</option>
									<option value="9">September</option>
									<option value="10">Oktober</option>
									<option value="11">November</option>
									<option value="12">Desember</option>
								</select>
							</div>
							<label class="col-12 mt-4 d-none text-info-butuh-tanggal"><span class="text-danger text-sm-left font-weight-bold" style="font-size:.875rem">*Pastikan bulan dan tanggal telah terpilih sebelum anda mencetak laporan yang ada</span></label>
						</div>
						<div class="row mt-4 border border-primary rounded p-4 mx-auto ">
							<label class="col-4 col-form-label form-control-label">Barang Terlaris</label>
							<div class="col-8 text-right">
								<form action="<?php echo site_url('admin/reports/cetak_barang_terlaris'); ?>" method="POST" target="_blank">
									<input type="hidden" class="data-bulan-hidden" name="data-bulan-hidden">
									<input type="hidden" class="data-tahun-hidden" name="data-tahun-hidden">
									<button class="btn btn-icon btn-primary btn-cetak-barang-terlaris btn-submit-laris" type="submit">
										<span class="btn-inner--icon"><i class="fas fa-print"></i></span>
										<span class="btn-inner--text">Cetak</span>
									</button>
								</form>
							</div>
						</div>
						<div class="row mt-4 border border-primary rounded p-4 mx-auto ">
							<label class="col-4 col-form-label form-control-label">Barang Kurang Laris</label>
							<div class="col-8 text-right">
								<form action="<?php echo site_url('admin/reports/cetak_barang_kurang_laris'); ?>" method="POST" target="_blank">
									<input type="hidden" class="data-bulan-hidden" name="data-bulan-hidden">
									<input type="hidden" class="data-tahun-hidden" name="data-tahun-hidden">
									<button class="btn btn-icon btn-primary btn-cetak-barang-kurang-laris btn-submit-laris" type="submit">
										<span class="btn-inner--icon"><i class="fas fa-print"></i></span>
										<span class="btn-inner--text">Cetak</span>
									</button>
								</form>
							</div>
						</div>
						<div class="row mt-4 border border-primary rounded p-4 mx-auto ">
							<label class="col-4 col-form-label form-control-label ">Tampilkan Semua</label>
							<div class="col-8 text-right">
								<form action="<?php echo site_url('admin/reports/cetak_tampilkan_semua'); ?>" method="POST" target="_blank">
									<input type="hidden" class="data-bulan-hidden" name="data-bulan-hidden">
									<input type="hidden" class="data-tahun-hidden" name="data-tahun-hidden">
									<button class="btn btn-icon btn-primary btn-cetak-tampilkan-semua btn-submit-laris" type="submit">
										<span class="btn-inner--icon"><i class="fas fa-print"></i></span>
										<span class="btn-inner--text">Cetak</span>
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- SCRIPT -->
	<script src="<?php echo get_theme_uri('vendor/chart.js/dist/Chart.min.js', 'argon'); ?>"></script>

	<!-- jquery -->
	<script>
		let btn1 = document.querySelector('.btn-laporan-stok-barang')
		let btn2 = document.querySelector('.btn-laporan-hasil-penjualan-kasir')
		let btn3 = document.querySelector('.btn-barang-terlaris-kurang-laris')
		let btn4 = document.querySelector('.btn-laporan-bulanan')
		let btn5 = document.querySelector('.btn-laporan-harian')
		let btn6 = document.querySelector('.btn-laporan-tahunan')

		let div1 = document.querySelector('.laporan-stok-barang')
		let div2 = document.querySelector('.laporan-hasil-penjualan-kasir')
		let div3 = document.querySelector('.barang-terlaris-kurang-laris')
		let div4 = document.querySelector('.laporan-bulanan')
		let div5 = document.querySelector('.laporan-harian')
		let div6 = document.querySelector('.laporan-tahunan')

		btn1.addEventListener('click', () => {
			btn1.classList.add('active')
			btn2.classList.remove('active')
			btn3.classList.remove('active')
			btn4.classList.remove('active')
			btn5.classList.remove('active')

			div1.classList.remove('d-none')
			div2.classList.add('d-none')
			div3.classList.add('d-none')
			div4.classList.add('d-none')
			div5.classList.add('d-none')

			btn6.classList.remove('active')
			div6.classList.add('d-none')
		})
		btn2.addEventListener('click', () => {
			btn2.classList.add('active')
			btn1.classList.remove('active')
			btn3.classList.remove('active')
			btn4.classList.remove('active')
			btn5.classList.remove('active')

			div2.classList.remove('d-none')
			div1.classList.add('d-none')
			div3.classList.add('d-none')
			div4.classList.add('d-none')
			div5.classList.add('d-none')

			btn6.classList.remove('active')
			div6.classList.add('d-none')
		})
		btn3.addEventListener('click', () => {
			btn3.classList.add('active')
			btn2.classList.remove('active')
			btn1.classList.remove('active')
			btn4.classList.remove('active')
			btn5.classList.remove('active')

			div3.classList.remove('d-none')
			div2.classList.add('d-none')
			div1.classList.add('d-none')
			div4.classList.add('d-none')
			div5.classList.add('d-none')

			btn6.classList.remove('active')
			div6.classList.add('d-none')
		})
		btn4.addEventListener('click', () => {
			btn4.classList.add('active')
			btn2.classList.remove('active')
			btn1.classList.remove('active')
			btn3.classList.remove('active')
			btn5.classList.remove('active')

			div4.classList.remove('d-none')
			div2.classList.add('d-none')
			div1.classList.add('d-none')
			div3.classList.add('d-none')
			div5.classList.add('d-none')

			btn6.classList.remove('active')
			div6.classList.add('d-none')
		})
		btn5.addEventListener('click', () => {
			btn5.classList.add('active')
			btn4.classList.remove('active')
			btn2.classList.remove('active')
			btn1.classList.remove('active')
			btn3.classList.remove('active')

			div5.classList.remove('d-none')
			div4.classList.add('d-none')
			div2.classList.add('d-none')
			div1.classList.add('d-none')
			div3.classList.add('d-none')

			btn6.classList.remove('active')
			div6.classList.add('d-none')
		})

		btn6.addEventListener('click', () => {
			btn6.classList.add('active')
			btn4.classList.remove('active')
			btn2.classList.remove('active')
			btn1.classList.remove('active')
			btn3.classList.remove('active')
			btn5.classList.remove('active')

			div6.classList.remove('d-none')
			div4.classList.add('d-none')
			div2.classList.add('d-none')
			div1.classList.add('d-none')
			div3.classList.add('d-none')
			div5.classList.add('d-none')
		})

		let cetak_semua_barang = document.querySelector('.btn-cetak-daftar-semua-barang');
		cetak_semua_barang.addEventListener('click', () => {
			window.open("<?php echo site_url('admin/reports/cetak_daftar_semua_barang'); ?>", '_blank');
		})


		$('document').ready(function(){
			$(document).on('input', '#tahun-input', (e)=>{
				$('.data-tahun-hidden').val($('#tahun-input').val())
			})
			$(document).on('input', '#bulan-input', (e)=>{
				$('.data-bulan-hidden').val($('#bulan-input').val())
			})


			$(document).on('click', '.btn-submit-laris', (e)=>{
				if($('#tahun-input').val() == null || $('#bulan-input').val() == null){
					e.preventDefault();
					$('.text-info-butuh-tanggal').removeClass('d-none')
				}
			})

			// LAPORAN TAHUNAN
			$(document).on('input', '#laphun-tahun-input', (e)=>{
				$('.data-tahun-laphun-hidden').val($('#laphun-tahun-input').val())
			})

			// LAPORAN BULANAN
			$(document).on('input', '#lapbul-tahun-input', (e)=>{
				$('.data-tahun-lapbul-hidden').val($('#lapbul-tahun-input').val())
			})
			$(document).on('input', '#lapbul-bulan-input', (e)=>{
				$('.data-bulan-lapbul-hidden').val($('#lapbul-bulan-input').val())
			})

			$(document).on('click', '.btn-submit-lapbul', (e)=>{
				if($('#lapbul-tahun-input').val() == null || $('#lapbul-bulan-input').val() == null){
					e.preventDefault();
					$('.text-info-lapbul-butuh-tanggal').removeClass('d-none')
				}
			})

			// LAPORAN HARIAN
			$(document).on('input', '#laphar-tanggal-input', (e)=>{
				$('.data-tanggal-laphar-hidden').val($('#laphar-tanggal-input').val())
			})
			$(document).on('click', '.btn-submit-laphar', (e)=>{
				if($('#laphar-tanggal-input').val() == ''){
					e.preventDefault();
					$('.text-info-laphar-butuh-tanggal').removeClass('d-none')
				}
			})

			
			$(document).on('input', '#tanggal_laporan_kasir', (e)=>{
				$('.data-tanggal-lapsir-hidden').val($('#tanggal_laporan_kasir').val())
			})
			$(document).on('input', '#kasir_laporan', (e)=>{
				$('.data-kasir-lapsir-hidden').val($('#kasir_laporan').val())
			})
			$(document).on('click', '.btn-submit-laporan-kasir', (e)=>{
				if($('#tanggal_laporan_kasir').val() == '' || $('#kasir_laporan').val() == null){
					e.preventDefault();
					$('.text-info-laporan-kasir').removeClass('d-none')
				}
			})
			$(document).on('click', '.btn-submit-laporan-kasir-pertanggal', (e)=>{
				if($('#tanggal_laporan_kasir').val() == ''){
					e.preventDefault();
					$('.text-info-laporan-kasir').removeClass('d-none')
				}
			})

		});

	</script>
	<!-- chart -->
	<script>
		//
		// Charts
		//

		'use strict';

		var Charts = (function() {

			// Variable

			var $toggle = $('[data-toggle="chart"]');
			var mode = 'light'; //(themeMode) ? themeMode : 'light';
			var fonts = {
				base: 'Open Sans'
			}

			// Colors
			var colors = {
				gray: {
					100: '#f6f9fc',
					200: '#e9ecef',
					300: '#dee2e6',
					400: '#ced4da',
					500: '#adb5bd',
					600: '#8898aa',
					700: '#525f7f',
					800: '#32325d',
					900: '#212529'
				},
				theme: {
					'default': '#14147a',
					'primary': '#4535b7',
					'secondary': '#f4f5f7',
					'info': '#11cdef',
					'success': '#2de8c4',
					'danger': '#f5365c',
					'warning': '#ffc410'
				},
				black: '#12263F',
				white: '#FFFFFF',
				transparent: 'transparent',
			};


			// Methods

			// Chart.js global options
			function chartOptions() {

				// Options
				var options = {
					defaults: {
						global: {
							responsive: true,
							maintainAspectRatio: false,
							defaultColor: (mode == 'dark') ? colors.gray[700] : colors.gray[600],
							defaultFontColor: (mode == 'dark') ? colors.gray[700] : colors.gray[600],
							defaultFontFamily: fonts.base,
							defaultFontSize: 13,
							layout: {
								padding: 0
							},
							legend: {
								display: false,
								position: 'bottom',
								labels: {
									usePointStyle: true,
									padding: 16
								}
							},
							elements: {
								point: {
									radius: 0,
									backgroundColor: colors.theme['primary']
								},
								line: {
									tension: .4,
									borderWidth: 4,
									borderColor: colors.theme['primary'],
									backgroundColor: colors.transparent,
									borderCapStyle: 'rounded'
								},
								rectangle: {
									backgroundColor: colors.theme['warning']
								},
								arc: {
									backgroundColor: colors.theme['primary'],
									borderColor: (mode == 'dark') ? colors.gray[800] : colors.white,
									borderWidth: 4
								}
							},
							tooltips: {
								enabled: true,
								mode: 'index',
								intersect: false,
							}
						},
						doughnut: {
							cutoutPercentage: 83,
							legendCallback: function(chart) {
								var data = chart.data;
								var content = '';

								data.labels.forEach(function(label, index) {
									var bgColor = data.datasets[0].backgroundColor[index];

									content += '<span class="chart-legend-item">';
									content += '<i class="chart-legend-indicator" style="background-color: ' + bgColor + '"></i>';
									content += label;
									content += '</span>';
								});

								return content;
							}
						}
					}
				}

				// yAxes
				Chart.scaleService.updateScaleDefaults('linear', {
					gridLines: {
						borderDash: [2],
						borderDashOffset: [2],
						color: (mode == 'dark') ? colors.gray[900] : colors.gray[300],
						drawBorder: false,
						drawTicks: false,
						drawOnChartArea: true,
						zeroLineWidth: 0,
						zeroLineColor: 'rgba(0,0,0,0)',
						zeroLineBorderDash: [2],
						zeroLineBorderDashOffset: [2]
					},
					ticks: {
						beginAtZero: true,
						padding: 10,
						callback: function(value) {
							if (!(value % 10)) {
								return value
							}
						}
					}
				});

				// xAxes
				Chart.scaleService.updateScaleDefaults('category', {
					gridLines: {
						drawBorder: false,
						drawOnChartArea: false,
						drawTicks: false
					},
					ticks: {
						padding: 20
					},
					maxBarThickness: 10
				});

				return options;

			}

			// Parse global options
			function parseOptions(parent, options) {
				for (var item in options) {
					if (typeof options[item] !== 'object') {
						parent[item] = options[item];
					} else {
						parseOptions(parent[item], options[item]);
					}
				}
			}

			// Push options
			function pushOptions(parent, options) {
				for (var item in options) {
					if (Array.isArray(options[item])) {
						options[item].forEach(function(data) {
							parent[item].push(data);
						});
					} else {
						pushOptions(parent[item], options[item]);
					}
				}
			}

			// Pop options
			function popOptions(parent, options) {
				for (var item in options) {
					if (Array.isArray(options[item])) {
						options[item].forEach(function(data) {
							parent[item].pop();
						});
					} else {
						popOptions(parent[item], options[item]);
					}
				}
			}

			// Toggle options
			function toggleOptions(elem) {
				var options = elem.data('add');
				var $target = $(elem.data('target'));
				var $chart = $target.data('chart');

				if (elem.is(':checked')) {

					// Add options
					pushOptions($chart, options);

					// Update chart
					$chart.update();
				} else {

					// Remove options
					popOptions($chart, options);

					// Update chart
					$chart.update();
				}
			}

			// Update options
			function updateOptions(elem) {
				var options = elem.data('update');
				var $target = $(elem.data('target'));
				var $chart = $target.data('chart');

				// Parse options
				parseOptions($chart, options);

				// Toggle ticks
				toggleTicks(elem, $chart);

				// Update chart
				$chart.update();
			}

			// Toggle ticks
			function toggleTicks(elem, $chart) {

				if (elem.data('prefix') !== undefined || elem.data('prefix') !== undefined) {
					var prefix = elem.data('prefix') ? elem.data('prefix') : '';
					var suffix = elem.data('suffix') ? elem.data('suffix') : '';

					// Update ticks
					$chart.options.scales.yAxes[0].ticks.callback = function(value) {
						if (!(value % 10)) {
							return prefix + value + suffix;
						}
					}

					// Update tooltips
					$chart.options.tooltips.callbacks.label = function(item, data) {
						var label = data.datasets[item.datasetIndex].label || '';
						var yLabel = item.yLabel;
						var content = '';

						if (data.datasets.length > 1) {
							content += '<span class="popover-body-label mr-auto">' + label + '</span>';
						}

						content += '<span class="popover-body-value">' + prefix + yLabel + suffix + '</span>';
						return content;
					}

				}
			}


			// Events

			// Parse global options
			if (window.Chart) {
				parseOptions(Chart, chartOptions());
			}

			// Toggle options
			$toggle.on({
				'change': function() {
					var $this = $(this);

					if ($this.is('[data-add]')) {
						toggleOptions($this);
					}
				},
				'click': function() {
					var $this = $(this);

					if ($this.is('[data-update]')) {
						updateOptions($this);
					}
				}
			});


			// Return

			return {
				colors: colors,
				fonts: fonts,
				mode: mode
			};

		})();

		'use strict';

		//
		// Bar chart
		//

		var BarsChart = (function() {

			//
			// Variables
			//

			var $chart2 = $('#chart-bars');


			//
			// Methods
			//

			// Init chart
			function initChart($chart) {

				// Create chart
				var posChart = new Chart($chart, {
					type: 'bar',
					data: {
						labels: [
							<?php foreach ($transaction_overview as $transaction) : ?> '<?php echo get_month($transaction->month); ?>',
							<?php endforeach; ?>
						],
						datasets: [{
							label: 'Penjualan (Rp)',
							data: [
								<?php foreach ($transaction_overview as $transaction) : ?> '<?php echo $transaction->income; ?>',
								<?php endforeach; ?>
							]
						}]
					}
				});

				// Save to jQuery object
				$chart.data('chart', posChart);
			}

			// Init chart
			if ($chart2.length) {
				initChart($chart2);
			}

		})();


		//
		// Sales chart
		//

		var SalesChart = (function() {

			// Variables

			var $chart1 = $('#chart-sales-dark');


			// Methods

			function init($this) {
				var salesChart = new Chart($this, {
					type: 'line',
					options: {
						scales: {
							yAxes: [{
								gridLines: {
									color: Charts.colors.gray[700],
									zeroLineColor: Charts.colors.gray[700]
								},
								ticks: {

								}
							}]
						}
					},
					data: {
						labels: [
							<?php foreach ($transaction_count as $transaction) : ?> '<?php echo get_month($transaction->month); ?>',
							<?php endforeach; ?>
						],
						datasets: [{
							label: 'Transaksi',
							data: [
								<?php foreach ($transaction_count as $transaction) : ?>
									<?php echo $transaction->sale; ?>,
								<?php endforeach; ?>
							]
						}]
					}
				});

				// Save to jQuery object

				$this.data('chart', salesChart);

			};


			// Events

			if ($chart1.length) {
				init($chart1);
			}

		})();
	</script>
