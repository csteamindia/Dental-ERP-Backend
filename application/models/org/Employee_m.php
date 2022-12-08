<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_m extends CI_Model {
	private $table = "employee";

    function __constuct(){
		parent::__constuct();
	}

	function getAllEmpoloyees($id = false){
		if($id){
			$this->db->distinct()->select('*');
		}else{
			$this->db->distinct()->select('e.id, e.firstname, e.middlename, e.code, e.lastname, e.email, e.mobile, e.gender, l.title as location, d.title as designation, e.status');
		}
		
		$this->db->from($this->table.' as e')
		->join('location as l', 'l.code = e.location', 'left')
		->join('designation as d', 'd.code = e.designation', 'left')
		->order_by('e.id', 'asc');
		if($id) {
			$this->db->where('e.id', $id);
		}
		return $this->db->get()->result();
	}

	function addorupdate($data, $id = false){
        if(empty($id))
            return $this->db->insert($this->table, $data) ?$this->db->where('id', $this->db->insert_id())->get($this->table)->row() : false;
        else{
            $this->db->set($data)->where('id', $id)->update($this->table);
            return $this->db->affected_rows() ? $this->db->set($data)->where('id', $id)->get($this->table)->row() : false;
        } 
    }

    function deleteEmployee($id, $status){
        $this->db->set('status', $status)->where('id', $id)->update($this->table);
        if($this->db->affected_rows()) return true;
        else return $this->db->error();
    }
}