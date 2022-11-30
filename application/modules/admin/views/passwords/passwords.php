<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Header -->
<div class="header bg-secondary pb-6">
	<div class="container-fluid">
		<div class="header-body">
			<div class="row align-items-center py-4">
				<div class="col-lg-6 col-7">
					<h6 class="h2 d-inline-block mb-0">Kelola Password</h6>
					<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
						<ol class="breadcrumb breadcrumb-links ">
							<li class="breadcrumb-item"><a href="<?php echo site_url('admin') ?>"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item active" aria-current="page">Password</li>
						</ol>
					</nav>
				</div>
				<div class="col-lg-6 col-5 text-right">
					<a href="#" data-target="#addModal" data-toggle="modal" class="btn btn-sm btn-primary btn-tambah">Tambah Akun</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
	<div class="row">

		<!-- <div class="col-lg-6">
          <div class="card">  -->
		<!-- Card header -->
		<!-- <div class="card-header">
              <h3 class="mb-0">Admin</h3>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="adminList" style="width: 100%">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">ID</th>
																<th scope="col">Nama</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            
          </div>
        </div> -->

		<div class="col-lg-12">
			<div class="card">
				<!-- Card header -->
				<div class="card-header">
					<h3 class="mb-0">Kasir</h3>
				</div>

				<div class="card-body p-0">
					<div class="table-responsive">
						<table class="table align-items-center table-flush" id="kasirList" style="width: 100%">
							<thead class="thead-light">
								<tr>
									<th scope="col">ID</th>
									<th scope="col">Nama</th>
									<th scope="col"></th>
								</tr>
							</thead>
						</table>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- EDIT ADMIN -->
	<!-- <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog modal-md" role="document">
      <div class="modal-content">
          <div class="modal-body p-0">
              <div class="card bg-secondary border-0 mb-0">
                  <div class="card-header bg-transparent">
                      <h3 class="card-heading text-center mt-2">Edit Password Admin</h3>
                  </div>
                  <div class="card-body px-lg-5 py-lg-5">
                      <form role="form" action="#" method="POST" id="editAdminPasswordForm">
                        
                        <input type="hidden" name="id" value="" class="edit-id">
													
                          <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-key fa-4"></i></span>
                                  </div>
                                  <input name="password" class="form-control edit-password" placeholder="Password Baru" type="password" minlength="6" maxlength="100" required>
                                </div>
                                <div class="text-danger err password-error"></div>
                          </div>
                          
                          <div class="text-left">
                              <button type="button" class="btn btn-secondary my-4" data-dismiss="modal">Batal</button>
                          </div>
                          <div class="float-right" style="margin-top: -90px">
                            <button type="submit" class="btn btn-primary my-4 editPasswordBtn">Simpan</button>
                        </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div> -->

	<!-- DELETE ADMIN -->
	<!-- <div class="modal fade" id="deleteAdminModal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
  <div class="modal-dialog modal-modal-dialog-centered modal-" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h6 class="modal-title" id="modal-title-default">Hapus Akun Admin?</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
          </div>
          <form action="#" id="deleteAdmin" method="POST">
        
            <input type="hidden" name="id" value="" class="deleteAdminID">

          //<div class="modal-body">
              <p>Yakin ingin pelanggan ini? Semua data seperti data profil, order dan pembayaran juga akan dihapus.</p>
          </div>//
					<div class="modal-body">
              <p>Yakin ingin menghapus data admin ini? Semua data yang telah dihapus tidak dapat dipulihkan.</p>
          </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-danger btn-delete">Hapus</button>
              <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Batal</button>
          </div>
          </form>
      </div>
  </div>
