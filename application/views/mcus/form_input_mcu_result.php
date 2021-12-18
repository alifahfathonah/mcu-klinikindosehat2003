<div class="rows main-page">
	<div class="page">
		<div class="row">
			<div class="col-md-8">
				<form action="<?= base_url('mcu/inputMcuResultProcess') ?>" method="POST">
					<input type="hidden" name="id_patient" value="<?= $data['id_patient'] ?>">
					<input type="hidden" name="medical_record_number" value="<?= $data['medical_record_number'] ?>">
					<div class="row">
						<div class="col-md-8">
							<div class="form-group mt-n1">
								<label class="label-input-result" for="address">Alamat</label>
								<textarea class="form-control form-control-sm value-input-result mt-n1" id="address" name="address" rows="2" autocomplete="off"><?= ($data['address'] != NULL || $data['address'] != "") ? ($data["address"]) : ("") ?></textarea>
							</div>
							<div class="form-group mt-n1">
								<label class="label-input-result" for="mcu_manual">Nomor Rekam Medis</label>
								<input class="form-control form-control-sm value-input-result mt-n1" type="text" id="mcu_manual" name="mcu_manual" <?= ($data['mcu_manual'] != NULL || $data['mcu_manual'] != "") ? ('value="'. $data["mcu_manual"] .'"') : ("") ?> placeholder="Nomor rekam medis harus unik..." required autocomplete="off">
							</div>
							<div class="form-group mt-n1">
								<label class="label-input-result" for="is_fit">Hasil Pemeriksaan Laboratoriom</label>
								<select class="form-control form-control-sm value-input-result mt-n1" id="is_fit" name="is_fit" required>
									<option value="" disabled selected>Pilih hasil pemeriksaan lab</option>
									<option value="1">Fit</option>
									<option value="0">Unfit</option>
									<option value="2">Fit with Medicine</option>
								</select>
							</div>
							<div class="form-group mt-n1">
								<label class="label-input-result mb-n2">Masa Berlaku Hasil Laboratorium</label>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="validity_period" name="validity_period" value="1">
									<label class="form-check-label" for="validity_period" style="font-size: 14px; color: #555;">Check if the validity period of laboratory results for 1 year</label>
								</div>
							</div>
						</div>
						<div class="col-md-4 text-center mt-4">
							<img class="img-fluid rounded" src="<?= ($data['image'] == '') ? (base_url('assets/images/patients/default.png')) : (base_url('assets/images/patients/' . $data['image'])) ?>">
						</div>
					</div>
					<div class="row mt-2 mr-1">
						<div class="col-md-6">
							<div class="accordion" id="medicalHistory">
								<div class="card">
									<div class="card-header p-0" id="headingOne">
										<h2 class="mb-0">
											<button class="btn btn-light btn-block text-center label-input-result" type="button" data-toggle="collapse" data-target="#collapseMedicalHistory" aria-expanded="true" aria-controls="collapseMedicalHistory">
												Riwayat Medis
											</button>
										</h2>
									</div>

									<div id="collapseMedicalHistory" class="collapse show" aria-labelledby="headingOne" data-parent="#medicalHistory">
										<div class="card-body">
											<div class="row">
												<div class="col-12 col-sm-12 col-md-12 col-lg-6">
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="alcohol_history" name="alcohol_history" value="1">
														<label class="form-check-label label-medical-history" for="alcohol_history">Alcohol History</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="balance_problem" name="balance_problem" value="1">
														<label class="form-check-label label-medical-history" for="balance_problem">Balance Problem</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="diabetes" name="diabetes" value="1">
														<label class="form-check-label label-medical-history" for="diabetes">Diabetes</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="eye_vision_problem" name="eye_vision_problem" value="1">
														<label class="form-check-label label-medical-history" for="eye_vision_problem">Eye / Vision Problem</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="heart_surgery" name="heart_surgery" value="1">
														<label class="form-check-label label-medical-history" for="heart_surgery">Heart Surgery</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="infectious_disease" name="infectious_disease" value="1">
														<label class="form-check-label label-medical-history" for="infectious_disease">Infectious Disease</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="lost_of_memory" name="lost_of_memory" value="1">
														<label class="form-check-label label-medical-history" for="lost_of_memory">Lost of Memory</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="psychiatric_problem" name="psychiatric_problem" value="1">
														<label class="form-check-label label-medical-history" for="psychiatric_problem">Psychiatric Problem</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="thyroid_problem" name="thyroid_problem" value="1">
														<label class="form-check-label label-medical-history" for="thyroid_problem">Thyroid Problem</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="allergic_history" name="allergic_history" value="1">
														<label class="form-check-label label-medical-history" for="allergic_history">Allergic History</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="back_or_joint_problem" name="back_or_joint_problem" value="1">
														<label class="form-check-label label-medical-history" for="back_or_joint_problem">Back or Joint Problem</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="digestive_disorder" name="digestive_disorder" value="1">
														<label class="form-check-label label-medical-history" for="digestive_disorder">Digestive Disorder</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="ear_problem" name="ear_problem" value="1">
														<label class="form-check-label label-medical-history" for="ear_problem">Ear Problem</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="heart_disease" name="heart_disease" value="1">
														<label class="form-check-label label-medical-history" for="heart_disease">Heart Disease</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="kidney_problem" name="kidney_problem" value="1">
														<label class="form-check-label label-medical-history" for="kidney_problem">Kidney Problem</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="narcotic_history" name="narcotic_history" value="1">
														<label class="form-check-label label-medical-history" for="narcotic_history">Narcotic History</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="restricted_mobility" name="restricted_mobility" value="1">
														<label class="form-check-label label-medical-history" for="restricted_mobility">Restricted Mobility</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="tuberculosis" name="tuberculosis" value="1">
														<label class="form-check-label label-medical-history" for="tuberculosis">Tuberculosis</label>
													</div>
												</div>
												<div class="col-12 col-sm-12 col-md-12 col-lg-6">
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="amputation" name="amputation" value="1">
														<label class="form-check-label label-medical-history" for="amputation">Amputation</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="colour_blindness" name="colour_blindness" value="1">
														<label class="form-check-label label-medical-history" for="colour_blindness">Colour Blindness</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="depresion" name="depresion" value="1">
														<label class="form-check-label label-medical-history" for="depresion">Depresion</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="fracture" name="fracture" value="1">
														<label class="form-check-label label-medical-history" for="fracture">Fracture</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="high_blood_pressure" name="high_blood_pressure" value="1">
														<label class="form-check-label label-medical-history" for="high_blood_pressure">High Blood Pressure</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="lung_disease" name="lung_disease" value="1">
														<label class="form-check-label label-medical-history" for="lung_disease">Lung Disease</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="neurogical_disease" name="neurogical_disease" value="1">
														<label class="form-check-label label-medical-history" for="neurogical_disease">Neurogical Disease</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="skin_problem" name="skin_problem" value="1">
														<label class="form-check-label label-medical-history" for="skin_problem">Skin Problem</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="smoking" name="smoking" value="1">
														<label class="form-check-label label-medical-history" for="smoking">Smoking</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="blood_disorder" name="blood_disorder" value="1">
														<label class="form-check-label label-medical-history" for="blood_disorder">Blood Disorder</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="cancer" name="cancer" value="1">
														<label class="form-check-label label-medical-history" for="cancer">Cancer</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="epilepsy" name="epilepsy" value="1">
														<label class="form-check-label label-medical-history" for="epilepsy">Epilepsy</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="genital_disorder" name="genital_disorder" value="1">
														<label class="form-check-label label-medical-history" for="genital_disorder">Genital Disorder</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="hernia" name="hernia" value="1">
														<label class="form-check-label label-medical-history" for="hernia">Hernia</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="liver_problem" name="liver_problem" value="1">
														<label class="form-check-label label-medical-history" for="liver_problem">Liver Problem</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="operation_surgery" name="operation_surgery" value="1">
														<label class="form-check-label label-medical-history" for="operation_surgery">Operation / Surgery</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="sleep_problem" name="sleep_problem" value="1">
														<label class="form-check-label label-medical-history" for="sleep_problem">Sleep Problem</label>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="accordion mt-3" id="visionExamination">
								<div class="card">
									<div class="card-header p-0" id="headingOne">
										<h2 class="mb-0">
											<button class="btn btn-light btn-block text-center label-input-result" type="button" data-toggle="collapse" data-target="#collapseVisionExamination" aria-expanded="true" aria-controls="collapseVisionExamination">
												Pemeriksaan Pengelihatan
											</button>
										</h2>
									</div>

									<div id="collapseVisionExamination" class="collapse show" aria-labelledby="headingOne" data-parent="#visionExamination">
										<div class="card-body p-0" style="padding: 10px !important;">
											<div class="form-group">
												<label class="label-input-result">WITHOUT</label>
											</div>
											<div class="form-group mt-n4">
												<label class="label-input-result-2 mb-n2" for="right_eye_without">Mata Kanan</label>
												<input type="text" class="form-control form-control-sm value-input-result" id="right_eye_without" name="right_eye_without" placeholder="Contoh : 20/20" autocomplete="off">
											</div>
											<div class="form-group mt-n2">
												<label class="label-input-result-2 mb-n2" for="left_eye_without">Mata Kiri</label>
												<input type="text" class="form-control form-control-sm value-input-result" id="left_eye_without" name="left_eye_without" placeholder="Contoh : 20/25" autocomplete="off">
											</div>
											<div class="form-group mt-n2">
												<label class="label-input-result-2 mb-n2" for="both_eye_without">Kedua Mata</label>
												<input type="text" class="form-control form-control-sm value-input-result" id="both_eye_without" name="both_eye_without" placeholder="Contoh : 20/25" autocomplete="off">
											</div>
											<div class="form-group mt-n2">
												<label class="label-input-result">WITH</label>
											</div>
											<div class="form-group mt-n4">
												<label class="label-input-result-2 mb-n2" for="right_eye_with">Mata Kanan</label>
												<input type="text" class="form-control form-control-sm value-input-result" id="right_eye_with" name="right_eye_with" placeholder="Contoh : 20/20" autocomplete="off">
											</div>
											<div class="form-group mt-n2">
												<label class="label-input-result-2 mb-n2" for="left_eye_with">Mata Kiri</label>
												<input type="text" class="form-control form-control-sm value-input-result" id="left_eye_with" name="left_eye_with" placeholder="Contoh : 20/25" autocomplete="off">
											</div>
											<div class="form-group mt-n2">
												<label class="label-input-result-2 mb-n2" for="both_eye_with">Kedua Mata</label>
												<input type="text" class="form-control form-control-sm value-input-result" id="both_eye_with" name="both_eye_with" placeholder="Contoh : 20/25" autocomplete="off">
											</div>
											<div class="form-group mt-n2">
												<label class="label-input-result" for="color_vision">PENGELIHATAN WARNA</label>
												<select class="form-control form-control-sm value-input-result" name="color_vision" id="color_vision" required>
													<option value="" disabled selected>Pilih penglihatan warna</option>
													<option value="0">Abnormal</option>
													<option value="1">Normal</option>
													<option value="2">Partial Blindness</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="accordion" id="physicalExamination">
								<div class="card">
									<div class="card-header p-0" id="headingOne">
										<h2 class="mb-0">
											<button class="btn btn-light btn-block text-center label-input-result" type="button" data-toggle="collapse" data-target="#collapsePhysicalExamination" aria-expanded="true" aria-controls="collapsePhysicalExamination">
												Pemeriksaan Fisik
											</button>
										</h2>
									</div>

									<div id="collapsePhysicalExamination" class="collapse show" aria-labelledby="headingOne" data-parent="#physicalExamination">
										<div class="card-body">
											<div class="form-group">
												<label class="label-input-result-2" for="height">Tinggi Badan (cm)</label>
												<input type="text" class="form-control form-control-sm value-input-result" id="height" name="height" placeholder="Contoh : 168 atau 162.8" required autocomplete="off">
											</div>
											<div class="form-group">
												<label class="label-input-result-2" for="weight">Berat Badan (kg)</label>
												<input type="text" class="form-control form-control-sm value-input-result" id="weight" name="weight" placeholder="Contoh : 50 atau 48.8" required autocomplete="off">
											</div>
											<div class="form-group">
												<label class="label-input-result-2" for="blood_pressure">Tekanan Darah (mmHg)</label>
												<input type="text" class="form-control form-control-sm value-input-result" id="blood_pressure" name="blood_pressure" placeholder="Contoh : 100/70" required autocomplete="off">
											</div>
											<div class="form-group">
												<label class="label-input-result-2" for="pulse_regular">Pulse Regular (X/min)</label>
												<input type="text" class="form-control form-control-sm value-input-result" id="pulse_regular" name="pulse_regular" placeholder="Contoh : 84 atau 85.4" required autocomplete="off">
											</div>
											<div class="form-group">
												<label class="label-input-result-2" for="respiratory_rate">Respiratory Rate (X/min)</label>
												<input type="text" class="form-control form-control-sm value-input-result" id="respiratory_rate" name="respiratory_rate" placeholder="Contoh : 20" required autocomplete="off">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="accordion mt-3" id="hearingExamination">
								<div class="card">
									<div class="card-header p-0" id="headingOne">
										<h2 class="mb-0">
											<button class="btn btn-light btn-block text-center label-input-result" type="button" data-toggle="collapse" data-target="#collapseHearingExamination" aria-expanded="true" aria-controls="collapseHearingExamination">
												Pemeriksaan Pendengaran
											</button>
										</h2>
									</div>

									<div id="collapseHearingExamination" class="collapse show" aria-labelledby="headingOne" data-parent="#hearingExamination">
										<div class="card-body">
											<div class="form-group">
												<label class="label-input-result-2" for="right_ear">Kuping Kanan</label>
												<select class="form-control form-control-sm value-input-result" name="right_ear" id="right_ear" required>
													<option value="" disabled selected>Pilih hasil pemeriksaan</option>
													<option value="0">Abnormal</option>
													<option value="1">Normal</option>
												</select>
											</div>
											<div class="form-group">
												<label class="label-input-result-2" for="left_ear">Kuping Kiri</label>
												<select class="form-control form-control-sm value-input-result" name="left_ear" id="left_ear" required>
													<option value="" disabled selected>Pilih hasil pemeriksaan</option>
													<option value="0">Abnormal</option>
													<option value="1">Normal</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="accordion mt-3" id="examination">
								<div class="card">
									<div class="card-header p-0" id="headingOne">
										<h2 class="mb-0">
											<button class="btn btn-light btn-block text-center label-input-result" type="button" data-toggle="collapse" data-target="#collapseExamination" aria-expanded="true" aria-controls="collapseExamination">
												Pemeriksaan
											</button>
										</h2>
									</div>

									<div id="collapseExamination" class="collapse show" aria-labelledby="headingOne" data-parent="#examination">
										<div class="card-body">
											<div class="row">
												<div class="col-md-12 text-center mb-2">
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="allexam" onclick="if(this.checked){myFunction1()}else{myFunction2()}">
														<label class="form-check-label label-medical-history font-weight-bold" for="allexam">Pilih Semua</label>
													</div>
												</div>
												<div class="col-12 col-sm-12 col-md-12 col-lg-5">
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="eyes" name="eyes" value="1">
														<label class="form-check-label label-medical-history" for="eyes">Eyes</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="ears" name="ears" value="1">
														<label class="form-check-label label-medical-history" for="ears">Ears</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="nose" name="nose" value="1">
														<label class="form-check-label label-medical-history" for="nose">Nose</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="mouth" name="mouth" value="1">
														<label class="form-check-label label-medical-history" for="mouth">Mouth</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="throat" name="throat" value="1">
														<label class="form-check-label label-medical-history" for="throat">Throat</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="neck" name="neck" value="1">
														<label class="form-check-label label-medical-history" for="neck">Neck</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="throid" name="throid" value="1">
														<label class="form-check-label label-medical-history" for="throid">Throid</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="lymp_node" name="lymp_node" value="1">
														<label class="form-check-label label-medical-history" for="lymp_node">Lymp Node</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="lungs" name="lungs" value="1">
														<label class="form-check-label label-medical-history" for="lungs">Lungs</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="hearts" name="hearts" value="1">
														<label class="form-check-label label-medical-history" for="hearts">Hearts</label>
													</div>
												</div>
												<div class="col-12 col-sm-12 col-md-12 col-lg-7">
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="abdomen" name="abdomen" value="1">
														<label class="form-check-label label-medical-history" for="abdomen">Abdomen</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="urogenital_system" name="urogenital_system" value="1">
														<label class="form-check-label label-medical-history" for="urogenital_system">Urogenital System</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="upper_extremities" name="upper_extremities" value="1">
														<label class="form-check-label label-medical-history" for="upper_extremities">Upper Extremities</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="lower_extremities" name="lower_extremities" value="1">
														<label class="form-check-label label-medical-history" for="lower_extremities">Lower Extremities</label>
													</div>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="back_abnormality" name="back_abnormality" value="1">
														<label class="form-check-label label-medical-history" for="back_abnormality">Back Abnormality</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="hernia_2" name="hernia_2" value="1">
														<label class="form-check-label label-medical-history" for="hernia_2">Hernia</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="central_nervous_system" name="central_nervous_system" value="1">
														<label class="form-check-label label-medical-history" for="central_nervous_system">Central Nervous System</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="skin_nails" name="skin_nails" value="1">
														<label class="form-check-label label-medical-history" for="skin_nails">Skin & Nails</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="speech" name="speech" value="1">
														<label class="form-check-label label-medical-history" for="speech">Speech</label>
													</div>
													<br>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="other" name="other" value="1">
														<label class="form-check-label label-medical-history" for="other">Other</label>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row mt-3 mr-1">
						<div class="col-md-12">
							<div class="form-group mt-n1">
								<label class="label-input-result" for="general_appearance">Hasil Keseluruhan Pemeriksaan Laboratorium</label>
								<select class="form-control form-control-sm value-input-result mt-n1" id="general_appearance" name="general_appearance" required>
									<option value="" disabled selected>Pilih hasil keseluruhan laboratorium</option>
									<option value="0">Unhealthy</option>
									<option value="1">Healthy</option>
								</select>
							</div>
							<div class="form-group mt-n1">
								<label class="label-input-result" for="details">Jika tidak normal, berikan penjelasan</label>
								<textarea class="form-control value-input-result mt-n1" id="details" name="details" rows="3" autocomplete="off"></textarea>
							</div>
							<button type="submit" class="btn btn-block btn-success mt-2" style="background-color: #04AA6D;">
								<i class="fas fa-fw fa-save"></i> Kirim
							</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-4" style="background-color: #f4f6fa; margin-left: -15px; padding: 10px;">
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