<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('transaction_model', 'transaction');
		if (!$this->session->has_userdata('logged_in')) {
			redirect('auth');
		}
	}

	/** 
	 * Serverside Datatables for this controller
	 */
	function get_ajax_transaction()
	{
		$list = $this->transaction->get_datatables_transaction();
		$data = [];
		$no   = @$_POST['start'];
		foreach ($list as $item) {
			$no++;
			$row   = [];
			$row[] = $no . ".";
			$row[] = $item->no_transaction;
			$row[] = $item->medical_record_number;
			$row[] = $item->patient_name;
			$row[] = strtoupper($item->type_transaction);
			$row[] = number_format($item->total_price, 0, '.', '.');

			// Action Button
			$row[] = '
				<a class="button-primary" href="' . base_url('transaction/previewInvoicePdf/' . $item->no_transaction) . '"><i class="far fa-fw fa-eye"></i> <i>View</i></a>
			';

			$data[] = $row;
		}

		$output = [
			"draw"            => @$_POST['draw'],
			"recordsTotal"    => $this->transaction->count_all(),
			"recordsFiltered" => $this->transaction->count_filtered(),
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
			'title'   => 'Transaction'
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
		$this->load->view('transactions/index');
		$this->load->view('templates/footer');
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
