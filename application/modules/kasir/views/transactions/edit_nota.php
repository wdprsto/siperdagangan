<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="content-wrapper">
	<!-- Header -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h6 class="h3 d-inline-block mb-0">Kelola Nota Transaksi</h6>
					<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
						<ol class="breadcrumb breadcrumb-links ">
							<li class="breadcrumb-item"><?php echo anchor(base_url(), 'Home'); ?></li>
							<li class="breadcrumb-item active">Transaksi</li>
						</ol>
					</nav>
				</div>
				<div class="col-sm-6 text-right">
					<a href="<?php echo site_url('kasir/transactions'); ?>" class="btn btn-sm btn-inline btn-primary" tabindex='1'>Riwayat Nota</a>

				</div>
			</div>
		</div>
	</section>
	<!-- Page content -->
	<section class="content">
		<div class="container-fluid mt--6">
			<div class="card">
				<div class="row">
					<div class="col-md-6">
						<div class="card-body">
							<form role="form" action="#" method="POST" id="addNotaForm" enctype="multipart/form-data">
								<div class="form-group row-next-disabled row div_nomor_nota">
									<label for="nomor_nota" class="col-md-4 col-form-label form-control-label">Nomor Nota</label>
									<div class="col-md-8">
										<input class="form-control" name="nomor_nota" type="number" id="nomor_nota" required placeholder="Masukkan Nomor PO" value="<?php echo $nota_id ?>">
										<input type="hidden" id="simpan_nomor_nota" value="<?php echo $nota_id ?>">
									</div>
								</div>
								<div class="form-group row-next-disabled row div_tanggal_nota">
									<label for="tanggal_nota" class="col-md-4 col-form-label form-control-label">Tanggal Nota</label>
									<div class="col-md-8">
										<input class="form-control" name="tanggal_nota" type="datetime-local" id="tanggal_nota" required>
									</div>
								</div>
								<div class="form-group row pertama-buka">
									<div class="mx-auto">
										<button type="button" name="saveNotaBtn" class="btn btn-success my-2 saveNotaBtn  mx-2">Simpan</button>
										<button type="button" name="deleteNotaBtn" class="btn btn-danger my-2 deleteNotaBtn  mr-2">Hapus</button>
										<!-- <button type="button" name="printNotaBtn" class="btn btn-info my-2 printNotaBtn mr-2 ">Cetak Nota</button> -->
										<div class="btn-group">
											<button class="btn btn-info dropdown-toggle printNotaDiv" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												Cetak Nota
											</button>
											<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 48px, 0px); top: 0px; left: 0px; will-change: transform;">
												<a class="dropdown-item printNotaBtn" href="#/">A4</a>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item printNotaBtn80" href="#">80mm</a>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row kedua-buka">
									<div class="mx-auto">
										<button type="button" name="printNotaBtn2" class="btn btn-info my-2 printNotaBtn2 mr-2 ">Cetak Nota</button>
									</div>
								</div>


								<!-- END -->
						</div>
					</div>
					<!-- col md6 end -->
					<!-- col md6 start -->
					<div class="col-md-6">
						<div class="card-body">
							<div class="form-group row row-disabled">
								<label for="nama_pembeli" class="col-md-4 col-form-label form-control-label ">Nama Pembeli</label>
								<div class="col-md-8">
									<input class="form-control" name="nama_pembeli" type="text" id="nama_pembeli" placeholder="Masukkan Nama Pembeli">
								</div>
							</div>
							<div class="form-group row row-disabled">
								<label for="no_plat" class="col-md-4 col-form-label form-control-label">No. Plat</label>
								<div class="col-md-8">
									<input class="form-control" name="no_plat" type="text" id="no_plat" placeholder="Masukkan Nomor Plat">
								</div>
							</div>
							</form>


							<!-- END -->

						</div>

					</div>
					<!-- col md6end -->
				</div>
			</div>

			<div class="row row-disabled ">
				<div class="col-md-8">
					<div class="card">
						<!-- Card header -->
						<div class="card-header border-0">
							<h3 class="mb-0">Barang Nota</h3>
						</div>
						<div class="packageContainer">
							<!-- Light table -->
							<div class="table-responsive">
								<table class="table align-items-center table-flush" id="notaProductList" style="width: 100%">
									<thead class="thead-light">
										<tr>
											<th scope="col"></th>
											<th scope="col">Kode</th>
											<th scope="col">Nama Barang</th>
											<th scope="col">Jumlah</th>
											<th scope="col">Harga Jual</th>
											<th scope="col">Diskon</th>
											<th scope="col"></th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
						<div class="card-footer border-0">
							<input type="hidden" name="total-barang" class='total-barang' id='total-barang'>
							<h4 class="mb-0 float-right total-harga">Total: <span class="total-harga"></span></h4>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card">
						<!-- Card header -->
						<div class="card-header border-0">
							<h3 class="mb-0">Barang</h3>
						</div>
						<div class="productContainer">
							<!-- <div class="col-lg-6 mx-auto" id="events">

							</div> -->
							<div class="table-responsive">
								<table class="table align-items-center table-flush" id="productList" style="width: 100%">
									<thead class="thead-light">
										<tr>
											<th scope="col">ID</th>
											<th scope="col">Nama Barang</th>
											<th scope="col">Stok</th>
											<th scope="col">Kategori</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>

					</div>
				</div>
			</div>
	</section>

</div>

