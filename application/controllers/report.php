<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library("template");
        $this->load->library('form_validation');
        $this->load->model('excell_sheets_model');
        $this->load->model('report_model');
    }

    //redirect if needed, otherwise display the user list
    function index() {
        $this->load->model('report_model');
        $data = $this->report_model->general();
        $data['submit'] = $this->input->post('mysubmit');
        $this->load->library('export');
                
        $studies_name = $this->input->post('studies_name');
        $studies_id = $this->excell_sheets_model->get_studies_id($studies_name);
        $patient_cancer = $this->input->post('patient_cancer');
        $diagnosis_date_start = str_replace("/","-",$this->input->post('report_start_range_date'));
        $diagnosis_date_end = str_replace("/","-",$this->input->post('report_end_range_date'));
        $diagnosis_age_start = $this->input->post('report_start_range_age');
        $diagnosis_age_end = $this->input->post('report_end_range_age');
        
        
        if($this->input->post('mysubmit')){
        
        $data['cancer_name'] = $patient_cancer;
        $data['studies'] = $studies_id;
        $data['date_start'] = $diagnosis_date_start;
        $data['date_end'] = $diagnosis_date_end;
        $data['age_start'] = $diagnosis_age_start;
        $data['age_end'] = $diagnosis_age_end;
        

        $data_search_key = array(
            'studies_name' => $studies_id,
            'cancer' => $patient_cancer,
            'date_start' => date('Y-m-d',strtotime($diagnosis_date_start)),
            'date_end' => date('Y-m-d',strtotime($diagnosis_date_end)),
            'age_start' => $diagnosis_age_start,
            'age_end' => $diagnosis_age_end    
        );
        
        //print_r($data_search_key);exit;
        
        $result = array();
        $result = $this->report_model->getReportData($data_search_key);

        $result_size = count($result);
        if ($result_size > 0) {
            $data['searched_result'] = $result;
            
        } else {
            
            $data['searched_result'] = NULL;
            //echo "There is no such entry for the IC_no and Patient name";
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
        $studies_name = $this->input->post('studies_name');
        //$studies_id = $this->excell_sheets_model->get_studies_id($studies_name);
        $patient_cancer = $this->input->post('patient_cancer');
        $diagnosis_date_start = $this->input->post('report_start_range_date');
        $diagnosis_date_end = $this->input->post('report_end_range_date');
        $diagnosis_age_start = $this->input->post('report_start_range_age');
        $diagnosis_age_end = $this->input->post('report_end_range_age');
        
       $data_search_key = array(
            'studies_name' => $studies_name,
            'cancer' => $patient_cancer,
            'date_start' => $diagnosis_date_start,
            'date_end' => $diagnosis_date_end,
            'age_start' => $diagnosis_age_start,
            'age_end' => $diagnosis_age_end    
        );
        $result = array();
        $result = $this->report_model->getReportData($data_search_key);
        
        $data['patient'] = $result;

        $this->load->view('report/excel_export',$data);
  
  }
    
}