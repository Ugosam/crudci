<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {



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
	public function view ($page = 'login')
	{
		if( !file_exists('application/views/'.$page.'.php'))
		{
			show_404();
		}
        elseif ($page == 'login') {
                    

            $this->load->view($page);

        }
        else {
            
            $this->load->view('modal/modal');
            $this->load->view('menu');
            $this->load->view($page);
        }
		       
	}

	// Scholars Loging
	public function signin () {
        

            $user['matno'] = $_POST['matno'];
            $user['password'] =$_POST['password'];
            
            $query = $this->Home_model->signin($user);

            if ($query == TRUE) {
                
                // Read user information in the datbase
                $matno = $this->input->post('matno');

                $fetch = $this->Home_model->fetch_details($matno);

                if ($fetch != FALSE) {
                    //  fetch session data

                    $session_data = array(
                        'matno' => $fetch[0]->matno,
                        'surname' => $fetch[0]->surname,
                        'firstname' => $fetch[0]->firstname,
                        'middlename' => $fetch[0]->middlename,
                        'college' => $fetch[0]->college,
                        'department' => $fetch[0]->department,
						'level' => $fetch[0]->level,
						'phone' => $fetch[0]->phone,
						'email' => $fetch[0]->email,
						'address'=> $fetch[0]->address,
						'image' => $fetch[0]->image
                        );
                    // add user data to  session

                     $response['status'] = 'OK';                   
                     $response['Message'] = 'Logged in';
                     $this->session->set_userdata('logged_in', $session_data);
                    //$this->load->view('header');
                    //header('location:'.base_url('dashboard'));
                        

                }
            }
            else {

                    $response['Error'] = 'true';
                    $response['Message'] = 'Invalid Login Credentials';
            }

    echo json_encode($response);
        
    }

    public function CheckResult() {

     if (isset($this->session->userdata['logged_in'])) {

        $data['matno'] = $this->input->post('matno');
        $data['dept'] = $this->input->post('department');
        //$data['level'] = $this->input->post('level');
		$data['semester'] = $this->input->post('semester');
		$data['session'] = $this->input->post('session');
		

        $data= $this->Home_model->CheckResult($data);

        
        echo json_encode($data);
    }


    else {
    redirect(base_url());
    }


	}
	
	/**
	 * Fetch Result from any session or semester 
	 */
	public function ChechLastResult() {

		if (isset($this->session->userdata['logged_in'])) {
			
		   $data['matno'] = $this->input->post('matno');
		   $data['dept'] = $this->input->post('department');
		   $data['level'] = $this->input->post('level');
		   $data['semester'] = $this->input->post('semester');
		   $data['session'] = $this->input->post('session');

   
		   $data= $this->Home_model->ChechLastResult($data);
   
		   
		   echo json_encode($data);
	   }
   
   
	   else {
	   redirect(base_url());
	   }
   
   
	   }
    
    // fetch course outline for a specific department and college
  public function FetchOutline(){
    if (isset($this->session->userdata['logged_in'])) {

		// fetch active session and semester
		$fetch_session = $this->Home_model->SemesterSession();
		$session = $fetch_session[0]->session;
		$semester = $fetch_session[0]->semester;

		$data['college'] = $this->input->post('college');
		$data['department'] = $this->input->post('department');
		$data['level'] = $this->input->post('level');
		$data['semester'] = "".$semester." Semester "; 

		$query = $this->Home_model->FetchOutline($data);
		if (!empty($query)) {
			
			$response['error'] = false;
			$response['message'] = $query;
		}
		else{
			$response['error'] = true;
			$response['message'] = 'No Course Outline found';
		}

		echo json_encode($response);
	}

	else {
  
		redirect(base_url());
		}

  }
    public function ChangePass () {

        if (isset($this->session->userdata['logged_in'])) {

        $data['matno'] = ($this->session->userdata['logged_in']['matno']);

        $data['oldpass'] = $this->input->post('oldpass');
        $data['newpassword'] = $this->input->post('newpassword');
        // verify old password
        $verify = $this->Home_model->VerifyPass($data);

        //$arr = array_column($verify,"password");
        $arr = $verify[0]->password;

        if ($arr == $data['oldpass']) {
            
            $UpdatePass = $this->Home_model->UpdateSchPass($data);

            if ($UpdatePass = true) {
                $response['Error'] = 'false';
                $response['Message'] = 'Password changed successfully';
            }
            else {
                $response['Error'] = 'true';
                $response['Message'] = 'Unable to change password';
            }
        }
        else {

            $response['Error'] = 'true';
            $response['Message'] = 'password is not correct';
        }


        echo json_encode($response);
    }

    else {
    redirect(base_url());
    }
    }
    
    /*
     * View Lecture Notes*
    */
    
    public function FetchLectureNotes(){
        
        if (isset($this->session->userdata['logged_in'])) {

		// fetch active session and semester
		$fetch_session = $this->Home_model->SemesterSession();
		$session = $fetch_session[0]->session;
		$semester = $fetch_session[0]->semester;

		$data['college'] = $this->input->post('college');
		$data['department'] = $this->input->post('department');
		$data['level'] = $this->input->post('level');
		$data['semester'] = "".$semester." Semester ";


		$query = $this->Home_model->FetchLectureNotes($data);
		if (!empty($query)) {
			
			$response['error'] = false;
			$response['message'] = $query;
		}
		else{
			$response['error'] = true;
			$response['message'] = 'No Lecture Note found';
		}

		echo json_encode($response);
	}

	else {
  
		redirect(base_url());
		}
        
	}
	
	// Profile picture Upload
	public function ProfilePhoto () {
		if (isset($this->session->userdata['logged_in'])) {
			
		  $data['matno'] = $this->input->post('matno');
	  
		  // image upload {this will upload both images}
		  $config['upload_path'] = './uploads/profile';
		  $config['allowed_types'] = 'jpg|png|jpeg';
		  $config['max_size'] = 5024;
		  $config['encrypt_name'] = true;
  
		  $this->load->library('upload', $config);
		  $this->upload->initialize($config);
		  
		  if (!$this->upload->do_upload('file')) {
			  $response['error'] = 'true';
			  $response['Message'] = $this->upload->display_errors();
		  } else {
			  $upload_data = $this->upload->data();
			  $data['image'] = $upload_data['file_name'];
			  
			  $EditProfile = $this->Home_model->ProfilePhoto($data);
  
			  if ($EditProfile == false) {
				  $response['error'] = 'false';
				  $response['Message'] = 'Profile Photo Uploaded Successfully';
			  } else {
				  $response['Error'] = 'true';
				  $response['Message'] = 'Error in Uploading Profile Photo';
			  }
		  }
			
		  echo json_encode($response);
	  
			
  
		}
		  else {
		  redirect(base_url());
		  }
		  
	  }

	  public function ProfileUpdate () {
		  if(isset($this->session->userdata['logged_in'])){

			$data['matno'] = $this->input->post('matno2');
			$data['phone'] = $this->input->post('phone');
			$data['email'] = $this->input->post('email');
			$data['address'] = $this->input->post('address');
			$data['status'] = 1;


			$query = $this->Home_model->ProfileUpdate($data);
			if ($query == false){

				/*unset(
					$_SESSION['phone'],
					$_SESSION['email'],
					$_SESSION['address']
			);*/
			
				$response['error'] = false;
				$response['Message'] = 'Profile Updated Successfully';
			}
			else{
				$response['error'] = true;
				$response['Message'] = 'Error in Updating profile';
			}
			echo json_encode($response);
		  }

		else 
		{
			redirect(base_url());
			}
			
	  }
	

	  
	  /**
	   * Course registration
	   */
	  
	   // fect the courses 

	   public function FetchCourses () {
        if (isset($this->session->userdata['logged_in'])) {
			// fetch active session and semester
			$fetch_session = $this->Home_model->SemesterSession();
			$session = $fetch_session[0]->session;
			$semester = $fetch_session[0]->semester;

			$data['semester'] = "".$semester." Semester ";
			$data['department'] = ($this->session->userdata['logged_in']['department']);
			$data['college'] = ($this->session->userdata['logged_in']['college']);
			$data['level'] = ($this->session->userdata['logged_in']['level']);

			$query = $this->Home_model->FetchCourses($data);

			
			$response['error'] = false;
			$response['message'] = $query;

			echo json_encode($response);

		}
		else {
			redirect(base_url());

		}

	   }


	   Public Function CarryOver(){
	   	  if (isset($this->session->userdata['logged_in'])) {

	   	  	$fetch_session = $this->Home_model->SemesterSession();
			$session = $fetch_session[0]->session;
			$semester = $fetch_session[0]->semester;

			$data['semester'] = "".$semester." Semester ";
			$data['department'] = ($this->session->userdata['logged_in']['department']);
			$data['college'] = ($this->session->userdata['logged_in']['college']);

			$data['level'] = $this->input->get("level");

			$query = $this->Home_model->FetchCourses($data);

			if(!empty($query)){
				$response['error'] = false;
				$response['message'] = $query;
			}
			else{
				$response['error'] = true;
				$response['message'] = 'No data Found';
			}

			echo json_encode($response);

	   	  }

		else {
			redirect(base_url());

		}
	   }

	   public function RegisterCourses(){
	   	if(isset($this->session->userdata['logged_in'])){
	   		// register courses 

		$dataa = json_decode(file_get_contents('php://input'), true);
		

	   	// fetch active session and semester
        $fetch_session = $this->Home_model->SemesterSession();
        $session = $fetch_session[0]->session;
        $semester = $fetch_session[0]->semester;

		$semester = "".$semester." Semester ";
		$session = $session;
		$matno = ($this->session->userdata['logged_in']['matno']);
		$dept = ($this->session->userdata['logged_in']['department']);
		$college = ($this->session->userdata['logged_in']['college']);
		$level = ($this->session->userdata['logged_in']['level']);

			for ($i=0;$i<count($dataa['data']);$i++) {

				$data['unit'] = $dataa['data'][$i]['unit']; 
				$data['code'] = $dataa['data'][$i]['courseCode']; 

				$data['college'] = $college;
				$data['level'] = $level;
				$data['matno'] = $matno;
				$data['dept'] = $dept;
				$data['session'] = $session;
				$data['semester'] = $semester;

				// check for double entries
				$query =  $this->Home_model->Doublecheck($data);
				if ($query == true) {
					$response['error'] = true;
					$response['message'] = 'Duplicate Enty for Courses being Registered with same matric number';
				}
				else {
		
					$query2 = $this->Home_model->RegisterCourses($data);
		
					if ($query2 == true) {
						$response['error'] = false;
						$response['message'] = 'Courses Registered  Successfully';
					}
					else {
						$response['error'] = true;
						$response['message'] = 'error in adding Courses for scholar';
					}
				}

			}
			

			echo json_encode($response);
	   	}
	   	else{
	   		redirect(base_url());
	   	}
	   }

	   // active semester and session 

	   public function SessionSemester(){
		   // fetch active session and semester
			$response['message'] = $this->Home_model->SemesterSession();
			$response['error'] = false;

			echo json_encode($response);
	   }
    
     // Logout from admin page
    public function logout() {

    // Removing session data
    $sess_array = array(
    'username' => ''
    );
    $this->session->unset_userdata('logged_in', $sess_array);
    header('location:'.base_url('login'));
    }

	
	public function ViewTests(){
		if (isset($this->session->userdata['logged_in'])) {

			// fetch active session and semester
			$fetch_session = $this->Home_model->SemesterSession();
			$session = $fetch_session[0]->session;
			$semester = $fetch_session[0]->semester;

			$data['semester'] = "".$semester." Semester ";
			$data['department'] = ($this->session->userdata['logged_in']['department']);
			$data['college'] = ($this->session->userdata['logged_in']['college']);
			$data['level'] = ($this->session->userdata['logged_in']['level']);

			$query = $this->Home_model->ViewTests($data);

			$response['error'] = false;
			$response['message'] = $query;

			echo json_encode($response);

		}
		else {
			redirect(base_url());

		}	
	}

	public function StartQuiz(){
		if (isset($this->session->userdata['logged_in'])) {

			$data['matno'] = $this->input->post('matno');
			$data['exam_id'] = $this->input->post('exam_id');

			// check if he has take the exam before 
			$query = $this->Home_model->CheckScore($data);
			if (!empty($query)) {
				// Put it in a session 

				$score_data = array(
					'matno' => $query[0]->matno,
					'exam_id' => $query[0]->exam_id,
					'code' => $query[0]->code,
					'score' => $query[0]->score,
					);
				// add user data to  session

				 $response['error'] = true;                   
				 $response['message'] = 'You have taken this quiz for "'.$score_data['code'].'", your score is "'.$score_data['score'].'"';

			}
			else {
				// fetch exam detiails based on ID
				$fetch = $this->Home_model->FetchExamDetails($data);
				$test_data = array(
					'exam_id' => $fetch[0]->exam_id,
					'code' => $fetch[0]->code,
					'duration' => $fetch[0]->duration,
					'instructions' => $fetch[0]->instructions,
					);
				// add user data to  session

				 $response['error'] = false;                   
				 $this->session->set_userdata('test', $test_data);

			}

			echo json_encode($response);

		}
		else {
			redirect(base_url());

		}	
	}

	public function FetchQuestions(){
		if (isset($this->session->userdata['logged_in'])) {
			$data['exam_id'] = $this->input->post('exam_id');
			$query = $this->Home_model->FetchQuestions($data);
			if (!empty($query)) {
				$response['error'] = false;
				// create an array that matches the jquery example
				// send it out as a session

				
				$dataArray = $query;
				$result = array();
				$n = 1; 
				for ($i = 0; $i < count($dataArray); $i++){
					if (isset($result[$dataArray[$i]->question_id]) == false)
						//$result[$dataArray[$i]->question_id] = array();
		
					$result[] = array('question' => $n++. $dataArray[$i]->question,
										'choices' => [$dataArray[$i]->options1, $dataArray[$i]->options2, $dataArray[$i]->options3, $dataArray[$i]->options4],
										'correctAnswer' =>  $dataArray[$i]->answer);
				}
				
				$questions = json_encode($result);
				$this->session->set_userdata('question', $questions);

				// exam details
				// fetch exam detiails based on ID
				$fetch = $this->Home_model->FetchExamDetails($data);
				$test_data = array(
					'exam_id' => $fetch[0]->exam_id,
					'code' => $fetch[0]->code,
					'duration' => $fetch[0]->duration,
					'instructions' => $fetch[0]->instructions,
					);
				// add user data to  session

				 $response['error'] = false;                   
				 $this->session->set_userdata('test', $test_data);

			}
			else{
				$response['error'] = true;
				$response['message'] = 'Quiz Questions Not Ready';
			}
			echo json_encode($response);
			//echo $questions;
		}
		else {
			redirect(base_url());

		}	
	}

	public function StoreTestData () {
	if (isset($this->session->userdata['logged_in'])) {
		$data['exam_id'] = $this->input->post('exam_id');
		$data['code'] = $this->input->post('code');
		$data['matno'] = $this->input->post('matno');
		$data['college'] = $this->input->post('college');
		$data['department'] = $this->input->post('department');
		$data['level'] = $this->input->post('level');
		$data['score'] = $this->input->post('score');

		// verify that the test data has not been stored
		$verify = $this->Home_model->CheckScore($data);
		if (!empty($verify)) {
			$response['error'] = true;
			$response['message'] = 'You have taken this test before';
		}
		else{
		$query = $this->Home_model->StoreTestData($data);
			if ($query == true) {
				
				$response['error'] = false;
				// Destroy all session 
				//$this->session->sess_destroy();
				// redirect to login

				// Logout from admin page

					// Removing session data
					$sess_array = array(
					'test' => ''
					);
					$this->session->unset_userdata('test', $sess_array);
			}
			else {
				$response['error'] = true;
				$response['message'] = 'Error in storing test data';
			}
			

		}
		
		echo json_encode($response);

		}
	else {
		redirect(base_url());

	}	
	}
}
