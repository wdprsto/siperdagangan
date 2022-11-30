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
	<div class="mb-4" style="border-bottom: 1px solid black;">
		<h3 class="text-center"><?php echo get_settings('store_name') ?></h3>
		<span class="d-block text-center" style='margin-left:100px; margin-right:100px'><?php echo get_settings('store_address') ?></span>
		<span class="d-block text-center" style='margin-left:100px; margin-right:100px; margin-bottom: 8px'><?php echo get_settings('store_phone_number') ?></span>
	</div>
	<div class="mb-4">
		<h4 class="text-center"><?php echo $title_pdf ?></h4>
		<h5 class="text-center"><?php echo 'Tahun ' . $tahun ?></h5>
	</div>

	<table id="table">
		<thead>
			<tr>
				<th scope="col">No.</th>
				<th scope="col">Bulan</th>
				<th scope="col">Jumlah Pembelian (Rp.)</th>
				<th scope="col">Jumlah Penjualan (Rp.)</th>
				<th scope="col">Laba (Rp.)</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$global_total_pembelian = 0;
			$global_total_penjualan = 0;
			$global_laba = 0;
			$no = 1;
			if (!$uangs) { ?>
				<tr>
					<td colspan='5'>
						<p class='container my-4 text-center '>Tidak Ada Data Barang Yang Memenuhi</p>
					</td>
				</tr>
			<?php } else { ?>
				<?php foreach ($uangs as $uang) : ?>
					<tr class="align-top">
						<td><?php echo $no++; ?></td>
						<td><?php echo get_month_name($uang->tgl).' '.$tahun; ?></td>
						<td><?php echo format_rupiah($uang->jumlah_pembelian);
								$global_total_pembelian += $uang->jumlah_pembelian; ?></td>
						<td><?php echo format_rupiah($uang->jumlah_penjualan);
								$global_total_penjualan += $uang->jumlah_penjualan;
								?></td>
						<td><?php echo format_rupiah($uang->jumlah_penjualan - $uang->jumlah_pembelian);
								$global_laba += ($uang->jumlah_penjualan - $uang->jumlah_pembelian);
								?></td>
					</tr>
				<?php endforeach ?>
			<?php
			}; ?>
			<tr class="align-top">
				<td class='text-center font-weight-bold' colspan="2">Total</td>
				<td><?php echo format_rupiah($global_total_pembelian);  ?></td>
				<td><?php echo format_rupiah($global_total_penjualan); ?></td>
				<td><?php echo format_rupiah($global_laba); ?></td>
			</tr>
		</tbody>
	</table>

	<div class="row">
		<div class="col-6">
			<span class="d-block" style="margin-bottom:50px; margin-top:40px">Admin,</span>
			<span class="d-block"><?php echo $admin->adm_nama; ?></span>
		</div>
	</div>
</body>

</html>
