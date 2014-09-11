<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Groups extends CI_Controller {

    public function index() {
       $this->load->view('Groups');
        }
      
}
