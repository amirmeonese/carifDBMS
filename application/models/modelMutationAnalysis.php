<?php

class ModelMutationAnalysis extends CI_Model {

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

    public function mutation($sheet) {
        $created_date = date('Y-m-d H:i:s');
        $abort = FALSE;
        $data_patient_mutation_analysis = array();
        $data_patient_mutation_analysis = null;
        $data_patient_mutation_analysis_updated = array();
        $data_patient_mutation_analysis_updated = null;
        $temp_result_patient_studies_id = array();
        $temp_result_patient_studies_id = null;
        $temp9 = array();
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
        $temp_result_patient_studies_id = null;

        $i = 0;
        foreach ($sheet->getRowIterator() as $row) {
            $i++;

            if ($i == 1)//ommiting cell header name
                continue;

            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            $temp9 = null;
            foreach ($cellIterator as $key => $cell) {
                $cell_value = $cell->getFormattedValue();

                if ($key == 0 && $cell_value != NULL)
                    $cell_value = preg_replace("/[^0-9]/", "", $cell_value);

                if ($key == 1 && $cell_value != NULL)
                    $cell_value = trim($cell_value);

                if ($key == 2 || $key == 7 || $key == 20 || $key == 21) {
                    //echo $key.'     From line 1045<br/>';
                    /* if (strpos($cell_value, '-') !== FALSE)
                      $cell_value = date("d/m/Y", strtotime($cell_value));
                      list($day, $month, $year) = explode("/", $cell_value);

                      if (!checkdate($month, $day, $year)) {
                      echo '<h2>date_test_ordered or  or  or  is not in appropriate format at </h2>';
                      if ($key == 2)
                      $this->modelValidator->showMessage("date_test_ordered", "Mutation analysis", $i);
                      if ($key == 7)
                      $this->modelValidator->showMessage("testing_date", "Mutation analysis", $i);
                      if ($key == 20)
                      $this->modelValidator->showMessage("report_date", "Mutation analysis", $i);
                      if ($key == 21)
                      $this->modelValidator->showMessage("date_notified", "Mutation analysis", $i);
                      $abort = TRUE;
                      break;
                      } */
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
                $temp9[] = $cell_value;
            }

            if ($abort)
                break;

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

            if (in_array($patient_studies_id, $result_patient_studies_id)) {
                $patient_investigations_id = $this->excell_sheets_model->get_id('patient_mutation_analysis', 'patient_investigations_id', 'patient_studies_id', $patient_studies_id);
                $data_patient_mutation_analysis_updated[] = array(
                    'patient_investigations_id' => $patient_investigations_id,
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
            } else {
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
        if (!$abort) {
            if (sizeof($data_patient_mutation_analysis) > 0) {
                $id_patient_mutation_analysis = $this->excell_sheets_model->insert_record($data_patient_mutation_analysis, 'patient_mutation_analysis');
                if ($id_patient_mutation_analysis > 0)
                    echo 'Data added succesfully at patient_mutation_analysis table';
                else
                    echo 'Failed to insert at patient_mutation_analysis table';
                echo '<br/>';
                $data_patient_mutation_analysis = null;
            }


            if (sizeof($data_patient_mutation_analysis_updated) > 0) {
                $id_patient_mutation_analysis = $this->db->update_batch('patient_mutation_analysis', $data_patient_mutation_analysis_updated, 'patient_investigations_id');
                if ($id_patient_mutation_analysis > 0)
                    echo 'Data updated succesfully at patient_mutation_analysis table';
                else
                    echo 'Updated Data at patient_mutation_analysis table';
                echo '<br/>';
                $data_patient_mutation_analysis_updated = null;
            }
        }


        $data_patient_mutation_analysis = null;
        $data_patient_mutation_analysis_updated = null;
        $temp_result_patient_studies_id = null;
        $result_patient_studies_id = null;
    }

}

?>
