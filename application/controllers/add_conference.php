<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Add_conference extends CI_Controller 
{

    public function index() 
	{
        $this->load->view('add_conference1');
		
    }



	public function process()
			{

				$this->load->model('conference_model');
				$this->conference_model->add($_POST);
				$this->load->view('conference_details');

			}
			
			public function view()
			{
			
            $this->load->model('conference_model');
            $this->conference_model->update($_POST);
			$this->load->view('conference_details');
    
			}
			
			public function edit()
			{
				$this->load->view('update');

			}
			
			public function delete()
			{
			
            $this->load->model('conference_model');
            $this->conference_model->delete();
			$this->load->view('conference_details');
    
			}
			
			public function copy_conf()		//copy conference.
			{
			
            $this->load->model('conference_model');
            $this->conference_model->copy_conference();
			$this->load->view('conference_details');
    		}
			
			public function upload()
			{
				$this->load->view('upload');

			}
       
}
