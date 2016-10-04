<?php
class company_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
	
	public function getCompanyDetail($id){
        $this->db->where('id',$id);
		$company=$this->db->get('company')->result_array();
		if(isset($company) && !empty($company)){
			return current($company);
		}else{
			return false;
		}
    }
	
	public function getCompanylist($limit=null, $offset=null, $show_active=false){
		if($show_active){
			$pages = $this->db->where('is_active',1);
		}
		if(!empty($limit) || !empty($offset)){
			$pages = $this->db->limit($offset,$limit)->order_by("modified_at", "desc")->get('company')->result_array();
		} else {
			$pages = $this->db->order_by("modified_at", "desc")->get('company')->result_array();
		}
		if(isset($pages) && !empty($pages)){
			return $pages;
		}else{
			return false;
		}
    }

	public function getCompanylistByUserId($userid){
		$this->db->select('uc.id AS id, c.name AS name');
		$this->db->from("user_company as uc");
		$this->db->join("users AS u", "uc.uid = u.id", "left");
		$this->db->join("company AS c", "uc.cid = c.id", "left");
		$this->db->where('uc.uid',$userid);
		$companies = $this->db->order_by("uc.created_at", "desc")->get()->result_array();
		//echo "<pre>";print_r($companies);exit;
		if(isset($companies) && !empty($companies)){
			return $companies;
		}else{
			return false;
		}
    }

    public function getCompanyCount($show_active=false){
    	if($show_active){
			$total = $this->db->where('is_active',1);
		}
        $total=$this->db->select('id')->get('company')->num_rows();      
        if(isset($total) && !empty($total)){
            return $total;
        }else{
            return false;
        }    
    }
	
	public function addCompany($formData) {
		$return_result=$this->db->insert('company', $formData);
		if($return_result){
    		return $this->db->insert_id();
		}else{
			return false;
		}
	}
	
	public function editCompany($formData,$id) {
		$this->db->where('id', $id);
		$return_result=$this->db->update('company', $formData); 		
		if($return_result){
    		return true;
		}else{
			return false;
		}
	}
}