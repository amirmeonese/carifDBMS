<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
		$this->load->helper('file');
		$this->load->helper('array');
		$this->load->helper('download');
        $this->load->library("template");
        $this->load->library('form_validation');
        $this->load->model('admin_model');
        $this->load->library('session');
    }

    //redirect if needed, otherwise display the user list
    function index() {
        //$this->template->load("templates/add_record_template",'admin/report_home');
        
        $this->admin_panel();
    }

    function input() {
        $this->load->model('Record_model');
        $data = $this->Record_model->general();
        //$this->load->view('books_input',$data);	
    }
    
    function add_record_admin_detail(){
    

            $password = $this->admin_model->get_random_password();
            $salt = $this->admin_model->get_random_salt();
        
            $id = $this->admin_model->insert_admin_record($password,$salt);
            if ($id > 0) {
                
                $this->session->set_flashdata('msg', 'success: Data Added successfully');
                redirect('admin/create_new_user');
                //echo "Data Added successfully";
            } else {
                echo "Failed to insert";
            }
    }
    
    function list_record_locked_item(){
    
            $this->template->load("templates/admin_panel_template",'admin/list_record_locked_item');

    }
    
    function list_error_locked_item(){
			
		if (!read_file('error_log/carif_error.txt'))
		{
			 echo 'Unable to read the file';
		}
		else
		{
			$data = read_file('error_log/carif_error.txt');
			$errorArray = array('errorMSG' => ''. $data . '');
            $this->template->load("templates/admin_panel_template",'admin/list_error_locked_item', $errorArray);
		}
			

    }
    
	function process_error_log_form()
	{
		if (isset ($_POST['logsubmit'])) {
			$this->submit_error_to_consultant();
		}
		else if (isset ($_POST['downloadbtn'])) {
			$this->download_error_log_file();
		}
	}
	
	function submit_error_to_consultant()
	{
		$error_list = $this->input->post('error_list');
		
		$config = array(
            'protocol' => 'smtp',
            //'mailpath' => '/usr/sbin/sendmail',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'apurbamy@gmail.com',
            'smtp_pass' => 'apurbamy2012',
            'mailtype' => 'html'
        );
    
		$this->load->library('email',$config);
		$this->email->set_newline("\r\n");
		$this->email->from('carif@errorlog.com', 'Carif Error Log sent via CarifDBMS');
		$this->email->to('farizaamir@gmail.com'); 
		$this->email->subject('Carif Error Log Report');
		$this->email->message($error_list);
		$send_status = $this->email->send();
		$this->email->print_debugger();
		
		if($send_status)
			redirect('admin/admin_panel/submit_report', 'refresh');
	}
	
	function write_error_into_log($error_msg){
		if (!read_file('error_log/carif_error.txt'))
		{
			 echo 'Unable to read the file';
		}
		else
		{
			//Get current error list and append new error message
			$data = read_file('error_log/carif_error.txt');
			$data = $data . '\n' . $error_msg;
			
			if ( !write_file('error_log/carif_error.txt'))
			{
				echo 'Unable to write the error log file';
				return false;
			}
			else
			{
				return true;
			}
		}
		
	}
	
	function download_error_log_file(){
		$data = file_get_contents("error_log/carif_error.txt"); // Read the file's contents
		$name = 'carif_error_log.txt';

		force_download($name, $data);
	}
	
    function submit_report(){
    
    $sender = $this->input->post('sender');
    $cc = $this->input->post('cc');
    $subject = $this->input->post('email_subject');
    $message = $this->input->post('message_contain');
    
    //------------------------------------------------------------------------------//
        $folder = $_SERVER["DOCUMENT_ROOT"] .'/'. 'Carif'.'/'.'img'.'/';
        
        $aconfig['upload_path'] = $folder;
        $aconfig['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
        $aconfig['max_size'] = '26214400'; // 25MB
        $aconfig['overwrite'] = FALSE;

        $this->load->library('upload', $aconfig);

        $filetype = $_FILES['userfile1']['type'];
        $filesize = $_FILES['userfile1']['size'];

        //file upload
        if (!empty($filetype)) {

            if (($filetype != "image/jpeg") && ($filetype != "image/jpg") && ($filetype != "image/gif") && ($filetype != "image/png") && ($filetype != "application/pdf")) {
                $this->session->set_flashdata('msg', 'error: Wrong file uploaded ');
            } elseif (($filesize > 26214400)) {

                $this->session->set_flashdata('msg', 'error: File is too large');
            } else {

                $path_upload = $this->upload->do_upload('userfile1');
                
                $filename = $_FILES['userfile1'];

                //$update_data = array('filepath1' => $rcptno . '/' . $filename['name']);

            }
        }
    
    $config = array(
//            'protocol' => 'smtp',
//            //'mailpath' => '/usr/sbin/sendmail',
//            'smtp_host' => 'ssl://server1.barracudacms.com',
//            'smtp_port' => 465,
//            'smtp_user' => 'system@barracudacms.com',
//            'smtp_pass' => 'System@33',
//            'mailtype' => 'html'
        
            'protocol' => 'smtp',
            //'mailpath' => '/usr/sbin/sendmail',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'apurbamy@gmail.com',
            'smtp_pass' => 'apurbamy2012',
            'mailtype' => 'html'
        );
    
	$this->load->library('email',$config);
        $this->email->set_newline("\r\n");
   	$this->email->from('carif@bugreport.com', 'Carif Bug Report sent via CarifDBMS');
   	$this->email->to($sender);
   	$this->email->cc($cc);
   	$this->email->subject($subject);
   	$this->email->message($message);
        $this->email->attach($folder.'/'.$filename['name']);
   	$a = $this->email->send();
        
        $this->email->print_debugger();


      
   if($a){
   
   redirect('admin/admin_panel/submit_report');
   }	
       
}
    
    function admin_panel() {
    
//        $this->load->model('Record_model');
//        $data = $this->Record_model->general();
        
//        if ($var == 'home')
        	$this->template->load("templates/list_record_template",'admin/admin_panel');
//        else if ($var == 'error_log')
//            $this->template->load("templates/add_record_template", 'admin/list_error_locked_item',$data);
//        else if ($var == 'submit_report')
//            $this->template->load("templates/add_record_template", 'admin/submit_report', $data);
//        else if ($var == 'create_user')
//            $this->template->load("templates/add_record_template", 'admin/add_record_admin_detail',$data);
//        else if ($var == 'lock_items')
//            $this->template->load("templates/add_record_template", 'admin/list_record_locked_item', $data);
//    	else if ($var == 'new_form')
//            $this->template->load("templates/add_record_template", 'admin/create_new_report', $data);
    
    }
    
    function submit_report_form(){
        
        $this->load->model('Record_model');
        $data = $this->Record_model->general();
        
        $this->template->load("templates/admin_panel_template", 'admin/submit_report', $data);
        
    }
    
    function create_new_user(){
        
        $this->load->model('Record_model');
        $data = $this->Record_model->general();
        
            $this->template->load("templates/admin_panel_template", 'admin/add_record_admin_detail',$data);
        
    }

    
    function create_new_report(){
        
        $this->load->model('Record_model');
        $data = $this->Record_model->general();
        
        $this->template->load("templates/admin_panel_template", 'admin/create_new_report',$data);
        
    }

}