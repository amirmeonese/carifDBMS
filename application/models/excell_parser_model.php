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
                        $row_skip_flag = FALSE;
                        $name_validator = TRUE;
                        $ic_no_validator = TRUE;
                        $home_phone_validator = TRUE;
                        $cellphone_validator = TRUE;
                        $workphone_validator = TRUE;
                        $otherphone_validator = TRUE;
                        $contact_phone_validator = TRUE;
                        $email_validator = TRUE;
                        $height_validator = TRUE;
                        $weight_validator = TRUE;
                        $date_flag = FALSE;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);

                        foreach ($cellIterator as $key => $cell) {
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            if ($key == 5 && $cell_value == NULL) {
                                $row_skip_flag = TRUE;
                                break;
                            }

                            if ($key == 5 && $cell_value != NULL) {
                                $ic_no_validator = $this->check_IC_NO($cell_value);
                                $cell_value_ic = $cell_value;
                            }

                            if ($key == 0 && $cell_value != NULL) {
                                $name_validator = $this->check_name($cell_value);
                            }

                            if ($key == 22 && $cell_value != NULL) {
                                $home_phone_validator = $this->check_phone_no($cell_value);
                            }

                            if ($key == 23 && $cell_value != NULL) {
                                $cellphone_validator = $this->check_phone_no($cell_value);
                            }

                            if ($key == 24 && $cell_value != NULL) {
                                $workphone_validator = $this->check_phone_no($cell_value);
                            }

                            if ($key == 25 && $cell_value != NULL) {
                                $otherphone_validator = $this->check_phone_no($cell_value);
                            }

                            if ($key == 27 && $cell_value != NULL) {
                                $email_validator = $this->check_email($cell_value);
                            }

                            if ($key == 29 && $cell_value != NULL) {
                                $height_validator = $this->check_phone_no($cell_value);
                            }

                            if ($key == 30 && $cell_value != NULL) {
                                $weight_validator = $this->check_phone_no($cell_value);
                            }

                            if ($key == 34 && $cell_value != NULL) {
                                $contact_phone_validator = $this->check_phone_no($cell_value);
                            }

                            if (($key == 8 || $key == 13 || $key == 49) && $cell_value != NULL) {
                                //echo $key;
                                list($month, $day, $year) = explode("/", $cell_value);
                                if (!checkdate($month, $day, $year)) {
                                    echo '<h2>patient_DOB or patient_DOD or status_collection_date is not in appropriate format at Personal</h2>';
                                    $date_flag = TRUE;
                                    $abort = TRUE;
                                    break;
                                }
                            }
                        }
                        if (!$row_skip_flag) {
                            $array_IC_no[] = $cell_value_ic;
                        }

                        if (!$ic_no_validator) {
                            echo '<h2>patient_IC_no is not in appropriate length or Number format at Personal</h2>';
                            $abort = TRUE;
                            break;
                        }

                        
                        if (!$name_validator) {
                            echo '<h2>patient_given_name is not in appropriate format at Personal</h2>';
                            $abort = TRUE;
                            break;
                        }
                        if (!$home_phone_validator) {
                            echo '<h2>patient_home_phone is not in appropriate format at Personal</h2>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$cellphone_validator) {
                            echo '<h2>patient_cell_phone is not in appropriate format at Personal</h2>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$workphone_validator) {
                            echo '<h2>patient_work_phone is not in appropriate format at Personal</h2>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$otherphone_validator) {
                            echo '<h2>patient_other_phone is not in appropriate format at Personal</h2>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$contact_phone_validator) {
                            echo '<h2>contact_phone is not in appropriate format at Personal</h2>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$email_validator) {
                            echo '<h2>patient_email is not in appropriate format at Personal</h2>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$height_validator) {
                            echo '<h2>patient_height is not in appropriate format at Personal</h2>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$weight_validator) {
                            echo '<h2>patient_$weight is not in appropriate format at Personal</h2>';
                            $abort = TRUE;
                            break;
                        }

                        if ($date_flag)
                            break;
                    }

                    //print_r($array_IC_no);
                } else if ($loadedSheetName == 'Personal2') {
                    foreach ($sheet->getRowIterator() as $row) {
                        $ic_no_validator = TRUE;
                        $date_flag = FALSE;
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);

                        foreach ($cellIterator as $key => $cell) {
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            if ($key == 0 && $cell_value != NULL) {
                                $ic_no_validator = $this->check_IC_NO($cell_value);
                                if (!$ic_no_validator) {
                                    echo '<h2>patient_IC_no is not in appropriate format at Personal2</h2>';
                                    $abort = TRUE;
                                    break;
                                }
                                $array_IC_no_Personal2[] = $cell_value;
                            }

                            if ($key == 1) {
                                $array_studies_name[] = $cell_value;
                            }

                            if ($key == 2 && $cell_value != NULL) {
                                list($month, $day, $year) = explode("/", $cell_value);

                                if (!checkdate($month, $day, $year)) {
                                    echo '<h2>date_at_consent is not in appropriate format at Personal2</h2>';
                                    $date_flag = TRUE;
                                    $abort = TRUE;
                                    break;
                                }

                                break;
                            }
                        }

                        if (!$ic_no_validator)
                            break;

                        if ($date_flag)
                            break;
                    }

                    //print_r($array_IC_no_Personal2);
                    //print_r($array_studies_name);

                    for ($i = 0; $i < sizeof($array_IC_no_Personal2); $i++) {
                        $val_ic_no = in_array($array_IC_no_Personal2[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name[$i], $result_studies_name);

                        if (!$val_ic_no) {
                            echo 'Should ommit import for invalid IC_no data at Personal2 worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_studies_id) {
                            echo 'Should ommit import for invalid studies_id at Personal2 worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }
                } else if ($loadedSheetName == 'Family') {
                    foreach ($sheet->getRowIterator() as $row) {
                        $ic_no_validator = TRUE;
                        $date_flag = FALSE;
                        $i++;
                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        foreach ($cellIterator as $key => $cell) {
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..

                            if ($key == 0 && $cell_value != NULL) {
                                $ic_no_validator = $this->check_IC_NO($cell_value);
                                if (!$ic_no_validator) {
                                    echo '<h2>patient_IC_no is not in appropriate format at Family</h2>';
                                    $abort = TRUE;
                                    break;
                                }
                                $array_IC_no_Family[] = $cell_value;
                            }

                            if ($key == 1 && $cell_value != NULL) {
                                $array_relationship_type[] = $cell_value;
                            }

                            if (($key == 9 || $key == 11 || $key == 13) && $cell_value != NULL) {
                                list($month, $day, $year) = explode("/", $cell_value);

                                if (!checkdate($month, $day, $year)) {
                                    echo '<h2>DOB or DOD or date_of_diagnosis is not in appropriate format at Family</h2>';
                                    $date_flag = TRUE;
                                    $abort = TRUE;
                                    break;
                                }
                            }

                            if ($key == 14 && $cell_value == NULL)
                                $array_cancer_name_Family[] = 'None';
                            else if ($key == 14 && $cell_value != NULL)
                                $array_cancer_name_Family[] = $cell_value;
                        }

                        if (!$ic_no_validator)
                            break;

                        if (!$date_flag)
                            break;
                    }

                    //print_r($array_IC_no_Family);
                    //print_r($array_relationship_type);
                    //print_r($array_cancer_name_Family);

                    for ($i = 0; $i < sizeof($array_IC_no_Family); $i++) {
                        $val_ic_no = in_array($array_IC_no_Family[$i], $array_IC_no);
                        if (!$val_ic_no) {
                            echo 'Should ommit import for invalid patient_IC_no data at Family worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }

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
                    //print_r($result_relationship_type);
                    for ($i = 0; $i < sizeof($array_relationship_type); $i++) {
                        $val_relative_id = in_array($array_relationship_type[$i], $result_relationship_type);
                        if (!$val_relative_id) {
                            echo 'Should ommit import for invalid relatives_id data at Family worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }

                    $temp_result_cancer_name = array();
                    $temp_result_cancer_name = null;
                    $this->db->select('cancer_name');
                    $this->db->from('cancer');
                    $temp_result_cancer_name = $this->db->get()->result_array();

                    $result_cancer_name = array();
                    for ($i = 0; $i < sizeof($temp_result_cancer_name); $i++) {
                        //echo $result_relationship[$j]['relatives_type']. '<br/>';
                        $result_cancer_name[$i] = $temp_result_cancer_name[$i]['cancer_name'];
                        //echo $result_family_name[$i]. '<br/>';
                    }

                    for ($i = 0; $i < sizeof($array_cancer_name_Family); $i++) {
                        $val_cancer_name = in_array($array_cancer_name_Family[$i], $result_cancer_name);

                        if (!$val_cancer_name) {
                            echo 'Should ommit import for invalid cancer_name data at Family worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }
                } else if ($loadedSheetName == 'Diagnosis & Treatment') {
                    $array_studies_name = array();
                    $array_studies_name = null;
                    $array_treatment_name_Diagnosis = array();
                    $array_treatment_name_Diagnosis = null;
                    foreach ($sheet->getRowIterator() as $row) {
                        $ic_no_validator = TRUE;
                        $date_flag = FALSE;
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);


                        foreach ($cellIterator as $key => $cell) {
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            if ($key == 0 && $cell_value != NULL) {
                                $ic_no_validator = $this->check_IC_NO($cell_value);
                                if (!$ic_no_validator) {
                                    echo '<h2>patient_IC_no is not in appropriate format at Diagnosis & Treatment</h2>';
                                    $abort = TRUE;
                                    break;
                                }
                                $array_IC_no_Diagnosis[] = $cell_value;
                            }

                            if ($key == 1 && $cell_value != NULL) {
                                $array_studies_name[] = $cell_value;
                            }

                            if ($key == 2 && $cell_value != NULL) {
                                $array_cancer_name_Diagnosis[] = $cell_value;
                            }

                            if ($key == 3 && $cell_value != NULL) {
                                $array_cancer_site_name_Diagnosis[] = $cell_value;
                            }

                            if ($key == 13 && $cell_value != NULL) {
                                $array_treatment_name_Diagnosis[] = $cell_value;
                            }

                            if (($key == 6 || $key == 14 || $key == 15 || $key == 28 ) && $cell_value != NULL) {
                                list($month, $day, $year) = explode("/", $cell_value);

                                if (!checkdate($month, $day, $year)) {
                                    echo '<h2>date_of_diagnosis or treatment_start_date or treatment_end_date is not in appropriate format at Diagnosis & Treatment</h2>';
                                    $date_flag = TRUE;
                                    $abort = TRUE;
                                    break;
                                }
                            }
                        }

                        if (!$ic_no_validator)
                            break;

                        if ($date_flag)
                            break;
                    }

                    // print_r($array_IC_no_Diagnosis);
                    //print_r($array_studies_name);

                    for ($i = 0; $i < sizeof($array_IC_no_Diagnosis); $i++) {
                        $val_ic_no = in_array($array_IC_no_Diagnosis[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name[$i], $result_studies_name);

                        if (!$val_ic_no) {
                            echo 'Should ommit import for invalid ic_no data at Diagnosis & Treatment worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_studies_id) {
                            echo 'Should ommit import for invalid studies_id data at Diagnosis & Treatment worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }

                    $temp_result_cancer_name = array();
                    $temp_result_cancer_name = null;
                    $this->db->select('cancer_name');
                    $this->db->from('cancer');
                    $temp_result_cancer_name = $this->db->get()->result_array();

                    $result_cancer_name = array();
                    for ($i = 0; $i < sizeof($temp_result_cancer_name); $i++) {
                        //echo $result_relationship[$j]['relatives_type']. '<br/>';
                        $result_cancer_name[$i] = $temp_result_cancer_name[$i]['cancer_name'];
                        //echo $result_Diagnosis_name[$i]. '<br/>';
                    }

                    for ($i = 0; $i < sizeof($array_cancer_name_Diagnosis); $i++) {
                        $val_cancer_name = in_array($array_cancer_name_Diagnosis[$i], $result_cancer_name);

                        if (!$val_cancer_name) {
                            echo 'Should ommit import for invalid cancer_name data at Diagnosis & Treatment worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }

                    $temp_result_cancer_site_name = array();
                    $temp_result_cancer_site_name = null;
                    $this->db->select('cancer_site_name');
                    $this->db->from('cancer_site');
                    $temp_result_cancer_site_name = $this->db->get()->result_array();

                    $result_cancer_site_name = array();
                    for ($i = 0; $i < sizeof($temp_result_cancer_site_name); $i++) {
                        $result_cancer_site_name[$i] = $temp_result_cancer_site_name[$i]['cancer_site_name'];
                    }

                    for ($i = 0; $i < sizeof($array_cancer_site_name_Diagnosis); $i++) {
                        $val_cancer_site_name = in_array($array_cancer_site_name_Diagnosis[$i], $result_cancer_site_name);

                        if (!$val_cancer_site_name) {
                            echo 'Should ommit import for invalid cancer_site_name data at Diagnosis & Treatment worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }

                    $temp_result_treatment_name = array();
                    $temp_result_treatment_name = null;
                    $this->db->select('treatment_name');
                    $this->db->from('treatment');
                    $temp_result_treatment_name = $this->db->get()->result_array();

                    $result_treatment_name = array();
                    for ($i = 0; $i < sizeof($temp_result_treatment_name); $i++) {
                        $result_treatment_name[$i] = $temp_result_treatment_name[$i]['treatment_name'];
                    }
                    //print_r($array_treatment_name_Diagnosis);
                    //print_r($result_treatment_name);
                    for ($i = 0; $i < sizeof($array_treatment_name_Diagnosis); $i++) {
                        $val_treatment_name = in_array($array_treatment_name_Diagnosis[$i], $result_treatment_name);

                        if (!$val_treatment_name) {
                            echo 'Should ommit import for invalid treatment_name data at Diagnosis worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }
                } else if ($loadedSheetName == 'Sreening and Surveilance1') {
                    $array_studies_name = array();
                    $array_studies_name = null;
                    foreach ($sheet->getRowIterator() as $row) {
                        $ic_no_validator = TRUE;
                        $date_flag = FALSE;
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);


                        foreach ($cellIterator as $key => $cell) {
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            if ($key == 0 && $cell_value != NULL) {
                                $ic_no_validator = $this->check_IC_NO($cell_value);
                                if (!$ic_no_validator) {
                                    echo '<h2>patient_IC_no is not in appropriate format at Sreening and Surveilance1</h2>';
                                    $abort = TRUE;
                                    break;
                                }
                                $array_IC_no_Surveilance1[] = $cell_value;
                            }

                            if ($key == 1 && $cell_value != NULL) {
                                $array_studies_name[] = $cell_value;
                            }

                            if (($key == 2 || $key == 20 || $key == 26) && $cell_value != NULL) {
                                list($month, $day, $year) = explode("/", $cell_value);

                                if (!checkdate($month, $day, $year)) {
                                    echo '<h2>date_of_first_mammogram or ultrasound_date or MRI_date is not in appropriate format at Surveilance1</h2>';
                                    $date_flag = TRUE;
                                    $abort = TRUE;
                                    break;
                                }
                            }
                        }
                        if (!$ic_no_validator)
                            break;

                        if ($date_flag)
                            break;
                    }

                    // print_r($array_IC_no_Surveilance1);
                    //print_r($array_studies_name);

                    for ($i = 0; $i < sizeof($array_IC_no_Surveilance1); $i++) {
                        $val_ic_no = in_array($array_IC_no_Surveilance1[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name[$i], $result_studies_name);

                        if (!$val_ic_no) {
                            echo 'Should ommit import for invalid ic_no data at Sreening and Surveilance1 worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_studies_id) {
                            echo 'Should ommit import for invalid studies_id data at Sreening and Surveilance1 worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }
                } else if ($loadedSheetName == 'Sreening and Surveilance2') {
                    $array_studies_name = array();
                    $array_studies_name = null;
                    foreach ($sheet->getRowIterator() as $row) {
                        $ic_no_validator = TRUE;
                        $date_flag = FALSE;
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);


                        foreach ($cellIterator as $key => $cell) {
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            if ($key == 0 && $cell_value != NULL) {
                                $ic_no_validator = $this->check_IC_NO($cell_value);
                                if (!$ic_no_validator) {
                                    echo '<h2>patient_IC_no is not in appropriate format at Sreening and Surveilance2</h2>';
                                    $abort = TRUE;
                                    break;
                                }
                                $array_IC_no_Surveilance2[] = $cell_value;
                            }

                            if ($key == 1 && $cell_value != NULL) {
                                $array_studies_name[] = $cell_value;
                            }

                            if (($key == 4 || $key == 10) && $cell_value != NULL) {
                                list($month, $day, $year) = explode("/", $cell_value);

                                if (!checkdate($month, $day, $year)) {
                                    echo '<h2>date_of_surgery or breast_date_of_surgery is not in appropriate format at Sreening and Surveilance2</h2>';
                                    $date_flag = TRUE;
                                    $abort = TRUE;
                                    break;
                                }
                            }
                        }

                        if (!$ic_no_validator)
                            break;

                        if ($date_flag)
                            break;
                    }

                    // print_r($array_IC_no_Family);
                    // print_r($array_studies_name);

                    for ($i = 0; $i < sizeof($array_IC_no_Surveilance2); $i++) {
                        $val_ic_no = in_array($array_IC_no_Surveilance2[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name[$i], $result_studies_name);

                        if (!$val_ic_no) {
                            echo 'Should ommit import for invalid ic_no data at Sreening and Surveilance2 worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_studies_id) {
                            echo 'Should ommit import for invalid studies_id data at Sreening and Surveilance2 worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }
                } else if ($loadedSheetName == 'Sreening and Surveilance3') {
                    $array_studies_name = array();
                    $array_studies_name = null;
                    $array_lesion_surgery_site = array();
                    $array_lesion_surgery_site = null;
                    $array_surgery_site = array();
                    $array_surgery_site = null;
                    
                    foreach ($sheet->getRowIterator() as $row) {
                        $ic_no_validator = TRUE;
                        $date_flag = FALSE;
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);


                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            if ($key == 0 && $cell_value != NULL) {
                                $ic_no_validator = $this->check_IC_NO($cell_value);
                                if (!$ic_no_validator) {
                                    echo '<h2>patient_IC_no is not in appropriate format at Sreening and Sreening and Surveilance3</h2>';
                                    $abort = TRUE;
                                    break;
                                }
                                $array_IC_no_Surveilance3[] = $cell_value;
                            }

                            if ($key == 1 && $cell_value != NULL) {
                                $array_studies_name[] = $cell_value;
                            }

                            if ($key == 3 && $cell_value != NULL) {
                                $array_lesion_surgery_site[] = $cell_value;
                            }

                            if ($key == 6 && $cell_value != NULL) {
                                $array_surgery_site[] = $cell_value;
                                //break;
                            }

                            if (($key == 4 || $key == 7) && $cell_value != NULL) {
                                list($month, $day, $year) = explode("/", $cell_value);

                                if (!checkdate($month, $day, $year)) {
                                    echo '<h2>surgery_date or surgery_date is not in appropriate format at Sreening and Surveilance3</h2>';
                                    $date_flag = TRUE;
                                    $abort = TRUE;
                                    break;
                                }
                            }
                        }
                        if (!$ic_no_validator)
                            break;

                        if ($date_flag)
                            break;
                    }

                    //print_r($array_IC_no_Surveilance3);
                    //print_r($array_studies_name);
                    //print_r($array_lesion_surgery_site);
                    //print_r($array_surgery_site);

                    $temp_non_cancerous_site_name = array();
                    $temp_non_cancerous_site_name = null;
                    $this->db->select('non_cancerous_site_name');
                    $this->db->from('non_cancerous_site');
                    $temp_non_cancerous_site_name = $this->db->get()->result_array();

                    //print_r($temp_result_family_name);
                    $result_non_cancerous_site_name = array();
                    for ($i = 0; $i < sizeof($temp_non_cancerous_site_name); $i++) {
                        //echo $result_relationship[$j]['relatives_type']. '<br/>';
                        $result_non_cancerous_site_name[$i] = $temp_non_cancerous_site_name[$i]['non_cancerous_site_name'];
                    }
                    //print_r($result_cancer_name);
                    for ($i = 0; $i < sizeof($array_IC_no_Surveilance3); $i++) {
                        $val_ic_no = in_array($array_IC_no_Surveilance3[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name[$i], $result_studies_name);

                        $val_cancer_site_name1 = in_array($array_lesion_surgery_site[$i], $result_non_cancerous_site_name);
                        $val_cancer_site_name2 = in_array($array_surgery_site[$i], $result_non_cancerous_site_name);

                        if (!$val_ic_no) {
                            echo 'Should ommit import for invalid ic_no data at Sreening and Surveilance3 worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_studies_id) {
                            echo 'Should ommit import for invalid studies_id data at Sreening and Surveilance3 worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_cancer_site_name1) {
                            echo 'Should ommit import for invalid lesion_surgery_site data at Sreening and Surveilance3 worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_cancer_site_name2) {
                            echo 'Should ommit import for invalid surgery_site data at Sreening and Surveilance3 worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }
                } else if ($loadedSheetName == 'Sreening and Surveilance4') {
                    $array_studies_name = array();
                    $array_studies_name = null;
                    $array_other_screening_type = array();
                    $array_other_screening_type = null;
                    
                    foreach ($sheet->getRowIterator() as $row) {
                        $ic_no_validator = TRUE;
                        $date_flag = TRUE;
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);


                        foreach ($cellIterator as $key => $cell) {
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            if ($key == 0 && $cell_value != NULL) {
                                $ic_no_validator = $this->check_IC_NO($cell_value);
                                if (!$ic_no_validator) {
                                    echo '<h2>patient_IC_no is not in appropriate format at Sreening and Surveilance4</h2>';
                                    $abort = TRUE;
                                    break;
                                }
                                $array_IC_no_Surveilance4[] = $cell_value;
                            }

                            if ($key == 1 && $cell_value != NULL) {
                                $array_studies_name[] = $cell_value;
                            }

                            if ($key == 2 && $cell_value != NULL) {
                                $array_ovarian_screening_type[] = $cell_value;
                            }

                            if ($key == 6 && $cell_value != NULL) {
                                $array_other_screening_type[] = $cell_value;
                                break;

                                if ($key == 3 && $cell_value != NULL) {
                                    list($month, $day, $year) = explode("/", $cell_value);

                                    if (!checkdate($month, $day, $year)) {
                                        echo '<h2>screening_date is not in appropriate format at Sreening and Surveilance4</h2>';
                                        $date_flag = TRUE;
                                        $abort = TRUE;
                                        break;
                                    }
                                }
                            }
                        }
                        if (!$ic_no_validator)
                            break;

                        if ($date_flag)
                            break;
                    }

                    //print_r($array_IC_no_Surveilance4);
                    //print_r($array_studies_name);
                    //print_r($array_ovarian_screening_type);
                    //print_r($array_other_screening_type);

                    $temp_ovarian_screening_type_name = array();
                    $temp_ovarian_screening_type_name = null;
                    $this->db->select('ovarian_screening_type_name');
                    $this->db->from('ovarian_screening_type');
                    $temp_ovarian_screening_type_name = $this->db->get()->result_array();

                    //print_r($temp_result_family_name);
                    $result_ovarian_screening_type_name = array();
                    for ($i = 0; $i < sizeof($temp_ovarian_screening_type_name); $i++) {
                        //echo $result_relationship[$j]['relatives_type']. '<br/>';
                        $result_ovarian_screening_type_name[$i] = $temp_ovarian_screening_type_name[$i]['ovarian_screening_type_name'];
                    }
                    //print_r($result_cancer_name);
                    for ($i = 0; $i < sizeof($array_IC_no_Surveilance4); $i++) {
                        $val_ic_no = in_array($array_IC_no_Surveilance4[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name[$i], $result_studies_name);

                        $val_ovarian_screening_type_name1 = in_array($array_ovarian_screening_type[$i], $result_ovarian_screening_type_name);
                        $val_ovarian_screening_type_name2 = in_array($array_other_screening_type[$i], $result_ovarian_screening_type_name);

                        if (!$val_ic_no) {
                            echo 'Should ommit import for invalid ic_no data at Sreening and Surveilance4 worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_studies_id) {
                            echo 'Should ommit import for invalid studies_id data at Sreening and Surveilance4 worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_ovarian_screening_type_name1) {
                            echo 'Should ommit import for invalid ovarian screening type data at Sreening and Surveilance4 worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_ovarian_screening_type_name2) {
                            echo 'Should ommit import for invalid other_screening_type data at Sreening and Surveilance4 worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }
                } else if ($loadedSheetName == 'Sreening and Surveilance5') {
                    $array_studies_name = array();
                    $array_studies_name = null;
                    $array_diagnonis_name = array();
                    $array_diagnonis_name = null;
                    
                    foreach ($sheet->getRowIterator() as $row) {
                        $ic_no_validator = TRUE;
                        $date_flag = FALSE;
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);


                        foreach ($cellIterator as $key => $cell) {
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            if ($key == 0 && $cell_value != NULL) {
                                $ic_no_validator = $this->check_IC_NO($cell_value);
                                if (!$ic_no_validator) {
                                    echo '<h2>patient_IC_no is not in appropriate format at Sreening and Surveilance5</h2>';
                                    $abort = TRUE;
                                    break;
                                }
                                $array_IC_no_Surveilance5[] = $cell_value;
                                
                                
                            }
                            
                            if ($key == 1 && $cell_value != NULL) {
                                $array_studies_name[] = $cell_value;
                            }

                            if ($key == 2 && $cell_value != NULL) {
                                $array_diagnonis_name[] = $cell_value;
                            }

                             if (($key == 3 || $key == 10 || $key == 14 || $key == 15 || $key == 16) && $cell_value != NULL) {
                                //echo $key.'     From line 952<br/>';
                                //echo "cell value:   ".$cell_value.'<br/>';
                              
                                list($month, $day, $year) = explode("/", $cell_value);
                                if (!checkdate($month, $day, $year)) {
                                    echo '<h2>date_of_diagnosis or first_consultation_date or due_date or reminder_sent_date or surveillance_done_date is not in appropriate format at Sreening and Surveilance5</h2>';
                                    $date_flag = TRUE;
                                    $abort = TRUE;
                                    break;
                                }
                            }
                            
                        }
                        
                        if (!$ic_no_validator)
                            break;

                        if ($date_flag)
                            break;
                    }

                    //print_r($array_IC_no_Surveilance5);
                    //print_r($array_studies_name);
                    //print_r($array_diagnonis_name);

                    $temp_diagnonis_name = array();
                    $temp_diagnonis_name = null;
                    $this->db->select('diagnosis_name');
                    $this->db->from('diagnosis');
                    $temp_diagnonis_name = $this->db->get()->result_array();

                    // print_r($temp_diagnonis_name);
                    $result_diagnonis_name = array();
                    $result_diagnonis_name = null;
                    for ($i = 0; $i < sizeof($temp_diagnonis_name); $i++) {
                        //echo $result_relationship[$j]['relatives_type']. '<br/>';
                        $result_diagnonis_name[$i] = $temp_diagnonis_name[$i]['diagnosis_name'];
                    }
                    //print_r($result_cancer_name);
                    for ($i = 0; $i < sizeof($array_IC_no_Surveilance5); $i++) {
                        $val_ic_no = in_array($array_IC_no_Surveilance5[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name[$i], $result_studies_name);

                        $val_diagnonis_name = in_array($array_diagnonis_name[$i], $result_diagnonis_name);

                        if (!$val_ic_no) {
                            echo 'Should ommit import for invalid ic_no data at Sreening and Surveilance5 worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_studies_id) {
                            echo 'Should ommit import for invalid studies_id data at Sreening and Surveilance5 worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_diagnonis_name) {
                            echo 'Should ommit import for invalid diagnonis_name data at Sreening and Surveilance5 worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }
                } else if ($loadedSheetName == 'Mutation analysis') {
                    $array_studies_name = array();
                    $array_studies_name = null;
                    foreach ($sheet->getRowIterator() as $row) {
                        $ic_no_validator = TRUE;
                        $date_flag = FALSE;
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);


                        foreach ($cellIterator as $key => $cell) {
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            if ($key == 0 && $cell_value != NULL) {
                                $ic_no_validator = $this->check_IC_NO($cell_value);
                                if (!$ic_no_validator) {
                                    echo '<h2>patient_IC_no is not in appropriate format at Mutation analysis</h2>';
                                    $abort = TRUE;
                                    break;
                                }
                                $array_IC_no_mutation_analysis[] = $cell_value;
                            }

                            if ($key == 1 && $cell_value != NULL) {
                                $array_studies_name[] = $cell_value;
                            }

                            if (($key == 2 || $key == 7 || $key == 20 || $key == 21) && $cell_value != NULL) {
                                //echo $key.'     From line 1045<br/>';
                                list($month, $day, $year) = explode("/", $cell_value);

                                if (!checkdate($month, $day, $year)) {
                                    echo '<h2>date_test_ordered or testing_date or report_date or date_notified is not in appropriate format at Mutation analysis</h2>';
                                    $date_flag = TRUE;
                                    $abort = TRUE;
                                    break;
                                }
                            }
                        }
                        if (!$ic_no_validator)
                            break;

                        if ($date_flag)
                            break;
                    }

                    //print_r($array_IC_no_mutation_analysis);
                    //print_r($array_studies_name);

                    for ($i = 0; $i < sizeof($array_IC_no_mutation_analysis); $i++) {
                        $val_ic_no = in_array($array_IC_no_mutation_analysis[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name[$i], $result_studies_name);

                        if (!$val_ic_no) {
                            echo 'Should ommit import for invalid ic_no data at Mutation analysis worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_studies_id) {
                            echo 'Should ommit import for invalid studies_id data at Mutation analysis worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }
                } else if ($loadedSheetName == 'Risk Assesment') {
                    foreach ($sheet->getRowIterator() as $row) {
                        $ic_no_validator = TRUE;
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);


                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            if ($key == 0 && $cell_value != NULL) {
                                $ic_no_validator = $this->check_IC_NO($cell_value);
                                if (!$ic_no_validator) {
                                    echo '<h2>patient_IC_no is not in appropriate format at Risk Assesment</h2>';
                                    $abort = TRUE;
                                    break;
                                }
                                $array_IC_no_risk_Assesment[] = $cell_value;
                            }
                        }
                        if (!$ic_no_validator)
                            break;
                    }

                    //print_r($array_IC_no_risk_Assesment);


                    for ($i = 0; $i < sizeof($array_IC_no_risk_Assesment); $i++) {
                        $val_ic_no = in_array($array_IC_no_risk_Assesment[$i], $array_IC_no);
                        //echo $val . '<br/>';

                        if (!$val_ic_no) {
                            echo 'Should ommit import for invalid ic_no data at Risk Assesment worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }
                } else if ($loadedSheetName == 'Lifestyles1') {
                    $array_studies_name = array();
                    $array_studies_name = null;
                    foreach ($sheet->getRowIterator() as $row) {
                        $ic_no_validator = TRUE;
                        $date_flag = FALSE;
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);


                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            if ($key == 0 && $cell_value != NULL) {
                                $ic_no_validator = $this->check_IC_NO($cell_value);
                                if (!$ic_no_validator) {
                                    echo '<h2>patient_IC_no is not in appropriate format at Lifestyles1</h2>';
                                    $abort = TRUE;
                                    break;
                                }
                                $array_IC_no_Lifestyles1[] = $cell_value;
                            }

                            if ($key == 1 && $cell_value != NULL) {
                                $array_studies_name[] = $cell_value;
                            }

                            if ($key == 2 && $cell_value != NULL) {
                                list($month, $day, $year) = explode("/", $cell_value);

                                if (!checkdate($month, $day, $year)) {
                                    echo '<h2>questionnaire_date is not in appropriate format at Lifestyles1</h2>';
                                    $date_flag = TRUE;
                                    $abort = TRUE;
                                    break;
                                }
                            }
                        }
                        if (!$ic_no_validator)
                            break;

                        if ($date_flag)
                            break;
                    }

                    //print_r($array_IC_no_Lifestyles1);
                    //print_r($array_studies_name);

                    for ($i = 0; $i < sizeof($array_IC_no_Lifestyles1); $i++) {
                        $val_ic_no = in_array($array_IC_no_Lifestyles1[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name[$i], $result_studies_name);

                        if (!$val_ic_no) {
                            echo 'Should ommit import for invalid ic_no data at Lifestyles1 worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_studies_id) {
                            echo 'Should ommit import for invalid studies_id data at Lifestyles1 worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }
                } else if ($loadedSheetName == 'Lifestyle2') {
                    $array_studies_name = array();
                    $array_studies_name = null;
                    foreach ($sheet->getRowIterator() as $row) {
                        $ic_no_validator = TRUE;
                        $date_flag = FALSE;
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);


                        foreach ($cellIterator as $key => $cell) {
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            if ($key == 0 && $cell_value != NULL) {
                                $ic_no_validator = $this->check_IC_NO($cell_value);
                                if (!$ic_no_validator) {
                                    echo '<h2>patient_IC_no is not in appropriate format at Lifestyle2</h2>';
                                    $abort = TRUE;
                                    break;
                                }
                                $array_IC_no_Lifestyles2[] = $cell_value;
                            }

                            if ($key == 1 && $cell_value != NULL) {
                                $array_studies_name[] = $cell_value;
                            }

                            if (($key == 9 || $key == 19 || $key == 20 || $key == 24 || $key == 25) && $cell_value != NULL) {
                                list($month, $day, $year) = explode("/", $cell_value);

                                if (!checkdate($month, $day, $year)) {
                                    echo '<h2>date_period_stops or start_date or end_date or hrt_start_date or hrt_end_date is not in appropriate format at Lifestyle2</h2>';
                                    $date_flag = TRUE;
                                    $abort = TRUE;
                                    break;
                                }
                            }
                        }
                        if (!$ic_no_validator)
                            break;
                        
                        if ($date_flag)
                            break;
                    }

                    //print_r($array_IC_no_Lifestyles2);
                    //print_r($array_studies_name);

                    for ($i = 0; $i < sizeof($array_IC_no_Lifestyles2); $i++) {
                        $val_ic_no = in_array($array_IC_no_Lifestyles2[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name[$i], $result_studies_name);

                        if (!$val_ic_no) {
                            echo 'Should ommit import for invalid ic_no data at Lifestyles2 worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_studies_id) {
                            echo 'Should ommit import for invalid studies_id data at Lifestyles2 worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }
                } else if ($loadedSheetName == 'Lifestyle3') {
                    $array_studies_name = array();
                    $array_studies_name = null;
                    foreach ($sheet->getRowIterator() as $row) {
                        $ic_no_validator = TRUE;
                        $date_flag = FALSE;
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);


                        foreach ($cellIterator as $key => $cell) {
                            $cell_value = $cell->getFormattedValue();
                            //echo $key; // 0, 1, 2..
                            if ($key == 0 && $cell_value != NULL) {
                                $ic_no_validator = $this->check_IC_NO($cell_value);
                                if (!$ic_no_validator) {
                                    echo '<h2>patient_IC_no is not in appropriate format at Lifestyle3</h2>';
                                    $abort = TRUE;
                                    break;
                                }
                                $array_IC_no_Lifestyles3[] = $cell_value;
                            }

                            if ($key == 1 && $cell_value != NULL) {
                                $array_studies_name[] = $cell_value;
                            }

                            if ($key == 4 && $cell_value != NULL) {
                                list($month, $day, $year) = explode("/", $cell_value);

                                if (!checkdate($month, $day, $year)) {
                                    echo '<h2>date_of_birth is not in appropriate format at Lifestyle3</h2>';
                                    $date_flag = TRUE;
                                    $abort = TRUE;
                                    break;
                                }
                            }
                        }
                        if (!$ic_no_validator)
                            break;

                        if ($date_flag)
                            break;
                    }

                    //print_r($array_IC_no_Lifestyles2);
                    //print_r($array_studies_name);

                    for ($i = 0; $i < sizeof($array_IC_no_Lifestyles3); $i++) {
                        $val_ic_no = in_array($array_IC_no_Lifestyles3[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name[$i], $result_studies_name);

                        if (!$val_ic_no) {
                            echo 'Should ommit import for invalid ic_no data at Lifestyles3 worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_studies_id) {
                            echo 'Should ommit import for invalid studies_id data at Lifestyles3 worksheet' . '<br/>';
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
          $row_skip_flag = FALSE;
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

          if ($key == 0 && $cell_value == NULL) {
          $row_skip_flag = TRUE;
          }
          //echo $key; // 0, 1, 2..
          $temp1[] = $cell_value;
          //echo $cell_value . '    ';
          }

          if ($row_skip_flag == TRUE) {
          $row_skip_flag = FALSE;
          continue;
          }

          $array_IC_no[] = $temp1[5];

          $data_patient[] = array(
          'given_name' => $temp1[0],
          'surname' => $temp1[1],
          'maiden_name' => $temp1[2],
          'nationality' => $temp1[4],
          'ic_no' => $temp1[5],
          'family_no' => $temp1[3],
          'gender' => $temp1[6],
          'ethnicity' => $temp1[7],
          'd_o_b' => date('Y-m-d', strtotime(str_replace('/', '-', $temp1[8]))),
          'place_of_birth' => $temp1[9],
          'marital_status' => $temp1[10],
          'blood_group' => $temp1[11],
          'comment' => $temp1[36],
          'is_dead' => $temp1[12],
          'd_o_d' => date('Y-m-d', strtotime(str_replace('/', '-', $temp1[13]))),
          'reason_of_death' => $temp1[14],
          'blood_card' => $temp1[19],
          'blood_card_location' => $temp1[20],
          'address' => $temp1[21],
          'home_phone' => $temp1[22],
          'cell_phone' => $temp1[23],
          'work_phone' => $temp1[24],
          'other_phone' => $temp1[25],
          'fax' => $temp1[26],
          'email' => $temp1[27],
          'height' => $temp1[29],
          'weight' => $temp1[30],
          'bmi' => $temp1[31],
          'highest_education_level' => $temp1[28],
          'income_level' => $temp1[32],
          'created_on' => $created_date
          );

          $data_patient_hospital_no[] = array(
          'patient_ic_no' => $temp1[5],
          'hospital_no' => $temp1[15],
          'created_on' => $created_date
          );

          $data_patient_private_no[] = array(
          'patient_ic_no' => $temp1[5],
          'private_no' => $temp1[16],
          'created_on' => $created_date
          );

          $data_patient_cogs_studies[] = array(
          'patient_ic_no' => $temp1[5],
          'COGS_studies_name' => $temp1[17],
          'COGS_studies_no' => $temp1[18],
          'created_on' => $created_date
          );

          $data_patient_contact_person[] = array(
          'patient_ic_no' => $temp1[5],
          'contact_name' => $temp1[33],
          'contact_relationship' => $temp1[35],
          'contact_telephone' => $temp1[34],
          'created_on' => $created_date
          );

          $data_patient_relatives_summary[] = array(
          'patient_ic_no' => $temp1[5],
          'total_no_of_male_siblings' => $temp1[37],
          'total_no_of_female_siblings' => $temp1[38],
          'total_no_of_affected_siblings' => $temp1[39],
          'total_no_of_male_children' => $temp1[40],
          'total_no_of_female_children' => $temp1[41],
          'total_no_of_affected_children' => $temp1[42],
          'total_no_of_1st_degree' => $temp1[43],
          'total_no_of_2nd_degree' => $temp1[44],
          'total_no_of_3rd_degree' => $temp1[45],
          'created_on' => $created_date,
          'total_no_of_siblings' => $temp1[46]
          );


          $data_patient_survival_status[] = array(
          'patient_ic_no' => $temp1[5],
          'source' => $temp1[47],
          'alive_status' => $temp1[48],
          'status_gathering_date' => date('Y-m-d', strtotime(str_replace('/', '-', $temp1[49]))),
          'created_on' => $created_date
          );
          }
          echo '<pre>';
          //print_r($data_patient);
          //print_r($data_patient_hospital_no);
          //print_r($data_patient_private_no);
          //print_r($data_patient_cogs_studies);
          //print_r($data_patient_contact_person);
          //print_r($data_patient_relatives_summary);
          //print_r($data_patient_survival_status);

          $id_data_patient = $this->excell_sheets_model->insert_record($data_patient, 'patient');
          if ($id_data_patient > 0)
          echo 'Data added succesfully at patient table';
          else
          echo 'Failed to insert at patient table';
          echo '<br/>';

          $id_data_patient_hospital_no = $this->excell_sheets_model->insert_record($data_patient_hospital_no, 'patient_hospital_no');

          if ($id_data_patient_hospital_no > 0)
          echo 'Data added succesfully at patient_hospital_no table';
          else
          echo 'Failed to insert at patient_hospital_no table';
          echo '<br/>';

          $id_data_patient_private_no = $this->excell_sheets_model->insert_record($data_patient_private_no, 'patient_private_no');

          if ($id_data_patient_private_no > 0)
          echo 'Data added succesfully at patient_private_no table';
          else
          echo 'Failed to insert at patient_private_no table';
          echo '<br/>';

          $id_data_patient_cogs_studies = $this->excell_sheets_model->insert_record($data_patient_cogs_studies, 'patient_cogs_studies');

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

          $id_data_patient_relatives_summary = $this->excell_sheets_model->insert_record($data_patient_relatives_summary, 'patient_relatives_summary');

          if ($id_data_patient_relatives_summary > 0)
          echo 'Data added succesfully at patient_relatives_summary table';
          else
          echo 'Failed to insert at patient_relatives_summary table';
          echo '<br/>';

          $id_data_patient_survival_status = $this->excell_sheets_model->insert_record($data_patient_survival_status, 'patient_survival_status');

          if ($id_data_patient_survival_status > 0)
          echo 'Data added succesfully at patient_survival_status table';
          else
          echo 'Failed to insert at patient_survival_status table';
          echo '<br/>';
          } else if ($loadedSheetName == 'Family') {
          $temp_ic_no = NULL;
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

          if ($key == 0 && $cell_value != NULL)
          $temp_ic_no = $cell_value;

          if ($key == 0 && $cell_value == NULL)
          $cell_value = $temp_ic_no;

          if ($key == 14 && $cell_value == NULL)
          $cell_value = 'None';
          //echo $key; // 0, 1, 2..
          $temp2[] = $cell_value;
          }

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

          if ($temp2[22] == 'yes')
          $is_paternal = TRUE;
          else if ($temp2[22] == 'no')
          $is_paternal = FALSE;
          else
          $is_paternal = FALSE;

          if ($temp2[23] == 'yes')
          $is_maternal = TRUE;
          else if ($temp2[23] == 'no')
          $is_maternal = FALSE;
          else
          $is_maternal = FALSE;

          if ($temp2[26] == 'yes' || $temp2[26] == 'Yes')
          $is_adopted = TRUE;
          else if ($temp2[26] == 'no' || $temp2[26] == 'No')
          $is_adopted = FALSE;
          else
          $is_adopted = FALSE;

          if ($temp2[27] == 'yes' || $temp2[27] == 'Yes')
          $is_in_other_country = TRUE;
          else if ($temp2[27] == 'no' || $temp2[27] == 'No')
          $is_in_other_country = FALSE;
          else
          $is_in_other_country = FALSE;

          $relatives_id = $this->excell_sheets_model->get_id('relatives', 'relatives_id', 'relatives_type', $temp2[1]);

          $cancer_type_id = $this->excell_sheets_model->get_id('cancer', 'cancer_id', 'cancer_name', $temp2[14]);

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
          'd_o_b' => date('Y-m-d', strtotime(str_replace('/', '-', $temp2[9]))),
          'is_alive_flag' => $is_alive_flag,
          'd_o_d' => date('Y-m-d', strtotime(str_replace('/', '-', $temp2[11]))),
          'is_cancer_diagnosed' => $is_cancer_diagnosed,
          'date_of_diagnosis' => date('Y-m-d', strtotime(str_replace('/', '-', $temp2[13]))),
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
          // print_r($data_patient_relatives);
          $id_data_patient_relatives = $this->excell_sheets_model->insert_record($data_patient_relatives, 'patient_relatives');
          if ($id_data_patient_relatives > 0)
          echo 'Data added succesfully at patient_relatives table';
          else
          echo 'Failed to insert at patient_relatives table';
          echo '<br/>';
          }
          else if ($loadedSheetName == 'Personal2') {
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
          }

          $studies_id = $this->excell_sheets_model->get_id('studies', 'studies_id', 'studies_name', $temp3[1]);

          $relations_to_study = $temp3[8];

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
          'date_at_consent' => date('Y-m-d', strtotime(str_replace('/', '-', $temp3[2]))),
          'age_at_consent' => $temp3[3],
          'double_consent_flag' => $double_consent_flag,
          'consent_given_by' => $temp3[5],
          'consent_response' => $temp3[6],
          'consent_version' => $temp3[7],
          'relation_to_study' => $relations_to_study_flag,
          'referral_to' => $temp3[9],
          'referral_to_genetic_counselling' => $temp3[10],
          'referral_source' => $temp3[11],
          'created_on' => $created_date
          );
          }
          //print_r($data_patient_studies);
          $id_data_patient_studies = $this->excell_sheets_model->insert_record($data_patient_studies, 'patient_studies');
          if ($id_data_patient_studies > 0)
          echo 'Data added succesfully at patient_studies table';
          else
          echo 'Failed to insert at patient_studies table';
          echo '<br/>';
          }
          else if ($loadedSheetName == 'Diagnosis & Treatment') {
          $temp_ic_no = NULL;
          $temp_cancer_name = NULL;
          $temp_cancer_site_name = NULL;
          $temp_studies_name = NULL;

          $temp_patient_ic_no = array();
          $treatment_patient_studies_id = array();
          $pathology_patient_studies_id = array();
          $treatment_cancer_id = array();
          $pathology_cancer_id = array();
          $treatment_cancer_site_id = array();
          $pathology_cancer_site_id = array();

          $flag_ic_no = FALSE;
          $flag_cancer_name = FALSE;
          $flag_cancer_site_name = FALSE;
          $flag_studies_name = FALSE;
          $flag_treatment_name = FALSE;
          $flag_pathology_tissue_site = FALSE;

          foreach ($sheet->getRowIterator() as $row) {
          $i++;

          if ($i == 1)//ommiting cell header name
          continue;

          $cellIterator = $row->getCellIterator();
          $cellIterator->setIterateOnlyExistingCells(false);
          $temp14 = array();
          foreach ($cellIterator as $key => $cell) {
          $cell_value = $cell->getFormattedValue();

          if ($key == 0 && $cell_value != NULL)
          $temp_ic_no = $cell_value;

          if ($key == 0 && $cell_value == NULL) {
          $cell_value = $temp_ic_no;
          $flag_ic_no = TRUE;
          }

          if ($key == 1 && $cell_value != NULL)
          $temp_studies_name = $cell_value;

          if ($key == 1 && $cell_value == NULL) {
          $cell_value = $temp_studies_name;
          $flag_studies_name = TRUE;
          }

          if ($key == 2 && $cell_value != NULL)
          $temp_cancer_name = $cell_value;

          if ($key == 2 && $cell_value == NULL) {
          $cell_value = $temp_cancer_name;
          $flag_cancer_name = TRUE;
          }

          if ($key == 3 && $cell_value != NULL)
          $temp_cancer_site_name = $cell_value;

          if ($key == 3 && $cell_value == NULL) {
          $cell_value = $temp_cancer_site_name;
          $flag_cancer_site_name = TRUE;
          }

          if ($key == 13 && $cell_value == NULL) {
          $flag_treatment_name = TRUE;
          }

          if ($key == 26 && $cell_value == NULL) {
          $flag_pathology_tissue_site = TRUE;
          }

          $temp14[] = $cell_value;
          }

          if ($temp14[4] == 'Yes' || $temp14[4] == 'yes')
          $is_primary = TRUE;
          else if ($temp14[4] == 'No' || $temp14[4] == 'no')
          $is_primary = FALSE;
          else
          $is_primary = FALSE;

          if ($temp14[11] == 'Yes' || $temp14[11] == 'yes')
          $bilateral_flag = TRUE;
          else if ($temp14[11] == 'No' || $temp14[11] == 'no')
          $bilateral_flag = FALSE;
          else
          $bilateral_flag = FALSE;

          if ($temp14[12] == 'Yes' || $temp14[12] == 'yes')
          $recurrence_flag = TRUE;
          else if ($temp14[12] == 'No' || $temp14[12] == 'no')
          $recurrence_flag = FALSE;
          else
          $recurrence_flag = FALSE;

          $patient_ic_no = $temp14[0];
          $studies_name = $temp14[1]; //echo 'studies_name'.$studies_name.'</br>';
          $studies_id = $this->excell_sheets_model->get_id('studies', 'studies_id', 'studies_name', $temp14[1]);
          $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);
          //echo 'patient_studies_id'.$patient_studies_id.'</br>';

          if (!$flag_cancer_name) {
          $cancer_id = $this->excell_sheets_model->get_id('cancer', 'cancer_id', 'cancer_name', $temp14[2]);
          $cancer_site_id = $this->excell_sheets_model->get_id('cancer_site', 'cancer_site_id', 'cancer_site_name', $temp14[3]);
          $data_patient_cancer[] = array(
          'patient_studies_id' => $patient_studies_id,
          'cancer_id' => $cancer_id,
          'cancer_site_id' => $cancer_site_id,
          'cancer_invasive_type' => $temp14[4],
          'is_primary' => $is_primary,
          'date_of_diagnosis' => date('Y-m-d', strtotime(str_replace('/', '-', $temp14[6]))),
          'age_of_diagnosis' => $temp14[7],
          'diagnosis_center' => $temp14[8],
          'doctor_name' => $temp14[9],
          'detected_by' => $temp14[10],
          'bilateral_flag' => $bilateral_flag,
          'recurrence_flag' => $recurrence_flag,
          'created_on' => $created_date
          );
          }
          $flag_cancer_name = FALSE;

          if (!$flag_treatment_name) {
          $cancer_id = $this->excell_sheets_model->get_id('cancer', 'cancer_id', 'cancer_name', $temp14[2]);
          $cancer_site_id = $this->excell_sheets_model->get_id('cancer_site', 'cancer_site_id', 'cancer_site_name', $temp14[3]);
          $treatment_patient_studies_id[] = $patient_studies_id;
          $treatment_cancer_id[] = $cancer_id;
          $treatment_cancer_site_id[] = $cancer_site_id;

          $treatment_id = $this->excell_sheets_model->get_id('treatment', 'treatment_id', 'treatment_name', $temp14[13]);

          $data_patient_cancer_treatment[] = array(
          'treatment_id' => $treatment_id,
          'patient_cancer_id' => 1,
          'treatment_start_date' => date('Y-m-d', strtotime(str_replace('/', '-', $temp14[14]))),
          'treatment_end_date' => date('Y-m-d', strtotime(str_replace('/', '-', $temp14[15]))),
          'treatment_durations' => $temp14[16],
          'comments' => $temp14[17],
          'created_on' => $created_date,
          'treatment_details' => $temp14[18],
          'treatment_dose' => $temp14[19],
          'treatment_cycle' => $temp14[20],
          'treatment_frequency' => $temp14[21],
          'treatment_visidual_desease' => $temp14[22],
          'treatment_privacy_outcome' => $temp14[23],
          'treatment_cal125_pretreatment' => $temp14[24],
          'treatment_cal125_posttreatment' => $temp14[25]
          );
          }
          $flag_treatment_name = FALSE;

          if (!$flag_pathology_tissue_site) {
          $cancer_site_id = $this->excell_sheets_model->get_id('cancer_site', 'cancer_site_id', 'cancer_site_name', $temp14[3]);
          $pathology_patient_studies_id[] = $patient_studies_id;
          $pathology_cancer_id[] = $cancer_id;
          $pathology_cancer_site_id[] = $cancer_site_id;
          $cancer_id = $this->excell_sheets_model->get_id('cancer', 'cancer_id', 'cancer_name', $temp14[2]);

          $data_patient_pathology[] = array(
          'cancer_id' => $cancer_id,
          'tissue_site' => $temp14[26],
          'type_of_report' => $temp14[27],
          'date_of_report' => date('Y-m-d', strtotime(str_replace('/', '-', $temp14[28]))),
          'pathology_lab' => $temp14[29],
          'name_of_doctor' => $temp14[30],
          'morphology' => $temp14[31],
          't_staging' => $temp14[32],
          'n_staging' => $temp14[33],
          'm_staging' => $temp14[34],
          'stage_classifications' => $temp14[35],
          'tumour_stage' => $temp14[36],
          'tumour_grade' => $temp14[37],
          'total_lymph_nodes' => $temp14[38],
          'tumour_size' => $temp14[39],
          'comments' => $temp14[40],
          'created_on' => $created_date,
          'patient_cancer_id' => 1,
          'no_of_report' => $temp14[41],
          'tumor_subtype' => $temp14[42],
          'tumor_behaviour' => $temp14[43],
          'tumor_differentiation' => $temp14[44]
          );
          $flag_pathology_tissue_site = FALSE;
          }
          }

          //print_r($data_patient_cancer);
          //print_r($data_patient_cancer_treatment);
          //print_r($data_patient_pathology);
          //print_r($treatment_patient_studies_id);
          //print_r($treatment_cancer_id);
          //print_r($treatment_cancer_site_id);

          //print_r($pathology_patient_studies_id);
          //print_r($pathology_cancer_id);
          //print_r($pathology_cancer_site_id);

          $id_data_patient_cancer = $this->excell_sheets_model->insert_record($data_patient_cancer, 'patient_cancer');
          if ($id_data_patient_cancer > 0)
          echo 'Data added succesfully at patient_cancer table';
          else
          echo 'Failed to insert at patient_cancer table';
          echo '<br/>';

          $tempLength = sizeof($data_patient_cancer_treatment);

          for ($key = 0; $key < $tempLength; $key++) {
          //echo $treatment_patient_studies_id[$key].'      '.$treatment_cancer_id[$key].'      '.$treatment_cancer_site_id[$key].'<br/>';
          $patient_cancer_id = $this->excell_sheets_model->get_patient_cancer_id($treatment_patient_studies_id[$key], $treatment_cancer_id[$key], $treatment_cancer_site_id[$key]);
          $data_patient_cancer_treatment[$key]['patient_cancer_id'] = $patient_cancer_id;
          }

          // print_r($data_patient_cancer_treatment);

          $tempLength = sizeof($data_patient_pathology);

          for ($key = 0; $key < $tempLength; $key++) {
          //echo $treatment_patient_studies_id[$key].'      '.$treatment_cancer_id[$key].'      '.$treatment_cancer_site_id[$key].'<br/>';
          $patient_cancer_id = $this->excell_sheets_model->get_patient_cancer_id($pathology_patient_studies_id[$key], $pathology_cancer_id[$key], $pathology_cancer_site_id[$key]);
          $data_patient_pathology[$key]['patient_cancer_id'] = $patient_cancer_id;
          }
          //print_r($data_patient_pathology);
          $id_patient_cancer_treatment = $this->excell_sheets_model->insert_record($data_patient_cancer_treatment, 'patient_cancer_treatment');
          if ($id_patient_cancer_treatment > 0)
          echo 'Data added succesfully at patient_cancer_treatment table';
          else
          echo 'Failed to insert at patient_cancer_treatment table';
          echo '<br/>';

          $id_patient_pathology = $this->excell_sheets_model->insert_record($data_patient_pathology, 'patient_pathology');
          if ($id_patient_pathology > 0)
          echo 'Data added succesfully at patient_pathology table';
          else
          echo 'Failed to insert at patient_pathology table';
          echo '<br/>';
          } else if ($loadedSheetName == 'Sreening and Surveilance1') {
          $temp_patient_ic_no = array();
          $temp_patient_studies_id = array();
          foreach ($sheet->getRowIterator() as $row) {
          $i++;

          if ($i == 1)//ommiting cell header name
          continue;

          $cellIterator = $row->getCellIterator();
          $cellIterator->setIterateOnlyExistingCells(false);
          $temp4 = array();
          foreach ($cellIterator as $key => $cell) {

          $cell_value = $cell->getFormattedValue();
          //echo $key; // 0, 1, 2..
          $temp4[] = $cell_value;
          }

          if ($temp4[16] == 'Yes' || $temp4[16] == 'yes')
          $abnormality_mammo_flag = TRUE;
          else if ($temp4[16] == 'No' || $temp4[16] == 'no')
          $abnormality_mammo_flag = FALSE;
          else
          $abnormality_mammo_flag = FALSE;

          if ($temp4[17] == 'Yes' || $temp4[17] == 'yes')
          $had_ultrasound_flag = TRUE;
          else if ($temp4[17] == 'No' || $temp4[17] == 'no')
          $had_ultrasound_flag = FALSE;
          else
          $had_ultrasound_flag = FALSE;

          if ($temp4[19] == 'Yes' || $temp4[19] == 'yes')
          $abnormality_ultrasound_flag = TRUE;
          else if ($temp4[19] == 'No' || $temp4[19] == 'no')
          $abnormality_ultrasound_flag = FALSE;
          else
          $abnormality_ultrasound_flag = FALSE;

          if ($temp4[23] == 'Yes' || $temp4[23] == 'yes')
          $had_mri_flag = TRUE;
          else if ($temp4[23] == 'No' || $temp4[23] == 'no')
          $had_mri_flag = FALSE;
          else
          $had_mri_flag = FALSE;

          if ($temp4[25] == 'Yes' || $temp4[25] == 'yes')
          $abnormality_MRI_flag = TRUE;
          else if ($temp4[25] == 'No' || $temp4[25] == 'no')
          $abnormality_MRI_flag = FALSE;
          else
          $abnormality_MRI_flag = FALSE;

          if ($temp4[41] == 'Yes' || $temp4[41] == 'yes')
          $is_cancer_mammogram_flag = TRUE;
          else if ($temp4[41] == 'No' || $temp4[41] == 'no')
          $is_cancer_mammogram_flag = FALSE;
          else
          $is_cancer_mammogram_flag = FALSE;

          $patient_ic_no = $temp4[0];
          $studies_name = $temp4[1];
          $studies_id = $this->excell_sheets_model->get_id('studies', 'studies_id', 'studies_name', $temp4[1]);
          $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);

          $temp_patient_ic_no[] = $patient_ic_no;
          $temp_patient_studies_id[] = $patient_studies_id;

          $data_patient_breast_screening[] = array(
          'patient_ic_no' => $temp4[0],
          'patient_studies_id' => $patient_studies_id,
          'date_of_first_mammogram' => date('Y-m-d', strtotime(str_replace('/', '-', $temp4[2]))),
          'age_of_first_mammogram' => $temp4[3],
          'date_of_recent_mammogram' => date('Y-m-d', strtotime(str_replace('/', '-', $temp4[4]))),
          'screening_centre' => $temp4[5],
          'total_no_of_mammogram' => $temp4[9],
          'screening_interval' => $temp4[10],
          'abnormalities_mammo_flag' => $abnormality_mammo_flag,
          'mammo_comments' => $temp4[8],
          'name_of_radiologist' => $temp4[6],
          'had_ultrasound_flag' => $had_ultrasound_flag,
          'total_no_of_ultrasound' => $temp4[18],
          'abnormalities_ultrasound_flag' => $abnormality_ultrasound_flag,
          'had_mri_flag' => $had_mri_flag,
          'total_no_of_mri' => $temp4[24],
          'abnormalities_MRI_flag' => $abnormality_MRI_flag,
          'BIRADS_clinical_classification' => $temp4[11],
          'BIRADS_density_classification' => $temp4[12],
          'percentage_of_mammo_density' => $temp4[13],
          'created_on' => $created_date,
          'screening_center_of_first_mammogram' => $temp4[29],
          'screening_center_of_recent_mammogram' => $temp4[30],
          'details_of_first_mammogram' => $temp4[31],
          'details_of_recent_mammogram' => $temp4[32],
          'motivaters_of_first_mammogram' => $temp4[33],
          'motivaters_of_recent_mammogram' => $temp4[34],
          'reason_of_mammogram' => $temp4[35],
          'reason_of_mammogram_details' => $temp4[36],
          'mammogram_in_sdmc' => $temp4[37],
          'action_suggested_on_mammogram_report' => $temp4[38],
          'reason_of_action_suggested' => $temp4[39],
          'site_effected_of_mammogram' => $temp4[40],
          'is_cancer_mammogram_flag' => $is_cancer_mammogram_flag
          );

          $patient_breast_screening_id = 1; //for testing
          $left_right_breast_side = $temp4[14];
          $upper_below_breast_side = $temp4[15];

          if ($left_right_breast_side == "yes/yes" || $left_right_breast_side == "Yes/Yes") {
          $left_breast = TRUE;
          $right_breast = TRUE;
          } else if ($left_right_breast_side == "yes/no" || $left_right_breast_side == "Yes/No") {
          $left_breast = TRUE;
          $right_breast = FALSE;
          } else if ($left_right_breast_side == "no/yes" || $left_right_breast_side == "No/Yes") {
          $left_breast = FALSE;
          $right_breast = TRUE;
          } else if ($left_right_breast_side == "no/no" || $left_right_breast_side == "No/No") {
          $left_breast = FALSE;
          $right_breast = FALSE;
          } else {
          $left_breast = FALSE;
          $right_breast = FALSE;
          }

          if ($upper_below_breast_side == "yes/yes" || $upper_below_breast_side == "Yes/Yes") {
          $upper = TRUE;
          $below = TRUE;
          } else if ($upper_below_breast_side == "yes/no" || $upper_below_breast_side == "Yes/No") {
          $upper = TRUE;
          $below = FALSE;
          } else if ($upper_below_breast_side == "no/yes" || $upper_below_breast_side == "No/Yes") {
          $upper = FALSE;
          $below = TRUE;
          } else if ($upper_below_breast_side == "no/no" || $upper_below_breast_side == "No/No") {
          $upper = FALSE;
          $below = FALSE;
          } else {
          $upper = FALSE;
          $below = FALSE;
          }


          if ($temp4[7] == 'Yes' || $temp4[7] == 'yes')
          $is_abnormality_detected_breast = TRUE;
          else if ($temp4[7] == 'No' || $temp4[7] == 'no')
          $is_abnormality_detected_breast = FALSE;
          else
          $is_abnormality_detected_breast = FALSE;

          $data_patient_breast_abnormality[] = array(
          'patient_breast_screening_id' => $patient_breast_screening_id,
          'left_breast' => $left_breast,
          'right_breast' => $right_breast,
          'upper' => $upper,
          'below' => $below,
          'is_abnormality_detected' => $is_abnormality_detected_breast,
          'created_on' => $created_date
          );

          if ($temp4[21] == 'Yes' || $temp4[21] == 'yes')
          $is_abnormality_detected_ultrasound = TRUE;
          else if ($temp4[21] == 'No' || $temp4[21] == 'no')
          $is_abnormality_detected_ultrasound = FALSE;
          else
          $is_abnormality_detected_ultrasound = FALSE;

          $data_patient_ultrasound_abnormality[] = array(
          'ultrasound_date' => $temp4[20],
          'is_abnormality_detected' => $is_abnormality_detected_ultrasound,
          'comments' => $temp4[22],
          'patient_breast_screening_id' => $patient_breast_screening_id,
          'created_on' => $created_date
          );

          if ($temp4[27] == 'Yes' || $temp4[27] == 'yes')
          $is_abnormality_detected_mri = TRUE;
          else if ($temp4[27] == 'No' || $temp4[27] == 'no')
          $is_abnormality_detected_mri = FALSE;
          else
          $is_abnormality_detected_mri = FALSE;

          $data_patient_mri_abnormality[] = array(
          'mri_date' => date('Y-m-d', strtotime(str_replace('/', '-', $temp4[26]))),
          'is_abnormality_detected' => $is_abnormality_detected_mri,
          'comments' => $temp4[28],
          'patient_breast_screening_id' => $patient_breast_screening_id,
          'created_on' => $created_date
          );
          }



          //print_r($data_patient_breast_screening);
          //print_r($data_patient_breast_abnormality);
          //print_r($data_patient_ultrasound_abnormality);
          // print_r($data_patient_mri_abnormality);

          $id_patient_breast_screening = $this->excell_sheets_model->insert_record($data_patient_breast_screening, 'patient_breast_screening');
          if ($id_patient_breast_screening > 0)
          echo 'Data added succesfully at patient_breast_screening table';
          else
          echo 'Failed to insert at patient_breast_screening table';
          echo '<br/>';

          $tempLength = sizeof($temp_patient_ic_no);

          for ($key = 0; $key < $tempLength; $key++) {
          $patient_breast_screening_id = $this->excell_sheets_model->get_patient_breast_screening_id($temp_patient_ic_no[$key], $temp_patient_studies_id[$key]);
          $data_patient_breast_abnormality[$key]['patient_breast_screening_id'] = $patient_breast_screening_id;
          $data_patient_ultrasound_abnormality[$key]['patient_breast_screening_id'] = $patient_breast_screening_id;
          $data_patient_mri_abnormality[$key]['patient_breast_screening_id'] = $patient_breast_screening_id;
          }

          //print_r($data_patient_breast_abnormality);
          //print_r($data_patient_ultrasound_abnormality);
          //print_r($data_patient_mri_abnormality);
          $id_patient_breast_abnormality = $this->excell_sheets_model->insert_record($data_patient_breast_abnormality, 'patient_breast_abnormality');
          if ($id_patient_breast_abnormality > 0)
          echo 'Data added succesfully at patient_breast_abnormality table';
          else
          echo 'Failed to insert at patient_breast_abnormality table';
          echo '<br/>';

          $id_patient_ultrasound_abnormality = $this->excell_sheets_model->insert_record($data_patient_ultrasound_abnormality, 'patient_ultrasound_abnormality');
          if ($id_patient_ultrasound_abnormality > 0)
          echo 'Data added succesfully at patient_ultrasound_abnormality table';
          else
          echo 'Failed to insert at patient_ultrasound_abnormality table';
          echo '<br/>';

          $id_patient_mri_abnormality = $this->excell_sheets_model->insert_record($data_patient_mri_abnormality, 'patient_mri_abnormality');
          if ($id_patient_mri_abnormality > 0)
          echo 'Data added succesfully at patient_mri_abnormality table';
          else
          echo 'Failed to insert at patient_mri_abnormality table';
          echo '<br/>';
          } else if ($loadedSheetName == 'Sreening and Surveilance2') {
          foreach ($sheet->getRowIterator() as $row) {
          $i++;

          if ($i == 1)//ommiting cell header name
          continue;

          $cellIterator = $row->getCellIterator();
          $cellIterator->setIterateOnlyExistingCells(false);
          $temp5 = array();
          foreach ($cellIterator as $key => $cell) {
          $cell_value = $cell->getFormattedValue();
          //echo $key; // 0, 1, 2..
          $temp5[] = $cell_value;
          }

          $patient_ic_no = $temp5[0];
          $studies_name = $temp5[1];
          $studies_id = $this->excell_sheets_model->get_id('studies', 'studies_id', 'studies_name', $temp5[1]);
          $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);

          $data_patient_non_cancer_surgery[] = array(
          'patient_studies_id' => $patient_studies_id,
          'surgery_type' => $temp5[2],
          'reason_for_surgery' => $temp5[3],
          'date_of_surgery' => date('Y-m-d', strtotime(str_replace('/', '-', $temp5[4]))),
          'age_at_surgery' => $temp5[5],
          'comments' => $temp5[6],
          'created_on' => $created_date,
          'breast_surgery_type' => $temp5[7],
          'breast_reason_of_surgery' => $temp5[8],
          'breast_comments' => $temp5[9],
          'breast_age_of_surgery' => $temp5[10],
          'breast_date_of_surgery' => $temp5[11]
          );
          }
          //print_r($data_patient_non_cancer_surgery);
          $id_data_patient_studies = $this->excell_sheets_model->insert_record($data_patient_non_cancer_surgery, 'patient_non_cancer_surgery');
          if ($id_data_patient_studies > 0)
          echo 'Data added succesfully at patient_non_cancer_surgery table';
          else
          echo 'Failed to insert at patient_non_cancer_surgery table';
          echo '<br/>';
          }else if ($loadedSheetName == 'Sreening and Surveilance3') {
          $temp_patient_studies_id = array();
          foreach ($sheet->getRowIterator() as $row) {
          $i++;

          if ($i == 1)//ommiting cell header name
          continue;

          $cellIterator = $row->getCellIterator();
          $cellIterator->setIterateOnlyExistingCells(false);
          $temp6 = array();
          foreach ($cellIterator as $key => $cell) {
          $cell_value = $cell->getFormattedValue();
          //echo $key; // 0, 1, 2..
          $temp6[] = $cell_value;
          }

          if ($temp6[2] == 'Yes' || $temp6[2] == 'yes')
          $had_new_lesion_surgery_flag = TRUE;
          else if ($temp6[2] == 'No' || $temp6[2] == 'no')
          $had_new_lesion_surgery_flag = FALSE;
          else
          $had_new_lesion_surgery_flag = FALSE;

          if ($temp6[5] == 'Yes' || $temp6[5] == 'yes')
          $had_complete_removal_surgery_flag = TRUE;
          else if ($temp6[5] == 'No' || $temp6[5] == 'no')
          $had_complete_removal_surgery_flag = FALSE;
          else
          $had_complete_removal_surgery_flag = FALSE;

          $studies_id = $this->excell_sheets_model->get_id('studies', 'studies_id', 'studies_name', $temp6[1]);
          $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($temp6[0], $studies_id);
          $temp_patient_studies_id[] = $patient_studies_id;

          $data_patient_risk_reducing_surgery[] = array(
          'patient_studies_id' => $patient_studies_id,
          'had_new_lesion_surgery_flag' => $had_new_lesion_surgery_flag,
          'had_complete_removal_surgery_flag' => $had_complete_removal_surgery_flag,
          'created_on' => $created_date
          );

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
          'surgery_date' => date('Y-m-d', strtotime(str_replace('/', '-', $temp6[7]))),
          'surgery_reason' => $temp6[8],
          'created_on' => $created_date
          );
          }
          //print_r($data_patient_risk_reducing_surgery);
          // print_r($patient_risk_reducing_surgery_lesion);
          //print_r($patient_risk_reducing_surgery_complete_removal);

          $id_patient_risk_reducing_surgery = $this->excell_sheets_model->insert_record($data_patient_risk_reducing_surgery, 'patient_risk_reducing_surgery');
          if ($id_patient_risk_reducing_surgery > 0)
          echo 'Data added succesfully at patient_risk_reducing_surgery table';
          else
          echo 'Failed to insert at patient_risk_reducing_surgery table';
          echo '<br/>';

          $tempLength = sizeof($temp_patient_studies_id);

          for ($key = 0; $key < $tempLength; $key++) {
          $patient_risk_reducing_surgery_id = $this->excell_sheets_model->get_id('patient_risk_reducing_surgery', 'patient_risk_reducing_surgery_id', 'patient_studies_id', $temp_patient_studies_id[$key]);
          $data_patient_risk_reducing_surgery_lesion[$key]['patient_risk_reducing_surgery_id'] = $patient_risk_reducing_surgery_id;
          $data_patient_risk_reducing_surgery_complete_removal[$key]['patient_risk_reducing_surgery_id'] = $patient_risk_reducing_surgery_id;
          }

          //print_r($patient_risk_reducing_surgery_lesion);
          // print_r($patient_risk_reducing_surgery_complete_removal);
          $id_patient_risk_reducing_surgery_lesion = $this->excell_sheets_model->insert_record($data_patient_risk_reducing_surgery_lesion, 'patient_risk_reducing_surgery_lesion');
          if ($id_patient_risk_reducing_surgery_lesion > 0)
          echo 'Data added succesfully at patient_risk_reducing_surgery_lesion table';
          else
          echo 'Failed to insert at patient_risk_reducing_surgery_lesion table';
          echo '<br/>';

          $id_patient_risk_reducing_surgery_complete_removal = $this->excell_sheets_model->insert_record($data_patient_risk_reducing_surgery_complete_removal, 'patient_risk_reducing_surgery_complete_removal');
          if ($id_patient_risk_reducing_surgery_complete_removal > 0)
          echo 'Data added succesfully at patient_risk_reducing_surgery_complete_removal table';
          else
          echo 'Failed to insert at patient_risk_reducing_surgery_complete_removal table';
          echo '<br/>';
          } else if ($loadedSheetName == 'Sreening and Surveilance4') {
          foreach ($sheet->getRowIterator() as $row) {
          $i++;

          if ($i == 1)//ommiting cell header name
          continue;

          $cellIterator = $row->getCellIterator();
          $cellIterator->setIterateOnlyExistingCells(false);
          $temp7 = array();
          foreach ($cellIterator as $key => $cell) {
          $cell_value = $cell->getFormattedValue();
          //echo $key; // 0, 1, 2..
          $temp7[] = $cell_value;
          }

          if ($temp7[4] == 'Yes' || $temp7[4] == 'yes')
          $is_abnormality_detected = TRUE;
          else if ($temp7[4] == 'No' || $temp7[4] == 'no')
          $is_abnormality_detected = FALSE;
          else
          $is_abnormality_detected = FALSE;

          $patient_ic_no = $temp7[0];
          $studies_id = $this->excell_sheets_model->get_id('studies', 'studies_id', 'studies_name', $temp7[1]);
          $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);

          $ovarian_screening_type_id = $this->excell_sheets_model->get_id('ovarian_screening_type', 'ovarian_screening_type_id', 'ovarian_screening_type_name', $temp7[2]);
          $data_patient_ovarian_screening[] = array(
          'patient_studies_id' => $patient_studies_id,
          'ovarian_screening_type_id' => $ovarian_screening_type_id,
          'screening_date' => date('Y-m-d', strtotime(str_replace('/', '-', $temp7[3]))),
          'is_abnormality_detected' => $is_abnormality_detected,
          'additional_info' => $temp7[5],
          'created_on' => $created_date
          );

          $data_patient_other_screening[] = array(
          'patient_studies_id' => $patient_studies_id,
          'screening_type' => $temp7[6],
          'age_at_screening' => $temp7[7],
          'screening_center' => $temp7[8],
          'screening_result' => $temp7[9],
          'created_on' => $created_date
          );
          }
          //print_r($data_patient_ovarian_screening);
          //print_r($patient_other_screening);

          $id_patient_ovarian_screening = $this->excell_sheets_model->insert_record($data_patient_ovarian_screening, 'patient_ovarian_screening');
          if ($id_patient_ovarian_screening > 0)
          echo 'Data added succesfully at patient_ovarian_screening table';
          else
          echo 'Failed to insert at patient_ovarian_screening table';
          echo '<br/>';

          $id_patient_other_screening = $this->excell_sheets_model->insert_record($data_patient_other_screening, 'patient_other_screening');
          if ($id_patient_other_screening > 0)
          echo 'Data added succesfully at patient_other_screening table';
          else
          echo 'Failed to insert at patient_other_screening table';
          echo '<br/>';
          }
          else if ($loadedSheetName == 'Sreening and Surveilance5') {
          foreach ($sheet->getRowIterator() as $row) {
          $i++;

          if ($i == 1)//ommiting cell header name
          continue;

          $cellIterator = $row->getCellIterator();
          $cellIterator->setIterateOnlyExistingCells(false);
          $temp8 = array();
          foreach ($cellIterator as $key => $cell) {
          $cell_value = $cell->getFormattedValue();
          //echo $key; // 0, 1, 2..
          $temp8[] = $cell_value;
          }

          if ($temp8[7] == 'Yes' || $temp8[7] == 'yes')
          $on_medication_flag = TRUE;
          else if ($temp8[7] == 'No' || $temp8[7] == 'no')
          $on_medication_flag = FALSE;
          else
          $on_medication_flag = FALSE;

          $patient_ic_no = $temp8[0];
          $studies_name = $temp8[1];
          $studies_id = $this->excell_sheets_model->get_id('studies', 'studies_id', 'studies_name', $temp8[1]);
          $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);

          $diagnosis_id = $this->excell_sheets_model->get_id('diagnosis', 'diagnosis_id', 'diagnosis_name', $temp8[2]);
          $data_patient_other_disease[] = array(
          'patient_studies_id' => $patient_studies_id,
          'diagnosis_id' => $diagnosis_id,
          'date_of_diagnosis' => date('Y-m-d', strtotime(str_replace('/', '-', $temp8[3]))),
          'diagnosis_age' => $temp8[4],
          'diagnosis_center' => $temp8[5],
          'doctor_name' => $temp8[6],
          'on_medication_flag' => $on_medication_flag,
          'created_on' => $created_date
          );

          $data_patient_surveillance[] = array(
          'patient_studies_id' => $patient_studies_id,
          'recruitment_center' => $temp8[8],
          'type' => $temp8[9],
          'first_consultation_date' => $temp8[10],
          'first_consultation_place' => $temp8[11],
          'surveillance_interval' => $temp8[12],
          'diagnosis' => $temp8[13],
          'due_date' => date('Y-m-d', strtotime(str_replace('/', '-', $temp8[14]))),
          'reminder_sent_date' => date('Y-m-d', strtotime(str_replace('/', '-', $temp8[15]))),
          'surveillance_done_date' => date('Y-m-d', strtotime(str_replace('/', '-', $temp8[16]))),
          'reminded_by' => $temp8[17],
          'timing' => $temp8[18],
          'symptoms' => $temp8[19],
          'doctor_name' => $temp8[20],
          'surveillance_done_place' => $temp8[21],
          'outcome' => $temp8[22],
          'comments' => $temp8[23],
          'created_on' => $created_date
          );
          }
          //print_r($data_patient_other_disease);
          //print_r($data_patient_surveillance);

          $id_patient_other_disease = $this->excell_sheets_model->insert_record($data_patient_other_disease, 'patient_other_disease');
          if ($id_patient_other_disease > 0)
          echo 'Data added succesfully at patient_other_disease table';
          else
          echo 'Failed to insert at patient_other_disease table';
          echo '<br/>';

          $id_patient_surveillance = $this->excell_sheets_model->insert_record($data_patient_surveillance, 'patient_surveillance');
          if ($id_patient_surveillance > 0)
          echo 'Data added succesfully at patient_surveillance table';
          else
          echo 'Failed to insert at patient_surveillance table';
          echo '<br/>';
          }
          else if ($loadedSheetName == 'Mutation analysis') {
          foreach ($sheet->getRowIterator() as $row) {
          $i++;

          if ($i == 1)//ommiting cell header name
          continue;

          $cellIterator = $row->getCellIterator();
          $cellIterator->setIterateOnlyExistingCells(false);
          $temp9 = array();
          foreach ($cellIterator as $key => $cell) {
          $cell_value = $cell->getFormattedValue();
          //echo $key; // 0, 1, 2..
          $temp9[] = $cell_value;
          }

          if ($temp9[4] == 'Yes' || $temp9[4] == 'yes')
          $testing_result_notification_flag = TRUE;
          else if ($temp9[4] == 'No' || $temp9[4] == 'no')
          $testing_result_notification_flag = FALSE;
          else
          $testing_result_notification_flag = FALSE;

          if ($temp9[12] == 'Yes' || $temp9[12] == 'yes')
          $new_mutation_flag = TRUE;
          else if ($temp9[12] == 'No' || $temp9[12] == 'no')
          $new_mutation_flag = FALSE;
          else
          $new_mutation_flag = FALSE;

          if ($temp9[22] == 'Yes' || $temp9[22] == 'yes')
          $is_counselling_flag = TRUE;
          else if ($temp9[22] == 'No' || $temp9[22] == 'no')
          $is_counselling_flag = FALSE;
          else
          $is_counselling_flag = FALSE;

          $patient_ic_no = $temp9[0];
          $studies_name = $temp9[1];
          $studies_id = $this->excell_sheets_model->get_id('studies', 'studies_id', 'studies_name', $temp9[1]);
          $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);

          $data_patient_mutation_analysis[] = array(
          'date_test_ordered' => $temp9[2],
          'ordered_by' => $temp9[3],
          'testing_result_notification_flag' => $testing_result_notification_flag,
          'service_provider' => $temp9[5],
          'testing_batch' => $temp9[6],
          'testing_date' => date('Y-m-d', strtotime(str_replace('/', '-', $temp9[7]))),
          'gene_tested' => $temp9[8],
          'types_of_testing' => $temp9[9],
          'type_of_sample' => $temp9[10],
          'reasons' => $temp9[11],
          'new_mutation_flag' => $new_mutation_flag,
          'test_result' => $temp9[13],
          'investigation_test_results_other_details' => $temp9[14],
          'carrier_status' => $temp9[19],
          'mutation_nomenclature' => $temp9[16],
          'mutation_type' => $temp9[17],
          'exon' => $temp9[18],
          'mutation_pathogenicity' => $temp9[15],
          'report_date' => date('Y-m-d', strtotime(str_replace('/', '-', $temp9[20]))),
          'date_client_notified' => date('Y-m-d', strtotime(str_replace('/', '-', $temp9[21]))),
          'is_counselling_flag' => $temp9[22],
          'comments' => $temp9[23],
          'patient_studies_id' => $patient_studies_id,
          'created_on' => $created_date,
          'mutation_name' => $temp9[24]
          );
          }
          // print_r($data_patient_mutation_analysis);


          $id_patient_mutation_analysis = $this->excell_sheets_model->insert_record($data_patient_mutation_analysis, 'patient_mutation_analysis');
          if ($id_patient_mutation_analysis > 0)
          echo 'Data added succesfully at patient_mutation_analysis table';
          else
          echo 'Failed to insert at patient_mutation_analysis table';
          echo '<br/>';
          }
          else if ($loadedSheetName == 'Risk Assesment') {
          foreach ($sheet->getRowIterator() as $row) {
          $i++;

          if ($i == 1)//ommiting cell header name
          continue;

          $cellIterator = $row->getCellIterator();
          $cellIterator->setIterateOnlyExistingCells(false);
          $temp10 = array();
          foreach ($cellIterator as $key => $cell) {
          $cell_value = $cell->getFormattedValue();
          //echo $key; // 0, 1, 2..
          $temp10[] = $cell_value;
          }

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
          //print_r($data_patient_risk_assessment);


          $id_patient_risk_assessment = $this->excell_sheets_model->insert_record($data_patient_risk_assessment, 'patient_risk_assessment');
          if ($id_patient_risk_assessment > 0)
          echo 'Data added succesfully at patient_risk_assessment table';
          else
          echo 'Failed to insert at patient_risk_assessment table';
          echo '<br/>';
          } else if ($loadedSheetName == 'Lifestyles1') {
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

          if ($temp11[9] == 'Yes' || $temp11[9] == 'yes')
          $cigarrets_smoked_flag = TRUE;
          else if ($temp11[9] == 'No' || $temp11[9] == 'no')
          $cigarrets_smoked_flag = FALSE;
          else
          $cigarrets_smoked_flag = FALSE;

          if ($temp11[10] == 'Yes' || $temp11[10] == 'yes')
          $cigarrets_still_smoked_flag = TRUE;
          else if ($temp11[10] == 'No' || $temp11[10] == 'no')
          $cigarrets_still_smoked_flag = FALSE;
          else
          $cigarrets_still_smoked_flag = FALSE;

          if ($temp11[19] == 'Yes' || $temp11[19] == 'yes')
          $alcohol_drunk_flag = TRUE;
          else if ($temp11[19] == 'No' || $temp11[19] == 'no')
          $alcohol_drunk_flag = FALSE;
          else
          $alcohol_drunk_flag = FALSE;

          if ($temp11[22] == 'Yes' || $temp11[22] == 'yes')
          $coffee_drunk_flag = TRUE;
          else if ($temp11[22] == 'No' || $temp11[22] == 'no')
          $coffee_drunk_flag = FALSE;
          else
          $coffee_drunk_flag = FALSE;

          if ($temp11[25] == 'Yes' || $temp11[25] == 'yes')
          $tea_drunk_flag = TRUE;
          else if ($temp11[25] == 'No' || $temp11[25] == 'no')
          $tea_drunk_flag = FALSE;
          else
          $tea_drunk_flag = FALSE;

          if ($temp11[29] == 'Yes' || $temp11[29] == 'yes')
          $soya_bean_drunk_flag = TRUE;
          else if ($temp11[29] == 'No' || $temp11[29] == 'no')
          $soya_bean_drunk_flag = FALSE;
          else
          $soya_bean_drunk_flag = FALSE;

          if ($temp11[31] == 'yes')
          $soya_products_flag = TRUE;
          else if ($temp11[31] == 'no')
          $soya_products_flag = FALSE;
          else
          $soya_products_flag = FALSE;

          if ($temp11[33] == 'Yes' || $temp11[33] == 'yes')
          $diabetes_flag = TRUE;
          else if ($temp11[33] == 'No' || $temp11[33] == 'no')
          $diabetes_flag = FALSE;
          else
          $diabetes_flag = FALSE;

          if ($temp11[34] == 'yes')
          $medicine_for_diabetes_flag = TRUE;
          else if ($temp11[34] == 'no')
          $medicine_for_diabetes_flag = FALSE;
          else
          $medicine_for_diabetes_flag = FALSE;

          $patient_ic_no = $temp11[0];
          $studies_name = $temp11[1];
          $studies_id = $this->excell_sheets_model->get_id('studies', 'studies_id', 'studies_name', $temp11[1]);
          $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);

          $data_patient_lifestyle_factors[] = array(
          'patient_studies_id' => $patient_studies_id,
          'questionnaire_date' => date('Y-m-d', strtotime(str_replace('/', '-', $temp11[2]))),
          'self_image_at_7years' => $temp11[3],
          'self_image_at_18years' => $temp11[4],
          'self_image_now' => $temp11[5],
          'pa_sports_activitiy_childhood' => $temp11[6],
          'pa_sports_activitiy_adult' => $temp11[7],
          'pa_sports_activitiy_now' => $temp11[8],
          'cigarrets_smoked_flag' => $cigarrets_smoked_flag,
          'cigarrets_still_smoked_flag' => $cigarrets_still_smoked_flag,
          'total_smoked_years' => $temp11[11],
          'cigarrets_count_at_teen' => $temp11[12],
          'cigarrets_count_at_twenties' => $temp11[13],
          'cigarrets_count_at_thirties' => $temp11[14],
          'cigarrets_count_at_fourrties' => $temp11[15],
          'cigarrets_count_at_fifties' => $temp11[16],
          'cigarrets_count_at_sixties_and_above' => $temp11[17],
          'cigarrets_count_one_year_before_diagnosed' => $temp11[18],
          'alcohol_drunk_flag' => $alcohol_drunk_flag,
          'alcohol_frequency' => $temp11[20],
          'alcohol_comments' => $temp11[21],
          'coffee_drunk_flag' => $coffee_drunk_flag,
          'coffee_age' => $temp11[23],
          'coffee_frequency' => $temp11[24],
          'tea_drunk_flag' => $tea_drunk_flag,
          'tea_age' => $temp11[26],
          'tea_type' => $temp11[27],
          'tea_frequency' => $temp11[28],
          'soya_bean_drunk_flag' => $soya_bean_drunk_flag,
          'soya_bean_frequency' => $temp11[30],
          'soya_products_flag' => $soya_products_flag,
          'soya_products_average' => $temp11[32],
          'diabetes_flag' => $diabetes_flag,
          'medicine_for_diabetes_flag' => $medicine_for_diabetes_flag,
          'diabetes_medicine_name' => $temp11[35],
          'created_on' => $created_date
          );
          }
          //print_r($data_patient_lifestyle_factors);


          $id_patient_lifestyle_factors = $this->excell_sheets_model->insert_record($data_patient_lifestyle_factors, 'patient_lifestyle_factors');
          if ($id_patient_lifestyle_factors > 0)
          echo 'Data added succesfully at patient_lifestyle_factors table';
          else
          echo 'Failed to insert at patient_lifestyle_factors table';
          echo '<br/>';
          }
          else if ($loadedSheetName == 'Lifestyle2') {
          foreach ($sheet->getRowIterator() as $row) {
          $i++;

          if ($i == 1)//ommiting cell header name
          continue;

          $cellIterator = $row->getCellIterator();
          $cellIterator->setIterateOnlyExistingCells(false);
          $temp12 = array();
          foreach ($cellIterator as $key => $cell) {
          $cell_value = $cell->getFormattedValue();
          //echo $key; // 0, 1, 2..
          $temp12[] = $cell_value;
          }

          if ($temp12[3] == 'Yes' || $temp12[3] == 'yes')
          $still_period_flag = TRUE;
          else if ($temp12[3] == 'No' || $temp12[3] == 'no')
          $still_period_flag = FALSE;
          else
          $still_period_flag = FALSE;


          $patient_ic_no = $temp12[0];
          $studies_id = $this->excell_sheets_model->get_id('studies', 'studies_id', 'studies_name', $temp12[1]);
          $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);

          $data_patient_menstruation[] = array(
          'patient_studies_id' => $patient_studies_id,
          'age_period_starts' => $temp12[2],
          'still_period_flag' => $still_period_flag,
          'period_type' => $temp12[4],
          'period_cycle_days' => $temp12[5],
          'period_cycle_days_other_details' => $temp12[6],
          'age_at_menopause' => $temp12[7],
          'reason_period_stops' => $temp12[8],
          'date_period_stops' => $temp12[9],
          'reason_period_stops_other_details' => $temp12[10],
          'created_on' => $created_date
          );

          if ($temp12[11] == 'Yes' || $temp12[11] == 'yes')
          $pregnant_flag = TRUE;
          else if ($temp12[11] == 'No' || $temp12[11] == 'no')
          $pregnant_flag = FALSE;
          else
          $pregnant_flag = FALSE;

          $data_patient_parity_table[] = array(
          'patient_studies_id' => $patient_studies_id,
          'pregnant_flag' => $pregnant_flag,
          'created_on' => $created_date
          );

          if ($temp12[12] == 'Yes' || $temp12[12] == 'yes')
          $infertility_testing_flag = TRUE;
          else if ($temp12[12] == 'No' || $temp12[12] == 'no')
          $infertility_testing_flag = FALSE;
          else
          $infertility_testing_flag = FALSE;

          if ($temp12[16] == 'Yes' || $temp12[16] == 'yes')
          $contraceptive_pills_flag = TRUE;
          else if ($temp12[16] == 'No' || $temp12[16] == 'no')
          $contraceptive_pills_flag = FALSE;
          else
          $contraceptive_pills_flag = FALSE;

          if ($temp12[17] == 'Yes' || $temp12[17] == 'yes')
          $currently_taking_contraceptive_pills_flag = TRUE;
          else if ($temp12[17] == 'No' || $temp12[17] == 'no')
          $currently_taking_contraceptive_pills_flag = FALSE;
          else
          $currently_taking_contraceptive_pills_flag = FALSE;

          if ($temp12[21] == 'Yes' || $temp12[21] == 'yes')
          $hrt_flag = TRUE;
          else if ($temp12[21] == 'No' || $temp12[21] == 'no')
          $hrt_flag = FALSE;
          else
          $hrt_flag = FALSE;

          if ($temp12[22] == 'Yes' || $temp12[22] == 'yes')
          $currently_using_hrt_flag = TRUE;
          else if ($temp12[22] == 'No' || $temp12[22] == 'no')
          $currently_using_hrt_flag = FALSE;
          else
          $currently_using_hrt_flag = FALSE;


          $data_patient_infertility[] = array(
          'patient_studies_id' => $patient_studies_id,
          'infertility_testing_flag' => $infertility_testing_flag,
          'infertility_treatment_type' => $temp12[13],
          'infertility_treatment_duration' => $temp12[14],
          'infertility_comments' => $temp12[15],
          'contraceptive_pills_flag' => $contraceptive_pills_flag,
          'currently_taking_contraceptive_pills_flag' => $currently_taking_contraceptive_pills_flag,
          'contraceptive_start_date' => date('Y-m-d', strtotime(str_replace('/', '-', $temp12[19]))),
          'contraceptive_end_date' => date('Y-m-d', strtotime(str_replace('/', '-', $temp12[20]))),
          'contraceptive_duration' => $temp12[18],
          'hrt_flag' => $hrt_flag,
          'currently_using_hrt_flag' => $currently_using_hrt_flag,
          'hrt_start_date' => date('Y-m-d', strtotime(str_replace('/', '-', $temp12[24]))),
          'hrt_end_date' => date('Y-m-d', strtotime(str_replace('/', '-', $temp12[25]))),
          'hrt_duration' => $temp12[23],
          'created_on' => $created_date,
          'contraceptive_end_age' => $temp12[26],
          'contraceptive_start_age' => $temp12[27],
          'hrt_start_age' => $temp12[28],
          'hrt_end_age' => $temp12[29]
          );

          if ($temp12[30] == 'Yes' || $temp12[30] == 'yes')
          $had_gnc_surgery_flag = TRUE;
          else if ($temp12[30] == 'No' || $temp12[30] == 'no')
          $had_gnc_surgery_flag = FALSE;
          else
          $had_gnc_surgery_flag = FALSE;

          $treatment_Id = $this->excell_sheets_model->get_id('treatment', 'treatment_id', 'treatment_name', $temp12[32]);
          $data_patient_gynaecological_surgery_history[] = array(
          'patient_studies_id' => $patient_studies_id,
          'had_gnc_surgery_flag' => $had_gnc_surgery_flag,
          'surgery_year' => $temp12[31],
          'treatment_id' => $treatment_Id,
          'gnc_treatment_name_other_details' => $temp12[33],
          'created_on' => $created_date
          );
          }
          //print_r($data_patient_menstruation);
          //print_r($data_patient_parity_table);
          // print_r($data_patient_infertility);
          // print_r($data_patient_gynaecological_surgery_history);
          $id_patient_menstruation = $this->excell_sheets_model->insert_record($data_patient_menstruation, 'patient_menstruation');
          if ($id_patient_menstruation > 0)
          echo 'Data added succesfully at patient_menstruation table';
          else
          echo 'Failed to insert at patient_menstruation table';
          echo '<br/>';

          $id_patient_parity_table = $this->excell_sheets_model->insert_record($data_patient_parity_table, 'patient_parity_table');
          if ($id_patient_parity_table > 0)
          echo 'Data added succesfully at patient_parity_table table';
          else
          echo 'Failed to insert at patient_parity_table table';
          echo '<br/>';

          $id_patient_infertility = $this->excell_sheets_model->insert_record($data_patient_infertility, 'patient_infertility');
          if ($id_patient_infertility > 0)
          echo 'Data added succesfully at patient_infertility table';
          else
          echo 'Failed to insert at patient_infertility table';
          echo '<br/>';

          $id_patient_gynaecological_surgery_history = $this->excell_sheets_model->insert_record($data_patient_gynaecological_surgery_history, 'patient_gynaecological_surgery_history');
          if ($id_patient_gynaecological_surgery_history > 0)
          echo 'Data added succesfully at patient_gynaecological_surgery_history table';
          else
          echo 'Failed to insert at patient_gynaecological_surgery_history table';
          echo '<br/>';
          }
          else if ($loadedSheetName == 'Lifestyle3') {
          foreach ($sheet->getRowIterator() as $row) {
          $i++;

          if ($i == 1)//ommiting cell header name
          continue;

          $cellIterator = $row->getCellIterator();
          $cellIterator->setIterateOnlyExistingCells(false);
          $temp13 = array();
          foreach ($cellIterator as $key => $cell) {
          $cell_value = $cell->getFormattedValue();
          //echo $key; // 0, 1, 2..
          $temp13[] = $cell_value;
          }

          $patient_ic_no = $temp13[0];
          $studies_name = $temp13[1];
          $studies_id = $this->excell_sheets_model->get_id('studies', 'studies_id', 'studies_name', $studies_name);
          $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);
          $patient_parity_table_id = $this->excell_sheets_model->get_patient_parity_table_id($patient_studies_id);

          $data_patient_Lifestyle3[] = array(
          'patient_parity_table_id' => $patient_parity_table_id,
          'pregnancy_type' => $temp13[2],
          'gender' => $temp13[3],
          'date_of_birth' => date('Y-m-d', strtotime(str_replace('/', '-', $temp13[4]))),
          'year_of_birth' => $temp13[5],
          'age_child_at_consent' => $temp13[6],
          'birthweight' => $temp13[7],
          'breastfeeding_duration' => $temp13[8],
          'created_on' => $created_date
          );
          }
          //print_r($data_patient_Lifestyle3);


          $id_patient_Lifestyle3 = $this->excell_sheets_model->insert_record($data_patient_Lifestyle3, 'patient_parity_record');

          if ($id_patient_Lifestyle3 > 0)
          echo 'Data added succesfully at patient_parity_record table';
          else
          echo 'Failed to insert at patient_parity_record table';
          echo '<br/>';
          }
          }

          // all loop ends
          }
    }

    function check_name($name) {
        if (ctype_alpha(str_replace(array(' ', "'", '@', '/'), '', $name)))   //if (ctype_alpha(str_replace(' ', '', $name)))
            return TRUE;
        else
            return FALSE;
    }

    function check_IC_NO($ic_no) {
        if (strlen($ic_no) == 12 && ctype_digit($ic_no))
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
