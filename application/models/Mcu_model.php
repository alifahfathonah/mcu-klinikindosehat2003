<?php

class Mcu_model extends CI_Model {

	// Start Datatables

	/* set column field database for datatable orderable */
	var $column_order  = array(null, 'medical_record_number', 'patient_name', 'patient_id_number');
	/* set column field database for datatable searchable */
	var $column_search = array('medical_record_number', 'name_patient', 'id_number_patient');
	/* default order */
	var $order         = array('id' => 'asc');

	private function _get_datatables_query_mcu()
	{
		if ( $this->session->userdata('role') == 'superuser' ) {
			$this->db->select('mcus_v1.id as id, medical_record_number, mcu_manual, id_number_patient, name_patient, mcus_v1.is_fit as mcu_is_fit, patients.id_number as patient_id_number, patients.name as patient_name, type_examination');
			$this->db->from('mcus_v1');
			$this->db->join('patients', 'patients.id=mcus_v1.id_patient', 'left');	
		} else {
			$this->db->select('mcus_v1.id as id, medical_record_number, mcu_manual, id_number_patient, name_patient, mcus_v1.is_fit as mcu_is_fit, patients.id_number as patient_id_number, patients.name as patient_name, type_examination');
			$this->db->from('mcus_v1');
			$this->db->join('patients', 'patients.id=mcus_v1.id_patient', 'left');
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

	function get_datatables_mcu()
	{
		$this->_get_datatables_query_mcu();
		if (@$_POST['length'] != -1)
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query_mcu();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all()
	{
		$this->db->from('mcus_v1');
		return $this->db->count_all_results();
	}

	// End Datatables

	function get_data_mcu_by_medical_record_number($medical_record_number)
	{
		$this->db->select('mcus_v1.id as id, mcus_v1.medical_record_number as medical_record_number, mcu_manual, id_clinic, id_patient, id_number_patient, name_patient, no_transaction, type_examination, is_fit, date_examination, qrcode, passport_number, gender, place_of_birth, date_of_birth, patients.address as address, basic_safety_training, nationality, id_company, occupation, image, companies.name as company_name, clinics.name as clinic_name, alcohol_history, allergic_history, amputation, blood_disorder, balance_problem, back_or_joint_problem, colour_blindness, cancer, diabetes, digestive_disorder, depresion, epilepsy, eye_vision_problem, ear_problem, fracture, genital_disorder, heart_surgery, heart_disease, high_blood_pressure, hernia, infectious_disease, kidney_problem, lung_disease, liver_problem, lost_of_memory, narcotic_history, neurogical_disease, operation_surgery, psychiatric_problem, restricted_mobility, skin_problem, sleep_problem, thyroid_problem, tuberculosis, smoking, height, weight, blood_pressure, pulse_regular, respiratory_rate, right_eye_without, left_eye_without, both_eye_without, right_eye_with, left_eye_with, both_eye_with, color_vision, general_appearance, eyes, ears, nose, mouth, throat, neck, throid, lymp_node, lungs, hearts, abdomen, urogenital_system, upper_extremities, lower_extremities, back_abnormality, hernia_2, central_nervous_system, skin_nails, speech, other, right_ear, left_ear, details, validity_period, mcus_v1.created_at as created_at');
		$this->db->from('mcus_v1');
		$this->db->join('mcus_v2', 'mcus_v2.medical_record_number=mcus_v1.medical_record_number', 'left');
		$this->db->join('patients', 'patients.id=mcus_v1.id_patient', 'left');
		$this->db->join('companies', 'companies.id=patients.id_company', 'left');
		$this->db->join('clinics', 'clinics.id=mcus_v1.id_clinic', 'left');
		$this->db->where('mcus_v1.medical_record_number', $medical_record_number);
		return $this->db->get()->row_array();
	}

	function get_total_data_mcu_today($keyword = null)
	{
		date_default_timezone_set("Asia/Jakarta");
		
		if ($keyword) {
			$this->db->like('medical_record_number', $keyword);
			$this->db->or_like('mcu_manual', $keyword);
			$this->db->or_like('id_number_patient', $keyword);
			$this->db->or_like('name_patient', $keyword);
		}

		if ( $this->session->userdata('role') == 'superuser' ) {
			return $this->db->get_where('mcus_v1', ["DATE_FORMAT(mcus_v1.created_at,'%Y-%m-%d')" => date('Y-m-d')])->num_rows();
		} else {
			return $this->db->get_where('mcus_v1', ["DATE_FORMAT(mcus_v1.created_at,'%Y-%m-%d')" => date('Y-m-d'), 'id_clinic' => $this->session->userdata('site')])->num_rows();
		}
	}

	function get_data_mcu_today($limit, $start, $keyword = null)
	{
		date_default_timezone_set("Asia/Jakarta");

		$this->db->select('mcus_v1.id as id, mcus_v1.medical_record_number as medical_record_number, mcu_manual, id_clinic, id_patient, id_number_patient, name_patient, no_transaction, type_examination, is_fit, date_examination, qrcode, passport_number, gender, place_of_birth, date_of_birth, patients.address as address, basic_safety_training, nationality, id_company, occupation, image, companies.name as company_name, validity_period, mcus_v1.created_at as created_at');
		if ($keyword) {
			$this->db->like('medical_record_number', $keyword);
			$this->db->or_like('mcu_manual', $keyword);
			$this->db->or_like('id_number_patient', $keyword);
			$this->db->or_like('name_patient', $keyword);
		}
		$this->db->from('mcus_v1');
		$this->db->join('patients', 'patients.id=mcus_v1.id_patient', 'left');
		$this->db->join('companies', 'companies.id=patients.id_company', 'left');
		if ( $this->session->userdata('role') == 'superuser' ) {
			
		} else {
			$this->db->where('id_clinic', $this->session->userdata('site'));
		}
		$this->db->where("DATE_FORMAT(mcus_v1.created_at,'%Y-%m-%d')", date('Y-m-d'));
		$this->db->order_by('mcus_v1.created_at DESC');
		$this->db->limit($limit, $start);
		return $this->db->get()->result_array();
	}

	function store_to_table_mcus_v1($data)
	{
		$this->db->insert('mcus_v1', $data);

		return TRUE;
	}

	function update_table_mcus_v1($medical_record_number, $data)
	{
		$this->db->update('mcus_v1', $data, array('medical_record_number' => $medical_record_number));

		return TRUE;
	}

	function store_to_table_mcus_v2($data)
	{
		$this->db->insert('mcus_v2', $data);

		return TRUE;
	}

	function update_table_mcus_v2($medical_record_number, $data)
	{
		$this->db->update('mcus_v2', $data, array('medical_record_number' => $medical_record_number));

		return TRUE;
	}

	function store_to_table_transactions($data)
	{
		$this->db->insert('transactions', $data);

		return TRUE;
	}

	function update_table_transactions($medical_record_number, $data)
	{
		$this->db->update('transactions', $data, array('medical_record_number' => $medical_record_number));

		return TRUE;
	}

	function get_medical_record_number($type)
	{
		date_default_timezone_set("Asia/Jakarta");
		$bulan = date('m');
		$tahun = date('Y');

		$q  = $this->db->query("SELECT MAX(RIGHT(medical_record_number,5)) AS kd_max FROM mcus_v1 WHERE MONTH(created_at)='$bulan' AND YEAR(created_at)='$tahun' AND type_examination='$type'");
		$kd = "";
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $k) {
				$tmp = ((int)$k->kd_max) + 1;
				$kd  = sprintf("%05s", $tmp);
			}
		} else {
			$kd = "00001";
		}

		if ($type == 'umum') {
			return "CLC-UMUM-" . date('ym') . $kd;
		} elseif ($type == 'rev') {
			return "CLC-REV-" . date('ym') . $kd;
		} elseif ($type == 'mcu') {
			return "CLC-MCU-" . date('ym') . $kd;
		}
	}

	function get_no_transaction($id_patient, $type)
	{
		date_default_timezone_set("Asia/Jakarta");
		$bulan = date('m');
		$tahun = date('Y');

		$q  = $this->db->query("SELECT MAX(RIGHT(no_transaction,4)) AS kd_max FROM transactions WHERE MONTH(created_at)='$bulan' AND YEAR(created_at)='$tahun' AND type_examination='$type'");
		$kd = "";
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $k) {
				$tmp = ((int)$k->kd_max) + 1;
				$kd  = sprintf("%05s", $tmp);
			}
		} else {
			$kd = "0001";
		}

		if ($type == 'umum') {
			return "INV-UMUM-" . date('ym') . '-' . $id_patient . '-' . $kd;
		} elseif ($type == 'rev') {
			return "INV-REV-" . date('ym') . '-' . $id_patient . '-' . $kd;
		} elseif ($type == 'mcu') {
			return "INV-MCU-" . date('ym') . '-' . $id_patient . '-' . $kd;
		}
		
	}

}
