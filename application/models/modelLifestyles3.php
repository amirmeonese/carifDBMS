<?php

class ModelLifestyles3 extends CI_Model {

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

    public function Lifestyles3($sheet) {
        $created_date = date('Y-m-d H:i:s');
        $abort = FALSE;
        $temp13 = array();
        $data_patient_parity_record = array();
        $data_patient_parity_record = null;
        $data_patient_parity_record_update = array();
        $data_patient_parity_record_update = null;
        $temp_patient_parity_table_id = array();
        $temp_patient_parity_table_id = null;
        $this->db->select('patient_parity_table_id');
        $this->db->from('patient_parity_record');
        $temp_patient_parity_table_id = $this->db->get()->result_array();

        //print_r($temp_result_relationship);
        $result_patient_parity_table_id = array();
        for ($i = 0; $i < sizeof($temp_patient_parity_table_id); $i++) {
            $result_patient_parity_table_id[$i] = $temp_patient_parity_table_id[$i]['patient_parity_table_id'];
        }
        $temp_patient_parity_table_id = null;
        $i = 0;
        foreach ($sheet->getRowIterator() as $row) {
            $i++;

            if ($i == 1)//ommiting cell header name
                continue;

            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            $temp13 = null;
            foreach ($cellIterator as $key => $cell) {
                $cell_value = $cell->getFormattedValue();

                if ($key == 0 && $cell_value != NULL)
                    $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
                
                if ($key == 1 && $cell_value != NULL)
                    $cell_value = trim($cell_value);
                
                if ($key == 4) {
                    //$cell_value = preg_replace("/[^0-9\/]/", "", $cell_value);
                    if ($cell_value == "")
                        $cell_value = NULL;
                    else
                        $cell_value == '0000-00-00' ? NULL :  date('Y-m-d', strtotime(str_replace('/', '-', $cell_value)));
                }

                //echo $key; // 0, 1, 2..
                $temp13[] = $cell_value;
            }

            if ($abort)
                break;

            $patient_ic_no = $temp13[0];
            $studies_name = $temp13[1];
            $studies_id = $this->excell_sheets_model->get_id('studies', 'studies_id', 'studies_name', $studies_name);
            $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id); //echo $patient_studies_id.'    ';
            $patient_parity_table_id = $this->excell_sheets_model->get_patient_parity_table_id($patient_studies_id); //echo $patient_parity_table_id.'<br/>';
            //echo $patient_parity_table_id . ' row '.$i.'<br/>';
            if (in_array($patient_parity_table_id, $result_patient_parity_table_id)) {
                $patient_parity_record_id = $this->excell_sheets_model->get_id('patient_parity_record', 'patient_parity_record_id', 'patient_parity_table_id', $patient_parity_table_id);
                $data_patient_parity_record_update[] = array(
                    'patient_parity_record_id' => $patient_parity_record_id,
                    'patient_parity_table_id' => $patient_parity_table_id,
                    'pregnancy_type' => $temp13[2],
                    'gender' => $temp13[3],
                    'date_of_birth' => $temp13[4],
                    'year_of_birth' => $temp13[5],
                    'age_child_at_consent' => $temp13[6],
                    'birthweight' => $temp13[7],
                    'breastfeeding_duration' => $temp13[8],
                    'created_on' => $created_date
                );
            } else {
                $data_patient_parity_record[] = array(
                    'patient_parity_table_id' => $patient_parity_table_id,
                    'pregnancy_type' => $temp13[2],
                    'gender' => $temp13[3],
                    'date_of_birth' => $temp13[4],
                    'year_of_birth' => $temp13[5],
                    'age_child_at_consent' => $temp13[6],
                    'birthweight' => $temp13[7],
                    'breastfeeding_duration' => $temp13[8],
                    'created_on' => $created_date
                );
            }
            $temp13 = null;
        }
        //print_r($data_patient_Lifestyle3);
        $result_patient_parity_table_id = null;

        if (!$abort) {
            if (sizeof($data_patient_parity_record) > 0) {
                $id_patient_parity_record = $this->excell_sheets_model->insert_record($data_patient_parity_record, 'patient_parity_record');

                if ($id_patient_parity_record > 0)
                    echo 'Data added succesfully at patient_parity_record table';
                else
                    echo 'Failed to insert at patient_parity_record table';
                echo '<br/>';
                $data_patient_parity_record = null;
            }

            if (sizeof($data_patient_parity_record_update) > 0) {
                $id_patient_parity_record = $this->db->update_batch('patient_parity_record', $data_patient_parity_record_update, 'patient_parity_record_id');

                if ($id_patient_parity_record > 0)
                    echo 'Data updated succesfully at patient_parity_record table';
                else
                    echo 'Updated Data at patient_parity_record table';
                echo '<br/>';
                $data_patient_parity_record_update = null;
            }
        }


        $data_patient_parity_record = null;
        $data_patient_parity_record_update = null;
        $temp_patient_parity_table_id = null;
        $result_patient_parity_table_id = null;
    }

}

?>
