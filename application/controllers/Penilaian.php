<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penilaian extends CI_Controller
{
    function index(){
        $karyawan = $this->db->select('*')->get('karyawan')->result();
        $kriteria = $this->db->select('*')->get('kriteria')->result();
        $subkriteria = $this->db->select('*')->get('sub_kriteria')->result();


        $data = [
            'resource' => array('main', 'dore','datatables', 'form'),
            'contentHtml' => array(),
            'content' => array('pages/penilaian'),
            'navbar' => 'component/navbar/navbar.dore',
            'sidebar' => 'component/sidebar/sidebar.dore',
            'sidebarConf' => config_sidebar('def', 1, 0),
            'pageName' => 'Data Karyawan',
            'title' => 'Data Karyawan',
            'data_content' => array(
                'karyawan' => $karyawan,
                'kriteria' => $kriteria,
                'subkriteria' => $subkriteria,
            ),
            'navbarConf' => array(
                'adaUserMenu' => true,
                'adaNotif' => false,
                'pencarian' => false,
                'adaSidebar' => true,
                'homePath' => base_url()
            ),
            'bodyClass' => 'menu-hidden sub-hidden'
        ];

        $this->add_javascript('js/utils/ahp');
        $this->add_cachedJavascript('pages/penilaian');

        $this->addViews('template/dore', $data);
        $this->render();
    }
}
