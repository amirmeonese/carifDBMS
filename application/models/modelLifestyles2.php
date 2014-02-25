<?php

class ModelLifestyles2 extends CI_Model {

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

    public function Lifestyles2($sheet) {
        $created_date = date('Y-m-d H:i:s');
        $temp12 = array();
        $abort = FALSE;
        $data_patient_menstruation = array();
        $data_patient_menstruation = null;
        $data_patient_menstruation_update = array();
        $data_patient_menstruation_update = null;
        $data_patient_infertility = array();
        $data_patient_infertility = null;
        $data_patient_infertility_update = array();
        $data_patient_infertility_update = null;
        $data_patient_gynaecological_surgery_history = array();
        $data_patient_gynaecological_surgery_history = null;
        $data_patient_gynaecological_surgery_history_update = array();
        $data_patient_gynaecological_surgery_history_update = null;
        $data_patient_parity_table = array();
        $data_patient_parity_table = null;
        $data_patient_parity_table_update = array();
        $data_patient_parity_table_update = null;

        $temp_result_pt_studies_id_patient_menstruation = array();
        $temp_result_pt_studies_id_patient_menstruation = null;
        $this->db->select('patient_studies_id');
        $this->db->from('patient_menstruation');
        $temp_result_pt_studies_id_patient_menstruation = $this->db->get()->result_array();

        //print_r($temp_result_relationship);
        $result_pt_studies_id_pt_menstruation = array();
        for ($i = 0; $i < sizeof($temp_result_pt_studies_id_patient_menstruation); $i++) {
            //echo $result_relationship[$j]['relatives_type']. '<br/>';
            $result_pt_studies_id_pt_menstruation[$i] = $temp_result_pt_studies_id_patient_menstruation[$i]['patient_studies_id'];
            //echo $result_studies_name[$i] . '<br/>';
        }
        $temp_result_pt_studies_id_patient_menstruation = null;

        $temp_result_pt_studies_id_pt_parity_table = array();
        $temp_result_pt_studies_id_pt_parity_table = null;
        $this->db->select('patient_studies_id');
        $this->db->from('patient_parity_table');
        $temp_result_pt_studies_id_pt_parity_table = $this->db->get()->result_array();

        //print_r($temp_result_relationship);
        $result_pt_studies_id_pt_parity_table = array();
        for ($i = 0; $i < sizeof($temp_result_pt_studies_id_pt_parity_table); $i++) {
            //echo $result_relationship[$j]['relatives_type']. '<br/>';
            $result_pt_studies_id_pt_parity_table[$i] = $temp_result_pt_studies_id_pt_parity_table[$i]['patient_studies_id'];
            //echo $result_studies_name[$i] . '<br/>';
        }
        $temp_result_pt_studies_id_pt_parity_table = null;

        $temp_result_pt_studies_id_pt_infertility = array();
        $temp_result_pt_studies_id_pt_infertility = null;
        $this->db->select('patient_studies_id');
        $this->db->from('patient_infertility');
        $temp_result_pt_studies_id_pt_infertility = $this->db->get()->result_array();

        //print_r($temp_result_relationship);
        $result_pt_studies_id_pt_infertility = array();
        for ($i = 0; $i < sizeof($temp_result_pt_studies_id_pt_infertility); $i++) {
            //echo $result_relationship[$j]['relatives_type']. '<br/>';
            $result_pt_studies_id_pt_infertility[$i] = $temp_result_pt_studies_id_pt_infertility[$i]['patient_studies_id'];
            //echo $result_studies_name[$i] . '<br/>';
        }
        $temp_result_pt_studies_id_pt_infertility = null;

        $temp_pt_studies_id_pt_gyn_srg_history = array();
        $temp_pt_studies_id_pt_gyn_srg_history = null;
        $this->db->select('patient_studies_id');
        $this->db->from('patient_gynaecological_surgery_history');
        $temp_pt_studies_id_pt_gyn_srg_history = $this->db->get()->result_array();

        //print_r($temp_result_relationship);
        $result_pt_studies_id_pt_gyn_srg_history = array();
        for ($i = 0; $i < sizeof($temp_pt_studies_id_pt_gyn_srg_history); $i++) {
            //echo $result_relationship[$j]['relatives_type']. '<br/>';
            $result_pt_studies_id_pt_gyn_srg_history[$i] = $temp_pt_studies_id_pt_gyn_srg_history[$i]['patient_studies_id'];
            //echo $result_studies_name[$i] . '<br/>';
        }
        $temp_pt_studies_id_pt_gyn_srg_history = null;

        $i = 0;
        foreach ($sheet->getRowIterator() as $row) {
            $i++;

            if ($i == 1)//ommiting cell header name
                continue;

            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            $temp12 = null;
            foreach ($cellIterator as $key => $cell) {
                $cell_value = $cell->getFormattedValue();

                if ($key == 0 && $cell_value != NULL)
                    $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
                //echo $key; // 0, 1, 2..
                if ($key == 32)
                    $cell_value = 'None';

                if (($key == 19 || $key == 20 || $key == 24 || $key == 25) && $cell_value != NULL) {
                    $cell_value = preg_replace("/[^0-9\/]/", "", $cell_value);
                    if ($cell_value == "")
                        $cell_value = '0000-00-00';
                    else
                        $cell_value = date('Y-m-d', strtotime(str_replace('/', '-', $cell_value)));
                }

                $temp12[] = $cell_value;
            }

            if (strpos(strtoupper($temp12[3]), 'Y') !== false)
                $still_period_flag = TRUE;
            else if (strpos(strtoupper($temp12[3]), 'N') !== false)
                $still_period_flag = FALSE;
            else
                $still_period_flag = FALSE;


            $patient_ic_no = $temp12[0];
            $studies_id = $this->excell_sheets_model->get_id('studies', 'studies_id', 'studies_name', $temp12[1]);
            $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);

            if (in_array($patient_studies_id, $result_pt_studies_id_pt_menstruation)) {
                $data_patient_menstruation_update[] = array(
                    'patient_studies_id' => $patient_studies_id,
                    'age_period_starts' => $temp12[2],
                    'still_period_flag' => $still_period_flag,
                    'period_type' => $temp12[4],
                    'period_cycle_days' => $temp12[5],
                    'period_cycle_days_other_details' => $temp12[6],
                    'age_at_menopause' => $temp12[7],
                    'reason_period_stops' => $temp12[8],
                    'date_period_stops' => $temp12[9],
                    'reason_period_stops_other_details' => $temp12[10],
                    'created_on' => $created_date
                );
            } else {
                $data_patient_menstruation[] = array(
                    'patient_studies_id' => $patient_studies_id,
                    'age_period_starts' => $temp12[2],
                    'still_period_flag' => $still_period_flag,
                    'period_type' => $temp12[4],
                    'period_cycle_days' => $temp12[5],
                    'period_cycle_days_other_details' => $temp12[6],
                    'age_at_menopause' => $temp12[7],
                    'reason_period_stops' => $temp12[8],
                    'date_period_stops' => $temp12[9],
                    'reason_period_stops_other_details' => $temp12[10],
                    'created_on' => $created_date
                );
            }


            if (strpos(strtoupper($temp12[11]), 'Y') !== false)
                $pregnant_flag = TRUE;
            else if (strpos(strtoupper($temp12[11]), 'N') !== false)
                $pregnant_flag = FALSE;
            else
                $pregnant_flag = FALSE;

            if (in_array($patient_studies_id, $result_pt_studies_id_pt_parity_table)) {
                $data_patient_parity_table_update[] = array(
                    'patient_studies_id' => $patient_studies_id,
                    'pregnant_flag' => $pregnant_flag,
                    'created_on' => $created_date
                );
            } else {
                $data_patient_parity_table[] = array(
                    'patient_studies_id' => $patient_studies_id,
                    'pregnant_flag' => $pregnant_flag,
                    'created_on' => $created_date
                );
            }


            if (strpos(strtoupper($temp12[12]), 'Y') !== false)
                $infertility_testing_flag = TRUE;
            else if (strpos(strtoupper($temp12[12]), 'N') !== false)
                $infertility_testing_flag = FALSE;
            else
                $infertility_testing_flag = FALSE;

            if (strpos(strtoupper($temp12[16]), 'Y') !== false)
                $contraceptive_pills_flag = TRUE;
            else if (strpos(strtoupper($temp12[16]), 'N') !== false)
                $contraceptive_pills_flag = FALSE;
            else
                $contraceptive_pills_flag = FALSE;

            if (strpos(strtoupper($temp12[17]), 'Y') !== false)
                $currently_taking_contraceptive_pills_flag = TRUE;
            else if (strpos(strtoupper($temp12[17]), 'N') !== false)
                $currently_taking_contraceptive_pills_flag = FALSE;
            else
                $currently_taking_contraceptive_pills_flag = FALSE;

            if (strpos(strtoupper($temp12[21]), 'Y') !== false)
                $hrt_flag = TRUE;
            else if (strpos(strtoupper($temp12[21]), 'N') !== false)
                $hrt_flag = FALSE;
            else
                $hrt_flag = FALSE;

            if (strpos(strtoupper($temp12[22]), 'Y') !== false)
                $currently_using_hrt_flag = TRUE;
            else if (strpos(strtoupper($temp12[22]), 'N') !== false)
                $currently_using_hrt_flag = FALSE;
            else
                $currently_using_hrt_flag = FALSE;

            if (in_array($patient_studies_id, $result_pt_studies_id_pt_infertility)) {
                $data_patient_infertility_update[] = array(
                    'patient_studies_id' => $patient_studies_id,
                    'infertility_testing_flag' => $infertility_testing_flag,
                    'infertility_treatment_type' => $temp12[13],
                    'infertility_treatment_duration' => $temp12[14],
                    'infertility_comments' => $temp12[15],
                    'contraceptive_pills_flag' => $contraceptive_pills_flag,
                    'currently_taking_contraceptive_pills_flag' => $currently_taking_contraceptive_pills_flag,
                    'contraceptive_start_date' => $temp12[19],
                    'contraceptive_end_date' => $temp12[20],
                    'contraceptive_duration' => $temp12[18],
                    'hrt_flag' => $hrt_flag,
                    'currently_using_hrt_flag' => $currently_using_hrt_flag,
                    'hrt_start_date' => $temp12[24],
                    'hrt_end_date' => $temp12[25],
                    'hrt_duration' => $temp12[23],
                    'created_on' => $created_date,
                    'contraceptive_end_age' => $temp12[26],
                    'contraceptive_start_age' => $temp12[27],
                    'hrt_start_age' => $temp12[28],
                    'hrt_end_age' => $temp12[29]
                );
            } else {
                $data_patient_infertility[] = array(
                    'patient_studies_id' => $patient_studies_id,
                    'infertility_testing_flag' => $infertility_testing_flag,
                    'infertility_treatment_type' => $temp12[13],
                    'infertility_treatment_duration' => $temp12[14],
                    'infertility_comments' => $temp12[15],
                    'contraceptive_pills_flag' => $contraceptive_pills_flag,
                    'currently_taking_contraceptive_pills_flag' => $currently_taking_contraceptive_pills_flag,
                    'contraceptive_start_date' => $temp12[19],
                    'contraceptive_end_date' => $temp12[20],
                    'contraceptive_duration' => $temp12[18],
                    'hrt_flag' => $hrt_flag,
                    'currently_using_hrt_flag' => $currently_using_hrt_flag,
                    'hrt_start_date' => $temp12[24],
                    'hrt_end_date' => $temp12[25],
                    'hrt_duration' => $temp12[23],
                    'created_on' => $created_date,
                    'contraceptive_end_age' => $temp12[26],
                    'contraceptive_start_age' => $temp12[27],
                    'hrt_start_age' => $temp12[28],
                    'hrt_end_age' => $temp12[29]
                );
            }


            if (strpos(strtoupper($temp12[30]), 'Y') !== false)
                $had_gnc_surgery_flag = TRUE;
            else if (strpos(strtoupper($temp12[30]), 'N') !== false)
                $had_gnc_surgery_flag = FALSE;
            else
                $had_gnc_surgery_flag = FALSE;

            $treatment_Id = $this->excell_sheets_model->get_id('treatment', 'treatment_id', 'treatment_name', $temp12[32]);

            if (in_array($patient_studies_id, $result_pt_studies_id_pt_gyn_srg_history)) {
                $data_patient_gynaecological_surgery_history_update[] = array(
                    'patient_studies_id' => $patient_studies_id,
                    'had_gnc_surgery_flag' => $had_gnc_surgery_flag,
                    'surgery_year' => $temp12[31],
                    'treatment_id' => $treatment_Id,
                    'gnc_treatment_name_other_details' => $temp12[33],
                    'created_on' => $created_date
                );
            } else {
                $data_patient_gynaecological_surgery_history[] = array(
                    'patient_studies_id' => $patient_studies_id,
                    'had_gnc_surgery_flag' => $had_gnc_surgery_flag,
                    'surgery_year' => $temp12[31],
                    'treatment_id' => $treatment_Id,
                    'gnc_treatment_name_other_details' => $temp12[33],
                    'created_on' => $created_date
                );
            }
            $temp12 = null;
        }
        $result_pt_studies_id_pt_menstruation = null;
        $result_pt_studies_id_pt_parity_table = null;
        $result_pt_studies_id_pt_infertility = null;
        //print_r($data_patient_menstruation);
        //print_r($data_patient_parity_table);
        // print_r($data_patient_infertility);
        // print_r($data_patient_gynaecological_surgery_history);

