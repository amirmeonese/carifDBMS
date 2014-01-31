<?php

class ModelScreening5 extends CI_Model {

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

    public function Screening5($sheet) {
        $created_date = date('Y-m-d H:i:s');
        $abort = FALSE; 
        $temp8 = array();
        $data_patient_surveillance = array();
        $data_patient_surveillance = null;
        $data_patient_surveillance_update = array();
        $data_patient_surveillance_update = null;

        $temp_result_patient_studies_id = array();
        $temp_result_patient_studies_id = null;
        $this->db->select('patient_studies_id');
        $this->db->from('patient_surveillance');
        $temp_result_patient_studies_id = $this->db->get()->result_array();

        //print_r($temp_result_relationship);
        $result_patient_studies_id = array();
        for ($i = 0; $i < sizeof($temp_result_patient_studies_id); $i++) {
            //echo $result_relationship[$j]['relatives_type']. '<br/>';
            $result_patient_studies_id[$i] = $temp_result_patient_studies_id[$i]['patient_studies_id'];
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
            
            $temp8 = null;
            foreach ($cellIterator as $key => $cell) {
                $cell_value = $cell->getFormattedValue();

                if ($key == 0 && $cell_value != NULL)
                    $cell_value = preg_replace("/[^0-9]/", "", $cell_value);

                if ($key == 1 && $cell_value != NULL)
                    $cell_value = trim($cell_value);
                
                if ($key == 2 && $cell_value == NULL)
                    $cell_value = 'None';
                //echo $key; // 0, 1, 2..
                /*if (($key == 4 || $key == 8 || $key == 9 || $key == 10) && $cell_value != NULL) {
                                if (strpos($cell_value, '-') !== FALSE)
                                    $cell_value = date("d/m/Y", strtotime($cell_value));
                                list($day, $month, $year) = explode("/", $cell_value);

                                if (!checkdate($month, $day, $year)) {
                                    if($key == 4)
                                    $this->modelValitor->showMessage("date_of_diagnosis","Sreening and Surveilance5",$i);
                                    
                                    if($key == 8)
                                    $this->modelValitor->showMessage("first_consultation_date","Sreening and Surveilance5",$i);
                                    
                                    if($key == 9)
                                    $this->modelValitor->showMessage("reminder_sent_date","Sreening and Surveilance5",$i);
                                    
                                    if($key == 10)
                                    $this->modelValitor->showMessage("surveillance_done_date","Sreening and Surveilance5",$i);

                                    $abort = TRUE;
                                    break;
                                }
                            }
                            
                    if ($key == 4 || $key == 8 || $key == 9 || $key == 10) {
                    if ($cell_value != NULL) {
                        $cell_value = date('Y-m-d', strtotime(str_replace('/', '-', $cell_value)));
                    }
                }*/
                $temp8[] = $cell_value;
            }

            if($abort)
            break;
            
            $patient_ic_no = $temp8[0]; //echo $patient_ic_no.'          ';
            $studies_name = $temp8[1]; //echo $studies_name.'           ';
            $studies_id = $this->excell_sheets_model->get_id('studies', 'studies_id', 'studies_name', $studies_name);
            $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);
            //echo $patient_studies_id.'<br/>';

            if (in_array($patient_studies_id, $result_patient_studies_id)) {
                $data_patient_surveillance_update[] = array(
                    'patient_studies_id' => $patient_studies_id,
                    'recruitment_center' => $temp8[recruitment_center],
                    'type' => $temp8[surveillance_type],
                    'first_consultation_date' => $temp8[first_consultation_date],
                    'first_consultation_place' => $temp8[first_consultation_place],
                    'surveillance_interval' => $temp8[interval],
                    'diagnosis' => $temp8[diagnosis],
                    'due_date' => $temp8[due_date],
                    'reminder_sent_date' => $temp8[reminder_sent_date],
                    'surveillance_done_date' => $temp8[surveillance_done_date],
                    'reminded_by' => $temp8[reminded_by],
                    'timing' => $temp8[timing],
                    'symptoms' => $temp8[symptoms],
                    'doctor_name' => $temp8[doctor_name],
                    'surveillance_done_place' => $temp8[survillance_done_place],
                    'outcome' => $temp8[outcome],
                    'comments' => $temp8[comments],
                    'created_on' => $created_date
                );
            } else {
                $data_patient_surveillance[] = array(
                    'patient_studies_id' => $patient_studies_id,
                    'recruitment_center' => $temp8[recruitment_center],
                    'type' => $temp8[surveillance_type],
                    'first_consultation_date' => $temp8[first_consultation_date],
                    'first_consultation_place' => $temp8[first_consultation_place],
                    'surveillance_interval' => $temp8[interval],
                    'diagnosis' => $temp8[diagnosis],
                    'due_date' => $temp8[due_date],
                    'reminder_sent_date' => $temp8[reminder_sent_date],
                    'surveillance_done_date' => $temp8[surveillance_done_date],
                    'reminded_by' => $temp8[reminded_by],
                    'timing' => $temp8[timing],
                    'symptoms' => $temp8[symptoms],
                    'doctor_name' => $temp8[doctor_name],
                    'surveillance_done_place' => $temp8[survillance_done_place],
                    'outcome' => $temp8[outcome],
                    'comments' => $temp8[comments],
                    'created_on' => $created_date
                );
            }
            $temp8 = null;
        }
        //print_r($data_patient_surveillance);
        $result_patient_studies_id = null;
        
        if(!$abort)
        {
            if (sizeof($data_patient_surveillance) > 0) {
            $id_patient_surveillance = $this->excell_sheets_model->insert_record($data_patient_surveillance, 'patient_surveillance');
            if ($id_patient_surveillance > 0)
                echo 'Data added succesfully at patient_surveillance table';
            else
                echo 'Failed to insert at patient_surveillance table';
            echo '<br/>';
            $data_patient_surveillance = null;
            }

            if (sizeof($data_patient_surveillance_update) > 0) {
                $id_patient_surveillance = $this->db->update_batch('patient_surveillance', $data_patient_surveillance_update, 'patient_studies_id');
                if ($id_patient_surveillance > 0)
                    echo 'Data updated succesfully at patient_surveillance table';
                else
                    echo 'Updated Datad at patient_surveillance table';
                echo '<br/>';
                $data_patient_surveillance = null;
            }
        }
        

        $data_patient_surveillance = null;
        $data_patient_surveillance_update = null;
        $temp_result_patient_studies_id = null;
        $result_patient_studies_id = null;
    }

}

?>
