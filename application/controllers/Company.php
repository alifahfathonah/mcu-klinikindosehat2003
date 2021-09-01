<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Company extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('company_model', 'company');
		if (!$this->session->has_userdata('logged_in')) {
			redirect('auth');
		}
	}

	/** 
	 * Serverside Datatables for this controller
	 */
	function get_ajax_company()
	{
		$list = $this->company->get_datatables_company();
		$data = [];
		$no   = @$_POST['start'];
		foreach ($list as $item) {
			$no++;
			$row   = [];
			$row[] = $no . ".";
			$row[] = $item->name;
			$row[] = $item->address;

			// Action Button
			$row[] = '
				<a class="button-warning" href="#" data-toggle="modal" data-target="#editCompany' . $item->id . '"><i class="fas fa-fw fa-user-edit"></i> Ubah / <i>Edit</i></a>
				<a class="button-danger" href="#" data-toggle="modal" data-target="#deleteCompany' . $item->id . '"><i class="fas fa-fw fa-user-minus"></i> Hapus / <i>Delete</i></a>
			';

			$data[] = $row;
		}

		$output = [
			"draw"            => @$_POST['draw'],
			"recordsTotal"    => $this->company->count_all(),
			"recordsFiltered" => $this->company->count_filtered(),
			"data"            => $data
		];

		// Output to JSON Format
		echo json_encode($output);
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$data = [
			'title'   	=> 'Company',
			'companies'	=> $this->company->get_datatables_company()
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
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

		$this->company->add_company($data);

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

		$this->company->edit_company($this->input->post('id'), $data);

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
