<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Record extends CI_Controller {

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
        $this->load->view('record/record_home');
    }

    function input() {
        $this->load->model('Record_model');
        $data = $this->Record_model->general();
        //$this->load->view('books_input',$data);	
    }

    function view_list($var = null) {
        $this->load->model('Record_model');
        $data = $this->Record_model->general();

        if ($var == 'personal')
            $this->template->load("templates/add_record_template", 'record/add_record_personal_details', $data);
        else if ($var == 'family')
            $this->template->load("templates/add_record_template", 'record/add_record_family_details', $data);
		else if ($var == 'studies_setOne')
            $this->template->load("templates/add_record_template", 'record/add_record_studies_set_one_details', $data);
		else if ($var == 'investigations')
            $this->template->load("templates/add_record_template", 'record/add_record_investigation_details', $data);
		else if ($var == 'surveillance')
            $this->template->load("templates/add_record_template", 'record/add_record_surveillance_details', $data);
		else if ($var == 'lifestyleFactors')
            $this->template->load("templates/add_record_template", 'record/add_record_lifestyles_factors_details', $data);
		else if ($var == 'patientSchedulers')
            $this->template->load("templates/add_record_template", 'record/add_record_patient_schedulers_details', $data);
        //$this->load->view('record/add_record', $data);
    }

    function patient_record_insertion() {
        //print_r($this->input->post());
        //$data = array();
        //validate form input
        $this->form_validation->set_rules('fullname', 'Full name', 'required|xss_clean');
        if ($this->form_validation->run() == true) {


            $data = array(
                'fullname' => $this->input->post('fullname'),
                'surname' => $this->input->post('surname'),
                'maiden_name' => $this->input->post('maiden_name'),
                'ic_no' => $this->input->post('IC_no'),
                'nationality' => $this->input->post('nationality'),
                'd_o_b' => $this->input->post('d_o_b'),
                'padigree_labelling' => $this->input->post('padigree_labelling'),
                'gender' => $this->input->post('gender'),
                'ethnicity' => $this->input->post('ethnicity'),
                'blood_group' => $this->input->post('blood_group'),
                'comment' => $this->input->post('comment'),
                'hospital_no' => $this->input->post('comment')
            );

            //array_push($data, $this->input->post('firstname'));
            $id = $this->record_model->insert_patient_record($data);
            if ($id > 0) {
                echo "Data Added successfully";
            } else {
                echo "Failed to insert";
            }
        } else {
            print_r(validation_errors());
        }
    }
    
    function patient_family_record_insertion()
    {
        //print_r($this->input->post());
        //$data = array();
        //validate form input
        $this->form_validation->set_rules('mother_fullname', 'Full name', 'required|xss_clean');
        if ($this->form_validation->run() == true) {


            $data = array(
                'full_name' => $this->input->post('mother_fullname'),
                'sur_name' => $this->input->post('mother_surname'),
                'maiden_name' => $this->input->post('mother_maiden_name'),
                'patient_ic_no' => $this->input->post('mother_IC_no'),
                'nationality' => $this->input->post('mother_nationality'),
                'd_o_b' => $this->input->post('mother_DOB'),
                'relatives_id' => $this->input->post('mother_IC_no'),
                'family_no' => $this->input->post('mother_IC_no'),  
                'cancer_type_id' => $this->input->post('mother_IC_no')   
            );

            //array_push($data, $this->input->post('firstname'));
            $id = $this->record_model->insert_patient_family_record($data);
            if ($id > 0) {
                echo "Data Added successfully";
            } else {
                echo "Failed to insert";
            }
        } else {
            print_r(validation_errors());
        }
    }
    
    function patient_record_view($ic_no){
        
        $data['ic_no'] = $ic_no;
    
    $this->load->view('record/view_home',$data);  
    
    }
    
    function record_list(){
    
 	$this->load->view('record/record_list');    
    }
    
    function patient_record_list(){
    
    $this->load->model('Record_model');
    $data = $this->Record_model->general();
    $data['patient_list'] = $this->record_model->get_list_patient_record();
        
    $this->template->load("templates/report_home_template", 'record/list_record_personal_details', $data);
    
    }
    
    function view_record_home(){
        
            $this->template->load("templates/report_home_template", 'record/view_record_home');

    }
    
    function view_record_list($var = null,$ic_no) {
        $this->load->model('Record_model');
        $data = $this->Record_model->general();
        
        if ($var == 'personal') {
            $data['patient_detail'] = $this->record_model->get_view_patient_record($ic_no,'patient','ic_no');
            $this->template->load("templates/add_record_template", 'record/view_record_personal_details', $data);
        
        } else if ($var == 'family') {
            $data['patient_family'] = $a = $this->record_model->get_view_patient_record($ic_no,'patient_relatives','patient_ic_no');
            $this->template->load("templates/add_record_template", 'record/view_record_family_details', $data);
                    
        } else if ($var == 'studies_setOne') {
            $data['patient_studies'] = $this->record_model->get_view_patient_record($ic_no,'patient_studies','patient_ic_no');
            
            $patient_breast_screening = $this->record_model->get_view_patient_record($ic_no,'patient_breast_screening','patient_ic_no');
                        
            $data['patient_mammogram'] = $patient_breast_screening;
            
            $a = @$patient_breast_screening['patient_breast_screening_id'];
            
            $data['patient_other_screening'] = $this->record_model->get_patient_other_screening($a);
            
            $patient_cancer = $this->record_model->get_view_patient_record($ic_no,'patient_cancer','patient_ic_no');

            $data['patient_cancer'] = $patient_cancer;
            
            $data['patient_cancer_treatment'] = $this->record_model->get_patient_cancer_treatment(@$patient_cancer['patient_cancer_id']);
            $data['patient_diagnosis'] = $this->record_model->get_view_patient_record($ic_no,'patient_diagnosis','patient_ic_no');
            $data['patient_pathology'] = $this->record_model->get_view_patient_record($ic_no,'patient_pathology','patient_ic_no');
            $this->template->load("templates/add_record_template", 'record/view_record_studies_set_one_details', $data);
                    
        } else if ($var == 'investigations') {
            $data['patient_investigation'] = $this->record_model->get_view_patient_record($ic_no,'patient_investigations','patient_ic_no');            
            $this->template->load("templates/add_record_template", 'record/view_record_investigation_details', $data);
        
        } else if ($var == 'surveillance') {
            $data['patient_surveillance'] = $this->record_model->get_view_patient_record($ic_no,'patient_surveillance','patient_ic_no');
            $this->template->load("templates/add_record_template", 'record/view_record_surveillance_details', $data);
        
        } else if ($var == 'lifestyleFactors') {
            $data['patient_lifestyle'] = $this->record_model->get_view_patient_record($ic_no,'patient_lifestyle_factors','patient_ic_no');            
            $this->template->load("templates/add_record_template", 'record/view_record_lifestyles_factors_details', $data);
        
        } else if ($var == 'interview_manager') {
            $data['patient_list'] = $this->record_model->get_view_patient_record($ic_no,'patient_interview_manager','patient_ic_no');            
            $this->template->load("templates/add_record_template", 'record/view_record_interview_manager', $data);
    }
    }

}