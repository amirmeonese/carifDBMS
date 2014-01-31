<?php

class ModelDiagnosis1 extends CI_Model {

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

    public function Diagnosis1($sheet) {
        /*$temp_result_cancer_name = array();
        $temp_result_cancer_name = null;
        $this->db->select('cancer_name');
        $this->db->from('cancer');
        $temp_result_cancer_name = $this->db->get()->result_array();

        $result_cancer_name = array();
        for ($i = 0; $i < sizeof($temp_result_cancer_name); $i++) {
            $result_cancer_name[$i] = $temp_result_cancer_name[$i]['cancer_name'];
            echo $result_cancer_name[$i].'<br/>';
        }*/
        $created_date = date('Y-m-d H:i:s');
        $abort = FALSE;
        $temp14 = array();
        $data_patient_cancer_insert = array();
        $data_patient_cancer_insert = null;
        $data_patient_cancer_update = array();
        $data_patient_cancer_update = null;
        $data_patient_pathology = array();
        $data_patient_pathology = null;
        $temp_cancer_name = NULL;
        $temp_cancer_site_name = NULL;
        $temp_studies_name = NULL;

        $temp_patient_ic_no = array();
        $temp_patient_ic_no = null;
        $treatment_patient_studies_id = array();
        $treatment_patient_studies_id = null;
        $pathology_patient_studies_id = array();
        $pathology_patient_studies_id = null;
        $treatment_cancer_id = array();
        $treatment_cancer_id = null;
        $pathology_cancer_id = array();
        $pathology_cancer_id = null;
        $treatment_cancer_site_id = array();
        $treatment_cancer_site_id = null;
        $pathology_cancer_site_id = array();
        $pathology_cancer_site_id = null;
        $data_patient_cancer_treatment = array();
        $data_patient_cancer_treatment = null;
        $flag_ic_no = FALSE;
        $flag_cancer_name = FALSE;
        $flag_cancer_site_name = FALSE;
        $flag_studies_name = FALSE;
        $flag_treatment_name = FALSE;
        $flag_pathology_tissue_site = FALSE;

        $temp_result_cancer_site_name = array();
        $temp_result_cancer_site_name = null;
        $this->db->select('cancer_site_name');
        $this->db->from('cancer_site');
        $temp_result_cancer_site_name = $this->db->get()->result_array();

        $result_cancer_site_name = array();
        for ($i = 0; $i < sizeof($temp_result_cancer_site_name); $i++) {
            $result_cancer_site_name[$i] = $temp_result_cancer_site_name[$i]['cancer_site_name'];
        }
        $temp_result_cancer_site_name = null;

        $temp_pt_studies_id_pt_cancer = array();
        $temp_pt_studies_id_pt_cancer = null;
        $this->db->select('patient_studies_id');
        $this->db->from('patient_cancer');
        $temp_pt_studies_id_pt_cancer = $this->db->get()->result_array();

        //print_r($temp_pt_risk_reduc_surgery_id_pt_risk_red_surgery_lesion);
        $result_pt_studies_id_pt_cancer = array();
        for ($i = 0; $i < sizeof($temp_pt_studies_id_pt_cancer); $i++) {
            $result_pt_studies_id_pt_cancer [$i] = $temp_pt_studies_id_pt_cancer[$i]['patient_studies_id'];
        }
        $temp_pt_studies_id_pt_cancer = null;

        $temp_pt_cancer_id_pt_cancer = array();
        $temp_pt_cancer_id_pt_cancer = null;
        $this->db->select('cancer_id');
        $this->db->from('patient_cancer');
        $temp_pt_cancer_id_pt_cancer = $this->db->get()->result_array();

        //print_r($temp_pt_risk_reduc_surgery_id_pt_risk_red_surgery_lesion);
        $result_pt_cancer_id_pt_cancer = array();
        for ($i = 0; $i < sizeof($temp_pt_cancer_id_pt_cancer); $i++) {
            $result_pt_cancer_id_pt_cancer [$i] = $temp_pt_cancer_id_pt_cancer[$i]['cancer_id'];
        }
        $temp_pt_cancer_id_pt_cancer = null;

        $temp_pt_cancer_site_id_pt_cancer = array();
        $temp_pt_cancer_site_id_pt_cancer = null;
        $this->db->select('cancer_site_id');
        $this->db->from('patient_cancer');
        $temp_pt_cancer_site_id_pt_cancer = $this->db->get()->result_array();

        //print_r($temp_pt_risk_reduc_surgery_id_pt_risk_red_surgery_lesion);
        $result_pt_cancer_site_id_pt_cancer = array();
        for ($i = 0; $i < sizeof($temp_pt_cancer_site_id_pt_cancer); $i++) {
            $result_pt_cancer_site_id_pt_cancer [$i] = $temp_pt_cancer_site_id_pt_cancer[$i]['cancer_site_id'];
        }
        $temp_pt_cancer_site_id_pt_cancer = null;

        $temp_pt_cancer_id_pt_cancer_treatment = array();
        $temp_pt_cancer_id_pt_cancer_treatment = null;
        $this->db->select('patient_cancer_id');
        $this->db->from('patient_cancer_treatment');
        $temp_pt_cancer_id_pt_cancer_treatment = $this->db->get()->result_array();

        //print_r($temp_pt_risk_reduc_surgery_id_pt_risk_red_surgery_lesion);
        $result_pt_cancer_id_pt_cancer_treatment = array();
        for ($i = 0; $i < sizeof($temp_pt_cancer_id_pt_cancer_treatment); $i++) {
            $result_pt_cancer_id_pt_cancer_treatment [$i] = $temp_pt_cancer_id_pt_cancer_treatment[$i]['patient_cancer_id'];
        }
        $temp_pt_cancer_id_pt_cancer_treatment = null;

        $temp_pt_cancer_id_pt_pathology = array();
        $temp_pt_cancer_id_pt_pathology = null;
        $this->db->select('patient_cancer_id');
        $this->db->from('patient_pathology');
        $temp_pt_cancer_id_pt_pathology = $this->db->get()->result_array();

        //print_r($temp_pt_risk_reduc_surgery_id_pt_risk_red_surgery_lesion);
        $result_pt_cancer_id_pt_pathology = array();
        for ($i = 0; $i < sizeof($temp_pt_cancer_id_pt_pathology); $i++) {
            $result_pt_cancer_id_pt_pathology [$i] = $temp_pt_cancer_id_pt_pathology[$i]['patient_cancer_id'];
        }
        $temp_pt_cancer_id_pt_pathology = null;

        $i = 0;
        foreach ($sheet->getRowIterator() as $row) {
            $i++;

            if ($i == 1)//ommiting cell header name
                continue;

            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            $temp14 = null;
            foreach ($cellIterator as $key => $cell) {
                $cell_value = $cell->getFormattedValue();

                if ($key == 0 && $cell_value != NULL) {
                    $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
                }

                if ($key == 0 && $cell_value != NULL)
                    $temp_ic_no = $cell_value;

                if ($key == 0 && $cell_value == NULL) {
                    $cell_value = $temp_ic_no;
                    $flag_ic_no = TRUE;
                }

                if ($key == 1 && $cell_value != NULL)
                    $temp_studies_name = $cell_value;

                if ($key == 1 && $cell_value == NULL) {
                    $cell_value = $temp_studies_name;
                    $flag_studies_name = TRUE;
                }

                if ($key == 2 && $cell_value != NULL)
                    $cell_value = trim(strtoupper($cell_value));

                if ($key == 2 && $cell_value != NULL)
                    $temp_cancer_name = $cell_value;

                if ($key == 2 && $cell_value == NULL) {
                    $cell_value = $temp_cancer_name;
                    $flag_cancer_name = TRUE;
                }

                if ($key == 3 && $cell_value != NULL) {
                    $cell_value = trim($cell_value);
                    if (in_array($cell_value, $result_cancer_site_name)) {
                        $temp_cancer_site_name = $cell_value;
                    } else {
                        $cell_value = 'None';
                    }
                }

                if ($key == 3 && $cell_value == NULL) {
                    $cell_value = 'None';
                }

                if ($key == 13 && $cell_value == NULL) {
                    $cell_value = 'None';
                }

                if ($key == 26 && $cell_value == NULL) {
                    $cell_value = 'None';
                    //$flag_pathology_tissue_site = TRUE;
                }
                /*if (($key == 6 || $key == 14 || $key == 15 || $key == 28) && $cell_value != NULL) {
                    //echo $cell_value.'         ';
                    if (strlen($cell_value) > 8) {
                        if (strpos($cell_value, '-') !== FALSE)
                            $cell_value = date("d/m/Y", strtotime($cell_value));
                        list($day, $month, $year) = explode("/", $cell_value);

                        if (!checkdate($month, $day, $year)) {
                            //echo '<h2>date_of_diagnosis or treatment_start_date or treatment_end_date is not in appropriate format at Diagnosis & Treatment</h2>';
                            if ($key == 6)
                                $this->model_Validator->showMessage("date_of_diagnosis", "Diagnosis & Treatment", $i);
                            if ($key == 14)
                                $this->model_Validator->showMessage("treatment_start_date", "Diagnosis & Treatment", $i);
                            if ($key == 15)
                                $this->model_Validator->showMessage("treatment_end_date", "Diagnosis & Treatment", $i);
                            if ($key == 28)
                                $this->model_Validator->showMessage("date_of_report", "Diagnosis & Treatment", $i);

                            $abort = TRUE;
                            break;
                        }
                    }
                }

                if ($key == 6 || $key == 14 || $key == 15 || $key == 28) {
                    if ($cell_value != NULL) {
                        $cell_value = date('Y-m-d', strtotime(str_replace('/', '-', $cell_value)));
                    }
                }*/

                $temp14[] = $cell_value;
            }

            if ($abort)
                break;

            if(strpos(strtoupper($temp14[4]), 'Y') !== false)
                $is_primary = TRUE;
            else if(strpos(strtoupper($temp14[4]), 'N') !== false)
                $is_primary = FALSE;
            else
                $is_primary = FALSE;

            if(strpos(strtoupper($temp14[11]), 'Y') !== false)
                $bilateral_flag = TRUE;
            else if(strpos(strtoupper($temp14[11]), 'N') !== false)
                $bilateral_flag = FALSE;
            else
                $bilateral_flag = FALSE;

            if(strpos(strtoupper($temp14[12]), 'Y') !== false)
                $recurrence_flag = TRUE;
            else if(strpos(strtoupper($temp14[12]), 'N') !== false)
                $recurrence_flag = FALSE;
            else
                $recurrence_flag = FALSE;

            $patient_ic_no = $temp14[0];
            $studies_name = $temp14[1]; //echo 'studies_name'.$studies_name.'</br>';
            $studies_id = $this->excell_sheets_model->get_id('studies', 'studies_id', 'studies_name', $temp14[1]);
            $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);
            //echo 'patient_studies_id'.$patient_studies_id.'</br>';

            if (!$flag_cancer_name) {
                $cancer_id = $this->excell_sheets_model->get_id('cancer', 'cancer_id', 'cancer_name', $temp14[2]);
                $cancer_site_id = $this->excell_sheets_model->get_id('cancer_site', 'cancer_site_id', 'cancer_site_name', $temp14[3]);

                if (in_array($patient_studies_id, $result_pt_studies_id_pt_cancer) && in_array($cancer_id, $result_pt_cancer_id_pt_cancer) && in_array($cancer_site_id, $result_pt_cancer_site_id_pt_cancer)) {
                    $data_patient_cancer_update = array(
                        'patient_studies_id' => $patient_studies_id,
                        'cancer_id' => $cancer_id,
                        'cancer_site_id' => $cancer_site_id,
                        'cancer_invasive_type' => $temp14[4],
                        'is_primary' => $is_primary,
                        'date_of_diagnosis' => $temp14[6],
                        'age_of_diagnosis' => $temp14[7],
                        'diagnosis_center' => $temp14[8],
                        'doctor_name' => $temp14[9],
                        'detected_by' => $temp14[10],
                        'bilateral_flag' => $bilateral_flag,
                        'recurrence_flag' => $recurrence_flag,
                        'created_on' => $created_date
                    );

                    $this->db->where('patient_studies_id', $patient_studies_id);
                    $this->db->where('cancer_id', $cancer_id);
                    $this->db->where('cancer_site_id', $cancer_site_id);
                    $this->db->update('patient_cancer', $data_patient_cancer_update);

                    $data_patient_cancer_update = null;
                } else {
                    $data_patient_cancer_insert[] = array(
                        'patient_studies_id' => $patient_studies_id,
                        'cancer_id' => $cancer_id,
                        'cancer_site_id' => $cancer_site_id,
                        'cancer_invasive_type' => $temp14[4],
                        'is_primary' => $is_primary,
                        'date_of_diagnosis' => $temp14[6],
                        'age_of_diagnosis' => $temp14[7],
                        'diagnosis_center' => $temp14[8],
                        'doctor_name' => $temp14[9],
                        'detected_by' => $temp14[10],
                        'bilateral_flag' => $bilateral_flag,
                        'recurrence_flag' => $recurrence_flag,
                        'created_on' => $created_date
                    );
                }
            }
            $flag_cancer_name = FALSE;

            //if (!$flag_treatment_name)  {
            $cancer_id = $this->excell_sheets_model->get_id('cancer', 'cancer_id', 'cancer_name', $temp14[2]);
            $cancer_site_id = $this->excell_sheets_model->get_id('cancer_site', 'cancer_site_id', 'cancer_site_name', $temp14[3]);
            $treatment_patient_studies_id[] = $patient_studies_id;
            $treatment_cancer_id[] = $cancer_id;
            $treatment_cancer_site_id[] = $cancer_site_id;

            $treatment_id = $this->excell_sheets_model->get_id('treatment', 'treatment_id', 'treatment_name', $temp14[13]);

            $data_patient_cancer_treatment[] = array(
                'treatment_id' => $treatment_id,
                'patient_cancer_id' => 1,
                'treatment_start_date' => $temp14[14],
                'treatment_end_date' => $temp14[15],
                'treatment_durations' => $temp14[16],
                'comments' => $temp14[17],
                'created_on' => $created_date,
                'treatment_details' => $temp14[18],
                'treatment_dose' => $temp14[19],
                'treatment_cycle' => $temp14[20],
                'treatment_frequency' => $temp14[21],
                'treatment_visidual_desease' => $temp14[22],
                'treatment_primary_outcome' => $temp14[23],
                'treatment_cal125_pretreatment' => $temp14[24],
                'treatment_cal125_posttreatment' => $temp14[25]
            );

            $flag_treatment_name = FALSE;

            //if (!$flag_pathology_tissue_site)  {
            $cancer_site_id = $this->excell_sheets_model->get_id('cancer_site', 'cancer_site_id', 'cancer_site_name', $temp14[3]);
            $pathology_patient_studies_id[] = $patient_studies_id;
            $pathology_cancer_id[] = $cancer_id;
            $pathology_cancer_site_id[] = $cancer_site_id;
            $cancer_id = $this->excell_sheets_model->get_id('cancer', 'cancer_id', 'cancer_name', $temp14[2]);

            $data_patient_pathology[] = array(
                'cancer_id' => $cancer_id,
                'tissue_site' => $temp14[26],
                'type_of_report' => $temp14[27],
                'date_of_report' => $temp14[28],
                'pathology_lab' => $temp14[29],
                'name_of_doctor' => $temp14[30],
                'morphology' => $temp14[31],
                't_staging' => $temp14[32],
                'n_staging' => $temp14[33],
                'm_staging' => $temp14[34],
                'stage_classifications' => $temp14[35],
                'tumour_stage' => $temp14[36],
                'tumour_grade' => $temp14[37],
                'total_lymph_nodes' => $temp14[38],
                'tumour_size' => $temp14[39],
                'comments' => $temp14[40],
                'created_on' => $created_date,
                'patient_cancer_id' => 1,
                'no_of_report' => $temp14[41],
                'tumor_subtype' => $temp14[42],
                'tumor_behaviour' => $temp14[43],
                'tumor_differentiation' => $temp14[44]
            );
            $flag_pathology_tissue_site = FALSE;
        }
        $result_pt_cancer_id_pt_cancer = null;
        $result_pt_studies_id_pt_cancer = null;

