<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

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
		$this->load->model('Report_model');
        $data = $this->Report_model->general();
		
         $this->template->load("templates/report_home_template", 'report/report_home', $data);
    }
}