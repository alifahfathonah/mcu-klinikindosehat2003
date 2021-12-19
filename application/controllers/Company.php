<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Company extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		
		date_default_timezone_set("Asia/Jakarta");

		$this->load->model('company_model', 'company');
		
		if (!$this->session->has_userdata('logged_in')) {
			redirect('auth');
		}
		
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
		if ($this->input->post('filter')) {
			$filterByDataCompany = $this->input->post('filter-by-data');
			
			$this->session->set_userdata('filterByDataCompany', $filterByDataCompany);
		} else {
			$filterByDataCompany = $this->session->userdata('filterByDataCompany');
		}

		// Pagination 

		$this->load->library('pagination');
		
		$config['base_url']   = base_url('company/index');
		$config['total_rows'] = $this->company->get_total_data_company($filterByDataCompany);
		$config['per_page']   = 15;
		
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

		$this->pagination->initialize($config);

		$start_data = $this->uri->segment(3);

		$data = [
			'title'   	 => 'Perusahaan',
			'companies'	 => $this->company->get_data_company($config['per_page'], $start_data, $filterByDataCompany),
			'total_data' => $config['total_rows']
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('companies/index');
		$this->load->view('templates/footer');
	}

	public function addCompany()
	{
		$data = [
			'name' 		 => $this->input->post('name'),
			'address' 	 => $this->input->post('address'),
			'created_at' => date("Y-m-d H:i:s")
		];

		$this->company->store_to_table_companies($data);

		$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'New Company has been added!',showConfirmButton: false,timer: 1500})</script>");

		redirect('company');
	}

	public function editCompany()
	{
		$data = [
			'name'		 => $this->input->post('name'),
			'address' 	 => $this->input->post('address'),
			'updated_at' => date('Y-m-d H:i:s')
		];

		$this->company->update_table_companies($this->input->post('id'), $data);

		$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Data Company has been updated!',showConfirmButton: false,timer: 1500})</script>");

		redirect('company');
	}

	public function deleteCompany()
	{
		$this->company->delete_company($this->input->post('id'));

		$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Company has been deleted!',showConfirmButton: false,timer: 1500})</script>");

		redirect('company');
	}

}
