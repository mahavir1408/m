<?php
class invoice_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    public function generateInvoiceNumber($company_id){
   		$this->db->where('cid',$company_id);
   		$this->db->limit('1')->order_by("id", "desc");
        $result=$this->db->select('(invoice_no+1) AS invoice_no')->get('invoice')->result_array();
        //echo "<pre>";print_r($result);exit;
        if(isset($result) && !empty($result)){
        	$result = current($result);
        	return sprintf('%010d',$result['invoice_no']);
        }else{
        	return sprintf('%010d',1);
        }   
    }

    public function getTotalAmount($company_id='',$from='',$to=''){
        if(!empty($company_id)){
            $this->db->where('cid',$company_id);
        }
        if(!empty($from)&&!empty($to)){
            $this->db->where("DATE_FORMAT(FROM_UNIXTIME(created_at),'%Y-%m-%d') >=",$from);
            $this->db->where("DATE_FORMAT(FROM_UNIXTIME(created_at),'%Y-%m-%d') <=",$to);
        }
        $result=$this->db->select('sum(amount) AS total_amount')->get('invoice')->result_array();
        if(isset($result) && !empty($result)){
            return current($result);
        }else{
            return 0;
        } 
    }

    public function getInvoicelist($limit=null, $offset=null,$company_id='',$from='',$to=''){
        $select = 'i.id as id, i.invoice_no as invoice_no, i.amount as amount,i.customer_info as customer_info,i.created_at as created_at';
        $select .= ',c.name as company_name,u.name as user_name';
        $this->db->select($select);
        $this->db->from("invoice as i");
        $this->db->join("company as c", "c.id=i.cid", "left"); 
        $this->db->join("users as u", "u.id=i.uid", "left");     
        if(!empty($company_id)){
            $this->db->where('i.cid',$company_id);
        }
        if(!empty($from)&&!empty($to)){
            $this->db->where("DATE_FORMAT(FROM_UNIXTIME(i.created_at),'%Y-%m-%d') >=",$from);
            $this->db->where("DATE_FORMAT(FROM_UNIXTIME(i.created_at),'%Y-%m-%d') <=",$to);
        }
        if(!empty($limit) || !empty($offset)){
            $result = $this->db->limit($offset,$limit)->order_by("i.id", "desc")->get()->result_array();
        } else {
            $result = $this->db->order_by("i.id", "desc")->get()->result_array();
        }
        if(isset($result) && !empty($result)){
            return $result;
        }else{
            return false;
        }
    }

    public function getInvoiceDetails($invoice_id){
        $select = 'invd.id as id, p.name as product, invd.quantity as quantity,invd.price as price,invd.amount as amount';
        $this->db->select($select);
        $this->db->from("invoice_details as invd");
        $this->db->join("product as p", "invd.pid=p.id", "left"); 
        $this->db->join("invoice as i", "invd.iid=i.id", "left");
        $this->db->where('invd.iid',$invoice_id);
        $result = $this->db->order_by("invd.id", "desc")->get()->result_array();
        if(isset($result) && !empty($result)){
            return $result;
        }else{
            return false;
        }
    }

    public function addInvoice($formData) {
        $return_result=$this->db->insert('invoice', $formData);
        if($return_result){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    public function addInvoiceItems($formData) {
        $return_result=$this->db->insert_batch('invoice_details', $formData);
        if($return_result){
            return $return_result;
        }else{
            return false;
        }
    }

    public function getInvoiceCount($company_id='',$from='',$to=''){
        if(!empty($company_id)){
            $this->db->where('cid',$company_id);
        }
        if(!empty($from)&&!empty($to)){
            $this->db->where("DATE_FORMAT(FROM_UNIXTIME(created_at),'%Y-%m-%d') >=",$from);
            $this->db->where("DATE_FORMAT(FROM_UNIXTIME(created_at),'%Y-%m-%d') <=",$to);
        }
        $total=$this->db->select('id')->get('invoice')->num_rows();
        if(isset($total) && !empty($total)){
            return $total;
        }else{
            return 0;
        }   
    }
}