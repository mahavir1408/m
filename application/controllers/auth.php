<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {    
    
    public $data = array();

    public function __construct()
    {       
        parent::__construct(); 		
        $this->load->model('user_model');
        $this->load->helper('url');
        $this->output->enable_profiler(PROFILER);
        if($this->session->userdata('logged_in')){
            header('Location:/dashboard');             
        }		
    }
    
    public function index()
    {
        	
        $this->load->library('form_validation');
        $this->load->model('company_model');        
        $this->form_validation->set_error_delimiters('<div class="message error">', '</div>');
        
        if ( $this->form_validation->run('userlogin')) {
            $companyId = $this->input->post('company');
            $companyName = $this->input->post("company_name");
			$userData=$this->user_model->getUserDetails($this->input->post('username'),$this->input->post('password'));
            //echo "<pre>";print_r($userData);exit;	
            $newdata = array(
                    'id'         => $userData['userId'],
				    'name'       => $userData['userFullName'], 
                    'is_admin'   => ($userData['isAdmin']=='1')?true:false,	
                    'companyid'  => $companyId,
                    'company_name'  => $companyName?$companyName:"",		
                    'logged_in'  => true
                );
            $this->session->set_userdata($newdata);
            header('Location:/dashboard');
        }
        $this->data['companies'] = $this->company_model->getCompanylist('','',true);
        //$userData = $this->session->all_userdata();
		
        $structure = array(				
            'title'       => "Billing System!",
            'keywords'    =>"Billing System!",
            'description' => "Billing System!",
            'js'          => '',
            'css'         => array('css/bootstrap.min.css','css/login/signin.css'),
			'meta'        => array('author'    =>'Mahavir Munot', 
							       'viewport'  => 'width=device-width, initial-scale=1.0',
                                   'copyright' => 'Copyright @ 2016, addedbits'							
							)
        );
		$this->config->set_item('structureFile', 'structure');
        //'header','left','content','footer'
         $views=array(
			 'content' => 'pages/login/index'			 
             );
        $this->hq_layout->set_structure($structure);
        $this->hq_layout->set_layout($views,'0col');
        $this->hq_layout->set_data($this->data);
        $this->hq_layout->render();
    }
	
	public function userLogin()
    {   
        $isValid=$this->user_model->login_check($this->input->post('username'),$this->input->post('password'),$this->input->post('company'));

        if(!$isValid){
            $this->form_validation->set_message('userLogin', 'Incorrect Username or Password.');
            return false;				
        }else{
            return true;
        }
    }
    
    public function logout()
    {        
        $this->session->sess_destroy();
        header('Location:/');
    }
} 