<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <!-- Header -->
    <div class="header bg-secondary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 d-inline-block mb-0">Kelola Purchase Order</h6>
							<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links ">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">Order</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
							<a href="<?php echo site_url('admin/orders/add_new_po'); ?>" class="btn btn-sm btn-primary">Tambah</a>
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
            <div class="card-header">
              <h3 class="mb-0">Kelola PO</h3>
            </div>

            <?php if ( count($po) > 0) : ?>
            <div class="card-body p-0">
                <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush" id='poList'>
                <thead class="thead-light">
                  <tr>
										<th scope="col"></th>
                    <th scope="col">ID</th>
                    <th scope="col">Tanggal PO</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Jatuh Tempo</th>
                    <th scope="col">Status</th>
                    <!-- <th scope="col">Admin</th> -->
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
               
                </tbody>
              </table>
            </div>
                </div>
            
            
            <?php else : ?>
             <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="alert alert-primary">
                            Belum ada data Purchase Order yang tersimpan. Silahkan menambahkan data baru.
                        </div>
                    </div>
                    <div class="col-md-4">
                        <a href="<?php echo site_url('admin/orders/add_new_po'); ?>"><i class="fa fa-plus"></i> Tambah PO baru</a>
                        <br>
                        <!-- <a href="<?php //echo site_url('admin/products/category'); ?>"><i class="fa fa-list"></i> Kelola PO</a> -->
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
          </div>
        </div>
      </div>

			
<!-- MODAL HAPUS PO -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
  <div class="modal-dialog modal-modal-dialog-centered modal-" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h6 class="modal-title" id="modal-title-default">Hapus PO</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
          </div>
          <form action="#" id="deletePO" method="POST">
        
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
<script src="http://cdn.datatables.net/plug-ins/1.10.24/dataRender/datetime.js"></script>

