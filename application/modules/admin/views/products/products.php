<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <!-- Header -->
    <div class="header bg-secondary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 d-inline-block mb-0">Kelola Data Barang</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links ">
                  <li class="breadcrumb-item"><a href="<?php echo site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
									<li class="breadcrumb-item active" aria-current="page">Barang</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
							<a href="#" data-target="#addModal" data-toggle="modal" class="btn btn-sm btn-primary btn-add-modal">Tambah</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Barang</h3>
            </div>
						<div class="packageContainer">
							<!-- Light table -->
							<div class="table-responsive">
								<table class="table align-items-center table-flush" id="productList" style="width: 100%">
									<thead class="thead-light">
										<tr>
											<th scope="col"></th>
											<th scope="col">ID</th>
											<th scope="col">Nama Barang</th>
											<th scope="col">Stok</th>
											<th scope="col">Kategori</th>
											<th scope="col"></th>
										</tr>
									</thead>
								
								</table>
							</div>
						</div>  
          </div>
        </div>
				<div class="col-md-4">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Kategori</h3>
            </div>
						<div class="card-header border-0 mt--4">
              	<!-- //OPSI PENGUBAH -->
								<select name="kategori" class="form-control select2" id="kategori">
									<option value=""></option>
									<?php foreach ($categories as $category) : ?>
										<option value="<?php echo $category->kat_id?>"><?php echo $category->kat_nama?></option>
									<?php endforeach; ?>
								</select> 
            </div>
						<h4 class="mx-auto">atau</h4>
						<div class="categoryContainer">
							<!-- <div class="col-lg-6 mx-auto" id="events">

							</div> -->
							<div class="table-responsive">
								<table class="table align-items-center table-flush" id="categoryList" style="width: 100%;" > <!-- style="width: 100%; margin:0px auto; max-height:100px" -->
									<thead class="thead-light">
										<tr>
											<th scope="col">ID</th>
											<th scope="col">Nama Kategori</th>
										</tr>
									</thead>
								
								</table>
							</div>
						</div>
            
          </div>
        </div>
      </div>

<!-- MODAL TAMBAH BARANG -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog modal-md" role="document">
      <div class="modal-content">
          <div class="modal-body p-0">
              <div class="card bg-secondary border-0 mb-0">
                  <div class="card-header bg-transparent">
                      <h3 class="card-heading text-center mt-2">Tambah Barang</h3>
                  </div>
                  <div class="card-body px-lg-5 py-lg-5">
                      <form role="form" action="#" method="POST" id="addProductForm">

													<div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative  add-id-div">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-list-ol fa-4"></i></span>
                                  </div>
                                  <input name="id" class="form-control add-id" placeholder="Id Barang" type="number" >
                                  <!-- <a href="#" class="btn btn-sm btn-outline-primary btn-cekid my-auto mx-3">Cek Id</a> -->
                                </div>
                                
                                <div class="text-danger err id-error"></div>
                          </div>

													<div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="ni ni-box-2"></i></span>
                                  </div>
                                  <input name="nama" class="form-control nama-barang" placeholder="Nama Barang" type="text"  autofocus>
                                </div>
                                <div class="text-danger err nama-error"></div>
                          </div>
													<div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative add-idkat-div">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-book fa-4"></i></span>
                                  </div>
																	<select name="idkat" id="idkat" class='form-control add-idkat select2' placeholder="Id Kategori">
																		<option value="" disabled selected>Pilih Kategori Barang</option>
																		<?php foreach ($categories as $category) : ?>
																			<option value="<?php echo $category->kat_id?>">
																				<?php echo $category->kat_nama?>
																			</option>
																		<?php endforeach; ?>
																	</select> 
                                </div>
                                <div class="text-danger err idkat-error"></div>
                          </div>
													<div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-cubes fa-4"></i></span>
                                  </div>
                                  <input name="stok" class="form-control" placeholder="Stok Barang" type="number" >
                                </div>
                                <div class="text-danger err stok-error"></div>
                          </div>
													<div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-puzzle-piece fa-4"></i></span>
                                  </div>
                                  <input name="satuan" class="form-control" placeholder="Satuan Barang" type="text" minlength="2" maxlength="100" oninvalid="this.setCustomValidity('Satuan barang minimal 2 huruf')" oninput="this.setCustomValidity('')">
                                </div>
                                <div class="text-danger err satuan-error"></div>
                          </div>
													<div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-dollar-sign fa-4"></i></span>
                                  </div>
                                  <input name="hargadasar" class="form-control" placeholder="Harga Dasar Barang" type="number" >
                                </div>
                                <div class="text-danger err hargadasar-error"></div>
                          </div>
													<div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-money-bill-alt fa-4"></i></span>
                                  </div>
                                  <input name="hargajual" class="form-control" placeholder="Harga Jual Barang" type="number" >
                                </div>
                                <div class="text-danger err hargajual-error"></div>
                          </div>
													<!-- <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa- fa-4"></i></span>
                                  </div>
																	<select name="idsup" id="idsup" class='form-control add-idsup select2' placeholder="Id Supplier" required>
																		<option value="" disabled selected>Pilih Supplier Barang</option>
																		<?php //foreach ($suppliers as $supplier) : ?>
																			<option value="<?php //echo $supplier->sup_id?>" 
																			<?php // echo ($supplier->sup_id==$idsup_val ? 'selected' : ''); ?>
																			>
																				<?php //echo $supplier->sup_perusahaan?>
																			</option>
																		<?php //endforeach; ?>
																	</select> 
                                </div>
                                <div class="text-danger err idsup-error"></div>
                          </div> -->
										
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


