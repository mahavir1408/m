<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{

	public $data = array();
    
    public function __construct()
    {       
        parent::__construct(); 		
        $this->load->model('user_model');
        if(!$this->session->userdata('logged_in')){
            header('Location:/');
            exit;
        }        
        $this->config->set_item('menu', 'user');
		$this->data['userData'] = $this->session->all_userdata();
        $this->data['segmentArray'] = $this->uri->segment_array();
    }
    
    public function index()
    {
        //echo "<pre>";print_r($this->data['segmentArray']);exit;
        $lastSegment = end($this->data['segmentArray']);
        $this->load->library("pagination2");    
        $config = $this->config->load('pagination');
        $config = $this->config->config['pagination'];
        $rows_per_page = $config['per_page'];
        $pageNumber =  is_numeric($lastSegment)?$lastSegment:"1";
        $this->data['pageNumber'] = ($pageNumber-1);
        $pageNumber = $rows_per_page*($pageNumber-1);
        $totalRows = $this -> user_model -> getUserCount();
        $config['total_rows'] = $totalRows;         
        $this->data['users'] = $this->user_model->getUserList($pageNumber,$rows_per_page);
        $config['first_url'] = BASEURL.'/users/';
        $config['uri_segment'] = $this->uri->total_segments();  
        $config['base_url'] = BASEURL.'/users/';      
        $this->pagination2->initialize($config);
        $this->data['pagination'] = $this->pagination2->create_links();

        $structure = array(             
            'title' => "Users",
            'keywords' =>"Users",
            'description' => "Users",
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
			 'content' => 'pages/user/index',
			 'footer' => 'layout/footer',
             );
        $this->hq_layout->set_structure($structure);
        $this->hq_layout->set_layout($views,'2col');
        $this->hq_layout->set_data($this->data);
        $this->hq_layout->render();
    }

    public function add()
    {
        $structure = array(             
            'title' => "Users",
            'keywords' =>"Users",
            'description' => "Users",
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
             'content' => 'pages/user/add',
             'footer' => 'layout/footer',
             );
        $this->hq_layout->set_structure($structure);
        $this->hq_layout->set_layout($views,'2col');
        $this->hq_layout->set_data($this->data);
        $this->hq_layout->render();
    }

    public function edit()
    {
        $structure = array(             
            'title' => "Users",
            'keywords' =>"Users",
            'description' => "Users",
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
             'content' => 'pages/user/edit',
             'footer' => 'layout/footer',
             );
        $this->hq_layout->set_structure($structure);
        $this->hq_layout->set_layout($views,'2col');
        $this->hq_layout->set_data($this->data);
        $this->hq_layout->render();
    }
}