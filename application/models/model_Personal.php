<?php
class Model_Personal extends CI_Model {

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
    
    public function Personal($sheet,$array_IC_no_db) {

                    $created_date = date('Y-m-d H:i:s');
                    $abort =FALSE;
                    $row_skip_flag = FALSE;
                    $data_patient = array();
                    $data_patient = null;
                    $data_patient_update = array();
                    $data_patient_hospital_no_update = array();
                    $data_patient_hospital_no_update = null;
                    $data_patient_update = null;
                    $data_patient_hospital_no_update = array();
                    $data_patient_hospital_no_update = null;
                    /*$data_patient_private_no_update = array();
                    $data_patient_private_no_update = null;*/
                    $data_patient_cogs_studies_update = array();
                    $data_patient_cogs_studies_update = null;
                    $data_patient_contact_person_update = array();
                    $data_patient_contact_person_update = null;
                    $data_patient_relatives_summary_update = array();
                    $data_patient_relatives_summary_update = null;
                    $data_patient_survival_status_update = array();
                    $data_patient_survival_status_update = null;

                    $data_patient_hospital_no = array();
                    $data_patient_hospital_no = null;
                    /*$data_patient_private_no = array();
                    $data_patient_private_no = null;*/
                    $data_patient_cogs_studies = array();
                    $data_patient_cogs_studies = null;
                    $data_patient_contact_person = array();
                    $data_patient_contact_person = null;
                    $data_patient_relatives_summary = array();
                    $data_patient_relatives_summary = null;
                    $data_patient_survival_status = array();
                    $data_patient_survival_status = null;
                    $old_ic_no = NULL;
                    $height = NULL;
                    $weight = NULL;
                    
                    //Checking variable defined here
                    $name_validator = TRUE;
                    $email_validator = TRUE;
              
                    
                    $i = 0;$temp1 = array();
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        
                        $temp1 = null;
                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();

                            if ($key == 5 && $cell_value == NULL) {
                                $row_skip_flag = TRUE;
                                break;
                            }
                            
                            if ($key == 5 && $cell_value != NULL) {
                                $old_ic_no = $cell_value;
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
                            }

                            if ($key == 0 && $cell_value != NULL) {
                                $name_validator = $this->model_Validator->check_name($cell_value);
                                if(!$name_validator)
                                {
                                    $this->model_Validator->showMessage("GivenName","Personal",$i);
                                    $abort = true;
                                    break;
                                }
                            }


                            if ($key == 26 && $cell_value != NULL) {
                                $email_validator = $this->model_Validator->check_email($cell_value);
                                if(!$email_validator)
                                {
                                    $this->model_Validator->showMessage("email","Personal",$i);
                                    $abort = true;
                                    break;
                                }
                            }

                            /*if ($key == 29 && $cell_value != NULL) {
                                $height_validator = is_float($cell_value);
                            }

                            if ($key == 30 && $cell_value != NULL) {
                                $weight_validator = is_float($cell_value);
                            }*/

                            if ($key == 8 || $key == 13 || $key == 47) {
                                /*$cell_value = trim($cell_value);
                                if (strpos($cell_value, '-') !== FALSE)
                                    $cell_value = date("d/m/Y", strtotime($cell_value));
                                
                                list($day, $month, $year) = explode("/", $cell_value);
                                if (!checkdate($month, $day, $year)) {
                                    if ($key == 8)
                                        $this->model_Validator->showMessage("patient_DOB","Personal",$i);
                                    if ($key == 13)
                                        $this->model_Validator->showMessage("patient_DOD","Personal",$i);
                                    if ($key == 48)
                                        $this->model_Validator->showMessage("status_collection_date","Personal",$i);
                                       
                                    $abort = TRUE;
                                    break;
                                }
                                $cell_value = date('Y-m-d', strtotime(str_replace('/', '-', $cell_value)));*/
                                
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

                            /*if ($key == 8 || $key == 13 || $key == 48) {
                                if ($cell_value != NULL) {
                                    $cell_value = date('Y-m-d', strtotime(str_replace('/', '-', $cell_value)));
                                }
                            }*/
                            /*if ($key == 8)
                                echo $cell_value.'<br/>';*/
                            $temp1[] = $cell_value;
                            //echo $cell_value . '    ';
                        }


                        if($abort)
                        break;

                        if(strpos(strtoupper($temp1[12]), 'Y') !== false)
                            $is_dead = TRUE;
                        else if(strpos(strtoupper($temp1[12]), 'N') !== false)
                            $is_dead = FALSE;
                        else
                            $is_dead = 2;
                        
                        //print_r(strtoupper($temp1[46]));exit;
                        if(strtoupper($temp1[46]) == 'UNKNOWN')
                            $alive_status = 2;
                        else if(strtoupper($temp1[46]) == 'ALIVE' || strpos(strtoupper($temp1[46]), 'HIDUP') !== false || strpos(strtoupper($temp1[46]), 'YES') !== false)
                            $alive_status = TRUE;
                        else if(strpos(strtoupper($temp1[46]), 'DIED') !== false || strpos(strtoupper($temp1[46]), 'MATI') !== false || strpos(strtoupper($temp1[46]), 'NO') !== false)
                            $alive_status = FALSE;
                        else 
                            $alive_status = 2;
                        
                        $val_ic_no_db = in_array($temp1[5], $array_IC_no_db);
                        $height = $temp1[28];
                        $weight = $temp1[29];
                        
                        $total_no_of_siblings = $temp1[36] + $temp1[37];
                        
                        if (!empty($temp1[29]) && !empty($temp1[28])){
                        
                            $bmi = round($temp1[29] / ($temp1[28]*$temp1[28]),2);
                        } else {
                            
                            $bmi = NULL;
                        }
                        

                        if ($val_ic_no_db) {
                            $data_patient_update[] = array(
                                'given_name' => $temp1[0],
                                'surname' => $temp1[1],
                                'maiden_name' => $temp1[2],
                                'nationality' => $temp1[4],
                                'ic_no' => $temp1[5],
                                'old_ic_no' => $old_ic_no,
                                'family_no' => $temp1[3],
                                'gender' => $temp1[6],
                                'ethnicity' => $temp1[7],
                                'd_o_b' => $temp1[8],
                                'place_of_birth' => $temp1[9],
                                'marital_status' => $temp1[10],
                                'blood_group' => $temp1[11],
                                'comment' => $temp1[35],
                                'is_dead' => $is_dead,
                                'd_o_d' => $temp1[13],
                                'reason_of_death' => $temp1[14],
                                'blood_card' => $temp1[18],
                                'blood_card_location' => $temp1[19],
                                'address' => $temp1[20],
                                'home_phone' => $temp1[21],
                                'cell_phone' => $temp1[22],
                                'work_phone' => $temp1[23],
                                'other_phone' => $temp1[24],
                                'fax' => $temp1[25],
                                'email' => $temp1[26],
                                'height' => $height,
                                'weight' => $weight,
                                'bmi' => $bmi,
                                'highest_education_level' => $temp1[27],
                                'income_level' => $temp1[31],
                                'created_on' => $created_date
                            );
                                                        
                            $data_patient_hospital_no_update[] = array(
                                'patient_ic_no' => $temp1[5],
                                'hospital_no' => $temp1[15],
                                'created_on' => $created_date
                            );

                            /*$data_patient_private_no_update[] = array(
                                'patient_ic_no' => $temp1[5],
                                'private_no' => $temp1[16],
                                'created_on' => $created_date
                            );*/

                            $data_patient_cogs_studies_update[] = array(
                                'patient_ic_no' => $temp1[5],
                                'COGS_studies_name' => $temp1[16],
                                'COGS_studies_no' => $temp1[17],
                                'created_on' => $created_date
                            );

                            $data_patient_contact_person_update[] = array(
                                'patient_ic_no' => $temp1[5],
                                'contact_name' => $temp1[32],
                                'contact_relationship' => $temp1[34],
                                'contact_telephone' => $temp1[33],
                                'created_on' => $created_date
                            );

                            $data_patient_relatives_summary_update[] = array(
                                'patient_ic_no' => $temp1[5],
                                'total_no_of_male_siblings' => $temp1[36],
                                'total_no_of_female_siblings' => $temp1[37],
                                'total_no_of_affected_siblings' => $temp1[38],
                                'total_no_of_male_children' => $temp1[39],
                                'total_no_of_female_children' => $temp1[40],
                                'total_no_of_affected_children' => $temp1[41],
                                'total_no_of_1st_degree' => $temp1[42],
                                'total_no_of_2nd_degree' => $temp1[43],
                                'total_no_of_3rd_degree' => $temp1[44],
                                'total_no_of_siblings' => $total_no_of_siblings,
                                'created_on' => $created_date
                            );

                            $data_patient_survival_status_update[] = array(
                                'patient_ic_no' => $temp1[5],
                                'source' => $temp1[45],
                                'alive_status' => $alive_status,
                                'status_gathering_date' => $temp1[47],
                                'created_on' => $created_date
                            );
                        } else {
                            $data_patient[] = array(
                                'given_name' => $temp1[0],
                                'surname' => $temp1[1],
                                'maiden_name' => $temp1[2],
                                'nationality' => $temp1[4],
                                'ic_no' => $temp1[5],
                                'old_ic_no' => $old_ic_no,
                                'family_no' => $temp1[3],
                                'gender' => $temp1[6],
                                'ethnicity' => $temp1[7],
                                'd_o_b' => $temp1[8],
                                'place_of_birth' => $temp1[9],
                                'marital_status' => $temp1[10],
                                'blood_group' => $temp1[11],
                                'comment' => $temp1[35],
                                'is_dead' => $is_dead,
                                'd_o_d' => $temp1[13],
                                'reason_of_death' => $temp1[14],
                                'blood_card' => $temp1[18],
                                'blood_card_location' => $temp1[19],
                                'address' => $temp1[20],
                                'home_phone' => $temp1[21],
                                'cell_phone' => $temp1[22],
                                'work_phone' => $temp1[23],
                                'other_phone' => $temp1[24],
                                'fax' => $temp1[25],
                                'email' => $temp1[26],
                                'height' => $height,
                                'weight' => $weight,
                                'bmi' => $bmi,
                                'highest_education_level' => $temp1[27],
                                'income_level' => $temp1[31],
                                'created_on' => $created_date
                            );
                                                        
                            $data_patient_hospital_no[] = array(
                                'patient_ic_no' => $temp1[5],
                                'hospital_no' => $temp1[15],
                                'created_on' => $created_date
                            );

                            /*$data_patient_private_no[] = array(
                                'patient_ic_no' => $temp1[5],
                                'private_no' => $temp1[16],
                                'created_on' => $created_date
                            );*/

                            $data_patient_cogs_studies[] = array(
                                'patient_ic_no' => $temp1[5],
                                'COGS_studies_name' => $temp1[16],
                                'COGS_studies_no' => $temp1[17],
                                'created_on' => $created_date
                            );

                            $data_patient_contact_person[] = array(
                                'patient_ic_no' => $temp1[5],
                                'contact_name' => $temp1[32],
                                'contact_relationship' => $temp1[34],
                                'contact_telephone' => $temp1[33],
                                'created_on' => $created_date
                            );

                            $data_patient_relatives_summary[] = array(
                                'patient_ic_no' => $temp1[5],
                                'total_no_of_male_siblings' => $temp1[36],
                                'total_no_of_female_siblings' => $temp1[37],
                                'total_no_of_affected_siblings' => $temp1[38],
                                'total_no_of_male_children' => $temp1[39],
                                'total_no_of_female_children' => $temp1[40],
                                'total_no_of_affected_children' => $temp1[41],
                                'total_no_of_1st_degree' => $temp1[42],
                                'total_no_of_2nd_degree' => $temp1[43],
                                'total_no_of_3rd_degree' => $temp1[44],
                                'total_no_of_siblings' => $total_no_of_siblings,
                                'created_on' => $created_date
                            );

                            $data_patient_survival_status[] = array(
                                'patient_ic_no' => $temp1[5],
                                'source' => $temp1[45],
                                'alive_status' => $alive_status,
                                'status_gathering_date' => $temp1[47],
                                'created_on' => $created_date
                            );
                        }
                        $temp1 = null;
                    }