<!-- MODAL TESTING Barang -->
<!-- <div class="modal fade" id="testModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog modal-md" role="document">
      <div class="modal-content">
          <div class="modal-body p-0">
              <div class="card bg-secondary border-0 mb-0">
                  <div class="card-header bg-transparent">
                      <h3 class="card-heading text-center mt-2">TESTING Barang</h3>
                  </div>
                  <div class="card-body px-lg-5 py-lg-5">
                      <form role="form" action="#" method="POST" id="addProductForm">

													<div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa- fa-4"></i></span>
                                  </div>
                                  <input name="id_test" class="form-control id-test" placeholder="Id Barang" type="number" >
                                </div>
                                <div class="text-danger err id-error"></div>
                          </div>

													<div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa- fa-4"></i></span>
                                  </div>
                                  <input name="nama_test" class="form-control nama-test" placeholder="Nama Barang" type="text" >
                                </div>
                                <div class="text-danger err nama-error"></div>
                          </div>
													<div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa- fa-4"></i></span>
                                  </div>
																	<select name="idkat_test" id="idkat" class='form-control idkat-test select2' placeholder="Id Kategori" required>
																		<option value="" disabled selected>Pilih Kategori Barang</option>
																		<?php //foreach ($categories as $category) : ?>
																			<option value="<?php //echo $category->kat_id?>" 
																			<?php // echo ($supplier->sup_id==$idsup_val ? 'selected' : ''); ?>
																			>
																				<?php //echo $category->kat_nama?>
																			</option>
																		<?php //endforeach; ?>
																	</select> 
                                </div>
                                <div class="text-danger err idkat-error"></div>
                          </div>
													<div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa- fa-4"></i></span>
                                  </div>
                                  <input name="stok_test" class="form-control stok-test" placeholder="Stok Barang" type="number" >
                                </div>
                                <div class="text-danger err stok-error"></div>
                          </div>
													<div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa- fa-4"></i></span>
                                  </div>
                                  <input name="satuan_test" class="form-control satuan-test" placeholder="Satuan Barang" type="text" >
                                </div>
                                <div class="text-danger err satuan-error"></div>
                          </div>
													<div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa- fa-4"></i></span>
                                  </div>
                                  <input name="hargadasar_test" class="form-control hargadasar_test" placeholder="Harga Dasar Barang" type="number" >
                                </div>
                                <div class="text-danger err hargadasar-error"></div>
                          </div>
													<div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa- fa-4"></i></span>
                                  </div>
                                  <input name="hargajual_test" class="form-control hargajual_test" placeholder="Harga Jual Barang" type="number" >
                                </div>
                                <div class="text-danger err hargajual-error"></div>
                          </div>
													<div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa- fa-4"></i></span>
                                  </div>
																	<select name="idsup_test" id="idsup" class='form-control idsup-test select2' placeholder="Id Supplier" required>
																		<option value="" disabled selected>Pilih Supplier Barang</option>
																		<?php //foreach ($suppliers as $supplier) : ?>
																			<option value="<?php //echo $supplier->sup_id?>" 
																			<?php // echo ($supplier->sup_id==$idsup_val ? 'selected' : ''); ?>
																			>
																				<?php //echo $supplier->sup_perusahaan?>
																			</option>
																		<?php //endforeach; ?>
																	</select> 
                                </div>
                                <div class="text-danger err idsup-error"></div>
                          </div>
										
                          <div class="text-left">
                              <button type="button" class="btn btn-secondary my-4" data-dismiss="modal">Batal</button>
                          </div>
                          <div class="float-right" style="margin-top: -90px">
                            <button type="submit" class="btn btn-primary my-4 testProductBtn">Tambah</button>
                        </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div> -->

