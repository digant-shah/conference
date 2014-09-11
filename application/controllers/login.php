<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index() {
        $this->session->sess_destroy();
        $this->load->view('login');
    }

    public function login_process() {
        $this->load->model('login_model');
        $result = $this->login_model->validate();

        if ($result['error']['no'] == 1) { // if the user's credentials validated...
            $data = array(
                '_logged_user_info' => $result['data']
            );
            $this->session->set_userdata($data);
            //redirect('/userlist');
            $this->jump( '/index.php/dashboard' );
        } else { // incorrect username or password
            //redirect('/index.php?/login');
            $this->jump( '/index.php' );
        }
    }

    public function jump( $url ){
        $data['url'] = $url;
        $this->load->view('jump_page', $data );
    }
    
    function logout() {
        $this->session->sess_destroy();
        $this->jump( '/index.php?/login' );
    }

}