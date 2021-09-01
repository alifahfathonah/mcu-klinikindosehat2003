<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard_model', 'dashboard');
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
			'title' => 'Dashboard'
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
		$this->load->view('dashboards/index');
		$this->load->view('templates/footer');
	}
}
