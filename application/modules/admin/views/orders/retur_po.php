<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Header -->
<div class="header bg-secondary pb-6">
	<div class="container-fluid">
		<div class="header-body">
			<div class="row align-items-center py-4">
				<div class="col-lg-6 col-7">
					<h6 class="h2 d-inline-block mb-0">Barang Pasca Retur PO</h6>
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

	<input class="form-control" name="nomor_po" type="hidden" id="nomor_po" value="<?php echo $po_id ?>">
	<input type="hidden" id="simpan_nomor_po" value="<?php echo $po_id ?>">

	<div class="row ">
		<div class="col-md-8">
			<div class="card">
				<!-- Card header -->
				<div class="card-header border-0">
					<h3 class="mb-0">Pesanan PO <?php echo $po_id ?></h3>
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
					<a class="btn btn-sm btn-inline btn-info printPoBtn" tabindex='1' style='cursor:pointer'>Cetak Nota</a>
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
				<div class="card-header border-0 mt--4">
					<!-- //OPSI PENGUBAH -->
					<select name="barangbarang" class="form-control select2" id="barangbarang">
					</select>
				</div>
				<div class="card-header border-0 mt--4">
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
														<input name="id" class="form-control add-id" placeholder="Id Barang" type="number" minlength="4" maxlength="100" disabled>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group mb-3">
													<div class="input-group input-group-merge input-group-alternative">
														<div class="input-group-prepend">
															<span class="input-group-text"><i class="fas fa-cubes fa-4"></i></span>
														</div>
														<input name="stok" class="form-control add-stok" placeholder="Stok Barang" type="text" minlength="4" maxlength="100" disabled>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group mb-3">
											<div class="input-group input-group-merge input-group-alternative">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="ni ni-box-2"></i></span>
												</div>
												<input name="nama" class="form-control add-namabarang" placeholder="Nama Barang" type="text" minlength="4" maxlength="100" disabled>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group mb-3">
													<div class="input-group input-group-merge input-group-alternative">
														<div class="input-group-prepend">
															<span class="input-group-text"><i class="fas fa-dollar-sign fa-4"></i></span>
														</div>
														<input name="hargadasar" class="form-control add-hargadasar" placeholder="Harga Dasar Barang" type="text" minlength="4" maxlength="100" disabled>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group mb-3">
													<div class="input-group input-group-merge input-group-alternative">
														<div class="input-group-prepend">
															<span class="input-group-text"><i class="fas fa-money-bill-alt fa-4"></i></span>
														</div>
														<input name="hargajual" class="form-control add-hargajual" placeholder="Harga Jual Barang" type="text" minlength="4" maxlength="100" disabled>
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
										<input name="jumlah_pesanan" class="form-control add-jumlah jumlah_pesanan" placeholder="Jumlah barang yang dipesan" type="number" min="1" required oninvalid="this.setCustomValidity('Jumlah barang dibutuhkan, minimal 1')" oninput="this.setCustomValidity('')">
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
														<input name="edit-id" class="form-control edit-id" placeholder="Id Barang" type="number" minlength="4" maxlength="100" disabled>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group mb-3">
													<div class="input-group input-group-merge input-group-alternative">
														<div class="input-group-prepend">
															<span class="input-group-text"><i class="fas fa-cubes fa-4"></i></span>
														</div>
														<input name="edit-stok" class="form-control edit-stok" placeholder="Stok Barang" type="text" minlength="4" maxlength="100" disabled>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group mb-3">
											<div class="input-group input-group-merge input-group-alternative">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="ni ni-box-2"></i></span>
												</div>
												<input name="edit-namabarang" class="form-control edit-namabarang" placeholder="Nama Barang" type="text" minlength="4" maxlength="100" disabled>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group mb-3">
													<div class="input-group input-group-merge input-group-alternative">
														<div class="input-group-prepend">
															<span class="input-group-text"><i class="fas fa-dollar-sign fa-4"></i></span>
														</div>
														<input name="edit-hargadasar" class="form-control edit-hargadasar" placeholder="Harga Dasar Barang" type="text" minlength="4" maxlength="100" disabled>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group mb-3">
													<div class="input-group input-group-merge input-group-alternative">
														<div class="input-group-prepend">
															<span class="input-group-text"><i class="fas fa-money-bill-alt fa-4"></i></span>
														</div>
														<input name="edit-hargajual" class="form-control edit-hargajual" placeholder="Harga Jual Barang" type="text" minlength="4" maxlength="100" disabled>
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
										<input name="edit_jumlah_pesanan" class="form-control add-jumlah edit_jumlah_pesanan" placeholder="Jumlah barang yang dipesan" type="number" min="1" required>
										<input name="edit_jumlah_pesanan_lama" class="form-control edit_jumlah_pesanan_lama" type='hidden'>
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
					<!-- <button type="button" class="btn btn-link text-white ml-auto btn-hapus-data-double" data-dismiss="modal">Hapus Barang dari PO</button> -->
					<button type="button" class="btn btn-link text-white ml-auto btn-cancel" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</div>
	</div>

	<!-- MODAL NOTIF BARANG HANYA 1  -->
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
						<h4 class="heading mt-4">Hanya Ada 1 Barang pada PO!</h4>
						<p>Retur PO bukan berarti menghapus semua data barang yang ada.</p>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>


	<!-- MODAL NOTIF BARANG HANYA 1  -->
	<div class="modal fade" id="modal-notification-cantdelete" tabindex="-1" role="dialog" aria-labelledby="modal-notification-cantdelete" style="display: none;" aria-hidden="true">
		<div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
			<div class="modal-content bg-gradient-danger">
				<div class="modal-header">
					<h6 class="modal-title" id="modal-title-notification">Perhatian</h6>
					</button>
				</div>
				<div class="modal-body">
					<div class="py-3 text-center">
						<i class="ni ni-bell-55 ni-3x"></i>
						<h4 class="heading mt-4">Jumlah Stok Tidak Memenuhi!</h4>
						<p>Barang yang ingin retur lebih besar dari pada stok anda saat ini. Silahkan perhatikan kembali.</p>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<!-- MODAL NOTIF DATA PO BELUM LENGKAP  -->
	<div class="modal fade" id="modal-notification-faktur" tabindex="-1" role="dialog" aria-labelledby="modal-notification-faktur" style="display: none;" aria-hidden="true">
		<div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
			<div class="modal-content bg-gradient-danger">
				<div class="modal-header">
					<h6 class="modal-title" id="modal-title-notification">Perhatian</h6>
				</div>
				<div class="modal-body">
					<div class="py-3 text-center">
						<i class="ni ni-bell-55 ni-3x"></i>
						<h4 class="heading mt-4">Data Belum Lengkap!</h4>
						<p>Data yang anda masukkan belum lengkap. Silahkan isi semua data yang diperlukan agar dapat melakukan simpan permanen terhadap dokumen PO ini.</p>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>


	<!-- MODAL NOTIF BARANG BELUM ADA   -->
	<div class="modal fade" id="modal-notification-0" tabindex="-1" role="dialog" aria-labelledby="modal-notification-0" style="display: none;" aria-hidden="true">
		<div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
			<div class="modal-content bg-gradient-danger">
				<div class="modal-header">
					<h6 class="modal-title" id="modal-title-notification">Perhatian</h6>
					</button>
				</div>
				<div class="modal-body">
					<div class="py-3 text-center">
						<i class="ni ni-bell-55 ni-3x"></i>
						<h4 class="heading mt-4">Tidak Ada Barang pada PO!</h4>
						<p>Anda tidak bisa menyimpan PO sebelum anda menambahkan setidaknya satu barang.</p>
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

			//inisisasi id po, total harga, dan total barang
			var id_po = $('#nomor_po').val();
			var total_harga_po = "<?php echo $total_po->total_harga ?>";
			total_harga_po = total_harga_po == null ? 0 : total_harga_po;
			$('.total-harga').text("Total PO: " + format_rp(total_harga_po));
			$('.total-barang').val(<?php echo $total_po->total_barang ?>);

			//MENAMPILKAN DATA BARANG PO
			var table2 = $('#poProductList').DataTable({
				"ajax": "<?php echo site_url('admin/orders/api?action=list_po_products&nomor_po='); ?>" + id_po,
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
							return '<div class="text-right"><a href="#/" data-idbrg="' + row.brg_id + '" data-idpo="' + row.beli_idpo + '" class="btn btn-warning btn-sm btnEdit"><i class="fa fa-edit"></i></a><a href="#/" data-idbrg="' + row.brg_id + '"  data-idpo="' + row.beli_idpo + '" class="btn btn-danger btn-sm btnDelete" data-candelete='+ (row.brg_stok - row.beli_jumlahbrg>=0) +'><i class="fa fa-trash"></i></a></div>';
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
					url: '<?php echo site_url('admin/orders/api?action=add_product_retur'); ?>',
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
					url: '<?php echo site_url('admin/orders/api?action=edit_product_quantity_retur'); ?>',
					//data ini mengacu pada res.data yang ada di from modal & data yang telah di ppanggil di proses di atas
					data: {
						idbrg_pesanan: id_brg,
						idpo_pesanan: id_po,
						jumlah_pesanan: jumlah_pesanan,
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
				var total_barang = $('#total-barang').val();

				//DELETE DATA YANG MAU DITAMBAH
				btn_hapus_double = $('.btn-hapus-data-double');

				if (total_barang > 1) {
					btn_hapus_double.html('<i class="fa fa-spin fa-spinner"></i> Menghapus...');
					$.ajax({
						method: 'POST',
						url: '<?php echo site_url('admin/orders/api?action=delete_product_retur'); ?>',
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

				} else {
					$('#modal-notification-doubled').modal('hide');
					btn_hapus_double.html('<i class="fa fa-times"></i> Gagal').removeAttr('disabled');
					btn_hapus_double.html('Hapus Barang dari PO');

					$('#modal-notification').modal('show');
				}

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
							$('.edit_jumlah_pesanan_lama').val(d.beli_jumlahbrg);
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

				var jumlah_pesanan = $('.edit_jumlah_pesanan').val();
				var jumlah_pesanan_lama = $('.edit_jumlah_pesanan_lama').val();
				var stok_sekarang = parseInt($('.edit-stok').val().replace(/[^0-9]/g, ''), 10);

				var penambahan = jumlah_pesanan - jumlah_pesanan_lama;

				if(penambahan<0 && (penambahan*(-1) > stok_sekarang - 1)){ //setidaknya ada sisa 1 barang
					$('.jumlah_pesanan-error').text('Jumlah barang yang akan diretur melebihi stok, silahkan coba lagi. Produk minimal tersisa 1 atau silahkan hapus produk dari nota.')
				}else{
					btn.html('<i class="fa fa-spin fa-spinner"></i> Menyimpan...').attr('disabled', true);
					$('.jumlah_pesanan-error').text('');
	
					$.ajax({
						method: 'POST',
						url: '<?php echo site_url('admin/orders/api?action=edit_product_retur'); ?>',
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
				}
			});

			//MENGAHAPUS BARANG
			$(document).on('click', '.btnDelete', function() {
				var idbrg = $(this).data('idbrg');
				var idpo = $(this).data('idpo');
				var candelete = $(this).data('candelete');
				var cek_total_barang = $('.total-barang').val();

				if (cek_total_barang > 1 && candelete) {
					$('.deleteIdBrg').val(idbrg);
					$('.deleteIdPo').val(idpo);
					$('#deleteModal').modal('show');
				} else if(!candelete){
					$('#modal-notification-cantdelete').modal('show');
				} else {
					$('#modal-notification').modal('show');
				}
			});

			$('#deleteProduct').submit(function(e) {
				e.preventDefault();

				var idbrg = $('.deleteIdBrg').val();
				var idpo = $('.deleteIdPo').val();
				var btn = $('.btn-delete');

				btn.html('<i class="fa fa-spin fa-spinner"></i> Menghapus...').attr('disabled', true);;

				$.ajax({
					method: 'POST',
					url: '<?php echo site_url('admin/orders/api?action=delete_product_retur'); ?>',
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

			//cetak po
			$('.printPoBtn').on('click', function() {
				var id_po = $('#nomor_po').val();
				window.open("<?php echo site_url('admin/orders/cetak_po/'); ?>" + id_po, '_blank', 'resizable=yes');
			});


			//select2
			$("#barangbarang").select2({
				placeholder: 'Cari Barang di sini...',
				// minimumInputLength: 2,
				templateResult: formatCariBarang, //this is for append country flag.
				delay: 250,
				ajax: {
					url: "<?php echo site_url('admin/orders/api?action=search'); ?>",
					dataType: 'json',
					type: "POST",
					data: function(term) {
						return {
							term: term.term
						};
					},
					processResults: function(data) {
						return {
							results: $.map(data.data, function(item) {
								return {
									id: item.brg_id,
									text: item.brg_nama,
									stok: item.brg_stok + ' ' + item.brg_satuan

								}
							})
						};
					},
					cache: true,
					allowClear: true,
					language: "id",
					escapeMarkup: function(markup) {
						return markup;
					}
				}
			});

			$('#barangbarang').on('change', function() {
				var id_barang = $('#barangbarang').val();
				//buka modal add barang

				$.ajax({
					method: 'GET',
					url: '<?php echo site_url('admin/orders/api?action=get_product'); ?>',
					data: {
						id_barang: id_barang
					},
					success: function(res) {
						if (res.data) {
							var d = res.data;
				
							$('.add-id').val(d.brg_id);
							$('.add-namabarang').val(d.brg_nama);
							$('.add-stok').val(d.brg_stok + ' ' + d.brg_satuan);
							$('.add-hargadasar').val(d.brg_hargadasar);
							$('.add-hargajual').val(d.brg_hargajual);

							//menetapkan nilai ke hidden value yang digunakan untuk insert data barang po
							$('.idbrg_pesanan').val(d.brg_id);
							$('.idpo_pesanan').val($('#nomor_po').val());

							$('#addModal').modal('show');

						}
					}
				});
			});

		});

		//for apend flag of country.
		function formatCariBarang(barang) {
			if (!barang.id) {
				return barang.id;
			}
			var $barang = $(
				'<div class="row">' +
				'<div class="col-3">' + barang.id + '</div>' +
				'<div class="col-6">' + barang.text + '</div>' +
				'<div class="col-3">' + barang.stok + '</div>' +
				'</div>'
			);
			return $barang;
		};
	</script>
