<?php

class ModelRiskAssesment extends CI_Model {

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

    public function RiskAssesment($sheet) {
        $created_date = date('Y-m-d H:i:s');
        $temp10 = array();
        $data_patient_risk_assessment = array();
        $data_patient_risk_assessment = null;
        $data_patient_risk_assessment_update = array();
        $data_patient_risk_assessment_update = null;
        $temp_result_patient_ic_no = array();
        $temp_result_patient_ic_no = null;
        $this->db->select('patient_ic_no');
        $this->db->from('patient_risk_assessment');
        $temp_result_patient_ic_no = $this->db->get()->result_array();

        //print_r($temp_result_relationship);
        $result_patient_ic_no = array();
        for ($i = 0; $i < sizeof($temp_result_patient_ic_no); $i++) {
            //echo $result_relationship[$j]['relatives_type']. '<br/>';
            $result_patient_ic_no[$i] = $temp_result_patient_ic_no[$i]['patient_ic_no'];
            //echo $result_studies_name[$i] . '<br/>';
        }
        $temp_result_patient_ic_no = null;
        $i = 0;
        foreach ($sheet->getRowIterator() as $row) {
            $i++;

            if ($i == 1)//ommiting cell header name
                continue;

            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            
            $temp10 = null;
            foreach ($cellIterator as $key => $cell) {
                $cell_value = $cell->getFormattedValue();

                if ($key == 0 && $cell_value != NULL)
                    $cell_value = preg_replace("/[^0-9]/", "", $cell_value);

                //echo $key; // 0, 1, 2..
                $temp10[] = $cell_value;
            }

            if (in_array($temp10[0], $result_patient_ic_no)) {
                $data_patient_risk_assessment_update[] = array(
                    'patient_ic_no' => $temp10[0],
                    'at_consent_mach_brca1' => $temp10[2],
                    'at_consent_mach_brca2' => $temp10[3],
                    'at_consent_mach_total' => $temp10[4],
                    'adjusted_mach_brca1' => $temp10[5],
                    'adjusted_mach_brca2' => $temp10[6],
                    'adjusted_mach_total' => $temp10[7],
                    'after_gc_brca1' => $temp10[8],
                    'after_gc_brca2' => $temp10[9],
                    'after_gc_total' => $temp10[10],
                    'at_consent_boadicea_brca1' => $temp10[11],
                    'at_consent_boadicea_brca2' => $temp10[12],
                    'at_consent_boadicea_no_mutation' => $temp10[13],
                    'adjusted_boadicea_brca1' => $temp10[14],
                    'adjusted_boadicea_brca2' => $temp10[15],
                    'adjusted_boadicea_no_mutation' => $temp10[16],
                    'after_gc_boadicea_brca1' => $temp10[17],
                    'after_gc_boadicea_brca2' => $temp10[18],
                    'after_gc_boadicea_no_mutation' => $temp10[19],
                    'at_consent_gail_model_5years' => $temp10[20],
                    'at_consent_gail_model_10years' => $temp10[21],
                    'first_mammo_gail_model_5years' => $temp10[22],
                    'first_mammo_gail_model_10years' => $temp10[23],
                    'created_on' => $created_date
                );
            } else {
                $data_patient_risk_assessment[] = array(
                    'patient_ic_no' => $temp10[0],
                    'at_consent_mach_brca1' => $temp10[2],
                    'at_consent_mach_brca2' => $temp10[3],
                    'at_consent_mach_total' => $temp10[4],
                    'adjusted_mach_brca1' => $temp10[5],
                    'adjusted_mach_brca2' => $temp10[6],
                    'adjusted_mach_total' => $temp10[7],
                    'after_gc_brca1' => $temp10[8],
                    'after_gc_brca2' => $temp10[9],
                    'after_gc_total' => $temp10[10],
                    'at_consent_boadicea_brca1' => $temp10[11],
                    'at_consent_boadicea_brca2' => $temp10[12],
                    'at_consent_boadicea_no_mutation' => $temp10[13],
                    'adjusted_boadicea_brca1' => $temp10[14],
                    'adjusted_boadicea_brca2' => $temp10[15],
                    'adjusted_boadicea_no_mutation' => $temp10[16],
                    'after_gc_boadicea_brca1' => $temp10[17],
                    'after_gc_boadicea_brca2' => $temp10[18],
                    'after_gc_boadicea_no_mutation' => $temp10[19],
                    'at_consent_gail_model_5years' => $temp10[20],
                    'at_consent_gail_model_10years' => $temp10[21],
                    'first_mammo_gail_model_5years' => $temp10[22],
                    'first_mammo_gail_model_10years' => $temp10[23],
                    'created_on' => $created_date
                );
            }
            $temp10 = null;
        }
        //print_r($data_patient_risk_assessment);

        if (sizeof($data_patient_risk_assessment) > 0) {
            $id_patient_risk_assessment = $this->excell_sheets_model->insert_record($data_patient_risk_assessment, 'patient_risk_assessment');
            if ($id_patient_risk_assessment > 0)
                echo 'Data added succesfully at patient_risk_assessment table';
            else
                echo 'Failed to insert at patient_risk_assessment table';
            echo '<br/>';
            $data_patient_risk_assessment = null;
        }

        if (sizeof($data_patient_risk_assessment_update) > 0) {
            $id_patient_risk_assessment = $this->db->update_batch('patient_risk_assessment', $data_patient_risk_assessment_update, 'patient_ic_no');
            if ($id_patient_risk_assessment > 0)
                echo 'Data updated succesfully at patient_risk_assessment table';
            else
                echo 'Updated Data at patient_risk_assessment table';
            echo '<br/>';
            $data_patient_risk_assessment_update = null;
        }

        $data_patient_risk_assessment = null;
        $data_patient_risk_assessment_update = null;
        $temp_result_patient_ic_no = null;
        $result_patient_ic_no = null;
        $temp10 = null;
    }

}

?>
