<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function index(){
        if(!is_login())
            redirect(base_url());
       

        // response(config_sidebar('admin', 0));die;
        $data = [
            'resource' => array('main', 'dore'),
            'content' => array(),
            'data_content' => array(
            ),
            'navbar' => 'component/navbar/navbar.dore',
            'adaThemeSelector' => true,
            'sidebar' => 'component/sidebar/sidebar.dore',
            'pageName' => 'Dashboard',
            'sidebarConf' => config_sidebar('def', 0),
            'navbarConf' => array(
                'adaUserMenu' => true,
                'adaNotif' => true,
                'pencarian' => false,
                'adaSidebar' => true,
                'homePath' => base_url()
            )
        ];
        $this->addViews('template/dore', $data);
        $this->render();
    }
   
}
