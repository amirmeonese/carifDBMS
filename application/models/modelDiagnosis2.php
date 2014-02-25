<?php

class ModelDiagnosis2 extends CI_Model {

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

    public function Diagnosis2($sheet) {
        $created_date = date('Y-m-d H:i:s');
        $abort = FALSE;
        $data_patient_other_disease = array();
        $data_patient_other_disease = null;
        $data_patient_other_disease_update = array();
        $data_patient_other_disease_update = null;
        $data_patient_other_disease_medication = array();
        $data_patient_other_disease_medication = null;

        $temp_pt_studies_id_pt_other_disease = array();
        $temp_pt_studies_id_pt_other_disease = null;
        $this->db->select('patient_studies_id');
        $this->db->from('patient_other_disease');
        $temp_pt_studies_id_pt_other_disease = $this->db->get()->result_array();

        //print_r($temp_pt_risk_reduc_surgery_id_pt_risk_red_surgery_lesion);
        $result_pt_studies_id_pt_other_disease = array();
        for ($i = 0; $i < sizeof($temp_pt_studies_id_pt_other_disease); $i++) {
            $result_pt_studies_id_pt_other_disease [$i] = $temp_pt_studies_id_pt_other_disease[$i]['patient_studies_id'];
        }
        $temp_pt_studies_id_pt_other_disease = null;

        $temp_pt_diagnosis_id_pt_other_disease = array();
        $temp_pt_diagnosis_id_pt_other_disease = null;
        $this->db->select('diagnosis_id');
        $this->db->from('patient_other_disease');
        $temp_pt_diagnosis_id_pt_other_disease = $this->db->get()->result_array();

        //print_r($temp_pt_risk_reduc_surgery_id_pt_risk_red_surgery_lesion);
        $result_pt_diagnosis_id_pt_other_disease = array();
        for ($i = 0; $i < sizeof($temp_pt_diagnosis_id_pt_other_disease); $i++) {
            $result_pt_diagnosis_id_pt_other_disease [$i] = $temp_pt_diagnosis_id_pt_other_disease[$i]['diagnosis_id'];
        }
        $temp_pt_diagnosis_id_pt_other_disease = null;

        $temp_pt_other_dis_id_pt_other_dis_medic = array();
        $temp_pt_other_dis_id_pt_other_dis_medic = null;
        $this->db->select('patient_other_disease_id');
        $this->db->from('patient_other_disease_medication');
        $temp_pt_other_dis_id_pt_other_dis_medic = $this->db->get()->result_array();

        //print_r($temp_pt_risk_reduc_surgery_id_pt_risk_red_surgery_lesion);
        $result_pt_other_dis_id_pt_other_dis_medic = array();
        for ($i = 0; $i < sizeof($temp_pt_other_dis_id_pt_other_dis_medic); $i++) {
            $result_pt_other_dis_id_pt_other_dis_medic [$i] = $temp_pt_other_dis_id_pt_other_dis_medic[$i]['patient_other_disease_id'];
        }
        $temp_pt_other_dis_id_pt_other_dis_medic = null;

        $Diagnosis2_patient_studies_id = array();
        $Diagnosis2_patient_studies_id = null;
        $Diagnosis2_diagnosis_id = array();
        $Diagnosis2_diagnosis_id = null;
        $temp14 = array();

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

                if ($key == 2 && $cell_value == NULL)
                    $cell_value = 'None';

                if ($key == 2 && $cell_value != NULL)
                    $cell_value = trim($cell_value);
                //echo $key; // 0, 1, 2..
                if (($key == 3 || $key == 9 || $key == 10) && $cell_value != NULL) {
                    /*if (strpos($cell_value, '-') !== FALSE)
                        $cell_value = date("d/m/Y", strtotime($cell_value));
                    list($day, $month, $year) = explode("/", $cell_value);

                    if (!checkdate($month, $day, $year)) {
                       
                        if ($key == 3)
                            $this->model_Validator->showMessage("date_of_birth", "Diagnosis & Treatment2", $i);
                        if ($key == 9)
                            $this->model_Validator->showMessage("medication_start_date", "Diagnosis & Treatment2", $i);
                        if ($key == 10)
                            $this->model_Validator->showMessage("medication_end_date", "Diagnosis & Treatment2", $i);
                        $abort = TRUE;
                        break;
                    }*/
                    $cell_value = preg_replace("/[^0-9\/]/", "", $cell_value);
                    if ($cell_value == "")
                        $cell_value = '0000-00-00';
                    else
                        $cell_value = date('Y-m-d', strtotime(str_replace('/', '-', $cell_value)));
                }


                $temp14[] = $cell_value;
            }
            
            if($abort)
                break;
            
            if(strpos(strtoupper($temp14[7]), 'Y') !== false)
                $on_medication_flag = TRUE;
            else if(strpos(strtoupper($temp14[7]), 'Y') !== false)
                $on_medication_flag = FALSE;
            else
                $on_medication_flag = FALSE;

