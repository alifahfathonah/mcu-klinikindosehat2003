<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Preview PDF Result</title>

	<!-- Favicons -->
	<link rel="icon" href="<?= base_url('assets/images/favicons/indosehat2003.png') ?>" type="image/gif">

	<!-- Style -->
	<style>
	html,
	body {
		font-family: Arial, Helvetica, sans-serif;
	}

	.container {
		margin-left: 50px;
		margin-right: 50px;
	}

	table td {
		font-size: 11px;
	}

	.box {
		width: 114px;
		height: 152px;
		border: 1px solid black;
		margin-left: 80%;
		margin-top: -165px;
	}
</style>
</head>

<?php if ($data['id_clinic'] == 1) : ?>
	<body style='background-image: url("<?= base_url('assets/images/pdftemplate/kop-cilincing.png') ?>"); background-position: top left; background-repeat: no-repeat; background-image-resize: 4; background-image-resolution: from-image;'>
<?php elseif ($data['id_clinic'] == 2) : ?>
	<body style='background-image: url("<?= base_url('assets/images/pdftemplate/kop-semarang.png') ?>"); background-position: top left; background-repeat: no-repeat; background-image-resize: 4; background-image-resolution: from-image;'>
<?php elseif ($data['id_clinic'] == 3) : ?>
	<body style='background-image: url("<?= base_url('assets/images/pdftemplate/kop-surabaya.png') ?>"); background-position: top left; background-repeat: no-repeat; background-image-resize: 4; background-image-resolution: from-image;'>
<?php elseif ($data['id_clinic'] == 4) : ?>
	<body style='background-image: url("<?= base_url('assets/images/pdftemplate/kop-tegal.png') ?>"); background-position: top left; background-repeat: no-repeat; background-image-resize: 4; background-image-resolution: from-image;'>
<?php elseif ($data['id_clinic'] == 5) : ?>
	<body style='background-image: url("<?= base_url('assets/images/pdftemplate/kop-warakas.png') ?>"); background-position: top left; background-repeat: no-repeat; background-image-resize: 4; background-image-resolution: from-image;'>
<?php endif ?>

