<?php
class User_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function login_check1($uname,$pass){
        $q = $this
        ->db
        ->where('u.username ', $uname)
        ->where('u.passwd ', md5($pass))
        ->where('is_active ', '1')
        ->get('users as u');
        if ( $q->num_rows() == 1 ) {
            return true;
        } else {
            return false;
        }
    }

    public function login_check($uname,$pass,$company){
        $this->db->select('u.id AS id');
        $this->db->from("users as u");
        $this->db->join("user_company AS uc", "uc.uid = u.id", "left");
        $this->db->where('uc.cid ', $company);
        $this->db->where('u.username ', $uname);
        $this->db->where('u.passwd ', md5($pass));
        $this->db->where('u.is_active ', '1');
        $result = $this->db->get()->num_rows();
        //echo "<pre>";print_r($companies);exit;
        if($result==1){
            return true;
        }else{
            return false;
        }
    }

    public function getUserList($limit=null, $offset=null, $show_active=false){
        if($show_active){
            $users = $this->db->where('is_active',1);
        }
        if(!empty($limit) || !empty($offset)){
            $users = $this->db->limit($offset,$limit)->order_by("modified_at", "desc")->get('users')->result_array();
        } else {
            $users = $this->db->order_by("modified_at", "desc")->get('users')->result_array();
        }
        if(isset($users) && !empty($users)){
            return $users;
        }else{
            return false;
        }
    }	
	
	public function getUserDetails($email,$pass){		
		$this->db->select('u.id AS userId, u.name AS userFullName, u.is_admin AS isAdmin',false);
        $this->db->where('u.username ',$email);
		$this->db->where('u.passwd ',md5($pass));
		$this->db->where('is_active ', '1');
        $userDetails = $this->db->get('users as u')->result_array();
        //echo "2222<pre>";print_r($userDetails);exit;	
        if(isset($userDetails) && !empty($userDetails)){
            return current($userDetails);
        }else{
            return false;
        }
	}

    public function getUserDetailsById($userid){       
        $this->db->where('id ', $userid);
        $userDetails = $this->db->get('users')->result_array();
        //echo "2222<pre>";print_r($userDetails);exit;  
        if(isset($userDetails) && !empty($userDetails)){
            return current($userDetails);
        }else{
            return false;
        }
    }

    public function getUserCount(){
        $total=$this->db->select('id')->get('users')->num_rows();      
        if(isset($total) && !empty($total)){
            return $total;
        }else{
            return false;
        }    
    }

    public function setUserCompany($formData) {
        $return_result=$this->db->insert('user_company', $formData);
        if($return_result){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    public function removeUserCompany($user_company_id){
        $this->db->where('id', $user_company_id);
        $this->db->delete('user_company'); 
    }

    public function username_exists($uname){
        $q = $this
        ->db
        ->where('username ', $uname)
        ->get('users');
        if ( $q->num_rows() == 1 ) {
            return true;
        } else {
            return false;
        }
    }

    public function addUser($formData) {
        $return_result=$this->db->insert('users', $formData);
        if($return_result){
            return true;
        }else{
            return false;
        }
    }

    public function updateUser($formData,$id) {
        $this->db->where('id', $id);
        $return_result=$this->db->update('users', $formData);         
        if($return_result){
            return true;
        }else{
            return false;
        }
    }
}   