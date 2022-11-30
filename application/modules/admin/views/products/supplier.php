<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Header -->
<div class="header bg-secondary pb-6">
	<div class="container-fluid">
		<div class="header-body">
			<div class="row align-items-center py-4">
				<div class="col-lg-6 col-7">
					<h6 class="h2 d-inline-block mb-0">Kelola Data Supplier</h6>
					<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
						<ol class="breadcrumb breadcrumb-links ">
							<li class="breadcrumb-item"><a href="<?php echo site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item"><a href="<?php echo site_url('admin/products'); ?>">Barang</a></li>
							<li class="breadcrumb-item active" aria-current="page">Supplier</li>
						</ol>
					</nav>
				</div>
				<div class="col-lg-6 col-5 text-right">
					<a href="#" data-target="#addModal" data-toggle="modal" class="btn btn-sm btn-primary btn-tambah">Tambah</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
	<div class="row">
		<div class="col">
			<div class="card">
				<!-- Card header -->
				<div class="card-header border-0">
					<h3 class="mb-0">Supplier</h3>
				</div>

				<div class="packageContainer">
					<!-- Light table -->
					<div class="table-responsive">
						<table class="table align-items-center table-flush" id="packageList" style="width: 100%">
							<thead class="thead-light">
								<tr>
									<th scope="col"></th>
									<th scope="col">ID</th>
									<th scope="col">Perusahaan</th>
									<!-- <th scope="col">Alamat</th> -->
									<!-- <th scope="col">No. Rek.</th>
										<th scope="col">Bank</th> -->
									<th scope="col">Personal</th>
									<th scope="col">No. HP</th>
									<th scope="col">Inisial</th>
									<th scope="col"></th>
								</tr>
							</thead>

						</table>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- MODAL TAMBAH SUPPLIER -->
	<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
		<div class="modal-dialog modal- modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-body p-0">
					<div class="card bg-secondary border-0 mb-0">
						<div class="card-header bg-transparent">
							<h3 class="card-heading text-center mt-2">Tambah Supplier</h3>
						</div>
						<div class="card-body px-lg-5 py-lg-5">
							<form role="form" action="#" method="POST" id="addSupplierForm">

								<div class="form-group mb-3">
									<div class="input-group input-group-merge input-group-alternative add-id-div">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-id-card fa-4"></i></span>
										</div>
										<input name="id" class="form-control add-id" placeholder="Id Supplier" type="number" >
									</div>
									<div class="text-danger err id-error"></div>
								</div>

								<div class="form-group mb-3">
									<div class="input-group input-group-merge input-group-alternative">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-building fa4"></i></span>
										</div>
										<input name="perusahaan" class="form-control perusahaan" placeholder="Nama Perusahaan" type="text" >
									</div>
									<div class="text-danger err perusahaan-error"></div>
								</div>

								<div class="form-group mb-3">
									<div class="input-group input-group-merge input-group-alternative">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-map-marked-alt fa4"></i></span>
										</div>
										<input name="alamat" class="form-control" placeholder="Alamat Supplier" type="text" >
									</div>
									<div class="text-danger err alamat-error"></div>
								</div>
								<div class="form-group mb-3">
									<div class="input-group input-group-merge input-group-alternative">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-money-check-alt fa-4"></i></span>
										</div>
										<input name="norek" class="form-control" placeholder="No. Rek. Supplier" type="text" >
									</div>
									<div class="text-danger err norek-error"></div>
								</div>
								<div class="form-group mb-3">
									<div class="input-group input-group-merge input-group-alternative">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-university fa4"></i></span>
										</div>
										<input name="bank" class="form-control" placeholder="Bank Supplier" type="text" >
									</div>
									<div class="text-danger err bank-error"></div>
								</div>
								<div class="form-group mb-3">
									<div class="input-group input-group-merge input-group-alternative">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-male fa4"></i></span>
										</div>
										<input name="personal" class="form-control" placeholder="Nama Personal Supplier" type="text" >
									</div>
									<div class="text-danger err personal-error"></div>
								</div>
								<div class="form-group mb-3">
									<div class="input-group input-group-merge input-group-alternative">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-phone fa4"></i></span>
										</div>
										<input name="nohp" class="form-control" placeholder="No. HP Supplier" type="text" >
									</div>
									<div class="text-danger err nohp-error"></div>
								</div>
								<div class="form-group mb-3">
									<div class="input-group input-group-merge input-group-alternative">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-signature fa4"></i></span>
										</div>
										<input name="inisial" class="form-control" placeholder="Inisial Supplier" type="text" >
									</div>
									<div class="text-danger err inisial-error"></div>
								</div>

								<div class="text-left">
									<button type="button" class="btn btn-secondary my-4" data-dismiss="modal">Batal</button>
								</div>
								<div class="float-right" style="margin-top: -90px">
									<button type="submit" class="btn btn-primary my-4 addSupplierBtn">Tambah</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- MODAL HAPUS SUPPLIER -->
	<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
		<div class="modal-dialog modal-modal-dialog-centered modal-" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h6 class="modal-title" id="modal-title-default">Hapus Supplier</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form action="#" id="deleteSupplier" method="POST">

					<input type="hidden" name="id" value="" class="deleteID">

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

	<!-- MODAL EDIT SUPPLIER -->
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
		<div class="modal-dialog modal- modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-body p-0">
					<div class="card bg-secondary border-0 mb-0">
						<div class="card-header bg-transparent">
							<h3 class="card-heading text-center mt-2">Edit Supplier</h3>
						</div>
						<div class="card-body px-lg-5 py-lg-5">
							<form role="form" action="#" method="POST" id="editCategoryForm">

								<input type="hidden" name="id" value="" class="edit-id">

								<div class="form-group mb-3">
									<div class="input-group input-group-merge input-group-alternative">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-id-card fa4"></i></span>
										</div>
										<input name="perusahaan" class="form-control edit-perusahaan" placeholder="Nama Perusahaan" type="text"  autofocus>
									</div>
									<div class="text-danger err edit-perusahaan-error"></div>
								</div>
								<div class="form-group mb-3">
									<div class="input-group input-group-merge input-group-alternative">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-map-marked-alt fa4"></i></span>
										</div>
										<input name="alamat" class="form-control edit-alamat" placeholder="Alamat supplier" type="text" >
									</div>
									<div class="text-danger err edit-alamat-error"></div>
								</div>
								<div class="form-group mb-3">
									<div class="input-group input-group-merge input-group-alternative">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-money-check-alt fa4"></i></span>
										</div>
										<input name="norek" class="form-control edit-norek" placeholder="No. Rek. supplier" type="text" >
									</div>
									<div class="text-danger err edit-norek-error"></div>
								</div>
								<div class="form-group mb-3">
									<div class="input-group input-group-merge input-group-alternative">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-university fa4"></i></span>
										</div>
										<input name="bank" class="form-control edit-bank" placeholder="Bank supplier" type="text" >
									</div>
									<div class="text-danger err edit-bank-error"></div>
								</div>
								<div class="form-group mb-3">
									<div class="input-group input-group-merge input-group-alternative">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-male fa4"></i></span>
										</div>
										<input name="personal" class="form-control edit-personal" placeholder="Nama Personal supplier" type="text" >
									</div>
									<div class="text-danger err edit-personal-error"></div>
								</div>
								<div class="form-group mb-3">
									<div class="input-group input-group-merge input-group-alternative">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-phone fa4"></i></span>
										</div>
										<input name="nohp" class="form-control edit-nohp" placeholder="No. HP supplier" type="text" >
									</div>
									<div class="text-danger err edit-nohp-error"></div>
								</div>
								<div class="form-group mb-3">
									<div class="input-group input-group-merge input-group-alternative">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-signature fa4"></i></span>
										</div>
										<input name="inisial" class="form-control edit-inisial" placeholder="Inisial sFupplier" type="text" >
									</div>
									<div class="text-danger err edit-inisial-error"></div>
								</div>

								<div class="text-left">
									<button type="button" class="btn btn-secondary my-4" data-dismiss="modal">Batal</button>
								</div>
								<div class="float-right" style="margin-top: -90px">
									<button type="submit" class="btn btn-primary my-4 editSupplierBtn">Simpan</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<link href="<?php echo get_theme_uri('vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css', 'argon'); ?>" rel="stylesheet">

	<script src="<?php echo get_theme_uri('vendor/datatables.net/js/jquery.dataTables.min.js', 'argon'); ?>"></script>
	<script src="<?php echo get_theme_uri('vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js', 'argon'); ?>"></script>
	<script src="<?php echo base_url('assets/plugins/datatables.lang.js'); ?>"></script>

	<script>
		// FUNGSI UNTUK MENAMPILKAN DETAIL TABLE
		function format(d) {
			// `d` is the original data object for the row
			return '<table width="100%" style="border-radius:45px; border:1px solid #ccc;">' +
				'<tr>' +
				'<td style="font-weight:bold">Alamat:</td>' +
				'<td>' + d.sup_alamat + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td style="font-weight:bold">Norek:</td>' +
				'<td>' + d.sup_norek + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td style="font-weight:bold">Bank:</td>' +
				'<td>' + d.sup_bank + '</td>' +
				'</tr>' +
				'</table>';
		}

		$(document).ready(function() {

			//MENAMPILKAN DATA KATEGORI PADA TABEL
			var table = $('#packageList').DataTable({
				"ajax": "<?php echo site_url('admin/suppliers/supplier_api?action=list'); ?>",
				"columns": [{
						"className": 'details-control',
						"orderable": false,
						"data": null,
						"defaultContent": ''
					},
					{
						"data": "sup_id"
					},
					{
						"data": "sup_perusahaan"
					},
					// {"data": "sup_alamat"},
					// {"data": "sup_norek"},
					// {"data": "sup_bank"},
					{
						"data": "sup_personal"
					},
					{
						"data": "sup_nohp"
					},
					{
						"data": "sup_inisial"
					},
					{
						"mRender": function(data, type, row) {
							return '<div class="text-right"><a href="#" data-id="' + row.sup_id + '" class="btn btn-warning btn-sm btnEdit"><i class="fa fa-edit"></i></a><a href="#" data-id="' + row.sup_id + '" class="btn btn-danger btn-sm btnDelete"><i class="fa fa-trash"></i></a></div>';
						}
					}
					//nama variabel yang digunakan adalah nama yang tertera di bagian "data", atau sama dengan nama kolom di tabel. Untuk ambil data per baris, tambah kata "row"
				],
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
					"paginate": {
						"first": "&laquo;",
						"last": "&raquo;",
						"next": "&rsaquo;",
						"previous": "&lsaquo;"
					},
				}
			});

			// Add event listener for opening and closing details
			$('#packageList tbody').on('click', 'td.details-control', function() {
				var tr = $(this).closest('tr');
				var row = table.row(tr);

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

			//MENGEDIT SUPPLIER, KITA PERLU DATA DARI SUPPLIERNYA UNTUK DITAMPILKAN
			$(document).on('click', '.btnEdit', function() {
				//data('id') didapat dari deklarasi "data-id" pada pembuatan datatables, tepatnya di bagian "mRender". disana ada atribut data-id=row.kat_id. kita ambil nilai id dari tabel dari database
				var id = $(this).data('id');

				$.ajax({
					method: 'GET',
					//KITA MENGAMBIL DATA MENGGUNAKAN CATEGORY API UNTUK VIEW DATA. DATA YANG KITA PASS ADALAH "ID" SEBAGAI KUNCI UNTUK MENCARI DATA NANTINYA.
					url: '<?php echo site_url('admin/suppliers/supplier_api?action=view_data'); ?>',
					data: {
						id: id
					},
					success: function(res) {
						if (res.data) {
							var d = res.data;
							//RES DATA, ITU BERARTI DATA YANG DI AMBIL DARI DATABASE. GUNAKAN RES.NAMA_KOLOM DI DATABASE UNTUK MENGAMBIL DATA
							$('.edit-id').val(d.sup_id);
							$('.edit-perusahaan').val(d.sup_perusahaan);
							$('.edit-alamat').val(d.sup_alamat);
							$('.edit-norek').val(d.sup_norek);
							$('.edit-bank').val(d.sup_bank);
							$('.edit-personal').val(d.sup_personal);
							$('.edit-nohp').val(d.sup_nohp);
							$('.edit-inisial').val(d.sup_inisial);

							$('#editModal').modal('show');

						}
					}
				});


			});

			//BUKA EDIT SUPPLIER
			$('#editCategoryForm').submit(function(e) {
				e.preventDefault();

				var btn = $('.editSupplierBtn');
				var id = $('.edit-id').val();
				var data = $(this).serialize();
				btn.html('<i class="fa fa-spin fa-spinner"></i> Menyimpan...').attr('disabled', true);

				$('.err').empty();
				$.ajax({
					method: 'POST',
					url: '<?php echo site_url('admin/suppliers/supplier_api?action=edit_supplier'); ?>',
					data: data,
					success: function(res) {
						if (res.code == 201) {
							btn.html('<i class="fa fa-check"></i> Berhasil').removeAttr('disabled');

							setTimeout(() => {
								$('#editModal').modal('hide');
								table.ajax.reload();
								btn.html('Simpan');
							}, 1500);
						}else if(res.code == 409){
							btn.html('Simpan').removeAttr('disabled');
							if (res.nohp_error) {
								$('.edit-nohp-error').append(res.nohp_error);
							}
							if (res.norek_error) {
								$('.edit-norek-error').append(res.norek_error);
							}
							if (res.inisial_error) {
								$('.edit-inisial-error').append(res.inisial_error);
							}
							if (res.perusahaan_error) {
								$('.edit-perusahaan-error').append(res.perusahaan_error);
							}
						}
					}
				})
			});

			//MENGAHAPUS SUPPLIER
			$(document).on('click', '.btnDelete', function() {
				var id = $(this).data('id');

				$('.deleteID').val(id);
				$('#deleteModal').modal('show');
			});

			$('#deleteSupplier').submit(function(e) {
				e.preventDefault();

				var id = $('.deleteID').val();
				var btn = $('.btn-delete');

				btn.html('<i class="fa fa-spin fa-spinner"></i> Menghapus...');

				$.ajax({
					method: 'POST',
					url: '<?php echo site_url('admin/suppliers/supplier_api?action=delete_supplier'); ?>',
					//DIAMBIL DARI DATA DI BAWAH (BAGIAN MENAMPILKAN TABEL) . data-id dari penampilan tabel di bawah kemudian di pass ke struktur html di atas (atribut name sbg penentu penyimpan datanya). kemudian, ambil datanya dengan deklarasi variabel di dalam scope delete category ini.
					//id yang di pass ke parameter controller:::: id yang didapat dari var id di atas.
					data: {
						id: id
					},
					success: function(res) {
						if (res.code == 204) {
							btn.html('<i class="fa fa-check"></i> Terhapus!');

							setTimeout(() => {
								$('#deleteModal').modal('hide');
								table.ajax.reload();
								btn.html('Hapus');
							}, 1500);
						}
					}
				})
			});

			//MENAMBAH SUPPLIER BARU
			$('#addSupplierForm').submit(function(e) {
				e.preventDefault();

				var data = $(this).serialize();
				var btn = $('.addSupplierBtn');

				btn.html('<i class="fa fa-spin fa-spinner"></i> Menambah...');
				$('.err').empty();

				$.ajax({
					method: 'POST',
					url: '<?php echo site_url('admin/suppliers/supplier_api?action=add_supplier'); ?>',
					data: data,
					context: this,
					success: function(res) {
						if (res.data) {
							btn.html('<i class="fa fa-check"></i> Berhasil!');

							setTimeout(function() {
								$('#addSupplierForm .form-control').val(null);
								btn.html('Tambah');
							}, 2000);
							setTimeout(() => {
								$('#addModal').modal('hide');

								// //keypressed di bawah
								// is_add_supp_modal_shown = false;
							}, 2222);

							table.ajax.reload();

						} else if (res.code == 409) {

							if (res.id_error) {
								$('.id-error').append(res.id_error);
							}
							if (res.nohp_error) {
								$('.nohp-error').append(res.nohp_error);
							}
							if (res.norek_error) {
								$('.norek-error').append(res.norek_error);
							}
							if (res.inisial_error) {
								$('.inisial-error').append(res.inisial_error);
							}
							if (res.perusahaan_error) {
								$('.perusahaan-error').append(res.perusahaan_error);
							}

							//KALAU MAU MENGHAPUS SEMUA DATA YANG ADA DI FORM
							// $('#addSupplierForm .form-control').val(null);
							btn.html('Tambah');

						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						btn.html('Tambah');

						var errors = xhr.responseJSON.errors;

						$.each(errors, function(keys, val) {
							$.each(val, function(key, val) {
								$('.' + keys + '-error').text(val);
							});
						});
					}
				})
			})

			//menampilkan id terakhir+1 pada penambahnan supplier baru
			$(document).on('click', '.btn-tambah', function() {
				//mendapatkan id kategori terakhir
				$.ajax({
					method: 'GET',
					//KITA MENGAMBIL DATA MENGGUNAKAN CATEGORY API UNTUK VIEW DATA. DATA YANG KITA PASS ADALAH "ID" SEBAGAI KUNCI UNTUK MENCARI DATA NANTINYA.
					url: '<?php echo site_url('admin/suppliers/supplier_api?action=last_id'); ?>',
					success: function(res) {
						if (res.data) {
							var d = res.data;
							//RES DATA, ITU BERARTI DATA YANG DI AMBIL DARI DATABASE. GUNAKAN RES.NAMA_KOLOM DI DATABASE UNTUK MENGAMBIL DATA
							$('.add-id').val(parseInt(d.sup_id) + 1);
							$('.add-id-div').addClass('disabled');
							$('.perusahaan').focus();
						} else {
							$('.add-id').val('1');
							$('.perusahaan').focus();
						}
					}
				});
			});

			// KEYPRESSED
			let is_add_supp_modal_shown = false;
			$(document).keydown(function(e) {

				//ALT+T
				if (e.which == 84 && e.altKey) {
					if (!is_add_supp_modal_shown) {
						$('#addModal').modal('show');
						is_add_supp_modal_shown = true;
					} else {
						$('#addModal').modal('hide');
						is_add_supp_modal_shown = false;
					}
				}
				if (e.which == 68 && e.altKey) {

				}
			});
		});
	</script>
