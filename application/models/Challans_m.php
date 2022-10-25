<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Challans_m extends CI_Model {
	function __constuct(){
		parent::__constuct();
	}

	/**
	* All Orders List
	*/
	function GetChallans(){
		$this->db->select("o.id, o.order_number, DATE_FORMAT(o.order_date, '%d-%m-%Y') as order_date, c.clientname, o.case_no, o.status, DATE_FORMAT(o.due_date, '%d-%m-%Y') as due_date, o.order_value, o.patient_name as patient, o.worktype as status");
		$this->db->from(ORDERS.' as o');
		$this->db->join(CLIENTS.' as c', 'c.code = o.client', 'inner');
		return $this->db->where('o.is_challan', 0)->get()->result();
	}
}
