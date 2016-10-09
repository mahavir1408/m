<?php
class product_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
	
	public function getProductDetailById($id){
        $this->db->where('id',$id);
		$product=$this->db->get('product')->result_array();
		if(isset($product) && !empty($product)){
			return current($product);
		}else{
			return false;
		}
    }
	
	public function getProductlist($limit=null, $offset=null,$company_id){
		$this->db->select('p.id as id, p.name as name, FORMAT(COALESCE(SUM(pq.quantity),0),0) as quantity,p.price as price');
		$this->db->from("product as p");
		$this->db->join("product_quantity as pq", "p.id=pq.pid", "left");		
		$this->db->where('p.cid',$company_id);		
		$this->db->group_by('p.id');
		if(!empty($limit) || !empty($offset)){
			$result = $this->db->limit($offset,$limit)->order_by("p.id", "desc")->get()->result_array();
		} else {
			$result = $this->db->order_by("p.id", "desc")->get()->result_array();
		}
		if(isset($result) && !empty($result)){
			return $result;
		}else{
			return false;
		}
    }

    public function getProductCount($company_id){
   		$this->db->where('cid',$company_id);
        $total=$this->db->select('id')->get('product')->num_rows();
        if(isset($total) && !empty($total)){
        	return $total;
        }else{
        	return 0;
        }   
    }

    public function addProductQuantity($formData){
		$return_result=$this->db->insert('product_quantity', $formData);
		if($return_result){
    		return $this->db->insert_id();
		}else{
			return false;
		}    	
    }

	public function addProduct($formData) {
		$return_result=$this->db->insert('product', $formData);
		if($return_result){
    		return $this->db->insert_id();
		}else{
			return false;
		}
	}
	
	public function editProduct($formData,$id) {
		$this->db->where('id', $id);
		$return_result=$this->db->update('product', $formData); 		
		if($return_result){
    		return true;
		}else{
			return false;
		}
	}
}