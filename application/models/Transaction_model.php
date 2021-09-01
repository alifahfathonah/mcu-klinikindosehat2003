<?php

class Transaction_model extends CI_Model
{

	// Start Datatables

	/* set column field database for datatable orderable */
	var $column_order  = array(null, 'no_transaction', 'medical_record_number', 'patient_name', 'type_examination', 'type_transaction', 'total_price', null);
	/* set column field database for datatable searchable */
	var $column_search = array('no_transaction', 'medical_record_number', 'patient_name', 'type_examination', 'type_transaction', 'total_price');
	/* default order */
	var $order         = array('id' => 'asc');

	private function _get_datatables_query_transaction()
	{
		if ( $this->session->userdata('role') == 'superuser' ) {
			$this->db->select('*');
			$this->db->from('transactions');	
		} else {
			$this->db->select('*');
			$this->db->from('transactions');
			$this->db->where('id_clinic', $this->session->userdata('site'));
		}
		
		$i = 0;
		/* loop column */
		foreach ($this->column_search as $item) {
			/* if datatable send POST for search */
			if (@$_POST['search']['value']) {
				/* first loop */
				if ($i === 0) {
					/* open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND. */
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				/* last loop */
				if (count($this->column_search) - 1 == $i)
					/* close bracket */
					$this->db->group_end();
			}
			$i++;
		}

		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables_transaction()
	{
		$this->_get_datatables_query_transaction();
		if (@$_POST['length'] != -1)
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query_transaction();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all()
	{
		$this->db->from('transactions');
		return $this->db->count_all_results();
	}

	// End Datatables

	function get_data_transaction($no_transaction)
	{
		$this->db->select('transactions.id as id, no_transaction, medical_record_number, patient_name, patients.address as patient_address, type_transaction, type_examination, total_price, transactions.created_at as date');
		$this->db->from('transactions');
		$this->db->join('patients', 'patients.id = transactions.id_patient');
		$this->db->where('transactions.no_transaction', $no_transaction);

		return $this->db->get()->row_array();
	}

}
