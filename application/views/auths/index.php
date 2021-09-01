<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Sign In | IndoSehat 2003</title>

	<!-- Favicons -->
	<link rel="icon" href="<?= base_url('assets/images/favicons/indosehat2003.png') ?>" type="image/gif">

	<!-- Bootstrap Core CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/bootstrap-4.6.0/css/bootstrap.min.css') ?>">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Viga&display=swap');

		html,
		body {
			height: 100%;
		}

		body {
			display: -ms-flexbox;
			display: flex;
			-ms-flex-align: center;
			align-items: center;
			padding-top: 40px;
			padding-bottom: 40px;
			background-color: #f5f5f5;
		}

		.form-signin {
			width: 100%;
			max-width: 330px;
			padding: 15px;
			margin: auto;
		}

		.form-signin .checkbox {
			font-weight: 400;
		}

		.form-signin .form-control {
			position: relative;
			box-sizing: border-box;
			height: auto;
			padding: 10px;
			font-size: 16px;
		}

		.form-signin .form-control:focus {
			z-index: 2;
		}

		.form-signin input[type="email"] {
			margin-bottom: -1px;
			border-bottom-right-radius: 0;
			border-bottom-left-radius: 0;
		}

		.form-signin input[type="password"] {
			margin-bottom: 10px;
			border-top-left-radius: 0;
			border-top-right-radius: 0;
		}

		.bd-placeholder-img {
			font-size: 1.125rem;
			text-anchor: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}

		@media (min-width: 768px) {
			.bd-placeholder-img-lg {
				font-size: 3.5rem;
			}
		}
	</style>
	<script src="<?= base_url('assets/datetimepicker/jquery.js') ?>"></script>
	<script src="<?= base_url('assets/sweetalert/dist/sweetalert2.all.min.js') ?>"></script>
</head>

<body class="text-center">
	<?= $this->session->flashdata('flash'); ?>
	<form class="form-signin" method="POST" action="<?= base_url('auth/login') ?>">
		<h1 class="h3 mb-3 font-weight-normal" style="font-family: 'Viga', sans-serif;">MCU Record System</h1>
		<img class="img-fluid mb-4" src="<?= base_url('assets/images/logo/indosehat2003.png') ?>" alt="LOGO">
		<h3 class="h4 mb-3 font-weight-normal">Sign In to Apps</h3>
		<label for="email" class="sr-only">Email address</label>
		<input type="email" name="email" id="email" class="form-control" placeholder="Email address" required autofocus autocomplete="off">
		<label for="password" class="sr-only">Password</label>
		<input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
		<button class="btn btn-lg btn-success btn-block" type="submit">Sign in</button>
	</form>
</body>

</html>
