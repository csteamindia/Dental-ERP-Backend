<?php defined('BASEPATH') or exit('No direct script access allowed');

/***
 * Challan Helper Methods 
 * @date : 25/10/2022
 * @author CSTEAMINDIA
 */


/**
 * GetNew Challan Number Helper
 * @return string Challan Number
 */
function GetChallanNumber()
{
    $ci = &get_instance();
    $res = $ci->db->select('MAX(id) as challan_number')->get(SHIPMENTS)->row()->challan_number;
    return $res + 1;
}