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
        $this->load->model('record_model');
        $this->load->library('PHPExcel');
    }

    //redirect if needed, otherwise display the user list
    function index() {
        $this->load->model('report_model');
        $this->load->model('record_model');
        $data = $this->report_model->general();
        $data['submit'] = $this->input->post('mysubmit');
        $this->load->library('export');
        
        $data['export_tab']= array(
                    
                    'personal' => 'Personal',
                    'family' => 'Family',
                    'diagnosis' => 'Diagnosis & Treatment',
                    'studies_setOne' => 'Screening & Survellience',
                    'mutation' => 'Mutation Analysis',
                    'risk_assessment' => 'Risk Assessment',
                    'lifestyleFactors' => 'Lifestyle Factor',
                    'counseling' => 'Counseling',
                    'All' => 'All'
                );
        
        $studies_name = $this->input->post('studies_name');
        $studies_id = $this->excell_sheets_model->get_studies_id($studies_name);
        //$patient_cancer = $this->input->post('cancer');
        //$cancer_id = $this->record_model->get_cancer_id($patient_cancer);
        $diagnosis_date_start = $this->input->post('report_start_range_date');
        $diagnosis_date_end = $this->input->post('report_end_range_date');
        $diagnosis_age_start = $this->input->post('report_start_range_age');
        $diagnosis_age_end = $this->input->post('report_end_range_age');
        //$cancer_name = $this->input->post('cancer');
        $ethnic_name = $this->input->post('ethnic');
        $patient_start = $this->input->post('patient_start');
        $field_name = $this->input->post('field');
        $cancer_name = $this->input->post('cancer');
        $creation_date_start = $this->input->post('report_creation_date_start');
        $creation_date_end = $this->input->post('report_creation_date_end');
        $consent_date_start = $this->input->post('report_consent_date_start');
        $consent_date_end = $this->input->post('report_consent_date_end');
                
        
        if($this->input->post('mysubmit')){
                                
        $data['cancer_name'] = $cancer_name;
        $data['studies'] = $studies_id;
        $data['date_start'] = $diagnosis_date_start;
        $data['date_end'] = $diagnosis_date_end;
        $data['age_start'] = $diagnosis_age_start;
        $data['age_end'] = $diagnosis_age_end;
        $data['patient_ethnic'] = $ethnic_name;
        $data['patient_field'] = $field_name;
        $data['creation_date_start'] = $creation_date_start;
        $data['creation_date_end'] = $creation_date_end;
        $data['consent_date_start'] = $consent_date_start;
        $data['consent_date_end'] = $consent_date_end;
        $data['patient_start'] = $patient_start;
        
        

        $data_search_key = array(
            'studies_name' => $studies_id,
            //'cancer' => $cancer_id,
            'date_start' => date('Y-m-d',strtotime($diagnosis_date_start)),
            'date_end' => date('Y-m-d',strtotime($diagnosis_date_end)),
            'creation_date_start' => date('Y-m-d',strtotime($creation_date_start)),
            'creation_date_end' => date('Y-m-d',strtotime($creation_date_end)),
            'consent_date_start' => date('Y-m-d',strtotime($consent_date_start)),
            'consent_date_end' => date('Y-m-d',strtotime($consent_date_end)),
            'age_start' => $diagnosis_age_start,
            'age_end' => $diagnosis_age_end    
        );
        
        //print_r($data_search_key);exit;
        
        $result = array();
        $result = $this->report_model->getReportData($data_search_key,$ethnic_name,$cancer_name,$patient_start);

        $result_size = count($result);
                
        if ($result_size > 0) {
            $data['searched_result'] = $result;
            
        } else {
            
            $data['searched_result'] = NULL;
            //echo "There is no such entry for the IC_no and Patient name";
        } echo '<br/>';
        
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
        $cancer_name = $this->input->post('cancer');
        $ethnic_name = $this->input->post('ethnic');
                
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
        $ethnic_name = $this->input->post('ethnic_name');
        $field_name = $this->input->post('field_name');
        $cancer_name = $this->input->post('cancer');
        $creation_date_start = $this->input->post('report_creation_date_start');
        $creation_date_end = $this->input->post('report_creation_date_end');
        $patient_ic_no = $this->input->post('ic_no');
        
        //print_r($patient_ic_no);exit;
        
       $data_search_key = array(
            'studies_name' => $studies_name,
            //'cancer' => $patient_cancer,
            'date_start' => $diagnosis_date_start,
            'date_end' => $diagnosis_date_end,
            'creation_date_start' => date('Y-m-d',strtotime($creation_date_start)),
            'creation_date_end' => date('Y-m-d',strtotime($creation_date_end)),
            'age_start' => $diagnosis_age_start,
            'age_end' => $diagnosis_age_end    
        );
        $result = array();
        $result = $this->report_model->getReportData($data_search_key,$ethnic_name,$cancer_name);
        
        $data['patient'] = $result;
        $data['patient_field'] = $field_name;

        $this->load->view('report/excel_export',$data);
  
  }
  
  function export_record_list() {
                $this->load->model('record_model');
                $data = $this->record_model->general();
                
                $var = $this->input->post('tab_name');
                $ic_no_check = $this->input->post('ic_no');
                
                $icno = $this->input->post('icno');
                
                $data['alive_id'] = $this->record_model->get_alive_status_by_id();
                $data['checkbox_status'] = $this->report_model->get_checkbox_value();
                $data['studies_id'] = $this->record_model->get_studies_name_by_id();
                $data['patient_studies_id'] = $this->record_model->get_studies_id_by_id();
                
                if (!empty($ic_no_check)){
                
                $ic_no = $ic_no_check;
                
                } else {
                                    
                $ic_no = $icno;
                    
                }
                                
                $studies_id = $this->input->post('patient_studies');
                
                $patient_studies = $this->report_model->get_patient_studies_id($ic_no,$studies_id);
                
                
                if(!empty($patient_studies)){
                foreach ($patient_studies as $value){
          
                $patient_studies_id[] = $value['patient_studies_id'];
          
                }
                } else {
                    
                   $patient_studies_id = NULL; 
                }
                if (($var == 'personal') || ($var == 'All')) {

                    $data['patient_detail'] = $this->record_model->get_detail_export_patient_record($ic_no, $patient_studies_id);
                    $data['patient_consent_detail'] = $this->report_model->get_consent_detail_patient_record($ic_no,$patient_studies_id);
                    //print_r(count($data['patient_consent_detail']));exit;
                    $data['patient_private_no'] = $this->record_model->get_private_no_record($ic_no);
                    $data['patient_hospital_no'] = $this->record_model->get_hospital_no_record($ic_no);
                    $data['patient_cogs_studies'] = $this->record_model->get_cogs_study_record($ic_no);
                    $data['patient_contact_person'] = $this->report_model->get_detail_record($ic_no, 'patient_contact_person');
                    $data['patient_survival_status'] = $this->record_model->get_survival_record($ic_no);
                    $data['patient_relatives_summary'] = $this->report_model->get_detail_record($ic_no, 'patient_relatives_summary');
                    
                    $this->load->view('export/personal_tab',$data);
                    
                    $this->load->view('export/consent_detail_tab',$data);
                    
                }  if (($var == 'family') || ($var == 'All')) {
                    $data['patient_family'] = $this->record_model->get_view_family_export($ic_no);
                    
                    //print_r($data['patient_family']);exit;
                    
                    $data['cancer_name'] = $this->record_model->get_cancer_by_id();
                    $data['relative'] = $this->record_model->get_relative_by_id();
                    $data['relationship'] = $this->record_model->get_relationship_list();
                    $data['relative_degrees'] = $this->record_model->get_relative_degree_by_id();
                    
                     $this->load->view('export/family_tab',$data);
                     
                } if (($var == 'diagnosis') || ($var == 'All')) {
                    //$data['patient_breast_cancer'] = $this->record_model->get_patient_breast_diagnosis_record($patient_studies_id);
                    //$data['patient_ovary_cancer'] = $this->record_model->get_patient_ovary_diagnosis_record($patient_studies_id);
                    //$data['patient_ovary_cancer_treatment'] = $this->record_model->get_patient_treatment_record($a['patient_cancer_id']);
                    $breast_diagnosis_list = $this->report_model->get_patient_all_cancer_record($patient_studies_id);
                                        
                    if(!empty($breast_diagnosis_list)){
                    foreach ($breast_diagnosis_list as $breast_id=>$breast) {
                    $breast_cancer_id = $breast['patient_cancer_id'];
                                                                    
                    $breast_treatment['treatment'] = $this->record_model->get_patient_treatment_record($breast_cancer_id);
                    $breast_pathology['pathology'] = $this->record_model->get_patient_breast_pathology_record($breast_cancer_id);

                    $breast_cancer[] = array_merge($breast, $breast_treatment, $breast_pathology);

                    }
                    
                    $data['patient_breast_cancer'] = $breast_diagnosis_list;
                    }

                    $data['patient_other_disease'] = $this->report_model->get_patient_others_desease_record($patient_studies_id);
                    $data['diagnosis_name'] = $this->record_model->get_diagnosis();
                    $data['site_cancer'] = $this->record_model->get_cancer_site();
                    $data['treatment_type'] = $this->record_model->get_treatment_type();
                    $data['cancer_name'] = $this->record_model->get_cancer_by_id();

                    $this->load->view('export/diagnosis_tab',$data);
                    $this->load->view('export/diagnosis_tab1',$data);
                    
                } if (($var == 'studies_setOne') || ($var == 'All')) {
                    $data['patient_breast_screening'] = $this->record_model->get_patient_breast_screening_record($patient_studies_id, $ic_no);
                    $data['patient_non_cancer'] = $this->report_model->get_patient_non_cancer_record($patient_studies_id);
                    $data['patient_risk_reducing_surgery'] = $this->report_model->get_patient_risk_reducing_surgery_record($patient_studies_id);
                    $data['patient_ovarian_screening'] = $this->report_model->get_patient_ovarian_screening_record($patient_studies_id);
                    $data['patient_surveillance'] = $this->report_model->get_patient_surveillance_record($patient_studies_id);
                    $data['patient_other_screening'] = $this->report_model->get_patient_other_screening_record($patient_studies_id);
                    $data['ovarian_screening_type'] = $this->record_model->get_ovarian_screening_type_by_id();
                    $data['site_breast'] = $this->record_model->get_site_breast_by_id();
                    $data['upperbelow_breast'] = $this->record_model->get_upperbellow_breast_by_id();
                    $data['non_cancerous_site'] = $this->record_model->get_non_cancerous_benign_site_name();

                    $this->load->view('export/screening_tab',$data);
                    $this->load->view('export/screening_tab2',$data);
                    $this->load->view('export/screening_tab3',$data);
                    $this->load->view('export/screening_tab4',$data);
                    $this->load->view('export/screening_tab5',$data);
                    $this->load->view('export/screening_tab6',$data);
                } if (($var == 'mutation') || ($var == 'All')) {

                    $data['patient_mutation_analysis'] = $this->report_model->get_export_mutation_record($patient_studies_id);
                    $this->load->view('export/mutation_tab',$data);
                    
                } if (($var == 'risk_assessment') || ($var == 'All')) {
                    $data['patient_risk_assessment'] = $this->report_model->get_export_riskassesment_record($ic_no, 'patient_risk_assessment', 'patient_ic_no');
                    
                    $this->load->view('export/risk_assessment_tab',$data);
                
                    
                } if (($var == 'lifestyleFactors') || ($var == 'All')) {
                    
                    $data['patient_lifestyle_factors'] = $this->report_model->get_lifestyle_detail_patient_record($patient_studies_id);
                    $data['patient_menstruation'] = $this->report_model->get_patient_menstruation_record($patient_studies_id);
                    $data['patient_parity_table'] = $this->report_model->get_patient_parity_table_record($patient_studies_id);
                    // $data['patient_parity_record'] = $this->record_model->get_patient_parity_record($ic_no, $patient_studies_id);
                    $data['patient_infertility'] = $this->report_model->get_patient_infertility_record($patient_studies_id);
                    $data['patient_gynaecological'] = $this->report_model->get_patient_gynaecological_record($ic_no, $patient_studies_id);

                    $this->load->view('export/lifestyle_tab',$data);
                    $this->load->view('export/lifestyle_tab2',$data);
                    $this->load->view('export/lifestyle_tab3',$data);
                    $this->load->view('export/lifestyle_tab4',$data);
                    $this->load->view('export/lifestyle_tab5',$data);
                } if (($var == 'counseling') || ($var == 'All')){
                    
                    //echo 'test 1';
                    $data['patient_interview_manager'] = $this->record_model->get_patient_counselling_record($ic_no);
                    $data['email_reminder'] = array(
                        '' => '',
                        '0' => 'No',
                        '1' => 'Yes'
                    );

                        //$this->template->load("templates/add_record_template", 'export/counseling_tab', $data);
                        $this->load->view('export/counseling_tab',$data);
                } 
            }
    
}