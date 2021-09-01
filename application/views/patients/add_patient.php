<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h3 font-weight-bolder">Formulir Tambah Pasien / <i>Form Add Patient</i></h1>
	</div>
	<form id="add_patient_process">
		<div class="row p-3">
			<div class="col-md-9">
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
				<div class="form-group">
					<label class="font-weight-bolder" for="address">Alamat / <i>Address</i></label>
					<textarea name="address" id="address" class="form-control form-control-sm" rows="3" required autocomplete="off"></textarea>
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
			</div>
			<div class="col-md-3">
				<div class="card">
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
		<div class="row p-3 mt-n3">
			<button type="submit" class="btn btn-sm btn-block btn-primary"><span data-feather="save"></span> Simpan / <i>Save</i></button>
		</div>
	</form>
</main>
</div>
</div>

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
</script>

<!-- First, include the Webcam.js JavaScript Library -->
<script type="text/javascript" src="<?= base_url('assets/webcam/webcam.min.js') ?>"></script>
<script language="JavaScript">
	Webcam.set({
		width: 320,
		height: 240,
		crop_width: 180,
		crop_height: 240,
		image_format: 'jpeg',
		jpeg_quality: 100
	});
	Webcam.attach('#my_camera');
</script>
<!-- Code to handle taking the snapshot and displaying it locally -->
<script>
	function take_snapshot() {
		// take snapshot and get image data
		Webcam.snap(function(data_uri) {
			// display results in page
			document.getElementById('results').innerHTML = '<img id="imageprev" src="' + data_uri + '"/>';
		});
	}
</script>
<script type="text/javascript">
	$('#add_patient_process').on('submit', function(event) {
		event.preventDefault();
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

		var image = document.getElementById("imageprev").src;

		$.ajax({
				url: '<?= base_url("patient/addPatientProcess"); ?>',
				type: 'POST',
				dataType: 'json',
				data: {
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