<!-- MODAL TAMBAH BARANG -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true" style="display:none">
	<div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
		<div class="modal-content">
			<div class="modal-body p-0">
				<div class="card bg-white border-0 mb-0">
					<div class="card-header bg-transparent">
						<h3 class="card-heading text-center mt-2">Tambah Barang ke Nota</h3>
					</div>
					<div class="card-body px-lg-5 py-lg-5">
						<form role="form" action="#" method="POST" id="addProductForm">

							<div class="card bg-gradient-primary border-0 text-center mb-4">
								<div class="card-body">
									<div class='row'>
										<div class="col-md-6">
											<div class="form-group mb-3">
												<div class="input-group input-group-merge input-group-alternative">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="ni ni-box-2"></i></span>
													</div>
													<input name="id" class="form-control add-id" placeholder="Id Barang" type="number" disabled>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group mb-3">
												<div class="input-group input-group-merge input-group-alternative">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="ni ni-box-2"></i></span>
													</div>
													<input name="stok" class="form-control add-stok" placeholder="Stok Barang" type="text" disabled>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group mb-3">
										<div class="input-group input-group-merge input-group-alternative">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="ni ni-box-2"></i></span>
											</div>
											<input name="nama" class="form-control add-namabarang" placeholder="Nama Barang" type="text" disabled>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group mb-3">
												<div class="input-group input-group-merge input-group-alternative">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="ni ni-box-2"></i></span>
													</div>
													<input name="hargadasar" class="form-control add-hargadasar" placeholder="Harga Dasar Barang" type="text" disabled>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group mb-3">
												<div class="input-group input-group-merge input-group-alternative">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="ni ni-box-2"></i></span>
													</div>
													<input name="hargajual" class="form-control add-hargajual" placeholder="Harga Jual Barang" type="text" disabled>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>


							<div class="form-group mb-3">
								<div class="input-group input-group-merge input-group-alternative input-data-barang">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="ni ni-box-2"></i></span>
									</div>
									<input name="jumlah_pesanan" class="form-control add-jumlah jumlah_pesanan" placeholder="Jumlah barang yang dipesan" type="number" min="1" required oninvalid="this.setCustomValidity('Jumlah barang dibutuhkan, minimal 1')" oninput="this.setCustomValidity('')" value="1">
									<input type="hidden" name="idnota_pesanan" class="form-control idnota_pesanan">
									<input type="hidden" name="idbrg_pesanan" class="form-control idbrg_pesanan">
								</div>
								<div class="text-danger err jumlah_pesanan-error"></div>
							</div>
							<div class="form-group mb-3">
								<div class="input-group input-group-merge input-group-alternative input-data-barang">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="ni ni-box-2"></i></span>
									</div>
									<input name="diskon_pesanan" class="form-control add-diskon diskon_pesanan" placeholder="Besaran diskon (jika ada)" type="number" min="0" value="0">
								</div>
								<div class="text-danger err diskon_pesanan-error"></div>
							</div>
							<div class="text-left">
								<button type="button" class="btn btn-secondary my-4" data-dismiss="modal">Batal</button>
							</div>
							<div class="float-right" style="margin-top: -90px">
								<button type="submit" class="btn btn-primary my-4 addProductBtn">Tambah</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- MODAL EDIT BARANG -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true" style="display:none">
	<div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
		<div class="modal-content">
			<div class="modal-body p-0">
				<div class="card bg-white border-0 mb-0">
					<div class="card-header bg-transparent">
						<h3 class="card-heading text-center mt-2">Ubah Jumlah Barang di Nota</h3>
					</div>
					<div class="card-body px-lg-5 py-lg-5">
						<form role="form" action="#" method="POST" id="editProductForm">

							<div class="card bg-gradient-primary border-0 text-center mb-4">
								<div class="card-body">
									<div class='row'>
										<div class="col-md-6">
											<div class="form-group mb-3">
												<div class="input-group input-group-merge input-group-alternative">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="ni ni-box-2"></i></span>
													</div>
													<input name="edit-id" class="form-control edit-id" placeholder="Id Barang" type="number" disabled>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group mb-3">
												<div class="input-group input-group-merge input-group-alternative">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="ni ni-box-2"></i></span>
													</div>
													<input name="edit-stok" class="form-control edit-stok" placeholder="Stok Barang" type="text" disabled>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group mb-3">
										<div class="input-group input-group-merge input-group-alternative">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="ni ni-box-2"></i></span>
											</div>
											<input name="edit-namabarang" class="form-control edit-namabarang" placeholder="Nama Barang" type="text" disabled>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group mb-3">
												<div class="input-group input-group-merge input-group-alternative">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="ni ni-box-2"></i></span>
													</div>
													<input name="edit-hargadasar" class="form-control edit-hargadasar" placeholder="Harga Dasar Barang" type="text" disabled>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group mb-3">
												<div class="input-group input-group-merge input-group-alternative">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="ni ni-box-2"></i></span>
													</div>
													<input name="edit-hargajual" class="form-control edit-hargajual" placeholder="Harga Jual Barang" type="text" disabled>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="form-group mb-3">
								<div class="input-group input-group-merge input-group-alternative input-data-barang">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="ni ni-box-2"></i></span>
									</div>
									<input name="edit_jumlah_pesanan" class="form-control add-jumlah edit_jumlah_pesanan" placeholder="Jumlah barang yang dipesan" type="number" min="1" required oninvalid="this.setCustomValidity('Jumlah barang dibutuhkan, minimal 1')" oninput="this.setCustomValidity('')">
									<input type="hidden" name="edit_idnota_pesanan" class="edit_idnota_pesanan">
									<input type="hidden" name="edit_idbrg_pesanan" class="edit_idbrg_pesanan">
								</div>
								<div class="text-danger err edit_jumlah_pesanan-error"></div>
							</div>
							<div class="form-group mb-3">
								<div class="input-group input-group-merge input-group-alternative input-data-barang">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="ni ni-box-2"></i></span>
									</div>
									<input name="edit_diskon_pesanan" class="form-control add-diskon edit_diskon_pesanan" placeholder="Diskon yang diberikan" type="number" min="0">
								</div>
								<div class="text-danger err edit_diskon_pesanan-error"></div>
							</div>
							<div class="text-left">
								<button type="button" class="btn btn-secondary my-4" data-dismiss="modal">Batal</button>
							</div>
							<div class="float-right" style="margin-top: -90px">
								<button type="submit" class="btn btn-primary my-4 editProductBtn">Ubah Jumlah Nota</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- MODAL NOTIF BARANG SUDAH ADA  -->
