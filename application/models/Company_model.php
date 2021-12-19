<?php

class Company_model extends CI_Model
{

	function get_companies()
	{
		$this->db->order_by('name', 'ACS');

		return $this->db->get_where('companies', ['is_deleted' => '0'])->result_array();
	}

	function get_total_data_company($keyword = null)
	{
		date_default_timezone_set("Asia/Jakarta");

		$this->db->select('*');
		$this->db->from('companies');

		if ($keyword) {
			$this->db->like('name', $keyword);
			$this->db->or_like('address', $keyword);
		}

		return $this->db->get()->num_rows();
	}

	function get_data_company($limit, $startPagination, $keyword = null)
	{
		date_default_timezone_set("Asia/Jakarta");

		$this->db->select('*');
		$this->db->from('companies');

		if ($keyword) {
			$this->db->like('name', $keyword);
			$this->db->or_like('address', $keyword);
		}

		$this->db->order_by('name ASC');
		$this->db->limit($limit, $startPagination);

		return $this->db->get()->result_array();
	}

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
