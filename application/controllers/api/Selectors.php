<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Selectors extends CI_Controller {
	function __Construct(){
		parent::__Construct();
		$this->load->model('org/clients_m','cm');
		$this->data = getBodyData();
		$this->table = $this->input->get('access_type');
	}

    function getClientsOptions(){
        $res = $this->cm->getClientOptions();
        SuccessResponse("request", $res ? $res : "No Data Found");
    }

}