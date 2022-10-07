<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function carddata($_for){
		$data = [
			"token"=> getToken(),
		];
		if($_for > 0 && $_for <= 3){
			$data['data'] =[
				[
					"title" => 'total employees',
					"count" => get_count('employee', 3),
					"icon" => 'fa- fa-user',
					"img" => '',
					"bg-color" => 'bg-aqua',
				],
				[
					"title" => 'total clients',
					"count" => get_count('clients', 3),
					"icon" => '',
					"img" => 'https://www.demohub.co.in/ecaps/assets/dist/img/icons/d.png',
					"bg-color" => 'bg-red',
				],
				[
					"title" => 'total products',
					"count" => get_count('product', 3),
					"icon" => 'fa fa-cart',
					"bg-color" => 'bg-green',
				],
				[
					"title" => 'total orders',
					"count" => get_count('orders', 3),
					"icon" => 'fa- fa-list',
					"bg-color" => 'bg-yellow',
				],
				[
					"title" => 'new orders',
					"count" => get_order_count('new', $_for),
					"icon" => 'fa fa-item',
					"bg-color" => 'bg-green',
				],
				[
					"title" => 'redo orders',
					"count" => get_order_count('redo', $_for),
					"icon" => 'fa fa-cart',
					"bg-color" => 'bg-red',
				],
				[
					"title" => 'currection orders',
					"count" => get_order_count('correction', $_for),
					"icon" => 'fa fa-tick',
					"bg-color" => 'bg-yellow',
				],

				[
					"title" => 'total invoices',
					"count" => total_invoices($_for),
					"icon" => 'fa fa-file',
					"bg-color" => 'bg-yellow',
				],

				[
					"title" => 'total challans',
					"count" => total_challans('correction', $_for),
					"icon" => 'fa fa-file',
					"bg-color" => 'bg-yellow',
				],

				[
					"title" => 'total invoice amount',
					"count" => number_format(total_invoice_amount($_for), 2),
					"icon" => 'fa fa-amount',
					"bg-color" => 'bg-green',
				],
			]; 
		}
		response(200, $data);
	}
}