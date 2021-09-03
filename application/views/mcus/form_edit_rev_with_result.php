<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h3 font-weight-bolder">Formulir Ubah Laboratory Result / <i>Form Edit Laboratory Result</i></h1>
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
	<form method="POST" action="<?= base_url('mcu/editRevProcess') ?>" enctype="multipart/form-data" class="p-3 mt-n3">
		<input type="hidden" name="medical_record_number" value="<?= $data['medical_record_number'] ?>">
		<div class="row">
			<div class="col-lg-12">
				<div class="card border-success">
					<div class="card-body">
						<table width="100%">
							<tbody>
								<?php if ($this->session->userdata('role') == 'superuser') : ?>
									<tr>
										<td colspan="6" align="center">
											<label class="font-weight-bolder" for="date_examination">Klinik / <i>Clinic</i></label>
										</td>
									</tr>
									<tr>
										<td>
											<select id="id_clinic" class="form-control form-control-sm" name="id_clinic" required>
												<option value="0" disabled selected>Select Clinic</option>
												<?php foreach ($clinics as $clinic) : ?>
													<option value="<?= $clinic['id'] ?>" <?= ($clinic['id'] == $data['id_clinic']) ? ('selected') : ('') ?>><?= $clinic['name'] ?></option>
												<?php endforeach ?>
											</select><br>
										</td>
									</tr>
								<?php else : 
									$clinic_name = $this->db->get_where('clinics', ['id' => $data['id_clinic']])->row_array();
								?>
									<tr>
										<td colspan="6" align="center">
											<label class="font-weight-bolder" for="date_examination">Klinik / <i>Clinic</i></label>
										</td>
									</tr>
									<tr>
										<td>
											<input type="hidden" name="id_clinic" value="<?= $data['id_clinic'] ?>">
											<input type="text" class="form-control form-control-sm" name="id_clinic_name" value="<?= $clinic_name['name'] ?>" disabled><br>
										</td>
									</tr>
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
										<br>
									</td>
								</tr>
								<tr>
									<td colspan="6" align="center">
										<label class="font-weight-bolder" for="mcu_manual">Nomor Rekam Medis / <i>Medical Record Number</i> *</label>
									</td>
								</tr>
								<tr>
									<td colspan="6">
										<input class="form-control form-control-sm" type="text" id="mcu_manual" name="mcu_manual" value="<?= $data['mcu_manual'] ?>" required autocomplete="off" required>
									</td>
								</tr>
								<tr>
									<td colspan="6" align="center">
										<label class="font-weight-bolder" for="is_fit"><br>Hasil Pemeriksaan / <i>Examination Result</i> *</label>
									</td>
								</tr>
								<tr>
									<td colspan="6">
										<select class="form-control form-control-sm" name="is_fit" id="is_fit" required>
											<option value="" disabled selected>Pilih Hasil / Select Result</option>
											<option value="1" <?= ($data['is_fit'] == '1' ? ('selected') : ('')) ?>>Fit</option>
											<option value="0" <?= ($data['is_fit'] == '0' ? ('selected') : ('')) ?>>Unfit</option>
											<option value="2" <?= ($data['is_fit'] == '2' ? ('selected') : ('')) ?>>Fit with Medicine</option>
										</select>
									</td>
								</tr>
								<tr>
									<td colspan="6" align="center">
										<label class="font-weight-bolder" for="is_fit"><br>Masa Berlaku Hasil Laboratorium / <i>Validity Periode of Laboratory Result</i></label>
									</td>
								</tr>
								<tr>
									<td colspan="6">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="checkbox" id="validity_period" name="validity_period" value="1" <?= ($data['validity_period'] == '1' ? ('checked') : ('')) ?>>
											<label class="form-check-label" for="validity_period">Check if the validity period of laboratory results for 1 year</label>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-lg-12">
				<div class="card border-success">
					<div class="card-body">
						<p class="card-title font-weight-bolder text-center">Riwayat Medis / <i>Medical History</i></p>
						<div class="row">
							<div class="col-6 col-sm-6 col-md-6 col-lg-3">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="alcohol_history" name="alcohol_history" value="1" <?= ($data['alcohol_history'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="alcohol_history">Alcohol History</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="balance_problem" name="balance_problem" value="1" <?= ($data['balance_problem'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="balance_problem">Balance Problem</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="diabetes" name="diabetes" value="1" <?= ($data['diabetes'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="diabetes">Diabetes</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="eye_vision_problem" name="eye_vision_problem" value="1" <?= ($data['eye_vision_problem'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="eye_vision_problem">Eye / Vision Problem</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="heart_surgery" name="heart_surgery" value="1" <?= ($data['heart_surgery'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="heart_surgery">Heart Surgery</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="infectious_disease" name="infectious_disease" value="1" <?= ($data['infectious_disease'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="infectious_disease">Infectious Disease</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="lost_of_memory" name="lost_of_memory" value="1" <?= ($data['lost_of_memory'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="lost_of_memory">Lost of Memory</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="psychiatric_problem" name="psychiatric_problem" value="1" <?= ($data['psychiatric_problem'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="psychiatric_problem">Psychiatric Problem</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="thyroid_problem" name="thyroid_problem" value="1" <?= ($data['thyroid_problem'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="thyroid_problem">Thyroid Problem</label>
								</div>
							</div>
							<div class="col-6 col-sm-6 col-md-6 col-lg-3">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="allergic_history" name="allergic_history" value="1" <?= ($data['allergic_history'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="allergic_history">Allergic History</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="back_or_joint_problem" name="back_or_joint_problem" value="1" <?= ($data['back_or_joint_problem'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="back_or_joint_problem">Back or Joint Problem</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="digestive_disorder" name="digestive_disorder" value="1" <?= ($data['digestive_disorder'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="digestive_disorder">Digestive Disorder</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="ear_problem" name="ear_problem" value="1" <?= ($data['ear_problem'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="ear_problem">Ear Problem</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="heart_disease" name="heart_disease" value="1" <?= ($data['heart_disease'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="heart_disease">Heart Disease</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="kidney_problem" name="kidney_problem" value="1" <?= ($data['kidney_problem'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="kidney_problem">Kidney Problem</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="narcotic_history" name="narcotic_history" value="1" <?= ($data['narcotic_history'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="narcotic_history">Narcotic History</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="restricted_mobility" name="restricted_mobility" value="1" <?= ($data['restricted_mobility'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="restricted_mobility">Restricted Mobility</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="tuberculosis" name="tuberculosis" value="1" <?= ($data['tuberculosis'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="tuberculosis">Tuberculosis</label>
								</div>
							</div>
							<div class="col-6 col-sm-6 col-md-6 col-lg-3">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="amputation" name="amputation" value="1" <?= ($data['amputation'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="amputation">Amputation</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="colour_blindness" name="colour_blindness" value="1" <?= ($data['colour_blindness'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="colour_blindness">Colour Blindness</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="depresion" name="depresion" value="1" <?= ($data['depresion'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="depresion">Depresion</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="fracture" name="fracture" value="1" <?= ($data['fracture'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="fracture">Fracture</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="high_blood_pressure" name="high_blood_pressure" value="1" <?= ($data['high_blood_pressure'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="high_blood_pressure">High Blood Pressure</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="lung_disease" name="lung_disease" value="1" <?= ($data['lung_disease'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="lung_disease">Lung Disease</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="neurogical_disease" name="neurogical_disease" value="1" <?= ($data['neurogical_disease'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="neurogical_disease">Neurogical Disease</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="skin_problem" name="skin_problem" value="1" <?= ($data['skin_problem'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="skin_problem">Skin Problem</label>
								</div>
							</div>
							<div class="col-6 col-sm-6 col-md-6 col-lg-3">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="blood_disorder" name="blood_disorder" value="1" <?= ($data['blood_disorder'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="blood_disorder">Blood Disorder</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="cancer" name="cancer" value="1" <?= ($data['cancer'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="cancer">Cancer</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="epilepsy" name="epilepsy" value="1" <?= ($data['epilepsy'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="epilepsy">Epilepsy</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="genital_disorder" name="genital_disorder" value="1" <?= ($data['genital_disorder'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="genital_disorder">Genital Disorder</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="hernia" name="hernia" value="1" <?= ($data['hernia'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="hernia">Hernia</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="liver_problem" name="liver_problem" value="1" <?= ($data['liver_problem'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="liver_problem">Liver Problem</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="operation_surgery" name="operation_surgery" value="1" <?= ($data['operation_surgery'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="operation_surgery">Operation / Surgery</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="sleep_problem" name="sleep_problem" value="1" <?= ($data['sleep_problem'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="sleep_problem">Sleep Problem</label>
								</div>
							</div>
						</div>
						<p class="card-title font-weight-bolder text-center mt-1">Pemeriksaan Fisik / <i>Physical Examination</i></p>
						<div class="row">
							<div class="col-lg-12">
								<table width="100%">
									<tbody>
										<tr>
											<td width="17.5%">
												<label for="height" class="mt-1">Height (cm)</label>
											</td>
											<td width="27.5%">
												<input type="text" class="form-control form-control-sm" id="height" name="height" value="<?= $data['height'] ?>" required autocomplete="off">
											</td>
											<td width="10%"></td>
											<td width="17.5%">
												<label for="weight" class="mt-1">Weight (kg)</label>
											</td>
											<td width="27.5%">
												<input type="text" class="form-control form-control-sm" id="weight" name="weight" value="<?= $data['weight'] ?>" required autocomplete="off">
											</td>
										</tr>
										<tr>
											<td>
												<label for="blood_pressure" class="mt-1">Blood Pressure (mmHg)</label>
											</td>
											<td>
												<input type="text" class="form-control form-control-sm" id="blood_pressure" name="blood_pressure" value="<?= $data['blood_pressure'] ?>" required autocomplete="off">
											</td>
											<td></td>
											<td>
												<label for="pulse_regular" class="mt-1">Pulse Regular (X/min)</label>
											</td>
											<td>
												<input type="text" class="form-control form-control-sm" id="pulse_regular" name="pulse_regular" value="<?= $data['pulse_regular'] ?>" required autocomplete="off">
											</td>
										</tr>
										<tr>
											<td>
												<label for="respiratory_rate" class="mt-1">Respiratory Rate (X/min)</label>
											</td>
											<td>
												<input type="text" class="form-control form-control-sm" id="respiratory_rate" name="respiratory_rate" value="<?= $data['respiratory_rate'] ?>" required autocomplete="off">
											</td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<p class="card-title font-weight-bolder text-center mt-2">Pemeriksaan Pengelihatan / <i>Vision Examination</i></p>
						<div class="row">
							<div class="col-lg-12">
								<table width="100%">
									<tbody>
										<tr>
											<td colspan="8" class="font-weight-bolder">WITHOUT</td>
										</tr>
										<tr>
											<td width="7.5%">
												<label for="right_eye_without" class="mt-1">Right Eye</label>
											</td>
											<td width="22.5%">
												<input type="text" class="form-control form-control-sm" id="right_eye_without" name="right_eye_without" value="<?= $data['right_eye_without'] ?>" autocomplete="off">
											</td>
											<td width="5%"></td>
											<td width="7.5%">
												<label for="left_eye_without" class="mt-1">Left Eye</label>
											</td>
											<td width="22.5%">
												<input type="text" class="form-control form-control-sm" id="left_eye_without" name="left_eye_without" value="<?= $data['left_eye_without'] ?>" autocomplete="off">
											</td>
											<td width="5%"></td>
											<td width="7.5%">
												<label for="both_eye_without" class="mt-1">Both Eye</label>
											</td>
											<td width="22.5%">
												<input type="text" class="form-control form-control-sm" id="both_eye_without" name="both_eye_without" value="<?= $data['both_eye_without'] ?>" autocomplete="off">
											</td>
										</tr>
										<tr>
											<td colspan="8" class="font-weight-bolder">WITH</td>
										</tr>
										<tr>
											<td>
												<label for="right_eye_with" class="mt-1">Right Eye</label>
											</td>
											<td>
												<input type="text" class="form-control form-control-sm" id="right_eye_with" name="right_eye_with" value="<?= $data['right_eye_with'] ?>" autocomplete="off">
											</td>
											<td></td>
											<td>
												<label for="left_eye_with" class="mt-1">Left Eye</label>
											</td>
											<td>
												<input type="text" class="form-control form-control-sm" id="left_eye_with" name="left_eye_with" value="<?= $data['left_eye_with'] ?>" autocomplete="off">
											</td>
											<td></td>
											<td>
												<label for="both_eye_with" class="mt-1">Both Eye</label>
											</td>
											<td>
												<input type="text" class="form-control form-control-sm" id="both_eye_with" name="both_eye_with" value="<?= $data['both_eye_with'] ?>" autocomplete="off">
											</td>
										</tr>
										<tr>
											<td colspan="8">
												<label class="font-weight-bolder mt-1" for="color_vision">Pengeliahatan Warna / <i>Color Vision</i></label>
											</td>
										</tr>
										<tr>
											<td colspan="8">
												<select class="form-control form-control-sm" name="color_vision" id="color_vision" required>
													<option value="" disabled selected>Pilih Penglihatan Warna / Select Color Vision</option>
													<option value="0" <?= ($data['color_vision'] == '0' ? ('selected') : ('')) ?>>Abnormal</option>
													<option value="1" <?= ($data['color_vision'] == '1' ? ('selected') : ('')) ?>>Normal</option>
													<option value="2" <?= ($data['color_vision'] == '2' ? ('selected') : ('')) ?>>Partial Blindness</option>
												</select>
											</td>
										</tr>
										<tr>
											<td colspan="8" class="text-center">
												<label class="font-weight-bolder mt-1" for="general_appearance">Hasil Keseluruhan / <i>General Appearance</i></label>
											</td>
										</tr>
										<tr>
											<td colspan="8">
												<select class="form-control form-control-sm" name="general_appearance" id="general_appearance" required>
													<option value="" disabled selected>Pilih Hasil Keseluruhan / Select General Appearance</option>
													<option value="0" <?= ($data['general_appearance'] == '0' ? ('selected') : ('')) ?>>Unhealthy</option>
													<option value="1" <?= ($data['general_appearance'] == '1' ? ('selected') : ('')) ?>>Healthy</option>
												</select>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<p class="card-title font-weight-bolder text-center mt-3">Pemeriksaan / <i>Examination</i></p>
						<table width="100%" class="mt-n2">
							<tr>
								<td class="text-center">
									<input type="checkbox" id="allexam" onclick="if(this.checked){myFunction1()}else{myFunction2()}" <?= ($is_all_examine == 1) ? ('checked') : ('') ?>> <label for="allexam">All</label>
								</td>
							</tr>
						</table>
						<div class="row">
							<div class="col-6 col-sm-6 col-md-6 col-lg-3">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="eyes" name="eyes" value="1" <?= ($data['eyes'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="eyes">Eyes</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="ears" name="ears" value="1" <?= ($data['ears'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="ears">Ears</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="nose" name="nose" value="1" <?= ($data['nose'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="nose">Nose</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="mouth" name="mouth" value="1" <?= ($data['mouth'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="mouth">Mouth</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="throat" name="throat" value="1" <?= ($data['throat'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="throat">Throat</label>
								</div>
							</div>
							<div class="col-6 col-sm-6 col-md-6 col-lg-3">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="neck" name="neck" value="1" <?= ($data['neck'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="neck">Neck</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="throid" name="throid" value="1" <?= ($data['throid'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="throid">Throid</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="lymp_node" name="lymp_node" value="1" <?= ($data['lymp_node'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="lymp_node">Lymp Node</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="lungs" name="lungs" value="1" <?= ($data['lungs'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="lungs">Lungs</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="hearts" name="hearts" value="1" <?= ($data['hearts'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="hearts">Hearts</label>
								</div>
							</div>
							<div class="col-6 col-sm-6 col-md-6 col-lg-3">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="abdomen" name="abdomen" value="1" <?= ($data['abdomen'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="abdomen">Abdomen</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="urogenital_system" name="urogenital_system" value="1" <?= ($data['urogenital_system'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="urogenital_system">Urogenital System</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="upper_extremities" name="upper_extremities" value="1" <?= ($data['upper_extremities'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="upper_extremities">Upper Extremities</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="lower_extremities" name="lower_extremities" value="1" <?= ($data['lower_extremities'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="lower_extremities">Lower Extremities</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="back_abnormality" name="back_abnormality" value="1" <?= ($data['back_abnormality'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="back_abnormality">Back Abnormality</label>
								</div>
							</div>
							<div class="col-6 col-sm-6 col-md-6 col-lg-3">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="hernia_2" name="hernia_2" value="1" <?= ($data['hernia_2'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="hernia_2">Hernia</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="central_nervous_system" name="central_nervous_system" value="1" <?= ($data['central_nervous_system'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="central_nervous_system">Central Nervous System</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="skin_nails" name="skin_nails" value="1" <?= ($data['skin_nails'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="skin_nails">Skin & Nails</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="speech" name="speech" value="1" <?= ($data['speech'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="speech">Speech</label>
								</div>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="other" name="other" value="1" <?= ($data['other'] == '1' ? ('checked') : ('')) ?>>
									<label class="form-check-label" for="other">Other</label>
								</div>
							</div>
						</div>
						<p class="card-title font-weight-bolder text-center mt-2">Pemeriksaan Pendengaran / <i>Hearing Examination</i></p>
						<div class="row">
							<div class="col-lg-12">
								<table width="100%">
									<tbody>
										<tr>
											<td width="8%">
												<label for="right_ear" class="mt-1">Right Ear</label>
											</td>
											<td width="37%">
												<select class="form-control form-control-sm" name="right_ear" id="right_ear" required>
													<option value="" disabled selected>Select Examination Result</option>
													<option value="0" <?= ($data['right_ear'] == '0' ? ('selected') : ('')) ?>>Abnormal</option>
													<option value="1" <?= ($data['right_ear'] == '1' ? ('selected') : ('')) ?>>Normal</option>
												</select>
											</td>
											<td width="10%"></td>
											<td width="8%">
												<label for="left_ear" class="mt-1">Left Ear</label>
											</td>
											<td width="37%">
												<select class="form-control form-control-sm" name="left_ear" id="left_ear" required>
													<option value="" disabled selected>Select Examination Result</option>
													<option value="0" <?= ($data['left_ear'] == '0' ? ('selected') : ('')) ?>>Abnormal</option>
													<option value="1" <?= ($data['left_ear'] == '1' ? ('selected') : ('')) ?>>Normal</option>
												</select>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="form-group mt-3">
							<label class="font-weight-bolder" for="details">Jika tidak normal, berikan penjelasan / <i>If Abnormal, give details</i></label>
							<textarea id="details" name="details" class="form-control form-control-sm" rows="3"><?= $data['details'] ?></textarea>
						</div>
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

	function myFunction1() {
		document.getElementById("eyes").checked = true;
		document.getElementById("ears").checked = true;
		document.getElementById("nose").checked = true;
		document.getElementById("mouth").checked = true;
		document.getElementById("throat").checked = true;
		document.getElementById("neck").checked = true;
		document.getElementById("throid").checked = true;
		document.getElementById("lymp_node").checked = true;
		document.getElementById("lungs").checked = true;
		document.getElementById("hearts").checked = true;
		document.getElementById("abdomen").checked = true;
		document.getElementById("urogenital_system").checked = true;
		document.getElementById("upper_extremities").checked = true;
		document.getElementById("lower_extremities").checked = true;
		document.getElementById("back_abnormality").checked = true;
		document.getElementById("hernia_2").checked = true;
		document.getElementById("central_nervous_system").checked = true;
		document.getElementById("skin_nails").checked = true;
		document.getElementById("speech").checked = true;
		document.getElementById("other").checked = true;
	}

	function myFunction2() {
		document.getElementById("eyes").checked = false;
		document.getElementById("ears").checked = false;
		document.getElementById("nose").checked = false;
		document.getElementById("mouth").checked = false;
		document.getElementById("throat").checked = false;
		document.getElementById("neck").checked = false;
		document.getElementById("throid").checked = false;
		document.getElementById("lymp_node").checked = false;
		document.getElementById("lungs").checked = false;
		document.getElementById("hearts").checked = false;
		document.getElementById("abdomen").checked = false;
		document.getElementById("urogenital_system").checked = false;
		document.getElementById("upper_extremities").checked = false;
		document.getElementById("lower_extremities").checked = false;
		document.getElementById("back_abnormality").checked = false;
		document.getElementById("hernia_2").checked = false;
		document.getElementById("central_nervous_system").checked = false;
		document.getElementById("skin_nails").checked = false;
		document.getElementById("speech").checked = false;
		document.getElementById("other").checked = false;
	}
</script>
