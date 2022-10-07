<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Checksession {
    
	function is_valid_session(){
		$this->config();
		if($this->ci->session->userdata('is_login') == true){
			$this->ci->session->set_userdata('session_login_key', rand(999999999999999999, 111111111111111111));
		}else{
			$this->ci->session->set_userdata('is_login', false);
		}
	}


	function isTokenValid(){
		header('Access-Control-Allow-Origin: http://localhost:3000');
		header("Access-Control-Expose-Headers: Content-Length, X-JSON");
		header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Authorization, Accept, Accept-Language, X-Authorization");
		header('Access-Control-Max-Age: 86400');

		if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
			header("HTTP/1.1 200 OK");
			return;
		}

		if($_SERVER['REQUEST_URI'] != '/demo/login'){
			require_once APPPATH.'helpers/jwt_helper.php';
			require_once APPPATH.'helpers/basic_helper.php';
			$headers = apache_request_headers();
			$res = decode_web_token($headers['Authorization']);
			if($res[0] === false){
				header("HTTP/1.1 401 Unauthorized");
				echo json_encode([
					"status" => 401,
					"message" => "Invalid token"
				]);
				die();
			}
		}
	}
	
	//Check Ip Address is Allow or Not
	function is_valid_ip(){
	    $url = $_SERVER['REQUEST_URI'];
		$blockedIps = array('103.199.175.253','183.87.104.125', '103.100.16.251', '115.96.221.196', '103.100.16.252', '103.100.16.249');
        $currentUserIp = $_SERVER['REMOTE_ADDR'];
        if($url != '/validate/warrantycard'){
            if(!in_array($currentUserIp, $blockedIps)){
                header("Location: page-not-found");
                die(); 
            } 
        }
	}
	
	//Load Session Library
	private function config(){
		$this->ci = &get_instance();
        // if (!isset($this->ci->session)){
        //     $this->ci->load->library('session');
        // }
	}
}