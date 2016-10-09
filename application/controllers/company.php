<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller{

	public $data = array();
    
    public function __construct()
    {       
        parent::__construct(); 		
        $this->load->model('company_model');
        if(!$this->session->userdata('logged_in')){
            header('Location:/');
            exit;
        }        
        $this->config->set_item('menu', 'company');
		$this->data['userData'] = $this->session->all_userdata();
		$this->data['segmentArray'] = $this->uri->segment_array();
    }
    
    public function index()
    {
        //echo "<pre>";print_r($this->data['segmentArray']);exit;
        $show_active = false;
        $lastSegment = end($this->data['segmentArray']);
        $this->load->library("pagination2");    
        $config = $this->config->load('pagination');
        $config = $this->config->config['pagination'];
        $rows_per_page = $config['per_page'];
        $pageNumber =  is_numeric($lastSegment)?$lastSegment:"1";
        $this->data['pageNumber'] = ($pageNumber-1);
        $pageNumber = $rows_per_page*($pageNumber-1);
        $totalRows = $this -> company_model -> getCompanyCount($show_active);
        $config['total_rows'] = $totalRows;         
        $this->data['companies'] = $this -> company_model -> getCompanylist($pageNumber,$rows_per_page,$show_active);
        $config['first_url'] = BASEURL.'/company/';
        $config['uri_segment'] = $this->uri->total_segments();  
        $config['base_url'] = BASEURL.'/company/';      
        $this->pagination2->initialize($config);
        $this->data['pagination'] = $this->pagination2->create_links();
        //$data['test'] = 'test';
        //echo "<pre>";print_r($this->data);exit;
        $structure = array(             
            'title' => "Company",
            'keywords' =>"Company",
            'description' => "Company",
            'js' => '',
            'css' => array('css/bootstrap.min.css','css/style.css'),
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
			 'content' => 'pages/company/index',
			 'footer' => 'layout/footer',
             );
        $this->hq_layout->set_structure($structure);
        $this->hq_layout->set_layout($views,'2col');
        $this->hq_layout->set_data($this->data);
        $this->hq_layout->render();
    }

    public function add()
    {
        if ( $this->input->post('save')) {
            $formData = array(
                'name' => $this->input->post('company'),
                'address' => $this->input->post('address'),
                'is_active' => $this->input->post('activate')?"1":"0",
                'modified_at' => time(),
                'created_at' => time()
                );
            //echo "<pre>";print_r($formData);exit;
            $this->company_model->addCompany($formData);
            $this->session->set_flashdata('success', true);
            $this->session->set_flashdata('message', "Company added successfully!!");
            redirect("/company", 'refresh');
            //echo "<pre>";print_r($formData);exit;
        }
        $structure = array(             
            'title' => "Add New Company",
            'keywords' =>"Add New Company",
            'description' => "Add New Company",
            'js' => '',
            'css' => array('css/bootstrap.min.css','css/style.css'),
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
             'content' => 'pages/company/add',
             'footer' => 'layout/footer',
             );
        $this->hq_layout->set_structure($structure);
        $this->hq_layout->set_layout($views,'2col');
        $this->hq_layout->set_data($this->data);
        $this->hq_layout->render();
    }

    public function edit()
    {
        $company_id = end($this->data['segmentArray']);
        $this->data['company']=$this->company_model->getCompanyDetail($company_id);
        if ( $this->input->post('save')) {
            $formData = array(
                'name' => $this->input->post('company'),
                'address' => $this->input->post('address'),
                'is_active' => $this->input->post('activate')?"1":"0",
                'modified_at' => time()
                );
            $this->company_model->editCompany($formData,$company_id);
            $this->session->set_flashdata('success', true);
            $this->session->set_flashdata('message', "Company updated successfully!!");
            redirect("/company", 'refresh');
        }
        $structure = array(             
            'title' => "Edit Company",
            'keywords' =>"Edit Company",
            'description' => "Edit Company",
            'js' => '',
            'css' => array('css/bootstrap.min.css','css/style.css'),
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
             'content' => 'pages/company/edit',
             'footer' => 'layout/footer',
             );
        $this->hq_layout->set_structure($structure);
        $this->hq_layout->set_layout($views,'2col');
        $this->hq_layout->set_data($this->data);
        $this->hq_layout->render();
    }
}