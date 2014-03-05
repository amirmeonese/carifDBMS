<?php

class ModelLifestyles1 extends CI_Model {

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

    public function Lifestyles1($sheet) {
        $created_date = date('Y-m-d H:i:s');
        $abort = FALSE;
        $data_patient_lifestyle_factors = array();
        $data_patient_lifestyle_factors = null;
        $data_patient_lifestyle_factors_update = array();
        $data_patient_lifestyle_factors_update = null;
        $temp_result_patient_studies_id = array();
        $temp_result_patient_studies_id = null;
        $temp11 = array();
        $this->db->select('patient_studies_id');
        $this->db->from('patient_lifestyle_factors');
        $temp_result_patient_studies_id = $this->db->get()->result_array();

        //print_r($temp_result_relationship);
        $result_patient_studies_id_Lifestyles1 = array();
        for ($i = 0; $i < sizeof($temp_result_patient_studies_id); $i++) {
            //echo $result_relationship[$j]['relatives_type']. '<br/>';
            $result_patient_studies_id_Lifestyles1[$i] = $temp_result_patient_studies_id[$i]['patient_studies_id'];
            //echo $result_studies_name[$i] . '<br/>';
        }
        $temp_result_patient_studies_id = null;
        $i = 0;
        foreach ($sheet->getRowIterator() as $row) {
            $i++;

            if ($i == 1)//ommiting cell header name
                continue;

            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            $temp11 = null;
            foreach ($cellIterator as $key => $cell) {
                //$cell_value = $cell->getCalculatedValue(); // Value here
                $cell_value = $cell->getFormattedValue();

                if ($key == 0 && $cell_value != NULL)
                    $cell_value = preg_replace("/[^0-9]/", "", $cell_value);

                if ($key == 1 && $cell_value != NULL)
                    $cell_value = trim($cell_value);

                if ($key == 2 && $cell_value != NULL) {
                    /* if (strpos($cell_value, '-') !== FALSE)
                      $cell_value = date("d/m/Y", strtotime($cell_value));
                      list($day, $month, $year) = explode("/", $cell_value);

                      if (!checkdate($month, $day, $year)) {
                      $this->model_Validator->showMessage("questionnaire_date", "Lifestyles1", $i);
                      $abort = TRUE;
                      break;
                      } */
                    //$cell_value = preg_replace("/[^0-9\/]/", "", $cell_value);
                    if ($cell_value == "")
                        $cell_value = '0000-00-00';
                    else
                        $cell_value == '0000-00-00' ? "0000-00-00" :  date('Y-m-d', strtotime(str_replace('/', '-', $cell_value)));
                }
                //echo $key; // 0, 1, 2..
                $temp11[] = $cell_value;
                //echo $cell_value . '    ';
            }

            if ($abort)
                break;

            if (strpos(strtoupper($temp11[cigarettes_smoked_now]), 'Y') !== false)
                $cigarrets_smoked_flag = TRUE;
            else if (strpos(strtoupper($temp11[cigarettes_smoked_now]), 'N') !== false)
                $cigarrets_smoked_flag = FALSE;
            else
                $cigarrets_smoked_flag = FALSE;

            if (strpos(strtoupper($temp11[cigarettes_still_smoked]), 'Y') !== false)
                $cigarrets_still_smoked_flag = TRUE;
            else if (strpos(strtoupper($temp11[cigarettes_still_smoked]), 'N') !== false)
                $cigarrets_still_smoked_flag = FALSE;
            else
                $cigarrets_still_smoked_flag = FALSE;

            if (strpos(strtoupper($temp11[alcohol_drunk_flag]), 'Y') !== false)
                $alcohol_drunk_flag = TRUE;
            else if (strpos(strtoupper($temp11[alcohol_drunk_flag]), 'N') !== false)
                $alcohol_drunk_flag = FALSE;
            else
                $alcohol_drunk_flag = FALSE;

            if (strpos(strtoupper($temp11[coffee_drunk_flag]), 'Y') !== false)
                $coffee_drunk_flag = TRUE;
            else if (strpos(strtoupper($temp11[coffee_drunk_flag]), 'N') !== false)
                $coffee_drunk_flag = FALSE;
            else
                $coffee_drunk_flag = FALSE;

            if (strpos(strtoupper($temp11[tea_drunk_flag]), 'Y') !== false)
                $tea_drunk_flag = TRUE;
            else if (strpos(strtoupper($temp11[tea_drunk_flag]), 'N') !== false)
                $tea_drunk_flag = FALSE;
            else
                $tea_drunk_flag = FALSE;

            if (strpos(strtoupper($temp11[soya_bean_drunk_flag]), 'Y') !== false)
                $soya_bean_drunk_flag = TRUE;
            else if (strpos(strtoupper($temp11[soya_bean_drunk_flag]), 'N') !== false)
                $soya_bean_drunk_flag = FALSE;
            else
                $soya_bean_drunk_flag = FALSE;

            if (strpos(strtoupper($temp11[soya_products_flag]), 'Y') !== false)
                $soya_products_flag = TRUE;
            else if (strpos(strtoupper($temp11[soya_products_flag]), 'N') !== false)
                $soya_products_flag = FALSE;
            else
                $soya_products_flag = FALSE;

            if (strpos(strtoupper($temp11[diabetes_flag]), 'Y') !== false)
                $diabetes_flag = TRUE;
            else if (strpos(strtoupper($temp11[diabetes_flag]), 'N') !== false)
                $diabetes_flag = FALSE;
            else
                $diabetes_flag = FALSE;

            if (strpos(strtoupper($temp11[medicine_for_diabetes_flag]), 'Y') !== false)
                $medicine_for_diabetes_flag = TRUE;
            else if (strpos(strtoupper($temp11[medicine_for_diabetes_flag]), 'N') !== false)
                $medicine_for_diabetes_flag = FALSE;
            else
                $medicine_for_diabetes_flag = FALSE;

            $patient_ic_no = $temp11[0];
            $studies_name = $temp11[1];
            $studies_id = $this->excell_sheets_model->get_id('studies', 'studies_id', 'studies_name', $temp11[1]);
            $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);

            if (in_array($patient_studies_id, $result_patient_studies_id_Lifestyles1)) {
                $patient_lifestyle_factors_id = $this->excell_sheets_model->get_id('patient_lifestyle_factors', 'patient_lifestyle_factors_id', 'patient_studies_id', $patient_studies_id);
                $data_patient_lifestyle_factors_update[] = array(
                    'patient_lifestyle_factors_id' => $patient_lifestyle_factors_id,
                    'patient_studies_id' => $patient_studies_id,
                    'questionnaire_date' => $temp11[questionnaire_date],
                    'self_image_at_7years' => $temp11[self_image_at_7],
                    'self_image_at_18years' => $temp11[self_image_at_18],
                    'self_image_now' => $temp11[self_image_now],
                    'pa_strenuous_activity_childhood' => $temp11[pa_strenuous_activity_childhood],
                    'pa_moderate_exercise_childhood' => $temp11[pa_moderate_exercise_childhood],
                    'pa_gentle_exercise_childhood' => $temp11[pa_gentle_exercise_childhood],
                    'pa_strenuous_activity_now' => $temp11[pa_strenuous_activity_now],
                    'pa_moderate_exercise_now' => $temp11[pa_moderate_exercise_now],
                    'pa_gentle_exercise_now' => $temp11[pa_gentle_exercise_now],
                    'pa_strenuous_activity_adult' => $temp11[pa_strenuous_activity_adult],
                    'pa_moderate_exercise_adult' => $temp11[pa_moderate_exercise_adult],
                    'pa_gentle_exercise_adult' => $temp11[pa_gentle_exercise_adult],
                    'cigarrets_smoked_flag' => $cigarrets_smoked_flag,
                    'cigarrets_still_smoked_flag' => $cigarrets_still_smoked_flag,
                    'total_smoked_years' => $temp11[total_smoked_years],
                    'cigarrets_count_at_teen' => $temp11[cigarettes_count_at_teen],
                    'cigarrets_count_at_twenties' => $temp11[cigarettes_count_at_twenties],
                    'cigarrets_count_at_thirties' => $temp11[cigarettes_count_at_thirties],
                    'cigarrets_count_at_fourrties' => $temp11[cigarettes_count_at_fourties],
                    'cigarrets_count_at_fifties' => $temp11[cigarettes_count_at_fifties],
                    'cigarrets_count_at_sixties_and_above' => $temp11[cigarettes_count_at_sixties],
                    'cigarrets_count_one_year_before_diagnosed' => $temp11[cigarettes_count_one_year_prior],
                    'alcohol_drunk_flag' => $alcohol_drunk_flag,
                    'alcohol_frequency' => $temp11[alcohol_frequency],
                    'alcohol_comments' => $temp11[alcohol_comments],
                    'coffee_drunk_flag' => $coffee_drunk_flag,
                    'coffee_age' => $temp11[coffee_age],
                    'coffee_frequency' => $temp11[coffee_frequency],
                    'tea_drunk_flag' => $tea_drunk_flag,
                    'tea_age' => $temp11[tea_age],
                    'tea_type' => $temp11[tea_type],
                    'tea_frequency' => $temp11[tea_frequency],
                    'soya_bean_drunk_flag' => $soya_bean_drunk_flag,
                    'soya_bean_frequency' => $temp11[soya_bean_frequency],
                    'soya_products_flag' => $soya_products_flag,
                    'soya_products_average' => $temp11[soya_products_average],
                    'diabetes_flag' => $diabetes_flag,
                    'medicine_for_diabetes_flag' => $medicine_for_diabetes_flag,
                    'diabetes_medicine_name' => $temp11[diabetes_medicine_name],
                    'created_on' => $created_date
                );
            } else {
                $data_patient_lifestyle_factors[] = array(
                    'patient_studies_id' => $patient_studies_id,
                    'questionnaire_date' => $temp11[questionnaire_date],
                    'self_image_at_7years' => $temp11[self_image_at_7],
                    'self_image_at_18years' => $temp11[self_image_at_18],
                    'self_image_now' => $temp11[self_image_now],
                    'pa_strenuous_activity_childhood' => $temp11[pa_strenuous_activity_childhood],
                    'pa_moderate_exercise_childhood' => $temp11[pa_moderate_exercise_childhood],
                    'pa_gentle_exercise_childhood' => $temp11[pa_gentle_exercise_childhood],
                    'pa_strenuous_activity_now' => $temp11[pa_strenuous_activity_now],
                    'pa_moderate_exercise_now' => $temp11[pa_moderate_exercise_now],
                    'pa_gentle_exercise_now' => $temp11[pa_gentle_exercise_now],
                    'pa_strenuous_activity_adult' => $temp11[pa_strenuous_activity_adult],
                    'pa_moderate_exercise_adult' => $temp11[pa_moderate_exercise_adult],
                    'pa_gentle_exercise_adult' => $temp11[pa_gentle_exercise_adult],
                    'cigarrets_smoked_flag' => $cigarrets_smoked_flag,
                    'cigarrets_still_smoked_flag' => $cigarrets_still_smoked_flag,
                    'total_smoked_years' => $temp11[total_smoked_years],
                    'cigarrets_count_at_teen' => $temp11[cigarettes_count_at_teen],
                    'cigarrets_count_at_twenties' => $temp11[cigarettes_count_at_twenties],
                    'cigarrets_count_at_thirties' => $temp11[cigarettes_count_at_thirties],
                    'cigarrets_count_at_fourrties' => $temp11[cigarettes_count_at_fourties],
                    'cigarrets_count_at_fifties' => $temp11[cigarettes_count_at_fifties],
                    'cigarrets_count_at_sixties_and_above' => $temp11[cigarettes_count_at_sixties],
                    'cigarrets_count_one_year_before_diagnosed' => $temp11[cigarettes_count_one_year_prior],
                    'alcohol_drunk_flag' => $alcohol_drunk_flag,
                    'alcohol_frequency' => $temp11[alcohol_frequency],
                    'alcohol_comments' => $temp11[alcohol_comments],
                    'coffee_drunk_flag' => $coffee_drunk_flag,
                    'coffee_age' => $temp11[coffee_age],
                    'coffee_frequency' => $temp11[coffee_frequency],
                    'tea_drunk_flag' => $tea_drunk_flag,
                    'tea_age' => $temp11[tea_age],
                    'tea_type' => $temp11[tea_type],
                    'tea_frequency' => $temp11[tea_frequency],
                    'soya_bean_drunk_flag' => $soya_bean_drunk_flag,
                    'soya_bean_frequency' => $temp11[soya_bean_frequency],
                    'soya_products_flag' => $soya_products_flag,
                    'soya_products_average' => $temp11[soya_products_average],
                    'diabetes_flag' => $diabetes_flag,
                    'medicine_for_diabetes_flag' => $medicine_for_diabetes_flag,
                    'diabetes_medicine_name' => $temp11[diabetes_medicine_name],
                    'created_on' => $created_date
                );
            }
            $temp11 = null;
        }
        //print_r($data_patient_lifestyle_factors);
        $result_patient_studies_id_Lifestyles1 = null;
        if (!$abort) {
            if (sizeof($data_patient_lifestyle_factors) > 0) {
                $id_patient_lifestyle_factors = $this->excell_sheets_model->insert_record($data_patient_lifestyle_factors, 'patient_lifestyle_factors');
                if ($id_patient_lifestyle_factors > 0)
                    echo 'Data added succesfully at patient_lifestyle_factors table';
                else
                    echo 'Failed to insert at patient_lifestyle_factors table';
                echo '<br/>';
                $data_patient_lifestyle_factors = null;
            }


            if (sizeof($data_patient_lifestyle_factors_update) > 0) {
                $id_patient_lifestyle_factors = $this->db->update_batch('patient_lifestyle_factors', $data_patient_lifestyle_factors_update, 'patient_lifestyle_factors_id');
                if ($id_patient_lifestyle_factors > 0)
                    echo 'Data updated succesfully at patient_lifestyle_factors table';
                else
                    echo 'Updated Data at patient_lifestyle_factors table';
                echo '<br/>';
                $data_patient_lifestyle_factors_update = null;
            }
        }


        $data_patient_lifestyle_factors = null;
        $data_patient_lifestyle_factors_update = null;
        $temp_result_patient_studies_id = null;
        $temp11 = null;
    }

}

?>