        //echo '<pre>';
        //print_r($data_patient_cancer_insert);
        //print_r($data_patient_cancer_treatment);
        //print_r($data_patient_pathology);
        //print_r($treatment_patient_studies_id);
        //print_r($treatment_cancer_id);
        //print_r($treatment_cancer_site_id);
        //print_r($pathology_patient_studies_id);
        //print_r($pathology_cancer_id);
        //print_r($pathology_cancer_site_id);

        if (!$abort)
        {
            if (sizeof($data_patient_cancer_insert) > 0) {
                $id_data_patient_cancer = $this->excell_sheets_model->insert_record($data_patient_cancer_insert, 'patient_cancer');
                if ($id_data_patient_cancer > 0)
                    echo 'Data added succesfully at patient_cancer table';
                else
                    echo 'Failed to insert at patient_cancer table';
                echo '<br/>';
                $data_patient_cancer_insert = null;
            }
        }


        $tempLen = sizeof($data_patient_cancer_treatment);

        $data_patient_cancer_treatment_update = array();
        $data_patient_cancer_treatment_update = null;
        $data_patient_cancer_treatment_insert = array();
        $data_patient_cancer_treatment_insert = null;
        for ($key = 0; $key < $tempLen; $key++) {
            //echo $treatment_patient_studies_id[$key].'      '.$treatment_cancer_id[$key].'      '.$treatment_cancer_site_id[$key].'<br/>';
            $patient_cancer_id = $this->excell_sheets_model->get_patient_cancer_id($treatment_patient_studies_id[$key], $treatment_cancer_id[$key], $treatment_cancer_site_id[$key]);
            $data_patient_cancer_treatment[$key]['patient_cancer_id'] = $patient_cancer_id;
            //echo "before if: "; 
            //print_r($data_patient_cancer_treatment[$key]);
            if ($patient_cancer_id > 0 && in_array($patient_cancer_id, $result_pt_cancer_id_pt_cancer_treatment)) {
                //echo "update : ";print_r($data_patient_cancer_treatment[$key]);
                $data_patient_cancer_treatment_update[] = $data_patient_cancer_treatment[$key];
            } else if ($patient_cancer_id > 0) {
                //echo "insert : "; print_r($data_patient_cancer_treatment[$key]);
                $data_patient_cancer_treatment_insert[] = $data_patient_cancer_treatment[$key];
            }
        }
        $data_patient_cancer_treatment = null;

