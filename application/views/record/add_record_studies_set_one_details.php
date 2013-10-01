<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>Add Screenings & Surveillance</p>
    </div>
    <?php echo form_open_multipart("record/studies_set_one_insertion"); ?>
    <div class="container" id="add_record_form_section_mammo">
		<div height="30px">&nbsp;</div>
		<table>
		<tr> 
			<td>
                    <?php echo $IC_no; ?>: 
                    <?php echo form_input('IC_no'); ?>
			</td>
			<td>
				<?php echo $studies_name; ?>: 
				<?php echo form_dropdown('studies_name', $studies_name_lists); ?>
				<?php echo '<br/>'; ?>
			</td>
		</tr>
		</table>
        <div height="30px">&nbsp;</div>
        <?php
        echo form_fieldset('Mammogram');
        ?>
        <table id="mammo_first_section">
            <tr>
                <td>
                    <?php echo $year_of_first_mammogram; ?>: 
                    <?php echo form_input('year_of_first_mammogram'); ?>
                </td>
                <td>
                    <?php echo $age_at_first_mammogram; ?>: 
                    <?php echo form_input('age_of_first_mammogram'); ?>
                </td>
                <td>
                    <?php echo $date_of_recent_mammogram; ?>: 
                    <?php echo form_input('date_of_recent_mammogram'); ?>
                </td>
				<td>
                    <?php echo $age_at_recent__mammogram; ?>: 
                    <?php echo form_input('age_at_recent__mammogram'); ?>
                </td>
            </tr>
            <tr>
				<td>
                    <?php echo $screening_center; ?>: 
                    <?php echo form_input('screening_center'); ?>
                </td>
                <td>
                    <?php echo $name_of_radiologist; ?>: 
                    <?php echo form_input('name_of_radiologist'); ?>
                </td>
				 <td>
                    <?php echo $abnormalities_mammo_flag; ?>: 
                    <?php echo form_checkbox('abnormalities_mammo_flag', '1', FALSE); ?>
                </td>
				<td>
                    <?php echo $mammo_comments; ?>: 
                    <?php
                    $data = array(
                        'name' => 'mammo_comments',
                        'id' => 'mammo_comments',
                        'rows' => '3',
                        'cols' => '7'
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
               
            </tr>
        </table>
        <table id="mammo_second_section_1">
			 <tr>
                <td>
                    <input type="button" value="Add more site details" onClick="window.parent.addBreastSiteInput('add_record_form_section_mammo');
                            window.parent.calcHeight();">
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
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
                    <?php echo $mammo_is_abnormality_detected; ?>: 
                    <?php echo form_checkbox('mammo_is_abnormality_detected', '1', FALSE); ?>
                </td>
            </tr>           
        </table>
        <?php echo form_fieldset_close(); ?>	
    </div>
	<div height="30px">&nbsp;</div>
	<table>
		<tr>
			<td>
				<?php echo $BIRADS_clinical_classification; ?>: 
				<?php echo form_input('BIRADS_clinical_classification'); ?>
			</td>
			<td>
				<?php echo $BIRADS_density_classification; ?>: 
				<?php echo form_input('BIRADS_density_classification'); ?>
			</td>
			<td>
				<?php echo $percentage_of_mammo_density; ?>: 
				<?php echo form_input('percentage_of_mammo_density'); ?>
			</td>
			<td>&nbsp;</td>
		</tr>
	</table>
    <div class="container" id="add_record_form_section_mammo_attach_raw_processed_images">
        <div height="30px">&nbsp;</div>
        <?php
        echo form_fieldset('Attach raw images');
        ?>
        <table id="mammo_images_section">
            <tr>
                <td>
                    <?php echo $upload_raw_images_one; ?>: 

                    <input type="file" name="raw_images_one" size="100000" />

                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $upload_raw_images_two; ?>: 
                    <input type="file" name="raw_images_two" size="100000" />
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $upload_raw_images_three; ?>: 
                    <input type="file" name="raw_images_three" size="100000" />
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $upload_raw_images_four; ?>: 

                    <input type="file" name="raw_images_four" size="100000" />
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
                    <input type="file" name="processed_images_one" size="100000" />
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $upload_processed_images_two; ?>: 
                    <input type="file" name="processed_images_two" size="100000" />
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $upload_processed_images_three; ?>: 
                    <input type="file" name="processed_images_three" size="100000" />
                </td>
            </tr><tr>
                <td>
                    <?php echo $upload_processed_images_four; ?>: 
                    <input type="file" name="processed_images_four" size="100000" />
                </td>
            </tr>
        </table>
    </div>
    <div class="container" id="add_record_form_section_mammo_ultrasound">
        <div height="30px">&nbsp;</div>
        <table id="mammo_third_section">
            <tr>
                <td id="label1">Ultrasound</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $had_ultrasound_flag; ?>: 
                    <?php echo form_checkbox('had_ultrasound_flag', '1', FALSE); ?>
                </td>
                <td>
                    <?php echo $total_no_of_ultrasound; ?>: 
                    <?php echo form_input('total_no_of_ultrasound'); ?>
                </td>
                <td>
                    <?php echo $abnormalities_ultrasound_flag; ?>: 
                    <?php echo form_checkbox('abnormalities_ultrasound_flag', '1', FALSE); ?>
                </td>
            </tr>
        </table>
        <table id="mammo_ultrasound_second_section_1">
            <tr>
				 <td>
                    <?php echo $mammo_ultrasound_date; ?>: 
                    <?php echo form_input('mammo_ultrasound_date'); ?>
                </td>
				 <td>
                    <?php echo $mammo_ultrasound_is_abnormality_detected; ?>: 
                    <?php echo form_checkbox('mammo_ultrasound_is_abnormality_detected', '1', FALSE); ?>
                </td>
                <td>
                    <?php echo $mammo_ultrasound_details; ?>: 
                    <?php
                    $data = array(
                        'name' => 'mammo_ultrasound_details',
                        'id' => 'mammo_ultrasound_details',
                        'rows' => '3',
                        'cols' => '7'
                    );
                    echo form_textarea($data);
                    ?>
                </td>
                <td>
                    <input type="button" value="Add ultrasound" onClick="window.parent.addUltrasoundDetailsInput('add_record_form_section_mammo_ultrasound');
                            window.parent.calcHeight();">
                </td>
            </tr>
        </table>
    </div>
    <div class="container" id="add_record_form_section_mammo_MRI">
        <div height="30px">&nbsp;</div>
        <table id="mammo_fourth_section">
            <tr>
                <td id="label1">MRI</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>

                    <?php echo $had_MRI_flag; ?>: 
                    <?php echo form_checkbox('had_mri_flag', '1', FALSE); ?>
                </td>
                <td>
                    <?php echo $total_no_of_MRI; ?>: 
                    <?php echo form_input('total_no_of_mri'); ?>
                </td>
				 <td>
                    <?php echo $abnormalities_MRI_flag; ?>: 
                    <?php echo form_checkbox('abnormalities_MRI_flag', '1', FALSE); ?>
                </td>
            </tr>
        </table>
        <table id="mammo_MRI_second_section_1">
            <tr>
				 <td>
                    <?php echo $mammo_MRI_date; ?>: 
                    <?php echo form_input('mammo_mri_date'); ?>
                </td>
				 <td>
                    <?php echo $mammo_MRI_is_abnormality_detected; ?>: 
                    <?php echo form_checkbox('mammo_mri_is_abnormality_detected', '1', FALSE); ?>
                </td>
                <td>
                    <?php echo $mammo_MRI_details; ?>: 

                    <?php
                    $data = array(
                        'name' => 'mammo_MRI_details',
                        'id' => 'mammo_MRI_details',
                        'rows' => '3',
                        'cols' => '7'
                    );
                    echo form_textarea($data);
                    ?>
                </td>
                <td>
                    <input type="button" value="Add MRI" onClick="window.parent.addMRIDetailsInput('add_record_form_section_mammo_MRI');
                            window.parent.calcHeight();">
                </td>
            </tr>
        </table>
    </div>
    <div class="container" id="add_record_form_section_mammo_non_cancer_surgery">
        <div height="30px">&nbsp;</div>
        <table id="mammo_non_cancer_surgery_section_1">
            <tr>
                <td id="label1">Surgery for non-cancer</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
			<tr>
				 <td>
                    <?php echo $non_cancer_surgery_type; ?>: 
                    <?php echo form_input('non_cancer_surgery_type'); ?>
                </td>
				 <td>
                    <?php echo $reason_for_non_cancer_surgery; ?>: 
                    <?php echo form_input('reason_for_non_cancer_surgery'); ?>
                </td>
				 <td>
                    <?php echo $date_of_non_cancer_surgery; ?>: 
                    <?php echo form_input('date_of_non_cancer_surgery'); ?>
                </td>
				 <td>
                    <?php echo $age_at_non_cancer_surgery; ?>: 
                    <?php echo form_input('age_at_non_cancer_surgery'); ?>
                </td>
			</tr>
            <tr>
				 <td>
                    <?php echo $non_cancer_surgery_comments; ?>: 
                    <?php
                    $data = array(
                        'name' => 'non_cancer_surgery_comments',
                        'id' => 'non_cancer_surgery_comments',
                        'rows' => '3',
                        'cols' => '7'
                    );
                    echo form_textarea($data);
                    ?>
                </td>
                <td>
                    <input type="button" value="Add surgery" onClick="window.parent.addNonCancerSurgeryDetailsInput('add_record_form_section_mammo_non_cancer_surgery');
                            window.parent.calcHeight();">
                </td>
            </tr>
        </table>
    </div>
	<div class="container" id="add_record_form_risk_reducing_surgery_div" >
		<div height="30px">&nbsp;</div>
		 <table id="risk_reducing_surgery_title">
            <tr>
                <td id="label1">Risk Reducing Surgery</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table>
		<div id="non_cancerous_benign_section_1">
			<table id="non_cancerous_benign_table_1">
				<tr>
					<td>
						<?php echo $had_new_risk_reducing_surgery; ?>: 
						 <?php echo form_checkbox('had_new_risk_reducing_surgery', '1', FALSE); ?>
					</td>
				</tr>
			</table>
			<table id="non_cancerous_benign_info_table_1">
				<tr>
					<td>
						<?php echo $non_cancerous_benign_site; ?>: 
						<?php echo form_dropdown('non_cancerous_benign_site', $non_cancerous_benign_site_lists); ?>
					</td>
					<td>
						<?php echo $non_cancerous_benign_date; ?>: 
						 <?php echo form_input('non_cancerous_benign_date'); ?>
					</td>
					<td>
						<input type="button" value="Add" onClick="window.parent.addRiskReducingSurgeryBenignInfo('non_cancerous_benign_section_1');
                            window.parent.calcHeight();">
					</td>
				</tr>
			</table>
		</div>
		<div id="non_cancerous_complete_removal_section_1">
			<table id="non_cancerous_complete_removal_table_1">
				<tr>
					<td>
						<?php echo $had_new_complete_removal_surgery; ?>: 
						 <?php echo form_checkbox('had_new_complete_removal_surgery', '1', FALSE); ?>
					</td>
				</tr>
			</table>
			<table id="non_cancerous_complete_removal_info_table_1">
				<tr>
					<td>
						<?php echo $non_cancerous_complete_removal_site; ?>: 
						<?php echo form_dropdown('non_cancerous_complete_removal_site', $non_cancerous_benign_site_lists); ?>
					</td>
					<td>
						<?php echo $non_cancerous_complete_removal_date; ?>: 
						 <?php echo form_input('non_cancerous_complete_removal_date'); ?>
					</td>
					<td>
						<?php echo $non_cancerous_complete_removal_reason; ?>: 
						<?php echo form_dropdown('non_cancerous_complete_removal_reason', $non_cancerous_complete_removal_reason_lists); ?>
					</td>
					<td>
						<input type="button" value="Add" onClick="window.parent.addRiskReducingSurgeryCompleteRemovalInfo('non_cancerous_complete_removal_section_1');
                            window.parent.calcHeight();">
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="container" id="add_record_form_section_mammo_ovarian_screenings" >
	 <div height="30px">&nbsp;</div>
        <table id="ovarian_cancer_screening_title">
            <tr>
                <td id="label1">Ovarian Cancer Screenings</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table>
		<div id="ovarian_cancer_screening_record_physical_exam_div_section">
			<table id="physical_flag_table_1">
				<tr>
					<td>
						<?php echo $ovarian_screening_type_name; ?>: 
						 <?php echo form_dropdown('ovarian_screening_type_name', $ovarian_screening_type_name_lists); ?>
					</td>
					<td>
						<?php echo $physical_exam_date; ?>:
						 <?php echo form_input('physical_exam_date'); ?>
					</td>
					<td>
						<?php echo $physical_exam_is_abnormality_detected; ?>: 
						 <?php echo form_checkbox('physical_exam_is_abnormality_detected', '1', FALSE); ?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo $physical_exam_additional_info; ?>: <br />
						<?php
						$data = array(
							'name' => 'physical_exam_additional_info',
							'id' => 'physical_exam_additional_info',
							'rows' => '3',
							'cols' => '7'
						);
						echo form_textarea($data);
						?>
					</td>
					<td>
						<input type="button" value="Add" onClick="window.parent.addOvarianScreeningPhycialExamsInfo('ovarian_cancer_screening_record_physical_exam_div_section');
                            window.parent.calcHeight();">
					</td>
				</tr>
			</table>
		</div>
	</div>
    <div class="container" id="add_record_form_section_mammo_other_screenings">
        <div height="30px">&nbsp;</div>
        <table id="mammo_sixth_section">
            <tr>
                <td id="label1">Other Screening</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table>
        <table id="mammo_other_screenings_section_1">
            <tr>
                <td>
                    <?php echo $screening_name; ?>: 
                    <?php echo form_dropdown('screening_name', $screening_name_lists); ?>
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
                        'name' => 'screening_results',
                        'id' => 'screening_results',
                        'rows' => '3',
                        'cols' => '7'
                    );
                    echo form_textarea($data);
                    ?>
                </td>
                <td>
                    <input type="button" value="Add screenings" onClick="window.parent.addScreeningDetailsInput('add_record_form_section_mammo_other_screenings');
                            window.parent.calcHeight();">
                </td>
            </tr>
        </table>
    </div>
	<div class="container" id="add_record_form_section_breast_cancer">
        <div height="30px">&nbsp;</div>
        <?php
        echo form_fieldset('Breast Cancer Diagnosis & Treatment');
        ?>
		<input type="button" value="Add diagnosis" onClick="window.parent.addBreastCancerDiagnosis('add_record_form_section_breast_cancer');
                            window.parent.calcHeight();">
		<div height="30px">&nbsp;</div>
        <table id="breast_cancer_section_1">
			<tr>
                <td id="label1">Diagnosis 1</td>
            </tr>
            <tr>
                <td>
					<?php echo $cancer_site; ?>: 
					<?php echo form_dropdown('cancer_site', $patient_cancer_site_lists); ?>
				</td>
				<td>
					<?php echo $cancer_invasive_type; ?>: 
					<?php echo form_dropdown('cancer_invasive_type', $cancer_invasive_type_lists); ?>
				</td>
				 <td>
                    <?php echo $primary_diagnosis; ?>: 
                    <?php echo form_checkbox('primary_diagnosis', '1', FALSE); ?>
                </td>
				</tr>&nbsp;</td>
            </tr>
			<tr>
				 <td>
                    <?php echo $date_of_diagnosis; ?>: 
                    <?php echo form_input('date_of_diagnosis'); ?>
                </td>
				<td>
                    <?php echo $age_of_diagnosis; ?>: <br />
                    <?php echo form_input('age_of_diagnosis'); ?>
                </td>
				<td>
                    <?php echo $cancer_diagnosis_center; ?>: 
                    <?php echo form_input('cancer_diagnosis_center'); ?>
                </td>
				</tr>&nbsp;</td>
			</tr>
			<tr>
                <td>
                    <?php echo $cancer_doctor_name; ?>: 
                    <?php echo form_input('cancer_doctor_name'); ?>
                </td>
				 <td>
                    <?php echo $detected_by; ?>: <br />
                    <?php echo form_dropdown('detected_by', $detected_by_lists); ?>
                </td>
				 <td>
                    <?php echo $detected_by_other_details; ?>: 
                    <?php echo form_input('detected_by_other_details'); ?>
                </td>
				</tr>&nbsp;</td>
			</tr>
			<tr>
				<td>
                    <?php echo $cancer_is_bilateral; ?>: <br /> 
                    <?php echo form_checkbox('cancer_is_bilateral', '1', FALSE); ?>
                </td>
				<td>
                    <?php echo $cancer_is_recurrent; ?>: <br /> 
                     <?php echo form_checkbox('cancer_is_recurrent', '1', FALSE); ?>
                </td>
				</tr>&nbsp;</td>
				</tr>&nbsp;</td>
			</tr>
        </table>
		<div id="add_breast_cancer_treatment_div_1" >
			<table id="breast_cancer_treatment_1">
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
					<td>
						<?php echo $treatment_duration; ?>: 
						<?php echo form_input('treatment_duration'); ?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo $breast_cancer_treatment_comments; ?>: 
						<?php
						$data = array(
							'name' => 'breast_cancer_treatment_comments',
							'id' => 'breast_cancer_treatment_comments',
							'rows' => '3',
							'cols' => '7'
						);
						echo form_textarea($data);
						?>
					</td>
					 <td>
						<input type="button" value="Add treatment" onClick="window.parent.addCancerTreatmentInput('add_breast_cancer_treatment_div_1');
								window.parent.calcHeight();">
					</td>
					</tr>&nbsp;</td>
					</tr>&nbsp;</td>
				</tr>
			</table>
		</div>
        <?php echo form_fieldset_close(); ?>	
    </div>
	<div class="container" id="add_record_form_section_ovary_cancer">
        <div height="30px">&nbsp;</div>
        <?php
        echo form_fieldset('Ovary Cancer Diagnosis & Treatment');
        ?>
		<input type="button" value="Add diagnosis" onClick="window.parent.addOvaryCancerDiagnosis('add_record_form_section_ovary_cancer');
                            window.parent.calcHeight();">
		<div height="30px">&nbsp;</div>
        <table id="ovary_cancer_section_1">
			<tr>
                <td id="label1">Diagnosis 1</td>
            </tr>
            <tr>
                <td>
					<?php echo $ovary_cancer_site; ?>: 
					<?php echo form_dropdown('ovary_cancer_site', $patient_cancer_site_lists); ?>
				</td>
				<td>
					<?php echo $ovary_cancer_invasive_type; ?>: 
					<?php echo form_dropdown('ovary_cancer_invasive_type', $cancer_invasive_type_lists); ?>
				</td>
				 <td>
                    <?php echo $ovary_primary_diagnosis; ?>: 
                    <?php echo form_checkbox('ovary_primary_diagnosis', '1', FALSE); ?>
                </td>
				</tr>&nbsp;</td>
            </tr>
			<tr>
				 <td>
                    <?php echo $ovary_date_of_diagnosis; ?>: 
                    <?php echo form_input('ovary_date_of_diagnosis'); ?>
                </td>
				<td>
                    <?php echo $ovary_age_of_diagnosis; ?>: <br />
                    <?php echo form_input('ovary_age_of_diagnosis'); ?>
                </td>
				<td>
                    <?php echo $ovary_cancer_diagnosis_center; ?>: 
                    <?php echo form_input('ovary_cancer_diagnosis_center'); ?>
                </td>
				</tr>&nbsp;</td>
			</tr>
			<tr>
                <td>
                    <?php echo $ovary_cancer_doctor_name; ?>: 
                    <?php echo form_input('ovary_cancer_doctor_name'); ?>
                </td>
				 <td>
                    <?php echo $ovary_detected_by; ?>: <br />
                    <?php echo form_dropdown('ovary_detected_by', $detected_by_lists); ?>
                </td>
				 <td>
                    <?php echo $ovary_detected_by_other_details; ?>: 
                    <?php echo form_input('ovary_detected_by_other_details'); ?>
                </td>
				</tr>&nbsp;</td>
			</tr>
				<tr>
				<td>
                    <?php echo $ovary_cancer_is_bilateral; ?>: <br /> 
                    <?php echo form_checkbox('ovary_cancer_is_bilateral', '1', FALSE); ?>
                </td>
				<td>
                    <?php echo $ovary_cancer_is_recurrent; ?>: <br /> 
                    <?php echo form_checkbox('ovary_cancer_is_recurrent', '1', FALSE); ?>
                </td>
				</tr>&nbsp;</td>
				</tr>&nbsp;</td>
			</tr>
        </table>
		<div id="add_ovary_cancer_treatment_div_1" >
			<table id="ovary_cancer_treatment_1">
				<tr>
					<td>
						<?php echo $ovary_patient_cancer_treatment_name; ?>: 
						<?php echo form_dropdown('ovary_patient_cancer_treatment_name', $patient_cancer_treatment_name_lists); ?>
					</td>
					<td>
						<?php echo $ovary_treatment_start_date; ?>: 
						<?php echo form_input('ovary_treatment_start_date'); ?>
					</td>
					<td>
						<?php echo $ovary_treatment_end_date; ?>: 
						<?php echo form_input('ovary_treatment_end_date'); ?>
					</td>
					<td>
						<?php echo $ovary_treatment_duration; ?>: 
						<?php echo form_input('ovary_treatment_duration'); ?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo $ovary_cancer_treatment_comments; ?>: 
						<?php
						$data = array(
							'name' => 'ovary_cancer_treatment_comments',
							'id' => 'ovary_cancer_treatment_comments',
							'rows' => '3',
							'cols' => '7'
						);
						echo form_textarea($data);
						?>
					</td>
					 <td>
						<input type="button" value="Add treatment" onClick="window.parent.addOvaryCancerTreatmentInput('add_ovary_cancer_treatment_div_1');
								window.parent.calcHeight();">
					</td>
					</tr>&nbsp;</td>
					</tr>&nbsp;</td>
				</tr>
			</table>
		</div>
        <?php echo form_fieldset_close(); ?>	
    </div>
	<div class="container" id="add_record_form_section_other_cancer">
        <div height="30px">&nbsp;</div>
        <?php
        echo form_fieldset('Other Cancer Diagnosis & Treatment');
        ?>
		<input type="button" value="Add diagnosis" onClick="window.parent.addOtherCancerDiagnosis('add_record_form_section_other_cancer');
                            window.parent.calcHeight();">
		<div height="30px">&nbsp;</div>
        <table id="other_cancer_section_1">
			<tr>
                <td id="label1">Diagnosis 1</td>
            </tr>
			<tr>
				 <td>
					<?php echo $other_cancer_type; ?>: 
					<?php echo form_dropdown('other_cancer_type', $patient_cancer_name_lists); ?>
				</td>
				 <td>
                    <?php echo $other_date_of_diagnosis; ?>: 
                    <?php echo form_input('other_date_of_diagnosis'); ?>
                </td>
				<td>
                    <?php echo $other_age_of_diagnosis; ?>: <br />
                    <?php echo form_input('other_age_of_diagnosis'); ?>
                </td>
				<td>
                    <?php echo $other_cancer_diagnosis_center; ?>: 
                    <?php echo form_input('other_cancer_diagnosis_center'); ?>
                </td>
			</tr>
			<tr>
                <td>
                    <?php echo $other_cancer_doctor_name; ?>: 
                    <?php echo form_input('other_cancer_doctor_name'); ?>
                </td>
				 <td>
                    <?php echo $other_cancer_comments; ?>: <br />
                    <?php
						$data = array(
							'name' => 'other_cancer_comments',
							'id' => 'other_cancer_comments',
							'rows' => '3',
							'cols' => '7'
						);
						echo form_textarea($data);
						?>
                </td>
				</tr>&nbsp;</td>
			</tr>
        </table>
		<div id="add_other_cancer_treatment_div_1" >
			<table id="other_cancer_treatment_1">
				<tr>
					<td>
						<?php echo $other_patient_cancer_treatment_name; ?>: 
						<?php echo form_dropdown('other_patient_cancer_treatment_name', $patient_cancer_treatment_name_lists); ?>
					</td>
					<td>
						<?php echo $other_treatment_start_date; ?>: 
						<?php echo form_input('other_treatment_start_date'); ?>
					</td>
					<td>
						<?php echo $other_treatment_end_date; ?>: 
						<?php echo form_input('other_treatment_end_date'); ?>
					</td>
					<td>
						<?php echo $other_treatment_duration; ?>: 
						<?php echo form_input('other_treatment_duration'); ?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo $other_cancer_treatment_comments; ?>: 
						<?php
						$data = array(
							'name' => 'other_cancer_treatment_comments',
							'id' => 'other_cancer_treatment_comments',
							'rows' => '3',
							'cols' => '7'
						);
						echo form_textarea($data);
						?>
					</td>
					 <td>
						<input type="button" value="Add treatment" onClick="window.parent.addOtherCancerTreatmentInput('add_other_cancer_treatment_div_1');
								window.parent.calcHeight();">
					</td>
					</tr>&nbsp;</td>
					</tr>&nbsp;</td>
				</tr>
			</table>
		</div>
        <?php echo form_fieldset_close(); ?>	
    </div>
	<?php echo form_fieldset_close(); ?>
    <div class="container" id="add_record_form_section_other_disease_diagnosis">
        <div height="30px">&nbsp;</div>
        <?php
        echo form_fieldset('Other diseases');
        ?>
		<input type="button" value="Add other disease" onClick="window.parent.addOtherDisease('add_record_form_section_other_disease_diagnosis');
                            window.parent.calcHeight();">
		<div height="30px">&nbsp;</div>
		<table id="other_disease_diagnosis_section">
			 <tr>
                <td id="label1">Disease 1</td>
            </tr>
            <tr>
                <td>
                    <?php echo $patient_other_diagnosis_name; ?>: 
                    <?php echo form_dropdown('diagnosis_name', $diagnosis_name_lists); ?>
                </td>
				<td>
                    <?php echo $year_of_diagnosis; ?>: 
                    <?php echo form_input('year_of_diagnosis'); ?>
                </td>
				 <td>
                    <?php echo $diagnosis_age; ?>: 
                    <?php echo form_input('diagnosis_age'); ?>
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
		<div id="add_record_form_section_other_disease_diagnosis_medication">
		<table id="other_disease_medication_section">
            <tr>
                <td>
                    <?php echo $is_on_medication_flag; ?>: 
                    <?php echo form_checkbox('is_on_medication_flag', '1', FALSE); ?>
                </td>
                <td>
                    <?php echo $medication_type_name; ?>: 
                     <?php echo form_input($medication_type_name); ?>
                </td>
				 <td>
                    <?php echo $medication_start_date; ?>: 
                     <?php echo form_input($medication_start_date); ?>
                </td>
                <td>
                    <?php echo $medication_end_date; ?>: 
                     <?php echo form_input($medication_end_date); ?>
                </td>
            </tr>
			 <tr>
                <td>
                    <?php echo $medication_duration; ?>: 
                    <?php echo form_input($medication_duration); ?>
                </td>
                <td>
                    <?php echo $medication_comments; ?>: 
                     <?php echo form_input($medication_comments); ?>
                </td>
				 <td>
                    <input type="button" value="Add medication" onClick="window.parent.addOtherDiseasesMedication('add_record_form_section_other_disease_diagnosis_medication');
                            window.parent.calcHeight();">
                </td>
            </tr>
        </table>
		</div>
        <?php echo form_fieldset_close(); ?>	
    </div>
    <div class="container" id="add_record_form_section_studies">
        <div height="30px">&nbsp;</div>
        <?php
        echo form_fieldset('Surveillance Details');
        ?>
        <table>
            <tr>
                <td>
                    <?php echo $surveillance_recruitment_center; ?>: 
                    <?php echo form_dropdown('surveillance_recruitment_center', $surveillance_recruitment_center_lists); ?>
                </td>
                <td>
                    <?php echo $surveillance_type; ?>: 
                    <?php echo form_dropdown('surveillance_type', $surveillance_type_lists); ?>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $surveillance_first_consultation_date; ?>: 
                    <?php echo form_input('surveillance_first_consultation_date'); ?>
                </td>
                <td>
                    <?php echo $surveillance_first_consultation_place; ?>: 
                    <?php echo form_input('surveillance_first_consultation_place'); ?>
                </td>
                <td>
                    <?php echo $surveillance_interval; ?>: 
                    <?php echo form_input('surveillance_interval'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $surveillance_diagnosis; ?>: 
                    <?php echo form_input('surveillance_diagnosis'); ?>
                </td>
                <td>
                    <?php echo $surveillance_due_date; ?>: 
                    <?php echo form_input('surveillance_due_date'); ?>
                </td>
                <td>
                    <?php echo $surveillance_reminder_sent_date; ?>: 
                    <?php echo form_input('surveillance_reminder_sent_date'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $surveillance_done_date; ?>: 
                    <?php echo form_input('surveillance_done_date'); ?>
                </td>
                <td>
                    <?php echo $surveillance_reminded_by; ?>: 
                    <?php echo form_input('surveillance_reminded_by'); ?>
                </td>
                <td>
                    <?php echo $surveillance_timing; ?>: 
                    <?php echo form_input('surveillance_timing'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $surveillance_symptoms; ?>: 
                    <?php
                    $data = array(
                        'name' => 'surveillance_symptoms',
                        'id' => 'surveillance_symptoms',
                        'rows' => '3',
                        'cols' => '7'
                    );
                    echo form_textarea($data);
                    ?>
                </td>
                <td>
                    <?php echo $surveillance_doctor_name; ?>: 
                    <?php echo form_input('surveillance_doctor_name'); ?>
                </td>
                <td>
                    <?php echo $surveillance_place; ?>: 
                    <?php echo form_input('surveillance_place'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $surveillance_outcome; ?>: 
                    <?php
                    $data = array(
                        'name' => 'surveillance_outcome',
                        'id' => 'surveillance_outcome',
                        'rows' => '3',
                        'cols' => '7'
                    );
                    echo form_textarea($data);
                    ?>
                </td>
                <td>
                    <?php echo $surveillance_comments; ?>: 
                    <?php
                    $data = array(
                        'name' => 'surveillance_comments',
                        'id' => 'surveillance_comments',
                        'rows' => '3',
                        'cols' => '7'
                    );
                    echo form_textarea($data);
                    ?>
                </td>
                <td>&nbsp;</td>
            </tr>
        </table>
        <?php echo form_fieldset_close(); ?>
    </div>
    <?php echo form_submit('mysubmit', 'Save'); ?>
    <?php echo form_close(); ?>

</div>




