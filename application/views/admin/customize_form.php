<div class="container" id="submit_report_div">
	<div id="add_record_header" class="row">
		<p>Form Fields Customization</p>
	</div>
	<div class="container">
		<div height="30px">&nbsp;</div>
<!--		<table border="1" align="lefts" width="30%">
			<tr>
                <td colspan="2" id="design-customized-form-table">Basic Field</td>
            </tr>
            <tr>
                <td>Text Box</td>
                <td>Text Area</td>
            </tr>
            <tr>
                <td>Number</td>
                <td>Dropdown</td>
            </tr>
            <tr>
                <td>Radio Button</td>
                <td>Checkbox</td>
            </tr>
		</table>-->
		<div height="30px">&nbsp;</div>
		<table>
			<tr><td id="label1">Dropdowns</td></tr>
			<tr>
				<td colspan="2">
					<select id="first-choice">
					<option selected value="base">Please Select</option>
					<optgroup label="General">
						<option value="studies_name">Studies Names</option>
					</optgroup>
					<optgroup label="Personal">
						<option value="nationality">Nationality</option>
						<option value="gender">Gender</option>
						<option value="marital_status">Marital Status</option>
						<option value="COGS_study_id">COGS Study ID</option>
						<option value="income_level">Income Level</option>
						<option value="status_source">Status Source</option>
						<option value="alive_status">Alive Status</option>
					</optgroup>
                                        <optgroup label="Family">
						<option value="relative_degrees">Relative Degrees</option>
					</optgroup>
					<optgroup label="Diagnosis">
						<option value="patient_cancer_name_lists">Cancer Names</option>
						<option value="cancer_site">Cancer Sites</option>
						<option value="cancer_invasive_type">Cancer Invasive Types</option>
						<option value="detected_by">Detected By</option>
						<option value="pathology_path_report_type_lists">Pathology Type of Report</option>
						<option value="pathology_morphology_lists">Morphology</option>
						<option value="pathology_tissue_tumour_stage_lists">T Staging</option>
						<option value="pathology_node_stage_lists">N Staging</option>
						<option value="pathology_metastasis_stage_lists">M Staging</option>
						<option value="pathology_tumour_stage_lists">Tumour Stage</option>
						<option value="pathology_tumour_grade_lists">Tumour Grade</option>
						<option value="patient_cancer_treatment_name_lists">Treatment Type</option>
						<option value="ovary_stage_classification_lists">Pathology Stage Classification</option>
						<option value="diagnosis_name_lists">Type of Diseases</option>
					</optgroup>
					<optgroup label="Screenings">
						<option value="mammo_left_right_breast_side_lists">Breast Left/Right Sides</option>
						<option value="mammo_upper_below_breast_side_lists">Breast Upper/Below Sides</option>
						<option value="non_cancerous_benign_site_lists">Non-Cancerous Sides</option>
						<option value="non_cancerous_complete_removal_reason_lists">Removal Reasons</option>
						<option value="ovarian_screening_type_name_lists">Ovarian Screenings Type</option>
						<option value="screening_name_lists">Other Screening Type</option>
						<option value="surveillance_recruitment_center_lists">Recruitment Centers</option>
						<option value="surveillance_type_lists">Surveillance Type</option>
                                                <option value="reason_mammo">Reason for Mammogram</option>
					</optgroup>
					<optgroup label="Mutation">
						<option value="investigation_project_name_lists">Service Providers</option>
						<option value="investigation_gene_tested_lists">Gene Tested</option>
						<option value="investigation_test_type_lists">Types of Testing</option>
						<option value="investigation_sample_type_lists">Sample Type</option>
						<option value="investigation_test_results_lists">Test Results</option>
						<option value="investigation_mutation_pathogenicity_lists">Mutation Pathogenicity</option>
						<option value="investigation_mutation_nomenclature_lists">Mutation Nomenclature</option>
						<option value="investigation_carrier_status_lists">Carrier Status</option>
					</optgroup>
					<optgroup label="Lifestyle Factors">
						<option value="self_image_lists">Self Image</option>
						<option value="pa_activities_lists">Physical Activities</option>
						<option value="cigarettes_average_count_lists">Smoking Average</option>
						<option value="alcohol_drink_average_lists">Alcohol Average</option>
						<option value="coffee_tea_drink_average_lists">Coffee/Tea Average</option>
						<option value="tea_type_lists">Tea Type</option>	
						<option value="soya_products_lists">Soy Products Average</option>
						<option value="period_type_lists">Period Regularity</option>
						<option value="period_cycle_days_lists">Period Cycle Days</option>
						<option value="reason_period_stops_lists">Reason Period Stops</option>
						<option value="gnc_treatment_lists">GNC Surgery Type</option>
						<option value="pregnancy_type">Pregnancy Type</option>
					</optgroup>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<select id="second-choice">
					<option>Please choose from above</option>
					</select>
				</td>
				<td><button id="renameBtnID" class="rename">Rename</button><button id="addBtnID" class="add-new">Add new</button><button id="deleteBtnID" class="delete">Delete</button></td>
			</tr>
		</table>	
		<p><a class="doneButton" href="<?php echo base_url(). '/admin/'; ?>">Back</a></p>
	</div>
 </div>


