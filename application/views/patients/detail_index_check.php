		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
				<h1 class="h3 font-weight-bolder">Detail Pasien / <i>Patient Details</i></h1>
				<div class="btn-toolbar mb-2 mb-md-0">
					<a href="<?= base_url('patient/indexCheck') ?>" class="btn btn-info"><span data-feather="skip-back"></span> BACK</a>
				</div>
			</div>

			<div class="row">
				<div class="col-md-7">
					<div class="card shadow">
						<div class="card-body">
							<div class="h4 p-2 border-bottom">
								Data Patient
							</div>
							<div class="h6 p-3">
								<table cellpadding="10">
									<tr>
										<td>ID Number</td>
										<td>: <?= $data['id_number_patient'] ?></td>
									</tr>
									<tr>
										<td>Passport Number</td>
										<td>: <?= $data['passport_number'] ?></td>
									</tr>
									<tr>
										<td>Name</td>
										<td>: <?= $data['name_patient'] ?></td>
									</tr>
									<tr>
										<td>Gender</td>
										<td>: <?= $data['gender'] ?></td>
									</tr>
									<tr>
										<td>Place of Birth</td>
										<td>: <?= $data['place_of_birth'] ?></td>
									</tr>
									<tr>
										<td>Date of Birth</td>
										<td>: <?= date('d F Y', strtotime($data['date_of_birth'])) ?></td>
									</tr>
									<tr>
										<td>Address</td>
										<td>: <?= $data['address'] ?></td>
									</tr>
									<tr>
										<td>Basic Safety Training</td>
										<td>: <?= $data['basic_safety_training'] ?></td>
									</tr>
									<tr>
										<td>Nationality</td>
										<td>: <?= $data['nationality'] ?></td>
									</tr>
									<tr>
										<td>Company</td>
										<td>: <?= ($data['id_company'] == 0) ? ('PRIVATE') : ($data['company_name']) ?></td>
									</tr>
									<tr>
										<td>Occupation</td>
										<td>: <?= $data['occupation'] ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="card shadow text-center mb-3">
						<div class="card-body">
							<img class="img-fluid rounded" src="<?= base_url('assets/images/patients/' . $data['image']) ?>">
						</div>
					</div>
					<div class="card shadow">
						<div class="card-body">
							<div class="h4 p-2 border-bottom">
								Data Registration
							</div>
							<div class="h6 p-3">
								<table cellpadding="7">
									<tr>
										<td>MCU No.</td>
										<td>: <?= ($data['mcu_manual'] != NULL) ? ($data['mcu_manual']) : ($data['medical_record_number']) ?></td>
									</tr>
									<tr>
										<td>Passport Number</td>
										<td>: <?= $data['clinic_name'] ?></td>
									</tr>
									<tr>
										<td>Type Examination</td>
										<td>: <?= ($data['type_examination'] == 'rev') ? ('REVALIDASI') : ('MEDICAL CHECK UP') ?></td>
									</tr>
									<tr>
										<td>Date Registration</td>
										<td>: <?= date('D, d M Y / H:i', strtotime($data['created_at'])) ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>
</div>