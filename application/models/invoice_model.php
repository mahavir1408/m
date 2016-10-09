<?php
class invoice_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
	
	public function getInvoiceDetailById($id){
        $this->db->where('id',$id);
		$product=$this->db->get('product')->result_array();
		if(isset($product) && !empty($product)){
			return current($product);
		}else{
			return false;
		}
    }

    public function generateInvoiceNumber($company_id){
   		$this->db->where('cid',$company_id);
   		$this->db->limit('1')->order_by("id", "desc");
        $result=$this->db->select('(invoice_no+1) AS invoice_no')->get('invoice')->result_array();
        if(isset($result) && !empty($result)){
        	$result = current($result);
        	return sprintf('%010d',$result['invoice_no']);
        }else{
        	return 0;
        }   
    }
}