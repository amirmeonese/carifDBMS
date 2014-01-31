<?php
class ModelScreening3 extends CI_Model {
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
    
    public function Screening3($sheet)
    {
        $abort = FALSE;
        $created_date = date('Y-m-d H:i:s');
        $data_patient_risk_reducing_surgery_update = array();
                    $data_patient_risk_reducing_surgery_update = null;
                    $data_patient_risk_reducing_surgery = array();
                    $data_patient_risk_reducing_surgery = null;
                    $data_patient_risk_reducing_surgery_lesion = array();
                    $data_patient_risk_reducing_surgery_lesion = null;
                    $data_patient_risk_reducing_surgery_complete_removal = array();
                    $data_patient_risk_reducing_surgery_complete_removal = null;
                    $temp6 = array();
                    
                    $temp_pt_studies_id_pt_risk_red_surgery = array();
                    $temp_pt_studies_id_pt_risk_red_surgery = null;           
                    $this->db->select('patient_studies_id');
                    $this->db->from('patient_risk_reducing_surgery');
                    $temp_pt_studies_id_pt_risk_red_surgery = $this->db->get()->result_array();

                    //print_r($temp_pt_studies_id_pt_risk_red_surgery);
                    $result_pt_studies_id_pt_risk_red_surgery = array();
                    for ($i = 0; $i < sizeof($temp_pt_studies_id_pt_risk_red_surgery); $i++) {
                        $result_pt_studies_id_pt_risk_red_surgery [$i] = $temp_pt_studies_id_pt_risk_red_surgery[$i]['patient_studies_id'];
                    }
                    $temp_pt_studies_id_pt_risk_red_surgery = null;
                    
                    $temp_pt_risk_reduc_surgery_id_surgery_lesion = array();
                    $temp_pt_risk_reduc_surgery_id_surgery_lesion = null;
                    $this->db->select('patient_risk_reducing_surgery_id');
                    $this->db->from('patient_risk_reducing_surgery_lesion');
                    $temp_pt_risk_reduc_surgery_id_surgery_lesion = $this->db->get()->result_array();

                    //print_r($temp_pt_risk_reduc_surgery_id_pt_risk_red_surgery_lesion);
                    $result_pt_risk_reduc_surgery_id_surgery_lesion = array();
                    for ($i = 0; $i < sizeof($temp_pt_risk_reduc_surgery_id_surgery_lesion); $i++) {
                        $result_pt_risk_reduc_surgery_id_surgery_lesion [$i] = $temp_pt_risk_reduc_surgery_id_surgery_lesion[$i]['patient_risk_reducing_surgery_id'];
                    }
                    $temp_pt_risk_reduc_surgery_id_surgery_lesion = null;
                    
                    $temp_pt_risk_reduc_surgery_id_complete_removal = array();
                    $temp_pt_risk_reduc_surgery_id_complete_removal = null;
                    $this->db->select('patient_risk_reducing_surgery_id');
                    $this->db->from('patient_risk_reducing_surgery_complete_removal');
                    $temp_pt_risk_reduc_surgery_id_complete_removal = $this->db->get()->result_array();

                    //print_r($temp_pt_risk_reduc_surgery_id_pt_risk_red_surgery_lesion);
                    $result_pt_risk_reduc_surgery_id_complete_removal = array();
                    for ($i = 0; $i < sizeof($temp_pt_risk_reduc_surgery_id_complete_removal); $i++) {
                        $result_pt_risk_reduc_surgery_id_complete_removal [$i] = $temp_pt_risk_reduc_surgery_id_complete_removal[$i]['patient_risk_reducing_surgery_id'];
                    }
                    $temp_pt_risk_reduc_surgery_id_complete_removal = null;
                    
                    $temp_patient_studies_id = array();
                    $temp_patient_studies_id = null;
                    $i = 0;
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        
                        $temp6 = null;
                        foreach ($cellIterator as $key => $cell) {
                            $cell_value = $cell->getFormattedValue();

                            if ($key == 0 && $cell_value != NULL)
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);

                            //echo $key; // 0, 1, 2..
                            if ($key == 3 && $cell_value == NULL)
                                $cell_value = 'None';

                            if ($key == 6 && $cell_value == NULL)
                                $cell_value = 'None';
                            
                            if (($key == 4 || $key == 7) && $cell_value != NULL) {
                                if (strpos($cell_value, '-') !== FALSE)
                                    $cell_value = date("d/m/Y", strtotime($cell_value));
                                list($day, $month, $year) = explode("/", $cell_value);

                                if (!checkdate($month, $day, $year)) {
                                    if($key == 4)
                                    $this->model_validator->showMessage("surgery_date","Sreening and Surveilance3",$i);
                                    
                                    if($key == 7)
                                    $this->model_validator->showMessage("surgery_date","Sreening and Surveilance3",$i);
                                    $abort = TRUE;
                                    break;
                                }
                            }
                            
                            if ($key == 4 || $key == 7) {
                                if ($cell_value != NULL) {
                                    $cell_value = date('Y-m-d', strtotime(str_replace('/', '-', $cell_value)));
                                }
                            }

                            $temp6[] = $cell_value;
                        }
                        
