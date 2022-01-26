<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Patient extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");

		$this->load->model('patient_model', 'patient');
		$this->load->model('company_model', 'company');
		$this->load->model('clinic_model', 'clinic');
		$this->load->model('mcu_model', 'mcu');
		
		if (!$this->session->has_userdata('logged_in')) {
			redirect('auth');
		}

		$this->session->unset_userdata('filterByDataCompany');
		$this->session->unset_userdata('filterByDataTransaction');
		$this->session->unset_userdata('filterByType');
		$this->session->unset_userdata('filterBySiteTransaction');
		$this->session->unset_userdata('filterByData');
		$this->session->unset_userdata('filterByStatus');
		$this->session->unset_userdata('filterByStartDate');
		$this->session->unset_userdata('filterByEndDate');
		$this->session->unset_userdata('filterBySite');
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$this->session->unset_userdata('filterByDataPatientCheck');

		$defaultFilterByCompany = $this->session->set_userdata('filterByCompany', '0');
		$filterByCompany = '0';

		if ($this->input->post('filter')) {
			$filterByDataPatient = $this->input->post('filter-by-data');
			$filterByCompany = $this->input->post('filter-by-company');
			
			$this->session->set_userdata('filterByDataPatient', $filterByDataPatient);
			$this->session->set_userdata('filterByCompany', $filterByCompany);
		} else {
			$filterByDataPatient = $this->session->userdata('filterByDataPatient');
			$filterByCompany = $this->session->userdata('filterByCompany');
		}

		// Pagination 

		// load
		$this->load->library('pagination');
		// config
		$config['base_url']   = base_url('patient/index');
		$config['total_rows'] = $this->patient->get_total_data_patient($filterByDataPatient, $filterByCompany);
		$config['per_page']   = 10;
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
			'title'   	 => 'Pasien',
			'total_data' => $config['total_rows'],
			'patients'	 => $this->patient->get_data_patient($config['per_page'], $start_data, $filterByDataPatient, $filterByCompany),
			'companies'	 => $this->company->get_companies()
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('patients/index');
		$this->load->view('templates/footer');
	}

	public function indexCheck()
	{
		$this->session->unset_userdata('filterByDataPatient');
		$this->session->unset_userdata('filterByCompany');

		if ($this->input->post('filter')) {
			$filterByDataPatientCheck = $this->input->post('filter-by-data');
			$this->session->set_userdata('filterByDataPatientCheck', $filterByDataPatientCheck);
		} else {
			$filterByDataPatientCheck = $this->session->userdata('filterByDataPatientCheck');
		}

		// Pagination 

		// load
		$this->load->library('pagination');
		// config
		$config['base_url']   = base_url('patient/indexCheck');
		$config['total_rows'] = $this->mcu->get_total_data_mcu_today($filterByDataPatientCheck);
		$config['per_page']   = 9;
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
			'title'      => 'Cek Pasien',
			'total_data' => $config['total_rows'],
			'patients'   => $this->mcu->get_data_mcu_today($config['per_page'], $start_data, $filterByDataPatientCheck)
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('patients/index_check');
		$this->load->view('templates/footer');
	}

	public function detailIndexCheck($hash, $medical_record_number)
	{
		$data = [
			'title'    => 'Cek Pasien',
			'subtitle' => 'Detail Cek Pasien',
			'data'     => $this->mcu->get_data_mcu_by_medical_record_number($medical_record_number)
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('patients/detail_index_check');
		$this->load->view('templates/footer');
	}

	public function registrationPatient()
	{
		$data = [
			'title'     => 'Pasien',
			'subtitle'  => 'Formulir Pendaftaran',
			'companies'	=> $this->company->get_companies(),
			'clinics' 	=> $this->clinic->get_list_of_clinic()
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
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
		$id_number_old 		  = $this->input->post('id_number_old', TRUE);
		$id_number 			  = $this->input->post('id_number', TRUE);
		$mcu_manual 		  = $this->input->post('mcu_manual');
		$duplicate_mcu_manual = $this->patient->get_mrn_exist($mcu_manual);
		$duplicate_id_number  = $this->patient->get_patient_exist($id_number_old);

		if ($duplicate_mcu_manual > 0) {
			echo json_encode("duplicate_mrn");
		} else {
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
					'mcu_manual'			=> $mcu_manual,
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
					'mcu_manual'			=> $mcu_manual,
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
	}

	public function formEditPatient($hash, $id_number)
	{
		$data = [
			'title'     => 'Pasien',
			'subtitle'  => 'Ubah Data Pasien',
			'patient'   => $this->patient->get_data_patient_by_id_number($id_number),
			'companies' => $this->company->get_companies()
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('patients/form_edit_patient');
		$this->load->view('templates/footer');
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
