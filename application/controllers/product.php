<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller{

	public $data = array();
    
    public function __construct()
    {       
        parent::__construct();
        $this->output->enable_profiler(PROFILER); 		
        $this->load->model('product_model');
        if(!$this->session->userdata('logged_in')){
            header('Location:/');
            exit;
        }
        $this->load->model('company_model');       
        $this->config->set_item('menu', 'product');
		$this->data['userData'] = $this->session->all_userdata();
        $this->data['segmentArray'] = $this->uri->segment_array();
    }
    
    public function index()
    {
        
        $company_id = $this->data['userData']['companyid'];
        $lastSegment = end($this->data['segmentArray']);
        $this->load->library("pagination2");    
        $config = $this->config->load('pagination');
        $config = $this->config->config['pagination'];
        $rows_per_page = $config['per_page'];
        $pageNumber =  is_numeric($lastSegment)?$lastSegment:"1";
        $this->data['pageNumber'] = ($pageNumber-1);
        $pageNumber = $rows_per_page*($pageNumber-1);
        $totalRows = $this -> product_model -> getProductCount($company_id);
        $config['total_rows'] = $totalRows;
        $this->data['products'] = $this -> product_model -> getProductlist($pageNumber,$rows_per_page,$company_id);
        $config['first_url'] = BASEURL.'/product/';
        $config['uri_segment'] = $this->uri->total_segments();  
        $config['base_url'] = BASEURL.'/product/';      
        $this->pagination2->initialize($config);
        $this->data['pagination'] = $this->pagination2->create_links();
        //echo "<pre>";print_r($this->data);exit;
        $structure = array(             
            'title' => "Poducts",
            'keywords' =>"Poducts",
            'description' => "Poducts",
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
			 'content' => 'pages/product/index',
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
        if ( $this->form_validation->run('product_add_edit')) {
            //if(isset($_POST) && !empty($_POST)){echo "<pre>";print_r($_POST);exit;}
            $formData = array(
                'name' => $this->input->post('name'),
                'cid' => $this->data['userData']['companyid'],
                'uid' => $this->data['userData']['id'],
                'price' => $this->input->post('price'),
                'created_at' => time(),
                'modified_at' => time()
                );
            $this->product_model->addProduct($formData);
            $this->session->set_flashdata('success', true);
            $this->session->set_flashdata('message', "Product added successfully!!");
            redirect("/product", 'refresh');
            //echo "<pre>";print_r($formData);exit;
        }
        $structure = array(             
            'title' => "Add New Product",
            'keywords' =>"Add New Product",
            'description' => "Add New Product",
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
             'content' => 'pages/product/add',
             'footer' => 'layout/footer',
             );
        $this->hq_layout->set_structure($structure);
        $this->hq_layout->set_layout($views,'2col');
        $this->hq_layout->set_data($this->data);
        $this->hq_layout->render();
    }

    public function edit()
    {
        $product_id = end($this->data['segmentArray']);
        $this->data['product']=$this->product_model->getProductDetailById($product_id);
        $this->load->library('form_validation');
        if ( $this->form_validation->run('product_add_edit')) {
            //if(isset($_POST) && !empty($_POST)){echo "<pre>";print_r($_POST);exit;}
            $formData = array(
                'name' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'modified_at' => time()
                );
            $this->product_model->editProduct($formData,$product_id);
            $this->session->set_flashdata('success', true);
            $this->session->set_flashdata('message', "Product updated successfully!!");
            redirect("/product", 'refresh');
            //echo "<pre>";print_r($formData);exit;
        }
        $structure = array(             
            'title' => "Edit Product",
            'keywords' =>"Edit Product",
            'description' => "Edit Product",
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
             'content' => 'pages/product/edit',
             'footer' => 'layout/footer',
             );
        $this->hq_layout->set_structure($structure);
        $this->hq_layout->set_layout($views,'2col');
        $this->hq_layout->set_data($this->data);
        $this->hq_layout->render();
    }

    public function add_quantity(){
        $product_id = end($this->data['segmentArray']);
        if ( $this->input->post('save')) {
            $formData = array(
                'pid' => $product_id,
                'uid' => $this->data['userData']['id'],
                'cid' => $this->data['userData']['companyid'],
                'quantity' => $this->input->post('quantity'),
                'created_at' => time()
                );
            //echo "<pre>";print_r($formData);exit;
            $this->product_model->addProductQuantity($formData);
            $this->session->set_flashdata('success', true);
            $this->session->set_flashdata('message', "Product quantity added successfully!!");
            redirect("/product", 'refresh');
            //echo "<pre>";print_r($formData);exit;
        }
        $structure = array(             
            'title' => "Add New Product",
            'keywords' =>"Add New Product",
            'description' => "Add New Product",
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
             'content' => 'pages/product/add_product_quantity',
             'footer' => 'layout/footer'
             );
        $this->hq_layout->set_structure($structure);
        $this->hq_layout->set_layout($views,'2col');
        $this->hq_layout->set_data($this->data);
        $this->hq_layout->render();

    }
}