                        if($abort)
                        break;
                        
                        if(strpos(strtoupper($temp6[2]), 'Y') !== false)
                            $had_new_lesion_surgery_flag = TRUE;
                        else if(strpos(strtoupper($temp6[2]), 'N') !== false)
                            $had_new_lesion_surgery_flag = FALSE;
                        else
                            $had_new_lesion_surgery_flag = FALSE;

                       if(strpos(strtoupper($temp6[5]), 'Y') !== false)
                            $had_complete_removal_surgery_flag = TRUE;
                        else if(strpos(strtoupper($temp6[5]), 'N') !== false)
                            $had_complete_removal_surgery_flag = FALSE;
                        else
                            $had_complete_removal_surgery_flag = FALSE;

                        $studies_id = $this->excell_sheets_model->get_id('studies', 'studies_id', 'studies_name', $temp6[1]);
                        $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($temp6[0], $studies_id);
                        $temp_patient_studies_id[] = $patient_studies_id;
                        
                        if(in_array($patient_studies_id, $result_pt_studies_id_pt_risk_red_surgery))
                        {
                            $data_patient_risk_reducing_surgery_update[] = array(
                            'patient_studies_id' => $patient_studies_id,
                            'had_new_lesion_surgery_flag' => $had_new_lesion_surgery_flag,
                            'had_complete_removal_surgery_flag' => $had_complete_removal_surgery_flag,
                            'created_on' => $created_date
                            );
                        }
                        else
                        {
                            $data_patient_risk_reducing_surgery[] = array(
                            'patient_studies_id' => $patient_studies_id,
                            'had_new_lesion_surgery_flag' => $had_new_lesion_surgery_flag,
                            'had_complete_removal_surgery_flag' => $had_complete_removal_surgery_flag,
                            'created_on' => $created_date
                            );
                        }


                        $non_cancerous_site_id = $this->excell_sheets_model->get_id('non_cancerous_site', 'non_cancerous_site_id', 'non_cancerous_site_name', $temp6[3]);
                        $data_patient_risk_reducing_surgery_lesion[] = array(
                            'patient_risk_reducing_surgery_id' => 1,
                            'non_cancerous_site_id' => $non_cancerous_site_id,
                            'surgery_date' => $temp6[4],
                            'created_on' => $created_date
                        );

