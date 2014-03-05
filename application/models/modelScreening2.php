<?php
class ModelScreening2 extends CI_Model {

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
    
    public function Screening2($sheet)
    {
        $created_date = date('Y-m-d H:i:s');
        $data_patient_non_cancer_surgery = array();
        $data_patient_non_cancer_surgery = null;
        $data_patient_non_cancer_surgery_update = array();
        $data_patient_non_cancer_surgery_update = null;
        $temp5 = array();
        $abort = FALSE;

        $temp_result_patient_studies_id = array();
        $temp_result_patient_studies_id = null;
        $this->db->select('patient_studies_id');
        $this->db->from('patient_non_cancer_surgery');
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
            
            $temp5 = null;
            foreach ($cellIterator as $key => $cell) {
                $cell_value = $cell->getFormattedValue();

                if ($key == 0 && $cell_value != NULL)
                    $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
                
                if($key == 1)
                {
                   $cell_value = trim($cell_value); 
                }
                
                
                if (($key == 4 || $key == 10) && $cell_value != NULL) {
                                /*if (strpos($cell_value, '-') !== FALSE)
                                    $cell_value = date("d/m/Y", strtotime($cell_value));
                                list($day, $month, $year) = explode("/", $cell_value);

                                if (!checkdate($month, $day, $year)) {
                                    if($key == 4)
                                    {
                                        $this->model_Validator->showMessage("date_of_surgery","Sreening and Surveilance2",$i);
                                    }
                                    
                                    if($key == 10)
                                    {
                                        $this->model_Validator->showMessage("breast_date_of_surgery","Sreening and Surveilance2",$i);
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
                $temp5[] = $cell_value;
            }
            
            if($abort)
            break;

            $patient_ic_no = $temp5[0];
            $studies_name = $temp5[1];
            $studies_id = $this->excell_sheets_model->get_id('studies', 'studies_id', 'studies_name', $temp5[1]);
            $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);

            $val_patient_studies_id = in_array($patient_studies_id, $result_patient_studies_id);

            if ($val_patient_studies_id) {
                $patient_non_cancer_surgery_id = $this->excell_sheets_model->get_patient_non_cancer_surgery_id($patient_studies_id);
                $data_patient_non_cancer_surgery_update[] = array(
                    'patient_non_cancer_surgery_id' => $patient_non_cancer_surgery_id, 
                    'patient_studies_id' => $patient_studies_id,
                    'surgery_type' => $temp5[2],
                    'reason_for_surgery' => $temp5[3],
                    'date_of_surgery' => $temp5[4],
                    'age_at_surgery' => $temp5[5],
                    'comments' => $temp5[6],
                    'created_on' => $created_date,
                    'breast_surgery_type' => $temp5[7],
                    'breast_reason_of_surgery' => $temp5[8],
                    'breast_comments' => $temp5[9],
                    'breast_age_of_surgery' => $temp5[11],
                    'breast_date_of_surgery' => $temp5[10]
                );
            } else {
                $data_patient_non_cancer_surgery[] = array(
                    'patient_studies_id' => $patient_studies_id,
                    'surgery_type' => $temp5[2],
                    'reason_for_surgery' => $temp5[3],
                    'date_of_surgery' => $temp5[4],
                    'age_at_surgery' => $temp5[5],
                    'comments' => $temp5[6],
                    'created_on' => $created_date,
                    'breast_surgery_type' => $temp5[7],
                    'breast_reason_of_surgery' => $temp5[8],
                    'breast_comments' => $temp5[9],
                    'breast_age_of_surgery' => $temp5[11],
                    'breast_date_of_surgery' => $temp5[10]
                );
            }
            $temp5 = null;
        }
        //print_r($data_patient_non_cancer_surgery);
        if(!$abort)
        {
           if (sizeof($data_patient_non_cancer_surgery) > 0) {
            $id_data_patient_studies = $this->excell_sheets_model->insert_record($data_patient_non_cancer_surgery, 'patient_non_cancer_surgery');
            if ($id_data_patient_studies > 0)
                echo 'Data added succesfully at patient_non_cancer_surgery table';
            else
                echo 'Failed to insert at patient_non_cancer_surgery table';
            echo '<br/>';
            $data_patient_non_cancer_surgery = null;
            }

            if (sizeof($data_patient_non_cancer_surgery_update) > 0) {
                $id_data_patient_studies = $this->db->update_batch('patient_non_cancer_surgery', $data_patient_non_cancer_surgery_update, 'patient_non_cancer_surgery_id');
                if ($id_data_patient_studies > 0)
                    echo 'Data updated succesfully at patient_non_cancer_surgery table';
                else
                    echo 'Updated Datad at patient_non_cancer_surgery table';
                echo '<br/>';
                $data_patient_non_cancer_surgery_update = null;
            } 
        }
        
        $data_patient_non_cancer_surgery = null;
        $data_patient_non_cancer_surgery_update = null;
        $temp_result_patient_studies_id = null;
        $result_patient_studies_id = null;

    }

}
?>
