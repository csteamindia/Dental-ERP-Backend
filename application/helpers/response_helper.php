<?php  defined('BASEPATH') OR exit('No direct script access allowed');

function SuccessResponse($message, $data = null){
    $res['message'] = $message." Succefully";
    $res['status'] = 200;
    if(!empty($data)) $res['response'] = $data;
    
    response(200, $res);
}

function FailedResponse($data = false, $status = 500){
    $res['message'] = !empty($data) ? $data : "Somthing worng";
    response($status, $res);
}

function response($status, $message){
    $ci = &get_instance();
    return $ci->output
        ->set_content_type('application/json')
        ->set_status_header($status)
        ->set_output(
            json_encode($message)
        );
}