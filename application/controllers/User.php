<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model', 'user');
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
			'title'   => 'Users',
			'users'	  => $this->user->get_list_of_users(),
			'clinics' => $this->clinic->get_list_of_clinic()
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
		$this->load->view('users/index');
		$this->load->view('templates/footer');
	}

	public function addNewUser()
	{
		date_default_timezone_set("Asia/Jakarta");
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

	public function editUser()
	{
		if ($this->input->post('password') == "") {
			date_default_timezone_set("Asia/Jakarta");
			$data = [
				'name' 		 => $this->input->post('name'),
				'email'		 => $this->input->post('email'),
				'role'		 => $this->input->post('role'),
				'site'		 => $this->input->post('site'),
				'updated_at' => date("Y-m-d H:i:s")
			];
		} else {
			date_default_timezone_set("Asia/Jakarta");
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

	public function deleteUser()
	{
		$this->user->delete_user($this->input->post('id'));

		$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Account has been deleted!',showConfirmButton: false,timer: 1500})</script>");

		redirect('user');
	}

	public function activateUser()
	{
		$this->user->activate_user($this->input->post('id'));

		$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Account has been activate!',showConfirmButton: false,timer: 1500})</script>");

		redirect('user');
	}

	public function disableUser()
	{
		$this->user->disable_user($this->input->post('id'));

		$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Account has been disabled!',showConfirmButton: false,timer: 1500})</script>");

		redirect('user');
	}
}
