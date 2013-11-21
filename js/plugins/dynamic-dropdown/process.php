<?php
	function renameDropdownItem($id, $text) {
        
		//Trim last comma
		$text = rtrim($text, ",");
		
		// Loading existing data:
		$json = file_get_contents("data.json");
		$data = json_decode($json, true);
		
		switch($id){
			case 'nationality':
				$data['nationality'] = $text;
				break;
			case 'gender':
				$data['gender'] = $text;
				break;
			case 'marital_status':
				$data['marital_status'] = $text;
				break;
			case 'COGS_study_id':
				$data['COGS_study_id'] = $text;
				break;
			case 'income_level':
				$data['income_level'] = $text;
				break;
			case 'status_source':
				$data['status_source'] = $text;
				break;
			case 'alive_status':
				$data['alive_status'] = $text;
				break;
			case 'studies_name':
				$data['studies_name'] = $text;
				break;
			case 'patient_cancer_name_lists':
				$data['patient_cancer_name_lists'] = $text;
				break;
			case 'cancer_site':
				$data['cancer_site'] = $text;
				break;
			case 'cancer_invasive_type':
				$data['cancer_invasive_type'] = $text;
				break;
			case 'detected_by':
				$data['detected_by'] = $text;
				break;
			case 'pathology_path_report_type_lists':
				$data['pathology_path_report_type_lists'] = $text;
				break;
			case 'pathology_morphology_lists':
				$data['pathology_morphology_lists'] = $text;
				break;
			case 'pathology_tissue_tumour_stage_lists':
				$data['pathology_tissue_tumour_stage_lists'] = $text;
				break;
			case 'pathology_node_stage_lists':
				$data['pathology_node_stage_lists'] = $text;
				break;
			case 'pathology_metastasis_stage_lists':
				$data['pathology_metastasis_stage_lists'] = $text;
				break;
			case 'pathology_tumour_stage_lists':
				$data['pathology_tumour_stage_lists'] = $text;
				break;
			case 'pathology_tumour_grade_lists':
				$data['pathology_tumour_grade_lists'] = $text;
				break;
			case 'patient_cancer_treatment_name_lists':
				$data['patient_cancer_treatment_name_lists'] = $text;
				break;
			case 'ovary_stage_classification_lists':
				$data['ovary_stage_classification_lists'] = $text;
				break;
			case 'diagnosis_name_lists':
				$data['diagnosis_name_lists'] = $text;
				break;
			case 'mammo_left_right_breast_side_lists':
				$data['mammo_left_right_breast_side_lists'] = $text;
				break;
			case 'mammo_upper_below_breast_side_lists':
				$data['mammo_upper_below_breast_side_lists'] = $text;
				break;
			case 'non_cancerous_benign_site_lists':
				$data['non_cancerous_benign_site_lists'] = $text;
				break;
			case 'non_cancerous_complete_removal_reason_lists':
				$data['non_cancerous_complete_removal_reason_lists'] = $text;
				break;
			case 'ovarian_screening_type_name_lists':
				$data['ovarian_screening_type_name_lists'] = $text;
				break;
			case 'screening_name_lists':
				$data['screening_name_lists'] = $text;
				break;
			case 'surveillance_recruitment_center_lists':
				$data['surveillance_recruitment_center_lists'] = $text;
				break;
			case 'surveillance_type_lists':
				$data['surveillance_type_lists'] = $text;
				break;
			case 'investigation_project_name_lists':
				$data['investigation_project_name_lists'] = $text;
				break;
			case 'investigation_gene_tested_lists':
				$data['investigation_gene_tested_lists'] = $text;
				break;
			case 'investigation_test_type_lists':
				$data['investigation_test_type_lists'] = $text;
				break;
			case 'investigation_sample_type_lists':
				$data['investigation_sample_type_lists'] = $text;
				break;
			case 'investigation_test_results_lists':
				$data['investigation_test_results_lists'] = $text;
				break;
			case 'investigation_mutation_pathogenicity_lists':
				$data['investigation_mutation_pathogenicity_lists'] = $text;
				break;
			case 'investigation_mutation_nomenclature_lists':
				$data['investigation_mutation_nomenclature_lists'] = $text;
				break;
			case 'investigation_carrier_status_lists':
				$data['investigation_carrier_status_lists'] = $text;
				break;
				
			
		}
		
		// Writing modified data:
		file_put_contents('data.json', json_encode($data, JSON_FORCE_OBJECT));

		return true;
    }
	
	if(isset($_POST['action']) && !empty($_POST['action'])) {
		$action = $_POST['action'];
		$id = $_POST['id'];
		$text = $_POST['text'];
		
		switch($action) {
			case 'dropdown' : 
			{
				renameDropdownItem($id, $text);
				break;
			}
			case 'add' : addItem();break;
		}	
	}

	
?>