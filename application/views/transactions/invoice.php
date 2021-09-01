<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Invoice | <?= $data['no_transaction'] ?></title>

	<!-- Favicons -->
	<link rel="icon" href="<?= base_url('assets/images/favicons/indosehat2003.png') ?>" type="image/gif">

	<style>
		.container {
			margin: 0 50px 0 50px;
		}

		.content {
			margin-bottom: 10px;
		}

		.title p {
			text-align: center;
			font-size: 1.2rem;
			font-weight: bold;
			letter-spacing: 3px;
		}

		.information tr td {
			font-size: .85rem;
		}

		.kwitansi {
			border: 1px solid black;
		}

		.kwitansi tr td {
			font-size: .9rem;
		}

		.footer {
			font-size: .65rem;
		}
	</style>
</head>

<body style='background-image: url("<?= base_url('assets/images/pdftemplate/kop-cilincing.png') ?>"); background-position: top left; background-repeat: no-repeat; background-image-resize: 4; background-image-resolution: from-image;'>
	<div class="container">
		<div class="content title">
			<p>INVOICE</p>
		</div>
		<div class="content">
			<table class="information" width="100%">
				<tr>
					<td width="21%">Medical Record Number</td>
					<td width="35%">: <?= $data["medical_record_number"] ?></td>
					<td width="5%"></td>
					<td width="14%">Invoice Number</td>
					<td width="25%">: <?= $data["no_transaction"] ?></td>
				</tr>
				<tr>
					<td>Patient Name</td>
					<td>: <?= $data["patient_name"] ?></td>
					<td></td>
					<td>Invoice Date</td>
					<td>: <?= date('D, d M Y H:i', strtotime($data['date'])) ?></td>
				</tr>
				<tr>
					<td>Patient Address</td>
					<td>: <?= $data["patient_address"] ?></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</table>
		</div>
		<div class="content">
			<table class="kwitansi" width="100%" cellpadding="4" cellspacing="0">
				<tr>
					<td width="5%" align="center" style="border-bottom: 1px solid black; border-right: 1px solid black;">No</td>
					<td align="center" style="border-bottom: 1px solid black; border-right: 1px solid black;">Name</td>
					<td width="24.25%;" align="center" style="border-bottom: 1px solid black;">Sub Total (Rp)</td>
				</tr>
				<tr>
					<td align="center" style="border-right: 1px solid black; padding-bottom: 225px;">&nbsp;1.</td>
					<td style="border-right: 1px solid black; padding-bottom: 225px;">
						&nbsp;Administrasi + Pelayanan Jasa
						<?php
						switch ($data['type_examination']) {
							case 'umum':
								echo 'Umum';
								break;
							case 'rev':
								echo 'Revalidasi';
								break;
							case 'mcu':
								echo 'MCU';
								break;
							default:
								echo '';
								break;
						}
						?>
					</td>
					<td align="right" style="padding-bottom: 225px;"><?= number_format($data['total_price']) ?>&nbsp;</td>
				</tr>
			</table>
		</div>
		<div class="content">
			<table class="information" width="100%" cellpadding="4" cellspacing="0">
				<tr>
					<td align="right">Grand Total : </td>
					<td width="24.25%;" align="right"><?= number_format($data['total_price']) ?>&nbsp;</td>
				</tr>
			</table>
		</div>
		<div class="content">
			<div>
				<p style="font-weight: bold; font-size: 0.9rem;">Patient Receipt / Kuitansi :</p>
			</div>
			<table class="kwitansi" width="100%" cellpadding="4" cellspacing="0">
				<tr>
					<td align="center" style="border-bottom: 1px solid black; border-right: 1px solid black;">Type</td>
					<td align="center" style="border-bottom: 1px solid black; border-right: 1px solid black;">Date</td>
					<td align="center" style="border-bottom: 1px solid black; border-right: 1px solid black;">Payment Mode</td>
					<td align="center" style="border-bottom: 1px solid black;">Total (Rp)</td>
				</tr>
				<tr>
					<td style="border-right: 1px solid black;">&nbsp;Payment</td>
					<td style="border-right: 1px solid black;">&nbsp;<?= date('d/m/Y', strtotime($data['date'])) ?></td>
					<td style="border-right: 1px solid black;">&nbsp;<?= ucwords($data['type_transaction']) ?></td>
					<td align="right"><?= number_format($data['total_price']) ?>&nbsp;</td>
				</tr>
			</table>
		</div>
		<br>
		<div class="content">
			<table class="information" width="100%" cellpadding="4" cellspacing="0">
				<tr>
					<td></td>
					<td width="25%" align="center" style="border-bottom: 1px solid black;">
						CASHIER
						<br><br><br><br><br><br><br><br>
					</td>
				</tr>
			</table>
		</div>
		<br><br><br><br>
		<div class="content">
			<table class="footer" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td width="2.5%" valign="top">+</td>
					<td valign="top">Pembayaran sah setelah kasir memberikan cap lunas.</td>
					<td width="2.5%"></td>
					<td width="2.5%" valign="top">+</td>
					<td width="55%" valign="top">Pemeriksaan Laboratorium dan Radiologi yang telah dilaksanakan tidak dapat dibatalkan.</td>
				</tr>
				<tr>
					<td valign="top">+</td>
					<td valign="top">Keberatan yang diajukan lebih dari 14 (empat belas) hari setelah invoice ini dikeluarkan tidak akan dilayani.</td>
					<td></td>
					<td valign="top">+</td>
					<td valign="top">Pengambilan hasil pemeriksaan Laboratorium dan Radiologi paling lambat 2 (dua) bulan setelah hasil selesai. Setelah periode tersebut, permintaan hasil akan dicetak ulang dan dikenakan biaya.</td>
				</tr>
				<tr>
					<td valign="top">+</td>
					<td valign="top">Klinik Indosehat 2003 tidak bertanggung jawab apabila obat-obatan tidak diambil dalam jangka waktu 7x24 jam.</td>
					<td></td>
					<td valign="top">+</td>
					<td valign="top">Barang dan Jasa yang telah dibeli tidak dapat dikembalikan atau ditukar.</td>
				</tr>
			</table>
		</div>
	</div>
</body>

</html>
