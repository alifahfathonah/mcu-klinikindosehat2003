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

	public function addPatient()
	{
		$data = [
			'title'     => 'Patient',
			'companies'	=> $this->company->get_datatables_company()
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
		$this->load->view('patients/add_patient');
		$this->load->view('templates/footer');
	}

	public function addPatientProcess()
	{
		$id_number = $this->input->post('id_number', TRUE);
		$duplicate_id_number = $this->db->query("SELECT * FROM patients WHERE id_number='$id_number'")->num_rows();

		if ($duplicate_id_number > 0) {
			$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'error',title: 'Duplicate ID Number!',showConfirmButton: false,timer: 1500})</script>");

			redirect('patient');
		} else {
			$image    = $this->input->post('image');
			$image    = str_replace('data:image/jpeg;base64,', '', $image);
			$image    = base64_decode($image);
			$filename = 'image_' . $id_number . '_' . date('dmy') . '.jpg';

			$this->patient->filePut($filename, $image);

			date_default_timezone_set("Asia/Jakarta");
			$data = [
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
				'image'					=> $filename,
				'created_at'	  		=> date('Y-m-d H:i:s')
			];

			// Save data to Database
			$res = $this->patient->add_patient_process($data);

			echo json_encode($res);
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

		$this->patient->edit_patient($this->input->post('id'), $data, $id_number, $name);

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
