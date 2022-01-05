<div class="navbar-backdrop" id="navbarBackdrop" style="position: absolute; top: 0;">
    <nav class="navbar-fixed navbar-dark">
        <div class="nav-header text-center">
            <?php if ($this->session->userdata('site') == 2) : ?>
                <img class="img-fluid" src="<?= base_url('assets/images/logo/indosehat2003-semarang.png') ?>" alt="Klinik Indosehat 2003 Semarang">
            <?php elseif ($this->session->userdata('site') == 3) :?>
                <img class="img-fluid" src="<?= base_url('assets/images/logo/indosehat2003-surabaya.png') ?>" alt="Klinik Indosehat 2003 Surabaya">
            <?php elseif ($this->session->userdata('site') == 4) :?>
                <img class="img-fluid" src="<?= base_url('assets/images/logo/indosehat2003-tegal.png') ?>" alt="Klinik Indosehat 2003 Tegal">
            <?php else :?>
                <img class="img-fluid" src="<?= base_url('assets/images/logo/indosehat2003.png') ?>" alt="Klinik Indosehat 2003">
            <?php endif ?>
        </div>

        <ul class="list-group list-group-flush">
            <li class="list-group-item <?php if ($title == 'Dashboard') : ?> active <?php endif ?>">
                <a href="<?= base_url() ?>">
                    <i class="far fa-fw fa-chart-bar"></i> Dashboard
                </a>
            </li>
            <?php if ($this->session->userdata('role') == 'superuser') : ?>
                <li class="list-group-item <?php if ($title == 'Pengguna') : ?> active <?php endif ?>">
                    <a href="<?= base_url('user') ?>">
                        <i class="fas fa-fw fa-chalkboard-teacher"></i> Pengguna
                    </a>
                </li>
                <li class="list-group-item <?php if ($title == 'Klinik') : ?> active <?php endif ?>">
                    <a href="<?= base_url('clinic') ?>">
                        <i class="fas fa-fw fa-clinic-medical"></i> Klinik
                    </a>
                </li>
            <?php endif ?>
            <?php if ($this->session->userdata('role') == 'superuser' || $this->session->userdata('role') == 'admin') : ?>
                <li class="list-group-item <?php if ($title == 'Perusahaan') : ?> active <?php endif ?>">
                    <a href="<?= base_url('company') ?>">
                        <i class="fas fa-fw fa-city"></i> Perusahaan
                    </a>
                </li>
            <?php endif ?>
            <?php if ($this->session->userdata('role') == 'superuser' || $this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'doctor') : ?>
                <li class="list-group-item <?php if ($title == 'Pasien') : ?> active <?php endif ?>">
                    <a href="<?= base_url('patient') ?>">
                        <i class="fas fa-fw fa-users"></i> Pasien
                    </a>
                </li>
            <?php endif ?>
            <?php if ($this->session->userdata('role') == 'superuser' || $this->session->userdata('role') == 'examinator') : ?>
                <li class="list-group-item <?php if ($title == 'Cek Pasien') : ?> active <?php endif ?>">
                    <a href="<?= base_url('patient/indexCheck') ?>">
                        <i class="fas fa-fw fa-person-booth"></i> Cek Pasien</li>
                    </a>
                </li>
            <?php endif ?>
            <?php if ($this->session->userdata('role') == 'superuser' || $this->session->userdata('role') == 'admin') : ?>
                <li class="list-group-item <?php if ($title == 'Transaksi') : ?> active <?php endif ?>">
                    <a href="<?= base_url('transaction') ?>">
                        <i class="fas fa-fw fa-cash-register"></i> Transaksi
                    </a>
                </li>
            <?php endif ?>
            <?php if ($this->session->userdata('role') == 'superuser' || $this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'doctor') : ?>
                <li class="list-group-item <?php if ($title == 'Hasil Lab') : ?> active <?php endif ?>">
                    <a href="<?= base_url('mcu') ?>">
                        <i class="fas fa-fw fa-book-medical"></i> Hasil Lab
                    </a>
                </li>
            <?php endif ?>
        </ul>
    </nav>
</div>

