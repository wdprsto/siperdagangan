<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper" >
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
					<h6 class="h3 d-inline-block mb-0" >Kelola Data</h6>
					<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4 mt-0">
						<ol class="breadcrumb breadcrumb-links ">
							<li class="breadcrumb-item"><?php echo anchor(base_url(), 'Home'); ?></li>
							<li class="breadcrumb-item active">Data</li>
						</ol>
					</nav>
                </div>
                <div class="col-sm-6 text-right">
					<a href="<?php echo site_url('kasir/transactions/add_new_nota'); ?>" class="btn btn-sm btn-inline btn-primary" tabindex='1'>Tambah</a>
					
           		</div>
            </div>
        </div>
    </section>

    <section class="content">
    <div class="container-fluid" >
    <div class="row">
    <div class="col-12">
        <div class="card card-primary">
        <div class="card-body dataTables_wrapper dt-bootstrap4">
            <?php if ( count($nota) > 0) : ?>
                <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="notaList" style="width: 100%">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">ID</th>
                                <th scope="col">Tanggal </th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>

                    </table>
                </div>

                <?php else : ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            Belum ada data transaksi.
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>

        </div>
        </div>
    </div>
    </div>
    </div>
    </section>

</div>

			
<!-- MODAL HAPUS Nota -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
  <div class="modal-dialog modal-modal-dialog-centered modal-" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h6 class="modal-title" id="modal-title-default">Hapus Nota</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
          </div>
          <form action="#" id="deleteNota" method="POST">
        
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


<script>
	
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

