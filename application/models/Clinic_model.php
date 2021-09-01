<?php

class Clinic_model extends CI_Model
{

	// Start Datatables

	/* set column field database for datatable orderable */
	var $column_order  = array(null, 'name', 'address');
	/* set column field database for datatable searchable */
	var $column_search = array('name', 'address');
	/* default order */
	var $order         = array('id' => 'asc');

	private function _get_datatables_query_clinic()
	{
		$this->db->select('*');
		$this->db->from('clinics');
		$this->db->where('is_deleted', 0);
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

	function get_datatables_clinic()
	{
		$this->_get_datatables_query_clinic();
		if (@$_POST['length'] != -1)
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query_clinic();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all()
	{
		$this->db->from('clinics');
		return $this->db->count_all_results();
	}

	// End Datatables

	function get_list_of_clinic()
	{
		return $this->db->get_where('clinics', ['is_deleted' => 0])->result_array();
	}

	function add_new_clinic($data)
	{
		$this->db->insert('clinics', $data);

		return TRUE;
	}

	function edit_clinic($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('clinics', $data);

		return TRUE;
	}

	function delete_clinic($id)
	{
		date_default_timezone_set("Asia/Jakarta");
		$this->db->where('id', $id);
		$this->db->update('clinics', ['is_deleted' => 1, 'deleted_at' => date("Y-m-d H:i:s")]);

		$this->db->where('id_clinic', $id);
		$this->db->update('doctors', ['is_deleted' => 1, 'deleted_at' => date("Y-m-d H:i:s")]);

		return TRUE;
	}

	// 

	function get_doctor_by_id_clinic($id)
	{
		return $this->db->get_where('doctors', ['id_clinic' => $id, 'is_deleted' => 0])->result_array();
	}
}
