<?php defined('BASEPATH') or exit('No direct script access allowed');

class Ws extends CI_Controller{
    /** @var Authentication */
    var $authenticatioin;

    function login(){
        if(is_login())
            redirect('admin/login');
        $this->load->library('Authentication');

        if(!httpmethod())
            response("Metode akses ilegal");

        list($input) = $this->authentication->persiapan($_POST);
        $this->authentication->login($input);
    }
    function update_profile(){
        if(!httpmethod())
            response("Metode akses ilegal", 403);
        if(!is_login())
            response("Anda belum login", 403);

        $post = $_POST;
        $dataUser = fieldmapping('user', $post);
        if(is_login('member')){
            $dataMember = fieldmapping('member', $_POST);
            $dataMember['penanggung_jawab'] = $dataUser['nama'];
            $dataUser['member'] = $post['memberid'];
        }

        if(isset($dataUser['password']) && !empty($dataUser['password']))
            $dataUser['password'] = password_hash($dataUser['password'], PASSWORD_DEFAULT);
        else
            unset($dataUser['password']);

        if(isset($_FILES['pp']) && !empty($_FILES['pp'])){
            $this->load->helper('file_upload_helper');
            $fname = uploadImage($_FILES['pp'], 'pp', 'profile');

            if(sessiondata('login', 'photo') != 'default.jpg')
                delete_img(sessiondata('login', 'photo'));
            $dataUser['photo'] = $fname;
        }
        if(is_login('member'))
            $this->db->where('id', sessiondata('login', 'memberid'))->update('member', $dataMember);
        $this->db->where('id', sessiondata('login', 'id'))->update('user', $dataUser);

        // Update in localdata
        $tmp = sessiondata();
        if(is_login('member')){
            foreach ($dataMember as $key => $value) {
                if(sessiondata('login', $key) != $value)
                    $tmp[$key] = $value;
            }
        }
        foreach ($dataUser as $key => $value) {
            if($key == 'password') continue;
            if(sessiondata('login', $key) != $value)
                $tmp[$key] = $value;
        }
        $this->session->set_userdata('login', $tmp);
        response("Berhasil update profile");
    }

    function cek_username(){
        if(!httpmethod()) response("Ilegal Akses", 403);
        if(!is_login()) response("Anda belum login", 403);
        if(sessiondata('login', 'username') == $_POST['username']) response(['boleh' => true]);
        if(!isset($_POST['username']) || empty($_POST['username'])) response(['boleh' => false]);
        $usernameBaru = $_POST['username'];
        
        $user = $this->db->select('*')->where('username', $usernameBaru)->get('user')->result();
        if(!empty($user))
            response(['boleh'=> false]);
        else
            response(['boleh' => true]);
    }
    function logout(){
        if (!is_login())
            response(['message' => 'Anda belum login', 'type' => 'error'], 401);

        try {
            $this->session->unset_userdata('login');
            response(['message' => 'Anda berhasil logout', 'type' => 'success'], 200);
        } catch (\Throwable $th) {
            response(['message' => 'Gagal, Terjadi kesalahan', 'type' => 'error', 'err' => $th], 500);
        }
    }

    function buku_get(){
        if(!is_login())
            response("Anda tidak memiliki akses", 403);
        $this->load->model('Buku');

        $data = $this->Buku->get_dt();
        response($data);
    }

    function buku_post(){
        if(!is_login())
            response("Anda tidak memiliki akses", 403);
        $this->load->model('Buku');
        $post = $this->input->post();
        
        list($res, $err) = $this->Buku->simpan($post);
        if($res)
            response("Berhasil Mendaftarkan Buku");
        else
            response(['message' => 'Terjadi Kesalahan', 'err' => $err], 500);
    }

    function buku_delete(){
        if(!is_login())
            response("Anda tidak memiliki akses", 403);

        $this->load->model('Buku');
        $post = $this->input->post();
        list($res, $err) = $this->Buku->delete($post['ids']);
        if($res)
            response("Berhasil Delete Buku");
        else
            response(['message' => 'Terjadi Kesalahan', 'err' => $err], 500);
    }
    function buku_update(){
        if(!is_login())
            response("Anda tidak memiliki akses", 403);
        $this->load->model('Buku');
        $post = $this->input->post();
            
        list($res, $err) = $this->Buku->simpan($post, true);
        if($res)
            response("Berhasil Update Buku");
        else
            response(['message' => 'Terjadi Kesalahan', 'err' => $err], 500);
    }
}