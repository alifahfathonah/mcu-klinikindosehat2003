		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
				<h1 class="h3 font-weight-bolder">Formulir Pendaftaran Pasien / <i>Patient Registration Form</i></h1>
			</div>

			<div class="row">
				<div class="col-md-12">
					<div class="card border-success">
						<h5 class="card-header bg-success text-center text-light"><b>KTP Pasien /<i>ID Number Patient</i></b></h5>
						<div class="card-body">
							<form id="id_number_checking">
								<div class="input-group">
									<div class="custom-file">
										<input type="text" class="form-control" name="id_number_for_checking" id="id_number_for_checking" required autofocus="on">
									</div>
									<div class="input-group-append">
										<button class="btn btn-info" type="submit">Enter</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<div class="row p-3">
				<div class="col-md-9 card border-success p-4">
					<form id="registration_patient_process">
						<input type="hidden" name="id_number_old" id="id_number_old">
						<div class="form-group">
							<label class="font-weight-bolder" for="id_number">KTP / <i>ID Number</i></label>
							<input type="text" class="form-control form-control-sm" name="id_number" id="id_number" placeholder="Enter ID Number..." required autocomplete="off">
						</div>
						<div class="form-group">
							<label class="font-weight-bolder" for="passport_number">Nomor Paspor / <i>Passport Number</i></label>
							<input type="text" class="form-control form-control-sm" name="passport_number" id="passport_number" placeholder="Enter Passport Number..." required autocomplete="off">
						</div>
						<div class="form-group">
							<label class="font-weight-bolder" for="name">Nama Pasien / <i>Patient's Name</i></label>
							<input type="text" class="form-control form-control-sm" name="name" id="name" placeholder="Name of Patient..." required autocomplete="off">
						</div>
						<div class="form-group">
							<label for="gender" class="font-weight-bolder">Jenis Kelamin / <i>Gender</i></label>
							<select class="form-control form-control-sm" name="gender" id="gender" required>
								<option value="0" disabled selected>Pilih Jenis Kelamin Pasien / Select Patient Gender</option>
								<option value="PRIA/MALE">Pria/Male</option>
								<option value="PEREMPUAN/FEMALE">Perempuan/Female</option>
							</select>
						</div>
						<div class="form-group">
							<label class="font-weight-bolder" for="place_of_birth">Tempat Lahir / <i>Place of Birth</i></label>
							<input type="text" class="form-control form-control-sm" name="place_of_birth" id="place_of_birth" placeholder="Enter Place of Birth..." required autocomplete="off">
						</div>
						<div class="form-group">
							<label for="date_of_birth" class="font-weight-bolder">Tanggal Lahir / <i>Date of Birth</i></label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><span data-feather="calendar"></span></span>
								</div>
								<input type="text" class="form-control form-control-sm" name="date_of_birth" id="date_of_birth" required autocomplete="off">
							</div>
						</div>
						<div class="form-group" id="address-display" style="display: none;">
							<label class="font-weight-bolder" for="address">Alamat / <i>Address</i></label>
							<textarea name="address" id="address" class="form-control form-control-sm" rows="3" autocomplete="off"></textarea>
						</div>
						<div class="form-group">
							<label class="font-weight-bolder" for="basic_safety_training">Nomor BST / <i>BST Number</i></label>
							<input type="checkbox" id="bst" onclick="if(this.checked){myFunction5()}else{myFunction6()}"> <label for="bst">Private</label>
							<input type="text" class="form-control form-control-sm" name="basic_safety_training" id="basic_safety_training" placeholder="Enter Basic Safety Training Number..." required autocomplete="off">
						</div>
						<div class="form-group">
							<label for="nationality" class="font-weight-bolder">Kewarganegaraan / <i>Nationality&nbsp;&nbsp;</i></label>
							<input type="checkbox" id="indonesia" onclick="if(this.checked){myFunction1()}else{myFunction2()}"> <label for="indonesia">Indonesia</label>
							<input type="text" class="form-control form-control-sm" name="nationality" id="nationality" placeholder="Enter Nationality..." required autocomplete="off">
						</div>
						<div class="form-group">
							<label for="id_company" class="font-weight-bolder">Perusahaan / <i>Company</i></label>
							<select class="form-control form-control-sm" name="id_company" id="id_company" required>
								<option value="" disabled selected>Pilih Perusahaan Pasien / Select Patient Company</option>
								<option value="0">Private</option>
								<?php foreach ($companies as $company) : ?>
									<option value="<?= $company->id ?>"><?= $company->name ?></option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="form-group">
							<label class="font-weight-bolder" for="occupation">Jabatan / <i>Occupation</i></label>
							<input type="checkbox" id="occu" onclick="if(this.checked){myFunction7()}else{myFunction8()}"> <label for="occu">Private</label>
							<input type="text" class="form-control form-control-sm" name="occupation" id="occupation" placeholder="Enter Patient Occupation..." required autocomplete="off">
						</div>
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
							<input type="hidden" id="id_clinic" name="id_clinic" value="<?= $this->session->userdata('site') ?>">
							<div class="form-group">
								<label for="id_clinic"><b>Klinik / <i>Clinic</i></b></label>
								<input type="text" class="form-control form-control-sm" name="id_clinic_name" value="<?= $clinic_name['name'] ?>" disabled>
							</div>
						<?php endif ?>
						<div class="form-group">
							<label for="type_examination"><b>Jenis Pemeriksaan / <i>Examination Type</i></b></label>
							<select id="type_examination" class="form-control form-control-sm" name="type_examination" required>
								<option value="0" disabled selected>Select Examination Type</option>
								<option value="rev">Revalidasi</option>
								<option value="mcu">Medical Check Up</option>
							</select>
						</div>
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

						<div>
							<button type="submit" class="btn btn-sm btn-block btn-primary"><span data-feather="save"></span> Simpan / <i>Save</i></button>
						</div>
					</form>
				</div>
				<div class="col-md-3">
					<div class="card border-success">
						<h5 class="card-header text-center text-light bg-success">Visitor Photo</h5>
						<div class="card-body">
							<div id="my_camera" class="card-img-top" style="margin-left: 7.5px;"></div>
							<div class="text-center mt-1">
								<button class="btn btn-sm btn-info" value="Take Snapshot" onClick="take_snapshot()">Take Photo</button>
							</div>
						</div>
					</div>
					<div class="card mt-2">
						<h5 class="card-header text-center text-light bg-success">Photo Results</h5>
						<div class="card-body">
							<div id="results" class="card-img-top"></div>
						</div>
					</div>
				</div>
			</div>

		</main>
	</div>
