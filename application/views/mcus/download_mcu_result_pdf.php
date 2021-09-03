<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Document</title>
	<style>
		html,
		body {
			font-family: Arial, Helvetica, sans-serif;
		}

		table td {
			font-size: 12px;
		}

		.box {
			width: 114px;
			height: 152px;
			border: 1px solid black;
			margin-left: 80%;
			margin-top: -165px;
		}

		/* Page 2 */

		.container-page-2 {
			margin: 0px 50px 0 50px;
		}

		.container-page-2 table td {
			font-size: 10.5px;
		}
	</style>
</head>

<?php if ($data['id_clinic'] == 1) : ?>
	<body style='background-image: url("<?= base_url('assets/images/pdftemplate/kop-cilincing.png') ?>"); background-position: top left; background-repeat: no-repeat; background-image-resize: 4; background-image-resolution: from-image;'>
<?php elseif ($data['id_clinic'] == 2) : ?>
	<body style='background-image: url("<?= base_url('assets/images/pdftemplate/kop-semarang.png') ?>"); background-position: top left; background-repeat: no-repeat; background-image-resize: 4; background-image-resolution: from-image;'>
<?php elseif ($data['id_clinic'] == 3) : ?>
	<body style='background-image: url("<?= base_url('assets/images/pdftemplate/kop-surabaya.png') ?>"); background-position: top left; background-repeat: no-repeat; background-image-resize: 4; background-image-resolution: from-image;'>
<?php elseif ($data['id_clinic'] == 4) : ?>
	<body style='background-image: url("<?= base_url('assets/images/pdftemplate/kop-tegal.png') ?>"); background-position: top left; background-repeat: no-repeat; background-image-resize: 4; background-image-resolution: from-image;'>
<?php elseif ($data['id_clinic'] == 5) : ?>
	<body style='background-image: url("<?= base_url('assets/images/pdftemplate/kop-warakas.png') ?>"); background-position: top left; background-repeat: no-repeat; background-image-resize: 4; background-image-resolution: from-image;'>
<?php endif ?>

