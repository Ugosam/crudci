<?php

class Home_model extends CI_Model {
 
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }



     // login user
    public function signin($user) {

      $condition = "matno =" . "'" . $user['matno'] . "' AND " . "password =" . "'" . $user['password'] . "'";
      $this->db->select('*');
      $this->db->from('scholars');
      $this->db->where($condition);
      $this->db->limit(1);
      $query = $this->db->get();
      
      if ($query->num_rows() == 1) {
      return true;
      } else {
      return false;
      }  

    }

    // fetch Scholar's  details
    public function fetch_details($matno) {

      $condition = "matno =" . "'" . $matno . "'";
      $this->db->select('*');
      $this->db->from('scholars');
      $this->db->where($condition);
      $this->db->limit(1);
      $query = $this->db->get();
      
      if ($query->num_rows() > 0) {
      return $query->result();
      } else {
      return false;
      }
  }

  // fect collleges and departments
  public function fetch_dept($college) {

      $condition = "college =" . "'" . $college . "'";
      $this->db->select('depts');
      $this->db->from('depts');
      $this->db->where($condition);
      $query = $this->db->get();
      $output = '<option value="">Select Department</option>';
      foreach($query->result() as $row)
      {
       $output .= '<option value="'.$row->depts.'">'.$row->depts.'</option>';
      }
      return $output;


  }

  // Fetch Result 
  public function CheckResult($data) {
      $condition = "matno = " . "'" . $data['matno'] . "' AND " . "session =" . "'" . $data['session'] . "' AND " . "semester =" . "'" . $data['semester'] . "'";      
      $this->db->select('*');
      $this->db->from('result');
      $this->db->where($condition);
      $query = $this->db->get();
      if ($query->num_rows() > 0) {
      return $query->result();
      } else {
      return false;
      }
  }
  
  // fetch course outline
  public function FetchOutline($data){
		$condition = "college = " . "'" . $data['college'] . "' AND " . "department =" . "'" . $data['department'] . "' AND " . "level =" . "'" . $data['level'] . "' AND " . "semester =" . "'" . $data['semester'] . "'";      
    $this->db->select('*');
    $this->db->from('course_outline');
    $this->db->where($condition);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
    return $query->result();
    } else {
    return false;
     }
	}

  /*
  * for course registratation 
  */

  // fetch course outline
  public function FetchCourses($data){
    $condition = "college = " . "'" . $data['college'] . "' AND " . "department =" . "'" . $data['department'] . "' AND " . "level =" . "'" . $data['level'] . "' AND " . "semester =" . "'" . $data['semester'] . "'";      
    $this->db->select('*');
    $this->db->from('course_list');
    $this->db->where($condition);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
    return $query->result();
    } else {
    return false;
     }
  }
	
	// fetch lecture note

     public function FetchLectureNotes($data) {
         $condition = "college = " . "'" . $data['college'] . "' AND " . "department =" . "'" . $data['department'] . "' AND " . "level =" . "'" . $data['level'] . "' AND " . "semester =" . "'" . $data['semester'] . "'";      
        $this->db->select('*');
        $this->db->from('lecture_note');
        $this->db->where($condition);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
        return $query->result();
        } else {
        return false;
         }
     }	
	
 
  // Verify Password
   public function VerifyPass($data) {
      $condition = "matno =" . "'" . $data['matno'] . "'";
      $this->db->select('password');
      $this->db->from('scholars');
      $this->db->where($condition);
      $query = $this->db->get();
      return $query->result();
   }
   
  // update password after verification 
   public function UpdateSchPass($data) {
    $this->db->set('password', $data['newpassword']);
    $this->db->where('matno', $data['matno']);
    $this->db->update('scholars');

   }

   public function ProfilePhoto($data) {
	$this->db->set('image', $data['image']);
	$this->db->where('matno', $data['matno']);
	$this->db->update('scholars');   
   }

   public function ProfileUpdate($data){
	$this->db->where('matno', $data['matno']);
	$this->db->update('scholars', $data);
}
  
	// fetch active session an semster
	public function SemesterSession (){
		$this->db->select('*');
		$this->db->from('session_semester');
		$this->db->where('status', 'active');
		$query = $this->db->get();
		if ($query != "") 
		{
		return $query->result();
		}
		else {
		  return false;
		}
		}

		public function ViewTests($data) {
			$condition = "college = " . "'" . $data['college'] . "' AND " . "department =" . "'" . $data['department'] . "' AND " . "level =" . "'" . $data['level'] . "' AND " . "semester =" . "'" . $data['semester'] . "'";      
		 $this->db->select('*');
		 $this->db->from('tbl_examinations');
		 $this->db->where($condition);
		 $query = $this->db->get();
		 if ($query->num_rows() > 0) {
		 return $query->result();
		 } else {
		 return false;
			}
	}	

	public function CheckScore($data){
		$condition = "matno = " . "'" . $data['matno'] . "' AND " . "exam_id =" . "'" . $data['exam_id'] . "'" ;      
		$this->db->select('*');
		$this->db->from('test_scores');
		$this->db->where($condition);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
		return $query->result();
		} else {
		return false;
		 }
  }
  

	public function FetchExamDetails($data){
		$condition = "exam_id = " . "'" . $data['exam_id'] . "'" ;      
		$this->db->select('*');
		$this->db->from('tbl_examinations');
		$this->db->where($condition);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
		return $query->result();
		} else {
		return false;
		 }
	}

	public function FetchQuestions($data){
		$condition = "exam_id = " . "'" . $data['exam_id'] . "'" ;      
		$this->db->select('*');
		$this->db->from('registered_course');
		$this->db->where($condition);
		$this->db->order_by('rand()');
		$this->db->limit(40);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
		return $query->result();
		} else {
		return false;
		 }
	}
	
	public function StoreTestData ($data){
		return $this->db->insert('test_scores', $data);

  }
  
  public function Doublecheck($data){
    $condition = "code = " . "'" . $data['code'] . "' AND " . "matno =" . "'" . $data['matno'] . "' AND " . "session =" . "'" . $data['session'] . "' AND " . "semester =" . "'" . $data['semester'] . "'";      
    $this->db->select('*');
    $this->db->from('registered_course');
    $this->db->where($condition);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
    return true;
    } else {
    return false;
      }
  }

  public function RegisterCourses($data){
    return $this->db->insert('registered_course', $data);
  }
}
?>