<div class="modal fade" id="modal-notification-doubled" tabindex="-1" role="dialog" aria-labelledby="modal-notification-doubled" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
		<div class="modal-content bg-gradient-danger">
			<div class="modal-header">
				<h6 class="modal-title" id="modal-title-notification">Perhatian</h6>
			</div>
			<div class="modal-body">
				<div class="py-3 text-center">
					<i class="ni ni-bell-55 ni-3x"></i>
					<h4 class="heading mt-4">Barang Sudah Ada!</h4>
					<p>Barang yang anda tambahkan sudah ada di daftar barang Nota.</p>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-white btn-update-data-double">Update Jumlah Barang</button>
				<button type="button" class="btn btn-link text-white ml-auto btn-hapus-data-double" data-dismiss="modal">Hapus Barang dari Nota</button>
			</div>
		</div>
	</div>
</div>


<!-- MODAL NOTIF BARANG BELUM ADA  -->
<div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
		<div class="modal-content bg-gradient-danger">
			<div class="modal-header">
				<h6 class="modal-title" id="modal-title-notification">Perhatian</h6>
				</button>
			</div>
			<div class="modal-body">
				<div class="py-3 text-center">
					<i class="ni ni-bell-55 ni-3x"></i>
					<h4 class="heading mt-4">Barang Belum Dipilih!</h4>
					<p>Untuk menambah barang, pilih barang dari tabel bantuan yang ada di bagian kiri.</p>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- MODAL HAPUS BARANG -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
	<div class="modal-dialog modal-modal-dialog-centered modal-" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="modal-title-default">Hapus Barang</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form action="#" id="deleteProduct" method="POST">

				<input type="hidden" name="idbrg" value="" class="deleteIdBrg">
				<input type="hidden" name="idnota" value="" class="deleteIdNota">

				<div class="modal-body">
					<p>Yakin ingin menghapus? Tindakan ini tidak dapat dibatalkan.</p>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-danger btn-delete">Hapus</button>
					<button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Batal</button>
				</div>
			</form>
		</div>
	</div>
</div>

<link href="<?php echo get_theme_uri('vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css', 'argon'); ?>" rel="stylesheet">

<script src="<?php echo get_theme_uri('vendor/datatables.net/js/jquery.dataTables.min.js', 'argon'); ?>"></script>
<script src="<?php echo get_theme_uri('vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js', 'argon'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables.lang.js'); ?>"></script>


<!-- Script untuk select datatables -->
<script src="<?php echo get_theme_uri('vendor/datatables.net-select/js/dataTables.select.min.js', 'argon'); ?>"></script>
<script src="<?php echo get_theme_uri('vendor/datatables.net-select-bs4/js/select.bootstrap4.min.js', 'argon'); ?>"></script>
<link href="<?php echo get_theme_uri('vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css', 'argon'); ?>" rel="stylesheet">

