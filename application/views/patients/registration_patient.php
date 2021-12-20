<div class="rows main-page">
	<div class="page">
		<div class="filter-wrapper">
			<form class="row" id="id_number_checking">
				<div class="col-md-10">
					<div class="form-group text-center">
						<label for="id_number_for_checking" class="label-filter font-weight-bold" style="color: black; font-size: 16px;">NIK Pasien</label>
						<input type="text" class="form-control form-control-sm" id="id_number_for_checking" name="id_number_for_checking" placeholder="Masukkan NIK pasien...">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label class="label-filter">&nbsp;</label>
						<input class="btn btn-sm btn-block btn-success" type="submit" name="filter" value="Kirim" style="background-color: #04AA6D;">
					</div>
				</div>
			</form>
		</div>
		<form id="registration_patient_process">
			<input type="hidden" name="id_number_old" id="id_number_old">
			<div class="row mt-2">
				<div class="col-md-10">
					<div class="row mr-1">
						<div class="col-md-6">
							<div class="accordion mt-3" id="patientData">
								<div class="card">
									<div class="card-header p-0" id="headingOne">
										<h2 class="mb-0">
											<button class="btn btn-light btn-block text-center label-input-result" type="button" data-toggle="collapse" data-target="#collapsePatientData" aria-expanded="true" aria-controls="collapsePatientData">
												Data Pasien
											</button>
										</h2>
									</div>

									<div id="collapsePatientData" class="collapse show" aria-labelledby="headingOne" data-parent="#patientData">
										<div class="card-body">
											<div class="form-group">
												<label class="label-input-result-2 mb-n1" for="id_number">NIK</label>
												<input type="text" class="form-control form-control-sm value-input-result" id="id_number" name="id_number" required autocomplete="off">
											</div>
											<div class="form-group mt-n2">
												<label class="label-input-result-2 mb-n1" for="passport_number">Nomor Paspor</label>
												<input type="text" class="form-control form-control-sm value-input-result" id="passport_number" name="passport_number" required autocomplete="off">
											</div>
											<div class="form-group mt-n2">
												<label class="label-input-result-2 mb-n1" for="name">Nama</label>
												<input type="text" class="form-control form-control-sm value-input-result" id="name" name="name" required autocomplete="off">
											</div>
											<div class="form-group mt-n2">
												<label class="label-input-result-2 mb-n1" for="gender">Jenis Kelamin</label>
												<select class="form-control form-control-sm value-input-result" id="gender" name="gender" required>
													<option value="0" disabled selected>Pilih jenis kelamin</option>
													<option value="PRIA/MALE">Pria</option>
													<option value="PEREMPUAN/FEMALE">Wanita</option>
												</select>
											</div>
											<div class="form-group mt-n2">
												<label class="label-input-result-2 mb-n1" for="place_of_birth">Tempat Lahir</label>
												<input type="text" class="form-control form-control-sm value-input-result" id="place_of_birth" name="place_of_birth" required autocomplete="off">
											</div>
											<div class="form-group mt-n2">
												<label class="label-input-result-2 mb-n1" for="date_of_birth">Tanggal Lahir</label>
												<input type="text" class="form-control value-input-result" id="date_of_birth" name="date_of_birth" required autocomplete="off">
											</div>
											<div class="form-group mt-n2 mt-n1" id="address-display" style="display: none;">
												<label class="label-input-result-2" for="address">Alamat</label>
												<textarea class="form-control form-control-sm value-input-result mt-n1" id="address" name="address" rows="3" autocomplete="off"></textarea>
											</div>
											<div class="form-group mt-n2">
												<label class="label-input-result-2 mb-n1" for="basic_safety_training">Nomor BST&nbsp;&nbsp;
													<input type="checkbox" id="bst" onclick="if(this.checked){myFunction5()}else{myFunction6()}"> <label for="bst">Private</label>
												</label>
												<input type="text" class="form-control form-control-sm value-input-result" id="basic_safety_training" name="basic_safety_training" required autocomplete="off">
											</div>
											<div class="form-group mt-n2">
												<label class="label-input-result-2 mb-n1" for="nationality">Kewarganeragaan&nbsp;&nbsp;
													<input type="checkbox" id="indonesia" onclick="if(this.checked){myFunction1()}else{myFunction2()}"> <label for="indonesia">Indonesia</label>
												</label>
												<input type="text" class="form-control form-control-sm value-input-result" id="nationality" name="nationality" required autocomplete="off">
											</div>
											<div class="form-group mt-n2">
												<label class="label-input-result-2 mb-n1" for="id_company">Perusahaan</label>
												<select class="form-control form-control-sm value-input-result selectpicker" data-live-search="true" data-style="btn-info" id="id_company" name="id_company" required>
													<option value="" disabled selected>Pilih Perusahaan Pasien</option>
													<option value="0">PRIVATE</option>
													<?php foreach ($companies as $company) : ?>
														<option value="<?= $company['id'] ?>"><?= $company['name'] ?></option>
													<?php endforeach ?>
												</select>
											</div>
											<div class="form-group mt-n2">
												<label class="label-input-result-2 mb-n1" for="occupation">Jabatan&nbsp;&nbsp;
													<input type="checkbox" id="occu" onclick="if(this.checked){myFunction7()}else{myFunction8()}"> <label for="occu">Private</label>
												</label>
												<input type="text" class="form-control form-control-sm value-input-result" id="occupation" name="occupation" required autocomplete="off">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="accordion mt-3" id="formRegistration">
								<div class="card">
									<div class="card-header p-0" id="headingOne">
										<h2 class="mb-0">
											<button class="btn btn-light btn-block text-center label-input-result" type="button" data-toggle="collapse" data-target="#collapseFormRegistration" aria-expanded="true" aria-controls="collapseFormRegistration">
												Formulir Pendaftaran
											</button>
										</h2>
									</div>

									<div id="collapseFormRegistration" class="collapse show" aria-labelledby="headingOne" data-parent="#formRegistration">
										<div class="card-body">
											<div class="form-group">
												<label for="id_clinic" class="label-input-result-2">Klinik</label>
												<?php if ($this->session->userdata('role') == 'superuser') : ?>
													<select class="form-control form-control-sm value-input-result" id="id_clinic" name="id_clinic">
														<option value="0" disabled selected>Semua Klinik</option>
														<?php foreach ($clinics as $clinic) : ?>
															<option value="<?= $clinic['id'] ?>"><?= $clinic['name'] ?></option>
														<?php endforeach ?>
													</select>
												<?php else : 
													$clinic_name = $this->db->get_where('clinics', ['id' => $this->session->userdata('site')])->row_array();
												?>
													<input type="hidden" id="id_clinic" name="id_clinic" value="<?= $this->session->userdata('site') ?>">
													<input type="text" class="form-control form-control-sm value-input-result" name="id_clinic_name" value="<?= $clinic_name['name'] ?>" disabled>
												<?php endif ?>
											</div>
											<div class="form-group">
												<label class="label-input-result-2" for="type_examination">Jenis Pemeriksaan</label>
												<select class="form-control form-control-sm value-input-result" id="type_examination" name="type_examination" required>
													<option value="0" disabled selected>Select Examination Type</option>
													<option value="rev">Revalidasi</option>
													<option value="mcu">Medical Check Up</option>
												</select>
											</div>
											<div class="form-group">
												<label class="label-input-result-2" for="mcu_manual">Nomor Rekam Medis</label>
												<input type="text" class="form-control form-control-sm value-input-result" id="mcu_manual" name="mcu_manual" required autocomplete="off">
											</div>
											<div class="form-group">
												<label class="label-input-result-2" for="date_examination">Tanggal Pemeriksaan</label>
												<input type="text" class="form-control value-input-result" id="date_examination" name="date_examination" required autocomplete="off" readonly style="background-color: transparent; cursor: pointer;">
											</div>
											<div class="form-group">
												<label class="label-input-result-2" for="type_transaction">Jenis Pembayaran</label>
												<select class="form-control form-control-sm value-input-result" id="type_transaction" name="type_transaction" required>
													<option value="0" disabled selected>Select Payment Type</option>
													<option value="cash">CASH</option>
													<option value="debit">DEBIT / TRANSFER</option>
												</select>
											</div>
											<div class="form-group">
												<label class="label-input-result-2" for="total_price">Harga Total</label>
												<input type="text" class="form-control form-control-sm value-input-result" id="total_price" name="total_price" required autocomplete="off">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="mt-3">
								<button type="submit" class="btn btn-sm btn-block btn-primary">Simpan</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-2 text-center" style="background-color: #f4f6fa; margin-left: -15px; padding: 10px;">
					<div id="my_camera"></div>
					<div class="text-center mt-2">
						<button class="btn btn-sm btn-info" value="Take Snapshot" onClick="take_snapshot()"><i class="fas fa-camera-retro"></i>&nbsp;Ambil Foto</button>
					</div>
					<div class="mt-3">
						<div class="form-group">
							<label class="label-input-result">Hasil Foto</label>
							<div id="results">
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript" src="<?= base_url('assets/webcam/webcam.min.js') ?>"></script>
<script>
	jQuery('#date_of_birth').datetimepicker({
		timepicker: false,
		format: 'Y-m-d'
	});

	jQuery('#date_examination').datetimepicker({
		timepicker: false,
		format: 'Y-m-d'
	});

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

	$('#id_company').on('change', function() {
		if (this.value > 0) {
			$('<option/>').val('company').text('TAGIHAN / INVOICE').appendTo('#type_transaction')
		} else {
			$("#type_transaction option[value='company']").remove();
			$("#total_price").attr("value", "");
			$("#total_price").prop("readonly", false);
		}
	});

	$('#type_transaction').on('change', function() {
		if (this.value == 'company') {
			$("#total_price").attr("value", 0);
			$("#total_price").prop("readonly", true);
		} else {
			$("#total_price").attr("value", "");
			$("#total_price").prop("readonly", false);
		}
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

	// Photo Snapshot
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
		Webcam.snap(function(data_uri) {
			document.getElementById('results').innerHTML = '<img id="imageprev" src="' + data_uri + '"/>';
		});
	};

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
		var mcu_manual = $('#mcu_manual').val();
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
					mcu_manual: mcu_manual,
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