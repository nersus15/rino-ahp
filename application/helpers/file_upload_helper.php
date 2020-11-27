<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function uploadImage($file, $iname, $type = 'profile')
{
    $file = explode('.', $file['name']);
    $file_name = uniqid(8) . '.'.$file[count($file) - 1];
    if($type == 'profile')
        $config['upload_path'] = ASSETS_PATH  . 'public/assets/img/profile/';
    if($type == 'thumb')
        $config['upload_path'] = ASSETS_PATH  . 'public/assets/img/barang/';

    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size'] = '';
    $config['file_name'] = $file_name;
    // var_dump($_SERVER['DOCUMENT_ROOT'] . '/public/img/profile/');
    /** @var CI_Controller $ci */
    $ci =& get_instance();
    $ci->load->library('upload', $config);  
    $ci->upload->initialize($config);

    if (!$ci->upload->do_upload($iname)) {
        response(['message' => print_r($ci->upload->display_errors(), true), 'type' => 'error'], 500);
    }

    return $file_name;
}
