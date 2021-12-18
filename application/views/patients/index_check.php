<div class="rows main-page">
	<div class="filter-wrapper">
		<form class="row" action="<?= base_url('patient/indexCheck') ?>" method="POST">
			<div id="input-filters-date"></div>
			<div class="col-md-10">
				<div class="form-group">
					<label for="filter-by-data" class="label-filter">Cari</label>
					<input type="text" class="form-control form-control-sm" id="filter-by-data" name="filter-by-data" placeholder="Masukkan nama / alamat perusahaan..." value="<?= ($this->session->userdata('filterByDataPatientCheck') !== '') ? ($this->session->userdata('filterByDataPatientCheck')) : ('') ?>">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label class="label-filter">&nbsp;</label>
					<input class="btn btn-sm btn-block btn-success" type="submit" name="filter" value="Filter" style="background-color: #04AA6D;">
				</div>
			</div>
		</form>
	</div>
	<div class="row m-3">
		<?php foreach ($patients as $patient) : ?>
			<div class="col-md-4">
				<div class="card mb-3" style="max-width: 540px;">
					<div class="row no-gutters">
						<div class="col-md-4 my-auto mx-auto text-center">
							<img class="img-fluid rounded" src="<?= ($patient['image'] == '') ? (base_url('assets/images/patients/default.png')) : (base_url('assets/images/patients/' . $patient['image'])) ?>">
						</div>
						<div class="col-md-8">
							<div class="card-body">
								<p class="card-title h5 font-weight-bolder" style="color: #444;"><?= ($patient['mcu_manual'] != NULL) ? ($patient['mcu_manual']) : ($patient['medical_record_number']) ?></p>
								<p class="mt-n3"><small>(<?= date('D, d M Y / H:i', strtotime($patient['created_at'])) ?>)</small></p>
								<table style="font-size: 13px; color: #777;">
									<tr>
										<td><?= $patient['name_patient'] ?></td>
									</tr>
									<tr>
										<td><?= $patient['id_number_patient'] ?></td>
									</tr>
									<tr>
										<td><?= ($patient['id_company'] == 0) ? ('PRIVATE') : ($patient['company_name']) ?></td>
									</tr>
								</table>
								<div class="text-right mt-3">
									<a href="<?= base_url('patient/detailIndexCheck/') . md5($patient['mcu_manual']) . '/' . $patient['medical_record_number'] ?>" style="text-decoration: none; color: #555;">Lihat <i class="fas fa-arrow-right"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach ?>
	</div>
	<div class="mt-1 m-3">
		<div class="row">
			<div class="col-lg-6">
				<span class="pagination-total">Menampilkan <?= ($total_data < 1) ? $total_data : ($this->uri->segment(3)+1) ?> - <?= ($this->uri->segment(3)+15 > $total_data) ? ($total_data) : ($this->uri->segment(3)+15) ?> dari <?= $total_data ?> data</span>
			</div>
			<div class="col-lg-6">				
				<?= $this->pagination->create_links(); ?>
			</div>
		</div>
	</div>
</div>