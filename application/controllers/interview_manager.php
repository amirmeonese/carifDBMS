<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Interview_Manager extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library("template");
        $this->load->library('form_validation');
        $this->load->model('record_model');
    }

    //redirect if needed, otherwise display the user list
    function index() {
		$this->load->model('Interview_Manager_Model');
        $data = $this->Interview_Manager_Model->general();
		
         $this->template->load("templates/interview_home_template", 'interview_manager/interview_home', $data);
    }
}