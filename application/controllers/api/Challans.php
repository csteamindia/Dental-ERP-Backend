<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Challans extends CI_Controller {

	function __Construct(){
		parent::__Construct();
		$this->load->model('challans_m');
		$this->data = getBodyData();
	}

    /***
     * Add Challan or Get Challan Details
     */
	function index(){
        $data = ["token"=> getToken()];
        $data['data'] = json_encode($this->input->server('REQUEST_METHOD'));

        switch($this->input->server('REQUEST_METHOD')){
            case "GET":
				$this->listAllChallans();
                break;
            case "POST":
				$this->newChallan();
                break;
        }
    }

    /***
     * Get All Challans
     */
    function listAllChallans(){
        $data = $this->challans_m->GetChallans();
        SuccessResponse("request", ['challans' => $data, 'doctors' => $this->GetClientOptions()]);
        return;
    }

    /***
     * Create Challans
     */
    private function newChallan(){
        $ChallanNumber = get_challan_number();
        foreach ($this->input->post('orders') as $orderNumber) {
            $arr = [
                    'shipment_date' => date('Y-m-d', strtotime($this->input->post('createdate'))),
                    'shipment_note' => $this->inpput->post('note'),
                    'delivery_mode' => $this->input->post('deliveryMode'),
                    'order_id' => $orderNumber,
                    'challan_number' => $ChallanNumber,
                    'bulk' => 1,
                    'added_at' => date('Y-m-d H:i:s'),
                    'added_by' => login_user(),
                ];
            if ($this->db->insert('shipments', $arr)) {
                $this->db->set('is_challan', 1)->where('order_number', $o)->update('orders');
                $isc = true;
            }
        }
    }

    private function GetClientOptions(){
        return GetClientOptionsHelper();
    }

}