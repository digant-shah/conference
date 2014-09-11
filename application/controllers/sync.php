<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sync extends CI_Controller 
{

    public function index() 
	{
//$this->load->model('sync_model');
//$this->sync_model->sync_contacts();
$this->load->view('sync');

        }
		
		public function group() 
	{

$this->load->view('sync_group');

        }
        

}


?>