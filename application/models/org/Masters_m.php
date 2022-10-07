<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Masters_m extends CI_Model {
    private $tables = [
		'm01' => 'department',
		'm02' => 'designation',
		'm03' => 'labdepartment',
		'm04' => 'country',
		'm05' => 'states',
		'm06' => 'cities',
		'm07' => 'stations',
		'm08' => 'zones',
		'm09' => 'source',
		'm10' => 'qualification',
		'm11' => 'currency',
		'm12' => 'correction_template',
		'm13' => 'role',
		'm14' => 'location',
		'm15' => 'shadeguide',
		'm16' => 'shade',
		'm17' => 'productcategory',
		'm18' => 'warranty',
		'm19' => 'productgroup',
		'm20' => 'producttype',
		'm21' => 'parent_client',
		'm22' => 'client_category',
	];

	function __constuct(){
		parent::__constuct();
    }

	function liatAllMasterOptions(){
		$res = [];
		foreach($this->tables as $key => $value){
			$res[$value] = $this->db->get($value)->result();
		}
		return $res;
	}

	function liatAllMaster($table, $id = false){
        if($id)
            $this->db->where('id', $id);
            
        return $this->db->get($this->tables[$table])->result();
    }

    function addorupdate($table, $data, $id = false){
		if(empty($id))
			return $this->db->insert($this->tables[$table], $data) ?$this->db->where('id', $this->db->insert_id())->get($this->tables[$table])->row() : false;
		else{
			$this->db->set($data)->where('id', $id)->update($this->tables[$table]);
			return $this->db->affected_rows() ? $this->db->set($data)->where('id', $id)->get($this->tables[$table])->row() : false;
		}
    }

    function deleteMaster($table, $id, $status){
        $this->db->set('status', $status)->where('id', $id)->update($this->tables[$table]);
        if($this->db->affected_rows()) return true;
        else return $this->db->error();
    }
}