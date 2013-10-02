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
        //Loading PHPExcell Library
        $this->load->library('PHPExcel');
    }

    function excell_file_parser($filePath) {
        //$this->load->view('record/record_home');
        $inputFileType = 'Excel2007';

        //$inputFileName = './sampleData/carif_dummy_data_sample.xlsx';
        $inputFileName = './uploads/' . $filePath;
        echo 'Loading file ', pathinfo($inputFileName, PATHINFO_BASENAME), ' using IOFactory with a defined reader type of ', $inputFileType, '<br />';
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        echo 'Loading all WorkSheets<br />';
        $objReader->setLoadAllSheets();
        $objPHPExcel = $objReader->load($inputFileName);
        echo '<hr />';
        echo $objPHPExcel->getSheetCount(), ' worksheet', (($objPHPExcel->getSheetCount() == 1) ? '' : 's'), ' loaded<br /><br />';

        $loadedSheetNames = $objPHPExcel->getSheetNames();
        $created_date = date("Y-m-d");
        $array_IC_no = array();
        $abort = FALSE;

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
        //Checking sheets data here
        foreach ($loadedSheetNames as $sheetIndex => $loadedSheetName) {
            $objPHPExcel->setActiveSheetIndex($sheetIndex);
            $sheet = $objPHPExcel->getActiveSheet();
            echo '<pre>';
            $i = 0;

            if (!$abort)
                if ($loadedSheetName == 'Personal') {
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp1 = array();
                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            //$temp1[] = $cell_value;
                            //echo $cell_value . '    ';
                            if ($key == 5)
                                break;
                        }

                        $array_IC_no[] = $cell_value;
                    }

                    //print_r($array_IC_no);
                }
                else if ($loadedSheetName == 'Family') {
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp1 = array();
                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            //$temp1[] = $cell_value;
                            //echo $cell_value . '    ';
                            if ($key == 0) {
                                $array_IC_no_Family[] = $cell_value;
                            }

                            if ($key == 1) {
                                $array_relationship_type[] = $cell_value;
                            }

                            if ($key == 2) {
                                $array_family_name[] = $cell_value;
                                break;
                            }
                        }
                    }

                    //print_r($array_IC_no_Family);
                    //print_r($array_family_name);
                    $temp_result_relationship = array();
                    $temp_result_relationship = null;
                    $this->db->select('relatives_type');
                    $this->db->from('relatives');
                    $temp_result_relationship = $this->db->get()->result_array();

                    //print_r($temp_result_relationship);
                    $result_relationship_type = array();
                    for ($i = 0; $i < sizeof($temp_result_relationship); $i++) {
                        //echo $result_relationship[$j]['relatives_type']. '<br/>';
                        $result_relationship_type[$i] = $temp_result_relationship[$i]['relatives_type'];
                        // echo $result_relationship_type[$i]. '<br/>';
                    }

                    $temp_result_family_name = array();
                    $temp_result_family_name = null;
                    $this->db->select('family_name');
                    $this->db->from('family');
                    $temp_result_family_name = $this->db->get()->result_array();

                    //print_r($temp_result_family_name);
                    $result_family_name = array();
                    for ($i = 0; $i < sizeof($temp_result_family_name); $i++) {
                        //echo $result_relationship[$j]['relatives_type']. '<br/>';
                        $result_family_name[$i] = $temp_result_family_name[$i]['family_name'];
                        //echo $result_family_name[$i]. '<br/>';
                    }

                    for ($i = 0; $i < sizeof($array_IC_no_Family); $i++) {
                        $val_ic_no = in_array($array_IC_no_Family[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_relative_id = in_array($array_relationship_type[$i], $result_relationship_type);

                        $val_family_no = in_array($array_family_name[$i], $result_family_name);
                        if (!$val_ic_no) {
                            echo 'Should ommit import' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_relative_id) {
                            echo 'Should ommit import Realtive id' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_family_no) {
                            echo 'Should ommit import' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }
                } else if ($loadedSheetName == 'Studies') {
                    $array_studies_name = array();
                    $array_studies_name = null;

                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp1 = array();
                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            //$temp1[] = $cell_value;
                            //echo $cell_value . '    ';
                            if ($key == 0) {
                                $array_IC_no_Studies[] = $cell_value;
                            }

                            if ($key == 1) {
                                $array_studies_name[] = $cell_value;
                                break;
                            }
                        }
                    }

                    //print_r($array_IC_no_Family);
                    //print_r($array_family_name);

                    for ($i = 0; $i < sizeof($array_IC_no_Family); $i++) {
                        $val_ic_no = in_array($array_IC_no_Studies[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name[$i], $result_studies_name);

                        if (!$val_ic_no) {
                            echo 'Should ommit import' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_studies_id) {
                            echo 'Should ommit import studies_id' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_family_no) {
                            echo 'Should ommit import' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }
                } else if ($loadedSheetName == 'Breast_Screening1') {
                    $array_studies_name = array();
                    $array_studies_name = null;
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);


                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            //$temp1[] = $cell_value;
                            //echo $cell_value . '    ';
                            if ($key == 0) {
                                $array_IC_no_Breast_Screening1[] = $cell_value;
                            }

                            if ($key == 1) {
                                $array_studies_name[] = $cell_value;
                                break;
                            }
                        }
                    }

                    //print_r($array_IC_no_Family);
                    //print_r($array_family_name);

                    for ($i = 0; $i < sizeof($array_IC_no_Breast_Screening1); $i++) {
                        $val_ic_no = in_array($array_IC_no_Breast_Screening1[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name[$i], $result_studies_name);

                        if (!$val_ic_no) {
                            echo 'Should ommit import' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_studies_id) {
                            echo 'Should ommit import studies_id' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }
                } else if ($loadedSheetName == 'Breast_Abn and other screening') {
                    $array_studies_name = array();
                    $array_studies_name = null;
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);


                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            //$temp1[] = $cell_value;
                            //echo $cell_value . '    ';
                            if ($key == 0) {
                                $array_IC_no_Breast_Abn[] = $cell_value;
                            }

                            if ($key == 1) {
                                $array_studies_name[] = $cell_value;
                                break;
                            }
                        }
                    }

                    //print_r($array_IC_no_Family);
                    //print_r($array_family_name);

                    for ($i = 0; $i < sizeof($array_IC_no_Breast_Abn); $i++) {
                        $val_ic_no = in_array($array_IC_no_Breast_Abn[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name[$i], $result_studies_name);

                        if (!$val_ic_no) {
                            echo 'Should ommit import' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_studies_id) {
                            echo 'Should ommit import studies_id' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }
                } else if ($loadedSheetName == 'Cancer1') {
                    $array_studies_name = array();
                    $array_studies_name = null;
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);


                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            //$temp1[] = $cell_value;
                            //echo $cell_value . '    ';
                            if ($key == 0) {
                                $array_IC_no_Cancer1[] = $cell_value;
                            }

                            if ($key == 1) {
                                $array_studies_name[] = $cell_value;
                                //break;
                            }

                            if ($key == 3) {
                                $array_cancer_name[] = $cell_value;
                                //break;
                            }
                        }
                    }

                    //print_r($array_IC_no_Family);
                    //print_r($array_family_name);
                    $temp_result_cancer_name = array();
                    $temp_result_cancer_name = null;
                    $this->db->select('cancer_name');
                    $this->db->from('cancer');
                    $temp_result_cancer_name = $this->db->get()->result_array();

                    //print_r($temp_result_family_name);
                    $result_cancer_name = array();
                    for ($i = 0; $i < sizeof($temp_result_cancer_name); $i++) {
                        //echo $result_relationship[$j]['relatives_type']. '<br/>';
                        $result_cancer_name[$i] = $temp_result_cancer_name[$i]['cancer_name'];
                        //echo $result_family_name[$i]. '<br/>';
                    }
                    //print_r($result_cancer_name);
                    for ($i = 0; $i < sizeof($array_IC_no_Cancer1); $i++) {
                        $val_ic_no = in_array($array_IC_no_Cancer1[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name[$i], $result_studies_name);

                        $val_cancer_name = in_array($array_cancer_name[$i], $result_cancer_name);

                        if (!$val_ic_no) {
                            echo 'Should ommit import' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_studies_id) {
                            echo 'Should ommit import studies_id' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_cancer_name) {
                            echo 'Should ommit import studies_id' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }
                } else if ($loadedSheetName == 'Cancer2') {
                    $array_studies_name = array();
                    $array_studies_name = null;
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);


                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            //$temp1[] = $cell_value;
                            //echo $cell_value . '    ';
                            if ($key == 0) {
                                $array_IC_no_Cancer2[] = $cell_value;
                            }

                            if ($key == 1) {
                                $array_studies_name[] = $cell_value;
                                //break;
                            }

                            if ($key == 2) {
                                $array_treatment_name[] = $cell_value;
                                //break;
                            }

                            if ($key == 8) {
                                $array_recurrent_treatment_name[] = $cell_value;
                                break;
                            }
                        }
                    }

                    //print_r($array_IC_no_Family);
                    //print_r($array_family_name);
                    $temp_result_treatment_name = array();
                    $temp_result_treatment_name = null;
                    $this->db->select('treatment_name');
                    $this->db->from('treatment');
                    $temp_result_treatment_name = $this->db->get()->result_array();

                    //print_r($temp_result_treatment_name);
                    $result_treatment_name = array();
                    for ($i = 0; $i < sizeof($temp_result_treatment_name); $i++) {
                        //echo $result_relationship[$j]['relatives_type']. '<br/>';
                        $result_treatment_name[$i] = $temp_result_treatment_name[$i]['treatment_name'];
                        //echo $result_family_name[$i]. '<br/>';
                    }
                    //print_r($result_cancer_name);
                    for ($i = 0; $i < sizeof($array_IC_no_Cancer2); $i++) {
                        $val_ic_no = in_array($array_IC_no_Cancer2[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name[$i], $result_studies_name);

                        $val_treatment_name = in_array($array_treatment_name[$i], $result_treatment_name);

                        $val_recurrent_treatment_name = in_array($array_recurrent_treatment_name[$i], $result_treatment_name);

                        if (!$val_ic_no) {
                            echo 'Should ommit import' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_studies_id) {
                            echo 'Should ommit import studies_id' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_treatment_name) {
                            echo 'Should ommit import studies_id' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_recurrent_treatment_name) {
                            echo 'Should ommit import studies_id' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }
                } else if ($loadedSheetName == 'Diagnosis') {
                    $array_studies_name = array();
                    $array_studies_name = null;
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);


                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            //$temp1[] = $cell_value;
                            //echo $cell_value . '    ';
                            if ($key == 0) {
                                $array_IC_no_Diagnosis[] = $cell_value;
                            }

                            if ($key == 1) {
                                $array_studies_name[] = $cell_value;
                                //break;
                            }

                            if ($key == 2) {
                                $array_diagnosis_name[] = $cell_value;
                                //break;
                            }
                        }
                    }

                    //print_r($array_IC_no_Family);
                    //print_r($array_family_name);
                    $temp_result_diagnosis_name = array();
                    $temp_result_diagnosis_name = null;
                    $this->db->select('diagnosis_name');
                    $this->db->from('diagnosis');
                    $temp_result_diagnosis_name = $this->db->get()->result_array();

                    //print_r($temp_result_treatment_name);
                    $result_diagnosis_name = array();
                    for ($i = 0; $i < sizeof($temp_result_diagnosis_name); $i++) {
                        //echo $result_relationship[$j]['relatives_type']. '<br/>';
                        $result_diagnosis_name[$i] = $temp_result_diagnosis_name[$i]['diagnosis_name'];
                        //echo $result_family_name[$i]. '<br/>';
                    }
                    // print_r($result_diagnosis_name);
                    for ($i = 0; $i < sizeof($array_IC_no_Diagnosis); $i++) {
                        $val_ic_no = in_array($array_IC_no_Diagnosis[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name[$i], $result_studies_name);

                        $val_diagnosis_name = in_array($array_diagnosis_name[$i], $result_diagnosis_name);

                        if (!$val_ic_no) {
                            echo 'Should ommit import' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_studies_id) {
                            echo 'Should ommit import studies_id' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_diagnosis_name) {
                            echo 'Should ommit import diagnosis_name' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }
                } else if ($loadedSheetName == 'Pathology') {
                    $array_studies_name = array();
                    $array_studies_name = null;
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);


                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            //$temp1[] = $cell_value;
                            //echo $cell_value . '    ';
                            if ($key == 0) {
                                $array_IC_no_Pathology[] = $cell_value;
                            }

                            if ($key == 1) {
                                $array_studies_name[] = $cell_value;
                                //break;
                            }
                        }
                    }

                    for ($i = 0; $i < sizeof($array_IC_no_Pathology); $i++) {
                        $val_ic_no = in_array($array_IC_no_Pathology[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name[$i], $result_studies_name);

                        if (!$val_ic_no) {
                            echo 'Should ommit import' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_studies_id) {
                            echo 'Should ommit import studies_id' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }
                } else if ($loadedSheetName == 'Investigations') {
                    $array_studies_name = array();
                    $array_studies_name = null;
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);


                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            //$temp1[] = $cell_value;
                            //echo $cell_value . '    ';
                            if ($key == 0) {
                                $array_IC_no_Investigations[] = $cell_value;
                            }

                            if ($key == 1) {
                                $array_studies_name[] = $cell_value;
                                //break;
                            }
                        }
                    }

                    for ($i = 0; $i < sizeof($array_IC_no_Investigations); $i++) {
                        $val_ic_no = in_array($array_IC_no_Investigations[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name[$i], $result_studies_name);

                        if (!$val_ic_no) {
                            echo 'Should ommit import' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_studies_id) {
                            echo 'Should ommit import studies_id' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }
                } else if ($loadedSheetName == 'Surveillance') {
                    $array_studies_name = array();
                    $array_studies_name = null;
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);


                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            //$temp1[] = $cell_value;
                            //echo $cell_value . '    ';
                            if ($key == 0) {
                                $array_IC_no_Surveillance[] = $cell_value;
                            }

                            if ($key == 1) {
                                $array_studies_name[] = $cell_value;
                                //break;
                            }
                        }
                    }

                    for ($i = 0; $i < sizeof($array_IC_no_Surveillance); $i++) {
                        $val_ic_no = in_array($array_IC_no_Surveillance[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name[$i], $result_studies_name);

                        if (!$val_ic_no) {
                            echo 'Should ommit import' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_studies_id) {
                            echo 'Should ommit import studies_id' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }
                } else if ($loadedSheetName == 'Lifestyles') {
                    $array_studies_name = array();
                    $array_studies_name = null;
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);


                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            //$temp1[] = $cell_value;
                            //echo $cell_value . '    ';
                            if ($key == 0) {
                                $array_IC_no_Lifestyles[] = $cell_value;
                            }

                            if ($key == 1) {
                                $array_studies_name[] = $cell_value;
                                //break;
                            }
                        }
                    }

                    for ($i = 0; $i < sizeof($array_IC_no_Lifestyles); $i++) {
                        $val_ic_no = in_array($array_IC_no_Lifestyles[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name[$i], $result_studies_name);

                        if (!$val_ic_no) {
                            echo 'Should ommit import' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_studies_id) {
                            echo 'Should ommit import studies_id' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }
                } else if ($loadedSheetName == 'Menstruation & Infertility') {
                    $array_studies_name = array();
                    $array_studies_name = null;
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);


                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            //$temp1[] = $cell_value;
                            //echo $cell_value . '    ';
                            if ($key == 0) {
                                $array_IC_no_Menstruation[] = $cell_value;
                            }

                            if ($key == 1) {
                                $array_studies_name[] = $cell_value;
                                //break;
                            }
                        }
                    }

                    for ($i = 0; $i < sizeof($array_IC_no_Menstruation); $i++) {
                        $val_ic_no = in_array($array_IC_no_Menstruation[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name[$i], $result_studies_name);

                        if (!$val_ic_no) {
                            echo 'Should ommit import' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_studies_id) {
                            echo 'Should ommit import studies_id' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }
                } else if ($loadedSheetName == 'Parity1') {
                    $array_studies_name = array();
                    $array_studies_name = null;
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);


                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            //$temp1[] = $cell_value;
                            //echo $cell_value . '    ';
                            if ($key == 0) {
                                $array_IC_no_Parity1[] = $cell_value;
                            }

                            if ($key == 1) {
                                $array_studies_name[] = $cell_value;
                                //break;
                            }
                        }
                    }

                    for ($i = 0; $i < sizeof($array_IC_no_Parity1); $i++) {
                        $val_ic_no = in_array($array_IC_no_Parity1[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name[$i], $result_studies_name);

                        if (!$val_ic_no) {
                            echo 'Should ommit import' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_studies_id) {
                            echo 'Should ommit import studies_id' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }
                } else if ($loadedSheetName == 'Parity2') {
                    $array_studies_name = array();
                    $array_studies_name = null;
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);


                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            //$temp1[] = $cell_value;
                            //echo $cell_value . '    ';
                            if ($key == 0) {
                                $array_IC_no_Parity2[] = $cell_value;
                            }

                            if ($key == 1) {
                                $array_studies_name[] = $cell_value;
                                //break;
                            }
                        }
                    }

                    for ($i = 0; $i < sizeof($array_IC_no_Parity2); $i++) {
                        $val_ic_no = in_array($array_IC_no_Parity2[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name[$i], $result_studies_name);

                        if (!$val_ic_no) {
                            echo 'Should ommit import' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_studies_id) {
                            echo 'Should ommit import studies_id' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }
                } else if ($loadedSheetName == 'GNC History') {
                    $array_studies_name = array();
                    $array_studies_name = null;
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);


                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            //$temp1[] = $cell_value;
                            //echo $cell_value . '    ';
                            if ($key == 0) {
                                $array_IC_no_GNC_History[] = $cell_value;
                            }

                            if ($key == 1) {
                                $array_studies_name[] = $cell_value;
                                //break;
                            }
                        }
                    }

                    for ($i = 0; $i < sizeof($array_IC_no_GNC_History); $i++) {
                        $val_ic_no = in_array($array_IC_no_GNC_History[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name[$i], $result_studies_name);

                        if (!$val_ic_no) {
                            echo 'Should ommit import' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_studies_id) {
                            echo 'Should ommit import studies_id' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }
                }
        }

        //checking ends at above
        if (!$abort) {
            foreach ($loadedSheetNames as $sheetIndex => $loadedSheetName) {
                $objPHPExcel->setActiveSheetIndex($sheetIndex);
                $sheet = $objPHPExcel->getActiveSheet();
                echo '<pre>';
                $i = 0;

                if ($loadedSheetName == 'Personal') {
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp1 = array();
                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            $temp1[] = $cell_value;
                            //echo $cell_value . '    ';
                        }

                        $array_IC_no[] = $temp1[5];
                        $family_name = $temp1[0];
                        $family_no = $this->record_model->get_family_no($family_name);
                        $data_patient[] = array(
                            'fullname' => $temp1[1],
                            'surname' => $temp1[2],
                            'maiden_name' => $temp1[3],
                            'nationality' => $temp1[4],
                            'ic_no' => $temp1[5],
                            'family_no' => $family_no,
                            'padigree_labelling' => $temp1[6],
                            'gender' => $temp1[7],
                            'ethnicity' => $temp1[8],
                            'blood_group' => $temp1[9],
                            'comment' => $temp1[10],
                            'hospital_no' => $temp1[11],
                            'private_patient_no' => $temp1[12],
                            'cogs_study_id' => $temp1[13],
                            '2nd_mammo_test_flag' => $temp1[14],
                            'd_o_b' => $temp1[15],
                            'd_o_d' => $temp1[16],
                            'place_of_birth' => $temp1[17],
                            'marital_status' => $temp1[18],
                            'is_dead' => $temp1[19],
                            'reason_of_death' => $temp1[20],
                            'record_status' => $temp1[21],
                            'blood_card' => $temp1[22],
                            'blood_card_location' => $temp1[23],
                            'address' => $temp1[24],
                            'home_phone' => $temp1[25],
                            'cell_phone' => $temp1[26],
                            'work_phone' => $temp1[27],
                            'other_phone' => $temp1[28],
                            'fax' => $temp1[29],
                            'email' => $temp1[30],
                            'height' => $temp1[31],
                            'weight' => $temp1[32],
                            'bmi' => $temp1[33],
                            'highest_education_level' => $temp1[34],
                            'income_level' => $temp1[35],
                            'created_on' => $created_date
                        );

                        $data_patient_survival_status[] = array(
                            'patient_ic_no' => $temp1[5],
                            'source' => $temp1[36],
                            'alive_status' => $temp1[37],
                            'status_gathering_date' => $temp1[38],
                            'created_on' => $created_date
                        );

                        $data_patient_relatives_summary[] = array(
                            'patient_ic_no' => $temp1[5],
                            'total_no_of_male_siblings' => $temp1[39],
                            'total_no_of_female_siblings' => $temp1[40],
                            'total_no_of_affected_siblings' => $temp1[41],
                            'total_no_of_male_children' => $temp1[42],
                            'total_no_of_female_children' => $temp1[43],
                            'total_no_of_affected_children' => $temp1[44],
                            'total_no_of_1st_degree' => $temp1[45],
                            'total_no_of_2nd_degree' => $temp1[46],
                            'total_no_of_3rd_degree' => $temp1[47],
                            'unknown_reason_is_adopted' => $temp1[48],
                            'unknown_reason_in_other_countries' => $temp1[49],
                            'created_on' => $created_date
                        );

                        $data_patient_contact_person[] = array(
                            'patient_ic_no' => $temp1[5],
                            'contact_name' => $temp1[50],
                            'contact_relationship' => $temp1[51],
                            'contact_telephone' => $temp1[52],
                            'created_on' => $created_date
                        );
                    }
                    echo '<pre>';
                    //print_r($data_patient);
                    //print_r($data_patient_survival_status);
                    //print_r($data_patient_relatives_summary);
                    //print_r($data_patient_contact_person);
                    //echo $data_patient[0]['ic_no'];

                    $id_data_patient = $this->excell_sheets_model->insert_record($data_patient, 'patient');
                    if ($id_data_patient > 0)
                        echo 'Data added succesfully at patient table';
                    else
                        echo 'Failed to insert at patient table';
                    echo '<br/>';
                    $id_data_patient_survival_status = $this->excell_sheets_model->insert_record($data_patient_survival_status, 'patient_survival_status');
                    //$id_data_patient = $this->excell_sheets_model->insert_patient_record($data_patient);
                    if ($id_data_patient_survival_status > 0)
                        echo 'Data added succesfully at patient_survival_status table';
                    else
                        echo 'Failed to insert at patient_survival_status table';
                    echo '<br/>';
                    $id_data_patient_relatives_summary = $this->excell_sheets_model->insert_record($data_patient_relatives_summary, 'patient_relatives_summary');
                    //$id_data_patient = $this->excell_sheets_model->insert_patient_record($data_patient);
                    if ($id_data_patient_relatives_summary > 0)
                        echo 'Data added succesfully at patient_relatives_summary table';
                    else
                        echo 'Failed to insert at patient_relatives_summary table';
                    echo '<br/>';
                    $id_data_patient_contact_person = $this->excell_sheets_model->insert_record($data_patient_contact_person, 'patient_contact_person');
                    //$id_data_patient = $this->excell_sheets_model->insert_patient_record($data_patient);
                    if ($id_data_patient_contact_person > 0)
                        echo 'Data added succesfully at patient_contact_person table';
                    else
                        echo 'Failed to insert at patient_contact_person table';echo '<br/>';
                } else if ($loadedSheetName == 'Family') {
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp2 = array();
                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            $temp2[] = $cell_value;
                            //echo $cell_value . '    ';
                        }

                        // echo '<BR/>';

                        if ($temp2[10] == 'yes')
                            $is_alive_flag = TRUE;
                        else if ($temp2[10] == 'no')
                            $is_alive_flag = FALSE;
                        else
                            $is_alive_flag = FALSE;

                        if ($temp2[12] == 'yes')
                            $is_cancer_diagnosed = TRUE;
                        else if ($temp2[12] == 'no')
                            $is_cancer_diagnosed = FALSE;
                        else
                            $is_cancer_diagnosed = FALSE;

                        if ($temp2[20] == 'yes')
                            $is_paternal = TRUE;
                        else if ($temp2[20] == 'no')
                            $is_paternal = FALSE;
                        else
                            $is_paternal = FALSE;

                        if ($temp2[21] == 'yes')
                            $is_maternal = TRUE;
                        else if ($temp2[21] == 'no')
                            $is_maternal = FALSE;
                        else
                            $is_maternal = FALSE;

                        $relatives_types = $temp2[1];
                        $relatives_id = $this->record_model->get_relatives_id($relatives_types);

                        $family_name = $temp2[2];
                        $family_no = $this->record_model->get_family_no($family_name);

                        $cancer_name = $temp2[14];
                        $cancer_type_id = $this->record_model->get_cancer_id($cancer_name);

                        $data_patient_relatives[] = array(
                            'patient_ic_no' => $temp2[0],
                            'relatives_id' => $relatives_id,
                            'family_no' => $family_no,
                            'full_name' => $temp2[3],
                            'sur_name' => $temp2[4],
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
                            'sex' => $temp2[19],
                            'is_paternal' => $is_paternal,
                            'is_maternal' => $is_maternal,
                            'vital_status' => $temp2[22],
                            'match_score_at_consent' => $temp2[23],
                            'match_score_past_consent' => $temp2[24],
                            'fh_category' => $temp2[25],
                            'created_on' => $created_date
                        );
                    }
                    //print_r($data_patient_relatives);
                    $id_data_patient_relatives = $this->excell_sheets_model->insert_record($data_patient_relatives, 'patient_relatives');
                    if ($id_data_patient_relatives > 0)
                        echo 'Data added succesfully at patient_relatives table';
                    else
                        echo 'Failed to insert at patient_relatives table';
                    echo '<br/>';
                }
                else if ($loadedSheetName == 'Studies') {
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp3 = array();
                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            $temp3[] = $cell_value;
                            //echo $cell_value . '    ';
                        }

                        // echo '<BR/>';

                        $studies_name = $temp3[1];
                        $studies_id = $this->excell_sheets_model->get_studies_id($studies_name);
                        $relations_to_study = $temp3[9];

                        if ($relations_to_study == 'Yes' || $relations_to_study == 'yes')
                            $relations_to_study_flag = TRUE;
                        else if ($relations_to_study == 'No' || $relations_to_study == 'no')
                            $relations_to_study_flag = FALSE;
                        else
                            $relations_to_study_flag = FALSE;

                        if ($temp3[4] == 'Yes' || $temp3[4] == 'yes')
                            $double_consent_flag = TRUE;
                        else if ($temp3[4] == 'No' || $temp3[4] == 'no')
                            $double_consent_flag = FALSE;
                        else
                            $double_consent_flag = FALSE;

                        $data_patient_studies[] = array(
                            'patient_ic_no' => $temp3[0],
                            'studies_id' => $studies_id,
                            'date_at_consent' => $temp3[2],
                            'age_at_consent' => $temp3[3],
                            'double_consent_flag' => $temp3[4],
                            'double_consent_detail' => $temp3[5],
                            'consent_given_by' => $temp3[6],
                            'consent_response' => $temp3[7],
                            'consent_version' => $temp3[8],
                            'relation_to_study_flag' => $relations_to_study_flag,
                            'referral_to' => $temp3[10],
                            'referral_to_service' => $temp3[11],
                            'referral_date' => $temp3[12],
                            'referral_source' => $temp3[13],
                            'created_on' => $created_date
                        );
                    }
                    // print_r($data_patient_studies);
                    $id_data_patient_studies = $this->excell_sheets_model->insert_record($data_patient_studies, 'patient_studies');
                    if ($id_data_patient_studies > 0)
                        echo 'Data added succesfully at patient_studies table';
                    else
                        echo 'Failed to insert at patient_studies table';
                    echo '<br/>';
                }
                else if ($loadedSheetName == 'Breast_Screening1') {
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp4 = array();
                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            $temp4[] = $cell_value;
                            //echo $cell_value . '    ';
                        }
                        //print_r($temp4);
                        // echo '<BR/>';

                        if ($temp4[8] == 'Yes' || $temp4[8] == 'yes')
                            $abnormality_mammo_flag = TRUE;
                        else if ($temp4[8] == 'No' || $temp4[8] == 'no')
                            $abnormality_mammo_flag = FALSE;
                        else
                            $abnormality_mammo_flag = FALSE;

                        if ($temp4[12] == 'Yes' || $temp4[12] == 'yes')
                            $had_ultrasound_flag = TRUE;
                        else if ($temp4[12] == 'No' || $temp4[12] == 'no')
                            $had_ultrasound_flag = FALSE;
                        else
                            $had_ultrasound_flag = FALSE;

                        if ($temp4[14] == 'Yes' || $temp4[14] == 'yes')
                            $abnormality_ultrasound_flag = TRUE;
                        else if ($temp4[14] == 'No' || $temp4[14] == 'no')
                            $abnormality_ultrasound_flag = FALSE;
                        else
                            $abnormality_ultrasound_flag = FALSE;

                        if ($temp4[15] == 'Yes' || $temp4[15] == 'yes')
                            $had_mri_flag = TRUE;
                        else if ($temp4[15] == 'No' || $temp4[15] == 'no')
                            $had_mri_flag = FALSE;
                        else
                            $had_mri_flag = FALSE;

                        if ($temp4[17] == 'Yes' || $temp4[17] == 'yes')
                            $had_surgery_for_benign_lump_or_cyst_flag = TRUE;
                        else if ($temp4[17] == 'No' || $temp4[17] == 'no')
                            $had_surgery_for_benign_lump_or_cyst_flag = FALSE;
                        else
                            $had_surgery_for_benign_lump_or_cyst_flag = FALSE;

                        if ($temp4[22] == 'Yes' || $temp4[22] == 'yes')
                            $abnormality_MRI_flag = TRUE;
                        else if ($temp4[22] == 'No' || $temp4[22] == 'no')
                            $abnormality_MRI_flag = FALSE;
                        else
                            $abnormality_MRI_flag = FALSE;

                        $patient_ic_no = $temp4[0];
                        $studies_name = $temp4[1];
                        $studies_id = $this->excell_sheets_model->get_studies_id($studies_name);
                        $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);

                        if ($patient_studies_id == null && !in_array($patient_ic_no, $array_IC_no)) {
                            echo 'NULL found should break here';
                            break;
                        }

                        $data_patient_breast_screening[] = array(
                            'patient_ic_no' => $temp4[0],
                            'patient_studies_id' => $patient_studies_id,
                            'year_of_first_mammogram' => $temp4[2],
                            'age_of_first_mammogram' => $temp4[3],
                            'date_of_recent_mammogram' => $temp4[4],
                            'screening_centre' => $temp4[5],
                            'total_no_of_mammogram' => $temp4[6],
                            'screening_interval' => $temp4[7],
                            'abnormality_mammo_flag' => $abnormality_mammo_flag,
                            'mammo_abnormality_details' => $temp4[9],
                            'name_of_radiologist' => $temp4[10],
                            'action_suggested_on_memo_report' => $temp4[11],
                            'had_ultrasound_flag' => $had_ultrasound_flag,
                            'total_no_of_ultrasound' => $temp4[13],
                            'abnormality_ultrasound_flag' => $abnormality_ultrasound_flag,
                            'had_mri_flag' => $had_mri_flag,
                            'total_no_of_mri' => $temp4[16],
                            'had_surgery_for_benign_lump_or_cyst_flag' => $had_surgery_for_benign_lump_or_cyst_flag,
                            'mammo_benign_lump_cyst_details' => $temp4[18],
                            'other_screening_flag' => $temp4[19],
                            'BIRADS_clinical_classification' => $temp4[20],
                            'BIRADS_density_classification' => $temp4[21],
                            'abnormality_MRI_flag' => $abnormality_MRI_flag,
                            'created_on' => $created_date
                        );
                    }
                    //print_r($data_patient_breast_screening);
                    $id_patient_breast_screening = $this->excell_sheets_model->insert_record($data_patient_breast_screening, 'patient_breast_screening');
                    if ($id_patient_breast_screening > 0)
                        echo 'Data added succesfully at patient_breast_screening table';
                    else
                        echo 'Failed to insert at patient_breast_screening table';
                    echo '<br/>';
                } else if ($loadedSheetName == 'BreastAbn and other screening') {
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp5 = array();
                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            $temp5[] = $cell_value;
                            //echo $cell_value . '    ';
                        }
                        //print_r($temp4);
                        // echo '<BR/>';
                        $left_breast_side = $temp5[3];
                        $right_breast_side = $temp5[4];
                        $upper_breast_side = $temp5[5];
                        $below_breast_side = $temp5[6];

                        if ($left_breast_side == 'yes')
                            $left_breast = TRUE;
                        else if ($left_breast_side == 'no')
                            $left_breast = FALSE;
                        else
                            $left_breast = FALSE;

                        if ($right_breast_side == 'yes')
                            $right_breast = TRUE;
                        else if ($right_breast_side == 'no')
                            $right_breast = FALSE;
                        else
                            $right_breast = FALSE;

                        if ($upper_breast_side == 'yes')
                            $upper = TRUE;
                        else if ($upper_breast_side == 'no')
                            $upper = FALSE;
                        else
                            $upper = FALSE;

                        if ($below_breast_side == 'yes')
                            $below = TRUE;
                        else if ($below_breast_side == 'no')
                            $below = FALSE;
                        else
                            $below = FALSE;

                        $patient_ic_no = $temp5[0];
                        $studies_name = $temp5[1];
                        $studies_id = $this->excell_sheets_model->get_studies_id($studies_name);
                        $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);
                        $patient_breast_screening_id = $this->excell_sheets_model->get_patient_breast_screening_id($patient_ic_no, $patient_studies_id);

                        $data_patient_breast_abnormality[] = array(
                            'patient_breast_screening_id' => $patient_breast_screening_id,
                            'description' => $temp5[2],
                            'left_breast' => $left_breast,
                            'right_breast' => $right_breast,
                            'upper' => $upper,
                            'below' => $below,
                            'percentage_of_mammo_density' => $temp5[7],
                            'created_on' => $created_date
                        );

                        $data_patient_ultrasound_abnormality[] = array(
                            'details' => $temp5[8],
                            'patient_breast_screening_id' => $patient_breast_screening_id,
                            'created_on' => $created_date
                        );

                        $data_patient_mri_abnormality[] = array(
                            'detail' => $temp5[9],
                            'patient_breast_screening_id' => $patient_breast_screening_id,
                            'created_on' => $created_date
                        );

                        $data_patient_other_screening[] = array(
                            'screening_name' => $temp5[10],
                            'total_no_of_screening' => $temp5[11],
                            'age_at_screening' => $temp5[12],
                            'place_of_screening' => $temp5[13],
                            'screening_result' => $temp5[14],
                            'patient_breast_screening_id' => $patient_breast_screening_id,
                            'created_on' => $created_date
                        );
                    }
                    /*print_r($data_patient_breast_abnormality);
                    print_r($data_patient_ultrasound_abnormality);
                    print_r($data_patient_mri_abnormality);
                    print_r($data_patient_other_screening);*/
                    $id_data_patient_breast_abnormality = $this->excell_sheets_model->insert_record($data_patient_breast_abnormality, 'patient_breast_abnormality');
                    if ($id_data_patient_breast_abnormality > 0)
                        echo 'Data added succesfully at patient_breast_abnormality table';
                    else
                        echo 'Failed to insert at patient_breast_abnormality table';
                    echo '<br/>';

                    $id_data_patient_ultrasound_abnormality = $this->excell_sheets_model->insert_record($data_patient_ultrasound_abnormality, 'patient_ultrasound_abnormality');
                    if ($id_data_patient_ultrasound_abnormality > 0)
                        echo 'Data added succesfully at patient_ultrasound_abnormality table';
                    else
                        echo 'Failed to insert at patient_ultrasound_abnormality table';
                    echo '<br/>';

                    $id_data_patient_mri_abnormality = $this->excell_sheets_model->insert_record($data_patient_mri_abnormality, 'patient_mri_abnormality');
                    if ($id_data_patient_mri_abnormality > 0)
                        echo 'Data added succesfully at patient_mri_abnormality table';
                    else
                        echo 'Failed to insert at patient_mri_abnormality table';
                    echo '<br/>';

                    $id_data_patient_other_screening = $this->excell_sheets_model->insert_record($data_patient_other_screening, 'patient_other_screening');
                    if ($id_data_patient_other_screening > 0)
                        echo 'Data added succesfully at patient_other_screening table';
                    else
                        echo 'Failed to insert at patient_other_screening table';
                    echo '<br/>';
                }
                else if ($loadedSheetName == 'Cancer1') {
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp6 = array();
                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            $temp6[] = $cell_value;
                            //echo $cell_value . '    ';
                        }
                        //print_r($temp4);
                        // echo '<BR/>';
                        $breast_cancer_diagnosed = $temp6[2];
                        $recurrence = $temp6[9];
                        $is_primary = $temp6[12];


                        if ($breast_cancer_diagnosed == 'yes')
                            $breast_cancer_diagnosed_flag = TRUE;
                        else if ($breast_cancer_diagnosed == 'no')
                            $breast_cancer_diagnosed_flag = FALSE;
                        else
                            $breast_cancer_diagnosed_flag = FALSE;

                        if ($recurrence == 'yes')
                            $recurrence_flag = TRUE;
                        else if ($recurrence == 'no')
                            $recurrence_flag = FALSE;
                        else
                            $recurrence_flag = FALSE;

                        if ($is_primary == 'yes')
                            $is_primary_flag = TRUE;
                        else if ($is_primary == 'no')
                            $is_primary_flag = FALSE;
                        else
                            $is_primary_flag = FALSE;

                        $patient_ic_no = $temp6[0];
                        $studies_name = $temp6[1];
                        $studies_id = $this->excell_sheets_model->get_studies_id($studies_name);
                        $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);
                        $cancer_id = $this->record_model->get_cancer_id($temp6[3]);
                        $data_patient_cancer[] = array(
                            'patient_studies_id' => $patient_studies_id,
                            'breast_cancer_diagnosed_flag' => $breast_cancer_diagnosed_flag,
                            'cancer_id' => $cancer_id,
                            'age_of_diagnosis' => $temp6[4],
                            'date_of_diagnosis' => $temp6[5],
                            'diagnosis_center' => $temp6[6],
                            'doctor_name' => $temp6[7],
                            'detected_by' => $temp6[8],
                            'recurrence_flag' => $recurrence_flag,
                            'recurrence_site' => $temp6[10],
                            'recurrence_date' => $temp6[11],
                            'is_primary' => $is_primary_flag,
                            'created_on' => $created_date
                        );
                    }
                    //print_r($data_patient_cancer);
                    $id_data_patient_cancer = $this->excell_sheets_model->insert_record($data_patient_cancer, 'patient_cancer');
                    if ($id_data_patient_cancer > 0)
                        echo 'Data added succesfully at patient_cancer table';
                    else
                        echo 'Failed to insert at patient_cancer table';
                    echo '<br/>';
                }
                else if ($loadedSheetName == 'Cancer2') {
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp7 = array();
                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            $temp7[] = $cell_value;
                            //echo $cell_value . '    ';
                        }
                        //print_r($temp4);
                        // echo '<BR/>';
                        $treatment_id = $this->record_model->get_treatment_id($temp7[2]);
                        $patient_ic_no = $temp7[0];
                        $studies_name = $temp7[1];
                        $studies_id = $this->excell_sheets_model->get_studies_id($studies_name);
                        $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);
                        $patient_cancer_id = $this->excell_sheets_model->get_patient_cancer_id($patient_studies_id);

                        $data_patient_cancer_treatment[] = array(
                            'treatment_id' => $treatment_id,
                            'patient_cancer_id' => $patient_cancer_id,
                            'treatment_start_date' => $temp7[3],
                            'treatment_end_date' => $temp7[4],
                            'treatment_drug_dose' => $temp7[5],
                            'created_on' => $created_date
                        );


                        $cancer_site_id = $this->record_model->get_cancer_site_id($temp7[6]);

                        $data_patient_cancer_site[] = array(
                            'patient_cancer_id' => $patient_cancer_id,
                            'cancer_site_id' => $cancer_site_id,
                            'site_details' => $temp7[7],
                            'created_on' => $created_date
                        );

                        $treatment_id_recurrent = $this->record_model->get_treatment_id($temp7[8]);
                        $data_patient_cancer_recurrent[] = array(
                            'treatment_id' => $treatment_id_recurrent,
                            'patient_cancer_id' => $patient_cancer_id,
                            'created_on' => $created_date
                        );
                    }
                    /*print_r($data_patient_cancer_treatment);
                    print_r($data_patient_cancer_site);
                    print_r($data_patient_cancer_recurrent);*/

                    $id_data_patient_cancer_treatment = $this->excell_sheets_model->insert_record($data_patient_cancer_treatment, 'patient_cancer_treatment');
                    if ($id_data_patient_cancer_treatment > 0)
                        echo 'Data added succesfully at patient_cancer_treatment table';
                    else
                        echo 'Failed to insert at patient_cancer_treatment table';
                    echo '<br/>';

                    $id_data_patient_cancer_site = $this->excell_sheets_model->insert_record($data_patient_cancer_site, 'patient_cancer_site');
                    if ($id_data_patient_cancer_site > 0)
                        echo 'Data added succesfully at patient_cancer_site table';
                    else
                        echo 'Failed to insert at patient_cancer_site table';
                    echo '<br/>';

                    $id_data_patient_cancer_recurrent = $this->excell_sheets_model->insert_record($data_patient_cancer_recurrent, 'patient_cancer_recurrent');
                    if ($id_data_patient_cancer_recurrent > 0)
                        echo 'Data added succesfully at patient_cancer_recurrent table';
                    else
                        echo 'Failed to insert at patient_cancer_recurrent table';
                    echo '<br/>';
                } else if ($loadedSheetName == 'Diagnosis') {
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp8 = array();
                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            $temp8[] = $cell_value;
                            //echo $cell_value . '    ';
                        }
                        //print_r($temp4);
                        // echo '<BR/>';
                        $on_medication = $temp8[5];
                        if ($on_medication == 'yes')
                            $on_medication_flag = TRUE;
                        else if ($on_medication == 'no')
                            $on_medication_flag = FALSE;
                        else
                            $on_medication_flag = FALSE;

                        $patient_ic_no = $temp8[0];
                        $studies_name = $temp8[1];
                        $studies_id = $this->excell_sheets_model->get_studies_id($studies_name);
                        $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);

                        $diagnosis_id = $this->record_model->get_diagnosis_id($temp8[2]);
                        $data_patient_diagnosis[] = array(
                            'patient_studies_id' => $patient_studies_id,
                            'diagnosis_id' => $diagnosis_id,
                            'diagnosis_age' => $temp8[3],
                            'year_of_diagnosis' => $temp8[4],
                            'on_medication_flag' => $on_medication_flag,
                            'medication_details' => $temp8[6],
                            'diagnosis_center' => $temp8[7],
                            'doctor_name' => $temp8[8],
                            'diagnosis_details' => $temp8[9],
                            'created_on' => $created_date
                        );
                    }
                    // print_r($data_patient_diagnosis);
                    $id_data_patient_diagnosis = $this->excell_sheets_model->insert_record($data_patient_diagnosis, 'patient_diagnosis');
                    if ($id_data_patient_diagnosis > 0)
                        echo 'Data added succesfully at patient_diagnosis table';
                    else
                        echo 'Failed to insert at patient_diagnosis table';
                    echo '<br/>';
                }
                else if ($loadedSheetName == 'Pathology') {
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp9 = array();
                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            $temp9[] = $cell_value;
                            //echo $cell_value . '    ';
                        }
                        //print_r($temp4);
                        // echo '<BR/>';

                        $patient_ic_no = $temp9[0];
                        $studies_name = $temp9[1];
                        $studies_id = $this->excell_sheets_model->get_studies_id($studies_name);
                        $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);

                        $data_patient_pathology[] = array(
                            'patient_studies_id' => $patient_studies_id,
                            'tissue_site' => $temp9[2],
                            'tissue_tumour_stages' => $temp9[3],
                            'morphology' => $temp9[4],
                            'node_stage' => $temp9[5],
                            'lymph_node' => $temp9[6],
                            'total_lymph_nodes' => $temp9[7],
                            'er_status' => $temp9[8],
                            'pr_status' => $temp9[9],
                            'her2_status' => $temp9[10],
                            'no_of_tumers' => $temp9[11],
                            'metastasis_stage' => $temp9[12],
                            'side_affected' => $temp9[13],
                            'tumour_stage' => $temp9[14],
                            'tumour_grade' => $temp9[15],
                            'size' => $temp9[16],
                            'path_doc' => $temp9[17],
                            'path_lab' => $temp9[18],
                            'lab_reference' => $temp9[19],
                            'path_report_date' => $temp9[20],
                            'type_of_report' => $temp9[21],
                            'path_report_requested_date' => $temp9[22],
                            'path_report_received_date' => $temp9[23],
                            'path_block_requested_date' => $temp9[24],
                            'path_block_received_date' => $temp9[25],
                            'tissue_path_comment' => $temp9[26],
                            'created_on' => $created_date
                        );
                    }
                    //print_r($data_patient_pathology);
                    $id_data_patient_pathology = $this->excell_sheets_model->insert_record($data_patient_pathology, 'patient_pathology');
                    if ($id_data_patient_pathology > 0)
                        echo 'Data added succesfully at patient_pathology table';
                    else
                        echo 'Failed to insert at patient_pathology table';
                    echo '<br/>';
                } else if ($loadedSheetName == 'Investigations') {
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp10 = array();
                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            $temp10[] = $cell_value;
                            //echo $cell_value . '    ';
                        }
                        //print_r($temp4);
                        // echo '<BR/>';
                        if ($temp10[4] == 'yes')
                            $testing_result_notification_flag = TRUE;
                        else if ($temp10[4] == 'no')
                            $testing_result_notification_flag = FALSE;
                        else
                            $testing_result_notification_flag = FALSE;

                        if ($temp10[10] == 'yes')
                            $new_mutation_flag = TRUE;
                        else if ($temp10[10] == 'no')
                            $new_mutation_flag = FALSE;
                        else
                            $new_mutation_flag = FALSE;

                        $patient_ic_no = $temp10[0];
                        $studies_name = $temp10[1];
                        $studies_id = $this->excell_sheets_model->get_studies_id($studies_name);
                        $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);

                        $data_patient_investigations[] = array(
                            'date_test_ordered' => $temp10[2],
                            'ordered_by' => $temp10[3],
                            'testing_result_notification_flag' => $testing_result_notification_flag,
                            'project_name' => $temp10[5],
                            'project_batch' => $temp10[6],
                            'test_type' => $temp10[7],
                            'type_of_sample' => $temp10[8],
                            'reasons' => $temp10[9],
                            'new_mutation_flag' => $new_mutation_flag,
                            'test_result' => $temp10[11],
                            'investigation_test_results_other_details' => $temp10[12],
                            'carrier_status' => $temp10[13],
                            'mutation_nomenclature' => $temp10[14],
                            'reported_by' => $temp10[15],
                            'mutation_type' => $temp10[16],
                            'mutation_pathogenicity' => $temp10[17],
                            'sample_id' => $temp10[18],
                            'report_due' => $temp10[19],
                            'report_date' => $temp10[20],
                            'date_modified' => $temp10[21],
                            'test_comment' => $temp10[22],
                            'patient_studies_id' => $patient_studies_id,
                            'created_on' => $created_date
                        );
                    }
                    //print_r($data_patient_investigations);
                    $id_data_patient_investigations = $this->excell_sheets_model->insert_record($data_patient_investigations, 'patient_investigations');
                    if ($id_data_patient_investigations > 0)
                        echo 'Data added succesfully at patient_investigations table';
                    else
                        echo 'Failed to insert at patient_investigations table';
                    echo '<br/>';
                }
                else if ($loadedSheetName == 'Surveillance') {
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp10 = array();
                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            $temp10[] = $cell_value;
                            //echo $cell_value . '    ';
                        }
                        //print_r($temp4);
                        // echo '<BR/>';

                        $patient_ic_no = $temp10[0];
                        $studies_name = $temp10[1];
                        $studies_id = $this->excell_sheets_model->get_studies_id($studies_name);
                        $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);

                        $data_patient_surveillance[] = array(
                            'patient_studies_id' => $patient_studies_id,
                            'recruitment_center' => $temp10[2],
                            'type' => $temp10[3],
                            'first_consultation_date' => $temp10[4],
                            'first_consultation_place' => $temp10[5],
                            'surveillance_interval' => $temp10[6],
                            'diagnosis' => $temp10[7],
                            'due_date' => $temp10[8],
                            'reminder_sent_date' => $temp10[9],
                            'surveillance_done_date' => $temp10[10],
                            'reminded_by' => $temp10[11],
                            'timing' => $temp10[12],
                            'symptoms' => $temp10[13],
                            'doctor_name' => $temp10[14],
                            'surveillance_done_place' => $temp10[15],
                            'outcome' => $temp10[16],
                            'comments' => $temp10[17],
                            'created_on' => $created_date
                        );
                    }
                    //print_r($data_patient_surveillance);
                    $id_data_patient_surveillance = $this->excell_sheets_model->insert_record($data_patient_surveillance, 'patient_surveillance');
                    if ($id_data_patient_surveillance > 0)
                        echo 'Data added succesfully at patient_surveillance table';
                    else
                        echo 'Failed to insert at patient_surveillance table';
                    echo '<br/>';
                } else if ($loadedSheetName == 'Lifestyles') {
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp11 = array();
                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            $temp11[] = $cell_value;
                            //echo $cell_value . '    ';
                        }
                        //print_r($temp4);
                        // echo '<BR/>';
                        if ($temp11[8] == 'yes')
                            $cigarrets_smoked_flag = TRUE;
                        else if ($temp11[8] == 'no')
                            $cigarrets_smoked_flag = FALSE;
                        else
                            $cigarrets_smoked_flag = FALSE;

                        if ($temp11[9] == 'yes')
                            $cigarrets_still_smoked_flag = TRUE;
                        else if ($temp11[9] == 'no')
                            $cigarrets_still_smoked_flag = FALSE;
                        else
                            $cigarrets_still_smoked_flag = FALSE;

                        if ($temp11[18] == 'yes')
                            $alcohol_drunk_flag = TRUE;
                        else if ($temp11[18] == 'no')
                            $alcohol_drunk_flag = FALSE;
                        else
                            $alcohol_drunk_flag = FALSE;

                        if ($temp11[21] == 'yes')
                            $coffee_drunk_flag = TRUE;
                        else if ($temp11[21] == 'no')
                            $coffee_drunk_flag = FALSE;
                        else
                            $coffee_drunk_flag = FALSE;

                        if ($temp11[24] == 'yes')
                            $tea_drunk_flag = TRUE;
                        else if ($temp11[24] == 'no')
                            $tea_drunk_flag = FALSE;
                        else
                            $tea_drunk_flag = FALSE;

                        if ($temp11[28] == 'yes')
                            $soya_bean_drunk_flag = TRUE;
                        else if ($temp11[28] == 'no')
                            $soya_bean_drunk_flag = FALSE;
                        else
                            $soya_bean_drunk_flag = FALSE;

                        if ($temp11[30] == 'yes')
                            $soya_products_flag = TRUE;
                        else if ($temp11[30] == 'no')
                            $soya_products_flag = FALSE;
                        else
                            $soya_products_flag = FALSE;

                        if ($temp11[32] == 'yes')
                            $diabetes_flag = TRUE;
                        else if ($temp11[32] == 'no')
                            $diabetes_flag = FALSE;
                        else
                            $diabetes_flag = FALSE;

                        if ($temp11[33] == 'yes')
                            $medicine_for_diabetes_flag = TRUE;
                        else if ($temp11[33] == 'no')
                            $medicine_for_diabetes_flag = FALSE;
                        else
                            $medicine_for_diabetes_flag = FALSE;

                        $patient_ic_no = $temp11[0];
                        $studies_name = $temp11[1];
                        $studies_id = $this->excell_sheets_model->get_studies_id($studies_name);
                        $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);

                        $data_patient_lifestyle_factors[] = array(
                            'patient_studies_id' => $patient_studies_id,
                            'self_image_at_7years' => $temp11[2],
                            'self_image_at_18years' => $temp11[3],
                            'self_image_now' => $temp11[4],
                            'pa_sports_activitiy_childhood' => $temp11[5],
                            'pa_sports_activitiy_adult' => $temp11[6],
                            'pa_sports_activitiy_now' => $temp11[7],
                            'cigarrets_smoked_flag' => $cigarrets_smoked_flag,
                            'cigarrets_still_smoked_flag' => $cigarrets_still_smoked_flag,
                            'total_smoked_years' => $temp11[10],
                            'cigarrets_count_at_teen' => $temp11[11],
                            'cigarrets_count_at_twenties' => $temp11[12],
                            'cigarrets_count_at_thirties' => $temp11[13],
                            'cigarrets_count_at_fourrties' => $temp11[14],
                            'cigarrets_count_at_fifties' => $temp11[15],
                            'cigarrets_count_at_sixties_and_above' => $temp11[16],
                            'cigarrets_count_one_year_before_diagnosed' => $temp11[17],
                            'alcohol_drunk_flag' => $alcohol_drunk_flag,
                            'alcohol_average' => $temp11[19],
                            'alcohol_average_details' => $temp11[20],
                            'coffee_drunk_flag' => $coffee_drunk_flag,
                            'coffee_age' => $temp11[22],
                            'coffee_average' => $temp11[23],
                            'tea_drunk_flag' => $tea_drunk_flag,
                            'tea_age' => $temp11[25],
                            'tea_type' => $temp11[26],
                            'tea_average' => $temp11[27],
                            'soya_bean_drunk_flag' => $soya_bean_drunk_flag,
                            'soya_bean_average' => $temp11[29],
                            'soya_products_flag' => $soya_products_flag,
                            'soya_products_average' => $temp11[31],
                            'diabetes_flag' => $diabetes_flag,
                            'medicine_for_diabetes_flag' => $medicine_for_diabetes_flag,
                            'diabetes_medicine_name' => $temp11[34],
                            'created_on' => $created_date
                        );
                    }
                    //print_r($data_patient_lifestyle_factors);
                    $id_data_patient_lifestyle_factors = $this->excell_sheets_model->insert_record($data_patient_lifestyle_factors, 'patient_lifestyle_factors');
                    if ($id_data_patient_lifestyle_factors > 0)
                        echo 'Data added succesfully at patient_lifestyle_factors table';
                    else
                        echo 'Failed to insert at patient_lifestyle_factors table';
                    echo '<br/>';
                }
                else if ($loadedSheetName == 'Menstruation & Infertility') {
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp12 = array();
                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            $temp12[] = $cell_value;
                            //echo $cell_value . '    ';
                        }
                        //print_r($temp4);
                        // echo '<BR/>';
                        if ($temp12[3] == 'yes')
                            $still_period_flag = TRUE;
                        else if ($temp12[3] == 'no')
                            $still_period_flag = FALSE;
                        else
                            $still_period_flag = FALSE;

                        $patient_ic_no = $temp12[0];
                        $studies_name = $temp12[1];
                        $studies_id = $this->excell_sheets_model->get_studies_id($studies_name);
                        $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);

                        $data_patient_menstruation[] = array(
                            'patient_studies_id' => $patient_studies_id,
                            'age_period_starts' => $temp12[2],
                            'still_period_flag' => $still_period_flag,
                            'period_type' => $temp12[4],
                            'period_cycle_days' => $temp12[5],
                            'period_cycle_days_other_details' => $temp12[6],
                            'age_period_stops' => $temp12[7],
                            'reason_period_stops' => $temp12[8],
                            'date_period_stops' => $temp12[9],
                            'reason_period_stops_other_details' => $temp12[10],
                            'created_on' => $created_date
                        );

                        if ($temp12[11] == 'yes')
                            $infertility_testing_flag = TRUE;
                        else if ($temp12[11] == 'no')
                            $infertility_testing_flag = FALSE;
                        else
                            $infertility_testing_flag = FALSE;

                        if ($temp12[13] == 'yes')
                            $contraceptive_pills_flag = TRUE;
                        else if ($temp12[13] == 'no')
                            $contraceptive_pills_flag = FALSE;
                        else
                            $contraceptive_pills_flag = FALSE;

                        if ($temp12[14] == 'yes')
                            $currently_taking_contraceptive_pills_flag = TRUE;
                        else if ($temp12[14] == 'no')
                            $currently_taking_contraceptive_pills_flag = FALSE;
                        else
                            $currently_taking_contraceptive_pills_flag = FALSE;

                        if ($temp12[18] == 'yes')
                            $hrt_flag = TRUE;
                        else if ($temp12[18] == 'no')
                            $hrt_flag = FALSE;
                        else
                            $hrt_flag = FALSE;

                        if ($temp12[19] == 'yes')
                            $currently_using_hrt_flag = TRUE;
                        else if ($temp12[19] == 'no')
                            $currently_using_hrt_flag = FALSE;
                        else
                            $currently_using_hrt_flag = FALSE;


                        $data_patient_infertility[] = array(
                            'patient_studies_id' => $patient_studies_id,
                            'infertility_testing_flag' => $infertility_testing_flag,
                            'infertility_treatment_details' => $temp12[12],
                            'contraceptive_pills_flag' => $contraceptive_pills_flag,
                            'currently_taking_contraceptive_pills_flag' => $currently_taking_contraceptive_pills_flag,
                            'contraceptive_pills_details' => $temp12[15],
                            'contraceptive_start_date' => $temp12[16],
                            'contraceptive_end_date' => $temp12[17],
                            'hrt_flag' => $hrt_flag,
                            'currently_using_hrt_flag' => $currently_using_hrt_flag,
                            'hrt_details' => $temp12[20],
                            'hrt_start_date' => $temp12[21],
                            'hrt_end_date' => $temp12[22],
                            'created_on' => $created_date
                        );
                    }
                    // print_r($data_patient_menstruation);
                    // print_r($data_patient_infertility);
                    $id_data_patient_menstruation = $this->excell_sheets_model->insert_record($data_patient_menstruation, 'patient_menstruation');
                    if ($id_data_patient_menstruation > 0)
                        echo 'Data added succesfully at patient_menstruation table';
                    else
                        echo 'Failed to insert at patient_menstruation table';
                    echo '<br/>';

                    $id_data_patient_infertility = $this->excell_sheets_model->insert_record($data_patient_infertility, 'patient_infertility');
                    if ($id_data_patient_infertility > 0)
                        echo 'Data added succesfully at patient_infertility table';
                    else
                        echo 'Failed to insert at patient_infertility table';
                    echo '<br/>';
                }
                else if ($loadedSheetName == 'Parity1') {
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp13 = array();
                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            $temp13[] = $cell_value;
                            //echo $cell_value . '    ';
                        }
                        //print_r($temp4);
                        // echo '<BR/>';
                        if ($temp13[2] == 'yes')
                            $pregnant_flag = TRUE;
                        else if ($temp13[2] == 'no')
                            $pregnant_flag = FALSE;
                        else
                            $pregnant_flag = FALSE;

                        $patient_ic_no = $temp13[0];
                        $studies_name = $temp13[1];
                        $studies_id = $this->excell_sheets_model->get_studies_id($studies_name);
                        $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);

                        $data_patient_parity_table[] = array(
                            'patient_studies_id' => $patient_studies_id,
                            'pregnant_flag' => $pregnant_flag,
                            'created_on' => $created_date
                        );
                    }
                    // print_r($data_patient_parity_table);
                    $id_data_patient_parity_table = $this->excell_sheets_model->insert_record($data_patient_parity_table, 'patient_parity_table');
                    if ($id_data_patient_parity_table > 0)
                        echo 'Data added succesfully at patient_parity_table ';
                    else
                        echo 'Failed to insert at patient_parity_table';
                    echo '<br/>';
                }
                else if ($loadedSheetName == 'Parity2') {
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp14 = array();
                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            $temp14[] = $cell_value;
                            //echo $cell_value . '    ';
                        }
                        //print_r($temp4);
                        // echo '<BR/>';

                        $patient_ic_no = $temp14[0];
                        $studies_name = $temp14[1];
                        $studies_id = $this->excell_sheets_model->get_studies_id($studies_name);
                        $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);
                        $patient_parity_table_id = $this->excell_sheets_model->get_patient_parity_table_id($patient_studies_id);

                        $data_patient_parity_record[] = array(
                            'patient_parity_table_id' => $patient_parity_table_id,
                            'pregnancy_type' => $temp14[2],
                            'gender' => $temp14[3],
                            'birthyear' => $temp14[4],
                            'birthweight' => $temp14[5],
                            'breastfeeding_duration' => $temp14[6],
                            'created_on' => $created_date
                        );
                    }
                    //print_r($data_patient_parity_record);
                    $id_data_patient_parity_record = $this->excell_sheets_model->insert_record($data_patient_parity_record, 'patient_parity_record');
                    if ($id_data_patient_parity_record > 0)
                        echo 'Data added succesfully at patient_parity_record ';
                    else
                        echo 'Failed to insert at patient_parity_record';
                    echo '<br/>';
                } else if ($loadedSheetName == 'GNC History') {
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp15 = array();
                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            $temp15[] = $cell_value;
                            //echo $cell_value . '    ';
                        }
                        //print_r($temp4);
                        // echo '<BR/>';
                        if ($temp15[2] == 'yes')
                            $had_gnc_surgery_flag = TRUE;
                        else if ($temp15[2] == 'no')
                            $had_gnc_surgery_flag = FALSE;
                        else
                            $had_gnc_surgery_flag = FALSE;

                        $patient_ic_no = $temp15[0];
                        $studies_name = $temp15[1];
                        $studies_id = $this->excell_sheets_model->get_studies_id($studies_name);
                        $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);

                        $treatment_id = $this->record_model->get_treatment_id($temp15[4]);
                        $data_patient_gynaecological_surgery_history[] = array(
                            'patient_studies_id' => $patient_studies_id,
                            'had_gnc_surgery_flag' => $had_gnc_surgery_flag,
                            'surgery_year' => $temp15[3],
                            'treatment_id' => $treatment_id,
                            'gnc_treatment_name_other_details' => $temp15[5]
                        );
                    }
                    // print_r($data_patient_gynaecological_surgery_history);
                    $id_data_patient_gynaecological_surgery_history = $this->excell_sheets_model->insert_record($data_patient_gynaecological_surgery_history, 'patient_gynaecological_surgery_history');
                    if ($id_data_patient_gynaecological_surgery_history > 0)
                        echo 'Data added succesfully at patient_gynaecological_surgery_history ';
                    else
                        echo 'Failed to insert at patient_gynaecological_surgery_history';
                    echo '<br/>';
                }
            }
        }
        // all loop ends
    }

    public function test($fileName) {
        echo $fileName;
    }

}

?>
