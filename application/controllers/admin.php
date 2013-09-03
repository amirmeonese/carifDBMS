<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library("template");
        $this->load->library('form_validation');
        $this->load->model('admin_model');
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
    
    //if($this->input->post('submit')){
    
    $data = array(
                'first_name' => $this->input->post('admin_firstname'),
                'last_name' => $this->input->post('admin_lastname'),
                'email' => $this->input->post('admin_email'),
                'username' => $this->input->post('admin_log_id')
                
            );
            
            print_r($data);exit;
			$id = $this->db->insert('users', $data);
            //array_push($data, $this->input->post('firstname'));
            //$id = $this->admin_model->insert_admin_record($data);
            if ($id > 0) {
                echo "Data Added successfully";
            } else {
                echo "Failed to insert";
            }
    //}
            //$this->template->load("templates/add_record_template",'record/add_record_admin_detail');

    }
    
    function list_record_locked_item(){
    
            $this->template->load("templates/add_record_template",'admin/list_record_locked_item');

    }
    
    function list_error_locked_item(){
    
            $this->template->load("templates/add_record_template",'admin/list_error_locked_item');

    }
    
    function submit_report(){
    
    $sender = $this->input->post('sender');
    $cc = $this->input->post('cc');
    $subject = $this->input->post('email_subject');
    $message = $this->input->post('message_contain');
    
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
            'smtp_user' => 'asyraf.abdrani@gmail.com',
            'smtp_pass' => 'is081744',
            'mailtype' => 'html'
        );
    
	$this->load->library('email',$config);
        $this->email->set_newline("\r\n");
   	$this->email->from( 'asyraf.abdrani@gmail.com', 'Amirul Asyraf' );
   	$this->email->to($sender);
   	$this->email->cc($cc);
   	$this->email->subject($subject);
   	$this->email->message($message);
   	$a = $this->email->send();
      
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

    
    function create_new_report(){
        
        $this->load->model('Record_model');
        $data = $this->Record_model->general();
        
        $this->template->load("templates/add_record_template", 'admin/list_error_locked_item',$data);
        
    }

}