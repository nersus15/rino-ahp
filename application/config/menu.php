<?php
defined('BASEPATH') or exit('No direct script access allowed');

$config['menu'] = array(
    'def' => array(
        'menus' => array(
            array('text' => 'Dashboard', 'icon' => 'iconsmind-Home', 'link' => base_url('dashboard')),
            array('text' => 'Data', 'link' =>  '#data', 'icon' => 'iconsmind-Big-Data', 'sub' => array(
                array('text' => 'Kriteria', 'link' => base_url('data/kriteria')),
                array('text' => 'Sub-Kriteria', 'link' => base_url('data/subkriteria')),
                array('text' => 'Alternatif', 'link' => base_url('data/alternatif')),
                array('text' => 'Karyawan', 'link' => base_url('data/karyawan')),
            )),
            array('text' => 'Penilaian Kinerja', 'link' => base_url('penilaian'), 'icon' => 'iconsmind-Bar-Chart'),
        ),
    )
);
