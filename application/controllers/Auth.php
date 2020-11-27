<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    function index()
    {
        $data = array(
            'resource' => array('main', 'dore')
        );


        $this->add_cachedJavascript('js/pages/login.js');

        $this->addViews(array('head/main', 'pages/login', 'foot/main'), $data);
        $this->render();
    }

    function login()
    {
        if (!httpmethod())
            response(['message' => 'ERROR, Tidak ada method Login [GET]', 'type' => 'error'], 405);

        if (is_login())
            response(['message' => 'Anda sudah login', 'type' => 'error'], 401);

        $this->load->library('Authentication');
        $post =& $_POST;
        list($input) = $this->authentication->persiapan($post);
        $this->authentication->login($input);
    }

    function logout(){
        if (!httpmethod())
            response(["message" => "Error, Tidak ada method logout[GET]", "type" => 'error'], 405);

        if (!is_login())
            response(['message' => 'Anda belum login', 'type' => 'error'], 401);

        try {
            $this->session->unset_userdata('login');
            response(['message' => 'Anda berhasil logout', 'type' => 'success'], 200);
        } catch (\Throwable $th) {
            response(['message' => 'Gagal, Terjadi kesalahan', 'type' => 'error', 'err' => $th], 500);
        }
    }
}
