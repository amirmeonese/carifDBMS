<?php

class ModelCounselling extends CI_Model {

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

    public function Counselling($sheet) {
        $created_date = date('Y-m-d H:i:s');
        $abort = FALSE;
        $temp14 = array();
        $data_patient_interview_manager = array();
        $data_patient_interview_manager = null;
        $data_patient_interview_manager_update = array();
        $data_patient_interview_manager_update = null;
        $temp_patient_interview_manager_id = array();
        $temp_patient_interview_manager_id = null;
        $this->db->select('patient_interview_manager_id');
        $this->db->from('patient_interview_manager');
        $temp_patient_interview_manager_id = $this->db->get()->result_array();

        //print_r($temp_result_relationship);
        $result_patient_interview_manager_id = array();
        for ($i = 0; $i < sizeof($temp_patient_interview_manager_id); $i++) {
            $result_patient_interview_manager_id[$i] = $temp_patient_interview_manager_id[$i]['patient_interview_manager_id'];
        }
        $temp_patient_interview_manager_id = null;
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

                if ($key == 0 && $cell_value != NULL)
                    $cell_value = preg_replace("/[^0-9]/", "", $cell_value);

                if ($key == 1 && $cell_value != NULL)
                    $cell_value = trim($cell_value);

                if (($key == 2 || $key == 3) && $cell_value != NULL) {
                    //$cell_value = preg_replace("/[^0-9\/]/", "", $cell_value);
                    if ($cell_value == "")
                        $cell_value = NULL;
                    else
                        $cell_value == '0000-00-00' ? NULL : date('Y-m-d', strtotime(str_replace('/', '-', $cell_value)));
                }

                //echo $key; // 0, 1, 2..
                $temp14[] = $cell_value;
            }

            if ($abort)
                break;

            if (strpos(strtoupper($temp14[4]), 'Y') !== false)
                $is_send_email_reminder_to_officers = TRUE;
            else if (strpos(strtoupper($temp14[4]), 'N') !== false)
                $is_send_email_reminder_to_officers = FALSE;
            else
                $is_send_email_reminder_to_officers = FALSE;

            $patient_ic_no = $temp14[0];
            $patient_interview_manager_id = $this->excell_sheets_model->get_id('patient_interview_manager', 'patient_interview_manager_id', 'patient_ic_no', $patient_ic_no);

            if (in_array($patient_interview_manager_id, $result_patient_interview_manager_id)) {
                $data_patient_interview_manager_update[] = array(
                    'patient_interview_manager_id' => $patient_interview_manager_id,
                    'patient_ic_no' => $patient_ic_no,
                    'created_on' => $created_date,
                    'comments' => $temp14[1],
                    'interview_date' => $temp14[2],
                    'next_interview_date' => $temp14[3],
                    'is_send_email_reminder_to_officers' => $is_send_email_reminder_to_officers,
                    'officer_email_addresses' => $temp14[5],
                    'interview_interval' => $temp14[6]
                );
            } else {
                $data_patient_interview_manager[] = array(
                    'patient_ic_no' => $patient_ic_no,
                    'created_on' => $created_date,
                    'comments' => $temp14[1],
                    'interview_date' => $temp14[2],
                    'next_interview_date' => $temp14[3],
                    'is_send_email_reminder_to_officers' => $is_send_email_reminder_to_officers,
                    'officer_email_addresses' => $temp14[5],
                    'interview_interval' => $temp14[6]
                );
            }
            $temp14 = null;
        }
        //print_r($data_patient_Lifestyle3);
        $result_patient_interview_manager_id = null;

        if (!$abort) {
            if (sizeof($data_patient_interview_manager) > 0) {
                $id_patient_interview_manager = $this->excell_sheets_model->insert_record($data_patient_interview_manager, 'patient_interview_manager');

                if ($id_patient_interview_manager > 0)
                    echo 'Data added succesfully at patient_interview_manager table';
                else
                    echo 'Failed to insert at patient_interview_manager table';
                echo '<br/>';
                $data_patient_interview_manager = null;
            }

            if (sizeof($data_patient_interview_manager_update) > 0) {
                $id_patient_interview_manager = $this->db->update_batch('patient_interview_manager', $data_patient_interview_manager_update, 'patient_interview_manager_id');

                if ($id_patient_interview_manager > 0)
                    echo 'Data updated succesfully at patient_interview_manager table';
                else
                    echo 'Updated Data at patient_interview_manager table';
                echo '<br/>';
                $data_patient_interview_manager_update = null;
            }
        }


        $data_patient_interview_manager = null;
        $data_patient_interview_manager_update = null;
        $temp_patient_interview_manager_id = null;
        $result_patient_interview_manager_id = null;
    }

}
?>

