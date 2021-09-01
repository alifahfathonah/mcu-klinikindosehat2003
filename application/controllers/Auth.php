<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model', 'auth');
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		if ($this->session->has_userdata('logged_in')) {
			redirect('dashboard');
		} else {
			$this->load->view('auths/index');
		}
	}

	public function login()
	{
		$email    = $this->input->post('email');
		$password = $this->input->post('password');

		if ($this->auth->check_email($email) == 1) {
			if ($this->auth->check_status($email) == 1) {
				$password_db = $this->auth->get_password($email);
				if (password_verify($password, $password_db)) {
					$data = array(
						'id'		=> $this->auth->get_user_id($email),
						'name'      => $this->auth->get_name($email),
						'role'      => $this->auth->get_role($email),
						'site'      => $this->auth->get_site($email),
						'logged_in' => TRUE
					);

					$this->session->set_userdata($data);

					$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Login Success! Welcome " . $this->session->userdata('name') . "',showConfirmButton: false,timer: 1500})</script>");

					redirect('dashboard');
				} else {
					$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'error',title: 'Wrong Password!',showConfirmButton: false,timer: 1500})</script>");
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'error',title: 'Inactive Account!',showConfirmButton: false,timer: 1500})</script>");
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'error',title: 'Wrong Email!',showConfirmButton: false,timer: 1500})</script>");
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();

		redirect('auth');
	}
	
}