<div class="container">
	<table width="100%" cellpadding="1" cellspacing="1">
		<tr>
			<td width="25%"></td>
			<td width="50%" align="center" style="border: 4px; border-style: double;">
				<span style="font-size: 14px; font-weight: bold;">REPORT LABORATORY RESULT</span>
			</td>
			<td width="25%"></td>
		</tr>
	</table>
	<table class="identity" width="100%" cellpadding="4" cellspacing="0" style="border: 1px solid black; margin-top: 5px;">
		<tr>
			<td><b>COMPANY</b></td>
			<td colspan="3" style="border-right: 1px solid black;">: <?= ($data['id_company'] == 0) ? ('PRIVATE') : ($data['company_name']) ?></td>
		</tr>
		<tr>
			<td><b>MCU NO.</b></td>
			<td colspan="3" style="border-right: 1px solid black;">: <?= $data['mcu_manual'] ?></td>
		</tr>
		<tr>
			<td><b>NAME</b></td>
			<td colspan="3" style="border-right: 1px solid black;">: <?= $data['name_patient'] ?></td>
		</tr>
		<tr>
			<td><b>SEX</b></td>
			<td>: <?= $data['gender'] ?></td>
			<td><b>DATE EXAMINE</b></td>
			<td style="border-right: 1px solid black;">: <?= date('d M Y') ?></td>
		</tr>
		<tr>
			<td width="26.75%"><b>PLACE & DATE OF BIRTH</b></td>
			<td width="26.75%">: <?= $data['place_of_birth'] . ' / ' . date('d F Y', strtotime($data['date_of_birth'])) ?></td>
			<td width="13.25%"><b>NATIONALITY</b></td>
			<td width="13.25%" style="border-right: 1px solid black;">: <?= $data['nationality'] ?></td>
			<td width="20%" rowspan="3"></td>
		</tr>
		<tr>
			<td><b>MAILING ADDRESS OF EXAMINE</b></td>
			<td colspan="3" style="border-right: 1px solid black;">: <?= $data['address'] ?></td>
		</tr>
		<tr>
			<td><b>DUTY</b></td>
			<td>: <?= $data['occupation'] ?></td>
			<td><b>PASSPORT</b></td>
			<td style="border-right: 1px solid black;">: <?= $data['passport_number'] ?></td>
		</tr>
	</table>
	<table class="view_2" width="100%" cellpadding="1" cellspacing="0" style="border: 1px solid black; margin-top: 10px;">
		<tr>
			<td align="center" colspan="2" style="border-right: 1px solid black; border-bottom: 1px solid black; padding: 5px;"><b>MEDICAL HISTORY<br><i>(EXAMINE PERSONAL DECLARATION)</i></b></td>
			<td align="center" colspan="5" style="border-bottom: 1px solid black;"><b>PHYSICAL EXAMINATION</b></td>
		</tr>
		<tr>
			<td width="25%"></td>
			<td align="center" width="10%" style="border-right: 1px solid black; padding: 5px;">Yes / No</td>
			<td align="center" width="13%" style="border-right: 1px solid black;"><b>HEIGHT</b></td>
			<td align="center" width="13%" style="border-right: 1px solid black;"><b>WEIGHT</b></td>
			<td align="center" width="13%" style="border-right: 1px solid black;"><b>BLOOD PRESSURE</b></td>
			<td align="center" width="13%" style="border-right: 1px solid black;"><b>PULSE REGULAR</b></td>
			<td align="center" width="13%"><b>RESPIRATORY RATE</b></td>
		</tr>
		<tr>
			<td>&nbsp;1. ALCOHOL HISTORY</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['alcohol_history'] == '0') ? ('No') : ('Yes') ?></td>
			<td align="center" rowspan="2" style="border-right: 1px solid black; border-bottom: 1px solid black;"><?= number_format($data['height']) ?> cm</td>
			<td align="center" rowspan="2" style="border-right: 1px solid black; border-bottom: 1px solid black;"><?= number_format($data['weight']) ?> kg</td>
			<td align="center" rowspan="2" style="border-right: 1px solid black; border-bottom: 1px solid black;"><?= $data['blood_pressure'] ?> mmHg</td>
			<td align="center" rowspan="2" style="border-right: 1px solid black; border-bottom: 1px solid black;"><?= number_format($data['pulse_regular']) ?> X/min</td>
			<td align="center" rowspan="2" style="border-bottom: 1px solid black;"><?= number_format($data['respiratory_rate']) ?> X/min</td>
		</tr>
		<tr>
			<td>&nbsp;2. ALLERGIC HISTORY</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['allergic_history'] == '0') ? ('No') : ('Yes') ?></td>
		</tr>
		<tr>
			<td>&nbsp;3. AMPUTATION</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['amputation'] == '0') ? ('No') : ('Yes') ?></td>
			<td align="center" rowspan="2" style="border-right: 1px solid black; border-bottom: 1px solid black;"><b>VISION</b></td>
			<td align="center" rowspan="2" style="border-right: 1px solid black; border-bottom: 1px solid black;"><b>WITHOUT</b></td>
			<td align="center" rowspan="2" style="border-right: 1px solid black; border-bottom: 1px solid black;"><b>WITH</b></td>
			<td align="center" colspan="2" rowspan="2" style="border-bottom: 1px solid black;"><b>COLOR VISION<br>(ISIHARA'S METHOD)</b></td>
		</tr>
		<tr>
			<td>&nbsp;4. BLOOD DISORDER</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['blood_disorder'] == '0') ? ('No') : ('Yes') ?></td>
		</tr>
		<tr>
			<td>&nbsp;5. BALANCE PROBLEM</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['balance_problem'] == '0') ? ('No') : ('Yes') ?></td>
			<td style="border-right: 1px solid black;">&nbsp;Right Eye</td>
			<td align="center" style="border-right: 1px solid black;"><?= $data['right_eye_without'] ?></td>
			<td align="center" style="border-right: 1px solid black;"><?= $data['right_eye_with'] ?></td>
			<td align="center" colspan="2" rowspan="6" style="border-bottom: 1px solid black;">
				<?php if ($data['color_vision'] == '0') : ?>
					ABNORMAL
				<?php elseif ($data['color_vision'] == '1') : ?>
					NORMAL
				<?php elseif ($data['color_vision'] == '2') : ?>
					PARTIAL BLINDNESS<br>(Buta Warna Parsial / Buta Warna Sebagian)
				<?php endif ?>	
			</td>
		</tr>
		<tr>
			<td>&nbsp;6. BACK OR JOINT PROBLEM</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['back_or_joint_problem'] == '0') ? ('No') : ('Yes') ?></td>
			<td style="border-right: 1px solid black;">&nbsp;Left Eye</td>
			<td align="center" style="border-right: 1px solid black;"><?= $data['left_eye_without'] ?></td>
			<td align="center" style="border-right: 1px solid black;"><?= $data['left_eye_with'] ?></td>
		</tr>
		<tr>
			<td>&nbsp;7. COLOUR BLINDNESS</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['colour_blindness'] == '0') ? ('No') : ('Yes') ?></td>
			<td style="border-right: 1px solid black; border-bottom: 1px solid black;">&nbsp;Both Eye</td>
			<td align="center" style="border-right: 1px solid black; border-bottom: 1px solid black;"><?= $data['both_eye_without'] ?></td>
			<td align="center" style="border-right: 1px solid black; border-bottom: 1px solid black;"><?= $data['both_eye_with'] ?></td>
		</tr>
		<tr>
			<td>&nbsp;8. CANCER</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['cancer'] == '0') ? ('No') : ('Yes') ?></td>
			<td align="center" colspan="3" style="border-right: 1px solid black;"><b>GENERAL APPEARANCE</b></td>
		</tr>
		<tr>
			<td>&nbsp;9. DIABETES</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['diabetes'] == '0') ? ('No') : ('Yes') ?></td>
			<td align="center" colspan="3" rowspan="2" style="border-right: 1px solid black; border-bottom: 1px solid black;"><?= ($data['general_appearance'] == '0') ? ('LOOKING UNHEALTHY') : ('LOOKING HEALTHY') ?></td>
		</tr>
		<tr>
			<td>&nbsp;10. DIGESTIVE DISORDER</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['digestive_disorder'] == '0') ? ('No') : ('Yes') ?></td>
		</tr>
		<tr>
			<td>&nbsp;11. DEPRESION</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['depresion'] == '0') ? ('No') : ('Yes') ?></td>
			<td colspan="2" rowspan="2">&nbsp;NORMAL</td>
			<td colspan="2"></td>
		</tr>
		<tr>
			<td>&nbsp;12. EPILEPSY</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['epilepsy'] == '0') ? ('No') : ('Yes') ?></td>
		</tr>
		<tr>
			<td>&nbsp;13. EYE / VISION PROBLEM</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['eye_vision_problem'] == '0') ? ('No') : ('Yes') ?></td>
			<td colspan="3">&nbsp;1. EYES</td>
			<td colspan="2"><?= ($data['eyes'] == '0') ? ('No') : ('Yes') ?></td>
		</tr>
		<tr>
			<td>&nbsp;14. EAR PROBLEM</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['ear_problem'] == '0') ? ('No') : ('Yes') ?></td>
			<td colspan="3">&nbsp;2. EARS</td>
			<td colspan="2"><?= ($data['ears'] == '0') ? ('No') : ('Yes') ?></td>
		</tr>
		<tr>
			<td>&nbsp;15. FRACTURE</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['fracture'] == '0') ? ('No') : ('Yes') ?></td>
			<td colspan="3">&nbsp;3. NOSE</td>
			<td colspan="2"><?= ($data['nose'] == '0') ? ('No') : ('Yes') ?></td>
		</tr>
		<tr>
			<td>&nbsp;16. GENITAL DISORDER</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['genital_disorder'] == '0') ? ('No') : ('Yes') ?></td>
			<td colspan="3">&nbsp;4. MOUTH</td>
			<td colspan="2"><?= ($data['mouth'] == '0') ? ('No') : ('Yes') ?></td>
		</tr>
		<tr>
			<td>&nbsp;17. HEART SURGERY</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['heart_surgery'] == '0') ? ('No') : ('Yes') ?></td>
			<td colspan="3">&nbsp;5. THROAT</td>
			<td colspan="2"><?= ($data['throat'] == '0') ? ('No') : ('Yes') ?></td>
		</tr>
		<tr>
			<td>&nbsp;18. HEART DISEASE</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['heart_disease'] == '0') ? ('No') : ('Yes') ?></td>
			<td colspan="3">&nbsp;6. NECK</td>
			<td colspan="2"><?= ($data['neck'] == '0') ? ('No') : ('Yes') ?></td>
		</tr>
		<tr>
			<td>&nbsp;19. HIGH BLOOD PRESSURE</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['high_blood_pressure'] == '0') ? ('No') : ('Yes') ?></td>
			<td colspan="3">&nbsp;7. THROID</td>
			<td colspan="2"><?= ($data['throid'] == '0') ? ('No') : ('Yes') ?></td>
		</tr>
		<tr>
			<td>&nbsp;20. HERNIA</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['hernia'] == '0') ? ('No') : ('Yes') ?></td>
			<td colspan="3">&nbsp;8. LYMP NODE</td>
			<td colspan="2"><?= ($data['lymp_node'] == '0') ? ('No') : ('Yes') ?></td>
		</tr>
		<tr>
			<td>&nbsp;21. INFECTIOUS DISEASE</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['infectious_disease'] == '0') ? ('No') : ('Yes') ?></td>
			<td colspan="3">&nbsp;9. LUNGS</td>
			<td colspan="2"><?= ($data['lungs'] == '0') ? ('No') : ('Yes') ?></td>
		</tr>
		<tr>
			<td>&nbsp;22. KIDNEY PROBLEM</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['kidney_problem'] == '0') ? ('No') : ('Yes') ?></td>
			<td colspan="3">&nbsp;10. HEARTS</td>
			<td colspan="2"><?= ($data['hearts'] == '0') ? ('No') : ('Yes') ?></td>
		</tr>
		<tr>
			<td>&nbsp;23. LUNG DISEASE</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['lung_disease'] == '0') ? ('No') : ('Yes') ?></td>
			<td colspan="3">&nbsp;11. ABDOMEN</td>
			<td colspan="2"><?= ($data['abdomen'] == '0') ? ('No') : ('Yes') ?></td>
		</tr>
		<tr>
			<td>&nbsp;24. LIVER PROBLEM</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['liver_problem'] == '0') ? ('No') : ('Yes') ?></td>
			<td colspan="3">&nbsp;12. UROGENITAL SYSTEM</td>
			<td colspan="2"><?= ($data['urogenital_system'] == '0') ? ('No') : ('Yes') ?></td>
		</tr>
		<tr>
			<td>&nbsp;25. LOST OF MEMORY</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['lost_of_memory'] == '0') ? ('No') : ('Yes') ?></td>
			<td colspan="3">&nbsp;13. UPPER EXTREMITIES</td>
			<td colspan="2"><?= ($data['upper_extremities'] == '0') ? ('No') : ('Yes') ?></td>
		</tr>
		<tr>
			<td>&nbsp;26. NARCOTIC HISTORY</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['narcotic_history'] == '0') ? ('No') : ('Yes') ?></td>
			<td colspan="3">&nbsp;14. LOWER EXTREMITIES</td>
			<td colspan="2"><?= ($data['lower_extremities'] == '0') ? ('No') : ('Yes') ?></td>
		</tr>
		<tr>
			<td>&nbsp;27. NEUROGICAL DISEASE</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['neurogical_disease'] == '0') ? ('No') : ('Yes') ?></td>
			<td colspan="3">&nbsp;15. BACK ABNORMALITY</td>
			<td colspan="2"><?= ($data['back_abnormality'] == '0') ? ('No') : ('Yes') ?></td>
		</tr>
		<tr>
			<td>&nbsp;28. OPERATION / SURGERY</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['operation_surgery'] == '0') ? ('No') : ('Yes') ?></td>
			<td colspan="3">&nbsp;16. HERNIA</td>
			<td colspan="2"><?= ($data['hernia_2'] == '0') ? ('No') : ('Yes') ?></td>
		</tr>
		<tr>
			<td>&nbsp;29. PSYCHIATRIC PROBLEM</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['psychiatric_problem'] == '0') ? ('No') : ('Yes') ?></td>
			<td colspan="3">&nbsp;17. CENTRAL NERVOUS SYSTEM</td>
			<td><?= ($data['central_nervous_system'] == '0') ? ('No') : ('Yes') ?></td>
			<td rowspan="7" align="center" style="border-bottom: 1px solid black;">
				<img src="<?= base_url("assets/images/qrcode/") . $data['qrcode'] ?>" width="84px">
			</td>
		</tr>
		<tr>
			<td>&nbsp;30. RESTRICTED MOBILITY</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['restricted_mobility'] == '0') ? ('No') : ('Yes') ?></td>
			<td colspan="3">&nbsp;18. SKIN & NAILS</td>
			<td><?= ($data['skin_nails'] == '0') ? ('No') : ('Yes') ?></td>
		</tr>
		<tr>
			<td>&nbsp;31. SKIN PROBLEM</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['skin_problem'] == '0') ? ('No') : ('Yes') ?></td>
			<td colspan="3">&nbsp;19. SPEECH</td>
			<td><?= ($data['speech'] == '0') ? ('No') : ('Yes') ?></td>
		</tr>
		<tr>
			<td>&nbsp;32. SLEEP PROBLEM</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['sleep_problem'] == '0') ? ('No') : ('Yes') ?></td>
			<td colspan="3">&nbsp;20. OTHERS</td>
			<td><?= ($data['other'] == '0') ? ('No') : ('Yes') ?></td>
		</tr>
		<tr>
			<td>&nbsp;33. THYROID PROBLEM</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['thyroid_problem'] == '0') ? ('No') : ('Yes') ?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>&nbsp;34. TUBERCULOSIS</td>
			<td align="center" style="border-right: 1px solid black;"><?= ($data['tuberculosis'] == '0') ? ('No') : ('Yes') ?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td style="border-bottom: 1px solid black;">&nbsp;35. SMOKING</td>
			<td align="center" style="border-right: 1px solid black; border-bottom: 1px solid black;"><?= ($data['smoking'] == '0' | $data['smoking'] == NULL) ? ('No') : ('Yes') ?></td>
			<td style="border-bottom: 1px solid black;"></td>
			<td style="border-bottom: 1px solid black;"></td>
			<td style="border-bottom: 1px solid black;"></td>
			<td style="border-bottom: 1px solid black;"></td>
		</tr>
		<tr>
			<td align="center" colspan="2" style="border-right: 1px solid black; border-bottom: 1px solid black;"><b>DENTAL EXAMINATION</b></td>
			<td align="center" colspan="2" style="border-right: 1px solid black; border-bottom: 1px solid black;"><b>HEARING</b></td>
			<td colspan="3"><b>If abnormal, give details</b></td>
		</tr>
		<tr>
			<td align="center" colspan="2" style="border-right: 1px solid black;"><span style="border-bottom: 1px solid black;">8 7 6 5 4 3 2 1 | 1 2 3 4 5 6 7 8</span></td>
			<td align="right" colspan="2" style="border-right: 1px solid black;">NORMAL&nbsp;</td>
			<td colspan="3" rowspan="4"><?= $data['details'] ?></td>
		</tr>
		<tr>
			<td align="center" colspan="2" style="border-right: 1px solid black;">8 7 6 5 4 3 2 1 | 1 2 3 4 5 6 7 8</td>
			<td>&nbsp;Right Ear</td>
			<td align="right" style="border-right: 1px solid black;"><?= ($data['right_ear'] == '0') ? ('No') : ('Yes') ?>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" style="border-right: 1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#8226; : Filling&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;O : Caries &nbsp;&nbsp;&nbsp;&nbsp;^ : Root Rest</td>
			<td>&nbsp;Left Ear</td>
			<td align="right" style="border-right: 1px solid black;"><?= ($data['left_ear'] == '0') ? ('No') : ('Yes') ?>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" style="border-right: 1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;x : Missing&nbsp;&nbsp;&nbsp;V : Prothesa</td>
			<td colspan="2" style="border-right: 1px solid black;"></td>
		</tr>
	</table>
</div>
</body>

</html>
