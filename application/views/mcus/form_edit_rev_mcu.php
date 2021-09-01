<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h3 font-weight-bolder">Ubah Formulir Laboratory Result / <i>Edit Form Laboratory Result</i></h1>
	</div>
	<div class="p-3">
		<div class="card">
			<h5 class="card-header font-weight-bolder text-center">Data Pasien / <i>Patient Data</i></h5>
			<div class="card-body">
				<div class="row">
					<div class="col-lg-2">
						<img class="img-thumbnail" width="100" src="<?= base_url('assets/images/patients/' . $data['image']) ?>">
					</div>
					<div class="col-lg-10 ml-n5 mt-3">
						<div class="row mb-1">
							<div class="col-lg-2 font-weight-bold"><i class="fas fa-fw fa-at"></i> Name</div>
							<div class="col-lg-4">: <?= $data['name_patient'] ?></div>
							<div class="col-lg-2 font-weight-bold"><i class="fas fa-fw fa-map-marked-alt"></i> Address</div>
							<div class="col-lg-4">: <?= $data['address'] ?></div>
						</div>
						<div class="row mb-1">
							<div class="col-lg-2 font-weight-bold"><i class="fas fa-fw fa-id-card"></i> ID Number</div>
							<div class="col-lg-4">: <?= $data['id_number_patient'] ?></div>
							<div class="col-lg-2 font-weight-bold"><i class="fas fa-fw fa-building"></i> Company</div>
							<div class="col-lg-4">:
								<?php if ($data['id_company'] == 0) : ?>
									PRIVATE
								<?php else : ?>
									<?= $data['company_name'] ?>
								<?php endif ?>
							</div>
						</div>
						<div class="row mb-1">
							<div class="col-lg-2 font-weight-bold"><i class="fas fa-fw fa-passport"></i> Passport</div>
							<div class="col-lg-4">: <?= $data['passport_number'] ?></div>
							<div class="col-lg-2 font-weight-bold"><i class="fas fa-fw fa-crosshairs"></i> Occupation</div>
							<div class="col-lg-4">: <?= $data['occupation'] ?></div>
						</div>
						<div class="row mb-1">
							<div class="col-lg-2 font-weight-bold"><i class="fas fa-fw fa-birthday-cake"></i> Date of Birth</div>
							<div class="col-lg-4">: <?= $data['place_of_birth'] . ' / ' . date('d F Y', strtotime($data['date_of_birth'])) ?></div>
							<div class="col-lg-2 font-weight-bold"><i class="fas fa-fw fa-list-ol"></i> No. BST</div>
							<div class="col-lg-4">: <?= strtoupper($data['basic_safety_training']) ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<form method="POST" action="<?= base_url('mcu/editUmumRevMcuProcess') ?>" enctype="multipart/form-data" class="p-3 mt-n3">
		<input type="hidden" name="medical_record_number" value="<?= $data['medical_record_number'] ?>">
		<div class="row">
			<div class="col-lg-12">
				<div class="card border-success">
					<div class="card-body">
						<table width="100%">
							<tbody>
								<?php if ($this->session->userdata('role') == 'superuser') : ?>
									<div class="form-group">
										<label for="id_clinic"><b>Klinik / <i>Clinic</i></b></label>
										<select id="id_clinic" class="form-control form-control-sm" name="id_clinic" required>
											<option value="0" disabled selected>Select Clinic</option>
											<?php foreach ($clinics as $clinic) : ?>
												<option value="<?= $clinic['id'] ?>" <?= ($clinic['id'] == $data['id_clinic']) ? ('selected') : ('') ?>><?= $clinic['name'] ?></option>
											<?php endforeach ?>
										</select>
									</div>
								<?php else : 
									$clinic_name = $this->db->get_where('clinics', ['id' => $data['id_clinic']])->row_array();
								?>
									<input type="hidden" name="id_clinic" value="<?= $data['id_clinic'] ?>">
									<div class="form-group">
										<label for="id_clinic"><b>Klinik / <i>Clinic</i></b></label>
										<input type="text" class="form-control form-control-sm" name="id_clinic_name" value="<?= $clinic_name['name'] ?>" disabled>
									</div>
								<?php endif ?>
								<tr>
									<td colspan="6" align="center">
										<label class="font-weight-bolder" for="date_examination">Tanggal Pemeriksaan / <i>Date Examination</i></label>
									</td>
								</tr>
								<tr>
									<td colspan="6">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><span data-feather="calendar"></span></span>
											</div>
											<input type="text" class="form-control form-control-sm" name="date_examination" id="date_examination" value="<?= $data['date_examination'] ?>" required autocomplete="off">
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-sm btn-block btn-warning mt-3"><i class="fas fa-fw fa-save"></i> Ubah / <i>Edit</i></button>
	</form>
</main>

<script>
	jQuery('#date_examination').datetimepicker({
		timepicker: false,
		format: 'Y-m-d'
	});
</script>