                        $non_cancerous_site_id = $this->excell_sheets_model->get_id('non_cancerous_site', 'non_cancerous_site_id', 'non_cancerous_site_name', $temp6[6]);
                        $data_patient_risk_reducing_surgery_complete_removal[] = array(
                            'patient_risk_reducing_surgery_id' => 1,
                            'non_cancerous_site_id' => $non_cancerous_site_id,
                            'surgery_date' => $temp6[7],
                            'surgery_reason' => $temp6[8],
                            'created_on' => $created_date
                        );
                        $temp6 = null;
                    }
                    //print_r($data_patient_risk_reducing_surgery);
                    // print_r($patient_risk_reducing_surgery_lesion);
                    //print_r($patient_risk_reducing_surgery_complete_removal);
                    if(sizeof($data_patient_risk_reducing_surgery) > 0)
                    {
                        $id_patient_risk_reducing_surgery = $this->excell_sheets_model->insert_record($data_patient_risk_reducing_surgery, 'patient_risk_reducing_surgery');
                        if ($id_patient_risk_reducing_surgery > 0)
                            echo 'Data added succesfully at patient_risk_reducing_surgery table';
                        else
                            echo 'Failed to insert at patient_risk_reducing_surgery table';
                        echo '<br/>';
                        $data_patient_risk_reducing_surgery = null;
                    }
 
                    if(sizeof($data_patient_risk_reducing_surgery_update) > 0)
                    {
                        $id_patient_risk_reducing_surgery = $this->db->update_batch('patient_risk_reducing_surgery',$data_patient_risk_reducing_surgery_update, 'patient_studies_id');
                        if ($id_patient_risk_reducing_surgery > 0)
                            echo 'Data updated succesfully at patient_risk_reducing_surgery table';
                        else
                            echo 'Updated Data at patient_risk_reducing_surgery table';
                        echo '<br/>';
                        $data_patient_risk_reducing_surgery_update = null;
                    }        
                    
                    $data_patient_risk_reducing_surgery_lesion_update = array();
                    $data_patient_risk_reducing_surgery_lesion_update = null;
                    $data_patient_risk_reducing_surgery_lesion_insert = array();
                    $data_patient_risk_reducing_surgery_lesion_insert = null;
                    
                    $data_patient_risk_reducing_surgery_complete_update = array();
                    $data_patient_risk_reducing_surgery_complete_update = null;
                    $data_patient_risk_reducing_surgery_complete_insert = array();
                    $data_patient_risk_reducing_surgery_complete_insert = null;
                    
                    $tempLength = sizeof($temp_patient_studies_id);
                    
                    for ($key = 0; $key < $tempLength; $key++) {
                        $patient_risk_reducing_surgery_id = $this->excell_sheets_model->get_id('patient_risk_reducing_surgery', 'patient_risk_reducing_surgery_id', 'patient_studies_id', $temp_patient_studies_id[$key]);
                        $data_patient_risk_reducing_surgery_lesion[$key]['patient_risk_reducing_surgery_id'] = $patient_risk_reducing_surgery_id;
                        if(in_array($patient_risk_reducing_surgery_id, $result_pt_risk_reduc_surgery_id_surgery_lesion))
                        {
                            $data_patient_risk_reducing_surgery_lesion_update[] = $data_patient_risk_reducing_surgery_lesion[$key];
                        }
                        else
                        {
                            $data_patient_risk_reducing_surgery_lesion_insert[] = $data_patient_risk_reducing_surgery_lesion[$key];
                        }
                        
                        $data_patient_risk_reducing_surgery_complete_removal[$key]['patient_risk_reducing_surgery_id'] = $patient_risk_reducing_surgery_id;
                        
                        if(in_array($patient_risk_reducing_surgery_id, $result_pt_risk_reduc_surgery_id_complete_removal))
                        {
                            $data_patient_risk_reducing_surgery_complete_update[] = $data_patient_risk_reducing_surgery_complete_removal[$key];
                        }
                        else
                        {
                            $data_patient_risk_reducing_surgery_complete_insert[] = $data_patient_risk_reducing_surgery_complete_removal[$key];
                        }
                    }
                    $data_patient_risk_reducing_surgery_lesion = null;
                    $data_patient_risk_reducing_surgery_complete_removal = null;

                    //print_r($patient_risk_reducing_surgery_lesion);
                    // print_r($patient_risk_reducing_surgery_complete_removal);
                    if(sizeof($data_patient_risk_reducing_surgery_lesion_insert) > 0)
                    {
                        $id_patient_risk_reducing_surgery_lesion = $this->excell_sheets_model->insert_record($data_patient_risk_reducing_surgery_lesion_insert, 'patient_risk_reducing_surgery_lesion');
                        if ($id_patient_risk_reducing_surgery_lesion > 0)
                            echo 'Data added succesfully at patient_risk_reducing_surgery_lesion table';
                        else
                            echo 'Failed to insert at patient_risk_reducing_surgery_lesion table';
                        echo '<br/>';
                        $data_patient_risk_reducing_surgery_lesion_insert = null;
                    }
                    
                    if(sizeof($data_patient_risk_reducing_surgery_lesion_update) > 0)
                    {
                        $id_patient_risk_reducing_surgery_lesion = $this->db->update_batch('patient_risk_reducing_surgery_lesion',$data_patient_risk_reducing_surgery_lesion_update,'patient_risk_reducing_surgery_id');
                        
                        if ($id_patient_risk_reducing_surgery_lesion > 0)
                            echo 'Data updated succesfully at patient_risk_reducing_surgery_lesion table';
                        else
                            echo 'Updated Data at patient_risk_reducing_surgery_lesion table';
                        echo '<br/>';
                        $data_patient_risk_reducing_surgery_lesion_update = null;
                    }

                    if(sizeof($data_patient_risk_reducing_surgery_complete_insert) > 0)
                    {
                        $id_patient_risk_reducing_surgery_complete_removal = $this->excell_sheets_model->insert_record($data_patient_risk_reducing_surgery_complete_insert, 'patient_risk_reducing_surgery_complete_removal');
                        if ($id_patient_risk_reducing_surgery_complete_removal > 0)
                            echo 'Data added succesfully at patient_risk_reducing_surgery_complete_removal table';
                        else
                            echo 'Failed to insert at patient_risk_reducing_surgery_complete_removal table';
                        echo '<br/>';
                        $data_patient_risk_reducing_surgery_complete_insert = null;
                    }
                    
                    if(sizeof($data_patient_risk_reducing_surgery_complete_update) > 0)
                    {
                        $id_patient_risk_reducing_surgery_complete_removal = $this->db->update_batch('patient_risk_reducing_surgery_complete_removal',$data_patient_risk_reducing_surgery_complete_update,'patient_risk_reducing_surgery_id');
                        if ($id_patient_risk_reducing_surgery_complete_removal > 0)
                            echo 'Data updated succesfully at patient_risk_reducing_surgery_complete_removal table';
                        else
                            echo 'Updated Data at patient_risk_reducing_surgery_complete_removal table';
                        echo '<br/>';
                        $data_patient_risk_reducing_surgery_complete_update = null;
                    }
                    
                    $data_patient_risk_reducing_surgery_update = null;
                    $data_patient_risk_reducing_surgery = null;
                    $temp_pt_studies_id_pt_risk_red_surgery = null;
                    $result_pt_studies_id_pt_risk_red_surgery = null;
                    $temp_pt_risk_reduc_surgery_id_surgery_lesion = null;
                    $result_pt_risk_reduc_surgery_id_surgery_lesion = null;
                    $temp_pt_risk_reduc_surgery_id_complete_removal = null;
                    $result_pt_risk_reduc_surgery_id_complete_removal = null;
                    $temp_patient_studies_id = null;
                    $temp6 = null;
                    $temp_patient_studies_id = null;
                    $data_patient_risk_reducing_surgery_lesion = null;
                    $data_patient_risk_reducing_surgery_complete_removal = null;
                    $data_patient_risk_reducing_surgery_lesion_update = null;
                    $data_patient_risk_reducing_surgery_lesion_insert = null;
                    $data_patient_risk_reducing_surgery_complete_update = null;
                    $data_patient_risk_reducing_surgery_complete_insert = null;
    }
}  
?>