        if (sizeof($data_patient_menstruation) > 0) {
            $id_patient_menstruation = $this->excell_sheets_model->insert_record($data_patient_menstruation, 'patient_menstruation');
            if ($id_patient_menstruation > 0)
                echo 'Data added succesfully at patient_menstruation table';
            else
                echo 'Failed to insert at patient_menstruation table';
            echo '<br/>';
            $data_patient_menstruation = null;
        }


        if (sizeof($data_patient_menstruation_update) > 0) {
            $id_patient_menstruation = $this->db->update_batch('patient_menstruation', $data_patient_menstruation_update, 'patient_studies_id');
            if ($id_patient_menstruation > 0)
                echo 'Data updated succesfully at patient_menstruation table';
            else
                echo 'Updated Data at patient_menstruation table';
            echo '<br/>';
            $data_patient_menstruation_update = null;
        }

        if (sizeof($data_patient_parity_table) > 0) {
            $id_patient_parity_table = $this->excell_sheets_model->insert_record($data_patient_parity_table, 'patient_parity_table');
            if ($id_patient_parity_table > 0)
                echo 'Data added succesfully at patient_parity_table table';
            else
                echo 'Failed to insert at patient_parity_table table';
            echo '<br/>';
            $data_patient_parity_table = null;
        }


