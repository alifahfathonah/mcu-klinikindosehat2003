<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?= $title ?> | MCU IndoSehat 2003</title>

	<!-- Favicons -->
	<link rel="icon" href="<?= base_url('assets/images/favicons/indosehat2003.png') ?>" type="image/gif">

	<!-- Bootstrap Core CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/bootstrap-4.6.0/css/bootstrap.min.css') ?>">

	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/datetimepicker/jquery.datetimepicker.css') ?>">

	<!-- Datatables -->
	<link rel="stylesheet" href="<?= base_url('assets/datatables/datatables.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/datatables/bootstrap4/css/dataTables.bootstrap4.min.css') ?>">

	<!-- Style For This Dashboard -->
	<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

	<!-- Datetimepicker JS -->
	<script src="<?= base_url('assets/datetimepicker/jquery.js') ?>"></script>
	<script src="<?= base_url('assets/datetimepicker/build/jquery.datetimepicker.full.min.js') ?>"></script>

	<!-- Sweetalert -->
	<script src="<?= base_url('assets/sweetalert/dist/sweetalert2.all.min.js') ?>"></script>

	<!-- Fontawesome -->
	<script src="https://kit.fontawesome.com/5d1f417d80.js" crossorigin="anonymous"></script>
</head>

<body>
	<?= $this->session->flashdata('flash'); ?>
