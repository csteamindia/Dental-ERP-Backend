<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Masters extends CI_Controller {
	private $data;

	function __Construct(){
		parent::__Construct();
		$this->load->model('org/Masters_m','ms');
		$this->data = getBodyData();
		$this->table = $this->input->get('access_type');
	}

    /***
	* Add New Company or Get Company Details
	*/
	function index(){
        $data = ["token"=> getToken()];
        $data['data'] = json_encode($this->input->server('REQUEST_METHOD'));

        switch($this->input->server('REQUEST_METHOD')){
            case "GET":
				$this->liatAllMaster($this->input->get('q'));
                break;
			case "POST":
				$this->addorupdate();
				break;
			case "PUT":
				$this->addorupdate(true);
				break;
			case "DELETE":
				$this->deleteMaster();
				break;
        }
    }
  
    // Get Companey Details
    private function liatAllMaster($id = false){
		if($this->input->get('type')){
			$res = $this->ms->liatAllMasterOptions();
		}else{
			$res = $this->ms->liatAllMaster($this->table, $id);
		}

		SuccessResponse("request", $res ? $res : "No Data Found");
    }

    private function addorupdate($is_type = false){
		$arr["title"] = $this->data->title;
		$arr["code"] = $this->data->code;

		// States Master
		if(isset($this->data->country) && !empty($this->data->country))
			$arr["country"] = $this->data->country;
		
		// City Master
		if(isset($this->data->state) && !empty($this->data->state))
			$arr["state"] = $this->data->state;

		// Station Master
		if(isset($this->data->city) && !empty($this->data->city))
			$arr["city"] = $this->data->city;
			
		// Zone Master
		if(isset($this->data->locations) && !empty($this->data->locations))
			$arr["stations"] = json_encode($this->data->locations);

		// Role 
		if(isset($this->data->privileges) && !empty($this->data->privileges))
			$arr["previlize"] = json_encode($this->data->privileges);

		// shade 
		if(isset($this->data->shade) && !empty($this->data->shade))
			$arr["previlize"] = json_encode($this->data->shade);
		
			// product_category 
		if(isset($this->data->category) && !empty($this->data->category))
			$arr["product_category"] = json_encode($this->data->category);


        if($is_type) {
			$res = $this->ms->addorupdate($this->table, $arr, $this->input->get('q'));
			if(empty($res['code']))
				SuccessResponse("Updated");
			else
				FailedResponse();
				
		} else {
			$res = $this->ms->addorupdate($this->table, $arr);
			if(!empty($res))
				SuccessResponse("Added", $res);
			else
				FailedResponse($res);
		}
		
    }
	
	private function deleteMaster(){
		$res = $this->ms->deleteMaster($this->table, $this->input->get('q'), $this->input->get('status'));

		if(empty($res['code']))
			SuccessResponse($this->input->get('status') == 1? "De-Activated" : "Activated");
		else
			FailedResponse();
	}

	function privatization($role){
		$access_level = $this->db->select('previlize')->where('code', $role)->get('role')->row()->previlize;

		$accessble_menus = $this->db->get('privileges')->result();
		$menus = [];
		
		foreach ($accessble_menus as $k) {
			if($k->parent == 0)
				$menus[$k->label] = ['parent', $k->label, $k->id];
			else 
				$menus[$k->parent][] = [$k->label, $k->id];
		}

		$final_data = [];
		
		foreach($menus as $v){
			if($v[0] == 'parent'){
				$submenu = [];
				foreach($menus[$v[2]] as $sm){
					$submenu[] = [
						"title" => $sm[0],
						"id" => $sm[1],
						"is_selected" => in_array($sm[1], json_decode($access_level)) ? true : false
					];
				}

				$final_data[] = [
					"id" => $v[2],
					"title" => $v[1],
					"is_selected" => in_array($v[2], json_decode($access_level)) ? true : false,
					"submenus" => $submenu,
				];
			}
		}
		
		SuccessResponse("request", $final_data ? $final_data : "No Data Found");
	}
}