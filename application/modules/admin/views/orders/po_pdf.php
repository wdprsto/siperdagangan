<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title_pdf ?> | <?php echo get_store_name(); ?></title>

	<link href="<?php echo get_theme_uri('custom/auth/login/css/bootstrap.min.css'); ?>" rel="stylesheet" />

	<link rel="icon" href="<?php echo base_url('assets/uploads/sites/Logo.png'); ?>">

	<style>
		#table {
			font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
			border-collapse: collapse;
			width: 100%;
			/*95.5 */
		}

		#table th {
			border: 1px solid #000;
			padding: 8px;
			padding-top: 10px;
			padding-bottom: 10px;
			text-align: center;
			background-color: #f2f2f2
		}

		#table td {
			border: 1px solid #000;
			padding-left: 8px;
			padding-bottom: 8px;
	
		}

		

		/* #table td {} */
		/* 
		#table tbody tr:nth-child(even) {
			background-color: #f2f2f2;
		} */


	</style>
</head>

<body>
	<div class="mb-4">
		<h3 class="text-center"><?php echo $title_pdf ?></h3>
	</div>
	<div class="row" style="margin-bottom:-8px">
		<div class="col-5">
			<span class="d-block font-weight-bold"><?php echo get_settings('store_name') ?></span>
			<span class="d-block"><?php echo get_settings('store_address') ?></span>
			<span class="d-block">HP: <?php echo get_settings('store_phone_number') ?></span>
		</div>
		<div class="col-11 ">
			<div class="row">
				<span class="font-weight-bold position-relative" style="left:420px">Nomor PO</span>
				<span class="d-block text-right"><?php echo $po->po_id?></span>
			</div>
			<div class="row">
				<span class="font-weight-bold position-relative" style="left:420px">Tanggal PO</span>
				<span class="d-block text-right"><?php echo get_formatted_date($po->po_tgl);?></span>
			</div>
			<div class="row" style="max-width:298.5px">
				<span class="d-block font-weight-bold position-relative" style="left:420px; top:45px; border-bottom:0.5px solid black; padding-bottom:8px;">Order ke</span>
				<div class='position-relative' style="left:420px; top:90px">
					<span class="d-block font-weight-bold " ><?php echo $po->sup_perusahaan?></span>
					<span class="d-block position-relative" style="margin-top:8px"><?php echo $po->sup_alamat?><br>Telp. <?php echo $po->sup_nohp?></span>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<span class="d-block font-weight-bold"></span>
		</div>
	</div>

	<table id="table">
		<thead>
			<tr>
				<th scope="col">Kode</th>
				<th scope="col">Nama Barang</th>
				<th scope="col">Jumlah</th>
				<th scope="col">Harga</th>
				<th scope="col">Total</th>
			</tr>
		</thead>
		<tbody>
			<?php if(!$barang_po): ?>
				<tr>
					<td colspan='5'><p class='container my-4 text-center '>Anda belum menambahkan barang ke PO</p></td>
				</tr>
			<?php else: ?>
				<?php foreach ($barang_po as $barang) : ?>
					<tr class="align-top">
						<td><?php echo $barang->brg_id; ?></td>
						<td><?php echo $barang->brg_nama; ?></td>
						<td><?php echo $barang->beli_jumlahbrg . ' ' . $barang->brg_satuan; ?></td>
						<td><?php echo 'Rp.' . format_rupiah($barang->brg_hargadasar); ?></td>
						<td><?php echo 'Rp.' . format_rupiah($barang->beli_hargadasar); ?></td>
					</tr>
				<?php endforeach ?>
			<?php endif;?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan='4'><span class='d-block mt-2 font-weight-bold'>Jumlah Tertagih</span></td>
				<td><span class='d-block mt-2 font-weight-bold'><?php echo 'Rp.' . format_rupiah($total_biaya_po->total_harga); ?></span></td>
			</tr>
		</tfoot>
	</table>

	<div class="row" >
		<div class="col-6">
			<span class="d-block" style="margin-bottom:50px; margin-top:40px">Pemesan,</span>
			<span class="d-block"><?php echo $po->adm_nama; ?></span>
		</div>
		<div class="col-11 text-right" >
			<span class="d-block" style=" margin-top:40px">Tanggal jatuh tempo:</span>
			<?php if ($po->po_tgljatuhtempo) : ?>
				<span class="d-block text-danger"><?php echo get_formatted_date($po->po_tgljatuhtempo); ?></span>
			<?php else : ?>
				<span class="d-block">..................</span>
			<?php endif; ?>
		</div>
	</div>
</body>

</html>
