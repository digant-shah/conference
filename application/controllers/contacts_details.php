<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contacts_Details extends CI_Controller {

    public function index() {
		
		
		$this->load->model('sync_model');
				$this->sync_model->display_contacts();
        $this->load->view('contact');
        }
       
}
