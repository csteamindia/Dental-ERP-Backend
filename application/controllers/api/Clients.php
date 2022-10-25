
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends CI_Controller {
	private $data;
	function __Construct(){
		parent::__Construct();
		$this->load->model('org/Clients_m','c');
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
				$this->liatAllClients($this->input->get('q'));
                break;
			case "POST":
				$this->addorupdate();
				break;
			case "PUT":
				$this->addorupdate(true);
				break;
			case "DELETE":
				$this->deleteClient();
				break;
        }
   }

       
    // Get Companey Details
    private function liatAllClients($id = false){
        try{
			$res = $this->c->getAllClients($id);
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
				$res = $this->c->addorupdate($arr, $this->input->get('q'));
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
				$res = $this->c->addorupdate($arr);
				if($res) SuccessResponse("Added", $res);
			}catch(Expection $e){
				FailedResponse();
			}
		}
		
    }
	
	private function deleteClient(){
		try{
			if($this->c->deleteCompany($this->input->get('q'), $this->input->get('status'))){
				SuccessResponse($this->input->get('status') == 1? "De-Activated" : "Activated");
			}else{
				FailedResponse();
			}
		}catch(Exception $e){
			FailedResponse();
		}
	}
    

}
