<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {
	private $data;

	function __Construct(){
		parent::__Construct();
		$this->load->model('order_m','pm');
		$this->data = getBodyData();
	}
    
    function getcasenumber(){
        $res = $this->db->select('case_no, order_number')->order_by('id', "desc")->limit(1)->get(ORDERS)->row();
        SuccessResponse("fetch successfully", $res);
    }

    function getJobCard($orderNumber){
        $res = $this->db->where('order_number', $orderNumber)->get(ORDERS)->row();
        SuccessResponse("request", $res);
        return;
    }
    
    /***
	* Add New Company or Get Company Details
	*/
	function index(){
        $data = ["token"=> getToken()];
        $data['data'] = json_encode($this->input->server('REQUEST_METHOD'));

        switch($this->input->server('REQUEST_METHOD')){
            case "GET":
				$this->listAllOrders();
                break;
            case "POST":
				$this->newOrder();
                break;
        }
    }

    private function newOrder(){
        try{
            $this->db->trans_begin();

            $object = [
                'order_date' => date(
                    'Y-m-d H:i:s',
                    strtotime($this->data->order_date)
                ),
                'due_date' => date(
                    'Y-m-d H:i:s',
                    strtotime($this->data->due_date)
                ),
                'client' => $this->data->client,
                'patient_name' => $this->data->patient_name,
                'patient_age' => $this->data->patient_age,
                'in_date' =>  date(
                    'Y-m-d H:i:s',
                    strtotime($this->data->in_date)
                ),
                'department' => $this->data->lab_department,
                'manufacture' => $this->data->manufacturer,
                'delivery' => $this->data->drop_location,
                'priority' => $this->data->priority,
                'note' => $this->data->shade_note,
                'trial' => json_encode($this->data->trials),
                'assign' => $this->data->employee,
                'worktype' => 'new',
                'enclosure' => json_encode($this->data->enclosure),
                'doctor' => $this->data->sub_doctor,
                'location' => $this->data->drop_location,
                'correction_template' => $this->data->correction_template,
                'shade' => json_encode($this->data->shades),
                'shade_node' => $this->data->shade_note,
                'articular' => $this->data->articulator_tag,
                'units' => $this->data->units,
                'order_value' => $this->data->orderValue
            ];

            if($this->data->order_id == null){
                $object['order_number'] = $this->generateOrderNumber($this->data->client);
                $object['case_no'] = $this->data->case_no;
                if($this->db->insert(ORDERS, $object)){
                    $products = $this->data->products;
                    $productsObject = [];
        
                    foreach($products as $product){
                        $productsObject[] = [
                            "order_id" => $object['order_number'],
                            "product_id" => $product->productList,
                            "product_type" => $product->categoryType,
                            "product_category" => $product->category,
                            "teeth" => json_encode($product->teeth),
                            "unit" => sizeof($product->teeth),
                            "unit_price" => $product->unitPrice,
                            "discount" => 0,
                            "total_amount" => sizeof($product->teeth) * $product->unitPrice,	
                            "options" => null
                        ];
                    }
                    if($this->db->insert_batch(ORDER_PRODUCTS, $productsObject)){
                        $this->db->trans_commit();
                        SuccessResponse("request", "Order Created Succefully");
                        return;
                    }
                }
            }else{
                $this->db->where('id', $this->data->order_id)->update(ORDERS, $object);
                $products = $this->data->products;
            }


            if ($this->db->trans_status() === false) {
                echo 'rol';
                $this->db->trans_rollback();
            }

        } catch (Expection $e) {
            FailedResponse();
        }
    }

    private function generateOrderNumber($client) {
        $num = $this->db->select('order_number')->where('client', $client)->limit(1)->order_by('id', 'desc')->get('orders_new')->row();
        return $num ? $num->order_number + 1 : date('Y').'000001';
    }

    private function listAllOrders(){
        try {
            if($this->input->get('order')){
                $res = $this->db->from('orders_new as o')->where('o.id', $this->input->get('order'))->get()->row();
                $res->products = $this->db->select('OP.teeth,OP.unit, OP.unit_price as unitPrice, PT.title as categoryTypeTitle, P.title as productListTitle, PC.title as categoryTitle')
                ->from('order_products as OP')
                ->join('producttype as PT', 'PT.code = OP.product_type', 'inner')
                ->join('productcategory as PC', 'PC.code = OP.product_category', 'inner')
                ->join('product as P', 'P.code = OP.product_id', 'inner')
                ->where('OP.order_id', $res->order_number)
                ->get()->result();
                
                SuccessResponse("request", $res ? $res : "No Data Found");
            }else{
                $count = $this->getRows(true);
                $res = $this->getRows();
                SuccessResponse("request", $count > 0  ? ['totalRows' => $count, 'rows' => $res] : "No Data Found");
            }
        } catch (Expection $e) {
            FailedResponse();
        }
    }

    private function getRows($is_count = false){
        $this->db->select('o.id, o.order_number, o.order_date, o.patient_name as patient, o.case_no, o.worktype as type, c.clientname as client, c.id as client_id, c.code as client_code');
        $this->db->from('orders_new as o');
        $this->db->join('clients as c', 'c.code = o.client', 'inner');
        $this->db->where('c.org', '1');
        if($is_count){
            return $this->db->order_by('o.id', 'desc')->get()->num_rows();
        }else{
            $this->db->limit($this->input->get('limit'), $this->input->get('page'));
            return $this->db->order_by('o.id', 'desc')->get()->result();
        }
    }

}