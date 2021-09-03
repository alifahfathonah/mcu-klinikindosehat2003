<?php

if (isset($_GET['search_patient'])) {
	$key = $_GET['search_patient'];
} else {
	$key = NULL;
}

?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h3 font-weight-bolder">Daftar Pasien / <i>List of Patient</i></h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<div class="btn-group mr-2">
				<a class="btn btn-sm btn-success" href="<?= base_url('patient/registrationPatient') ?>"><span data-feather="user-plus"></span> Pendaftaran Pasien / <i>Patient Registration</i></a>
			</div>
		</div>
	</div>
	<form action="">
		<div class="row mt-4">
			<div class="col-md-10">
				<div class="form-group">
					<input type="text" class="form-control form-control-sm" name="search_patient" id="search_patien" placeholder="Search Patient's by ID Number or Name..." required autocomplete="off">
				</div>
			</div>
			<div class="col-md-2">
				<button type="submit" class="btn btn-sm btn-block btn-secondary"><span data-feather="search"></span> Search</button>
			</div>
		</div>
	</form>
	<div class="table-responsive p-3 mb-n5">
		<table class="table table-hover" id="#" width="100%">
			<thead class="text-center">
				<tr>
					<th>#<br><i>.</i></th>
					<th>Foto<br><i>Photo</i></th>
					<th>KTP<br><i>ID Number</i></th>
					<th>Nama<br><i>Name</i></th>
					<th>Perusahaan<br><i>Company</i></th>
					<th colspan="2">Aksi<br><i>Action</i></th>
				</tr>
			</thead>
			<tbody>
				<?php if ($key == NULL) : ?>
					<tr>
						<td colspan="6" align="center">Please Search Patient's</td>
					</tr>
				<?php else : ?>
					<?php
					$this->db->select('patients.id as id, id_number, passport_number, patients.name as name, gender, place_of_birth, date_of_birth, patients.address as address, basic_safety_training, nationality, id_company, occupation, image, companies.name as company_name, companies.address as company_address');
					$this->db->from('patients');
					$this->db->join('companies', 'companies.id=patients.id_company', 'left');
					$this->db->join('mcus_v1', 'mcus_v1.id_patient=patients.id', 'left');
					$this->db->group_by('patients.id');
					$this->db->like('id_number', $key);
					$this->db->or_like('patients.name', $key);
					$this->db->or_like('companies.name', $key);
					$this->db->where('patients.is_deleted', 0);
					$row = $this->db->get()->num_rows();
					?>
					<?php if ($row > 0) :
						$this->db->select('patients.id as id, id_number, passport_number, patients.name as name, gender, place_of_birth, date_of_birth, patients.address as address, basic_safety_training, nationality, id_company, occupation, image, companies.name as company_name, companies.address as company_address');
						$this->db->from('patients');
						$this->db->join('companies', 'companies.id=patients.id_company', 'left');
						$this->db->join('mcus_v1', 'mcus_v1.id_patient=patients.id', 'left');
						$this->db->group_by('patients.id');
						$this->db->like('id_number', $key);
						$this->db->or_like('patients.name', $key);
						$this->db->or_like('companies.name', $key);
						$this->db->where('patients.is_deleted', 0);
						$patients = $this->db->get()->result_array();
					?>

						<?php foreach ($patients as $index => $patient) : ?>
							<tr>
								<td class="align-middle"><?= $index + 1 ?></td>
								<td class="align-middle">
									<img class="img-thumbnail" width="84" src="<?= base_url('assets/images/patients/' . $patient['image']) ?>">
								</td>
								<td class="text-center align-middle font-weight-bolder"><?= $patient['id_number'] ?></td>
								<td class="align-middle"><?= $patient['name'] ?></td>
								<td class="align-middle">
									<?php if ($patient['id_company'] == 0) : ?>
										PRIVATE
									<?php else : ?>
										<?= $patient['company_name'] ?>
									<?php endif ?>
								</td>
								<td class="text-center align-middle">
									<a class="button-warning" href="#" data-toggle="modal" data-target="#editPatient<?= $patient['id'] ?>"><i class="fas fa-fw fa-user-edit"></i> Ubah / <i>Edit</i></a>
									<a class="button-danger" href="#" data-toggle="modal" data-target="#deletePatient<?= $patient['id'] ?>"><i class="fas fa-fw fa-user-minus"></i> Hapus / <i>Delete</i></a>
								</td>
								<td class="text-center align-middle">
									<a class="button-primary" href="<?= base_url('patient/formMakeRev/' . $patient['id'] . '/' . $patient['id_number']) ?>"><i class="far fa-fw fa-window-restore"></i> Revalidasi</a>
									<br><br>
									<a class="button-success" href="<?= base_url('patient/formMakeMcu/' . $patient['id'] . '/' . $patient['id_number']) ?>"><i class="far fa-fw fa-window-restore"></i> MCU</a>
								</td>
							</tr>
						<?php endforeach ?>
					<?php else : ?>
						<tr>
							<td colspan="6" align="center">No Result</td>
						</tr>
					<?php endif ?>
				<?php endif ?>
			</tbody>
		</table>
	</div>
</main>
</div>
</div>

