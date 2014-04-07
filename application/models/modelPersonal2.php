<?php

class ModelPersonal2 extends CI_Model {

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

    public function Personal2($sheet) {
        $created_date = date('Y-m-d H:i:s');
        $data_patient_studies_update = array();
        $data_patient_studies_update = null;
        $data_patient_studies = array();
        $data_patient_studies = null;
        $data_patient_private_no_update = array();
        $data_patient_private_no_update = null;
        $data_patient_private_no = array();
        $data_patient_private_no = null;
        $temp3 = array();
        $abort = FALSE;


        $temp_array_IC_no_db = array();
        $temp_array_IC_no_db = null;
        $this->db->select('patient_ic_no');
        $this->db->from('patient_studies');
        $temp_array_IC_no_db = $this->db->get()->result_array();

        $array_IC_no_db = array();

        for ($i = 0; $i < sizeof($temp_array_IC_no_db); $i++) {
            //echo $result_relationship[$j]['relatives_type']. '<br/>';
            $array_IC_no_db[$i] = $temp_array_IC_no_db[$i]['patient_ic_no'];
            //echo $result_studies_name[$i] . '<br/>';
        }

        $temp_array_IC_no_db = null;

        $temp_studies_id = array();
        $temp_studies_id = null;
        $this->db->select('studies_id');
        $this->db->from('patient_studies');
        $temp_studies_id = $this->db->get()->result_array();

        $result_studies_id = array();

        for ($i = 0; $i < sizeof($temp_studies_id); $i++) {
            //echo $result_relationship[$j]['relatives_type']. '<br/>';
            $result_studies_id[$i] = $temp_studies_id[$i]['studies_id'];
            //echo $result_studies_name[$i] . '<br/>';
        }

        $temp_studies_id = null;

        $temp_patient_private_no_id = array();
        $temp_patient_private_no_id = null;
        $this->db->select('patient_private_no_id');
        $this->db->from('patient_private_no');
        $temp_patient_private_no_id = $this->db->get()->result_array();

        $result_patient_private_no_id = array();

        for ($i = 0; $i < sizeof($temp_patient_private_no_id); $i++) {
            //echo $result_relationship[$j]['relatives_type']. '<br/>';
            $result_patient_private_no_id[$i] = $temp_patient_private_no_id[$i]['patient_private_no_id'];
            //echo $result_studies_name[$i] . '<br/>';
        }

        $temp_patient_private_no_id = null;

        $array_ic = array();
        $array_ic = null;
        $array_studies_id = array();
        $array_studies_id = null;

        $i = 0;
        foreach ($sheet->getRowIterator() as $row) {
            $i++;

            if ($i == 1)//ommiting cell header name
                continue;

            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            $temp3 = null;
            foreach ($cellIterator as $key => $cell) {
                //$cell_value = $cell->getCalculatedValue(); // Value here
                $cell_value = $cell->getFormattedValue();
                if ($key == 0 && $cell_value != NULL) {
                    $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
                    //echo 'ic_no     '.$cell_value.'row  '.$i.'<br/>';
                }

                if ($key == 1 && $cell_value != NULL) {
                    $cell_value = trim($cell_value);
                }
                if ($key == 2) {
                    /* if (strpos($cell_value, '-') !== FALSE)
                      $cell_value = date("d/m/Y", strtotime($cell_value));
                      list($day, $month, $year) = explode("/", $cell_value);

                      if (!checkdate($month, $day, $year)) {
                      $this->model_Validator->showMessage("date_at_consent","Personal2",$i);
                      $abort = TRUE;
                      break;
                      }
                      $cell_value = date('Y-m-d', strtotime(str_replace('/', '-', $cell_value))); */
                    //$cell_value = preg_replace("/[^0-9\/]/", "", $cell_value);
                    if ($cell_value == "") {
                        $cell_value = NULL;
                    } else {
                        $cell_value == '0000-00-00' ? NULL : date('Y-m-d', strtotime(str_replace('/', '-', $cell_value)));
                    }
                }

                //print_r($print);exit;
                //echo $key; // 0, 1, 2..
                $temp3[] = $cell_value;
            }

            if ($abort)
                break;

            $studies_id = $this->excell_sheets_model->get_id('studies', 'studies_id', 'studies_name', $temp3[1]);

            $relations_to_study = $temp3[8];

            if (strpos(strtoupper($relations_to_study), 'Y') !== false)
                $relations_to_study_flag = TRUE;
            else if (strpos(strtoupper($relations_to_study), 'N') !== false)
                $relations_to_study_flag = FALSE;
            else
                $relations_to_study_flag = FALSE;

            if (strpos(strtoupper($temp3[4]), 'Y') !== false)
                $double_consent_flag = TRUE;
            else if (strpos(strtoupper($temp3[4]), 'N') !== false)
                $double_consent_flag = FALSE;
            else
                $double_consent_flag = FALSE;
            //echo $temp3[0].'<br/>';

            $patient_studies_id = null;
            $val_ic_no_db = in_array($temp3[0], $array_IC_no_db);

            /* if(!in_array($temp3[0], $array_IC_no_db_personal))
              {
              echo $temp3[0].'row '.$i.'<br/>';
              } */

            if ($val_ic_no_db && in_array($studies_id, $result_studies_id)) {
                $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($temp3[0], $studies_id);
                //if($patient_studies_id == null)
                //echo 'hello '.$patient_studies_id;
            }
                        
            //if ($val_ic_no_db && in_array($studies_id, $result_studies_id)) 
            if ($patient_studies_id != null) {
                //$patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($temp3[0],$studies_id);
                $data_patient_studies_update[] = array(
                    'patient_studies_id' => $patient_studies_id,
                    'patient_ic_no' => $temp3[0],
                    'studies_id' => $studies_id,
                    'date_at_consent' => $temp3[2],
                    'age_at_consent' => $temp3[3],
                    'double_consent_flag' => $double_consent_flag,
                    'consent_given_by' => $temp3[5],
                    'consent_response' => $temp3[6],
                    'consent_version' => $temp3[7],
                    'relation_to_study' => $temp3[8],
                    'referral_to' => $temp3[9],
                    'referral_to_genetic_counselling' => $temp3[10],
                    'referral_source' => $temp3[11],
                    'created_on' => $created_date
                );
                //print_r($data_patient_studies_update);exit;
            } else {
                $data_patient_studies[] = array(
                    'patient_ic_no' => $temp3[0],
                    'studies_id' => $studies_id,
                    'date_at_consent' => $temp3[2],
                    'age_at_consent' => $temp3[3],
                    'double_consent_flag' => $double_consent_flag,
                    'consent_given_by' => $temp3[5],
                    'consent_response' => $temp3[6],
                    'consent_version' => $temp3[7],
                    'relation_to_study' => $temp3[8],
                    'referral_to' => $temp3[9],
                    'referral_to_genetic_counselling' => $temp3[10],
                    'referral_source' => $temp3[11],
                    'created_on' => $created_date
                );
            }

            $patient_private_no_id = -1;
            if ($patient_studies_id != null) {
                $patient_private_no_id = $this->excell_sheets_model->get_id('patient_private_no', 'patient_private_no_id', 'patient_studies_id', $patient_studies_id);
                //echo 'patient_private_no_id    ' . $patient_private_no_id . '<br/>';
            }

            if (in_array($patient_private_no_id, $result_patient_private_no_id)) {
                $data_patient_private_no_update[] = array(
                    'patient_private_no_id' => $patient_private_no_id,
                    'patient_ic_no' => $temp3[0],
                    'patient_studies_id' => $patient_studies_id,
                    'private_no' => $temp3[12],
                    'created_on' => $created_date
                );
            } else {
                $array_ic[] = $temp3[0];
                $array_studies_id[] = $studies_id;

                $data_patient_private_no[] = array(
                    'patient_ic_no' => $temp3[0],
                    'patient_studies_id' => 1,
                    'private_no' => $temp3[12],
                    'created_on' => $created_date
                );
            }
            $temp3 = null;
        }
        //echo 'data_patient_private_no_update<br/>';
        //print_r($data_patient_private_no_update);
        $result_studies_id = null;
        if (!$abort) {
            if (sizeof($data_patient_studies) > 0) {
                $id_data_patient_studies = $this->excell_sheets_model->insert_record($data_patient_studies, 'patient_studies');
                if ($id_data_patient_studies > 0)
                    echo 'Data added succesfully at patient_studies table';
                else
                    echo 'Failed to insert at patient_studies table';
                echo '<br/>';
                $data_patient_studies = null;
            }


            if (sizeof($data_patient_studies_update) > 0) {
                $id_data_patient_studies = $this->db->update_batch('patient_studies', $data_patient_studies_update, 'patient_studies_id');
                if ($id_data_patient_studies > 0)
                    echo 'Data updated succesfully at patient_studies table';
                else
                    echo 'Updated Datad at patient_studies table';
                echo '<br/>';
                $data_patient_studies_update = null;
            }
        }

        //$data_patient_private_no_insert = array();
        //$data_patient_private_no_insert = null;
        $tempLen = sizeof($data_patient_private_no);

        if (sizeof($data_patient_private_no) > 0) {
            for ($key = 0; $key < $tempLen; $key++) {
                $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($array_ic[$key], $array_studies_id[$key]);
                $data_patient_private_no[$key]['patient_studies_id'] = $patient_studies_id;
                if ($patient_studies_id > 0) {
                    //$data_patient_private_no_insert[] = $data_patient_private_no[$key];
                    $data_patient_private_no[$key]['patient_studies_id'] = $patient_studies_id;
                }
            }
            //$data_patient_private_no = null;
            $array_ic = null;
            $array_studies_id = null;
        }

        if (!$abort) {
            if (sizeof($data_patient_private_no) > 0) {
                $id_data_patient_private_no = $this->excell_sheets_model->insert_record($data_patient_private_no, 'patient_private_no');

                if ($id_data_patient_private_no > 0)
                    echo 'Data added succesfully at patient_private_no table';
                else
                    echo 'Failed to insert at patient_private_no table';
                echo '<br/>';
                $data_patient_private_no = null;
            }

            if (sizeof($data_patient_private_no_update) > 0) {
                $id_data_patient_private_no = $this->db->update_batch('patient_private_no', $data_patient_private_no_update, 'patient_private_no_id');
                if ($id_data_patient_private_no > 0)
                    echo 'Data updated succesfully at patient_private_no table';
                else
                    echo 'Updated Data at patient_private_no table';
                echo '<br/>';
                $data_patient_private_no_update = null;
            }
        }



        $array_IC_no_db = null;
        $temp3 = null;
    }

}

?>
