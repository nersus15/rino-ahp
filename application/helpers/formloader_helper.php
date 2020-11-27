<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!method_exists($this,'field')){
    function fieldmapping($config, $input){

        /** @var CI_Controller $ci */
        $ci =& get_instance();
        $isLoaded = $ci->load->config('forms');
        $configitem = $ci->config->item('form');
        $field = array();
        if(!$isLoaded || empty($configitem[$config]))
            response(['message' => 'Config form ' . $config . ' Tidak ditemukan'], 404);
        foreach($configitem[$config] as $k => $v){
            if(isset($input[$k]))
                $field[$v] = html_escape($input[$k]);
        }
        return $field;
    }
}
