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
		$Ugochi['email'] = $this->input->post('Email');
		$Ugochi['pass'] = $this->input->post('pass');

		if (!empty($Ugochi['fname']) &&  !empty($Ugochi['lname']) &&  !empty($Ugochi['otherName']) &&  !empty($Ugochi['day']) &&  !empty($Ugochi['month']) &&  !empty($Ugochi['year']) &&  !empty($Ugochi['gender']) &&  !empty($Ugochi['address']) &&  !empty($Ugochi['country']) &&  !empty($Ugochi['phoneNo']) &&  !empty($Ugochi['email']) &&  !empty($Ugochi['pass'])) {
			
			// I'm trying to make sure that the user emails is not doubled.
			$query = $this->Home_model->Verify($Ugochi);
			if ($query == true) {
				$response['error'] = true;
				$response['message'] = 'Email Already Exist';
			}
			else{

				// Save the user in the database 
				$insert = $this->Home_model->insert($Ugochi);

				$response['error'] = false;
				$response['message'] = 'User Added Successfully';
			}

		}
		else{
			$response['error'] = true;
			$response['message'] = 'All field are required';
		}

		

		echo json_encode($response);

	}














}
