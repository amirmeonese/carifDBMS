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
        $created_date = date('Y-m-d H:i:s'); //date("Y-m-d");
        $array_IC_no = array();
        $array_IC_no = null;
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
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
                                $ic_no_validator = $this->check_IC_NO($cell_value);
                                $cell_value_ic = $cell_value;
                            }

                            if ($key == 0 && $cell_value != NULL) {
                                $name_validator = $this->check_name($cell_value);
                            }

                            /* if ($key == 22 && $cell_value != NULL) {
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
                              } */

                            if ($key == 27 && $cell_value != NULL) {
                                $email_validator = $this->check_email($cell_value);
                            }

                            if ($key == 29 && $cell_value != NULL) {
                                $height_validator = $this->check_phone_no($cell_value);
                            }

                            if ($key == 30 && $cell_value != NULL) {
                                $weight_validator = $this->check_phone_no($cell_value);
                            }

                            /* if ($key == 34 && $cell_value != NULL) {
                              $contact_phone_validator = $this->check_phone_no($cell_value);
                              } */

                            if (($key == 8 || $key == 13 || $key == 49) && $cell_value != NULL) {
                                if (strpos($cell_value, '-') !== FALSE)
                                    $cell_value = date("d/m/Y", strtotime($cell_value));

                                list($day, $month, $year) = explode("/", $cell_value);
                                if (!checkdate($month, $day, $year)) {
                                    if ($key == 8)
                                        echo '<h2>patient_DOB is not in appropriate format at Personal' . '		row	' . $i . '</h2>';
                                    if ($key == 13)
                                        echo '<h2>patient_DOD is not in appropriate format at Personal' . '	row	' . $i . '</h2>';
                                    if ($key == 49)
                                        echo '<h2>status_collection_date is not in appropriate format at Personal' . '		row	' . $i . '</h2>';
                                    //echo '<h2>patient_DOB or patient_DOD or status_collection_date is not in appropriate format at Personal</h2>';
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
                            echo '<h2>patient_IC_no is not in appropriate length or Number format at Personal</h2>' . '   row ' . $i . '</h2>';
                            $abort = TRUE;
                            break;
                        }


                        if (!$name_validator) {
                            echo '<h2>patient_given_name is not in appropriate format at Personal</h2>';
                            $abort = TRUE;
                            break;
                        }
                        /* if (!$home_phone_validator) {
                          echo '<h2>patient_home_phone is not in appropriate format at Personal</h2>';
                          $abort = TRUE;
                          break;
                          }

                          if (!$cellphone_validator) {
                          echo '<h2>patient_cellphone is not in appropriate format at Personal</h2>';
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
                          } */

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
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
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
                                if (strpos($cell_value, '-') !== FALSE)
                                    $cell_value = date("d/m/Y", strtotime($cell_value));
                                list($day, $month, $year) = explode("/", $cell_value);

                                if (!checkdate($month, $day, $year)) {
                                    echo '<h2>date_at_consent is not in appropriate format at Personal2  </h2>' . $i;
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
                            echo 'Should ommit import for invalid studies_id at Personal2 worksheet' . ' row ' . $i . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }
                    $array_IC_no_Personal2 = null;
                    $array_studies_name = null;
                    
                } else if ($loadedSheetName == 'Family') {
                    $array_IC_no_Family = array();
                    $array_IC_no_Family = null;
                    $array_relationship_type = array();
                    $array_relationship_type = null;
                    $array_cancer_name_Family = array();
                    $array_cancer_name_Family = null;

                    foreach ($sheet->getRowIterator() as $row) {//echo 'from Family';
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
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
                                $ic_no_validator = $this->check_IC_NO($cell_value);
                                if (!$ic_no_validator) {
                                    echo '<h2>patient_IC_no is not in appropriate format at Family</h2>';
                                    $abort = TRUE;
                                    break;
                                }
                                $array_IC_no_Family[] = $cell_value;
                            }

                            if ($key == 1 && $cell_value == NULL) {
                                $array_relationship_type[] = 'None';
                            }

                            if ($key == 1 && $cell_value != NULL) {
                                $array_relationship_type[] = $cell_value;
                            }

                            if (($key == 9 || $key == 11 || $key == 13) && $cell_value != NULL) {
                                if (strpos($cell_value, '-') !== FALSE)
                                    $cell_value = date("d/m/Y", strtotime($cell_value));
                                list($day, $month, $year) = explode("/", $cell_value);

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
                    
                    $array_IC_no_Family = null;
                    $array_relationship_type = null;
                    $array_cancer_name_Family = null;
		    $temp_result_relationship = null;
                    $result_relationship_type = null;
                    $temp_result_cancer_name = null;
                    $result_cancer_name = null;
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
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
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

                            if ($key == 3 && $cell_value == NULL) {
                                $cell_value = 'None';
                            }

                            if ($key == 3 && $cell_value != NULL) {
                                $array_cancer_site_name_Diagnosis[] = trim($cell_value);
                            }
                            if ($key == 13 && $cell_value == NULL) {
                                $cell_value = 'None';
                            }

                            if ($key == 13 && $cell_value != NULL) {
                                $array_treatment_name_Diagnosis[] = $cell_value;
                            }

                            if (($key == 6 || $key == 14 || $key == 15 || $key == 28) && $cell_value != NULL) {
                                //echo $cell_value.'         ';
                                if (strlen($cell_value) > 8) {
                                    if (strpos($cell_value, '-') !== FALSE)
                                        $cell_value = date("d/m/Y", strtotime($cell_value));
                                    list($day, $month, $year) = explode("/", $cell_value);

                                    if (!checkdate($month, $day, $year)) {
                                        //echo '<h2>date_of_diagnosis or treatment_start_date or treatment_end_date is not in appropriate format at Diagnosis & Treatment</h2>';
                                        if ($key == 6)
                                            echo '<h2>date_of_diagnosis is not in appropriate format at Diagnosis & Treatment' . '		row	' . $i . '</h2>';
                                        if ($key == 14)
                                            echo '<h2>treatment_start_date is not in appropriate format at Diagnosis & Treatment' . '	row	' . $i . '</h2>';
                                        if ($key == 15)
                                            echo '<h2>treatment_end_date is not in appropriate format at Diagnosis & Treatment' . '		row	' . $i . '</h2>';

                                        if ($key == 28)
                                            echo '<h2>date_of_report is not in appropriate format at Diagnosis & Treatment' . '		row	' . $i . '</h2>';

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

                    // print_r($array_IC_no_Diagnosis);
                    //print_r($array_studies_name);
                    //print_r($array_cancer_site_name_Diagnosis);
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
                            echo 'Should ommit import for invalid studies_id data at Diagnosis & Treatment worksheet' . $i . '<br/>';
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
                    //print_r($result_cancer_site_name);
                    for ($i = 0; $i < sizeof($array_cancer_site_name_Diagnosis); $i++) {
                        $val_cancer_site_name = in_array($array_cancer_site_name_Diagnosis[$i], $result_cancer_site_name);

                        if (!$val_cancer_site_name) {
                            echo 'Should ommit import for invalid cancer_site_name data at Diagnosis & Treatment worksheet' . '  row ' . $i . '<br/>';
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
                    
                    $array_studies_name = null;
                    $array_treatment_name_Diagnosis = null;
                    $array_IC_no_Diagnosis = null;
                    $array_studies_name = null;
                    $array_cancer_name_Diagnosis = null;
                    $array_cancer_site_name_Diagnosis = null;
                    $array_treatment_name_Diagnosis = null;
                    $temp_result_cancer_name = null;
                    $result_cancer_name = null;
                    $temp_result_cancer_site_name = null;
                    $result_cancer_site_name = null;
                    $temp_result_treatment_name = null;
                    $result_treatment_name = null;		
                } else if ($loadedSheetName == 'Diagnosis & Treatment2') {
                    $array_studies_name = array();
                    $array_studies_name = null;
                    $array_IC_no_Diagnosis2 = array();
                    $array_IC_no_Diagnosis2 = null;
                    $array_diagnosis_name = array();
                    $array_diagnosis_name = null;

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
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
                                $ic_no_validator = $this->check_IC_NO($cell_value);
                                if (!$ic_no_validator) {
                                    echo '<h2>patient_IC_no is not in appropriate format at Diagnosis & Treatment2</h2>';
                                    $abort = TRUE;
                                    break;
                                }
                                $array_IC_no_Diagnosis2[] = $cell_value;
                            }

                            if ($key == 1 && $cell_value != NULL) {
                                $array_studies_name[] = $cell_value;
                            }

                            if ($key == 2 && $cell_value != NULL) {
                                $cell_value = trim($cell_value);
                                $array_diagnosis_name[] = $cell_value;
                            }

                            if ($key == 2 && $cell_value == NULL) {
                                $cell_value = 'None';
                                $array_diagnosis_name[] = $cell_value;
                            }

                            if (($key == 3 || $key == 9 || $key == 10) && $cell_value != NULL) {
                                if (strpos($cell_value, '-') !== FALSE)
                                    $cell_value = date("d/m/Y", strtotime($cell_value));
                                list($day, $month, $year) = explode("/", $cell_value);

                                if (!checkdate($month, $day, $year)) {
                                    echo '<h2>date_of_birth is not in appropriate format at Diagnosis & Treatment2</h2>';
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

                    for ($i = 0; $i < sizeof($array_IC_no_Diagnosis2); $i++) {
                        $val_ic_no = in_array($array_IC_no_Diagnosis2[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name[$i], $result_studies_name);

                        $val_diagnosis_id = in_array($array_diagnosis_name[$i], $result_diagnonis_name);

                        if (!$val_ic_no) {
                            echo 'Should ommit import for invalid ic_no data at Diagnosis & Treatment2 worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_studies_id) {
                            echo 'Should ommit import for invalid studies_id data at Diagnosis & Treatment2 worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }

                        if (!$val_diagnosis_id) {
                            echo 'Should ommit import for invalid diagnosis_id data at Diagnosis & Treatment2 worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }
                    $array_studies_name = null;
                    $array_IC_no_Diagnosis2 = null;
                    $array_diagnosis_name = null;
                    $array_IC_no_Diagnosis2 = null;
                    $array_studies_name = null;
                    $array_diagnosis_name = null;
                    $array_diagnosis_name = null;
                    
                } else if ($loadedSheetName == 'Sreening and Surveilance1') {
                    $array_studies_name_Surveilance1 = array();
                    $array_studies_name_Surveilance1 = null;
                    $array_IC_no_Surveilance1 = array();
                    $array_IC_no_Surveilance1 = null;

                    foreach ($sheet->getRowIterator() as $row) {//echo '<br/>from Sreening and Surveilance1';
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
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
                                $ic_no_validator = $this->check_IC_NO($cell_value);
                                if (!$ic_no_validator) {
                                    echo '<h2>patient_IC_no is not in appropriate format at Sreening and Surveilance1</h2>';
                                    $abort = TRUE;
                                    break;
                                }
                                $array_IC_no_Surveilance1[] = $cell_value;
                            }

                            if ($key == 1 && $cell_value != NULL) {
                                $array_studies_name_Surveilance1[] = $cell_value;
                            }

                            if (($key == 2 || $key == 4 || $key == 21 || $key == 27) && $cell_value != NULL) {
                                if (strpos($cell_value, '-') !== FALSE)
                                    $cell_value = date("d/m/Y", strtotime($cell_value));
                                list($day, $month, $year) = explode("/", $cell_value);

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
                    //print_r($array_studies_name_Surveilance1);

                    for ($i = 0; $i < sizeof($array_IC_no_Surveilance1); $i++) {
                        $val_ic_no = in_array($array_IC_no_Surveilance1[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name_Surveilance1[$i], $result_studies_name);

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
                    $array_studies_name_Surveilance1 = null;
                    $array_IC_no_Surveilance1 = null;
                } else if ($loadedSheetName == 'Sreening and Surveilance2') {
                    $array_studies_name_Surveilance2 = array();
                    $array_studies_name_Surveilance2 = null;
                    $array_IC_no_Surveilance2 = array();
                    $array_IC_no_Surveilance2 = null;

                    foreach ($sheet->getRowIterator() as $row) {//echo '<br/>from Sreening and Surveilance2';
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
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
                                $ic_no_validator = $this->check_IC_NO($cell_value);
                                if (!$ic_no_validator) {
                                    echo '<h2>patient_IC_no is not in appropriate format at Sreening and Surveilance2</h2>';
                                    $abort = TRUE;
                                    break;
                                }
                                $array_IC_no_Surveilance2[] = $cell_value;
                            }

                            if ($key == 1 && $cell_value != NULL) {
                                $array_studies_name_Surveilance2[] = $cell_value;
                            }

                            if (($key == 4 || $key == 10) && $cell_value != NULL) {
                                if (strpos($cell_value, '-') !== FALSE)
                                    $cell_value = date("d/m/Y", strtotime($cell_value));
                                list($day, $month, $year) = explode("/", $cell_value);

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
                    // print_r($array_studies_name_Surveilance2);

                    for ($i = 0; $i < sizeof($array_IC_no_Surveilance2); $i++) {
                        $val_ic_no = in_array($array_IC_no_Surveilance2[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name_Surveilance2[$i], $result_studies_name);

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
                    $array_studies_name_Surveilance2 = null;
                    $array_IC_no_Surveilance2 = null;
                } else if ($loadedSheetName == 'Sreening and Surveilance3') {
                    $array_studies_name_Surveilance3 = array();
                    $array_studies_name_Surveilance3 = null;
                    $array_lesion_surgery_site = array();
                    $array_lesion_surgery_site = null;
                    $array_surgery_site = array();
                    $array_surgery_site = null;
                    $array_IC_no_Surveilance3 = array();
                    $array_IC_no_Surveilance3 = null;
                    
                    foreach ($sheet->getRowIterator() as $row) {//echo '<br/>from Sreening and Surveilance3';
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
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
                                $ic_no_validator = $this->check_IC_NO($cell_value);
                                if (!$ic_no_validator) {
                                    echo '<h2>patient_IC_no is not in appropriate format at Sreening and Sreening and Surveilance3</h2>';
                                    $abort = TRUE;
                                    break;
                                }
                                $array_IC_no_Surveilance3[] = $cell_value;
                            }

                            if ($key == 1 && $cell_value != NULL) {
                                $array_studies_name_Surveilance3[] = $cell_value;
                            }

                            if ($key == 3 && $cell_value == NULL) {
                                $cell_value = 'None';
                            }

                            if ($key == 3 && $cell_value != NULL) {
                                $array_lesion_surgery_site[] = $cell_value;
                            }

                            if ($key == 6 && $cell_value == NULL) {
                                $cell_value = 'None';
                            }

                            if ($key == 6 && $cell_value != NULL) {
                                $array_surgery_site[] = $cell_value;
                            }

                            if (($key == 4 || $key == 7) && $cell_value != NULL) {
                                if (strpos($cell_value, '-') !== FALSE)
                                    $cell_value = date("d/m/Y", strtotime($cell_value));
                                list($day, $month, $year) = explode("/", $cell_value);

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
                    //print_r($array_studies_name_Surveilance3);
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
                    //print_r($result_non_cancerous_site_name);
                    for ($i = 0; $i < sizeof($array_IC_no_Surveilance3); $i++) {
                        $val_ic_no = in_array($array_IC_no_Surveilance3[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name_Surveilance3[$i], $result_studies_name);

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
                    $array_studies_name_Surveilance3 = null;
                    $array_lesion_surgery_site = null;
                    $array_surgery_site = null;
                    $array_IC_no_Surveilance3 = null;
                    $temp_non_cancerous_site_name = null;
                    $result_non_cancerous_site_name = null;
                } else if ($loadedSheetName == 'Sreening and Surveilance4') {
                    $array_studies_name_Surveilance4 = array();
                    $array_studies_name_Surveilance4 = null;
                    $array_other_screening_type = array();
                    $array_other_screening_type = null;
                    $array_IC_no_Surveilance4 = array();
                    $array_IC_no_Surveilance4 = null;
                    $array_ovarian_screening_type = array();
                    $array_ovarian_screening_type = null;
                    

                    foreach ($sheet->getRowIterator() as $row) {//echo '<br/>from Sreening and Surveilance4';
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
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
                                $ic_no_validator = $this->check_IC_NO($cell_value);
                                if (!$ic_no_validator) {
                                    echo '<h2>patient_IC_no is not in appropriate format at Sreening and Surveilance4</h2>';
                                    $abort = TRUE;
                                    break;
                                }
                                $array_IC_no_Surveilance4[] = $cell_value;
                            }

                            if ($key == 1 && $cell_value != NULL) {
                                $array_studies_name_Surveilance4[] = $cell_value;
                            }

                            if ($key == 2 && $cell_value == NULL) {
                                $array_ovarian_screening_type[] = 'None';
                            }

                            if ($key == 2 && $cell_value != NULL) {
                                $array_ovarian_screening_type[] = $cell_value;
                            }

                            if ($key == 3 && $cell_value != NULL) {
                                if (strpos($cell_value, '-') !== FALSE)
                                    $cell_value = date("d/m/Y", strtotime($cell_value));
                                list($day, $month, $year) = explode("/", $cell_value);

                                if (!checkdate($month, $day, $year)) {
                                    echo '<h2>screening_date is not in appropriate format at Sreening and Surveilance4</h2>';
                                    $date_flag = TRUE;
                                    $abort = TRUE;
                                    break;
                                }
                            }

                            if ($key == 6 && $cell_value == NULL) {
                                $cell_value = 'None';
                            }
                            if ($key == 6 && $cell_value != NULL) {
                                $array_other_screening_type[] = $cell_value;
                                break;
                            }
                        }
                        if (!$ic_no_validator)
                            break;

                        if ($date_flag)
                            break;
                    }

                    //print_r($array_IC_no_Surveilance4);
                    //print_r($array_studies_name_Surveilance4);
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
                        $val_studies_id = in_array($array_studies_name_Surveilance4[$i], $result_studies_name);

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
                    $array_studies_name_Surveilance4 = null;
                    $array_other_screening_type = null;
                    $array_IC_no_Surveilance4 = null;
                    $array_ovarian_screening_type = null;
                    $temp_ovarian_screening_type_name = null;
                    $result_ovarian_screening_type_name = null;
                } else if ($loadedSheetName == 'Sreening and Surveilance5') {
                    $array_studies_name_Surveilance5 = array();
                    $array_studies_name_Surveilance5 = null;
                    $array_IC_no_Surveilance5 = array();
                    $array_IC_no_Surveilance5 = null;

                    foreach ($sheet->getRowIterator() as $row) {//echo '<br/>from Sreening and Surveilance5';
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
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
                                $ic_no_validator = $this->check_IC_NO($cell_value);
                                if (!$ic_no_validator) {
                                    echo '<h2>patient_IC_no is not in appropriate format at Sreening and Surveilance5</h2>';
                                    $abort = TRUE;
                                    break;
                                }
                                $array_IC_no_Surveilance5[] = $cell_value;
                            }

                            if ($key == 1 && $cell_value != NULL) {
                                $array_studies_name_Surveilance5[] = $cell_value;
                            }

                            if (($key == 4 || $key == 8 || $key == 9 || $key == 10) && $cell_value != NULL) {
                                //echo $key.'     From line 952<br/>';
                                //echo "cell value:   ".$cell_value.'<br/>';

                                if (strpos($cell_value, '-') !== FALSE)
                                    $cell_value = date("d/m/Y", strtotime($cell_value));
                                list($day, $month, $year) = explode("/", $cell_value);

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
                    //print_r($array_studies_name_Surveilance5);
                    //print_r($array_diagnonis_name_Surveilance5);

                    //print_r($result_diagnonis_name);
                    for ($i = 0; $i < sizeof($array_IC_no_Surveilance5); $i++) {
                        $val_ic_no = in_array($array_IC_no_Surveilance5[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name_Surveilance5[$i], $result_studies_name);

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
                    }
                    $array_studies_name_Surveilance5 = null;
                    $array_IC_no_Surveilance5 = null;
                } else if ($loadedSheetName == 'Mutation analysis') {
                    $array_studies_name = array();
                    $array_studies_name = null;
                    $array_IC_no_mutation_analysis = array();
                    $array_IC_no_mutation_analysis = null;

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
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
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
                                if (strpos($cell_value, '-') !== FALSE)
                                    $cell_value = date("d/m/Y", strtotime($cell_value));
                                list($day, $month, $year) = explode("/", $cell_value);

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
                    $array_studies_name = null;
                    $array_IC_no_mutation_analysis = null;
                } else if ($loadedSheetName == 'Risk Assesment') {
                    $array_IC_no_risk_Assesment = array();
                    $array_IC_no_risk_Assesment = null;

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
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
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
                    $array_IC_no_risk_Assesment = null;
                } else if ($loadedSheetName == 'Lifestyles1') {
                    $array_studies_name_Lifestyles1 = array();
                    $array_studies_name_Lifestyles1 = null;
                    $array_IC_no_Lifestyles1 = array();
                    $array_IC_no_Lifestyles1 = null;

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
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
                                $ic_no_validator = $this->check_IC_NO($cell_value);
                                if (!$ic_no_validator) {
                                    echo '<h2>patient_IC_no is not in appropriate format at Lifestyles1</h2>';
                                    $abort = TRUE;
                                    break;
                                }
                                $array_IC_no_Lifestyles1[] = $cell_value;
                            }

                            if ($key == 1 && $cell_value != NULL) {
                                $array_studies_name_Lifestyles1[] = $cell_value;
                            }

                            if ($key == 2 && $cell_value != NULL) {
                                if (strpos($cell_value, '-') !== FALSE)
                                    $cell_value = date("d/m/Y", strtotime($cell_value));
                                list($day, $month, $year) = explode("/", $cell_value);

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
                    //print_r($array_studies_name_Lifestyles1);

                    for ($i = 0; $i < sizeof($array_IC_no_Lifestyles1); $i++) {
                        $val_ic_no = in_array($array_IC_no_Lifestyles1[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name_Lifestyles1[$i], $result_studies_name);

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
                    $array_studies_name_Lifestyles1 = null;
                    $array_IC_no_Lifestyles1 = null;
                } else if ($loadedSheetName == 'Lifestyle2') {
                    $array_studies_name_Lifestyle2 = array();
                    $array_studies_name_Lifestyle2 = null;
                    $array_treatment_name_Lifestyle2 = array();
                    $array_treatment_name_Lifestyle2 = null;
                    $array_IC_no_Lifestyles2 = array();
                    $array_IC_no_Lifestyles2 = null;

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
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
                                $ic_no_validator = $this->check_IC_NO($cell_value);
                                if (!$ic_no_validator) {
                                    echo '<h2>patient_IC_no is not in appropriate format at Lifestyle2</h2>';
                                    $abort = TRUE;
                                    break;
                                }
                                $array_IC_no_Lifestyles2[] = $cell_value;
                            }

                            if ($key == 1 && $cell_value != NULL) {
                                $array_studies_name_Lifestyle2[] = $cell_value;
                            }

                            if (($key == 9 || $key == 19 || $key == 20 || $key == 24 || $key == 25) && $cell_value != NULL) {
                                if (strpos($cell_value, '-') !== FALSE)
                                    $cell_value = date("d/m/Y", strtotime($cell_value));
                                list($day, $month, $year) = explode("/", $cell_value);

                                if (!checkdate($month, $day, $year)) {
                                    echo '<h2>date_period_stops or start_date or end_date or hrt_start_date or hrt_end_date is not in appropriate format at Lifestyle2</h2>';
                                    $date_flag = TRUE;
                                    $abort = TRUE;
                                    break;
                                }
                            }

                            if ($key == 32 && $cell_value == NULL) {
                                $cell_value = 'None';
                            }

                            if ($key == 32 && $cell_value != NULL) {
                                $array_treatment_name_Lifestyle2[] = $cell_value;
                            }
                        }
                        if (!$ic_no_validator)
                            break;

                        if ($date_flag)
                            break;
                    }

                    //print_r($array_IC_no_Lifestyles2);
                    //print_r($array_studies_name_Lifestyle2);

                    for ($i = 0; $i < sizeof($array_IC_no_Lifestyles2); $i++) {
                        $val_ic_no = in_array($array_IC_no_Lifestyles2[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name_Lifestyle2[$i], $result_studies_name);

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
                    for ($i = 0; $i < sizeof($array_treatment_name_Lifestyle2); $i++) {
                        $val_treatment_name = in_array($array_treatment_name_Lifestyle2[$i], $result_treatment_name);

                        if (!$val_treatment_name) {
                            echo 'Should ommit import for invalid treatment_name data at Lifestyle2 worksheet' . '<br/>';
                            $abort = TRUE;
                            break;
                        }
                    }
                    $array_studies_name_Lifestyle2 = null;
                    $array_treatment_name_Lifestyle2 = null;	
                    $array_IC_no_Lifestyles2 = null;		
                    $temp_result_treatment_name = null;
                    $result_treatment_name = null;
                    
                } else if ($loadedSheetName == 'Lifestyle3') {
                    $array_studies_name_Lifestyle3 = array();
                    $array_studies_name_Lifestyle3 = null;
                    $array_IC_no_Lifestyles3 = array();
                    $array_IC_no_Lifestyles3 = null;

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
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
                                $ic_no_validator = $this->check_IC_NO($cell_value);
                                if (!$ic_no_validator) {
                                    echo '<h2>patient_IC_no is not in appropriate format at Lifestyle3' . '  row ' . $i . '</h2>';
                                    $abort = TRUE;
                                    break;
                                }
                                $array_IC_no_Lifestyles3[] = $cell_value;
                            }

                            if ($key == 1 && $cell_value != NULL) {
                                $array_studies_name_Lifestyle3[] = $cell_value;
                            }

                            if ($key == 4 && $cell_value != NULL) {
                                if (strpos($cell_value, '-') !== FALSE)
                                    $cell_value = date("d/m/Y", strtotime($cell_value));
                                list($day, $month, $year) = explode("/", $cell_value);

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
                    //print_r($array_studies_name_Lifestyle3);

                    for ($i = 0; $i < sizeof($array_IC_no_Lifestyles3); $i++) {
                        $val_ic_no = in_array($array_IC_no_Lifestyles3[$i], $array_IC_no);
                        //echo $val . '<br/>';
                        $val_studies_id = in_array($array_studies_name_Lifestyle3[$i], $result_studies_name);

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
                    $array_studies_name_Lifestyle3 = null;
                    $array_IC_no_Lifestyles3 = null;
                }
        }



        //checking ends at above
        if (!$abort) {
            $temp_array_IC_no_db = array();
            $temp_array_IC_no_db = null;
            $this->db->select('ic_no');
            $this->db->from('patient');
            $temp_array_IC_no_db = $this->db->get()->result_array();

            $array_IC_no_db = array();
            //$array_IC_no_db = null;
            for ($i = 0; $i < sizeof($temp_array_IC_no_db); $i++) {
                //echo $result_relationship[$j]['relatives_type']. '<br/>';
                $array_IC_no_db[$i] = $temp_array_IC_no_db[$i]['ic_no'];
                //echo $result_studies_name[$i] . '<br/>';
            }
            //print_r($array_IC_no_db);
            foreach ($loadedSheetNames as $sheetIndex => $loadedSheetName) {
                $objPHPExcel->setActiveSheetIndex($sheetIndex);
                $sheet = $objPHPExcel->getActiveSheet();
                echo '<pre>';
                $i = 0;

                if ($loadedSheetName == 'Personal') {
                    $row_skip_flag = FALSE;
                    $data_patient = array();
                    $data_patient = null;
                    $data_patient_update = array();
                    $data_patient_hospital_no_update = array();
                    $data_patient_hospital_no_update = null;
                    $data_patient_update = null;
                    $data_patient_hospital_no_update = array();
                    $data_patient_hospital_no_update = null;
                    $data_patient_private_no_update = array();
                    $data_patient_private_no_update = null;
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
                    $data_patient_private_no = array();
                    $data_patient_private_no = null;
                    $data_patient_cogs_studies = array();
                    $data_patient_cogs_studies = null;
                    $data_patient_contact_person = array();
                    $data_patient_contact_person = null;
                    $data_patient_relatives_summary = array();
                    $data_patient_relatives_summary = null;
                    $data_patient_survival_status = array();
                    $data_patient_survival_status = null;
                    $old_ic_no = NULL;
                    
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp1 = array();
                        $temp1 = null;
                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();

                            /* if ($key == 0 && $cell_value == NULL) {
                              $row_skip_flag = TRUE;
                              } */
                            //echo $key; // 0, 1, 2..
                            if ($key == 5 && $cell_value != NULL) {
                                $old_ic_no = $cell_value;
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
                            }
                            if ($key == 8 || $key == 13 || $key == 48) {
                                if ($cell_value != NULL) {
                                    $cell_value = date('Y-m-d', strtotime(str_replace('/', '-', $cell_value)));
                                }
                            }

                            $temp1[] = $cell_value;
                            //echo $cell_value . '    ';
                        }

                        /* if ($row_skip_flag == TRUE) {
                          $row_skip_flag = FALSE;
                          continue;
                          } */

                        $array_IC_no[] = $temp1[5];

                        if ($temp1[12] == 'Yes' || $temp1[12] == 'yes')
                            $is_dead = TRUE;
                        else if ($temp1[12] == 'No' || $temp1[12] == 'no')
                            $is_dead = FALSE;
                        else
                            $is_dead = 2;

                        if ($temp1[47] == 'Alive' || $temp1[47] == 'alive')
                            $alive_status = TRUE;
                        else if ($temp1[47] == 'Dead' || $temp1[47] == 'dead')
                            $alive_status = FALSE;
                        else
                            $alive_status = 2;

                        $val_ic_no_db = in_array($temp1[5], $array_IC_no_db);

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
                                'comment' => $temp1[36],
                                'is_dead' => $is_dead,
                                'd_o_d' => $temp1[13],
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
                            $data_patient_hospital_no_update[] = array(
                                'patient_ic_no' => $temp1[5],
                                'hospital_no' => $temp1[15],
                                'created_on' => $created_date
                            );

                            $data_patient_private_no_update[] = array(
                                'patient_ic_no' => $temp1[5],
                                'private_no' => $temp1[16],
                                'created_on' => $created_date
                            );

                            $data_patient_cogs_studies_update[] = array(
                                'patient_ic_no' => $temp1[5],
                                'COGS_studies_name' => $temp1[17],
                                'COGS_studies_no' => $temp1[18],
                                'created_on' => $created_date
                            );

                            $data_patient_contact_person_update[] = array(
                                'patient_ic_no' => $temp1[5],
                                'contact_name' => $temp1[33],
                                'contact_relationship' => $temp1[35],
                                'contact_telephone' => $temp1[34],
                                'created_on' => $created_date
                            );

                            $data_patient_relatives_summary_update[] = array(
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
                                'created_on' => $created_date
                            );

                            $data_patient_survival_status_update[] = array(
                                'patient_ic_no' => $temp1[5],
                                'source' => $temp1[46],
                                'alive_status' => $alive_status,
                                'status_gathering_date' => $temp1[48],
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
                                'comment' => $temp1[36],
                                'is_dead' => $is_dead,
                                'd_o_d' => $temp1[13],
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
                                'created_on' => $created_date
                            );

                            $data_patient_survival_status[] = array(
                                'patient_ic_no' => $temp1[5],
                                'source' => $temp1[46],
                                'alive_status' => $alive_status,
                                'status_gathering_date' => $temp1[48],
                                'created_on' => $created_date
                            );
                        }
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

                    if (sizeof($data_patient) > 0 && sizeof($data_patient_hospital_no) > 0 && sizeof($data_patient_private_no) > 0 && sizeof($data_patient_cogs_studies) > 0 && sizeof($data_patient_contact_person) > 0 && sizeof($data_patient_relatives_summary) > 0 && sizeof($data_patient_survival_status) > 0) {
                        $id_data_patient = $this->excell_sheets_model->insert_record($data_patient, 'patient');
                        //echo 'inserted_id     '.$id_data_patient;
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
                    }

                    if (sizeof($data_patient_update) > 0 && sizeof($data_patient_hospital_no_update) > 0 && sizeof($data_patient_private_no_update) > 0 && sizeof($data_patient_cogs_studies_update) > 0 && sizeof($data_patient_contact_person_update) > 0 && sizeof($data_patient_relatives_summary_update) > 0 && sizeof($data_patient_survival_status_update) > 0) {
                        $id_data_patient = $this->db->update_batch('patient', $data_patient_update, 'ic_no');
                        //echo 'inserted_id     '.$id_data_patient;
                        if ($id_data_patient > 0)
                            echo 'Data updated succesfully at patient table';
                        else
                            echo 'Updated Data at patient table';
                        echo '<br/>';

                        $id_data_patient_hospital_no = $this->db->update_batch('patient_hospital_no', $data_patient_hospital_no_update, 'patient_ic_no');

                        if ($id_data_patient_hospital_no > 0)
                            echo 'Data updated succesfully at patient_hospital_no table';
                        else
                            echo 'Updated Data at patient_hospital_no table';
                        echo '<br/>';

                        $id_data_patient_private_no = $this->db->update_batch('patient_private_no', $data_patient_private_no_update, 'patient_ic_no');
                        if ($id_data_patient_private_no > 0)
                            echo 'Data updated succesfully at patient_private_no table';
                        else
                            echo 'Updated Data at patient_private_no table';
                        echo '<br/>';

                        $id_data_patient_cogs_studies = $this->db->update_batch('patient_cogs_studies', $data_patient_cogs_studies_update, 'patient_ic_no');

                        if ($id_data_patient_cogs_studies > 0)
                            echo 'Data updated succesfully at patient_cogs_studies table';
                        else
                            echo 'Updated Data at patient_cogs_studies table';
                        echo '<br/>';

                        $id_data_patient_contact_person = $this->db->update_batch('patient_contact_person', $data_patient_contact_person_update, 'patient_ic_no');
                        if ($id_data_patient_contact_person > 0)
                            echo 'Data updated succesfully at patient_contact_person table';
                        else
                            echo 'Updated Data at patient_contact_person table';
                        echo '<br/>';

                        $id_data_patient_relatives_summary = $this->db->update_batch('patient_relatives_summary', $data_patient_relatives_summary_update, 'patient_ic_no');

                        if ($id_data_patient_relatives_summary > 0)
                            echo 'Data updated succesfully at patient_relatives_summary table';
                        else
                            echo 'Updated Data at patient_relatives_summary table';
                        echo '<br/>';

                        $id_data_patient_survival_status = $this->db->update_batch('patient_survival_status', $data_patient_survival_status_update, 'patient_ic_no');

                        if ($id_data_patient_survival_status > 0)
                            echo 'Data updated succesfully at patient_survival_status table';
                        else
                            echo 'Updated Data at patient_survival_status table';
                        echo '<br/>';
                    }
                    $data_patient = null;
                    $data_patient_update = null;
                    $temp1 = null;
                    $data_patient_hospital_no_update = null;
                    $data_patient_private_no_update = null;
                    $data_patient_cogs_studies_update = null;
                    $data_patient_contact_person_update = null;
                    $data_patient_relatives_summary_update = null;
                    $data_patient_survival_status_update = null;

                    $data_patient_hospital_no = null;
                    $data_patient_private_no = null;
                    $data_patient_cogs_studies = null;
                    $data_patient_contact_person = null;
                    $data_patient_relatives_summary = null;
                    $data_patient_survival_status = null;
                }
                else if (($loadedSheetName == 'Family')) {
                    $data_patient_relatives = array();
                    $data_patient_relatives = null;
                    $temp_ic_no = NULL;
                    $data_patient_relatives_update = array();
                    $data_patient_relatives_update = null;
                    $i = 0;
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp2 = array();
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

                            if ($key == 9 || $key == 11 || $key == 13) {
                                if ($cell_value != NULL) {
                                    $cell_value = date('Y-m-d', strtotime(str_replace('/', '-', $cell_value)));
                                }
                            }
                            if ($key == 1 && $cell_value == NULL)
                                $cell_value = 'None';

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

                        $val_ic_no_db = in_array($temp2[0], $array_IC_no_db);

                        if ($val_ic_no_db) {
                            $data_patient_relatives_update[] = array(
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
                    // print_r($data_patient_relatives);
                    if (sizeof($data_patient_relatives) > 0) {
                        $id_data_patient_relatives = $this->excell_sheets_model->insert_record($data_patient_relatives, 'patient_relatives');
                        if ($id_data_patient_relatives > 0)
                            echo 'Data added succesfully at patient_relatives table';
                        else
                            echo 'Failed to insert at patient_relatives table';
                        echo '<br/>';
                    }


                    if (sizeof($data_patient_relatives_update) > 0) {
                        $id_data_patient_relatives = $this->db->update_batch('patient_relatives', $data_patient_relatives_update, 'patient_ic_no');
                        if ($id_data_patient_relatives > 0)
                            echo 'Data updated succesfully at patient_relatives table';
                        else
                            echo 'Updated Data at patient_relatives table';
                        echo '<br/>';
                    }
                    
                    $data_patient_relatives = null;
                    $data_patient_relatives_update = null;
                }
                else if ($loadedSheetName == 'Personal2') {
                    $data_patient_studies_update = array();
                    $data_patient_studies_update = null;
                    $data_patient_studies = array();
                    $data_patient_studies = null;
                    
                    $i = 0;
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp3 = array();
                        $temp3 = null;
                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();
                            if ($key == 0 && $cell_value != NULL) {
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
                            }

                            if ($key == 2) {
                                if ($cell_value != NULL) {
                                    $cell_value = date('Y-m-d', strtotime(str_replace('/', '-', $cell_value)));
                                }
                            }
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
                        //echo $temp3[0].'<br/>';

                        $val_ic_no_db = in_array($temp3[0], $array_IC_no_db);

                        if ($val_ic_no_db) {
                            $data_patient_studies_update[] = array(
                                'patient_ic_no' => $temp3[0],
                                'studies_id' => $studies_id,
                                'date_at_consent' => $temp3[2],
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
                                'relation_to_study' => $relations_to_study_flag,
                                'referral_to' => $temp3[9],
                                'referral_to_genetic_counselling' => $temp3[10],
                                'referral_source' => $temp3[11],
                                'created_on' => $created_date
                            );
                        }
                        $temp3 = null;
                    }
                    //print_r($data_patient_studies);
                    if (sizeof($data_patient_studies) > 0) {
                        $id_data_patient_studies = $this->excell_sheets_model->insert_record($data_patient_studies, 'patient_studies');
                        if ($id_data_patient_studies > 0)
                            echo 'Data added succesfully at patient_studies table';
                        else
                            echo 'Failed to insert at patient_studies table';
                        echo '<br/>';
                    }


                    if (sizeof($data_patient_studies_update) > 0) {
                        $id_data_patient_studies = $this->db->update_batch('patient_studies', $data_patient_studies_update, 'patient_ic_no');
                        if ($id_data_patient_studies > 0)
                            echo 'Data updated succesfully at patient_studies table';
                        else
                            echo 'Updated Datad at patient_studies table';
                        echo '<br/>';
                    }
                    
                    $data_patient_studies = null;
                    $data_patient_studies_update = null;
                    
                }
                else if ($loadedSheetName == 'Diagnosis & Treatment') {
                    $data_patient_cancer_insert = array();
                    $data_patient_cancer_insert = null;
                    $data_patient_cancer_update = array();
                    $data_patient_cancer_update = null;
                    $data_patient_pathology = array();
                    $data_patient_pathology = null;
                    $temp_cancer_name = NULL;
                    $temp_cancer_site_name = NULL;
                    $temp_studies_name = NULL;

                    $temp_patient_ic_no = array();
                    $temp_patient_ic_no = null;
                    $treatment_patient_studies_id = array();
                    $treatment_patient_studies_id = null;
                    $pathology_patient_studies_id = array();
                    $pathology_patient_studies_id = null;
                    $treatment_cancer_id = array();
                    $treatment_cancer_id = null;
                    $pathology_cancer_id = array();
                    $pathology_cancer_id = null;
                    $treatment_cancer_site_id = array();
                    $treatment_cancer_site_id = null;
                    $pathology_cancer_site_id = array();
                    $pathology_cancer_site_id = null;
                    $data_patient_cancer_treatment = array();
                    $data_patient_cancer_treatment = null;
                    $flag_ic_no = FALSE;
                    $flag_cancer_name = FALSE;
                    $flag_cancer_site_name = FALSE;
                    $flag_studies_name = FALSE;
                    $flag_treatment_name = FALSE;
                    $flag_pathology_tissue_site = FALSE;
                    
                    $temp_pt_studies_id_pt_cancer = array();
                    $temp_pt_studies_id_pt_cancer = null;
                    $this->db->select('patient_studies_id');
                    $this->db->from('patient_cancer');
                    $temp_pt_studies_id_pt_cancer = $this->db->get()->result_array();

                    //print_r($temp_pt_risk_reduc_surgery_id_pt_risk_red_surgery_lesion);
                    $result_pt_studies_id_pt_cancer = array();
                    for ($i = 0; $i < sizeof($temp_pt_studies_id_pt_cancer); $i++) {
                        $result_pt_studies_id_pt_cancer [$i] = $temp_pt_studies_id_pt_cancer[$i]['patient_studies_id'];
                    }
                    
                    $temp_pt_cancer_id_pt_cancer = array();
                    $temp_pt_cancer_id_pt_cancer = null;
                    $this->db->select('cancer_id');
                    $this->db->from('patient_cancer');
                    $temp_pt_cancer_id_pt_cancer = $this->db->get()->result_array();

                    //print_r($temp_pt_risk_reduc_surgery_id_pt_risk_red_surgery_lesion);
                    $result_pt_cancer_id_pt_cancer = array();
                    for ($i = 0; $i < sizeof($temp_pt_cancer_id_pt_cancer); $i++) {
                        $result_pt_cancer_id_pt_cancer [$i] = $temp_pt_cancer_id_pt_cancer[$i]['cancer_id'];
                    }
                    
                    $temp_pt_cancer_site_id_pt_cancer = array();
                    $temp_pt_cancer_site_id_pt_cancer = null;
                    $this->db->select('cancer_site_id');
                    $this->db->from('patient_cancer');
                    $temp_pt_cancer_site_id_pt_cancer = $this->db->get()->result_array();

                    //print_r($temp_pt_risk_reduc_surgery_id_pt_risk_red_surgery_lesion);
                    $result_pt_cancer_site_id_pt_cancer = array();
                    for ($i = 0; $i < sizeof($temp_pt_cancer_site_id_pt_cancer); $i++) {
                        $result_pt_cancer_site_id_pt_cancer [$i] = $temp_pt_cancer_site_id_pt_cancer[$i]['cancer_site_id'];
                    }
                    
                    $temp_pt_cancer_id_pt_cancer_treatment = array();
                    $temp_pt_cancer_id_pt_cancer_treatment = null;
                    $this->db->select('patient_cancer_id');
                    $this->db->from('patient_cancer_treatment');
                    $temp_pt_cancer_id_pt_cancer_treatment = $this->db->get()->result_array();

                    //print_r($temp_pt_risk_reduc_surgery_id_pt_risk_red_surgery_lesion);
                    $result_pt_cancer_id_pt_cancer_treatment = array();
                    for ($i = 0; $i < sizeof($temp_pt_cancer_id_pt_cancer_treatment); $i++) {
                        $result_pt_cancer_id_pt_cancer_treatment [$i] = $temp_pt_cancer_id_pt_cancer_treatment[$i]['patient_cancer_id'];
                    }

                    $temp_pt_cancer_id_pt_pathology = array();
                    $temp_pt_cancer_id_pt_pathology = null;
                    $this->db->select('patient_cancer_id');
                    $this->db->from('patient_pathology');
                    $temp_pt_cancer_id_pt_pathology = $this->db->get()->result_array();

                    //print_r($temp_pt_risk_reduc_surgery_id_pt_risk_red_surgery_lesion);
                    $result_pt_cancer_id_pt_pathology = array();
                    for ($i = 0; $i < sizeof($temp_pt_cancer_id_pt_pathology); $i++) {
                        $result_pt_cancer_id_pt_pathology [$i] = $temp_pt_cancer_id_pt_pathology[$i]['patient_cancer_id'];
                    }
                    $i = 0;
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp14 = array();
                        $temp14 = null;
                        foreach ($cellIterator as $key => $cell) {
                            $cell_value = $cell->getFormattedValue();

                            if ($key == 0 && $cell_value != NULL) {
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
                            }

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

                            if ($key == 3 && $cell_value != NULL) {
                                $cell_value = trim($cell_value);
                                $temp_cancer_site_name = $cell_value;
                            }
                            if ($key == 3 && $cell_value == NULL) {
                                $cell_value = 'None';
                            }

                            if ($key == 13 && $cell_value == NULL) {
                                $cell_value = 'None';
                            }

                            if ($key == 26 && $cell_value == NULL) {
                                $cell_value = 'None';
                                //$flag_pathology_tissue_site = TRUE;
                            }

                            if ($key == 6 || $key == 14 || $key == 15 || $key == 28) {
                                if ($cell_value != NULL) {
                                    $cell_value = date('Y-m-d', strtotime(str_replace('/', '-', $cell_value)));
                                }
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

                        if (!$flag_cancer_name) 
                        {
                            $cancer_id = $this->excell_sheets_model->get_id('cancer', 'cancer_id', 'cancer_name', $temp14[2]);
                            $cancer_site_id = $this->excell_sheets_model->get_id('cancer_site', 'cancer_site_id', 'cancer_site_name', $temp14[3]);
                            
                            if(in_array($patient_studies_id, $result_pt_studies_id_pt_cancer)  
                                && in_array($cancer_id, $result_pt_cancer_id_pt_cancer) && in_array($cancer_site_id, $result_pt_cancer_site_id_pt_cancer))
                            {
                                $data_patient_cancer_update = array(
                                'patient_studies_id' => $patient_studies_id,
                                'cancer_id' => $cancer_id,
                                'cancer_site_id' => $cancer_site_id,
                                'cancer_invasive_type' => $temp14[4],
                                'is_primary' => $is_primary,
                                'date_of_diagnosis' => $temp14[6],
                                'age_of_diagnosis' => $temp14[7],
                                'diagnosis_center' => $temp14[8],
                                'doctor_name' => $temp14[9],
                                'detected_by' => $temp14[10],
                                'bilateral_flag' => $bilateral_flag,
                                'recurrence_flag' => $recurrence_flag,
                                'created_on' => $created_date
                                );
                                
                                $this->db->where('patient_studies_id', $patient_studies_id);
                                $this->db->where('cancer_id', $cancer_id);
                                $this->db->where('cancer_site_id', $cancer_site_id);
                                $this->db->update('patient_cancer', $data_patient_cancer_update);

                                $data_patient_cancer_update = null;
                            }
                            else
                            {
                                $data_patient_cancer_insert[] = array(
                                'patient_studies_id' => $patient_studies_id,
                                'cancer_id' => $cancer_id,
                                'cancer_site_id' => $cancer_site_id,
                                'cancer_invasive_type' => $temp14[4],
                                'is_primary' => $is_primary,
                                'date_of_diagnosis' => $temp14[6],
                                'age_of_diagnosis' => $temp14[7],
                                'diagnosis_center' => $temp14[8],
                                'doctor_name' => $temp14[9],
                                'detected_by' => $temp14[10],
                                'bilateral_flag' => $bilateral_flag,
                                'recurrence_flag' => $recurrence_flag,
                                'created_on' => $created_date
                                );
                            }

                        }
                        $flag_cancer_name = FALSE;

                        //if (!$flag_treatment_name)  {
                        $cancer_id = $this->excell_sheets_model->get_id('cancer', 'cancer_id', 'cancer_name', $temp14[2]);
                        $cancer_site_id = $this->excell_sheets_model->get_id('cancer_site', 'cancer_site_id', 'cancer_site_name', $temp14[3]);
                        $treatment_patient_studies_id[] = $patient_studies_id;
                        $treatment_cancer_id[] = $cancer_id;
                        $treatment_cancer_site_id[] = $cancer_site_id;

                        $treatment_id = $this->excell_sheets_model->get_id('treatment', 'treatment_id', 'treatment_name', $temp14[13]);

                        $data_patient_cancer_treatment[] = array(
                            'treatment_id' => $treatment_id,
                            'patient_cancer_id' => 1,
                            'treatment_start_date' => $temp14[14],
                            'treatment_end_date' => $temp14[15],
                            'treatment_durations' => $temp14[16],
                            'comments' => $temp14[17],
                            'created_on' => $created_date,
                            'treatment_details' => $temp14[18],
                            'treatment_dose' => $temp14[19],
                            'treatment_cycle' => $temp14[20],
                            'treatment_frequency' => $temp14[21],
                            'treatment_visidual_desease' => $temp14[22],
                            'treatment_primary_outcome' => $temp14[23],
                            'treatment_cal125_pretreatment' => $temp14[24],
                            'treatment_cal125_posttreatment' => $temp14[25]
                        );

                        $flag_treatment_name = FALSE;

                        //if (!$flag_pathology_tissue_site)  {
                        $cancer_site_id = $this->excell_sheets_model->get_id('cancer_site', 'cancer_site_id', 'cancer_site_name', $temp14[3]);
                        $pathology_patient_studies_id[] = $patient_studies_id;
                        $pathology_cancer_id[] = $cancer_id;
                        $pathology_cancer_site_id[] = $cancer_site_id;
                        $cancer_id = $this->excell_sheets_model->get_id('cancer', 'cancer_id', 'cancer_name', $temp14[2]);

                        $data_patient_pathology[] = array(
                            'cancer_id' => $cancer_id,
                            'tissue_site' => $temp14[26],
                            'type_of_report' => $temp14[27],
                            'date_of_report' => $temp14[28],
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
                    //echo '<pre>';
                    //print_r($data_patient_cancer_insert);
                    //print_r($data_patient_cancer_treatment);
                    //print_r($data_patient_pathology);
                    //print_r($treatment_patient_studies_id);
                    //print_r($treatment_cancer_id);
                    //print_r($treatment_cancer_site_id);
                    //print_r($pathology_patient_studies_id);
                    //print_r($pathology_cancer_id);
                    //print_r($pathology_cancer_site_id);
                    
                    if(sizeof($data_patient_cancer_insert) > 0)
                    {
                        $id_data_patient_cancer = $this->excell_sheets_model->insert_record($data_patient_cancer_insert, 'patient_cancer');
                        if ($id_data_patient_cancer > 0)
                            echo 'Data added succesfully at patient_cancer table';
                        else
                            echo 'Failed to insert at patient_cancer table';
                        echo '<br/>'; 
                    }


                    $tempLen = sizeof($data_patient_cancer_treatment);
                    
                    $data_patient_cancer_treatment_update = array();
                    $data_patient_cancer_treatment_update = null;
                    $data_patient_cancer_treatment_insert = array();
                    $data_patient_cancer_treatment_insert = null;
                    for ($key = 0; $key < $tempLen; $key++) {
                        //echo $treatment_patient_studies_id[$key].'      '.$treatment_cancer_id[$key].'      '.$treatment_cancer_site_id[$key].'<br/>';
                        $patient_cancer_id = $this->excell_sheets_model->get_patient_cancer_id($treatment_patient_studies_id[$key], $treatment_cancer_id[$key], $treatment_cancer_site_id[$key]);
                        $data_patient_cancer_treatment[$key]['patient_cancer_id'] = $patient_cancer_id;
                        //echo "before if: "; 
                        //print_r($data_patient_cancer_treatment[$key]);
                        if($patient_cancer_id > 0 && in_array($patient_cancer_id, $result_pt_cancer_id_pt_cancer_treatment))
                        {
                            //echo "update : ";print_r($data_patient_cancer_treatment[$key]);
                            $data_patient_cancer_treatment_update[] = $data_patient_cancer_treatment[$key];
                        }
                        else if($patient_cancer_id > 0)
                        {
                            //echo "insert : "; print_r($data_patient_cancer_treatment[$key]);
                            $data_patient_cancer_treatment_insert[] = $data_patient_cancer_treatment[$key];
                        }
                    }

                     //print_r($data_patient_cancer_treatment);
                    //print_r($data_patient_cancer_treatment_update);
                    $data_patient_pathology_update = array();
                    $data_patient_pathology_update = null;
                    $data_patient_pathology_insert = array();
                    $data_patient_pathology_insert = null;
                    
                    $tempLength = sizeof($data_patient_pathology);

                    for ($key = 0; $key < $tempLength; $key++) {
                        //echo $treatment_patient_studies_id[$key].'      '.$treatment_cancer_id[$key].'      '.$treatment_cancer_site_id[$key].'<br/>';
                        $patient_cancer_id = $this->excell_sheets_model->get_patient_cancer_id($pathology_patient_studies_id[$key], $pathology_cancer_id[$key], $pathology_cancer_site_id[$key]);
                        $data_patient_pathology[$key]['patient_cancer_id'] = $patient_cancer_id;
                        
                        if($patient_cancer_id > 0 && in_array($patient_cancer_id, $result_pt_cancer_id_pt_pathology))
                        {
                            $data_patient_pathology_update[] = $data_patient_pathology[$key];
                        }
                        else if($patient_cancer_id > 0)
                        {
                            $data_patient_pathology_insert[] = $data_patient_pathology[$key];
                        }
                    }
                    //print_r($data_patient_pathology);
                    if(sizeof($data_patient_cancer_treatment_insert) > 0)
                    {
                       // print_r($data_patient_cancer_treatment_insert);
                        $id_patient_cancer_treatment = $this->excell_sheets_model->insert_record($data_patient_cancer_treatment_insert, 'patient_cancer_treatment');
                        if ($id_patient_cancer_treatment > 0)
                            echo 'Data added succesfully at patient_cancer_treatment table';
                        else
                            echo 'Failed to insert at patient_cancer_treatment table';
                        echo '<br/>'; 
                    }
                    
                     if(sizeof($data_patient_cancer_treatment_update) > 0)
                    {
                        $id_patient_cancer_treatment = $this->db->update_batch('patient_cancer_treatment',$data_patient_cancer_treatment_update,'patient_cancer_id');
                        if ($id_patient_cancer_treatment > 0)
                            echo 'Data updated succesfully at patient_cancer_treatment table';
                        else
                            echo 'Updated Data at patient_cancer_treatment table';
                        echo '<br/>'; 
                    }

                    if(sizeof($data_patient_pathology_insert) > 0)
                    {
                        $id_patient_pathology = $this->excell_sheets_model->insert_record($data_patient_pathology_insert, 'patient_pathology');
                        if ($id_patient_pathology > 0)
                            echo 'Data added succesfully at patient_pathology table';
                        else
                            echo 'Failed to insert at patient_pathology table';
                        echo '<br/>';
                    }
                    
                     if(sizeof($data_patient_pathology_update) > 0)
                    {
                        $id_patient_pathology = $this->db->update_batch('patient_pathology',$data_patient_pathology_update,'patient_cancer_id');
                        if ($id_patient_pathology > 0)
                            echo 'Data updated succesfully at patient_pathology table';
                        else
                            echo 'Updated Data at patient_pathology table';
                        echo '<br/>';
                    }
                    
                    $data_patient_cancer_insert = null;
                    $temp_patient_ic_no = null;
                    $treatment_patient_studies_id = null;
                    $pathology_patient_studies_id = null;
                    $treatment_cancer_id = null;
                    $pathology_cancer_id = null;
                    $treatment_cancer_site_id = null;
                    $pathology_cancer_site_id = null;
                    $data_patient_cancer_treatment = null;
                    $temp_pt_studies_id_pt_cancer = null;
                    $result_pt_studies_id_pt_cancer = null;
                    $temp_pt_cancer_id_pt_cancer = null;
                    $result_pt_cancer_id_pt_cancer = null;
                    $temp_pt_cancer_site_id_pt_cancer = null;
                    $result_pt_cancer_site_id_pt_cancer = null;
                    $temp_pt_cancer_id_pt_cancer_treatment = null;
                    $result_pt_cancer_id_pt_cancer_treatment = null;
                    $temp_pt_cancer_id_pt_pathology = null;
                    $result_pt_cancer_id_pt_pathology = null;
                    $temp14 = null;
                    $data_patient_cancer_update = null;
                    $data_patient_cancer_insert = null;
                    $treatment_patient_studies_id = null;
                    $treatment_cancer_id = null;
                    $treatment_cancer_site_id = null;
                    $data_patient_cancer_treatment = null;
                    $pathology_patient_studies_id = null;
                    $pathology_cancer_id = null;
                    $pathology_cancer_site_id = null;
                    $data_patient_pathology = null;
                    $data_patient_cancer_treatment_update = null;
                    $data_patient_cancer_treatment_insert = null;
                    $data_patient_pathology_update = null;
                    $data_patient_pathology_insert = null;

                }else if (($loadedSheetName == 'Diagnosis & Treatment2')) {
                    $data_patient_other_disease = array();
                    $data_patient_other_disease = null;
                    $data_patient_other_disease_update = array();
                    $data_patient_other_disease_update = null;
                    $data_patient_other_disease_medication = array();
                    $data_patient_other_disease_medication = null;
                    
                    $temp_pt_studies_id_pt_other_disease = array();
                    $temp_pt_studies_id_pt_other_disease = null;
                    $this->db->select('patient_studies_id');
                    $this->db->from('patient_other_disease');
                    $temp_pt_studies_id_pt_other_disease = $this->db->get()->result_array();

                    //print_r($temp_pt_risk_reduc_surgery_id_pt_risk_red_surgery_lesion);
                    $result_pt_studies_id_pt_other_disease = array();
                    for ($i = 0; $i < sizeof($temp_pt_studies_id_pt_other_disease); $i++) {
                        $result_pt_studies_id_pt_other_disease [$i] = $temp_pt_studies_id_pt_other_disease[$i]['patient_studies_id'];
                    }
                    
                    $temp_pt_diagnosis_id_pt_other_disease = array();
                    $temp_pt_diagnosis_id_pt_other_disease = null;
                    $this->db->select('diagnosis_id');
                    $this->db->from('patient_other_disease');
                    $temp_pt_diagnosis_id_pt_other_disease = $this->db->get()->result_array();

                    //print_r($temp_pt_risk_reduc_surgery_id_pt_risk_red_surgery_lesion);
                    $result_pt_diagnosis_id_pt_other_disease = array();
                    for ($i = 0; $i < sizeof($temp_pt_diagnosis_id_pt_other_disease); $i++) {
                        $result_pt_diagnosis_id_pt_other_disease [$i] = $temp_pt_diagnosis_id_pt_other_disease[$i]['diagnosis_id'];
                    }
                    
                    $temp_pt_other_dis_id_pt_other_dis_medic = array();
                    $temp_pt_other_dis_id_pt_other_dis_medic = null;
                    $this->db->select('patient_other_disease_id');
                    $this->db->from('patient_other_disease_medication');
                    $temp_pt_other_dis_id_pt_other_dis_medic = $this->db->get()->result_array();

                    //print_r($temp_pt_risk_reduc_surgery_id_pt_risk_red_surgery_lesion);
                    $result_pt_other_dis_id_pt_other_dis_medic = array();
                    for ($i = 0; $i < sizeof($temp_pt_other_dis_id_pt_other_dis_medic); $i++) {
                        $result_pt_other_dis_id_pt_other_dis_medic [$i] = $temp_pt_other_dis_id_pt_other_dis_medic[$i]['patient_other_disease_id'];
                    }
                    
                    $Diagnosis2_patient_studies_id = array();
                    $Diagnosis2_patient_studies_id = null;
                    $Diagnosis2_diagnosis_id = array();
                    $Diagnosis2_diagnosis_id = null;
                    $i = 0;
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp14 = array();
                        $temp14 = null;
                        foreach ($cellIterator as $key => $cell) {
                            $cell_value = $cell->getFormattedValue();

                            if ($key == 0 && $cell_value != NULL)
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);

                            if ($key == 2 && $cell_value == NULL)
                                $cell_value = 'None';

                            if ($key == 2 && $cell_value != NULL)
                                $cell_value = trim($cell_value);
                            //echo $key; // 0, 1, 2..

                            if ($key == 3 || $key == 9 || $key == 10) {
                                if ($cell_value != NULL) {
                                    $cell_value = date('Y-m-d', strtotime(str_replace('/', '-', $cell_value)));
                                }
                            }
                            $temp14[] = $cell_value;
                        }

                        if ($temp14[7] == 'Yes' || $temp14[7] == 'yes')
                            $on_medication_flag = TRUE;
                        else if ($temp14[7] == 'No' || $temp14[7] == 'no')
                            $on_medication_flag = FALSE;
                        else
                            $on_medication_flag = FALSE;

                        $patient_ic_no = $temp14[0]; //echo $patient_ic_no.'          ';
                        $studies_name = $temp14[1]; //echo $studies_name.'           ';
                        $studies_id = $this->excell_sheets_model->get_id('studies', 'studies_id', 'studies_name', $studies_name);
                        $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);
                        $Diagnosis2_patient_studies_id[] = $patient_studies_id;
                        //echo $patient_studies_id.'<br/>';
                        $diagnosis_id = $this->excell_sheets_model->get_id('diagnosis', 'diagnosis_id', 'diagnosis_name', $temp14[2]);
                        $Diagnosis2_diagnosis_id[] = $diagnosis_id;

                        if(in_array($patient_studies_id, $result_pt_studies_id_pt_other_disease)  
                                && in_array($diagnosis_id, $result_pt_diagnosis_id_pt_other_disease))
                        {
                            $data_patient_other_disease_update = array(
                            'patient_studies_id' => $patient_studies_id,
                            'diagnosis_id' => $diagnosis_id,
                            'date_of_diagnosis' => $temp14[3],
                            'diagnosis_age' => $temp14[4],
                            'diagnosis_center' => $temp14[5],
                            'doctor_name' => $temp14[6],
                            'on_medication_flag' => $on_medication_flag,
                            'created_on' => $created_date
                            );
                            
                            $this->db->where('patient_studies_id', $patient_studies_id);
                            $this->db->where('diagnosis_id', $diagnosis_id);
                            $this->db->update('patient_other_disease', $data_patient_other_disease_update); 
                            $data_patient_other_disease_update = null;
                        }
                        else
                        {
                            $data_patient_other_disease[] = array(
                            'patient_studies_id' => $patient_studies_id,
                            'diagnosis_id' => $diagnosis_id,
                            'date_of_diagnosis' => $temp14[3],
                            'diagnosis_age' => $temp14[4],
                            'diagnosis_center' => $temp14[5],
                            'doctor_name' => $temp14[6],
                            'on_medication_flag' => $on_medication_flag,
                            'created_on' => $created_date
                            );
                        }


                        $data_patient_other_disease_medication[] = array(
                            'patient_other_disease_id' => 1,
                            'medication_type' => $temp14[8],
                            'start_date' => $temp14[9],
                            'end_date' => $temp14[10],
                            'duration' => $temp14[11],
                            'comments' => $temp14[12],
                            'created_on' => $created_date
                        );
                    }
                    //print_r($data_patient_other_disease);
                    //print_r($data_patient_other_disease_medication);
                    if(sizeof($data_patient_other_disease) > 0)
                    {
                        $id_patient_other_disease = $this->excell_sheets_model->insert_record($data_patient_other_disease, 'patient_other_disease');
                        if ($id_patient_other_disease > 0)
                            echo 'Data added succesfully at patient_other_disease table';
                        else
                            echo 'Failed to insert at patient_other_disease table';
                        echo '<br/>';  
                    }


                    //have to work here
                    $data_pt_other_dis_medication_update = array();
                    $data_pt_other_dis_medication_update = null;
                    $data_pt_other_dis_medication_insert = array();
                    $data_pt_other_dis_medication_insert = null;
                    
                    $tempLength = sizeof($data_patient_other_disease_medication);

                    for ($key = 0; $key < $tempLength; $key++) {
                        //echo $treatment_patient_studies_id[$key].'      '.$treatment_cancer_id[$key].'      '.$treatment_cancer_site_id[$key].'<br/>';
                        $patient_other_disease_id = $this->excell_sheets_model->get_patient_other_disease_id($Diagnosis2_patient_studies_id[$key], $Diagnosis2_diagnosis_id[$key]);
                        $data_patient_other_disease_medication[$key]['patient_other_disease_id'] = $patient_other_disease_id;
                        if(in_array($patient_other_disease_id, $result_pt_other_dis_id_pt_other_dis_medic))
                        {
                            $data_pt_other_dis_medication_update[] = $data_patient_other_disease_medication[$key];
                        }
                        else
                        {
                           $data_pt_other_dis_medication_insert[] =  $data_patient_other_disease_medication[$key];
                        }
                    }

                    if(sizeof($data_pt_other_dis_medication_insert) > 0)
                    {
                        $id_patient_other_disease_medication = $this->excell_sheets_model->insert_record($data_pt_other_dis_medication_insert, 'patient_other_disease_medication');
                        if ($id_patient_other_disease_medication > 0)
                            echo 'Data added succesfully at patient_other_disease_medication table';
                        else
                            echo 'Failed to insert at patient_other_disease_medication table';
                        echo '<br/>';
                    }
                    
                    if(sizeof($data_pt_other_dis_medication_update) > 0)
                    {
                        $id_patient_other_disease_medication = $this->db->update_batch('patient_other_disease_medication',$data_pt_other_dis_medication_update,'patient_other_disease_id');
                        if ($id_patient_other_disease_medication > 0)
                            echo 'Data updated succesfully at patient_other_disease_medication table';
                        else
                            echo 'Updated Data at patient_other_disease_medication table';
                        echo '<br/>';
                    }
                   
                } else if (($loadedSheetName == 'Sreening and Surveilance1')) {
                    $data_patient_breast_screening = array();
                    $data_patient_breast_screening = null;
                    $data_patient_breast_screening_update = array();
                    $data_patient_breast_screening_update = null;
                    $data_patient_breast_abnormality = array();
                    $data_patient_breast_abnormality = null;
                    $data_patient_ultrasound_abnormality = array();
                    $data_patient_ultrasound_abnormality = null;
                    $data_patient_mri_abnormality = array();
                    $data_patient_mri_abnormality = null;
                    $temp_pt_ic_no_pt_breast_screening = array();
                    $temp_pt_ic_no_pt_breast_screening = null;
                    $this->db->select('patient_ic_no');
                    $this->db->from('patient_breast_screening');
                    $temp_pt_ic_no_pt_breast_screening = $this->db->get()->result_array();

                    //print_r($temp_pt_risk_reduc_surgery_id_pt_risk_red_surgery_lesion);
                    $result_pt_ic_no_pt_breast_screening = array();
                    for ($i = 0; $i < sizeof($temp_pt_ic_no_pt_breast_screening); $i++) {
                        $result_pt_ic_no_pt_breast_screening [$i] = $temp_pt_ic_no_pt_breast_screening[$i]['patient_ic_no'];
                    }
                    
                    $temp_pt_studies_id_pt_breast_screening = array();
                    $temp_pt_studies_id_pt_breast_screening = null;
                    $this->db->select('patient_studies_id');
                    $this->db->from('patient_breast_screening');
                    $temp_pt_studies_id_pt_breast_screening = $this->db->get()->result_array();

                    //print_r($temp_pt_risk_reduc_surgery_id_pt_risk_red_surgery_lesion);
                    $result_pt_studies_id_pt_breast_screening = array();
                    for ($i = 0; $i < sizeof($temp_pt_studies_id_pt_breast_screening); $i++) {
                        $result_pt_studies_id_pt_breast_screening [$i] = $temp_pt_studies_id_pt_breast_screening[$i]['patient_studies_id'];
                    }
                    
                    $temp_pt_brst_scrning_id_pt_bst_abn = array();
                    $temp_pt_brst_scrning_id_pt_bst_abn = null;
                    $this->db->select('patient_breast_screening_id');
                    $this->db->from('patient_breast_abnormality');
                    $temp_pt_brst_scrning_id_pt_bst_abn = $this->db->get()->result_array();

                    //print_r($temp_pt_risk_reduc_surgery_id_pt_risk_red_surgery_lesion);
                    $result_pt_brst_scrning_id_pt_bst_abn = array();
                    for ($i = 0; $i < sizeof($temp_pt_brst_scrning_id_pt_bst_abn); $i++) {
                        $result_pt_brst_scrning_id_pt_bst_abn [$i] = $temp_pt_brst_scrning_id_pt_bst_abn[$i]['patient_breast_screening_id'];
                    }
                    
                    $temp_pt_brst_scrning_id_pt_ultrad_abn = array();
                    $temp_pt_brst_scrning_id_pt_ultrad_abn = null;
                    $this->db->select('patient_breast_screening_id');
                    $this->db->from('patient_ultrasound_abnormality');
                    $temp_pt_brst_scrning_id_pt_ultrad_abn = $this->db->get()->result_array();

                    //print_r($temp_pt_risk_reduc_surgery_id_pt_risk_red_surgery_lesion);
                    $result_pt_brst_scrning_id_pt_ultrad_abn = array();
                    for ($i = 0; $i < sizeof($temp_pt_brst_scrning_id_pt_ultrad_abn); $i++) {
                        $result_pt_brst_scrning_id_pt_ultrad_abn [$i] = $temp_pt_brst_scrning_id_pt_ultrad_abn[$i]['patient_breast_screening_id'];
                    }
                    
                    //print_r($result_pt_brst_scrning_id_pt_ultrad_abn);
                    $temp_pt_brst_scrning_id_pt_mri_abn = array();
                    $temp_pt_brst_scrning_id_pt_mri_abn = null;
                    $this->db->select('patient_breast_screening_id');
                    $this->db->from('patient_mri_abnormality');
                    $temp_pt_brst_scrning_id_pt_mri_abn = $this->db->get()->result_array();

                    //print_r($temp_pt_risk_reduc_surgery_id_pt_risk_red_surgery_lesion);
                    $result_pt_brst_scrning_id_pt_mri_abn = array();
                    for ($i = 0; $i < sizeof($temp_pt_brst_scrning_id_pt_mri_abn); $i++) {
                        $result_pt_brst_scrning_id_pt_mri_abn [$i] = $temp_pt_brst_scrning_id_pt_mri_abn[$i]['patient_breast_screening_id'];
                    }
                    
                    $temp_patient_ic_no_survelance = array();
                    $temp_patient_ic_no_survelance = null;
                    $temp_patient_studies_id = array();
                    $temp_patient_studies_id = null;
                    $i = 0;
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp4 = array();
                        $temp4 = null;
                        foreach ($cellIterator as $key => $cell) {

                            $cell_value = $cell->getFormattedValue();

                            if ($key == 0 && $cell_value != NULL)
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
                            //echo $key; // 0, 1, 2..
                            if ($key == 2 || $key == 4 || $key == 21 || $key == 27) {
                                if ($cell_value != NULL) {
                                    $cell_value = date('Y-m-d', strtotime(str_replace('/', '-', $cell_value)));
                                }
                            }
                            $temp4[] = $cell_value;
                        }


                        if ($temp4[mammo_abnormality_flag] == 'Yes' || $temp4[mammo_abnormality_flag] == 'yes')
                            $abnormality_mammo_flag = TRUE;
                        else if ($temp4[mammo_abnormality_flag] == 'No' || $temp4[mammo_abnormality_flag] == 'no')
                            $abnormality_mammo_flag = FALSE;
                        else
                            $abnormality_mammo_flag = FALSE;

                        if ($temp4[had_ultrasound_flag] == 'Yes' || $temp4[had_ultrasound_flag] == 'yes')
                            $had_ultrasound_flag = TRUE;
                        else if ($temp4[had_ultrasound_flag] == 'No' || $temp4[had_ultrasound_flag] == 'no')
                            $had_ultrasound_flag = FALSE;
                        else
                            $had_ultrasound_flag = FALSE;

                        if ($temp4[ultrasound_abnormalities_flag] == 'Yes' || $temp4[ultrasound_abnormalities_flag] == 'yes')
                            $abnormality_ultrasound_flag = TRUE;
                        else if ($temp4[ultrasound_abnormalities_flag] == 'No' || $temp4[ultrasound_abnormalities_flag] == 'no')
                            $abnormality_ultrasound_flag = FALSE;
                        else
                            $abnormality_ultrasound_flag = FALSE;

                        if ($temp4[had_mri_flag] == 'Yes' || $temp4[had_mri_flag] == 'yes')
                            $had_mri_flag = TRUE;
                        else if ($temp4[had_mri_flag] == 'No' || $temp4[had_mri_flag] == 'no')
                            $had_mri_flag = FALSE;
                        else
                            $had_mri_flag = FALSE;

                        if ($temp4[abnormalities_MRI_flag] == 'Yes' || $temp4[abnormalities_MRI_flag] == 'yes')
                            $abnormality_MRI_flag = TRUE;
                        else if ($temp4[abnormalities_MRI_flag] == 'No' || $temp4[abnormalities_MRI_flag] == 'no')
                            $abnormality_MRI_flag = FALSE;
                        else
                            $abnormality_MRI_flag = FALSE;

                        if ($temp4[is_cancer_mammogram_flag] == 'Yes' || $temp4[is_cancer_mammogram_flag] == 'yes')
                            $is_cancer_mammogram_flag = TRUE;
                        else if ($temp4[is_cancer_mammogram_flag] == 'No' || $temp4[is_cancer_mammogram_flag] == 'no')
                            $is_cancer_mammogram_flag = FALSE;
                        else
                            $is_cancer_mammogram_flag = FALSE;

                        $patient_ic_no = $temp4[patient_IC_no];
                        $studies_name = $temp4[studies_name];
                        $studies_id = $this->excell_sheets_model->get_id('studies', 'studies_id', 'studies_name', $temp4[1]);
                        $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);

                        $temp_patient_ic_no_survelance[] = $patient_ic_no;
                        $temp_patient_studies_id[] = $patient_studies_id;

                        if(in_array($patient_ic_no, $result_pt_ic_no_pt_breast_screening)  
                                && in_array($patient_studies_id, $result_pt_studies_id_pt_breast_screening))
                        {
                            $data_patient_breast_screening_update = array(
                            'patient_ic_no' => $temp4[patient_IC_no],
                            'patient_studies_id' => $patient_studies_id,
                            'date_of_first_mammogram' => $temp4[date_of_first_mammogram],
                            'age_of_first_mammogram' => $temp4[age_at_first_mammogram],
                            'age_of_recent_mammogram' => $temp4[age_of_recent_mammogram],
                            'date_of_recent_mammogram' => $temp4[date_of_recent_mammogram],
                            'screening_centre' => $temp4[screening_center],
                            'total_no_of_mammogram' => $temp4[total_no_of_mammogram],
                            'screening_interval' => $temp4[screening_intervals],
                            'abnormalities_mammo_flag' => $abnormality_mammo_flag,
                            'mammo_comments' => $temp4[mammo_comments],
                            'name_of_radiologist' => $temp4[radiologist_name],
                            'had_ultrasound_flag' => $had_ultrasound_flag,
                            'total_no_of_ultrasound' => $temp4[total_no_ultrasound],
                            'abnormalities_ultrasound_flag' => $abnormality_ultrasound_flag,
                            'had_mri_flag' => $had_mri_flag,
                            'total_no_of_mri' => $temp4[total_no_mri],
                            'abnormalities_MRI_flag' => $abnormality_MRI_flag,
                            'BIRADS_clinical_classification' => $temp4[BIRADS_clinical_classification],
                            'BIRADS_density_classification' => $temp4[BIRADS_density_classification],
                            'percentage_of_mammo_density' => $temp4[percentage_of_mammo_density],
                            'created_on' => $created_date,
                            'screening_center_of_first_mammogram' => $temp4[screening_center_of_first_mammogram],
                            'screening_center_of_recent_mammogram' => $temp4[screening_center_of_recent_mammogram],
                            'details_of_first_mammogram' => $temp4[details_of_first_mammogram],
                            'details_of_recent_mammogram' => $temp4[details_of_recent_mammogram],
                            'motivaters_of_first_mammogram' => $temp4[motivaters_of_first_mammogram],
                            'motivaters_of_recent_mammogram' => $temp4[motivaters_of_recent_mammogram],
                            'reason_of_mammogram' => $temp4[reason_of_mammogram],
                            'reason_of_mammogram_details' => $temp4[reason_of_mammogram_details],
                            'mammogram_in_sdmc' => $temp4[mammogram_in_sdmc],
                            'action_suggested_on_mammogram_report' => $temp4[action_suggested_on_mammogram_report],
                            'reason_of_action_suggested' => $temp4[reason_of_action_suggested],
                            'site_effected_of_mammogram' => $temp4[site_effected_of_mammogram],
                            'is_cancer_mammogram_flag' => $is_cancer_mammogram_flag
                            );
                            $this->db->where('patient_ic_no', $patient_ic_no);
                            $this->db->where('patient_studies_id', $patient_studies_id);
                            $this->db->update('patient_breast_screening', $data_patient_breast_screening_update); 
                            $data_patient_breast_screening_update = null;
                        }
                        else
                        {
                            $data_patient_breast_screening[] = array(
                            'patient_ic_no' => $temp4[patient_IC_no],
                            'patient_studies_id' => $patient_studies_id,
                            'date_of_first_mammogram' => $temp4[date_of_first_mammogram],
                            'age_of_first_mammogram' => $temp4[age_at_first_mammogram],
                            'age_of_recent_mammogram' => $temp4[age_of_recent_mammogram],
                            'date_of_recent_mammogram' => $temp4[date_of_recent_mammogram],
                            'screening_centre' => $temp4[screening_center],
                            'total_no_of_mammogram' => $temp4[total_no_of_mammogram],
                            'screening_interval' => $temp4[screening_intervals],
                            'abnormalities_mammo_flag' => $abnormality_mammo_flag,
                            'mammo_comments' => $temp4[mammo_comments],
                            'name_of_radiologist' => $temp4[radiologist_name],
                            'had_ultrasound_flag' => $had_ultrasound_flag,
                            'total_no_of_ultrasound' => $temp4[total_no_ultrasound],
                            'abnormalities_ultrasound_flag' => $abnormality_ultrasound_flag,
                            'had_mri_flag' => $had_mri_flag,
                            'total_no_of_mri' => $temp4[total_no_mri],
                            'abnormalities_MRI_flag' => $abnormality_MRI_flag,
                            'BIRADS_clinical_classification' => $temp4[BIRADS_clinical_classification],
                            'BIRADS_density_classification' => $temp4[BIRADS_density_classification],
                            'percentage_of_mammo_density' => $temp4[percentage_of_mammo_density],
                            'created_on' => $created_date,
                            'screening_center_of_first_mammogram' => $temp4[screening_center_of_first_mammogram],
                            'screening_center_of_recent_mammogram' => $temp4[screening_center_of_recent_mammogram],
                            'details_of_first_mammogram' => $temp4[details_of_first_mammogram],
                            'details_of_recent_mammogram' => $temp4[details_of_recent_mammogram],
                            'motivaters_of_first_mammogram' => $temp4[motivaters_of_first_mammogram],
                            'motivaters_of_recent_mammogram' => $temp4[motivaters_of_recent_mammogram],
                            'reason_of_mammogram' => $temp4[reason_of_mammogram],
                            'reason_of_mammogram_details' => $temp4[reason_of_mammogram_details],
                            'mammogram_in_sdmc' => $temp4[mammogram_in_sdmc],
                            'action_suggested_on_mammogram_report' => $temp4[action_suggested_on_mammogram_report],
                            'reason_of_action_suggested' => $temp4[reason_of_action_suggested],
                            'site_effected_of_mammogram' => $temp4[site_effected_of_mammogram],
                            'is_cancer_mammogram_flag' => $is_cancer_mammogram_flag
                            );
                        }

                        $patient_breast_screening_id = 1; //for testing
                        $left_right_breast_side = $temp4[mammo_left_right_breast_site];
                        $upper_below_breast_side = $temp4[mammo_upper_below_breast_site];

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


                        if ($temp4[abnormalities_detected] == 'Yes' || $temp4[abnormalities_detected] == 'yes')
                            $is_abnormality_detected_breast = TRUE;
                        else if ($temp4[abnormalities_detected] == 'No' || $temp4[abnormalities_detected] == 'no')
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

                        if ($temp4[ultrasound_abnormality_detected_flag] == 'Yes' || $temp4[ultrasound_abnormality_detected_flag] == 'yes')
                            $is_abnormality_detected_ultrasound = TRUE;
                        else if ($temp4[ultrasound_abnormality_detected_flag] == 'No' || $temp4[ultrasound_abnormality_detected_flag] == 'no')
                            $is_abnormality_detected_ultrasound = FALSE;
                        else
                            $is_abnormality_detected_ultrasound = FALSE;

                        $data_patient_ultrasound_abnormality[] = array(
                            'ultrasound_date' => $temp4[ultrasound_date],
                            'is_abnormality_detected' => $is_abnormality_detected_ultrasound,
                            'comments' => $temp4[Ultrasound_abnormality_comments],
                            'patient_breast_screening_id' => $patient_breast_screening_id,
                            'created_on' => $created_date
                        );

                        if ($temp4[MRI_abnormality_detected_flag] == 'Yes' || $temp4[MRI_abnormality_detected_flag] == 'yes')
                            $is_abnormality_detected_mri = TRUE;
                        else if ($temp4[MRI_abnormality_detected_flag] == 'No' || $temp4[MRI_abnormality_detected_flag] == 'no')
                            $is_abnormality_detected_mri = FALSE;
                        else
                            $is_abnormality_detected_mri = FALSE;

                        $data_patient_mri_abnormality[] = array(
                            'mri_date' => $temp4[MRI_date],
                            'is_abnormality_detected' => $is_abnormality_detected_mri,
                            'comments' => $temp4[MRI_abnormality_comments],
                            'patient_breast_screening_id' => $patient_breast_screening_id,
                            'created_on' => $created_date
                        );
                        
                        $temp4 = null;
                    }



                    //print_r($data_patient_breast_screening);
                    //print_r($data_patient_breast_abnormality);
                    //print_r($data_patient_ultrasound_abnormality);
                    // print_r($data_patient_mri_abnormality);
                    if(sizeof($data_patient_breast_screening) > 0)
                    {
                        $id_patient_breast_screening = $this->excell_sheets_model->insert_record($data_patient_breast_screening, 'patient_breast_screening');
                        if ($id_patient_breast_screening > 0)
                            echo 'Data added succesfully at patient_breast_screening table';
                        else
                            echo 'Failed to insert at patient_breast_screening table';
                        echo '<br/>'; 
                    }
                    
                    $data_patient_breast_abnormality_update = array();
                    $data_patient_breast_abnormality_update = null;
                    $data_patient_breast_abnormality_insert = array();
                    $data_patient_breast_abnormality_insert = null;
                    $data_patient_ultrasound_abnormality_update = array();
                    $data_patient_ultrasound_abnormality_update = null;
                    $data_patient_ultrasound_abnormality_insert = array();
                    $data_patient_ultrasound_abnormality_insert = null;
                    $data_patient_mri_abnormality_update = array();
                    $data_patient_mri_abnormality_update = null;
                    $data_patient_mri_abnormality_insert = array();
                    $data_patient_mri_abnormality_insert = null;

                    $tempLength = sizeof($temp_patient_ic_no_survelance);
                    
                    for ($key = 0; $key < $tempLength; $key++) 
                    {
			$patient_breast_screening_id_in = $this->excell_sheets_model->get_patient_breast_screening_id($temp_patient_ic_no_survelance[$key], $temp_patient_studies_id[$key]);
			$data_patient_breast_abnormality[$key]['patient_breast_screening_id'] = $patient_breast_screening_id_in;
			if($patient_breast_screening_id_in > 0 && in_array($patient_breast_screening_id_in, $result_pt_brst_scrning_id_pt_bst_abn))
			{
                            $data_patient_breast_abnormality_update[] = $data_patient_breast_abnormality[$key];
			}
			else if($patient_breast_screening_id_in > 0)
			{
                            $data_patient_breast_abnormality_insert[] = $data_patient_breast_abnormality[$key];
			}
                    }
                    
                    for ($key = 0; $key < $tempLength; $key++) 
                    {
			$patient_breast_screening_id_in = $this->excell_sheets_model->get_patient_breast_screening_id($temp_patient_ic_no_survelance[$key], $temp_patient_studies_id[$key]);
			$data_patient_ultrasound_abnormality[$key]['patient_breast_screening_id'] = $patient_breast_screening_id_in;
			if($patient_breast_screening_id_in > 0 && in_array($patient_breast_screening_id_in, $result_pt_brst_scrning_id_pt_ultrad_abn))
			{
                            $data_patient_ultrasound_abnormality_update[] = $data_patient_ultrasound_abnormality[$key];
			}
			else if($patient_breast_screening_id_in > 0)
			{
                            $data_patient_ultrasound_abnormality_insert[] = $data_patient_ultrasound_abnormality[$key];
			}
                    }
                    
                    for ($key = 0; $key < $tempLength; $key++) 
                    {
			$patient_breast_screening_id_in = $this->excell_sheets_model->get_patient_breast_screening_id($temp_patient_ic_no_survelance[$key], $temp_patient_studies_id[$key]);
			$data_patient_mri_abnormality[$key]['patient_breast_screening_id'] = $patient_breast_screening_id_in;
			if($patient_breast_screening_id_in > 0 && in_array($patient_breast_screening_id_in, $result_pt_brst_scrning_id_pt_mri_abn))
			{
			$data_patient_mri_abnormality_update[] = $data_patient_mri_abnormality[$key];
			}
			else if($patient_breast_screening_id_in > 0)
			{
			$data_patient_mri_abnormality_insert[] = $data_patient_mri_abnormality[$key];
			}
                    }

                    //print_r($data_patient_breast_abnormality);
                    //print_r($data_patient_ultrasound_abnormality);
                    //print_r($data_patient_mri_abnormality);
                    if(sizeof($data_patient_breast_abnormality_insert) > 0)
                    {
                        $id_patient_breast_abnormality = $this->excell_sheets_model->insert_record($data_patient_breast_abnormality_insert, 'patient_breast_abnormality');
                        if ($id_patient_breast_abnormality > 0)
                            echo 'Data added succesfully at patient_breast_abnormality table';
                        else
                            echo 'Failed to insert at patient_breast_abnormality table';
                        echo '<br/>';
                    }

                    if(sizeof($data_patient_breast_abnormality_update) > 0)
                    {
                        $id_patient_breast_abnormality = $this->db->update_batch('patient_breast_abnormality',$data_patient_breast_abnormality_update,'patient_breast_screening_id');
                        if ($id_patient_breast_abnormality > 0)
                            echo 'Data updated succesfully at patient_breast_abnormality table';
                        else
                            echo 'Updated Data at patient_breast_abnormality table';
                        echo '<br/>';
                    }
                    
                    if(sizeof($data_patient_ultrasound_abnormality_insert) > 0)
                    {
                        $id_patient_ultrasound_abnormality = $this->excell_sheets_model->insert_record($data_patient_ultrasound_abnormality_insert, 'patient_ultrasound_abnormality');
                        if ($id_patient_ultrasound_abnormality > 0)
                            echo 'Data added succesfully at patient_ultrasound_abnormality table';
                        else
                            echo 'Failed to insert at patient_ultrasound_abnormality table';
                        echo '<br/>';
                    }
                    
                    if(sizeof($data_patient_ultrasound_abnormality_update) > 0)
                    {
                        $id_patient_ultrasound_abnormality = $this->db->update_batch('patient_ultrasound_abnormality',$data_patient_ultrasound_abnormality_update,'patient_breast_screening_id');
                        if ($id_patient_ultrasound_abnormality > 0)
                            echo 'Data updated succesfully at patient_ultrasound_abnormality table';
                        else
                            echo 'Updated Data at patient_ultrasound_abnormality table';
                        echo '<br/>';
                    }

                    if(sizeof($data_patient_mri_abnormality_insert) > 0)
                    {
                        $id_patient_mri_abnormality = $this->excell_sheets_model->insert_record($data_patient_mri_abnormality_insert, 'patient_mri_abnormality');
                        if ($id_patient_mri_abnormality > 0)
                            echo 'Data added succesfully at patient_mri_abnormality table';
                        else
                            echo 'Failed to insert at patient_mri_abnormality table';
                        echo '<br/>';
                    }
                    
                    if(sizeof($data_patient_mri_abnormality_update) > 0)
                    {
                        $id_patient_mri_abnormality = $this->db->update_batch('patient_mri_abnormality',$data_patient_mri_abnormality_update,'patient_breast_screening_id');
                        if ($id_patient_mri_abnormality > 0)
                            echo 'Data updated succesfully at patient_mri_abnormality table';
                        else
                            echo 'Updated Data at patient_mri_abnormality table';
                        echo '<br/>';
                    }
                  
                    echo '<br/>';
                    $data_patient_breast_screening = null;
                    $temp_pt_ic_no_pt_breast_screening = null;
                    $result_pt_ic_no_pt_breast_screening = null;
                    $temp_pt_studies_id_pt_breast_screening = null;
                    $result_pt_studies_id_pt_breast_screening = null;
                    $temp_pt_brst_scrning_id_pt_bst_abn = null;
                    $result_pt_brst_scrning_id_pt_bst_abn = null;
                    $temp_pt_brst_scrning_id_pt_ultrad_abn = null;
                    $result_pt_brst_scrning_id_pt_ultrad_abn = null;
                    $temp_pt_brst_scrning_id_pt_mri_abn = null;
                    $result_pt_brst_scrning_id_pt_mri_abn = null;
                    $temp_patient_ic_no_survelance = null;
                    $temp_patient_studies_id = null;
                    $temp_patient_ic_no_survelance = null;
                    $temp_patient_studies_id = null;
                    $data_patient_breast_abnormality = null;
                    $data_patient_ultrasound_abnormality = null;
                    $data_patient_mri_abnormality = null;
                    $data_patient_breast_abnormality_update = null;
                    $data_patient_breast_abnormality_insert = null;
                    $data_patient_ultrasound_abnormality_update = null;
                    $data_patient_ultrasound_abnormality_insert = null;
                    $data_patient_mri_abnormality_update = null;
                    $data_patient_mri_abnormality_insert = null;
                    
                } else if (($loadedSheetName == 'Sreening and Surveilance2')) {
                    $data_patient_non_cancer_surgery = array();
                    $data_patient_non_cancer_surgery = null;
                    $data_patient_non_cancer_surgery_update = array();
                    $data_patient_non_cancer_surgery_update = null;
                    
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
                    $i = 0;
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp5 = array();
                        $temp5 = null;
                        foreach ($cellIterator as $key => $cell) {
                            $cell_value = $cell->getFormattedValue();

                            if ($key == 0 && $cell_value != NULL)
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
                            //echo $key; // 0, 1, 2..
                            if ($key == 4 || $key == 10) {
                                if ($cell_value != NULL) {
                                    $cell_value = date('Y-m-d', strtotime(str_replace('/', '-', $cell_value)));
                                }
                            }

                            $temp5[] = $cell_value;
                        }

                        $patient_ic_no = $temp5[0];
                        $studies_name = $temp5[1];
                        $studies_id = $this->excell_sheets_model->get_id('studies', 'studies_id', 'studies_name', $temp5[1]);
                        $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);

                        $val_patient_studies_id = in_array($patient_studies_id, $result_patient_studies_id);

                        if ($val_patient_studies_id) {
                            $data_patient_non_cancer_surgery_update[] = array(
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
                                'breast_age_of_surgery' => $temp5[10],
                                'breast_date_of_surgery' => $temp5[11]
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
                                'breast_age_of_surgery' => $temp5[10],
                                'breast_date_of_surgery' => $temp5[11]
                            );
                        }
                        $temp5 = null;
                    }
                    //print_r($data_patient_non_cancer_surgery);
                    if (sizeof($data_patient_non_cancer_surgery) > 0) {
                        $id_data_patient_studies = $this->excell_sheets_model->insert_record($data_patient_non_cancer_surgery, 'patient_non_cancer_surgery');
                        if ($id_data_patient_studies > 0)
                            echo 'Data added succesfully at patient_non_cancer_surgery table';
                        else
                            echo 'Failed to insert at patient_non_cancer_surgery table';
                        echo '<br/>';
                    }

                    if (sizeof($data_patient_non_cancer_surgery_update) > 0) {
                        $id_data_patient_studies = $this->db->update_batch('patient_non_cancer_surgery', $data_patient_non_cancer_surgery_update, 'patient_studies_id');
                        if ($id_data_patient_studies > 0)
                            echo 'Data updated succesfully at patient_non_cancer_surgery table';
                        else
                            echo 'Updated Datad at patient_non_cancer_surgery table';
                        echo '<br/>';
                    }
                    $data_patient_non_cancer_surgery = null;
                    $data_patient_non_cancer_surgery_update = null;
                    $temp_result_patient_studies_id = null;
                    $result_patient_studies_id = null;

                }else if (($loadedSheetName == 'Sreening and Surveilance3')) {
                    $data_patient_risk_reducing_surgery_update = array();
                    $data_patient_risk_reducing_surgery_update = null;
                    $data_patient_risk_reducing_surgery = array();
                    $data_patient_risk_reducing_surgery = null;
                    $data_patient_risk_reducing_surgery_lesion = array();
                    $data_patient_risk_reducing_surgery_lesion = null;
                    $data_patient_risk_reducing_surgery_complete_removal = array();
                    $data_patient_risk_reducing_surgery_complete_removal = null;  
                    
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
                    
                    $temp_patient_studies_id = array();
                    $temp_patient_studies_id = null;
                    $i = 0;
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp6 = array();
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

                            if ($key == 4 || $key == 7) {
                                if ($cell_value != NULL) {
                                    $cell_value = date('Y-m-d', strtotime(str_replace('/', '-', $cell_value)));
                                }
                            }

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
                    }
 
                    if(sizeof($data_patient_risk_reducing_surgery_update) > 0)
                    {
                        $id_patient_risk_reducing_surgery = $this->db->update_batch('patient_risk_reducing_surgery',$data_patient_risk_reducing_surgery_update, 'patient_studies_id');
                        if ($id_patient_risk_reducing_surgery > 0)
                            echo 'Data updated succesfully at patient_risk_reducing_surgery table';
                        else
                            echo 'Updated Data at patient_risk_reducing_surgery table';
                        echo '<br/>';
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
                    }
                    
                    if(sizeof($data_patient_risk_reducing_surgery_lesion_update) > 0)
                    {
                        $id_patient_risk_reducing_surgery_lesion = $this->db->update_batch('patient_risk_reducing_surgery_lesion',$data_patient_risk_reducing_surgery_lesion_update,'patient_risk_reducing_surgery_id');
                        
                        if ($id_patient_risk_reducing_surgery_lesion > 0)
                            echo 'Data updated succesfully at patient_risk_reducing_surgery_lesion table';
                        else
                            echo 'Updated Data at patient_risk_reducing_surgery_lesion table';
                        echo '<br/>';
                    }

                    if(sizeof($data_patient_risk_reducing_surgery_complete_insert) > 0)
                    {
                        $id_patient_risk_reducing_surgery_complete_removal = $this->excell_sheets_model->insert_record($data_patient_risk_reducing_surgery_complete_insert, 'patient_risk_reducing_surgery_complete_removal');
                        if ($id_patient_risk_reducing_surgery_complete_removal > 0)
                            echo 'Data added succesfully at patient_risk_reducing_surgery_complete_removal table';
                        else
                            echo 'Failed to insert at patient_risk_reducing_surgery_complete_removal table';
                        echo '<br/>';
                    }
                    
                    if(sizeof($data_patient_risk_reducing_surgery_complete_update) > 0)
                    {
                        $id_patient_risk_reducing_surgery_complete_removal = $this->db->update_batch('patient_risk_reducing_surgery_complete_removal',$data_patient_risk_reducing_surgery_complete_update,'patient_risk_reducing_surgery_id');
                        if ($id_patient_risk_reducing_surgery_complete_removal > 0)
                            echo 'Data updated succesfully at patient_risk_reducing_surgery_complete_removal table';
                        else
                            echo 'Updated Data at patient_risk_reducing_surgery_complete_removal table';
                        echo '<br/>';
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

                } else if (($loadedSheetName == 'Sreening and Surveilance4')) {
                    $data_patient_other_screening = array();
                    $data_patient_other_screening = null;
                    $data_patient_other_screening_update = array();
                    $data_patient_other_screening_update = null;
                    $data_patient_ovarian_screening = array();
                    $data_patient_ovarian_screening = null;
                    $data_patient_ovarian_screening_update = array();
                    $data_patient_ovarian_screening_update = null;
                    
                    $temp_pt_studies_id_pt_ova_scrning = array();
                    $temp_pt_studies_id_pt_ova_scrning = null;
                    $this->db->select('patient_studies_id');
                    $this->db->from('patient_ovarian_screening');
                    $temp_pt_studies_id_pt_ova_scrning = $this->db->get()->result_array();

                    //print_r($temp_pt_studies_id_pt_ova_scrning);
                    $result_pt_studies_id_pt_ova_scrning = array();
                    for ($i = 0; $i < sizeof($temp_pt_studies_id_pt_ova_scrning); $i++) {
                        $result_pt_studies_id_pt_ova_scrning [$i] = $temp_pt_studies_id_pt_ova_scrning[$i]['patient_studies_id'];
                    }
                    
                    $temp_ova_scrning_type_id_pt_ova_scrning = array();
                    $temp_ova_scrning_type_id_pt_ova_scrning = null;
                    $this->db->select('ovarian_screening_type_id');
                    $this->db->from('patient_ovarian_screening');
                    $temp_ova_scrning_type_id_pt_ova_scrning = $this->db->get()->result_array();

                    //print_r($temp_ova_scrning_type_id_pt_ova_scrning);
                    $result_ova_scrning_type_id_pt_ova_scrning = array();
                    for ($i = 0; $i < sizeof($temp_ova_scrning_type_id_pt_ova_scrning); $i++) {
                        $result_ova_scrning_type_id_pt_ova_scrning [$i] = $temp_ova_scrning_type_id_pt_ova_scrning[$i]['ovarian_screening_type_id'];
                    }
                    
                    $temp_pt_studies_id_pt_other_scrning = array();
                    $temp_pt_studies_id_pt_other_scrning = null;
                    $this->db->select('patient_studies_id');
                    $this->db->from('patient_other_screening');
                    $temp_pt_studies_id_pt_other_scrning = $this->db->get()->result_array();

                    //print_r($temp_pt_studies_id_pt_other_scrning);
                    $result_pt_studies_id_pt_other_scrning = array();
                    for ($i = 0; $i < sizeof($temp_pt_studies_id_pt_other_scrning); $i++) {
                        $result_pt_studies_id_pt_other_scrning [$i] = $temp_pt_studies_id_pt_other_scrning[$i]['patient_studies_id'];
                    }
                    
                    $i = 0;
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp7 = array();
                        $temp7 = null;
                        foreach ($cellIterator as $key => $cell) {
                            $cell_value = $cell->getFormattedValue();

                            if ($key == 0 && $cell_value != NULL)
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);

                            //echo $key; // 0, 1, 2..
                            if ($key == 2 && $cell_value == NULL)
                                $cell_value = 'None';

                            if ($key == 6 && $cell_value == NULL)
                                $cell_value = 'None';

                            if ($key == 3) {
                                if ($cell_value != NULL) {
                                    $cell_value = date('Y-m-d', strtotime(str_replace('/', '-', $cell_value)));
                                }
                            }

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
                        
                        if(in_array($patient_studies_id, $result_pt_studies_id_pt_ova_scrning)  
                                && in_array($ovarian_screening_type_id, $result_ova_scrning_type_id_pt_ova_scrning))
                        {
                            $data_patient_ovarian_screening_update = array(
                            'patient_studies_id' => $patient_studies_id,
                            'ovarian_screening_type_id' => $ovarian_screening_type_id,
                            'screening_date' => $temp7[3],
                            'is_abnormality_detected' => $is_abnormality_detected,
                            'additional_info' => $temp7[5],
                            'created_on' => $created_date
                            ); 
                            
                            $this->db->where('patient_studies_id', $patient_studies_id);
                            $this->db->where('ovarian_screening_type_id', $ovarian_screening_type_id);
                            $this->db->update('patient_ovarian_screening', $data_patient_ovarian_screening_update); 
                            $data_patient_ovarian_screening_update = null;
                        }        
                        else
                        {
                            $data_patient_ovarian_screening[] = array(
                            'patient_studies_id' => $patient_studies_id,
                            'ovarian_screening_type_id' => $ovarian_screening_type_id,
                            'screening_date' => $temp7[3],
                            'is_abnormality_detected' => $is_abnormality_detected,
                            'additional_info' => $temp7[5],
                            'created_on' => $created_date
                            ); 
                        }
 
                        

                        if(in_array($patient_studies_id, $result_pt_studies_id_pt_other_scrning))
                        {
                            $data_patient_other_screening_update[] = array(
                            'patient_studies_id' => $patient_studies_id,
                            'screening_type' => $temp7[6],
                            'age_at_screening' => $temp7[7],
                            'screening_center' => $temp7[8],
                            'screening_result' => $temp7[9],
                            'created_on' => $created_date
                            );
                        }
                        else
                        {
                            $data_patient_other_screening[] = array(
                            'patient_studies_id' => $patient_studies_id,
                            'screening_type' => $temp7[6],
                            'age_at_screening' => $temp7[7],
                            'screening_center' => $temp7[8],
                            'screening_result' => $temp7[9],
                            'created_on' => $created_date
                            );
                        }
                        $temp7 = null;
                    }
                    //print_r($data_patient_ovarian_screening);
                    //print_r($patient_other_screening);
                    if(sizeof($data_patient_ovarian_screening) > 0)
                    {
                        $id_patient_ovarian_screening = $this->excell_sheets_model->insert_record($data_patient_ovarian_screening, 'patient_ovarian_screening');
                        if ($id_patient_ovarian_screening > 0)
                            echo 'Data added succesfully at patient_ovarian_screening table';
                        else
                            echo 'Failed to insert at patient_ovarian_screening table';
                        echo '<br/>';
                    }
                                   
                    if(sizeof($data_patient_other_screening) > 0)
                    {
                        $id_patient_other_screening = $this->excell_sheets_model->insert_record($data_patient_other_screening, 'patient_other_screening');
                        if ($id_patient_other_screening > 0)
                            echo 'Data added succesfully at patient_other_screening table';
                        else
                            echo 'Failed to insert at patient_other_screening table';
                        echo '<br/>';
                    }
                    
                    if(sizeof($data_patient_other_screening_update) > 0)
                    {
                        $id_patient_other_screening = $this->db->update_batch('patient_other_screening',$data_patient_other_screening_update,'patient_studies_id');
                        if ($id_patient_other_screening > 0)
                            echo 'Data updated succesfully at patient_other_screening table';
                        else
                            echo 'Updated Data at patient_other_screening table';
                        echo '<br/>';
                    }
                    
                    $data_patient_other_screening = null;
                    $data_patient_other_screening_update = null;
                    $data_patient_ovarian_screening = null;
                    $temp_pt_studies_id_pt_ova_scrning = null;
                    $result_pt_studies_id_pt_ova_scrning = null;
                    $temp_ova_scrning_type_id_pt_ova_scrning = null;
                    $result_ova_scrning_type_id_pt_ova_scrning = null;
                    $temp_pt_studies_id_pt_other_scrning = null;
                    $result_pt_studies_id_pt_other_scrning = null;
                    $temp7 = null;
                    $data_patient_ovarian_screening_update = null;
 
                }
                else if (($loadedSheetName == 'Sreening and Surveilance5')) {
                    $data_patient_surveillance = array();
                    $data_patient_surveillance = null;
                    $data_patient_surveillance_update = array();
                    $data_patient_surveillance_update = null;
                    
                    $temp_result_patient_studies_id = array();
                    $temp_result_patient_studies_id = null;
                    $this->db->select('patient_studies_id');
                    $this->db->from('patient_surveillance');
                    $temp_result_patient_studies_id = $this->db->get()->result_array();

                    //print_r($temp_result_relationship);
                    $result_patient_studies_id = array();
                    for ($i = 0; $i < sizeof($temp_result_patient_studies_id); $i++) {
                        //echo $result_relationship[$j]['relatives_type']. '<br/>';
                        $result_patient_studies_id[$i] = $temp_result_patient_studies_id[$i]['patient_studies_id'];
                        //echo $result_studies_name[$i] . '<br/>';
                    }
                    
                    $i = 0;
                    
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp8 = array();
                        $temp8 = null;
                        foreach ($cellIterator as $key => $cell) {
                            $cell_value = $cell->getFormattedValue();

                            if ($key == 0 && $cell_value != NULL)
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);

                            if ($key == 2 && $cell_value == NULL)
                                $cell_value = 'None';
                            //echo $key; // 0, 1, 2..

                            if ($key == 4 || $key == 8 || $key == 9 || $key == 10) {
                                if ($cell_value != NULL) {
                                    $cell_value = date('Y-m-d', strtotime(str_replace('/', '-', $cell_value)));
                                }
                            }
                            $temp8[] = $cell_value;
                        }


                        $patient_ic_no = $temp8[0]; //echo $patient_ic_no.'          ';
                        $studies_name = $temp8[1]; //echo $studies_name.'           ';
                        $studies_id = $this->excell_sheets_model->get_id('studies', 'studies_id', 'studies_name', $studies_name);
                        $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);
                        //echo $patient_studies_id.'<br/>';
                        
                        if(in_array($patient_studies_id, $result_patient_studies_id))
                        {
                            $data_patient_surveillance_update[] = array(
                            'patient_studies_id' => $patient_studies_id,
                            'recruitment_center' => $temp8[recruitment_center],
                            'type' => $temp8[surveillance_type],
                            'first_consultation_date' => $temp8[first_consultation_date],
                            'first_consultation_place' => $temp8[first_consultation_place],
                            'surveillance_interval' => $temp8[interval],
                            'diagnosis' => $temp8[diagnosis],
                            'due_date' => $temp8[due_date],
                            'reminder_sent_date' => $temp8[reminder_sent_date],
                            'surveillance_done_date' => $temp8[surveillance_done_date],
                            'reminded_by' => $temp8[reminded_by],
                            'timing' => $temp8[timing],
                            'symptoms' => $temp8[symptoms],
                            'doctor_name' => $temp8[doctor_name],
                            'surveillance_done_place' => $temp8[survillance_done_place],
                            'outcome' => $temp8[outcome],
                            'comments' => $temp8[comments],
                            'created_on' => $created_date
                            );
                        }
                        else
                        {
                            $data_patient_surveillance[] = array(
                            'patient_studies_id' => $patient_studies_id,
                            'recruitment_center' => $temp8[recruitment_center],
                            'type' => $temp8[surveillance_type],
                            'first_consultation_date' => $temp8[first_consultation_date],
                            'first_consultation_place' => $temp8[first_consultation_place],
                            'surveillance_interval' => $temp8[interval],
                            'diagnosis' => $temp8[diagnosis],
                            'due_date' => $temp8[due_date],
                            'reminder_sent_date' => $temp8[reminder_sent_date],
                            'surveillance_done_date' => $temp8[surveillance_done_date],
                            'reminded_by' => $temp8[reminded_by],
                            'timing' => $temp8[timing],
                            'symptoms' => $temp8[symptoms],
                            'doctor_name' => $temp8[doctor_name],
                            'surveillance_done_place' => $temp8[survillance_done_place],
                            'outcome' => $temp8[outcome],
                            'comments' => $temp8[comments],
                            'created_on' => $created_date
                            );
                        }
                        $temp8 = null;
                    }
                    //print_r($data_patient_surveillance);

                    if(sizeof($data_patient_surveillance) > 0)
                    {
                        $id_patient_surveillance = $this->excell_sheets_model->insert_record($data_patient_surveillance, 'patient_surveillance');
                        if ($id_patient_surveillance > 0)
                            echo 'Data added succesfully at patient_surveillance table';
                        else
                            echo 'Failed to insert at patient_surveillance table';
                        echo '<br/>';
                    }

                    if (sizeof($data_patient_surveillance_update) > 0) {
                        $id_patient_surveillance = $this->db->update_batch('patient_surveillance', $data_patient_surveillance_update, 'patient_studies_id');
                        if ($id_patient_surveillance > 0)
                            echo 'Data updated succesfully at patient_surveillance table';
                        else
                            echo 'Updated Datad at patient_surveillance table';
                        echo '<br/>';
                    }
                    
                    $data_patient_surveillance = null;
                    $data_patient_surveillance_update = null;
                    $temp_result_patient_studies_id = null;
                    $result_patient_studies_id = null;
                }
                else if (($loadedSheetName == 'Mutation analysis')) {
                    $data_patient_mutation_analysis = array();
                    $data_patient_mutation_analysis = null;
                    $data_patient_mutation_analysis_updated = array();
                    $data_patient_mutation_analysis_updated = null;
                    $temp_result_patient_studies_id = array();
                    $temp_result_patient_studies_id = null;
                    $this->db->select('patient_studies_id');
                    $this->db->from('patient_mutation_analysis');
                    $temp_result_patient_studies_id = $this->db->get()->result_array();

                    //print_r($temp_result_relationship);
                    $result_patient_studies_id = array();
                    for ($i = 0; $i < sizeof($temp_result_patient_studies_id); $i++) {
                        //echo $result_relationship[$j]['relatives_type']. '<br/>';
                        $result_patient_studies_id[$i] = $temp_result_patient_studies_id[$i]['patient_studies_id'];
                        //echo $result_studies_name[$i] . '<br/>';
                    }
                    $i = 0;
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp9 = array();
                        $temp9 = null;
                        foreach ($cellIterator as $key => $cell) {
                            $cell_value = $cell->getFormattedValue();

                            if ($key == 0 && $cell_value != NULL)
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);

                            if ($key == 2 || $key == 7 || $key == 20 || $key == 21) {
                                if ($cell_value != NULL) {
                                    $cell_value = date('Y-m-d', strtotime(str_replace('/', '-', $cell_value)));
                                }
                            }
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

                        if(in_array($patient_studies_id, $result_patient_studies_id))
                        {
                           $data_patient_mutation_analysis_updated[] = array(
                            'date_test_ordered' => $temp9[2],
                            'ordered_by' => $temp9[3],
                            'testing_result_notification_flag' => $testing_result_notification_flag,
                            'service_provider' => $temp9[5],
                            'testing_batch' => $temp9[6],
                            'testing_date' => $temp9[7],
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
                            'report_date' => $temp9[20],
                            'date_client_notified' => $temp9[21],
                            'is_counselling_flag' => $temp9[22],
                            'comments' => $temp9[23],
                            'patient_studies_id' => $patient_studies_id,
                            'created_on' => $created_date,
                            'mutation_name' => $temp9[24]
                            ); 
                        }
                        else
                        {
                            $data_patient_mutation_analysis[] = array(
                            'date_test_ordered' => $temp9[2],
                            'ordered_by' => $temp9[3],
                            'testing_result_notification_flag' => $testing_result_notification_flag,
                            'service_provider' => $temp9[5],
                            'testing_batch' => $temp9[6],
                            'testing_date' => $temp9[7],
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
                            'report_date' => $temp9[20],
                            'date_client_notified' => $temp9[21],
                            'is_counselling_flag' => $temp9[22],
                            'comments' => $temp9[23],
                            'patient_studies_id' => $patient_studies_id,
                            'created_on' => $created_date,
                            'mutation_name' => $temp9[24]
                            );
                        }
                        $temp9 = null;
                    }
                    // print_r($data_patient_mutation_analysis);

                    if(sizeof($data_patient_mutation_analysis) > 0)
                    {
                        $id_patient_mutation_analysis = $this->excell_sheets_model->insert_record($data_patient_mutation_analysis, 'patient_mutation_analysis');
                        if ($id_patient_mutation_analysis > 0)
                            echo 'Data added succesfully at patient_mutation_analysis table';
                        else
                            echo 'Failed to insert at patient_mutation_analysis table';
                        echo '<br/>';
                    }
                    
                    
                    if (sizeof($data_patient_mutation_analysis_updated) > 0) {
                        $id_patient_mutation_analysis = $this->db->update_batch('patient_mutation_analysis', $data_patient_mutation_analysis_updated, 'patient_studies_id');
                        if ($id_patient_mutation_analysis > 0)
                            echo 'Data updated succesfully at patient_mutation_analysis table';
                        else
                            echo 'Updated Data at patient_mutation_analysis table';
                        echo '<br/>';
                    }
                    
                    $data_patient_mutation_analysis = null;
                    $data_patient_mutation_analysis_updated = null;
                    $temp_result_patient_studies_id = null;
                    $result_patient_studies_id = null;
                }
                else if (($loadedSheetName == 'Risk Assesment')) {
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
                    $i = 0;
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp10 = array();
                        $temp10 = null;
                        foreach ($cellIterator as $key => $cell) {
                            $cell_value = $cell->getFormattedValue();

                            if ($key == 0 && $cell_value != NULL)
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);

                            //echo $key; // 0, 1, 2..
                            $temp10[] = $cell_value;
                        }

                        if(in_array($temp10[0], $result_patient_ic_no))
                        {
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
                        }
                        else
                        {
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

                    if(sizeof($data_patient_risk_assessment) > 0)
                    {
                        $id_patient_risk_assessment = $this->excell_sheets_model->insert_record($data_patient_risk_assessment, 'patient_risk_assessment');
                        if ($id_patient_risk_assessment > 0)
                            echo 'Data added succesfully at patient_risk_assessment table';
                        else
                            echo 'Failed to insert at patient_risk_assessment table';
                        echo '<br/>';
                    }
                    
                    if(sizeof($data_patient_risk_assessment_update) > 0)
                    {
                        $id_patient_risk_assessment = $this->db->update_batch('patient_risk_assessment',$data_patient_risk_assessment_update, 'patient_ic_no');
                        if ($id_patient_risk_assessment > 0)
                            echo 'Data updated succesfully at patient_risk_assessment table';
                        else
                            echo 'Updated Data at patient_risk_assessment table';
                        echo '<br/>';
                    }
                    
                    $data_patient_risk_assessment = null;
                    $data_patient_risk_assessment_update = null;
                    $temp_result_patient_ic_no = null;
                    $result_patient_ic_no = null;
                    $temp10 = null;
                } else if (($loadedSheetName == 'Lifestyles1')) {
                    $data_patient_lifestyle_factors = array();
                    $data_patient_lifestyle_factors = null;
                    $data_patient_lifestyle_factors_update = array();
                    $data_patient_lifestyle_factors_update = null;
                    $temp_result_patient_studies_id = array();
                    $temp_result_patient_studies_id = null;
                    $this->db->select('patient_studies_id');
                    $this->db->from('patient_lifestyle_factors');
                    $temp_result_patient_studies_id = $this->db->get()->result_array();

                    //print_r($temp_result_relationship);
                    $result_patient_studies_id_Lifestyles1 = array();
                    for ($i = 0; $i < sizeof($temp_result_patient_studies_id); $i++) {
                        //echo $result_relationship[$j]['relatives_type']. '<br/>';
                        $result_patient_studies_id_Lifestyles1[$i] = $temp_result_patient_studies_id[$i]['patient_studies_id'];
                        //echo $result_studies_name[$i] . '<br/>';
                    }
                    $i = 0;
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp11 = array();
                        $temp11 = null;
                        foreach ($cellIterator as $key => $cell) {
                            //$cell_value = $cell->getCalculatedValue(); // Value here
                            $cell_value = $cell->getFormattedValue();

                            if ($key == 0 && $cell_value != NULL)
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
                            //echo $key; // 0, 1, 2..
                            if ($key == 2) {
                                if ($cell_value != NULL) {
                                    $cell_value = date('Y-m-d', strtotime(str_replace('/', '-', $cell_value)));
                                }
                            }
                            $temp11[] = $cell_value;
                            //echo $cell_value . '    ';
                        }

                        if ($temp11[cigarettes_smoked_now] == 'Yes' || $temp11[cigarettes_smoked_now] == 'yes')
                            $cigarrets_smoked_flag = TRUE;
                        else if ($temp11[cigarettes_smoked_now] == 'No' || $temp11[cigarettes_smoked_now] == 'no')
                            $cigarrets_smoked_flag = FALSE;
                        else
                            $cigarrets_smoked_flag = FALSE;

                        if ($temp11[cigarettes_still_smoked] == 'Yes' || $temp11[cigarettes_still_smoked] == 'yes')
                            $cigarrets_still_smoked_flag = TRUE;
                        else if ($temp11[cigarettes_still_smoked] == 'No' || $temp11[cigarettes_still_smoked] == 'no')
                            $cigarrets_still_smoked_flag = FALSE;
                        else
                            $cigarrets_still_smoked_flag = FALSE;

                        if ($temp11[alcohol_drunk_flag] == 'Yes' || $temp11[alcohol_drunk_flag] == 'yes')
                            $alcohol_drunk_flag = TRUE;
                        else if ($temp11[alcohol_drunk_flag] == 'No' || $temp11[alcohol_drunk_flag] == 'no')
                            $alcohol_drunk_flag = FALSE;
                        else
                            $alcohol_drunk_flag = FALSE;

                        if ($temp11[coffee_drunk_flag] == 'Yes' || $temp11[coffee_drunk_flag] == 'yes')
                            $coffee_drunk_flag = TRUE;
                        else if ($temp11[coffee_drunk_flag] == 'No' || $temp11[coffee_drunk_flag] == 'no')
                            $coffee_drunk_flag = FALSE;
                        else
                            $coffee_drunk_flag = FALSE;

                        if ($temp11[tea_drunk_flag] == 'Yes' || $temp11[tea_drunk_flag] == 'yes')
                            $tea_drunk_flag = TRUE;
                        else if ($temp11[tea_drunk_flag] == 'No' || $temp11[tea_drunk_flag] == 'no')
                            $tea_drunk_flag = FALSE;
                        else
                            $tea_drunk_flag = FALSE;

                        if ($temp11[soya_bean_drunk_flag] == 'Yes' || $temp11[soya_bean_drunk_flag] == 'yes')
                            $soya_bean_drunk_flag = TRUE;
                        else if ($temp11[soya_bean_drunk_flag] == 'No' || $temp11[soya_bean_drunk_flag] == 'no')
                            $soya_bean_drunk_flag = FALSE;
                        else
                            $soya_bean_drunk_flag = FALSE;

                        if ($temp11[soya_products_flag] == 'yes')
                            $soya_products_flag = TRUE;
                        else if ($temp11[soya_products_flag] == 'no')
                            $soya_products_flag = FALSE;
                        else
                            $soya_products_flag = FALSE;

                        if ($temp11[diabetes_flag] == 'Yes' || $temp11[diabetes_flag] == 'yes')
                            $diabetes_flag = TRUE;
                        else if ($temp11[diabetes_flag] == 'No' || $temp11[diabetes_flag] == 'no')
                            $diabetes_flag = FALSE;
                        else
                            $diabetes_flag = FALSE;

                        if ($temp11[medicine_for_diabetes_flag] == 'yes')
                            $medicine_for_diabetes_flag = TRUE;
                        else if ($temp11[medicine_for_diabetes_flag] == 'no')
                            $medicine_for_diabetes_flag = FALSE;
                        else
                            $medicine_for_diabetes_flag = FALSE;

                        $patient_ic_no = $temp11[0];
                        $studies_name = $temp11[1];
                        $studies_id = $this->excell_sheets_model->get_id('studies', 'studies_id', 'studies_name', $temp11[1]);
                        $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id);
                        
                        if(in_array($patient_studies_id, $result_patient_studies_id_Lifestyles1))
                        {
                            $data_patient_lifestyle_factors_update[] = array(
                            'patient_studies_id' => $patient_studies_id,
                            'questionnaire_date' => $temp11[questionnaire_date],
                            'self_image_at_7years' => $temp11[self_image_at_7],
                            'self_image_at_18years' => $temp11[self_image_at_18],
                            'self_image_now' => $temp11[self_image_now],
                            'pa_strenuous_activity_childhood' => $temp11[pa_strenuous_activity_childhood],
                            'pa_moderate_exercise_childhood' => $temp11[pa_moderate_exercise_childhood],
                            'pa_gentle_exercise_childhood' => $temp11[pa_gentle_exercise_childhood],
                            'pa_strenuous_activity_now' => $temp11[pa_strenuous_activity_now],
                            'pa_moderate_exercise_now' => $temp11[pa_moderate_exercise_now],
                            'pa_gentle_exercise_now' => $temp11[pa_gentle_exercise_now],
                            'pa_strenuous_activity_adult' => $temp11[pa_strenuous_activity_adult],
                            'pa_moderate_exercise_adult' => $temp11[pa_moderate_exercise_adult],
                            'pa_gentle_exercise_adult' => $temp11[pa_gentle_exercise_adult],
                            'cigarrets_smoked_flag' => $cigarrets_smoked_flag,
                            'cigarrets_still_smoked_flag' => $cigarrets_still_smoked_flag,
                            'total_smoked_years' => $temp11[total_smoked_years],
                            'cigarrets_count_at_teen' => $temp11[cigarettes_count_at_teen],
                            'cigarrets_count_at_twenties' => $temp11[cigarettes_count_at_twenties],
                            'cigarrets_count_at_thirties' => $temp11[cigarettes_count_at_thirties],
                            'cigarrets_count_at_fourrties' => $temp11[cigarettes_count_at_fourties],
                            'cigarrets_count_at_fifties' => $temp11[cigarettes_count_at_fifties],
                            'cigarrets_count_at_sixties_and_above' => $temp11[cigarettes_count_at_sixties],
                            'cigarrets_count_one_year_before_diagnosed' => $temp11[cigarettes_count_one_year_prior],
                            'alcohol_drunk_flag' => $alcohol_drunk_flag,
                            'alcohol_frequency' => $temp11[alcohol_frequency],
                            'alcohol_comments' => $temp11[alcohol_comments],
                            'coffee_drunk_flag' => $coffee_drunk_flag,
                            'coffee_age' => $temp11[coffee_age],
                            'coffee_frequency' => $temp11[coffee_frequency],
                            'tea_drunk_flag' => $tea_drunk_flag,
                            'tea_age' => $temp11[tea_age],
                            'tea_type' => $temp11[tea_type],
                            'tea_frequency' => $temp11[tea_frequency],
                            'soya_bean_drunk_flag' => $soya_bean_drunk_flag,
                            'soya_bean_frequency' => $temp11[soya_bean_frequency],
                            'soya_products_flag' => $soya_products_flag,
                            'soya_products_average' => $temp11[soya_products_average],
                            'diabetes_flag' => $diabetes_flag,
                            'medicine_for_diabetes_flag' => $medicine_for_diabetes_flag,
                            'diabetes_medicine_name' => $temp11[diabetes_medicine_name],
                            'created_on' => $created_date
                            );
                        }
                        else
                        {
                             $data_patient_lifestyle_factors[] = array(
                            'patient_studies_id' => $patient_studies_id,
                            'questionnaire_date' => $temp11[questionnaire_date],
                            'self_image_at_7years' => $temp11[self_image_at_7],
                            'self_image_at_18years' => $temp11[self_image_at_18],
                            'self_image_now' => $temp11[self_image_now],
                            'pa_strenuous_activity_childhood' => $temp11[pa_strenuous_activity_childhood],
                            'pa_moderate_exercise_childhood' => $temp11[pa_moderate_exercise_childhood],
                            'pa_gentle_exercise_childhood' => $temp11[pa_gentle_exercise_childhood],
                            'pa_strenuous_activity_now' => $temp11[pa_strenuous_activity_now],
                            'pa_moderate_exercise_now' => $temp11[pa_moderate_exercise_now],
                            'pa_gentle_exercise_now' => $temp11[pa_gentle_exercise_now],
                            'pa_strenuous_activity_adult' => $temp11[pa_strenuous_activity_adult],
                            'pa_moderate_exercise_adult' => $temp11[pa_moderate_exercise_adult],
                            'pa_gentle_exercise_adult' => $temp11[pa_gentle_exercise_adult],
                            'cigarrets_smoked_flag' => $cigarrets_smoked_flag,
                            'cigarrets_still_smoked_flag' => $cigarrets_still_smoked_flag,
                            'total_smoked_years' => $temp11[total_smoked_years],
                            'cigarrets_count_at_teen' => $temp11[cigarettes_count_at_teen],
                            'cigarrets_count_at_twenties' => $temp11[cigarettes_count_at_twenties],
                            'cigarrets_count_at_thirties' => $temp11[cigarettes_count_at_thirties],
                            'cigarrets_count_at_fourrties' => $temp11[cigarettes_count_at_fourties],
                            'cigarrets_count_at_fifties' => $temp11[cigarettes_count_at_fifties],
                            'cigarrets_count_at_sixties_and_above' => $temp11[cigarettes_count_at_sixties],
                            'cigarrets_count_one_year_before_diagnosed' => $temp11[cigarettes_count_one_year_prior],
                            'alcohol_drunk_flag' => $alcohol_drunk_flag,
                            'alcohol_frequency' => $temp11[alcohol_frequency],
                            'alcohol_comments' => $temp11[alcohol_comments],
                            'coffee_drunk_flag' => $coffee_drunk_flag,
                            'coffee_age' => $temp11[coffee_age],
                            'coffee_frequency' => $temp11[coffee_frequency],
                            'tea_drunk_flag' => $tea_drunk_flag,
                            'tea_age' => $temp11[tea_age],
                            'tea_type' => $temp11[tea_type],
                            'tea_frequency' => $temp11[tea_frequency],
                            'soya_bean_drunk_flag' => $soya_bean_drunk_flag,
                            'soya_bean_frequency' => $temp11[soya_bean_frequency],
                            'soya_products_flag' => $soya_products_flag,
                            'soya_products_average' => $temp11[soya_products_average],
                            'diabetes_flag' => $diabetes_flag,
                            'medicine_for_diabetes_flag' => $medicine_for_diabetes_flag,
                            'diabetes_medicine_name' => $temp11[diabetes_medicine_name],
                            'created_on' => $created_date
                            );
                        }
                        $temp11 = null;
                       
                    }
                    //print_r($data_patient_lifestyle_factors);

                    if(sizeof($data_patient_lifestyle_factors) > 0)
                    {
                        $id_patient_lifestyle_factors = $this->excell_sheets_model->insert_record($data_patient_lifestyle_factors, 'patient_lifestyle_factors');
                        if ($id_patient_lifestyle_factors > 0)
                            echo 'Data added succesfully at patient_lifestyle_factors table';
                        else
                            echo 'Failed to insert at patient_lifestyle_factors table';
                        echo '<br/>';
                    }
                    
                    
                    if(sizeof($data_patient_lifestyle_factors_update) > 0)
                    {
                        $id_patient_lifestyle_factors = $this->db->update_batch('patient_lifestyle_factors',$data_patient_lifestyle_factors_update,'patient_studies_id');
                        if ($id_patient_lifestyle_factors > 0)
                            echo 'Data updated succesfully at patient_lifestyle_factors table';
                        else
                            echo 'Updated Data at patient_lifestyle_factors table';
                        echo '<br/>';
                    }
                    
                    $data_patient_lifestyle_factors = null;
                    $data_patient_lifestyle_factors_update = null;
                    $temp_result_patient_studies_id = null;
                    $temp11 = null;
                }
                else if (($loadedSheetName == 'Lifestyle2')) {
                    $data_patient_menstruation = array();
                    $data_patient_menstruation = null;
                    $data_patient_menstruation_update = array();
                    $data_patient_menstruation_update = null;
                    $data_patient_infertility = array();
                    $data_patient_infertility = null;
                    $data_patient_infertility_update = array();
                    $data_patient_infertility_update = null;
                    $data_patient_gynaecological_surgery_history = array();
                    $data_patient_gynaecological_surgery_history = null;
                    $data_patient_gynaecological_surgery_history_update = array();
                    $data_patient_gynaecological_surgery_history_update = null;
                    $data_patient_parity_table = array();
                    $data_patient_parity_table = null;
                    $data_patient_parity_table_update = array();
                    $data_patient_parity_table_update = null;
                    
                    $temp_result_pt_studies_id_patient_menstruation = array();
                    $temp_result_pt_studies_id_patient_menstruation = null;
                    $this->db->select('patient_studies_id');
                    $this->db->from('patient_menstruation');
                    $temp_result_pt_studies_id_patient_menstruation = $this->db->get()->result_array();

                    //print_r($temp_result_relationship);
                    $result_pt_studies_id_pt_menstruation = array();
                    for ($i = 0; $i < sizeof($temp_result_pt_studies_id_patient_menstruation); $i++) {
                        //echo $result_relationship[$j]['relatives_type']. '<br/>';
                        $result_pt_studies_id_pt_menstruation[$i] = $temp_result_pt_studies_id_patient_menstruation[$i]['patient_studies_id'];
                        //echo $result_studies_name[$i] . '<br/>';
                    }
                    
                    $temp_result_pt_studies_id_pt_parity_table = array();
                    $temp_result_pt_studies_id_pt_parity_table = null;
                    $this->db->select('patient_studies_id');
                    $this->db->from('patient_parity_table');
                    $temp_result_pt_studies_id_pt_parity_table = $this->db->get()->result_array();

                    //print_r($temp_result_relationship);
                    $result_pt_studies_id_pt_parity_table = array();
                    for ($i = 0; $i < sizeof($temp_result_pt_studies_id_pt_parity_table); $i++) {
                        //echo $result_relationship[$j]['relatives_type']. '<br/>';
                        $result_pt_studies_id_pt_parity_table[$i] = $temp_result_pt_studies_id_pt_parity_table[$i]['patient_studies_id'];
                        //echo $result_studies_name[$i] . '<br/>';
                    }
                    
                    $temp_result_pt_studies_id_pt_infertility = array();
                    $temp_result_pt_studies_id_pt_infertility = null;
                    $this->db->select('patient_studies_id');
                    $this->db->from('patient_infertility');
                    $temp_result_pt_studies_id_pt_infertility = $this->db->get()->result_array();

                    //print_r($temp_result_relationship);
                    $result_pt_studies_id_pt_infertility = array();
                    for ($i = 0; $i < sizeof($temp_result_pt_studies_id_pt_infertility); $i++) {
                        //echo $result_relationship[$j]['relatives_type']. '<br/>';
                        $result_pt_studies_id_pt_infertility[$i] = $temp_result_pt_studies_id_pt_infertility[$i]['patient_studies_id'];
                        //echo $result_studies_name[$i] . '<br/>';
                    }
                    
                    $temp_pt_studies_id_pt_gyn_srg_history = array();
                    $temp_pt_studies_id_pt_gyn_srg_history = null;
                    $this->db->select('patient_studies_id');
                    $this->db->from('patient_gynaecological_surgery_history');
                    $temp_pt_studies_id_pt_gyn_srg_history = $this->db->get()->result_array();

                    //print_r($temp_result_relationship);
                    $result_pt_studies_id_pt_gyn_srg_history = array();
                    for ($i = 0; $i < sizeof($temp_pt_studies_id_pt_gyn_srg_history); $i++) {
                        //echo $result_relationship[$j]['relatives_type']. '<br/>';
                        $result_pt_studies_id_pt_gyn_srg_history[$i] = $temp_pt_studies_id_pt_gyn_srg_history[$i]['patient_studies_id'];
                        //echo $result_studies_name[$i] . '<br/>';
                    }
                    $i = 0;
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp12 = array();
                        $temp12 = null;
                        foreach ($cellIterator as $key => $cell) {
                            $cell_value = $cell->getFormattedValue();

                            if ($key == 0 && $cell_value != NULL)
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);
                            //echo $key; // 0, 1, 2..
                            if ($key == 32)
                                $cell_value = 'None';

                            if ($key == 9 || $key == 19 || $key == 20 || $key == 24 || $key == 25) {
                                if ($cell_value != NULL) {
                                    $cell_value = date('Y-m-d', strtotime(str_replace('/', '-', $cell_value)));
                                }
                            }
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
                        
                        if(in_array($patient_studies_id, $result_pt_studies_id_pt_menstruation))
                        {
                           $data_patient_menstruation_update[] = array(
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
                        }
                        else
                        {
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
                        }
                        

                        if ($temp12[11] == 'Yes' || $temp12[11] == 'yes')
                            $pregnant_flag = TRUE;
                        else if ($temp12[11] == 'No' || $temp12[11] == 'no')
                            $pregnant_flag = FALSE;
                        else
                            $pregnant_flag = FALSE;

                        if(in_array($patient_studies_id, $result_pt_studies_id_pt_parity_table))
                        {
                            $data_patient_parity_table_update[] = array(
                            'patient_studies_id' => $patient_studies_id,
                            'pregnant_flag' => $pregnant_flag,
                            'created_on' => $created_date
                            );
                        }
                        else
                        {
                            $data_patient_parity_table[] = array(
                            'patient_studies_id' => $patient_studies_id,
                            'pregnant_flag' => $pregnant_flag,
                            'created_on' => $created_date
                            );
                        }
                        

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

                        if(in_array($patient_studies_id, $result_pt_studies_id_pt_infertility))
                        {
                            $data_patient_infertility_update[] = array(
                            'patient_studies_id' => $patient_studies_id,
                            'infertility_testing_flag' => $infertility_testing_flag,
                            'infertility_treatment_type' => $temp12[13],
                            'infertility_treatment_duration' => $temp12[14],
                            'infertility_comments' => $temp12[15],
                            'contraceptive_pills_flag' => $contraceptive_pills_flag,
                            'currently_taking_contraceptive_pills_flag' => $currently_taking_contraceptive_pills_flag,
                            'contraceptive_start_date' => $temp12[19],
                            'contraceptive_end_date' => $temp12[20],
                            'contraceptive_duration' => $temp12[18],
                            'hrt_flag' => $hrt_flag,
                            'currently_using_hrt_flag' => $currently_using_hrt_flag,
                            'hrt_start_date' => $temp12[24],
                            'hrt_end_date' => $temp12[25],
                            'hrt_duration' => $temp12[23],
                            'created_on' => $created_date,
                            'contraceptive_end_age' => $temp12[26],
                            'contraceptive_start_age' => $temp12[27],
                            'hrt_start_age' => $temp12[28],
                            'hrt_end_age' => $temp12[29]
                            );
                        }
                        else
                        {
                            $data_patient_infertility[] = array(
                            'patient_studies_id' => $patient_studies_id,
                            'infertility_testing_flag' => $infertility_testing_flag,
                            'infertility_treatment_type' => $temp12[13],
                            'infertility_treatment_duration' => $temp12[14],
                            'infertility_comments' => $temp12[15],
                            'contraceptive_pills_flag' => $contraceptive_pills_flag,
                            'currently_taking_contraceptive_pills_flag' => $currently_taking_contraceptive_pills_flag,
                            'contraceptive_start_date' => $temp12[19],
                            'contraceptive_end_date' => $temp12[20],
                            'contraceptive_duration' => $temp12[18],
                            'hrt_flag' => $hrt_flag,
                            'currently_using_hrt_flag' => $currently_using_hrt_flag,
                            'hrt_start_date' => $temp12[24],
                            'hrt_end_date' => $temp12[25],
                            'hrt_duration' => $temp12[23],
                            'created_on' => $created_date,
                            'contraceptive_end_age' => $temp12[26],
                            'contraceptive_start_age' => $temp12[27],
                            'hrt_start_age' => $temp12[28],
                            'hrt_end_age' => $temp12[29]
                            );
                        }
                        

                        if ($temp12[30] == 'Yes' || $temp12[30] == 'yes')
                            $had_gnc_surgery_flag = TRUE;
                        else if ($temp12[30] == 'No' || $temp12[30] == 'no')
                            $had_gnc_surgery_flag = FALSE;
                        else
                            $had_gnc_surgery_flag = FALSE;

                        $treatment_Id = $this->excell_sheets_model->get_id('treatment', 'treatment_id', 'treatment_name', $temp12[32]);
                        
                        if(in_array($patient_studies_id, $result_pt_studies_id_pt_gyn_srg_history))
                        {
                            $data_patient_gynaecological_surgery_history_update[] = array(
                            'patient_studies_id' => $patient_studies_id,
                            'had_gnc_surgery_flag' => $had_gnc_surgery_flag,
                            'surgery_year' => $temp12[31],
                            'treatment_id' => $treatment_Id,
                            'gnc_treatment_name_other_details' => $temp12[33],
                            'created_on' => $created_date
                            );
                        }
                        else
                        {
                            $data_patient_gynaecological_surgery_history[] = array(
                            'patient_studies_id' => $patient_studies_id,
                            'had_gnc_surgery_flag' => $had_gnc_surgery_flag,
                            'surgery_year' => $temp12[31],
                            'treatment_id' => $treatment_Id,
                            'gnc_treatment_name_other_details' => $temp12[33],
                            'created_on' => $created_date
                            );
                        }
                        $temp12 = null;
                    }
                    //print_r($data_patient_menstruation);
                    //print_r($data_patient_parity_table);
                    // print_r($data_patient_infertility);
                    // print_r($data_patient_gynaecological_surgery_history);
                    
                    if(sizeof($data_patient_menstruation) > 0)
                    {
                        $id_patient_menstruation = $this->excell_sheets_model->insert_record($data_patient_menstruation, 'patient_menstruation');
                        if ($id_patient_menstruation > 0)
                            echo 'Data added succesfully at patient_menstruation table';
                        else
                            echo 'Failed to insert at patient_menstruation table';
                        echo '<br/>';
                    }
           
                    
                    if(sizeof($data_patient_menstruation_update) > 0)
                    {
                        $id_patient_menstruation = $this->db->update_batch('patient_menstruation',$data_patient_menstruation_update,'patient_studies_id');
                        if ($id_patient_menstruation > 0)
                            echo 'Data updated succesfully at patient_menstruation table';
                        else
                            echo 'Updated Data at patient_menstruation table';
                        echo '<br/>';
                    }
                   
                    if(sizeof($data_patient_parity_table) > 0)
                    {
                        $id_patient_parity_table = $this->excell_sheets_model->insert_record($data_patient_parity_table, 'patient_parity_table');
                        if ($id_patient_parity_table > 0)
                            echo 'Data added succesfully at patient_parity_table table';
                        else
                            echo 'Failed to insert at patient_parity_table table';
                        echo '<br/>';
                    }


                    if(sizeof($data_patient_parity_table_update) > 0)
                    {
                        $id_patient_parity_table = $this->db->update_batch('patient_parity_table',$data_patient_parity_table_update,'patient_studies_id');
                        if ($id_patient_parity_table > 0)
                            echo 'Data updated succesfully at patient_parity_table table';
                        else
                            echo 'Updated Data at patient_parity_table table';
                        echo '<br/>';
                    }
                    
                    if(sizeof($data_patient_infertility) > 0)
                    {
                        $id_patient_infertility = $this->excell_sheets_model->insert_record($data_patient_infertility, 'patient_infertility');
                        if ($id_patient_infertility > 0)
                            echo 'Data added succesfully at patient_infertility table';
                        else
                            echo 'Failed to insert at patient_infertility table';
                        echo '<br/>'; 
                    }
                    
                    if(sizeof($data_patient_infertility_update) > 0)
                    {
                        $id_patient_infertility = $this->db->update_batch('patient_infertility',$data_patient_infertility_update,'patient_studies_id');
                        if ($id_patient_infertility > 0)
                            echo 'Data updated succesfully at patient_infertility table';
                        else
                            echo 'Updated Data at patient_infertility table';
                        echo '<br/>'; 
                    }
                    
                    if(sizeof($data_patient_gynaecological_surgery_history) > 0)
                    {
                        $id_patient_gynaecological_surgery_history = $this->excell_sheets_model->insert_record($data_patient_gynaecological_surgery_history, 'patient_gynaecological_surgery_history');
                        if ($id_patient_gynaecological_surgery_history > 0)
                            echo 'Data added succesfully at patient_gynaecological_surgery_history table';
                        else
                            echo 'Failed to insert at patient_gynaecological_surgery_history table';
                        echo '<br/>';
                    }
                    
                    if(sizeof($data_patient_gynaecological_surgery_history_update) > 0)
                    {
                        $id_patient_gynaecological_surgery_history = $this->db->update_batch('patient_gynaecological_surgery_history',$data_patient_gynaecological_surgery_history_update,'patient_studies_id');
                        if ($id_patient_gynaecological_surgery_history > 0)
                            echo 'Data updated succesfully at patient_gynaecological_surgery_history table';
                        else
                            echo 'Updated Data at patient_gynaecological_surgery_history table';
                        echo '<br/>';
                    }
                    
                    $data_patient_menstruation = null;
                    $data_patient_menstruation_update = null;
                    $data_patient_parity_table_update = null;
                    $data_patient_infertility = null;
                    $data_patient_infertility_update = null;
                    $data_patient_gynaecological_surgery_history = null;
                    $data_patient_gynaecological_surgery_history_update = null;
                    $data_patient_parity_table = null;
                    $data_patient_parity_table_update = null;
                    $temp_result_pt_studies_id_patient_menstruation = null;
                    $result_pt_studies_id_pt_menstruation = null;
                    $temp_result_pt_studies_id_pt_parity_table = null;
                    $result_pt_studies_id_pt_parity_table = null;
                    $temp_result_pt_studies_id_pt_infertility = null;
                    $result_pt_studies_id_pt_infertility = null;
                    $temp_pt_studies_id_pt_gyn_srg_history = null;
                    $result_pt_studies_id_pt_gyn_srg_history = null;
                    
                }
                else if (($loadedSheetName == 'Lifestyle3')) {
                    $data_patient_parity_record = array();
                    $data_patient_parity_record = null;
                    $data_patient_parity_record_update = array();
                    $data_patient_parity_record_update = null;
                    $temp_patient_parity_table_id = array();
                    $temp_patient_parity_table_id = null;
                    $this->db->select('patient_parity_table_id');
                    $this->db->from('patient_parity_record');
                    $temp_patient_parity_table_id = $this->db->get()->result_array();

                    //print_r($temp_result_relationship);
                    $result_patient_parity_table_id = array();
                    for ($i = 0; $i < sizeof($temp_patient_parity_table_id); $i++) {
                        $result_patient_parity_table_id[$i] = $temp_patient_parity_table_id[$i]['patient_parity_table_id'];
                    }
                    $i = 0;
                    foreach ($sheet->getRowIterator() as $row) {
                        $i++;

                        if ($i == 1)//ommiting cell header name
                            continue;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $temp13 = array();
                        $temp13 = null;
                        foreach ($cellIterator as $key => $cell) {
                            $cell_value = $cell->getFormattedValue();

                            if ($key == 0 && $cell_value != NULL)
                                $cell_value = preg_replace("/[^0-9]/", "", $cell_value);

                            if ($key == 4) {
                                if ($cell_value != NULL) {
                                    $cell_value = date('Y-m-d', strtotime(str_replace('/', '-', $cell_value)));
                                }
                            }
                            //echo $key; // 0, 1, 2..
                            $temp13[] = $cell_value;
                        }

                        $patient_ic_no = $temp13[0];
                        $studies_name = $temp13[1];
                        $studies_id = $this->excell_sheets_model->get_id('studies', 'studies_id', 'studies_name', $studies_name);
                        $patient_studies_id = $this->excell_sheets_model->get_patient_studies_id($patient_ic_no, $studies_id); //echo $patient_studies_id.'    ';
                        $patient_parity_table_id = $this->excell_sheets_model->get_patient_parity_table_id($patient_studies_id); //echo $patient_parity_table_id.'<br/>';
                        
                        if(in_array($patient_parity_table_id, $result_patient_parity_table_id))
                        {
                            $data_patient_parity_record_update[] = array(
                            'patient_parity_table_id' => $patient_parity_table_id,
                            'pregnancy_type' => $temp13[2],
                            'gender' => $temp13[3],
                            'date_of_birth' => $temp13[4],
                            'year_of_birth' => $temp13[5],
                            'age_child_at_consent' => $temp13[6],
                            'birthweight' => $temp13[7],
                            'breastfeeding_duration' => $temp13[8],
                            'created_on' => $created_date
                            );
                        }
                        else
                        {
                            $data_patient_parity_record[] = array(
                            'patient_parity_table_id' => $patient_parity_table_id,
                            'pregnancy_type' => $temp13[2],
                            'gender' => $temp13[3],
                            'date_of_birth' => $temp13[4],
                            'year_of_birth' => $temp13[5],
                            'age_child_at_consent' => $temp13[6],
                            'birthweight' => $temp13[7],
                            'breastfeeding_duration' => $temp13[8],
                            'created_on' => $created_date
                            );
                        }
                       $temp13 = null;
                    }
                    //print_r($data_patient_Lifestyle3);

                    if(sizeof($data_patient_parity_record) > 0)
                    {
                        $id_patient_parity_record = $this->excell_sheets_model->insert_record($data_patient_parity_record, 'patient_parity_record');

                        if ($id_patient_parity_record > 0)
                            echo 'Data added succesfully at patient_parity_record table';
                        else
                            echo 'Failed to insert at patient_parity_record table';
                        echo '<br/>';  
                    }
                    
                    if(sizeof($data_patient_parity_record_update) > 0)
                    {
                        $id_patient_parity_record = $this->db->update_batch('patient_parity_record',$data_patient_parity_record_update,'patient_parity_table_id');

                        if ($id_patient_parity_record > 0)
                            echo 'Data updated succesfully at patient_parity_record table';
                        else
                            echo 'Updated Data at patient_parity_record table';
                        echo '<br/>';  
                    }
                    
                    $data_patient_parity_record = null;
                    $data_patient_parity_record_update = null;
                    $temp_patient_parity_table_id = null;
                    $result_patient_parity_table_id = null;

                }
            }
            $array_IC_no = null;
            $temp_result_studies_name = null;
            $result_studies_name = null;
            $temp_result_diagnonis_name = null;
            $result_diagnonis_name = null;
            $temp_array_IC_no_db = null;
            $array_IC_no_db = null;
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