<script>
	//INISIALISASI NILAI AWAL

	// FUNGSI UNTUK MENAMPILKAN DETAIL TABLE
	function format_rp(x) {
		return "Rp" + x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
	}

	function format(d) {
		// `d` is the original data object for the row
		// var x = d.brg_hargadasar; //bisa juga ngedeklarasiin variabel sebelum di return

		var output = '<table width="100%" style="border-radius:45px; border:1px solid #ccc;">' +
			'<tr>' +
			'<td style="font-weight:bold">Harga Dasar:</td>' +
			'<td>' + format_rp(d.brg_hargadasar) + '</td>' +
			'</tr>' +
			'<tr>' +
			'<td style="font-weight:bold">Harga Jual:</td>' +
			'<td>' + format_rp(d.brg_hargajual) + '</td>' +
			'</tr>' +
			'</table>';

		return output;
	}

	function check_konflik_stok() {
		let konflik_stok = document.querySelectorAll('.konflik_stok');
		let array_status_konflik = [];
		for (item of konflik_stok) {
			array_status_konflik.push(item.value)
		}

		return array_status_konflik.includes("true");
	}

	//mengatur jumlah paginasi di tabel
	$.fn.DataTable.ext.pager.numbers_length = 5;

	$(document).ready(function() {
		//inisisasi id nota, total harga, dan total barang
		var id_nota = $('#nomor_nota').val();
		var total_harga_nota = "<?php echo $total_nota->total_harga ?>";
		total_harga_nota = total_harga_nota == null ? 0 : total_harga_nota;
		$('.total-harga').text("Total: " + format_rp(total_harga_nota));
		$('.total-barang').val(<?php echo $total_nota->total_barang ?>);

		//inisiasi data po
		$('.div_nomor_nota').addClass("disabled");
		$.ajax({
			method: 'GET',
			url: '<?php echo site_url('kasir/transactions/api?action=view_data_nota'); ?>',
			data: {
				id_nota: id_nota
			},
			success: function(res) {
				if (res.data) {
					var d = res.data;
					if (d.nota_status == 'selesai') {
						$('.kedua-buka').show();
						$('.pertama-buka').remove();
						$('.div_tanggal_nota').addClass("disabled");
						$('.row-disabled').addClass("disabled");
					} else {
						$('.kedua-buka').remove();
						$('.pertama-buka').show();
					}

					var tanggal_nota = new Date(d.nota_tgl);
					tanggal_nota.setMinutes(tanggal_nota.getMinutes() - tanggal_nota.getTimezoneOffset());

					$('#tanggal_nota').val(tanggal_nota.toISOString().slice(0, 16));
					$('#nama_pembeli').val(d.nota_pembeli);

					$('#no_plat').val(d.nota_plat);
				}
			}
		});

		//MENAMPILKAN DATA BARANG PADA TABEL
		var table = $('#productList').DataTable({
			// "dom": 'Bfrt',
			"dom": "<'row'<'col-sm-12 pr-4'f>>" +
				"<'row'<'col-sm-12'tr>>",
			"select": true,
			// scrollabel
			"scrollY": "305.5px", //"286.8px"
			"scrollX": "100%", //"286.8px"
			"scrollCollapse": true,
			"paging": false,
			//end scrollable
			"ajax": "<?php echo site_url('kasir/transactions/product_api?action=list'); ?>",
			"columns": [{
					"data": "brg_id"
				},
				{
					"data": "brg_nama"
				},
				{
					"mRender": function(data, type, row) {
						return row.brg_stok + ' ' + row.brg_satuan;
					}
				},
				{
					"data": "kat_nama"
				}
				//nama variabel yang digunakan adalah nama yang tertera di bagian "data", atau sama dengan nama kolom di tabel. Untuk ambil data per baris, tambah kata "row"
			],
			//indeks kolom dimulai dari 0
			"order": [
				[0, 'asc']
			],
			"language": {
				"search": "Cari:",
				"lengthMenu": "Menampilkan _MENU_ data",
				"info": "Menampilkan _START_ sampai _END_ data dari _TOTAL_ data",
				"infoEmpty": "Tidak ada data yang ditampilkan",
				"infoFiltered": "(dari total _MAX_ data)",
				"zeroRecords": "Tidak ada hasil pencarian ditemukan",
			},
		});


		// menampilkan data dari baris terplih ke tabel
		// var events = $('#events'); //untuk testing apakah data yang diambil benar/tidak
		var tdata, old_tdata, temp;
		table.on('click', function() {
			$('.jumlah_pesanan').focus();
			setTimeout(() => {
				tdata = table.rows({
					selected: true
				}).data()[0];

				if (old_tdata == tdata) {
					return false;
				} else if (tdata) {
					//di modal add item, id-kat secara otomatis terisi dengan x angka id kategori + y angka id terakhir dari kategori tsb di dalam database. selain itu, kategorinya juga scr otomatis terpilih
					$('.add-id').val(tdata['brg_id']);
					$('.add-hargadasar').val(format_rp(tdata['brg_hargadasar']));
					$('.add-hargajual').val(format_rp(tdata['brg_hargajual']));
					$('.add-namabarang').val(tdata['brg_nama']);
					$('.add-stok').val(tdata['brg_stok'] + ' ' + tdata['brg_satuan']);



					//menetapkan nilai ke hidden value yang digunakan untuk insert data barang po
					$('.idbrg_pesanan').val(tdata['brg_id']);
					$('.idnota_pesanan').val($('#nomor_nota').val());


					//buka modal add kategori
					$('#addModal').modal('show');

				}

			}, 0);
		});



		//MENAMPILKAN DATA BARANG PO
		var table2 = $('#notaProductList').DataTable({
			"ajax": "<?php echo site_url('kasir/transactions/api?action=list_nota_products&nomor_nota='); ?>" + id_nota,
			"dom": "<'row'<'col-sm-3 pl-4'l><'col-sm-3'B><'col-sm-6 pr-md-4'f>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-5 pl-4'i><'col-sm-7 pr-4 mb-2'p>>",
			"columns": [{
					"className": 'p-4 details-control mr-2',
					"orderable": false,
					"data": null,
					"defaultContent": ''
				},
				{
					"data": "brg_id"
				},
				{
					"mRender": function(data, type, row) {
						var status = '';

						if (row.brg_stok <= 0) {
							$('.saveNotaBtn').hide()
							$('.printNotaDiv').hide()
							status = '</br><span class="badge badge-danger">Tidak Tersedia</span>' +
								'<input type="hidden" class="konflik_stok" value="true">'
						} else if (row.brg_stok - row.jual_jumlahbrg < 0) {

							$('.saveNotaBtn').hide()
							$('.printNotaDiv').hide()
							status = '</br><span class="badge badge-danger">Tidak Mencukupi</span>' +
								'<input type="hidden" class="konflik_stok" value="true">'

						} else {
							status = '<input type="hidden" class="konflik_stok" value="false">'
						}
						return row.brg_nama + status
					}
				},
				{
					"mRender": function(data, type, row) {
						return row.jual_jumlahbrg + ' ' + row.brg_satuan;
					}
				},
				{
					"mRender": function(data, type, row) {
						return format_rp(row.brg_hargajual);
					}
				},
				{
					"mRender": function(data, type, row) {
						return format_rp(row.jual_diskon);
					}
				},
				{
					"mRender": function(data, type, row) {
						if (row.brg_stok <= 0) {
							return '<div class="text-right"><a href="#/" data-idbrg="' + row.brg_id + '"  data-idnota="' + row.jual_idnota + '" class="btn btn-danger btn-sm btnDelete mr-2 mb-2" style="max-width:2rem"><i class="fa fa-trash"></i></a></div>';
						} else {
							return '<div class="text-right"><a href="#/" data-idbrg="' + row.brg_id + '" data-idnota="' + row.jual_idnota + '" class="btn btn-warning btn-sm btnEdit mr-2 mb-2" style="max-width:2rem"><i class="fa fa-edit" style="color:white"></i></a><a href="#/" data-idbrg="' + row.brg_id + '"  data-idnota="' + row.jual_idnota + '" class="btn btn-danger btn-sm btnDelete mr-2 mb-2" style="max-width:2rem"><i class="fa fa-trash"></i></a></div>';
						}
					}
				}
				//nama variabel yang digunakan adalah nama yang tertera di bagian "data", atau sama dengan nama kolom di tabel. Untuk ambil data per baris, tambah kata "row"
			],
			//limitasi tampilan
			"lengthMenu": [5, 10, 25, 50, 100],
			"pageLength": 5,
			"pagingType": "simple_numbers",
			//indeks kolom dimulai dari 0
			"order": [
				[1, 'asc']
			],
			"language": {
				"search": "Cari:",
				"lengthMenu": "Menampilkan _MENU_ data",
				"info": "Menampilkan _START_ sampai _END_ data dari _TOTAL_ data",
				"infoEmpty": "Tidak ada data yang ditampilkan",
				"infoFiltered": "(dari total _MAX_ data)",
				"zeroRecords": "Tidak ada hasil pencarian ditemukan",
			},
			"language": {
				"search": "Cari:",
				"lengthMenu": "Menampilkan _MENU_ data",
				"info": "Menampilkan _START_ sampai _END_ data dari _TOTAL_ data",
				"infoEmpty": "Tidak ada data yang ditampilkan",
				"infoFiltered": "(dari total _MAX_ data)",
				"zeroRecords": "Tidak ada hasil pencarian ditemukan",
				"paginate": {
					"first": "&laquo;",
					"last": "&raquo;",
					"next": "&rsaquo;",
					"previous": "&lsaquo;"
				}
			}
		});


		// Add event listener for opening and closing details
		$('#notaProductList tbody').on('click', 'td.details-control', function() {
			var tr = $(this).closest('tr');
			var row = table2.row(tr);

			if (row.child.isShown()) {
				// This row is already open - close it
				row.child.hide();
				tr.removeClass('shown');
			} else {
				// Open this row
				row.child(format(row.data())).show();
				tr.addClass('shown');
			}
		});


		//MENGHAPUS NOTA
		$(document).on('click', '.deleteNotaBtn', function() {
			//data diidapat dari penggunaan atribut "name" pada html. nanti bisa dipanggil di modal
			var btn = $('.deleteNotaBtn');
			var id_nota = $('#nomor_nota').val();
			btn.html('<i class="fa fa-spin fa-spinner"></i> Menghapus Nota...').attr('disabled', true);

			$.ajax({
				method: 'POST',
				url: '<?php echo site_url('kasir/transactions/api?action=delete_nota'); ?>',
				data: {
					id_nota: id_nota
				},
				context: this,
				success: function(res) {
					if (res.code == '204') {
						btn.html('<i class="fa fa-check"></i> Berhasil!').removeAttr('disabled');

						setTimeout(function() {
							btn.html('Batalkan');

							//nonaktifkan bagian tambah barang
							$('.row-disabled').addClass("disabled");

							//aktifkan bagian input tertentu
							$('.row-next-disabled').removeClass("disabled");

							window.location = '<?php echo site_url('kasir/transactions/'); ?>';
						}, 1000);

						table2.ajax.reload();
						//set total harga seperti semula
						$('.total-harga').text("Total:");
						$('.total-barang').val(0);

					} else if (res.code == 409) {

						if (res.id_error) {
							$('.id-error').append(res.id_error);
						}

						//KALAU MAU MENGHAPUS SEMUA DATA YANG ADA DI FORM
						// $('#addProductForm .form-control').val(null);
						btn.html('Tambah Error');

					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					btn.html('Tambah Error 2x');

					var errors = xhr.responseJSON.errors;

					$.each(errors, function(keys, val) {
						$.each(val, function(key, val) {
							$('.' + keys + '-error').text(val);
						});
					});
				}
			})
		})

		//MENAMBAH BARANG BARU
		$('#addProductForm').submit(function(e) {
			e.preventDefault();

			var data = $(this).serialize();
			var btn = $('.addProductBtn');

			var jumlah_stok = parseInt($('.add-stok').val().replace(/[^0-9]/g, ''), 10);
			var jumlah_pesanan = parseInt($('.jumlah_pesanan').val(), 10);
			var cek_stok = jumlah_stok >= jumlah_pesanan;

			var nilai_diskon = parseInt($('.diskon_pesanan').val(), 10);
			if (isNaN(nilai_diskon)) {
				nilai_diskon = 0;
			}
			var diskon_maks = parseInt($('.jumlah_pesanan').val() * $('.add-hargajual').val().replace(/[^0-9]/g, ''), 10);
			var cek_diskon = nilai_diskon <= diskon_maks;

			var cek_kondisi = (cek_stok) && (cek_diskon);

			if (cek_kondisi) {
				btn.html('<i class="fa fa-spin fa-spinner"></i> Menambah...').attr('disabled', true);
				$('.err').empty();

				$.ajax({
					method: 'POST',
					url: '<?php echo site_url('kasir/transactions/api?action=add_product'); ?>',
					data: data,
					context: this,
					success: function(res) {
						if (res.code == 201) {
							btn.html('<i class="fa fa-check"></i> Berhasil!').removeAttr('disabled');

							//result . nama di controller['nama'] . nama kolom di model
							// alert(res.total_nota.total_harga)
							$('.total-harga').text("Total: " + format_rp(res.total_nota.total_harga));
							$('.total-barang').val(res.total_nota.total_barang);

							setTimeout(function() {
								$('#addProductForm .form-control').val(null);
								// hapus id barang dari input hidden
								$('.idbrg_pesanan').val(null);
								// namun id nota tetap harus dipertahankan
								$('.idnota_pesanan').val($('#nomor_nota').val());
								//set nilai diskon jadi 0 lagi
								$('.diskon_pesanan').val(0);

								btn.html('Tambah');
							}, 2000);
							setTimeout(() => {
								$('#addModal').modal('hide');
							}, 2222);

							table.rows().deselect();
							table2.ajax.reload();

						}
						//DISINI KALAU KITA MENCOBA MENGISI FORM KOSONG LEWAT CONSOLE
						else if (res.code == 409) {

							//KALAU MAU MENGHAPUS SEMUA DATA YANG ADA DI FORM
							// $('#addProductForm .form-control').val(null);
							btn.html('Tambah').removeAttr('disabled');
							$('#modal-notification').modal('show');
							$('#addModal').modal('hide');

						}
						//DISINI MENGATASI DOUBLE DATA
						else if (res.code == 500) {

							// btn.html('Tambah').removeAttr('disabled');
							// $('#modal-notification').modal('show');
							// $('#addModal').modal('hide');

							$('#addModal').modal('hide');
							btn.html('Tambah').removeAttr('disabled');
							$('#modal-notification-doubled').modal('show');

							table.rows().deselect();
						}
					},
					error: function(xhr, ajaxOptions, thrownError, res) {
						//ERROR INI BISA TERJADI KALAU FORM VALIDATIONNYA GAGAL
						//PADA KASUS, KITA INGIN DATA ID PO + ID BRG UNIK. ARTINYA KALAU ADO BARANG YANG SAMA, MAKA DAK BISA DITAMBAHKAN LAGI
						//nilai xhr.status = 500, internal server error atau 200 kalau validasi gagal karena dobel;
						// alert(xhr.status)
						btn.html('Tambah Error');

					}
				})
			} else {
				if (!cek_stok) {
					$('.jumlah_pesanan-error').text('Jumlah pesanan melebihi stok!')
				}
				if (!cek_diskon) {
					$('.diskon_pesanan-error').text('Diskon melewati batas!')
				}
			}

		})

		// Add event listener untuk nilai maks diskon
		$(document).on('change', '.jumlah_pesanan', function() {
			$(".jumlah_pesanan-error").text('');
		});
		$(document).on('change', '.diskon_pesanan', function() {
			$(".diskon_pesanan-error").text('');
		});

		//UPDATE DOUBLED
		$(document).on('click', '.btn-update-data-double', function(e) {
			btn_update_double = $('.btn-update-data-double');
			e.preventDefault();

			//Get Data
			var id_nota = $('.idnota_pesanan').val();
			var id_brg = $('.idbrg_pesanan').val();
			var jumlah_pesanan = $('.jumlah_pesanan').val();
			var diskon_pesanan = $('.diskon_pesanan').val();

			//UPDATE STOK DOUBLE
			btn_update_double = $('.btn-update-data-double');

			btn_update_double.html('<i class="fa fa-spin fa-spinner"></i> Menambah...');

			$.ajax({
				method: 'POST',
				url: '<?php echo site_url('kasir/transactions/api?action=edit_product_quantity'); ?>',
				//data ini mengacu pada res.data yang ada di from modal & data yang telah di ppanggil di proses di atas
				data: {
					idbrg_pesanan: id_brg,
					idnota_pesanan: id_nota,
					jumlah_pesanan: jumlah_pesanan,
					diskon_pesanan: diskon_pesanan
				},
				success: function(res) {
					if (res.code == 201) {
						btn_update_double.html('<i class="fa fa-check"></i> Berhasil').removeAttr('disabled');

						setTimeout(() => {
							$('#modal-notification-doubled').modal('hide');
							table2.ajax.reload();
							btn_update_double.html('Update Jumlah Barang');
						}, 1500);

						$('.total-harga').text("Total: " + format_rp(res.total_nota.total_harga));
						$('.total-barang').val(res.total_nota.total_barang);
					} else if (res.code == 409) {
						btn_update_double.html('<i class="fa fa-times"></i> Gagal').removeAttr('disabled');

						setTimeout(() => {
							$('#modal-notification-doubled').modal('hide');
							table2.ajax.reload();
							btn_update_double.html('Update Jumlah Barang');

							Swal.fire({
								type: 'warning',
								title: 'Jumlah barang melebihi stok!',
								text: 'Barang yang anda tambahkan sudah ada dan apabila di-update akan melebihi stok yang tersedia.',
							})

						}, 1500);

					}
				}

			});

			// hapus id barang dari input hidden
			$('.idbrg_pesanan').val(null);
			$('#addProductForm .form-control').val(null);
			// namun id nota tetap harus dipertahankan
			$('.idnota_pesanan').val($('#nomor_nota').val());
		});

		//DELETE DOUBLED
		$(document).on('click', '.btn-hapus-data-double', function(e) {
			e.preventDefault();

			//Get Data
			var id_nota = $('.idnota_pesanan').val();
			var id_brg = $('.idbrg_pesanan').val();


			//DELETE DATA YANG MAU DITAMBAH
			btn_hapus_double = $('.btn-hapus-data-double');

			btn_hapus_double.html('<i class="fa fa-spin fa-spinner"></i> Menghapus...');
			$.ajax({
				method: 'POST',
				url: '<?php echo site_url('kasir/transactions/api?action=delete_product'); ?>',
				data: {
					idbrg_pesanan: id_brg,
					idnota_pesanan: id_nota,
				},
				success: function(res) {
					if (res.code == 204) {
						btn_hapus_double.html('<i class="fa fa-check"></i> Berhasil Dihapus').removeAttr('disabled');
						table2.ajax.reload();

						//saat ponya menjadi kosong, harus ditangai agar tidak error karena null
						total_harga = res.total_nota.total_harga
						total_harga = total_harga == null ? 0 : total_harga;
						$('.total-harga').text("Total: " + format_rp(total_harga));
						$('.total-barang').val(res.total_nota.total_barang);

						setTimeout(() => {
							$('#modal-notification-doubled').modal('hide');
							btn_hapus_double.html('Hapus Barang dari Nota');
						}, 1500);
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {}
			})

			// hapus id barang dari input hidden
			$('.idbrg_pesanan').val(null);
			$('#addProductForm .form-control').val(null);
			// namun id nota tetap harus dipertahankan
			$('.idnota_pesanan').val($('#nomor_nota').val());
		});

		//BUKA MODAL EDIT BARANG,
		$(document).on('click', '.btnEdit', function() {
			//data('id') didapat dari deklarasi "data-id" pada pembuatan datatables, tepatnya di bagian "mRender". disana ada atribut data-id=row.kat_id. kita ambil nilai id dari tabel dari database
			var idbrg = $(this).data('idbrg');
			var idnota = $(this).data('idnota');

			$.ajax({
				method: 'GET',
				url: '<?php echo site_url('kasir/transactions/api?action=view_product'); ?>',
				data: {
					idbrg: idbrg,
					idnota: idnota
				},
				success: function(res) {
					if (res.data) {
						var d = res.data;
						$('.edit-id').val(d.brg_id);
						$('.edit-stok').val(d.brg_stok + ' ' + d.brg_satuan);
						$('.edit-namabarang').val(d.brg_nama);
						$('.edit-hargadasar').val(format_rp(d.brg_hargadasar));
						$('.edit-hargajual').val(format_rp(d.brg_hargajual));
						$('.edit_idnota_pesanan').val(idnota);
						$('.edit_idbrg_pesanan').val(idbrg);
						$('.edit_jumlah_pesanan').val(d.jual_jumlahbrg);
						$('.edit_diskon_pesanan').val(d.jual_diskon);



						$('#editModal').modal('show');
					}
				}
			});
		});


		//MENGEDIT BARANG
		$('#editProductForm').submit(function(e) {
			e.preventDefault();

			var btn = $('.editProductBtn');
			var data = $(this).serialize();

			var jumlah_stok = parseInt($('.edit-stok').val().replace(/[^0-9]/g, ''), 10);
			var jumlah_pesanan = parseInt($('.edit_jumlah_pesanan').val(), 10);
			var cek_stok = jumlah_stok >= jumlah_pesanan;

			var nilai_diskon = parseInt($('.edit_diskon_pesanan').val(), 10);
			if (isNaN(nilai_diskon)) {
				nilai_diskon = 0;
			}
			var diskon_maks = parseInt($('.edit_jumlah_pesanan').val() * $('.edit-hargajual').val().replace(/[^0-9]/g, ''), 10);
			var cek_diskon = nilai_diskon <= diskon_maks;

			var cek_kondisi = (cek_stok) && (cek_diskon);

			if (cek_kondisi) {
				btn.html('<i class="fa fa-spin fa-spinner"></i> Menyimpan...').attr('disabled', true);
				$.ajax({
					method: 'POST',
					url: '<?php echo site_url('kasir/transactions/api?action=edit_product'); ?>',
					//data ini mengacu pada res.data yang ada di from modal & data yang telah di ppanggil di proses di atas
					data: data,
					success: function(res) {
						if (res.code == 201) {
							btn.html('<i class="fa fa-check"></i> Tersimpan!').removeAttr('disabled');
							$('.total-harga').text("Total: " + format_rp(res.total_nota.total_harga));

							setTimeout(() => {
								$('#editModal').modal('hide');
								table2.ajax.reload();
								btn.html('Ubah Jumlah Nota');
							}, 1500);
						}
					}
				})
			} else {
				if (!cek_stok) {
					$('.edit_jumlah_pesanan-error').text('Jumlah pesanan melebihi stok!')
				}
				if (!cek_diskon) {
					$('.edit_diskon_pesanan-error').text('Diskon melewati batas!')
				}
			}
		});


		$(document).on('change', '.edit_jumlah_pesanan', function() {
			$(".edit_jumlah_pesanan-error").text('');
		});
		$(document).on('change', '.edit_diskon_pesanan', function() {
			$(".edit_diskon_pesanan-error").text('');
		});


		//MENGAHAPUS BARANG
		$(document).on('click', '.btnDelete', function() {
			var idbrg = $(this).data('idbrg');
			var idnota = $(this).data('idnota');

			$('.deleteIdBrg').val(idbrg);
			$('.deleteIdNota').val(idnota);
			$('#deleteModal').modal('show');
		});

		$('#deleteProduct').submit(function(e) {
			e.preventDefault();

			var idbrg = $('.deleteIdBrg').val();
			var idnota = $('.deleteIdNota').val();
			var btn = $('.btn-delete');

			btn.html('<i class="fa fa-spin fa-spinner"></i> Menghapus...').attr('disabled', true);;

			$.ajax({
				method: 'POST',
				url: '<?php echo site_url('kasir/transactions/api?action=delete_product'); ?>',
				data: {
					idbrg_pesanan: idbrg,
					idnota_pesanan: idnota
				},
				success: function(res) {
					if (res.code == 204) {
						btn.html('<i class="fa fa-check"></i> Terhapus!').removeAttr('disabled');

						table2.ajax.reload();
						//saat notanya menjadi kosong, harus ditangai agar tidak error karena null
						total_harga = res.total_nota.total_harga
						total_harga = total_harga == null ? 0 : total_harga;
						$('.total-harga').text("Total: " + format_rp(total_harga));
						$('.total-barang').val(res.total_nota.total_barang);

						setTimeout(() => {
							$('#deleteModal').modal('hide');
							btn.html('Hapus');
							if (!check_konflik_stok()) {
								$('.saveNotaBtn').show()
								$('.printNotaDiv').show()
							}
						}, 1500);
					}
				}
			})

		});


		//MENYIMPAN NOTA
		$(document).on('click', '.saveNotaBtn', function() {
			var btn = $('.saveNotaBtn');
			var id_nota = $('#nomor_nota').val();
			var tgl_nota = $('#tanggal_nota').val();
			var nama_pembeli = $('#nama_pembeli').val();
			var no_plat = $('#no_plat').val();

			var total_barang = $('#total-barang').val();
			// alert(id_nota+' '+tgl_nota+' '+nama_pembeli+' '+ no_plat+' '+total_barang)
			btn.html('<i class="fa fa-spin fa-spinner"></i> Menyimpan Nota...').attr('disabled', true);;
			if (total_barang > 0) {
				$.ajax({
					method: 'POST',
					url: '<?php echo site_url('kasir/transactions/api?action=save_nota'); ?>',
					data: {
						id_nota: id_nota,
						tgl_nota: tgl_nota,
						nama_pembeli: nama_pembeli,
						no_plat: no_plat
					},
					success: function(res) {
						// alert(res.code)
						if (res.code == 201) {
							btn.html('<i class="fa fa-check"></i> Berhasil').removeAttr('disabled');

							setTimeout(function() {
								btn.html('Simpan');
								// window.location ='<?php //echo site_url('kasir/transactions/'); 
																			?>';
								$('.deleteNotaBtn').remove();
								$('.saveNotaBtn').remove();

								$('.row-disabled').addClass("disabled");
								$('.row-next-disabled').addClass("disabled");
								table.ajax.reload();
							}, 1000);
						} else if (res.code == 409) {

						}
					}
				})
			} else {
				$('#modal-notification').modal('show');
				btn.html('<i class="fa fa-times"></i> Gagal').removeAttr('disabled');
				setTimeout(function() {
					btn.html('Simpan');
				}, 1000);
			}


		});


		// KEYPRESSED
		// $(document).keydown(function(e) {

		// 	//ALT+Enter, buat dokumen po
		// 	if (e.which == 13 && e.altKey) {
		// 		$('.addPoBtn').click();
		// 	}
		// });

		//cetak nota
		$('.printNotaBtn').on('click', function() {
			var id_nota = $('#nomor_nota').val();
			window.open("<?php echo site_url('kasir/transactions/cetak_nota/'); ?>" + id_nota, '_blank', 'resizable=yes');


		});
		$('.printNotaBtn80').on('click', function() {
			var id_nota = $('#nomor_nota').val();
			window.open("<?php echo site_url('kasir/transactions/cetak_nota_80/'); ?>" + id_nota, '_blank', 'resizable=yes');


		});
		$('.printNotaBtn2').on('click', function() {
			var id_nota = $('#nomor_nota').val();
			window.open("<?php echo site_url('kasir/transactions/cetak_nota/'); ?>" + id_nota, '_blank', 'resizable=yes');
		});

	});
</script>
