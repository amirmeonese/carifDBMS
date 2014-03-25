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
        $this->load->model('excell_sheets_model');
        $this->load->model('excell_parser_model');
        $this->load->model('excell_auto_verification');
        $this->load->library("pagination");
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
        $userid = $this->session->userdata('user_id');
        $data['userprivillage'] = $a = $this->record_model->user_privillage($userid);
        $data['isUpdate'] = FALSE;

        if ($var == 'personal')
            $this->template->load("templates/add_record_template", 'record/add_record_personal_details', $data);
        else if ($var == 'family')
            $this->template->load("templates/add_record_template", 'record/add_record_family_details', $data);
        else if ($var == 'diagnosis')
            $this->template->load("templates/add_record_template", 'record/add_record_diagnosis_treatment_details', $data);
        else if ($var == 'studies_setOne')
            $this->template->load("templates/add_record_template", 'record/add_record_studies_set_one_details', $data);
        else if ($var == 'mutation_analysis')
            $this->template->load("templates/add_record_template", 'record/add_record_mutation_analysis_details', $data);
        else if ($var == 'pathology')
            $this->template->load("templates/add_record_template", 'record/add_record_pathology_details', $data);
        else if ($var == 'risk_assessment')
            $this->template->load("templates/add_record_template", 'record/add_record_risk_assessment_details', $data);
        else if ($var == 'lifestyleFactors')
            $this->template->load("templates/add_record_template", 'record/add_record_lifestyles_factors_details', $data);
        else if ($var == 'counselling') {
            $this->template->load("templates/add_record_template", 'record/interview_home', $data);
        } else if ($var == 'bulkImport')
            $this->template->load("templates/add_record_template", 'record/upload_xlsx_file', $data);
        //$this->load->view('record/add_record', $data);
    }

    function getDynamicFieldsInputsArray($sectionName, $id = NULL) {
        /* section lists
          //FAMILY TAB
          mother cancer
          father cancer
          relative
          relative cancer
          //DIANOSIS TAB
          breast cancer: diagnosis
          breast cancer:pathology
          breast cancer:pathology:staining status
          breast cancer treatment
          ovary cancer: diagnosis
          ovary cancer:pathology
          ovary cancer:pathology:staining status
          ovary cancer treatment
          other cancer: diagnosis
          other cancer:pathology
          other cancer:pathology:staining status
          other cancer treatment
          other disease
          other disease: medication
          //SCREENINGS TAB
         */
        $ic_no = $this->input->post('IC_no');
        $old_ic_no = $this->input->post('old_IC_no');

        if (!empty($old_ic_no)) {

            $new_ic_no = substr($old_ic_no, 1);
        } else {

            $new_ic_no = $ic_no;
        }

        switch ($sectionName) {

            case "survival_status": {
                    $fieldCount = 2;
                    $allFieldArray = array();

                    while ($this->input->post('status_source' . $fieldCount)) {
                        $alive_status = $this->input->post('alive_status' . $fieldCount);

                        echo $this->input->post('status_source' . $fieldCount) . ', ' .
                        $alive_status . ', ' . $this->input->post('status_gathered_date' . $fieldCount) . '</br>';

                        if ($alive_status == 'Alive')
                            $alive_status_flag = TRUE;
                        else if ($alive_status == 'Dead')
                            $alive_status_flag = FALSE;
                        else
                            $alive_status_flag = FALSE;

                        $data_patient_survival_status = array(
                            'patient_ic_no' => $this->input->post('IC_no'),
                            'source' => $this->input->post('status_source' . $fieldCount),
                            'alive_status' => $alive_status_flag,
                            'status_gathering_date' => $this->input->post('status_gathered_date' . $fieldCount)
                        );

                        $fieldCount++;
                        array_push($allFieldArray, $data_patient_survival_status);
                    }
                    echo count($allFieldArray);
                    break;
                }
            case "counselling_note": {

                    $fieldCount = 2;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('interview_date' . $fieldCount)) {

                        //print_r($comment);exit;

                        $data_patient_interview_manager = array(
                            'patient_ic_no' => $this->input->post('IC_no'),
                            'interview_date' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('interview_date' . $fieldCount)))),
                            'next_interview_date' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('interview_next_date' . $fieldCount)))),
                            'is_send_email_reminder_to_officers' => $this->input->post('is_send_email_reminder' . $fieldCount),
                            'officer_email_addresses' => $this->input->post('officer_email_addresses' . $fieldCount),
                            'created_on' => $date,
                            'comments' => $this->input->post('interview_note' . $fieldCount)
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('patient_interview_manager', $data_patient_interview_manager);
                    }
                    //echo count($allFieldArray);
                    break;
                }
            case "hospital_no": {

                    $fieldCount = 2;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('hospital_no' . $fieldCount)) {

                        //print_r($comment);exit;

                        $data_patient_hospital_no = array(
                            'patient_ic_no' => $new_ic_no,
                            'created_on' => $date,
                            'hospital_no' => $this->input->post('hospital_no' . $fieldCount)
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('patient_hospital_no', $data_patient_hospital_no);
                    }
                    //echo count($allFieldArray);
                    break;
                }
            case "patient_private_no": {

                    $fieldCount = 2;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('private_patient_no' . $fieldCount)) {

                        //print_r($comment);exit;

                        $data_patient_private_no = array(
                            'patient_ic_no' => $new_ic_no,
                            'created_on' => $date,
                            'private_no' => $this->input->post('private_patient_no' . $fieldCount)
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('private_patient_no', $data_patient_private_no);
                    }
                    //echo count($allFieldArray);
                    break;
                }
            case "COGS_study": {

                    $fieldCount = 2;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('COGS_studies_id' . $fieldCount)) {

                        //print_r($comment);exit;

                        $data_patient_COGS_study = array(
                            'patient_ic_no' => $new_ic_no,
                            'COGS_studies_name' => $this->input->post('COGS_studies_id' . $fieldCount),
                            'created_on' => $date,
                            'COGS_studies_no' => $this->input->post('COGS_studies_no' . $fieldCount)
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('patient_cogs_studies', $data_patient_COGS_study);
                    }
                    //echo count($allFieldArray);
                    break;
                }
            case "father_cancer": {

                    $fieldCount = 2;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('father_cancer_name' . $fieldCount)) {

                        $father_cancer_name = $this->input->post('father_cancer_name' . $fieldCount);
                        $father_cancer_type_id = $this->record_model->get_cancer_id($father_cancer_name);
                        $data1_patient_relatives = array(
                            'patient_ic_no' => $this->input->post('IC_no'),
                            'date_of_diagnosis' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('father_date_of_diagnosis' . $fieldCount)))),
                            'cancer_type_id' => $father_cancer_type_id,
                            'age_of_diagnosis' => $this->input->post('father_age_of_diagnosis' . $fieldCount),
                            'other_detail' => $this->input->post('father_diagnosis_other_details' . $fieldCount),
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('patient_relatives', $data1_patient_relatives);
                    }
                    //echo count($allFieldArray);
                    break;
                }
            case "mother_cancer": {

                    $fieldCount = 2;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('mother_cancer_name' . $fieldCount)) {

                        //print_r($comment);exit;

                        $mother_cancer_name = $this->input->post('mother_cancer_name' . $fieldCount);
                        $mother_cancer_type_id = $this->record_model->get_cancer_id($mother_cancer_name);
                        $data2_patient_relatives = array(
                            'patient_ic_no' => $this->input->post('IC_no'),
                            'date_of_diagnosis' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('mother_date_of_diagnosis' . $fieldCount)))),
                            'cancer_type_id' => $mother_cancer_type_id,
                            'age_of_diagnosis' => $this->input->post('mother_age_of_diagnosis' . $fieldCount),
                            'other_detail' => $this->input->post('mother_diagnosis_other_details' . $fieldCount),
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('patient_relatives', $data2_patient_relatives);
                    }
                    //echo count($allFieldArray);
                    break;
                }
                
                case "relative_cancer": {

                    $fieldCount = 2;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('relative_fullname' . $fieldCount)) {

                        //print_r($comment);exit;

                        $relative_cancer_name = $this->input->post('relative_cancer_name' . $fieldCount);
                        $relative_cancer_type_id = $this->record_model->get_cancer_id($relative_cancer_name);
                        if($this->input->post('relative_relationship_status') == 'paternal'){
                            
                            $paternal_status = '1';
                        } else {
                          $paternal_status = '0';  
                        }
                         if($this->input->post('relative_relationship_status') == 'maternal'){
                            
                            $maternal_status = '1';
                        } else {
                          $maternal_status = '0';  
                        }
                        
                        $data3_patient_relatives = array(
                            'patient_ic_no' => $this->input->post('IC_no'),
                            'cancer_type_id' => $relative_cancer_type_id,
                            'is_paternal' => $paternal_status,
                            'is_maternal' => $maternal_status,
                            'relatives_id' => $this->input->post('relativeTypeLists'.$fieldCount),
                            'degree_of_relativeness' => $this->input->post('degreeOfRelativeness' . $fieldCount),
                            'full_name' => $this->input->post('relative_fullname'.$fieldCount),
                            'maiden_name' => $this->input->post('relative_maiden_name' . $fieldCount),
                            'ethnicity' => $this->input->post('relative_ethnicity' . $fieldCount),
                            'town_of_residence' => $this->input->post('relative_town_residence' . $fieldCount),
                            'd_o_b' => $this->input->post('relative_DOB' . $fieldCount),
                            'is_alive_flag' => $this->input->post('relative_still_alive_flag' . $fieldCount),
                            'sex' => $this->input->post('relative_gender' . $fieldCount),
                            'd_o_d' => $this->input->post('relative_DOD' . $fieldCount),
                            'is_cancer_diagnosed' => $this->input->post('relative_is_cancer_diagnosed' . $fieldCount),
                            'date_of_diagnosis' => $this->input->post('relative_date_of_diagnosis' . $fieldCount),
                            'age_of_diagnosis' => $this->input->post('relative_age_of_diagnosis' . $fieldCount),
                            'vital_status' => $this->input->post('relative_vital_status' . $fieldCount),
                            'comments' => $this->input->post('relative_comment' . $fieldCount),
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('patient_relatives', $data3_patient_relatives);
                    }
                    //echo count($allFieldArray);
                    break;
                }
            case "parity": {

                    $fieldCount = 1;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('pregnancy_type' . $fieldCount)) {

                        //print_r($comment);exit;

                        $data_patient_parity_record = array(
                            'patient_parity_table_id' => $id,
                            'pregnancy_type' => $this->input->post('pregnancy_type' . $fieldCount),
                            'gender' => $this->input->post('child_gender' . $fieldCount),
                            'year_of_birth' => $this->input->post('child_birthyear' . $fieldCount),
                            'birthweight' => $this->input->post('child_birthweight' . $fieldCount),
                            'created_on' => $date,
                            'breastfeeding_duration' => $this->input->post('child_breastfeeding_duration' . $fieldCount)
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('patient_parity_record', $data_patient_parity_record);
                    }
                    //echo count($allFieldArray);
                    break;
                }
            case "manchester_score": {

                    $fieldCount = 2;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('ms_at_consent_BRCA1' . $fieldCount)) {

                        $data_patient_risk_assessment = array(
                            'patient_ic_no' => $this->input->post('patient_ic_no'),
                            'at_consent_mach_brca1' => $this->input->post('ms_at_consent_BRCA1' . $fieldCount),
                            'at_consent_mach_brca2' => $this->input->post('ms_at_consent_BRCA2' . $fieldCount),
                            'at_consent_mach_total' => $this->input->post('ms_at_consent_Total' . $fieldCount),
                            'after_gc_brca1' => $this->input->post('ms_after_gc_BRCA1' . $fieldCount),
                            'after_gc_brca2' => $this->input->post('ms_after_gc_BRCA2' . $fieldCount),
                            'after_gc_total' => $this->input->post('ms_after_gc_Total' . $fieldCount),
                            'adjusted_mach_brca1' => $this->input->post('ms_adjusted_gc_BRCA1' . $fieldCount),
                            'adjusted_mach_brca2' => $this->input->post('ms_adjusted_gc_BRCA2' . $fieldCount),
                            'adjusted_mach_total' => $this->input->post('ms_adjusted_gc_Total' . $fieldCount),
                            'created_on' => $date,
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('patient_risk_assessment', $data_patient_risk_assessment);
                    }
                    //echo count($allFieldArray);
                    break;
                }
            case "BOADICEA": {

                    $fieldCount = 2;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('BOADICEA_at_consent_BRCA1' . $fieldCount)) {

                        //print_r($comment);exit;

                        $data_patient_risk_assessment = array(
                            'patient_ic_no' => $this->input->post('patient_ic_no'),
                            'at_consent_boadicea_brca1' => $this->input->post('BOADICEA_at_consent_BRCA1' . $fieldCount),
                            'at_consent_boadicea_brca2' => $this->input->post('BOADICEA_at_consent_BRCA2' . $fieldCount),
                            'at_consent_boadicea_no_mutation' => $this->input->post('BOADICEA_at_consent_no_mutation' . $fieldCount),
                            'adjusted_boadicea_brca1' => $this->input->post('BOADICEA_adjusted_BRCA1' . $fieldCount),
                            'adjusted_boadicea_brca2' => $this->input->post('BOADICEA_adjusted_BRCA2' . $fieldCount),
                            'adjusted_boadicea_no_mutation' => $this->input->post('BOADICEA_adjusted_no_mutation' . $fieldCount),
                            'after_gc_boadicea_brca1' => $this->input->post('BOADICEA_after_gc_BRCA1' . $fieldCount),
                            'after_gc_boadicea_brca2' => $this->input->post('BOADICEA_after_gc_BRCA2' . $fieldCount),
                            'after_gc_boadicea_no_mutation' => $this->input->post('BOADICEA_after_gc_no_mutation' . $fieldCount),
                            'created_on' => $date,
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('patient_risk_assessment', $data_patient_risk_assessment);
                    }
                    //echo count($allFieldArray);
                    break;
                }
            case "gail_model": {

                    $fieldCount = 2;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('gail_model_at_consent_5years' . $fieldCount)) {

                        //print_r($comment);exit;

                        $data_patient_risk_assessment = array(
                            'patient_ic_no' => $this->input->post('patient_ic_no'),
                            'at_consent_gail_model_5years' => $this->input->post('gail_model_at_consent_5years' . $fieldCount),
                            'at_consent_gail_model_10years' => $this->input->post('gail_model_at_consent_10years' . $fieldCount),
                            'first_mammo_gail_model_10years' => $this->input->post('gail_model_first_mammo_10years' . $fieldCount),
                            'created_on' => $date,
                            'first_mammo_gail_model_5years' => $this->input->post('gail_model_first_mammo_5years' . $fieldCount)
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('patient_risk_assessment', $data_patient_risk_assessment);
                    }
                    //echo count($allFieldArray);
                    break;
                }
            case "mutation_analysis": {

                    $fieldCount = 2;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('investigation_project_name' . $fieldCount)) {

                        //print_r($comment);exit;

                        $studies_name = $this->input->post('studies_name');
                        $studies_id = $this->excell_sheets_model->get_studies_id($studies_name);
                        $data_keys = array(
                            'patient_ic_no' => $this->input->post('IC_no'),
                            'studies_id' => $studies_id
                        );
                        //echo '<pre>';
                        //print_r($data_keys);echo '<br/>';date_test_ordered
                        $patient_studies_id = $this->record_model->get_patient_suudies_id($data_keys);
                        //echo $patient_studies_id;echo '<br/>';
                        $data_patient_investigations = array(
                            'patient_studies_id' => $patient_studies_id,
                            'date_test_ordered' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('date_test_ordered' . $fieldCount)))),
                            'ordered_by' => $this->input->post('test_ordered_by' . $fieldCount),
                            'testing_result_notification_flag' => $this->input->post('testing_results_notification_flag' . $fieldCount),
                            'service_provider' => $this->input->post('investigation_project_name' . $fieldCount),
                            'testing_batch' => $this->input->post('investigation_project_batch' . $fieldCount),
                            'testing_date' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('investigation_project_date' . $fieldCount)))),
                            'gene_tested' => $this->input->post('investigation_gene_tested' . $fieldCount),
                            'types_of_testing' => $this->input->post('investigation_test_type' . $fieldCount),
                            'type_of_sample' => $this->input->post('investigation_sample_type' . $fieldCount),
                            'reasons' => $this->input->post('investigation_test_reason' . $fieldCount),
                            'new_mutation_flag' => $this->input->post('investigation_new_mutation_flag' . $fieldCount),
                            'test_result' => $this->input->post('investigation_test_results' . $fieldCount),
                            'investigation_test_results_other_details' => $this->input->post('investigation_test_results_other_details' . $fieldCount),
                            'carrier_status' => $this->input->post('investigation_carrier_status' . $fieldCount),
                            'mutation_nomenclature' => $this->input->post('investigation_mutation_nomenclature' . $fieldCount),
                            'exon' => $this->input->post('investigation_exon' . $fieldCount),
                            'mutation_type' => $this->input->post('investigation_mutation_type' . $fieldCount),
                            'mutation_pathogenicity' => $this->input->post('investigation_mutation_pathogenicity' . $fieldCount),
                            'report_date' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('investigation_report_date' . $fieldCount)))),
                            'date_client_notified' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('investigation_date_notified' . $fieldCount)))),
                            'is_counselling_flag' => $this->input->post('mutation_is_counselling_flag' . $fieldCount),
                            'comments' => $this->input->post('investigation_test_comment' . $fieldCount),
                            'mutation_name' => $this->input->post('investigation_mutation_name' . $fieldCount),
                            'conformation_attachment' => $this->input->post('investigation_conformation_attachment' . $fieldCount),
                            'created_on' => $date,
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('patient_mutation_analysis', $data_patient_investigations);
                    }
                    //echo count($allFieldArray);
                    break;
                }
            case "mammo_site_detail": {

                    $fieldCount = 2;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('gail_model_at_consent_5years' . $fieldCount)) {

                        //print_r($comment);exit;

                        $mammo_left_right_breast_side = $this->input->post('mammo_left_right_breast_side' . $fieldCount);
                        $mammo_upper_below_breast_side = $this->input->post('mammo_upper_below_breast_side' . $fieldCount);

                        if ($mammo_left_right_breast_side == 'Left')
                            $left_breast = TRUE;
                        else
                            $left_breast = FALSE;

                        if ($mammo_left_right_breast_side == 'Right')
                            $right_breast = TRUE;
                        else
                            $right_breast = FALSE;

                        if ($mammo_upper_below_breast_side == 'Upper')
                            $upper = TRUE;
                        else
                            $upper = FALSE;

                        if ($mammo_upper_below_breast_side == 'Below')
                            $below = TRUE;
                        else
                            $below = FALSE;

                        $data_patient_breast_abnormality = array(
                            'patient_breast_screening_id' => $patient_breast_screening_id,
                            //'description' => $this->input->post('mammo_breast_other_descriptions'),
                            'left_breast' => $left_breast,
                            'right_breast' => $right_breast,
                            'upper' => $upper,
                            'created_on' => $date,
                            'below' => $below
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('patient_breast_abnormality', $data_patient_breast_abnormality);
                    }
                    //echo count($allFieldArray);
                    break;
                }
            case "ultrasound": {

                    $fieldCount = 2;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('abnormalities_ultrasound_flag' . $fieldCount)) {

                        //print_r($comment);exit;

                        $data_patient_ultrasound_abnormality = array(
                            'is_abnormality_detected' => $this->input->post('abnormalities_ultrasound_flag' . $fieldCount),
                            'ultrasound_date' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('mammo_ultrasound_date' . $fieldCount)))),
                            'comments' => $this->input->post('mammo_ultrasound_details' . $fieldCount),
                            'created_on' => $date,
                            'patient_breast_screening_id' => $patient_breast_screening_id
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('patient_ultrasound_abnormality', $data_patient_ultrasound_abnormality);
                    }
                    //echo count($allFieldArray);
                    break;
                }
            case "MRI": {

                    $fieldCount = 2;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('abnormalities_mri_flag' . $fieldCount)) {

                        //print_r($comment);exit;

                        $data_patient_mri_abnormality = array(
                            'is_abnormality_detected' => $this->input->post('abnormalities_mri_flag' . $fieldCount),
                            'mri_date' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('mammo_mri_date' . $fieldCount)))),
                            'comments' => $this->input->post('mammo_MRI_details' . $fieldCount),
                            'patient_breast_screening_id' => $patient_breast_screening_id
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('patient_mri_abnormality', $data_patient_mri_abnormality);
                    }
                    //echo count($allFieldArray);
                    break;
                }
            case "site_lesion_surgery": {

                    $fieldCount = 2;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('non_cancerous_complete_removal_site' . $fieldCount)) {

                        //print_r($comment);exit;
                        $data_patient_risk_reducing_surgery_id = $this->input->post('non_cancerous_benign_site' . $fieldCount);
                        $non_cancerous_site_id = $this->input->post('non_cancerous_benign_site' . $fieldCount);
                        $non_cancerous_site = $this->record_model->get_non_cancerous_benign_site_id($non_cancerous_site_id);
                        $data_patient_risk_reducing_surgery_lesion = array(
                            'patient_risk_reducing_surgery_id' => $id,
                            'non_cancerous_site_id' => $non_cancerous_site,
                            'created_on' => $date,
                            'surgery_date' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('non_cancerous_benign_date' . $fieldCount))))
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('patient_risk_reducing_surgery_lesion', $data_patient_risk_reducing_surgery_lesion);
                    }
                    //echo count($allFieldArray);
                    break;
                }
            case "site_complete_removal": {

                    $fieldCount = 2;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('non_cancerous_complete_removal_site' . $fieldCount)) {

                        //print_r($comment);exit;

                        $removal_non_cancerous_site_id = $this->input->post('non_cancerous_complete_removal_site' . $fieldCount);
                        $removal_non_cancerous_site = $this->record_model->get_non_cancerous_benign_site_id($removal_non_cancerous_site_id);

                        $data_patient_risk_reducing_surgery_complete_removal = array(
                            'patient_risk_reducing_surgery_id' => $id,
                            'non_cancerous_site_id' => $removal_non_cancerous_site,
                            'surgery_date' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('non_cancerous_complete_removal_date' . $fieldCount)))),
                            'created_on' => $date,
                            'surgery_reason' => $this->input->post('non_cancerous_complete_removal_reason' . $fieldCount)
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('patient_risk_reducing_surgery_complete_removal', $data_patient_risk_reducing_surgery_complete_removal);
                    }
                    //echo count($allFieldArray);
                    break;
                }
            case "ovarian_cancer_screening": {

                    $fieldCount = 2;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('ovarian_screening_type_name' . $fieldCount)) {

                        //print_r($comment);exit;

                        $ovarian_screening_type_id = $this->input->post('ovarian_screening_type_name' . $fieldCount);
                        $ovarian_screening_type = $this->record_model->get_ovarian_screening_type($ovarian_screening_type_id);
                        $data_patient_ovarian_screening = array(
                            'patient_studies_id' => $patient_studies_id,
                            'ovarian_screening_type_id' => $ovarian_screening_type,
                            'screening_date' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('physical_exam_date' . $fieldCount)))),
                            'is_abnormality_detected' => $this->input->post('physical_exam_is_abnormality_detected' . $fieldCount),
                            'created_on' => $date,
                            'additional_info' => $this->input->post('physical_exam_additional_info' . $fieldCount)
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('patient_ovarian_screening', $data_patient_ovarian_screening);
                    }
                    //echo count($allFieldArray);
                    break;
                }
            case "other_screening": {

                    $fieldCount = 2;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('screening_name' . $fieldCount)) {

                        //print_r($comment);exit;

                        $data_patient_other_screening = array(
                            'patient_studies_id' => $patient_studies_id,
                            'screening_type' => $this->input->post('screening_name' . $fieldCount),
                            //'total_no_of_screening' => $this->input->post('total_no_of_screening'),
                            'age_at_screening' => $this->input->post('age_at_screening' . $fieldCount),
                            'screening_center' => $this->input->post('place_of_screening' . $fieldCount),
                            'created_on' => $date,
                            'screening_result' => $this->input->post('screening_results' . $fieldCount)
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('patient_other_screening', $data_patient_other_screening);
                    }
                    //echo count($allFieldArray);
                    break;
                }
            case "breast_diagnosis": {

                    $fieldCount = 2;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('cancer_site' . $fieldCount)) {

                        $patient_breast_cancer_site = $this->input->post('cancer_site' . $fieldCount); //by this we will get treatment_id
                        $breast_cancer_site_id = $a = $this->record_model->get_cancer_site_id($patient_breast_cancer_site);
                        //print_r($comment);exit;

                        $data_patient_breast_diagnosis = array(
                            'patient_studies_id' => $patient_studies_id,
                            'cancer_id' => 1,
                            'cancer_site_id' => $breast_cancer_site_id,
                            'cancer_invasive_type' => $this->input->post('cancer_invasive_type' . $fieldCount),
                            'is_primary' => $this->input->post('primary_diagnosis' . $fieldCount),
                            'date_of_diagnosis' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('date_of_diagnosis' . $fieldCount)))),
                            'age_of_diagnosis' => $this->input->post('age_of_diagnosis' . $fieldCount),
                            'diagnosis_center' => $this->input->post('cancer_diagnosis_center' . $fieldCount),
                            'doctor_name' => $this->input->post('cancer_doctor_name' . $fieldCount),
                            'detected_by' => $this->input->post('detected_by' . $fieldCount),
                            'bilateral_flag' => $this->input->post('cancer_is_bilateral' . $fieldCount),
                            'created_on' => $date,
                            'recurrence_flag' => $this->input->post('cancer_is_recurrent' . $fieldCount)
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('patient_cancer', $data_patient_breast_diagnosis);
                    }
                    //echo count($allFieldArray);
                    break;
                }
            case "breast_pathology": {

                    $fieldCount = 2;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('breast_pathology_tissue_site' . $fieldCount)) {

                        //print_r($comment);exit;

                        $data_patient_breast_pathology = array(
                            'cancer_id' => 1,
                            'patient_cancer_id' => $patient_breast_diagnosis_id,
                            'tissue_site' => $this->input->post('breast_pathology_tissue_site' . $fieldCount),
                            'type_of_report' => $this->input->post('breast_pathology_path_report_type' . $fieldCount),
                            'date_of_report' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('breast_pathology_path_report_date' . $fieldCount)))),
                            'pathology_lab' => $this->input->post('breast_pathology_lab' . $fieldCount),
                            'name_of_doctor' => $this->input->post('breast_pathology_doctor' . $fieldCount),
                            'morphology' => $this->input->post('breast_pathology_morphology' . $fieldCount),
                            't_staging' => $this->input->post('breast_pathology_tissue_tumour_stage' . $fieldCount),
                            'n_staging' => $this->input->post('breast_pathology_node_stage' . $fieldCount),
                            'm_staging' => $this->input->post('breast_pathology_metastasis_stage' . $fieldCount),
                            'tumour_stage' => $this->input->post('breast_pathology_tumour_stage' . $fieldCount),
                            'tumour_grade' => $this->input->post('breast_pathology_tumour_grade' . $fieldCount),
                            'total_lymph_nodes' => $this->input->post('breast_pathology_total_lymph_nodes' . $fieldCount),
                            'tumour_size' => $this->input->post('breast_pathology_tumour_size' . $fieldCount),
                            'created_on' => $date,
                            'comments' => $this->input->post('breast_pathology_tissue_path_comments' . $fieldCount)
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('patient_pathology', $data_patient_breast_pathology);
                    }
                    //echo count($allFieldArray);
                    break;
                }
            case "breast_status": {

                    $fieldCount = 2;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('breast_pathology_ER_status' . $fieldCount)) {

                        //print_r($comment);exit;

                        $data_patient_breast_pathology_staining = array(
                            'patient_pathology_id' => $patient_breast_pathology_id,
                            'ER_status' => $this->input->post('breast_pathology_ER_status' . $fieldCount),
                            'PR_status' => $this->input->post('breast_pathology_PR_status' . $fieldCount),
                            'created_on' => $date,
                            'HER2_status' => $this->input->post('breast_pathology_HER2_status' . $fieldCount),
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('patient_pathology_staining_status', $data_patient_breast_pathology_staining);
                    }
                    //echo count($allFieldArray);
                    break;
                }
            case "breast_treatment": {

                    $fieldCount = 2;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('patient_cancer_treatment_name' . $fieldCount)) {

                        //print_r($comment);exit;

                        $patient_cancer_treatment_name = $this->input->post('patient_cancer_treatment_name' . $fieldCount); //by this we will get treatment_id
                        $treatment_id = $this->record_model->get_treatment_id($patient_cancer_treatment_name);
                        $data_patient_breast_treatment = array(
                            'patient_cancer_id' => $patient_breast_diagnosis_id,
                            'treatment_id' => $treatment_id,
                            'treatment_start_date' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('treatment_start_date' . $fieldCount)))),
                            'treatment_end_date' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('treatment_end_date' . $fieldCount)))),
                            'treatment_durations' => $this->input->post('treatment_duration' . $fieldCount),
                            'treatment_details' => $this->input->post('treatment_details' . $fieldCount),
                            'treatment_dose' => $this->input->post('treatment_dose' . $fieldCount),
                            'treatment_cycle' => $this->input->post('treatment_cycle' . $fieldCount),
                            'treatment_frequency' => $this->input->post('treatment_frequency' . $fieldCount),
                            'treatment_visidual_desease' => $this->input->post('treatment_visidual_desease' . $fieldCount),
                            'treatment_primary_outcome' => $this->input->post('treatment_primary_therapy_outcome' . $fieldCount),
                            'created_on' => $date,
                            'comments' => $this->input->post('breast_cancer_treatment_comments' . $fieldCount)
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('patient_cancer_treatment', $data_patient_breast_treatment);
                    }
                    //echo count($allFieldArray);
                    break;
                }
            case "ovarian_cancer": {

                    $fieldCount = 2;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('ovary_cancer_site' . $fieldCount)) {

                        //print_r($comment);exit;

                        $patient_ovary_cancer_site = $this->input->post('ovary_cancer_site' . $fieldCount); //by this we will get treatment_id
                        $ovary_cancer_site_id = $this->record_model->get_cancer_site_id($patient_ovary_cancer_site);

                        $data_patient_ovary_diagnosis = array(
                            'patient_studies_id' => $patient_studies_id,
                            'cancer_id' => 2,
                            'cancer_site_id' => $ovary_cancer_site_id,
                            'cancer_invasive_type' => $this->input->post('ovary_cancer_invasive_type' . $fieldCount),
                            'is_primary' => $this->input->post('ovary_primary_diagnosis' . $fieldCount),
                            'date_of_diagnosis' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('ovary_date_of_diagnosis' . $fieldCount)))),
                            'age_of_diagnosis' => $this->input->post('ovary_age_of_diagnosis' . $fieldCount),
                            'diagnosis_center' => $this->input->post('ovary_cancer_diagnosis_center' . $fieldCount),
                            'doctor_name' => $this->input->post('ovary_cancer_doctor_name' . $fieldCount),
                            'detected_by' => $this->input->post('ovary_detected_by' . $fieldCount),
                            'bilateral_flag' => $this->input->post('ovary_cancer_is_bilateral' . $fieldCount),
                            'created_on' => $date,
                            'recurrence_flag' => $this->input->post('ovary_cancer_is_recurrent' . $fieldCount)
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('patient_cancer', $data_patient_ovary_diagnosis);
                    }
                    //echo count($allFieldArray);
                    break;
                }
            case "ovarian_pathology": {

                    $fieldCount = 2;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('ovary_pathology_tissue_site' . $fieldCount)) {

                        //print_r($comment);exit;

                        $data_patient_ovary_pathology = array(
                            'cancer_id' => 2,
                            'patient_cancer_id' => $patient_ovary_diagnosis_id,
                            'tissue_site' => $this->input->post('ovary_pathology_tissue_site' . $fieldCount),
                            'type_of_report' => $this->input->post('ovary_pathology_path_report_type' . $fieldCount),
                            'date_of_report' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('ovary_pathology_path_report_date' . $fieldCount)))),
                            'pathology_lab' => $this->input->post('ovary_pathology_lab' . $fieldCount),
                            'name_of_doctor' => $this->input->post('ovary_pathology_doctor' . $fieldCount),
                            'morphology' => $this->input->post('ovary_pathology_morphology' . $fieldCount),
                            'stage_classifications' => $this->input->post('ovary_stage_classification' . $fieldCount),
                            'tumour_stage' => $this->input->post('ovary_pathology_tumour_stage' . $fieldCount),
                            'tumour_grade' => $this->input->post('ovary_pathology_tumour_grade' . $fieldCount),
                            'tumour_size' => $this->input->post('ovary_pathology_tumour_size' . $fieldCount),
                            'no_of_report' => $this->input->post('ovary_pathology_report_no' . $fieldCount),
                            'tumor_subtype' => $this->input->post('ovary_tumor_subtypes' . $fieldCount),
                            'tumor_behaviour' => $this->input->post('ovary_tumor_behavior' . $fieldCount),
                            'tumor_differentiation' => $this->input->post('ovary_tumor_differentiation' . $fieldCount),
                            'created_on' => $date,
                            'comments' => $this->input->post('ovary_pathology_tissue_path_comments' . $fieldCount)
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('patient_pathology', $data_patient_ovary_pathology);
                    }
                    //echo count($allFieldArray);
                    break;
                }
            case "ovarian_treatment": {

                    $fieldCount = 2;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('gail_model_at_consent_5years' . $fieldCount)) {

                        //print_r($comment);exit;

                        $ovary_patient_cancer_treatment_name = $this->input->post('ovary_patient_cancer_treatment_name' . $fieldCount); //by this we will get treatment_id
                        $ovary_treatment_id = $this->record_model->get_treatment_id($ovary_patient_cancer_treatment_name);
                        $data_patient_ovary_treatment = array(
                            'patient_cancer_id' => $patient_ovary_diagnosis_id,
                            'treatment_id' => $ovary_treatment_id,
                            'treatment_start_date' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('ovary_treatment_start_date' . $fieldCount)))),
                            'treatment_end_date' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('ovary_treatment_end_date' . $fieldCount)))),
                            'treatment_durations' => $this->input->post('ovary_treatment_duration' . $fieldCount),
                            'treatment_details' => $this->input->post('ovary_treatment_details' . $fieldCount),
                            'treatment_dose' => $this->input->post('ovary_treatment_drug_dose' . $fieldCount),
                            'treatment_cycle' => $this->input->post('ovary_treatment_cycle' . $fieldCount),
                            'treatment_frequency' => $this->input->post('ovary_treatment_frequency' . $fieldCount),
                            'treatment_visidual_desease' => $this->input->post('ovary_treatment_visidual_desease' . $fieldCount),
                            'treatment_primary_outcome' => $this->input->post('oavry_treatment_primary_therapy_outcome' . $fieldCount),
                            'treatment_cal125_pretreatment' => $this->input->post('ovary_cal125_pretreatment' . $fieldCount),
                            'treatment_cal125_posttreatment' => $this->input->post('ovary_cal125_posttreatment' . $fieldCount),
                            'created_on' => $date,
                            'comments' => $this->input->post('ovary_cancer_treatment_comments' . $fieldCount)
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('patient_cancer_treatment', $data_patient_ovary_treatment);
                    }
                    //echo count($allFieldArray);
                    break;
                }
            case "other_cancer_diagnosis": {

                    $fieldCount = 2;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('gail_model_at_consent_5years' . $fieldCount)) {

                        $patient_other_cancer_site = $this->input->post('other_cancer_site' . $fieldCount); //by this we will get treatment_id
                        $other_cancer_site_id = $this->record_model->get_cancer_site_id($patient_other_cancer_site);

                        $patient_other_cancer_name = $this->input->post('other_cancer_type' . $fieldCount);
                        $other_cancer_id = $this->record_model->get_cancer_id($patient_other_cancer_name);
                        $data_patient_other_cancer_diagnosis = array(
                            'patient_studies_id' => $patient_studies_id,
                            'cancer_id' => $other_cancer_id,
                            'cancer_site_id' => $other_cancer_site_id,
                            'date_of_diagnosis' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('other_date_of_diagnosis' . $fieldCount)))),
                            'age_of_diagnosis' => $this->input->post('other_age_of_diagnosis' . $fieldCount),
                            'diagnosis_center' => $this->input->post('other_cancer_diagnosis_center' . $fieldCount),
                            'doctor_name' => $this->input->post('other_cancer_doctor_name' . $fieldCount),
                            'created_on' => $date,
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('patient_cancer', $data_patient_other_cancer_diagnosis);
                    }
                    //echo count($allFieldArray);
                    break;
                }
            case "other_cancer_pathology": {

                    $fieldCount = 2;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('gail_model_at_consent_5years' . $fieldCount)) {

                        //print_r($comment);exit;

                        $data_patient_other_cancer_pathology = array(
                            'patient_cancer_id' => $patient_other_diagnosis_id,
                            'cancer_id' => $other_cancer_id,
                            'tissue_site' => $this->input->post('other_pathology_tissue_site' . $fieldCount),
                            'type_of_report' => $this->input->post('other_pathology_path_report_type' . $fieldCount),
                            'date_of_report' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('other_pathology_path_report_date' . $fieldCount)))),
                            'pathology_lab' => $this->input->post('other_pathology_lab' . $fieldCount),
                            'name_of_doctor' => $this->input->post('other_pathology_doctor' . $fieldCount),
                            'comments' => $this->input->post('other_pathology_tissue_path_comments' . $fieldCount),
                            'created_on' => $date,
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('patient_cancer_pathology', $data_patient_other_cancer_pathology);
                    }
                    //echo count($allFieldArray);
                    break;
                }
            case "other_cancer_treatment": {

                    $fieldCount = 2;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('gail_model_at_consent_5years' . $fieldCount)) {

                        //print_r($comment);exit;

                        $patient_other_cancer_treatment_name = $this->input->post('other_patient_cancer_treatment_name' . $fieldCount); //by this we will get treatment_id
                        $other_cancer_treatment_id = $this->record_model->get_treatment_id($patient_other_cancer_treatment_name);
                        $data_patient_other_cancer_treatment = array(
                            'patient_cancer_id' => $patient_other_diagnosis_id,
                            'treatment_id' => $other_cancer_treatment_id,
                            'treatment_start_date' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('other_treatment_start_date' . $fieldCount)))),
                            'treatment_end_date' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('other_treatment_end_date' . $fieldCount)))),
                            'treatment_durations' => $this->input->post('other_treatment_duration' . $fieldCount),
                            'treatment_details' => $this->input->post('other_treatment_details' . $fieldCount),
                            'treatment_dose' => $this->input->post('other_treatment_drug_dose' . $fieldCount),
                            'treatment_cycle' => $this->input->post('other_treatment_cycle' . $fieldCount),
                            'treatment_frequency' => $this->input->post('other_treatment_frequency' . $fieldCount),
                            'treatment_visidual_desease' => $this->input->post('other_treatment_visidual_desease' . $fieldCount),
                            'treatment_primary_outcome' => $this->input->post('other_treatment_primary_therapy_outcome' . $fieldCount),
                            'created_on' => $date,
                            'comments' => $this->input->post('other_cancer_treatment_comments' . $fieldCount)
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('patient_risk_assessment', $data_patient_risk_assessment);
                    }
                    //echo count($allFieldArray);
                    break;
                }
            case "other_disease": {

                    $fieldCount = 2;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('diagnosis_name' . $fieldCount)) {

                        $patient_diagnosis = $this->input->post('diagnosis_name' . $fieldCount); //by this we will get treatment_id
                        $other_diagnosis_id = $this->record_model->get_diagnosis_id($patient_diagnosis);

                        $data_patient_other_diseases = array(
                            'patient_studies_id' => $patient_studies_id,
                            'diagnosis_id' => $other_diagnosis_id,
                            'date_of_diagnosis' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('year_of_diagnosis' . $fieldCount)))),
                            'diagnosis_age' => $this->input->post('diagnosis_age' . $fieldCount),
                            'diagnosis_center' => $this->input->post('diagnosis_center' . $fieldCount),
                            'doctor_name' => $this->input->post('diagnosis_doctor_name' . $fieldCount),
                            'created_on' => $date,
                            'on_medication_flag' => $this->input->post('is_on_medication_flag' . $fieldCount)
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('patient_other_disease', $data_patient_other_diseases);
                    }
                    //echo count($allFieldArray);
                    break;
                }
            case "medication": {

                    $fieldCount = 2;
                    $allFieldArray = array();
                    $date = date('Y-m-d H:i:s'); //Returns IST

                    while ($this->input->post('medication_type_name' . $fieldCount)) {

                        //print_r($comment);exit;

                        $data_patient_other_diseases_medication = array(
                            'patient_other_disease_id' => $patient_other_diseases_id,
                            'medication_type' => $this->input->post('medication_type_name' . $fieldCount),
                            'start_date' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('medication_start_date' . $fieldCount)))),
                            'end_date' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('medication_end_date' . $fieldCount)))),
                            'duration' => $this->input->post('medication_duration' . $fieldCount),
                            'created_on' => $date,
                            'comments' => $this->input->post('medication_comments' . $fieldCount)
                        );

                        $fieldCount++;
                        // array_push($allFieldArray, $data_patient_interview_manager);
                        $this->db->insert('patient_other_disease_medication', $data_patient_other_diseases_medication);
                    }
                    //echo count($allFieldArray);
                    break;
                }
        }
    }

    function patient_record_update() {

        date_default_timezone_set("Asia/Kuala_lumpur");
        $date = date('Y-m-d H:i:s'); //Returns IST     

        $patient_ic_no = $this->input->post('IC_no');
        $patient_contact_person_id = $this->input->post('patient_contact_person_id');
        $patient_hospital_no_id = $this->input->post('patient_hospital_no_id');
        $patient_private_no_id = $this->input->post('patient_private_no_id');
        $patient_survival_status_id = $this->input->post('patient_survival_status_id');
        $COGS_studies_id = $this->input->post('COGS_studies_id');
        $patient_relatives_summary_id = $this->input->post('patient_relatives_summary_id');
        $patient_studies_id = $this->input->post('patient_studies_id');
        $dod = $this->input->post('d_o_d');
        $dob = $this->input->post('d_o_b');

        $data_patient = array(
            'given_name' => $this->input->post('fullname'),
            'surname' => $this->input->post('surname'),
            'maiden_name' => $this->input->post('maiden_name'),
            'family_no' => $this->input->post('family_no'),
            'nationality' => $this->input->post('nationality'),
            'gender' => $this->input->post('gender'),
            'ethnicity' => $this->input->post('ethnicity'),
            'd_o_b' => $dob == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($dob)),
            'place_of_birth' => $this->input->post('place_of_birth'),
            'income_level' => $this->input->post('income_level'),
            'is_dead' => $this->input->post('is_dead'),
            'd_o_d' => $dod == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($dod)),
            'reason_of_death' => $this->input->post('reason_of_death'),
            //'padigree_labelling' => $this->input->post('padigree_labelling'),
            'blood_group' => $this->input->post('blood_group'),
            //'private_patient_no' => $this->input->post('private_patient_no'), patient_private_no
            'marital_status' => $this->input->post('marital_status'),
            'blood_card' => $this->input->post('is_blood_card_exist'),
            'blood_card_location' => $this->input->post('blood_card_location'),
            //'cogs_study_id' => $this->input->post('COGS_study_id'),
            'address' => $this->input->post('address'),
            'home_phone' => $this->input->post('home_phone'),
            'cell_phone' => $this->input->post('cell_phone'),
            'work_phone' => $this->input->post('work_phone'),
            'other_phone' => $this->input->post('other_phone'),
            'fax' => $this->input->post('fax'),
            'email' => $this->input->post('email'),
            'height' => $this->input->post('height'),
            'weight' => $this->input->post('weight'),
            'bmi' => $this->input->post('BMI'),
            'created_on' => $date,
            'comment' => $this->input->post('patient_comments'),
            'highest_education_level' => $this->input->post('highest_education_level')
        );

        //print_r($data_patient);exit;
        $this->db->where('ic_no', $patient_ic_no);
        $this->db->update('patient', $data_patient);

        if ($this->db->affected_rows() > 0) {
            echo '<h2>Data update successfully<h2>';
        } else {
            echo '<h2>No update data</h2>';
        }
        echo '<br/>';


        if (!empty($patient_contact_person_id)) {
            $data_patient_contact_person = array(
                'contact_name' => $this->input->post('contact_person_name'),
                'contact_relationship' => $this->input->post('contact_person_relationship'),
                'created_on' => $date,
                'contact_telephone' => $this->input->post('contact_person_phone_number')
            );

            $this->db->where('patient_contact_person_id', $patient_contact_person_id);
            $this->db->update('patient_contact_person', $data_patient_contact_person);
            // print_r($data_patient_contact_person);

            if ($this->db->affected_rows() > 0) {
                echo '<h2>Data update successfully<h2>';
            } else {
                echo '<h2>No update data</h2>';
            }
            echo '<br/>';
        }

        if (!empty($patient_hospital_no_id)) {
            $data_patient_hospital_no = array(
                'modified_on' => $date,
                'hospital_no' => $this->input->post('hospital_no')
            );

            $this->db->where('patient_hospital_no_ID', $patient_hospital_no_id);
            $this->db->update('patient_hospital_no', $data_patient_hospital_no);
            // print_r($data_patient_contact_person);

            if ($this->db->affected_rows() > 0) {
                echo '<h2>Data update successfully<h2>';
            } else {
                echo '<h2>No update data</h2>';
            }
            echo '<br/>';
        }

        if (!empty($patient_private_no_id)) {
            $data_patient_private_no = array(
                'modified_on' => $date,
                'private_no' => $this->input->post('private_patient_no')
            );

            $this->db->where('patient_private_no_id', $patient_private_no_id);
            $this->db->update('patient_private_no', $data_patient_private_no);

            if ($this->db->affected_rows() > 0) {
                echo '<h2>Data update successfully<h2>';
            } else {
                echo '<h2>No update data</h2>';
            }
            echo '<br/>';
        }

        $alive_status = $this->input->post('alive_status');

        if ($alive_status == 'Alive')
            $alive_status_flag = TRUE;
        else if ($alive_status == 'Dead')
            $alive_status_flag = FALSE;
        else
            $alive_status_flag = FALSE;

        $status_gathering_date = $this->input->post('status_gathered_date');

        if (!empty($patient_survival_status_id)) {
            $data_patient_survival_status = array(
                'alive_status' => $alive_status_flag,
                'status_gathering_date' => $status_gathering_date == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($status_gathering_date)),
                'created_on' => $date,
                'source' => $this->input->post('status_source')
            );

            $this->db->where('patient_survival_status_id', $patient_survival_status_id);
            $this->db->update('patient_survival_status', $data_patient_survival_status);

            if ($this->db->affected_rows() > 0) {
                echo '<h2>Data update successfully<h2>';
            } else {
                echo '<h2>No update data</h2>';
            }
            echo '<br/>';
        }

        if (!empty($COGS_studies_id)) {
            $data_patient_COGS_study = array(
                'COGS_studies_name' => $this->input->post('COGS_studies_id'),
                'modified_on' => $date,
                'COGS_studies_no' => $this->input->post('COGS_studies_no')
            );

            $this->db->where('COGS_studies_id', $COGS_studies_id);
            $this->db->update('patient_COGS_studies', $data_patient_COGS_study);

            if ($this->db->affected_rows() > 0) {
                echo '<h2>Data update successfully<h2>';
            } else {
                echo '<h2>No update data</h2>';
            }
            echo '<br/>';
        }

        /* NOTE: Call getDynamicFieldsInputsArray() function to fetch the data array of dynamic fields. Parameter: Name of dynamic field's section */
        //$dynamicFieldsArray = $this->getDynamicFieldsInputsArray("survival_status");

        if (!empty($patient_relatives_summary_id)) {
            $data_patient_relatives_summary = array(
                'total_no_of_male_siblings' => $this->input->post('total_no_of_male_siblings'),
                'total_no_of_female_siblings' => $this->input->post('total_no_of_female_siblings'),
                'total_no_of_affected_siblings' => $this->input->post('total_no_of_affected_siblings'),
                'total_no_of_male_children' => $this->input->post('total_no_male_children'),
                'total_no_of_female_children' => $this->input->post('total_no_female_children'),
                'total_no_of_affected_children' => $this->input->post('total_no_of_affected_children'),
                'total_no_of_1st_degree' => $this->input->post('total_no_of_first_degree'),
                'total_no_of_2nd_degree' => $this->input->post('total_no_of_second_degree'),
                'total_no_of_3rd_degree' => $this->input->post('total_no_of_third_degree'),
                'created_on' => $date,
                'total_no_of_siblings' => $this->input->post('total_no_of_siblings')
                    //'unknown_reason_is_adopted' => $this->input->post('unknown_reason_is_adopted'),
                    //'unknown_reason_in_other_countries' => $this->input->post('unknown_reason_in_other_countries')
            );

            $this->db->where('patient_relatives_summary_id', $patient_relatives_summary_id);
            $this->db->update('patient_relatives_summary', $data_patient_relatives_summary);

            if ($this->db->affected_rows() > 0) {
                echo '<h2>Data update successfully<h2>';
            } else {
                echo '<h2>No update data</h2>';
            }
            echo '<br/>';
        }
        //print_r($data_patient_relatives_summary);


        $consent_studies_id = $this->input->post('studies_name');
        $date_at_consent = $this->input->post('date_at_consent');
        $age_at_consent = $this->input->post('age_at_consent');
        $double_consent_flag = $this->input->post('is_double_consent_flag');
        $consent_given_by = $this->input->post('consent_given_by');
        $consent_response = $this->input->post('consent_response');
        $consent_version = $this->input->post('consent_version');
        $relation_to_study = $this->input->post('relations_to_study');
        $referral_to = $this->input->post('referral_to');
        $referral_to_genetic_counselling = $this->input->post('referral_date');
        $referral_source = $this->input->post('referral_source');
        
        $double_consent_flag_check = $this->record_model->update_checkbox($double_consent_flag,'double_consent_flag','patient_studies_id','patient_studies');
        $double_consent_flag_uncheck = $this->record_model->update_checkbox_uncheck($patient_ic_no,$double_consent_flag,'patient_studies_id','double_consent_flag','patient_ic_no','patient_studies');

        if (!empty($patient_studies_id)) {
            for ($i = 0; $i < count($patient_studies_id); $i++) {

                $studies_id = $this->record_model->get_studies_id($consent_studies_id[$i]);

                $data_patient_consent_detail = array(
                    'date_at_consent' => $date_at_consent[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($date_at_consent[$i])),
                    'age_at_consent' => $age_at_consent[$i],
                    'studies_id' => $studies_id,
//                    'double_consent_flag' => $double_consent_flag[$i],
                    'consent_given_by' => $consent_given_by[$i],
                    'consent_response' => $consent_response[$i],
                    'consent_version' => $consent_version[$i],
                    'relation_to_study' => $relation_to_study[$i],
                    'referral_to' => $referral_to[$i],
                    'modified_on' => $date,
                    'referral_to_genetic_counselling' => $referral_to_genetic_counselling[$i],
                    'referral_source' => $referral_source[$i]
                );

                //print_r($data_patient_consent_detail);exit;
                $this->db->where('patient_studies_id', $patient_studies_id[$i]);
                $this->db->update('patient_studies', $data_patient_consent_detail);

                if ($this->db->affected_rows() > 0) {
                    echo '<h2>Data for id ' . $i . ' update successfully<h2>';
                } else {
                    echo '<h2>No update data for id ' . $i . '</h2>';
                }
                echo '<br/>';
            }
        }
    }

    function patient_record_insertion() {
        //print_r($this->input->post());
        //$data = array();
        //validate form input
//        $dod = date('Y-m-d',strtotime($this->input->post('d_o_d')));
//        
//        print_r($dod);exit;

        date_default_timezone_set("Asia/Kuala_lumpur");
        $date = date('Y-m-d H:i:s'); //Returns IST        

        $this->form_validation->set_rules('fullname', 'Full name', 'required|xss_clean');
        if ($this->form_validation->run() == true) {

            $ic_no = $this->input->post('IC_no');
            $old_ic_no = $this->input->post('old_IC_no');

            if (!empty($old_ic_no)) {

                $new_ic_no = substr($old_ic_no, 1);
                ;
            } else {

                $new_ic_no = $ic_no;
            }

            $dob = $this->input->post('d_o_b');
            $dod = $this->input->post('d_o_d');

            $data_patient = array(
                'given_name' => $this->input->post('fullname'),
                'surname' => $this->input->post('surname'),
                'maiden_name' => $this->input->post('maiden_name'),
                'family_no' => $this->input->post('family_no'),
                'ic_no' => $new_ic_no,
                'old_ic_no' => $old_ic_no,
                'nationality' => $this->input->post('nationality'),
                'gender' => $this->input->post('gender'),
                'ethnicity' => $this->input->post('ethnicity'),
                'd_o_b' => $dob == '' ? '0000-00-00' : date("Y-m-d", strtotime($dob)),
                'place_of_birth' => $this->input->post('place_of_birth'),
                'income_level' => $this->input->post('income_level'),
                'is_dead' => $this->input->post('is_dead'),
                'd_o_d' => $dod == '' ? '0000-00-00' : date("Y-m-d", strtotime($dod)),
                'reason_of_death' => $this->input->post('reason_of_death'),
                //'padigree_labelling' => $this->input->post('padigree_labelling'),
                'blood_group' => $this->input->post('blood_group'),
                //'private_patient_no' => $this->input->post('private_patient_no'),
                'marital_status' => $this->input->post('marital_status'),
                'blood_card' => $this->input->post('is_blood_card_exist'),
                'blood_card_location' => $this->input->post('blood_card_location'),
                //'cogs_study_id' => $this->input->post('COGS_study_id'),
                'address' => $this->input->post('address'),
                'home_phone' => $this->input->post('home_phone'),
                'cell_phone' => $this->input->post('cell_phone'),
                'work_phone' => $this->input->post('work_phone'),
                'other_phone' => $this->input->post('other_phone'),
                'fax' => $this->input->post('fax'),
                'email' => $this->input->post('email'),
                'height' => $this->input->post('height'),
                'weight' => $this->input->post('weight'),
                'bmi' => $this->input->post('BMI'),
                'created_on' => $date,
                'comment' => $this->input->post('patient_comments'),
                'highest_education_level' => $this->input->post('highest_education_level')
            );
            echo '<pre>';
            //print_r($data_patient);exit;
            echo '<br/>';
            $data_patient_contact_person = array(
                'patient_ic_no' => $new_ic_no,
                'contact_name' => $this->input->post('contact_person_name'),
                'contact_relationship' => $this->input->post('contact_person_relationship'),
                'created_on' => $date,
                'contact_telephone' => $this->input->post('contact_person_phone_number')
            );
            // print_r($data_patient_contact_person);
            //echo '<br/>';
            //array_push($data, $this->input->post('firstname'));
            $id_patient_record = $this->record_model->insert_at_patient_record($data_patient);
            if ($id_patient_record > 0) {

                echo "<h2>Data Added successfully at patient_studies table</h2>";
            } else {
                echo "<h2>Failed to insert at patient_studies table</h2>";
            }
            echo '<br/>';

            $id_patient_contact_person = $this->record_model->insert_at_patient_contact_person($data_patient_contact_person);
            if ($id_patient_contact_person > 0) {
                echo "<h2>Data Added successfully at patient_contact_person table</h2>";
            } else {
                echo "<h2>Failed to insert at patient_contact_person table</h2>";
            }
            echo '<br/>';

            $data_patient_hospital_no = array(
                'patient_ic_no' => $new_ic_no,
                'created_on' => $date,
                'hospital_no' => $this->input->post('hospital_no')
            );
            // print_r($data_patient_contact_person);
            //echo '<br/>';
            //array_push($data, $this->input->post('firstname'));
            $id_patient_hospital_no = $this->db->insert('patient_hospital_no', $data_patient_hospital_no);

            $add_hospital_no = $this->getDynamicFieldsInputsArray("hospital_no");

            if ($id_patient_hospital_no > 0) {
                echo "<h2>Data Added successfully at Patient_hospital_no table</h2>";
            } else {
                echo "<h2>Failed to insert at Patient_hospital_no table</h2>";
            }
            echo '<br/>';

            $data_patient_private_no = array(
                'patient_ic_no' => $new_ic_no,
                'created_on' => $date,
                'private_no' => $this->input->post('private_patient_no')
            );
            // print_r($data_patient_contact_person);

            $id_patient_private_no = $this->db->insert('patient_private_no', $data_patient_private_no);

            $add_patient_private_no = $this->getDynamicFieldsInputsArray("patient_private_no");

            if ($id_patient_private_no > 0) {
                echo "<h2>Data Added successfully at patient_private_no table</h2>";
            } else {
                echo "<h2>Failed to insert at patient_private_no table</h2>";
            }
            echo '<br/>';

            $alive_status = $this->input->post('alive_status');

            if ($alive_status == 'Alive')
                $alive_status_flag = TRUE;
            else if ($alive_status == 'Dead')
                $alive_status_flag = FALSE;
            else
                $alive_status_flag = FALSE;

            $gathering_date = $this->input->post('status_gathered_date');

            $data_patient_survival_status = array(
                'patient_ic_no' => $new_ic_no,
                'source' => $this->input->post('recurrence_site'),
                'alive_status' => $alive_status_flag,
                'status_gathering_date' => $gathering_date == '' ? '0000-00-00' : date("Y-m-d", strtotime($gathering_date)),
                'created_on' => $date,
                'source' => $this->input->post('status_source')
            );

            $patient_survival_status_id = $this->record_model->insert_patient_survival_status($data_patient_survival_status);

            $add_survival_status = $this->getDynamicFieldsInputsArray("survival_status");

            if ($patient_survival_status_id > 0) {
                echo "<h2>Data Added successfully at patient_survival_status table</h2>";
            } else {
                echo "<h2>Failed to insert at patient_survival_status table</h2>";
            }
            echo '<br/>';

            $data_patient_COGS_study = array(
                'patient_ic_no' => $new_ic_no,
                'COGS_studies_name' => $this->input->post('COGS_studies_id'),
                'created_on' => $date,
                'COGS_studies_no' => $this->input->post('COGS_studies_no')
            );

            $patient_COGS_study_id = $this->db->insert('patient_cogs_studies', $data_patient_COGS_study);

            $add_COGS_study = $this->getDynamicFieldsInputsArray("COGS_study");

            if ($patient_COGS_study_id > 0) {
                echo "<h2>Data Added successfully at patient_cogs_studies table</h2>";
            } else {
                echo "<h2>Failed to insert at patient_cogs_studies table</h2>";
            }
            echo '<br/>';

            /* NOTE: Call getDynamicFieldsInputsArray() function to fetch the data array of dynamic fields. Parameter: Name of dynamic field's section */
            //$dynamicFieldsArray = $this->getDynamicFieldsInputsArray("survival_status");

            $data_patient_relatives_summary = array(
                'patient_ic_no' => $new_ic_no,
                'total_no_of_male_siblings' => $this->input->post('total_no_of_male_siblings'),
                'total_no_of_female_siblings' => $this->input->post('total_no_of_female_siblings'),
                'total_no_of_affected_siblings' => $this->input->post('total_no_of_affected_siblings'),
                'total_no_of_male_children' => $this->input->post('total_no_male_children'),
                'total_no_of_female_children' => $this->input->post('total_no_female_children'),
                'total_no_of_affected_children' => $this->input->post('total_no_of_affected_children'),
                'total_no_of_1st_degree' => $this->input->post('total_no_of_first_degree'),
                'total_no_of_2nd_degree' => $this->input->post('total_no_of_second_degree'),
                'total_no_of_3rd_degree' => $this->input->post('total_no_of_third_degree'),
                'created_on' => $date,
                'total_no_of_siblings' => $this->input->post('total_no_of_siblings')
                    //'unknown_reason_is_adopted' => $this->input->post('unknown_reason_is_adopted'),
                    //'unknown_reason_in_other_countries' => $this->input->post('unknown_reason_in_other_countries')
            );
            //print_r($data_patient_relatives_summary);
            $patient_relatives_summary_id = $this->record_model->insert_patient_relatives_summary($data_patient_relatives_summary);
            if ($patient_relatives_summary_id > 0) {
                echo "<h2>Data Added successfully at patient_relatives_summary table</h2>";
            } else {
                echo "<h2>Failed to insert at patient_relatives_summary table</h2>";
            }
            echo '<br/>';

            $consent_studies_id = $this->input->post('studies_name');
            $studies_id = $this->record_model->get_studies_id($consent_studies_id);
            $consent_date = $this->input->post('date_at_consent');
            $referral_date = $this->input->post('referral_date');

            $data_patient_consent_detail = array(
                'patient_ic_no' => $new_ic_no,
                'studies_id' => $studies_id,
                'date_at_consent' => $consent_date == '' ? '0000-00-00' : date("Y-m-d", strtotime($consent_date)),
                'age_at_consent' => $this->input->post('age_at_consent'),
                'double_consent_flag' => $this->input->post('is_double_consent_flag'),
                'consent_given_by' => $this->input->post('consent_given_by'),
                'consent_response' => $this->input->post('consent_response'),
                'consent_version' => $this->input->post('consent_version'),
                'relation_to_study' => $this->input->post('relations_to_study'),
                'referral_to' => $this->input->post('referral_to'),
                'created_on' => $date,
                'referral_to_genetic_counselling' => $referral_date,
                'referral_source' => $this->input->post('referral_source')
            );
            //print_r($data_patient_relatives_summary);
            $data_patient_consent_detail_id = $this->record_model->insert_patient_studies($data_patient_consent_detail);
            if ($data_patient_consent_detail_id > 0) {
                echo "<h2>Data Added successfully at patient_consent_detail table</h2>";
            } else {
                echo "<h2>Failed to insert at patient_consent_detail table</h2>";
            }
            echo '<br/>';
        } else {
            print_r(validation_errors());
        }
    }

    public function patient_family_record_insertion() {
        //print_r($this->input->post());
        //$data = array();
        //validate form input

        date_default_timezone_set("Asia/Kuala_lumpur");
        $date = date('Y-m-d H:i:s'); //Returns IST 

        $this->form_validation->set_rules('mother_fullname', 'Full name', 'required|xss_clean');
        if ($this->form_validation->run() == true) {

            $father_cancer_name = $this->input->post('father_cancer_name');
            $father_cancer_type_id = $this->record_model->get_cancer_id($father_cancer_name);
            $f_dob = $this->input->post('father_DOB');
            $f_dod = $this->input->post('father_DOD');
            $f_diagnosis_date = $this->input->post('father_date_of_diagnosis');

            $data1_patient_relatives = array(
                'patient_ic_no' => $this->input->post('IC_no'),
                'relatives_id' => 1,
                'family_no' => $this->input->post('family_no'),
                'full_name' => $this->input->post('father_fullname'),
                'sur_name' => $this->input->post('father_surname'),
                'maiden_name' => $this->input->post('father_maiden_name'),
                'ethnicity' => $this->input->post('father_ethncity'),
                'town_of_residence' => $this->input->post('father_town_residence'),
                'd_o_b' => $f_dob == '' ? '0000-00-00' : date("Y-m-d", strtotime($f_dob)),
                'is_alive_flag' => $this->input->post('father_still_alive_flag'),
                'd_o_d' => $f_dod == '' ? '0000-00-00' : date("Y-m-d", strtotime($f_dod)),
                'is_cancer_diagnosed' => $this->input->post('father_is_cancer_diagnosed'),
                'date_of_diagnosis' => $f_diagnosis_date == '' ? '0000-00-00' : date("Y-m-d", strtotime($f_diagnosis_date)),
                'cancer_type_id' => $father_cancer_type_id,
                'age_of_diagnosis' => $this->input->post('father_age_of_diagnosis'),
                'other_detail' => $this->input->post('father_diagnosis_other_details'),
                'no_of_brothers' => $this->input->post('father_no_of_brothers'),
                'no_of_sisters' => $this->input->post('father_no_of_sisters'),
                'total_half_sisters' => $this->input->post('father_no_of_half_sisters'),
                'total_half_brothers' => $this->input->post('father_no_of_half_brothers'),
                'is_adopted' => $this->input->post('father_unknown_reason_is_adopted'),
                'is_in_other_country' => $this->input->post('father_unknown_reason_in_other_countries'),
                'created_on' => $date,
                'comments' => $this->input->post('father_comments'),
                'vital_status' => $this->input->post('father_vital_status')
                    //'match_score_at_consent' => $this->input->post('father_mach_score_at_consent'),
                    //'match_score_past_consent' => $this->input->post('father_mach_score_past_consent'),
                    //'fh_category' => $this->input->post('father_FH_category')
            );

            $add_father = $this->getDynamicFieldsInputsArray("father_cancer");

            $mother_cancer_name = $this->input->post('mother_cancer_name');
            $mother_cancer_type_id = $this->record_model->get_cancer_id($mother_cancer_name);
            $m_dob = $this->input->post('mother_DOB');
            $m_dod = $this->input->post('mother_DOD');
            $m_diagnosis_date = $this->input->post('mother_date_of_diagnosis');

            $data2_patient_relatives = array(
                'patient_ic_no' => $this->input->post('IC_no'),
                'relatives_id' => 2,
                'family_no' => $this->input->post('family_no'),
                'full_name' => $this->input->post('mother_fullname'),
                'sur_name' => $this->input->post('mother_surname'),
                'maiden_name' => $this->input->post('mother_maiden_name'),
                'ethnicity' => $this->input->post('mother_ethnicity'),
                'town_of_residence' => $this->input->post('mother_town_residence'),
                'd_o_b' => $m_dob == '' ? '0000-00-00' : date("Y-m-d", strtotime($m_dob)),
                'is_alive_flag' => $this->input->post('mother_still_alive_flag'),
                'd_o_d' => $m_dod == '' ? '0000-00-00' : date("Y-m-d", strtotime($m_dod)),
                'is_cancer_diagnosed' => $this->input->post('mother_is_cancer_diagnosed'),
                'date_of_diagnosis' => $m_diagnosis_date == '' ? '0000-00-00' : date("Y-m-d", strtotime($m_diagnosis_date)),
                'cancer_type_id' => $mother_cancer_type_id,
                'age_of_diagnosis' => $this->input->post('mother_age_of_diagnosis'),
                'other_detail' => $this->input->post('mother_diagnosis_other_details'),
                'no_of_brothers' => $this->input->post('mother_no_of_brothers'),
                'total_half_sisters' => $this->input->post('mother_no_of_half_sisters'),
                'total_half_brothers' => $this->input->post('mother_no_of_half_brothers'),
                'no_of_sisters' => $this->input->post('mother_no_of_sisters'),
                'created_on' => $date,
                'is_adopted' => $this->input->post('mother_unknown_reason_is_adopted'),
                'comments' => $this->input->post('mother_comments'),
                'is_in_other_country' => $this->input->post('mother_unknown_reason_in_other_countries'),
                'vital_status' => $this->input->post('mother_vital_status')
                    //'match_score_at_consent' => $this->input->post('mother_mach_score_at_consent'),
                    //'match_score_past_consent' => $this->input->post('mother_mach_score_past_consent'),
                    //'fh_category' => $this->input->post('mother_FH_category')
            );

            $add_mother = $this->getDynamicFieldsInputsArray("mother_cancer");
            echo '<pre>';
            //print_r($data1_patient_relatives);
            //print_r($data2_patient_relatives);
            //array_push($data, $this->input->post('firstname'));
            $id1_patient_relatives = $this->record_model->insert_patient_family_record($data1_patient_relatives);
            if ($id1_patient_relatives > 0) {
                echo "<h2>Data Added successfully at patient_relatives1</h2>";
            } else {
                echo "<h2>Failed to insert patient_relatives1</h2>";
            }
            echo '<br/>';

            $id2_patient_relatives = $this->record_model->insert_patient_family_record($data2_patient_relatives);
            if ($id2_patient_relatives > 0) {
                echo "<h2>Data Added successfully at patient_relatives2</h2>";
            } else {
                echo "<h2>Failed to insert patient_relatives2</h2>";
            }
            echo '<br/>';
            
            $relative_cancer_name = $this->input->post('relative_cancer_name');
                        $relative_cancer_type_id = $this->record_model->get_cancer_id($relative_cancer_name);
                        if($this->input->post('relative_relationship_status') == 'paternal'){
                            
                            $paternal_status = '1';
                        } else {
                          $paternal_status = '0';  
                        }
                         if($this->input->post('relative_relationship_status') == 'maternal'){
                            
                            $maternal_status = '1';
                        } else {
                          $maternal_status = '0';  
                        }
                        
                        
                        $data3_patient_relatives = array(
                            'patient_ic_no' => $this->input->post('IC_no'),
                            'cancer_type_id' => $relative_cancer_type_id,
                            'is_paternal' => $paternal_status,
                            'is_maternal' => $maternal_status,
                            'relatives_id' => $this->input->post('relativeTypeLists'),
                            'degree_of_relativeness' => $this->input->post('degreeOfRelativeness'),
                            'full_name' => $this->input->post('relative_fullname'),
                            'maiden_name' => $this->input->post('relative_maiden_name'),
                            'ethnicity' => $this->input->post('relative_ethnicity'),
                            'town_of_residence' => $this->input->post('relative_town_residence'),
                            'd_o_b' => $this->input->post('relative_DOB'),
                            'is_alive_flag' => $this->input->post('relative_still_alive_flag'),
                            'sex' => $this->input->post('relative_gender'),
                            'd_o_d' => $this->input->post('relative_DOD'),
                            'is_cancer_diagnosed' => $this->input->post('relative_is_cancer_diagnosed'),
                            'date_of_diagnosis' => $this->input->post('relative_date_of_diagnosis'),
                            'age_of_diagnosis' => $this->input->post('relative_age_of_diagnosis'),
                            'vital_status' => $this->input->post('relative_vital_status'),
                            'comments' => $this->input->post('relative_comment'),
                        );
                       
            $id3_patient_relatives = $this->record_model->insert_patient_family_record($data3_patient_relatives);
            
             $add_relative = $this->getDynamicFieldsInputsArray("relative_cancer");
            if ($id3_patient_relatives > 0) {
                echo "<h2>Data Added successfully at patient_relatives3</h2>";
            } else {
                echo "<h2>Failed to insert patient_relatives3</h2>";
            }
            echo '<br/>';
        } else {
            print_r(validation_errors());
        }
    }

    public function patient_family_record_update() {
        //print_r($this->input->post());
        //$data = array();
        //validate form input

        date_default_timezone_set("Asia/Kuala_lumpur");
        $date = date('Y-m-d H:i:s'); //Returns IST
        $patient_ic_no = $this->input->post('patient_ic_no');

        $father_relatives_id = $this->input->post('father_relatives_id');
        $father_cancer_name = $this->input->post('father_cancer_name');
        $family_no = $this->input->post('family_no');
        $full_name = $this->input->post('father_fullname');
        $sur_name = $this->input->post('father_surname');
        $maiden_name = $this->input->post('father_maiden_name');
        $ethnicity = $this->input->post('father_ethncity');
        $town_of_residence = $this->input->post('father_town_residence');
        $d_o_b = $this->input->post('father_DOB');
        $is_alive_flag = $this->input->post('father_still_alive_flag');
        $d_o_d = $this->input->post('father_DOD');
        $is_cancer_diagnosed = $this->input->post('father_is_cancer_diagnosed');
        $date_of_diagnosis = $this->input->post('father_date_of_diagnosis');
        //$cancer_type_id = $father_cancer_type_id;
        $age_of_diagnosis = $this->input->post('father_age_of_diagnosis');
        $other_detail = $this->input->post('father_diagnosis_other_details');
        $no_of_brothers = $this->input->post('father_no_of_brothers');
        $no_of_sisters = $this->input->post('father_no_of_sisters');
        $total_half_sisters = $this->input->post('father_no_of_half_sisters');
        $total_half_brothers = $this->input->post('father_no_of_half_brothers');
        $is_adopted = $this->input->post('father_unknown_reason_is_adopted');
        $is_in_other_country = $this->input->post('father_unknown_reason_in_other_countries');
        $comments = $this->input->post('father_comments');
        $vital_status = $this->input->post('father_vital_status');

            $f_cancer_diagnose_check = $this->record_model->update_checkbox($is_cancer_diagnosed,'is_cancer_diagnosed','patient_relatives_id','patient_relatives');
            $f_cancer_diagnose_uncheck = $this->record_model->update_checkbox_uncheck($patient_ic_no,$is_cancer_diagnosed,'patient_relatives_id','is_cancer_diagnosed','patient_ic_no','patient_relatives');

            $f_still_alive_check = $this->record_model->update_checkbox($is_alive_flag,'is_alive_flag','patient_relatives_id','patient_relatives');
            $f_still_alive_uncheck = $this->record_model->update_checkbox_uncheck($patient_ic_no,$is_alive_flag,'patient_relatives_id','is_alive_flag','patient_ic_no','patient_relatives');
            
            $f_is_adopted_check = $this->record_model->update_checkbox($is_adopted,'is_adopted','patient_relatives_id','patient_relatives');
            $f_is_adopted_uncheck = $this->record_model->update_checkbox_uncheck($patient_ic_no,$is_adopted,'patient_relatives_id','is_adopted','patient_ic_no','patient_relatives');
            
            $f_other_country_check = $this->record_model->update_checkbox($is_in_other_country,'is_in_other_country','patient_relatives_id','patient_relatives');
            $f_other_country_uncheck = $this->record_model->update_checkbox_uncheck($patient_ic_no,$is_in_other_country,'patient_relatives_id','is_in_other_country','patient_ic_no','patient_relatives');
                
        if (!empty($father_relatives_id)) {
            for ($i = 0; $i < count($father_relatives_id); $i++) {

                $father_cancer_type_id = $this->record_model->get_cancer_id($father_cancer_name[$i]);

                $data1_patient_relatives = array(
                    'family_no' => $family_no[$i],
                    'full_name' => $full_name[$i],
                    'sur_name' => $sur_name[$i],
                    'maiden_name' => $maiden_name[$i],
                    'ethnicity' => $ethnicity[$i],
                    'town_of_residence' => $town_of_residence[$i],
                    'd_o_b' => $d_o_b[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($d_o_b[$i])),
//                    'is_alive_flag' => $is_alive_flag[$i],
                    'd_o_d' => $d_o_d[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($d_o_d[$i])),
//                    'is_cancer_diagnosed' => $is_cancer_diagnosed[$i],
                    'date_of_diagnosis' => $date_of_diagnosis[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($date_of_diagnosis[$i])),
                    'cancer_type_id' => $father_cancer_type_id,
                    'age_of_diagnosis' => $age_of_diagnosis[$i],
                    'other_detail' => $other_detail[$i],
                    'no_of_brothers' => $no_of_brothers[$i],
                    'no_of_sisters' => $no_of_sisters[$i],
                    'total_half_sisters' => $total_half_sisters[$i],
                    'total_half_brothers' => $total_half_brothers[$i],
//                    'is_adopted' => $is_adopted[$i],
//                    'is_in_other_country' => $is_in_other_country[$i],
                    'modified_on' => $date,
                    'comments' => $comments[$i],
                    'vital_status' => $vital_status[$i]
                        //'match_score_at_consent' => $this->input->post('father_mach_score_at_consent'),
                        //'match_score_past_consent' => $this->input->post('father_mach_score_past_consent'),
                        //'fh_category' => $this->input->post('father_FH_category')
                );

                $this->db->where('relatives_id', 1);
                $this->db->where('patient_relatives_id', $father_relatives_id[$i]);
                $this->db->update('patient_relatives', $data1_patient_relatives);

                if ($this->db->affected_rows() > 0) {
                    echo '<h2>Data for id ' . $i . ' update successfully<h2>';
                } else {
                    echo '<h2>No update data for id ' . $i . '</h2>';
                }
                echo '<br/>';
            }
        }

            $mother_relatives_id = $this->input->post('mother_relatives_id');
            $mother_cancer_name = $this->input->post('mother_cancer_name');
            $mother_family_no = $this->input->post('family_no');
            $mother_full_name = $this->input->post('mother_fullname');
            $mother_sur_name = $this->input->post('mother_surname');
            $mother_maiden_name = $this->input->post('mother_maiden_name');
            $mother_ethnicity = $this->input->post('mother_ethnicity');
            $mother_town_of_residence = $this->input->post('mother_town_residence');
            $mother_d_o_b = $this->input->post('mother_DOB');
            $mother_is_alive_flag = $this->input->post('mother_still_alive_flag');
            $mother_d_o_d = $this->input->post('mother_DOD');
            $mother_is_cancer_diagnosed = $this->input->post('mother_is_cancer_diagnosed');
            $mother_date_of_diagnosis = $this->input->post('mother_date_of_diagnosis');
            $mother_age_of_diagnosis = $this->input->post('mother_age_of_diagnosis');
            $mother_other_detail = $this->input->post('mother_diagnosis_other_details');
            $mother_no_of_brothers = $this->input->post('mother_no_of_brothers');
            $mother_total_half_sisters = $this->input->post('mother_no_of_half_sisters');
            $mother_total_half_brothers = $this->input->post('mother_no_of_half_brothers');
            $mother_no_of_sisters = $this->input->post('mother_no_of_sisters');
            $mother_is_adopted = $this->input->post('mother_unknown_reason_is_adopted');
            $mother_comments = $this->input->post('mother_comments');
            $mother_is_in_other_country = $this->input->post('mother_unknown_reason_in_other_countries');
            $mother_vital_status = $this->input->post('mother_vital_status');
            
            $m_cancer_diagnose_check = $this->record_model->update_checkbox($mother_is_cancer_diagnosed,'is_cancer_diagnosed','patient_relatives_id','patient_relatives');
            $m_cancer_diagnose_uncheck = $this->record_model->update_checkbox_uncheck($patient_ic_no,$mother_is_cancer_diagnosed,'patient_relatives_id','is_cancer_diagnosed','patient_ic_no','patient_relatives');

            $m_still_alive_check = $this->record_model->update_checkbox($mother_is_alive_flag,'is_alive_flag','patient_relatives_id','patient_relatives');
            $m_still_alive_uncheck = $this->record_model->update_checkbox_uncheck($patient_ic_no,$mother_is_alive_flag,'patient_relatives_id','is_alive_flag','patient_ic_no','patient_relatives');
            
            $m_is_adopted_check = $this->record_model->update_checkbox($mother_is_adopted,'is_adopted','patient_relatives_id','patient_relatives');
            $m_is_adopted_uncheck = $this->record_model->update_checkbox_uncheck($patient_ic_no,$mother_is_adopted,'patient_relatives_id','is_adopted','patient_ic_no','patient_relatives');
            
            $m_other_country_check = $this->record_model->update_checkbox($mother_is_in_other_country,'is_in_other_country','patient_relatives_id','patient_relatives');
            $m_other_country_uncheck = $this->record_model->update_checkbox_uncheck($patient_ic_no,$mother_is_in_other_country,'patient_relatives_id','is_in_other_country','patient_ic_no','patient_relatives');
            
            if (!empty($mother_relatives_id)) {
                for ($i = 0; $i < count($mother_relatives_id); $i++) {

                    $mother_cancer_type_id = $this->record_model->get_cancer_id($mother_cancer_name[$i]);

                    $data2_patient_relatives = array(
                        'family_no' => $mother_family_no[$i],
                        'full_name' => $mother_full_name[$i],
                        'sur_name' => $mother_sur_name[$i],
                        'maiden_name' => $mother_maiden_name[$i],
                        'ethnicity' => $mother_ethnicity[$i],
                        'town_of_residence' => $mother_town_of_residence[$i],
                        'd_o_b' => $mother_d_o_b[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($mother_d_o_b[$i])),
//                        'is_alive_flag' => $mother_is_alive_flag[$i],
                        'd_o_d' => $mother_d_o_d[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($mother_d_o_d[$i])),
//                        'is_cancer_diagnosed' => $mother_is_cancer_diagnosed[$i],
                        'date_of_diagnosis' => $mother_date_of_diagnosis[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($mother_date_of_diagnosis[$i])),
                        'cancer_type_id' => $mother_cancer_type_id,
                        'age_of_diagnosis' => $mother_age_of_diagnosis[$i],
                        'other_detail' => $mother_other_detail[$i],
                        'no_of_brothers' => $mother_no_of_brothers[$i],
                        'total_half_sisters' => $mother_total_half_sisters[$i],
                        'total_half_brothers' => $mother_total_half_brothers[$i],
                        'no_of_sisters' => $mother_no_of_sisters[$i],
                        'modified_on' => $date,
//                        'is_adopted' => $mother_is_adopted[$i],
                        'comments' => $mother_comments[$i],
//                        'is_in_other_country' => $mother_is_in_other_country[$i],
                        'vital_status' => $mother_vital_status[$i]
                            //'match_score_at_consent' => $this->input->post('mother_mach_score_at_consent'),
                            //'match_score_past_consent' => $this->input->post('mother_mach_score_past_consent'),
                            //'fh_category' => $this->input->post('mother_FH_category')
                    );


                    $this->db->where('relatives_id', 2);
                    $this->db->where('patient_relatives_id', $mother_relatives_id[$i]);
                    $this->db->update('patient_relatives', $data2_patient_relatives);

                    if ($this->db->affected_rows() > 0) {
                        echo '<h2>Data for id ' . $i . ' update successfully<h2>';
                    } else {
                        echo '<h2>No update data for id ' . $i . '</h2>';
                    }
                    echo '<br/>';
                }
            }
            $other_relatives_id = $this->input->post('others_relatives_id');
            $relative_cancer_name = $this->input->post('relative_cancer_name');
            $relative_relationship_status = $this->input->post('relative_relationship_status');
            $relativeTypeLists = $this->input->post('relativeTypeLists');
            $degreeOfRelativeness = $this->input->post('degreeOfRelativeness');
            $relative_fullname = $this->input->post('relative_fullname');
            $relative_maiden_name = $this->input->post('relative_maiden_name');
            $relative_ethnicity = $this->input->post('relative_ethnicity');
            $relative_town_residence = $this->input->post('relative_town_residence');
            $relative_DOB = $this->input->post('relative_DOB');
            $relative_DOD = $this->input->post('relative_DOD');
            $relative_gender = $this->input->post('relative_gender');
            $relative_still_alive_flag = $this->input->post('relative_still_alive_flag');
            $relative_is_cancer_diagnosed = $this->input->post('relative_is_cancer_diagnosed');
            $relative_date_of_diagnosis = $this->input->post('relative_date_of_diagnosis');
            $relative_age_of_diagnosis = $this->input->post('relative_age_of_diagnosis');
            $relative_vital_status = $this->input->post('relative_vital_status');
            $relative_comment = $this->input->post('relative_comment');
            
            $cancer_diagnose_check = $this->record_model->update_checkbox($relative_is_cancer_diagnosed,'is_cancer_diagnosed','patient_relatives_id','patient_relatives');
            $cancer_diagnose_uncheck = $this->record_model->update_checkbox_uncheck($patient_ic_no,$relative_is_cancer_diagnosed,'patient_relatives_id','is_cancer_diagnosed','patient_ic_no','patient_relatives');
            
            $still_alive_check = $this->record_model->update_checkbox($relative_still_alive_flag,'is_alive_flag','patient_relatives_id','patient_relatives');
            $still_alive_uncheck = $this->record_model->update_checkbox_uncheck($patient_ic_no,$relative_still_alive_flag,'patient_relatives_id','is_alive_flag','patient_ic_no','patient_relatives');
            
            if (!empty($other_relatives_id)) {
            for ($i = 0; $i < count($other_relatives_id); $i++) {
                 
                $relative_cancer_type_id = $this->record_model->get_cancer_id($relative_cancer_name[$i]);

                if ($relative_relationship_status[$i] == 'paternal') {

                    $paternal_status = '1';
                } else {
                    $paternal_status = '0';
                }
                if ($relative_relationship_status[$i] == 'maternal') {

                    $maternal_status = '1';
                } else {
                    $maternal_status = '0';
                }


                 $data3_patient_relatives = array(
                            'cancer_type_id' => $relative_cancer_type_id,
                            'is_paternal' => $paternal_status,
                            'is_maternal' => $maternal_status,
                            'relatives_id' => $relativeTypeLists[$i],
                            'degree_of_relativeness' => $degreeOfRelativeness[$i],
                            'full_name' => $relative_fullname[$i],
                            'maiden_name' => $relative_maiden_name[$i],
                            'ethnicity' => $relative_ethnicity[$i],
                            'town_of_residence' => $relative_town_residence[$i],
                            'd_o_b' => $relative_DOB[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($relative_DOB[$i])),
                            'sex' => $relative_gender[$i],
                            'd_o_d' => $relative_DOD[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($relative_DOD[$i])),
                            'date_of_diagnosis' => $relative_date_of_diagnosis[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($relative_date_of_diagnosis[$i])),
                            'age_of_diagnosis' => $relative_age_of_diagnosis[$i],
                            'vital_status' => $relative_vital_status[$i],
                            'comments' => $relative_comment[$i],
                            'modified_on' => $date
                        );
                       
                    $this->db->where('patient_relatives_id', $other_relatives_id[$i]);
                    $this->db->update('patient_relatives', $data3_patient_relatives);
                    
                    //echo $this->db->last_query();exit;

                    
                    if ($this->db->affected_rows() > 0) {
                        echo '<h2>Data for id ' . $i . ' update successfully<h2>';
                    } else {
                        echo '<h2>No update data for id ' . $i . '</h2>';
                    }
                    echo '<br/>';
    }
            }
    }

    public function risk_assessment_insertion() {
        //print_r($this->input->post());
        //$data = array();
        //validate form input

        date_default_timezone_set("Asia/Kuala_lumpur");
        $date = date('Y-m-d H:i:s'); //Returns IST 

        $this->form_validation->set_rules('patient_ic_no', 'IC No', 'required|xss_clean');
        if ($this->form_validation->run() == true) {

            $data_patient_risk_assessment = array(
                'patient_ic_no' => $this->input->post('patient_ic_no'),
                'at_consent_mach_brca1' => $this->input->post('ms_at_consent_BRCA1'),
                'at_consent_mach_brca2' => $this->input->post('ms_at_consent_BRCA2'),
                'at_consent_mach_total' => $this->input->post('ms_at_consent_Total'),
                'after_gc_brca1' => $this->input->post('ms_after_gc_BRCA1'),
                'after_gc_brca2' => $this->input->post('ms_after_gc_BRCA2'),
                'after_gc_total' => $this->input->post('ms_after_gc_Total'),
                'adjusted_mach_brca1' => $this->input->post('ms_adjusted_gc_BRCA1'),
                'adjusted_mach_brca2' => $this->input->post('ms_adjusted_gc_BRCA2'),
                'adjusted_mach_total' => $this->input->post('ms_adjusted_gc_Total'),
                'at_consent_boadicea_brca1' => $this->input->post('BOADICEA_at_consent_BRCA1'),
                'at_consent_boadicea_brca2' => $this->input->post('BOADICEA_at_consent_BRCA2'),
                'at_consent_boadicea_no_mutation' => $this->input->post('BOADICEA_at_consent_no_mutation'),
                'adjusted_boadicea_brca1' => $this->input->post('BOADICEA_adjusted_BRCA1'),
                'adjusted_boadicea_brca2' => $this->input->post('BOADICEA_adjusted_BRCA2'),
                'adjusted_boadicea_no_mutation' => $this->input->post('BOADICEA_adjusted_no_mutation'),
                'after_gc_boadicea_brca1' => $this->input->post('BOADICEA_after_gc_BRCA1'),
                'after_gc_boadicea_brca2' => $this->input->post('BOADICEA_after_gc_BRCA2'),
                'after_gc_boadicea_no_mutation' => $this->input->post('BOADICEA_after_gc_no_mutation'),
                'at_consent_gail_model_5years' => $this->input->post('gail_model_at_consent_5years'),
                'at_consent_gail_model_10years' => $this->input->post('gail_model_at_consent_10years'),
                'first_mammo_gail_model_10years' => $this->input->post('gail_model_first_mammo_10years'),
                'created_on' => $date,
                'first_mammo_gail_model_5years' => $this->input->post('gail_model_first_mammo_5years')
            );

            echo '<pre>';
            //print_r($data_patient_risk_assessment);
            //array_push($data, $this->input->post('firstname'));
            $id_patient_risk_assessment = $this->record_model->insert_patient_risk_assessment_record($data_patient_risk_assessment);

            $add_manchester_score = $this->getDynamicFieldsInputsArray("manchester_score");
            $add_BOADICEA = $this->getDynamicFieldsInputsArray("BOADICEA");
            $add_gail_model = $this->getDynamicFieldsInputsArray("gail_model");

            if ($id_patient_risk_assessment > 0) {
                echo "<h2>Data Added successfully at patient_risk_assessment</h2>";
            } else {
                echo "<h2>Failed to insert patient_risk_assessment</h2>";
            }
            echo '<br/>';
        } else {
            print_r(validation_errors());
        }
    }

    function patient_record_view($ic_no, $patient_studies_id) {

        $data['ic_no'] = $ic_no;
        $data['patient_studies_id'] = $patient_studies_id;

        $this->load->view('record/view_home', $data);
    }

    function patient_record_delete($ic_no, $patient_studies_id) {

        $this->load->model('Record_model');

        $data['ic_no'] = $ic_no;
        $data['patient_studies_id'] = $patient_studies_id;

        $this->Record_model->patient_delete($ic_no);

        redirect('record/patient_record_list');

        //$this->load->view('record/view_home', $data);
    }

    function record_list() {

        $this->load->view('record/record_list');
    }

    function patient_record_list() {

        $this->load->model('Record_model');
        $data = $this->Record_model->general();
        $userid = $this->session->userdata('user_id');
        $data['userprivillage'] = $this->record_model->user_privillage($userid);
        $data['submit'] = $this->input->post('search');
        $studies_name = $this->input->post('studies_name');
        $hospital_no = $this->input->post('hospital_no');
        $patient_no = $this->input->post('patient_no');
        $studies = $this->record_model->get_studies_id($studies_name);
        $name = $this->input->post('patient_name');
        $IC_no = $this->input->post('IC_no');
        
        if(!empty($studies)){
            
           $studies_id = $studies;
        } else {
            
           $studies_id = ''; 
        }
        

        if ($this->input->post('search')) {

            $data_search_key = array(
                'given_name' => $name,
                'ic_no' => $IC_no,
                'hospital_no' => $hospital_no,
                'patient_no' => $patient_no,
                'studies_name' => $studies_id
            );
        } else {
            $data_search_key = array(
                'given_name' => $name,
                'ic_no' => $IC_no,
                'hospital_no' => $hospital_no,
                'patient_no' => $patient_no,
                'studies_name' => $studies_id
            );
        }
        
        if (!empty($name)) {


            $patient_name = $name;
        } else {

            $patient_name = 0;
        }

        if (!empty($IC_no)) {

            $patient_ic_no = $IC_no;
        } else {

            $patient_ic_no = 0;
        }

        if (!empty($studies_id)) {

            $patient_studies = $studies_id;
        } else {

            $patient_studies = 0;
        }


        if (!empty($hospital_no)) {

            $patient_hospital_no = $hospital_no;
        } else {

            $patient_hospital_no = 0;
        }

        if (!empty($patient_no)) {

            $private_no = $patient_no;
        } else {

            $private_no = 0;
        }
        

        $limit = 30;
        $allResult = $this->Record_model->getPatientList($data_search_key);
        $config['total_rows'] = count($allResult);
        $config['base_url'] = site_url('record/patient_record_list_searched' . '/' . $patient_name . '/' . $patient_ic_no . '/' . $patient_studies . '/' . $patient_hospital_no . '/' . $private_no);
        //$config['base_url'] = site_url('record/patient_record_list/');
        $config['per_page'] = $limit;
        $config["uri_segment"] = 8;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(8)) ? $this->uri->segment(8) : 0;

        $result = array();
        $result = $this->Record_model->getCurrentRangeOfPatientList($data_search_key, $config["per_page"], $page);

        $data['patient_list'] = $result;
        // $config['total_rows'] = count($allResult);
        $data['studies_name_list'] = $this->Record_model->get_studies_name();
        $data['counter'] = $page;
        $data['pagination_links'] = $this->pagination->create_links();
        $data['total_results'] = count($allResult);
        $data['start_from'] = $page;

        $this->template->load("templates/report_home_template", 'record/list_record_personal_details', $data);
    }

    function patient_record_list_searched($name = null, $IC_no = null, $studies_name = null, $hospital_no = null, $patient_no = null) {


        $this->load->model('Record_model');
        $data = $this->Record_model->general();
        $userid = $this->session->userdata('user_id');
        $data['userprivillage'] = $this->record_model->user_privillage($userid);
        //$data['submit'] = $this->input->post('search');
        //$studies_name = $this->input->post('studies_name');
        //$patient_name1 = $this->input->post('patient_name1');
        //$patient_name = $this->input->post('patient_name');
        //$IC_no = $this->input->post('IC_no');
        //echo '$patient_name:'; print_r($patient_name);
//        $studies_id = $this->record_model->get_studies_id($studies_name);
//        
        if (!empty($name)) {

            $patient_name = $name;
        } else {

            $patient_name = "";
        }

        if (!empty($IC_no)) {

            $patient_ic_no = $IC_no;
        } else {

            $patient_ic_no = "";
        }

        if (!empty($studies_name)) {

            $patient_studies = $studies_name;
        } else {

            $patient_studies = "";
        }


        if (!empty($hospital_no)) {

            $patient_hospital_no = $hospital_no;
        } else {

            $patient_hospital_no = "";
        }

        if (!empty($patient_no)) {

            $private_no = $patient_no;
        } else {

            $private_no = "";
        }

        $data_search_key = array(
            'given_name' => $patient_name,
            'ic_no' => $patient_ic_no,
            'hospital_no' => $patient_hospital_no,
            'patient_no' => $private_no,
            'studies_name' => $patient_studies
        );


        $limit = 30;
        $allResult = $this->Record_model->getPatientList($data_search_key);
        $config['total_rows'] = count($allResult);
        $config['base_url'] = site_url('record/patient_record_list_searched' . '/' . $name . '/' . $IC_no . '/' . $studies_name . '/' . $hospital_no . '/' . $patient_no);
        //$config['base_url'] = site_url('record/patient_record_list_searched'.'/'.$patient_name.'/'.$IC_no);
        $config['per_page'] = $limit;
        $config["uri_segment"] = 8;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(8)) ? $this->uri->segment(8) : 0;

        $result = array();
        $result = $this->Record_model->getCurrentRangeOfPatientList($data_search_key, $config["per_page"], $page);

        $data['patient_list'] = $result;
        $data['studies_name_list'] = $this->Record_model->get_studies_name();
        $data['counter'] = $page;
        $data['pagination_links'] = $this->pagination->create_links();
        $data['total_results'] = count($allResult);
        $data['start_from'] = $page;

        $this->template->load("templates/report_home_template", 'record/list_record_personal_details', $data);
    }

    function studies_set_one_insertion() {
        //echo '<h1>Helllooo</h1>';
        //$this->form_validation->set_rules('mother_fullname', 'Full name', 'required|xss_clean');
        //if ($this->form_validation->run() == true)  {

        date_default_timezone_set("Asia/Kuala_lumpur");
        $date = date('Y-m-d H:i:s'); //Returns IST 

        $studies_name = $this->input->post('studies_name');
        $studies_id = $this->excell_sheets_model->get_studies_id($studies_name);
        $data_keys = array(
            'patient_ic_no' => $this->input->post('IC_no'),
            'studies_id' => $studies_id
        );
//        echo '<pre>';
        //print_r($data_keys);echo '<br/>';
        $patient_studies_id = $this->record_model->get_patient_suudies_id($data_keys);
        //echo $patient_studies_id;
        //echo '<br/>';

        $date_first_mammo = $this->input->post('date_of_first_mammogram');
        $date_recent_mammo = $this->input->post('date_of_recent_mammogram');

        $data_patient_breast_screening = array(
            'patient_ic_no' => $this->input->post('IC_no'),
            'patient_studies_id' => $patient_studies_id,
            'date_of_first_mammogram' => $date_first_mammo == '' ? '0000-00-00' : date("Y-m-d", strtotime($date_first_mammo)),
            'age_of_first_mammogram' => $this->input->post('age_of_first_mammogram'),
            'age_of_recent_mammogram' => $this->input->post('age_of_recent_mammogram'),
            'date_of_recent_mammogram' => $date_recent_mammo == '' ? '0000-00-00' : date("Y-m-d", strtotime($date_recent_mammo)),
            'screening_centre' => $this->input->post('screening_center'),
            //'action_suggested_on_memo_report' => $this->input->post('action_suggested_on_memo_report'),
            'total_no_of_mammogram' => $this->input->post('total_no_of_mammogram'),
            'screening_interval' => $this->input->post('screening_interval'),
            'abnormalities_mammo_flag' => $this->input->post('abnormalities_mammo_flag'),
            //'mammo_abnormality_details' => $this->input->post('mammo_breast_other_descriptions'),
            'name_of_radiologist' => $this->input->post('name_of_radiologist'),
            'had_ultrasound_flag' => $this->input->post('had_ultrasound_flag'), //from Ultrasound Details part
            'total_no_of_ultrasound' => $this->input->post('total_no_of_ultrasound'),
            'abnormalities_ultrasound_flag' => $this->input->post('abnormalities_ultrasound_flag'),
            'had_mri_flag' => $this->input->post('had_mri_flag'), // from MRI Details part
            'abnormalities_MRI_flag' => $this->input->post('abnormalities_MRI_flag'),
            'total_no_of_mri' => $this->input->post('total_no_of_mri'),
            //'had_surgery_for_benign_lump_or_cyst_flag' => $this->input->post('had_surgery_for_benign_lump_or_cyst_flag'),
            //'mammo_benign_lump_cyst_details' => $this->input->post('mammo_benign_lump_cyst_details'),
            //'other_screening_flag' => $this->input->post('other_screening_flag'),
            'screening_center_of_first_mammogram' => $this->input->post('screening_center_of_first_mammogram'),
            'screening_center_of_recent_mammogram' => $this->input->post('screening_center_of_recent_mammogram'),
            'details_of_first_mammogram' => $this->input->post('details_at_first_mammogram'),
            'details_of_recent_mammogram' => $this->input->post('details_at_recent_mammogram'),
            'motivaters_of_first_mammogram' => $this->input->post('motivaters_at_first_mammogram'),
            'motivaters_of_recent_mammogram' => $this->input->post('motivaters_at_recent_mammogram'),
            'mammogram_in_sdmc' => $this->input->post('mammogram_in_sdmc'),
            'reason_of_mammogram' => $this->input->post('reason_of_mammogram'),
            'reason_of_mammogram_details' => $this->input->post('reason_of_mammogram_details'),
            'action_suggested_on_mammogram_report' => $this->input->post('action_suggested_on_mammogram_report'),
            'reason_of_action_suggested' => $this->input->post('reason_of_action_suggested'),
            'is_cancer_mammogram_flag' => $this->input->post('is_cancer_mammogram_flag'),
            'site_effected_of_mammogram' => $this->input->post('site_effected_of_mammogram'),
            'BIRADS_clinical_classification' => $this->input->post('BIRADS_clinical_classification'),
            'percentage_of_mammo_density' => $this->input->post('percentage_of_mammo_density'),
            'mammo_comments' => $this->input->post('mammo_comments'),
            'created_on' => $date,
            'BIRADS_density_classification' => $this->input->post('BIRADS_density_classification')
        );

        //print_r($data_patient_breast_screening);exit;
        //echo '<br/>';
        $patient_breast_screening_id = $this->record_model->insert_at_patient_breast_screening($data_patient_breast_screening);
        //echo $patient_breast_screening_id;
        if ($patient_breast_screening_id > 0) {
            echo "Data Added successfully at patient_breast_screening";
        } else {
            echo "Failed to insert at patient_breast_screening";
        } echo '<br/>';


        $config['upload_path'] = './images/'; //$path=any path you want to save the file to...
        $config['allowed_types'] = 'gif|jpg|png|jpeg'; //this is the file types allowed
        $config['max_size'] = '100000'; //max file size
        //$config['max_width']  = '1024';//if file type is image
        //$config['max_height']  = '768';//if file type is image
        $array_file_path = array();
        $this->load->library('upload', $config);

        foreach ($_FILES as $Key => $File) {
            if ($File['size'] > 0) {
                if ($this->upload->do_upload($Key)) {
                    $data = $this->upload->data();
                    //echo $data['full_path'];
                    $array_file_path[] = $data['full_path'];
                    //echo '<br/>';
                } else {
                    // throw error
                    echo $this->upload->display_errors();
                }
            }
        }
        /* echo $array_file_path[0].'<br/>'; 
          echo $array_file_path[1].'<br/>';
          echo $array_file_path[2].'<br/>';
          echo $array_file_path[3]; */
        $array_file_path_length = sizeof($array_file_path);

        if ($array_file_path_length >= 1) {
            $data_patient_mammo_raw_images1 = array(
                'patient_ic_no' => $this->input->post('IC_no'),
                'patient_breast_screening_id' => $patient_breast_screening_id,
                'created_on' => $date,
                'raw_image_file_name' => $array_file_path[0]
            );
            $patient_mammo_raw_images_id1 = $this->record_model->insert_patient_mammo_raw_images($data_patient_mammo_raw_images1);

            if ($patient_mammo_raw_images_id1 > 0) {
                echo "Data Added successfully at patient_mammo_raw_images1";
            } else {
                echo "Failed to insert at patient_mammo_raw_images1";
            } echo '<br/>';
        }

        if ($array_file_path_length >= 2) {
            $data_patient_mammo_raw_images2 = array(
                'patient_ic_no' => $this->input->post('IC_no'),
                'patient_breast_screening_id' => $patient_breast_screening_id,
                'created_on' => $date,
                'raw_image_file_name' => $array_file_path[1]
            );
            $patient_mammo_raw_images_id2 = $this->record_model->insert_patient_mammo_raw_images($data_patient_mammo_raw_images2);

            if ($patient_mammo_raw_images_id2 > 0) {
                echo "Data Added successfully at patient_mammo_raw_images2";
            } else {
                echo "Failed to insert at patient_mammo_raw_images2";
            } echo '<br/>';
        }

        if ($array_file_path_length >= 3) {
            $data_patient_mammo_raw_images3 = array(
                'patient_ic_no' => $this->input->post('IC_no'),
                'patient_breast_screening_id' => $patient_breast_screening_id,
                'created_on' => $date,
                'raw_image_file_name' => $array_file_path[2]
            );
            $patient_mammo_raw_images_id3 = $this->record_model->insert_patient_mammo_raw_images($data_patient_mammo_raw_images3);

            if ($patient_mammo_raw_images_id3 > 0) {
                echo "Data Added successfully at patient_mammo_raw_images3";
            } else {
                echo "Failed to insert at patient_mammo_raw_images3";
            } echo '<br/>';
        }

        if ($array_file_path_length >= 4) {
            $data_patient_mammo_raw_images4 = array(
                'patient_ic_no' => $this->input->post('IC_no'),
                'patient_breast_screening_id' => $patient_breast_screening_id,
                'created_on' => $date,
                'raw_image_file_name' => $array_file_path[3]
            );
            $patient_mammo_raw_images_id4 = $this->record_model->insert_patient_mammo_raw_images($data_patient_mammo_raw_images4);

            if ($patient_mammo_raw_images_id4 > 0) {
                echo "Data Added successfully at patient_mammo_raw_images4";
            } else {
                echo "Failed to insert at patient_mammo_raw_images4";
            } echo '<br/>';
        }

        if ($array_file_path_length >= 5) {
            $data_patient_mammo_processed_images1 = array(
                'patient_ic_no' => $this->input->post('IC_no'),
                'patient_breast_screening_id' => $patient_breast_screening_id,
                'created_on' => $date,
                'processed_image_file_name' => $array_file_path[4]
            );
            $patient_mammo_processed_images_id1 = $this->record_model->insert_patient_mammo_processed_images($data_patient_mammo_processed_images1);

            if ($patient_mammo_processed_images_id1 > 0) {
                echo "Data Added successfully at patient_mammo_processed_images1";
            } else {
                echo "Failed to insert at patient_mammo_processed_images1";
            } echo '<br/>';
        }

        if ($array_file_path_length >= 6) {
            $data_patient_mammo_processed_images2 = array(
                'patient_ic_no' => $this->input->post('IC_no'),
                'patient_breast_screening_id' => $patient_breast_screening_id,
                'created_on' => $date,
                'processed_image_file_name' => $array_file_path[5]
            );
            $patient_mammo_processed_images_id2 = $this->record_model->insert_patient_mammo_processed_images($data_patient_mammo_processed_images2);

            if ($patient_mammo_processed_images_id2 > 0) {
                echo "Data Added successfully at patient_mammo_processed_images2";
            } else {
                echo "Failed to insert at patient_mammo_processed_images2";
            } echo '<br/>';
        }

        if ($array_file_path_length >= 7) {
            $data_patient_mammo_processed_images3 = array(
                'patient_ic_no' => $this->input->post('IC_no'),
                'patient_breast_screening_id' => $patient_breast_screening_id,
                'created_on' => $date,
                'processed_image_file_name' => $array_file_path[6]
            );
            $patient_mammo_processed_images_id3 = $this->record_model->insert_patient_mammo_processed_images($data_patient_mammo_processed_images3);

            if ($patient_mammo_processed_images_id3 > 0) {
                echo "Data Added successfully at patient_mammo_processed_images3";
            } else {
                echo "Failed to insert at patient_mammo_processed_images3";
            } echo '<br/>';
        }

        if ($array_file_path_length >= 8) {
            $data_patient_mammo_processed_images4 = array(
                'patient_ic_no' => $this->input->post('IC_no'),
                'patient_breast_screening_id' => $patient_breast_screening_id,
                'created_on' => $date,
                'processed_image_file_name' => $array_file_path[7]
            );
            $patient_mammo_processed_images_id4 = $this->record_model->insert_patient_mammo_processed_images($data_patient_mammo_processed_images4);

            if ($patient_mammo_processed_images_id4 > 0) {
                echo "Data Added successfully at patient_mammo_processed_images4";
            } else {
                echo "Failed to insert at patient_mammo_processed_images4";
            } echo '<br/>';
        }
        $mammo_left_right_breast_side = $this->input->post('mammo_left_right_breast_side');
        $mammo_upper_below_breast_side = $this->input->post('mammo_upper_below_breast_side');

        if ($mammo_left_right_breast_side == 'Left')
            $left_breast = TRUE;
        else
            $left_breast = FALSE;

        if ($mammo_left_right_breast_side == 'Right')
            $right_breast = TRUE;
        else
            $right_breast = FALSE;

        if ($mammo_upper_below_breast_side == 'Upper')
            $upper = TRUE;
        else
            $upper = FALSE;

        if ($mammo_upper_below_breast_side == 'Below')
            $below = TRUE;
        else
            $below = FALSE;

        $data_patient_breast_abnormality = array(
            'patient_breast_screening_id' => $patient_breast_screening_id,
            //'description' => $this->input->post('mammo_breast_other_descriptions'),
            'left_breast' => $left_breast,
            'right_breast' => $right_breast,
            'upper' => $upper,
            'created_on' => $date,
            'below' => $below
        );
        //print_r($data_patient_breast_abnormality);
        echo '<br/>';
        $patient_breast_abnormality_id = $this->record_model->insert_at_patient_breast_abnormality($data_patient_breast_abnormality);

        $add_mammo_site_detail = $this->getDynamicFieldsInputsArray("mammo_site_detail", $patient_breast_screening_id);

        if ($patient_breast_abnormality_id > 0) {
            echo "Data Added successfully at patient_breast_abnormality";
        } else {
            echo "Failed to insert at patient_breast_abnormality";
        } echo '<br/>';

        $date_ultrasound = $this->input->post('mammo_ultrasound_date');

        $data_patient_ultrasound_abnormality = array(
            'is_abnormality_detected' => $this->input->post('abnormalities_ultrasound_flag'),
            'ultrasound_date' => $date_ultrasound == '' ? '0000-00-00' : date("Y-m-d", strtotime($date_ultrasound)),
            'comments' => $this->input->post('mammo_ultrasound_details'),
            'created_on' => $date,
            'patient_breast_screening_id' => $patient_breast_screening_id
        );
        //print_r($data_patient_ultrasound_abnormality);
        echo '<br/>';
        $patient_ultrasound_abnormality_id = $this->record_model->insert_patient_ultrasound_abnormality($data_patient_ultrasound_abnormality);

        $add_ultrasound = $this->getDynamicFieldsInputsArray("ultrasound", $patient_breast_screening_id);

        if ($patient_ultrasound_abnormality_id > 0) {
            echo "Data Added successfully at patient_ultrasound_abnormality";
        } else {
            echo "Failed to insert at patient_ultrasound_abnormality";
        } echo '<br/>';

        $date_mri = $this->input->post('mammo_mri_date');

        $data_patient_mri_abnormality = array(
            'is_abnormality_detected' => $this->input->post('abnormalities_mri_flag'),
            'mri_date' => $date_mri == '' ? '0000-00-00' : date("Y-m-d", strtotime($date_mri)),
            'comments' => $this->input->post('mammo_MRI_details'),
            'patient_breast_screening_id' => $patient_breast_screening_id
        );
        //print_r($data_patient_mri_abnormality);
        echo '<br/>';
        $patient_patient_mri_abnormality_id = $this->record_model->insert_patient_mri_abnormality($data_patient_mri_abnormality);

        $add_mri = $this->getDynamicFieldsInputsArray("MRI", $patient_breast_screening_id);

        if ($patient_patient_mri_abnormality_id > 0) {
            echo "Data Added successfully at patient_mri_abnormality";
        } else {
            echo "Failed to insert at patient_mri_abnormality";
        } echo '<br/>';

        $breast_surgery_date = $this->input->post('date_of_non_cancer_surgery');
        $ovary_surgery_date = $this->input->post('ovary_date_of_non_cancer_surgery');

        $data_patient_non_cancer_surgery = array(
            'patient_studies_id' => $patient_studies_id,
            'breast_surgery_type' => $this->input->post('non_cancer_surgery_type'),
            'breast_reason_of_surgery' => $this->input->post('reason_for_non_cancer_surgery'),
            'breast_date_of_surgery' => $breast_surgery_date == '' ? '0000-00-00' : date("Y-m-d", strtotime($breast_surgery_date)),
            'breast_age_of_surgery' => $this->input->post('age_at_non_cancer_surgery'),
            'breast_comments' => $this->input->post('non_cancer_surgery_comments'),
            'surgery_type' => $this->input->post('ovary_non_cancer_surgery_type'),
            'reason_for_surgery' => $this->input->post('ovary_reason_for_non_cancer_surgery'),
            'date_of_surgery' => $ovary_surgery_date == '' ? '0000-00-00' : date("Y-m-d", strtotime($ovary_surgery_date)),
            'age_at_surgery' => $this->input->post('ovary_age_at_non_cancer_surgery'),
            'created_on' => $date,
            'comments' => $this->input->post('ovary_non_cancer_surgery_comments')
        );
        //print_r($data_patient_mri_abnormality);
        echo '<br/>';
        $data_patient_non_cancer_surgery_id = $this->record_model->insert_patient_non_cancer_surgery($data_patient_non_cancer_surgery);
        if ($data_patient_non_cancer_surgery_id > 0) {
            echo "Data Added successfully at patient_non_cancer_surgery";
        } else {
            echo "Failed to insert at patient_non_cancer_surgery";
        } echo '<br/>';

        $data_patient_risk_reducing_surgery = array(
            'patient_studies_id' => $patient_studies_id,
            'had_new_lesion_surgery_flag' => $this->input->post('had_new_risk_reducing_surgery'),
            'created_on' => $date,
            'had_complete_removal_surgery_flag' => $this->input->post('had_new_complete_removal_surgery')
        );
        //print_r($data_patient_mri_abnormality);
        echo '<br/>';
        $data_patient_risk_reducing_surgery_id = $this->record_model->insert_patient_risk_reducing_surgery($data_patient_risk_reducing_surgery);
        if ($data_patient_risk_reducing_surgery_id > 0) {
            echo "Data Added successfully at patient_risk_reducing_surgery";
        } else {
            echo "Failed to insert at patient_risk_reducing_surgery";
        } echo '<br/>';

        $removal_non_cancerous_site_id = $this->input->post('non_cancerous_complete_removal_site');
        $removal_non_cancerous_site = $this->record_model->get_non_cancerous_benign_site_id($removal_non_cancerous_site_id);
        $date_concerous_surgery = $this->input->post('non_cancerous_complete_removal_date');

        $data_patient_risk_reducing_surgery_complete_removal = array(
            'patient_risk_reducing_surgery_id' => $data_patient_risk_reducing_surgery_id,
            'non_cancerous_site_id' => $removal_non_cancerous_site,
            'surgery_date' => $date_concerous_surgery == '' ? '0000-00-00' : date("Y-m-d", strtotime($date_concerous_surgery)),
            'created_on' => $date,
            'surgery_reason' => $this->input->post('non_cancerous_complete_removal_reason')
        );
        //print_r($data_patient_mri_abnormality);
        echo '<br/>';
        $data_patient_risk_reducing_surgery_complete_removal_id = $this->record_model->insert_patient_risk_reducing_surgery_complete_removal($data_patient_risk_reducing_surgery_complete_removal);

        $add_site_complete_removal = $this->getDynamicFieldsInputsArray("site_complete_removal", $data_patient_risk_reducing_surgery_id);

        if ($data_patient_risk_reducing_surgery_complete_removal_id > 0) {
            echo "Data Added successfully at patient_risk_reducing_surgery_complete_removal";
        } else {
            echo "Failed to insert at patient_risk_reducing_surgery_complete_removal";
        } echo '<br/>';

        $non_cancerous_site_id = $this->input->post('non_cancerous_benign_site');
        $non_cancerous_site = $this->record_model->get_non_cancerous_benign_site_id($non_cancerous_site_id);
        $date_benign_site_surgery = $this->input->post('non_cancerous_benign_date');

        $data_patient_risk_reducing_surgery_lesion = array(
            'patient_risk_reducing_surgery_id' => $data_patient_risk_reducing_surgery_id,
            'non_cancerous_site_id' => $non_cancerous_site,
            'created_on' => $date,
            'surgery_date' => $date_benign_site_surgery == '' ? '0000-00-00' : date("Y-m-d", strtotime($date_benign_site_surgery))
        );
        //print_r($data_patient_mri_abnormality);
        echo '<br/>';
        $data_patient_risk_reducing_surgery_lesion_id = $this->record_model->insert_patient_risk_reducing_surgery_lesion($data_patient_risk_reducing_surgery_lesion);

        $add_site_lesion_surgery = $this->getDynamicFieldsInputsArray("site_lesion_surgery", $data_patient_risk_reducing_surgery_id);

        if ($data_patient_risk_reducing_surgery_lesion_id > 0) {
            echo "Data Added successfully at patient_risk_reducing_surgery_lesion";
        } else {
            echo "Failed to insert at patient_risk_reducing_surgery_lesion";
        } echo '<br/>';


        $ovarian_screening_type_id = $this->input->post('ovarian_screening_type_name');
        $ovarian_screening_type = $this->record_model->get_ovarian_screening_type($ovarian_screening_type_id);
        $ovarian_screening_date = $this->input->post('physical_exam_date');

        $data_patient_ovarian_screening = array(
            'patient_studies_id' => $patient_studies_id,
            'ovarian_screening_type_id' => $ovarian_screening_type,
            'screening_date' => $ovarian_screening_date == '' ? '0000-00-00' : date("Y-m-d", strtotime($ovarian_screening_date)),
            'is_abnormality_detected' => $this->input->post('physical_exam_is_abnormality_detected'),
            'created_on' => $date,
            'additional_info' => $this->input->post('physical_exam_additional_info')
        );
        //print_r($data_patient_mri_abnormality);
        echo '<br/>';
        $data_patient_ovarian_screening_id = $this->record_model->insert_patient_ovarian_screening($data_patient_ovarian_screening);

        $add_ovarian_cancer_screening = $this->getDynamicFieldsInputsArray("ovarian_cancer_screening", $data_patient_risk_reducing_surgery_id);

        if ($data_patient_ovarian_screening_id > 0) {
            echo "Data Added successfully at patient_ovarian_screening";
        } else {
            echo "Failed to insert at patient_ovarian_screening";
        } echo '<br/>';


        $data_patient_other_screening = array(
            'patient_studies_id' => $patient_studies_id,
            'screening_type' => $this->input->post('screening_name'),
            //'total_no_of_screening' => $this->input->post('total_no_of_screening'),
            'age_at_screening' => $this->input->post('age_at_screening'),
            'screening_center' => $this->input->post('place_of_screening'),
            'created_on' => $date,
            'screening_result' => $this->input->post('screening_results')
        );

        //print_r($data_patient_other_screening);
        echo '<br/>';
        $patient_other_screening_id = $this->record_model->insert_patient_other_screening($data_patient_other_screening);

        $add_other_screening = $this->getDynamicFieldsInputsArray("other_screening");

        if ($patient_other_screening_id > 0) {
            echo "Data Added successfully at patient_other_screening";
        } else {
            echo "Failed to insert at patient_other_screening";
        } echo '<br/>';


        $date_first_consultation = $this->input->post('surveillance_first_consultation_date');
        $date_due = $this->input->post('surveillance_due_date');
        $date_send_reminder = $this->input->post('surveillance_reminder_sent_date');
        $date_surveillance_done = $this->input->post('surveillance_done_date');
        $data_patient_surveillance = array(
            'patient_studies_id' => $patient_studies_id,
            'recruitment_center' => $this->input->post('surveillance_recruitment_center'),
            'type' => $this->input->post('surveillance_type'),
            'first_consultation_date' => $date_first_consultation == '' ? '0000-00-00' : date("Y-m-d", strtotime($date_first_consultation)),
            'first_consultation_place' => $this->input->post('surveillance_first_consultation_place'),
            'surveillance_interval' => $this->input->post('surveillance_interval'),
            'diagnosis' => $this->input->post('surveillance_diagnosis'),
            'due_date' => $date_due == '' ? '0000-00-00' : date("Y-m-d", strtotime($date_due)),
            'reminder_sent_date' => $date_send_reminder == '' ? '0000-00-00' : date("Y-m-d", strtotime($date_send_reminder)),
            'surveillance_done_date' => $date_surveillance_done == '' ? '0000-00-00' : date("Y-m-d", strtotime($date_surveillance_done)),
            'reminded_by' => $this->input->post('surveillance_reminded_by'),
            'timing' => $this->input->post('surveillance_timing'),
            'symptoms' => $this->input->post('surveillance_symptoms'),
            'doctor_name' => $this->input->post('surveillance_doctor_name'),
            'surveillance_done_place' => $this->input->post('surveillance_place'),
            'outcome' => $this->input->post('surveillance_outcome'),
            'created_on' => $date,
            'comments' => $this->input->post('surveillance_comments')
        );

        // echo '<pre>';
        // print_r($data_patient_surveillance);echo '<br/>';
        //array_push($data, $this->input->post('firstname'));
        $patient_surveillance_id = $this->record_model->insert_patient_surveillance($data_patient_surveillance);
        if ($patient_surveillance_id > 0) {
            echo "<h2>Data Added successfully at patient_surveillance</h2>";
        } else {
            echo "<h2>Failed to insert patient_surveillance</h2>";
        }
        echo '<br/>';
    }

    function studies_set_one_update() {

        date_default_timezone_set("Asia/Kuala_lumpur");
        $date = date('Y-m-d H:i:s'); //Returns IST 
        //$patient_studies_id = $this->input->post('studies_name');
        $patient_ic_no = $this->input->post('patient_ic_no');
        $patient_studies_id = $this->input->post('patient_studies_id');

        $patient_breast_screening_id = $this->input->post('patient_breast_screening_id');

        $date_of_first_mammogram = $this->input->post('date_of_first_mammogram');
        $age_of_first_mammogram = $this->input->post('age_of_first_mammogram');
        $age_of_recent_mammogram = $this->input->post('age_of_recent_mammogram');
        $date_of_recent_mammogram = $this->input->post('date_of_recent_mammogram');
        $screening_centre = $this->input->post('screening_center');
        $total_no_of_mammogram = $this->input->post('total_no_of_mammogram');
        $screening_interval = $this->input->post('screening_interval');
        $abnormalities_mammo_flag = $this->input->post('abnormalities_mammo_flag');
        $name_of_radiologist = $this->input->post('name_of_radiologist');
        $had_ultrasound_flag = $this->input->post('had_ultrasound_flag'); //from Ultrasound Details part
        $total_no_of_ultrasound = $this->input->post('total_no_of_ultrasound');
        $abnormalities_ultrasound_flag = $this->input->post('abnormalities_ultrasound_flag');
        $had_mri_flag = $this->input->post('had_mri_flag'); // from MRI Details part
        $abnormalities_MRI_flag = $this->input->post('abnormalities_MRI_flag');
        $total_no_of_mri = $this->input->post('total_no_of_mri');
        $screening_center_of_first_mammogram = $this->input->post('screening_center_of_first_mammogram');
        $screening_center_of_recent_mammogram = $this->input->post('screening_center_of_recent_mammogram');
        $details_of_first_mammogram = $this->input->post('details_at_first_mammogram');
        $details_of_recent_mammogram = $this->input->post('details_at_recent_mammogram');
        $motivaters_of_first_mammogram = $this->input->post('motivaters_at_first_mammogram');
        $motivaters_of_recent_mammogram = $this->input->post('motivaters_at_recent_mammogram');
        $mammogram_in_sdmc = $this->input->post('mammogram_in_sdmc');
        $reason_of_mammogram = $this->input->post('reason_of_mammogram');
        $reason_of_mammogram_details = $this->input->post('reason_of_mammogram_details');
        $action_suggested_on_mammogram_report = $this->input->post('action_suggested_on_mammogram_report');
        $reason_of_action_suggested = $this->input->post('reason_of_action_suggested');
        $is_cancer_mammogram_flag = $this->input->post('is_cancer_mammogram_flag');
        $site_effected_of_mammogram = $this->input->post('site_effected_of_mammogram');
        $BIRADS_clinical_classification = $this->input->post('BIRADS_clinical_classification');
        $percentage_of_mammo_density = $this->input->post('percentage_of_mammo_density');
        $mammo_comments = $this->input->post('mammo_comments');
        $BIRADS_density_classification = $this->input->post('BIRADS_density_classification');
        
        $abnormalities_mammo_flag_check = $this->record_model->update_checkbox($abnormalities_mammo_flag,'abnormalities_mammo_flag','patient_breast_screening_id','patient_breast_screening');
        $abnormalities_mammo_flag_uncheck = $this->record_model->update_checkbox_uncheck($patient_studies_id,$abnormalities_mammo_flag,'patient_breast_screening_id','abnormalities_mammo_flag','patient_studies_id','patient_breast_screening');
        
        $mammogram_in_sdmc_check = $this->record_model->update_checkbox($mammogram_in_sdmc,'mammogram_in_sdmc','patient_breast_screening_id','patient_breast_screening');
        $mammogram_in_sdmc_uncheck = $this->record_model->update_checkbox_uncheck($patient_studies_id,$mammogram_in_sdmc,'patient_breast_screening_id','mammogram_in_sdmc','patient_studies_id','patient_breast_screening');
        
        $is_cancer_mammogram_flag_check = $this->record_model->update_checkbox($is_cancer_mammogram_flag,'is_cancer_mammogram_flag','patient_breast_screening_id','patient_breast_screening');
        $is_cancer_mammogram_flag_uncheck = $this->record_model->update_checkbox_uncheck($patient_studies_id,$is_cancer_mammogram_flag,'patient_breast_screening_id','is_cancer_mammogram_flag','patient_studies_id','patient_breast_screening');
        
        $had_ultrasound_flag_check = $this->record_model->update_checkbox($had_ultrasound_flag,'had_ultrasound_flag','patient_breast_screening_id','patient_breast_screening');
        $had_ultrasound_flag_uncheck = $this->record_model->update_checkbox_uncheck($patient_studies_id,$had_ultrasound_flag,'patient_breast_screening_id','had_ultrasound_flag','patient_studies_id','patient_breast_screening');
        
        $abnormalities_ultrasound_flag_check = $this->record_model->update_checkbox($abnormalities_ultrasound_flag,'abnormalities_ultrasound_flag','patient_breast_screening_id','patient_breast_screening');
        $abnormalities_ultrasound_flag_uncheck = $this->record_model->update_checkbox_uncheck($patient_studies_id,$abnormalities_ultrasound_flag,'patient_breast_screening_id','abnormalities_ultrasound_flag','patient_studies_id','patient_breast_screening');
        
        $had_mri_flag_check = $this->record_model->update_checkbox($had_mri_flag,'had_mri_flag','patient_breast_screening_id','patient_breast_screening');
        $had_mri_flag_uncheck = $this->record_model->update_checkbox_uncheck($patient_studies_id,$had_mri_flag,'patient_breast_screening_id','had_mri_flag','patient_studies_id','patient_breast_screening');
        
        $abnormalities_MRI_flag_check = $this->record_model->update_checkbox($abnormalities_MRI_flag,'abnormalities_MRI_flag','patient_breast_screening_id','patient_breast_screening');
        $abnormalities_MRI_flag_uncheck = $this->record_model->update_checkbox_uncheck($patient_studies_id,$abnormalities_MRI_flag,'patient_breast_screening_id','abnormalities_MRI_flag','patient_studies_id','patient_breast_screening');

        if (!empty($patient_breast_screening_id)) {
            for ($i = 0; $i < count($patient_breast_screening_id); $i++) {
                $data_patient_breast_screening = array(
                    'date_of_first_mammogram' => $date_of_first_mammogram[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($date_of_first_mammogram[$i])),
                    'age_of_first_mammogram' => $age_of_first_mammogram[$i],
                    'age_of_recent_mammogram' => $age_of_recent_mammogram[$i],
                    'date_of_recent_mammogram' => $date_of_recent_mammogram[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($date_of_recent_mammogram[$i])),
                    'screening_centre' => $screening_centre[$i],
                    'total_no_of_mammogram' => $total_no_of_mammogram[$i],
                    'screening_interval' => $screening_interval[$i],
//                    'abnormalities_mammo_flag' => $abnormalities_mammo_flag[$i],
                    'name_of_radiologist' => $name_of_radiologist[$i],
//                    'had_ultrasound_flag' => $had_ultrasound_flag[$i], //from Ultrasound Details part
                    'total_no_of_ultrasound' => $total_no_of_ultrasound[$i],
//                    'abnormalities_ultrasound_flag' => $abnormalities_ultrasound_flag[$i],
//                    'had_mri_flag' => $had_mri_flag[$i], // from MRI Details part
//                    'abnormalities_MRI_flag' => $abnormalities_MRI_flag[$i],
                    'total_no_of_mri' => $total_no_of_mri[$i],
                    'screening_center_of_first_mammogram' => $screening_center_of_first_mammogram[$i],
                    'screening_center_of_recent_mammogram' => $screening_center_of_recent_mammogram[$i],
                    'details_of_first_mammogram' => $details_of_first_mammogram[$i],
                    'details_of_recent_mammogram' => $details_of_recent_mammogram[$i],
                    'motivaters_of_first_mammogram' => $motivaters_of_first_mammogram[$i],
                    'motivaters_of_recent_mammogram' => $motivaters_of_recent_mammogram[$i],
//                    'mammogram_in_sdmc' => $mammogram_in_sdmc[$i],
                    'reason_of_mammogram' => $reason_of_mammogram[$i],
                    'reason_of_mammogram_details' => $reason_of_mammogram_details[$i],
                    'action_suggested_on_mammogram_report' => $action_suggested_on_mammogram_report[$i],
                    'reason_of_action_suggested' => $reason_of_action_suggested[$i],
//                    'is_cancer_mammogram_flag' => $is_cancer_mammogram_flag[$i],
                    'site_effected_of_mammogram' => $site_effected_of_mammogram[$i],
                    'BIRADS_clinical_classification' => $BIRADS_clinical_classification[$i],
                    'percentage_of_mammo_density' => $percentage_of_mammo_density[$i],
                    'mammo_comments' => $mammo_comments[$i],
                    'modified_on' => $date,
                    'BIRADS_density_classification' => $BIRADS_density_classification[$i]
                );

                $this->db->where('patient_breast_screening_id', $patient_breast_screening_id[$i]);
                $this->db->where('patient_ic_no', $patient_ic_no);
                $this->db->update('patient_breast_screening', $data_patient_breast_screening);

                if ($this->db->affected_rows() > 0) {
                    echo '<h2>Data for id ' . $i . ' update successfully<h2>';
                } else {
                    echo '<h2>No update data for id ' . $i . '</h2>';
                }
                echo '<br/>';
            }
        }

//        $config['upload_path'] = './images/'; //$path=any path you want to save the file to...
//        $config['allowed_types'] = 'gif|jpg|png|jpeg'; //this is the file types allowed
//        $config['max_size'] = '100000'; //max file size
//        //$config['max_width']  = '1024';//if file type is image
//        //$config['max_height']  = '768';//if file type is image
//        $array_file_path = array();
//        $this->load->library('upload', $config);
//
//        foreach ($_FILES as $Key => $File) {
//            if ($File['size'] > 0) {
//                if ($this->upload->do_upload($Key)) {
//                    $data = $this->upload->data();
//                    //echo $data['full_path'];
//                    $array_file_path[] = $data['full_path'];
//                    //echo '<br/>';
//                } else {
//                    // throw error
//                    echo $this->upload->display_errors();
//                }
//            }
//        }
//        /* echo $array_file_path[0].'<br/>'; 
//          echo $array_file_path[1].'<br/>';
//          echo $array_file_path[2].'<br/>';
//          echo $array_file_path[3]; */
//        $array_file_path_length = sizeof($array_file_path);
//        $patient_mammo_raw_images_id = $this->input->post('patient_mammo_raw_images_id');
//        $patient_mammo_processed_images_id = $this->input->post('patient_mammo_processed_images_id');
//
//        if ($array_file_path_length >= 1) {
//            
//            for ($i = 0; $i < count($patient_mammo_raw_images_id); $i++) {
//            $data_patient_mammo_raw_images1 = array(
//                'modified_on' => $date,
//                'raw_image_file_name' => $array_file_path[0][$i]
//            );
//            
//        $this->db->where('patient_mammo_raw_images_id', $patient_mammo_raw_images_id[$i]);
//        $this->db->update('patient_relatives', $data_patient_mammo_raw_images1);
//            }
//        }
//
//        if ($array_file_path_length >= 2) {
//            
//            for ($i = 0; $i < count($patient_mammo_raw_images_id); $i++) {
//            $data_patient_mammo_raw_images2 = array(
//                'modified_on' => $date,
//                'raw_image_file_name' => $array_file_path[1][$i]
//            );
//            
//             $this->db->where('patient_mammo_raw_images_id', $patient_mammo_raw_images_id[$i]);
//             $this->db->update('patient_mammo_raw_images', $data_patient_mammo_raw_images2);
//            }
//             
//            }
//
//        if ($array_file_path_length >= 3) {
//            
//            for ($i = 0; $i < count($patient_mammo_raw_images_id); $i++) {
//            $data_patient_mammo_raw_images3 = array(
//                'modified_on' => $date,
//                'raw_image_file_name' => $array_file_path[2][$i]
//            );
//            
//             $this->db->where('patient_mammo_raw_images_id', $patient_mammo_raw_images_id[$i]);
//             $this->db->update('patient_mammo_raw_images', $data_patient_mammo_raw_images3);
//
//            }
//             
//            }
//
//        if ($array_file_path_length >= 4) {
//            
//            for ($i = 0; $i < count($patient_mammo_raw_images_id); $i++) {
//            $data_patient_mammo_raw_images4 = array(
//                'modified_on' => $date,
//                'raw_image_file_name' => $array_file_path[3][$i]
//            );
//            
//             $this->db->where('patient_mammo_raw_images_id', $patient_mammo_raw_images_id[$i]);
//             $this->db->update('patient_mammo_raw_images', $data_patient_mammo_raw_images4);
//        }
//        }
//
//        if ($array_file_path_length >= 5) {
//            
//            for ($i = 0; $i < count($patient_mammo_processed_images_id); $i++) {
//            $data_patient_mammo_processed_images1 = array(
//                'modified_on' => $date,
//                'processed_image_file_name' => $array_file_path[4][$i]
//            );
//            
//             $this->db->where('patient_mammo_processed_images_id', $patient_mammo_processed_images_id[$i]);
//            $this->db->update('patient_mammo_processed_images', $data_patient_mammo_processed_images1);
//        }
//        }
//
//        if ($array_file_path_length >= 6) {
//            
//            for ($i = 0; $i < count($patient_mammo_processed_images_id); $i++) {
//            $data_patient_mammo_processed_images2 = array(
//                'modified_on' => $date,
//                'processed_image_file_name' => $array_file_path[5][$i]
//            );
//            
//             $this->db->where('patient_mammo_processed_images_id', $patient_mammo_processed_images_id[$i]);
//            $this->db->update('patient_mammo_processed_images', $data_patient_mammo_processed_images2);
//            }
//        }
//
//        if ($array_file_path_length >= 7) {
//            
//            for ($i = 0; $i < count($patient_mammo_processed_images_id); $i++) {
//            $data_patient_mammo_processed_images3 = array(
//                'modified_on' => $date,
//                'processed_image_file_name' => $array_file_path[6][$i]
//            );
//            
//             $this->db->where('patient_mammo_processed_images_id', $patient_mammo_processed_images_id[$i]);
//            $this->db->update('patient_mammo_processed_images', $data_patient_mammo_processed_images3);
//            }
//        }
//
//        if ($array_file_path_length >= 8) {
//            
//            for ($i = 0; $i < count($patient_mammo_processed_images_id); $i++) {
//            $data_patient_mammo_processed_images4 = array(
//                'modified_on' => $date,
//                'processed_image_file_name' => $array_file_path[7][$i]
//            );
//            
//             $this->db->where('patient_mammo_processed_images_id', $patient_mammo_processed_images_id[$i]);
//            $this->db->update('patient_mammo_processed_images', $data_patient_mammo_processed_images4);
//            }  
//        }

        $mammo_left_right_breast_side = $this->input->post('mammo_left_right_breast_side');
        $mammo_upper_below_breast_side = $this->input->post('mammo_upper_below_breast_side');

        $patient_breast_abnormality_side_id = $this->input->post('patient_breast_abnormality_side_id');

        if (!empty($patient_breast_abnormality_side_id)) {
            for ($i = 0; $i < count($patient_breast_abnormality_side_id); $i++) {
                if ($mammo_left_right_breast_side == 'Left')
                    $left_breast = TRUE;
                else
                    $left_breast = FALSE;

                if ($mammo_left_right_breast_side == 'Right')
                    $right_breast = TRUE;
                else
                    $right_breast = FALSE;

                if ($mammo_upper_below_breast_side == 'Upper')
                    $upper = TRUE;
                else
                    $upper = FALSE;

                if ($mammo_upper_below_breast_side == 'Below')
                    $below = TRUE;
                else
                    $below = FALSE;

                $data_patient_breast_abnormality = array(
                    'left_breast' => $left_breast[$i],
                    'right_breast' => $right_breast[$i],
                    'upper' => $upper[$i],
                    'modified_on' => $date,
                    'below' => $below[$i]
                );

                //$this->db->where('patient_breast_screening_id', $patient_breast_screening_id[$i]);
                $this->db->where('patient_breast_abnormality_side_id', $patient_breast_abnormality_side_id[$i]);
                $this->db->update('patient_breast_abnormality', $data_patient_breast_abnormality);

                if ($this->db->affected_rows() > 0) {
                    echo '<h2>Data for id ' . $i . ' update successfully<h2>';
                } else {
                    echo '<h2>No update data for id ' . $i . '</h2>';
                }
                echo '<br/>';
            }
        }

        $patient_ultra_abn = $this->input->post('patient_ultra_abn');
        $is_abnormality_detected = $this->input->post('abnormalities_ultrasound_flag');
        $ultrasound_date = $this->input->post('mammo_ultrasound_date');
        $ultrasound_comments = $this->input->post('mammo_ultrasound_details');


        if (!empty($patient_ultra_abn)) {
            for ($i = 0; $i < count($patient_ultra_abn); $i++) {
                $data_patient_ultrasound_abnormality = array(
                    'is_abnormality_detected' => $is_abnormality_detected[$i],
                    'ultrasound_date' => $ultrasound_date[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($ultrasound_date[$i])),
                    'comments' => $ultrasound_comments[$i],
                    'modified_on' => $date,
                    'patient_breast_screening_id' => $patient_breast_screening_id[$i]
                );

                $this->db->where('patient_ultra_abn', $patient_ultra_abn[$i]);
                $this->db->update('patient_ultrasound_abnormality', $data_patient_ultrasound_abnormality);

                if ($this->db->affected_rows() > 0) {
                    echo '<h2>Data for id ' . $i . ' update successfully<h2>';
                } else {
                    echo '<h2>No update data for id ' . $i . '</h2>';
                }
                echo '<br/>';
            }
        }


        $patient_mri_abnormality_id = $this->input->post('patient_mri_abnormality_id');
        $mri_abnormality_detected = $this->input->post('abnormalities_mri_flag');

        $mri_date = $this->input->post('mammo_mri_date');
        $mri_comments = $this->input->post('mammo_MRI_details');

        if (!empty($patient_mri_abnormality_id)) {
            for ($i = 0; $i < count($patient_mri_abnormality_id); $i++) {
                $data_patient_mri_abnormality = array(
                    'is_abnormality_detected' => $mri_abnormality_detected[$i],
                    'mri_date' => $mri_date[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($mri_date[$i])),
                    'comments' => $mri_comments[$i],
                );

                $this->db->where('patient_mri_abnormlity_id', $patient_mri_abnormality_id[$i]);
                $this->db->update('patient_mri_abnormality', $data_patient_mri_abnormality);

                if ($this->db->affected_rows() > 0) {
                    echo '<h2>Data for id ' . $i . ' update successfully<h2>';
                } else {
                    echo '<h2>No update data for id ' . $i . '</h2>';
                }
                echo '<br/>';
            }
        }

        $patient_non_cancer_surgery_id = $this->input->post('patient_non_cancer_surgery_id');
        $breast_surgery_type = $this->input->post('non_cancer_surgery_type');
        $breast_reason_of_surgery = $this->input->post('reason_for_non_cancer_surgery');

        $breast_date_of_surgery = $this->input->post('date_of_non_cancer_surgery');

        $breast_age_of_surgery = $this->input->post('age_at_non_cancer_surgery');
        $breast_comments = $this->input->post('non_cancer_surgery_comments');
        $surgery_type = $this->input->post('ovary_non_cancer_surgery_type');
        $reason_for_surgery = $this->input->post('ovary_reason_for_non_cancer_surgery');
        $date_of_surgery = $this->input->post('ovary_date_of_non_cancer_surgery');

        $age_at_surgery = $this->input->post('ovary_age_at_non_cancer_surgery');
        $non_surgery_comments = $this->input->post('ovary_non_cancer_surgery_comments');

        if (!empty($patient_non_cancer_surgery_id)) {

            for ($i = 0; $i < count($patient_non_cancer_surgery_id); $i++) {
                $data_patient_non_cancer_surgery = array(
                    'breast_surgery_type' => $breast_surgery_type[$i],
                    'breast_reason_of_surgery' => $breast_reason_of_surgery[$i],
                    'breast_date_of_surgery' => $breast_date_of_surgery[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($breast_date_of_surgery[$i])),
                    'breast_age_of_surgery' => $breast_age_of_surgery[$i],
                    'breast_comments' => $breast_comments[$i],
                    'surgery_type' => $surgery_type[$i],
                    'reason_for_surgery' => $reason_for_surgery[$i],
                    'date_of_surgery' => $date_of_surgery[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($date_of_surgery[$i])),
                    'age_at_surgery' => $age_at_surgery[$i],
                    'modified_on' => $date,
                    'comments' => $non_surgery_comments[$i]
                );

                $this->db->where('patient_non_cancer_surgery_id', $patient_non_cancer_surgery_id[$i]);
                //$this->db->where('patient_studies_id', $patient_studies_id);
                $this->db->update('patient_non_cancer_surgery', $data_patient_non_cancer_surgery);

                if ($this->db->affected_rows() > 0) {
                    echo '<h2>Data for id ' . $i . ' update successfully<h2>';
                } else {
                    echo '<h2>No update data for id ' . $i . '</h2>';
                }
                echo '<br/>';
            }
        }

        $patient_risk_reducing_surgery_id = $this->input->post('patient_risk_reducing_surgery_id');
        $had_new_lesion_surgery_flag = $this->input->post('had_new_risk_reducing_surgery');
        $had_complete_removal_surgery_flag = $this->input->post('had_new_complete_removal_surgery');
        
        $had_new_lesion_surgery_flag_check = $this->record_model->update_checkbox($had_new_lesion_surgery_flag,'had_new_lesion_surgery_flag','patient_risk_reducing_surgery_id','patient_risk_reducing_surgery');
        $had_new_lesion_surgery_flag_uncheck = $this->record_model->update_checkbox_uncheck($patient_studies_id,$had_new_lesion_surgery_flag,'patient_risk_reducing_surgery_id','had_new_lesion_surgery_flag','patient_studies_id','patient_risk_reducing_surgery');
        
        $had_complete_removal_surgery_flag_check = $this->record_model->update_checkbox($had_complete_removal_surgery_flag,'had_complete_removal_surgery_flag','patient_risk_reducing_surgery_id','patient_risk_reducing_surgery');
        $had_complete_removal_surgery_flag_uncheck = $this->record_model->update_checkbox_uncheck($patient_studies_id,$had_complete_removal_surgery_flag,'patient_risk_reducing_surgery_id','had_complete_removal_surgery_flag','patient_studies_id','patient_risk_reducing_surgery');

        if (!empty($patient_risk_reducing_surgery_id)) {
            for ($i = 0; $i < count($patient_risk_reducing_surgery_id); $i++) {
                $data_patient_risk_reducing_surgery = array(
//                    'had_new_lesion_surgery_flag' => $had_new_lesion_surgery_flag[$i],
                    'modified_on' => $date,
//                    'had_complete_removal_surgery_flag' => $had_complete_removal_surgery_flag[$i]
                );

                $this->db->where('patient_risk_reducing_surgery_id', $patient_risk_reducing_surgery_id[$i]);
                $this->db->update('patient_risk_reducing_surgery', $data_patient_risk_reducing_surgery);

                if ($this->db->affected_rows() > 0) {
                    echo '<h2>Data for id ' . $i . ' update successfully<h2>';
                } else {
                    echo '<h2>No update data for id ' . $i . '</h2>';
                }
                echo '<br/>';
            }
        }

        $patient_risk_reducing_surgery_complete_removal_id = $this->input->post('patient_risk_reducing_surgery_complete_removal_id');

        $surgery_date = $this->input->post('non_cancerous_complete_removal_date');

        $surgery_reason = $this->input->post('non_cancerous_complete_removal_reason');
        $removal_non_cancerous_site_id = $this->input->post('non_cancerous_complete_removal_site');

        if (!empty($patient_risk_reducing_surgery_complete_removal_id)) {

            for ($i = 0; $i < count($patient_risk_reducing_surgery_complete_removal_id); $i++) {

                $removal_non_cancerous_site = $this->record_model->get_non_cancerous_benign_site_id($removal_non_cancerous_site_id[$i]);

                $data_patient_risk_reducing_surgery_complete_removal = array(
                    'non_cancerous_site_id' => $removal_non_cancerous_site,
                    'surgery_date' => $surgery_date[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($surgery_date[$i])),
                    'modified_on' => $date,
                    'surgery_reason' => $surgery_reason[$i]
                );
                //print_r($data_patient_risk_reducing_surgery_complete_removal);exit;

                $this->db->where('patient_risk_reducing_surgery_complete_removal_id', $patient_risk_reducing_surgery_complete_removal_id[$i]);
                $this->db->update('patient_risk_reducing_surgery_complete_removal', $data_patient_risk_reducing_surgery_complete_removal);

                if ($this->db->affected_rows() > 0) {
                    echo '<h2>Data for id ' . $i . ' update successfully<h2>';
                } else {
                    echo '<h2>No update data for id ' . $i . '</h2>';
                }
                echo '<br/>';
            }
        }

        $patient_risk_reducing_surgery_lesion_id = $this->input->post('patient_risk_reducing_surgery_lesion_id');
        $non_cancerous_site_id = $this->input->post('non_cancerous_benign_site');
        $non_cancerous_surgery_date = $this->input->post('non_cancerous_benign_date');

        if (!empty($patient_risk_reducing_surgery_lesion_id)) {
            for ($i = 0; $i < count($patient_risk_reducing_surgery_lesion_id); $i++) {

                $non_cancerous_site = $this->record_model->get_non_cancerous_benign_site_id($non_cancerous_site_id[$i]);

                $data_patient_risk_reducing_surgery_lesion = array(
                    'non_cancerous_site_id' => $non_cancerous_site,
                    'modified_on' => $date,
                    'surgery_date' => $non_cancerous_surgery_date[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($non_cancerous_surgery_date[$i]))
                );
                //print_r($data_patient_risk_reducing_surgery_lesion);exit;

                $this->db->where('patient_risk_reducing_surgery_lesion_id', $patient_risk_reducing_surgery_lesion_id[$i]);
                $this->db->update('patient_risk_reducing_surgery_lesion', $data_patient_risk_reducing_surgery_lesion);

                if ($this->db->affected_rows() > 0) {
                    echo '<h2>Data for id ' . $i . ' update successfully<h2>';
                } else {
                    echo '<h2>No update data for id ' . $i . '</h2>';
                }

                $patient_ovarian_screening_id = $this->input->post('patient_ovarian_screening_id');
                $ovarian_screening_type_id = $this->input->post('ovarian_screening_type_name');
                $oavrian_screening_date = $this->input->post('physical_exam_date');
                $ovarian_screening_is_abnormality_detected = $this->input->post('physical_exam_is_abnormality_detected');
                $ovarian_screening_additional_info = $this->input->post('physical_exam_additional_info');
                
                $ovarian_screening_is_abnormality_detected_check = $this->record_model->update_checkbox($ovarian_screening_is_abnormality_detected,'is_abnormality_detected','patient_ovarian_screening_id','patient_ovarian_screening');
                $ovarian_screening_is_abnormality_detected_uncheck = $this->record_model->update_checkbox_uncheck($patient_studies_id,$ovarian_screening_is_abnormality_detected,'patient_ovarian_screening_id','is_abnormality_detected','patient_studies_id','patient_ovarian_screening');

                if (!empty($patient_ovarian_screening_id)) {

                    for ($i = 0; $i < count($patient_ovarian_screening_id); $i++) {

                        $ovarian_screening_type = $this->record_model->get_ovarian_screening_type($ovarian_screening_type_id[$i]);

                        $data_patient_ovarian_screening = array(
                            'ovarian_screening_type_id' => $ovarian_screening_type[$i],
                            'screening_date' => $oavrian_screening_date[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($oavrian_screening_date[$i])),
//                            'is_abnormality_detected' => $ovarian_screening_is_abnormality_detected[$i],
                            'modified_on' => $date,
                            'additional_info' => $ovarian_screening_additional_info[$i]
                        );

                        $this->db->where('patient_ovarian_screening_id', $patient_ovarian_screening_id[$i]);
                        $this->db->update('patient_ovarian_screening', $data_patient_ovarian_screening);

                        if ($this->db->affected_rows() > 0) {
                            echo '<h2>Data for id ' . $i . ' update successfully<h2>';
                        } else {
                            echo '<h2>No update data for id ' . $i . '</h2>';
                        }
                        echo '<br/>';
                    }
                }

                $patient_other_screening_id = $this->input->post('patient_other_screening_id');
                $other_screening_type = $this->input->post('screening_name');
                $other_age_at_screening = $this->input->post('age_at_screening');
                $other_screening_center = $this->input->post('place_of_screening');
                $other_screening_result = $this->input->post('screening_results');

                if (!empty($patient_other_screening_id)) {
                    for ($i = 0; $i < count($patient_other_screening_id); $i++) {
                        $data_patient_other_screening = array(
                            'screening_type' => $other_screening_type[$i],
                            //'total_no_of_screening' => $this->input->post('total_no_of_screening'),
                            'age_at_screening' => $other_age_at_screening[$i],
                            'screening_center' => $other_screening_center[$i],
                            'modified_on' => $date,
                            'screening_result' => $other_screening_result[$i]
                        );

                        $this->db->where('patient_other_screening_id', $patient_other_screening_id[$i]);
                        $this->db->update('patient_other_screening', $data_patient_other_screening);

                        if ($this->db->affected_rows() > 0) {
                            echo '<h2>Data for id ' . $i . ' update successfully<h2>';
                        } else {
                            echo '<h2>No update data for id ' . $i . '</h2>';
                        }
                        echo '<br/>';
                    }
                }

                $patient_surveillance_id = $this->input->post('patient_surveillance_id');
                $surveillance_recruitment_center = $this->input->post('surveillance_recruitment_center');
                $surveillance_type = $this->input->post('surveillance_type');
                $surveillance_first_consultation_date = $this->input->post('surveillance_first_consultation_date');
                $surveillance_first_consultation_place = $this->input->post('surveillance_first_consultation_place');
                $surveillance_surveillance_interval = $this->input->post('surveillance_interval');
                $surveillance_diagnosis = $this->input->post('surveillance_diagnosis');
                $surveillance_due_date = $this->input->post('surveillance_due_date');
                $surveillance_reminder_sent_date = $this->input->post('surveillance_reminder_sent_date');
                $surveillance_done_date = $this->input->post('surveillance_done_date');

                $surveillance_reminded_by = $this->input->post('surveillance_reminded_by');
                $surveillance_timing = $this->input->post('surveillance_timing');
                $surveillance_symptoms = $this->input->post('surveillance_symptoms');
                $surveillance_doctor_name = $this->input->post('surveillance_doctor_name');
                $surveillance_done_place = $this->input->post('surveillance_place');
                $surveillance_outcome = $this->input->post('surveillance_outcome');
                $surveillance_comments = $this->input->post('surveillance_comments');

                if (!empty($patient_surveillance_id)) {
                    for ($i = 0; $i < count($patient_surveillance_id); $i++) {
                        $data_patient_surveillance = array(
                            'recruitment_center' => $surveillance_recruitment_center[$i],
                            'type' => $surveillance_type[$i],
                            'first_consultation_date' => $surveillance_first_consultation_date[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($surveillance_first_consultation_date[$i])),
                            'first_consultation_place' => $surveillance_first_consultation_place[$i],
                            'surveillance_interval' => $surveillance_surveillance_interval[$i],
                            'diagnosis' => $surveillance_diagnosis[$i],
                            'due_date' => $surveillance_due_date[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($surveillance_due_date[$i])),
                            'reminder_sent_date' => $surveillance_reminder_sent_date[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($surveillance_reminder_sent_date[$i])),
                            'surveillance_done_date' => $surveillance_done_date[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($surveillance_done_date[$i])),
                            'reminded_by' => $surveillance_reminded_by[$i],
                            'timing' => $surveillance_timing[$i],
                            'symptoms' => $surveillance_symptoms[$i],
                            'doctor_name' => $surveillance_doctor_name[$i],
                            'surveillance_done_place' => $surveillance_done_place[$i],
                            'outcome' => $surveillance_outcome[$i],
                            'modified_on' => $date,
                            'comments' => $surveillance_comments[$i]
                        );

                        //$this->db->where('patient_studies_id', $patient_studies_id);
                        $this->db->where('patient_surveillance_id', $patient_surveillance_id[$i]);
                        $this->db->update('patient_surveillance', $data_patient_surveillance);

                        if ($this->db->affected_rows() > 0) {
                            echo '<h2>Data for id ' . $i . ' update successfully<h2>';
                        } else {
                            echo '<h2>No update data for id ' . $i . '</h2>';
                        }
                        echo '<br/>';
                    }
                }
            }
        }
    }

    function lifestyle_insertion() {

            //need to calculate $patient_studies_id by using study name-->studies_id and patient_ic_no

            date_default_timezone_set("Asia/Kuala_lumpur");
            $date = date('Y-m-d H:i:s'); //Returns IST 

            $studies_name = $this->input->post('studies_name');
            $studies_id = $this->excell_sheets_model->get_studies_id($studies_name);
            $data_keys = array(
                'patient_ic_no' => $this->input->post('IC_no'),
                'studies_id' => $studies_id
            );
            echo '<pre>';
            //print_r($data_keys);echo '<br/>';
            $patient_studies_id = $this->record_model->get_patient_suudies_id($data_keys);
            //echo $patient_studies_id;
            //echo '<br/>';

            $questionnaire_date = $this->input->post('questionnaire_date');

            $data_patient_lifestyle_factors = array(
                'patient_studies_id' => $patient_studies_id,
                'questionnaire_date' => $questionnaire_date == '' ? '0000-00-00' : date("Y-m-d", strtotime($questionnaire_date)),
                'self_image_at_7years' => $this->input->post('self_image_at_7years'),
                'self_image_at_18years' => $this->input->post('self_image_at_18years'),
                'self_image_now' => $this->input->post('self_image_now'),
                'pa_strenuous_activity_childhood' => $this->input->post('pa_strenuous_exercise_childhood'),
                'pa_moderate_exercise_childhood' => $this->input->post('pa_moderate_exercise_childhood'),
                'pa_gentle_exercise_childhood' => $this->input->post('pa_gentle_exercise_childhood'),
                'pa_strenuous_activity_adult' => $this->input->post('pa_strenuous_exercise_adult'),
                'pa_moderate_exercise_adult' => $this->input->post('pa_moderate_exercise_adult'),
                'pa_gentle_exercise_adult' => $this->input->post('pa_gentle_exercise_adult'),
                'pa_strenuous_activity_now' => $this->input->post('pa_strenuous_exercise_now'),
                'pa_moderate_exercise_now' => $this->input->post('pa_moderate_exercise_now'),
                'pa_gentle_exercise_now' => $this->input->post('pa_gentle_exercise_now'),
                'cigarrets_smoked_flag' => $this->input->post('cigarettes_smoked_flag'),
                'cigarrets_still_smoked_flag' => $this->input->post('cigarettes_still_smoked_flag'),
                'total_smoked_years' => $this->input->post('total_smoked_years'),
                'cigarrets_count_at_teen' => $this->input->post('cigarettes_count_at_teen'),
                'cigarrets_count_at_twenties' => $this->input->post('cigarettes_count_at_twenties'),
                'cigarrets_count_at_thirties' => $this->input->post('cigarettes_count_at_thirties'),
                'cigarrets_count_at_fourrties' => $this->input->post('cigarettes_count_at_forties'),
                'cigarrets_count_at_fifties' => $this->input->post('cigarettes_count_at_fifties'),
                'cigarrets_count_at_sixties_and_above' => $this->input->post('cigarettes_count_at_sixties_and_above'),
                'cigarrets_count_one_year_before_diagnosed' => $this->input->post('cigarettes_count_one_year_before_diagnosed'),
                'alcohol_drunk_flag' => $this->input->post('alcohol_drunk_flag'),
                'alcohol_frequency' => $this->input->post('alcohol_average'),
                'alcohol_comments' => $this->input->post('alcohol_average_details'),
                'coffee_drunk_flag' => $this->input->post('coffee_drunk_flag'),
                'coffee_age' => $this->input->post('coffee_age'),
                'coffee_frequency' => $this->input->post('coffee_average'),
                'tea_drunk_flag' => $this->input->post('tea_drunk_flag'),
                'tea_age' => $this->input->post('tea_age'),
                'tea_frequency' => $this->input->post('tea_average'),
                'tea_type' => $this->input->post('tea_type'),
                //'tea_type_other' => $this->input->post('tea_type_other'),
                'soya_bean_drunk_flag' => $this->input->post('soya_bean_drunk_flag'),
                'soya_bean_frequency' => $this->input->post('soya_bean_average'),
                'soya_products_flag' => $this->input->post('soya_products_flag'),
                'soya_products_average' => $this->input->post('soya_products_average'),
                //'soya_products_average_other' => $this->input->post('soya_products_average_other'),
                'diabetes_flag' => $this->input->post('diabetes_flag'),
                'medicine_for_diabetes_flag' => $this->input->post('medicine_for_diabetes_flag'),
                'created_on' => $date,
                'diabetes_medicine_name' => $this->input->post('diabates_medicine_name')
            );
            //print_r($data_patient_lifestyle_factors);exit;
            //echo '<br/>';

            $patient_lifestyle_factors_id = $this->record_model->insert_patient_lifestyle_factors($data_patient_lifestyle_factors);
            if ($patient_lifestyle_factors_id > 0) {
                echo "<h2>Data Added successfully at patient_lifestyle_factors</h2>";
            } else {
                echo "<h2>Failed to insert at patient_lifestyle_factors</h2>";
            }
            echo '<br/>';

            $date_period_stops = $this->input->post('date_period_stops');

            $data_patient_menstruation = array(
                'patient_studies_id' => $patient_studies_id,
                'age_period_starts' => $this->input->post('age_period_starts'),
                'still_period_flag' => $this->input->post('still_period_flag'),
                'period_type' => $this->input->post('period_type'),
                'period_cycle_days' => $this->input->post('period_cycle_days'),
                'period_cycle_days_other_details' => $this->input->post('period_cycle_days_other_details'),
                'age_at_menopause' => $this->input->post('age_period_stops'),
                'date_period_stops' => $date_period_stops == '' ? '0000-00-00' : date("Y-m-d", strtotime($date_period_stops)),
                'reason_period_stops' => $this->input->post('reason_period_stops'),
                'created_on' => $date,
                'reason_period_stops_other_details' => $this->input->post('reason_period_stops_other_details')
            );
            //print_r($data_patient_menstruation);
            //echo '<br/>';

            $patient_menstruation_id = $this->record_model->insert_patient_menstruation($data_patient_menstruation);
            if ($patient_menstruation_id > 0) {
                echo "<h2>Data Added successfully at patient_menstruation</h2>";
            } else {
                echo "<h2>Failed to insert at patient_menstruation</h2>";
            }
            echo '<br/>';

            $data_patient_parity_table = array(
                'patient_studies_id' => $patient_studies_id,
                'created_on' => $date,
                //'pregnant_flag' => $this->input->post('never_been_pregnant_flag'),
                'pregnant_flag' => $this->input->post('pregnent_flag')
            );

            //print_r($data_patient_parity_table);
            //echo '<br/>';
            //patient_parity_table_id = //after inserting at patient_parity_table we will use it at next table

            $patient_parity_table_id = $this->record_model->insert_patient_parity_table($data_patient_parity_table);
            if ($patient_parity_table_id > 0) {
                echo "<h2>Data Added successfully at patient_parity_table</h2>";
            } else {
                echo "<h2>Failed to insert at patient_parity_table</h2>";
            }
            echo '<br/>';

            $date_of_birth = $this->input->post('child_birthdate');

            $data_patient_parity_record = array(
                'pregnancy_type' => $this->input->post('pregnancy_type'),
                'gender' => $this->input->post('child_gender'),
                'age_child_at_consent' => $this->input->post('child_age_at_consent'),
                'date_of_birth' => $date_of_birth == '' ? '0000-00-00' : date("Y-m-d", strtotime($date_of_birth)),
                'year_of_birth' => $this->input->post('child_birthyear'),
                'birthweight' => $this->input->post('child_birthweight'),
                'created_on' => $date,
                'breastfeeding_duration' => $this->input->post('child_breastfeeding_duration')
            );
            //print_r($data_patient_parity_record);
            //echo '<br/>';

            $patient_parity_record_id = $this->record_model->insert_patient_parity_record($data_patient_parity_record);

            $add_parity = $this->getDynamicFieldsInputsArray("parity", $patient_parity_table_id);

            if ($patient_parity_record_id > 0) {
                echo "<h2>Data Added successfully at patient_parity_record</h2>";
            } else {
                echo "<h2>Failed to insert at patient_parity_record</h2>";
            }
            echo '<br/>';

            $contraceptive_start_date = $this->input->post('contraceptive_start_date');
            $contraceptive_end_date = $this->input->post('contraceptive_end_date');
            $hrt_start_date = $this->input->post('hrt_start_date');
            $hrt_end_date = $this->input->post('hrt_end_date');

            $data_patient_infertility = array(
                'patient_studies_id' => $patient_studies_id,
                'infertility_testing_flag' => $this->input->post('infertility_testing_flag'),
                'infertility_comments' => $this->input->post('infertility_treatment_details'),
                'infertility_treatment_duration' => $this->input->post('infertility_treatment_duration'),
                'infertility_comments' => $this->input->post('infertility_treatment_comments'),
                'contraceptive_pills_flag' => $this->input->post('contraceptive_pills_flag'),
                //'contraceptive_pills_details' => $this->input->post('contraceptive_pills_details'),
                'currently_taking_contraceptive_pills_flag' => $this->input->post('currently_taking_contraceptive_pills_flag'),
                'contraceptive_start_date' => $contraceptive_start_date == '' ? '0000-00-00' : date("Y-m-d", strtotime($contraceptive_start_date)),
                'contraceptive_end_date' => $contraceptive_end_date == '' ? '0000-00-00' : date("Y-m-d", strtotime($contraceptive_end_date)),
                'contraceptive_end_age' => $this->input->post('contraceptive_end_age'),
                'contraceptive_start_age' => $this->input->post('contraceptive_start_age'),
                'contraceptive_duration' => $this->input->post('contraceptive_duration'),
                'hrt_start_age' => $this->input->post('hrt_start_age'),
                'hrt_end_age' => $this->input->post('hrt_end_age'),
                'hrt_flag' => $this->input->post('HRT_flag'),
                //'hrt_details' => $this->input->post('HRT_details'),
                'currently_using_hrt_flag' => $this->input->post('currently_using_hrt_flag'),
                'hrt_start_date' => $hrt_start_date == '' ? '0000-00-00' : date("Y-m-d", strtotime($hrt_start_date)),
                'created_on' => $date,
                'hrt_duration' => $this->input->post('HRT_duration'),
                'hrt_end_date' => $hrt_end_date == '' ? '0000-00-00' : date("Y-m-d", strtotime($hrt_end_date))
            );
            // print_r($data_patient_infertility);
            //echo '<br/>';

            $patient_infertility_id = $this->record_model->insert_patient_infertility($data_patient_infertility);
            if ($patient_infertility_id > 0) {
                echo "<h2>Data Added successfully at patient_infertility</h2>";
            } else {
                echo "<h2>Failed to insert at patient_infertility</h2>";
            }
            echo '<br/>';

            $treatment_name = $this->input->post('gnc_treatment_name');
            $treatment_id = $this->record_model->get_treatment_id($treatment_name);
            $data_patient_gynaecological_surgery_history = array(
                'patient_studies_id' => $patient_studies_id,
                'had_gnc_surgery_flag' => $this->input->post('had_gnc_surgery_flag'),
                'surgery_year' => $this->input->post('gnc_surgery_year'),
                'treatment_id' => $treatment_id,
                'created_on' => $date,
                'gnc_treatment_name_other_details' => $this->input->post('gnc_treatment_name_other_details')
            );
            //print_r($data_patient_gynaecological_surgery_history);
            //echo '<br/>';

            $patient_gynaecological_surgery_history_id = $this->record_model->insert_patient_gynaecological_surgery_history($data_patient_gynaecological_surgery_history);

            if ($patient_gynaecological_surgery_history_id > 0) {
                echo "<h2>Data Added successfully at patient_gynaecological_surgery_history</h2>";
            } else {
                echo "<h2>Failed to insert at patient_gynaecological_surgery_history</h2>";
            }
            echo '<br/>';
//        if ($patient_gynaecological_surgery_history_id && $patient_lifestyle_factors_id && $patient_menstruation_id && $patient_parity_table_id && $patient_parity_record_id && $patient_infertility_id && $patient_gynaecological_surgery_history_id > 0) {
//            echo "<h2>Data Added successfully.</h2>";
//        } else {
//            echo "<h2>Failed to insert data.</h2>";
//        }
        }

        function lifestyle_update() {

            //need to calculate $patient_studies_id by using study name-->studies_id and patient_ic_no

            date_default_timezone_set("Asia/Kuala_lumpur");
            $date = date('Y-m-d H:i:s'); //Returns IST 

            $patient_lifestyle_factors_id = $this->input->post('patient_lifestyle_factors_id');
            $patient_studies_id = $this->input->post('patient_studies_id');
            if (!empty($patient_lifestyle_factors_id)) {

                $date_questionnaire = $this->input->post('questionnaire_date');

                $data_patient_lifestyle_factors = array(
                    'questionnaire_date' => $date_questionnaire == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($date_questionnaire)),
                    'self_image_at_7years' => $this->input->post('self_image_at_7years'),
                    'self_image_at_18years' => $this->input->post('self_image_at_18years'),
                    'self_image_now' => $this->input->post('self_image_now'),
                    'pa_strenuous_activity_childhood' => $this->input->post('pa_strenuous_exercise_childhood'),
                    'pa_moderate_exercise_childhood' => $this->input->post('pa_moderate_exercise_childhood'),
                    'pa_gentle_exercise_childhood' => $this->input->post('pa_gentle_exercise_childhood'),
                    'pa_strenuous_activity_adult' => $this->input->post('pa_strenuous_exercise_adult'),
                    'pa_moderate_exercise_adult' => $this->input->post('pa_moderate_exercise_adult'),
                    'pa_gentle_exercise_adult' => $this->input->post('pa_gentle_exercise_adult'),
                    'pa_strenuous_activity_now' => $this->input->post('pa_strenuous_exercise_now'),
                    'pa_moderate_exercise_now' => $this->input->post('pa_moderate_exercise_now'),
                    'pa_gentle_exercise_now' => $this->input->post('pa_gentle_exercise_now'),
                    'cigarrets_smoked_flag' => $this->input->post('cigarettes_smoked_flag'),
                    'cigarrets_still_smoked_flag' => $this->input->post('cigarettes_still_smoked_flag'),
                    'total_smoked_years' => $this->input->post('total_smoked_years'),
                    'cigarrets_count_at_teen' => $this->input->post('cigarettes_count_at_teen'),
                    'cigarrets_count_at_twenties' => $this->input->post('cigarettes_count_at_twenties'),
                    'cigarrets_count_at_thirties' => $this->input->post('cigarettes_count_at_thirties'),
                    'cigarrets_count_at_fourrties' => $this->input->post('cigarettes_count_at_forties'),
                    'cigarrets_count_at_fifties' => $this->input->post('cigarettes_count_at_fifties'),
                    'cigarrets_count_at_sixties_and_above' => $this->input->post('cigarettes_count_at_sixties_and_above'),
                    'cigarrets_count_one_year_before_diagnosed' => $this->input->post('cigarettes_count_one_year_before_diagnosed'),
                    'alcohol_drunk_flag' => $this->input->post('alcohol_drunk_flag'),
                    'alcohol_frequency' => $this->input->post('alcohol_average'),
                    'alcohol_comments' => $this->input->post('alcohol_average_details'),
                    'coffee_drunk_flag' => $this->input->post('coffee_drunk_flag'),
                    'coffee_age' => $this->input->post('coffee_age'),
                    'coffee_frequency' => $this->input->post('coffee_average'),
                    'tea_drunk_flag' => $this->input->post('tea_drunk_flag'),
                    'tea_age' => $this->input->post('tea_age'),
                    'tea_frequency' => $this->input->post('tea_average'),
                    'tea_type' => $this->input->post('tea_type'),
                    //'tea_type_other' => $this->input->post('tea_type_other'),
                    'soya_bean_drunk_flag' => $this->input->post('soya_bean_drunk_flag'),
                    'soya_bean_frequency' => $this->input->post('soya_bean_average'),
                    'soya_products_flag' => $this->input->post('soya_products_flag'),
                    'soya_products_average' => $this->input->post('soya_products_average'),
                    //'soya_products_average_other' => $this->input->post('soya_products_average_other'),
                    'diabetes_flag' => $this->input->post('diabetes_flag'),
                    'medicine_for_diabetes_flag' => $this->input->post('medicine_for_diabetes_flag'),
                    'created_on' => $date,
                    'diabetes_medicine_name' => $this->input->post('diabates_medicine_name')
                );


//        print_r($data_patient_lifestyle_factors);exit;
                //echo '<br/>';

                $this->db->where('patient_lifestyle_factors_id', $patient_lifestyle_factors_id);
                $this->db->where('patient_studies_id', $patient_studies_id);
                $this->db->update('patient_lifestyle_factors', $data_patient_lifestyle_factors);

                //echo $this->db->last_query();exit;

                if ($this->db->affected_rows() > 0) {
                    echo '<h2>Data update successfully<h2>';
                } else {
                    echo '<h2>No update data</h2>';
                }
                echo '<br/>';
            }
            $patient_menstruation_id = $this->input->post('patient_menstruation_id');

            $date_stop_period = $this->input->post('date_period_stops');

            if (!empty($patient_menstruation_id)) {
                $data_patient_menstruation = array(
                    'age_period_starts' => $this->input->post('age_period_starts'),
                    'still_period_flag' => $this->input->post('still_period_flag'),
                    'period_type' => $this->input->post('period_type'),
                    'period_cycle_days' => $this->input->post('period_cycle_days'),
                    'period_cycle_days_other_details' => $this->input->post('period_cycle_days_other_details'),
                    'age_at_menopause' => $this->input->post('age_period_stops'),
                    'date_period_stops' => $date_stop_period == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($date_stop_period)),
                    'reason_period_stops' => $this->input->post('reason_period_stops'),
                    'created_on' => $date,
                    'reason_period_stops_other_details' => $this->input->post('reason_period_stops_other_details')
                );
                //print_r($data_patient_menstruation);
                //echo '<br/>';

                if ($this->db->affected_rows() > 0) {
                    echo '<h2>Data update successfully<h2>';
                } else {
                    echo '<h2>No update data</h2>';
                }
                echo '<br/>';
            }
            $patient_menstruation_id = $this->input->post('patient_menstruation_id');

            if (!empty($patient_menstruation_id)) {
                $data_patient_menstruation = array(
                    'age_period_starts' => $this->input->post('age_period_starts'),
                    'still_period_flag' => $this->input->post('still_period_flag'),
                    'period_type' => $this->input->post('period_type'),
                    'period_cycle_days' => $this->input->post('period_cycle_days'),
                    'period_cycle_days_other_details' => $this->input->post('period_cycle_days_other_details'),
                    'age_at_menopause' => $this->input->post('age_period_stops'),
                    'date_period_stops' => date('Y-m-d', strtotime($this->input->post('date_period_stops'))),
                    'reason_period_stops' => $this->input->post('reason_period_stops'),
                    'created_on' => $date,
                    'reason_period_stops_other_details' => $this->input->post('reason_period_stops_other_details')
                );
                //print_r($data_patient_menstruation);
                //echo '<br/>';

                $this->db->where('patient_menstruation_id', $patient_menstruation_id);
                $this->db->where('patient_studies_id', $patient_studies_id);
                $this->db->update('patient_menstruation', $data_patient_menstruation);

                if ($this->db->affected_rows() > 0) {
                    echo '<h2>Data update successfully<h2>';
                } else {
                    echo '<h2>No update data</h2>';
                }
                echo '<br/>';
            }

            $patient_parity_table_id = $this->input->post('patient_parity_table_id');
            if (!empty($patient_parity_table_id)) {

                $data_patient_parity_table = array(
                    'modified_on' => $date,
                    //'pregnant_flag' => $this->input->post('never_been_pregnant_flag'),
                    'pregnant_flag' => $this->input->post('pregnent_flag')
                );

                $this->db->where('patient_parity_id', $patient_parity_table_id);
                $this->db->where('patient_studies_id', $patient_studies_id);
                $this->db->update('patient_parity_table', $data_patient_parity_table);

                if ($this->db->affected_rows() > 0) {
                    echo '<h2>Data update successfully<h2>';
                } else {
                    echo '<h2>No update data</h2>';
                }
                echo '<br/>';
            }

            if (!empty($patient_parity_table_id)) {

                $d_o_b = $this->input->post('child_birthdate');

                $data_patient_parity_record = array(
                    'pregnancy_type' => $this->input->post('pregnancy_type'),
                    'gender' => $this->input->post('child_gender'),
                    'age_child_at_consent' => $this->input->post('child_age_at_consent'),
                    'date_of_birth' => $d_o_b == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($d_o_b)),
                    'year_of_birth' => $this->input->post('child_birthyear'),
                    'birthweight' => $this->input->post('child_birthweight'),
                    'created_on' => $date,
                    'breastfeeding_duration' => $this->input->post('child_breastfeeding_duration')
                );
                //print_r($data_patient_parity_record);
                //echo '<br/>';


                if ($this->db->affected_rows() > 0) {
                    echo '<h2>Data update successfully<h2>';
                } else {
                    echo '<h2>No update data</h2>';
                }
                echo '<br/>';
            }

            if (!empty($patient_parity_table_id)) {
                $data_patient_parity_record = array(
                    'pregnancy_type' => $this->input->post('pregnancy_type'),
                    'gender' => $this->input->post('child_gender'),
                    'year_of_birth' => $this->input->post('child_birthyear'),
                    'birthweight' => $this->input->post('child_birthweight'),
                    'created_on' => $date,
                    'breastfeeding_duration' => $this->input->post('child_breastfeeding_duration')
                );
                //print_r($data_patient_parity_record);
                //echo '<br/>';

                $this->db->where('patient_parity_table_id', $patient_parity_table_id);
                $this->db->update('patient_parity_record', $data_patient_parity_record);

                if ($this->db->affected_rows() > 0) {
                    echo '<h2>Data update successfully<h2>';
                } else {
                    echo '<h2>No update data</h2>';
                }
                echo '<br/>';
            }

            $patient_infertility_id = $this->input->post('patient_infertility_id');


            if (!empty($patient_infertility_id)) {

                $contraceptive_start_date = $this->input->post('contraceptive_start_date');
                $contraceptive_end_date = $this->input->post('contraceptive_end_date');
                $hrt_start_date = $this->input->post('hrt_start_date');
                $hrt_end_date = $this->input->post('hrt_end_date');

                $data_patient_infertility = array(
                    'infertility_testing_flag' => $this->input->post('infertility_testing_flag'),
                    'infertility_comments' => $this->input->post('infertility_treatment_details'),
                    'infertility_treatment_duration' => $this->input->post('infertility_treatment_duration'),
                    'infertility_comments' => $this->input->post('infertility_treatment_comments'),
                    'contraceptive_pills_flag' => $this->input->post('contraceptive_pills_flag'),
                    //'contraceptive_pills_details' => $this->input->post('contraceptive_pills_details'),
                    'currently_taking_contraceptive_pills_flag' => $this->input->post('currently_taking_contraceptive_pills_flag'),
                    'contraceptive_start_date' => $contraceptive_start_date == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($contraceptive_start_date)),
                    'contraceptive_end_date' => $contraceptive_end_date == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($contraceptive_end_date)),
                    'contraceptive_end_age' => $this->input->post('contraceptive_end_age'),
                    'contraceptive_start_age' => $this->input->post('contraceptive_start_age'),
                    'contraceptive_duration' => $this->input->post('contraceptive_duration'),
                    'hrt_start_age' => $this->input->post('hrt_start_age'),
                    'hrt_end_age' => $this->input->post('hrt_end_age'),
                    'hrt_flag' => $this->input->post('HRT_flag'),
                    //'hrt_details' => $this->input->post('HRT_details'),
                    'currently_using_hrt_flag' => $this->input->post('currently_using_hrt_flag'),
                    'hrt_start_date' => $hrt_start_date == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($hrt_start_date)),
                    'created_on' => $date,
                    'hrt_duration' => $this->input->post('HRT_duration'),
                    'hrt_end_date' => $hrt_end_date == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($hrt_end_date))
                );
                // print_r($data_patient_infertility);
                //echo '<br/>';

                $this->db->where('patient_infertility_id', $patient_infertility_id);
                $this->db->where('patient_studies_id', $patient_studies_id);
                $this->db->update('patient_infertility', $data_patient_infertility);

                if ($this->db->affected_rows() > 0) {
                    echo '<h2>Data update successfully<h2>';
                } else {
                    echo '<h2>No update data</h2>';
                }
                echo '<br/>';
            }

            $patient_gynaecological_surgery_history_id = $this->input->post('patient_gynaecological_surgery_history_id');
            $treatment_name = $this->input->post('gnc_treatment_name');
            $treatment_id = $this->record_model->get_treatment_id($treatment_name);

            if (!empty($patient_gynaecological_surgery_history_id)) {
                $data_patient_gynaecological_surgery_history = array(
                    'had_gnc_surgery_flag' => $this->input->post('had_gnc_surgery_flag'),
                    'surgery_year' => $this->input->post('gnc_surgery_year'),
                    'treatment_id' => $treatment_id,
                    'created_on' => $date,
                    'gnc_treatment_name_other_details' => $this->input->post('gnc_treatment_name_other_details')
                );
                //print_r($data_patient_gynaecological_surgery_history);
                //echo '<br/>';

                $this->db->where('patient_gynaecological_surgery_history_id', $patient_gynaecological_surgery_history_id);
                //$this->db->where('patient_studies_id', $patient_studies_id);
                $this->db->update('patient_gynaecological_surgery_history', $data_patient_gynaecological_surgery_history);

                if ($this->db->affected_rows() > 0) {
                    echo '<h2>Data update successfully<h2>';
                } else {
                    echo '<h2>No update data</h2>';
                }
                echo '<br/>';
            }
        }

        function investigation_insertion() {

            date_default_timezone_set("Asia/Kuala_lumpur");
            $date = date('Y-m-d H:i:s'); //Returns IST 

            $config['upload_path'] = './images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '100000';
            //$config['max_width']  = '1024';
            //$config['max_height']  = '768';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $attach_file_path = 0;
            } else {
                $data = array('upload_data' => $this->upload->data());
                //echo '<h3>Your file was successfully uploaded!</h3>';
                //echo $data['upload_data']['full_path'];
                $attach_file_path = $data['upload_data']['full_path'];
                //echo $attach_file_path;
                // echo '<br/>';
            }


            $studies_name = $this->input->post('studies_name');
            $studies_id = $this->excell_sheets_model->get_studies_id($studies_name);
            $data_keys = array(
                'patient_ic_no' => $this->input->post('IC_no'),
                'studies_id' => $studies_id
            );
            //echo '<pre>';
            //print_r($data_keys);echo '<br/>';
            $patient_studies_id = $this->record_model->get_patient_suudies_id($data_keys);
            //echo $patient_studies_id;echo '<br/>';
            $date_test_ordered = $this->input->post('date_test_ordered');
            $testing_date = $this->input->post('investigation_project_date');
            $report_date = $this->input->post('investigation_report_date');
            $date_client_notified = $this->input->post('investigation_date_notified');

            $data_patient_investigations = array(
                'patient_studies_id' => $patient_studies_id,
                'date_test_ordered' => $date_test_ordered == '' ? '0000-00-00' : date("Y-m-d", strtotime($date_test_ordered)),
                'ordered_by' => $this->input->post('test_ordered_by'),
                'testing_result_notification_flag' => $this->input->post('testing_results_notification_flag'),
                'service_provider' => $this->input->post('investigation_project_name'),
                'testing_batch' => $this->input->post('investigation_project_batch'),
                'testing_date' => $testing_date == '' ? '0000-00-00' : date("Y-m-d", strtotime($testing_date)),
                'gene_tested' => $this->input->post('investigation_gene_tested'),
                'types_of_testing' => $this->input->post('investigation_test_type'),
                'type_of_sample' => $this->input->post('investigation_sample_type'),
                'reasons' => $this->input->post('investigation_test_reason'),
                'new_mutation_flag' => $this->input->post('investigation_new_mutation_flag'),
                'test_result' => $this->input->post('investigation_test_results'),
                'investigation_test_results_other_details' => $this->input->post('investigation_test_results_other_details'),
                'carrier_status' => $this->input->post('investigation_carrier_status'),
                'mutation_nomenclature' => $this->input->post('investigation_mutation_nomenclature'),
                'exon' => $this->input->post('investigation_exon'),
                'mutation_type' => $this->input->post('investigation_mutation_type'),
                'mutation_pathogenicity' => $this->input->post('investigation_mutation_pathogenicity'),
                'report_date' => $report_date == '' ? '0000-00-00' : date("Y-m-d", strtotime($report_date)),
                'date_client_notified' => $date_client_notified == '' ? '0000-00-00' : date("Y-m-d", strtotime($date_client_notified)),
                'is_counselling_flag' => $this->input->post('mutation_is_counselling_flag'),
                'comments' => $this->input->post('investigation_test_comment'),
                'mutation_name' => $this->input->post('investigation_mutation_name'),
                'conformation_attachment' => $this->input->post('investigation_conformation_attachment'),
                'created_on' => $date,
                'conformation_file_url' => @$attach_file_path
            );


            $patient_investigations_id = $this->record_model->insert_patient_mutation_analysis($data_patient_investigations);

            $dynamicFieldsArray = $this->getDynamicFieldsInputsArray("mutation_analysis");

            if ($patient_investigations_id > 0) {

                //$this->session->set_flashdata('msg', 'success');
                //redirect('record/subject_list/');
                echo "<h2>Data Added successfully.</h2>";
            } else {
                echo "<h2>Failed to insert the data</h2>";
            }
            echo '<br/>';
        }

        function investigation_update() {

            date_default_timezone_set("Asia/Kuala_lumpur");
            $date = date('Y-m-d H:i:s'); //Returns IST 

            $config['upload_path'] = './images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '100000';
            //$config['max_width']  = '1024';
            //$config['max_height']  = '768';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $attach_file_path = 0;
            } else {
                $data = array('upload_data' => $this->upload->data());
                //echo '<h3>Your file was successfully uploaded!</h3>';
                //echo $data['upload_data']['full_path'];
                $attach_file_path = $data['upload_data']['full_path'];
                //echo $attach_file_path;
                // echo '<br/>';
            }

            $patient_investigation_id = $this->input->post('patient_investigations_id');
            $patient_studies_id = $this->input->post('patient_studies_id');
            $date_test_ordered = $this->input->post('date_test_ordered');

            $ordered_by = $this->input->post('test_ordered_by');
            $testing_result_notification_flag = $this->input->post('testing_results_notification_flag');
            $service_provider = $this->input->post('investigation_project_name');
            $testing_batch = $this->input->post('investigation_project_batch');
            $testing_date = $this->input->post('investigation_project_date');

            $gene_tested = $this->input->post('investigation_gene_tested');
            $types_of_testing = $this->input->post('investigation_test_type');
            $type_of_sample = $this->input->post('investigation_sample_type');
            $reasons = $this->input->post('investigation_test_reason');
            $new_mutation_flag = $this->input->post('investigation_new_mutation_flag');
            $test_result = $this->input->post('investigation_test_results');
            $investigation_test_results_other_details = $this->input->post('investigation_test_results_other_details');
            $carrier_status = $this->input->post('investigation_carrier_status');
            $mutation_nomenclature = $this->input->post('investigation_mutation_nomenclature');
            $exon = $this->input->post('investigation_exon');
            $mutation_type = $this->input->post('investigation_mutation_type');
            $mutation_pathogenicity = $this->input->post('investigation_mutation_pathogenicity');
            $report_date = $this->input->post('investigation_report_date');
            $date_client_notified = $this->input->post('investigation_date_notified');

            $is_counselling_flag = $this->input->post('mutation_is_counselling_flag');
            $comments = $this->input->post('investigation_test_comment');
            $mutation_name = $this->input->post('investigation_mutation_name');
            $conformation_attachment = $this->input->post('investigation_conformation_attachment');
            
            $testing_result_notification_flag_check = $this->record_model->update_checkbox($testing_result_notification_flag,'testing_result_notification_flag','patient_investigations_id','patient_mutation_analysis');
            $testing_result_notification_flag_uncheck = $this->record_model->update_checkbox_uncheck($patient_studies_id,$testing_result_notification_flag,'patient_investigations_id','testing_result_notification_flag','patient_studies_id','patient_mutation_analysis');
            
            $new_mutation_flag_check = $this->record_model->update_checkbox($new_mutation_flag,'new_mutation_flag','patient_investigations_id','patient_mutation_analysis');
            $new_mutation_flag_uncheck = $this->record_model->update_checkbox_uncheck($patient_studies_id,$new_mutation_flag,'patient_investigations_id','new_mutation_flag','patient_studies_id','patient_mutation_analysis');
            
            $is_counselling_flag_check = $this->record_model->update_checkbox($is_counselling_flag,'is_counselling_flag','patient_investigations_id','patient_mutation_analysis');
            $is_counselling_flag_uncheck = $this->record_model->update_checkbox_uncheck($patient_studies_id,$is_counselling_flag,'patient_investigations_id','is_counselling_flag','patient_studies_id','patient_mutation_analysis');
            
            $conformation_attachment_check = $this->record_model->update_checkbox($conformation_attachment,'conformation_attachment','patient_investigations_id','patient_mutation_analysis');
            $conformation_attachment_uncheck = $this->record_model->update_checkbox_uncheck($patient_studies_id,$conformation_attachment,'patient_investigations_id','conformation_attachment','patient_studies_id','patient_mutation_analysis');


            for ($i = 0; $i < count($patient_investigation_id); $i++) {

                $data_patient_investigations = array(
                    'date_test_ordered' => $date_test_ordered[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($date_test_ordered[$i])),
                    'ordered_by' => $ordered_by[$i],
//                    'testing_result_notification_flag' => $testing_result_notification_flag[$i],
                    'service_provider' => $service_provider[$i],
                    'testing_batch' => $testing_batch[$i],
                    'testing_date' => $testing_date[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($testing_date[$i])),
                    'gene_tested' => $gene_tested[$i],
                    'types_of_testing' => $types_of_testing[$i],
                    'type_of_sample' => $type_of_sample[$i],
                    'reasons' => $reasons[$i],
//                    'new_mutation_flag' => $new_mutation_flag[$i],
                    'test_result' => $test_result[$i],
                    'investigation_test_results_other_details' => $investigation_test_results_other_details[$i],
                    'carrier_status' => $carrier_status[$i],
                    'mutation_nomenclature' => $mutation_nomenclature[$i],
                    'exon' => $exon[$i],
                    'mutation_type' => $mutation_type[$i],
                    'mutation_pathogenicity' => $mutation_pathogenicity[$i],
                    'report_date' => $report_date[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($report_date[$i])),
                    'date_client_notified' => $date_client_notified[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($date_client_notified[$i])),
//                    'is_counselling_flag' => $is_counselling_flag[$i],
                    'comments' => $comments[$i],
                    'mutation_name' => $mutation_name[$i],
//                    'conformation_attachment' => $conformation_attachment[$i],
                    'created_on' => $date,
                    'conformation_file_url' => @$attach_file_path[$i]
                );

                //print_r($data_patient_investigations);exit;

                $this->db->where('patient_investigations_id', $patient_investigation_id[$i]);
                $this->db->where('patient_studies_id', $patient_studies_id);
                $this->db->update('patient_mutation_analysis', $data_patient_investigations);


                if ($this->db->affected_rows() > 0) {
                    echo '<h2>Data for id ' . $patient_investigation_id[$i] . ' update successfully<h2>';
                } else {
                    echo '<h2>No update data for id ' . $patient_investigation_id[$i] . '</h2>';
                }
                echo '<br/>';
            }
        }

        function surveillance_insertion() {

            date_default_timezone_set("Asia/Kuala_lumpur");
            $date = date('Y-m-d H:i:s'); //Returns IST 

            $studies_name = $this->input->post('studies_name');
            $studies_id = $this->excell_sheets_model->get_studies_id($studies_name);
            $data_keys = array(
                'patient_ic_no' => $this->input->post('IC_no'),
                'studies_id' => $studies_id
            );
            //echo '<pre>';
            //print_r($data_keys);echo '<br/>';
            $patient_studies_id = $this->record_model->get_patient_suudies_id($data_keys);
            //echo $patient_studies_id;echo '<br/>';

            $data_patient_surveillance = array(
                'patient_studies_id' => $patient_studies_id,
                'recruitment_center' => $this->input->post('surveillance_recruitment_center'),
                'type' => $this->input->post('surveillance_type'),
                'first_consultation_date' => date('Y-m-d', strtotime($this->input->post('surveillance_first_consultation_date'))),
                'first_consultation_place' => $this->input->post('surveillance_first_consultation_place'),
                'surveillance_interval' => $this->input->post('surveillance_interval'),
                'diagnosis' => $this->input->post('surveillance_diagnosis'),
                'due_date' => date('Y-m-d', strtotime($this->input->post('surveillance_due_date'))),
                'reminder_sent_date' => date('Y-m-d', strtotime($this->input->post('surveillance_reminder_sent_date'))),
                'surveillance_done_date' => date('Y-m-d', strtotime($this->input->post('surveillance_done_date'))),
                'reminded_by' => $this->input->post('surveillance_reminded_by'),
                'timing' => $this->input->post('surveillance_timing'),
                'symptoms' => $this->input->post('surveillance_symptoms'),
                'doctor_name' => $this->input->post('surveillance_doctor_name'),
                'surveillance_done_place' => $this->input->post('surveillance_place'),
                'outcome' => $this->input->post('surveillance_outcome'),
                'created_on' => $date,
                'comments' => $this->input->post('surveillance_comments')
            );

            // echo '<pre>';
            // print_r($data_patient_surveillance);echo '<br/>';
            //array_push($data, $this->input->post('firstname'));
            $patient_surveillance_id = $this->record_model->insert_patient_surveillance($data_patient_surveillance);
            if ($patient_surveillance_id > 0) {
                echo "<h2>Data Added successfully at patient_surveillance</h2>";
            } else {
                echo "<h2>Failed to insert patient_surveillance</h2>";
            }
            echo '<br/>';
        }

        function patient_diagnosis_treatment_record_insertion() {

            date_default_timezone_set("Asia/Kuala_lumpur");
            $date = date('Y-m-d H:i:s'); //Returns IST 

            $studies_name = $this->input->post('studies_name');
            $studies_id = $this->excell_sheets_model->get_studies_id($studies_name);
            $data_keys = array(
                'patient_ic_no' => $this->input->post('IC_no'),
                'studies_id' => $studies_id
            );
            //echo '<pre>';
            // print_r($data_keys);echo '<br/>';exit;
            $patient_studies_id = $this->record_model->get_patient_suudies_id($data_keys);
            //echo $patient_studies_id;echo '<br/>';
//        print_r($patient_studies_id);exit;

            $patient_breast_cancer_site = $this->input->post('cancer_site'); //by this we will get treatment_id
            $breast_cancer_site_id = $a = $this->record_model->get_cancer_site_id($patient_breast_cancer_site);

            $breast_diagnosis_date = $this->input->post('date_of_diagnosis');

            $data_patient_breast_diagnosis = array(
                'patient_studies_id' => $patient_studies_id,
                'cancer_id' => 1,
                'cancer_site_id' => $breast_cancer_site_id,
                'cancer_invasive_type' => $this->input->post('cancer_invasive_type'),
                'is_primary' => $this->input->post('primary_diagnosis'),
                'date_of_diagnosis' => $breast_diagnosis_date == '' ? '0000-00-00' : date("Y-m-d", strtotime($breast_diagnosis_date)),
                'age_of_diagnosis' => $this->input->post('age_of_diagnosis'),
                'diagnosis_center' => $this->input->post('cancer_diagnosis_center'),
                'doctor_name' => $this->input->post('cancer_doctor_name'),
                'detected_by' => $this->input->post('detected_by'),
                //'detected_by' => $this->input->post('detected_by_other_details'),
                'bilateral_flag' => $this->input->post('cancer_is_bilateral'),
                'created_on' => $date,
                'recurrence_flag' => $this->input->post('cancer_is_recurrent')
            );
            //$patient_breast_diagnosis_id = $this->db->insert('patient_cancer', $data_patient_breast_diagnosis);


            $patient_breast_diagnosis_id = $this->record_model->insert_patient_cancer($data_patient_breast_diagnosis);

            $add_breast_diagnosis = $this->getDynamicFieldsInputsArray("breast_diagnosis");

            if ($patient_breast_diagnosis_id > 0) {
                echo "<h2>Data Added successfully at patient_cancer(breast) table</h2>";
            } else {
                echo "<h2>Failed to insert at patient_cancer(breast) table</h2>";
            }
            echo '<br/>';

            $breast_report_date = $this->input->post('breast_pathology_path_report_date');

            $data_patient_breast_pathology = array(
                'cancer_id' => 1,
                'patient_cancer_id' => $patient_breast_diagnosis_id,
                'tissue_site' => $this->input->post('breast_pathology_tissue_site'),
                'type_of_report' => $this->input->post('breast_pathology_path_report_type'),
                'date_of_report' => $breast_report_date == '' ? '0000-00-00' : date("Y-m-d", strtotime($breast_report_date)),
                'pathology_lab' => $this->input->post('breast_pathology_lab'),
                'name_of_doctor' => $this->input->post('breast_pathology_doctor'),
                'morphology' => $this->input->post('breast_pathology_morphology'),
                't_staging' => $this->input->post('breast_pathology_tissue_tumour_stage'),
                'n_staging' => $this->input->post('breast_pathology_node_stage'),
                'm_staging' => $this->input->post('breast_pathology_metastasis_stage'),
                'tumour_stage' => $this->input->post('breast_pathology_tumour_stage'),
                'tumour_grade' => $this->input->post('breast_pathology_tumour_grade'),
                'total_lymph_nodes' => $this->input->post('breast_pathology_total_lymph_nodes'),
                'tumour_size' => $this->input->post('breast_pathology_tumour_size'),
                'created_on' => $date,
                'comments' => $this->input->post('breast_pathology_tissue_path_comments')
            );

            //$patient_breast_pathology_id = $this->db->insert('patient_pathology', $data_patient_breast_pathology);
            $patient_breast_pathology_id = $this->record_model->insert_patient_pathology($data_patient_breast_pathology);

            $add_breast_pathology = $this->getDynamicFieldsInputsArray("breast_pathology", $patient_breast_diagnosis_id);

            if ($patient_breast_pathology_id > 0) {
                echo "<h2>Data Added successfully at patient_pathology(breast) table</h2>";
            } else {
                echo "<h2>Failed to insert at patient_pathology(breast) table</h2>";
            }
            echo '<br/>';

            $data_patient_breast_pathology_staining = array(
                'patient_pathology_id' => $patient_breast_pathology_id,
                'ER_status' => $this->input->post('breast_pathology_ER_status'),
                'PR_status' => $this->input->post('breast_pathology_PR_status'),
                'created_on' => $date,
                'HER2_status' => $this->input->post('breast_pathology_HER2_status'),
            );

            $patient_breast_pathology_staining_id = $this->db->insert('patient_pathology_staining_status', $data_patient_breast_pathology_staining);

            $add_breast_status = $this->getDynamicFieldsInputsArray("breast_status", $patient_breast_pathology_id);

            if ($patient_breast_pathology_staining_id > 0) {
                echo "<h2>Data Added successfully at patient_pathology_staining_status(breast) table</h2>";
            } else {
                echo "<h2>Failed to insert at patient_pathology_staining_status(breast) table</h2>";
            }
            echo '<br/>';

            $patient_cancer_treatment_name = $this->input->post('patient_cancer_treatment_name'); //by this we will get treatment_id
            $treatment_id = $this->record_model->get_treatment_id($patient_cancer_treatment_name);
            $breast_t_start = $this->input->post('treatment_start_date');
            $breast_t_end = $this->input->post('treatment_end_date');

            $data_patient_breast_treatment = array(
                'patient_cancer_id' => $patient_breast_diagnosis_id,
                'treatment_id' => $treatment_id,
                'treatment_start_date' => $breast_t_start == '' ? '0000-00-00' : date("Y-m-d", strtotime($breast_t_start)),
                'treatment_end_date' => $breast_t_end == '' ? '0000-00-00' : date("Y-m-d", strtotime($breast_t_end)),
                'treatment_durations' => $this->input->post('treatment_duration'),
                'treatment_details' => $this->input->post('treatment_details'),
                'treatment_dose' => $this->input->post('treatment_dose'),
                'treatment_cycle' => $this->input->post('treatment_cycle'),
                'treatment_frequency' => $this->input->post('treatment_frequency'),
                'treatment_visidual_desease' => $this->input->post('treatment_visidual_desease'),
                'treatment_primary_outcome' => $this->input->post('treatment_primary_therapy_outcome'),
                'created_on' => $date,
                'comments' => $this->input->post('breast_cancer_treatment_comments')
            );

            $patient_breast_treatment_id = $this->db->insert('patient_cancer_treatment', $data_patient_breast_treatment);

            $add_breast_treatment = $this->getDynamicFieldsInputsArray("breast_treatment", $patient_breast_diagnosis_id);

//            $patient_COGS_study_id = $this->record_model->insert_patient_cogs_studies($data_patient_COGS_study);


            if ($patient_breast_treatment_id > 0) {
                echo "<h2>Data Added successfully at patient_treatment(breast) table</h2>";
            } else {
                echo "<h2>Failed to insert at patient_treatment(breast) table</h2>";
            }
            echo '<br/>';

            $patient_ovary_cancer_site = $this->input->post('ovary_cancer_site'); //by this we will get treatment_id
            $ovary_cancer_site_id = $this->record_model->get_cancer_site_id($patient_ovary_cancer_site);
            $ovary_diagnosis_date = $this->input->post('ovary_date_of_diagnosis');

            $data_patient_ovary_diagnosis = array(
                'patient_studies_id' => $patient_studies_id,
                'cancer_id' => 2,
                'cancer_site_id' => $ovary_cancer_site_id,
                'cancer_invasive_type' => $this->input->post('ovary_cancer_invasive_type'),
                'is_primary' => $this->input->post('ovary_primary_diagnosis'),
                'date_of_diagnosis' => $ovary_diagnosis_date == '' ? '0000-00-00' : date("Y-m-d", strtotime($ovary_diagnosis_date)),
                'age_of_diagnosis' => $this->input->post('ovary_age_of_diagnosis'),
                'diagnosis_center' => $this->input->post('ovary_cancer_diagnosis_center'),
                'doctor_name' => $this->input->post('ovary_cancer_doctor_name'),
                'detected_by' => $this->input->post('ovary_detected_by'),
                //'detected_by_other_details' => $this->input->post('ovary_detected_by_other_details'),
                'bilateral_flag' => $this->input->post('ovary_cancer_is_bilateral'),
                'created_on' => $date,
                'recurrence_flag' => $this->input->post('ovary_cancer_is_recurrent')
            );

            $patient_ovary_diagnosis_id = $this->record_model->insert_patient_cancer($data_patient_ovary_diagnosis);

            $add_ovary_diagnosis = $this->getDynamicFieldsInputsArray("ovary_diagnosis");

            if ($patient_ovary_diagnosis_id > 0) {
                echo "<h2>Data Added successfully at ovary diagnosis table</h2>";
            } else {
                echo "<h2>Failed to insert at ovary diagnosis table</h2>";
            }
            echo '<br/>';

            $ovary_report_date = $this->input->post('ovary_pathology_path_report_date');

            $data_patient_ovary_pathology = array(
                'cancer_id' => 2,
                'patient_cancer_id' => $patient_ovary_diagnosis_id,
                'tissue_site' => $this->input->post('ovary_pathology_tissue_site'),
                'type_of_report' => $this->input->post('ovary_pathology_path_report_type'),
                'date_of_report' => $ovary_report_date == '' ? '0000-00-00' : date("Y-m-d", strtotime($ovary_report_date)),
                'pathology_lab' => $this->input->post('ovary_pathology_lab'),
                'name_of_doctor' => $this->input->post('ovary_pathology_doctor'),
                'morphology' => $this->input->post('ovary_pathology_morphology'),
                'stage_classifications' => $this->input->post('ovary_stage_classification'),
                'tumour_stage' => $this->input->post('ovary_pathology_tumour_stage'),
                'tumour_grade' => $this->input->post('ovary_pathology_tumour_grade'),
                'tumour_size' => $this->input->post('ovary_pathology_tumour_size'),
                'no_of_report' => $this->input->post('ovary_pathology_report_no'),
                'tumor_subtype' => $this->input->post('ovary_tumor_subtypes'),
                'tumor_behaviour' => $this->input->post('ovary_tumor_behavior'),
                'tumor_differentiation' => $this->input->post('ovary_tumor_differentiation'),
                'created_on' => $date,
                'comments' => $this->input->post('ovary_pathology_tissue_path_comments')
            );

            $patient_ovary_pathology_id = $this->db->insert('patient_pathology', $data_patient_ovary_pathology);

            $add_ovary_pathology = $this->getDynamicFieldsInputsArray("ovary_pathology", $patient_ovary_diagnosis_id);

//            $patient_COGS_study_id = $this->record_model->insert_patient_cogs_studies($data_patient_COGS_study);

            if ($patient_ovary_pathology_id > 0) {
                echo "<h2>Data Added successfully at patient_pathology table</h2>";
            } else {
                echo "<h2>Failed to insert at patient_pathology table</h2>";
            }
            echo '<br/>';

            $ovary_patient_cancer_treatment_name = $this->input->post('ovary_patient_cancer_treatment_name'); //by this we will get treatment_id
            $ovary_treatment_id = $this->record_model->get_treatment_id($ovary_patient_cancer_treatment_name);
            $ovary_t_start = $this->input->post('ovary_treatment_start_date');
            $ovary_t_end = $this->input->post('ovary_treatment_end_date');

            $data_patient_ovary_treatment = array(
                'patient_cancer_id' => $patient_ovary_diagnosis_id,
                'treatment_id' => $ovary_treatment_id,
                'treatment_start_date' => $ovary_t_start == '' ? '0000-00-00' : date("Y-m-d", strtotime($ovary_t_start)),
                'treatment_end_date' => $ovary_t_end == '' ? '0000-00-00' : date("Y-m-d", strtotime($ovary_t_end)),
                'treatment_durations' => $this->input->post('ovary_treatment_duration'),
                'treatment_details' => $this->input->post('ovary_treatment_details'),
                'treatment_dose' => $this->input->post('ovary_treatment_drug_dose'),
                'treatment_cycle' => $this->input->post('ovary_treatment_cycle'),
                'treatment_frequency' => $this->input->post('ovary_treatment_frequency'),
                'treatment_visidual_desease' => $this->input->post('ovary_treatment_visidual_desease'),
                'treatment_primary_outcome' => $this->input->post('oavry_treatment_primary_therapy_outcome'),
                'treatment_cal125_pretreatment' => $this->input->post('ovary_cal125_pretreatment'),
                'treatment_cal125_posttreatment' => $this->input->post('ovary_cal125_posttreatment'),
                'created_on' => $date,
                'comments' => $this->input->post('ovary_cancer_treatment_comments')
            );

            $patient_ovary_treatment_id = $this->db->insert('patient_cancer_treatment', $data_patient_ovary_treatment);

            $add_ovary_treatment = $this->getDynamicFieldsInputsArray("ovary_treatment", $patient_ovary_diagnosis_id);

            if ($patient_ovary_treatment_id > 0) {
                echo "<h2>Data Added successfully at patient_cancer_treatment(ovary) table</h2>";
            } else {
                echo "<h2>Failed to insert at patient_cancer_treatment(ovary) table</h2>";
            }
            echo '<br/>';

            $patient_other_cancer_site = $this->input->post('other_cancer_site'); //by this we will get treatment_id
            $other_cancer_site_id = $this->record_model->get_cancer_site_id($patient_other_cancer_site);

            $patient_other_cancer_name = $this->input->post('other_cancer_type');
            $other_cancer_id = $this->record_model->get_cancer_id($patient_other_cancer_name);
            $other_diagnosis_date = $this->input->post('other_date_of_diagnosis');

            $data_patient_other_cancer_diagnosis = array(
                'patient_studies_id' => $patient_studies_id,
                'cancer_id' => $other_cancer_id,
                'cancer_site_id' => $other_cancer_site_id,
                'date_of_diagnosis' => $other_diagnosis_date == '' ? '0000-00-00' : date("Y-m-d", strtotime($other_diagnosis_date)),
                'age_of_diagnosis' => $this->input->post('other_age_of_diagnosis'),
                'diagnosis_center' => $this->input->post('other_cancer_diagnosis_center'),
                'doctor_name' => $this->input->post('other_cancer_doctor_name'),
                'created_on' => $date,
            );

            $patient_other_diagnosis_id = $this->record_model->insert_patient_cancer($data_patient_other_cancer_diagnosis);

            $add_other_cancer_diagnosis = $this->getDynamicFieldsInputsArray("other_diagnosis");

            if ($patient_other_diagnosis_id > 0) {
                echo "<h2>Data Added successfully at patient_cancer table</h2>";
            } else {
                echo "<h2>Failed to insert at patient_cancer table</h2>";
            }
            echo '<br/>';

            $others_report_date = $this->input->post('other_pathology_path_report_date');

            $data_patient_other_cancer_pathology = array(
                'patient_cancer_id' => $patient_other_diagnosis_id,
                'cancer_id' => $other_cancer_id,
                'tissue_site' => $this->input->post('other_pathology_tissue_site'),
                'type_of_report' => $this->input->post('other_pathology_path_report_type'),
                'date_of_report' => $others_report_date == '' ? '0000-00-00' : date("Y-m-d", strtotime($others_report_date)),
                'pathology_lab' => $this->input->post('other_pathology_lab'),
                'name_of_doctor' => $this->input->post('other_pathology_doctor'),
                'comments' => $this->input->post('other_pathology_tissue_path_comments'),
                'created_on' => $date,
            );


            $patient_other_cancer_pathology_id = $this->db->insert('patient_pathology', $data_patient_other_cancer_pathology);

            $add_other_cancer_pathology = $this->getDynamicFieldsInputsArray("other_pathology", $patient_other_diagnosis_id);

//            $patient_COGS_study_id = $this->record_model->insert_patient_cogs_studies($data_patient_COGS_study);

            if ($patient_other_cancer_pathology_id > 0) {
                echo "<h2>Data Added successfully at patient_pathology table</h2>";
            } else {
                echo "<h2>Failed to insert at patient_pathology table</h2>";
            }
            echo '<br/>';

            $patient_other_cancer_treatment_name = $this->input->post('other_patient_cancer_treatment_name'); //by this we will get treatment_id
            $other_cancer_treatment_id = $this->record_model->get_treatment_id($patient_other_cancer_treatment_name);
            $others_t_start = $this->input->post('other_treatment_start_date');
            $others_t_end = $this->input->post('other_treatment_end_date');

            $data_patient_other_cancer_treatment = array(
                'patient_cancer_id' => $patient_other_diagnosis_id,
                'treatment_id' => $other_cancer_treatment_id,
                'treatment_start_date' => $others_t_start == '' ? '0000-00-00' : date("Y-m-d", strtotime($others_t_start)),
                'treatment_end_date' => $others_t_end == '' ? '0000-00-00' : date("Y-m-d", strtotime($others_t_end)),
                'treatment_durations' => $this->input->post('other_treatment_duration'),
                'treatment_details' => $this->input->post('other_treatment_details'),
                'treatment_dose' => $this->input->post('other_treatment_drug_dose'),
                'treatment_cycle' => $this->input->post('other_treatment_cycle'),
                'treatment_frequency' => $this->input->post('other_treatment_frequency'),
                'treatment_visidual_desease' => $this->input->post('other_treatment_visidual_desease'),
                'treatment_primary_outcome' => $this->input->post('other_treatment_primary_therapy_outcome'),
                'created_on' => $date,
                'comments' => $this->input->post('other_cancer_treatment_comments')
            );

            $patient_other_cancer_treatment_id = $this->db->insert('patient_cancer_treatment', $data_patient_other_cancer_treatment);

            $add_other_cancer_treatment = $this->getDynamicFieldsInputsArray("other_treatment", $patient_other_diagnosis_id);

//            $patient_COGS_study_id = $this->record_model->insert_patient_cogs_studies($data_patient_COGS_study);

            if ($patient_other_cancer_treatment_id > 0) {
                echo "<h2>Data Added successfully at patient_cancer_treatment(Other) table</h2>";
            } else {
                echo "<h2>Failed to insert at patient_cancer_treatment(Other) table</h2>";
            }
            echo '<br/>';

            $patient_diagnosis = $this->input->post('diagnosis_name'); //by this we will get treatment_id
            $other_diagnosis_id = $this->record_model->get_diagnosis_id($patient_diagnosis);
            $other_diseases_diagnosis_date = $this->input->post('year_of_diagnosis');

            $data_patient_other_diseases = array(
                'patient_studies_id' => $patient_studies_id,
                'diagnosis_id' => $other_diagnosis_id,
                'date_of_diagnosis' => $other_diseases_diagnosis_date == '' ? '0000-00-00' : date("Y-m-d", strtotime($other_diseases_diagnosis_date)),
                'diagnosis_age' => $this->input->post('diagnosis_age'),
                'diagnosis_center' => $this->input->post('diagnosis_center'),
                'doctor_name' => $this->input->post('diagnosis_doctor_name'),
                'created_on' => $date,
                'on_medication_flag' => $this->input->post('is_on_medication_flag')
            );

            // echo '<pre>';
            // print_r($data_patient_surveillance);echo '<br/>';
            $patient_other_diseases_id = $this->record_model->insert_patient_other_disease($data_patient_other_diseases);

            $add_other_disease = $this->getDynamicFieldsInputsArray("other_disease");

            if ($patient_other_diseases_id > 0) {
                echo "<h2>Data Added successfully at patient_other_disease</h2>";
            } else {
                echo "<h2>Failed to insert patient_other_disease</h2>";
            }
            echo '<br/>';

            $medication_start = $this->input->post('medication_start_date');
            $medication_end = $this->input->post('medication_end_date');

            $data_patient_other_diseases_medication = array(
                'patient_other_disease_id' => $patient_other_diseases_id,
                'medication_type' => $this->input->post('medication_type_name'),
                'start_date' => $medication_start == '' ? '0000-00-00' : date("Y-m-d", strtotime($medication_start)),
                'end_date' => $medication_end == '' ? '0000-00-00' : date("Y-m-d", strtotime($medication_end)),
                'duration' => $this->input->post('medication_duration'),
                'created_on' => $date,
                'comments' => $this->input->post('medication_comments')
            );

            // echo '<pre>';
            // print_r($data_patient_surveillance);echo '<br/>';
            //array_push($data, $this->input->post('firstname'));
            $patient_other_diseases_medication_id = $this->db->insert('patient_other_disease_medication', $data_patient_other_diseases_medication);

            $add_medication = $this->getDynamicFieldsInputsArray("medication", $patient_other_diseases_id);

            if ($patient_other_diseases_medication_id > 0) {
                echo "<h2>Data Added successfully at patient_other_disease_medication</h2>";
            } else {
                echo "<h2>Failed to insert patient_other_disease_medication</h2>";
            }
            echo '<br/>';
        }

        function patient_diagnosis_treatment_record_update() {

            date_default_timezone_set("Asia/Kuala_lumpur");
            $date = date('Y-m-d H:i:s'); //Returns IST 

            $patient_studies_id = $this->input->post('patient_studies_id');
            $patient_cancer_id = $this->input->post('patient_cancer_id');
            $patient_breast_cancer_site = $this->input->post('cancer_site'); //by this we will get treatment_id
            $cancer_invasive_type = $this->input->post('cancer_invasive_type');
            $is_primary = $this->input->post('primary_diagnosis');
            $date_of_diagnosis = $this->input->post('date_of_diagnosis');
            $age_of_diagnosis = $this->input->post('age_of_diagnosis');
            $diagnosis_center = $this->input->post('cancer_diagnosis_center');
            $doctor_name = $this->input->post('cancer_doctor_name');
            $detected_by = $this->input->post('detected_by');
            $bilateral_flag = $this->input->post('cancer_is_bilateral');
            $recurrence_flag = $this->input->post('cancer_is_recurrent');
            
            $is_primary_check = $this->record_model->update_checkbox($is_primary,'is_primary','patient_cancer_id','patient_cancer');
            $is_primary_uncheck = $this->record_model->update_checkbox_uncheck($patient_studies_id,$is_primary,'patient_cancer_id','is_primary','patient_studies_id','patient_cancer');
            
            $bilateral_flag_check = $this->record_model->update_checkbox($bilateral_flag,'bilateral_flag','patient_cancer_id','patient_cancer');
            $bilateral_flag_uncheck = $this->record_model->update_checkbox_uncheck($patient_studies_id,$bilateral_flag,'patient_cancer_id','bilateral_flag','patient_studies_id','patient_cancer');
            
            $recurrence_flag_check = $this->record_model->update_checkbox($recurrence_flag,'recurrence_flag','patient_cancer_id','patient_cancer');
            $recurrence_flag_uncheck = $this->record_model->update_checkbox_uncheck($patient_studies_id,$recurrence_flag,'patient_cancer_id','recurrence_flag','patient_studies_id','patient_cancer');
        

            if (!empty($patient_cancer_id)) {

                for ($i = 0; $i < count($patient_cancer_id); $i++) {

                    $breast_cancer_site_id = $this->record_model->get_cancer_site_id($patient_breast_cancer_site[$i]);

                    $data_patient_breast_diagnosis = array(
                        'cancer_site_id' => $breast_cancer_site_id,
                        'cancer_invasive_type' => $cancer_invasive_type[$i],
//                        'is_primary' => $is_primary[$i],
                        'date_of_diagnosis' => $date_of_diagnosis[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($date_of_diagnosis[$i])),
                        'age_of_diagnosis' => $age_of_diagnosis[$i],
                        'diagnosis_center' => $diagnosis_center[$i],
                        'doctor_name' => $doctor_name[$i],
                        'detected_by' => $detected_by[$i],
                        //'detected_by' => $this->input->post('detected_by_other_details'),
//                        'bilateral_flag' => $bilateral_flag[$i],
                        'modified_on' => $date,
//                        'recurrence_flag' => $recurrence_flag[$i]
                    );
                    //$patient_breast_diagnosis_id = $this->db->insert('patient_cancer', $data_patient_breast_diagnosis);

                        $this->db->where('cancer_id', 1);
                        $this->db->where('patient_studies_id', $patient_studies_id);
                        $this->db->where('patient_cancer_id', $patient_cancer_id[$i]);
                        $this->db->update('patient_cancer', $data_patient_breast_diagnosis);

                        if ($this->db->affected_rows() > 0) {
                            echo '<h2>Data for id ' . $i . ' update successfully<h2>';
                        } else {
                            echo '<h2>No update data for id ' . $i . '</h2>';
                        }
                        echo '<br/>';
                    }
                }

                $patient_pathology_id = $this->input->post('patient_pathology_id');
                $tissue_site = $this->input->post('breast_pathology_tissue_site');
                $type_of_report = $this->input->post('breast_pathology_path_report_type');
                $date_of_report = $this->input->post('breast_pathology_path_report_date');

                $pathology_lab = $this->input->post('breast_pathology_lab');
                $name_of_doctor = $this->input->post('breast_pathology_doctor');
                $morphology = $this->input->post('breast_pathology_morphology');
                $t_staging = $this->input->post('breast_pathology_tissue_tumour_stage');
                $n_staging = $this->input->post('breast_pathology_node_stage');
                $m_staging = $this->input->post('breast_pathology_metastasis_stage');
                $tumour_stage = $this->input->post('breast_pathology_tumour_stage');
                $tumour_grade = $this->input->post('breast_pathology_tumour_grade');
                $total_lymph_nodes = $this->input->post('breast_pathology_total_lymph_nodes');
                $tumour_size = $this->input->post('breast_pathology_tumour_size');
                $pathology_comments = $this->input->post('breast_pathology_tissue_path_comments');

                if (!empty($patient_pathology_id)) {
                    for ($i = 0; $i < count($patient_pathology_id); $i++) {
                        $data_patient_breast_pathology = array(
                            'tissue_site' => $tissue_site[$i],
                            'type_of_report' => $type_of_report[$i],
                            'date_of_report' => $date_of_report[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($date_of_report[$i])),
                            'pathology_lab' => $pathology_lab[$i],
                            'name_of_doctor' => $name_of_doctor[$i],
                            'morphology' => $morphology[$i],
                            't_staging' => $t_staging[$i],
                            'n_staging' => $n_staging[$i],
                            'm_staging' => $m_staging[$i],
                            'tumour_stage' => $tumour_stage[$i],
                            'tumour_grade' => $tumour_grade[$i],
                            'total_lymph_nodes' => $total_lymph_nodes[$i],
                            'tumour_size' => $tumour_size[$i],
                            'modified_on' => $date[$i],
                            'comments' => $pathology_comments[$i]
                        );

                        //$this->db->where('patient_cancer_id', $patient_cancer_id[$i]);
                        $this->db->where('patient_pathology_id', $patient_pathology_id[$i]);
                        $this->db->update('patient_pathology', $data_patient_breast_pathology);

                        if ($this->db->affected_rows() > 0) {
                            echo '<h2>Data for id ' . $i . ' update successfully<h2>';
                        } else {
                            echo '<h2>No update data for id ' . $i . '</h2>';
                        }
                        echo '<br/>';
                    }
                }


                //$patient_breast_pathology_staining_status_id = $this->input->post('patient_pathology_staining_status_id');
                $patient_breast_pathology_staining_status_id = $this->input->post('patient_pathology_staining_status_id');
                $ER_status = $this->input->post('breast_pathology_ER_status');
                $PR_status = $this->input->post('breast_pathology_PR_status');
                $HER2_status = $this->input->post('breast_pathology_HER2_status');

                if (!empty($patient_breast_pathology_staining_status_id)) {
                    for ($i = 0; $i < count($patient_breast_pathology_staining_status_id); $i++) {
                        $data_patient_breast_pathology_staining = array(
                            'ER_status' => $ER_status[$i],
                            'PR_status' => $PR_status[$i],
                            'modified_on' => $date[$i],
                            'HER2_status' => $HER2_status[$i],
                        );

                        $this->db->where('patient_pathology_staining_status_id', $patient_breast_pathology_staining_status_id[$i]);
                        //$this->db->where('patient_pathology_id', $patient_pathology_id);
                        $this->db->update('patient_pathology_staining_status', $data_patient_breast_pathology_staining);

                        if ($this->db->affected_rows() > 0) {
                            echo '<h2>Data for id ' . $i . ' update successfully<h2>';
                        } else {
                            echo '<h2>No update data for id ' . $i . '</h2>';
                        }
                        echo '<br/>';
                    }
                }

                $treatment_start_date = $this->input->post('treatment_start_date');
                $treatment_end_date = $this->input->post('treatment_end_date');

                $treatment_durations = $this->input->post('treatment_duration');
                $treatment_details = $this->input->post('treatment_details');
                $treatment_dose = $this->input->post('treatment_dose');
                $treatment_cycle = $this->input->post('treatment_cycle');
                $treatment_frequency = $this->input->post('treatment_frequency');
                $treatment_visidual_desease = $this->input->post('treatment_visidual_desease');
                $treatment_primary_outcome = $this->input->post('treatment_primary_therapy_outcome');
                $treatment_comments = $this->input->post('breast_cancer_treatment_comments');

                $patient_cancer_treatment_id = $this->input->post('patient_cancer_treatment_id');
                $patient_cancer_treatment_name = $this->input->post('patient_cancer_treatment_name'); //by this we will get treatment_id


                if (!empty($patient_cancer_treatment_id)) {
                    for ($i = 0; $i < count($patient_cancer_treatment_id); $i++) {

                        $treatment_id = $this->record_model->get_treatment_id($patient_cancer_treatment_name[$i]);

                        $data_patient_breast_treatment = array(
                            'treatment_id' => $treatment_id,
                            'treatment_start_date' => $treatment_start_date[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($treatment_start_date[$i])),
                            'treatment_end_date' => $treatment_end_date[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($treatment_end_date[$i])),
                            'treatment_durations' => $treatment_durations[$i],
                            'treatment_details' => $treatment_details[$i],
                            'treatment_dose' => $treatment_dose[$i],
                            'treatment_cycle' => $treatment_cycle[$i],
                            'treatment_frequency' => $treatment_frequency[$i],
                            'treatment_visidual_desease' => $treatment_visidual_desease[$i],
                            'treatment_primary_outcome' => $treatment_primary_outcome[$i],
                            'created_on' => $date,
                            'comments' => $treatment_comments[$i]
                        );


                        //$this->db->where('patient_investigations_id', $patient_investigation_id[$i]);
                        $this->db->where('patient_cancer_treatment_id', $patient_cancer_treatment_id[$i]);
                        $this->db->update('patient_cancer_treatment', $data_patient_breast_treatment);

                        if ($this->db->affected_rows() > 0) {
                            echo '<h2>Data for id ' . $i . ' update successfully<h2>';
                        } else {
                            echo '<h2>No update data for id ' . $i . '</h2>';
                        }
                        echo '<br/>';
                    }
                }

                $ovary_patient_cancer_id = $this->input->post('ovary_patient_cancer_id');
                $patient_ovary_cancer_site = $this->input->post('ovary_cancer_site'); //by this we will get treatment_id
                $ovary_cancer_invasive_type = $this->input->post('ovary_cancer_invasive_type');
                $ovary_primary_diagnosis = $this->input->post('ovary_primary_diagnosis');
                $ovary_date_of_diagnosis = $this->input->post('ovary_date_of_diagnosis');

                $ovary_age_of_diagnosis = $this->input->post('ovary_age_of_diagnosis');
                $ovary_cancer_diagnosis_center = $this->input->post('ovary_cancer_diagnosis_center');
                $ovary_cancer_doctor_name = $this->input->post('ovary_cancer_doctor_name');
                $ovary_detected_by = $this->input->post('ovary_detected_by');
                $ovary_cancer_is_bilateral = $this->input->post('ovary_cancer_is_bilateral');
                $ovary_cancer_is_recurrent = $this->input->post('ovary_cancer_is_recurrent');
                
                $ovary_primary_diagnosis_check = $this->record_model->update_checkbox($ovary_primary_diagnosis,'is_primary','patient_cancer_id','patient_cancer');
                $ovary_primary_diagnosis_uncheck = $this->record_model->update_checkbox_uncheck($patient_studies_id,$ovary_primary_diagnosis,'patient_cancer_id','is_primary','patient_studies_id','patient_cancer');
            
                $ovary_bilateral_flag_check = $this->record_model->update_checkbox($ovary_cancer_is_bilateral,'bilateral_flag','patient_cancer_id','patient_cancer');
                $ovary_bilateral_flag_uncheck = $this->record_model->update_checkbox_uncheck($patient_studies_id,$ovary_cancer_is_bilateral,'patient_cancer_id','bilateral_flag','patient_studies_id','patient_cancer');
            
                $ovary_recurrence_flag_check = $this->record_model->update_checkbox($ovary_cancer_is_recurrent,'recurrence_flag','patient_cancer_id','patient_cancer');
                $ovary_recurrence_flag_uncheck = $this->record_model->update_checkbox_uncheck($patient_studies_id,$ovary_cancer_is_recurrent,'patient_cancer_id','recurrence_flag','patient_studies_id','patient_cancer');


                if (!empty($ovary_patient_cancer_id)) {
                    for ($i = 0; $i < count($ovary_patient_cancer_id); $i++) {

                        $ovary_cancer_site_id = $this->record_model->get_cancer_site_id($patient_ovary_cancer_site[$i]);

                        $data_patient_ovary_diagnosis = array(
                            'cancer_site_id' => $ovary_cancer_site_id,
                            'cancer_invasive_type' => $ovary_cancer_invasive_type[$i],
//                            'is_primary' => $ovary_primary_diagnosis[$i],
                            'date_of_diagnosis' => $ovary_date_of_diagnosis[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($ovary_date_of_diagnosis[$i])),
                            'age_of_diagnosis' => $ovary_age_of_diagnosis[$i],
                            'diagnosis_center' => $ovary_cancer_diagnosis_center[$i],
                            'doctor_name' => $ovary_cancer_doctor_name[$i],
                            'detected_by' => $ovary_detected_by[$i],
//                            'bilateral_flag' => $ovary_cancer_is_bilateral[$i],
                            'modified_on' => $date,
//                            'recurrence_flag' => $ovary_cancer_is_recurrent[$i]
                        );


                        $this->db->where('cancer_id', 2);
                        $this->db->where('patient_studies_id', $patient_studies_id);
                        $this->db->where('patient_cancer_id', $ovary_patient_cancer_id[$i]);
                        $this->db->update('patient_cancer', $data_patient_ovary_diagnosis);

                        if ($this->db->affected_rows() > 0) {
                            echo '<h2>Data for id ' . $i . ' update successfully<h2>';
                        } else {
                            echo '<h2>No update data for id ' . $i . '</h2>';
                        }
                        echo '<br/>';
                    }
                }

                $ovary_patient_pathology_id = $this->input->post('ovary_patient_pathology_id');
                $ovary_tissue_site = $this->input->post('ovary_pathology_tissue_site');
                $ovary_type_of_report = $this->input->post('ovary_pathology_path_report_type');
                $ovary_date_of_report = $this->input->post('ovary_pathology_path_report_date');

                $ovary_pathology_lab = $this->input->post('ovary_pathology_lab');
                $ovary_name_of_doctor = $this->input->post('ovary_pathology_doctor');
                $ovary_morphology = $this->input->post('ovary_pathology_morphology');
                $ovary_stage_classifications = $this->input->post('ovary_stage_classification');
                $ovary_tumour_stage = $this->input->post('ovary_pathology_tumour_stage');
                $ovary_tumour_grade = $this->input->post('ovary_pathology_tumour_grade');
                $ovary_tumour_size = $this->input->post('ovary_pathology_tumour_size');
                $ovary_no_of_report = $this->input->post('ovary_pathology_report_no');
                $ovary_tumor_subtype = $this->input->post('ovary_tumor_subtypes');
                $ovary_tumor_behaviour = $this->input->post('ovary_tumor_behavior');
                $ovary_tumor_differentiation = $this->input->post('ovary_tumor_differentiation');
                $ovary_comments = $this->input->post('ovary_pathology_tissue_path_comments');

                if (!empty($ovary_patient_pathology_id)) {
                    for ($i = 0; $i < count($ovary_patient_pathology_id); $i++) {
                        $data_patient_ovary_pathology = array(
                            'tissue_site' => $ovary_tissue_site[$i],
                            'type_of_report' => $ovary_type_of_report[$i],
                            'date_of_report' => $ovary_date_of_report[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($ovary_date_of_report[$i])),
                            'pathology_lab' => $ovary_pathology_lab[$i],
                            'name_of_doctor' => $ovary_name_of_doctor[$i],
                            'morphology' => $ovary_morphology[$i],
                            'stage_classifications' => $ovary_stage_classifications[$i],
                            'tumour_stage' => $ovary_tumour_stage[$i],
                            'tumour_grade' => $ovary_tumour_grade[$i],
                            'tumour_size' => $ovary_tumour_size[$i],
                            'no_of_report' => $ovary_no_of_report[$i],
                            'tumor_subtype' => $ovary_tumor_subtype[$i],
                            'tumor_behaviour' => $ovary_tumor_behaviour[$i],
                            'tumor_differentiation' => $ovary_tumor_differentiation[$i],
                            'modified_on' => $date,
                            'comments' => $ovary_comments[$i]
                        );


                        $this->db->where('patient_pathology_id', $ovary_patient_pathology_id[$i]);
                        $this->db->update('patient_pathology', $data_patient_ovary_pathology);

                        if ($this->db->affected_rows() > 0) {
                            echo '<h2>Data for id ' . $i . ' update successfully<h2>';
                        } else {
                            echo '<h2>No update data for id ' . $i . '</h2>';
                        }
                        echo '<br/>';
                    }
                }

                $ovary_patient_cancer_treatment_id = $this->input->post('ovary_patient_cancer_treatment_id');
                $ovary_patient_cancer_treatment_name = $this->input->post('ovary_patient_cancer_treatment_name'); //by this we will get treatment_id
                $ovary_treatment_start_date = $this->input->post('ovary_treatment_start_date');
                $ovary_treatment_end_date = $this->input->post('ovary_treatment_end_date');

                $ovary_treatment_durations = $this->input->post('ovary_treatment_duration');
                $ovary_treatment_details = $this->input->post('ovary_treatment_details');
                $ovary_treatment_dose = $this->input->post('ovary_treatment_drug_dose');
                $ovary_treatment_cycle = $this->input->post('ovary_treatment_cycle');
                $ovary_treatment_frequency = $this->input->post('ovary_treatment_frequency');
                $ovary_treatment_visidual_desease = $this->input->post('ovary_treatment_visidual_desease');
                $ovary_treatment_primary_outcome = $this->input->post('ovary_treatment_privacy_outcome');
                $ovary_treatment_cal125_pretreatment = $this->input->post('ovary_cal125_pretreatment');
                $ovary_treatment_cal125_posttreatment = $this->input->post('ovary_cal125_posttreatment');
                $ovary_treatment_comments = $this->input->post('ovary_cancer_treatment_comments');


                if (!empty($ovary_patient_cancer_treatment_id)) {
                    for ($i = 0; $i < count($ovary_patient_cancer_treatment_id); $i++) {

                        $ovary_treatment_id = $this->record_model->get_treatment_id($ovary_patient_cancer_treatment_name[$i]);

                        $data_patient_ovary_treatment = array(
                            'treatment_id' => $ovary_treatment_id[$i],
                            'treatment_start_date' => $ovary_treatment_start_date[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($ovary_treatment_start_date[$i])),
                            'treatment_end_date' => $ovary_treatment_end_date[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($ovary_treatment_end_date[$i])),
                            'treatment_durations' => $ovary_treatment_durations[$i],
                            'treatment_details' => $ovary_treatment_details[$i],
                            'treatment_dose' => $ovary_treatment_dose[$i],
                            'treatment_cycle' => $ovary_treatment_cycle[$i],
                            'treatment_frequency' => $ovary_treatment_frequency[$i],
                            'treatment_visidual_desease' => $ovary_treatment_visidual_desease[$i],
                            'treatment_primary_outcome' => $ovary_treatment_primary_outcome[$i],
                            'treatment_cal125_pretreatment' => $ovary_treatment_cal125_pretreatment[$i],
                            'treatment_cal125_posttreatment' => $ovary_treatment_cal125_posttreatment[$i],
                            'modified_on' => $date,
                            'comments' => $ovary_treatment_comments[$i]
                        );

                        $this->db->where('patient_cancer_treatment_id', $ovary_patient_cancer_treatment_id[$i]);
                        $this->db->update('patient_cancer_treatment', $data_patient_ovary_treatment);

                        if ($this->db->affected_rows() > 0) {
                            echo '<h2>Data for id ' . $i . ' update successfully<h2>';
                        } else {
                            echo '<h2>No update data for id ' . $i . '</h2>';
                        }
                        echo '<br/>';
                    }
                }

                $patient_other_cancer_site = $this->input->post('other_cancer_site'); //by this we will get treatment_id

                $patient_other_cancer_id = $this->input->post('patient_other_cancer_id');
                $other_cancer_id = $this->input->post('patient_cancer_name');
                //$other_cancer_id = $this->record_model->get_cancer_id($patient_other_cancer_name);

                $other_date_of_diagnosis = $this->input->post('other_date_of_diagnosis');

                $other_age_of_diagnosis = $this->input->post('other_age_of_diagnosis');
                $other_diagnosis_center = $this->input->post('other_cancer_diagnosis_center');
                $other_doctor_name = $this->input->post('other_cancer_doctor_name');


                if (!empty($ovary_patient_cancer_treatment_id)) {
                    for ($i = 0; $i < count($patient_other_cancer_id); $i++) {

                        $other_cancer_site_id = $this->record_model->get_cancer_site_id($patient_other_cancer_site[$i]);

                        $data_patient_other_cancer_diagnosis = array(
                            'cancer_id' => $other_cancer_id[$i],
                            'cancer_site_id' => $other_cancer_site_id,
                            'date_of_diagnosis' => $other_date_of_diagnosis[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($other_date_of_diagnosis[$i])),
                            'age_of_diagnosis' => $other_age_of_diagnosis[$i],
                            'diagnosis_center' => $other_diagnosis_center[$i],
                            'doctor_name' => $other_doctor_name[$i],
                            'modified_on' => $date,
                        );


                        $other_cancer_site_id = $this->record_model->get_cancer_site_id($patient_other_cancer_site[$i]);

                        $data_patient_other_cancer_diagnosis = array(
                            'cancer_id' => $other_cancer_id[$i],
                            'cancer_site_id' => $other_cancer_site_id,
                            'date_of_diagnosis' => date('Y-m-d', strtotime($other_date_of_diagnosis[$i])),
                            'age_of_diagnosis' => $other_age_of_diagnosis[$i],
                            'diagnosis_center' => $other_diagnosis_center[$i],
                            'doctor_name' => $other_doctor_name[$i],
                            'modified_on' => $date,
                        );

                        $this->db->where('patient_studies_id', $patient_studies_id);
                        $this->db->where('patient_cancer_id', $patient_other_cancer_id[$i]);
                        $this->db->update('patient_cancer', $data_patient_other_cancer_diagnosis);

                        if ($this->db->affected_rows() > 0) {
                            echo '<h2>Data for id ' . $i . ' update successfully<h2>';
                        } else {
                            echo '<h2>No update data for id ' . $i . '</h2>';
                        }
                        echo '<br/>';
                    }
                }

                $patient_other_pathology_id = $this->input->post('patient_other_pathology_id');
                $other_pathology_tissue_site = $this->input->post('other_pathology_tissue_site');
                $other_pathology_type_of_report = $this->input->post('other_pathology_path_report_type');

                $other_pathology_date_of_report = $this->input->post('other_pathology_path_report_date');

                $other_pathology_pathology_lab = $this->input->post('other_pathology_lab');
                $other_pathology_name_of_doctor = $this->input->post('other_pathology_doctor');
                $other_pathology_comments = $this->input->post('other_pathology_tissue_path_comments');

                if (!empty($patient_other_pathology_id)) {
                    for ($i = 0; $i < count($patient_other_pathology_id); $i++) {


                        $data_patient_other_cancer_pathology = array(
                            'tissue_site' => $other_pathology_tissue_site[$i],
                            'type_of_report' => $other_pathology_type_of_report[$i],
                            'date_of_report' => $other_pathology_date_of_report[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($other_pathology_date_of_report[$i])),
                            'pathology_lab' => $other_pathology_pathology_lab[$i],
                            'name_of_doctor' => $other_pathology_name_of_doctor[$i],
                            'comments' => $other_pathology_comments[$i],
                            'modified_on' => $date,
                        );



                        $this->db->where('patient_pathology_id', $patient_other_pathology_id[$i]);
                        $this->db->update('patient_pathology', $data_patient_other_cancer_pathology);

                        if ($this->db->affected_rows() > 0) {
                            echo '<h2>Data for id ' . $i . ' update successfully<h2>';
                        } else {
                            echo '<h2>No update data for id ' . $i . '</h2>';
                        }
                        echo '<br/>';
                    }
                }

                $patient_other_cancer_treatment_id = $this->input->post('patient_other_cancer_treatment_id');
                $patient_other_cancer_treatment_name = $this->input->post('other_patient_cancer_treatment_name'); //by this we will get treatment_id

                $other_treatment_start_date = $this->input->post('other_treatment_start_date');
                $other_treatment_end_date = $this->input->post('other_treatment_end_date');

                $other_treatment_durations = $this->input->post('other_treatment_duration');
                $other_treatment_details = $this->input->post('other_treatment_details');
                $other_treatment_dose = $this->input->post('other_treatment_drug_dose');
                $other_treatment_cycle = $this->input->post('other_treatment_cycle');
                $other_treatment_frequency = $this->input->post('other_treatment_frequency');
                $other_treatment_visidual_desease = $this->input->post('other_treatment_visidual_desease');
                $other_treatment_primary_outcome = $this->input->post('other_treatment_primary_therapy_outcome');
                $other_comments = $this->input->post('other_cancer_treatment_comments');


                if (!empty($patient_other_cancer_treatment_id)) {
                    for ($i = 0; $i < count($patient_other_cancer_treatment_id); $i++) {

                        $other_cancer_treatment_id = $this->record_model->get_treatment_id($patient_other_cancer_treatment_name[$i]);

                        $data_patient_other_cancer_treatment = array(
                            'treatment_id' => $other_cancer_treatment_id,
                            'treatment_details' => $other_treatment_details[$i],
                            'treatment_start_date' => $other_treatment_start_date[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($other_treatment_start_date[$i])),
                            'treatment_end_date' => $other_treatment_end_date[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($other_treatment_end_date[$i])),
                            'treatment_durations' => $other_treatment_durations[$i],
                            'treatment_dose' => $other_treatment_dose[$i],
                            'treatment_cycle' => $other_treatment_cycle[$i],
                            'treatment_frequency' => $other_treatment_frequency[$i],
                            'treatment_visidual_desease' => $other_treatment_visidual_desease[$i],
                            'treatment_primary_outcome' => $other_treatment_primary_outcome[$i],
                            'modified_on' => $date,
                            'comments' => $other_comments[$i]
                        );


                        $this->db->where('patient_cancer_treatment_id', $patient_other_cancer_treatment_id[$i]);
                        $this->db->update('patient_cancer_treatment', $data_patient_other_cancer_treatment);

                        if ($this->db->affected_rows() > 0) {
                            echo '<h2>Data for id ' . $i . ' update successfully<h2>';
                        } else {
                            echo '<h2>No update data for id ' . $i . '</h2>';
                        }
                        echo '<br/>';
                    }
                }

                $patient_other_disease_id = $this->input->post('patient_other_disease_id');
                $patient_diagnosis = $this->input->post('diagnosis_name'); //by this we will get treatment_id
                $year_of_diagnosis = $this->input->post('year_of_diagnosis');
                $diagnosis_age = $this->input->post('diagnosis_age');
                $center = $this->input->post('diagnosis_center');
                $diagnosis_doctor_name = $this->input->post('diagnosis_doctor_name');
                $on_medication_flag = $this->input->post('is_on_medication_flag');

                //print_r($patient_other_disease_id);exit;
                $on_medication_flag_check = $this->record_model->update_checkbox($on_medication_flag,'on_medication_flag','patient_other_disease_id','patient_other_disease');
                $on_medication_flag_uncheck = $this->record_model->update_checkbox_uncheck($patient_studies_id,$on_medication_flag,'patient_other_disease_id','on_medication_flag','patient_studies_id','patient_other_disease');


                if (!empty($patient_other_disease_id)) {
                    for ($i = 0; $i < count($patient_other_disease_id); $i++) {

                        $other_diagnosis_id = $this->record_model->get_diagnosis_id($patient_diagnosis[$i]);

                        $data_patient_other_diseases = array(
                            'diagnosis_id' => $other_diagnosis_id,
                            'date_of_diagnosis' => $year_of_diagnosis[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($year_of_diagnosis[$i])),
                            'diagnosis_age' => $diagnosis_age[$i],
                            'diagnosis_center' => $center[$i],
                            'doctor_name' => $diagnosis_doctor_name[$i],
                            'created_on' => $date,
                            'on_medication_flag' => $on_medication_flag[$i]
                        );


                        $other_diagnosis_id = $this->record_model->get_diagnosis_id($patient_diagnosis[$i]);

                        $this->db->where('patient_other_disease_id', $patient_other_disease_id[$i]);
                        $this->db->where('patient_studies_id', $patient_studies_id);
                        $this->db->update('patient_other_disease', $data_patient_other_diseases);

                        if ($this->db->affected_rows() > 0) {
                            echo '<h2>Data for id ' . $i . ' update successfully<h2>';
                        } else {
                            echo '<h2>No update data for id ' . $i . '</h2>';
                        }
                        echo '<br/>';
                    }
                }

                $patient_other_disease_medication_id = $this->input->post('patient_other_disease_medication_id');
                $medication_type = $this->input->post('medication_type_name');

                $medication_start_date = $this->input->post('medication_start_date');
                $medication_end_date = $this->input->post('age_of_diagnosis');

                $medication_duration = $this->input->post('medication_duration');
                $medication_comments = $this->input->post('medication_comments');

                if (!empty($patient_other_disease_medication_id)) {
                    for ($i = 0; $i < count($patient_other_disease_medication_id); $i++) {


                        $data_patient_other_diseases_medication = array(
                            'medication_type' => $medication_type[$i],
                            'start_date' => $medication_start_date[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($medication_start_date[$i])),
                            'end_date' => $medication_end_date[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($medication_end_date[$i])),
                            'duration' => $medication_duration[$i],
                            'modified_on' => $date,
                            'comments' => $medication_comments[$i]
                        );


                        // echo '<pre>';
                        // print_r($data_patient_surveillance);echo '<br/>';
                        //array_push($data, $this->input->post('firstname'));
                        $this->db->where('patient_other_disease_id', $patient_other_disease_id[$i]);
                        $this->db->where('patient_other_disease_medication_id', $patient_other_disease_medication_id[$i]);
                        $this->db->update('patient_other_disease_medication', $data_patient_other_diseases_medication);

                        if ($this->db->affected_rows() > 0) {
                            echo '<h2>Data for id ' . $i . ' update successfully<h2>';
                        } else {
                            echo '<h2>No update data for id ' . $i . '</h2>';
                        }
                        echo '<br/>';
                    }
                }
        }
        

            function interview_home_insersion() {

                date_default_timezone_set("Asia/Kuala_lumpur");
                $date = date('Y-m-d H:i:s'); //Returns IST
                $interview_date = $this->input->post('interview_date');
                $next_interview_date = $this->input->post('interview_next_date');

                $data_patient_interview_manager = array(
                    'patient_ic_no' => $this->input->post('IC_no'),
                    'interview_date' => $interview_date == '' ? '0000-00-00' : date("Y-m-d", strtotime($interview_date)),
                    'next_interview_date' => $next_interview_date == '' ? '0000-00-00' : date("Y-m-d", strtotime($next_interview_date)),
                    'is_send_email_reminder_to_officers' => $this->input->post('is_send_email_reminder'),
                    'officer_email_addresses' => $this->input->post('officer_email_addresses'),
                    'created_on' => $date,
                    'comments' => $this->input->post('interview_note')
                );
                
                //print_r($data_patient_interview_manager);exit;
                $patient_interview_manager_id = $this->record_model->insert_patient_interview_manager($data_patient_interview_manager);

                $dynamicFieldsArray = $this->getDynamicFieldsInputsArray("counselling_note");
                

        if ($patient_interview_manager_id > 0) {
            echo "<h2>Data Added successfully.</h2>";
                } else {
                    echo "<h2>Failed to added data. Please try again.</h2>";
                }
                echo '<br/>';
            }

            function interview_home_update() {

                date_default_timezone_set("Asia/Kuala_lumpur");
                $date = date('Y-m-d H:i:s'); //Returns IST 

                $icno = $this->input->post('icno');
                $manager_id = $this->input->post('patient_interview_manager_id');
                $interview_date = $this->input->post('interview_date');
                $next_interview_date = $this->input->post('interview_next_date');

                $is_send_email_reminder_to_officers = $this->input->post('is_send_email_reminder');
                $officer_email_addresses = $this->input->post('officer_email_addresses');
                $comments = $this->input->post('interview_note');
                //print_r($manager_id);exit;
                //foreach ($manager_id as $test):
                
                $is_send_email_reminder_to_officers_check = $this->record_model->update_checkbox($is_send_email_reminder_to_officers,'is_send_email_reminder_to_officers','patient_interview_manager_id','patient_interview_manager');
                $is_send_email_reminder_to_officers_uncheck = $this->record_model->update_checkbox_uncheck($icno,$is_send_email_reminder_to_officers,'patient_interview_manager_id','is_send_email_reminder_to_officers','patient_ic_no','patient_interview_manager');

                for ($i = 0; $i < count($manager_id); $i++) {
                    //print_r($test);exit;

                    $data_patient_interview_manager = array(
                        //'patient_ic_no' => $this->input->post('IC_no'),
                        'interview_date' => $interview_date[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($interview_date[$i])),
                        'next_interview_date' => $next_interview_date[$i] == '00-00-0000' ? '0000-00-00' : date("Y-m-d", strtotime($next_interview_date[$i])),
//                        'is_send_email_reminder_to_officers' => $is_send_email_reminder_to_officers[$i],
                        'officer_email_addresses' => $officer_email_addresses[$i],
                        'created_on' => $date,
                        'comments' => $comments[$i]
                    );

                    //print_r($data_patient_interview_manager);exit;

                    $this->db->where('patient_interview_manager_id', $manager_id[$i]);
                    $this->db->where('patient_ic_no', $icno);
                    $this->db->update('patient_interview_manager', $data_patient_interview_manager);


                    if ($this->db->affected_rows() > 0) {
                        echo '<h2>Data for id ' . $i . ' update successfully<h2>';
                    } else {
                        echo '<h2>No update data for id ' . $i . '</h2>';
                    }
                    echo '<br/>';
                }
                //endforeach;
            }

            function risk_assessment_update() {

                date_default_timezone_set("Asia/Kuala_lumpur");
                $date = date('Y-m-d H:i:s'); //Returns IST 

                $icno = $this->input->post('icno');
                $boadicea_id = $this->input->post('patient_boadicea_id');
                $at_consent_mach_brca1 = $this->input->post('ms_at_consent_BRCA1');
                $at_consent_mach_brca2 = $this->input->post('ms_at_consent_BRCA2');
                $at_consent_mach_total = $this->input->post('ms_at_consent_Total');
                $after_gc_brca1 = $this->input->post('ms_after_gc_BRCA1');
                $after_gc_brca2 = $this->input->post('ms_after_gc_BRCA2');
                $after_gc_total = $this->input->post('ms_after_gc_Total');
                $adjusted_mach_brca1 = $this->input->post('ms_adjusted_gc_BRCA1');
                $adjusted_mach_brca2 = $this->input->post('ms_adjusted_gc_BRCA2');
                $adjusted_mach_total = $this->input->post('ms_adjusted_gc_Total');
                $at_consent_boadicea_brca1 = $this->input->post('BOADICEA_at_consent_BRCA1');
                $at_consent_boadicea_brca2 = $this->input->post('BOADICEA_at_consent_BRCA2');
                $at_consent_boadicea_no_mutation = $this->input->post('BOADICEA_at_consent_no_mutation');
                $adjusted_boadicea_brca1 = $this->input->post('BOADICEA_adjusted_BRCA1');
                $adjusted_boadicea_brca2 = $this->input->post('BOADICEA_adjusted_BRCA2');
                $adjusted_boadicea_no_mutation = $this->input->post('BOADICEA_adjusted_no_mutation');
                $after_gc_boadicea_brca1 = $this->input->post('BOADICEA_after_gc_BRCA1');
                $after_gc_boadicea_brca2 = $this->input->post('BOADICEA_after_gc_BRCA2');
                $after_gc_boadicea_no_mutation = $this->input->post('BOADICEA_after_gc_no_mutation');
                $at_consent_gail_model_5years = $this->input->post('gail_model_at_consent_5years');
                $at_consent_gail_model_10years = $this->input->post('gail_model_at_consent_10years');
                $first_mammo_gail_model_10years = $this->input->post('gail_model_first_mammo_10years');
                $first_mammo_gail_model_5years = $this->input->post('gail_model_first_mammo_5years');
                
                $at_consent_boadicea_no_mutation_check = $this->record_model->update_checkbox($at_consent_boadicea_no_mutation,'at_consent_boadicea_no_mutation','patient_boadicea_id','patient_risk_assessment');
                $at_consent_boadicea_no_mutation_uncheck = $this->record_model->update_checkbox_uncheck($icno,$at_consent_boadicea_no_mutation,'patient_boadicea_id','at_consent_boadicea_no_mutation','patient_ic_no','patient_risk_assessment');
                
                $adjusted_boadicea_no_mutation_check = $this->record_model->update_checkbox($adjusted_boadicea_no_mutation,'adjusted_boadicea_no_mutation','patient_boadicea_id','patient_risk_assessment');
                $adjusted_boadicea_no_mutation_uncheck = $this->record_model->update_checkbox_uncheck($icno,$adjusted_boadicea_no_mutation,'patient_boadicea_id','adjusted_boadicea_no_mutation','patient_ic_no','patient_risk_assessment');
                
                $after_gc_boadicea_no_mutation_check = $this->record_model->update_checkbox($after_gc_boadicea_no_mutation,'after_gc_boadicea_no_mutation','patient_boadicea_id','patient_risk_assessment');
                $after_gc_boadicea_no_mutation_uncheck = $this->record_model->update_checkbox_uncheck($icno,$after_gc_boadicea_no_mutation,'patient_boadicea_id','after_gc_boadicea_no_mutation','patient_ic_no','patient_risk_assessment');
            

                if (!empty($boadicea_id)) {
                    for ($i = 0; $i < count($boadicea_id); $i++) {

                        $data_patient_risk_assessment = array(
                            'at_consent_mach_brca1' => $at_consent_mach_brca1[$i],
                            'at_consent_mach_brca2' => $at_consent_mach_brca2[$i],
                            'at_consent_mach_total' => $at_consent_mach_total[$i],
                            'after_gc_brca1' => $after_gc_brca1[$i],
                            'after_gc_brca2' => $after_gc_brca2[$i],
                            'after_gc_total' => $after_gc_total[$i],
                            'adjusted_mach_brca1' => $adjusted_mach_brca1[$i],
                            'adjusted_mach_brca2' => $adjusted_mach_brca2[$i],
                            'adjusted_mach_total' => $adjusted_mach_total[$i],
                            'at_consent_boadicea_brca1' => $at_consent_boadicea_brca1[$i],
                            'at_consent_boadicea_brca2' => $at_consent_boadicea_brca2[$i],
//                            'at_consent_boadicea_no_mutation' => $at_consent_boadicea_no_mutation[$i],
                            'adjusted_boadicea_brca1' => $adjusted_boadicea_brca1[$i],
                            'adjusted_boadicea_brca2' => $adjusted_boadicea_brca2[$i],
//                            'adjusted_boadicea_no_mutation' => $adjusted_boadicea_no_mutation[$i],
                            'after_gc_boadicea_brca1' => $after_gc_boadicea_brca1[$i],
                            'after_gc_boadicea_brca2' => $after_gc_boadicea_brca2[$i],
//                            'after_gc_boadicea_no_mutation' => $after_gc_boadicea_no_mutation[$i],
                            'at_consent_gail_model_5years' => $at_consent_gail_model_5years[$i],
                            'at_consent_gail_model_10years' => $at_consent_gail_model_10years[$i],
                            'first_mammo_gail_model_10years' => $first_mammo_gail_model_10years[$i],
                            'created_on' => $date,
                            'first_mammo_gail_model_5years' => $first_mammo_gail_model_5years[$i]
                        );

                        $this->db->where('patient_boadicea_id', $boadicea_id[$i]);
                        $this->db->where('patient_ic_no', $icno);
                        $this->db->update('patient_risk_assessment', $data_patient_risk_assessment);

                        //$this->db->last_query();
                        if ($this->db->affected_rows() > 0) {
                            echo '<h2>Data for id ' . $i . ' update successfully<h2>';
                        } else {
                            echo '<h2>No update data for id ' . $i . '</h2>';
                        }
                        echo '<br/>';
                    }
                }
            }

            function view_bulk_import() {
                $this->load->model('Record_model');
                $data = $this->Record_model->general();
                $this->template->load("templates/add_record_template", 'record/upload_xlsx_file', $data);
            }

            function do_upload_xlsx_final($filePath) {
                //echo $file_path;
                $this->excell_parser_model->excell_file_parser($filePath);
            }

            function do_upload_xlsx() {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'xlsx';
                $config['max_size'] = '100000';
                //$config['max_width']  = '1024';
                //$config['max_height']  = '768';

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload()) {
                    $error = array('error' => $this->upload->display_errors());

                    $this->load->view('upload_xlsx_file', $error);
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    //echo '<h3>Your file was successfully uploaded!</h3>';
                    //echo $data['upload_data']['full_path'];
                    $temp = $data['upload_data']['file_name'];
                    //echo $temp;
                    //print_r($data);
                    //redirect('excell_parser/test/',$temp);
                    $data_duplicate_ic = array();
                    $data_duplicate_ic = null;
                    //echo $temp.'<br>';
                    //if($temp == 'Personal.xlsx')
                    $pos = strpos($temp, 'Personal');
                    if ($pos !== false)
                        $data_duplicate_ic = $this->excell_auto_verification->excell_parser($temp);

                    $data_all = array(
                        'fileName' => $temp,
                        'ic_no' => $data_duplicate_ic
                    );

                    if (sizeof($data_duplicate_ic) > 0) {

                        $this->template->load("templates/add_record_template", 'record/auto_verification_dialog_view', $data_all);
                    } else {
                        $this->excell_parser_model->excell_file_parser($temp);
                    }

                    //$this->excell_parser_model->excell_file_parser($temp);
                }
            }

            function do_upload_rawImage() {
                $config['upload_path'] = './images/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '100000';
                //$config['max_width']  = '1024';
                //$config['max_height']  = '768';

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload()) {
                    $error = array('error' => $this->upload->display_errors());

                    //$this->load->view('upload_xlsx_file', $error);
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    //echo '<h3>Your file was successfully uploaded!</h3>';
                    //echo $data['upload_data']['full_path'];
                    $temp = $data['upload_data']['full_path'];
                    echo $temp;
                    //print_r($data);
                    //redirect('excell_parser/test/',$temp);
                    //$this->excell_parser_model->excell_file_parser($temp);
                }
            }

            function view_record_home() {

                $this->template->load("templates/report_home_template", 'record/view_record_home');
            }

            function view_record_list($var = null, $ic_no, $patient_studies_id = null) {
                $this->load->model('Record_model');
                $data = $this->Record_model->general();
                $userid = $this->session->userdata('user_id');

                $data['userprivillage'] = $this->record_model->user_privillage($userid);
                $data['isLocked'] = FALSE;
                $user_is_locked = $this->record_model->get_is_user_locked($ic_no);
                //echo 'is locked:'.$user_is_locked;

                if ($var == 'personal') {


                    $data['patient_detail'] = $this->record_model->get_detail_patient_record($ic_no, $patient_studies_id);
                    $data['patient_consent_detail'] = $this->record_model->get_consent_detail_patient_record($ic_no, $patient_studies_id);
                    $data['studies_id'] = $this->record_model->get_studies_name_by_id();
                    $data['patient_private_no'] = $this->record_model->get_private_no_record($ic_no);
                    $data['patient_hospital_no'] = $this->record_model->get_hospital_no_record($ic_no);
                    $data['patient_cogs_studies'] = $this->record_model->get_cogs_study_record($ic_no);
                    $data['patient_contact_person'] = $this->record_model->get_detail_record($ic_no, 'patient_contact_person', 'patient_ic_no');
                    $data['patient_survival_status'] = $this->record_model->get_survival_record($ic_no);
                    $data['alive_id'] = $this->record_model->get_alive_status_by_id();
                    $data['patient_relatives_summary'] = $this->record_model->get_detail_record($ic_no, 'patient_relatives_summary', 'patient_ic_no');
                                        
                    $data['isUpdate'] = TRUE;

                    if ($user_is_locked == 1) {
                        $this->template->load("templates/add_record_template", 'record/view_personal_details_readonly', $data);
                    } else {
                        $this->template->load("templates/add_record_template", 'record/view_record_personal_details', $data);
                    }
                } else if ($var == 'family') {
                    $data['patient_family_mother'] = $this->record_model->get_view_family_record($ic_no, 2);
                    $data['patient_family_father'] = $this->record_model->get_view_family_record($ic_no, 1);
                    $data['patient_family_others'] = $this->record_model->get_view_family_others_record($ic_no);
                    $data['cancer_name'] = $this->record_model->get_cancer_by_id();
                    $data['relative'] = $this->record_model->get_relative_by_id();
                    $data['relationship'] = $this->record_model->get_relationship_list();
                    $data['relative_degrees'] = $this->record_model->get_relative_degrees_list();
                    if ($user_is_locked == 1)
                        $this->template->load("templates/add_record_template", 'record/view_family_details_readonly', $data);
                    else
                        $this->template->load("templates/add_record_template", 'record/view_record_family_details', $data);
                } else if ($var == 'diagnosis') {
                    //$data['patient_breast_cancer'] = $this->record_model->get_patient_breast_diagnosis_record($patient_studies_id);
                    //$data['patient_ovary_cancer'] = $this->record_model->get_patient_ovary_diagnosis_record($patient_studies_id);
                    //$data['patient_ovary_cancer_treatment'] = $this->record_model->get_patient_treatment_record($a['patient_cancer_id']);
                    $breast_diagnosis_list = $this->record_model->get_patient_breast_cancer_record($patient_studies_id);
                    
                    if(!empty($breast_diagnosis_list)){
                    foreach ($breast_diagnosis_list as $breast_id=>$breast) {
                    $breast_cancer_id = $breast['patient_cancer_id'];
                                                                    
                    $breast_treatment['treatment'] = $this->record_model->get_patient_treatment_record($breast_cancer_id);
                    $breast_pathology['pathology'] = $this->record_model->get_patient_breast_pathology_record($breast_cancer_id);

                    $breast_cancer[] = array_merge($breast, $breast_treatment, $breast_pathology);

                    }
                    $data['patient_breast_cancer'] = $breast_cancer;
                    }
                    
                    //print_r($breast_diagnosis_list);exit;
                    
                    $ovarian_diagnosis_list = $this->record_model->get_patient_ovary_cancer_record($patient_studies_id);
                    
                    if(!empty($ovarian_diagnosis_list)){
                    foreach ($ovarian_diagnosis_list as $ovarian_id=>$ovary) {
                    $ovarian_cancer_id = $ovary['patient_cancer_id'];
                                                                    
                    $ovarian_treatment['treatment'] = $this->record_model->get_patient_treatment_record($ovarian_cancer_id);
                    $ovarian_pathology['pathology'] = $this->record_model->get_patient_pathology_record($ovarian_cancer_id);

                    $ovarian[] = array_merge($ovary, $ovarian_treatment, $ovarian_pathology);

                    }
                    $data['patient_ovary_cancer'] = $ovarian;
                    }
                    $other_diagnosis_list = $this->record_model->get_patient_other_diagnosis_record($patient_studies_id);
                    
                    if(!empty($other_diagnosis_list)){
                    foreach ($other_diagnosis_list as $id=>$test) {
                    $patient_cancer_id = $test['patient_cancer_id'];
                                                                    
                    $treatment['treatment'] = $this->record_model->get_patient_treatment_record($patient_cancer_id);
                    $pathology['pathology'] = $this->record_model->get_patient_pathology_record($patient_cancer_id);

                    $example[] = array_merge($test, $treatment, $pathology);

                    }
                    $data['patient_others_cancer'] = $example;
                    }

                    $data['patient_other_disease'] = $this->record_model->get_patient_others_desease_record($patient_studies_id);
                    $data['diagnosis_name'] = $this->record_model->get_diagnosis();
                    $data['site_cancer'] = $this->record_model->get_cancer_site();
                    $data['treatment_type'] = $this->record_model->get_treatment_type();
                    $data['cancer_name'] = $this->record_model->get_cancer_by_id();

                    if ($user_is_locked == 1)
                        $this->template->load("templates/add_record_template", 'record/view_diagnosis_treatment_details_readonly', $data);
                    else
                        $this->template->load("templates/add_record_template", 'record/view_record_diagnosis_treatment_details', $data);
                } else if ($var == 'studies_setOne') {
                    $data['patient_breast_screening'] = $this->record_model->get_patient_breast_screening_record($patient_studies_id, $ic_no);
                    $data['patient_non_cancer'] = $this->record_model->get_patient_non_cancer_record($patient_studies_id);
                    $data['patient_risk_reducing_surgery'] = $this->record_model->get_patient_risk_reducing_surgery_record($patient_studies_id);
                    $data['patient_ovarian_screening'] = $this->record_model->get_patient_ovarian_screening_record($patient_studies_id);
                    $data['patient_surveillance'] = $this->record_model->get_patient_surveillance_record($patient_studies_id);
                    $data['patient_other_screening'] = $this->record_model->get_patient_other_screening_record($patient_studies_id);
                    $data['ovarian_screening_type'] = $this->record_model->get_ovarian_screening_type_by_id();
                    $data['site_breast'] = $this->record_model->get_site_breast_by_id();
                    $data['upperbelow_breast'] = $this->record_model->get_upperbellow_breast_by_id();
                    $data['non_cancerous_site'] = $this->record_model->get_non_cancerous_benign_site_name();

                    $this->template->load("templates/add_record_template", 'record/view_record_studies_set_one_details', $data);
                } else if ($var == 'mutation_analysis') {

                    $data['patient_mutation_analysis'] = $this->record_model->get_view_patient_record($patient_studies_id, 'patient_mutation_analysis', 'patient_studies_id');
                    //print_r($a);exit;
                    if ($user_is_locked == 1)
                        $this->template->load("templates/add_record_template", 'record/view_mutation_analysis_details_readonly', $data);
                    else
                        $this->template->load("templates/add_record_template", 'record/view_record_mutation_analysis_details', $data);
                } else if ($var == 'risk_assessment') {
                    $data['patient_risk_assessment'] = $this->record_model->get_view_patient_record($ic_no, 'patient_risk_assessment', 'patient_ic_no');
                    if ($user_is_locked == 1)
                        $this->template->load("templates/add_record_template", 'record/view_risk_assessment_details_readonly', $data);
                    else
                        $this->template->load("templates/add_record_template", 'record/view_record_risk_assessment_details', $data);
                } else if ($var == 'lifestyleFactors') {
                    $data['patient_lifestyle_factors'] = $this->record_model->get_lifestyle_detail_patient_record($patient_studies_id);
                    $data['patient_menstruation'] = $this->record_model->get_patient_menstruation_record($ic_no, $patient_studies_id);
                    $data['patient_parity_table'] = $this->record_model->get_patient_parity_table_record($ic_no, $patient_studies_id);
                    // $data['patient_parity_record'] = $this->record_model->get_patient_parity_record($ic_no, $patient_studies_id);
                    $data['patient_infertility'] = $this->record_model->get_patient_infertility_record($ic_no, $patient_studies_id);
                    $data['patient_gynaecological'] = $this->record_model->get_patient_gynaecological_record($ic_no, $patient_studies_id);
                    //$data['patient_lifestyle_factors'] = $this->record_model->get_patient_lifstyle_record($patient_studies_id);
                    if ($user_is_locked == 1)
                        $this->template->load("templates/add_record_template", 'record/view_lifestyles_factors_details_readonly', $data);
                    else
                        $this->template->load("templates/add_record_template", 'record/view_record_lifestyles_factors_details', $data);
                } else if ($var == 'counselling') {
                    $data['patient_interview_manager'] = $this->record_model->get_patient_counselling_record($ic_no);

                    if ($user_is_locked == 1)
                        $this->template->load("templates/add_record_template", 'record/view_interview_home_readonly', $data);
                    else
                        $this->template->load("templates/add_record_template", 'record/view_interview_home', $data);
                } else if ($var == 'bulkImport') {
                    $this->template->load("templates/add_record_template", 'record/upload_xlsx_file', $data);
                }
            }
            
            function export_filter($icno, $patient_studies_id = NULL){
                
                $data['export_tab']= array(
                    
                    'personal' => 'Personal',
                    'family' => 'Family',
                    'diagnosis' => 'Diagnosis & Treatment',
                    'studies_setOne' => 'Screening & Survellience',
                    'mutation' => 'Mutation Analysis',
                    'risk_assessment' => 'Risk Assessment',
                    'lifestyleFactors' => 'Lifestyle Factor',
                    'counseling' => 'Counseling'
                );
                
                $data['ic_no'] = $icno;
                $data['patient_studies_id'] = $patient_studies_id;
                
                $this->template->load("templates/add_record_template", 'export/view_export_filter', $data);
            }
            
            function export_record_list() {
                $this->load->model('Record_model');
                $data = $this->Record_model->general();
                $userid = $this->session->userdata('user_id');
                
                $var = $this->input->post('tab_name');
                $ic_no = $this->input->post('icno');
                $patient_studies_id = $this->input->post('patient_studies_id');

                $data['userprivillage'] = $this->record_model->user_privillage($userid);
                $data['isLocked'] = FALSE;
                $user_is_locked = $this->record_model->get_is_user_locked($ic_no);
                //echo 'is locked:'.$user_is_locked;

                if ($var == 'personal') {

                    $data['patient_detail'] = $this->record_model->get_detail_export_patient_record($ic_no, $patient_studies_id);
                    $data['patient_consent_detail'] = $this->record_model->get_consent_detail_patient_record($ic_no, $patient_studies_id);
                    $data['studies_id'] = $this->record_model->get_studies_name_by_id();
                    $data['patient_private_no'] = $this->record_model->get_private_no_record($ic_no);
                    $data['patient_hospital_no'] = $this->record_model->get_hospital_no_record($ic_no);
                    $data['patient_cogs_studies'] = $this->record_model->get_cogs_study_record($ic_no);
                    $data['patient_contact_person'] = $this->record_model->get_detail_record($ic_no, 'patient_contact_person', 'patient_ic_no');
                    $data['patient_survival_status'] = $this->record_model->get_survival_record($ic_no);
                    $data['alive_id'] = $this->record_model->get_alive_status_by_id();
                    $data['patient_relatives_summary'] = $this->record_model->get_detail_record($ic_no, 'patient_relatives_summary', 'patient_ic_no');
                     
                    $this->load->view('export/personal_tab',$data);
                    $this->load->view('export/consent_detail_tab',$data);
                    
                } else if ($var == 'family') {
                    $data['patient_family'] = $this->record_model->get_view_family_export($ic_no);
                    
                    //print_r($data['patient_family']);exit;
                    
                    $data['cancer_name'] = $this->record_model->get_cancer_by_id();
                    $data['relative'] = $this->record_model->get_relative_by_id();
                    $data['relationship'] = $this->record_model->get_relationship_list();
                    $data['relative_degrees'] = $this->record_model->get_relative_degrees_list();
                    
                     $this->load->view('export/family_tab',$data);
                     
                } else if ($var == 'diagnosis') {
                    //$data['patient_breast_cancer'] = $this->record_model->get_patient_breast_diagnosis_record($patient_studies_id);
                    //$data['patient_ovary_cancer'] = $this->record_model->get_patient_ovary_diagnosis_record($patient_studies_id);
                    //$data['patient_ovary_cancer_treatment'] = $this->record_model->get_patient_treatment_record($a['patient_cancer_id']);
                    $breast_diagnosis_list = $this->record_model->get_patient_all_cancer_record($patient_studies_id);
                    
                    if(!empty($breast_diagnosis_list)){
                    foreach ($breast_diagnosis_list as $breast_id=>$breast) {
                    $breast_cancer_id = $breast['patient_cancer_id'];
                                                                    
                    $breast_treatment['treatment'] = $this->record_model->get_patient_treatment_record($breast_cancer_id);
                    $breast_pathology['pathology'] = $this->record_model->get_patient_breast_pathology_record($breast_cancer_id);

                    $breast_cancer[] = array_merge($breast, $breast_treatment, $breast_pathology);

                    }
                    $data['patient_breast_cancer'] = $breast_cancer;
                    }

                    $data['patient_other_disease'] = $this->record_model->get_patient_others_desease_record($patient_studies_id);
                    $data['diagnosis_name'] = $this->record_model->get_diagnosis();
                    $data['site_cancer'] = $this->record_model->get_cancer_site();
                    $data['treatment_type'] = $this->record_model->get_treatment_type();
                    $data['cancer_name'] = $this->record_model->get_cancer_by_id();

                    $this->load->view('export/diagnosis_tab',$data);
                    $this->load->view('export/diagnosis_tab1',$data);
                    
                } else if ($var == 'studies_setOne') {
                    $data['patient_breast_screening'] = $this->record_model->get_patient_breast_screening_record($patient_studies_id, $ic_no);
                    $data['patient_non_cancer'] = $this->record_model->get_patient_non_cancer_record($patient_studies_id);
                    $data['patient_risk_reducing_surgery'] = $this->record_model->get_patient_risk_reducing_surgery_record($patient_studies_id);
                    $data['patient_ovarian_screening'] = $this->record_model->get_patient_ovarian_screening_record($patient_studies_id);
                    $data['patient_surveillance'] = $this->record_model->get_patient_surveillance_record($patient_studies_id);
                    $data['patient_other_screening'] = $this->record_model->get_patient_other_screening_record($patient_studies_id);
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
                } else if ($var == 'mutation') {

                    $data['patient_mutation_analysis'] = $this->record_model->get_view_patient_record($patient_studies_id, 'patient_mutation_analysis', 'patient_studies_id');
                    $this->load->view('export/mutation_tab',$data);
                    
                } else if ($var == 'risk_assessment') {
                    $data['patient_risk_assessment'] = $this->record_model->get_view_patient_record($ic_no, 'patient_risk_assessment', 'patient_ic_no');
                    
                    $this->load->view('export/risk_assessment_tab',$data);
                } else if ($var == 'lifestyleFactors') {
                    $data['patient_lifestyle_factors'] = $this->record_model->get_lifestyle_detail_patient_record($patient_studies_id);
                    $data['patient_menstruation'] = $this->record_model->get_patient_menstruation_record($ic_no, $patient_studies_id);
                    $data['patient_parity_table'] = $this->record_model->get_patient_parity_table_record($ic_no, $patient_studies_id);
                    // $data['patient_parity_record'] = $this->record_model->get_patient_parity_record($ic_no, $patient_studies_id);
                    $data['patient_infertility'] = $this->record_model->get_patient_infertility_record($ic_no, $patient_studies_id);
                    $data['patient_gynaecological'] = $this->record_model->get_patient_gynaecological_record($ic_no, $patient_studies_id);
                    //$data['patient_lifestyle_factors'] = $this->record_model->get_patient_lifstyle_record($patient_studies_id);
                                        
                    $this->load->view('export/lifestyle_tab',$data);
                    $this->load->view('export/lifestyle_tab2',$data);
                    $this->load->view('export/lifestyle_tab3',$data);
                    $this->load->view('export/lifestyle_tab4',$data);
                } else if ($var == 'counseling') {
                    
                    //echo 'test 1';
                    $data['patient_interview_manager'] = $this->record_model->get_patient_counselling_record($ic_no);
                    $data['email_reminder'] = array(
                        '' => '',
                        '0' => 'No',
                        '1' => 'Yes'
                    );

                        //$this->template->load("templates/add_record_template", 'export/counseling_tab', $data);
                        $this->load->view('export/counseling_tab',$data);
                } else if ($var == 'bulkImport') {
                    $this->template->load("templates/add_record_template", 'record/upload_xlsx_file', $data);
                }
            }
            
        function check_duplicate_ic_entry()
    {
        //$pattern = array('0'=>'/-/','1'=>'/_/','2'=>'/\s/','3'=>'/\W/');
        $icno = $this->input->post('ic_no');

        $this->db->select('ic_no');
        $this->db->where('ic_no',$icno);
        $query = $this->db->get('patient');
        $result = $query->row_array();
        $query->free_result();
        
        //echo $this->db->last_query();
        
        if ($result != NULL){
            echo '1';
        } else {
            echo '0';
        }
    }
    
    function check_duplicate_oldic_entry()
    {
        //$pattern = array('0'=>'/-/','1'=>'/_/','2'=>'/\s/','3'=>'/\W/');
        $icno = $this->input->post('old_ic_no');

        $this->db->select('old_ic_no');
        $this->db->where('old_ic_no',$icno);
        $query = $this->db->get('patient');
        $result = $query->row_array();
        $query->free_result();
        
        //echo $this->db->last_query();
        
        if ($result != NULL){
            echo '1';
        } else {
            echo '0';
        }
    }
            
}