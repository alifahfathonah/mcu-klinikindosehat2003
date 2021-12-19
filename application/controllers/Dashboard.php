<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	/**
	 * Constructor for this controller
	 */
	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");

		$this->load->model('Dashboard_model', 'dashboard');
		
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
			'title' => 'Dashboard'
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('dashboards/index');
		$this->load->view('templates/footer');
	}
}
