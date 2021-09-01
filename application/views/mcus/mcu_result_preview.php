<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Test Result</title>

	<!-- Favicons -->
	<link rel="icon" href="<?= base_url('assets/images/favicons/indosehat2003.png') ?>" type="image/gif">

	<!-- Bootstrap Core CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/bootstrap-4.6.0/css/bootstrap.min.css') ?>">

	<style>
		@import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap');

		html,
		body {
			height: 100%;
			background-color: white;
			font-family: 'Quicksand', sans-serif;
			font-weight: 500;
			font-size: .925rem;
		}

		body {
			display: -ms-flexbox;
			display: flex;
		}

		.cover-container {
			max-width: 42em;
		}

		.masthead {
			margin-bottom: 2rem;
		}

		.masthead-brand {
			margin-bottom: 0;
		}

		.cover {
			padding: 0 1.5rem;
		}

		.mastfoot {
			font-size: 1rem;
		}

		@media (max-width: 374.98px) {

			html,
			body {
				font-size: .875rem;
			}
		}

		@media (min-width: 375px) and (max-width: 424.98px) {

			html,
			body {
				font-size: .9rem;
			}
		}
	</style>
</head>

<body>
	<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
		<header class="masthead mb-auto">
			<div class="inner p-4 mt-n4">
				<img class="img-fluid" src="<?= base_url('assets/images/logo/indosehat2003.png') ?>" alt="">
			</div>
		</header>

		<main role="main" class="inner cover">
			<table width="100%">
				<tbody>
					<tr>
						<td style="font-weight: 700;">Nama<br><i>Name</i></td>
						<td style="font-weight: 500;">: <?= $data['name_patient'] ?></td>
					</tr>
					<tr>
						<td style="font-weight: 700;">Jenis Kelamin<br><i>Gender</i></td>
						<td style="font-weight: 500;">: <?= $data['gender'] ?></td>
					</tr>
					<tr>
						<td style="font-weight: 700;">Tanggal Lahir<br><i>Date of Birth</i></td>
						<td style="font-weight: 500;">: <?= date('d F Y', strtotime($data['date_of_birth'])) ?></td>
					</tr>
					<tr>
						<td style="font-weight: 700;">KTP<br><i>ID Number</i></td>
						<td style="font-weight: 500;">: <?= $data['id_number_patient'] ?></td>
					</tr>
					<tr>
						<td style="font-weight: 700;">Paspor<br><i>Passport</i></td>
						<td style="font-weight: 500;">: <?= $data['passport_number'] ?></td>
					</tr>
					<tr>
						<td style="font-weight: 700;">Perusahaan<br><i>Company</i></td>
						<td style="font-weight: 500;">: <?= ($data['id_company'] == 0) ? ('PRIVATE') : ($data['company_name']) ?></td>
					</tr>
				</tbody>
			</table>
			<table width="100%" class="mt-3">
				<tbody>
					<tr>
						<td align="center">
							Telah melakukan
							<b><i>
									<?php if ($data['type_examination'] == 'umum') : ?>
										Medical Check Up
									<?php elseif ($data['type_examination'] == 'rev') : ?>
										Revalidasi
									<?php elseif ($data['type_examination'] == 'mcu') : ?>
										Medical Check Up
									<?php endif ?>
								</i></b> pada <b><?= date('d F Y', strtotime($data['date_examination'])) ?></b>, dengan hasil :
						</td>
					</tr>
					<tr>
						<td align="center" style="font-style: italic;">
							Has carried out the <b><i>
									<?php if ($data['type_examination'] == 'umum') : ?>
										Medical Check Up
									<?php elseif ($data['type_examination'] == 'rev') : ?>
										Revalidation
									<?php elseif ($data['type_examination'] == 'mcu') : ?>
										Medical Check Up
									<?php endif ?>
								</i></b> on <b><?= date('d F Y', strtotime($data['date_examination'])) ?></b>, with the results :
						</td>
					</tr>
					<tr>
						<td align="center" style="font-size: 1.5rem;">
							<?php if ($data['is_fit'] == '0') : ?>
								<div class="label-hasil">
									<span class="badge badge-pill badge-danger">NOT FIT</span>
								</div>
							<?php else : ?>
								<div class="label-hasil">
									<span class="badge badge-pill badge-success">FIT</span>
								</div>
							<?php endif ?>
						</td>
					</tr>
				</tbody>
			</table>
			<table width="100%" class="mt-3 mb-3">
				<tbody>
					<tr>
						<td align="center">
							Tekan tombol Unduh, untuk mengunduh file hasil <b><i>Medical Check Up</i></b>
						</td>
					</tr>
					<tr>
						<td align="center" style="font-style: italic;">
							Press the Download button, to download the <b><i>Medical Check Up</i></b> result file
						</td>
					</tr>
					<tr>
						<td align="center" style="font-size: 1.5rem;">
							<?php if ($data['type_examination'] == 'umum') : ?>
								
							<?php elseif ($data['type_examination'] == 'rev') : ?>
								<a href="<?= base_url('mcu/downloadRevResultPdf/') . $data['medical_record_number'] ?>" class="badge badge-pill badge-info">UNDUH / <i>DOWNLOAD</i></a>
							<?php elseif ($data['type_examination'] == 'mcu') : ?>
								<a href="<?= base_url('mcu/downloadMcuResultPdf/') . $data['medical_record_number'] ?>" class="badge badge-pill badge-info">UNDUH / <i>DOWNLOAD</i></a>
							<?php endif ?>
						</td>
					</tr>
				</tbody>
			</table>
		</main>

		<footer class="mastfoot mt-auto text-center font-weight-bold">
			<?php
			$masa_berlaku = strtotime($data['date_examination']) + 63072000;
			?>
			<div class="tgl-berlaku">
				Berlaku sampai dengan tanggal / <i>valid until the date</i> <?= date('d F Y', $masa_berlaku) ?>
			</div>
		</footer>
	</div>

	<script src="<?= base_url('assets/datetimepicker/jquery.js') ?>"></script>
	<script src="<?= base_url('assets/bootstrap-4.6.0/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>
