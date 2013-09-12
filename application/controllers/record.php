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
        else if ($var == 'interviewmanager')
            $this->template->load("templates/add_record_template", 'record/interview_home', $data);
        else if ($var == 'bulkImport')
            $this->template->load("templates/add_record_template", 'record/upload_xlsx_file', $data);
        //$this->load->view('record/add_record', $data);
    }

    function patient_record_insertion() {
        //print_r($this->input->post());
        //$data = array();
        //validate form input
        $this->form_validation->set_rules('fullname', 'Full name', 'required|xss_clean');
        if ($this->form_validation->run() == true) {

            $data_patient = array(
                'fullname' => $this->input->post('fullname'),
                'surname' => $this->input->post('surname'),
                'maiden_name' => $this->input->post('maiden_name'),
                'family_no' => $this->input->post('family_no'),
                'ic_no' => $this->input->post('IC_no'),
                'nationality' => $this->input->post('nationality'),
                'gender' => $this->input->post('gender'),
                'ethnicity' => $this->input->post('ethnicity'),
                'd_o_b' => $this->input->post('d_o_b'),
                'place_of_birth' => $this->input->post('place_of_birth'),
                'income_level' => $this->input->post('income_level'),
                'is_dead' => $this->input->post('still_alive_flag'),
                'd_o_d' => $this->input->post('d_o_d'),
                'reason_of_death' => $this->input->post('reason_of_death'),
                'padigree_labelling' => $this->input->post('padigree_labelling'),
                'blood_group' => $this->input->post('blood_group'),
                'hospital_no' => $this->input->post('hospital_no'),
                'private_patient_no' => $this->input->post('private_patient_no'),
                'marital_status' => $this->input->post('marital_status'),
                'blood_card' => $this->input->post('is_blood_card_exist'),
                'blood_card_location' => $this->input->post('private_patient_no'),
                'cogs_study_id' => $this->input->post('COGS_study_id'),
                'address' => $this->input->post('address'),
                'home_phone' => $this->input->post('home_phone'),
                'cell_phone' => $this->input->post('cell_phone'),
                'work_phone' => $this->input->post('work_phone'),
                'other_phone' => $this->input->post('other_phone'),
                'fax' => $this->input->post('fax'),
                'email' => $this->input->post('email'),
                'height' => $this->input->post('height'),
                'weight' => $this->input->post('weight'),
                'bmi' => $this->input->post('bmi'),
                'highest_education_level' => $this->input->post('highest_education_level') 
            );
            echo '<pre>';
           // print_r($data_patient);
            echo '<br/>';
            $data_patient_contact_person = array(
                'patient_ic_no' => $this->input->post('IC_no'),
                'name' => $this->input->post('contact_person_name'),
                'relationship' => $this->input->post('contact_person_relationship'),
                'telephone' => $this->input->post('contact_person_phone_number')
            );
            // print_r($data_patient_contact_person);
            //echo '<br/>';
            //array_push($data, $this->input->post('firstname'));
            $id_patient_record = $this->record_model->insert_at_patient_record($data_patient);
            if ($id_patient_record > 0) {
                echo "<h2>Data Added successfully at Patient table</h2>";
            } else {
                echo "<h2>Failed to insert at Patient table</h2>";
            }
            echo '<br/>';
            $id_patient_contact_person = $this->record_model->insert_at_patient_contact_person($data_patient_contact_person);
            if ($id_patient_contact_person > 0) {
                echo "<h2>Data Added successfully at patient_contact_person table</h2>";
            } else {
                echo "<h2>Failed to insert at patient_contact_person table</h2>";
            }
            echo '<br/>';
             
            $alive_status = $this->input->post('alive_status');
            
            if($alive_status == 'Alive')
               $alive_status_flag = TRUE;
            else if($alive_status == 'Dead')
                $alive_status_flag = FALSE;
            else 
                $alive_status_flag = FALSE;
            
            $data_patient_survival_status = array(
                'patient_ic_no' => $this->input->post('IC_no'),
                'source' => $this->input->post('recurrence_site'),
                'alive_status' => $alive_status_flag,
                'creation_date' => $this->input->post('status_gathered_date')
            );

            $patient_survival_status_id = $this->record_model->insert_patient_survival_status($data_patient_survival_status);
            if ($patient_survival_status_id > 0) {
                echo "<h2>Data Added successfully at patient_survival_status table</h2>";
            } else {
                echo "<h2>Failed to insert at patient_survival_status table</h2>";
            }
            echo '<br/>';
            
               $data_patient_relatives_summary = array(
                'patient_ic_no' => $this->input->post('IC_no'),
                'total_no_of_male_siblings' => $this->input->post('total_no_of_male_siblings'),
                'total_no_of_female_siblings' => $this->input->post('total_no_of_female_siblings'),
                'total_no_of_affected_siblings' => $this->input->post('total_no_of_affected_siblings'),
                'total_no_of_male_children' => $this->input->post('total_no_male_children'),
                'total_no_of_female_children' => $this->input->post('total_no_female_children'),
                'total_no_of_affected_children' => $this->input->post('total_no_of_affected_children'),
                'total_no_of_1st_degree' => $this->input->post('total_no_of_first_degree'),
                'total_no_of_2nd_degree' => $this->input->post('total_no_of_second_degree'),
                'total_no_of_3rd_degree' => $this->input->post('total_no_of_third_degree'),
                'unknown_reason_is_adopted' => $this->input->post('unknown_reason_is_adopted'),
                'unknown_reason_in_other_countries' => $this->input->post('unknown_reason_in_other_countries')
                     );
                     //print_r($data_patient_relatives_summary);
            $patient_relatives_summary_id = $this->record_model->insert_patient_relatives_summary($data_patient_relatives_summary);
            if ($patient_relatives_summary_id > 0) {
                echo "<h2>Data Added successfully at patient_relatives_summary table</h2>";
            } else {
                echo "<h2>Failed to insert at patient_relatives_summary table</h2>";
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
        $this->form_validation->set_rules('mother_fullname', 'Full name', 'required|xss_clean');
        if ($this->form_validation->run() == true) {

            $father_cancer_name = $this->input->post('father_cancer_name');
            $father_cancer_type_id = $this->record_model->get_cancer_id($father_cancer_name);
            $data1_patient_relatives = array(
                'patient_ic_no' => $this->input->post('IC_no'),
                'relatives_id' => 1,
                'family_no' => $this->input->post('family_no'),
                'full_name' => $this->input->post('father_fullname'),
                'sur_name' => $this->input->post('father_surname'),
                'maiden_name' => $this->input->post('father_maiden_name'),
                'ethnicity' => $this->input->post('father_ethncity'),
                'town_of_residence' => $this->input->post('father_town_residence'),
                'd_o_b' => $this->input->post('father_DOB'),
                'is_alive_flag' => $this->input->post('father_still_alive_flag'),
                'd_o_d' => $this->input->post('father_DOD'),
                'is_cancer_diagnosed' => $this->input->post('father_is_cancer_diagnosed'),
                'date_of_diagnosis' => $this->input->post('father_date_of_diagnosis'),
                'cancer_type_id' => $father_cancer_type_id,
                'age_of_diagnosis' => $this->input->post('father_age_of_diagnosis'),
                'other_detail' => $this->input->post('father_diagnosis_other_details'),
                'no_of_brothers' => $this->input->post('father_no_of_brothers'),
                'no_of_sisters' => $this->input->post('father_no_of_sisters'),
                'vital_status' => $this->input->post('father_vital_status'),
                'match_score_at_consent' => $this->input->post('father_mach_score_at_consent'),
                'match_score_past_consent' => $this->input->post('father_mach_score_past_consent'),
                'fh_category' => $this->input->post('father_FH_category')
            );


            $mother_cancer_name = $this->input->post('mother_cancer_name');
            $mother_cancer_type_id = $this->record_model->get_cancer_id($mother_cancer_name);
            $data2_patient_relatives = array(
                'patient_ic_no' => $this->input->post('IC_no'),
                'relatives_id' => 2,
                'family_no' => $this->input->post('family_no'),
                'full_name' => $this->input->post('mother_fullname'),
                'sur_name' => $this->input->post('mother_surname'),
                'maiden_name' => $this->input->post('mother_maiden_name'),
                'ethnicity' => $this->input->post('mother_ethncity'),
                'town_of_residence' => $this->input->post('mother_town_residence'),
                'd_o_b' => $this->input->post('mother_DOB'),
                'is_alive_flag' => $this->input->post('mother_still_alive_flag'),
                'd_o_d' => $this->input->post('mother_DOD'),
                'is_cancer_diagnosed' => $this->input->post('mother_is_cancer_diagnosed'),
                'date_of_diagnosis' => $this->input->post('mother_date_of_diagnosis'),
                'cancer_type_id' => $mother_cancer_type_id,
                'age_of_diagnosis' => $this->input->post('mother_age_of_diagnosis'),
                'other_detail' => $this->input->post('mother_diagnosis_other_details'),
                'no_of_brothers' => $this->input->post('mother_no_of_brothers'),
                'no_of_sisters' => $this->input->post('mother_no_of_sisters'),
                'vital_status' => $this->input->post('mother_vital_status'),
                'match_score_at_consent' => $this->input->post('mother_mach_score_at_consent'),
                'match_score_past_consent' => $this->input->post('mother_mach_score_past_consent'),
                'fh_category' => $this->input->post('mother_FH_category')
            );
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
        } else {
            print_r(validation_errors());
        }
    }

    function patient_record_view($ic_no) {

        $this->load->model('Record_model');
        $data = $this->Record_model->general();
        $data['patient_detail'] = $a = $this->record_model->get_patient_record($ic_no);

        $this->template->load("templates/report_home_template", 'record/view_record_personal_details', $data);
    }

    function record_list() {

        $this->load->view('record/record_list');
    }

    function patient_record_list() {

        $this->load->model('Record_model');
        $data = $this->Record_model->general();
        $data['patient_list'] = $this->record_model->get_list_patient_record();

        $this->template->load("templates/report_home_template", 'record/list_record_personal_details', $data);
    }

    public function studies_set_one_insertion() {
        //echo '<h1>Helllooo</h1>';
        //$this->form_validation->set_rules('mother_fullname', 'Full name', 'required|xss_clean');
        //if ($this->form_validation->run() == true)  {

        $studies_name = $this->input->post('studies_name');
        $studies_id = $this->excell_sheets_model->get_patient_studies_id($studies_name);
        $relations_to_study = $this->input->post('relations_to_study');

        if ($relations_to_study == 'Yes' || $relations_to_study == 'yes')
            $relations_to_study_flag = TRUE;
        else if ($relations_to_study == 'No' || $relations_to_study == 'no')
            $relations_to_study_flag = FALSE;
        else
            $relations_to_study_flag = FALSE;


        $data_patient_studies = array(
            'patient_ic_no' => $this->input->post('IC_no'),
            'studies_id' => $studies_id,
            'date_at_consent' => $this->input->post('date_at_consent'),
            'age_at_consent' => $this->input->post('age_at_consent'),
            'double_consent_flag' => $this->input->post('is_double_consent_flag'),
            'double_consent_detail' => $this->input->post('double_consent_detail'),
            'consent_given_by' => $this->input->post('consent_given_by'),
            'consent_response' => $this->input->post('consent_response'),
            'consent_version' => $this->input->post('consent_version'),
            'relation_to_study_flag' => $relations_to_study_flag,
            'referral_to' => $this->input->post('referral_to'),
            'referral_to_service' => $this->input->post('referral_to_service'),
            'referral_date' => $this->input->post('referral_date'),
            'referral_source' => $this->input->post('referral_source')
        );
        echo '<pre>';
        //print_r($data_patient_studies);
        echo '<br/>';
        $patient_studies_id = $this->record_model->insert_patient_studies_record($data_patient_studies);
        if ($patient_studies_id > 0) {
            echo "Data Added successfully at patient_studies";
        } else {
            echo "Failed to insert at patient_studies";
        } echo '<br/>';


        $data_patient_breast_screening = array(
            'patient_ic_no' => $this->input->post('IC_no'),
            'year_of_first_mammogram' => $this->input->post('year_of_first_mammogram'),
            'age_of_first_mammogram' => $this->input->post('age_of_first_mammogram'),
            'date_of_recent_mammogram' => $this->input->post('date_of_recent_mammogram'),
            'screening_centre' => $this->input->post('screening_center'),
            'action_suggested_on_memo_report' => $this->input->post('action_suggested_on_memo_report'),
            'total_no_of_mammogram' => $this->input->post('total_no_of_mammogram'),
            'screening_interval' => $this->input->post('screening_interval'),
            'abnormality_mammo_flag' => $this->input->post('abnormality_mammo_flag'),
            'mammo_abnormality_details' => $this->input->post('mammo_breast_other_descriptions'),
            'name_of_radiologist' => $this->input->post('name_of_radiologist'),
            'had_ultrasound_flag' => $this->input->post('had_ultrasound_flag'), //from Ultrasound Details part
            'total_no_of_ultrasound' => $this->input->post('total_no_of_ultrasound'),
            'abnormality_ultrasound_flag' => $this->input->post('abnormality_ultrasound_flag'),
            'had_mri_flag' => $this->input->post('had_mri_flag'), // from MRI Details part
            'total_no_of_mri' => $this->input->post('total_no_of_mri'),
            'had_surgery_for_benign_lump_or_cyst_flag' => $this->input->post('had_surgery_for_benign_lump_or_cyst_flag'),
            'mammo_benign_lump_cyst_details' => $this->input->post('mammo_benign_lump_cyst_details'),
            'other_screening_flag' => $this->input->post('other_screening_flag'),
            'patient_studies_id' => $patient_studies_id,
            'BIRADS_clinical_classification' => $this->input->post('BIRADS_clinical_classification'),
            'BIRADS_density_classification' => $this->input->post('BIRADS_density_classification')
        );

        //print_r($data_patient_breast_screening);
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
            'description' => $this->input->post('mammo_breast_other_descriptions'),
            'left_breast' => $left_breast,
            'right_breast' => $right_breast,
            'upper' => $upper,
            'below' => $below,
            'percentage_of_mammo_density' => $this->input->post('percentage_of_mammo_density')
        );
        //print_r($data_patient_breast_abnormality);
        echo '<br/>';
        $patient_breast_abnormality_id = $this->record_model->insert_at_patient_breast_abnormality($data_patient_breast_abnormality);
        if ($patient_breast_abnormality_id > 0) {
            echo "Data Added successfully at patient_breast_abnormality";
        } else {
            echo "Failed to insert at patient_breast_abnormality";
        } echo '<br/>';

        $data_patient_ultrasound_abnormality = array(
            'details' => $this->input->post('mammo_ultrasound_details'),
            'patient_breast_screening_id' => $patient_breast_screening_id
        );
        //print_r($data_patient_ultrasound_abnormality);
        echo '<br/>';
        $patient_ultrasound_abnormality_id = $this->record_model->insert_patient_ultrasound_abnormality($data_patient_ultrasound_abnormality);
        if ($patient_ultrasound_abnormality_id > 0) {
            echo "Data Added successfully at patient_ultrasound_abnormality";
        } else {
            echo "Failed to insert at patient_ultrasound_abnormality";
        } echo '<br/>';

        $data_patient_mri_abnormality = array(
            'detail' => $this->input->post('mammo_MRI_details'),
            'patient_breast_screening_id' => $patient_breast_screening_id
        );
        //print_r($data_patient_mri_abnormality);
        echo '<br/>';
        $patient_patient_mri_abnormality_id = $this->record_model->insert_patient_mri_abnormality($data_patient_mri_abnormality);
        if ($patient_patient_mri_abnormality_id > 0) {
            echo "Data Added successfully at patient_mri_abnormality";
        } else {
            echo "Failed to insert at patient_mri_abnormality";
        } echo '<br/>';
  

        $data_patient_other_screening = array(
            'screening_name' => $this->input->post('screening_name'),
            'total_no_of_screening' => $this->input->post('total_no_of_screening'),
            'age_at_screening' => $this->input->post('age_at_screening'),
            'place_of_screening' => $this->input->post('place_of_screening'),
            'screening_result' => $this->input->post('screening_results'),
            'patient_breast_screening_id' => $patient_breast_screening_id
        );

        //print_r($data_patient_other_screening);
        echo '<br/>';
        $patient_other_screening_id = $this->record_model->insert_patient_other_screening($data_patient_other_screening);
        if ($patient_other_screening_id > 0) {
            echo "Data Added successfully at patient_other_screening";
        } else {
            echo "Failed to insert at patient_other_screening";
        } echo '<br/>';

        
        $patient_cancer_name = $this->input->post('patient_cancer_name');
        $cancer_id = $this->record_model->get_cancer_id($patient_cancer_name);
        $data_patient_cancer = array(
            'patient_ic_no' => $this->input->post('IC_no'),
            'patient_studies_id' => $patient_studies_id,
            'breast_cancer_diagnosed_flag' => $this->input->post('breast_cancer_diagnosed_flag'),
            'cancer_id' => $cancer_id,
            'age_of_diagnosis' => $this->input->post('age_of_diagnosis'),
            'date_of_diagnosis' => $this->input->post('date_of_diagnosis'),
            'diagnosis_center' => $this->input->post('cancer_diagnosis_center'),
            'doctor_name' => $this->input->post('cancer_doctor_name'),
            'detected_by' => $this->input->post('detected_by'),
            'recurrence_flag' => $this->input->post('is_recurrence_flag'),
            'recurrence_site' => $this->input->post('recurrence_site'),
            'recurrence_date' => $this->input->post('recurrence_date'),
            'is_primary' => $this->input->post('primary_diagnosis')
        );
        //print_r($data_patient_cancer);
        echo '<br/>';
        $patient_cancer_id = $this->record_model->insert_patient_cancer($data_patient_cancer);
        if ($patient_cancer_id > 0) {
            echo "Data Added successfully at patient_cancer";
        } else {
            echo "Failed to insert at patient_cancer";
        } echo '<br/>';


        $cancer_site = $this->input->post('cancer_site'); //will give cancer_site_id
        $cancer_site_id = $this->record_model->get_cancer_site_id($cancer_site);

        $data_patient_cancer_site = array(
            'patient_cancer_id' => $patient_cancer_id,
            'cancer_site_id' => $cancer_site_id,
            'site_details' => $this->input->post('cancer_site_details')
        );
        // print_r($data_patient_cancer_site);
        echo '<br/>';
        $patient_cancer_site_id = $this->record_model->insert_patient_cancer_site($data_patient_cancer_site);
        if ($patient_cancer_site_id > 0) {
            echo "Data Added successfully at patient_cancer_site";
        } else {
            echo "Failed to insert at patient_cancer_site";
        } echo '<br/>';
        //after inserting at patient_cancer_site table we will get patient_cancer_site_id

        $patient_cancer_treatment_name = $this->input->post('patient_cancer_treatment_name'); //by this we will get treatment_id
        $treatment_id = $this->record_model->get_treatment_id($patient_cancer_treatment_name);
        $data_patient_cancer_treatment = array(
            'treatment_id' => $treatment_id,
            'patient_cancer_id' => $patient_cancer_id,
            'treatment_start_date' => $this->input->post('treatment_start_date'),
            'treatment_end_date' => $this->input->post('treatment_end_date'),
            'treatment_drug_dose' => $this->input->post('treatment_drug_dose'),
        );
        //after inserting  data_patient_cancer_treatment we will get patient_cancer_treatment_id
        // print_r($data_patient_cancer_treatment);
        echo '<br/>';
        $patient_cancer_treatment_id = $this->record_model->insert_patient_cancer_treatment($data_patient_cancer_treatment);
        if ($patient_cancer_treatment_id > 0) {
            echo "Data Added successfully at patient_cancer_treatment";
        } else {
            echo "Failed to insert at patient_cancer_treatment";
        } echo '<br/>';

        $patient_cancer_recurrence_treatment_name = $this->input->post('patient_cancer_recurrence_treatment_name'); //where to insert this value
        $treatment_id_recurrent = $this->record_model->get_treatment_id($patient_cancer_recurrence_treatment_name);
        $data_patient_cancer_recurrent = array(
            'treatment_id' => $treatment_id_recurrent,
            'patient_cancer_id' => $patient_cancer_id
        );
        // print_r($data_patient_cancer_recurrent);
        echo '<br/>';
        $patient_cancer_recurrent_id = $this->record_model->insert_patient_cancer_recurrent($data_patient_cancer_recurrent);
        if ($patient_cancer_recurrent_id > 0) {
            echo "Data Added successfully at patient_cancer_recurrent";
        } else {
            echo "Failed to insert at patient_cancer_recurrent";
        } echo '<br/>';
        //after inserting  data_patient_cancer_recurrent we will get patient_cancer_recurrent_id


        $diagnosis_name = $this->input->post('diagnosis_name');
        $diagnosis_id = $this->record_model->get_diagnosis_id($diagnosis_name);
        $data_patient_diagnosis = array(
            'patient_ic_no' => $this->input->post('IC_no'),
            'patient_studies_id' => $patient_studies_id,
            'diagnosis_id' => $diagnosis_id,
            'diagnosis_age' => $this->input->post('diagnosis_age'),
            'year_of_diagnosis' => $this->input->post('year_of_diagnosis'),
            'on_medication_flag' => $this->input->post('is_on_medication_flag'),
            'medication_details' => $this->input->post('medication_details'),
            'diagnosis_center' => $this->input->post('diagnosis_center'),
            'doctor_name' => $this->input->post('diagnosis_doctor_name'),
            'diagnosis_details' => $this->input->post('diagnosis_details')
        );
        // print_r($data_patient_diagnosis);
        echo '<br/>';
        $patient_diagnosis_id = $this->record_model->insert_patient_diagnosis($data_patient_diagnosis);
        if ($patient_diagnosis_id > 0) {
            echo "Data Added successfully at patient_diagnosis";
        } else {
            echo "Failed to insert at patient_diagnosis";
        } echo '<br/>';

        $data_patient_pathology = array(
            'patient_ic_no' => $this->input->post('IC_no'),
            'patient_studies_id' => $patient_studies_id,
            'tissue_site' => $this->input->post('pathology_tissue_site'),
            'tissue_tumour_stages' => $this->input->post('pathology_tissue_tumour_stage'),
            'morphology' => $this->input->post('pathology_morphology'),
            'node_stage' => $this->input->post('pathology_node_stage'),
            'lymph_node' => $this->input->post('pathology_lymph_node'),
            'total_lymph_nodes' => $this->input->post('pathology_total_lymph_nodes'),
            'er_status' => $this->input->post('pathology_ER_status'),
            'pr_status' => $this->input->post('pathology_PR_status'),
            'her2_status' => $this->input->post('pathology_HER2_status'),
            'number_of_tumers' => $this->input->post('pathology_number_of_tumours'),
            'metastasis_stage' => $this->input->post('pathology_metastasis_stage'),
            'side_affected' => $this->input->post('pathology_side_affected'),
            'tumour_stage' => $this->input->post('pathology_tumour_stage'),
            'tumour_grade' => $this->input->post('pathology_tumour_grade'),
            'size' => $this->input->post('pathology_tumour_size'),
            'path_doc' => $this->input->post('pathology_doctor'),
            'path_lab' => $this->input->post('pathology_lab'),
            'lab_reference' => $this->input->post('pathology_lab_reference'),
            'path_report_date' => $this->input->post('pathology_path_report_date'),
            'type_of_report' => $this->input->post('pathology_path_report_type'),
            'path_report_requested_date' => $this->input->post('pathology_report_requested_date'),
            'path_report_received_date' => $this->input->post('pathology_path_report_received_date'),
            'path_block_requested_date' => $this->input->post('pathology_path_block_requested_date'),
            'path_block_received_date' => $this->input->post('pathology_path_block_received_date'),
            'tissue_path_comment' => $this->input->post('pathology_tissue_path_comments'),
        );

        // print_r($data_patient_pathology);
        echo '<br/>';
        $patient_pathology_id = $this->record_model->insert_patient_pathology($data_patient_pathology);
        if ($patient_pathology_id > 0) {
            echo "Data Added successfully at patient_pathology";
        } else {
            echo "Failed to insert at patient_pathology";
        } echo '<br/>';
    }

    function lifestyle_insertion() {

        //need to calculate $patient_studies_id by using study name-->studies_id and patient_ic_no
        $studies_name = $this->input->post('studies_name');
        $studies_id = $this->excell_sheets_model->get_patient_studies_id($studies_name);
        $data_keys = array(
            'patient_ic_no' => $this->input->post('IC_no'),
            'studies_id' => $studies_id
        );
        echo '<pre>';
        //print_r($data_keys);echo '<br/>';
        $patient_studies_id = $this->record_model->get_patient_suudies_id($data_keys);
        //echo $patient_studies_id;
        //echo '<br/>';

        $data_patient_lifestyle_factors = array(
            'patient_ic_no' => $this->input->post('IC_no'),
            'patient_studies_id' => $patient_studies_id,
            'self_image_at_7years' => $this->input->post('self_image_at_7years'),
            'self_image_at_18years' => $this->input->post('self_image_at_18years'),
            'self_image_now' => $this->input->post('self_image_now'),
            'pa_sports_activitiy_childhood' => $this->input->post('pa_at_childhood'),
            'pa_sports_activitiy_adult' => $this->input->post('pa_at_adulthood'),
            'pa_sports_activitiy_now' => $this->input->post('pa_now'),
            'cigarrets_smoked_flag' => $this->input->post('cigarettes_smoked_flag'),
            'cigarrets_still_smoked_flag' => $this->input->post('cigarettes_still_smoked_flag'),
            'total_smoked_years' => $this->input->post('total_smoked_years'),
            'cigarrets_count_at_teen' => $this->input->post('cigarettes_count_at_teen'),
            'cigarrets_count_at_twenties' => $this->input->post('cigarettes_count_at_twenties'),
            'cigarrets_count_at_thirties' => $this->input->post('cigarettes_count_at_thirties'),
            'cigarrets_count_at_fourrties' => $this->input->post('cigarettes_count_at_forties'),
            'cigarrets_count_at_fifties' => $this->input->post('cigarettes_count_at_fifties'),
            'cigarrets_count_at_sixties_and_above' => $this->input->post('cigarrets_count_at_sixties_and_above'),
            'cigarrets_count_one_year_before_diagnosed' => $this->input->post('cigarettes_count_one_year_before_diagnosed'),
            'alcohol_drunk_flag' => $this->input->post('alcohol_drunk_flag'),
            'alcohol_average' => $this->input->post('alcohol_average'),
            'alcohol_average_details' => $this->input->post('alcohol_average_details'),
            'coffee_drunk_flag' => $this->input->post('coffee_drunk_flag'),
            'coffee_age' => $this->input->post('coffee_age'),
            'coffee_average' => $this->input->post('coffee_average'),
            'tea_drunk_flag' => $this->input->post('tea_drunk_flag'),
            'tea_age' => $this->input->post('tea_age'),
            'tea_average' => $this->input->post('tea_average'),
            'tea_type' => $this->input->post('tea_type'),
            'soya_bean_drunk_flag' => $this->input->post('soya_bean_drunk_flag'),
            'soya_bean_average' => $this->input->post('soya_bean_average'),
            'soya_products_flag' => $this->input->post('soya_products_flag'),
            'soya_products_average' => $this->input->post('soya_products_average'),
            'diabetes_flag' => $this->input->post('diabetes_flag'),
            'medicine_for_diabetes_flag' => $this->input->post('medicine_for_diabetes_flag'),
            'diabetes_medicine_name' => $this->input->post('diabates_medicine_name')
        );
        //print_r($data_patient_lifestyle_factors);
        //echo '<br/>';

        $patient_lifestyle_factors_id = $this->record_model->insert_patient_lifestyle_factors($data_patient_lifestyle_factors);
        if ($patient_lifestyle_factors_id > 0) {
            echo "<h2>Data Added successfully at patient_lifestyle_factors</h2>";
        } else {
            echo "<h2>Failed to insert at patient_lifestyle_factors</h2>";
        }
        echo '<br/>';

        $data_patient_menstruation = array(
            'patient_studies_id' => $patient_studies_id,
            'age_period_starts' => $this->input->post('age_period_starts'),
            'still_period_flag' => $this->input->post('still_period_flag'),
            'period_type' => $this->input->post('period_type'),
            'period_cycle_days' => $this->input->post('period_cycle_days'),
            'period_cycle_days_other_details' => $this->input->post('period_cycle_days_other_details'),
            'age_period_stops' => $this->input->post('age_period_stops'),
            'date_period_stops' => $this->input->post('date_period_stops'),
            'reason_period_stops' => $this->input->post('reason_period_stops'),
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
            'patient_ic_no' => $this->input->post('IC_no'),
            'patient_studies_id' => $patient_studies_id,
            'pregnent_flag' => $this->input->post('pregnent_flag')
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

        $data_patient_parity_record = array(
            'patient_parity_table_id' => $patient_parity_table_id,
            'pregnancy_type' => $this->input->post('pregnancy_type'),
            'gender' => $this->input->post('child_gender'),
            'birthyear' => $this->input->post('child_birthyear'),
            'birthweight' => $this->input->post('child_birthweight'),
            'breastfeeding_duration' => $this->input->post('child_breastfeeding_duration')
        );
        //print_r($data_patient_parity_record);
        //echo '<br/>';

        $patient_parity_record_id = $this->record_model->insert_patient_parity_record($data_patient_parity_record);
        if ($patient_parity_record_id > 0) {
            echo "<h2>Data Added successfully at patient_parity_record</h2>";
        } else {
            echo "<h2>Failed to insert at patient_parity_record</h2>";
        }
        echo '<br/>';

        $data_patient_infertility = array(
            'patient_studies_id' => $patient_studies_id,
            'infertility_testing_flag' => $this->input->post('infertility_testing_flag'),
            'infertility_treatment_details' => $this->input->post('infertility_treatment_details'),
            'contraceptive_pills_flag' => $this->input->post('contraceptive_pills_flag'),
            'contraceptive_pills_details' => $this->input->post('contraceptive_pills_details'),
            'currently_taking_contraceptive_pills_flag' => $this->input->post('currently_taking_contraceptive_pills_flag'),
            'contraceptive_start_date' => $this->input->post('contraceptive_start_date'),
            'contraceptive_end_date' => $this->input->post('contraceptive_end_date'),
            'hrt_flag' => $this->input->post('HRT_flag'),
            'hrt_details' => $this->input->post('HRT_details'),
            'currently_using_hrt_flag' => $this->input->post('currently_using_hrt_flag'),
            'hrt_start_date' => $this->input->post('hrt_start_date'),
            'hrt_end_date' => $this->input->post('hrt_end_date')
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
            'patient_ic_no' => $this->input->post('IC_no'),
            'patient_studies_id' => $patient_studies_id,
            'had_gnc_surgery_flag' => $this->input->post('had_gnc_surgery_flag'),
            'surgery_year' => $this->input->post('gnc_surgery_year'),
            'treatment_id' => $treatment_id,
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
    }

    function investigation_insertion() {

        $config['upload_path'] = './images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '100000';
        //$config['max_width']  = '1024';
        //$config['max_height']  = '768';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
            //echo '<h3>Your file was successfully uploaded!</h3>';
            //echo $data['upload_data']['full_path'];
            $attach_file_path = $data['upload_data']['full_path'];
            //echo $attach_file_path;
            // echo '<br/>';
        }


        $studies_name = $this->input->post('studies_name');
        $studies_id = $this->excell_sheets_model->get_patient_studies_id($studies_name);
        $data_keys = array(
            'patient_ic_no' => $this->input->post('IC_no'),
            'studies_id' => $studies_id
        );
        //echo '<pre>';
        //print_r($data_keys);echo '<br/>';
        $patient_studies_id = $this->record_model->get_patient_suudies_id($data_keys);
        //echo $patient_studies_id;echo '<br/>';
        $data_patient_investigations = array(
            'patient_ic_no' => $this->input->post('IC_no'),
            'patient_studies_id' => $patient_studies_id,
            'date_test_ordered' => $this->input->post('date_test_ordered'),
            'ordered_by' => $this->input->post('test_ordered_by'),
            'testing_result_notification_flag' => $this->input->post('testing_results_notification_flag'),
            'project_name' => $this->input->post('investigation_project_name'),
            'project_batch' => $this->input->post('investigation_project_batch'),
            'test_type' => $this->input->post('investigation_test_type'),
            'type_of_sample' => $this->input->post('investigation_sample_type'),
            'reasons' => $this->input->post('investigation_test_reason'),
            'new_mutation_flag' => $this->input->post('investigation_new_mutation_flag'),
            'test_result' => $this->input->post('investigation_test_results'),
            'investigation_test_results_other_details' => $this->input->post('$investigation_test_results_other_details'),
            'carrier_status' => $this->input->post('investigation_carrier_status'),
            'mutation_nomenclature' => $this->input->post('investigation_mutation_nomenclature'),
            'reported_by' => $this->input->post('investigation_reported_by'),
            'mutation_type' => $this->input->post('investigation_mutation_type'),
            'mutation_pathogenicity' => $this->input->post('investigation_mutation_pathogenicity'),
            'sample_id' => $this->input->post('investigation_sample_ID'),
            'report_due' => $this->input->post('investigation_report_due'),
            'report_date' => $this->input->post('investigation_report_date'),
            'date_modified' => $this->input->post('investigation_date_notified'),
            'test_comment' => $this->input->post('investigation_test_comment'),
            'conformation_attachment' => $this->input->post('investigation_conformation_attachment'),
            'conformation_file_url' => $attach_file_path
        );

        //echo '<pre>';
        // print_r($data_patient_investigations);echo '<br/>';
        //array_push($data, $this->input->post('firstname'));
        $patient_investigations_id = $this->record_model->insert_patient_investigations($data_patient_investigations);
        if ($patient_investigations_id > 0) {
            echo "<h2>Data Added successfully at patient_investigations</h2>";
        } else {
            echo "<h2>Failed to insert at patient_investigations</h2>";
        }
        echo '<br/>';
    }

    public function surveillance_insertion() {

        $studies_name = $this->input->post('studies_name');
        $studies_id = $this->excell_sheets_model->get_patient_studies_id($studies_name);
        $data_keys = array(
            'patient_ic_no' => $this->input->post('IC_no'),
            'studies_id' => $studies_id
        );
        //echo '<pre>';
        //print_r($data_keys);echo '<br/>';
        $patient_studies_id = $this->record_model->get_patient_suudies_id($data_keys);
        //echo $patient_studies_id;echo '<br/>';

        $data_patient_surveillance = array(
            'patient_ic_no' => $this->input->post('IC_no'),
            'patient_studies_id' => $patient_studies_id,
            'recruitment_center' => $this->input->post('surveillance_recruitment_center'),
            'type' => $this->input->post('surveillance_type'),
            'first_consultation_date' => $this->input->post('surveillance_first_consultation_date'),
            'first_consultation_place' => $this->input->post('surveillance_first_consultation_place'),
            'interval' => $this->input->post('surveillance_interval'),
            'diagnosis' => $this->input->post('surveillance_diagnosis'),
            'due_date' => $this->input->post('surveillance_due_date'),
            'reminder_sent_date' => $this->input->post('surveillance_reminder_sent_date'),
            'surveillance_done_date' => $this->input->post('surveillance_done_date'),
            'reminded_by' => $this->input->post('surveillance_reminded_by'),
            'timing' => $this->input->post('surveillance_timing'),
            'symptoms' => $this->input->post('surveillance_symptoms'),
            'doctor_name' => $this->input->post('surveillance_doctor_name'),
            'surveillance_done_place' => $this->input->post('surveillance_place'),
            'outcome' => $this->input->post('surveillance_outcome'),
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

    public function interview_home_insersion() {
        $data_patient_interview_manager = array(
            'patient_ic_no' => $this->input->post('IC_no'),
            'interview_date' => $this->input->post('interview_date'),
            'next_interview_date' => $this->input->post('interview_next_date'),
            'is_send_email_reminder_to_officers' => $this->input->post('is_send_email_reminder'),
            'officer_email_addresses' => $this->input->post('officer_email_addresses'),
            'comments' => $this->input->post('interview_note')
        );
        $patient_interview_manager_id = $this->record_model->insert_patient_interview_manager($data_patient_interview_manager);
        if ($patient_interview_manager_id > 0) {
            echo "<h2>Data Added successfully at patient_interview_manager</h2>";
        } else {
            echo "<h2>Failed to insert patient_interview_manager</h2>";
        }
        echo '<br/>';
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
            echo $temp;
            //print_r($data);
            //redirect('excell_parser/test/',$temp);
            $this->excell_parser_model->excell_file_parser($temp);
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

}