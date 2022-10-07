<?php  defined('BASEPATH') OR exit('No direct script access allowed');
	
require_once APPPATH.'libraries/JWT.php';


function create_web_token($data){
    $jwt = new JWT();
    return $jwt->encode($data, '123', 'HS256');
}

function decode_web_token($token){
    $jwt = new JWT();
    try{
        $res = $jwt->decode($token, '123', 'HS256');
        return [true, $res];
    }
    catch(Exception $e){
        return [false, $e->getMessage()];
    }
}