<!-- MODAL EDIT BARANG -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog modal-md" role="document">
      <div class="modal-content">
          <div class="modal-body p-0">
              <div class="card bg-secondary border-0 mb-0">
                  <div class="card-header bg-transparent">
                      <h3 class="card-heading text-center mt-2">Edit Barang</h3>
                  </div>
                  <div class="card-body px-lg-5 py-lg-5">
                      <form role="form" action="#" method="POST" id="editCategoryForm">
                        
                        <input type="hidden" name="id" value="" class="edit-id">
								
                          <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="ni ni-box-2"></i></span>
                                  </div>
                                  <input name="nama" class="form-control edit-nama" placeholder="Nama Barang" type="text" >
                                </div>
                                <div class="text-danger err edit-nama-error"></div>
                          </div>
													<div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-book fa-4"></i></span>
                                  </div>
																	<!-- //LIST KATEGORI -->
																	<select name="idkat" id="idkat" class='form-control edit-idkat select2' placeholder="Id Kategori" disabled>
																		<?php foreach ($categories as $category) : ?>
																			<option value="<?php echo $category->kat_id?>" >
																				<?php echo $category->kat_nama?>
																			</option>
																		<?php endforeach; ?>
																	</select> 
                                </div>
                                <div class="text-danger err edit-idkat-error"></div>
                          </div>
													<div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-cubes fa-4"></i></span>
                                  </div>
                                  <input name="stok" class="form-control edit-stok" placeholder="Stok Barang" type="number" >
                                </div>
                                <div class="text-danger err edit-stok-error"></div>
                          </div>
													<div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-puzzle-piece fa-4"></i></span>
                                  </div>
                                  <input name="satuan" class="form-control edit-satuan" placeholder="Satuan Barang" type="text" >
                                </div>
                                <div class="text-danger err edit-satuan-error"></div>
                          </div>
													<div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-dollar-sign fa-4"></i></span>
                                  </div>
                                  <input name="hargadasar" class="form-control edit-hargadasar" placeholder="Harga Dasar Barang" type="number" >
                                </div>
                                <div class="text-danger err edit-hargadasar-error"></div>
                          </div>
													<div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-money-bill-alt fa-4"></i></span>
                                  </div>
                                  <input name="hargajual" class="form-control edit-hargajual" placeholder="Harga Jual Barang" type="number" >
                                </div>
                                <div class="text-danger err edit-hargajual-error"></div>
                          </div>
													<!-- <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa- fa-4"></i></span>
                                  </div>
																	<select name="idsup" id="idsup" class='form-control edit-idsup select2' placeholder="Id Supplier" required>
																		<?php //foreach ($suppliers as $supplier) : ?>
																			<option value="<?php //echo $supplier->sup_id?>" 
																			<?php // echo ($supplier->sup_id==$idsup_val ? 'selected' : ''); ?>
																			>
																				<?php //echo $supplier->sup_perusahaan?>
																			</option>
																		<?php //endforeach; ?>
																	</select> 
                                </div>
                                <div class="text-danger err idsup-error"></div>
                          </div>
											 -->
                          <div class="text-left">
                              <button type="button" class="btn btn-secondary my-4" data-dismiss="modal">Batal</button>
                          </div>
                          <div class="float-right" style="margin-top: -90px">
                            <button type="submit" class="btn btn-primary my-4 editProductBtn">Simpan</button>
                        </div>
                      </form>
                  </div>
              </div>
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

<link href="<?php echo get_theme_uri('vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css', 'argon'); ?>" rel="stylesheet">

<script src="<?php echo get_theme_uri('vendor/datatables.net/js/jquery.dataTables.min.js', 'argon'); ?>"></script>
<script src="<?php echo get_theme_uri('vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js', 'argon'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables.lang.js'); ?>"></script>