            $patient_ic_no = $temp14[0]; //echo $patient_ic_no.'          ';
            $studies_name = $temp14[1]; //echo $studies_name.'           ';
            $studies_id = $this->excell_sheets_model->get_id('studies', 'studies_id', 'studies_name', $studies_name);
            $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);
            $Diagnosis2_patient_studies_id[] = $patient_studies_id;
            //echo $patient_studies_id.'<br/>';
            $diagnosis_id = $this->excell_sheets_model->get_id('diagnosis', 'diagnosis_id', 'diagnosis_name', $temp14[2]);
            $Diagnosis2_diagnosis_id[] = $diagnosis_id;

            if (in_array($patient_studies_id, $result_pt_studies_id_pt_other_disease) && in_array($diagnosis_id, $result_pt_diagnosis_id_pt_other_disease)) {
                $data_patient_other_disease_update = array(
                    'patient_studies_id' => $patient_studies_id,
                    'diagnosis_id' => $diagnosis_id,
                    'date_of_diagnosis' => $temp14[3],
                    'diagnosis_age' => $temp14[4],
                    'diagnosis_center' => $temp14[5],
                    'doctor_name' => $temp14[6],
                    'on_medication_flag' => $on_medication_flag,
                    'created_on' => $created_date
                );

                $this->db->where('patient_studies_id', $patient_studies_id);
                $this->db->where('diagnosis_id', $diagnosis_id);
                $this->db->update('patient_other_disease', $data_patient_other_disease_update);
                $data_patient_other_disease_update = null;
            } else {
                $data_patient_other_disease[] = array(
                    'patient_studies_id' => $patient_studies_id,
                    'diagnosis_id' => $diagnosis_id,
                    'date_of_diagnosis' => $temp14[3],
                    'diagnosis_age' => $temp14[4],
                    'diagnosis_center' => $temp14[5],
                    'doctor_name' => $temp14[6],
                    'on_medication_flag' => $on_medication_flag,
                    'created_on' => $created_date
                );
            }


            $data_patient_other_disease_medication[] = array(
                'patient_other_disease_id' => 1,
                'medication_type' => $temp14[8],
                'start_date' => $temp14[9],
                'end_date' => $temp14[10],
                'duration' => $temp14[11],
                'comments' => $temp14[12],
                'created_on' => $created_date
            );
        }
        //print_r($data_patient_other_disease);
        //print_r($data_patient_other_disease_medication);
        if (sizeof($data_patient_other_disease) > 0) {
            $id_patient_other_disease = $this->excell_sheets_model->insert_record($data_patient_other_disease, 'patient_other_disease');
            if ($id_patient_other_disease > 0)
                echo 'Data added succesfully at patient_other_disease table';
            else
                echo 'Failed to insert at patient_other_disease table';
            echo '<br/>';
            $data_patient_other_disease = null;
        }


        //have to work here
        $data_pt_other_dis_medication_update = array();
        $data_pt_other_dis_medication_update = null;
        $data_pt_other_dis_medication_insert = array();
        $data_pt_other_dis_medication_insert = null;

        $tempLength = sizeof($data_patient_other_disease_medication);

        for ($key = 0; $key < $tempLength; $key++) {
            //echo $treatment_patient_studies_id[$key].'      '.$treatment_cancer_id[$key].'      '.$treatment_cancer_site_id[$key].'<br/>';
            $patient_other_disease_id = $this->excell_sheets_model->get_patient_other_disease_id($Diagnosis2_patient_studies_id[$key], $Diagnosis2_diagnosis_id[$key]);
            $data_patient_other_disease_medication[$key]['patient_other_disease_id'] = $patient_other_disease_id;
            if (in_array($patient_other_disease_id, $result_pt_other_dis_id_pt_other_dis_medic)) {
                $data_pt_other_dis_medication_update[] = $data_patient_other_disease_medication[$key];
            } else {
                $data_pt_other_dis_medication_insert[] = $data_patient_other_disease_medication[$key];
            }
        }
        
        $data_patient_other_disease_medication = null;

        if (sizeof($data_pt_other_dis_medication_insert) > 0) {
            $id_patient_other_disease_medication = $this->excell_sheets_model->insert_record($data_pt_other_dis_medication_insert, 'patient_other_disease_medication');
            if ($id_patient_other_disease_medication > 0)
                echo 'Data added succesfully at patient_other_disease_medication table';
            else
                echo 'Failed to insert at patient_other_disease_medication table';
            echo '<br/>';
            $data_pt_other_dis_medication_insert = null;
        }

        if (sizeof($data_pt_other_dis_medication_update) > 0) {
            $id_patient_other_disease_medication = $this->db->update_batch('patient_other_disease_medication', $data_pt_other_dis_medication_update, 'patient_other_disease_id');
            if ($id_patient_other_disease_medication > 0)
                echo 'Data updated succesfully at patient_other_disease_medication table';
            else
                echo 'Updated Data at patient_other_disease_medication table';
            echo '<br/>';
            $data_pt_other_dis_medication_update = null;
        }
    }

}

?>
