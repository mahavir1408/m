<?php
class company_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
	
	public function getCompany($id){
        $this->db->where('id',$id);
		$company=$this->db->get('company')->result_array();
		if(isset($company) && !empty($company)){
			return current($company);
		}else{
			return false;
		}
    }
	
	public function getCompanylist($limit=null, $offset=null, $show_active="false"){
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
	
	public function insert($formData) {
		$return_result=$this->db->insert('ab_category', $formData);
		if($return_result){
    		return $this->db->insert_id();
		}else{
			return false;
		}
	}
	
	public function update($formData,$id) {
		$this->db->where('id', $id);
		$return_result=$this->db->update('ab_category', $formData); 		
		if($return_result){
    		return true;
		}else{
			return false;
		}
	}
}