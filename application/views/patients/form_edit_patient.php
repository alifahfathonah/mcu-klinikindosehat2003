<div class="rows main-page">
	<div class="page">
		<div class="row">
			<div class="col-md-10">
				<form action="<?= base_url('patient/editPatient') ?>" method="POST">
					<input type="hidden" name="id" value="<?= $patient['id'] ?>">
					<div class="row mr-1">
						<div class="col-md-6">
							<div class="form-group">
								<label class="label-input-result" for="id_number">KTP</label>
								<input type="text" class="form-control value-input-result" id="id_number" name="id_number" value="<?= $patient['id_number'] ?>" required autocomplete="off">
							</div>
							<div class="form-group">
								<label class="label-input-result" for="name">Nama</label>
								<input type="text" class="form-control value-input-result" id="name" name="name" value="<?= $patient['name'] ?>" required autocomplete="off">
							</div>
							<div class="form-group">
								<label class="label-input-result" for="place_of_birth">Tempat Lahir</label>
								<input type="text" class="form-control value-input-result" id="place_of_birth" place_of_birth="place_of_birth" value="<?= $patient['place_of_birth'] ?>" required autocomplete="off">
							</div>
							<div class="form-group">
								<label class="label-input-result" for="basic_safety_training">Nomor BST</label>
								<input type="text" class="form-control value-input-result" id="basic_safety_training" basic_safety_training="basic_safety_training" value="<?= $patient['basic_safety_training'] ?>" required autocomplete="off">
							</div>
							<div class="form-group">
								<label class="label-input-result" for="id_company">Perusahaan</label>
								<select class="form-control value-input-result selectpicker" data-live-search="true" data-style="btn-info" id="id_company" name="id_company" required>
									<option value="" disabled selected>Pilih Perusahaan Pasien / Select Patient Company</option>
									<option value="0" <?php if ($patient['id_company'] == 0) : ?> selected <?php endif ?>>PRIVATE</option>
									<?php foreach ($companies as $company) : ?>
										<option value="<?= $company['id'] ?>" <?php if ($patient['id_company'] == $company['id']) : ?> selected <?php endif ?>><?= $company['name'] ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="label-input-result" for="passport_number">Nomor Paspor</label>
								<input type="text" class="form-control value-input-result" id="passport_number" name="passport_number" value="<?= $patient['passport_number'] ?>" required autocomplete="off">
							</div>
							<div class="form-group">
								<label class="label-input-result" for="gender">Jenis Kelamin</label>
								<select class="form-control value-input-result" id="gender" name="gender" required>
									<option value="0" disabled selected>Pilih jenis kelamin</option>
									<option value="PRIA/MALE" <?= ($patient['gender'] == 'PRIA/MALE' ? ('selected') : ('')) ?>>Pria</option>
									<option value="PEREMPUAN/FEMALE" <?= ($patient['gender'] == 'PEREMPUAN/FEMALE' ? ('selected') : ('')) ?>>Wanita</option>
								</select>
							</div>
							<div class="form-group">
								<label class="label-input-result" for="date_of_birth">Tanggal Lahir</label>
								<input type="text" class="form-control value-input-result" id="date_of_birth" name="date_of_birth" value="<?= $patient['date_of_birth'] ?>" required autocomplete="off" readonly style="background-color: transparent; cursor: pointer;">
							</div>
							<div class="form-group">
								<label class="label-input-result" for="nationality">Kewarganegaraan</label>
								<input type="text" class="form-control value-input-result" id="nationality" nationality="nationality" value="<?= $patient['nationality'] ?>" required autocomplete="off">
							</div>
							<div class="form-group">
								<label class="label-input-result" for="occupation">Jabatan</label>
								<input type="text" class="form-control value-input-result" id="occupation" occupation="occupation" value="<?= $patient['occupation'] ?>" required autocomplete="off">
							</div>
						</div>
					</div>
					<div class="row mr-1">
						<div class="col-md-12">
							<div class="form-group mt-n1">
								<label class="label-input-result" for="address">Alamat</label>
								<textarea class="form-control value-input-result mt-n1" id="address" name="address" rows="3" autocomplete="off"><?= $patient['address'] ?></textarea>
							</div>
							<button type="submit" class="btn btn-block btn-warning mt-2">
								<i class="fas fa-fw fa-save"></i> Ubah
							</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-2 text-center" style="background-color: #f4f6fa; margin-left: -15px; padding: 10px;">
				<img class="img-fluid rounded" src="<?= ($patient['image'] == '') ? (base_url('assets/images/patients/default.png')) : (base_url('assets/images/patients/' . $patient['image'])) ?>">
			</div>
		</div>
	</div>
</div>

<script>
	jQuery('#date_of_birth').datetimepicker({
		timepicker: false,
		format: 'Y-m-d'
	});
</script>