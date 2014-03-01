<?php
class ModelScreening4 extends CI_Model {
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
    
     public function Screening4($sheet)
    {
         $created_date = date('Y-m-d H:i:s');
         $abort = FALSE;
         $temp7 = array();
         $data_patient_other_screening = array();
                    $data_patient_other_screening = null;
                    $data_patient_other_screening_update = array();
                    $data_patient_other_screening_update = null;
                    $data_patient_ovarian_screening = array();
                    $data_patient_ovarian_screening = null;
                    $data_patient_ovarian_screening_update = array();
                    $data_patient_ovarian_screening_update = null;
                    
                    $temp_pt_studies_id_pt_ova_scrning = array();
                    $temp_pt_studies_id_pt_ova_scrning = null;
                    $this->db->select('patient_studies_id');
                    $this->db->from('patient_ovarian_screening');
                    $temp_pt_studies_id_pt_ova_scrning = $this->db->get()->result_array();

                    //print_r($temp_pt_studies_id_pt_ova_scrning);
                    $result_pt_studies_id_pt_ova_scrning = array();
                    for ($i = 0; $i < sizeof($temp_pt_studies_id_pt_ova_scrning); $i++) {
                        $result_pt_studies_id_pt_ova_scrning [$i] = $temp_pt_studies_id_pt_ova_scrning[$i]['patient_studies_id'];
                    }
                    
                    $temp_ova_scrning_type_id_pt_ova_scrning = array();
                    $temp_ova_scrning_type_id_pt_ova_scrning = null;
                    $this->db->select('ovarian_screening_type_id');
                    $this->db->from('patient_ovarian_screening');
                    $temp_ova_scrning_type_id_pt_ova_scrning = $this->db->get()->result_array();

                    //print_r($temp_ova_scrning_type_id_pt_ova_scrning);
                    $result_ova_scrning_type_id_pt_ova_scrning = array();
                    for ($i = 0; $i < sizeof($temp_ova_scrning_type_id_pt_ova_scrning); $i++) {
                        $result_ova_scrning_type_id_pt_ova_scrning [$i] = $temp_ova_scrning_type_id_pt_ova_scrning[$i]['ovarian_screening_type_id'];
                    }
                    
                    $temp_pt_studies_id_pt_other_scrning = array();
                    $temp_pt_studies_id_pt_other_scrning = null;
                    $this->db->select('patient_studies_id');
                    $this->db->from('patient_other_screening');
                    $temp_pt_studies_id_pt_other_scrning = $this->db->get()->result_array();

                    //print_r($temp_pt_studies_id_pt_other_scrning);
                    $result_pt_studies_id_pt_other_scrning = array();
                    for ($i = 0; $i < sizeof($temp_pt_studies_id_pt_other_scrning); $i++) {
                        $result_pt_studies_id_pt_other_scrning [$i] = $temp_pt_studies_id_pt_other_scrning[$i]['patient_studies_id'];
                    }
                    
                    $i = 0;
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        
                        $temp7 = null;
                        foreach ($cellIterator as $key => $cell) {
                            $cell_value = $cell->getFormattedValue();

                            if ($key == 0 && $cell_value != NULL)
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);

                            //echo $key; // 0, 1, 2..
                            if ($key == 2 && $cell_value == NULL)
                                $cell_value = 'None';

                            if ($key == 6 && $cell_value == NULL)
                                $cell_value = 'None';
                            
                            if ($key == 3 && $cell_value != NULL) {
                                /*if (strpos($cell_value, '-') !== FALSE)
                                    $cell_value = date("d/m/Y", strtotime($cell_value));
                                list($day, $month, $year) = explode("/", $cell_value);

                                if (!checkdate($month, $day, $year)) {
                                    $this->model_Validator->showMessage("screening_date","Sreening and Surveilance4",$i);
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

                            $temp7[] = $cell_value;
                        }
                        
                        if($abort)
                        break;
                        
                        if(strpos(strtoupper($temp7[4]), 'Y') !== false)
                            $is_abnormality_detected = TRUE;
                        else if(strpos(strtoupper($temp7[4]), 'N') !== false)
                            $is_abnormality_detected = FALSE;
                        else
                            $is_abnormality_detected = FALSE;

                        $patient_ic_no = $temp7[0];
                        $studies_id = $this->excell_sheets_model->get_id('studies', 'studies_id', 'studies_name', $temp7[1]);
                        $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);

                        $ovarian_screening_type_id = $this->excell_sheets_model->get_id('ovarian_screening_type', 'ovarian_screening_type_id', 'ovarian_screening_type_name', $temp7[2]);
                        
                        if(in_array($patient_studies_id, $result_pt_studies_id_pt_ova_scrning)  
                                && in_array($ovarian_screening_type_id, $result_ova_scrning_type_id_pt_ova_scrning))
                        {
                            $data_patient_ovarian_screening_update = array(
                            'patient_studies_id' => $patient_studies_id,
                            'ovarian_screening_type_id' => $ovarian_screening_type_id,
                            'screening_date' => $temp7[3],
                            'is_abnormality_detected' => $is_abnormality_detected,
                            'additional_info' => $temp7[5],
                            'created_on' => $created_date
                            ); 
                            
                            $this->db->where('patient_studies_id', $patient_studies_id);
                            $this->db->where('ovarian_screening_type_id', $ovarian_screening_type_id);
                            $this->db->update('patient_ovarian_screening', $data_patient_ovarian_screening_update); 
                            $data_patient_ovarian_screening_update = null;
                        }        
                        else
                        {
                            $data_patient_ovarian_screening[] = array(
                            'patient_studies_id' => $patient_studies_id,
                            'ovarian_screening_type_id' => $ovarian_screening_type_id,
                            'screening_date' => $temp7[3],
                            'is_abnormality_detected' => $is_abnormality_detected,
                            'additional_info' => $temp7[5],
                            'created_on' => $created_date
                            ); 
                        }
 
                        

                        if(in_array($patient_studies_id, $result_pt_studies_id_pt_other_scrning))
                        {
                            $data_patient_other_screening_update[] = array(
                            'patient_studies_id' => $patient_studies_id,
                            'screening_type' => $temp7[6],
                            'age_at_screening' => $temp7[7],
                            'screening_center' => $temp7[8],
                            'screening_result' => $temp7[9],
                            'created_on' => $created_date
                            );
                        }
                        else
                        {
                            $data_patient_other_screening[] = array(
                            'patient_studies_id' => $patient_studies_id,
                            'screening_type' => $temp7[6],
                            'age_at_screening' => $temp7[7],
                            'screening_center' => $temp7[8],
                            'screening_result' => $temp7[9],
                            'created_on' => $created_date
                            );
                        }
                        $temp7 = null;
                    }
                    //print_r($data_patient_ovarian_screening);
                    //print_r($patient_other_screening);
                    if(!$abort)
                    {
                            if(sizeof($data_patient_ovarian_screening) > 0)
                        {
                            $id_patient_ovarian_screening = $this->excell_sheets_model->insert_record($data_patient_ovarian_screening, 'patient_ovarian_screening');
                            if ($id_patient_ovarian_screening > 0)
                                echo 'Data added succesfully at patient_ovarian_screening table';
                            else
                                echo 'Failed to insert at patient_ovarian_screening table';
                            echo '<br/>';
                            $data_patient_ovarian_screening = null;
                        }

                        if(sizeof($data_patient_other_screening) > 0)
                        {
                            $id_patient_other_screening = $this->excell_sheets_model->insert_record($data_patient_other_screening, 'patient_other_screening');
                            if ($id_patient_other_screening > 0)
                                echo 'Data added succesfully at patient_other_screening table';
                            else
                                echo 'Failed to insert at patient_other_screening table';
                            echo '<br/>';
                            $data_patient_other_screening = null;
                        }

                        if(sizeof($data_patient_other_screening_update) > 0)
                        {
                            $id_patient_other_screening = $this->db->update_batch('patient_other_screening',$data_patient_other_screening_update,'patient_studies_id');
                            if ($id_patient_other_screening > 0)
                                echo 'Data updated succesfully at patient_other_screening table';
                            else
                                echo 'Updated Data at patient_other_screening table';
                            echo '<br/>';
                            $data_patient_other_screening_update = null;
                        }
                    }
                    
                    
                    $data_patient_other_screening = null;
                    $data_patient_other_screening_update = null;
                    $data_patient_ovarian_screening = null;
                    $temp_pt_studies_id_pt_ova_scrning = null;
                    $result_pt_studies_id_pt_ova_scrning = null;
                    $temp_ova_scrning_type_id_pt_ova_scrning = null;
                    $result_ova_scrning_type_id_pt_ova_scrning = null;
                    $temp_pt_studies_id_pt_other_scrning = null;
                    $result_pt_studies_id_pt_other_scrning = null;
                    $temp7 = null;
                    $data_patient_ovarian_screening_update = null;
    }
}   
?>
