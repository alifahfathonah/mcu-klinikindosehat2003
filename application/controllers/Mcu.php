<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class Mcu extends CI_Controller
{
	/**
	 * Constructor for this controller
	 */
	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");
		
		$this->load->model('Mcu_model', 'mcu');
		$this->load->model('Clinic_model', 'clinic');
		$this->load->model('Patient_model', 'patient');

		$this->session->unset_userdata('filterByDataCompany');
		$this->session->unset_userdata('filterByDataPatient');
		$this->session->unset_userdata('filterByCompany');
		$this->session->unset_userdata('filterByDataPatientCheck');
		$this->session->unset_userdata('filterByDataTransaction');
		$this->session->unset_userdata('filterByType');
		$this->session->unset_userdata('filterBySiteTransaction');
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		if (!$this->session->has_userdata('logged_in')) {
			redirect('auth');
		} else {
			if ($this->input->post('filter')) {
				$filterByData = $this->input->post('filter-by-data');
				$filterByStatus = $this->input->post('filter-by-status');
				$filterByStartDate = $this->input->post('filter-by-start-date');
				$filterByEndDate = $this->input->post('filter-by-end-date');
				$filterBySite = $this->input->post('filter-by-site');
				
				$this->session->set_userdata('filterByData', $filterByData);
				$this->session->set_userdata('filterByStatus', $filterByStatus);
				$this->session->set_userdata('filterByStartDate', $filterByStartDate);
				$this->session->set_userdata('filterByEndDate', $filterByEndDate);
				$this->session->set_userdata('filterBySite', $filterBySite);
			} else {
				$filterByData = $this->session->userdata('filterByData');
				$filterByStatus = $this->session->userdata('filterByStatus');
				$filterByStartDate = $this->session->userdata('filterByStartDate');
				$filterByEndDate = $this->session->userdata('filterByEndDate');
				$filterBySite = $this->session->userdata('filterBySite');
			}

			// Pagination 

			// load
			$this->load->library('pagination');
			// config
			$config['base_url']   = base_url('mcu/index');
			$config['total_rows'] = $this->mcu->get_total_data_mcu($filterByData, $filterByStatus, $filterByStartDate, $filterByEndDate, $filterBySite);
			$config['per_page']   = 15;
			// style
			$config['full_tag_open'] = '<nav><ul class="pagination justify-content-end">';
			$config['full_tag_close'] = '</ul></nav>';
			
			$config['first_link'] = 'First';
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			
			$config['last_link'] = 'Last';
			$config['last_tag_open'] = '<li class="page-item">';
			$config['last_tag_close'] = '</li>';

			$config['next_link'] = '&raquo';
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';

			$config['prev_link'] = '&laquo';
			$config['prev_tag_open'] = '<li class="page-item">';
			$config['prev_tag_close'] = '</li>';

			$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
			$config['cur_tag_close'] = '</a></li>';

			$config['num_tag_open'] = '<li class="page-item">';
			$config['num_tag_close'] = '</li>';

			$config['attributes'] = ['class' => 'page-link'];
			// initialize
			$this->pagination->initialize($config);

			$start_data = $this->uri->segment(3);

			$data = [
				'title'   	 => 'Hasil Lab',
				'clinics'    => $this->clinic->get_list_of_clinic(),
				'total_data' => $config['total_rows'],
				'mcus'	  	 => $this->mcu->get_data_mcu($config['per_page'], $start_data, $filterByData, $filterByStatus, $filterByStartDate, $filterByEndDate, $filterBySite)
			];

			$this->load->view('templates/header', $data);
			$this->load->view('templates/navbar');
			$this->load->view('mcus/index');
			$this->load->view('templates/footer');
		}
	}

	/**
	 * Page input laboratory result - Revalidation
	 */
	public function formInputRevResult($id, $medical_record_number)
	{
		if (!$this->session->has_userdata('logged_in')) {
			redirect('auth');
		} else {
			$data = [
				'title'    => 'Hasil Lab',
				'subtitle' => 'Input Hasil Lab - Revalidasi',
				'data'     => $this->mcu->get_data_mcu_by_medical_record_number($medical_record_number)
			];

			$this->load->view('templates/header', $data);
			$this->load->view('templates/navbar');
			$this->load->view('mcus/form_input_rev_result');
			$this->load->view('templates/footer');
		}
	}

	/**
	 * Input process laboratory result - Revalidation
	 */
	public function inputRevResultProcess()
	{
		if (!$this->session->has_userdata('logged_in')) {
			redirect('auth');
		} else {
			$medical_record_number = $this->input->post('medical_record_number');

			$data_patients = [
				'address' 	 => $this->input->post('address'),
				'updated_at' => date('Y-m-d H:i:s')
			];

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
				'smoking' 			 	 => ($this->input->post('smoking') == NULL) ? ('0') : ('1'),
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

			$this->patient->update_table_patients($this->input->post('id_patient'), $data_patients);
			$this->mcu->update_table_mcus_v1($medical_record_number, $data_mcus_v1);
			$this->mcu->store_to_table_mcus_v2($data_mcus_v2);

			$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Insert Revalidation result successfully!',showConfirmButton: false,timer: 1500})</script>");

			redirect('mcu');
		}
	}

	/**
	 * Page input laboratory result - Medical Check Up
	 */
	public function formInputMcuResult($id, $medical_record_number)
	{
		if (!$this->session->has_userdata('logged_in')) {
			redirect('auth');
		} else {
			$data = [
				'title'    => 'Hasil Lab',
				'subtitle' => 'Input Hasil Lab - Medical Check Up',
				'data'     => $this->mcu->get_data_mcu_by_medical_record_number($medical_record_number)
			];

			$this->load->view('templates/header', $data);
			$this->load->view('templates/navbar');
			$this->load->view('mcus/form_input_mcu_result');
			$this->load->view('templates/footer');
		}
	}

	/**
	 * Input process laboratory result - Medical Check Up
	 */
	public function inputMcuResultProcess()
	{
		if (!$this->session->has_userdata('logged_in')) {
			redirect('auth');
		} else {
			$medical_record_number = $this->input->post('medical_record_number');

			$data_patients = [
				'address' 	 => $this->input->post('address'),
				'updated_at' => date('Y-m-d H:i:s')
			];

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
				'smoking' 			 	 => ($this->input->post('smoking') == NULL) ? ('0') : ('1'),
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

			$this->patient->update_table_patients($this->input->post('id_patient'), $data_patients);
			$this->mcu->update_table_mcus_v1($medical_record_number, $data_mcus_v1);
			$this->mcu->store_to_table_mcus_v2($data_mcus_v2);

			$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Insert Medical Check Up result successfully!',showConfirmButton: false,timer: 1500})</script>");

			redirect('mcu');
		}
	}

	/**
	 * Page edit without result
	 */
	public function formEditUmumRevMcu($id, $medical_record_number)
	{
		if (!$this->session->has_userdata('logged_in')) {
			redirect('auth');
		} else {
			$data = [
				'title'    => 'Hasil Lab',
				'subtitle' => 'Ubah Formulir Pendaftaran',
				'data' 	   => $this->mcu->get_data_mcu_by_medical_record_number($medical_record_number),
				'clinics'  => $this->clinic->get_list_of_clinic()
			];

			$this->load->view('templates/header', $data);
			$this->load->view('templates/navbar');
			$this->load->view('mcus/form_edit_rev_mcu');
			$this->load->view('templates/footer');
		}
	}

	/**
	 * Update process without result
	 */
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

			$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Edit form laboratory successfully!',showConfirmButton: false,timer: 1500})</script>");

			redirect('mcu');
		}
	}

	/**
	 * Page edit laboratory result - Revalidasi
	 */
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
				'title'  		 => 'Hasil Lab',
				'subtitle'		 => 'Ubah Data Hasil Lab - Revalidasi',
				'data' 	 		 => $lab,
				'is_all_examine' => $is_all_examine,
				'clinics'		 => $this->clinic->get_list_of_clinic()
			];

			$this->load->view('templates/header', $data);
			$this->load->view('templates/navbar');
			$this->load->view('mcus/form_edit_rev_with_result');
			$this->load->view('templates/footer');
		}
	}

	/**
	 * Update process laboratory result - Revalidasi
	 */
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
				'smoking' 			 	 => ($this->input->post('smoking') == NULL) ? ('0') : ('1'),
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

	/**
	 * Page edit laboratory result - Medical Check Up
	 */
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
				'title'  		 => 'Hasil Lab',
				'subtitle'		 => 'Ubah Data Hasil Lab - Medical Check Up',
				'data' 	 		 => $lab,
				'is_all_examine' => $is_all_examine,
				'clinics' 		 => $this->clinic->get_list_of_clinic()
			];

			$this->load->view('templates/header', $data);
			$this->load->view('templates/navbar');
			$this->load->view('mcus/form_edit_mcu_with_result');
			$this->load->view('templates/footer');
		}
	}

	/**
	 * Update process laboratory result - Medical Check Up
	 */
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
				'smoking' 			 	 => ($this->input->post('smoking') == NULL) ? ('0') : ('1'),
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

	/**
	 * Return image QR
	 */
	public function downloadQRCodePng($medical_record_number)
	{
		$file_name = $medical_record_number . '.png';
		$file_path = './assets/images/qrcode/' . $medical_record_number . '.png';
		force_download($file_name, file_get_contents($file_path));
	}

	/**
	 * View result laboratory result - Revalidasi
	 */
	public function previewRevResultPdf($medical_record_number)
	{
		$data = $this->mcu->get_data_mcu_by_medical_record_number($medical_record_number);

		$mpdf = new \Mpdf\Mpdf([
			'mode' 					=> 'utf-8',
			'format' 				=> [297, 210],
			'orientation' 			=> 'L',
			'margin_left'			=> 0,
			'margin_right' 			=> 0,
			'margin_top'			=> ($data['id_clinic'] == '3' || $data['id_clinic'] == '4') ? (30) : (37),
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

	/**
	 * View result laboratory result - Medical Check Up
	 */
	public function previewMcuResultPdf($medical_record_number)
	{
		$data = $this->mcu->get_data_mcu_by_medical_record_number($medical_record_number);

		$mpdf = new \Mpdf\Mpdf([
			'mode' 					=> 'utf-8',
			'format' 				=> [297, 210],
			'orientation' 			=> 'L',
			'margin_left'			=> 0,
			'margin_right' 			=> 0,
			'margin_top'			=> ($data['id_clinic'] == '3' || $data['id_clinic'] == '4') ? (25) : (32),
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
	
	/**
	 * Return Pdf file result laboratory result - Revalidasi
	 */
	public function downloadRevResultPdf($medical_record_number)
	{
		$data = $this->mcu->get_data_mcu_by_medical_record_number($medical_record_number);

		$mpdf = new \Mpdf\Mpdf([
			'mode' 					=> 'utf-8',
			'format' 				=> [297, 210],
			'orientation' 			=> 'L',
			'margin_left'			=> 0,
			'margin_right' 			=> 0,
			'margin_top'			=> 29,
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

	/**
	 * Return Pdf file result laboratory result - Medical Check Up
	 */
	public function downloadMcuResultPdf($medical_record_number)
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

	/**
	 * View of scan QR laboratory result
	 */
	public function mcuResultPreview($medical_record_number)
	{
		$data = [
			'data' => $this->mcu->get_data_mcu_by_medical_record_number($medical_record_number)
		];

		$this->load->view('mcus/mcu_result_preview', $data);
	}

	/**
	 * Return Excel file data of laboratory result
	 */
	public function downloadExcelReportMcu()
	{
		$id_clinic = $this->input->post('id_clinic');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');

		$title = "MCU Report " . $this->clinic->get_name_clinic_by_id($id_clinic); 
		$range_top_date = 'From : ' . date('d F Y', strtotime($start_date)) . ' To : ' . date('d F Y', strtotime($end_date));
		$total_data = $this->mcu->get_count_mcu_by_range_date_and_id_clinic($id_clinic, $start_date, $end_date);
		$data = $this->mcu->get_data_mcu_by_range_date_and_id_clinic($id_clinic, $start_date, $end_date);

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$sheet->getColumnDimension('A')->setAutoSize(true);
		$sheet->getColumnDimension('B')->setAutoSize(true);
		$sheet->getColumnDimension('C')->setAutoSize(true);
		$sheet->getColumnDimension('D')->setAutoSize(true);
		$sheet->getColumnDimension('E')->setAutoSize(true);
		$sheet->getColumnDimension('F')->setAutoSize(true);
		$sheet->getColumnDimension('G')->setAutoSize(true);

		$sheet->mergeCells('A1:G1');
		$sheet->setCellValue('A1', $title);
		$sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('A1')->getFont()->setBold('1');
		$sheet->getStyle('A1')->getFont()->setSize('16');

		$sheet->mergeCells('A2:G2');
		$sheet->setCellValue('A2', $range_top_date);
		$sheet->getStyle('A2')->getAlignment()->setHorizontal('center');


		$sheet->setCellValue('F4', 'Total MCU Test');
		$sheet->setCellValue('G4', $total_data);
		$sheet->getStyle('F4')->getFont()->setBold('1');
		$sheet->getStyle('G4')->getAlignment()->setHorizontal('left');

		$sheet->setCellValue('A6', 'No.');
		$sheet->setCellValue('B6', 'Medical Number Record');
		$sheet->setCellValue('C6', 'Name Patient');
		$sheet->setCellValue('D6', 'Examination Date');
		$sheet->setCellValue('E6', 'Company');
		$sheet->setCellValue('F6', 'Type Transaction');
		$sheet->setCellValue('G6', 'Total Price');
		$sheet->getStyle('A6')->getFont()->setBold('1');
		$sheet->getStyle('A6')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('B6')->getFont()->setBold('1');
		$sheet->getStyle('B6')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('C6')->getFont()->setBold('1');
		$sheet->getStyle('C6')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('D6')->getFont()->setBold('1');
		$sheet->getStyle('D6')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('E6')->getFont()->setBold('1');
		$sheet->getStyle('E6')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('F6')->getFont()->setBold('1');
		$sheet->getStyle('F6')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('G6')->getFont()->setBold('1');
		$sheet->getStyle('G6')->getAlignment()->setHorizontal('center');

		$column = 7;
		foreach($data as $index=>$d) {
			$spreadsheet->setActiveSheetIndex(0)
						->setCellValue('A' . $column, $index+1)
						->setCellValue('B' . $column, $d['mcu_manual'])
						->setCellValue('C' . $column, $d['name_patient'])
						->setCellValue('D' . $column, date('d F Y', strtotime($d['date_examination'])))
						->setCellValue('E' . $column, $d['company_name'])
						->setCellValue('F' . $column, strtoupper($d['type_transaction']))
						->setCellValue('G' . $column, number_format($d['total_price']))
						->getStyle('G')->getAlignment()->setHorizontal('right');
			$column++;
		}

		$writer = new Xlsx($spreadsheet);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="MCU Report - ' . date("d F Y [") . time() . "]" . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

}
