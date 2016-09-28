<?php
class User_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function login_check($uname,$pass){
        $q = $this
        ->db
        ->where('username ', $uname)
        ->where('passwd ', md5($pass))
        ->where('is_active ', '1')
        ->get('users');
        if ( $q->num_rows() == 1 ) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserList($limit=null, $offset=null, $show_active="false"){
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
		$this->db->select('a.id AS userId, a.name AS userFullName, a.email AS userEmail',false);
        $this->db->where('a.email ',$email);
		$this->db->where('a.passwd ',md5($pass));
		$this->db->where('is_active ', '1');
        $userDetails = $this->db->get('users as a')->result_array();		
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
}   