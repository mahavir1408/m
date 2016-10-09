<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller{

	public $data = array();
    
    public function __construct()
    {       
        parent::__construct(); 		
        $this->load->model('user_model');
        if(!$this->session->userdata('logged_in')){
            header('Location:/');
            exit;
        } 
        $this->config->set_item('menu', 'dashboard');
		$this->data['userData'] = $this->session->all_userdata();
    }

    public function index()
    {
        $structure = array(             
            'title' => "Dashboard",
            'keywords' =>"Dashboard",
            'description' => "Dashboard",
            'js' => 'js/jquery.min.js,js/bootstrap.min.js,js/bootstrap-select.min.js,js/moment.min.js,js/invoice_generator.js',
            'css' => array('css/bootstrap.min.css','css/style.css','css/bootstrap-select.min.css'),
            'meta' => array('author'=>'Mahavir Munot', 
                            'viewport' => 'width=device-width, initial-scale=1.0',
                            'copyright' => 'Copyright @ 2016, addedbits'                            
                            )
        );
        $this->config->set_item('structureFile', 'structure');
        //'header','left','content','footer'
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

    public function constructInvoice(){
        $invoice = array();
        $this->load->model('invoice_model');
        $this->load->model('company_model');
        $this->load->model('product_model');
        //$data['test'] = 'test';
        $invoice['invoice_number'] = $this->invoice_model->generateInvoiceNumber($this->data['userData']['companyid']);
        $invoice['company_details'] = $this->company_model->getCompanyDetail($this->data['userData']['companyid']);
        $invoice['product_list'] = $this->product_model->getProductlist('','',$this->data['userData']['companyid']);
        echo json_encode($invoice);exit;
    }

    public function saveInvoice(){
        if ($this->input->post()) {
            $items = $this->input->post('items');
            $items = json_decode($items);
            //echo "<pre>";print_r($items);exit;
            echo json_encode(array("status"=>"success"));
        }
        exit;
    }
}