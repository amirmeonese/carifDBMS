<div class="container" id="submit_report_div">
	<div id="add_record_header" class="row">
		<p>Form Fields Customization</p>
	</div>
	<div class="container">
		<div height="30px">&nbsp;</div>
		<table border="1" align="lefts" width="30%">
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
		</table>
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
					</optgroup>
					<optgroup label="Mutation">
					</optgroup>
					<optgroup label="Lifestyle Factors">
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


