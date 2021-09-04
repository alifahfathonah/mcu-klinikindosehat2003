<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Patient extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('patient_model', 'patient');
		$this->load->model('company_model', 'company');
		$this->load->model('clinic_model', 'clinic');
		$this->load->model('mcu_model', 'mcu');
		if (!$this->session->has_userdata('logged_in')) {
			redirect('auth');
		}
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$data = [
			'title'   => 'Patient',
			'companies'	=> $this->company->get_datatables_company()
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
		$this->load->view('patients/index');
		$this->load->view('templates/footer');
	}

	public function registrationPatient()
	{
		$data = [
			'title'     => 'Patient',
			'companies'	=> $this->company->get_datatables_company(),
			'clinics' 	=> $this->clinic->get_list_of_clinic()
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
		$this->load->view('patients/registration_patient');
		$this->load->view('templates/footer');
	}

	public function checkingIdNumber()
	{
		$id_number = $this->input->post('id_number', true);
		
		if ( $this->patient->get_patient_exist( $id_number ) == 1 ) {
			
			$res = $this->patient->get_data_patient_by_id_number( $id_number );

			$result[] = [
				'id_number'    			=> $res['id_number'],
				'passport_number' 		=> $res['passport_number'],
				'name'   				=> $res['name'],
				'gender'         		=> $res['gender'],
				'place_of_birth'      	=> $res['place_of_birth'],
				'date_of_birth'      	=> $res['date_of_birth'],
				'address'       		=> $res['address'],
				'basic_safety_training' => $res['basic_safety_training'],
				'nationality'       	=> $res['nationality'],
				'id_company'       		=> $res['id_company'],
				'occupation'       		=> $res['occupation']
			];

		} else {
			$result[] = [
				'id_number' => $id_number,
				'address' => ""
			];
		}


		header('Content-Type: application/json');
		echo json_encode($result);
	}

	public function registrationPatientProcess()
	{
		date_default_timezone_set("Asia/Jakarta");

		$id_number_old 		 = $this->input->post('id_number_old', TRUE);
		$id_number 			 = $this->input->post('id_number', TRUE);
		$duplicate_id_number = $this->patient->get_patient_exist($id_number_old);

		if ($duplicate_id_number > 0) {
			/*
				Process if the patient already exist	
			*/

			$image    = $this->input->post('image');
			$image    = str_replace('data:image/jpeg;base64,', '', $image);
			$image    = base64_decode($image);
			$filename = 'image_' . $id_number . '_' . time() . '.jpg';

			$this->patient->filePut($filename, $image);

			// Get data patient exist
			$id_patient_exist = $this->patient->get_data_patient_by_id_number($id_number_old)['id'];

			$data_patient = [
				'id_number' 	  		=> $id_number,
				'passport_number' 		=> $this->input->post('passport_number', TRUE),
				'name'		 	  		=> strtoupper($this->input->post('name', TRUE)),
				'gender' 		  		=> $this->input->post('gender', TRUE),
				'place_of_birth'  		=> strtoupper($this->input->post('place_of_birth', TRUE)),
				'date_of_birth'   		=> $this->input->post('date_of_birth', TRUE),
				'address' 		  		=> $this->input->post('address', TRUE),
				'basic_safety_training'	=> $this->input->post('basic_safety_training', TRUE),
				'nationality' 	  		=> strtoupper($this->input->post('nationality', TRUE)),
				'id_company'	 	  	=> $this->input->post('id_company', TRUE),
				'occupation'	 	  	=> strtoupper($this->input->post('occupation', TRUE)),
				'updated_at'	  		=> date('Y-m-d H:i:s')
			];

			// Update data to table patients, mcus and transactions
			$this->patient->update_table_patients_mcus_transactions($id_patient_exist, $data_patient, $id_number, strtoupper($this->input->post('name', TRUE)));

			// Make new laboratory examination
			$type_examination = $this->input->post('type_examination', TRUE);

			$url_for_qrcode		   = base_url('mcu/mcuResultPreview/');
			$medical_record_number = $this->mcu->get_medical_record_number($type_examination);
			$no_transaction		   = $this->mcu->get_no_transaction($id_patient_exist, $type_examination);

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
				'mcu_manual'			=> $this->input->post('mcu_manual'),
				'id_clinic'				=> $this->input->post('id_clinic'),
				'id_patient'			=> $id_patient_exist,
				'id_number_patient'		=> $id_number,
				'name_patient'			=> strtoupper($this->input->post('name', TRUE)),
				'no_transaction'		=> $no_transaction,
				'type_examination'		=> $type_examination,
				'date_examination'		=> $this->input->post('date_examination'),
				'image'					=> $filename,
				'qrcode'				=> $image_name,
				'created_at'			=> date('Y-m-d H:i:s')
			];

			$data_transactions = [
				'no_transaction'		=> $no_transaction,
				'id_clinic'				=> $this->input->post('id_clinic'),
				'id_patient' 			=> $id_patient_exist,
				'id_company' 			=> $this->input->post('id_company', TRUE),
				'medical_record_number' => $medical_record_number,
				'patient_name' 			=> strtoupper($this->input->post('name', TRUE)),
				'patient_id_number' 	=> $id_number,
				'type_examination' 		=> $type_examination,
				'type_transaction'	 	=> $this->input->post('type_transaction'),
				'total_price' 			=> preg_replace("/[^0-9]/", "", $this->input->post('total_price'))
			];

			$this->mcu->store_to_table_mcus_v1($data_mcus_v1);
			$this->mcu->store_to_table_transactions($data_transactions);

			echo json_encode($id_patient_exist);
		} else {
			$image    = $this->input->post('image');
			$image    = str_replace('data:image/jpeg;base64,', '', $image);
			$image    = base64_decode($image);
			$filename = 'image_' . $id_number . '_' . time() . '.jpg';

			$this->patient->filePut($filename, $image);

			date_default_timezone_set("Asia/Jakarta");
			$data_patient = [
				'id_number' 	  		=> $id_number,
				'passport_number' 		=> $this->input->post('passport_number', TRUE),
				'name'		 	  		=> strtoupper($this->input->post('name', TRUE)),
				'gender' 		  		=> $this->input->post('gender', TRUE),
				'place_of_birth'  		=> strtoupper($this->input->post('place_of_birth', TRUE)),
				'date_of_birth'   		=> $this->input->post('date_of_birth', TRUE),
				'address' 		  		=> $this->input->post('address', TRUE),
				'basic_safety_training'	=> $this->input->post('basic_safety_training', TRUE),
				'nationality' 	  		=> strtoupper($this->input->post('nationality', TRUE)),
				'id_company'	 	  	=> $this->input->post('id_company', TRUE),
				'occupation'	 	  	=> strtoupper($this->input->post('occupation', TRUE)),
				'created_at'	  		=> date('Y-m-d H:i:s')
			];

			// Save data to table patients
			$id_patient = $this->patient->store_to_table_patients($data_patient);

			// Make new laboratory examination
			$type_examination = $this->input->post('type_examination', TRUE);

			$url_for_qrcode		   = base_url('mcu/mcuResultPreview/');
			$medical_record_number = $this->mcu->get_medical_record_number($type_examination);
			$no_transaction		   = $this->mcu->get_no_transaction($id_patient, $type_examination);

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
				'mcu_manual'			=> $this->input->post('mcu_manual'),
				'id_clinic'				=> $this->input->post('id_clinic'),
				'id_patient'			=> $id_patient,
				'id_number_patient'		=> $id_number,
				'name_patient'			=> strtoupper($this->input->post('name', TRUE)),
				'no_transaction'		=> $no_transaction,
				'type_examination'		=> $type_examination,
				'date_examination'		=> $this->input->post('date_examination'),
				'image'					=> $filename,
				'qrcode'				=> $image_name,
				'created_at'			=> date('Y-m-d H:i:s')
			];

			$data_transactions = [
				'no_transaction'		=> $no_transaction,
				'id_clinic'				=> $this->input->post('id_clinic'),
				'id_patient' 			=> $id_patient,
				'id_company' 			=> $this->input->post('id_company', TRUE),
				'medical_record_number' => $medical_record_number,
				'patient_name' 			=> strtoupper($this->input->post('name', TRUE)),
				'patient_id_number' 	=> $id_number,
				'type_examination' 		=> $type_examination,
				'type_transaction'	 	=> $this->input->post('type_transaction'),
				'total_price' 			=> preg_replace("/[^0-9]/", "", $this->input->post('total_price'))
			];

			$this->mcu->store_to_table_mcus_v1($data_mcus_v1);
			$this->mcu->store_to_table_transactions($data_transactions);

			echo json_encode($id_patient);
		}
	}

	public function editPatient()
	{
		$id_number = $this->input->post('id_number');
		$name 	   = strtoupper($this->input->post('name'));

		$data = [
			'id_number' 	  		=> $id_number,
			'passport_number' 		=> $this->input->post('passport_number'),
			'name'		 	  		=> $name,
			'gender' 		  		=> $this->input->post('gender'),
			'place_of_birth'  		=> $this->input->post('place_of_birth'),
			'date_of_birth'   		=> $this->input->post('date_of_birth'),
			'address'  		  		=> $this->input->post('address'),
			'basic_safety_training' => strtoupper($this->input->post('basic_safety_training')),
			'nationality' 	  		=> strtoupper($this->input->post('nationality')),
			'id_company'	 	  	=> $this->input->post('id_company', TRUE),
			'occupation'	 	  	=> strtoupper($this->input->post('occupation')),
			'updated_at'	  		=> date('Y-m-d H:i:s')
		];

		$this->patient->update_table_patients_mcus_transactions($this->input->post('id'), $data, $id_number, $name);

		$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Data Patient has been updated!',showConfirmButton: false,timer: 1500})</script>");

		redirect('patient');
	}

	public function deletePatient()
	{
		$this->patient->delete_patient($this->input->post('id'));

		$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Patient has been deleted!',showConfirmButton: false,timer: 1500})</script>");

		redirect('patient');
	}

	public function formMakeRev($id_patient, $id_number)
	{
		$data = [
			'title'   => 'Patient',
			'patient' => $this->patient->get_data_patient_by_id($id_patient),
			'clinics' => $this->clinic->get_list_of_clinic()
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
		$this->load->view('patients/form_make_rev');
		$this->load->view('templates/footer');
	}

	public function formMakeMcu($id_patient, $id_number)
	{
		$data = [
			'title'   => 'Patient',
			'patient' => $this->patient->get_data_patient_by_id($id_patient),
			'clinics' => $this->clinic->get_list_of_clinic()
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
		$this->load->view('patients/form_make_mcu');
		$this->load->view('templates/footer');
	}

}
