<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product_m extends CI_Model {
    private $table = 'product';

    function __constuct(){
		parent::__constuct();
	}

    function liatAllProducts($id = false){
        $this->db->select('p.*, b.brand as abrand, c.title as acategory, g.group as agroup, t.title as atype, w.title as awarranty')->from($this->table.' as p')->join('productbrand as b', 'b.id = p.brand', 'left')->join('productgroup as g', 'g.id = p.group', 'left')->join('productcategory as c', 'c.code = p.category', 'left')
		->join('producttype as t', 't.code = p.type', 'left')->join('warranty as w', 'w.id = p.warranty', 'left');
        
        if(!empty($id))
            $this->db->where('p.id', $id);

        return $this->db->get()->result();
	}

    function addorupdate($data, $id = false){
        if(empty($id))
            return $this->db->insert($this->table, $data) ? $this->db->where('id', $this->db->insert_id())->get($this->table)->row() : false;
        else{
            $this->db->set($data)->where('id', $id)->update($this->table);
            return $this->db->affected_rows() ? $this->db->set($data)->where('id', $id)->get($this->table)->row() : false;
        }
    }

    function deleteProduct($id, $status){
        $this->db->set('status', $status)->where('id', $id)->update($this->table);
        if($this->db->affected_rows()) return true;
        else return $this->db->error();
    }

    // Get Product Category Options
    function options($type = false)
    {
        $t = '';
        $where = '';

        switch($type){
            case 'types':
                $t = 'producttype';
                $where = ["product_category" => $this->input->get('q')];
                break;
            default:
                $t = 'productcategory';
                break;
        }

        if($type == 'product'){
            return $this->db->select('p.code, p.title, p.unit_price as price, cp.discount')
            ->from('product as p')
            ->join('client_products as cp', 'cp.product_id = p.code', 'inner')
            ->where('p.type', $this->input->get('q'))
            ->where(['cp.client_id' => 1, 'p.status' => 0])->get()->result();
        }
        
	

        $this->db->select('code, title')->from($t)->where('status', 0);

        if($where){
            $this->db->where($where);
        }
        
        return $this->db->get()->result();
    }
}