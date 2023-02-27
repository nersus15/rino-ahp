<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller{
    function index(){
        
    }

    function profile(){
        if(!is_login()){
            redirect(base_url());
        }
        $data = [
            'resource' => array('main', 'dore', 'form'),
            'content' => array('pages/profile'),
            'data_content' => array(
                'user' => sessiondata()
            ),
            'navbar' => 'component/navbar/navbar.dore',
            'adaThemeSelector' => true,
            'loadingAnim' => true,
            // 'pageName' => 'Profile',
            'pageName' => "<a href='". base_url(is_login('member') ? 'member' : 'dashboard') ."'> <i class='simple-icon-arrow-left'>Kembali</i> </a>",
            'navbarConf' => array(
                'adaUserMenu' => true,
                'adaNotif' => true,
                'pencarian' => false,
                'adaSidebar' => true,
                'homePath' => base_url()
            )
        ];

        $this->add_javascript('vendor/lightbox/js/lightbox.min', 'body:end', 'file');
        $this->add_stylesheet('vendor/lightbox/css/lightbox.min','head','file');
        $this->add_cachedStylesheet(
            ".section.footer{
                background: transparent;
                z-index: 99;
                width: 100%;
                margin-top: 39px;
                margin-bottom: 0px;
                bottom: 100%;
                position: static;
                text-align: center;
            }
            .separator{
                border-top: solid 1px darkgrey;
            }"
        , 'inline', 'head');
        
        $this->add_cachedStylesheet('pages/profile');
        $this->add_javascript('js/pages/profile', 'body:end');
        
        $this->addViews('template/dore', $data);
        $this->render();
    }
    
    function phpinfo(){
        phpinfo(INFO_ALL);
    }
}
