<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <!-- Header -->
    <div class="header bg-secondary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 d-inline-block mb-0">Kelola Kategori Barang</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links ">
                  <li class="breadcrumb-item"><a href="<?php echo site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="<?php echo site_url('admin/products'); ?>">Barang</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Kategori</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="#"  data-toggle="modal" class="btn btn-sm btn-primary btn-addmodal">Tambah</a>
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
              <h3 class="mb-0">Kategori Barang</h3>
            </div>

            <div class="packageContainer">
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush" id="categoryList" style="width: 100%">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Id Kategori</th>
                    <th scope="col">Nama Kategori</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
               
              </table>
            </div>
          </div>
            
          </div>
        </div>
      </div>

<!-- //modal nambah kategori baru -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog modal-md" role="document">
      <div class="modal-content">
          <div class="modal-body p-0">
              <div class="card bg-secondary border-0 mb-0">
                  <div class="card-header bg-transparent">
                      <h3 class="card-heading text-center mt-2">Tambah Kategori</h3>
                  </div>
                  <div class="card-body px-lg-5 py-lg-5">
                      <form role="form" action="#" method="POST" id="addCategoryForm">

													<div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative disabled">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-book fa-4"></i></span>
                                  </div>
                                  <input name="id" class="form-control add-id" placeholder="Id Kategori " type="number">
                                </div>
                                <div class="text-danger err id-error"><small></small></div>
																<!-- <div class="text-danger id-error"></div> -->
                          </div>

                          <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="ni ni-box-2"></i></span>
                                  </div>
                                  <input name="name" class="form-control add-name" placeholder="Nama " type="text">
                                </div>
                                <div class="text-danger err name-error"><small></small></div>
                          </div>
                          
                          <div class="text-left">
                              <button type="button" class="btn btn-secondary my-4" data-dismiss="modal">Batal</button>
                          </div>
                          <div class="float-right" style="margin-top: -90px">
                            <button type="submit" class="btn btn-primary my-4 addCategoryBtn">Tambah</button>
                        </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
  <div class="modal-dialog modal-modal-dialog-centered modal-" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h6 class="modal-title" id="modal-title-default">Hapus Kategori</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
          </div>
          <form action="#" id="deleteCategory" method="POST">
        
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

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog modal-md" role="document">
      <div class="modal-content">
          <div class="modal-body p-0">
              <div class="card bg-secondary border-0 mb-0">
                  <div class="card-header bg-transparent">
                      <h3 class="card-heading text-center mt-2">Edit Kategori (Id: <span class='id-kategori-edit'></span>)</h3>
                  </div>
                  <div class="card-body px-lg-5 py-lg-5">
                      <form role="form" action="#" method="POST" id="editCategoryForm">
                        
                        <input type="hidden" name="id" value="" class="edit-id">
													
                          <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="ni ni-box-2"></i></span>
                                  </div>
                                  <input name="name" class="form-control edit-name" placeholder="Nama paket" type="text" >
                                </div>
                                <div class="text-danger err edit-name-error"><small></small></div>
                          </div>
                          
                          <div class="text-left">
                              <button type="button" class="btn btn-secondary my-4" data-dismiss="modal">Batal</button>
                          </div>
                          <div class="float-right" style="margin-top: -90px">
                            <button type="submit" class="btn btn-primary my-4 editPackageBtn">Simpan</button>
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
    $(document).on('click', '.btnDelete', function() {
      var id  = $(this).data('id');

      $('.deleteID').val(id);
      $('#deleteModal').modal('show');
    });

			//MENAMPILKAN DATA KATEGORI PADA TABEL
		var table = $('#categoryList').DataTable({
      "ajax" : "<?php echo site_url('admin/products/category_api?action=list'); ?>",
      "columns" : [
        {"data": "kat_id"},
        {"data": "kat_nama"},
        {"mRender": function (data, type, row) {
          return '<div class="text-right"><a href="#" data-id="'+row.kat_id+'" class="btn btn-warning btn-sm btnEdit"><i class="fa fa-edit"></i></a><a href="#" data-id="'+row.kat_id+'" class="btn btn-danger btn-sm btnDelete"><i class="fa fa-trash"></i></a></div>';}
        }
				//nama variabel yang digunakan adalah nama yang tertera di bagian "data", atau sama dengan nama kolom di tabel. Untuk ambil data per baris, tambah kata "row"
      ],
      "language" : {
        "search" : "Cari:",
        "lengthMenu" : "Menampilkan _MENU_ data",
        "info" : "Menampilkan _START_ sampai _END_ data dari _TOTAL_ data",
        "infoEmpty" : "Tidak ada data yang ditampilkan",
        "infoFiltered" : "(dari total _MAX_ data)",
        "zeroRecords" : "Tidak ada hasil pencarian ditemukan",
        "paginate": {
          "first":"&laquo;",
          "last":"&raquo;",
          "next":       "&rsaquo;",
          "previous":   "&lsaquo;"
        },
      }
    });

		//MENGEDIT KATEGORI, KITA PERLU DATA DARI KATEGORINYA UNTUK DITAMPILKAN
    $(document).on('click', '.btnEdit', function() {
			//data('id') didapat dari deklarasi "data-id" pada pembuatan datatables, tepatnya di bagian "mRender". disana ada atribut data-id=row.kat_id. kita ambil nilai id dari tabel dari database
      var id  = $(this).data('id');

      $.ajax({
        method: 'GET',
				//KITA MENGAMBIL DATA MENGGUNAKAN CATEGORY API UNTUK VIEW DATA. DATA YANG KITA PASS ADALAH "ID" SEBAGAI KUNCI UNTUK MENCARI DATA NANTINYA.
        url: '<?php echo site_url('admin/products/category_api?action=view_data'); ?>',
        data: {id: id},
        success: function(res) {
          if (res.data) {
            var d  = res.data;
						//RES DATA, ITU BERARTI DATA YANG DI AMBIL DARI DATABASE. GUNAKAN RES.NAMA_KOLOM DI DATABASE UNTUK MENGAMBIL DATA
            $('.edit-id').val(d.kat_id);
            $('.edit-name').val(d.kat_nama);
						$('.id-kategori-edit').text(d.kat_id);
            
            $('#editModal').modal('show');
          }
        }
      });
    });

		//EDIT KATEOGRI
    $('#editCategoryForm').submit(function(e) {
      e.preventDefault();

      var btn = $('.editPackageBtn');
      var id = $('.edit-id').val();
      var data = $(this).serialize();
      btn.html('<i class="fa fa-spin fa-spinner"></i> Menyimpan...').attr('disabled', true);

      $('.err').empty();
      $.ajax({
        method: 'POST',
        url: '<?php echo site_url('admin/products/category_api?action=edit_category'); ?>',
        data: data,
        success: function (res) {
          if (res.code == 201) {
            btn.html('<i class="fa fa-check"></i> Berhasil').removeAttr('disabled');

            setTimeout(() => {
              $('#editModal').modal('hide');
              table.ajax.reload();
              btn.html('Simpan');
            }, 1500);
          }else if(res.code ==409){
            btn.html('Simpan').removeAttr('disabled');
            if(res.name_error){
								$('.edit-name-error').append(res.name_error);
							}
          }
        }
      })
    });

		//MENGAHAPUS KATEGORI
    $('#deleteCategory').submit(function(e) {
      e.preventDefault();

      var id = $('.deleteID').val();
      var btn = $('.btn-delete');

      btn.html('<i class="fa fa-spin fa-spinner"></i> Menghapus...');

      $.ajax({
        method: 'POST',
        url: '<?php echo site_url('admin/products/category_api?action=delete_category'); ?>',
        //DIAMBIL DARI DATA DI BAWAH (BAGIAN MENAMPILKAN TABEL) . data-id dari penampilan tabel di bawah kemudian di pass ke struktur html di atas (atribut name sbg penentu penyimpan datanya). kemudian, ambil datanya dengan deklarasi variabel di dalam scope delete category ini.

				data: {
            id: id
        },
        success: function (res) {
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

		//menampilkan id terakhir+1 pada penambahnan kategori baru
		$(document).on('click', '.btn-addmodal', function() {
      //mendapatkan id kategori terakhir
      $.ajax({
        method: 'GET',
				//KITA MENGAMBIL DATA MENGGUNAKAN CATEGORY API UNTUK VIEW DATA. DATA YANG KITA PASS ADALAH "ID" SEBAGAI KUNCI UNTUK MENCARI DATA NANTINYA.
        url: '<?php echo site_url('admin/products/category_api?action=last_id'); ?>',
        success: function(res) {
          if (res.data) {
            var d  = res.data;
						//RES DATA, ITU BERARTI DATA YANG DI AMBIL DARI DATABASE. GUNAKAN RES.NAMA_KOLOM DI DATABASE UNTUK MENGAMBIL DATA
            $('.add-id').val(parseInt(d.kat_id)+1);
						$('#addModal').modal('show');
          }
        }
      });
    });

		//MENAMBAH KATEGORI BARU
    $('#addCategoryForm').submit(function(e) {
      e.preventDefault();

      var data = $(this).serialize();
      var btn = $('.addCategoryBtn');

      btn.html('<i class="fa fa-spin fa-spinner"></i> Menambah...');
      $('.err').empty();

      $.ajax({
        method: 'POST',
        url: '<?php echo site_url('admin/products/category_api?action=add_category'); ?>',
        data: data,
        context: this,
        success: function(res) {
					if (res.data) {
            btn.html('<i class="fa fa-check"></i> Berhasil!');

            setTimeout(function() {
              $('#addCategoryForm .form-control').val(null);
              btn.html('Tambah');
            }, 2000);
            setTimeout(() => {
              $('#addModal').modal('hide');

							// //keypressed di bawah
							// is_add_cat_modal_shown = false;
            }, 2222);

            table.ajax.reload();
          } else if (res.code == 409) {
            	// toastr.error(res.message);

							if(res.id_error){
								$('.id-error').append(res.id_error);
							}
							if(res.name_error){
								$('.name-error').append(res.name_error);
							}
							// if(res.name_error){
							// 	$('.name-error').append(res.name_error);
							// }
							//TAMPILKAN DATA YANG SEBELUMNYA DIINPUT MESKIPUN ERROR
							

							//KALAU MAU MENGHAPUS SEMUA DATA YANG ADA DI FORM
              // $('#addCategoryForm .form-control').val(null);
              btn.html('Tambah');
      
          }
        },
        error: function(xhr, ajaxOptions, thrownError) {
          btn.html('Tambah');

          var errors = xhr.responseJSON.errors;

          $.each(errors, function(keys, val) {
            $.each(val, function(key, val) {
              $('.'+ keys +'-error').text(val);
            });
          });
        }
      })
    })

		// KEYPRESSED
		let is_add_cat_modal_shown = false;
		$(document).keydown(function(e) {

			//ALT+T
			if (e.which == 84 && e.altKey) {
				if(!is_add_cat_modal_shown){
					$('#addModal').modal('show');	
					is_add_cat_modal_shown = true;
				}else{
					$('#addModal').modal('hide');	
					is_add_cat_modal_shown = false;
				}
			}
			if (e.which == 68 && e.altKey) {
				
			}
		});
  });
</script>
