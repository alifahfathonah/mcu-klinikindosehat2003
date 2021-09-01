<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Clinic extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('clinic_model', 'clinic');
		if (!$this->session->has_userdata('logged_in')) {
			redirect('auth');
		}
	}

	/** 
	 * Serverside Datatables for this controller
	 */
	function get_ajax_clinic()
	{
		$list = $this->clinic->get_datatables_clinic();
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
				<a class="button-warning" href="#" data-toggle="modal" data-target="#editClinic' . $item->id . '"><i class="fas fa-fw fa-user-edit"></i> Ubah / <i>Edit</i></a>
				<a class="button-danger" href="#" data-toggle="modal" data-target="#deleteClinic' . $item->id . '"><i class="fas fa-fw fa-user-minus"></i> Hapus / <i>Delete</i></a>
			';

			$data[] = $row;
		}

		$output = [
			"draw"            => @$_POST['draw'],
			"recordsTotal"    => $this->clinic->count_all(),
			"recordsFiltered" => $this->clinic->count_filtered(),
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
			'title'   => 'Clinics',
			'clinics' => $this->clinic->get_list_of_clinic()
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
		$this->load->view('clinics/index');
		$this->load->view('templates/footer');
	}

	public function addNewClinic()
	{
		date_default_timezone_set("Asia/Jakarta");
		$data = [
			'name' 		 => $this->input->post('name'),
			'address' 	 => $this->input->post('address'),
			'created_at' => date("Y-m-d H:i:s")
		];

		$this->clinic->add_new_clinic($data);

		$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'New clinic has been added!',showConfirmButton: false,timer: 1500})</script>");

		redirect('clinic');
	}

	public function editClinic()
	{
		date_default_timezone_set("Asia/Jakarta");
		$data = [
			'name' 		 => $this->input->post('name'),
			'address' 	 => $this->input->post('address'),
			'updated_at' => date("Y-m-d H:i:s")
		];

		$this->clinic->edit_clinic($this->input->post('id'), $data);

		$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Data clinic has been updated!',showConfirmButton: false,timer: 1500})</script>");

		redirect('clinic');
	}

	public function deleteClinic()
	{
		$this->clinic->delete_clinic($this->input->post('id'));

		$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Clinic has been deleted!',showConfirmButton: false,timer: 1500})</script>");

		redirect('clinic');
	}

	// 

	public function getDoctor($id_clinic)
	{
		$doctors = $this->clinic->get_doctor_by_id_clinic($id_clinic);

		echo "<option value='0' selected disabled>Select Doctor</option>";
		foreach ($doctors as $doctor) {
			echo "<option value='" . $doctor['id'] . "'>" . $doctor['name'] . "</option>";
		}
	}
}