</div> -->

	<!-- EDIT KASIR -->
	<div class="modal fade" id="editKasirModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
		<div class="modal-dialog modal- modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-body p-0">
					<div class="card bg-secondary border-0 mb-0">
						<div class="card-header bg-transparent">
							<h3 class="card-heading text-center mt-2">Edit Password Kasir (Id: <span class="id-kasir-edit"></span>)</h3>
						</div>
						<div class="card-body px-lg-5 py-lg-5">
							<form role="form" action="#" method="POST" id="editKasirPasswordForm">

								<input type="hidden" name="id" value="" class="edit-kasir-id">

								<div class="form-group mb-3">
									<div class="input-group input-group-merge input-group-alternative">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-key fa-4"></i></span>
										</div>
										<input name="password" class="form-control edit-kasir-password" placeholder="Password Baru" type="password">
									</div>
									<div class="text-danger err edit-password-error"></div>
								</div>

								<div class="text-left">
									<button type="button" class="btn btn-secondary my-4" data-dismiss="modal">Batal</button>
								</div>
								<div class="float-right" style="margin-top: -90px">
									<button type="submit" class="btn btn-primary my-4 editKasirPasswordBtn">Simpan</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- DELETE KASIR -->
	<div class="modal fade" id="deleteKasirModal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
		<div class="modal-dialog modal-modal-dialog-centered modal-" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h6 class="modal-title" id="modal-title-default">Hapus Akun Kasir? (Id: <span class="id-kasir-hapus"></span>)</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form action="#" id="deleteKasir" method="POST">

					<input type="hidden" name="id" value="" class="deleteKasirID">

					<div class="modal-body">
						<p>Yakin ingin menghapus data kasir ini? Semua data yang telah dihapus tidak dapat dipulihkan.</p>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-danger btn-delete">Hapus</button>
						<button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Batal</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	
	<!-- MODAL TAMBAH ADMIN -->
	<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
		<div class="modal-dialog modal- modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-body p-0">
					<div class="card bg-secondary border-0 mb-0">
						<div class="card-header bg-transparent">
							<h3 class="card-heading text-center mt-2">Tambah Kasir</h3>
						</div>
						<div class="card-body px-lg-5 py-lg-5">
							<form role="form" action="#" method="POST" id="addKasirForm">

								<div class="form-group mb-3">
									<div class="input-group input-group-merge input-group-alternative add-id-div">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-id-card fa-4"></i></span>
										</div>
										<input name="id" class="form-control add-id" placeholder="Id Kasir" type="text" >
									</div>
									<div class="text-danger err id-error"></div>
								</div>
								<div class="form-group mb-3">
									<div class="input-group input-group-merge input-group-alternative">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-male fa-4"></i></span>
										</div>
										<input name="nama" class="form-control" placeholder="Nama Kasir" type="text" >
									</div>
									<div class="text-danger err nama-error"></div>
								</div>
								<div class="form-group mb-3">
									<div class="input-group input-group-merge input-group-alternative">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-phone fa-4"></i></span>
										</div>
										<input name="nohp" class="form-control" placeholder="No. HP Kasir" type="text">
									</div>
									<div class="text-danger err nohp-error"></div>
								</div>
								<div class="form-group mb-3">
									<div class="input-group input-group-merge input-group-alternative">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-key fa-4"></i></span>
										</div>
										<input name="password" class="form-control password" placeholder="Password" type="password">
									</div>
									<div class="text-danger err password-error"></div>
								</div>

								<div class="text-left">
									<button type="button" class="btn btn-secondary my-4" data-dismiss="modal">Batal</button>
								</div>
								<div class="float-right" style="margin-top: -90px">
									<button type="submit" class="btn btn-primary my-4 addKasirBtn">Tambah</button>
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
		$(document).ready(function() {

			//MENAMBAH SUPPLIER BARU
			$('#addKasirForm').submit(function(e) {
				e.preventDefault();

				var data = $(this).serialize();
				var btn = $('.addKasirBtn');

				btn.html('<i class="fa fa-spin fa-spinner"></i> Menambah...');
				$('.err').empty();

				$.ajax({
					method: 'POST',
					url: '<?php echo site_url('admin/passwords/api/add_kasir'); ?>',
					data: data,
					context: this,
					success: function(res) {
						if (res.code == 204) {
							btn.html('<i class="fa fa-check"></i> Berhasil!');

							setTimeout(function() {
								$('#addKasirForm .form-control').val(null);
								btn.html('Tambah');
							}, 2000);
							setTimeout(() => {
								$('#addModal').modal('hide');

								// //keypressed di bawah
								// is_add_supp_modal_shown = false;
							}, 2222);

							table_kasir.ajax.reload();

						} else if (res.code == 409) {

							if (res.id_error) {
								$('.id-error').append(res.id_error);
							}
							if (res.nohp_error) {
								$('.nohp-error').append(res.nohp_error);
							}
							if (res.nama_error) {
								$('.nama-error').append(res.nama_error);
							}
							if (res.password_error) {
								$('.password-error').append(res.password_error);
							}

							//KALAU MAU MENGHAPUS SEMUA DATA YANG ADA DI FORM
							// $('#addKasirForm .form-control').val(null);
							btn.html('Tambah');

						} 
					},
					error: function(xhr, ajaxOptions, thrownError) {
						btn.html('Tambah');

					}
				})
			})

			// var table = $('#adminList').DataTable({
			// 	"ajax" : "<?php //echo site_url('admin/passwords/api/admin_passwords'); 
											?>",
			// 	"columns" : [
			// 		{"data": "adm_id"},
			// 		{"data": "adm_nama"},
			// 		// {"data": function (data, type, row) {
			// 		//     return '<img src="'+ data.profile_picture +'" class="img img-fluid rounded" style="width: 40px;">';
			// 		// }
			// 		// },
			// 		// {"data": function (data, type, row) {
			// 		//     var url = window.location.href.split('?')[0].replace('#', '');
			// 		//     url = url + '/view/'+ data.id;

			// 		//     return '<a href="'+ url +'">'+ data.name +'</a>';
			// 		// }
			// 		// },
			// 		// {"data": "email"},
			// 		// {"data": "phone_number"},
			// 		// {"data": "address"},
			// 		{"mRender": function (data, type, row) {
			// 				var url = window.location.href.split('?')[0].replace('#', '');
			// 				url = url + '/edit/'+ row.adm_id;

			// 				return '<div class="text-right"><a href="#" data-id="'+row.adm_id+'" class="btn btn-warning btn-sm btnEdit"><i class="fa fa-edit"></i></a><a href="#" data-id="'+row.adm_id+'" class="btn btn-danger btn-sm btnDelete"><i class="fa fa-trash"></i></a></div>';}
			// 		}
			// 	],
			// 	//limitasi tampilan
			// 	"lengthMenu": [5, 10, 25, 50, 100],
			//   "pageLength": 5,
			// 	"language" : {
			// 		"search" : "Cari:",
			// 		"lengthMenu" : "Menampilkan _MENU_ data",
			// 		"info" : "Menampilkan _START_ sampai _END_ data dari _TOTAL_ data",
			// 		"infoEmpty" : "Tidak ada data yang ditampilkan",
			// 		"infoFiltered" : "(dari total _MAX_ data)",
			// 		"zeroRecords" : "Tidak ada hasil pencarian ditemukan",
			// 		"paginate": {
			// 			"first":"&laquo;",
			// 			"last":"&raquo;",
			// 			"next":       "&rsaquo;",
			// 			"previous":   "&lsaquo;"
			// 		},
			// 	}
			// });

			// //EDIT ADMIN
			// $(document).on('click', '.btnEdit', function() {
			// 	//data('id') didapat dari deklarasi "data-id" pada pembuatan datatables, tepatnya di bagian "mRender". disana ada atribut data-id=row.kat_id. kita ambil nilai id dari tabel dari database
			//   var id  = $(this).data('id');

			//   // $.ajax({
			//   //   method: 'GET',
			// 	// 	//KITA MENGAMBIL DATA MENGGUNAKAN CATEGORY API UNTUK VIEW DATA. DATA YANG KITA PASS ADALAH "ID" SEBAGAI KUNCI UNTUK MENCARI DATA NANTINYA.
			//   //   url: '</?php echo site_url('admin/passwords/category_api?action=view_data'); ?>',
			//   //   data: {id: id},
			//   //   success: function(res) {
			//   //     if (res.data) {
			//   //       var d  = res.data;

			// 	// 			//RES DATA, ITU BERARTI DATA YANG DI AMBIL DARI DATABASE. GUNAKAN RES.NAMA_KOLOM DI DATABASE UNTUK MENGAMBIL DATA
			//   //       $('.edit-id').val(d.kat_id);
			//   //       $('.edit-name').val(d.kat_nama);
			// 				$('.edit-id').val(id);
			//         $('#editModal').modal('show');
			//   //     }
			//   //   }
			//   // });
			// });

			// //EDIT PASSWORD ADMIN
			// $('#editAdminPasswordForm').submit(function(e) {
			//   e.preventDefault();

			//   var btn = $('.editPasswordBtn');
			//   var id = $('.edit-id').val();
			//   var data = $(this).serialize();
			//   btn.html('<i class="fa fa-spin fa-spinner"></i> Menyimpan...').attr('disabled', true);

			//   $.ajax({
			//     method: 'POST',
			//     url: '<?php //echo site_url('admin/passwords/edit/admin_password'); 
										?>',
			//     data: data,
			//     success: function (res) {
			//       if (res.code == 201) {
			//         btn.html('<i class="fa fa-check"></i> Berhasil').removeAttr('disabled');

			//         setTimeout(() => {
			//           $('#editModal').modal('hide');
			//           table.ajax.reload();
			//           btn.html('Simpan');
			//         }, 1500);
			// 				$('.edit-password').val('');
			//       }
			// 			btn.attr('class', 'btn btn-primary my-4');
			//     }
			//   })
			// });

			// //DELETE ADMIN
			// $(document).on('click', '.btnDelete', function() {
			// 	//data-id = adm_id
			//   var id  = $(this).data('id');

			//   $('.deleteAdminID').val(id);
			//   $('#deleteAdminModal').modal('show');
			// });

			// $('#deleteAdmin').submit(function(e) {
			//   e.preventDefault();

			//   var id = $('.deleteAdminID').val();
			//   var btn = $('.btn-delete');

			//   btn.html('<i class="fa fa-spin fa-spinner"></i> Menghapus...');

			//   $.ajax({
			//     method: 'POST',
			//     url: '<?php //echo site_url('admin/passwords/api/delete_admin'); 
										?>',
			//     data: {
			//         id: id
			//     },
			//     success: function (res) {
			//       if (res.code == 204) {
			//         btn.html('<i class="fa fa-check"></i> Terhapus!');

			//         setTimeout(() => {
			//           $('#deleteAdminModal').modal('hide');
			//           table.ajax.reload();
			//           btn.html('Hapus');
			//         }, 1500); 
			//       }
			//     }
			//   })
			// });


			var table_kasir = $('#kasirList').DataTable({
				"ajax": "<?php echo site_url('admin/passwords/api/kasir_passwords'); ?>",
				"columns": [{
						"data": "ksr_id"
					},
					{
						"data": "ksr_nama"
					},
					{
						"mRender": function(data, type, row) {
							var url = window.location.href.split('?')[0].replace('#', '');
							url = url + '/edit/' + row.ksr_id;

							return '<div class="text-right"><a href="#" data-id="' + row.ksr_id + '" class="btn btn-warning btn-sm btnEditKasir"><i class="fa fa-edit"></i></a><a href="#" data-id="' + row.ksr_id + '" class="btn btn-danger btn-sm btnDeleteKasir"><i class="fa fa-trash"></i></a></div>';
						}
					}
				],
				//limitasi tampilan
				"lengthMenu": [5, 10, 25, 50, 100],
				"pageLength": 5,
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


			//EDIT KASIR
			$(document).on('click', '.btnEditKasir', function() {
				var id = $(this).data('id');

				$('.edit-kasir-id').val(id);
				$('.id-kasir-edit').text(id);
				$('#editKasirModal').modal('show');
			});

			//EDIT PASSWORD KASIR
			$('#editKasirPasswordForm').submit(function(e) {
				e.preventDefault();
				$('.edit-password-error').empty();
				var btn = $('.editKasirPasswordBtn');
				var id = $('.edit-kasir-id').val();
				var data = $(this).serialize();
				btn.html('<i class="fa fa-spin fa-spinner"></i> Menyimpan...').attr('disabled', true);
			
				$.ajax({
					method: 'POST',
					url: '<?php echo site_url('admin/passwords/edit/kasir_password'); ?>',
					data: data,
					success: function(res) {
						if (res.code == 201) {
							// btn.html('<i class="fa fa-check"></i> Berhasil').removeAttr('disabled');
							btn.html('<i class="fa fa-check"></i> Berhasil').removeAttr('disabled');

							setTimeout(() => {
								$('#editKasirModal').modal('hide');
								table_kasir.ajax.reload();
								btn.html('Simpan');
							}, 1500);
							$('.edit-kasir-password').val('');
						} else if(res.code==409) {
								if (res.password_error) {
								btn.html('Simpan').removeAttr('disabled');
								$('.edit-password-error').append(res.password_error);
							}
						}
					}
				})
			});

			//DELETE KASIR
			$(document).on('click', '.btnDeleteKasir', function() {
				var id = $(this).data('id');

				$('.deleteKasirID').val(id);
				$('.id-kasir-hapus').text(id);
				$('#deleteKasirModal').modal('show');
			});

			$('#deleteKasir').submit(function(e) {
				e.preventDefault();

				var id = $('.deleteKasirID').val();
				var btn = $('.btn-delete');

				btn.html('<i class="fa fa-spin fa-spinner"></i> Menghapus...');

				$.ajax({
					method: 'POST',
					url: '<?php echo site_url('admin/passwords/api/delete_kasir'); ?>',
					data: {
						id: id
					},
					success: function(res) {
						if (res.code == 204) {
							btn.html('<i class="fa fa-check"></i> Terhapus!');

							setTimeout(() => {
								$('#deleteKasirModal').modal('hide');
								table_kasir.ajax.reload();
								btn.html('Hapus');
							}, 1500);
						}
						
					},
					error: function(xhr, ajaxOptions, thrownError) {
						btn.html('Gagal');
						setTimeout(() => {
								$('#deleteKasirModal').modal('hide');
								
							}, 1500);
					}
				})
			});




		});
	</script>
