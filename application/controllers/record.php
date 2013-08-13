<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Record extends CI_Controller {

	function __construct()
	{
		 parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library("template");
        $this->load->library('form_validation');
	}

	//redirect if needed, otherwise display the user list
	function index()
	{
		$this->load->view('record/record_home');

	}
	
	function input()
	{
		$this->load->model('Record_model');
		$data = $this->Record_model->general();
		//$this->load->view('books_input',$data);	
	}
  
	function view_list($var = null)
	{
		$this->load->model('Record_model');
		$data = $this->Record_model->general();
		
		if($var == 'personal')
			$this->template->load("templates/add_record_template", 'record/add_record_personal_details', $data); 
		else if($var == 'family')
			$this->template->load("templates/add_record_template", 'record/add_record_family_details', $data);
		//$this->load->view('record/add_record', $data);
	}

}