                    echo '<pre>';
                    //print_r($data_patient);
                    //print_r($data_patient_update);
                    //print_r($data_patient_hospital_no);
                    //print_r($data_patient_private_no);
                    //print_r($data_patient_cogs_studies);
                    //print_r($data_patient_contact_person);
                    //print_r($data_patient_relatives_summary);
                    //print_r($data_patient_survival_status);

                    if(!$abort)//if any data is not valid
                    {
                            if (sizeof($data_patient) > 0 && sizeof($data_patient_hospital_no) > 0 
                            && sizeof($data_patient_cogs_studies) > 0 
                            && sizeof($data_patient_contact_person) > 0 && sizeof($data_patient_relatives_summary) > 0 
                            && sizeof($data_patient_survival_status) > 0) 
                            {
                            $id_data_patient = $this->excell_sheets_model->insert_record($data_patient, 'patient');
                            //echo 'inserted_id     '.$id_data_patient;
                            if ($id_data_patient > 0)
                                echo 'Data added succesfully at patient table';
                            else
                                echo 'Data added succesfully at patient table';
                            echo '<br/>';
                            
                            $data_patient = null;
                            
                            $id_data_patient_hospital_no = $this->excell_sheets_model->insert_record($data_patient_hospital_no, 'patient_hospital_no');

                            if ($id_data_patient_hospital_no > 0)
                                echo 'Data added succesfully at patient_hospital_no table';
                            else
                                echo 'Failed to insert at patient_hospital_no table';
                            echo '<br/>';
                            
                            $data_patient_hospital_no = null;
                            
                            /*$id_data_patient_private_no = $this->excell_sheets_model->insert_record($data_patient_private_no, 'patient_private_no');

                            if ($id_data_patient_private_no > 0)
                                echo 'Data added succesfully at patient_private_no table';
                            else
                                echo 'Failed to insert at patient_private_no table';
                            echo '<br/>';*/

                            $id_data_patient_cogs_studies = $this->excell_sheets_model->insert_record($data_patient_cogs_studies, 'patient_cogs_studies');

                            $data_patient_cogs_studies = null;
                            
                            if ($id_data_patient_cogs_studies > 0)
                                echo 'Data added succesfully at patient_cogs_studies table';
                            else
                                echo 'Failed to insert at patient_cogs_studies table';
                            echo '<br/>';

                            $id_data_patient_contact_person = $this->excell_sheets_model->insert_record($data_patient_contact_person, 'patient_contact_person');
                            if ($id_data_patient_contact_person > 0)
                                echo 'Data added succesfully at patient_contact_person table';
                            else
                                echo 'Failed to insert at patient_contact_person table';
                            echo '<br/>';
                            $data_patient_contact_person = null;
                            $id_data_patient_relatives_summary = $this->excell_sheets_model->insert_record($data_patient_relatives_summary, 'patient_relatives_summary');

                            if ($id_data_patient_relatives_summary > 0)
                                echo 'Data added succesfully at patient_relatives_summary table';
                            else
                                echo 'Failed to insert at patient_relatives_summary table';
                            echo '<br/>';
                            
                            $data_patient_relatives_summary = null;
                            
                            $id_data_patient_survival_status = $this->excell_sheets_model->insert_record($data_patient_survival_status, 'patient_survival_status');

                            if ($id_data_patient_survival_status > 0)
                                echo 'Data added succesfully at patient_survival_status table';
                            else
                                echo 'Failed to insert at patient_survival_status table';
                            echo '<br/>';
                            $data_patient_survival_status = null;
                        }

                        if (sizeof($data_patient_update) > 0 && sizeof($data_patient_hospital_no_update) > 0 
                           && sizeof($data_patient_cogs_studies_update) > 0 
                           && sizeof($data_patient_contact_person_update) > 0 && sizeof($data_patient_relatives_summary_update) > 0 
                           && sizeof($data_patient_survival_status_update) > 0) 
                        {
                            $id_data_patient = $this->db->update_batch('patient', $data_patient_update, 'ic_no');
                            //echo 'inserted_id     '.$id_data_patient;
                            if ($id_data_patient > 0)
                                echo 'Data updated succesfully at patient table';
                            else
                                echo 'Updated Data at patient table';
                            echo '<br/>';
                            $data_patient_update = null;
                            $id_data_patient_hospital_no = $this->db->update_batch('patient_hospital_no', $data_patient_hospital_no_update, 'patient_ic_no');

                            if ($id_data_patient_hospital_no > 0)
                                echo 'Data updated succesfully at patient_hospital_no table';
                            else
                                echo 'Updated Data at patient_hospital_no table';
                            echo '<br/>';
                            $data_patient_hospital_no_update = null;
                            /*$id_data_patient_private_no = $this->db->update_batch('patient_private_no', $data_patient_private_no_update, 'patient_ic_no');
                            if ($id_data_patient_private_no > 0)
                                echo 'Data updated succesfully at patient_private_no table';
                            else
                                echo 'Updated Data at patient_private_no table';
                            echo '<br/>';
                            $data_patient_private_no_update = null;*/
                            $id_data_patient_cogs_studies = $this->db->update_batch('patient_cogs_studies', $data_patient_cogs_studies_update, 'patient_ic_no');

                            if ($id_data_patient_cogs_studies > 0)
                                echo 'Data updated succesfully at patient_cogs_studies table';
                            else
                                echo 'Updated Data at patient_cogs_studies table';
                            echo '<br/>';
                            $data_patient_cogs_studies_update = null;
                            $id_data_patient_contact_person = $this->db->update_batch('patient_contact_person', $data_patient_contact_person_update, 'patient_ic_no');
                            if ($id_data_patient_contact_person > 0)
                                echo 'Data updated succesfully at patient_contact_person table';
                            else
                                echo 'Updated Data at patient_contact_person table';
                            echo '<br/>';
                            $data_patient_contact_person_update = null;
                            $id_data_patient_relatives_summary = $this->db->update_batch('patient_relatives_summary', $data_patient_relatives_summary_update, 'patient_ic_no');

                            if ($id_data_patient_relatives_summary > 0)
                                echo 'Data updated succesfully at patient_relatives_summary table';
                            else
                                echo 'Updated Data at patient_relatives_summary table';
                            echo '<br/>';
                            $data_patient_relatives_summary_update = null;
                            $id_data_patient_survival_status = $this->db->update_batch('patient_survival_status', $data_patient_survival_status_update, 'patient_ic_no');

                            if ($id_data_patient_survival_status > 0)
                                echo 'Data updated succesfully at patient_survival_status table';
                            else
                                echo 'Updated Data at patient_survival_status table';
                            echo '<br/>';
                            $data_patient_survival_status_update = null;
                        }
                    }
                    $data_patient = null;
                    $data_patient_update = null;
                    $temp1 = null;
                    $data_patient_hospital_no_update = null;
                    //$data_patient_private_no_update = null;
                    $data_patient_cogs_studies_update = null;
                    $data_patient_contact_person_update = null;
                    $data_patient_relatives_summary_update = null;
                    $data_patient_survival_status_update = null;

                    $data_patient_hospital_no = null;
                    //$data_patient_private_no = null;
                    $data_patient_cogs_studies = null;
                    $data_patient_contact_person = null;
                    $data_patient_relatives_summary = null;
                    $data_patient_survival_status = null;
    }
    
}
?>
