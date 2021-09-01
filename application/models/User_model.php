<?php

class User_model extends CI_Model
{

	function get_list_of_users()
	{
		$this->db->select('users.id as id, users.name as name, email, password, role, status, site, clinics.id as id_clinic, clinics.name as name_clinic');
		$this->db->from('users');
		$this->db->join('clinics', 'clinics.id=users.site', 'left');
		$this->db->where('users.role !=', 'superuser');
		return $this->db->get()->result_array();
	}

	function add_new_user($data)
	{
		$this->db->insert('users', $data);

		return TRUE;
	}

	function edit_user($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('users', $data);

		return TRUE;
	}

	function delete_user($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('users');

		return TRUE;
	}

	function activate_user($id)
	{
		$this->db->where('id', $id);
		$this->db->update('users', ['status' => 1]);

		return TRUE;
	}

	function disable_user($id)
	{
		$this->db->where('id', $id);
		$this->db->update('users', ['status' => 0]);

		return TRUE;
	}
}
