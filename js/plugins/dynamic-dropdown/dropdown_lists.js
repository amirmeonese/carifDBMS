function applyDynamicDropdown()
{
	if (!window.location.origin)
		window.location.origin = window.location.protocol+"//"+window.location.host;
		
	// =================================================== //
	// ================ FORMS SETUP ====================== //
	// == FIlls in dropdowns with values from json file == //
	// =================================================== //
	$.getJSON(window.location.origin + "/carifDBMS/js/plugins/dynamic-dropdown/data.json", function(data) 
	{	
		var vals = [];
		
		$.each(data, function(key, value){
			
			vals = value.split(",");
			
			$("[id=" + key + "]").each(function( i, listItem )
			{
				var $elementObj = $( listItem );
				var preloadVal = $elementObj.attr("preload_val");
				
				$elementObj.empty();
				$.each(vals, function(index, value) {
					$elementObj.append("<option>" + value + "</option>");
				});
				
				if(preloadVal)
					$elementObj.val(preloadVal);
			});			
		});
	});
	
	
}

$( document ).ready(function() {
	
	if (!window.location.origin)
		window.location.origin = window.location.protocol+"//"+window.location.host;
   
   applyDynamicDropdown();
	// ======================== //
	//== ADMIN PANEL SETUPS ==//
	// ======================== //
	$("#first-choice").change(function() {
		var $dropdown = $(this);
		var key = $dropdown.val();
		
		$.getJSON(window.location.origin + "/carifDBMS/js/plugins/dynamic-dropdown/data.json", function(data) {

			var vals = [];
								
			switch(key) {
				case 'nationality':
					vals = data.nationality.split(",");
					break;
				case 'gender':
					vals = data.gender.split(",");
					break;
				case 'marital_status':
					vals = data.marital_status.split(",");
					break;
				case 'COGS_study_id':
					vals = data.COGS_study_id.split(",");
					break;
				case 'income_level':
					vals = data.income_level.split(",");
					break;
				case 'status_source':
					vals = data.status_source.split(",");
					break;
				case 'alive_status':
					vals = data.alive_status.split(",");
					break;
				case 'studies_name':
					vals = data.studies_name.split(",");
					break;
				case 'patient_cancer_name_lists':
					vals = data.patient_cancer_name_lists.split(",");
					break;
				case 'cancer_site':
					vals = data.cancer_site.split(",");
					break;
				case 'cancer_invasive_type':
					vals = data.cancer_invasive_type.split(",");
					break;
				case 'detected_by':
					vals = data.detected_by.split(",");
					break;
				case 'pathology_path_report_type_lists':
					vals = data.pathology_path_report_type_lists.split(",");
					break;
				case 'pathology_morphology_lists':
					vals = data.pathology_morphology_lists.split(",");
					break;
				case 'pathology_tissue_tumour_stage_lists':
					vals = data.pathology_tissue_tumour_stage_lists.split(",");
					break;
				case 'pathology_node_stage_lists':
					vals = data.pathology_node_stage_lists.split(",");
					break;
				case 'pathology_metastasis_stage_lists':
					vals = data.pathology_metastasis_stage_lists.split(",");
					break;
				case 'pathology_tumour_stage_lists':
					vals = data.pathology_tumour_stage_lists.split(",");
					break;
				case 'pathology_tumour_grade_lists':
					vals = data.pathology_tumour_grade_lists.split(",");
					break;
				case 'patient_cancer_treatment_name_lists':
					vals = data.patient_cancer_treatment_name_lists.split(",");
					break;
				case 'ovary_stage_classification_lists':
					vals = data.ovary_stage_classification_lists.split(",");
					break;
				case 'ovary_tumor_subtypes_lists':
					vals = data.ovary_tumor_subtypes_lists.split(",");
					break;
				case 'ovary_tumor_behavior_lists':
					vals = data.ovary_tumor_behavior_lists.split(",");
					break;
				case 'ovary_tumor_differentiation_lists':
					vals = data.ovary_tumor_differentiation_lists.split(",");
					break;					
				case 'diagnosis_name_lists':
					vals = data.diagnosis_name_lists.split(",");
					break;
				case 'mammo_left_right_breast_side_lists':
					vals = data.mammo_left_right_breast_side_lists.split(",");
					break;
				case 'mammo_upper_below_breast_side_lists':
					vals = data.mammo_upper_below_breast_side_lists.split(",");
					break;
				case 'non_cancerous_benign_site_lists':
					vals = data.non_cancerous_benign_site_lists.split(",");
					break;
				case 'non_cancerous_complete_removal_reason_lists':
					vals = data.non_cancerous_complete_removal_reason_lists.split(",");
					break;
				case 'ovarian_screening_type_name_lists':
					vals = data.ovarian_screening_type_name_lists.split(",");
					break;
				case 'screening_name_lists':
					vals = data.screening_name_lists.split(",");
					break;
				case 'surveillance_recruitment_center_lists':
					vals = data.surveillance_recruitment_center_lists.split(",");
					break;
				case 'surveillance_type_lists':
					vals = data.surveillance_type_lists.split(",");
					break;
				case 'investigation_project_name_lists':
					vals = data.investigation_project_name_lists.split(",");
					break;
				case 'investigation_gene_tested_lists':
					vals = data.investigation_gene_tested_lists.split(",");
					break;
				case 'investigation_test_type_lists':
					vals = data.investigation_test_type_lists.split(",");
					break;
				case 'investigation_sample_type_lists':
					vals = data.investigation_sample_type_lists.split(",");
					break
				case 'investigation_test_results_lists':
					vals = data.investigation_test_results_lists.split(",");
					break;
				case 'investigation_mutation_pathogenicity_lists':
					vals = data.investigation_mutation_pathogenicity_lists.split(",");
					break;
				case 'investigation_mutation_nomenclature_lists':
					vals = data.investigation_mutation_nomenclature_lists.split(",");
					break;
				case 'investigation_carrier_status_lists':
					vals = data.investigation_carrier_status_lists.split(",");
					break;
				case 'self_image_lists':
					vals = data.self_image_lists.split(",");
					break;
				case 'pa_activities_lists':
					vals = data.pa_activities_lists.split(",");
					break;
				case 'cigarettes_average_count_lists':
					vals = data.cigarettes_average_count_lists.split(",");
					break;
				case 'alcohol_drink_average_lists':
					vals = data.alcohol_drink_average_lists.split(",");
					break;
				case 'coffee_tea_drink_average_lists':
					vals = data.coffee_tea_drink_average_lists.split(",");
					break;
				case 'tea_type_lists':
					vals = data.tea_type_lists.split(",");
					break;
				case 'soya_products_lists':
					vals = data.soya_products_lists.split(",");
					break;
				case 'period_type_lists':
					vals = data.period_type_lists.split(",");
					break;
				case 'period_cycle_days_lists':
					vals = data.period_cycle_days_lists.split(",");
					break;
				case 'reason_period_stops_lists':
					vals = data.reason_period_stops_lists.split(",");
					break;
				case 'gnc_treatment_lists':
					vals = data.gnc_treatment_lists.split(",");
					break;
                                case 'pregnancy_type':
                                        vals = data.pregnancy_type.split(",");
                                        break;
				case 'base':
					vals = ['Please choose from above'];
			}
			
			var $secondChoice = $("#second-choice");
			$secondChoice.empty();
			$.each(vals, function(index, value) {
				$secondChoice.append("<option>" + value + "</option>");
			});

		});
	});
   
	if($(".dialog-form").dialog)
	{
		$(".dialog-form").dialog({
      autoOpen: false,
      height: 200,
      width: 350,
      modal: true,
      buttons: {
        "Save changes": function() {
			var passedID = $(this).data('id');
			var selectedValue = $('#second-choice').val();
			var newItemName = rename_item_name.value;
			
			$.getJSON(window.location.origin + "/carifDBMS/js/plugins/dynamic-dropdown/data.json", function(data) 
			{	
				var vals = [];
				
				switch(passedID) {
					case 'nationality':
						vals = data.nationality.split(",");
						break;
					case 'gender':
						vals = data.gender.split(",");
						break;
					case 'marital_status':
						vals = data.marital_status.split(",");
						break;
					case 'COGS_study_id':
						vals = data.COGS_study_id.split(",");
						break;
					case 'income_level':
						vals = data.income_level.split(",");
						break;
					case 'status_source':
						vals = data.status_source.split(",");
						break;
					case 'alive_status':
						vals = data.alive_status.split(",");
						break;
					case 'studies_name':
						vals = data.studies_name.split(",");
						break;
					case 'patient_cancer_name_lists':
						vals = data.patient_cancer_name_lists.split(",");
						break;
					case 'cancer_site':
						vals = data.cancer_site.split(",");
						break;
					case 'cancer_invasive_type':
						vals = data.cancer_invasive_type.split(",");
						break;
					case 'detected_by':
						vals = data.detected_by.split(",");
						break;
					case 'pathology_path_report_type_lists':
						vals = data.pathology_path_report_type_lists.split(",");
						break;
					case 'pathology_morphology_lists':
						vals = data.pathology_morphology_lists.split(",");
						break;
					case 'pathology_tissue_tumour_stage_lists':
						vals = data.pathology_tissue_tumour_stage_lists.split(",");
						break;
					case 'pathology_node_stage_lists':
						vals = data.pathology_node_stage_lists.split(",");
						break;
					case 'pathology_metastasis_stage_lists':
						vals = data.pathology_metastasis_stage_lists.split(",");
						break;
					case 'pathology_tumour_stage_lists':
						vals = data.pathology_tumour_stage_lists.split(",");
						break;
					case 'pathology_tumour_grade_lists':
						vals = data.pathology_tumour_grade_lists.split(",");
						break;
					case 'patient_cancer_treatment_name_lists':
						vals = data.patient_cancer_treatment_name_lists.split(",");
						break;
					case 'ovary_stage_classification_lists':
						vals = data.ovary_stage_classification_lists.split(",");
						break;
					case 'ovary_tumor_subtypes_lists':
						vals = data.ovary_tumor_subtypes_lists.split(",");
						break;
					case 'ovary_tumor_behavior_lists':
						vals = data.ovary_tumor_behavior_lists.split(",");
						break;
					case 'ovary_tumor_differentiation_lists':
						vals = data.ovary_tumor_differentiation_lists.split(",");
						break;			
					case 'diagnosis_name_lists':
						vals = data.diagnosis_name_lists.split(",");
						break;
					case 'mammo_left_right_breast_side_lists':
						vals = data.mammo_left_right_breast_side_lists.split(",");
						break;
					case 'mammo_upper_below_breast_side_lists':
						vals = data.mammo_upper_below_breast_side_lists.split(",");
						break;
					case 'non_cancerous_benign_site_lists':
						vals = data.non_cancerous_benign_site_lists.split(",");
						break;
					case 'non_cancerous_complete_removal_reason_lists':
						vals = data.non_cancerous_complete_removal_reason_lists.split(",");
						break;
					case 'ovarian_screening_type_name_lists':
						vals = data.ovarian_screening_type_name_lists.split(",");
						break;
					case 'screening_name_lists':
						vals = data.screening_name_lists.split(",");
						break;
					case 'surveillance_recruitment_center_lists':
						vals = data.surveillance_recruitment_center_lists.split(",");
						break;
					case 'surveillance_type_lists':
						vals = data.surveillance_type_lists.split(",");
						break;
					case 'investigation_project_name_lists':
						vals = data.investigation_project_name_lists.split(",");
						break;
					case 'investigation_gene_tested_lists':
						vals = data.investigation_gene_tested_lists.split(",");
						break;
					case 'investigation_test_type_lists':
						vals = data.investigation_test_type_lists.split(",");
						break;
					case 'investigation_sample_type_lists':
						vals = data.investigation_sample_type_lists.split(",");
						break;
					case 'investigation_test_results_lists':
						vals = data.investigation_test_results_lists.split(",");
						break;
					case 'investigation_mutation_pathogenicity_lists':
						vals = data.investigation_mutation_pathogenicity_lists.split(",");
						break;
					case 'investigation_mutation_nomenclature_lists':
						vals = data.investigation_mutation_nomenclature_lists.split(",");
						break;
					case 'investigation_carrier_status_lists':
						vals = data.investigation_carrier_status_lists.split(",");
						break;
					case 'self_image_lists':
						vals = data.self_image_lists.split(",");
						break;
					case 'pa_activities_lists':
						vals = data.pa_activities_lists.split(",");
						break;
					case 'cigarettes_average_count_lists':
						vals = data.cigarettes_average_count_lists.split(",");
						break;
					case 'alcohol_drink_average_lists':
						vals = data.alcohol_drink_average_lists.split(",");
						break;
					case 'coffee_tea_drink_average_lists':
						vals = data.coffee_tea_drink_average_lists.split(",");
						break;
					case 'tea_type_lists':
						vals = data.tea_type_lists.split(",");
						break;
					case 'soya_products_lists':
						vals = data.soya_products_lists.split(",");
						break;
					case 'period_type_lists':
						vals = data.period_type_lists.split(",");
						break;
					case 'period_cycle_days_lists':
						vals = data.period_cycle_days_lists.split(",");
						break;
					case 'reason_period_stops_lists':
						vals = data.reason_period_stops_lists.split(",");
						break;
					case 'gnc_treatment_lists':
						vals = data.gnc_treatment_lists.split(",");
						break;
                                        case 'pregnancy_type':
						vals = data.pregnancy_type.split(",");
						break;
				}
				
				$.each(vals, function(index, value) {
					if(value == selectedValue)
						vals[index] = newItemName;
				});
				
				var appendedText = '';
				$.each(vals, function(index, value) {
				
					appendedText = appendedText + value + ',';
				});
				
				//Call PHP to modify JSON file
				$.ajax({ url: window.location.origin + '/carifDBMS/js/plugins/dynamic-dropdown/process.php',
					 data: {action: 'dropdown',id:passedID, text: appendedText},
					 type: 'post',
					 success: function(output) {
						alert('Changes saved!');
						//Redraw dropdown
						var $secondChoice = $("#second-choice");
						$secondChoice.empty();
						$.each(vals, function(index, value) {
							$secondChoice.append("<option>" + value + "</option>");
						});
				
					  }
				});
				
			});

			$( this ).dialog( "close" );
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      },
      close: function() {
        
      }
    });
	
	}
	
	if($(".dialog-form-add-new").dialog)
	{
		$( ".dialog-form-add-new" ).dialog({
      autoOpen: false,
      height: 200,
      width: 350,
      modal: true,
      buttons: {
        "Save changes": function() {
			var passedID = $(this).data('id');
			var newItemName = add_item_name.value;
			
			$.getJSON(window.location.origin + "/carifDBMS/js/plugins/dynamic-dropdown/data.json", function(data) 
			{	
				var vals = [];
				
				switch(passedID) {
					case 'nationality':
						vals = data.nationality.split(",");
						break;
					case 'gender':
						vals = data.gender.split(",");
						break;
					case 'marital_status':
						vals = data.marital_status.split(",");
						break;
					case 'COGS_study_id':
						vals = data.COGS_study_id.split(",");
						break;
					case 'income_level':
						vals = data.income_level.split(",");
						break;
					case 'status_source':
						vals = data.status_source.split(",");
						break;
					case 'alive_status':
						vals = data.alive_status.split(",");
						break;
					case 'studies_name':
						vals = data.studies_name.split(",");
						break;
					case 'patient_cancer_name_lists':
						vals = data.patient_cancer_name_lists.split(",");
						break;
					case 'cancer_site':
						vals = data.cancer_site.split(",");
						break;
					case 'cancer_invasive_type':
						vals = data.cancer_invasive_type.split(",");
						break;
					case 'detected_by':
						vals = data.detected_by.split(",");
						break;
					case 'pathology_path_report_type_lists':
						vals = data.pathology_path_report_type_lists.split(",");
						break;
					case 'pathology_morphology_lists':
						vals = data.pathology_morphology_lists.split(",");
						break;
					case 'pathology_tissue_tumour_stage_lists':
						vals = data.pathology_tissue_tumour_stage_lists.split(",");
						break;
					case 'pathology_node_stage_lists':
						vals = data.pathology_node_stage_lists.split(",");
						break;
					case 'pathology_metastasis_stage_lists':
						vals = data.pathology_metastasis_stage_lists.split(",");
						break;	
					case 'pathology_tumour_stage_lists':
						vals = data.pathology_tumour_stage_lists.split(",");
						break;
					case 'pathology_tumour_grade_lists':
						vals = data.pathology_tumour_grade_lists.split(",");
						break;
					case 'patient_cancer_treatment_name_lists':
						vals = data.patient_cancer_treatment_name_lists.split(",");
						break;
					case 'ovary_stage_classification_lists':
						vals = data.ovary_stage_classification_lists.split(",");
						break;
					case 'ovary_tumor_subtypes_lists':
						vals = data.ovary_tumor_subtypes_lists.split(",");
						break;
					case 'ovary_tumor_behavior_lists':
						vals = data.ovary_tumor_behavior_lists.split(",");
						break;
					case 'ovary_tumor_differentiation_lists':
						vals = data.ovary_tumor_differentiation_lists.split(",");
						break;			
					case 'diagnosis_name_lists':
						vals = data.diagnosis_name_lists.split(",");
						break;
					case 'mammo_left_right_breast_side_lists':
						vals = data.mammo_left_right_breast_side_lists.split(",");
						break;
					case 'mammo_upper_below_breast_side_lists':
						vals = data.mammo_upper_below_breast_side_lists.split(",");
						break;
					case 'non_cancerous_benign_site_lists':
						vals = data.non_cancerous_benign_site_lists.split(",");
						break;
					case 'non_cancerous_complete_removal_reason_lists':
						vals = data.non_cancerous_complete_removal_reason_lists.split(",");
						break;
					case 'ovarian_screening_type_name_lists':
						vals = data.ovarian_screening_type_name_lists.split(",");
						break;
					case 'screening_name_lists':
						vals = data.screening_name_lists.split(",");
						break;
					case 'surveillance_recruitment_center_lists':
						vals = data.surveillance_recruitment_center_lists.split(",");
						break;
					case 'surveillance_type_lists':
						vals = data.surveillance_type_lists.split(",");
						break;
					case 'investigation_project_name_lists':
						vals = data.investigation_project_name_lists.split(",");
						break;
					case 'investigation_gene_tested_lists':
						vals = data.investigation_gene_tested_lists.split(",");
						break;
					case 'investigation_test_type_lists':
						vals = data.investigation_test_type_lists.split(",");
						break;
					case 'investigation_sample_type_lists':
						vals = data.investigation_sample_type_lists.split(",");
						break;
					case 'investigation_test_results_lists':
						vals = data.investigation_test_results_lists.split(",");
						break;
					case 'investigation_mutation_pathogenicity_lists':
						vals = data.investigation_mutation_pathogenicity_lists.split(",");
						break;
					case 'investigation_mutation_nomenclature_lists':
						vals = data.investigation_mutation_nomenclature_lists.split(",");
						break;
					case 'investigation_carrier_status_lists':
						vals = data.investigation_carrier_status_lists.split(",");
						break;
					case 'self_image_lists':
						vals = data.self_image_lists.split(",");
						break;
					case 'pa_activities_lists':
						vals = data.pa_activities_lists.split(",");
						break;
					case 'cigarettes_average_count_lists':
						vals = data.cigarettes_average_count_lists.split(",");
						break;
					case 'alcohol_drink_average_lists':
						vals = data.alcohol_drink_average_lists.split(",");
						break;
					case 'coffee_tea_drink_average_lists':
						vals = data.coffee_tea_drink_average_lists.split(",");
						break;
					case 'tea_type_lists':
						vals = data.tea_type_lists.split(",");
						break;
					case 'soya_products_lists':
						vals = data.soya_products_lists.split(",");
						break;
					case 'period_type_lists':
						vals = data.period_type_lists.split(",");
						break;
					case 'period_cycle_days_lists':
						vals = data.period_cycle_days_lists.split(",");
						break;
					case 'reason_period_stops_lists':
						vals = data.reason_period_stops_lists.split(",");
						break;
					case 'gnc_treatment_lists':
						vals = data.gnc_treatment_lists.split(",");
						break;
                                        case 'pregnancy_type':
						vals = data.pregnancy_type.split(",");
						break;
				}
				
				//Add item into end of array
				vals.push( newItemName );
				
				var appendedText = '';
				$.each(vals, function(index, value) {
				
					appendedText = appendedText + value + ',';
				});
				
				//Call PHP to modify JSON file
				$.ajax({ url: window.location.origin + '/carifDBMS/js/plugins/dynamic-dropdown/process.php',
					 data: {action: 'dropdown',id:passedID, text: appendedText},
					 type: 'post',
					 success: function(output) {
						alert('Changes saved!');
						//Redraw dropdown
						var $secondChoice = $("#second-choice");
						$secondChoice.empty();
						$.each(vals, function(index, value) {
							$secondChoice.append("<option>" + value + "</option>");
						});
				
					  }
				});
				
			});
			
			$( this ).dialog( "close" );
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      },
      close: function() {
       
      }
    });

	}
	$( ".rename" ).button().click(function() {
		
		var selectedID = $('#first-choice').val();
		var selectedValue = $('#second-choice').val();
		
		if(selectedValue == '')
			alert('Please select item to be renamed.');
		else
		{
			$("#rename_item_name").val(selectedValue);
			$( ".dialog-form" ).data('id', selectedID).dialog( "open" );
		}
	});

	$( ".add-new" ).button().click(function() {
		var selectedID = $('#first-choice').val();
		$( ".dialog-form-add-new" ).data('id', selectedID).dialog( "open" );
	});
	
	$( ".delete" ).button().click(function() {
		var selectedID = $('#first-choice').val();
		var selectedValue = $('#second-choice').val();
		
		if(selectedValue == '')
			alert('Please select item to be deleted.');
		else
			deleteItem(selectedID, selectedValue);
	});
	
	function deleteItem(passedID, selectedValue)
	{
		$.getJSON(window.location.origin + "/carifDBMS/js/plugins/dynamic-dropdown/data.json", function(data) 
		{	
			var vals = [];
			
			switch(passedID) {
				case 'nationality':
					vals = data.nationality.split(",");
					break;
				case 'gender':
					vals = data.gender.split(",");
					break;
				case 'marital_status':
					vals = data.marital_status.split(",");
					break;
				case 'COGS_study_id':
					vals = data.COGS_study_id.split(",");
					break;
				case 'income_level':
					vals = data.income_level.split(",");
					break;
				case 'status_source':
					vals = data.status_source.split(",");
					break;
				case 'alive_status':
					vals = data.alive_status.split(",");
					break;
				case 'studies_name':
					vals = data.studies_name.split(",");
					break;
				case 'patient_cancer_name_lists':
					vals = data.patient_cancer_name_lists.split(",");
					break;
				case 'cancer_site':
					vals = data.cancer_site.split(",");
					break;
				case 'cancer_invasive_type':
					vals = data.cancer_invasive_type.split(",");
					break;
				case 'detected_by':
					vals = data.detected_by.split(",");
					break;
				case 'pathology_path_report_type_lists':
					vals = data.pathology_path_report_type_lists.split(",");
					break;
				case 'pathology_morphology_lists':
					vals = data.pathology_morphology_lists.split(",");
					break;
				case 'pathology_tissue_tumour_stage_lists':
					vals = data.pathology_tissue_tumour_stage_lists.split(",");
					break;
				case 'pathology_node_stage_lists':
					vals = data.pathology_node_stage_lists.split(",");
					break;
				case 'pathology_metastasis_stage_lists':
					vals = data.pathology_metastasis_stage_lists.split(",");
					break;
				case 'pathology_tumour_stage_lists':
					vals = data.pathology_tumour_stage_lists.split(",");
					break;
				case 'pathology_tumour_grade_lists':
					vals = data.pathology_tumour_grade_lists.split(",");
					break;
				case 'patient_cancer_treatment_name_lists':
					vals = data.patient_cancer_treatment_name_lists.split(",");
					break;
				case 'ovary_stage_classification_lists':
					vals = data.ovary_stage_classification_lists.split(",");
					break;
				case 'ovary_tumor_subtypes_lists':
					vals = data.ovary_tumor_subtypes_lists.split(",");
					break;
				case 'ovary_tumor_behavior_lists':
					vals = data.ovary_tumor_behavior_lists.split(",");
					break;
				case 'ovary_tumor_differentiation_lists':
					vals = data.ovary_tumor_differentiation_lists.split(",");
					break;			
				case 'diagnosis_name_lists':
					vals = data.diagnosis_name_lists.split(",");
					break;
				case 'mammo_left_right_breast_side_lists':
					vals = data.mammo_left_right_breast_side_lists.split(",");
					break;
				case 'mammo_upper_below_breast_side_lists':
					vals = data.mammo_upper_below_breast_side_lists.split(",");
					break;
				case 'non_cancerous_benign_site_lists':
					vals = data.non_cancerous_benign_site_lists.split(",");
					break;
				case 'non_cancerous_complete_removal_reason_lists':
					vals = data.non_cancerous_complete_removal_reason_lists.split(",");
					break;
				case 'ovarian_screening_type_name_lists':
					vals = data.ovarian_screening_type_name_lists.split(",");
					break;
				case 'screening_name_lists':
					vals = data.screening_name_lists.split(",");
					break;
				case 'surveillance_recruitment_center_lists':
					vals = data.surveillance_recruitment_center_lists.split(",");
					break;
				case 'surveillance_type_lists':
					vals = data.surveillance_type_lists.split(",");
					break;
				case 'investigation_project_name_lists':
					vals = data.investigation_project_name_lists.split(",");
					break;
				case 'investigation_gene_tested_lists':
					vals = data.investigation_gene_tested_lists.split(",");
					break;
				case 'investigation_test_type_lists':
					vals = data.investigation_test_type_lists.split(",");
					break;
				case 'investigation_sample_type_lists':
					vals = data.investigation_sample_type_lists.split(",");
					break;
				case 'investigation_test_results_lists':
					vals = data.investigation_test_results_lists.split(",");
					break;
				case 'investigation_mutation_pathogenicity_lists':
					vals = data.investigation_mutation_pathogenicity_lists.split(",");
					break;
				case 'investigation_mutation_nomenclature_lists':
					vals = data.investigation_mutation_nomenclature_lists.split(",");
					break;
				case 'investigation_carrier_status_lists':
					vals = data.investigation_carrier_status_lists.split(",");
					break;
				case 'self_image_lists':
					vals = data.self_image_lists.split(",");
					break;
				case 'pa_activities_lists':
					vals = data.pa_activities_lists.split(",");
					break;
				case 'cigarettes_average_count_lists':
					vals = data.cigarettes_average_count_lists.split(",");
					break;
				case 'alcohol_drink_average_lists':
					vals = data.alcohol_drink_average_lists.split(",");
					break;	
				case 'coffee_tea_drink_average_lists':
					vals = data.coffee_tea_drink_average_lists.split(",");
					break;
				case 'tea_type_lists':
					vals = data.tea_type_lists.split(",");
					break;
				case 'soya_products_lists':
					vals = data.soya_products_lists.split(",");
					break;
				case 'period_type_lists':
					vals = data.period_type_lists.split(",");
					break;
				case 'period_cycle_days_lists':
					vals = data.period_cycle_days_lists.split(",");
					break;
				case 'reason_period_stops_lists':
					vals = data.reason_period_stops_lists.split(",");
					break;
				case 'gnc_treatment_lists':
					vals = data.gnc_treatment_lists.split(",");
					break;
                                case 'pregnancy_type':
                                        vals = data.pregnancy_type.split(",");
                                        break;
				case 'base':
					vals = ['Please choose from above'];
			}
			
			//Delete item
			$.each(vals, function(index, value) {
					if(value == selectedValue)
						vals.splice(index,1);
				});
			
			var appendedText = '';
			$.each(vals, function(index, value) {
			
				appendedText = appendedText + value + ',';
			});
			
			//Call PHP to modify JSON file
			$.ajax({ url: window.location.origin + '/carifDBMS/js/plugins/dynamic-dropdown/process.php',
				 data: {action: 'dropdown',id:passedID, text: appendedText},
				 type: 'post',
				 success: function(output) {
					alert('Changes saved!');
					//Redraw dropdown
					var $secondChoice = $("#second-choice");
					$secondChoice.empty();
					$.each(vals, function(index, value) {
						$secondChoice.append("<option>" + value + "</option>");
					});
			
				  }
			});
			
		});
	}
	
});