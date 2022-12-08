<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Clients_m extends CI_Model {
    private $table = 'clients';
	function __constuct(){
		parent::__constuct();
    }

    function getAllClients($id = false){
        if($id)
            $this->db->where('c.id', $id);

        $this->db->select('c.*, s.title as state, s.id as state_id, con.title as country, con.id as country_id, ci.title as city, ci.id as city_id, station.title as station, station.id as station_id')
        ->from($this->table.' as c')
        ->join('cities as ci', 'ci.id = c.city', 'inner')
        ->join('states as s', 's.id = c.state', 'inner')
        ->join('country as con', 'con.id = c.country', 'inner')
        ->join('stations as station', 'station.id = c.station', 'inner');

        return $this->db->order_by('c.id', 'asc')->get()->result();
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