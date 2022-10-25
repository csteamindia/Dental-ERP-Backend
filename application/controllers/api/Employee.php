<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {
	private $data;

	function __Construct(){
		parent::__Construct();
		$this->load->model('org/Employee_m','emp');
		$this->data = getBodyData();
		// $this->load->library('excel');
    }

    /***
	* Add New Company or Get Company Details
	*/
	function index(){
        $data = ["token"=> getToken()];
        $data['data'] = json_encode($this->input->server('REQUEST_METHOD'));

        switch($this->input->server('REQUEST_METHOD')){
            case "GET":
				$this->listAllEmployees($this->input->get('q'));
                break;
			case "POST":
				$this->addorupdate();
				break;
			case "PUT":
				$this->addorupdate(true);
				break;
			case "DELETE":
				$this->deleteEmployee();
				break;		
        }
    }

    private function listAllEmployees($id = false){
        try{
            $res = $this->emp->getAllEmpoloyees($id);
            SuccessResponse("request", $res ? $res : "No Data Found");
        }catch(Expection $e){
            FailedResponse();
        }
    }

    private function addorupdate($is_type = false){
        $arr = [
            "firstname" => $this->data->firstname,
            "middlename" => $this->data->middlename, 
            "lastname" => $this->data->lastname,
            "gender" => $this->data->gender ,
            "code" => $this->data->code,
            // "=>mage" : $this->data->image,
            "mobile" => $this->data->mobile,
            "phone" => $this->data->phone,
            "dob" => $this->data->dob,
            "doj" => $this->data->doj,
            "email" => $this->data->email,
            "role" => $this->data->role,
            "shift" => $this->data->shift, 
            "shiftgroup" => $this->data->shiftgroup, 
            "designaation" => $this->data->designaation, 
            "department" => $this->data->department,
            "lab_department" => $this->data->lab_department, 
            "location" => $this->data->location, 
            "pan" => $this->data->pan,
            "uid" => $this->data->uid,
            "address1" => $this->data->address1, 
            "address2" => $this->data->address2
		];

        if($is_type) {
			try{
				$res = $this->emp->addorupdate($arr, $this->input->get('q'));
				if($res){
					SuccessResponse("Updated",$res);
				}else{
					FailedResponse();
				}
			}catch(Expection $e){
				FailedResponse();
			}
		} else {
			try{
				$res = $this->emp->addorupdate($arr);
				if($res) SuccessResponse("Added", $res);
			}catch(Expection $e){
				FailedResponse();
			}
		}
    }
    
    private function deleteEmployee(){
        try{
			if($this->emp->deleteEmployee($this->input->get('q'), $this->input->get('status'))){
				SuccessResponse($this->input->get('status') == 1? "De-Activated" : "Activated");
			}else{
				FailedResponse();
			}
		}catch(Exception $e){
			FailedResponse();
		}
    }

}