</div>

<script type="text/javascript" src="<?= base_url('assets/webcam/webcam.min.js') ?>"></script>
<script>
	function myFunction1() {
		document.getElementById("nationality").setAttribute("readonly", "");
		document.getElementById("nationality").value = 'Indonesia';
	}

	function myFunction2() {
		document.getElementById("nationality").removeAttribute("readonly", "");
		document.getElementById("nationality").value = '';
	}

	function myFunction4() {
		document.getElementById("company").removeAttribute("readonly", "");
		document.getElementById("company").value = '';
	}

	function myFunction5() {
		document.getElementById("basic_safety_training").setAttribute("readonly", "");
		document.getElementById("basic_safety_training").value = 'Private';
	}

	function myFunction6() {
		document.getElementById("basic_safety_training").removeAttribute("readonly", "");
		document.getElementById("basic_safety_training").value = '';
	}

	function myFunction7() {
		document.getElementById("occupation").setAttribute("readonly", "");
		document.getElementById("occupation").value = 'Private';
	}

	function myFunction8() {
		document.getElementById("occupation").removeAttribute("readonly", "");
		document.getElementById("occupation").value = '';
	}

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

	$('#id_number_checking').on('submit', function (event) {
		event.preventDefault();
		var id_number = $('#id_number_for_checking').val();

		$.ajax({
			url: '<?= base_url("patient/checkingIdNumber") ?>',
			type: 'POST',
			dataType: 'json',
			data: {id_number:id_number},
		})
		.done(function(data) {
			let patient = data[0];
			$("#id_number_old").attr("value", patient.id_number);
			$("#id_number").attr("value", patient.id_number);
			$("#passport_number").attr("value", patient.passport_number);
			$("#name").attr("value", patient.name);
			$('#gender').val(patient.gender).change();
			$("#place_of_birth").attr("value", patient.place_of_birth);
			$("#date_of_birth").attr("value", patient.date_of_birth);
			$("#address").val(patient.address);
			$("#basic_safety_training").attr("value", patient.basic_safety_training);
			$("#nationality").attr("value", patient.nationality);
			$('#id_company').val(patient.id_company).change();
			$("#occupation").attr("value", patient.occupation);

			if (patient.basic_safety_training == "Private") {
				$("#bst").attr("checked", true);
			}

			if (patient.nationality == "INDONESIA") {
				$("#indonesia").attr("checked", true);
			}

			if (patient.occupation == "PRIVATE") {
				$("#occu").attr("checked", true);
			}

			if (patient.address != "") {
				$("#address-display").css("display", "");
			}

			if (patient.address == null) {
				$("#address-display").css("display", "none");
			}
		})
	});

	Webcam.set({
		width: 320,
		height: 240,
		crop_width: 180,
		crop_height: 240,
		image_format: 'jpeg',
		jpeg_quality: 100
	});
	Webcam.attach('#my_camera');

	function take_snapshot() {
		// take snapshot and get image data
		Webcam.snap(function(data_uri) {
			// display results in page
			document.getElementById('results').innerHTML = '<img id="imageprev" src="' + data_uri + '"/>';
		});
	}

	$('#registration_patient_process').on('submit', function(event) {
		event.preventDefault();
		var id_number_old = $('#id_number_old').val();
		var id_number = $('#id_number').val();
		var passport_number = $('#passport_number').val();
		var name = $('#name').val();
		var gender = $('#gender').val();
		var place_of_birth = $('#place_of_birth').val();
		var date_of_birth = $('#date_of_birth').val();
		var address = $('#address').val();
		var basic_safety_training = $('#basic_safety_training').val();
		var nationality = $('#nationality').val();
		var id_company = $('#id_company').val();
		var occupation = $('#occupation').val();
		var id_clinic = $('#id_clinic').val();
		var type_examination = $('#type_examination').val();
		var date_examination = $('#date_examination').val();
		var type_transaction = $('#type_transaction').val();
		var total_price = $('#total_price').val();

		var image = document.getElementById("imageprev").src;

		$.ajax({
				url: '<?= base_url("patient/registrationPatientProcess"); ?>',
				type: 'POST',
				dataType: 'json',
				data: {
					id_number_old: id_number_old,
					id_number: id_number,
					passport_number: passport_number,
					name: name,
					gender: gender,
					place_of_birth: place_of_birth,
					date_of_birth: date_of_birth,
					address: address,
					basic_safety_training: basic_safety_training,
					nationality: nationality,
					id_company: id_company,
					occupation: occupation,
					id_clinic: id_clinic,
					type_examination: type_examination,
					date_examination: date_examination,
					type_transaction: type_transaction,
					total_price: total_price,
					image: image
				},
			})
			.done(function(data) {
				if (data > 0) {
					Swal.fire({
						title: 'Success',
						icon: 'success',
						showCancelButton: false,
						confirmButtonColor: '#3085d6',
						confirmButtonText: 'OK'
					}).then((result) => {
						if (result.value) {
							window.location = "<?= base_url('patient') ?>"
							$('#add_patient_process')[0].reset();
						}
					})
				}
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
	});
</script>