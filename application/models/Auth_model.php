<?php

class Auth_model extends CI_Model {

	function check_email($email)
	{
		$result = $this->db->get_where('users', ['email' => $email])->num_rows();

		return $result;
	}

	function check_status($email)
	{
		$this->db->select('status');
		$result = $this->db->get_where('users', ['email' => $email])->row_array();

		return $result['status'];
	}

	function get_password($email)
	{
		$this->db->select('password');
		$result = $this->db->get_where('users', ['email' => $email])->row_array();

		return $result['password'];
	}

	function get_role($email)
	{
		$this->db->select('role');
		$result = $this->db->get_where('users', ['email' => $email])->row_array();

		return $result['role'];
	}

	function get_name($email)
	{
		$this->db->select('name');
		$result = $this->db->get_where('users', ['email' => $email])->row_array();

		return $result['name'];
	}

	function get_site($email)
	{
		$this->db->select('site');
		$result = $this->db->get_where('users', ['email' => $email])->row_array();

		return $result['site'];
	}

	function get_user_id($email)
	{
		$this->db->select('id');
		$result = $this->db->get_where('users', ['email' => $email])->row_array();

		return $result['id'];
	}

}
