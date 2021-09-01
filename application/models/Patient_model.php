<?php

class Patient_model extends CI_Model
{

	function get_data_patient_by_id($id)
	{
		$this->db->select('patients.id as id, id_number, passport_number, patients.name as name, gender, place_of_birth, date_of_birth, patients.address as address, basic_safety_training, nationality, id_company, occupation, image, companies.name as company_name, companies.address as company_address');
		$this->db->from('patients');
		$this->db->join('companies', 'companies.id=patients.id_company', 'left');
		$this->db->where('patients.id', $id);
		return $this->db->get()->row_array();
	}

	function filePut($filename, $image)
	{
		file_put_contents(FCPATH . 'assets/images/patients/' . $filename, $image);

		$result = TRUE;

		return $result;
	}

	function add_patient_process($data)
	{
		$this->db->insert('patients', $data);

		return $this->db->insert_id();
	}

	function edit_patient($id, $data, $id_number, $name)
	{
		$this->db->where('id', $id);
		$this->db->update('patients', $data);

		$this->db->where('id_patient', $id);
		$this->db->update('mcus', ['id_number_patient' => $id_number, 'name_patient' => $name]);

		return TRUE;
	}

	function delete_patient($id)
	{
		date_default_timezone_set("Asia/Jakarta");
		$this->db->where('id', $id);
		$this->db->update('patients', ['is_deleted' => 1, 'deleted_at' => date("Y-m-d H:i:s")]);

		return TRUE;
	}

}
