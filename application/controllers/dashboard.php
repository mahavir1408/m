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
        //if(isset($_POST) && !empty($_POST)){echo "<pre>";print_r($this->input->post());exit;}
        if ($this->input->post('save')) {
            echo "<pre>";print_r($_POST);exit;
            
        }
        $structure = array(             
            'title' => "Dashboard",
            'keywords' =>"Dashboard",
            'description' => "Dashboard",
            'js' => 'js/jquery.min.js,js/bootstrap.min.js,js/bootstrap-select.min.js,js/moment.min.js,js/invoice.js',
            'css' => array('css/bootstrap.min.css','css/bootstrap-select.min.css','css/style.css'),
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