        //print_r($data_patient_cancer_treatment);
        //print_r($data_patient_cancer_treatment_update);
        $data_patient_pathology_update = array();
        $data_patient_pathology_update = null;
        $data_patient_pathology_insert = array();
        $data_patient_pathology_insert = null;

        $tempLength = sizeof($data_patient_pathology);

        for ($key = 0; $key < $tempLength; $key++) {
            //echo $treatment_patient_studies_id[$key].'      '.$treatment_cancer_id[$key].'      '.$treatment_cancer_site_id[$key].'<br/>';
            $patient_cancer_id = $this->excell_sheets_model->get_patient_cancer_id($pathology_patient_studies_id[$key], $pathology_cancer_id[$key], $pathology_cancer_site_id[$key]);
            $data_patient_pathology[$key]['patient_cancer_id'] = $patient_cancer_id;

            if ($patient_cancer_id > 0 && in_array($patient_cancer_id, $result_pt_cancer_id_pt_pathology)) {
                $data_patient_pathology_update[] = $data_patient_pathology[$key];
            } else if ($patient_cancer_id > 0) {
                $data_patient_pathology_insert[] = $data_patient_pathology[$key];
            }
        }
        $data_patient_pathology = null;
        //print_r($data_patient_pathology);

        if (!$abort) {
            if (sizeof($data_patient_cancer_treatment_insert) > 0) {
                // print_r($data_patient_cancer_treatment_insert);
                $id_patient_cancer_treatment = $this->excell_sheets_model->insert_record($data_patient_cancer_treatment_insert, 'patient_cancer_treatment');
                if ($id_patient_cancer_treatment > 0)
                    echo 'Data added succesfully at patient_cancer_treatment table';
                else
                    echo 'Failed to insert at patient_cancer_treatment table';
                echo '<br/>';
                $data_patient_cancer_treatment_insert = null;
            }

            if (sizeof($data_patient_cancer_treatment_update) > 0) {
                $id_patient_cancer_treatment = $this->db->update_batch('patient_cancer_treatment', $data_patient_cancer_treatment_update, 'patient_cancer_id');
                if ($id_patient_cancer_treatment > 0)
                    echo 'Data updated succesfully at patient_cancer_treatment table';
                else
                    echo 'Updated Data at patient_cancer_treatment table';
                echo '<br/>';
                $data_patient_cancer_treatment_update = null;
            }

            if (sizeof($data_patient_pathology_insert) > 0) {
                $id_patient_pathology = $this->excell_sheets_model->insert_record($data_patient_pathology_insert, 'patient_pathology');
                if ($id_patient_pathology > 0)
                    echo 'Data added succesfully at patient_pathology table';
                else
                    echo 'Failed to insert at patient_pathology table';
                echo '<br/>';
                $data_patient_pathology_insert = null;
            }

            if (sizeof($data_patient_pathology_update) > 0) {
                $id_patient_pathology = $this->db->update_batch('patient_pathology', $data_patient_pathology_update, 'patient_cancer_id');
                if ($id_patient_pathology > 0)
                    echo 'Data updated succesfully at patient_pathology table';
                else
                    echo 'Updated Data at patient_pathology table';
                echo '<br/>';
                $data_patient_pathology_update = null;
            }
        }


