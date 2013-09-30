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
        $data['submit'] = $this->input->post('mysubmit');
        $this->load->library('export');
                
        $ic = $this->input->post('report_IC_no');
        $patient_name = $this->input->post('report_patient_name');
        
        if($this->input->post('mysubmit')){
        
        $data['patient_name'] = $patient_name;
        $data['patient_ic'] = $ic;

        $data_search_key = array(
            'ic_no' => $ic,
            'fullname' => $patient_name
        );
        $result = array();
        $result = $this->report_model->getPatientInfo($data_search_key);

        $result_size = count($result);
        if ($result_size > 0) {
            $data['searched_result'] = $result;
            
        } else {
            echo "There is no such entry for the IC_no and Patient name";
        } echo '<br/>';
        
        }
        
        if($this->input->post('export_excel')){
                            
        $patient_name = $this->input->post('patient_name');
            
        $this->toExcel($ic,$patient_name);
        }
        $this->template->load("templates/report_home_template", 'report/report_home', $data);
    }

    function process_report() {
        /* $data_search_key = array(
          'ic_no' => $this->input->post('report_IC_no'),
          'fullname' => $this->input->post('report_patient_name')
          ); */
        /* $data_search_key = array(
          'ic_no' => 'Lim Dan Tong',
          'fullname' => '870728443122'
          ); */
        //$data_search_key = array( 'ic_no' => $this->input->post('report_IC_no'),'fullname' => $this->input->post('report_patient_name'));
        $export = $this->input->post('export_excel');
        $ic = $this->input->post('report_IC_no');
        $patient_name = $this->input->post('report_patient_name');
        
        $data['a'] = $patient_name;
        
        $data['export'] = $export;
        
        $data_search_key = array(
            'ic_no' => $ic,
            'fullname' => $patient_name
        );
        //print_r($data_search_key);exit;
        $result = array();
        $result = $this->report_model->getPatientInfo($data_search_key);
        //print_r( $result);exit;

        $result_size = count($result);
        //print_r($result);
        if ($result_size > 0) {
            $data['searched_result'] = $result;
            $this->template->load("templates/report_home_template", 'report/generated_report', $data);
            //$this->load->view('report/generated_report', $data);
        } else {
            echo "There is no such entry for the IC_no and Patient name";
        } echo '<br/>';
   
    }

    public function toExcel()
  {        
        $patient_name = $this->input->post('patient_name');
        $ic = $this->input->post('report_ic');
        
        $data_search_key = array(
            'ic_no' => $ic,
            'fullname' => $patient_name
        );
        $result = array();
        $result = $this->report_model->getPatientInfo($data_search_key);
        
        $data['patient'] = $result;

        $this->load->view('report/excel_export',$data);
  
  }
    
}