<?php

class Company_model extends CI_Model
{

	// Start Datatables

	/* set column field database for datatable orderable */
	var $column_order  = array(null, 'name', 'address', null);
	/* set column field database for datatable searchable */
	var $column_search = array('name', 'address');
	/* default order */
	var $order         = array('id' => 'asc');

	private function _get_datatables_query_company()
	{
		$this->db->select('*');
		$this->db->from('companies');
		$this->db->where('is_deleted', '0');
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

	function get_datatables_company()
	{
		$this->_get_datatables_query_company();
		if (@$_POST['length'] != -1)
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query_company();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all()
	{
		$this->db->from('companies');
		return $this->db->count_all_results();
	}

	// End Datatables

	function store_to_table_companies($data)
	{
		$this->db->insert('companies', $data);

		return TRUE;
	}

	function update_table_companies($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('companies', $data);

		return TRUE;
	}

	function delete_company($id)
	{
		$this->db->where('id', $id);
		$this->db->update('companies', ['is_deleted' => '1', 'deleted_at' => date("Y-m-d H:i:s")]);

		return TRUE;
	}

}