        $data_patient_cancer_insert = null;
        $temp_patient_ic_no = null;
        $treatment_patient_studies_id = null;
        $pathology_patient_studies_id = null;
        $treatment_cancer_id = null;
        $pathology_cancer_id = null;
        $treatment_cancer_site_id = null;
        $pathology_cancer_site_id = null;
        $data_patient_cancer_treatment = null;
        $temp_pt_studies_id_pt_cancer = null;
        $result_pt_studies_id_pt_cancer = null;
        $temp_pt_cancer_id_pt_cancer = null;
        $result_pt_cancer_id_pt_cancer = null;
        $temp_pt_cancer_site_id_pt_cancer = null;
        $result_pt_cancer_site_id_pt_cancer = null;
        $temp_pt_cancer_id_pt_cancer_treatment = null;
        $result_pt_cancer_id_pt_cancer_treatment = null;
        $temp_pt_cancer_id_pt_pathology = null;
        $result_pt_cancer_id_pt_pathology = null;
        $temp14 = null;
        $data_patient_cancer_update = null;
        $data_patient_cancer_insert = null;
        $treatment_patient_studies_id = null;
        $treatment_cancer_id = null;
        $treatment_cancer_site_id = null;
        $data_patient_cancer_treatment = null;
        $pathology_patient_studies_id = null;
        $pathology_cancer_id = null;
        $pathology_cancer_site_id = null;
        $data_patient_pathology = null;
        $data_patient_cancer_treatment_update = null;
        $data_patient_cancer_treatment_insert = null;
        $data_patient_pathology_update = null;
        $data_patient_pathology_insert = null;
        $temp_result_cancer_site_name = null;
    }

}

?>