// FUNGSI UNTUK MENAMPILKAN DETAIL TABLE
function format_rp(x) {
return "Rp"+x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function format ( d ) {
    // `d` is the original data object for the row

		//UBAH DATA KE ARAI
		if(d.brg_satuan){
			var jual_idbrg = d.jual_idbrg.split(",");
			var brg_nama = d.brg_nama.split(",");
			var brg_hargajual = d.brg_hargajual.split(",");
			var brg_satuan = d.brg_satuan.split(",");
			var jual_jumlahbrg = d.jual_jumlahbrg.split(",");
			var jual_hargajual = d.jual_hargajual.split(",");
			var jual_diskon = d.jual_diskon.split(",");
	
			var output = '<div>'+
			'<div class="row mx-auto">'+
				'<div class="col-3">'+
				'</div>'+
				'<div class="col-3">'+
				'</div>'+
				'<div class="col-3">'+
					'<p style="font-weight: bold; font-size:1rem">Nomor</p>'+
					'<p style="font-weight: normal; font-size:1rem">Tanggal</p>'+
				'</div>'+
				'<div class="col-3">'+
					'<p style="font-weight: bold; text-align:right; font-size:1rem">'+d.nota_id+'</p>'+
					'<p style="font-weight: normal; text-align:right; font-size:1rem">'+get_formatted_date(d.nota_tgl)+'</p>'+
				'</div>'+
			'</div>'+
	
			'<table width="100%" style=" border:1px solid #ccc;">'+
					'<tr>'+
							'<th style="font-weight:bold">Qty</td>'+
							'<th style="font-weight:bold">Nama</td>'+
							// '<th style="font-weight:bold">Harga</td>'+
							// '<th style="font-weight:bold">Jumlah</td>'+
							// '<th style="font-weight:bold">Diskon</td>'+
					'</tr>';
	
			//APPEND NILAI TABEL YANG MAU DI TAMBAH
			for(var i=0; i<jual_idbrg.length; i++) {
				output+='<tr>'+
							'<td>'+jual_jumlahbrg[i]+' '+brg_satuan[i]+'</td>'+
							'<td>'+brg_nama[i]+'</td>'+
							// '<td>'+format_rp(brg_hargajual[i])+'</td>'+
							// '<td>'+format_rp(jual_hargajual[i])+'</td>'+
							// '<td>'+format_rp(jual_diskon[i])+'</td>'+
					'</tr>';
			}
	
			output += '</table>'+
			'<div class="row mt-3 mx-auto">'+
				// '<div class="col-3">'+
				// 	// '<div class="col ">'+
				// 		'<p style="font-weight: normal; font-size:1rem">Kasir,</p>'+
				// 		'<p style="font-weight: normal; font-size:1rem">&nbsp;</p>'+
				// 		'<p style="font-weight: normal; font-size:1rem">'+d.ksr_nama+'</p>'+
				// 	// '</div>'+
				// '</div>'+
				// '<div class="col-3 d-flex flex-column">'+
				// 	'<p style="font-weight: bold">'+'</p>'+
				// '</div>'+
				// '<div class="col-3">'+
				// 	'<p style=" font-size:1rem"> Total Harga:</p>'+
				// 	'<p style=" font-size:1rem"> Total Diskon:</p>'+
				// 	'<p style="font-weight: bold; font-size:1rem"> Jumlah Tagihan:</p>'+
				// '</div>'+
				// '<div class="col-3 d-flex flex-column">'+
				// 	'<p style=" text-align:right; font-size:1rem"> '+format_rp(d.jual_totalhargajual)+'</p>'+
				// 	'<p style=" text-align:right; font-size:1rem"> '+format_rp(d.jual_totaldiskon)+'</p>'+
				// 	'<p style="font-weight: bold; text-align:right; font-size:1rem"> '+format_rp(d.jual_totalbersih)+'</p>'+
				// '</div>'+
			'</div>';

		}else{
			var output = '<div>'+
			'<div class="row mx-auto">'+
				'<div class="col-3">'+
				'</div>'+
				'<div class="col-3">'+
				'</div>'+
				'<div class="col-3">'+
					'<p style="font-weight: bold; font-size:1rem">Nomor Nota</p>'+
					'<p style="font-weight: normal; font-size:1rem">Tanggal Nota</p>'+
				'</div>'+
				'<div class="col-3">'+
					'<p style="font-weight: bold; text-align:right; font-size:1rem">'+d.nota_id+'</p>'+
					'<p style="font-weight: normal; text-align:right; font-size:1rem">'+get_formatted_date_with_hour(d.nota_tgl)+'</p>'+
				'</div>'+
			'</div>'+
	
			'<table width="100%" style=" border:1px solid #ccc;">'+
					'<tr>'+
							'<th style="font-weight:bold">Qty</td>'+
							'<th style="font-weight:bold">Nama</td>'+
							// '<th style="font-weight:bold">Harga</td>'+
							// '<th style="font-weight:bold">Jumlah</td>'+
							// '<th style="font-weight:bold">Diskon</td>'+
					'</tr>'+
					'<tr>'+
							'<td colspan="5">Belum ada barang yang ditambahkan</td>'+
					'</tr>';
	
			output += '</table>'+
			'<div class="row mt-3 mx-auto">'+
				// '<div class="col-3">'+
				// 	// '<div class="col ">'+
				// 		'<p style="font-weight: normal; font-size:1rem">Kasir,</p>'+
				// 		'<p style="font-weight: normal; font-size:1rem">'+d.ksr_nama+'</p>'+
				// 	// '</div>'+
				// '</div>'+
				// '<div class="col-3">'+
				// 	'<p style="font-weight: bold">'+'</p>'+
				// '</div>'+
				// '<div class="col-3">'+
				// 	'<p style="font-weight: bold"></p>'+
				// '</div>'+
				// '<div class="col-3">'+
				// 	'<p style="font-weight: bold; float:right; font-size:1rem"> Total Harga: Rp0</p>'+
				// '</div>'+
			'</div>';
		}

		return output;
}

$(document).ready(function() {

	//TABEL DATA NOTA
    var table = $('#notaList').DataTable({
	  "ajax" : "<?php echo site_url('kasir/transactions/transaction_api?action=my_nota_for_api'); ?>", //id berasal dari parameter controller transactions
      "columns" : [
		{
			"className":      'details-control',
			"orderable":      false,
			"data":           null,
			"defaultContent": ''
		},
        {"data": "nota_id"},
        {"data": "nota_tgl"},
		{"mRender": function (data, type, row) {
			if(row.nota_status=="belum_selesai"){
				return '<div><span class="badge badge-danger">'+row.nota_status.toUpperCase().replace(/_/g, ' ') +'</span></div>';
			}else if(row.nota_status=="selesai"){
				return '<div><span class="badge badge-success">'+row.nota_status.toUpperCase() +'</span></div>';
			}
			}
		},
		{"mRender": function (data, type, row) {
			if(row.nota_status=="belum_selesai"){
				return '<div class="text-right">'+
				// '<a href="#/" data-id="'+row.nota_id+'" class="btn btn-info btn-sm btnCetak mr-2 mb-2"><i class="fa fa-print" style="max-width:2rem"></i></a>'+
				'<a href="<?php echo site_url('kasir/transactions/edit_nota/'); ?>'+row.nota_id+'" data-id="'+row.nota_id+'" class="btn btn-warning btn-sm btnEdit mr-2 mb-2" style="max-width:2rem"><i class="fa fa-edit" style="color:#fff"></i></a>'+
				'<a href="#/" data-id="'+row.nota_id+'" class="btn btn-danger btn-sm btnDelete mr-2 mb-2" style="max-width:2rem"><i class="fa fa-trash"></i></a></div>';
			}else{
				return '<div class="text-right">'+
				'<a href="<?php echo site_url('kasir/transactions/retur_nota/'); ?>'+row.nota_id+'" data-id="'+row.nota_id+'" class="btn btn-secondary btn-sm btnRetur mr-2" style="max-width:2rem"><i class="fa fa-undo"></i></a>' +
				'<a href="<?php echo site_url('kasir/transactions/cetak_nota_80/'); ?>'+row.nota_id+'" target="_blank" data-id="'+row.nota_id+'" class="btn btn-info btn-sm btnCetak mr-2" style="max-width:2rem"><i class="fa fa-print"></i></a>'}
			}
		},
      ],
	  "columnDefs": [
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
	$('#notaList tbody').on('click', 'td.details-control', function () {
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

	//mengapus nota
	$(document).on('click', '.btnDelete', function() {
		var id  = $(this).data('id');

		// $('.deleteID').val(id);
		// $('#deleteModal').modal('show');

		Swal.fire({
			title: 'Yakin ingin menghapus?',
			text: "Data yang sudah dihapus tidak bisa dikembalikan!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#007bff',
			cancelButtonColor: '#dc3545',
			confirmButtonText: 'Ya, hapus nota!',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.value==true) {	
				$.ajax({
					method: 'POST',
					url: '<?php echo site_url('kasir/transactions/transaction_api?action=delete_nota'); ?>',
					data: {
						id_nota : id
					},
					success: function (res) {
		
						if (res.code == 204) {
							table.ajax.reload();

							Swal.fire({
								title:'Terhapus!',
								text:'Data nota berhasil dihapus',
								type: 'success'
							})
						}else{
							Swal.fire({
								type: 'error',
								title: 'Gagal',
								text: 'Penghapusan data nota gagal!',
							})
						}
					}
				})
				
			}
		})
	});

	
	$('#deleteNota').submit(function(e) {
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
</script>
