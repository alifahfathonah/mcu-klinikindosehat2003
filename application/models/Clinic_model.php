<?php

class Clinic_model extends CI_Model
{

	function get_list_of_clinic()
	{
		return $this->db->get_where('clinics', ['is_deleted' => 0])->result_array();
	}

	function store_to_table_clinics($data)
	{
		$this->db->insert('clinics', $data);

		return TRUE;
	}

	function update_table_clinics($id, $data)
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

	function get_name_clinic_by_id($id)
	{
		$result = $this->db->get_where('clinics', ['id' => $id])->row_array();

		return $result['name'];
	}
}
