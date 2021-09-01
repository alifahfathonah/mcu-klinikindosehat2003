<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h3 font-weight-bolder">Buat Hasil Laboratory (Revalidasi)/ <i>Make Laboratory Result (Revalidasi)</i></h1>
	</div>
	<div class="p-3">
		<div class="card">
			<h5 class="card-header font-weight-bolder text-center">Data Pasien / <i>Patient Data</i></h5>
			<div class="card-body">
				<div class="row">
					<div class="col-lg-2">
						<img class="img-thumbnail" width="100" src="<?= base_url('assets/images/patients/' . $patient['image']) ?>">
					</div>
					<div class="col-lg-10 ml-n5 mt-3">
						<div class="row mb-1">
							<div class="col-lg-2 font-weight-bold"><i class="fas fa-fw fa-at"></i> Name</div>
							<div class="col-lg-4">: <?= $patient['name'] ?></div>
							<div class="col-lg-2 font-weight-bold"><i class="fas fa-fw fa-map-marked-alt"></i> Address</div>
							<div class="col-lg-4">: <?= $patient['address'] ?></div>
						</div>
						<div class="row mb-1">
							<div class="col-lg-2 font-weight-bold"><i class="fas fa-fw fa-id-card"></i> ID Number</div>
							<div class="col-lg-4">: <?= $patient['id_number'] ?></div>
							<div class="col-lg-2 font-weight-bold"><i class="fas fa-fw fa-building"></i> Company</div>
							<div class="col-lg-4">:
								<?php if ($patient['id_company'] == 0) : ?>
									PRIVATE
								<?php else : ?>
									<?= $patient['company_name'] ?>
								<?php endif ?>
							</div>
						</div>
						<div class="row mb-1">
							<div class="col-lg-2 font-weight-bold"><i class="fas fa-fw fa-passport"></i> Passport</div>
							<div class="col-lg-4">: <?= $patient['passport_number'] ?></div>
							<div class="col-lg-2 font-weight-bold"><i class="fas fa-fw fa-crosshairs"></i> Occupation</div>
							<div class="col-lg-4">: <?= $patient['occupation'] ?></div>
						</div>
						<div class="row mb-1">
							<div class="col-lg-2 font-weight-bold"><i class="fas fa-fw fa-birthday-cake"></i> Date of Birth</div>
							<div class="col-lg-4">: <?= $patient['place_of_birth'] . ' / ' . date('d F Y', strtotime($patient['date_of_birth'])) ?></div>
							<div class="col-lg-2 font-weight-bold"><i class="fas fa-fw fa-list-ol"></i> No. BST</div>
							<div class="col-lg-4">: <?= strtoupper($patient['basic_safety_training']) ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<form method="POST" action="<?= base_url('mcu/makeRev') ?>" enctype="multipart/form-data" class="p-4 mt-n4">
		<input type="hidden" name="id_patient" value="<?= $patient['id'] ?>">
		<input type="hidden" name="id_number_patient" value="<?= $patient['id_number'] ?>">
		<input type="hidden" name="name_patient" value="<?= $patient['name'] ?>">
		<input type="hidden" name="id_company" value="<?= $patient['id_company'] ?>">
		<?php if ($this->session->userdata('role') == 'superuser') : ?>
			<div class="form-group">
				<label for="id_clinic"><b>Klinik / <i>Clinic</i></b></label>
				<select id="id_clinic" class="form-control form-control-sm" name="id_clinic" required>
					<option value="0" disabled selected>Select Clinic</option>
					<?php foreach ($clinics as $clinic) : ?>
						<option value="<?= $clinic['id'] ?>"><?= $clinic['name'] ?></option>
					<?php endforeach ?>
				</select>
			</div>
		<?php else : 
			$clinic_name = $this->db->get_where('clinics', ['id' => $this->session->userdata('site')])->row_array();
		?>
			<input type="hidden" name="id_clinic" value="<?= $this->session->userdata('site') ?>">
			<div class="form-group">
				<label for="id_clinic"><b>Klinik / <i>Clinic</i></b></label>
				<input type="text" class="form-control form-control-sm" name="id_clinic_name" value="<?= $clinic_name['name'] ?>" disabled>
			</div>
		<?php endif ?>
		<div class="form-group">
			<label class="font-weight-bolder" for="date_examination">Tanggal Pemeriksaan / <i>Date of Examination</i></label>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text"><span data-feather="calendar"></span></span>
				</div>
				<input type="text" class="form-control form-control-sm" name="date_examination" id="date_examination" required autocomplete="off">
			</div>
		</div>
		<div class="form-group">
			<label for="type_transaction"><b>Jenis Pembayaran / <i>Payment Type</i></b></label>
			<select id="type_transaction" class="form-control form-control-sm" name="type_transaction" required>
				<option value="0" disabled selected>Select Payment Type</option>
				<option value="cash">CASH</option>
				<option value="debit">DEBIT / TRANSFER</option>
				<?php if ($patient['id_company'] == 0) : ?>
				<?php else : ?>
					<option value="company">COMPANY</option>
				<?php endif ?>
			</select>
		</div>
		<div class="form-group">
			<label class="font-weight-bolder" for="total_price">Harga Total / <i>Total Price</i></label>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text" style="font-size: 11px;">Rp</span>
				</div>
				<input type="text" class="form-control form-control-sm" name="total_price" id="total_price" required autocomplete="off">
			</div>
		</div>
		<button type="submit" class="btn btn-sm btn-block btn-primary"><i class="fas fa-fw fa-save"></i> Kirim / <i>Submit</i></button>
	</form>

	<script>
		jQuery('#date_examination').datetimepicker({
			timepicker: false,
			format: 'Y-m-d'
		});

		var jml_uang = document.getElementById('total_price');
		jml_uang.addEventListener('keyup', function(e) {

			jml_uang.value = formatRupiah(this.value, '');
		});

		function formatRupiah(angka, prefix) {
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
				split = number_string.split(','),
				sisa = split[0].length % 3,
				rupiah = split[0].substr(0, sisa),
				ribuan = split[0].substr(sisa).match(/\d{3}/gi);

			if (ribuan) {
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}

			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
		}
	</script>
