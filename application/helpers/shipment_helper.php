<?php  defined('BASEPATH') OR exit('No direct script access allowed');
	
	/***
		* Challan or Shipment Data by Order id (primary key)
		-- rpd_shipemts
			-order_id
	*/
	function get_challan($od){
		$ci = &get_instance();
		return $ci->db->where('order_id', $od)->get(SHIPMENTS)->row();
	}

	function get_title_priority($id){
		$ci = &get_instance();
		return $ci->db->select('title')->where('id', $id)->get(PRIORITY)->row('title');
	}
	
	function get_challan_number(){
		$ci = &get_instance();
		$res = $ci->db->select('MAX(id) as no')->get(SHIPMENTS)->row()->no;
		return $res + 1;
	}