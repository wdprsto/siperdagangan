<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Header -->
<div class="header bg-secondary pb-6">
	<div class="container-fluid">
		<div class="header-body">
			<div class="row align-items-center py-4">
				<div class="col-lg-6 col-7">
					<h6 class="h2 d-inline-block mb-0">Ubah Harga Barang</h6>
					<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
						<ol class="breadcrumb breadcrumb-links ">
							<li class="breadcrumb-item"><a href="<?php echo site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item active" aria-current="page">Barang</li>
						</ol>
					</nav>
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
									<th scope="col">ID</th>
									<th scope="col">Nama Barang</th>
									<th scope="col">Harga Dasar (Rp.)</th>
									<th scope="col">Harga Jual (Rp.)</th>
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
							<option value="<?php echo $category->kat_id ?>"><?php echo $category->kat_nama ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<h4 class="mx-auto">atau</h4>
				<div class="categoryContainer">
					<!-- <div class="col-lg-6 mx-auto" id="events">

							</div> -->
					<div class="table-responsive">
						<table class="table align-items-center table-flush" id="categoryList" style="width: 100%;">
							<!-- style="width: 100%; margin:0px auto; max-height:100px" -->
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

	<link href="<?php echo get_theme_uri('vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css', 'argon'); ?>" rel="stylesheet">

	<script src="<?php echo get_theme_uri('vendor/datatables.net/js/jquery.dataTables.min.js', 'argon'); ?>"></script>
	<script src="<?php echo get_theme_uri('vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js', 'argon'); ?>"></script>
	<script src="<?php echo base_url('assets/plugins/datatables.lang.js'); ?>"></script>


	<!-- Script untuk select datatables -->
	<script src="<?php echo get_theme_uri('vendor/datatables.net-select/js/dataTables.select.min.js', 'argon'); ?>"></script>
	<script src="<?php echo get_theme_uri('vendor/datatables.net-select-bs4/js/select.bootstrap4.min.js', 'argon'); ?>"></script>
	<link href="<?php echo get_theme_uri('vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css', 'argon'); ?>" rel="stylesheet">

	<!-- EDITABLE -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php //echo base_url('assets/plugins/bootstrap-editable/bootstrap-editable.css'); 
																										?>"> -->
	<!-- <script src="<?php //echo base_url('assets/plugins/bootstrap-editable/bootstrap-editable.js'); 
										?>"></script> -->

	<script>
		// FUNGSI UNTUK MENAMPILKAN DETAIL TABLE
		function format_rp(x) {
			return "Rp" + x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		}
		
		function ajax_editable(id, name, val) {
			$.ajax({
				method: 'POST',
				url: '<?php echo site_url('admin/products/api_ubah_harga'); ?>',
				//data ini mengacu pada data pada form dengan bantuan penggunaan atribut "name" pada element tsb
				data: {
					id: id,
					name: name,
					val: val
				},
				success: function(res) {
					// if (res.code == 201) {
					// 	alert(res);
					// }
				}
			});
		}
		//mengatur jumlah paginasi di tabel
		$.fn.DataTable.ext.pager.numbers_length = 5;

		$(document).ready(function() {

			//MENAMPILKAN DATA KATEGORI PADA TABEL
			var table = $('#productList').DataTable({
				"ajax": "<?php echo site_url('admin/products/product_api?action=list'); ?>",
				"columns": [{
						"data": "brg_id"
					},
					{
						"data": "brg_nama"
					},
					// {
					// 	"mRender": function(data, type, row) {
					// 		return row.brg_stok + ' ' + row.brg_satuan;
					// 	}
					// },
					// {"data": "brg_hargadasar"},
					// {"data": "brg_hargajual"},
					// {
					// 	"className": 'harga harga_dasar editable editable-click',
					// 	"data": "brg_hargadasar"
					// },
					// {
					// 	"className": 'harga harga_jual editable editable-click',
					// 	"data": "brg_hargajual"
					// },
					{
						"mRender": function(data, type, row) {
							let alert = 'Harga dasar harus lebih besar dari 0 dan tidak boleh negatif';
							return "<a href='#/' class='harga harga_dasar d-inline' >" + row.brg_hargadasar + "</a>" +
								'<div class="d-none">' +

								'<div class="editable-input parent_ubah_harga" style="position: relative;">' +
								'<form class="form-ubah-barang"><input name="harga_dasar" type="number" data-type="text" data-id="' + row.brg_id + '" data-name="harga_dasar"  class="form-control input-sm ubah_harga_dasar" style="padding-right: 24px;" value="' + row.brg_hargadasar + '" min="0" oninvalid="this.setCustomValidity(\''+alert+'\')"></form>' +
								'</div>' +
								'<div class="editable-error-block help-block" style="display: none;"></div>' +

								'</span>';
						}
					},
					{
						"mRender": function(data, type, row) {
							let alert = 'Harga jual harus lebih besar dari 0 dan tidak boleh negatif';
							return "<a href='#/' class='harga harga_jual d-inline' >" + row.brg_hargajual + "</a>" +
								'<div class="d-none">' +

								'<div class="editable-input parent_ubah_harga" style="position: relative;">' +
								'<form class="form-ubah-barang"><input name="harga_jual" type="number" data-type="text" data-id="' + row.brg_id + '" data-name="harga_jual"  class="form-control input-sm ubah_harga_jual" style="padding-right: 24px;" value="' + row.brg_hargajual + '" min="0" oninvalid="this.setCustomValidity(\''+alert+'\')"></form>' +
								'</div>' +
								'<div class="editable-error-block help-block" style="display: none;"></div>' +

								'</span>';
						}
					},

				],
				//limitasi tampilan
				"lengthMenu": [5, 10, 25, 50, 100],
				"pageLength": 5,
				"pagingType": "simple_numbers",
				// "pagingType": $(window).width() < 768 ? "simple" : "simple_numbers",
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
				},
				// initComplete: function() {
				// 	this.api().column(2).data().unique().sort().each(function(d, j) {
				// 		nama_brg.push(d);
				// 	});
				// }
			});


			// Add event listener for opening and closing details
			$('#productList tbody').on('click', 'td.details-control', function() {
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


			//select2
			$('#kategori').select2({
				placeholder: "Pilih kategori barang",
				theme: 'bootstrap4',
				scrollAfterSelect: 'true',
			});

			// $('#idsup').select2({
			// 	placeholder: "Pilih supplier barang",
			// 	theme: 'bootstrap4',
			// 	scrollAfterSelect: 'true',
			// });

			$('#kategori').on('change', function() {
				var kat_id = $('#kategori').val();

				//ubah data yang ditampilkan sesuai kategori
				table.ajax.url("<?php echo site_url('admin/products/product_api?action=list_by_cat&kat_id='); ?>" + kat_id).load();
				table2.rows().deselect();

			});

			//category table
			//MENAMPILKAN DATA KATEGORI PADA TABEL
			var table2 = $('#categoryList').DataTable({
				"dom": 'Brt',
				"select": true,
				// scrollabel
				"scrollY": "305.5px", //"286.8px"
				"scrollCollapse": true,
				"paging": false,
				//end scrollable
				"ajax": "<?php echo site_url('admin/products/category_api?action=list'); ?>",
				"columns": [{
						"data": "kat_id"
					},
					{
						"data": "kat_nama"
					},
					//nama variabel yang digunakan adalah nama yang tertera di bagian "data", atau sama dengan nama kolom di tabel. Untuk ambil data per baris, tambah kata "row"
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
					}
				}
			});

			//menampilkan data dari bari terplih ke tabel
			// var events = $('#events'); //untuk testing apakah data yang diambil benar/tidak
			var tdata, old_tdata, temp;
			table2.on('click', function() {
				setTimeout(() => {
					tdata = table2.rows({
						selected: true
					}).data()[0];

					if (old_tdata == tdata) {
						return false;
					} else if (tdata) {
						// events.prepend( '<div>'+tdata['kat_id']+':'+tdata['kat_nama']+tdata+'</div>' );
						table.ajax.url("<?php echo site_url('admin/products/product_api?action=list_by_cat&kat_id='); ?>" + tdata['kat_id']).load();

						//kosongkan bagian yang via select2
						$('#kategori').prop('selectedIndex', 0);
						old_tdata = tdata;

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


			//EDITABLE SUBMIT

			// Add event listener for opening and closing details
			$('#productList tbody').on('click', '.harga_dasar', function() {

				$(this).removeClass('d-inline')
				$(this).addClass('d-none')
				$(this).next().removeClass('d-none')
				$(this).next().addClass('d-inline')
				$(this).next().children().children().children().focus().select()

			});
			$('#productList tbody').on('change', '.ubah_harga_dasar', function(e) {
				var id = $(this).data('id');
				var name = $(this).data('name');
				var val = $(this).val().replace(/^[0]+/g,"");
				if(val==''){
					val = 0;
				}

				if(val>=0){
					ajax_editable(id, name, val)
					$(this).parent().parent().parent().removeClass('d-inline')
					$(this).parent().parent().parent().addClass('d-none')
					$(this).parent().parent().parent().prev().removeClass('d-none')
					$(this).parent().parent().parent().prev().addClass('d-inline')
					$(this).parent().parent().parent().prev().text(val);
				}

				e.preventDefault();
			});

			$('#productList tbody').on('click', '.harga_jual', function() {

				$(this).removeClass('d-inline')
				$(this).addClass('d-none')
				$(this).next().removeClass('d-none')
				$(this).next().addClass('d-inline')
				$(this).next().children().children().children().focus().select()

			});
			$('#productList tbody').on('change', '.ubah_harga_jual', function(e) {
				var id = $(this).data('id');
				var name = $(this).data('name');
				var val = $(this).val().replace(/^[0]+/g,"");
				if(val==''){
					val = 0;
				}

				if(val>=0){
					ajax_editable(id, name, val)
	
					$(this).parent().parent().parent().removeClass('d-inline')
					$(this).parent().parent().parent().addClass('d-none')
					$(this).parent().parent().parent().prev().removeClass('d-none')
					$(this).parent().parent().parent().prev().addClass('d-inline')
					$(this).parent().parent().parent().prev().text(val);
				}
			});

			$('#productList tbody').submit(function(e) {
				e.preventDefault();
			});

		});

	</script>
