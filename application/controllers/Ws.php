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

    function kriteria_get(){
        if(!is_login())
            response("Anda tidak memiliki akses", 403);
        /** @var Datatables */
        $this->load->library('Datatables');

        $query = $this->db->from('kriteria');
            
        $header = array(
            'id' => array('searchable' => true),
            'nama' => array('searchable' => true, 'field' => 'nama_kriteria'),
        );
        

        $this->datatables->setHeader($header)
            ->setQuery($query);

        $data =  $this->datatables->getData();
        response($data);
    }

    function kriteria_post(){
        if(!is_login())
            response("Anda tidak memiliki akses", 403);
     
        $post = $this->input->post();
        
        try {
            $this->db->insert('kriteria', ['nama_kriteria' => $post['kriteria']]);
            response("Berhasil Mendaftarkan Kriteria");
        } catch (\Throwable $th) {
            response(['message' => 'Terjadi Kesalahan', 'err' => $th->getMessage()], 500);
        }
      
            
    }

    function kriteria_delete(){
        if(!is_login())
            response("Anda tidak memiliki akses", 403);

        $post = $this->input->post();

        try {
            $this->db->where_in('id', $post['ids'])->delete('kriteria');
            response("Berhasil Delete Kriteria");
        } catch (\Throwable $th) {
            //throw $th;
            response(['message' => 'Terjadi Kesalahan', 'err' => $th->getMessage()], 500);
        }
    }
    function kriteria_update(){
        if(!is_login())
            response("Anda tidak memiliki akses", 403);
            
        $post = $this->input->post();
        
        try {
            $this->db->where('id', $post['id'])->update('kriteria', ['nama_kriteria' => $post['kriteria']]);
            response("Berhasil Mendaftarkan Kriteria");
        } catch (\Throwable $th) {
            response(['message' => 'Terjadi Kesalahan', 'err' => $th->getMessage()], 500);
        }
    }


    // Sub Kriteria
    function subkriteria_get(){
        if(!is_login())
            response("Anda tidak memiliki akses", 403);
        /** @var Datatables */
        $this->load->library('Datatables');

        $query = $this->db->from('sub_kriteria');
            
        $header = array(
            'id' => array('searchable' => true),
            'nama' => array('searchable' => true, 'field' => 'nama_subkriteria'),
        );
        

        $this->datatables->setHeader($header)
            ->setQuery($query);

        $data =  $this->datatables->getData();
        response($data);
    }

    function subkriteria_post(){
        if(!is_login())
            response("Anda tidak memiliki akses", 403);
     
        $post = $this->input->post();
        
        try {
            $this->db->insert('sub_kriteria', ['nama_subkriteria' => $post['subkriteria']]);
            response("Berhasil Mendaftarkan Sub Kriteria");
        } catch (\Throwable $th) {
            response(['message' => 'Terjadi Kesalahan', 'err' => $th->getMessage()], 500);
        }
      
            
    }

    function subkriteria_delete(){
        if(!is_login())
            response("Anda tidak memiliki akses", 403);

        $post = $this->input->post();

        try {
            $this->db->where_in('id', $post['ids'])->delete('sub_kriteria');
            response("Berhasil Delete Sub Kriteria");
        } catch (\Throwable $th) {
            //throw $th;
            response(['message' => 'Terjadi Kesalahan', 'err' => $th->getMessage()], 500);
        }
    }
    function subkriteria_update(){
        if(!is_login())
            response("Anda tidak memiliki akses", 403);
            
        $post = $this->input->post();
        
        try {
            $this->db->where('id', $post['id'])->update('sub_kriteria', ['nama_subkriteria' => $post['subkriteria']]);
            response("Berhasil Mendaftarkan Sub Kriteria");
        } catch (\Throwable $th) {
            response(['message' => 'Terjadi Kesalahan', 'err' => $th->getMessage()], 500);
        }
    }


    // Karyawan
    function karyawan_get(){
        if(!is_login())
            response("Anda tidak memiliki akses", 403);
        /** @var Datatables */
        $this->load->library('Datatables');

        $query = $this->db->from('karyawan');
            
        $header = array(
            'id' => array('searchable' => false),
            'nama' => array('searchable' => true),
            'nip' => array('searchable' => true),
        );
        

        $this->datatables->setHeader($header)
            ->setQuery($query);

        $data =  $this->datatables->getData();
        response($data);
    }

    function karyawan_post(){
        if(!is_login())
            response("Anda tidak memiliki akses", 403);
     
        $post = $this->input->post();
        
        try {
            $this->db->insert('karyawan', ['nama' => $post['nama'], 'nip' => $post['nip']]);
            response("Berhasil Mendaftarkan Karyawan");
        } catch (\Throwable $th) {
            response(['message' => 'Terjadi Kesalahan', 'err' => $th->getMessage()], 500);
        }
      
            
    }

    function karyawan_delete(){
        if(!is_login())
            response("Anda tidak memiliki akses", 403);

        $post = $this->input->post();

        try {
            $this->db->where_in('id', $post['ids'])->delete('karyawan');
            response("Berhasil Delete Karyawan");
        } catch (\Throwable $th) {
            //throw $th;
            response(['message' => 'Terjadi Kesalahan', 'err' => $th->getMessage()], 500);
        }
    }
    function karyawan_update(){
        if(!is_login())
            response("Anda tidak memiliki akses", 403);
            
        $post = $this->input->post();
        
        try {
            $this->db->where('id', $post['id'])->update('karyawan', ['nama' => $post['nama'], 'nip' => $post['nip']]);
            response("Berhasil Mendaftarkan Karyawan");
        } catch (\Throwable $th) {
            response(['message' => 'Terjadi Kesalahan', 'err' => $th->getMessage()], 500);
        }
    }

}