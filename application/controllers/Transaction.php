<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('transaction_model', 'transaction');
		$this->load->model('Clinic_model', 'clinic');

		if (!$this->session->has_userdata('logged_in')) {
			redirect('auth');
		}
		
		$this->session->unset_userdata('filterByDataCompany');
		$this->session->unset_userdata('filterByDataPatient');
		$this->session->unset_userdata('filterByCompany');
		$this->session->unset_userdata('filterByDataPatientCheck');
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
			$filterByDataTransaction = $this->input->post('filter-by-data');
			$filterByType = $this->input->post('filter-by-status');
			$filterBySiteTransaction = $this->input->post('filter-by-site');
			
			$this->session->set_userdata('filterByDataTransaction', $filterByDataTransaction);
			$this->session->set_userdata('filterByType', $filterByType);
			$this->session->set_userdata('filterBySiteTransaction', $filterBySiteTransaction);
		} else {
			$filterByDataTransaction = $this->session->userdata('filterByDataTransaction');
			$filterByType = $this->session->userdata('filterByType');
			$filterBySiteTransaction = $this->session->userdata('filterBySiteTransaction');
		}

		// Pagination 

		$this->load->library('pagination');
		
		$config['base_url']   = base_url('transaction/index');
		$config['total_rows'] = $this->transaction->get_total_data_transaction($filterByDataTransaction, $filterByType, $filterBySiteTransaction);
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
			'title'   	   => 'Transaksi',
			'clinics'      => $this->clinic->get_list_of_clinic(),
			'total_data'   => $config['total_rows'],
			'transactions' => $this->transaction->get_data_transactions($config['per_page'], $start_data, $filterByDataTransaction, $filterByType, $filterBySiteTransaction)
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('transactions/index');
		$this->load->view('templates/footer');
	}

	public function editTransaction()
	{
		$data = [
			'total_price' => $this->input->post('total_price')
		];

		$this->transaction->update_table_transactions($this->input->post('id'), $data);

		$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Data Transaction has been updated!',showConfirmButton: false,timer: 1500})</script>");

		redirect('transaction');
	}

	public function previewInvoicePdf($no_transaction)
	{
		$data = $this->transaction->get_data_transaction($no_transaction);

		$mpdf = new \Mpdf\Mpdf([
			'mode' 					=> 'utf-8',
			'format' 				=> [297, 210],
			'orientation' 			=> 'L',
			'margin_left'			=> 0,
			'margin_right' 			=> 0,
			'margin_top'			=> 36,
			'margin_bottom' 		=> 0,
			'margin_header' 		=> 0,
			'margin_footer' 		=> 0,
			'collapseBlockMargins' 	=> false,
		]);

		$view = $this->load->view('transactions/invoice', ['data' => $data], TRUE);

		$mpdf->WriteHTML($view);

		$filename = $data['no_transaction'] . '_' . $data['patient_name'] . '.pdf';
		$mpdf->Output($filename, \Mpdf\Output\Destination::INLINE);
	}

}
