<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{

	public $data = array();
    
    public function __construct()
    {       
        parent::__construct();
        $this->output->enable_profiler(PROFILER);		
        $this->load->model('user_model');
        if(!$this->session->userdata('logged_in')){
            header('Location:/');
            exit;
        }
        $this->load->model('company_model');      
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

    public function company(){
        $userid = end($this->data['segmentArray']);
        $this->data['uid'] = $userid;
        $this->data['companies'] = $this->company_model->getCompanylistByUserId($userid);
        //  echo "<pre>";print_r($this->data['companies']);exit;
        $structure = array(             
            'title' => "User Company",
            'keywords' =>"User Company",
            'description' => "User Company",
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
             'content' => 'pages/user/company',
             'footer' => 'layout/footer',
             );
        $this->hq_layout->set_structure($structure);
        $this->hq_layout->set_layout($views,'2col');
        $this->hq_layout->set_data($this->data);
        $this->hq_layout->render();
    }

    public function delete_company(){
        $userid = end($this->data['segmentArray']);
        $secondLastKey = count($this->uri->segment_array())-1;
        $user_company_id = $this->uri->segment($secondLastKey);
        $this->user_model->removeUserCompany($user_company_id);
        $this->session->set_flashdata('success', true);
        $this->session->set_flashdata('message', "Company removed successfully!!");
        redirect("/users/companies/user/$userid", 'refresh');        
    }

    public function add_company(){
        $userid = end($this->data['segmentArray']);
        if($this -> input -> post('save')){
            //echo "<pre>";print_r($this->input->post());exit;
            $formData = array(
                    'uid' => $userid,
                    'cid' => $this->input->post('company')
                );
            $this->user_model->setUserCompany($formData);
            $this->session->set_flashdata('success', true);
            $this->session->set_flashdata('message', "Company added successfully!!");
            redirect("/users/companies/user/$userid", 'refresh');
        }
        $this->data['uid'] = $userid;
        $this->data['companies'] = $this->company_model->getCompanylist('','',true);
        //echo "<pre>";print_r($this->data['companies']);exit;
        $structure = array(             
            'title' => "User Company",
            'keywords' =>"User Company",
            'description' => "User Company",
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
             'content' => 'pages/user/add_company',
             'footer' => 'layout/footer',
             );
        $this->hq_layout->set_structure($structure);
        $this->hq_layout->set_layout($views,'2col');
        $this->hq_layout->set_data($this->data);
        $this->hq_layout->render();
    }

    public function add()
    {           
        $this->load->library('form_validation');
        if ( $this->form_validation->run('user_registration')) {
            //if(isset($_POST) && !empty($_POST)){echo "<pre>";print_r($_POST);exit;}
            $formData = array(
                'name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'mobile' => $this->input->post('mobile'),
                'passwd' => md5($this->input->post('password')),
                'is_active' => $this->input->post('activate')?"1":"0",
                'is_admin' => $this->input->post('administrator')?"1":"0",
                'created_at' => time(),
                'modified_at' => time(),
                );
            $this->user_model->addUser($formData);
            $this->session->set_flashdata('success', true);
            $this->session->set_flashdata('message', "User added successfully!!");
            redirect("/users", 'refresh');
            //echo "<pre>";print_r($formData);exit;
        }
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
        $userid = end($this->data['segmentArray']);
        $this->data['userDetails']=$this->user_model->getUserDetailsById($userid);
        //echo "<pre>";print_r($this->data);exit;

        if($this->input->post("save")){
            //if(isset($_POST) && !empty($_POST)){echo "<pre>";print_r($_POST);exit;}
            $formData = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'mobile' => $this->input->post('mobile'),
                //'passwd' => md5($this->input->post('password')),
                'is_active' => $this->input->post('activate')?"1":"0",
                'is_admin' => $this->input->post('administrator')?"1":"0",
                'modified_at' => time()
                );
            $this->user_model->updateUser($formData,$userid);
            $this->session->set_flashdata('success', true);
            $this->session->set_flashdata('message', "Record updated successfully!!");
            redirect("/users", 'refresh');
            //echo "<pre>";print_r($formData);exit;
        }
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

    public function change_password()
    {
        $userid = end($this->data['segmentArray']);
        $this->data['userDetails']=$this->user_model->getUserDetailsById($userid);
        //echo "<pre>";print_r($this->data);exit;

        $this->load->library('form_validation');
        if ( $this->form_validation->run('change_password')) {
            $formData = array(
                'passwd' => md5($this->input->post('password')),
                'modified_at' => time()
                );
            $this->user_model->updateUser($formData,$userid);
            $this->session->set_flashdata('success', true);
            $this->session->set_flashdata('message', "Password changed successfully!!");
            redirect("/users/edit/$userid", 'refresh');
        }
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
        $views=array(
             'header' => 'layout/header',
             'left' => 'layout/left',
             'content' => 'pages/user/change_password',
             'footer' => 'layout/footer',
             );
        $this->hq_layout->set_structure($structure);
        $this->hq_layout->set_layout($views,'2col');
        $this->hq_layout->set_data($this->data);
        $this->hq_layout->render();
    }

    public function username_exists()
    {
        $isValid=$this->user_model->username_exists($this->input->post('username'));
        if($isValid){
            $this->form_validation->set_message('username_exists', 'Username already exists!!.');
            return false;               
        }else{
            return true;
        }
    }
}