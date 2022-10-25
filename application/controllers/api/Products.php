<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
	private $data;
	function __Construct(){
		parent::__Construct();
		$this->load->model('product/product_m','pm');
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
				$this->liatAllProducts($this->input->get('q'));
                break;
			case "POST":
				$this->addorupdate();
				break;
			case "PUT":
				$this->addorupdate(true);
				break;
			case "DELETE":
				$this->deleteProduct();
				break;
        }
    }

	// Options
	function options($category = false){
		$res = $this->pm->options($category);
		SuccessResponse("request", $res ? $res : []);
	}

    // Get Companey Details
    private function liatAllProducts($id = false){
        $res = $this->pm->liatAllProducts($id);
        SuccessResponse("request", $res ? $res : "No Data Found");
    }

    private function addorupdate($is_type = false){
        $arr = [
            "title" => $this->data->title,
            "code" => $this->data->code,
            "legancy_code" => $this->data->legancy_code,
            "desc" => $this->data->desc,
            "group" => $this->data->group,
            "brand" => $this->data->brand,
            "warranty" => $this->data->warranty,
            "category" => $this->data->category,
            "type" => $this->data->type,
            "unit_price" => $this->data->unit_price,
            "added_at" => date('Y-m-d H:i:s')
        ];

        if($is_type){            
            $res = $this->pm->addorupdate($arr, $this->input->get('q'));
            if(empty($res))
                SuccessResponse("Updated", $res);
			else
				FailedResponse($res);
		} else {
			$res = $this->pm->addorupdate($arr);
			if(!empty($res)){
				SuccessResponse("Added", $res);
			}
			else
				FailedResponse($res);
		}
		
    }
	
	private function deleteProduct(){
		$res = $this->pm->deleteProduct($this->input->get('q'), $this->input->get('status'));
		if(empty($res['code']))
			SuccessResponse($this->input->get('status') == 1? "De-Activated" : "Activated");
		else
			FailedResponse();
	}

}