        if (sizeof($data_patient_parity_table_update) > 0) {
            $id_patient_parity_table = $this->db->update_batch('patient_parity_table', $data_patient_parity_table_update, 'patient_studies_id');
            if ($id_patient_parity_table > 0)
                echo 'Data updated succesfully at patient_parity_table table';
            else
                echo 'Updated Data at patient_parity_table table';
            echo '<br/>';
            $data_patient_parity_table_update = null;
        }

        if (sizeof($data_patient_infertility) > 0) {
            $id_patient_infertility = $this->excell_sheets_model->insert_record($data_patient_infertility, 'patient_infertility');
            if ($id_patient_infertility > 0)
                echo 'Data added succesfully at patient_infertility table';
            else
                echo 'Failed to insert at patient_infertility table';
            echo '<br/>';
            $data_patient_infertility = null;
        }

        if (sizeof($data_patient_infertility_update) > 0) {
            $id_patient_infertility = $this->db->update_batch('patient_infertility', $data_patient_infertility_update, 'patient_studies_id');
            if ($id_patient_infertility > 0)
                echo 'Data updated succesfully at patient_infertility table';
            else
                echo 'Updated Data at patient_infertility table';
            echo '<br/>';
            $data_patient_infertility_update = null;
        }

        if (sizeof($data_patient_gynaecological_surgery_history) > 0) {
            $id_patient_gynaecological_surgery_history = $this->excell_sheets_model->insert_record($data_patient_gynaecological_surgery_history, 'patient_gynaecological_surgery_history');
            if ($id_patient_gynaecological_surgery_history > 0)
                echo 'Data added succesfully at patient_gynaecological_surgery_history table';
            else
                echo 'Failed to insert at patient_gynaecological_surgery_history table';
            echo '<br/>';
            $data_patient_gynaecological_surgery_history = null;
        }

