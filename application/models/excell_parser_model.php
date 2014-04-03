<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Excell_parser_model extends CI_Model {

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
        $this->load->model('model_Personal');
        $this->load->model('modelPersonal2');
        $this->load->model('modelScreening1');
        $this->load->model('modelScreening2');
        $this->load->model('modelScreening3');
        $this->load->model('modelScreening4');
        $this->load->model('modelScreening5');
        $this->load->model('modelMutationAnalysis');
        $this->load->model('modelRiskAssesment');
        $this->load->model('modelLifestyles1');
        $this->load->model('modelLifestyles2');
        $this->load->model('modelLifestyles3');
        $this->load->model('modelDiagnosis1');
        $this->load->model('modelDiagnosis2');
        $this->load->model('modelFamily');
        $this->load->model('modelCounselling');

        //Loading PHPExcell Library
        $this->load->library('PHPExcel');
    }

    function excell_file_parser($filePath) {
        //$this->load->view('record/record_home');
        $inputFileType = 'Excel2007';

        //$inputFileName = './sampleData/carif_dummy_data_sample.xlsx';
        $inputFileName = './uploads/' . $filePath;
        //echo 'Loading file ', pathinfo($inputFileName, PATHINFO_BASENAME), ' using IOFactory with a defined reader type of ', $inputFileType, '<br />';
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        //echo 'Loading all WorkSheets<br />';
        //$objReader->setReadDataOnly(true);
        $objReader->setLoadAllSheets();
        $objPHPExcel = $objReader->load($inputFileName);

        //echo $objPHPExcel->getSheetCount(), ' worksheet', (($objPHPExcel->getSheetCount() == 1) ? '' : 's'), ' loaded<br /><br />';

        $loadedSheetNames = $objPHPExcel->getSheetNames();


        echo '<pre>';
        $temp_result_studies_name = array();
        $temp_result_studies_name = null;
        $this->db->select('studies_name');
        $this->db->from('studies');
        $temp_result_studies_name = $this->db->get()->result_array();

        //print_r($temp_result_relationship);
        $result_studies_name = array();
        for ($i = 0; $i < sizeof($temp_result_studies_name); $i++) {
            //echo $result_relationship[$j]['relatives_type']. '<br/>';
            $result_studies_name[$i] = $temp_result_studies_name[$i]['studies_name'];
            //echo $result_studies_name[$i] . '<br/>';
        }

        $temp_result_diagnonis_name = array();
        $temp_result_diagnonis_name = null;
        $this->db->select('diagnosis_name');
        $this->db->from('diagnosis');
        $temp_result_diagnonis_name = $this->db->get()->result_array();

        //print_r($temp_result_relationship);
        $result_diagnonis_name = array();
        for ($i = 0; $i < sizeof($temp_result_diagnonis_name); $i++) {
            //echo $result_relationship[$j]['relatives_type']. '<br/>';
            $result_diagnonis_name[$i] = $temp_result_diagnonis_name[$i]['diagnosis_name'];
            //echo $result_studies_name[$i] . '<br/>';
        }

        //taking value from patient table to check either to update or insert data
        $temp_array_IC_no_db = array();
        $temp_array_IC_no_db = null;
        $this->db->select('ic_no');
        $this->db->from('patient');
        $temp_array_IC_no_db = $this->db->get()->result_array();

        $array_IC_no_db = array();
        for ($i = 0; $i < sizeof($temp_array_IC_no_db); $i++) {
            //echo $result_relationship[$j]['relatives_type']. '<br/>';
            $array_IC_no_db[$i] = $temp_array_IC_no_db[$i]['ic_no'];
            //echo $result_studies_name[$i] . '<br/>';
        }
        $temp_array_IC_no_db = null;

        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();

        foreach ($loadedSheetNames as $sheetIndex => $loadedSheetName) {
            //echo 'Sheet name: '.$loadedSheetName.'<br>';
            /* echo '<pre>';
              echo 'Sheet name: '.$loadedSheetName; */
            //$objPHPExcel->setActiveSheetIndex($sheetIndex);
            // $sheet = $objPHPExcel->getActiveSheet();

            if ($loadedSheetName == 'Personal') {
                $this->model_Personal->Personal($sheet, $array_IC_no_db);
            }

            if ($loadedSheetName == 'Personal2') {
                $this->modelPersonal2->Personal2($sheet);
            }

            if ($loadedSheetName == 'Diagnosis & Treatment') {
                $this->modelDiagnosis1->Diagnosis1($sheet);
            }

            if ($loadedSheetName == 'Diagnosis & Treatment2') {
                $this->modelDiagnosis2->Diagnosis2($sheet);
            }

            if ($loadedSheetName == 'Family') {
                $this->modelFamily->Family($sheet);
            }

            if ($loadedSheetName == 'Sreening and Surveilance1') {
                $this->modelScreening1->Screening1($sheet);
            }

            if ($loadedSheetName == 'Sreening and Surveilance2') {
                $this->modelScreening2->Screening2($sheet);
            }

            if ($loadedSheetName == 'Sreening and Surveilance3') {
                $this->modelScreening3->Screening3($sheet);
            }

            if ($loadedSheetName == 'Sreening and Surveilance4') {
                $this->modelScreening4->Screening4($sheet);
            }

            if ($loadedSheetName == 'Sreening and Surveilance5') {
                $this->modelScreening5->Screening5($sheet);
            }

            if ($loadedSheetName == 'Mutation analysis') {
                $this->modelMutationAnalysis->mutation($sheet);
            }

            if ($loadedSheetName == 'Risk Assesment') {
                $this->modelRiskAssesment->RiskAssesment($sheet);
            }

            if ($loadedSheetName == 'Lifestyles1') {
                $this->modelLifestyles1->Lifestyles1($sheet);
            }

            if ($loadedSheetName == 'Lifestyle2') {
                $this->modelLifestyles2->Lifestyles2($sheet);
            }

            if ($loadedSheetName == 'Lifestyle3') {
                $this->modelLifestyles3->Lifestyles3($sheet);
            }
            
            if ($loadedSheetName == 'Counselling') {
                $this->modelCounselling->Counselling($sheet);
            }
        }

        $objPHPExcel->disconnectWorksheets();
        unset($objPHPExcel);
        $temp_result_studies_name = null;
        $result_studies_name = null;
        $temp_result_diagnonis_name = null;
        $result_diagnonis_name = null;
        $temp_array_IC_no_db = null;
        $array_IC_no_db = null;
    }

    function check_name($name) {
        if (ctype_alpha(str_replace(array(' ', "'", '@', '/', '.'), '', $name)))   //if (ctype_alpha(str_replace(' ', '', $name)))
            return TRUE;
        else
            return FALSE;
    }

    function check_IC_NO($ic_no) {
        if (ctype_digit($ic_no))
            return TRUE;
        else
            return FALSE;
    }

    function check_phone_no($phone_no) {
        if (ctype_digit($phone_no))
            return TRUE;
        else
            return FALSE;
    }

    function check_email($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL))
            return TRUE;
        else
            return FALSE;
    }

    public function test($fileName) {
        echo $fileName;
    }

}

?>
