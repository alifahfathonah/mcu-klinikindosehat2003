<div class="rows main-page">
	<div class="page">
		<div class="row">
			<div class="col-md-8">
				<form action="<?= base_url('mcu/editUmumRevMcuProcess') ?>" method="POST">
					<input type="hidden" name="medical_record_number" value="<?= $data['medical_record_number'] ?>">
					<div class="row">
						<div class="col-md-8">
							<?php if ($this->session->userdata('role') == 'superuser') : ?>
								<div class="form-group">
									<label class="label-input-result" for="id_clinic">Klinik</label>
									<select class="form-control value-input-result" id="id_clinic" name="id_clinic" required>
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
									<label class="label-input-result" for="id_clinic_name">Klinik</label>
									<input type="text" class="form-control value-input-result" id="id_clinic_name" name="id_clinic_name" value="<?= $clinic_name['name'] ?>" disabled>
								</div>
							<?php endif ?>
							<div class="form-group">
								<label class="label-input-result" for="date_examination">Tanggal Pemeriksaan</label>
								<input type="text" class="form-control value-input-result" id="date_examination" name="date_examination" value="<?= $data['date_examination'] ?>" required autocomplete="off" readonly style="background-color: transparent; cursor: pointer;">
							</div>
						</div>
						<div class="col-md-4 text-center">
							<img class="img-fluid rounded" width="120px" src="<?= ($data['image'] == '') ? (base_url('assets/images/patients/default.png')) : (base_url('assets/images/patients/' . $data['image'])) ?>">
						</div>
					</div>
					<div class="row mt-3 mr-1">
						<div class="col-md-12">
							<button type="submit" class="btn btn-block btn-warning mt-2">
								<i class="fas fa-fw fa-save"></i> Ubah
							</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-4 rounded" style="background-color: #f4f6fa; margin-left: -15px; padding: 10px;">
				<div class="form-group">
					<label class="label-desc-patient">Nama</label>
					<input type="text" class="form-control-plaintext value-desc-patient mt-n3" value="<?= $data['name_patient'] ?>" readonly>
				</div>
				<div class="form-group mt-n2">
					<label class="label-desc-patient">NIK</label>
					<input type="text" class="form-control-plaintext value-desc-patient mt-n3" value="<?= $data['id_number_patient'] ?>" readonly>
				</div>
				<div class="form-group mt-n2">
					<label class="label-desc-patient">Nomor Paspor</label>
					<input type="text" class="form-control-plaintext value-desc-patient mt-n3" value="<?= $data['passport_number'] ?>" readonly>
				</div>
				<div class="form-group mt-n2">
					<label class="label-desc-patient">Jenis Kelamin</label>
					<input type="text" class="form-control-plaintext value-desc-patient mt-n3" value="<?= $data['gender'] ?>" readonly>
				</div>
				<div class="form-group mt-n2">
					<label class="label-desc-patient">Tempat / Tanggal Lahir</label>
					<input type="text" class="form-control-plaintext value-desc-patient mt-n3" value="<?= $data['place_of_birth'] . ' / ' . date('d F Y', strtotime($data['date_of_birth'])) ?>" readonly>
				</div>
				<div class="form-group mt-n2">
					<label class="label-desc-patient">No. Basic Safety Training</label>
					<input type="text" class="form-control-plaintext value-desc-patient mt-n3" value="<?= $data['basic_safety_training'] ?>" readonly>
				</div>
				<div class="form-group mt-n2">
					<label class="label-desc-patient">Perusahaan</label>
					<input type="text" class="form-control-plaintext value-desc-patient mt-n3" value="<?= ($data['id_company'] == 0) ? ('PRIVATE') : ($data['company_name']) ?>" readonly>
				</div>
				<div class="form-group mt-n2">
					<label class="label-desc-patient">Jabatan</label>
					<input type="text" class="form-control-plaintext value-desc-patient mt-n3" value="<?= $data['occupation'] ?>" readonly>
				</div>
				<div class="form-group mt-n2">
					<label class="label-desc-patient">Kewarganegaraan</label>
					<input type="text" class="form-control-plaintext value-desc-patient mt-n3" value="<?= $data['nationality'] ?>" readonly>
				</div>
				<div class="form-group mt-n2">
					<label class="label-desc-patient">Alamat</label>
					<textarea class="form-control-plaintext value-desc-patient mt-n3" readonly><?= $data['address'] ?></textarea>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	jQuery('#date_examination').datetimepicker({
		timepicker: false,
		format: 'Y-m-d'
	});
</script>