        if (sizeof($data_patient_gynaecological_surgery_history_update) > 0) {
            $id_patient_gynaecological_surgery_history = $this->db->update_batch('patient_gynaecological_surgery_history', $data_patient_gynaecological_surgery_history_update, 'patient_studies_id');
            if ($id_patient_gynaecological_surgery_history > 0)
                echo 'Data updated succesfully at patient_gynaecological_surgery_history table';
            else
                echo 'Updated Data at patient_gynaecological_surgery_history table';
            echo '<br/>';
            $data_patient_gynaecological_surgery_history_update = null;
        }

        $data_patient_menstruation = null;
        $data_patient_menstruation_update = null;
        $data_patient_parity_table_update = null;
        $data_patient_infertility = null;
        $data_patient_infertility_update = null;
        $data_patient_gynaecological_surgery_history = null;
        $data_patient_gynaecological_surgery_history_update = null;
        $data_patient_parity_table = null;
        $data_patient_parity_table_update = null;
        $temp_result_pt_studies_id_patient_menstruation = null;
        $result_pt_studies_id_pt_menstruation = null;
        $temp_result_pt_studies_id_pt_parity_table = null;
        $result_pt_studies_id_pt_parity_table = null;
        $temp_result_pt_studies_id_pt_infertility = null;
        $result_pt_studies_id_pt_infertility = null;
        $temp_pt_studies_id_pt_gyn_srg_history = null;
        $result_pt_studies_id_pt_gyn_srg_history = null;
    }

}

?>