<div style="margin-left: 75px; margin-right: 75px;">
	<table width="100%">
		<tr>
			<td align="center">
				<p style="font-size: 20px;"><b><u>SURAT KETERANGAN</u></b><br><i>TO WHOM IT MAY CONCERN</i><br><br>&nbsp;</p>
			</td>
		</tr>
	</table>
	<div style="display: flex;">
		<div>
			<table width="63%">
				<tr>
					<td colspan="2">
						<b>Dengan ini kami menerangkan bahwa :</b><br><i>Here with acknowledge that :</i><br><br><br><br>
					</td>
				</tr>
				<tr>
					<td width="23%"><b>Nama</b><br><i>Name</i></td>
					<td width="40%">: <?= $data['name_patient'] ?></td>
				</tr>
				<tr>
					<td><b>Jenis Kelamin</b><br><i>Gender/Sex</i></td>
					<td>: <?= $data['gender'] ?></td>
				</tr>
				<tr>
					<td><b>Tempat / Tanggal Lahir</b><br><i>Place / Date Of Birth</i></td>
					<td>: <?= $data['place_of_birth'] . ' / ' . strtoupper(date('F d, Y', strtotime($data['date_of_birth']))) ?></td>
				</tr>
				<tr>
					<td><b>Perusahaan</b><br><i>Company</i></td>
					<td>: <?= ($data['id_company'] == 0) ? ('PRIVATE') : ($data['company_name']) ?></td>
				</tr>
				<tr>
					<td><b>Jabatan</b><br><i>Occupation</i></td>
					<td>: <?= $data['occupation'] ?></td>
				</tr>
			</table>
		</div>
		<div>
			<div class="box"></div>
		</div>
	</div>
	<table width="100%">
		<tr>
			<td>
				<br><br><b>Benar telah melakukan Medical Check-Up di Indosehat 2003 Medical Centre.</b><br><i>Have trully complete Medical Standart Check-Up in Indosehat 2003 Medical Centre.</i><br><br>
			</td>
		</tr>
	</table>
	<table width="100%">
		<tr>
			<td width="15%"><b>Dengan Hasil</b><br><i>With Final Result</i></td>
			<td width="85%">
				<?php if ($data['is_fit'] == 0) : ?>
				<b>: Tidak Sehat untuk Bertugas.</b>
				<?php elseif ($data['is_fit'] == 1) : ?>
				<b>: Sehat untuk Bertugas.</b>
				<?php else : ?>
				<b>: Sehat dengan Resep Obat.</b>
				<?php endif; ?>
				<br>
				<?php if ($data['is_fit'] == 0) : ?>
				<i>: UNFIT.</i>
				<?php elseif ($data['is_fit'] == 1) : ?>
				<i>: FIT.</i>
				<?php else : ?>
				<i>: FIT WITH MEDICINE.</i>
				<?php endif; ?>
			</td>
		</tr>
	</table>
	<br>
	<table width="100%">
		<tr>
			<td colspan="2">
				<b>Demikian surat keterangan ini kami sampaikan untuk dapat dipergunakan sebagaimana mestinya.</b><br><i>I hope this letter will be found useful where necess.</i>
			</td>
		</tr>
	</table>
	<br>
	<table width="100%" style="margin-top: 12.5px;">
		<?php if ($data['id_clinic'] == 1) : ?>
			<tr>
				<td align="center" width="25%;">
					<img src="<?= base_url("assets/images/qrcode/") . $data['qrcode'] ?>" width="115px">
					<p style="font-size: 16px;"><?= $data['name_patient'] ?></p>
				</td>
				<td width="45%"></td>
				<td align="center">
					<p style="font-size: 16px;">Jakarta, <?= date('d F Y', strtotime($data["date_examination"])) ?></p>
					<br>
					<img src="<?= base_url("assets/images/pdftemplate/dic-said.png") ?>" width="400px" style="margin-top: -25px; margin-bottom: -35px;">
					<p style="font-size: 16px;"><b>dr. Said Husain<b></p>
					<p style="font-size: 16px;"><i>Examination</i></p>
				</td>
			</tr>
		<?php elseif ($data['id_clinic'] == 2) : ?>
			<tr>
				<td align="center" width="25%;">
					<img src="<?= base_url("assets/images/qrcode/") . $data['qrcode'] ?>" width="115px">
					<p style="font-size: 16px;"><?= $data['name_patient'] ?></p>
				</td>
				<td width="45%"></td>
				<td align="center">
					<p style="font-size: 16px;">Jakarta, <?= date('d F Y', strtotime($data["date_examination"])) ?></p>
					<br>
					<img src="<?= base_url("assets/images/pdftemplate/dic.png") ?>" width="400px" style="margin-top: -25px; margin-bottom: -35px;">
					<p style="font-size: 16px;"><b>dr. Abdul Hr Korompot, MARS<b></p>
					<p style="font-size: 16px;"><i>Examination</i></p>
				</td>
			</tr>
		<?php elseif ($data['id_clinic'] == 3) : ?>
			<tr>
				<td align="center" width="25%;">
					<img src="<?= base_url("assets/images/qrcode/") . $data['qrcode'] ?>" width="115px">
					<p style="font-size: 16px;"><?= $data['name_patient'] ?></p>
				</td>
				<td width="45%"></td>
				<td align="center">
					<p style="font-size: 16px;">Jakarta, <?= date('d F Y', strtotime($data["date_examination"])) ?></p>
					<br>
					<img src="<?= base_url("assets/images/pdftemplate/dic.png") ?>" width="400px" style="margin-top: -25px; margin-bottom: -35px;">
					<p style="font-size: 16px;"><b>dr. Abdul Arif Irsan<b></p>
					<p style="font-size: 16px;"><i>Examination</i></p>
				</td>
			</tr>
		<?php elseif ($data['id_clinic'] == 4) : ?>
			<tr>
				<td align="center" width="25%;">
					<img src="<?= base_url("assets/images/qrcode/") . $data['qrcode'] ?>" width="115px">
					<p style="font-size: 16px;"><?= $data['name_patient'] ?></p>
				</td>
				<td width="45%"></td>
				<td align="center">
					<p style="font-size: 16px;">Jakarta, <?= date('d F Y', strtotime($data["date_examination"])) ?></p>
					<br>
					<img src="<?= base_url("assets/images/pdftemplate/dic.png") ?>" width="400px" style="margin-top: -25px; margin-bottom: -35px;">
					<p style="font-size: 16px;"><b>dr. Rudolf Fernando Wibowo<b></p>
					<p style="font-size: 16px;"><i>Examination</i></p>
				</td>
			</tr>
		<?php elseif ($data['id_clinic'] == 5) : ?>
			<tr>
				<td align="center" width="25%;">
					<img src="<?= base_url("assets/images/qrcode/") . $data['qrcode'] ?>" width="115px">
					<p style="font-size: 16px;"><?= $data['name_patient'] ?></p>
				</td>
				<td width="45%"></td>
				<td align="center">
					<p style="font-size: 16px;">Jakarta, <?= date('d F Y', strtotime($data["date_examination"])) ?></p>
					<br>
					<img src="<?= base_url("assets/images/pdftemplate/dic-widha.png") ?>" width="400px" style="margin-top: -25px; margin-bottom: -35px;">
					<p style="font-size: 16px;"><b>dr. Widha Puji Ismayawati<b></p>
					<p style="font-size: 16px;"><i>Examination</i></p>
				</td>
			</tr>
		<?php endif ?>
	</table>
	<table width="100%">
		<tr>
			<td>
				<b style="text-align:left !important;">Date Of Examination, <?= date('F d, Y', strtotime($data["date_examination"])) ?></b>
				<br>
				
				<?php
					if ($data['validity_period'] == '0') {
						$masa_berlaku = 63072000;	
					} else {
						$masa_berlaku = 31536000;
					}
				?>

				<b>Expiration Of Validity, <?= date('F d, ', strtotime($data["date_examination"])) . date('Y', strtotime($data["date_examination"]) + $masa_berlaku) ?></b>
			</td>
		</tr>
	</table>
</div>
</body>

</html>
