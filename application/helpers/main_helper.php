<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once 'vendor/autoload.php';

use \Firebase\JWT\JWT;


if (!method_exists($this, 'response')) {
    function response($message, $code = 200)
    {
        http_response_code($code);
        echo json_encode($message);
        die;
    }
}

if (!method_exists($this, 'httpmethod')) {
    function httpmethod($method = 'POST')
    {
        return $_SERVER['REQUEST_METHOD'] == $method;
    }
}

if (!method_exists($this, 'sessiondata')) {
    function sessiondata($index = 'login', $kolom = null)
    {
        // if (!is_login())
        //     return;
        /** @var CI_Controller $CI */
        $CI = &get_instance();

        $data = $CI->session->userdata($index);

        return empty($kolom) ? $data : $data[$kolom];
    }
}

if (!method_exists($this, 'waktu')) {
    function waktu($waktu = null, $format = MYSQL_TIMESTAMP_FORMAT)
    {
        $waktu = empty($waktu) ? time() : $waktu;
        return date($format, $waktu);
    }
}
if (!method_exists($this, 'config_sidebar')) {
    function config_sidebar($configName = 'comp', $sidebar, int $activeMenu = 0, $subMenuConf = null)
    {
        /** @var CI_Controller $ci */
        $ci = &get_instance();

        $ci->load->config($configName);
        $compConf = $ci->config->item('comp');
        $sidebarConf = $compConf['dore']['sidebar'][$sidebar];
        $sidebarConf['menus'][$activeMenu]['active'] = true;

        if (!empty($subMenuConf)) {
            $sidebarConf['subMenus'][$subMenuConf['sub']]['menus'][$subMenuConf['menu']]['active'] = true;
        }
        return $sidebarConf;
    }
}

if (!method_exists($this, 'random')) {
    function random($length = 5, $type = 'string')
    {
        $characters = $type == 'string' ? '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' : '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $type == 'string' ? $randomString : boolval($randomString);
    }
}
if (!method_exists($this, 'is_login')) {
    function is_login($role = null, $user = null)
    {
        /** @var CI_Controller $ci */
        $ci = &get_instance();

        if (!JWT_AUTH)
            $userdata = $ci->session->userdata('login'); //sessiondata('login')
        else {
            $token = isset($_POST['_token']) ? $_POST['_token'] : null;
            list($isLogin, $data) = verfify_token($token);
        }
        if (!empty($userdata) && SYNC_DATAUSER) {
            $u  = $ci->db->select('users.username, users.role, users.photo,profile.*')
                ->where('username', $userdata['username'])
                ->where('email', $userdata['email'])
                ->from('users')->join('profile', 'users.id = profile.uid')
                ->get()->result_array();
            $ci->db->reset_query();
            if (count($u) > 1 || empty($u))
                return false;
            else
                $ci->session->set_userdata(['login' => $u[0]]);

            $userdata = $ci->session->userdata('login');
        }

        if (empty($role) && empty($user)) {
            if (JWT_AUTH)
                return $isLogin;
            else
                return !empty($userdata);
        } elseif (!empty($userdata) && !empty($role) && empty($user)) {
            if (JWT_AUTH)
                return $data['role'] == $role;
            elseif (!JWT_AUTH && $role == 'bendahara')
                return $userdata['role'] == 'bendahara 1' || $userdata['role'] == 'bendahara 2';
            elseif (!JWT_AUTH && $role == 'admin')
                return $userdata['role'] == 'admin';
            elseif (!JWT_AUTH && $role != 'bendahara')
                return $userdata['role'] == $role;
        } elseif (!empty($userdata) && empty($role) && !empty($user)) {
            if (JWT_AUTH)
                $data['username'] == $user;
            else
                return $userdata['username'] == $user;
        } elseif (!empty($userdata) && !empty($role) && !empty($user)) {
            if (JWT_AUTH)
                return $data['username'] == $user && $data['role'] == $role;
            else
                return $userdata['username'] == $user && $userdata['role'] == $role;
        }
    }
}

if (!method_exists($this, 'verify_token')) {

    function verfify_token($token)
    {
        if (empty($token)) {
            response(['messaage' => 'Token kosong!', 'type' => 'error'], 500);
        }

        try {
            $data = JWT::decode($token, 'BQNIT', array('HS256'));
            return [true, $data];
        } catch (\Throwable $err) {
            response(['messaage' => 'Token Invalid!', 'type' => 'error', 'error' => $err], 500);
        }
    }
}

if (!method_exists($this, 'addResourceGroup')) {
    function addResourceGroup($name, $type = null, $pos = null)
    {
        $type = empty($type) ? 'semua' : $type;
        $pos = empty($pos) ? 'head' : $pos;

        /** @var CI_Controller $ci */
        $ci = &get_instance();
        $isLoaded = $ci->load->config('themes');
        $resourceText = '';
        $configitem = $ci->config->item('themes');
        if ($type == 'semua') {
            if (!$isLoaded || empty($configitem[$name]))
                return null;

            foreach ($configitem[$name] as $k => $v) {
                foreach ($v as $resource) {
                    if(isset($resource['type']) && $resource['type'] == 'cdn')
                        $resource['src'] = $resource['src'];
                    else
                        $resource['src'] = base_url('public/assets/' . $resource['src']);
                    if ($k == 'js')
                        $resourceText .= $resource['pos'] == $pos ? "<script src='{$resource['src']}'></script>" : null;
                    elseif ($k == 'css')
                        $resourceText .= $resource['pos'] == $pos ? "<link rel='stylesheet' href='{$resource['src']}'></link>" : null;
                }
            }
        } else {
            if (!$isLoaded || empty($configitem[$name][$type]))
                return null;
            foreach ($configitem[$name][$type] as $k => $v) {
                if(isset($v['type']) && $v['type'] == 'cdn')
                        $v['src'] = $v['src'];
                    else
                        $v['src'] = base_url('public/assets/' . $v['src']);
                        
                if ($type == 'js') {
                    if ($v['pos'] == $pos)
                        $resourceText .= "<script src='{$v['src']}'></script>";
                }
                if ($type == 'css') {
                    if ($v['pos'] == $pos)
                        $resourceText .= "<link rel='stylesheet' href='{$v['src']}'></link>";
                }
            }
        }
        return $resourceText;
    }
}

if (!method_exists($this, 'include_view')) {
    function include_view($path, $data = null)
    {
        if (is_array($data))
            extract($data);

        include APPPATH . 'views/' . $path . '.php';
    }
}

if (!method_exists($this, 'rupiah_format')) {
    function rupiah_format($angka)
    {
        $hasil_rupiah = "Rp. " . number_format($angka, 2, ',', '.');
        return $hasil_rupiah;
    }
}
