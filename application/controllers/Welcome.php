<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	

	 function __construct()
    {
        parent::__construct();
        $this->load->model('Home_model');
        $this->load->helper('form', 'url');
        $this->load->library('session');
        $this->load->helper('download');
        $this->load->library('form_validation');

    }

	// This handles the pages
	public function Ugochi ($page = 'index')
	{
		if( !file_exists('application/views/'.$page.'.php'))
		{
			show_404();
		}
        elseif ($page == 'index') {
                    

            $this->load->view($page);

        }
        else {
            
            // load any page that comes in 
            $this->load->view($page);
        }
		       
	}

	// create a registration method
	public function register(){
		// set the varaibles for each html elemenst that comes into the controller from the view 

		$Ugochi['fname'] = $this->input->post('fname');
		$Ugochi['lname'] = $this->input->post('lname');
		$Ugochi['otherName'] = $this->input->post('otherName');
		$Ugochi['day'] = $this->input->post('day');
		$Ugochi['month'] = $this->input->post('month');
		$Ugochi['year'] = $this->input->post('year');
		$Ugochi['gender'] = $this->input->post('gender');
		$Ugochi['address'] = $this->input->post('address');
		$Ugochi['country'] = $this->input->post('country');
		$Ugochi['phoneNo'] = $this->input->post('phoneNo');
		$Ugochi['Email'] = $this->input->post('Email');
		$Ugochi['pass'] = $this->input->post('pass');
		$Ugochi['copass'] = $this->input->post('copass');

		echo json_encode($Ugochi);

	}














}