<!-- Script untuk select datatables -->
<script src="<?php echo get_theme_uri('vendor/datatables.net-select/js/dataTables.select.min.js', 'argon'); ?>"></script>
<script src="<?php echo get_theme_uri('vendor/datatables.net-select-bs4/js/select.bootstrap4.min.js', 'argon'); ?>"></script>
<link href="<?php echo get_theme_uri('vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css', 'argon'); ?>" rel="stylesheet">

<script>
	// FUNGSI UNTUK MENAMPILKAN DETAIL TABLE
	function format_rp(x) {
    return "Rp"+x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
	}
	function format ( d ) {
    // `d` is the original data object for the row
		// var x = d.brg_hargadasar; //bisa juga ngedeklarasiin variabel sebelum di return

    var output = '<table width="100%" style="border-radius:45px; border:1px solid #ccc;">'+
        '<tr>'+
            '<td style="font-weight:bold">Harga Dasar:</td>'+
            '<td>'+format_rp(d.brg_hargadasar)+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td style="font-weight:bold">Harga Jual:</td>'+
            '<td>'+format_rp(d.brg_hargajual)+'</td>'+
        '</tr>'+
				'</table>';

    return output;
	}
	//ajax menampilkan id terakhir+1 pada penambahnan kategori baru
  function get_last_product_id(kat_id) {
    $.ajax({
        method: 'GET',
        url: '<?php echo site_url('admin/products/product_api?action=last_product_id'); ?>',
				data: {kat_id: kat_id},
        success: function(res) {
          if (res.data) {
            var d  = res.data;
            $('.add-id').val(parseInt(d.brg_id)+1);
						$('.add-id-div').addClass('disabled');
						$('.add-idkat-div').addClass('disabled');
          }else{	
						$('.add-id').val(kat_id+'001');
						$('.add-id-div').addClass('disabled');
						$('.add-idkat-div').addClass('disabled');
					}
        }
      });
  }

	//mengatur jumlah paginasi di tabel
	$.fn.DataTable.ext.pager.numbers_length = 5;

  $(document).ready(function() {
		
		//TESTING FETHC DATA
		// $(document).on('input', '.id-test', function() {
		// 	//data('id') didapat dari deklarasi "data-id" pada pembuatan datatables, tepatnya di bagian "mRender". disana ada atribut data-id=row.kat_id. kita ambil nilai id dari tabel dari database
    //   var id  = $(this).val();
			
    //   $.ajax({
    //     method: 'GET',
    //     url: '<?php //echo site_url('admin/products/product_api?action=view_data'); ?>',
    //     data: {id: id},
    //     success: function(res) {
    //       if (res.data) {
    //         var d  = res.data;
		// 				$('.idkat-test').val(d.brg_idkat);
    //         $('.nama-test').val(d.brg_nama);
    //         $('.stok-test').val(d.brg_stok);
		// 				$('.satuan-test').val(d.brg_satuan);
		// 				$('.hargadasar-test').val(d.brg_hargadasar);
		// 				$('.hargajual-test').val(d.brg_hargajual);
		// 				$('.idsup-test').val(d.brg_idsup);

    //       }
    //     }
    //   });
    // });

		//MENAMPILKAN DATA KATEGORI PADA TABEL
		var table = $('#productList').DataTable({
      "ajax" : "<?php echo site_url('admin/products/product_api?action=list'); ?>",
      "columns" : [
				{
					"className":      'details-control',
					"orderable":      false,
					"data":           null,
					"defaultContent": ''
        },
        {"data": "brg_id"},
        {"data": "brg_nama"},
				{"mRender": function (data, type, row) {
          return row.brg_stok+' '+row.brg_satuan;}
        },
				// {"data": "brg_hargadasar"},
				// {"data": "brg_hargajual"},
				// {"data": "sup_perusahaan"},
				{"data": "kat_nama"},
				{"mRender": function (data, type, row) {
          return '<div class="text-right"><a href="#" data-id="'+row.brg_id+'" class="btn btn-warning btn-sm btnEdit"><i class="fa fa-edit"></i></a><a href="#" data-id="'+row.brg_id+'" class="btn btn-danger btn-sm btnDelete"><i class="fa fa-trash"></i></a></div>';}
        }
				//nama variabel yang digunakan adalah nama yang tertera di bagian "data", atau sama dengan nama kolom di tabel. Untuk ambil data per baris, tambah kata "row"
      ],
			//limitasi tampilan
			"lengthMenu": [5, 10, 25, 50, 100],
      "pageLength": 5,
			"pagingType" : "simple_numbers",
			// "pagingType": $(window).width() < 768 ? "simple" : "simple_numbers",
			//indeks kolom dimulai dari 0
			"order": [[1, 'asc']],
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
      },
			// initComplete: function() {
			// 	this.api().column(2).data().unique().sort().each(function(d, j) {
			// 		nama_brg.push(d);
			// 	});
			// }
    });


		// Add event listener for opening and closing details
		$('#productList tbody').on('click', 'td.details-control', function () {
			var tr = $(this).closest('tr');
			var row = table.row(tr);

			if ( row.child.isShown() ) {
					// This row is already open - close it
					row.child.hide();
					tr.removeClass('shown');
			}
			else {
					// Open this row
					row.child(format(row.data()) ).show();
					tr.addClass('shown');
			}
    });

		//MENGEDIT BARANG,
    $(document).on('click', '.btnEdit', function() {
			//data('id') didapat dari deklarasi "data-id" pada pembuatan datatables, tepatnya di bagian "mRender". disana ada atribut data-id=row.kat_id. kita ambil nilai id dari tabel dari database
      var id  = $(this).data('id');
			
      $.ajax({
        method: 'GET',
        url: '<?php echo site_url('admin/products/product_api?action=view_data'); ?>',
        data: {id: id},
        success: function(res) {
          if (res.data) {
            var d  = res.data;
            $('.edit-id').val(d.brg_id);
						$('.edit-idkat').val(d.brg_idkat);
            $('.edit-nama').val(d.brg_nama);
            $('.edit-stok').val(d.brg_stok);
						$('.edit-satuan').val(d.brg_satuan);
						$('.edit-hargadasar').val(d.brg_hargadasar);
						$('.edit-hargajual').val(d.brg_hargajual);
						$('.edit-idsup').val(d.brg_idsup);

            $('#editModal').modal('show');
          }
        }
      });
    });

		//BUKA EDIT BARANG
    $('#editCategoryForm').submit(function(e) {
      e.preventDefault();
			$('.edit-idkat').removeAttr("disabled");

      var btn = $('.editProductBtn');
			
      var id = $('.edit-id').val();
      var data = $(this).serialize();
      btn.html('<i class="fa fa-spin fa-spinner"></i> Menyimpan...').attr('disabled', true);

      $.ajax({
        method: 'POST',
        url: '<?php echo site_url('admin/products/product_api?action=edit_product'); ?>',
				//data ini mengacu pada data pada form dengan bantuan penggunaan atribut "name" pada element tsb
        data: data,
        success: function (res) {
          if (res.code == 201) {
            btn.html('<i class="fa fa-check"></i> Berhasil').removeAttr('disabled');

            setTimeout(() => {
              $('#editModal').modal('hide');
              table.ajax.reload();
              btn.html('Simpan');
            }, 1500);
          }else if(res.code = 409){
            btn.html('Simpan').removeAttr('disabled');
            if(res.nama_error){
                $('.edit-nama-error').append(res.nama_error);
            }
						if(res.satuan_error){
								$('.edit-satuan-error').append(res.satuan_error);
						}   
						if(res.idkat_error){
								$('.edit-idkat-error').append(res.idkat_error);
						}
          }
        }
      })

			$('.edit-idkat').prop("disabled","disabled");
    });

		//MENGAHAPUS BARANG
		$(document).on('click', '.btnDelete', function() {
      var id  = $(this).data('id');

      $('.deleteID').val(id);
      $('#deleteModal').modal('show');
    });

    $('#deleteProduct').submit(function(e) {
      e.preventDefault();

      var id = $('.deleteID').val();
      var btn = $('.btn-delete');

      btn.html('<i class="fa fa-spin fa-spinner"></i> Menghapus...');

      $.ajax({
        method: 'POST',
        url: '<?php echo site_url('admin/products/product_api?action=delete_product'); ?>',
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


		//MENAMPILKAN ID TERAKHIR DARI BARANG TERPILIH
		//menampilkan id terakhir+1 pada penambahnan kategori baru
		$(document).on('change', '.add-idkat', function() {
			var kat_id = $(this).val();
     
      get_last_product_id(kat_id);

    });

		//MENAMBAH BARANG BARU
    $('#addProductForm').submit(function(e) {
      e.preventDefault();

      var data = $(this).serialize();
      var btn = $('.addProductBtn');

      btn.html('<i class="fa fa-spin fa-spinner"></i> Menambah...');
      $('.err').empty();
			// alert(data)
      $.ajax({
        method: 'POST',
        url: '<?php echo site_url('admin/products/product_api?action=add_product'); ?>',
        data: data,
        context: this,
        success: function(res) {
          if (res.data) {
            btn.html('<i class="fa fa-check"></i> Berhasil!');

            setTimeout(function() {
              $('#addProductForm .form-control').val(null);
              btn.html('Tambah');
            }, 2000);
            setTimeout(() => {
              $('#addModal').modal('hide');
            }, 2222);

            table.ajax.reload();

          } 
					else if(res.code == 409){

						if(res.id_error){
								$('.id-error').append(res.id_error);
						}
            if(res.nama_error){
								$('.nama-error').append(res.nama_error);
						}
						if(res.satuan_error){
								$('.satuan-error').append(res.satuan_error);
						}   
						if(res.idkat_error){
								$('.idkat-error').append(res.idkat_error);
						}

						//KALAU MAU MENGHAPUS SEMUA DATA YANG ADA DI FORM
						// $('#addProductForm .form-control').val(null);
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
		
		//select2
		$('#kategori').select2({
			placeholder:  "Pilih kategori barang",
			theme: 'bootstrap4',
			scrollAfterSelect: 'true',
		});

		// $('#idsup').select2({
		// 	placeholder: "Pilih supplier barang",
		// 	theme: 'bootstrap4',
		// 	scrollAfterSelect: 'true',
		// });

		$('#kategori').on('change', function() 
		{
			var kat_id = $('#kategori').val();
			
			//ubah data yang ditampilkan sesuai kategori
			table.ajax.url("<?php echo site_url('admin/products/product_api?action=list_by_cat&kat_id='); ?>"+kat_id).load();
			table2.rows().deselect();

			//di modal add item, id-kat secara otomatis terisi dengan x angka id kategori + y angka id terakhir dari kategori tsb di dalam database. selain itu, kategorinya juga scr otomatis terpilih
			$('.add-idkat').val(kat_id);
			
			//menampilkan id terakhir dari kategori tersebuts
			get_last_product_id(kat_id);

			//buka modal add kategori
			$('#addModal').modal('show');
		
		});

		//category table
		//MENAMPILKAN DATA KATEGORI PADA TABEL
		var table2 = $('#categoryList').DataTable({
			"dom": 'Brt',
			"select": true,
			// scrollabel
			"scrollY":       	"305.5px", //"286.8px"
			"scrollCollapse": true,
			"paging":         false,
			//end scrollable
      "ajax" : "<?php echo site_url('admin/products/category_api?action=list'); ?>",
      "columns" : [
        {"data": "kat_id"},
        {"data": "kat_nama"},
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
        }
      }
    });

		//menampilkan data dari bari terplih ke tabel
		// var events = $('#events'); //untuk testing apakah data yang diambil benar/tidak
		var tdata, old_tdata, temp;
		table2.on('click', function(){
			setTimeout(() => {
				tdata = table2.rows( { selected: true } ).data()[0];

				if(old_tdata==tdata){
					return false;
				}
				else if(tdata){
					// events.prepend( '<div>'+tdata['kat_id']+':'+tdata['kat_nama']+tdata+'</div>' );
					table.ajax.url("<?php echo site_url('admin/products/product_api?action=list_by_cat&kat_id='); ?>"+tdata['kat_id']).load();

					//kosongkan bagian yang via select2
					$('#kategori').prop('selectedIndex',0);
					old_tdata=tdata;

					//di modal add item, id-kat secara otomatis terisi dengan x angka id kategori + y angka id terakhir dari kategori tsb di dalam database. selain itu, kategorinya juga scr otomatis terpilih
					$('.add-idkat').val(tdata['kat_id']);

					//menampilkan id terakhir dari kategori tersebuts
					get_last_product_id(tdata['kat_id']);


					//buka modal add kategori
					$('#addModal').modal('show');
				
				}
				
			}, 0);
		});

		// KEYPRESSED
		$(document).keydown(function(e) {
			
			// ALT+T
			if (e.which == 84 && e.altKey) {
				$('#addModal').modal('show');	
			}
			if (e.which == 13 && e.altKey) {
				$('.addProductBtn').click();
			}
		});


  });
</script>

