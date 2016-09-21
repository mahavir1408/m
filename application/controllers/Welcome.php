<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	/*
	public function index()
	{
		$this->load->view('welcome_message');
	}
	*/

	public function index()
    {
		
        $data['test'] = 'test';
        $structure = array(				
            'title' => "Admin Dashboard",
            'keywords' =>"Admin Dashboard",
            'description' => "Admin Dashboard",			
            'js' => 'js/script.js',
            'css' => array('css/style.css'),
			/*'misc_head' => '<!--[if gte IE 9]><link rel="stylesheet" href="assets/backend/css/ie9.css" type="text/css" /><![endif]-->
			<!--[if gte IE 8]><link rel="stylesheet" href="assets/backend/css/ie8.css" type="text/css" /><![endif]-->',*/
			//'meta' => array('<meta charset="utf-8" />','<meta name="author" content="" />','<meta name="viewport" content="width=device-width, initial-scale=1.0">')
			/*
			'meta' => array('author'=>'Mahavir Munot', 
							'viewport' => 'width=device-width, initial-scale=1.0',
							'copyright' => 'All content and images copyright &copy; 2013, addedbits'
							)
			*/
			'meta' => array('author'=>'Mahavir Munot', 
							'viewport' => 'width=device-width, initial-scale=1.0'							
							)
        );
		
		$data['left'] = "LEFT";
		$data['content'] = "CONTENT";
		$data['header'] = "HEADER";
		$data['footer'] = "FOOTER";
        //'header','left','content','footer'
        //$views=array('content' => 'welcome_message');
		$views=array(
			'header' => 'layout/header',
			'left' => 'layout/left',
			'content' => 'pages/content',
			'footer' => 'layout/footer',
			);
        $this->hq_layout->set_structure($structure);
        $this->hq_layout->set_layout($views,'2col');
        $this->hq_layout->set_data($data);
        $this->hq_layout->render();
    }	
}