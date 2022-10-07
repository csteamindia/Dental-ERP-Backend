<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {
	private $data;
	function __Construct(){
		parent::__Construct();
		$this->load->model('org/Company_m','cm');
		$this->data = getBodyData();
	}

    /***
	* Add New Company or Get Company Details
	*/
	function index(){
        $data = ["token"=> getToken()];
        $data['data'] = json_encode($this->input->server('REQUEST_METHOD'));

        switch($this->input->server('REQUEST_METHOD')){
            case "GET":
				$this->liatAllCompanies($this->input->get('q'));
                break;
			case "POST":
				$this->addorupdate();
				break;
			case "PUT":
				$this->addorupdate(true);
				break;
			case "DELETE":
				$this->deleteCompany();
				break;
				
        }
   }
    
    // Get Companey Details
    private function liatAllCompanies($id = false){
        try{
			$res = $this->cm->getAllComapnies($id);
			SuccessResponse("request", $res ? $res : "No Data Found");
		}catch(Expection $e){
			FailedResponse();
		}
    }

    private function addorupdate($is_type = false){
		$arr = [
			"title" => $this->data->title,
			"mobile" => $this->data->mobile,
			"tel" => $this->data->tel,
			"email" => $this->data->email,
			"fax" => $this->data->fax,
			"pan" => $this->data->pan,
			"gst" => $this->data->gst,
			"cin" => $this->data->cin,
			"website" => $this->data->website,
			"address" => $this->data->address
		];

        if($is_type) {
			try{
				$res = $this->cm->addorupdate($arr, $this->input->get('q'));
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
				$res = $this->cm->addorupdate($arr);
				if($res) SuccessResponse("Added", $res);
			}catch(Expection $e){
				FailedResponse();
			}
		}
		
    }
	
	private function deleteCompany(){
		try{
			if($this->cm->deleteCompany($this->input->get('q'), $this->input->get('status'))){
				SuccessResponse($this->input->get('status') == 1? "De-Activated" : "Activated");
			}else{
				FailedResponse();
			}
		}catch(Exception $e){
			FailedResponse();
		}
	}

}