<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Excell_auto_verification extends CI_Model {

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
        //Loading PHPExcell Library
        $this->load->library('PHPExcel');
    }

    function excell_parser($filePath) {
        //$this->load->view('record/record_home');
        $inputFileType = 'Excel2007';

        //$inputFileName = './sampleData/carif_dummy_data_sample.xlsx';
        $inputFileName = './uploads/' . $filePath;
        //echo 'Loading file ', pathinfo($inputFileName, PATHINFO_BASENAME), ' using IOFactory with a defined reader type of ', $inputFileType, '<br />';
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        //echo 'Loading all WorkSheets<br />';
        $objReader->setReadDataOnly(true);
        $objReader->setLoadAllSheets();
        $objPHPExcel = $objReader->load($inputFileName);
        $loadedSheetNames = $objPHPExcel->getSheetNames();

        //$objPHPExcel->setActiveSheetIndex(0);
        //$sheet = $objPHPExcel->getActiveSheet();
        //echo '<hr />';
        //echo $objPHPExcel->getSheetCount(), ' worksheet', (($objPHPExcel->getSheetCount() == 1) ? '' : 's'), ' loaded<br /><br />';
        $array_IC_no_duplicate = array();
        $array_IC_no_duplicate = null;
        $array_given_name = array();
        $array_given_name = null;
        $givenName = null;
        $array_given_name_duplicate = array();
        $array_given_name_duplicate = null;
        //echo '<pre>';
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

        $temp_array_given_name_db = array();
        $temp_array_given_name_db = null;
        $this->db->select('given_name');
        $this->db->from('patient');
        $temp_array_given_name_db = $this->db->get()->result_array();

        $array_given_name_db = array();
        for ($i = 0; $i < sizeof($temp_array_given_name_db); $i++) {
            //echo $result_relationship[$j]['relatives_type']. '<br/>';
            $array_given_name_db[$i] = $temp_array_given_name_db[$i]['given_name'];
            //echo $result_studies_name[$i] . '<br/>';
        }
        $temp_array_given_name_db = null;
        //echo '<pre>';
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();
        
        foreach ($loadedSheetNames as $sheetIndex => $loadedSheetName) {
            
            if ($loadedSheetName == 'Personal') {
                $i = 0;

                foreach ($sheet->getRowIterator() as $row) {
                    $i++;

                    if ($i == 1)//ommiting cell header name
                        continue;

                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(false);

                    foreach ($cellIterator as $key => $cell) {
                        $cell_value = $cell->getFormattedValue();

                        if ($key == 0 && $cell_value != NULL)
                            $givenName = $cell_value;

                        if ($key == 5 && $cell_value != NULL) {
                            $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
                            $cell_value_ic = $cell_value;
                        }
                    }


                    if (in_array($cell_value_ic, $array_IC_no_db) && !in_array($givenName, $array_given_name_db)) {
                        $array_IC_no_duplicate[] = $cell_value_ic;
                    }
                }
            }
        }   
        //print_r($array_IC_no);
      
        $objPHPExcel->disconnectWorksheets();
        unset($objPHPExcel);
        $array_IC_no_db = null;
        $array_given_name_db = null;
        return $array_IC_no_duplicate;
    }

}
?>

