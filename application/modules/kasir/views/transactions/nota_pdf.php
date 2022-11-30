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
			border-top: 1px dashed #000;
			border-bottom: 1px dashed #000;
			padding: 8px;
		}

		#table tfoot {
			border-top: 1px dashed #000;
			border-bottom: 1px dashed #000;
		}

		/* #table td {} */
		/* 
		#table tbody tr:nth-child(even) {
			background-color: #f2f2f2;
		} */

		#table th {
			padding-top: 10px;
			padding-bottom: 10px;
			text-align: center;
			background-color: #fff
		}
	</style>
</head>

<body>
	<div class="mb-4">
		<h3 class="text-center"><?php echo $title_pdf ?></h3>
	</div>
	<div class="row" style="margin-bottom:-40px">
		<div class="col-5">
			<span class="d-block font-weight-bold"><?php echo get_settings('store_name') ?></span>
			<span class="d-block"><?php echo get_settings('store_address') ?></span>
			<span class="d-block">HP: <?php echo get_settings('store_phone_number') ?></span>
		</div>
		<div class="col-11 text-right">
			<span class="d-block"><?php echo get_formatted_date($nota->nota_tgl) ?></span>
			<?php if ($nota->nota_pembeli) : ?>
				<span class="d-block">Kepada Yth, <?php echo $nota->nota_pembeli ?></span>
			<?php else : ?>
				<span class="d-block">Kepada Yth, ..................</span>
			<?php endif; ?>
			<?php if ($nota->nota_plat) : ?>
				<span class="d-block">Plat <?php echo $nota->nota_plat; ?></span>
			<?php else : ?>
				<span class="d-block">Plat ..................</span>
			<?php endif; ?>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<span class="d-block font-weight-bold">Nota: <?php echo $nota->nota_id ?></span>
		</div>
	</div>

	<table id="table">
		<thead>
			<tr>
				<th scope="col">Qty</th>
				<th scope="col">Nama Barang</th>
				<th scope="col">Harga</th>
				<th scope="col">Jumlah</th>
				<th scope="col">Diskon</th>
			</tr>
		</thead>
		<tbody>
			<?php if(!$barang_nota): ?>
				<tr>
					<td colspan='5'><p class='container my-4 text-center '>Anda belum menambahkan barang ke nota</p></td>
				</tr>
			<?php else: ?>
				<?php foreach ($barang_nota as $barang) : ?>
					<tr class="align-top">
						<td><?php echo $barang->jual_jumlahbrg . ' ' . $barang->brg_satuan; ?></td>
						<td><?php echo $barang->brg_nama; ?></td>
						<td><?php echo 'Rp.' . format_rupiah($barang->brg_hargajual); ?></td>
						<td><?php echo 'Rp.' . format_rupiah($barang->jual_hargajual); ?></td>
						<td><?php echo 'Rp.' . format_rupiah($barang->jual_diskon); ?></td>
					</tr>
				<?php endforeach ?>
			<?php endif;?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan='4'><span class='d-block mt-2'>Total Harga</span></td>
				<td><span class='d-block mt-2'><?php echo 'Rp.' . format_rupiah($total_biaya_nota->total_hargakotor); ?></span></td>
			</tr>
			<tr>
				<td colspan='4'><span class='d-block mb-2'>Total Diskon</span></td>
				<td><span class='d-block mb-2'><?php echo 'Rp.' . format_rupiah($total_biaya_nota->total_diskon); ?></span></td>
			</tr>
		</tfoot>
		<tr>
			<td colspan='4'><span class='d-block mt-2 font-weight-bold'>Jumlah Tagihan</span></td>
			<td class="font-weight-bold"><span class='d-block mt-2'><?php echo 'Rp.' . format_rupiah($total_biaya_nota->total_hargabersih); ?></span></td>
		</tr>
	</table>

	<div class="row">
		<div class="col-11">
			<span class="d-block" style="margin-top:40px; margin-bottom:50px">Penerima,</span>
			<span class="d-block">..................</span>
		</div>
		<div class="col-11 text-right">
			<span class="d-block" style="margin-top:40px; margin-bottom:50px">Kasir,</span>
			<?php if ($nota->ksr_nama) : ?>
				<span class="d-block"><?php echo $nota->ksr_nama; ?></span>
			<?php else : ?>
				<span class="d-block">..................</span>
			<?php endif; ?>
		</div>
	</div>
</body>

</html>
