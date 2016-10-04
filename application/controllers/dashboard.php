<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{

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
        //$data['test'] = 'test';
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
        //'header','left','content','footer'
         $views=array(
             'header' => 'layout/header',
			 'left' => 'layout/left',
			 'content' => 'pages/dashboard/index',
			 'footer' => 'layout/footer',
             );
        $this->hq_layout->set_structure($structure);
        $this->hq_layout->set_layout($views,'2col');
        $this->hq_layout->set_data($this->data);
        $this->hq_layout->render();
    }
}