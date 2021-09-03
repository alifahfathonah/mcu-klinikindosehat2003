<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mcu extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mcu_model', 'mcu');
		$this->load->model('clinic_model', 'clinic');
	}

	/** 
	 * Serverside Datatables for this controller
	 */
	function get_ajax_mcu()
	{
		$list = $this->mcu->get_datatables_mcu();
		$data = [];
		$no   = @$_POST['start'];
		foreach ($list as $item) {
			$no++;
			$row   = [];
			$row[] = $no . ".";
			$row[] = ($item->mcu_manual != NULL) ? ($item->mcu_manual) : ($item->medical_record_number);
			$row[] = $item->patient_name;
			$row[] = $item->patient_id_number;

			// Action Button
			if ($item->mcu_is_fit == NULL) {
				if ($this->session->userdata('role') == 'superuser' || $this->session->userdata('role') == 'doctor') {
					if ($item->type_examination == 'umum') {
						$row[] = '
							<a class="button-warning" href="' . base_url('mcu/formEditUmumRevMcu/' . md5($item->id) . '/' . $item->medical_record_number) . '"><i class="fas fa-fw fa-edit"></i> <i>Edit</i></a>
							<a class="button-primary" href="' . base_url('mcu/formInputUmumResult/' . md5($item->id) . '/' . $item->medical_record_number) . '"><i class="far fa-fw fa-window-restore"></i> <i>Input Umum Result</i></a>
						';
					} elseif ($item->type_examination == 'rev') {
						$row[] = '
							<a class="button-warning" href="' . base_url('mcu/formEditUmumRevMcu/' . md5($item->id) . '/' . $item->medical_record_number) . '"><i class="fas fa-fw fa-edit"></i> <i>Edit</i></a>
							<a class="button-primary" href="' . base_url('mcu/formInputRevResult/' . md5($item->id) . '/' . $item->medical_record_number) . '"><i class="far fa-fw fa-window-restore"></i> <i>Input Revalidasi Result</i></a>
						';
					} elseif ($item->type_examination == 'mcu') {
						$row[] = '
							<a class="button-warning" href="' . base_url('mcu/formEditUmumRevMcu/' . md5($item->id) . '/' . $item->medical_record_number) . '"><i class="fas fa-fw fa-edit"></i> <i>Edit</i></a>
							<a class="button-primary" href="' . base_url('mcu/formInputMcuResult/' . md5($item->id) . '/' . $item->medical_record_number) . '"><i class="far fa-fw fa-window-restore"></i> <i>Input MCU Result</i></a>
						';
					}
				} else {
					if ($item->type_examination == 'umum') {
						$row[] = '
							
						';
					} elseif ($item->type_examination == 'rev') {
						$row[] = '
							
						';
					} elseif ($item->type_examination == 'mcu') {
						$row[] = '
							
						';
					}
				}
			} else {
				if ($this->session->userdata('role') == 'superuser' || $this->session->userdata('role') == 'doctor') {				
					if ($item->type_examination == 'umum') {
						$row[] = '
							<a class="button-warning" href="' . base_url('mcu/formEditUmumWithResult/' . md5($item->id) . '/' . $item->medical_record_number) . '"><i class="fas fa-fw fa-edit"></i> <i>Edit</i></a>
							<a class="button-info" href="' . base_url('mcu/downloadUmumResultPdf/' . $item->medical_record_number) . '"><i>Download</i> <i class="fas fa-fw fa-file-pdf"></i></a>
							<a class="button-danger" href="' . base_url('mcu/previewUmumResultPdf/' . $item->medical_record_number) . '"><i class="far fa-fw fa-eye"></i> <i>View</i></a>
						';
					} elseif ($item->type_examination == 'rev') {
						$row[] = '
							<a class="button-warning" href="' . base_url('mcu/formEditRevWithResult/' . md5($item->id) . '/' . $item->medical_record_number) . '"><i class="fas fa-fw fa-edit"></i> <i>Edit</i></a>
							<a class="button-success" href="' . base_url('mcu/downloadQRCodePng/' . $item->medical_record_number) . '"><i>Download</i> <i class="fas fa-fw fa-qrcode"></i></a>
							<a class="button-info" href="' . base_url('mcu/downloadRevResultPdf/' . $item->medical_record_number) . '"><i>Download</i> <i class="fas fa-fw fa-file-pdf"></i></a>
							<a class="button-danger" href="' . base_url('mcu/previewRevResultPdf/' . $item->medical_record_number) . '"><i class="far fa-fw fa-eye"></i> <i>View</i></a>
						';	
					} elseif ($item->type_examination == 'mcu') {
						$row[] = '
							<a class="button-warning" href="' . base_url('mcu/formEditMcuWithResult/' . md5($item->id) . '/' . $item->medical_record_number) . '"><i class="fas fa-fw fa-edit"></i> <i>Edit</i></a>
							<a class="button-success" href="' . base_url('mcu/downloadQRCodePng/' . $item->medical_record_number) . '"><i>Download</i> <i class="fas fa-fw fa-qrcode"></i></a>
							<a class="button-info" href="' . base_url('mcu/downloadMcuResultPdf/' . $item->medical_record_number) . '"><i>Download</i> <i class="fas fa-fw fa-file-pdf"></i></a>
							<a class="button-danger" href="' . base_url('mcu/previewMcuResultPdf/' . $item->medical_record_number) . '"><i class="far fa-fw fa-eye"></i> <i>View</i></a>
						';
					}
				} else {
					if ($item->type_examination == 'umum') {
						$row[] = '
							<a class="button-info" href="' . base_url('mcu/downloadUmumResultPdf/' . $item->medical_record_number) . '"><i>Download</i> <i class="fas fa-fw fa-file-pdf"></i></a>
							<a class="button-danger" href="' . base_url('mcu/previewUmumResultPdf/' . $item->medical_record_number) . '"><i class="far fa-fw fa-eye"></i> <i>View</i></a>
						';
					} elseif ($item->type_examination == 'rev') {
						$row[] = '
							<a class="button-success" href="' . base_url('mcu/downloadQRCodePng/' . $item->medical_record_number) . '"><i>Download</i> <i class="fas fa-fw fa-qrcode"></i></a>
							<a class="button-info" href="' . base_url('mcu/downloadRevResultPdf/' . $item->medical_record_number) . '"><i>Download</i> <i class="fas fa-fw fa-file-pdf"></i></a>
							<a class="button-danger" href="' . base_url('mcu/previewRevResultPdf/' . $item->medical_record_number) . '"><i class="far fa-fw fa-eye"></i> <i>View</i></a>
						';
					} elseif ($item->type_examination == 'mcu') {
						$row[] = '
							<a class="button-success" href="' . base_url('mcu/downloadQRCodePng/' . $item->medical_record_number) . '"><i>Download</i> <i class="fas fa-fw fa-qrcode"></i></a>
							<a class="button-info" href="' . base_url('mcu/downloadMcuResultPdf/' . $item->medical_record_number) . '"><i>Download</i> <i class="fas fa-fw fa-file-pdf"></i></a>
							<a class="button-danger" href="' . base_url('mcu/previewMcuResultPdf/' . $item->medical_record_number) . '"><i class="far fa-fw fa-eye"></i> <i>View</i></a>
						';
					}
				}
			}

			$data[] = $row;
		}

		$output = [
			"draw"            => @$_POST['draw'],
			"recordsTotal"    => $this->mcu->count_all(),
			"recordsFiltered" => $this->mcu->count_filtered(),
			"data"            => $data
		];

		// Output to JSON Format
		echo json_encode($output);
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		if (!$this->session->has_userdata('logged_in')) {
			redirect('auth');
		} else {
			$data = [
				'title' => 'MCU'
			];

			$this->load->view('templates/header', $data);
			$this->load->view('templates/navbar');
			$this->load->view('templates/sidebar');
			$this->load->view('mcus/index');
			$this->load->view('templates/footer');
		}
	}

	public function makeRev()
	{
		if (!$this->session->has_userdata('logged_in')) {
			redirect('auth');
		} else {
			date_default_timezone_set("Asia/Jakarta");

			$id_patient 		   = $this->input->post('id_patient');
			$url_for_qrcode		   = base_url('mcu/mcuResultPreview/');
			$medical_record_number = $this->mcu->get_medical_record_number('rev');
			$no_transaction		   = $this->mcu->get_no_transaction($id_patient, 'rev');

			// Save file image of qrcode
			$this->load->library('ciqrcode');

			$configUploadQrcode['cacheable'] = true;
			$configUploadQrcode['cachedir']	 = './assets/';
			$configUploadQrcode['errorlog']  = './assets/';
			$configUploadQrcode['imagedir']  = './assets/images/qrcode/';
			$configUploadQrcode['quality']   = true;
			$configUploadQrcode['size']      = '1024';
			$configUploadQrcode['black']     = array(224, 255, 255);
			$configUploadQrcode['white']     = array(70, 130, 180);
			$this->ciqrcode->initialize($configUploadQrcode);

			$image_name = $medical_record_number . '.png';

			$params['data']  	= $url_for_qrcode . $medical_record_number;
			$params['level'] 	= 'H';
			$params['size']  	= 10;
			$params['savename'] = FCPATH . $configUploadQrcode['imagedir'] . $image_name;
			$this->ciqrcode->generate($params);

			$data_mcus_v1 = [
				'medical_record_number' => $medical_record_number,
				'id_clinic'				=> $this->input->post('id_clinic'),
				'id_patient'			=> $id_patient,
				'id_number_patient'		=> $this->input->post('id_number_patient'),
				'name_patient'			=> $this->input->post('name_patient'),
				'no_transaction'		=> $no_transaction,
				'type_examination'		=> 'rev',
				'date_examination'		=> $this->input->post('date_examination'),
				'qrcode'				=> $image_name,
				'created_at'			=> date('Y-m-d H:i:s')
			];

			$data_transactions = [
				'no_transaction'		=> $no_transaction,
				'id_clinic'				=> $this->input->post('id_clinic'),
				'id_patient' 			=> $id_patient,
				'id_company' 			=> $this->input->post('id_company'),
				'medical_record_number' => $medical_record_number,
				'patient_name' 			=> $this->input->post('name_patient'),
				'patient_id_number' 	=> $this->input->post('id_number_patient'),
				'type_examination' 		=> 'rev',
				'type_transaction'	 	=> $this->input->post('type_transaction'),
				'total_price' 			=> preg_replace("/[^0-9]/", "", $this->input->post('total_price'))
			];

			$this->mcu->store_to_table_mcus_v1($data_mcus_v1);
			$this->mcu->store_to_table_transactions($data_transactions);

			$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'New Revalidation has been added!',showConfirmButton: false,timer: 1500})</script>");

			redirect('patient');
		}
	}

	public function makeMcu()
	{
		if (!$this->session->has_userdata('logged_in')) {
			redirect('auth');
		} else {
			date_default_timezone_set("Asia/Jakarta");

			$id_patient 		   = $this->input->post('id_patient');
			$url_for_qrcode		   = base_url('mcu/mcuResultPreview/');
			$medical_record_number = $this->mcu->get_medical_record_number('mcu');
			$no_transaction		   = $this->mcu->get_no_transaction($id_patient, 'mcu');

			// Save file image of qrcode
			$this->load->library('ciqrcode');

			$configUploadQrcode['cacheable'] = true;
			$configUploadQrcode['cachedir']	 = './assets/';
			$configUploadQrcode['errorlog']  = './assets/';
			$configUploadQrcode['imagedir']  = './assets/images/qrcode/';
			$configUploadQrcode['quality']   = true;
			$configUploadQrcode['size']      = '1024';
			$configUploadQrcode['black']     = array(224, 255, 255);
			$configUploadQrcode['white']     = array(70, 130, 180);
			$this->ciqrcode->initialize($configUploadQrcode);

			$image_name = $medical_record_number . '.png';

			$params['data']  	= $url_for_qrcode . $medical_record_number;
			$params['level'] 	= 'H';
			$params['size']  	= 10;
			$params['savename'] = FCPATH . $configUploadQrcode['imagedir'] . $image_name;
			$this->ciqrcode->generate($params);

			$data_mcus_v1 = [
				'medical_record_number' => $medical_record_number,
				'id_clinic'				=> $this->input->post('id_clinic'),
				'id_patient'			=> $id_patient,
				'id_number_patient'		=> $this->input->post('id_number_patient'),
				'name_patient'			=> $this->input->post('name_patient'),
				'no_transaction'		=> $no_transaction,
				'type_examination'		=> 'mcu',
				'date_examination'		=> $this->input->post('date_examination'),
				'qrcode'				=> $image_name,
				'created_at'			=> date('Y-m-d H:i:s')
			];

			$data_transactions = [
				'no_transaction'		=> $no_transaction,
				'id_clinic'				=> $this->input->post('id_clinic'),
				'id_patient' 			=> $id_patient,
				'id_company' 			=> $this->input->post('id_company'),
				'medical_record_number' => $medical_record_number,
				'patient_name' 			=> $this->input->post('name_patient'),
				'patient_id_number' 	=> $this->input->post('id_number_patient'),
				'type_examination' 		=> 'mcu',
				'type_transaction'	 	=> $this->input->post('type_transaction'),
				'total_price' 			=> preg_replace("/[^0-9]/", "", $this->input->post('total_price'))
			];

			$this->mcu->store_to_table_mcus_v1($data_mcus_v1);
			$this->mcu->store_to_table_transactions($data_transactions);

			$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'New MCU has been added!',showConfirmButton: false,timer: 1500})</script>");

			redirect('patient');
		}
	}

	public function formInputRevResult($id, $medical_record_number)
	{
		if (!$this->session->has_userdata('logged_in')) {
			redirect('auth');
		} else {
			$data = [
				'title'   => 'MCU',
				'data'    => $this->mcu->get_data_mcu_by_medical_record_number($medical_record_number)
			];

			$this->load->view('templates/header', $data);
			$this->load->view('templates/navbar');
			$this->load->view('templates/sidebar');
			$this->load->view('mcus/form_input_rev_result');
			$this->load->view('templates/footer');
		}
	}

	public function inputRevResultProcess()
	{
		if (!$this->session->has_userdata('logged_in')) {
			redirect('auth');
		} else {
			date_default_timezone_set("Asia/Jakarta");

			$medical_record_number = $this->input->post('medical_record_number');

			$data_mcus_v1 = [
				'mcu_manual' 	  => $this->input->post('mcu_manual'),
				'is_fit'	  	  => $this->input->post('is_fit'),
				'validity_period' => ($this->input->post('validity_period') == NULL) ? ('0') : ('1'),
				'updated_at' 	  => date('Y-m-d H:i:s')
			];

			$data_mcus_v2 = [
				'medical_record_number'  => $medical_record_number,
				'alcohol_history' 		 => ($this->input->post('alcohol_history') == NULL) ? ('0') : ('1'),
				'allergic_history'		 => ($this->input->post('allergic_history') == NULL) ? ('0') : ('1'),
				'amputation' 			 => ($this->input->post('amputation') == NULL) ? ('0') : ('1'),
				'blood_disorder'		 => ($this->input->post('blood_disorder') == NULL) ? ('0') : ('1'),
				'balance_problem' 		 => ($this->input->post('balance_problem') == NULL) ? ('0') : ('1'),
				'back_or_joint_problem'  => ($this->input->post('back_or_joint_problem') == NULL) ? ('0') : ('1'),
				'colour_blindness' 		 => ($this->input->post('colour_blindness') == NULL) ? ('0') : ('1'),
				'cancer'	 			 => ($this->input->post('cancer') == NULL) ? ('0') : ('1'),
				'diabetes' 				 => ($this->input->post('diabetes') == NULL) ? ('0') : ('1'),
				'digestive_disorder' 	 => ($this->input->post('digestive_disorder') == NULL) ? ('0') : ('1'),
				'depresion' 			 => ($this->input->post('depresion') == NULL) ? ('0') : ('1'),
				'epilepsy' 				 => ($this->input->post('epilepsy') == NULL) ? ('0') : ('1'),
				'eye_vision_problem' 	 => ($this->input->post('eye_vision_problem') == NULL) ? ('0') : ('1'),
				'ear_problem'		 	 => ($this->input->post('ear_problem') == NULL) ? ('0') : ('1'),
				'fracture' 				 => ($this->input->post('fracture') == NULL) ? ('0') : ('1'),
				'genital_disorder' 		 => ($this->input->post('genital_disorder') == NULL) ? ('0') : ('1'),
				'heart_surgery' 		 => ($this->input->post('heart_surgery') == NULL) ? ('0') : ('1'),
				'heart_disease' 		 => ($this->input->post('heart_disease') == NULL) ? ('0') : ('1'),
				'high_blood_pressure' 	 => ($this->input->post('high_blood_pressure') == NULL) ? ('0') : ('1'),
				'hernia' 				 => ($this->input->post('hernia') == NULL) ? ('0') : ('1'),
				'infectious_disease' 	 => ($this->input->post('infectious_disease') == NULL) ? ('0') : ('1'),
				'kidney_problem' 		 => ($this->input->post('kidney_problem') == NULL) ? ('0') : ('1'),
				'lung_disease'	 		 => ($this->input->post('lung_disease') == NULL) ? ('0') : ('1'),
				'liver_problem' 		 => ($this->input->post('liver_problem') == NULL) ? ('0') : ('1'),
				'lost_of_memory'	 	 => ($this->input->post('lost_of_memory') == NULL) ? ('0') : ('1'),
				'narcotic_history' 		 => ($this->input->post('narcotic_history') == NULL) ? ('0') : ('1'),
				'neurogical_disease' 	 => ($this->input->post('neurogical_disease') == NULL) ? ('0') : ('1'),
				'operation_surgery' 	 => ($this->input->post('operation_surgery') == NULL) ? ('0') : ('1'),
				'psychiatric_problem' 	 => ($this->input->post('psychiatric_problem') == NULL) ? ('0') : ('1'),
				'restricted_mobility' 	 => ($this->input->post('restricted_mobility') == NULL) ? ('0') : ('1'),
				'skin_problem' 			 => ($this->input->post('skin_problem') == NULL) ? ('0') : ('1'),
				'sleep_problem' 		 => ($this->input->post('sleep_problem') == NULL) ? ('0') : ('1'),
				'thyroid_problem' 		 => ($this->input->post('thyroid_problem') == NULL) ? ('0') : ('1'),
				'tuberculosis' 			 => ($this->input->post('tuberculosis') == NULL) ? ('0') : ('1'),
				'height' 				 => $this->input->post('height'),
				'weight' 				 => $this->input->post('weight'),
				'blood_pressure' 		 => $this->input->post('blood_pressure'),
				'pulse_regular' 		 => $this->input->post('pulse_regular'),
				'respiratory_rate' 		 => $this->input->post('respiratory_rate'),
				'right_eye_without' 	 => $this->input->post('right_eye_without'),
				'left_eye_without' 		 => $this->input->post('left_eye_without'),
				'both_eye_without' 		 => $this->input->post('both_eye_without'),
				'right_eye_with' 		 => $this->input->post('right_eye_with'),
				'left_eye_with' 		 => $this->input->post('left_eye_with'),
				'both_eye_with' 		 => $this->input->post('both_eye_with'),
				'color_vision' 			 => $this->input->post('color_vision'),
				'general_appearance' 	 => $this->input->post('general_appearance'),
				'eyes' 					 => ($this->input->post('eyes') == NULL) ? ('0') : ('1'),
				'ears' 					 => ($this->input->post('ears') == NULL) ? ('0') : ('1'),
				'nose' 					 => ($this->input->post('nose') == NULL) ? ('0') : ('1'),
				'mouth' 				 => ($this->input->post('mouth') == NULL) ? ('0') : ('1'),
				'throat' 				 => ($this->input->post('throat') == NULL) ? ('0') : ('1'),
				'neck' 					 => ($this->input->post('neck') == NULL) ? ('0') : ('1'),
				'throid'	 			 => ($this->input->post('throid') == NULL) ? ('0') : ('1'),
				'lymp_node' 			 => ($this->input->post('lymp_node') == NULL) ? ('0') : ('1'),
				'lungs'		 			 => ($this->input->post('lungs') == NULL) ? ('0') : ('1'),
				'hearts' 				 => ($this->input->post('hearts') == NULL) ? ('0') : ('1'),
				'abdomen' 				 => ($this->input->post('abdomen') == NULL) ? ('0') : ('1'),
				'urogenital_system' 	 => ($this->input->post('urogenital_system') == NULL) ? ('0') : ('1'),
				'upper_extremities' 	 => ($this->input->post('upper_extremities') == NULL) ? ('0') : ('1'),
				'lower_extremities' 	 => ($this->input->post('lower_extremities') == NULL) ? ('0') : ('1'),
				'back_abnormality' 		 => ($this->input->post('back_abnormality') == NULL) ? ('0') : ('1'),
				'hernia_2' 				 => ($this->input->post('hernia_2') == NULL) ? ('0') : ('1'),
				'central_nervous_system' => ($this->input->post('central_nervous_system') == NULL) ? ('0') : ('1'),
				'skin_nails' 			 => ($this->input->post('skin_nails') == NULL) ? ('0') : ('1'),
				'speech' 				 => ($this->input->post('speech') == NULL) ? ('0') : ('1'),
				'other'	 				 => ($this->input->post('other') == NULL) ? ('0') : ('1'),
				'right_ear' 			 => $this->input->post('right_ear'),
				'left_ear' 				 => $this->input->post('left_ear'),
				'details'	 			 => $this->input->post('details')
			];

			$this->mcu->update_table_mcus_v1($medical_record_number, $data_mcus_v1);
			$this->mcu->store_to_table_mcus_v2($data_mcus_v2);

			$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Insert Revalidation Result successfully!',showConfirmButton: false,timer: 1500})</script>");

			redirect('mcu');
		}
	}

	public function formInputMcuResult($id, $medical_record_number)
	{
		if (!$this->session->has_userdata('logged_in')) {
			redirect('auth');
		} else {
			$data = [
				'title'   => 'MCU',
				'data'    => $this->mcu->get_data_mcu_by_medical_record_number($medical_record_number)
			];

			$this->load->view('templates/header', $data);
			$this->load->view('templates/navbar');
			$this->load->view('templates/sidebar');
			$this->load->view('mcus/form_input_mcu_result');
			$this->load->view('templates/footer');
		}
	}

	public function inputMcuResultProcess()
	{
		if (!$this->session->has_userdata('logged_in')) {
			redirect('auth');
		} else {
			date_default_timezone_set("Asia/Jakarta");

			$medical_record_number = $this->input->post('medical_record_number');

			$data_mcus_v1 = [
				'mcu_manual' 	  => $this->input->post('mcu_manual'),
				'is_fit'	  	  => $this->input->post('is_fit'),
				'validity_period' => ($this->input->post('validity_period') == NULL) ? ('0') : ('1'),
				'updated_at' 	  => date('Y-m-d H:i:s')
			];

			$data_mcus_v2 = [
				'medical_record_number'  => $medical_record_number,
				'alcohol_history' 		 => ($this->input->post('alcohol_history') == NULL) ? ('0') : ('1'),
				'allergic_history'		 => ($this->input->post('allergic_history') == NULL) ? ('0') : ('1'),
				'amputation' 			 => ($this->input->post('amputation') == NULL) ? ('0') : ('1'),
				'blood_disorder'		 => ($this->input->post('blood_disorder') == NULL) ? ('0') : ('1'),
				'balance_problem' 		 => ($this->input->post('balance_problem') == NULL) ? ('0') : ('1'),
				'back_or_joint_problem'  => ($this->input->post('back_or_joint_problem') == NULL) ? ('0') : ('1'),
				'colour_blindness' 		 => ($this->input->post('colour_blindness') == NULL) ? ('0') : ('1'),
				'cancer'	 			 => ($this->input->post('cancer') == NULL) ? ('0') : ('1'),
				'diabetes' 				 => ($this->input->post('diabetes') == NULL) ? ('0') : ('1'),
				'digestive_disorder' 	 => ($this->input->post('digestive_disorder') == NULL) ? ('0') : ('1'),
				'depresion' 			 => ($this->input->post('depresion') == NULL) ? ('0') : ('1'),
				'epilepsy' 				 => ($this->input->post('epilepsy') == NULL) ? ('0') : ('1'),
				'eye_vision_problem' 	 => ($this->input->post('eye_vision_problem') == NULL) ? ('0') : ('1'),
				'ear_problem'		 	 => ($this->input->post('ear_problem') == NULL) ? ('0') : ('1'),
				'fracture' 				 => ($this->input->post('fracture') == NULL) ? ('0') : ('1'),
				'genital_disorder' 		 => ($this->input->post('genital_disorder') == NULL) ? ('0') : ('1'),
				'heart_surgery' 		 => ($this->input->post('heart_surgery') == NULL) ? ('0') : ('1'),
				'heart_disease' 		 => ($this->input->post('heart_disease') == NULL) ? ('0') : ('1'),
				'high_blood_pressure' 	 => ($this->input->post('high_blood_pressure') == NULL) ? ('0') : ('1'),
				'hernia' 				 => ($this->input->post('hernia') == NULL) ? ('0') : ('1'),
				'infectious_disease' 	 => ($this->input->post('infectious_disease') == NULL) ? ('0') : ('1'),
				'kidney_problem' 		 => ($this->input->post('kidney_problem') == NULL) ? ('0') : ('1'),
				'lung_disease'	 		 => ($this->input->post('lung_disease') == NULL) ? ('0') : ('1'),
				'liver_problem' 		 => ($this->input->post('liver_problem') == NULL) ? ('0') : ('1'),
				'lost_of_memory'	 	 => ($this->input->post('lost_of_memory') == NULL) ? ('0') : ('1'),
				'narcotic_history' 		 => ($this->input->post('narcotic_history') == NULL) ? ('0') : ('1'),
				'neurogical_disease' 	 => ($this->input->post('neurogical_disease') == NULL) ? ('0') : ('1'),
				'operation_surgery' 	 => ($this->input->post('operation_surgery') == NULL) ? ('0') : ('1'),
				'psychiatric_problem' 	 => ($this->input->post('psychiatric_problem') == NULL) ? ('0') : ('1'),
				'restricted_mobility' 	 => ($this->input->post('restricted_mobility') == NULL) ? ('0') : ('1'),
				'skin_problem' 			 => ($this->input->post('skin_problem') == NULL) ? ('0') : ('1'),
				'sleep_problem' 		 => ($this->input->post('sleep_problem') == NULL) ? ('0') : ('1'),
				'thyroid_problem' 		 => ($this->input->post('thyroid_problem') == NULL) ? ('0') : ('1'),
				'tuberculosis' 			 => ($this->input->post('tuberculosis') == NULL) ? ('0') : ('1'),
				'height' 				 => $this->input->post('height'),
				'weight' 				 => $this->input->post('weight'),
				'blood_pressure' 		 => $this->input->post('blood_pressure'),
				'pulse_regular' 		 => $this->input->post('pulse_regular'),
				'respiratory_rate' 		 => $this->input->post('respiratory_rate'),
				'right_eye_without' 	 => $this->input->post('right_eye_without'),
				'left_eye_without' 		 => $this->input->post('left_eye_without'),
				'both_eye_without' 		 => $this->input->post('both_eye_without'),
				'right_eye_with' 		 => $this->input->post('right_eye_with'),
				'left_eye_with' 		 => $this->input->post('left_eye_with'),
				'both_eye_with' 		 => $this->input->post('both_eye_with'),
				'color_vision' 			 => $this->input->post('color_vision'),
				'general_appearance' 	 => $this->input->post('general_appearance'),
				'eyes' 					 => ($this->input->post('eyes') == NULL) ? ('0') : ('1'),
				'ears' 					 => ($this->input->post('ears') == NULL) ? ('0') : ('1'),
				'nose' 					 => ($this->input->post('nose') == NULL) ? ('0') : ('1'),
				'mouth' 				 => ($this->input->post('mouth') == NULL) ? ('0') : ('1'),
				'throat' 				 => ($this->input->post('throat') == NULL) ? ('0') : ('1'),
				'neck' 					 => ($this->input->post('neck') == NULL) ? ('0') : ('1'),
				'throid'	 			 => ($this->input->post('throid') == NULL) ? ('0') : ('1'),
				'lymp_node' 			 => ($this->input->post('lymp_node') == NULL) ? ('0') : ('1'),
				'lungs'		 			 => ($this->input->post('lungs') == NULL) ? ('0') : ('1'),
				'hearts' 				 => ($this->input->post('hearts') == NULL) ? ('0') : ('1'),
				'abdomen' 				 => ($this->input->post('abdomen') == NULL) ? ('0') : ('1'),
				'urogenital_system' 	 => ($this->input->post('urogenital_system') == NULL) ? ('0') : ('1'),
				'upper_extremities' 	 => ($this->input->post('upper_extremities') == NULL) ? ('0') : ('1'),
				'lower_extremities' 	 => ($this->input->post('lower_extremities') == NULL) ? ('0') : ('1'),
				'back_abnormality' 		 => ($this->input->post('back_abnormality') == NULL) ? ('0') : ('1'),
				'hernia_2' 				 => ($this->input->post('hernia_2') == NULL) ? ('0') : ('1'),
				'central_nervous_system' => ($this->input->post('central_nervous_system') == NULL) ? ('0') : ('1'),
				'skin_nails' 			 => ($this->input->post('skin_nails') == NULL) ? ('0') : ('1'),
				'speech' 				 => ($this->input->post('speech') == NULL) ? ('0') : ('1'),
				'other'	 				 => ($this->input->post('other') == NULL) ? ('0') : ('1'),
				'right_ear' 			 => $this->input->post('right_ear'),
				'left_ear' 				 => $this->input->post('left_ear'),
				'details'	 			 => $this->input->post('details')
			];

			$this->mcu->update_table_mcus_v1($medical_record_number, $data_mcus_v1);
			$this->mcu->store_to_table_mcus_v2($data_mcus_v2);

			$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Insert MCU Result successfully!',showConfirmButton: false,timer: 1500})</script>");

			redirect('mcu');
		}
	}

	public function formEditUmumRevMcu($id, $medical_record_number)
	{
		if (!$this->session->has_userdata('logged_in')) {
			redirect('auth');
		} else {
			$data = [
				'title'   => 'MCU',
				'data' 	  => $this->mcu->get_data_mcu_by_medical_record_number($medical_record_number),
				'clinics' => $this->clinic->get_list_of_clinic()
			];

			$this->load->view('templates/header', $data);
			$this->load->view('templates/navbar');
			$this->load->view('templates/sidebar');
			$this->load->view('mcus/form_edit_rev_mcu');
			$this->load->view('templates/footer');
		}
	}

	public function editUmumRevMcuProcess()
	{
		if (!$this->session->has_userdata('logged_in')) {
			redirect('auth');
		} else {
			$medical_record_number = $this->input->post('medical_record_number');

			$data_mcus_v1 = [
				'id_clinic'		   => $this->input->post('id_clinic'),
				'date_examination' => $this->input->post('date_examination'),
				'updated_at'	   => date('Y-m-d H:i:s')
			];

			$data_transactions = [
				'id_clinic' => $this->input->post('id_clinic')
			];

			$this->mcu->update_table_mcus_v1($medical_record_number, $data_mcus_v1);
			$this->mcu->update_table_transactions($medical_record_number, $data_transactions);

			$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Edit MCU Result successfully!',showConfirmButton: false,timer: 1500})</script>");

			redirect('mcu');
		}
	}

	public function formEditRevWithResult($id, $medical_record_number)
	{
		if (!$this->session->has_userdata('logged_in')) {
			redirect('auth');
		} else {
			$lab = $this->mcu->get_data_mcu_by_medical_record_number($medical_record_number);

			if ($lab['eyes'] == '1' && $lab['ears'] == '1' && $lab['nose'] == '1' && $lab['mouth'] == '1' && $lab['throat'] == '1' && $lab['neck'] == '1' && $lab['throid'] == '1' && $lab['lymp_node'] == '1' && $lab['lungs'] == '1' && $lab['hearts'] == '1' && $lab['abdomen'] == '1' && $lab['urogenital_system'] == '1' && $lab['upper_extremities'] == '1' && $lab['lower_extremities'] == '1' && $lab['back_abnormality'] == '1' && $lab['hernia_2'] == '1' && $lab['central_nervous_system'] == '1' && $lab['skin_nails'] == '1' && $lab['speech'] == '1' && $lab['other'] == '1') {
				$is_all_examine = 1;
			} else {
				$is_all_examine = 0;
			}

			$data = [
				'title'  		 => 'MCU',
				'data' 	 		 => $lab,
				'is_all_examine' => $is_all_examine,
				'clinics'		 => $this->clinic->get_list_of_clinic()
			];

			$this->load->view('templates/header', $data);
			$this->load->view('templates/navbar');
			$this->load->view('templates/sidebar');
			$this->load->view('mcus/form_edit_rev_with_result');
			$this->load->view('templates/footer');
		}
	}

	public function editRevProcess()
	{
		if (!$this->session->has_userdata('logged_in')) {
			redirect('auth');
		} else {
			$medical_record_number = $this->input->post('medical_record_number');

			$data_mcus_v1 = [
				'mcu_manual' 	   => $this->input->post('mcu_manual'),
				'id_clinic' 	   => $this->input->post('id_clinic'),
				'is_fit'		   => $this->input->post('is_fit'),
				'date_examination' => $this->input->post('date_examination'),
				'validity_period'  => ($this->input->post('validity_period') == NULL) ? ('0') : ('1'),
				'updated_at' 	   => date('Y-m-d H:i:s')
			];

			$data_mcus_v2 = [
				'alcohol_history' 		 => ($this->input->post('alcohol_history') == NULL) ? ('0') : ('1'),
				'allergic_history'		 => ($this->input->post('allergic_history') == NULL) ? ('0') : ('1'),
				'amputation' 			 => ($this->input->post('amputation') == NULL) ? ('0') : ('1'),
				'blood_disorder'		 => ($this->input->post('blood_disorder') == NULL) ? ('0') : ('1'),
				'balance_problem' 		 => ($this->input->post('balance_problem') == NULL) ? ('0') : ('1'),
				'back_or_joint_problem'  => ($this->input->post('back_or_joint_problem') == NULL) ? ('0') : ('1'),
				'colour_blindness' 		 => ($this->input->post('colour_blindness') == NULL) ? ('0') : ('1'),
				'cancer'	 			 => ($this->input->post('cancer') == NULL) ? ('0') : ('1'),
				'diabetes' 				 => ($this->input->post('diabetes') == NULL) ? ('0') : ('1'),
				'digestive_disorder' 	 => ($this->input->post('digestive_disorder') == NULL) ? ('0') : ('1'),
				'depresion' 			 => ($this->input->post('depresion') == NULL) ? ('0') : ('1'),
				'epilepsy' 				 => ($this->input->post('epilepsy') == NULL) ? ('0') : ('1'),
				'eye_vision_problem' 	 => ($this->input->post('eye_vision_problem') == NULL) ? ('0') : ('1'),
				'ear_problem'		 	 => ($this->input->post('ear_problem') == NULL) ? ('0') : ('1'),
				'fracture' 				 => ($this->input->post('fracture') == NULL) ? ('0') : ('1'),
				'genital_disorder' 		 => ($this->input->post('genital_disorder') == NULL) ? ('0') : ('1'),
				'heart_surgery' 		 => ($this->input->post('heart_surgery') == NULL) ? ('0') : ('1'),
				'heart_disease' 		 => ($this->input->post('heart_disease') == NULL) ? ('0') : ('1'),
				'high_blood_pressure' 	 => ($this->input->post('high_blood_pressure') == NULL) ? ('0') : ('1'),
				'hernia' 				 => ($this->input->post('hernia') == NULL) ? ('0') : ('1'),
				'infectious_disease' 	 => ($this->input->post('infectious_disease') == NULL) ? ('0') : ('1'),
				'kidney_problem' 		 => ($this->input->post('kidney_problem') == NULL) ? ('0') : ('1'),
				'lung_disease'	 		 => ($this->input->post('lung_disease') == NULL) ? ('0') : ('1'),
				'liver_problem' 		 => ($this->input->post('liver_problem') == NULL) ? ('0') : ('1'),
				'lost_of_memory'	 	 => ($this->input->post('lost_of_memory') == NULL) ? ('0') : ('1'),
				'narcotic_history' 		 => ($this->input->post('narcotic_history') == NULL) ? ('0') : ('1'),
				'neurogical_disease' 	 => ($this->input->post('neurogical_disease') == NULL) ? ('0') : ('1'),
				'operation_surgery' 	 => ($this->input->post('operation_surgery') == NULL) ? ('0') : ('1'),
				'psychiatric_problem' 	 => ($this->input->post('psychiatric_problem') == NULL) ? ('0') : ('1'),
				'restricted_mobility' 	 => ($this->input->post('restricted_mobility') == NULL) ? ('0') : ('1'),
				'skin_problem' 			 => ($this->input->post('skin_problem') == NULL) ? ('0') : ('1'),
				'sleep_problem' 		 => ($this->input->post('sleep_problem') == NULL) ? ('0') : ('1'),
				'thyroid_problem' 		 => ($this->input->post('thyroid_problem') == NULL) ? ('0') : ('1'),
				'tuberculosis' 			 => ($this->input->post('tuberculosis') == NULL) ? ('0') : ('1'),
				'height' 				 => $this->input->post('height'),
				'weight' 				 => $this->input->post('weight'),
				'blood_pressure' 		 => $this->input->post('blood_pressure'),
				'pulse_regular' 		 => $this->input->post('pulse_regular'),
				'respiratory_rate' 		 => $this->input->post('respiratory_rate'),
				'right_eye_without' 	 => $this->input->post('right_eye_without'),
				'left_eye_without' 		 => $this->input->post('left_eye_without'),
				'both_eye_without' 		 => $this->input->post('both_eye_without'),
				'right_eye_with' 		 => $this->input->post('right_eye_with'),
				'left_eye_with' 		 => $this->input->post('left_eye_with'),
				'both_eye_with' 		 => $this->input->post('both_eye_with'),
				'color_vision' 			 => $this->input->post('color_vision'),
				'general_appearance' 	 => $this->input->post('general_appearance'),
				'eyes' 					 => ($this->input->post('eyes') == NULL) ? ('0') : ('1'),
				'ears' 					 => ($this->input->post('ears') == NULL) ? ('0') : ('1'),
				'nose' 					 => ($this->input->post('nose') == NULL) ? ('0') : ('1'),
				'mouth' 				 => ($this->input->post('mouth') == NULL) ? ('0') : ('1'),
				'throat' 				 => ($this->input->post('throat') == NULL) ? ('0') : ('1'),
				'neck' 					 => ($this->input->post('neck') == NULL) ? ('0') : ('1'),
				'throid'	 			 => ($this->input->post('throid') == NULL) ? ('0') : ('1'),
				'lymp_node' 			 => ($this->input->post('lymp_node') == NULL) ? ('0') : ('1'),
				'lungs'		 			 => ($this->input->post('lungs') == NULL) ? ('0') : ('1'),
				'hearts' 				 => ($this->input->post('hearts') == NULL) ? ('0') : ('1'),
				'abdomen' 				 => ($this->input->post('abdomen') == NULL) ? ('0') : ('1'),
				'urogenital_system' 	 => ($this->input->post('urogenital_system') == NULL) ? ('0') : ('1'),
				'upper_extremities' 	 => ($this->input->post('upper_extremities') == NULL) ? ('0') : ('1'),
				'lower_extremities' 	 => ($this->input->post('lower_extremities') == NULL) ? ('0') : ('1'),
				'back_abnormality' 		 => ($this->input->post('back_abnormality') == NULL) ? ('0') : ('1'),
				'hernia_2' 				 => ($this->input->post('hernia_2') == NULL) ? ('0') : ('1'),
				'central_nervous_system' => ($this->input->post('central_nervous_system') == NULL) ? ('0') : ('1'),
				'skin_nails' 			 => ($this->input->post('skin_nails') == NULL) ? ('0') : ('1'),
				'speech' 				 => ($this->input->post('speech') == NULL) ? ('0') : ('1'),
				'other'	 				 => ($this->input->post('other') == NULL) ? ('0') : ('1'),
				'right_ear' 			 => $this->input->post('right_ear'),
				'left_ear' 				 => $this->input->post('left_ear'),
				'details'	 			 => $this->input->post('details')
			];

			$data_transactions = [
				'id_clinic' => $this->input->post('id_clinic')
			];

			$this->mcu->update_table_mcus_v1($medical_record_number, $data_mcus_v1);
			$this->mcu->update_table_mcus_v2($medical_record_number, $data_mcus_v2);
			$this->mcu->update_table_transactions($medical_record_number, $data_transactions);

			$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Edit Revalidation Result successfully!',showConfirmButton: false,timer: 1500})</script>");

			redirect('mcu');
		}
	}

	public function formEditMcuWithResult($id, $medical_record_number)
	{
		if (!$this->session->has_userdata('logged_in')) {
			redirect('auth');
		} else {
			$lab = $this->mcu->get_data_mcu_by_medical_record_number($medical_record_number);

			if ($lab['eyes'] == '1' && $lab['ears'] == '1' && $lab['nose'] == '1' && $lab['mouth'] == '1' && $lab['throat'] == '1' && $lab['neck'] == '1' && $lab['throid'] == '1' && $lab['lymp_node'] == '1' && $lab['lungs'] == '1' && $lab['hearts'] == '1' && $lab['abdomen'] == '1' && $lab['urogenital_system'] == '1' && $lab['upper_extremities'] == '1' && $lab['lower_extremities'] == '1' && $lab['back_abnormality'] == '1' && $lab['hernia_2'] == '1' && $lab['central_nervous_system'] == '1' && $lab['skin_nails'] == '1' && $lab['speech'] == '1' && $lab['other'] == '1') {
				$is_all_examine = 1;
			} else {
				$is_all_examine = 0;
			}

			$data = [
				'title'  		 => 'MCU',
				'data' 	 		 => $lab,
				'is_all_examine' => $is_all_examine,
				'clinics' => $this->clinic->get_list_of_clinic()
			];

			$this->load->view('templates/header', $data);
			$this->load->view('templates/navbar');
			$this->load->view('templates/sidebar');
			$this->load->view('mcus/form_edit_mcu_with_result');
			$this->load->view('templates/footer');
		}
	}

	public function editMcuProcess()
	{
		if (!$this->session->has_userdata('logged_in')) {
			redirect('auth');
		} else {
			$medical_record_number = $this->input->post('medical_record_number');

			$data_mcus_v1 = [
				'mcu_manual' 	   => $this->input->post('mcu_manual'),
				'id_clinic' 	   => $this->input->post('id_clinic'),
				'is_fit'		   => $this->input->post('is_fit'),
				'date_examination' => $this->input->post('date_examination'),
				'validity_period'  => ($this->input->post('validity_period') == NULL) ? ('0') : ('1'),
				'updated_at' 	   => date('Y-m-d H:i:s')
			];

			$data_mcus_v2 = [
				'alcohol_history' 		 => ($this->input->post('alcohol_history') == NULL) ? ('0') : ('1'),
				'allergic_history'		 => ($this->input->post('allergic_history') == NULL) ? ('0') : ('1'),
				'amputation' 			 => ($this->input->post('amputation') == NULL) ? ('0') : ('1'),
				'blood_disorder'		 => ($this->input->post('blood_disorder') == NULL) ? ('0') : ('1'),
				'balance_problem' 		 => ($this->input->post('balance_problem') == NULL) ? ('0') : ('1'),
				'back_or_joint_problem'  => ($this->input->post('back_or_joint_problem') == NULL) ? ('0') : ('1'),
				'colour_blindness' 		 => ($this->input->post('colour_blindness') == NULL) ? ('0') : ('1'),
				'cancer'	 			 => ($this->input->post('cancer') == NULL) ? ('0') : ('1'),
				'diabetes' 				 => ($this->input->post('diabetes') == NULL) ? ('0') : ('1'),
				'digestive_disorder' 	 => ($this->input->post('digestive_disorder') == NULL) ? ('0') : ('1'),
				'depresion' 			 => ($this->input->post('depresion') == NULL) ? ('0') : ('1'),
				'epilepsy' 				 => ($this->input->post('epilepsy') == NULL) ? ('0') : ('1'),
				'eye_vision_problem' 	 => ($this->input->post('eye_vision_problem') == NULL) ? ('0') : ('1'),
				'ear_problem'		 	 => ($this->input->post('ear_problem') == NULL) ? ('0') : ('1'),
				'fracture' 				 => ($this->input->post('fracture') == NULL) ? ('0') : ('1'),
				'genital_disorder' 		 => ($this->input->post('genital_disorder') == NULL) ? ('0') : ('1'),
				'heart_surgery' 		 => ($this->input->post('heart_surgery') == NULL) ? ('0') : ('1'),
				'heart_disease' 		 => ($this->input->post('heart_disease') == NULL) ? ('0') : ('1'),
				'high_blood_pressure' 	 => ($this->input->post('high_blood_pressure') == NULL) ? ('0') : ('1'),
				'hernia' 				 => ($this->input->post('hernia') == NULL) ? ('0') : ('1'),
				'infectious_disease' 	 => ($this->input->post('infectious_disease') == NULL) ? ('0') : ('1'),
				'kidney_problem' 		 => ($this->input->post('kidney_problem') == NULL) ? ('0') : ('1'),
				'lung_disease'	 		 => ($this->input->post('lung_disease') == NULL) ? ('0') : ('1'),
				'liver_problem' 		 => ($this->input->post('liver_problem') == NULL) ? ('0') : ('1'),
				'lost_of_memory'	 	 => ($this->input->post('lost_of_memory') == NULL) ? ('0') : ('1'),
				'narcotic_history' 		 => ($this->input->post('narcotic_history') == NULL) ? ('0') : ('1'),
				'neurogical_disease' 	 => ($this->input->post('neurogical_disease') == NULL) ? ('0') : ('1'),
				'operation_surgery' 	 => ($this->input->post('operation_surgery') == NULL) ? ('0') : ('1'),
				'psychiatric_problem' 	 => ($this->input->post('psychiatric_problem') == NULL) ? ('0') : ('1'),
				'restricted_mobility' 	 => ($this->input->post('restricted_mobility') == NULL) ? ('0') : ('1'),
				'skin_problem' 			 => ($this->input->post('skin_problem') == NULL) ? ('0') : ('1'),
				'sleep_problem' 		 => ($this->input->post('sleep_problem') == NULL) ? ('0') : ('1'),
				'thyroid_problem' 		 => ($this->input->post('thyroid_problem') == NULL) ? ('0') : ('1'),
				'tuberculosis' 			 => ($this->input->post('tuberculosis') == NULL) ? ('0') : ('1'),
				'height' 				 => $this->input->post('height'),
				'weight' 				 => $this->input->post('weight'),
				'blood_pressure' 		 => $this->input->post('blood_pressure'),
				'pulse_regular' 		 => $this->input->post('pulse_regular'),
				'respiratory_rate' 		 => $this->input->post('respiratory_rate'),
				'right_eye_without' 	 => $this->input->post('right_eye_without'),
				'left_eye_without' 		 => $this->input->post('left_eye_without'),
				'both_eye_without' 		 => $this->input->post('both_eye_without'),
				'right_eye_with' 		 => $this->input->post('right_eye_with'),
				'left_eye_with' 		 => $this->input->post('left_eye_with'),
				'both_eye_with' 		 => $this->input->post('both_eye_with'),
				'color_vision' 			 => $this->input->post('color_vision'),
				'general_appearance' 	 => $this->input->post('general_appearance'),
				'eyes' 					 => ($this->input->post('eyes') == NULL) ? ('0') : ('1'),
				'ears' 					 => ($this->input->post('ears') == NULL) ? ('0') : ('1'),
				'nose' 					 => ($this->input->post('nose') == NULL) ? ('0') : ('1'),
				'mouth' 				 => ($this->input->post('mouth') == NULL) ? ('0') : ('1'),
				'throat' 				 => ($this->input->post('throat') == NULL) ? ('0') : ('1'),
				'neck' 					 => ($this->input->post('neck') == NULL) ? ('0') : ('1'),
				'throid'	 			 => ($this->input->post('throid') == NULL) ? ('0') : ('1'),
				'lymp_node' 			 => ($this->input->post('lymp_node') == NULL) ? ('0') : ('1'),
				'lungs'		 			 => ($this->input->post('lungs') == NULL) ? ('0') : ('1'),
				'hearts' 				 => ($this->input->post('hearts') == NULL) ? ('0') : ('1'),
				'abdomen' 				 => ($this->input->post('abdomen') == NULL) ? ('0') : ('1'),
				'urogenital_system' 	 => ($this->input->post('urogenital_system') == NULL) ? ('0') : ('1'),
				'upper_extremities' 	 => ($this->input->post('upper_extremities') == NULL) ? ('0') : ('1'),
				'lower_extremities' 	 => ($this->input->post('lower_extremities') == NULL) ? ('0') : ('1'),
				'back_abnormality' 		 => ($this->input->post('back_abnormality') == NULL) ? ('0') : ('1'),
				'hernia_2' 				 => ($this->input->post('hernia_2') == NULL) ? ('0') : ('1'),
				'central_nervous_system' => ($this->input->post('central_nervous_system') == NULL) ? ('0') : ('1'),
				'skin_nails' 			 => ($this->input->post('skin_nails') == NULL) ? ('0') : ('1'),
				'speech' 				 => ($this->input->post('speech') == NULL) ? ('0') : ('1'),
				'other'	 				 => ($this->input->post('other') == NULL) ? ('0') : ('1'),
				'right_ear' 			 => $this->input->post('right_ear'),
				'left_ear' 				 => $this->input->post('left_ear'),
				'details'	 			 => $this->input->post('details')
			];

			$data_transactions = [
				'id_clinic' => $this->input->post('id_clinic')
			];

			$this->mcu->update_table_mcus_v1($medical_record_number, $data_mcus_v1);
			$this->mcu->update_table_mcus_v2($medical_record_number, $data_mcus_v2);
			$this->mcu->update_table_transactions($medical_record_number, $data_transactions);

			$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Edit MCU Result successfully!',showConfirmButton: false,timer: 1500})</script>");

			redirect('mcu');
		}
	}

	public function downloadQRCodePng($medical_record_number)
	{
		$file_name = $medical_record_number . '.png';
		$file_path = './assets/images/qrcode/' . $medical_record_number . '.png';
		force_download($file_name, file_get_contents($file_path));
	}

	public function previewRevResultPdf($medical_record_number)
	{
		$data = $this->mcu->get_data_mcu_by_medical_record_number($medical_record_number);

		$mpdf = new \Mpdf\Mpdf([
			'mode' 					=> 'utf-8',
			'format' 				=> [297, 210],
			'orientation' 			=> 'L',
			'margin_left'			=> 0,
			'margin_right' 			=> 0,
			'margin_top'			=> 38,
			'margin_bottom' 		=> 0,
			'margin_header' 		=> 0,
			'margin_footer' 		=> 0,
			'collapseBlockMargins' 	=> false,
		]);

		$view = $this->load->view('mcus/preview_rev_result_pdf', ['data' => $data], TRUE);
		
		$mpdf->WriteHTML($view);

		$filename = date('dm', strtotime($data['date_examination'])) . '_' . $data['name_patient'] . '.pdf';
		$mpdf->Output($filename, \Mpdf\Output\Destination::INLINE);
	}

	public function previewMcuResultPdf($medical_record_number)
	{
		$data = $this->mcu->get_data_mcu_by_medical_record_number($medical_record_number);

		$mpdf = new \Mpdf\Mpdf([
			'mode' 					=> 'utf-8',
			'format' 				=> [297, 210],
			'orientation' 			=> 'L',
			'margin_left'			=> 0,
			'margin_right' 			=> 0,
			'margin_top'			=> 32,
			'margin_bottom' 		=> 0,
			'margin_header' 		=> 0,
			'margin_footer' 		=> 0,
			'collapseBlockMargins' 	=> false,
		]);

		$view = $this->load->view('mcus/preview_mcu_result_pdf', ['data' => $data], TRUE);
		$view_2 = $this->load->view('mcus/preview_mcu_result_pdf_2', ['data' => $data], TRUE);
		// $view_3 = $this->load->view('mcus/preview_mcu_result_pdf_3', ['data' => $data], TRUE);
		// $view_4 = $this->load->view('mcus/preview_mcu_result_pdf_4', ['data' => $data], TRUE);

		$mpdf->WriteHTML($view);
		$mpdf->AddPage();
		$mpdf->WriteHTML($view_2);
		// $mpdf->AddPage();
		// $mpdf->WriteHTML($view_3);
		// $mpdf->AddPage();
		// $mpdf->WriteHTML($view_4);

		$filename = date('dm', strtotime($data['date_examination'])) . '_' . $data['name_patient'] . '.pdf';
		$mpdf->Output($filename, \Mpdf\Output\Destination::INLINE);
	}
	
	public function downloadRevResultPdf($medical_record_number)
	{
		$data = $this->mcu->get_data_mcu_by_medical_record_number($medical_record_number);

		$mpdf = new \Mpdf\Mpdf([
			'mode' 					=> 'utf-8',
			'format' 				=> [297, 210],
			'orientation' 			=> 'L',
			'margin_left'			=> 0,
			'margin_right' 			=> 0,
			'margin_top'			=> 30,
			'margin_bottom' 		=> 0,
			'margin_header' 		=> 0,
			'margin_footer' 		=> 0,
			'collapseBlockMargins' 	=> false,
		]);

		$view = $this->load->view('mcus/download_rev_result_pdf', ['data' => $data], TRUE);

		$mpdf->WriteHTML($view);

		$filename = date('dm', strtotime($data['date_examination'])) . '_' . $data['name_patient'] . '.pdf';
		$mpdf->Output($filename, \Mpdf\Output\Destination::DOWNLOAD);
	}

	public function downloadMcuResultPdf($medical_record_number)
	{
		$data = $this->mcu->get_data_mcu_by_medical_record_number($medical_record_number);

		$mpdf = new \Mpdf\Mpdf([
			'mode' 					=> 'utf-8',
			'format' 				=> [297, 210],
			'orientation' 			=> 'L',
			'margin_left'			=> 0,
			'margin_right' 			=> 0,
			'margin_top'			=> 32,
			'margin_bottom' 		=> 0,
			'margin_header' 		=> 0,
			'margin_footer' 		=> 0,
			'collapseBlockMargins' 	=> false,
		]);

		$view = $this->load->view('mcus/download_mcu_result_pdf', ['data' => $data], TRUE);
		$view_2 = $this->load->view('mcus/download_mcu_result_pdf_2', ['data' => $data], TRUE);
		// $view_3 = $this->load->view('mcus/download_mcu_result_pdf_3', ['data' => $data], TRUE);
		// $view_4 = $this->load->view('mcus/download_mcu_result_pdf_4', ['data' => $data], TRUE);

		$mpdf->WriteHTML($view);
		$mpdf->AddPage();
		$mpdf->WriteHTML($view_2);
		// $mpdf->AddPage();
		// $mpdf->WriteHTML($view_3);
		// $mpdf->AddPage();
		// $mpdf->WriteHTML($view_4);

		$filename = date('dm', strtotime($data['date_examination'])) . '_' . $data['name_patient'] . '.pdf';
		$mpdf->Output($filename, \Mpdf\Output\Destination::DOWNLOAD);
	}

	public function mcuResultPreview($medical_record_number)
	{
		$data = [
			'data' => $this->mcu->get_data_mcu_by_medical_record_number($medical_record_number)
		];

		$this->load->view('mcus/mcu_result_preview', $data);
	}

}
