<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller{

	public $data = array();
    
    public function __construct()
    {       
        parent::__construct();
        if(!$this->session->userdata('logged_in')){
            header('Location:/');
            exit;
        }
        $this->output->enable_profiler(PROFILER);
        $this->load->model('invoice_model');
        $this->config->set_item('menu', 'orders');
		$this->data['userData'] = $this->session->all_userdata();
        $this->data['segmentArray'] = $this->uri->segment_array();
        $this->data['company_id'] = $this->data['userData']['companyid'];
    }

    public function index()
    {
        $lastSegment = end($this->data['segmentArray']);
        $this->load->library("pagination2");    
        $config = $this->config->load('pagination');
        $config = $this->config->config['pagination'];
        $rows_per_page = $config['per_page'];
        $pageNumber =  is_numeric($lastSegment)?$lastSegment:"1";
        $this->data['pageNumber'] = ($pageNumber-1);
        $pageNumber = $rows_per_page*($pageNumber-1);
        $totalRows = $this -> invoice_model -> getInvoiceCount($this->data['company_id']);
        $config['total_rows'] = $totalRows;
        $this->data['invoices'] = $this -> invoice_model -> getInvoicelist($pageNumber,$rows_per_page,$this->data['company_id']);
        $config['first_url'] = BASEURL.'/orders/';
        $config['uri_segment'] = $this->uri->total_segments();  
        $config['base_url'] = BASEURL.'/orders/';      
        $this->pagination2->initialize($config);
        $this->data['pagination'] = $this->pagination2->create_links();
        $this->data['invoice'] = $this->invoice_model->getTotalAmount($this->data['company_id']);
        $structure = array(             
            'title' => "Dashboard",
            'keywords' =>"Dashboard",
            'description' => "Dashboard",
            'js' => '',
            'css' => array('css/bootstrap.min.css','css/style.css'),
            'meta' => array('author'=>'Mahavir Munot', 
                            'viewport' => 'width=device-width, initial-scale=1.0',
                            'copyright' => 'Copyright @ 2016, addedbits'                            
                            )
        );
        $this->config->set_item('structureFile', 'structure');
        $views=array(
             'header' => 'layout/header',
             'left' => 'layout/left',
             'content' => 'pages/invoice/index',
             'footer' => 'layout/footer',
             );
        $this->hq_layout->set_structure($structure);
        $this->hq_layout->set_layout($views,'2col');
        $this->hq_layout->set_data($this->data);
        $this->hq_layout->render();
    }

    public function invoiceDetails()
    {
        
        $invoice_id = end($this->data['segmentArray']);
        $this->data['invoiceDetails'] = $this->invoice_model->getInvoiceDetails($invoice_id);
        
        //echo "<pre>";print_r($this->data);exit;
        $structure = array(             
            'title' => "Dashboard",
            'keywords' =>"Dashboard",
            'description' => "Dashboard",
            'js' => '',
            'css' => array('css/bootstrap.min.css','css/style.css'),
            'meta' => array('author'=>'Mahavir Munot', 
                            'viewport' => 'width=device-width, initial-scale=1.0',
                            'copyright' => 'Copyright @ 2016, addedbits'                            
                            )
        );
        $this->config->set_item('structureFile', 'structure');
        $views=array(
             'header' => 'layout/header',
             'left' => 'layout/left',
             'content' => 'pages/invoice/invoice_details',
             'footer' => 'layout/footer',
             );
        $this->hq_layout->set_structure($structure);
        $this->hq_layout->set_layout($views,'2col');
        $this->hq_layout->set_data($this->data);
        $this->hq_layout->render();
    }

    public function constructInvoice(){
        $invoice = array();
        $this->load->model('company_model');
        $this->load->model('product_model');
        $invoice['invoice_number'] = $this->invoice_model->generateInvoiceNumber($this->data['company_id']);
        $invoice['company_details'] = $this->company_model->getCompanyDetail($this->data['company_id']);
        $invoice['product_list'] = $this->product_model->getProductlist('','',$this->data['company_id']);
        echo json_encode($invoice);exit;
    }

    public function saveInvoice(){
        if ($this->input->post()) {
            $customer_info = "";
            $invoice_number = $this->input->post('invoice_number');
            $amount = $this->input->post('amount');
            $customer = $this->input->post('customer_info');
            if(!empty($customer['customer_name'])){
                $customer_info = json_encode($customer);
            }
            $items = $this->input->post('items');
            $items = json_decode($items);
            if (is_object($items) && (count(get_object_vars($items)) > 0)) {
                $time = time();
                $item_batch = array();
                $formArray = array(
                    'uid' => $this->data['userData']['id'],
                    'cid' => $this->data['company_id'],
                    'invoice_no' => $invoice_number,
                    'amount' => $amount,
                    'customer_info' => $customer_info,
                    'created_at' => $time
                );
                $invoice_id = $this->invoice_model->addInvoice($formArray);
                
                foreach ($items as $v) {
                    if(!empty($v->item_id)){
                        $itemFormArray = array(
                            'uid' => $this->data['userData']['id'],
                            'cid' => $this->data['company_id'],
                            'pid' => $v->item_id,
                            'iid' => $invoice_id,
                            'quantity' => $v->quantity,
                            'price' => $v->price,
                            'amount' => $v->amount,
                            'created_at' => $time 
                        );
                        $item_batch[] = $itemFormArray;
                    }else{
                        header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                        echo json_encode(array("message"=>"Please select an items!!"));
                        exit;
                    }
                }
                $itemsInserted = $this->invoice_model->addInvoiceItems($item_batch);
                if($itemsInserted){
                    echo json_encode(array("message"=>"$itemsInserted items saved successfully!!"));
                    exit;
                }else{
                    header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                    echo json_encode(array("message"=>"Could not save the items!!"));
                    exit;
                }
            }else{
                header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                echo json_encode(array("message"=>"Please add an items!!"));
                exit;
            }
        }
        exit;
    }
}