<!-- Modal Edit -->
<?php if ($key == NULL) : ?>
<?php else : ?>
	<?php if ($row > 0) : ?>
		<?php foreach ($patients as $index => $patient) : ?>
			<div class="modal fade" id="editPatient<?= $patient['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Formulir Ubah Data Pasien<br><i>Form Edit Data Patient</i></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form method="POST" action="<?= base_url('patient/editPatient') ?>">
							<input type="hidden" name="id" value="<?= $patient['id'] ?>">
							<div class="modal-body">
								<div class="form-group">
									<label class="font-weight-bolder">KTP / <i>ID Number</i></label>
									<input type="text" class="form-control form-control-sm" name="id_number" value="<?= $patient['id_number'] ?>" required autocomplete="off">
								</div>
								<div class="form-group">
									<label class="font-weight-bolder">Nomor Paspor / <i>Passport Number</i></label>
									<input type="text" class="form-control form-control-sm" name="passport_number" value="<?= $patient['passport_number'] ?>" required autocomplete=" off">
								</div>
								<div class="form-group">
									<label class="font-weight-bolder">Nama Pasien / <i>Patient's Name</i></label>
									<input type="text" class="form-control form-control-sm" name="name" value="<?= $patient['name'] ?>" required autocomplete="off">
								</div>
								<div class="form-group">
									<label class="font-weight-bolder">Jenis Kelamin / <i>Gender</i></label>
									<select class="form-control form-control-sm" name="gender" required>
										<option value="0" disabled selected>Pilih Jenis Kelamin Pasien / Select Patient Gender</option>
										<option value="PRIA/MALE" <?php if ($patient['gender'] == 'PRIA/MALE') : ?> selected <?php endif ?>>Pria/Male</option>
										<option value="PEREMPUAN/FEMALE" <?php if ($patient['gender'] == 'PEREMPUAN/FEMALE') : ?> selected <?php endif ?>>Perempuan/Female</option>
									</select>
								</div>
								<div class="form-group">
									<label class="font-weight-bolder">Tempat Lahir / <i>Place of Birth&nbsp;&nbsp;</i></label>
									<input type="text" class="form-control form-control-sm" name="place_of_birth" value="<?= $patient['place_of_birth'] ?>" required autocomplete="off">
								</div>
								<div class="form-group">
									<label class="font-weight-bolder">Tanggal Lahir / <i>Date of Birth</i></label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><span data-feather="calendar"></span></span>
										</div>
										<input type="text" class="form-control form-control-sm" name="date_of_birth" id="date_of_birth_<?= $patient['id'] ?>" value="<?= $patient['date_of_birth'] ?>" required autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<label class="font-weight-bolder">Alamat / <i>Address&nbsp;&nbsp;</i></label>
									<textarea class="form-control form-control-sm" name="address" rows="3" autocomplete="off"><?= $patient['address'] ?></textarea>
								</div>
								<div class="form-group">
									<label class="font-weight-bolder">Nomor BST / <i>BST Number&nbsp;&nbsp;</i></label>
									<input type="text" class="form-control form-control-sm" name="basic_safety_training" value="<?= strtoupper($patient['basic_safety_training']) ?>" required autocomplete="off">
								</div>
								<div class="form-group">
									<label class="font-weight-bolder">Kewarganegaraan / <i>Nationality&nbsp;&nbsp;</i></label>
									<input type="text" class="form-control form-control-sm" name="nationality" value="<?= $patient['nationality'] ?>" required autocomplete="off">
								</div>
								<div class="form-group">
									<label class="font-weight-bolder">Perusahaan / <i>Company</i></label>
									<select class="form-control form-control-sm" name="id_company" required>
										<option value="" disabled selected>Pilih Perusahaan Pasien / Select Patient Company</option>
										<option value="0" <?php if ($patient['id_company'] == 0) : ?> selected <?php endif ?>>PRIVATE</option>
										<?php foreach ($companies as $company) : ?>
											<option value="<?= $company->id ?>" <?php if ($patient['id_company'] == $company->id) : ?> selected <?php endif ?>><?= $company->name ?></option>
										<?php endforeach ?>
									</select>
								</div>
								<div class="form-group">
									<label class="font-weight-bolder">Jabatan / <i>Occupation&nbsp;&nbsp;</i></label>
									<input type="text" class="form-control form-control-sm" name="occupation" value="<?= $patient['occupation'] ?>" required autocomplete="off">
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-user-edit"></i> Ubah / <i>Edit</i></button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<script>
				jQuery('#date_of_birth_<?= $patient['id'] ?>').datetimepicker({
					timepicker: false,
					format: 'Y-m-d'
				});
			</script>
		<?php endforeach ?>
	<?php endif ?>
<?php endif ?>

<!-- Modal Delete -->
<?php if ($key == NULL) : ?>
<?php else : ?>
	<?php if ($row > 0) : ?>
		<?php foreach ($patients as $index => $patient) : ?>
			<div class="modal fade" id="deletePatient<?= $patient['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Hapus Pasien / <i>Delete Patient</i></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form method="POST" action="<?= base_url('patient/deletePatient') ?>">
							<input type="hidden" name="id" value="<?= $patient['id'] ?>">
							<div class="modal-body">
								Pilih <b>"hapus"</b> dibawah jika Anda yakin akan menghapus pasien <b>'<?= $patient['name'] ?>'</b> ini.
								<br><br>
								Select <b>"delete"</b> below if you are sure to delete this <b>'<?= $patient['name'] ?>'</b> patient.
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-user-minus"></i> Hapus / <i>Delete</i></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		<?php endforeach ?>
	<?php endif ?>
<?php endif ?>

<script>
	function myFunction1() {
		document.getElementById("nationality").setAttribute("readonly", "");
		document.getElementById("nationality").value = 'Indonesia';
	}

	function myFunction2() {
		document.getElementById("nationality").removeAttribute("readonly", "");
		document.getElementById("nationality").value = '';
	}

	function myFunction3() {
		document.getElementById("company").setAttribute("readonly", "");
		document.getElementById("company").value = 'Private';
	}

	function myFunction4() {
		document.getElementById("company").removeAttribute("readonly", "");
		document.getElementById("company").value = '';
	}
</script>
