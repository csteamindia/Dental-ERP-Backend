<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login_m extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function validate($username, $password){
		$res = $this->db->select('id as user_id, username, empid, role, is_active')->where(['username' => $username, 'password' =>  $password, 'status' => 0])->get('users');
		if($res->num_rows() > 0) return $res->row();
	}
}
