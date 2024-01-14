<?php


defined('BASEPATH') or exit('No direct script access allowed');
class Data extends CI_Controller
{
    function kriteria(){
        $tabelKriteria = $this->getContentView('component/datatables/datatables.responsive', array(
            'dtTitle' => '',
            'dtid' => 'dt-kriteria',
            'head' => array(
            '', 'Id', 'Kriteria'
            ),
            'skrip' => 'dtconfig/dt_kriteria', //wajib
            'skrip_data' => array('id' => 'dt-kriteria'),
            'options' => array(
                'source' => 'ws/kriteria',
                'search' => 'false',
                'select' => 'multi', //false, true, multi
                'checkbox' => 'true',
                'change' => 'false',
                'dom' => 'rtip',
                'responsive' => 'true',
                'auto-refresh' => 'false',
                'deselect-on-refresh' => 'true',
            ),
            'form' => array(
                'id' => 'form-kriteria',
                'path' => '',
                'nama' => 'Form Kriteria',
                'skrip' => 'forms/form_kriteria',
                'formGenerate' => array(
                    [
                        'type' => 'hidden', 'name' => '_http_method', 'id' => 'method',
                    ],
                    [
                        'type' => 'hidden', 'name' => 'id', 'id' => 'id'
                    ],
                    [
                        "label" => 'Kriteria', "placeholder" => 'Nama kriteria',
                        "type" => 'text', "name" => 'kriteria', "id" => 'kriteria', 'attr' => 'data-rule-required="true"'
                    ]
                    
                    
                ),
                    'posturl' => 'ws/kriteria',
                    'buttons' => array(
                        [ "type" => 'reset', "data" => 'data-dismiss="modal"', "text" => 'Batal', "id" => "batal", "class" => "btn btn btn-warning" ],
                        [ "type" => 'submit', "text" => 'Simpan', "id" => "simpan", "class" => "btn btn btn-primary" ]
                )
            ),
            'data_panel' => array(
                'nama' => 'dt-kriteria',
                'perpage' => 10,
                'pages' => array(1, 2, 10),
                'hilangkan_display_length' => true,
                'toolbar' => array(
                    array(
                        'tipe' => 'buttonset',
                        'tombol' => array(
                            array('tipe' => 'link', 'href' => '#', 'title' => 'Tambah', 'icon' => 'icon-plus simple-icon-paper-plane', 'class' => 'btn-outline-primary tool-add tetap'),
                            array('tipe' => 'link', 'href' => '#', 'title' => 'Update', 'icon' => 'icon-plus simple-icon-pencil', 'class' => 'btn-outline-warning tool-edit tetap'),
                            array('tipe' => 'link', 'href' => '#', 'title' => 'Hapus', 'icon' => 'icon-delete simple-icon-trash', 'class' => 'btn-outline-danger tool-delete tetap'),
                        )
                    ),
                ),
            )
        ), true);

        $data = [
            'resource' => array('main', 'dore','datatables', 'form'),
            'contentHtml' => array($tabelKriteria),
            'content' => array(),
            'navbar' => 'component/navbar/navbar.dore',
            'sidebar' => 'component/sidebar/sidebar.dore',
            'sidebarConf' => config_sidebar('def', 1, 0),
            'pageName' => 'Data Kriteria',
            'title' => 'Data Kriteria',
            'navbarConf' => array(
                'adaUserMenu' => true,
                'adaNotif' => false,
                'pencarian' => false,
                'adaSidebar' => true,
                'homePath' => base_url()
            ),
            'bodyClass' => 'menu-hidden sub-hidden'
        ];
        $this->addViews('template/dore', $data);
        $this->render();
    }
    function subkriteria(){
        $tabelSubKriteria = $this->getContentView('component/datatables/datatables.responsive', array(
            'dtTitle' => '',
            'dtid' => 'dt-subkriteria',
            'head' => array(
            '', 'Id', 'Nama Sub Kriteria'
            ),
            'skrip' => 'dtconfig/dt_subkriteria', //wajib
            'skrip_data' => array('id' => 'dt-subkriteria'),
            'options' => array(
                'source' => 'ws/subkriteria',
                'search' => 'false',
                'select' => 'multi', //false, true, multi
                'checkbox' => 'true',
                'change' => 'false',
                'dom' => 'rtip',
                'responsive' => 'true',
                'auto-refresh' => 'false',
                'deselect-on-refresh' => 'true',
            ),
            'form' => array(
                'id' => 'form-subkriteria',
                'path' => '',
                'nama' => 'Form Sub-Kriteria',
                'skrip' => 'forms/form_subkriteria',
                'formGenerate' => array(
                    [
                        'type' => 'hidden', 'name' => '_http_method', 'id' => 'method',
                    ],
                    [
                        'type' => 'hidden', 'name' => 'id', 'id' => 'id'
                    ],
                    [
                        "label" => 'Sub Kriteria', "placeholder" => 'Nama sub-kriteria',
                        "type" => 'text', "name" => 'subkriteria', "id" => 'subkriteria', 'attr' => 'data-rule-required="true"'
                    ]
                    
                    
                ),
                    'posturl' => 'ws/subkriteria',
                    'buttons' => array(
                        [ "type" => 'reset', "data" => 'data-dismiss="modal"', "text" => 'Batal', "id" => "batal", "class" => "btn btn btn-warning" ],
                        [ "type" => 'submit', "text" => 'Simpan', "id" => "simpan", "class" => "btn btn btn-primary" ]
                )
            ),
            'data_panel' => array(
                'nama' => 'dt-subkriteria',
                'perpage' => 10,
                'pages' => array(1, 2, 10),
                'hilangkan_display_length' => true,
                'toolbar' => array(
                    array(
                        'tipe' => 'buttonset',
                        'tombol' => array(
                            array('tipe' => 'link', 'href' => '#', 'title' => 'Tambah', 'icon' => 'icon-plus simple-icon-paper-plane', 'class' => 'btn-outline-primary tool-add tetap'),
                            array('tipe' => 'link', 'href' => '#', 'title' => 'Update', 'icon' => 'icon-plus simple-icon-pencil', 'class' => 'btn-outline-warning tool-edit tetap'),
                            array('tipe' => 'link', 'href' => '#', 'title' => 'Hapus', 'icon' => 'icon-delete simple-icon-trash', 'class' => 'btn-outline-danger tool-delete tetap'),
                        )
                    ),
                ),
            )
        ), true);

        $data = [
            'resource' => array('main', 'dore','datatables', 'form'),
            'contentHtml' => array($tabelSubKriteria),
            'content' => array(),
            'navbar' => 'component/navbar/navbar.dore',
            'sidebar' => 'component/sidebar/sidebar.dore',
            'sidebarConf' => config_sidebar('def', 1, 0),
            'pageName' => 'Data Sub Kriteria',
            'title' => 'Data Sub Kriteria',
            'navbarConf' => array(
                'adaUserMenu' => true,
                'adaNotif' => false,
                'pencarian' => false,
                'adaSidebar' => true,
                'homePath' => base_url()
            ),
            'bodyClass' => 'menu-hidden sub-hidden'
        ];
        $this->addViews('template/dore', $data);
        $this->render();
    }
    function karyawan(){
        $tabelKaryawan = $this->getContentView('component/datatables/datatables.responsive', array(
            'dtTitle' => '',
            'dtid' => 'dt-karyawan',
            'head' => array(
            '', 'Id', 'Nama', 'NIP'
            ),
            'skrip' => 'dtconfig/dt_karyawan', //wajib
            'skrip_data' => array('id' => 'dt-karyawan'),
            'options' => array(
                'source' => 'ws/karyawan',
                'search' => 'false',
                'select' => 'multi', //false, true, multi
                'checkbox' => 'true',
                'change' => 'false',
                'dom' => 'rtip',
                'responsive' => 'true',
                'auto-refresh' => 'false',
                'deselect-on-refresh' => 'true',
            ),
            'form' => array(
                'id' => 'form-karyawan',
                'path' => '',
                'nama' => 'Form karyawan',
                'skrip' => 'forms/form_karyawan',
                'formGenerate' => array(
                    [
                        'type' => 'hidden', 'name' => '_http_method', 'id' => 'method',
                    ],
                    [
                        'type' => 'hidden', 'name' => 'id', 'id' => 'id'
                    ],
                    [
                        "label" => 'Nama', "placeholder" => 'Nama Karyawan',
                        "type" => 'text', "name" => 'nama', "id" => 'nama', 'attr' => 'data-rule-required="true"'
                    ],
                    [
                        "label" => 'NIP', "placeholder" => 'Nama Karyawan',
                        "type" => 'text', "name" => 'nip', "id" => 'nip', 'attr' => 'data-rule-required="true" data-rule-digits="true"'
                    ]                    
                    
                ),
                    'posturl' => 'ws/karyawan',
                    'buttons' => array(
                        [ "type" => 'reset', "data" => 'data-dismiss="modal"', "text" => 'Batal', "id" => "batal", "class" => "btn btn btn-warning" ],
                        [ "type" => 'submit', "text" => 'Simpan', "id" => "simpan", "class" => "btn btn btn-primary" ]
                )
            ),
            'data_panel' => array(
                'nama' => 'dt-karyawan',
                'perpage' => 10,
                'pages' => array(1, 2, 10),
                'hilangkan_display_length' => true,
                'toolbar' => array(
                    array(
                        'tipe' => 'buttonset',
                        'tombol' => array(
                            array('tipe' => 'link', 'href' => '#', 'title' => 'Tambah', 'icon' => 'icon-plus simple-icon-paper-plane', 'class' => 'btn-outline-primary tool-add tetap'),
                            array('tipe' => 'link', 'href' => '#', 'title' => 'Update', 'icon' => 'icon-plus simple-icon-pencil', 'class' => 'btn-outline-warning tool-edit tetap'),
                            array('tipe' => 'link', 'href' => '#', 'title' => 'Hapus', 'icon' => 'icon-delete simple-icon-trash', 'class' => 'btn-outline-danger tool-delete tetap'),
                        )
                    ),
                ),
            )
        ), true);

        $data = [
            'resource' => array('main', 'dore','datatables', 'form'),
            'contentHtml' => array($tabelKaryawan),
            'content' => array(),
            'navbar' => 'component/navbar/navbar.dore',
            'sidebar' => 'component/sidebar/sidebar.dore',
            'sidebarConf' => config_sidebar('def', 1, 0),
            'pageName' => 'Data Karyawan',
            'title' => 'Data Karyawan',
            'navbarConf' => array(
                'adaUserMenu' => true,
                'adaNotif' => false,
                'pencarian' => false,
                'adaSidebar' => true,
                'homePath' => base_url()
            ),
            'bodyClass' => 'menu-hidden sub-hidden'
        ];
        $this->addViews('template/dore', $data);
        $this->render();
    }
}
