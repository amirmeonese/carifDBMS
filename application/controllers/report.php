<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library("template");
        $this->load->library('form_validation');
        $this->load->model('report_model');
    }

    //redirect if needed, otherwise display the user list
    function index() {
        $this->load->model('Report_model');
        $data = $this->Report_model->general();

        $this->template->load("templates/report_home_template", 'report/report_home', $data);
    }

    function process_report() {
        /*$data_search_key = array(
            'ic_no' => $this->input->post('report_IC_no'),
            'fullname' => $this->input->post('report_patient_name')
        );*/
        /*$data_search_key = array(
            'ic_no' => 'Lim Dan Tong',
            'fullname' => '870728443122'
        );*/
        //$data_search_key = array( 'ic_no' => $this->input->post('report_IC_no'),'fullname' => $this->input->post('report_patient_name'));
        $data_search_key = array(
            'ic_no' => $this->input->post('report_IC_no'),
            'fullname' => $this->input->post('report_patient_name')
        );
        //print_r($data_search_key);
        $result = array();
        $result = $this->report_model->getPatientInfo($data_search_key);
        //print_r( $result);
       
        $result_size = count($result);
        //print_r($result);
        if ($result_size > 0) {
             //print_r($result);
            // echo "Match with ".$result_size." No of entry.";
            $data['result'] = $result;
            $this->load->view('report/generated_report', $data);
        } else {
            echo "There is no such entry for the IC_no and Patient name";
        } echo '<br/>';
    }

}