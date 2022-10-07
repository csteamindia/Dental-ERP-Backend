<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	private $data;
	function __construct(){
		parent::__construct();
		$this->load->model('login_m');
		$this->data = getBodyData();
	}

	function index(){
		$username = $this->data->username;
		$password = $this->data->password;

		if(!empty($username) && !empty($password)){
			$res = $this->login_m->validate($username, $password);
			$data = [
				"access_token"=> create_web_token($res),
				"data"=> [
					"username" => $res->username,
					"user_id" => $res->user_id,
					"employee_id" => $res->empid,
					"user_role" => $res->role,
					"is_active" => $res->is_active
				]
			];

			if($res)
				SuccessResponse("Login", $data);
			else
				FailedResponse("Unauthorized", 401);
		}
	}

	function resetpassword(){
		
	}

	function changepassword($is_change = false){
		if ($this->session->userdata('username') == '')
			redirect('logout');

		if($this->is_changed_pwd($this->session->userdata('username')) == 1 && $is_change == false){
			redirect('/dashboard');
		}
		
		if($_POST){
			$this->db
			->set(['is_changed' => 1, 'password' => $_POST['password']])
			->where('username', $this->session->userdata('username'))
			->or_where('empid', $this->session->userdata('username'))
			->update('users');
			if($this->db->affected_rows() > 0){
				redirect('/logout');
			}
			return;
		}
		$this->load->view('_changepassword');
	}

	private function is_changed_pwd($user){
		return $this->db->where('username', $user)->where('is_changed', 1)->get('users')->num_rows();
	}

	function logout(){
        $this->session->sess_destroy();
        redirect('/');
	}
}
