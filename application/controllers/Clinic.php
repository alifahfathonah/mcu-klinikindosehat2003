<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Clinic extends CI_Controller
{

	/**
	 * Constructor for this controller.
	 */
	public function __construct()
	{
		parent::__construct();
		
		date_default_timezone_set("Asia/Jakarta");

		$this->load->model('clinic_model', 'clinic');

		if (!$this->session->has_userdata('logged_in')) {
			redirect('auth');
		}

		$this->session->unset_userdata('filterByDataCompany');
		$this->session->unset_userdata('filterByDataPatient');
		$this->session->unset_userdata('filterByCompany');
		$this->session->unset_userdata('filterByDataPatientCheck');
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
		$data = [
			'title'   => 'Klinik',
			'clinics' => $this->clinic->get_list_of_clinic()
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('clinics/index');
		$this->load->view('templates/footer');
	}

	/**
	 * Add new clinic process.
	 */
	public function addNewClinic()
	{
		$data = [
			'name' 		 => $this->input->post('name'),
			'address' 	 => $this->input->post('address'),
			'created_at' => date("Y-m-d H:i:s")
		];

		$this->clinic->store_to_table_clinics($data);

		$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'New clinic has been added!',showConfirmButton: false,timer: 1500})</script>");

		redirect('clinic');
	}

	/**
	 * Edit data clinic process.
	 */
	public function editClinic()
	{
		$data = [
			'name' 		 => $this->input->post('name'),
			'address' 	 => $this->input->post('address'),
			'updated_at' => date("Y-m-d H:i:s")
		];

		$this->clinic->update_table_clinics($this->input->post('id'), $data);

		$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Data clinic has been updated!',showConfirmButton: false,timer: 1500})</script>");

		redirect('clinic');
	}

	/**
	 * Delete clinic process.
	 */
	public function deleteClinic()
	{
		$this->clinic->delete_clinic($this->input->post('id'));

		$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Clinic has been deleted!',showConfirmButton: false,timer: 1500})</script>");

		redirect('clinic');
	}

	/**
	 * Return doctors by clinic.
	 */
	public function getDoctor($id_clinic)
	{
		$doctors = $this->clinic->get_doctor_by_id_clinic($id_clinic);

		echo "<option value='0' selected disabled>Select Doctor</option>";
		foreach ($doctors as $doctor) {
			echo "<option value='" . $doctor['id'] . "'>" . $doctor['name'] . "</option>";
		}
	}
}
