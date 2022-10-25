<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Clients_m extends CI_Model {
    private $table = 'clients';
	function __constuct(){
		parent::__constuct();
    }

    function getAllClients($id = false){
        if($id)
            $this->db->where('id', $id);
            
        return $this->db->get($this->table)->result();
    }

    function addorupdate($data, $id = false){
        if(empty($id))
            return $this->db->insert($this->table, $data) ?$this->db->where('id', $this->db->insert_id())->get($this->table)->row() : false;
        else{
            $this->db->set($data)->where('id', $id)->update($this->table);
            return $this->db->affected_rows() ? $this->db->set($data)->where('id', $id)->get($this->table)->row() : false;
        } 
    }

    function deleteClient($id, $status){
        $this->db->set('status', $status)->where('id', $id)->update($this->table);
		return $this->db->affected_rows();
    }

    function getClientOptions(){
        return $this->db->select('clientname as label, code as value')->where('status', 0)->get(CLIENTS)->result();
    }

}