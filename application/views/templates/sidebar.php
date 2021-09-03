<div class="container-fluid">
	<div class="row">
		<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
			<div class="sidebar-sticky pt-3">
				<ul class="nav flex-column">
					<li class="nav-item">
						<a class="nav-link <?php if ($title == 'Dashboard') : ?> active <?php endif ?>" href="<?= base_url('') ?>">
							<span data-feather="cpu"></span>
							Dasbor / <i>Dashboard</i> <span class="sr-only">(current)</span>
						</a>
					</li>
					<?php if ($this->session->userdata('role') == 'superuser') : ?>
						<li class="nav-item">
							<a class="nav-link <?php if ($title == 'Users') : ?> active <?php endif ?>" href="<?= base_url('user') ?>">
								<span data-feather="user"></span>
								Pengguna / <i>Users</i>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?php if ($title == 'Clinics') : ?> active <?php endif ?>" href="<?= base_url('clinic') ?>">
								<span data-feather="home"></span>
								Klinik / <i>Clinics</i>
							</a>
						</li>
					<?php endif ?>
					<?php if ($this->session->userdata('role') == 'superuser' || $this->session->userdata('role') == 'admin') : ?>
						<li class="nav-item">
							<a class="nav-link <?php if ($title == 'Company') : ?> active <?php endif ?>" href="<?= base_url('company') ?>">
								<span data-feather="map"></span>
								Perusahaan / <i>Company</i>
							</a>
						</li>
					<?php endif ?>
					<li class="nav-item">
						<a class="nav-link <?php if ($title == 'Patient') : ?> active <?php endif ?>" href="<?= base_url('patient') ?>">
							<span data-feather="users"></span>
							Pasien / <i>Patient</i>
						</a>
					</li>
					<?php if ($this->session->userdata('role') == 'superuser' || $this->session->userdata('role') == 'admin') : ?>
						<li class="nav-item">
							<a class="nav-link <?php if ($title == 'Transaction') : ?> active <?php endif ?>" href="<?= base_url('transaction') ?>">
								<span data-feather="dollar-sign"></span>
								Transaksi / <i>Transaction</i>
							</a>
						</li>
					<?php endif ?>
					<li class="nav-item">
						<a class="nav-link <?php if ($title == 'MCU') : ?> active <?php endif ?>" href="<?= base_url('mcu') ?>">
							<span data-feather="bar-chart-2"></span>
							Hasil Laboratorium / <i>Laboratory Result</i>
						</a>
					</li>
				</ul>
			</div>
		</nav>
