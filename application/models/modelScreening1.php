<?php
class ModelScreening1 extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->library("template");
        $this->load->helper('url');

        // Load MongoDB library instead of native db driver if required
        $this->config->item('use_mongodb', 'ion_auth') ?
                        $this->load->library('mongo_db') :
                        $this->load->database();

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->helper('language');
        $this->load->model('excell_sheets_model');
        $this->load->model('record_model');
        $this->load->model('model_Validator');
        //Loading PHPExcell Library
        $this->load->library('PHPExcel');
    }
    
     public function Screening1($sheet) 
     {
        $created_date = date('Y-m-d H:i:s');
        $abort = FALSE;
        $data_patient_breast_screening = array();
        $data_patient_breast_screening = null;
        $data_patient_breast_screening_update = array();
        $data_patient_breast_screening_update = null;
        $data_patient_breast_abnormality = array();
        $data_patient_breast_abnormality = null;
        $data_patient_breast_abnormality_update = array();
        $data_patient_breast_abnormality_update = null;
        $data_patient_ultrasound_abnormality = array();
        $data_patient_ultrasound_abnormality = null;
        $data_patient_ultrasound_abnormality_update = array();
        $data_patient_ultrasound_abnormality_update = null;
        $data_patient_mri_abnormality = array();
        $data_patient_mri_abnormality = null;
        $data_patient_mri_abnormality_update = array();
        $data_patient_mri_abnormality_update = null;
        $temp_pt_ic_no_pt_breast_screening = array();
        $temp_pt_ic_no_pt_breast_screening = null;
        $this->db->select('patient_ic_no');
        $this->db->from('patient_breast_screening');
        $temp_pt_ic_no_pt_breast_screening = $this->db->get()->result_array();
        
                    //print_r($temp_pt_risk_reduc_surgery_id_pt_risk_red_surgery_lesion);
        $result_pt_ic_no_pt_breast_screening = array();
        for ($i = 0; $i < sizeof($temp_pt_ic_no_pt_breast_screening); $i++) {
            $result_pt_ic_no_pt_breast_screening [$i] = $temp_pt_ic_no_pt_breast_screening[$i]['patient_ic_no'];
        }
        $temp_pt_ic_no_pt_breast_screening = null;
        
        $temp_pt_studies_id_pt_breast_screening = array();
        $temp_pt_studies_id_pt_breast_screening = null;
        $this->db->select('patient_studies_id');
        $this->db->from('patient_breast_screening');
        $temp_pt_studies_id_pt_breast_screening = $this->db->get()->result_array();

        //print_r($temp_pt_risk_reduc_surgery_id_pt_risk_red_surgery_lesion);
        $result_pt_studies_id_pt_breast_screening = array();
        for ($i = 0; $i < sizeof($temp_pt_studies_id_pt_breast_screening); $i++) {
            $result_pt_studies_id_pt_breast_screening [$i] = $temp_pt_studies_id_pt_breast_screening[$i]['patient_studies_id'];
        }
        $temp_pt_studies_id_pt_breast_screening = null;
        
        $temp_pt_brst_scrning_id_pt_bst_abn = array();
        $temp_pt_brst_scrning_id_pt_bst_abn = null;
        $this->db->select('patient_breast_screening_id');
        $this->db->from('patient_breast_abnormality');
        $temp_pt_brst_scrning_id_pt_bst_abn = $this->db->get()->result_array();

        //print_r($temp_pt_risk_reduc_surgery_id_pt_risk_red_surgery_lesion);
        $result_pt_brst_scrning_id_pt_bst_abn = array();
        for ($i = 0; $i < sizeof($temp_pt_brst_scrning_id_pt_bst_abn); $i++) {
            $result_pt_brst_scrning_id_pt_bst_abn [$i] = $temp_pt_brst_scrning_id_pt_bst_abn[$i]['patient_breast_screening_id'];
        }
        $temp_pt_brst_scrning_id_pt_bst_abn = null;
        
        $temp_pt_brst_scrning_id_pt_ultrad_abn = array();
        $temp_pt_brst_scrning_id_pt_ultrad_abn = null;
        $this->db->select('patient_breast_screening_id');
        $this->db->from('patient_ultrasound_abnormality');
        $temp_pt_brst_scrning_id_pt_ultrad_abn = $this->db->get()->result_array();

        //print_r($temp_pt_risk_reduc_surgery_id_pt_risk_red_surgery_lesion);
        $result_pt_brst_scrning_id_pt_ultrad_abn = array();
        for ($i = 0; $i < sizeof($temp_pt_brst_scrning_id_pt_ultrad_abn); $i++) {
            $result_pt_brst_scrning_id_pt_ultrad_abn [$i] = $temp_pt_brst_scrning_id_pt_ultrad_abn[$i]['patient_breast_screening_id'];
        }
        $temp_pt_brst_scrning_id_pt_ultrad_abn = null;
        
        //print_r($result_pt_brst_scrning_id_pt_ultrad_abn);
        $temp_pt_brst_scrning_id_pt_mri_abn = array();
        $temp_pt_brst_scrning_id_pt_mri_abn = null;
        $this->db->select('patient_breast_screening_id');
        $this->db->from('patient_mri_abnormality');
        $temp_pt_brst_scrning_id_pt_mri_abn = $this->db->get()->result_array();

        //print_r($temp_pt_risk_reduc_surgery_id_pt_risk_red_surgery_lesion);
        $result_pt_brst_scrning_id_pt_mri_abn = array();
        for ($i = 0; $i < sizeof($temp_pt_brst_scrning_id_pt_mri_abn); $i++) {
            $result_pt_brst_scrning_id_pt_mri_abn [$i] = $temp_pt_brst_scrning_id_pt_mri_abn[$i]['patient_breast_screening_id'];
        }
        $temp_pt_brst_scrning_id_pt_mri_abn = null;
        
        $temp_patient_ic_no_survelance = array();
        $temp_patient_ic_no_survelance = null;
        $temp_patient_studies_id = array();
        $temp_patient_studies_id = null;
        $temp4 = array();
        $i = 0;
        foreach ($sheet->getRowIterator() as $row) {
            $i++;

            if ($i == 1)//ommiting cell header name
                continue;

            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            
            $temp4 = null;
            foreach ($cellIterator as $key => $cell) {

                $cell_value = $cell->getFormattedValue();

                if ($key == 0 && $cell_value != NULL)
                    $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
                
                 if ($key == 1 && $cell_value != NULL)
                    $cell_value = trim($cell_value);
                 
                 if (($key == 2 || $key == 4 || $key == 21 || $key == 27) && $cell_value != NULL) {
                                /*if (strpos($cell_value, '-') !== FALSE)
                                    $cell_value = date("d/m/Y", strtotime($cell_value));
                                list($day, $month, $year) = explode("/", $cell_value);

                                if (!checkdate($month, $day, $year)) {
                                    if($key == 2)
                                    {
                                         $this->model_Validator->showMessage("date_of_first_mammogram","Surveilance1",$i);
                                    }
                                    
                                    if($key == 4)
                                    {
                                         $this->model_Validator->showMessage("date_of_recent_mammogram","Surveilance1",$i);
                                    }
                                    
                                    if($key == 21)
                                    {
                                         $this->model_Validator->showMessage("ultrasound_date","Surveilance1",$i);
                                    }
                                    
                                    if($key == 27)
                                    {
                                         $this->model_Validator->showMessage("MRI_date","Surveilance1",$i);
                                    }
                                    
                                    $abort = TRUE;
                                    break;
                                }
                                $cell_value = date('Y-m-d', strtotime(str_replace('/', '-', $cell_value)));*/
                                //$cell_value = preg_replace("/[^0-9\/]/", "", $cell_value);
                                if($cell_value == "")
                                    $cell_value = '0000-00-00';
                                else
                                $cell_value == '0000-00-00' ? "0000-00-00" :  date('Y-m-d', strtotime(str_replace('/', '-', $cell_value)));
                            }
                //echo $key; // 0, 1, 2..      
                
                $temp4[] = $cell_value;
            }
                if($abort)
                break;
            
                if(strpos(strtoupper($temp4[mammo_abnormality_flag]), 'Y') !== false)
                $abnormality_mammo_flag = TRUE;
                else if(strpos(strtoupper($temp4[mammo_abnormality_flag]), 'N') !== false)
                    $abnormality_mammo_flag = FALSE;
                else
                    $abnormality_mammo_flag = FALSE;

                if(strpos(strtoupper($temp4[had_ultrasound_flag]), 'Y') !== false)
                    $had_ultrasound_flag = TRUE;
                else if(strpos(strtoupper($temp4[had_ultrasound_flag]), 'N') !== false)
                    $had_ultrasound_flag = FALSE;
                else
                    $had_ultrasound_flag = FALSE;

                if(strpos(strtoupper($temp4[ultrasound_abnormalities_flag]), 'Y') !== false)
                    $abnormality_ultrasound_flag = TRUE;
                else if(strpos(strtoupper($temp4[ultrasound_abnormalities_flag]), 'N') !== false)
                    $abnormality_ultrasound_flag = FALSE;
                else
                    $abnormality_ultrasound_flag = FALSE;

                if(strpos(strtoupper($temp4[had_mri_flag]), 'Y') !== false)
                    $had_mri_flag = TRUE;
                else if(strpos(strtoupper($temp4[had_mri_flag]), 'N') !== false)
                    $had_mri_flag = FALSE;
                else
                    $had_mri_flag = FALSE;

                if(strpos(strtoupper($temp4[abnormalities_MRI_flag]), 'Y') !== false)
                    $abnormality_MRI_flag = TRUE;
                else if(strpos(strtoupper($temp4[abnormalities_MRI_flag]), 'N') !== false)
                    $abnormality_MRI_flag = FALSE;
                else
                    $abnormality_MRI_flag = FALSE;
                
                if(strpos(strtoupper($temp4[is_cancer_mammogram_flag]), 'Y') !== false)
                    $is_cancer_mammogram_flag = TRUE;
                else if(strpos(strtoupper($temp4[is_cancer_mammogram_flag]), 'N') !== false)
                    $is_cancer_mammogram_flag = FALSE;
                else
                    $is_cancer_mammogram_flag = FALSE;

                $patient_ic_no = $temp4[patient_IC_no];
                $studies_name = $temp4[studies_name];
                $studies_id = $this->excell_sheets_model->get_id('studies', 'studies_id', 'studies_name', $temp4[1]);
                $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);

                $temp_patient_ic_no_survelance[] = $patient_ic_no;
                $temp_patient_studies_id[] = $patient_studies_id;
                $patient_breast_screening_id = -1;
                
                if(in_array($patient_ic_no, $result_pt_ic_no_pt_breast_screening)  
                        && in_array($patient_studies_id, $result_pt_studies_id_pt_breast_screening))
                {
                    $patient_breast_screening_id = $this->excell_sheets_model->get_patient_breast_screening_id($patient_ic_no,$patient_studies_id);
                   
                    $data_patient_breast_screening_update = array(
                    'patient_ic_no' => $temp4[patient_IC_no],
                    'patient_studies_id' => $patient_studies_id,
                    'date_of_first_mammogram' => $temp4[date_of_first_mammogram],
                    'age_of_first_mammogram' => $temp4[age_at_first_mammogram],
                    'age_of_recent_mammogram' => $temp4[age_of_recent_mammogram],
                    'date_of_recent_mammogram' => $temp4[date_of_recent_mammogram],
                    'screening_centre' => $temp4[screening_center],
                    'total_no_of_mammogram' => $temp4[total_no_of_mammogram],
                    'screening_interval' => $temp4[screening_intervals],
                    'abnormalities_mammo_flag' => $abnormality_mammo_flag,
                    'mammo_comments' => $temp4[mammo_comments],
                    'name_of_radiologist' => $temp4[radiologist_name],
                    'had_ultrasound_flag' => $had_ultrasound_flag,
                    'total_no_of_ultrasound' => $temp4[total_no_ultrasound],
                    'abnormalities_ultrasound_flag' => $abnormality_ultrasound_flag,
                    'had_mri_flag' => $had_mri_flag,
                    'total_no_of_mri' => $temp4[total_no_mri],
                    'abnormalities_MRI_flag' => $abnormality_MRI_flag,
                    'BIRADS_clinical_classification' => $temp4[BIRADS_clinical_classification],
                    'BIRADS_density_classification' => $temp4[BIRADS_density_classification],
                    'percentage_of_mammo_density' => $temp4[percentage_of_mammo_density],
                    'created_on' => $created_date,
                    'screening_center_of_first_mammogram' => $temp4[screening_center_of_first_mammogram],
                    'screening_center_of_recent_mammogram' => $temp4[screening_center_of_recent_mammogram],
                    'details_of_first_mammogram' => $temp4[details_of_first_mammogram],
                    'details_of_recent_mammogram' => $temp4[details_of_recent_mammogram],
                    'motivaters_of_first_mammogram' => $temp4[motivaters_of_first_mammogram],
                    'motivaters_of_recent_mammogram' => $temp4[motivaters_of_recent_mammogram],
                    'reason_of_mammogram' => $temp4[reason_of_mammogram],
                    'reason_of_mammogram_details' => $temp4[reason_of_mammogram_details],
                    'mammogram_in_sdmc' => $temp4[mammogram_in_sdmc],
                    'action_suggested_on_mammogram_report' => $temp4[action_suggested_on_mammogram_report],
                    'reason_of_action_suggested' => $temp4[reason_of_action_suggested],
                    'site_effected_of_mammogram' => $temp4[site_effected_of_mammogram],
                    'is_cancer_mammogram_flag' => $is_cancer_mammogram_flag
                    );
                    $this->db->where('patient_breast_screening_id', $patient_breast_screening_id);
                    $this->db->update('patient_breast_screening', $data_patient_breast_screening_update); 
                    $data_patient_breast_screening_update = null;
                }
                else
                {
                    $data_patient_breast_screening[] = array(
                    'patient_ic_no' => $temp4[patient_IC_no],
                    'patient_studies_id' => $patient_studies_id,
                    'date_of_first_mammogram' => $temp4[date_of_first_mammogram],
                    'age_of_first_mammogram' => $temp4[age_at_first_mammogram],
                    'age_of_recent_mammogram' => $temp4[age_of_recent_mammogram],
                    'date_of_recent_mammogram' => $temp4[date_of_recent_mammogram],
                    'screening_centre' => $temp4[screening_center],
                    'total_no_of_mammogram' => $temp4[total_no_of_mammogram],
                    'screening_interval' => $temp4[screening_intervals],
                    'abnormalities_mammo_flag' => $abnormality_mammo_flag,
                    'mammo_comments' => $temp4[mammo_comments],
                    'name_of_radiologist' => $temp4[radiologist_name],
                    'had_ultrasound_flag' => $had_ultrasound_flag,
                    'total_no_of_ultrasound' => $temp4[total_no_ultrasound],
                    'abnormalities_ultrasound_flag' => $abnormality_ultrasound_flag,
                    'had_mri_flag' => $had_mri_flag,
                    'total_no_of_mri' => $temp4[total_no_mri],
                    'abnormalities_MRI_flag' => $abnormality_MRI_flag,
                    'BIRADS_clinical_classification' => $temp4[BIRADS_clinical_classification],
                    'BIRADS_density_classification' => $temp4[BIRADS_density_classification],
                    'percentage_of_mammo_density' => $temp4[percentage_of_mammo_density],
                    'created_on' => $created_date,
                    'screening_center_of_first_mammogram' => $temp4[screening_center_of_first_mammogram],
                    'screening_center_of_recent_mammogram' => $temp4[screening_center_of_recent_mammogram],
                    'details_of_first_mammogram' => $temp4[details_of_first_mammogram],
                    'details_of_recent_mammogram' => $temp4[details_of_recent_mammogram],
                    'motivaters_of_first_mammogram' => $temp4[motivaters_of_first_mammogram],
                    'motivaters_of_recent_mammogram' => $temp4[motivaters_of_recent_mammogram],
                    'reason_of_mammogram' => $temp4[reason_of_mammogram],
                    'reason_of_mammogram_details' => $temp4[reason_of_mammogram_details],
                    'mammogram_in_sdmc' => $temp4[mammogram_in_sdmc],
                    'action_suggested_on_mammogram_report' => $temp4[action_suggested_on_mammogram_report],
                    'reason_of_action_suggested' => $temp4[reason_of_action_suggested],
                    'site_effected_of_mammogram' => $temp4[site_effected_of_mammogram],
                    'is_cancer_mammogram_flag' => $is_cancer_mammogram_flag
                    );
                }

                
                $left_right_breast_side = $temp4[mammo_left_right_breast_site];
                $upper_below_breast_side = $temp4[mammo_upper_below_breast_site];

                if ($left_right_breast_side == "yes/yes" || $left_right_breast_side == "Yes/Yes") {
                    $left_breast = TRUE;
                    $right_breast = TRUE;
                } else if ($left_right_breast_side == "yes/no" || $left_right_breast_side == "Yes/No") {
                    $left_breast = TRUE;
                    $right_breast = FALSE;
                } else if ($left_right_breast_side == "no/yes" || $left_right_breast_side == "No/Yes") {
                    $left_breast = FALSE;
                    $right_breast = TRUE;
                } else if ($left_right_breast_side == "no/no" || $left_right_breast_side == "No/No") {
                    $left_breast = FALSE;
                    $right_breast = FALSE;
                } else {
                    $left_breast = FALSE;
                    $right_breast = FALSE;
                }

                if ($upper_below_breast_side == "yes/yes" || $upper_below_breast_side == "Yes/Yes") {
                    $upper = TRUE;
                    $below = TRUE;
                } else if ($upper_below_breast_side == "yes/no" || $upper_below_breast_side == "Yes/No") {
                    $upper = TRUE;
                    $below = FALSE;
                } else if ($upper_below_breast_side == "no/yes" || $upper_below_breast_side == "No/Yes") {
                    $upper = FALSE;
                    $below = TRUE;
                } else if ($upper_below_breast_side == "no/no" || $upper_below_breast_side == "No/No") {
                    $upper = FALSE;
                    $below = FALSE;
                } else {
                    $upper = FALSE;
                    $below = FALSE;
                }


                if ($temp4[abnormalities_detected] == 'Yes' || $temp4[abnormalities_detected] == 'yes')
                    $is_abnormality_detected_breast = TRUE;
                else if ($temp4[abnormalities_detected] == 'No' || $temp4[abnormalities_detected] == 'no')
                    $is_abnormality_detected_breast = FALSE;
                else
                    $is_abnormality_detected_breast = FALSE;

                if(in_array($patient_breast_screening_id, $result_pt_brst_scrning_id_pt_bst_abn))
                {
                   $patient_breast_abnormality_side_id = $this->excell_sheets_model->get_patient_breast_abnormality_side_id($patient_breast_screening_id); 
                   $data_patient_breast_abnormality_update[] = array(
                    'patient_breast_abnormality_side_id' => $patient_breast_abnormality_side_id,  
                    'patient_breast_screening_id' => $patient_breast_screening_id,
                    'left_breast' => $left_breast,
                    'right_breast' => $right_breast,
                    'upper' => $upper,
                    'below' => $below,
                    'is_abnormality_detected' => $is_abnormality_detected_breast,
                    'created_on' => $created_date
                    );   
                }
                else
                {
                    $data_patient_breast_abnormality[] = array(
                    'patient_breast_screening_id' => 1,
                    'left_breast' => $left_breast,
                    'right_breast' => $right_breast,
                    'upper' => $upper,
                    'below' => $below,
                    'is_abnormality_detected' => $is_abnormality_detected_breast,
                    'created_on' => $created_date
                ); 
                }


                if ($temp4[ultrasound_abnormality_detected_flag] == 'Yes' || $temp4[ultrasound_abnormality_detected_flag] == 'yes')
                    $is_abnormality_detected_ultrasound = TRUE;
                else if ($temp4[ultrasound_abnormality_detected_flag] == 'No' || $temp4[ultrasound_abnormality_detected_flag] == 'no')
                    $is_abnormality_detected_ultrasound = FALSE;
                else
                    $is_abnormality_detected_ultrasound = FALSE;
                
                if(in_array($patient_breast_screening_id, $result_pt_brst_scrning_id_pt_ultrad_abn))
                {
                    $patient_ultra_abn = $this->excell_sheets_model->get_patient_ultra_abn($patient_breast_screening_id);
                    $data_patient_ultrasound_abnormality_update[] = array(
                    'patient_ultra_abn' => $patient_ultra_abn,    
                    'ultrasound_date' => $temp4[ultrasound_date],
                    'is_abnormality_detected' => $is_abnormality_detected_ultrasound,
                    'comments' => $temp4[Ultrasound_abnormality_comments],
                    'patient_breast_screening_id' => $patient_breast_screening_id,
                    'created_on' => $created_date
                );
                }
                else
                {
                     $data_patient_ultrasound_abnormality[] = array(
                    'ultrasound_date' => $temp4[ultrasound_date],
                    'is_abnormality_detected' => $is_abnormality_detected_ultrasound,
                    'comments' => $temp4[Ultrasound_abnormality_comments],
                    'patient_breast_screening_id' => 1,
                    'created_on' => $created_date
                    );
                }
               

                if ($temp4[MRI_abnormality_detected_flag] == 'Yes' || $temp4[MRI_abnormality_detected_flag] == 'yes')
                    $is_abnormality_detected_mri = TRUE;
                else if ($temp4[MRI_abnormality_detected_flag] == 'No' || $temp4[MRI_abnormality_detected_flag] == 'no')
                    $is_abnormality_detected_mri = FALSE;
                else
                    $is_abnormality_detected_mri = FALSE;

                if(in_array($patient_breast_screening_id, $result_pt_brst_scrning_id_pt_mri_abn))
                {
                    $patient_mri_abnormlity_id = $this->excell_sheets_model->get_patient_mri_abnormlity_id($patient_breast_screening_id);
                    $data_patient_mri_abnormality_update[] = array(
                    'patient_mri_abnormlity_id' => $patient_mri_abnormlity_id,   
                    'mri_date' => $temp4[MRI_date],
                    'is_abnormality_detected' => $is_abnormality_detected_mri,
                    'comments' => $temp4[MRI_abnormality_comments],
                    'patient_breast_screening_id' => $patient_breast_screening_id,
                    'created_on' => $created_date
                );
                }
                else
                {
                    $data_patient_mri_abnormality[] = array(
                    'mri_date' => $temp4[MRI_date],
                    'is_abnormality_detected' => $is_abnormality_detected_mri,
                    'comments' => $temp4[MRI_abnormality_comments],
                    'patient_breast_screening_id' => 1,
                    'created_on' => $created_date
                );
                }


                $temp4 = null;
            }

            $result_pt_studies_id_pt_breast_screening = null;
            $result_pt_brst_scrning_id_pt_bst_abn = null;
            $result_pt_brst_scrning_id_pt_ultrad_abn = null;
            $result_pt_brst_scrning_id_pt_mri_abn =null;
            //print_r($data_patient_breast_screening);
            //print_r($data_patient_breast_abnormality);
            //print_r($data_patient_ultrasound_abnormality);
            // print_r($data_patient_mri_abnormality);
            if(sizeof($data_patient_breast_screening) > 0)
            {
                $id_patient_breast_screening = $this->excell_sheets_model->insert_record($data_patient_breast_screening, 'patient_breast_screening');
                if ($id_patient_breast_screening > 0)
                    echo 'Data added succesfully at patient_breast_screening table';
                else
                    echo 'Failed to insert at patient_breast_screening table';
                echo '<br/>';
                $data_patient_breast_screening = null;
            }


            $data_patient_breast_abnormality_insert = array();
            $data_patient_breast_abnormality_insert = null;

            $data_patient_ultrasound_abnormality_insert = array();
            $data_patient_ultrasound_abnormality_insert = null;

            $data_patient_mri_abnormality_insert = array();
            $data_patient_mri_abnormality_insert = null;

            $tempLength = sizeof($temp_patient_ic_no_survelance);
            
            if(sizeof($data_patient_breast_abnormality) > 0)
            {
                for ($key = 0; $key < $tempLength; $key++) 
                {
                    $patient_breast_screening_id_in = $this->excell_sheets_model->get_patient_breast_screening_id($temp_patient_ic_no_survelance[$key], $temp_patient_studies_id[$key]);
                    $data_patient_breast_abnormality[$key]['patient_breast_screening_id'] = $patient_breast_screening_id_in;

                    if($patient_breast_screening_id_in > 0)
                    {
                        $data_patient_breast_abnormality_insert[] = $data_patient_breast_abnormality[$key];
                    }
                }
            }
 
            $data_patient_breast_abnormality = null;
            
            if(sizeof($data_patient_ultrasound_abnormality) > 0)
            {
                for ($key = 0; $key < $tempLength; $key++) 
                {
                    $patient_breast_screening_id_in = $this->excell_sheets_model->get_patient_breast_screening_id($temp_patient_ic_no_survelance[$key], $temp_patient_studies_id[$key]);
                    $data_patient_ultrasound_abnormality[$key]['patient_breast_screening_id'] = $patient_breast_screening_id_in;
                    if($patient_breast_screening_id_in > 0)
                    {
                        $data_patient_ultrasound_abnormality_insert[] = $data_patient_ultrasound_abnormality[$key];
                    }
                }
            }

            $data_patient_ultrasound_abnormality = null;
            
            if(sizeof($data_patient_mri_abnormality) > 0)
            {
                for ($key = 0; $key < $tempLength; $key++) 
                {
                    $patient_breast_screening_id_in = $this->excell_sheets_model->get_patient_breast_screening_id($temp_patient_ic_no_survelance[$key], $temp_patient_studies_id[$key]);
                    $data_patient_mri_abnormality[$key]['patient_breast_screening_id'] = $patient_breast_screening_id_in;
                    if($patient_breast_screening_id_in > 0)
                    {
                    $data_patient_mri_abnormality_insert[] = $data_patient_mri_abnormality[$key];
                    }
                }
            }

            $data_patient_mri_abnormality = null;
            
            //print_r($data_patient_breast_abnormality);
            //print_r($data_patient_ultrasound_abnormality);
            //print_r($data_patient_mri_abnormality);
            if(!$abort)
            {
                if(sizeof($data_patient_breast_abnormality_insert) > 0)
                {
                    $id_patient_breast_abnormality = $this->excell_sheets_model->insert_record($data_patient_breast_abnormality_insert, 'patient_breast_abnormality');
                    if ($id_patient_breast_abnormality > 0)
                        echo 'Data added succesfully at patient_breast_abnormality table';
                    else
                        echo 'Failed to insert at patient_breast_abnormality table';
                    echo '<br/>';
                    $data_patient_breast_abnormality_insert = null;
                }

                if(sizeof($data_patient_breast_abnormality_update) > 0)
                {
                    $id_patient_breast_abnormality = $this->db->update_batch('patient_breast_abnormality',$data_patient_breast_abnormality_update,'patient_breast_abnormality_side_id');
                    if ($id_patient_breast_abnormality > 0)
                        echo 'Data updated succesfully at patient_breast_abnormality table';
                    else
                        echo 'Updated Data at patient_breast_abnormality table';
                    echo '<br/>';
                    $data_patient_breast_abnormality_update = null;
                }

                if(sizeof($data_patient_ultrasound_abnormality_insert) > 0)
                {
                    $id_patient_ultrasound_abnormality = $this->excell_sheets_model->insert_record($data_patient_ultrasound_abnormality_insert, 'patient_ultrasound_abnormality');
                    if ($id_patient_ultrasound_abnormality > 0)
                        echo 'Data added succesfully at patient_ultrasound_abnormality table';
                    else
                        echo 'Failed to insert at patient_ultrasound_abnormality table';
                    echo '<br/>';
                    $data_patient_ultrasound_abnormality_insert = null;
                }

                if(sizeof($data_patient_ultrasound_abnormality_update) > 0)
                {
                    $id_patient_ultrasound_abnormality = $this->db->update_batch('patient_ultrasound_abnormality',$data_patient_ultrasound_abnormality_update,'patient_ultra_abn');
                    if ($id_patient_ultrasound_abnormality > 0)
                        echo 'Data updated succesfully at patient_ultrasound_abnormality table';
                    else
                        echo 'Updated Data at patient_ultrasound_abnormality table';
                    echo '<br/>';
                    $data_patient_ultrasound_abnormality_insert = null;
                }

                if(sizeof($data_patient_mri_abnormality_insert) > 0)
                {
                    $id_patient_mri_abnormality = $this->excell_sheets_model->insert_record($data_patient_mri_abnormality_insert, 'patient_mri_abnormality');
                    if ($id_patient_mri_abnormality > 0)
                        echo 'Data added succesfully at patient_mri_abnormality table';
                    else
                        echo 'Failed to insert at patient_mri_abnormality table';
                    echo '<br/>';
                    $data_patient_ultrasound_abnormality_insert = null;
                }

                if(sizeof($data_patient_mri_abnormality_update) > 0)
                {
                    $id_patient_mri_abnormality = $this->db->update_batch('patient_mri_abnormality',$data_patient_mri_abnormality_update,'patient_mri_abnormlity_id');
                    if ($id_patient_mri_abnormality > 0)
                        echo 'Data updated succesfully at patient_mri_abnormality table';
                    else
                        echo 'Updated Data at patient_mri_abnormality table';
                    echo '<br/>';
                    
                    $data_patient_mri_abnormality_update = null;
                }

                echo '<br/>';
            }
            
            
            $data_patient_breast_screening = null;
            $temp_pt_ic_no_pt_breast_screening = null;
            $result_pt_ic_no_pt_breast_screening = null;
            $temp_pt_studies_id_pt_breast_screening = null;
            $result_pt_studies_id_pt_breast_screening = null;
            $temp_pt_brst_scrning_id_pt_bst_abn = null;
            $result_pt_brst_scrning_id_pt_bst_abn = null;
            $temp_pt_brst_scrning_id_pt_ultrad_abn = null;
            $result_pt_brst_scrning_id_pt_ultrad_abn = null;
            $temp_pt_brst_scrning_id_pt_mri_abn = null;
            $result_pt_brst_scrning_id_pt_mri_abn = null;
            $temp_patient_ic_no_survelance = null;
            $temp_patient_studies_id = null;
            $temp_patient_ic_no_survelance = null;
            $temp_patient_studies_id = null;
            $data_patient_breast_abnormality = null;
            $data_patient_ultrasound_abnormality = null;
            $data_patient_mri_abnormality = null;
            $data_patient_breast_abnormality_update = null;
            $data_patient_breast_abnormality_insert = null;
            $data_patient_ultrasound_abnormality_update = null;
            $data_patient_ultrasound_abnormality_insert = null;
            $data_patient_mri_abnormality_update = null;
            $data_patient_mri_abnormality_insert = null;
                    
     }
    
    
}
?>
