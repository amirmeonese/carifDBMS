<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Excell_parser extends CI_Controller {

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
        //Loading PHPExcell Library
        $this->load->library('PHPExcel');
    }

    function index() {
        //$this->load->view('record/record_home');
        $inputFileType = 'Excel2007';

        $inputFileName = './sampleData/carif_dummy_data_sample.xlsx';

        echo 'Loading file ', pathinfo($inputFileName, PATHINFO_BASENAME), ' using IOFactory with a defined reader type of ', $inputFileType, '<br />';
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        echo 'Loading all WorkSheets<br />';
        $objReader->setLoadAllSheets();
        $objPHPExcel = $objReader->load($inputFileName);
        echo '<hr />';
        echo $objPHPExcel->getSheetCount(), ' worksheet', (($objPHPExcel->getSheetCount() == 1) ? '' : 's'), ' loaded<br /><br />';

        $loadedSheetNames = $objPHPExcel->getSheetNames();

        foreach ($loadedSheetNames as $sheetIndex => $loadedSheetName) {
            $objPHPExcel->setActiveSheetIndex($sheetIndex);
            $sheet = $objPHPExcel->getActiveSheet();
            echo '<pre>';
            $i = 0;

            if ($loadedSheetName == 'Personal & Family Details') {
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
                    // echo $temp1[0];
                    //echo $temp1[9];
                    //patient table data
                    $patient_table_data[] = array(
                        'fullname' => $temp1[0],
                        'surname' => $temp1[1],
                        'maiden_name' => $temp1[2],
                        'nationality' => $temp1[3],
                        'ic_no' => $temp1[4],
                        'address' => $temp1[5],
                        'gender' => $temp1[6],
                        'cell_phone' => $temp1[7],
                        'home_phone' => $temp1[8],
                        'd_o_b' => $temp1[9],
                    );

                    $patient_contact_person_data[] = array(
                        'patient_ic_no' => $temp1[4],
                        'name' => $temp1[10],
                        'relationship' => $temp1[11],
                        'telephone' => $temp1[12]
                    );

                    $relatives_id = $this->excell_sheets_model->get_patient_relatives_id($temp1[11]);
                    //echo "<br/><br/>";
                    //echo $relatives_id;
                    if ($relatives_id == 1) {
                        $relatives_id_data1 = 1;
                        $relatives_id_data2 = 2;
                    } else if ($relatives_id == 2) {
                        $relatives_id_data1 = 1;
                        $relatives_id_data2 = 2;
                    } else if ($relatives_id == 3) {
                        $relatives_id_data1 = 3;
                        $relatives_id_data2 = 4;
                    } else if ($relatives_id == 4) {
                        $relatives_id_data1 = 3;
                        $relatives_id_data2 = 4;
                    }

                    $family_no = $this->excell_sheets_model->get_patient_family_no($temp1[27]);
                    $father_is_cancer_diagnosed = $temp1[18];

                    if ($father_is_cancer_diagnosed == 'yes')
                        $is_cancer_diagnosed = TRUE;
                    else if ($father_is_cancer_diagnosed == 'no')
                        $is_cancer_diagnosed = FALSE;

                    $cancer_type_id1 = $this->excell_sheets_model->get_patient_relatives_cancer_id($temp1[19]);
                    $patient_relatives_data1[] = array(
                        'patient_ic_no' => $temp1[4],
                        'relatives_id' => $relatives_id_data1,
                        'family_no' => $family_no,
                        'full_name' => $temp1[13],
                        'sur_name' => $temp1[14],
                        'maiden_name' => $temp1[15],
                        'ethnicity' => $temp1[16],
                        'town_of_residence' => $temp1[17],
                        'is_cancer_diagnosed' => $is_cancer_diagnosed,
                        'cancer_type_id' => $cancer_type_id1
                    );

                    $mother_is_cancer_diagnosed = $temp1[25];

                    if ($mother_is_cancer_diagnosed == 'yes')
                        $is_cancer_diagnosed = TRUE;
                    else if ($mother_is_cancer_diagnosed == 'no')
                        $is_cancer_diagnosed = FALSE;

                    $cancer_type_id2 = $this->excell_sheets_model->get_patient_relatives_cancer_id($temp1[26]);

                    $patient_relatives_data2[] = array(
                        'patient_ic_no' => $temp1[4],
                        'relatives_id' => $relatives_id_data2,
                        'family_no' => $family_no,
                        'full_name' => $temp1[20],
                        'sur_name' => $temp1[21],
                        'maiden_name' => $temp1[22],
                        'ethnicity' => $temp1[23],
                        'town_of_residence' => $temp1[24],
                        'cancer_type_id' => $cancer_type_id2
                    );

                    echo '<BR/>';
                }
                //print_r($patient_table_data);
                $id1_patient = $this->excell_sheets_model->insert_patient_record($patient_table_data);
                if ($id1_patient > 0) {
                    echo "Data Added successfully at patient_table";
                } else {
                    echo "Failed to insert at patient_table";
                }
                echo '<br/>';
                //print_r($patient_relatives_data1);
                //print_r($patient_relatives_data2);


                $id2_patient_relatives_insert = $this->excell_sheets_model->insert_patient_relatives_record($patient_relatives_data1);
                if ($id2_patient_relatives_insert > 0) {
                    echo "Data1 Added successfully at patient_relatives  Table<BR/><BR/>";
                } else {
                    echo "Failed to insert Data1 at patient_relatives  Table<BR/><BR/>";
                }echo '<br/>';
                $id3_patient_relatives_insert = $this->excell_sheets_model->insert_patient_relatives_record($patient_relatives_data2);
                if ($id3_patient_relatives_insert > 0) {
                    echo "Data2 Added successfully at patient_relatives  Table<BR/><BR/>";
                } else {
                    echo "Failed to insert Data2 at patient_relatives  Table<BR/><BR/>";
                }
            } else if ($loadedSheetName == 'Studies') {
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

                    echo '<BR/>';
                    $studies_id = $this->excell_sheets_model->get_studies_id($temp2[1]);
                    //echo $studies_id.'<br/>';
                    if ($temp2[9] == 'yes')
                        $relation_to_study_flag = TRUE;
                    else if ($temp2[9] == 'no')
                        $relation_to_study_flag = FALSE;
                    else
                        $relation_to_study_flag = FALSE;

                    if ($temp2[9] == 'yes' || $temp2[9] == 'Yes')
                        $double_consent_flag = TRUE;
                    else if ($temp2[9] == 'no' || $temp2[9] == 'No')
                        $double_consent_flag = FALSE;
                    else
                        $double_consent_flag = FALSE;

                    $patient_studies_table_data[] = array(
                        'patient_ic_no' => $temp2[0],
                        'studies_id' => $studies_id,
                        'date_at_consent' => $temp2[2],
                        'age_at_consent' => $temp2[3],
                        'double_consent_flag' => $double_consent_flag,
                        'double_consent_detail' => $temp2[5],
                        'consent_given_by' => $temp2[6],
                        'consent_response' => $temp2[7],
                        'consent_version' => $temp2[8],
                        'relation_to_study_flag' => $relation_to_study_flag,
                        'referral_to' => $temp2[10],
                        'referral_to_service' => $temp2[11],
                        'referral_date' => $temp2[12],
                        'referral_source' => $temp2[13]
                    );
                }
                //print_r($patient_studies_table_data);
                $patient_studies_insert_id = $this->excell_sheets_model->insert_patient_studies($patient_studies_table_data);
                if ($patient_studies_insert_id > 0) {
                    echo "Data Added successfully at patient_studies_table";
                } else {
                    echo "Failed to insert at patient_studies_table";
                }
            }
        }
    }

}

?>
