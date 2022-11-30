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
	</div>

	<table id="table">
		<thead>
			<tr>
				<th scope="col">Kode</th>
				<th scope="col">Kategori/Nama Barang</th>
				<th scope="col">Stok</th>
				<th scope="col">Satuan</th>
				<th scope="col">Harga Dasar</th>
				<th scope="col">Harga Jual</th>
			</tr>
		</thead>
		<tbody>
			<?php $current_cat = '';
			if(!$barangs){ ?>
				<tr>
					<td colspan='5'><p class='container my-4 text-center '>Tidak Ada Data Barang Yang Memenuhi</p></td>
				</tr>
			<?php }
			else{ ?>
				<?php foreach ($barangs as $barang) : ?>
					<?php if($current_cat != $barang->kat_nama){ 
									$current_cat = $barang->kat_nama
					?>
					<tr class="align-top">
						<td colspan='6' class='font-weight-bold'><?php echo $barang->kat_id.'.'.' Kategori '.$barang->kat_nama; ?></td>
					</tr>
					<?php } ?>
					<tr class="align-top">
						<td><?php echo $barang->brg_id; ?></td>
						<td><?php echo $barang->brg_nama; ?></td>
						<td><?php echo $barang->brg_stok; ?></td>
						<td><?php echo $barang->brg_satuan; ?></td>
						<td><?php echo 'Rp.' . format_rupiah($barang->brg_hargadasar); ?></td>
						<td><?php echo 'Rp.' . format_rupiah($barang->brg_hargajual); ?></td>
					</tr>
				<?php endforeach ?>
			<?php 
			};?>
		</tbody>
	</table>

	<div class="row" >
		<div class="col-6">
			<span class="d-block" style="margin-bottom:50px; margin-top:40px">Admin,</span>
			<span class="d-block"><?php echo $admin->adm_nama; ?></span>
		</div>
	</div>
</body>

</html>