<script>
$(document).ready(function() {

	//TABEL DATA PO
	var table = $('#poList').DataTable({
	// Register date formats to allow DataTables sorting of the dates

		"ajax" : "<?php echo site_url('admin/orders/api?action=orders'); ?>",
		"columns" : [
			{
				"className":      'details-control',
				"orderable":      false,
				"data":           null,
				"defaultContent": ''
			},
			{"data": "po_id"},
			{"data": "po_tgl"},
			{"data": "sup_perusahaan"},
			{"data": "po_tgljatuhtempo"},
			// {"data": "po_status"},
			{"mRender": function (data, type, row) {
				if(row.po_status=="temporer"){
					return '<span class="badge badge-primary">'+row.po_status.toUpperCase() +'</span>';
				}else if(row.po_status=="permanen"){
					return '<span class="badge badge-success">'+row.po_status.toUpperCase() +'</span>';
				}else{
					return '<span class="badge badge-danger">'+row.po_status.toUpperCase().replace(/_/g, ' ') +'</span>';
				}
				}
			},
			// {"data": "adm_nama"},
			{"mRender": function (data, type, row) {
				if(row.po_status=="belum_selesai"){
					return '<div class="text-right">'+
					'<a href="<?php echo site_url('admin/orders/edit_po/'); ?>'+row.po_id+'" data-id="'+row.po_id+'" class="btn btn-warning btn-sm btnEdit"><i class="fa fa-edit"></i></a>'+
					'<a href="#/" data-id="'+row.po_id+'" class="btn btn-danger btn-sm btnDelete"><i class="fa fa-trash"></i></a></div>';
				}else if(row.po_status=="temporer"){
					return '<div class="text-right">'+
					'<a href="<?php echo site_url('admin/orders/cetak_po/'); ?>'+row.po_id+'" target="_blank" data-id="'+row.po_id+'" class="btn btn-info btn-sm btnCetak"><i class="fa fa-print"></i></a>'+
					'<a href="<?php echo site_url('admin/orders/edit_po/'); ?>'+row.po_id+'" data-id="'+row.po_id+'" class="btn btn-warning btn-sm btnEdit"><i class="fa fa-edit"></i></a>'+
					'<a href="#/" data-id="'+row.po_id+'" class="btn btn-danger btn-sm btnDelete"><i class="fa fa-trash"></i></a></div>';
				}else{
					return '<div class="text-right">'+
					'<a href="<?php echo site_url('admin/orders/retur_po/'); ?>'+row.po_id+'" data-id="'+row.po_id+'" class="btn btn-secondary btn-sm btnRetur mr-2" style="max-width:2rem"><i class="fa fa-undo"></i></a>' +
					'<a href="<?php echo site_url('admin/orders/cetak_po/'); ?>'+row.po_id+'" target="_blank" data-id="'+row.po_id+'" class="btn btn-info btn-sm btnCetak"><i class="fa fa-print"></i></a>'}
				}
			}
			
		],
		"columnDefs": [
					{
							"render": function ( data, type, row ) {
									return get_formatted_date(data);
							},
							"targets": 4
					},
					{
							"render": function ( data, type, row ) {
									return get_formatted_date(data);
							},
							"targets": 2
					},
	
		],
		"order": [[1, 'desc']],
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

	// Add event listener for opening and closing details
	$('#poList tbody').on('click', 'td.details-control', function () {
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

		
	$(document).on('click', '.btnDelete', function() {
		var id  = $(this).data('id');

		$('.deleteID').val(id);
		$('#deleteModal').modal('show');
	});

	
	$('#deletePO').submit(function(e) {
		e.preventDefault();

		var id = $('.deleteID').val();
		var btn = $('.btn-delete');

		btn.html('<i class="fa fa-spin fa-spinner"></i> Menghapus...');

		$.ajax({
			method: 'POST',
			url: '<?php echo site_url('admin/orders/api?action=delete_po'); ?>',
			data: {
				id_po : id
			},
			success: function (res) {
				if (res.code == 204) {
					btn.html('<i class="fa fa-check"></i> Terhapus!');
					table.ajax.reload();

					setTimeout(() => {
						$('#deleteModal').modal('hide');
						btn.html('Hapus');
					}, 1500);
				}
			}
		})
	});



		
});

function format ( d ) {
    // `d` is the original data object for the row

		//UBAH DATA KE ARAI
		if(d.brg_satuan){
			var beli_idbrg = d.beli_idbrg.split(",");
			var brg_nama = d.brg_nama.split(",");
			var brg_hargadasar = d.brg_hargadasar.split(",");
			var brg_satuan = d.brg_satuan.split(",");
			var beli_jumlahbrg = d.beli_jumlahbrg.split(",");
			var beli_hargadasar = d.beli_hargadasar.split(",");
	
			var output = '<div>'+
			'<div class="row mx-auto">'+
				'<div class="col-3">'+
				'</div>'+
				'<div class="col-3">'+
				'</div>'+
				'<div class="col-3">'+
					'<p style="font-weight: bold; font-size:.8125rem">Nomor PO</p>'+
					'<p style="font-weight: normal; font-size:.8125rem">Tanggal PO</p>'+
				'</div>'+
				'<div class="col-3">'+
					'<p style="font-weight: bold; float:right; font-size:.8125rem">'+d.po_id+'</p>'+
					'<p style="font-weight: normal; float:right; font-size:.8125rem">'+get_formatted_date_with_hour(d.po_tgl)+'</p>'+
				'</div>'+
			'</div>'+
	
			'<table width="100%" style=" border:1px solid #ccc;">'+
					'<tr>'+
							'<th style="font-weight:bold">Qty</td>'+
							'<th style="font-weight:bold">Nama Produk</td>'+
							'<th style="font-weight:bold">Harga Dasar</td>'+
							'<th style="font-weight:bold">Jumlah</td>'+
					'</tr>';
	
			//APPEND NILAI TABEL YANG MAU DI TAMBAH
			for(var i=0; i<beli_idbrg.length; i++) {
				output+='<tr>'+
							'<td>'+beli_jumlahbrg[i]+' '+brg_satuan[i]+'</td>'+
							'<td>'+brg_nama[i]+'</td>'+
							'<td>'+format_rp(brg_hargadasar[i])+'</td>'+
							'<td>'+format_rp(beli_hargadasar[i])+'</td>'+
					'</tr>';
			}
	
			output += '</table>'+
			'<div class="row mt-3 mx-auto">'+
				'<div class="col-3">'+
					// '<div class="col ">'+
						'<p style="font-weight: normal; font-size:.8125rem">Pemesan,</p>'+
						'<p style="font-weight: normal; font-size:.8125rem">'+d.adm_nama+'</p>'+
					// '</div>'+
				'</div>'+
				'<div class="col-3">'+
					'<p style="font-weight: bold">'+'</p>'+
				'</div>'+
				'<div class="col-3">'+
					'<p style="font-weight: bold"></p>'+
				'</div>'+
				'<div class="col-3">'+
					'<p style="font-weight: bold; float:right; font-size:.8125rem"> Total Harga: '+format_rp(d.beli_totalhargadasar)+'</p>'+
				'</div>'+
			'</div>';

		}else{
			var output = '<div>'+
			'<div class="row mx-auto">'+
				'<div class="col-3">'+
				'</div>'+
				'<div class="col-3">'+
				'</div>'+
				'<div class="col-3">'+
					'<p style="font-weight: bold; font-size:.8125rem">Nomor PO</p>'+
					'<p style="font-weight: normal; font-size:.8125rem">Tanggal PO</p>'+
				'</div>'+
				'<div class="col-3">'+
					'<p style="font-weight: bold; float:right; font-size:.8125rem">'+d.po_id+'</p>'+
					'<p style="font-weight: normal; float:right; font-size:.8125rem">'+get_formatted_date_with_hour(d.po_tgl)+'</p>'+
				'</div>'+
			'</div>'+
	
			'<table width="100%" style=" border:1px solid #ccc;">'+
					'<tr>'+
							'<th style="font-weight:bold">Qty</th>'+
							'<th style="font-weight:bold">Nama Produk</th>'+
							'<th style="font-weight:bold">Harga</th>'+
							'<th style="font-weight:bold">Jumlah</th>'+
					'</tr>'+
					'<tr>'+
							'<td rowspan="4">Belum ada barang yang ditambahkan</td>'+
					'</tr>';
	
			output += '</table>'+
			'<div class="row mt-3 mx-auto">'+
				'<div class="col-3">'+
					// '<div class="col ">'+
						'<p style="font-weight: normal; font-size:.8125rem">Pemesan,</p>'+
						'<p style="font-weight: normal; font-size:.8125rem">'+d.adm_nama+'</p>'+
					// '</div>'+
				'</div>'+
				'<div class="col-3">'+
					'<p style="font-weight: bold">'+'</p>'+
				'</div>'+
				'<div class="col-3">'+
					'<p style="font-weight: bold"></p>'+
				'</div>'+
				'<div class="col-3">'+
					'<p style="font-weight: bold; float:right; font-size:.8125rem"> Total Harga: Rp0</p>'+
				'</div>'+
			'</div>';
		}

		return output;
}

//FORMAT KALAU MAU LAKUKAN PERULANGAN DI DALAM TABEL ANAK
function format_po ( d ) {
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
			'</tr>';
	
	//APPEND NILAI TABEL YANG MAU DI TAMBAH
	for(var i=0; i<arr_stringku.length; i++) {
		output+='<tr>'+
					'<td style="font-weight:bold">Test-'+i+':</td>'+
					'<td>'+arr_stringku[i]+'</td>'+
			'</tr>';
	}

	//TUTUP ELEMEN TABEL DENGAN MENAMBAHKAN TAG PENUTU TABEL
	output+='</table>';

	//INI DITAMPIKAN
	return output;
}

function get_formatted_date(data)
{
	var date = new Date(data);
	var tahun = date.getFullYear();
	var bulan = date.getMonth();
	var tanggal = date.getDate();
	var hari = date.getDay();
	var jam = date.getHours();
	var menit = date.getMinutes();
	var detik = date.getSeconds();

	switch(hari) {
		case 0: hari = "Minggu"; break;
		case 1: hari = "Senin"; break;
		case 2: hari = "Selasa"; break;
		case 3: hari = "Rabu"; break;
		case 4: hari = "Kamis"; break;
		case 5: hari = "Jum'at"; break;
		case 6: hari = "Sabtu"; break;
	}
	switch(bulan) {
		case 0: bulan = "Januari"; break;
		case 1: bulan = "Februari"; break;
		case 2: bulan = "Maret"; break;
		case 3: bulan = "April"; break;
		case 4: bulan = "Mei"; break;
		case 5: bulan = "Juni"; break;
		case 6: bulan = "Juli"; break;
		case 7: bulan = "Agustus"; break;
		case 8: bulan = "September"; break;
		case 9: bulan = "Oktober"; break;
		case 10: bulan = "November"; break;
		case 11: bulan = "Desember"; break;
	}

	var tampilTanggal = hari + ", " + tanggal + " " + bulan + " " + tahun;
	var tampilWaktu = "Jam: " + jam + ":" + menit + ":" + detik;

	return tampilTanggal;
}

function get_formatted_date_with_hour(data)
{
	var date = new Date(data);
	var tahun = date.getFullYear();
	var bulan = date.getMonth();
	var tanggal = date.getDate();
	var hari = date.getDay();
	var jam = date.getHours();
	var menit = date.getMinutes();
	var detik = date.getSeconds();

	switch(hari) {
		case 0: hari = "Minggu"; break;
		case 1: hari = "Senin"; break;
		case 2: hari = "Selasa"; break;
		case 3: hari = "Rabu"; break;
		case 4: hari = "Kamis"; break;
		case 5: hari = "Jum'at"; break;
		case 6: hari = "Sabtu"; break;
	}
	switch(bulan) {
		case 0: bulan = "Januari"; break;
		case 1: bulan = "Februari"; break;
		case 2: bulan = "Maret"; break;
		case 3: bulan = "April"; break;
		case 4: bulan = "Mei"; break;
		case 5: bulan = "Juni"; break;
		case 6: bulan = "Juli"; break;
		case 7: bulan = "Agustus"; break;
		case 8: bulan = "September"; break;
		case 9: bulan = "Oktober"; break;
		case 10: bulan = "November"; break;
		case 11: bulan = "Desember"; break;
	}

	var tampilTanggal = hari + ", " + tanggal + " " + bulan + " " + tahun;
	var tampilWaktu = "pukul " + jam + ":" + menit + ":" + detik;

	return tampilTanggal + ' ' + tampilWaktu;
}

function format_rp(x) {
    return "Rp"+x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

</script>
