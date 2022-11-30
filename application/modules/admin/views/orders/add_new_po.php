<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Header -->
<div class="header bg-secondary pb-6">
	<div class="container-fluid">
		<div class="header-body">
			<div class="row align-items-center py-4">
				<div class="col-lg-6 col-7">
					<h6 class="h2 d-inline-block mb-0">Purchase Order Toko</h6>
					<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
						<ol class="breadcrumb breadcrumb-links ">
							<li class="breadcrumb-item"><a href="<?php echo site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item active" aria-current="page">Order</li>
						</ol>
					</nav>
				</div>
				<div class="col-lg-6 col-5 text-right">
					<a href="<?php echo site_url('admin/orders'); ?>" class="btn btn-sm btn-primary">Daftar Riwayat PO</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Page content -->

<div class="container-fluid mt--6">
	<div class="card">
		<div class="row">
			<div class="col-md-6">
				<div class="card-body">
					<form role="form" action="#" method="POST" id="addPoForm" enctype="multipart/form-data">
						<div class="form-group disabled row">
							<label for="nomor_po" class="col-md-4 col-form-label form-control-label">Nomor PO</label>
							<div class="col-md-8">
								<input class="form-control" name="nomor_po" type="number" id="nomor_po" required placeholder="Masukkan Nomor PO" value="<?php echo $last_id->po_id + 1 ?>">
								<input type="hidden" id="simpan_nomor_po" value="<?php echo $last_id->po_id + 1 ?>">
							</div>
						</div>
						<div class="form-group row-next-disabled row">
							<label for="tanggal_po" class="col-md-4 col-form-label form-control-label">Tanggal PO</label>
							<div class="col-md-8">
								<input class="form-control" name="tanggal_po" type="datetime-local" id="tanggal_po" required>
							</div>
						</div>
						<div class="form-group row pertama-buka">
							<div class="mx-auto">
								<button type="submit" name="submit" class="btn btn-primary my-2 addPoBtn ">Buat Dokumen PO</button>
							</div>
						</div>
						<span class="addPoInfo text-danger text-sm-left pertama-buka" style="font-size:.875rem">*Pastikan Nomor PO, Tanggal PO, dan Supplier sudah terisi sebelum membuat dokumen PO</span>
						<div class="form-group row kedua-buka">
							<div class="mx-auto">
								<button type="button" name="savePoBtn" class="btn btn-success my-2 savePoBtn">Simpan</button>
								<button type="button" name="cancelPoBtn" class="btn btn-danger my-2 cancelPoBtn ">Batalkan</button>
								<button type="button" name="printPoBtn" class="btn btn-info my-2 printPoBtn ">Cetak PO</button>
							</div>
						</div>
						<span class="addPoInfo text-info text-sm-left kedua-buka" style="font-size:.875rem"></br></br></span>

						<!-- END -->
				</div>
			</div>
			<!-- col md6 end -->
			<!-- col md6 start -->
			<div class="col-md-6">
				<div class="card-body">
					<div class="form-group row-next-disabled row">
						<label for="supplier" class="col-md-4 col-form-label form-control-label">Supplier</label>
						<div class="col-md-8">
							<select name="supplier" class="form-control" id="supplier" required oninvalid="this.setCustomValidity('Pilih Supplier terlebih dahulu')" oninput="this.setCustomValidity('')">
								<option value="" disabled selected>Pilih Supplier</option>
								<?php foreach ($suppliers as $supplier) : ?>
									<option value="<?php echo $supplier->sup_id ?>"><?php echo $supplier->sup_perusahaan ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="form-group row disabled">
						<label for="nomor_faktur" class="col-md-4 col-form-label form-control-label ">No. Faktur</label>
						<div class="col-md-8">
							<input class="form-control" name="nomor_faktur" type="text" id="nomor_faktur" placeholder="Masukkan Nomor Faktur">
						</div>
					</div>
					<div class="form-group row disabled">
						<label for="tanggal_faktur" class="col-md-4 col-form-label form-control-label">Tanggal Faktur</label>
						<div class="col-md-8">
							<input class="form-control" name="tanggal_faktur" type="date" id="tanggal_faktur">
						</div>
					</div>
					<div class="form-group row">
						<label for="jatuh_tempo" class="col-md-4 col-form-label form-control-label">Jatuh Tempo</label>
						<div class="col-md-8">
							<input class="form-control" name="jatuh_tempo" type="date" id="jatuh_tempo">
						</div>
						</form>
					</div>

					<!-- END -->

				</div>

			</div>
			<!-- col md6end -->
		</div>
	</div>

	<div class="row row-disabled disabled">
		<div class="col-md-8">
			<div class="card">
				<!-- Card header -->
				<div class="card-header border-0">
					<h3 class="mb-0">Pesanan PO</h3>
				</div>
				<div class="packageContainer">
					<!-- Light table -->
					<div class="table-responsive">
						<table class="table align-items-center table-flush" id="poProductList" style="width: 100%">
							<thead class="thead-light">
								<tr>
									<th scope="col"></th>
									<th scope="col">Kode</th>
									<th scope="col">Nama Barang</th>
									<th scope="col">Jumlah</th>
									<th scope="col">Harga Dasar</th>
									<th scope="col"></th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
				<div class="card-footer border-0">
					<input type="hidden" name="total-barang" class='total-barang' id='total-barang'>
					<h4 class="mb-0 float-right total-harga">Total PO: <span class="total-harga"></span></h4>
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

	<!-- MODAL TAMBAH BARANG -->
	<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true" style="display:none">
		<div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
			<div class="modal-content">
				<div class="modal-body p-0">
					<div class="card bg-secondary border-0 mb-0">
						<div class="card-header bg-transparent">
							<h3 class="card-heading text-center mt-2">Tambah Barang ke PO</h3>
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
															<span class="input-group-text"><i class="fas fa-list-ol fa-4"></i></span>
														</div>
														<input name="id" class="form-control add-id" placeholder="Id Barang" type="number" disabled>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group mb-3">
													<div class="input-group input-group-merge input-group-alternative">
														<div class="input-group-prepend">
															<span class="input-group-text"><i class="fas fa-cubes fa-4"></i></span>
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
															<span class="input-group-text"><i class="fas fa-dollar-sign fa-4"></i></span>
														</div>
														<input name="hargadasar" class="form-control add-hargadasar" placeholder="Harga Dasar Barang" type="text"  disabled>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group mb-3">
													<div class="input-group input-group-merge input-group-alternative">
														<div class="input-group-prepend">
															<span class="input-group-text"><i class="fas fa-money-bill-alt fa-4"></i></span>
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
											<span class="input-group-text"><i class="fas fa-plus-square fa-4"></i></span>
										</div>
										<input name="jumlah_pesanan" class="form-control add-jumlah jumlah_pesanan" placeholder="Jumlah barang yang dipesan" type="number" min="1" oninvalid="this.setCustomValidity('Jumlah barang dipesan harus lebih dari atau sama dengan 1')" oninput="this.setCustomValidity('')" required>
										<input type="hidden" name="idpo_pesanan" class="form-control idpo_pesanan">
										<input type="hidden" name="idbrg_pesanan" class="form-control idbrg_pesanan">
									</div>
									<div class="text-danger err jumlah_pesanan-error"></div>
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
					<div class="card bg-secondary border-0 mb-0">
						<div class="card-header bg-transparent">
							<h3 class="card-heading text-center mt-2">Ubah Jumlah Barang di PO</h3>
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
															<span class="input-group-text"><i class="fas fa-list-ol fa-4"></i></span>
														</div>
														<input name="edit-id" class="form-control edit-id" placeholder="Id Barang" type="number" disabled>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group mb-3">
													<div class="input-group input-group-merge input-group-alternative">
														<div class="input-group-prepend">
															<span class="input-group-text"><i class="fas fa-cubes fa-4"></i></span>
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
															<span class="input-group-text"><i class="fas fa-dollar-sign fa-4"></i></span>
														</div>
														<input name="edit-hargadasar" class="form-control edit-hargadasar" placeholder="Harga Dasar Barang" type="text" disabled>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group mb-3">
													<div class="input-group input-group-merge input-group-alternative">
														<div class="input-group-prepend">
															<span class="input-group-text"><i class="fas fa-money-bill-alt fa-4"></i></span>
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
											<span class="input-group-text"><i class="fas fa-plus-square fa-4"></i></span>
										</div>
										<input name="edit_jumlah_pesanan" class="form-control add-jumlah edit_jumlah_pesanan" placeholder="Jumlah barang yang dipesan" type="number" min="1" required oninvalid="this.setCustomValidity('Jumlah barang dipesan harus lebih dari atau sama dengan 1')" oninput="this.setCustomValidity('')">
										<input type="hidden" name="edit_idpo_pesanan" class="edit_idpo_pesanan">
										<input type="hidden" name="edit_idbrg_pesanan" class="edit_idbrg_pesanan">
									</div>
									<div class="text-danger err jumlah_pesanan-error"></div>
								</div>
								<div class="text-left">
									<button type="button" class="btn btn-secondary my-4" data-dismiss="modal">Batal</button>
								</div>
								<div class="float-right" style="margin-top: -90px">
									<button type="submit" class="btn btn-primary my-4 editProductBtn">Ubah Jumlah PO</button>
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
						<p>Barang yang anda tambahkan sudah ada di daftar barang PO.</p>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white btn-update-data-double">Update Jumlah Barang</button>
					<button type="button" class="btn btn-link text-white ml-auto btn-hapus-data-double" data-dismiss="modal">Hapus Barang dari PO</button>
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
					<input type="hidden" name="idpo" value="" class="deleteIdPo">

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
		function init() {
			//set tanggal po menjadi sekarang
			var now = new Date();
			now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
			document.getElementById('tanggal_po').value = now.toISOString().slice(0, 16);

			//set nilai jatuh tempo 3 bulan dari sekarang
			var nowplusthree = new Date();
			nowplusthree.setDate(nowplusthree.getDate() + 90);
			document.getElementById('jatuh_tempo').value = nowplusthree.toISOString().slice(0, 10);

			//sembunyikan 3 tombol sblm po dibuat
			$('.kedua-buka').hide();

		}

		init();
		// FUNGSI UNTUK MENAMPILKAN DETAIL TABLE
		function format_rp(x) {
			return "Rp" + x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		}

		function is_product_in_po(po_id, brg_id) {
			var is_unique;
			var id_barang = brg_id;
			var id_po = po_id;

			$.ajax({
				method: 'GET',
				url: '<?php echo site_url('admin/orders/api?action=check_unique'); ?>',
				data: {
					idpo_pesanan: id_po,
					idbrg_pesanan: id_barang
				},
				success: function(res) {
					is_unique = res.is_unique;

				}
			});
			return is_unique;
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

		//mengatur jumlah paginasi di tabel
		$.fn.DataTable.ext.pager.numbers_length = 5;

		$(document).ready(function() {

			//MENAMPILKAN DATA BARANG PADA TABEL
			var table = $('#productList').DataTable({
				"dom": 'Bfrt',
				"select": true,
				// scrollabel
				"scrollY": "305.5px", //"286.8px"
				"scrollX": "100%", //"286.8px"
				"scrollCollapse": true,
				"paging": false,
				//end scrollable
				"ajax": "<?php echo site_url('admin/products/product_api?action=list'); ?>",
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


			//menampilkan data dari baris terplih ke tabel
			// var events = $('#events'); //untuk testing apakah data yang diambil benar/tidak
			var tdata, old_tdata, temp;
			table.on('click', function() {


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
						$('.idpo_pesanan').val($('#nomor_po').val());


						//buka modal add kategori
						$('#addModal').modal('show');

					}

				}, 0);
			});

			//MENAMPILKAN DATA BARANG PO
			var table2 = $('#poProductList').DataTable({
				"columns": [{
						"className": 'details-control',
						"orderable": false,
						"data": null,
						"defaultContent": ''
					},
					{
						"data": "brg_id"
					},
					{
						"data": "brg_nama"
					},
					{
						"mRender": function(data, type, row) {
							return row.beli_jumlahbrg + ' ' + row.brg_satuan;
						}
					},
					{
						"mRender": function(data, type, row) {
							return format_rp(row.brg_hargadasar);
						}
					},
					{
						"mRender": function(data, type, row) {
							return '<div class="text-right"><a href="#/" data-idbrg="' + row.brg_id + '" data-idpo="' + row.beli_idpo + '" class="btn btn-warning btn-sm btnEdit"><i class="fa fa-edit"></i></a><a href="#/" data-idbrg="' + row.brg_id + '"  data-idpo="' + row.beli_idpo + '" class="btn btn-danger btn-sm btnDelete"><i class="fa fa-trash"></i></a></div>';
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
			$('#poProductList tbody').on('click', 'td.details-control', function() {
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

			//MENAMBAH PO BARU
			$('#addPoForm').submit(function(e) {
				e.preventDefault();

				//data diidapat dari penggunaan atribut "name" pada html. nanti bisa dipanggil di modal
				var data = $(this).serialize();
				var btn = $('.addPoBtn');
				var id_po = $('#nomor_po').val();
				btn.html('<i class="fa fa-spin fa-spinner"></i> Menambah Dokumen PO...').attr('disabled', true);;
				$('.err').empty();
				$.ajax({
					method: 'POST',
					url: '<?php echo site_url('admin/orders/api?action=add_po'); ?>',
					data: data,
					context: this,
					success: function(res) {
						if (res.code == 201) {
							btn.html('<i class="fa fa-check"></i> Berhasil!').removeAttr('disabled');

							setTimeout(function() {
								$('#addProductForm .form-control').val(null);
								btn.html('Buat Dokumen PO');

								//aktifkan bagian tambah barang
								$('.row-disabled').removeClass("disabled");

								//nonaktifkan bagian input tertentu
								$('.row-next-disabled').addClass("disabled");

								//sembunyikan tombol sebelumnya, tampilkan 3 tombol baru
								$('.pertama-buka').hide();
								$('.total-harga').text("Total PO: Rp0");

								//scroll ke bagian paling bawah
								window.scrollTo(0, document.body.scrollHeight);
								// $('#productList').scrollIntoView()

							}, 1000);
							setTimeout(function() {
								$('.kedua-buka').show();
							}, 1000);

							table2.ajax.url("<?php echo site_url('admin/orders/api?action=list_po_products&nomor_po='); ?>" + id_po).load();

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

			//MENYIMPAN PO
			$(document).on('click', '.savePoBtn', function() {
				var btn = $('.savePoBtn');
				var id_po = $('#nomor_po').val();
				var no_fak = $('#nomor_faktur').val();
				var tgl_fak = $('#tanggal_faktur').val();
				var jatuh_tempo = $('#jatuh_tempo').val();

				var total_barang = $('#total-barang').val();

				btn.html('<i class="fa fa-spin fa-spinner"></i> Menyimpan PO...').attr('disabled', true);;
				if (total_barang > 0) {
					$.ajax({
						method: 'POST',
						url: '<?php echo site_url('admin/orders/api?action=save_po'); ?>',
						data: {
							id_po: id_po,
							no_fak: no_fak,
							tgl_fak: tgl_fak,
							jatuh_tempo: jatuh_tempo
						},
						success: function(res) {
							if (res.code == 201) {
								btn.html('<i class="fa fa-check"></i> Berhasil').removeAttr('disabled');

								setTimeout(function() {
									btn.html('Simpan');
									window.location = '<?php echo site_url('admin/orders/'); ?>';
								}, 1000);
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

			//MEMBATALKAN PO
			$(document).on('click', '.cancelPoBtn', function() {
				//data diidapat dari penggunaan atribut "name" pada html. nanti bisa dipanggil di modal
				var btn = $('.cancelPoBtn');
				var id_po = $('#nomor_po').val();
				btn.html('<i class="fa fa-spin fa-spinner"></i> Membatalkan PO...').attr('disabled', true);

				$.ajax({
					method: 'POST',
					url: '<?php echo site_url('admin/orders/api?action=delete_po'); ?>',
					data: {
						id_po: id_po
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


								//sembunyikan 3 tombol, menyesuaikan dengan tanggal/jam/menit saat ini
								init();

								//tampilkan tombol awal (buat PO)
								$('.pertama-buka').show();
							}, 1000);

							table2.ajax.reload();
							//set total harga seperti semula
							$('.total-harga').text("Total PO:");
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
				var id_po = $('#nomor_po').val();

				btn.html('<i class="fa fa-spin fa-spinner"></i> Menambah...').attr('disabled', true);
				$('.err').empty();

				$.ajax({
					method: 'POST',
					url: '<?php echo site_url('admin/orders/api?action=add_product'); ?>',
					data: data,
					context: this,
					success: function(res) {
						if (res.data) {
							btn.html('<i class="fa fa-check"></i> Berhasil!').removeAttr('disabled');

							//result . nama di controller['nama'] . nama kolom di model
							// alert(res.total_po.total_harga)
							$('.total-harga').text("Total PO: " + format_rp(res.total_po.total_harga));
							$('.total-barang').val(res.total_po.total_barang);

							setTimeout(function() {
								$('#addProductForm .form-control').val(null);
								// hapus id barang dari input hidden
								$('.idbrg_pesanan').val(null);

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
			})

			$(document).on('click', '.btn-update-data-double', function(e) {
				btn_update_double = $('.btn-update-data-double');
				e.preventDefault();

				//Get Data
				var id_po = $('.idpo_pesanan').val();
				var id_brg = $('.idbrg_pesanan').val();
				var jumlah_pesanan = $('.jumlah_pesanan').val();

				//UPDATE STOK DOUBLE
				btn_update_double = $('.btn-update-data-double');

				btn_update_double.html('<i class="fa fa-spin fa-spinner"></i> Menambah...');
				$.ajax({
					method: 'POST',
					url: '<?php echo site_url('admin/orders/api?action=edit_product_quantity'); ?>',
					//data ini mengacu pada res.data yang ada di from modal & data yang telah di ppanggil di proses di atas
					data: {
						idbrg_pesanan: id_brg,
						idpo_pesanan: id_po,
						jumlah_pesanan: jumlah_pesanan
					},
					success: function(res) {
						if (res.code == 201) {
							btn_update_double.html('<i class="fa fa-check"></i> Berhasil').removeAttr('disabled');

							setTimeout(() => {
								$('#modal-notification-doubled').modal('hide');
								table2.ajax.reload();
								btn_update_double.html('Update Jumlah Barang');
							}, 1500);

							$('.total-harga').text("Total PO: " + format_rp(res.total_po.total_harga));
							$('.total-barang').val(res.total_po.total_barang);
						}
					}

				});

				// hapus id barang dari input hidden
				$('.idbrg_pesanan').val(null);
				$('#addProductForm .form-control').val(null);

			});

			$(document).on('click', '.btn-hapus-data-double', function(e) {
				e.preventDefault();

				//Get Data
				var id_po = $('.idpo_pesanan').val();
				var id_brg = $('.idbrg_pesanan').val();


				//DELETE DATA YANG MAU DITAMBAH
				btn_hapus_double = $('.btn-hapus-data-double');

				btn_hapus_double.html('<i class="fa fa-spin fa-spinner"></i> Menghapus...');
				$.ajax({
					method: 'POST',
					url: '<?php echo site_url('admin/orders/api?action=delete_product'); ?>',
					data: {
						idbrg_pesanan: id_brg,
						idpo_pesanan: id_po,
					},
					success: function(res) {
						if (res.code == 204) {
							btn_hapus_double.html('<i class="fa fa-check"></i> Berhasil Dihapus').removeAttr('disabled');
							table2.ajax.reload();

							//saat ponya menjadi kosong, harus ditangai agar tidak error karena null
							total_harga = res.total_po.total_harga
							total_harga = total_harga == null ? 0 : total_harga;
							$('.total-harga').text("Total PO: " + format_rp(total_harga));
							$('.total-barang').val(res.total_po.total_barang);

							setTimeout(() => {
								$('#modal-notification-doubled').modal('hide');
								btn_hapus_double.html('Hapus Barang dari PO');
							}, 1500);
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {}
				})

				// hapus id barang dari input hidden
				$('.idbrg_pesanan').val(null);
				$('#addProductForm .form-control').val(null);

			});



			//BUKA MODAL EDIT BARANG,
			$(document).on('click', '.btnEdit', function() {
				//data('id') didapat dari deklarasi "data-id" pada pembuatan datatables, tepatnya di bagian "mRender". disana ada atribut data-id=row.kat_id. kita ambil nilai id dari tabel dari database
				var idbrg = $(this).data('idbrg');
				var idpo = $(this).data('idpo');

				$.ajax({
					method: 'GET',
					url: '<?php echo site_url('admin/orders/api?action=view_product'); ?>',
					data: {
						idbrg: idbrg,
						idpo: idpo
					},
					success: function(res) {
						if (res.data) {
							var d = res.data;
							$('.edit-id').val(d.brg_id);
							$('.edit-stok').val(d.brg_stok + ' ' + d.brg_satuan);
							$('.edit-namabarang').val(d.brg_nama);
							$('.edit-hargadasar').val(format_rp(d.brg_hargadasar));
							$('.edit-hargajual').val(format_rp(d.brg_hargajual));
							$('.edit_jumlah_pesanan').val(d.beli_jumlahbrg);
							$('.edit_idpo_pesanan').val(idpo);
							$('.edit_idbrg_pesanan').val(idbrg);

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
				btn.html('<i class="fa fa-spin fa-spinner"></i> Menyimpan...').attr('disabled', true);

				$.ajax({
					method: 'POST',
					url: '<?php echo site_url('admin/orders/api?action=edit_product'); ?>',
					//data ini mengacu pada res.data yang ada di from modal & data yang telah di ppanggil di proses di atas
					data: data,
					success: function(res) {
						if (res.code == 201) {
							btn.html('<i class="fa fa-check"></i> Tersimpan!').removeAttr('disabled');
							$('.total-harga').text("Total PO: " + format_rp(res.total_po.total_harga));

							setTimeout(() => {
								$('#editModal').modal('hide');
								table2.ajax.reload();
								btn.html('Ubah Jumlah PO');
							}, 1500);
						}
					}
				})
			});

			//MENGAHAPUS BARANG
			$(document).on('click', '.btnDelete', function() {
				var idbrg = $(this).data('idbrg');
				var idpo = $(this).data('idpo');

				$('.deleteIdBrg').val(idbrg);
				$('.deleteIdPo').val(idpo);
				$('#deleteModal').modal('show');
			});

			$('#deleteProduct').submit(function(e) {
				e.preventDefault();

				var idbrg = $('.deleteIdBrg').val();
				var idpo = $('.deleteIdPo').val();
				var btn = $('.btn-delete');

				btn.html('<i class="fa fa-spin fa-spinner"></i> Menghapus...').attr('disabled', true);;

				$.ajax({
					method: 'POST',
					url: '<?php echo site_url('admin/orders/api?action=delete_product'); ?>',
					data: {
						idbrg_pesanan: idbrg,
						idpo_pesanan: idpo
					},
					success: function(res) {
						if (res.code == 204) {
							btn.html('<i class="fa fa-check"></i> Terhapus!').removeAttr('disabled');

							table2.ajax.reload();

							//saat ponya menjadi kosong, harus ditangai agar tidak error karena null
							total_harga = res.total_po.total_harga
							total_harga = total_harga == null ? 0 : total_harga;
							$('.total-harga').text("Total PO: " + format_rp(total_harga));
							$('.total-barang').val(res.total_po.total_barang);

							setTimeout(() => {
								$('#deleteModal').modal('hide');
								btn.html('Hapus');
							}, 1500);
						}
					}
				})

			});



			// //select2
			// $('#kategori').select2({
			// 	placeholder: "Pilih kategori barang",
			// 	theme: 'bootstrap4',
			// 	scrollAfterSelect: 'true',
			// });


			// KEYPRESSED
			// $(document).keydown(function(e) {

			// 	//ALT+Enter, buat dokumen po
			// 	if (e.which == 13 && e.altKey) {
			// 		$('.addPoBtn').click();
			// 	}
			// });

			//cetak nota
			$('.printPoBtn').on('click', function() {
				var id_po = $('#nomor_po').val();
				window.open("<?php echo site_url('admin/orders/cetak_po/'); ?>" + id_po, '_blank', 'resizable=yes');


			});

		});
	</script>
