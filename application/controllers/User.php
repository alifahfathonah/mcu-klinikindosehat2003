<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	/**
	 * Constructor for this controller
	 */
	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");
		
		$this->load->model('user_model', 'user');
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
			'title'   => 'Pengguna',
			'users'	  => $this->user->get_list_of_users(),
			'clinics' => $this->clinic->get_list_of_clinic()
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('users/index');
		$this->load->view('templates/footer');
	}

	/**
	 * Add new user process.
	 */
	public function addNewUser()
	{
		$data = [
			'name' 		 => $this->input->post('name'),
			'email'		 => $this->input->post('email'),
			'password'	 => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'role'		 => $this->input->post('role'),
			'site'		 => $this->input->post('site'),
			'created_at' => date("Y-m-d H:i:s")
		];

		$this->user->add_new_user($data);

		$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'New User has been added!',showConfirmButton: false,timer: 1500})</script>");

		redirect('user');
	}

	/**
	 * Edit data user process.
	 */
	public function editUser()
	{
		if ($this->input->post('password') == "") {
			$data = [
				'name' 		 => $this->input->post('name'),
				'email'		 => $this->input->post('email'),
				'role'		 => $this->input->post('role'),
				'site'		 => $this->input->post('site'),
				'updated_at' => date("Y-m-d H:i:s")
			];
		} else {
			$data = [
				'name' 		 => $this->input->post('name'),
				'email'		 => $this->input->post('email'),
				'password'	 => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'role'		 => $this->input->post('role'),
				'site'		 => $this->input->post('site'),
				'updated_at' => date("Y-m-d H:i:s")
			];
		}
		$this->user->edit_user($this->input->post('id'), $data);

		$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Account has been updated!',showConfirmButton: false,timer: 1500})</script>");

		redirect('user');
	}

	/**
	 * Delete user process.
	 */
	public function deleteUser()
	{
		$this->user->delete_user($this->input->post('id'));

		$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Account has been deleted!',showConfirmButton: false,timer: 1500})</script>");

		redirect('user');
	}

	/**
	 * Activate account user process.
	 */
	public function activateUser()
	{
		$this->user->activate_user($this->input->post('id'));

		$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Account has been activate!',showConfirmButton: false,timer: 1500})</script>");

		redirect('user');
	}

	/**
	 * Deactivate account user process.
	 */
	public function disableUser()
	{
		$this->user->disable_user($this->input->post('id'));

		$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Account has been disabled!',showConfirmButton: false,timer: 1500})</script>");

		redirect('user');
	}
}