<div id="page-wrapper">
    <div class="rows border-bottom">
        <nav class="navbar navbar-static-top col-md-12 no-padding">
            <ul class="col-md-12 col-sm-12 navbar-top-links navbar-right">
                <div class="mobile-tab">
                    <input type="checkbox" id="mobile-tab" style="display: none;">
                    <label for="mobile-tab" class="mobile-tab-pointer"><i class="fas fa-bars"></i></label>
                </div>
                <li class="user-name">
                    <span>
                        <a href="#" class="dropdown-toggle" id="dropdownProfile" data-toggle="dropdown">
                            <span title="Endar Deby Kurniawan"><?= $this->session->userdata('name') ?></span> 
                        </a>

                        <div class="dropdown-menu ml-5" aria-labelledby="dropdownProfile">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt"></i> Keluar</a>
                        </div>
                    </span>
                </li>
            </ul>
        </nav>
    </div>

    <div class="rows mobile-tab-content">
        <ul class="list-group list-group-flush">
            <li class="list-group-item active">
                <a href="<?= base_url() ?>">
                    <i class="far fa-fw fa-chart-bar"></i> Dashboard
                </a>
            </li>
            <?php if ($this->session->userdata('role') == 'superuser') : ?>
                <li class="list-group-item">
                    <a href="<?= base_url('user') ?>">
                        <i class="fas fa-fw fa-chalkboard-teacher"></i> Pengguna
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="<?= base_url('clinic') ?>">
                        <i class="fas fa-fw fa-clinic-medical"></i> Klinik
                    </a>
                </li>
            <?php endif ?>
            <?php if ($this->session->userdata('role') == 'superuser' || $this->session->userdata('role') == 'admin') : ?>
                <li class="list-group-item">
                    <a href="<?= base_url('company') ?>">
                        <i class="fas fa-fw fa-city"></i> Perusahaan
                    </a>
                </li>
            <?php endif ?>
            <?php if ($this->session->userdata('role') == 'superuser' || $this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'doctor') : ?>
                <li class="list-group-item">
                    <a href="<?= base_url('patient') ?>">
                        <i class="fas fa-fw fa-users"></i> Pasien
                    </a>
                </li>
            <?php endif ?>
            <?php if ($this->session->userdata('role') == 'superuser' || $this->session->userdata('role') == 'examinator') : ?>
                <li class="list-group-item">
                    <a href="<?= base_url('patient/indexCheck') ?>">
                        <i class="fas fa-fw fa-person-booth"></i> Cek Pasien</li>
                    </a>
                </li>
            <?php endif ?>
            <?php if ($this->session->userdata('role') == 'superuser' || $this->session->userdata('role') == 'admin') : ?>
                <li class="list-group-item">
                    <a href="<?= base_url('transaction') ?>">
                        <i class="fas fa-fw fa-cash-register"></i> Transaksi
                    </a>
                </li>
            <?php endif ?>
            <?php if ($this->session->userdata('role') == 'superuser' || $this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'doctor') : ?>
                <li class="list-group-item">
                    <a href="<?= base_url('mcu') ?>">
                        <i class="fas fa-fw fa-book-medical"></i> Hasil Lab
                    </a>
                </li>
            <?php endif ?>
        </ul>
    </div>

    <div class="rows">
        <div class="page-heading">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <?php if (isset($subtitle)) : ?>
                        <li class="breadcrumb-item"><a href="#"><i class="far fa-chart-bar"></i> <?= $title ?></a></li>
                        <li class="breadcrumb-item active"><a href="#"><?= $subtitle ?></a></li>
                    <?php else : ?>
                        <li class="breadcrumb-item active"><a href="#"><i class="far fa-chart-bar"></i> <?= $title ?></a></li>
                    <?php endif ?>
                    
                    <?php if ($title == 'Perusahaan') : ?>
                        <div class="col-md-12" style="margin-top: -23px;">                        
                            <button class="btn btn-sm btn-info float-right mt-n2" data-toggle="modal" data-target="#addCompany"><i class="fas fa-plus"></i> Tambah Perusahaan</button>
                        </div>
                    <?php elseif ($title == 'Pasien' && !isset($subtitle)) : ?>
                        <div class="col-md-12" style="margin-top: -23px;">                        
                            <a href="<?= base_url('patient/registrationPatient') ?>" class="btn btn-sm btn-info float-right mt-n2"><i class="fas fa-plus"></i> Pendaftaran Pasien</a>
                        </div>
                    <?php elseif ($title == 'Hasil Lab' && !isset($subtitle)) : ?>
                        <?php if ($this->session->userdata('role') == 'superuser' || $this->session->userdata('role') == 'admin') : ?>
                            <div class="col-md-12" style="margin-top: -23px;">                        
                                <button class="btn btn-sm btn-info float-right mt-n2" data-toggle="modal" data-target="#exportMcu"><i class="far fa-file-excel"></i> Ekspor</button>
                            </div>
                        <?php endif ?>
                    <?php endif ?>
                </ol>
            </nav>
        </div>
    </div>