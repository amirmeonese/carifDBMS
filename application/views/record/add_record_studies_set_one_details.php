<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>Add Studies, Mammo, Cancer & Diagnosis Details</p>
    </div>
    <?php echo form_open_multipart("record/studies_set_one_insertion"); ?>
    <div class="container" id="add_record_form_section_studies">
        <div height="30px">&nbsp;</div>
		<?php
		echo form_fieldset('Studies Details');
		?>
		<table>
            <tr>
				<td>
                    <?php echo $studies_name; ?>: 
                    <?php echo form_dropdown('studies_name', $studies_name_lists); ?>
                </td>
                <td>
                    <?php echo $date_at_consent; ?>: 
                    <?php echo form_input('date_at_consent'); ?>
                </td>
				<td>
                    <?php echo $age_at_consent; ?>: 
                    <?php echo form_input('age_at_consent'); ?>
                </td>
				<td>
                    <?php echo $is_double_consent_flag; ?>: 
                    <?php echo form_checkbox('is_double_consent_flag','no',FALSE); ?>
                </td>
			</tr>
            <tr>
				<td>
					<?php echo $double_consent_details; ?>: 
					<?php 
						$data = array(
							'name'        => 'double_consent_details',
							'id'          => 'double_consent_details',
							'rows'        => '3',
							'cols'        => '7'
						  );
						echo form_textarea($data); ?>
				</td>
				<td>
					<?php echo $consent_given_by; ?>: 
					<?php echo form_input('consent_given_by'); ?>
				</td>
				<td>
					<?php echo $consent_response; ?>: 
					<?php echo form_input('consent_response'); ?>
				</td>
				<td>
					<?php echo $consent_version; ?>: 
					<?php echo form_input('consent_version'); ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo $relations_to_study; ?>: 
					<?php 
					echo form_input('relations_to_study');
					?>
				</td>
				<td>
					<?php echo $referral_to; ?>: 
					<?php 
					echo form_input('referral_to');
					?>
				</td>
				<td>
					<?php echo $referral_to_service; ?>: 
					<?php echo form_input('referral_to_service'); ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo $referral_date; ?>: 
					<?php echo form_input('referral_date'); ?>
				</td>
				<td>
					<?php echo $referral_source; ?>: 
					<?php 
					echo form_input('referral_source');
					?>
				</td>
			</tr>
        </table>
		<?php echo form_fieldset_close(); ?>	
	</div>
	<div class="container" id="add_record_form_section_mammo">
		<div height="30px">&nbsp;</div>
		<?php
		echo form_fieldset('Mammogram Details');
		?>
		<table id="mammo_first_section">
			<tr>
				<td>
                    <?php echo $year_of_first_mammogram; ?>: 
					<?php echo form_input('year_of_first_mammogram'); ?>
                </td>
                <td>
                    <?php echo $age_at_first_mammogram; ?>: 
                    <?php echo form_input('age_at_first_mammogram'); ?>
                </td>
				<td>
                    <?php echo $date_of_recent_mammogram; ?>: 
                    <?php echo form_input('date_of_recent_mammogram'); ?>
                </td>
				<td>
                    <?php echo $screening_center; ?>: 
                    <?php echo form_input('screening_center'); ?>
                </td>
			</tr>
			<tr>
				<td>
                    <?php echo $name_of_radiologist; ?>: 
					<?php echo form_input('name_of_radiologist'); ?>
                </td>
                <td>
                    <?php echo $action_suggested_on_mammo_report; ?>: 
					<?php 
						$data = array(
							'name'        => 'action_suggested_on_mammo_report',
							'id'          => 'action_suggested_on_mammo_report',
							'rows'        => '3',
							'cols'        => '7'
						  );
						echo form_textarea($data); 
						?>
                </td>
			</tr>
            <tr>
				<td>
					<?php echo $total_no_of_mammogram; ?>: 
					<?php echo form_input('total_no_of_mammogram'); ?>
				</td>
				<td>
					<?php echo $screening_interval; ?>: 
					<?php echo form_input('screening_interval'); ?>
				</td>
				<td>
					<?php echo $abnormality_mammo_flag; ?>: 
					<?php echo form_checkbox('abnormality_mammo_flag','no',FALSE); ?>
				</td>
			</tr>
		</table>
		<table id="mammo_second_section_1">
			<tr>
				<td>
                    <?php echo $mammo_left_right_breast_side; ?>: 
					<?php echo form_dropdown('mammo_left_right_breast_side', $mammo_left_right_breast_side_lists); ?>
                </td>
                <td>
                    <?php echo $mammo_upper_below_breast_side; ?>: 
                    <?php echo form_dropdown('mammo_upper_below_breast_side', $mammo_upper_below_breast_side_lists); ?>
                </td>
				<td>
                    <?php echo $mammo_breast_other_descriptions; ?>: 
                    <?php 
						$data = array(
							'name'        => 'mammo_breast_other_descriptions',
							'id'          => 'mammo_breast_other_descriptions',
							'rows'        => '3',
							'cols'        => '7'
						  );
						echo form_textarea($data); 
					?>
                </td>
				<td>
					<input type="button" value="Add more site details" onClick="window.parent.addBreastSiteInput('add_record_form_section_mammo');window.parent.calcHeight();">
	
				</td>
			</tr>
		</table>
		<?php echo form_fieldset_close(); ?>	
	</div>
	<div class="container" id="add_record_form_section_mammo_attach_raw_processed_images">
		<div height="30px">&nbsp;</div>
		<table id="mammo_images_section">
			<tr>
				<td id="label1">Attach raw images</td>
			</tr>
			<tr>
				<td>
                    <?php echo $upload_raw_images_one; ?>: 
                    <?php  
						$fileData1 = array('name' => 'raw_images_one', 'class' => 'file'); // set your file and class for the image
						echo form_upload($fileData1); // upload the data here the image that user has selected.
					?>
                </td>
			</tr>
			<tr>
				<td>
                    <?php echo $upload_raw_images_two; ?>: 
                    <?php  
						$fileData1 = array('name' => 'raw_images_two', 'class' => 'file'); // set your file and class for the image
						echo form_upload($fileData1); // upload the data here the image that user has selected.
					?>
                </td>
			</tr>
			<tr>
				<td>
                    <?php echo $upload_raw_images_three; ?>: 
                    <?php  
						$fileData1 = array('name' => 'raw_images_three', 'class' => 'file'); // set your file and class for the image
						echo form_upload($fileData1); // upload the data here the image that user has selected.
					?>
                </td>
			</tr>
			<tr>
				<td>
                    <?php echo $upload_raw_images_four; ?>: 
                    <?php  
						$fileData1 = array('name' => 'raw_images_four', 'class' => 'file'); // set your file and class for the image
						echo form_upload($fileData1); // upload the data here the image that user has selected.
					?>
                </td>
			</tr>			
		</table>
		<div height="30px">&nbsp;</div>
		<table>
			<tr>
				<td id="label1">Attach processed images</td>
			</tr>
			<tr>
				<td>
                    <?php echo $upload_processed_images_one; ?>: 
                    <?php  
						$fileData2 = array('name' => 'processed_images_one', 'class' => 'file'); // set your file and class for the image
						echo form_upload($fileData2); // upload the data here the image that user has selected.
					?>
                </td>
			</tr>
			<tr>
				<td>
                    <?php echo $upload_processed_images_two; ?>: 
                    <?php  
						$fileData2 = array('name' => 'processed_images_two', 'class' => 'file'); // set your file and class for the image
						echo form_upload($fileData2); // upload the data here the image that user has selected.
					?>
                </td>
			</tr>
			<tr>
				<td>
                    <?php echo $upload_processed_images_three; ?>: 
                    <?php  
						$fileData2 = array('name' => 'processed_images_three', 'class' => 'file'); // set your file and class for the image
						echo form_upload($fileData2); // upload the data here the image that user has selected.
					?>
                </td>
			</tr><tr>
				<td>
                    <?php echo $upload_processed_images_four; ?>: 
                    <?php  
						$fileData2 = array('name' => 'processed_images_four', 'class' => 'file'); // set your file and class for the image
						echo form_upload($fileData2); // upload the data here the image that user has selected.
					?>
                </td>
			</tr>
		</table>
	</div>
	<div class="container" id="add_record_form_section_mammo_ultrasound">
		<div height="30px">&nbsp;</div>
		<table id="mammo_third_section">
			<tr>
				<td id="label1">Ultrasound Details</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>
                    <?php echo $had_ultrasound_flag; ?>: 
                    <?php echo form_checkbox('had_ultrasound_flag','no',FALSE); ?>
                </td>
				<td>
                    <?php echo $total_no_of_ultrasound; ?>: 
                    <?php echo form_input('total_no_of_ultrasound'); ?>
                </td>
				<td>
					<?php echo $abnormality_ultrasound_flag; ?>: 
					 <?php echo form_checkbox('abnormality_ultrasound_flag','no',FALSE); ?>
				</td>
			</tr>
		</table>
		<table id="mammo_ultrasound_second_section_1">
			<tr>
				<td>
                    <?php echo $mammo_ultrasound_details; ?>: 
                    <?php 
						$data = array(
							'name'        => 'mammo_ultrasound_details',
							'id'          => 'mammo_ultrasound_details',
							'rows'        => '3',
							'cols'        => '7'
						  );
						echo form_textarea($data); 
					?>
                </td>
				<td>
					<input type="button" value="Add more ultrasound details" onClick="window.parent.addUltrasoundDetailsInput('add_record_form_section_mammo_ultrasound');window.parent.calcHeight();">
				</td>
			</tr>
		</table>
	</div>
	<div class="container" id="add_record_form_section_mammo_MRI">
		<div height="30px">&nbsp;</div>
		<table id="mammo_fourth_section">
			<tr>
				<td id="label1">MRI Details</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>
                    <?php echo $had_MRI_flag; ?>: 
                    <?php echo form_checkbox('had_MRI_flag','no',FALSE); ?>
                </td>
				<td>
                    <?php echo $total_no_of_MRI; ?>: 
                    <?php echo form_input('total_no_of_MRI'); ?>
                </td>
				<td>
					<?php echo $abnormality_MRI_flag; ?>: 
					 <?php echo form_checkbox('abnormality_MRI_flag','no',FALSE); ?>
				</td>
			</tr>
		</table>
		<table id="mammo_MRI_second_section_1">
			<tr>
				<td>
                    <?php echo $mammo_MRI_details; ?>: 
                    <?php 
						$data = array(
							'name'        => 'mammo_MRI_details',
							'id'          => 'mammo_MRI_details',
							'rows'        => '3',
							'cols'        => '7'
						  );
						echo form_textarea($data); 
					?>
                </td>
				<td>
					<input type="button" value="Add more MRI details" onClick="window.parent.addMRIDetailsInput('add_record_form_section_mammo_MRI');window.parent.calcHeight();">
				</td>
			</tr>
		</table>
	</div>
	<div class="container" id="add_record_form_section_mammo_benign_cyst_surgery">
		<div height="30px">&nbsp;</div>
		<table id="mammo_fifth_section_1">
			<tr>
				<td id="label1">Surgery Details</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>
                    <?php echo $had_surgery_for_benign_lump_or_cyst_flag; ?>: 
                    <?php echo form_checkbox('had_surgery_for_benign_lump_or_cyst_flag','no',FALSE); ?>
                </td>
			</tr>
			<tr>
				<td>
                    <?php echo $mammo_benign_lump_cyst_details; ?>: 
                    <?php 
						$data = array(
							'name'        => 'mammo_benign_lump_cyst_details',
							'id'          => 'mammo_benign_lump_cyst_details',
							'rows'        => '3',
							'cols'        => '7'
						  );
						echo form_textarea($data); 
					?>
                </td>
				<td>
					<input type="button" value="Add more details" onClick="window.parent.addLumpCystDetailsInput('add_record_form_section_mammo_benign_cyst_surgery');window.parent.calcHeight();">
				</td>
			</tr>
		</table>
	</div>
	<div class="container" id="add_record_form_section_mammo_other_screenings">
		<div height="30px">&nbsp;</div>
		<table id="mammo_sixth_section">
			<tr>
				<td id="label1">Other Screenings Details</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>
                    <?php echo $other_screening_flag; ?>: 
                    <?php echo form_checkbox('other_screening_flag','no',FALSE); ?>
                </td>
			</tr>
		</table>
		<table id="mammo_other_screenings_section_1">
			<tr>
				<td>
                    <?php echo $screening_name; ?>: 
                    <?php echo form_input('screening_name'); ?>
                </td>
				<td>
                    <?php echo $total_no_of_screening; ?>: 
                    <?php echo form_input('total_no_of_screening'); ?>
                </td>
				<td>
                    <?php echo $age_at_screening; ?>: 
                    <?php echo form_input('age_at_screening'); ?>
                </td>
				<td>
                    <?php echo $place_of_screening; ?>: 
                    <?php echo form_input('place_of_screening'); ?>
                </td>
			</tr>
			<tr>
				<td>
                    <?php echo $screening_results; ?>: 
                    <?php 
						$data = array(
							'name'        => 'screening_results',
							'id'          => 'screening_results',
							'rows'        => '3',
							'cols'        => '7'
						  );
						echo form_textarea($data); 
					?>
                </td>
				<td>
					<input type="button" value="Add more screening details" onClick="window.parent.addScreeningDetailsInput('add_record_form_section_mammo_other_screenings');window.parent.calcHeight();">
				</td>
			</tr>
		</table>
	</div>
	<div class="container" id="add_record_form_section_cancer">
		<div height="30px">&nbsp;</div>
		<?php
		echo form_fieldset('Cancer Details');
		?>
		<table id="cancer_section">
			<tr>
				<td>
                    <?php echo $breast_cancer_diagnosed_flag; ?>: 
                    <?php echo form_checkbox('breast_cancer_diagnosed_flag','no',FALSE); ?>
                </td>
				<td>
                    <?php echo $patient_cancer_name; ?>: 
                    <?php echo form_dropdown('patient_cancer_name', $patient_cancer_name_lists); ?>
                </td>
				<td>
                    <?php echo $primary_diagnosis; ?>: 
                    <?php echo form_checkbox('primary_diagnosis','no',FALSE); ?>
                </td>
			</tr>
		</table>
		<table id="cancer_section_1">
				<td>
                    <?php echo $cancer_site; ?>: 
                    <?php echo form_dropdown('cancer_site', $patient_cancer_site_lists); ?>
                </td>
				<td>
                    <?php echo $cancer_site_details; ?>: 
                     <?php 
						$data = array(
							'name'        => 'cancer_site_details',
							'id'          => 'cancer_site_details',
							'rows'        => '3',
							'cols'        => '7'
						  );
						echo form_textarea($data); 
					?>
                </td>
				<td>
					<input type="button" value="Add more cancer details" onClick="window.parent.addCancerDetailsInput('add_record_form_section_cancer');window.parent.calcHeight();">
				</td>
			</tr>
		</table>
	</div>
	<div class="container" id="add_record_form_section_cancer_two">
		<div height="30px">&nbsp;</div>
		<table id="cancer_section_two">
			<tr>
				<td>
                    <?php echo $age_of_diagnosis; ?>: 
                     <?php echo form_input('age_of_diagnosis'); ?>
                </td>
				<td>
                    <?php echo $date_of_diagnosis; ?>: 
                     <?php echo form_input('date_of_diagnosis'); ?>
                </td>
				<td>
                    <?php echo $cancer_diagnosis_center; ?>: 
                     <?php echo form_input('cancer_diagnosis_center'); ?>
                </td>
			</tr>
			<tr>
				<td>
                    <?php echo $cancer_doctor_name; ?>: 
                     <?php echo form_input('cancer_doctor_name'); ?>
                </td>
				<td>
                    <?php echo $detected_by; ?>: 
                     <?php echo form_input('detected_by'); ?>
                </td>
			</tr>
		</table>
		<table id="cancer_second_section_three_1">
			<tr>
				<td>
                    <?php echo $patient_cancer_treatment_name; ?>: 
                    <?php echo form_dropdown('patient_cancer_treatment_name', $patient_cancer_treatment_name_lists); ?>
                </td>
				<td>
                    <?php echo $treatment_start_date; ?>: 
                     <?php echo form_input('treatment_start_date'); ?>
                </td>
				<td>
                    <?php echo $treatment_end_date; ?>: 
                     <?php echo form_input('treatment_end_date'); ?>
                </td>
			</tr>
			<tr>
				<td>
                    <?php echo $treatment_drug_dose; ?>: 
                     <?php echo form_input('treatment_drug_dose'); ?>
                </td>
				<td>
					<input type="button" value="Add more cancer treatment" onClick="window.parent.addCancerTreatmentInput('add_record_form_section_cancer_two');window.parent.calcHeight();">
				</td>
			</tr>
		</table>
	</div>
	<div class="container" id="add_record_form_section_cancer_three">
		<div height="30px">&nbsp;</div>
		<table id="cancer_section_four">
			<tr>
				<td>
                    <?php echo $is_recurrence_flag; ?>: 
                    <?php echo form_checkbox('is_recurrence_flag','no',FALSE); ?>
                </td>
				<td>
                    <?php echo $recurrence_site; ?>: 
                     <?php echo form_input('recurrence_site'); ?>
                </td>
				<td>
                    <?php echo $recurrence_date; ?>: 
                     <?php echo form_input('recurrence_date'); ?>
                </td>
			</tr>
		</table>
		<table id="cancer_second_section_five_1">
			<tr>
				<td>
                    <?php echo $patient_cancer_recurrence_treatment_name; ?>: 
                    <?php echo form_dropdown('patient_cancer_recurrence_treatment_name', $patient_cancer_treatment_name_lists); ?>
                </td>
				<td>
					<input type="button" value="Add more cancer recurrence treatment" onClick="window.parent.addCancerRecurrenceInput('add_record_form_section_cancer_three');window.parent.calcHeight();">
				</td>
			</tr>
		</table>
	</div>
	<?php echo form_fieldset_close(); ?>
	<div class="container" id="add_record_form_section_diagnosis">
	<div height="30px">&nbsp;</div>
	<?php
	echo form_fieldset('Diagnosis Details');
	?>
	<table id="diagnosis_section">
		<tr>
			<td>
				<?php echo $patient_other_diagnosis_name; ?>: 
				<?php echo form_dropdown('diagnosis_name', $diagnosis_name_lists); ?>
			</td>
			<td>
				<?php echo $diagnosis_details; ?>: 
				<?php 
					$data = array(
						'name'        => 'diagnosis_details',
						'id'          => 'diagnosis_details',
						'rows'        => '3',
						'cols'        => '7'
					  );
					echo form_textarea($data); 
				?>
			</td>
			<td>
				<?php echo $diagnosis_age; ?>: 
				 <?php echo form_input('diagnosis_age'); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $year_of_diagnosis; ?>: 
				 <?php echo form_input('year_of_diagnosis'); ?>
			</td>
			<td>
				<?php echo $is_on_medication_flag; ?>: 
				<?php echo form_checkbox('is_on_medication_flag','no',FALSE); ?>
			</td>
			<td>
				<?php echo $medication_details; ?>: 
				<?php 
					$data = array(
						'name'        => 'medication_details',
						'id'          => 'medication_details',
						'rows'        => '3',
						'cols'        => '7'
					  );
					echo form_textarea($data); 
				?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $diagnosis_center; ?>: 
				 <?php echo form_input('diagnosis_center'); ?>
			</td>
			<td>
				<?php echo $diagnosis_doctor_name; ?>: 
				 <?php echo form_input('diagnosis_doctor_name'); ?>
			</td>
		</tr>
	</table>
	<?php echo form_fieldset_close(); ?>	
	</div>
	<div class="container" id="add_record_form_section_pathology">
	<div height="30px">&nbsp;</div>
	<?php
	echo form_fieldset('Pathology Details');
	?>
	<table id="pathology_section">
		<tr>
			<td>
				<?php echo $pathology_tissue_site; ?>: 
				<?php 
					$data = array(
						'name'        => 'pathology_tissue_site',
						'id'          => 'pathology_tissue_site',
						'rows'        => '3',
						'cols'        => '7'
					  );
					echo form_textarea($data); 
				?>
			</td>
			<td>
				<?php echo $pathology_tissue_tumour_stage; ?>: 
				<?php echo form_dropdown('pathology_tissue_tumour_stage', $pathology_tissue_tumour_stage_lists); ?>
			</td>
			<td>
				<?php echo $pathology_morphology; ?>: 
				<?php echo form_dropdown('pathology_morphology', $pathology_morphology_lists); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $pathology_node_stage; ?>: 
				<?php echo form_dropdown('pathology_node_stage', $pathology_node_stage_lists); ?>
			</td>
			<td>
				<?php echo $pathology_lymph_node; ?>: 
				<?php echo form_dropdown('pathology_lymph_node', $pathology_lymph_node_lists); ?>
			</td>
			<td>
				<?php echo $pathology_total_lymph_nodes; ?>: 
				 <?php echo form_input('pathology_total_lymph_nodes'); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $pathology_ER_status; ?>: 
				 <?php echo form_input('pathology_ER_status'); ?>
			</td>
			<td>
				<?php echo $pathology_PR_status; ?>: 
				 <?php echo form_input('pathology_PR_status'); ?>
			</td>
			<td>
				<?php echo $pathology_HER2_status; ?>: 
				<?php echo form_input('pathology_HER2_status'); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $pathology_number_of_tumours; ?>: 
				<?php echo form_input('pathology_number_of_tumours'); ?>
			</td>
			<td>
				<?php echo $pathology_metastasis_stage; ?>: 
				<?php echo form_dropdown('pathology_metastasis_stage', $pathology_metastasis_stage_lists); ?>
			</td>
			<td>
				<?php echo $pathology_side_affected; ?>: 
				<?php echo form_dropdown('pathology_side_affected', $pathology_side_affected_lists); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $pathology_tumour_stage; ?>: 
				<?php echo form_dropdown('pathology_tumour_stage', $pathology_tumour_stage_lists); ?>
			</td>
			<td>
				<?php echo $pathology_tumour_grade; ?>: 
				<?php echo form_dropdown('pathology_tumour_grade', $pathology_tumour_grade_lists); ?>
			</td>
			<td>
				<?php echo $pathology_tumour_size; ?>: 
				<?php echo form_input('pathology_tumour_size'); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $pathology_doctor; ?>: 
				<?php echo form_input('pathology_doctor'); ?>
			</td>
			<td>
				<?php echo $pathology_lab; ?>: 
				<?php echo form_input('pathology_lab'); ?>
			</td>
			<td>
				<?php echo $pathology_lab_reference; ?>: 
				<?php echo form_input('pathology_lab_reference'); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $pathology_path_report_date; ?>: 
				<?php echo form_input('pathology_path_report_date'); ?>
			</td>
			<td>
				<?php echo $pathology_path_report_type; ?>: 
				<?php echo form_dropdown('pathology_path_report_type', $pathology_path_report_type_lists); ?>
			</td>
			<td>
				<?php echo $pathology_report_requested_date; ?>: 
				<?php echo form_input('pathology_report_requested_date'); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $pathology_path_report_received_date; ?>: 
				<?php echo form_input('pathology_path_report_received_date'); ?>
			</td>
			<td>
				<?php echo $pathology_path_block_requested_date ?>: 
				<?php echo form_input('pathology_path_block_requested_date'); ?>
			</td>
			<td>
				<?php echo $pathology_path_block_received_date ?>: 
				<?php echo form_input('pathology_path_block_received_date'); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $pathology_tissue_path_comments; ?>: 
				<?php 
					$data = array(
						'name'        => 'pathology_tissue_path_comments',
						'id'          => 'pathology_tissue_path_comments',
						'rows'        => '3',
						'cols'        => '7'
					  );
					echo form_textarea($data); 
				?>
			</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>
	<?php echo form_fieldset_close(); ?>	
	</div>
	<?php echo form_submit('mysubmit', 'Save'); ?>
	<?php echo form_close(); ?>
</div>




