<?php

class ModelFamily extends CI_Model {

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

    public function Family($sheet) {
           
      
        $created_date = date('Y-m-d H:i:s');
        $temp2 = array();
        $data_patient_relatives = array();
        $data_patient_relatives = null;
        $temp_ic_no = NULL;
        $data_patient_relatives_update = array();
        $data_patient_relatives_update = null;
        
         $temp_array_IC_no_db = array();
            $temp_array_IC_no_db = null;
            $this->db->select('patient_ic_no');
            $this->db->from('patient_relatives');
            $temp_array_IC_no_db = $this->db->get()->result_array();

            $array_IC_no_db = array();
            for ($i = 0; $i < sizeof($temp_array_IC_no_db); $i++) {
                //echo $result_relationship[$j]['relatives_type']. '<br/>';
                $array_IC_no_db[$i] = $temp_array_IC_no_db[$i]['patient_ic_no'];
                //echo $result_studies_name[$i] . '<br/>';
            }
            $temp_array_IC_no_db = null;
        
        $i = 0;
        foreach ($sheet->getRowIterator() as $row) {
            $i++;

            if ($i == 1)//ommiting cell header name
                continue;

            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            $temp2 = null;
            foreach ($cellIterator as $key => $cell) {
                //$cell_value = $cell->getCalculatedValue(); // Value here
                $cell_value = $cell->getFormattedValue();

                if ($key == 0 && $cell_value != NULL) {
                    $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
                }

                if ($key == 0 && $cell_value != NULL)
                    $temp_ic_no = $cell_value;

                if ($key == 0 && $cell_value == NULL)
                    $cell_value = $temp_ic_no;

                if ($key == 1 && $cell_value != NULL)
                    $cell_value = trim(strtoupper($cell_value));

                if ($key == 1 && $cell_value == NULL)
                    $cell_value = 'None';

                if ($key == 14 && $cell_value != NULL)
                    $cell_value = trim(strtoupper($cell_value));

                if ($key == 14 && $cell_value == NULL)
                    $cell_value = 'None';
                
                if ($key == 9 || $key == 11 || $key == 13) {
                    //$cell_value = preg_replace("/[^0-9\/]/", "", $cell_value);
                    if ($cell_value == "") {
                        $cell_value = NULL;
                    } else if ($cell_value == "0000-00-00") {
                        $cell_value = NULL;
                    } else {
                        $cell_value = date('Y-m-d', strtotime(str_replace('/', '-', $cell_value)));
                    }
                }
                //echo $key; // 0, 1, 2..
                $temp2[] = $cell_value;
            }


            
            if(strpos(strtoupper($temp2[10]), 'Y') !== false)
                $is_alive_flag = TRUE;
            else if(strpos(strtoupper($temp2[10]), 'N') !== false)
                $is_alive_flag = FALSE;
            else
                $is_alive_flag = FALSE;

            if(strpos(strtoupper($temp2[12]), 'Y') !== false)
                $is_cancer_diagnosed = TRUE;
            else if(strpos(strtoupper($temp2[12]), 'N') !== false)
                $is_cancer_diagnosed = FALSE;
            else
                $is_cancer_diagnosed = FALSE;

            if(strpos(strtoupper($temp2[22]), 'Y') !== false)
                $is_paternal = TRUE;
            else if(strpos(strtoupper($temp2[22]), 'N') !== false)
                $is_paternal = FALSE;
            else
                $is_paternal = FALSE;

            if(strpos(strtoupper($temp2[23]), 'Y') !== false)
                $is_maternal = TRUE;
            else if(strpos(strtoupper($temp2[23]), 'N') !== false)
                $is_maternal = FALSE;
            else
                $is_maternal = FALSE;

            if(strpos(strtoupper($temp2[26]), 'Y') !== false)
                $is_adopted = TRUE;
            else if(strpos(strtoupper($temp2[26]), 'N') !== false)
                $is_adopted = FALSE;
            else
                $is_adopted = FALSE;

            if(strpos(strtoupper($temp2[27]), 'Y') !== false)
                $is_in_other_country = TRUE;
            else if(strpos(strtoupper($temp2[27]), 'N') !== false)
                $is_in_other_country = FALSE;
            else
                $is_in_other_country = FALSE;

            $relatives_id = $this->excell_sheets_model->get_id('relatives', 'relatives_id', 'relatives_type', $temp2[1]);
            
           // echo $relatives_id.'row '.$i.'<br/>';

            $cancer_type_id = $this->excell_sheets_model->get_id('cancer', 'cancer_id', 'cancer_name', $temp2[14]);
            
            //if($cancer_type_id < 0)
                //echo $cancer_type_id.'row '.$i.'<br/>';
            //echo $temp2[14].'       Id'.$cancer_type_id.'       row '.$i.'<br>';
            $val_ic_no_db = in_array($temp2[0], $array_IC_no_db);

            if ($val_ic_no_db) {
                $patient_relatives_id = $this->excell_sheets_model->get_patient_relative_id($temp2[0],$relatives_id);
                $data_patient_relatives_update[] = array(
                    'patient_relatives_id' => $patient_relatives_id,
                    'patient_ic_no' => $temp2[0],
                    'relatives_id' => $relatives_id,
                    'degree_of_relativeness' => $temp2[2],
                    'family_no' => $temp2[3],
                    'full_name' => $temp2[4],
                    'maiden_name' => $temp2[5],
                    'ethnicity' => $temp2[6],
                    'nationality' => $temp2[7],
                    'town_of_residence' => $temp2[8],
                    'd_o_b' => $temp2[9],
                    'is_alive_flag' => $is_alive_flag,
                    'd_o_d' => $temp2[11],
                    'is_cancer_diagnosed' => $is_cancer_diagnosed,
                    'date_of_diagnosis' => $temp2[13],
                    'cancer_type_id' => $cancer_type_id,
                    'age_of_diagnosis' => $temp2[15],
                    'other_detail' => $temp2[16],
                    'no_of_brothers' => $temp2[17],
                    'no_of_sisters' => $temp2[18],
                    'total_half_brothers' => $temp2[19],
                    'total_half_sisters' => $temp2[20],
                    'sex' => $temp2[21],
                    'is_paternal' => $is_paternal,
                    'is_maternal' => $is_maternal,
                    'vital_status' => $temp2[24],
                    'comments' => $temp2[25],
                    'is_adopted' => $is_adopted,
                    'is_in_other_country' => $is_in_other_country,
                    'created_on' => $created_date
                );
            } else {
                $data_patient_relatives[] = array(
                    'patient_ic_no' => $temp2[0],
                    'relatives_id' => $relatives_id,
                    'degree_of_relativeness' => $temp2[2],
                    'family_no' => $temp2[3],
                    'full_name' => $temp2[4],
                    'maiden_name' => $temp2[5],
                    'ethnicity' => $temp2[6],
                    'nationality' => $temp2[7],
                    'town_of_residence' => $temp2[8],
                    'd_o_b' => $temp2[9],
                    'is_alive_flag' => $is_alive_flag,
                    'd_o_d' => $temp2[11],
                    'is_cancer_diagnosed' => $is_cancer_diagnosed,
                    'date_of_diagnosis' => $temp2[13],
                    'cancer_type_id' => $cancer_type_id,
                    'age_of_diagnosis' => $temp2[15],
                    'other_detail' => $temp2[16],
                    'no_of_brothers' => $temp2[17],
                    'no_of_sisters' => $temp2[18],
                    'total_half_brothers' => $temp2[19],
                    'total_half_sisters' => $temp2[20],
                    'sex' => $temp2[21],
                    'is_paternal' => $is_paternal,
                    'is_maternal' => $is_maternal,
                    'vital_status' => $temp2[24],
                    'comments' => $temp2[25],
                    'is_adopted' => $is_adopted,
                    'is_in_other_country' => $is_in_other_country,
                    'created_on' => $created_date
                );
            }
            $temp2 = null;
        }
         //print_r($data_patient_relatives);
        $array_IC_no_db = null;

            if (sizeof($data_patient_relatives) > 0) {
                $id_data_patient_relatives = $this->excell_sheets_model->insert_record($data_patient_relatives, 'patient_relatives');
                if ($id_data_patient_relatives > 0)
                    echo 'Data added succesfully at patient_relatives table';
                else
                    echo 'Failed to insert at patient_relatives table';
                echo '<br/>';
                $data_patient_relatives = null;
            }


            if (sizeof($data_patient_relatives_update) > 0) {
                $id_data_patient_relatives = $this->db->update_batch('patient_relatives', $data_patient_relatives_update, 'patient_relatives_id');
                if ($id_data_patient_relatives > 0)
                    echo 'Data updated succesfully at patient_relatives table';
                else
                    echo 'Updated Data at patient_relatives table';
                echo '<br/>';
                $data_patient_relatives_update = null;
            }
        


        $data_patient_relatives = null;
        $data_patient_relatives_update = null;
    }

}

?>
