<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>Add Screenings & Surveillance</p>
    </div>
	 <?php 
	$attributes = array('id' => 'screenings-details-form');
	echo form_open("record/studies_set_one_insertion", $attributes);
	?>
    <div class="container" id="add_record_form_section_mammo">
		<div height="30px">&nbsp;</div>
		<table>
		<tr> 
			<td>
				<label for="IC_no"><?php echo $IC_no; ?>: </label>
				<?php echo form_input('IC_no'); ?>
			</td>
			<td>
				<label for="studies_name"><?php echo $studies_name; ?>: </label>
				<?php echo form_dropdown('studies_name', $studies_name_lists, NULL, 'id="studies_name"'); ?>
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
                    <?php echo $reason_of_mammogram; ?>: 
                    <?php echo form_input('reason_of_mammogram'); ?>
                </td>
                <td>
                    <?php echo $details_for_mammogram; ?>: 
                    <?php echo form_input('details_for_mammogram'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $date_of_first_mammogram; ?>: 
                    <?php echo form_input(array('name'=>'date_of_first_mammogram','class'=>'datepicker')); ?>
                </td>
                <td>
                    <?php echo $age_at_first_mammogram; ?>: 
                    <?php echo form_input('age_of_first_mammogram'); ?>
                </td>
                <td>
                    <?php echo $screening_center_at_first_mammogram; ?>: 
                    <?php echo form_input('screening_center_of_first_mammogram'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $motivaters_at_first_mammogram; ?>: 
                    <?php echo form_input('motivaters_at_first_mammogram'); ?>
                </td>
                <td>
                    <?php echo $details_at_first_mammogram; ?>: 
                    <?php echo form_input('details_at_first_mammogram'); ?>
                </td>
                </tr>
                <tr>
                <td>
                    <?php echo $date_of_recent_mammogram; ?>: 
					<?php echo form_input(array('name'=>'date_of_recent_mammogram','class'=>'datepicker')); ?>
                </td>
				<td>
                    <?php echo $age_at_recent__mammogram; ?>: 
                    <?php echo form_input('age_at_recent__mammogram'); ?>
                </td>
                <td>
                    <?php echo $screening_center_at_recent_mammogram; ?>: 
                    <?php echo form_input('screening_center_of_recent_mammogram'); ?>
                </td>
                </tr>
                <tr>
                <td>
                    <?php echo $motivaters_at_recent_mammogram; ?>: 
                    <?php echo form_input('motivaters_at_recent_mammogram'); ?>
                </td>
                <td>
                    <?php echo $details_at_recent_mammogram; ?>: 
                    <?php echo form_input('details_at_recent_mammogram'); ?>
                </td>
                <td>
                    <?php echo $mammogram_in_sdmc; ?>: 
                    <?php echo form_checkbox('mammogram_in_sdmc', '1', FALSE); ?>
                </td>
            </tr>
            <tr>
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
                </tr>
                <tr>
                        <td>
				<?php echo $action_suggested_on_mammogram_report; ?>: 
				<?php echo form_input('action_suggested_on_mammogram_report'); ?>
			</td>
			<td>
				<?php echo $reason_of_action_suggested; ?>: 
				<?php echo form_input('reason_of_action_suggested'); ?>
                        </td>
                        <td>
                            <?php echo $is_cancer; ?>: 
                            <?php echo form_checkbox('is_cancer_mammogram_flag', '1', FALSE); ?>
                        </td>
                        <td>
                            <?php echo $side_effected; ?>: 
			    <?php echo form_dropdown('site_effected_of_mammogram', $mammo_report_site); ?>
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
					<?php echo form_input(array('name'=>'mammo_ultrasound_date','class'=>'datepicker')); ?>
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
					<?php echo form_input(array('name'=>'mammo_mri_date','class'=>'datepicker')); ?>
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
                <td id="label1">Breast Surgery for non-cancer</td>
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
					<?php echo form_input(array('name'=>'date_of_non_cancer_surgery','class'=>'datepicker')); ?>
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
<!--                <td>
                    <input type="button" value="Add surgery" onClick="window.parent.addNonCancerSurgeryDetailsInput('add_record_form_section_mammo_non_cancer_surgery');
                            window.parent.calcHeight();">
                </td>-->
            </tr>
        </table>
    </div>
        <div class="container" id="add_record_form_section_mammo_non_cancer_surgery">
        <div height="30px">&nbsp;</div>
        <table id="mammo_non_cancer_surgery_section_1">
            <tr>
                <td id="label1">Ovary Surgery for non-cancer</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
			<tr>
				 <td>
                    <?php echo $non_cancer_surgery_type; ?>: 
                    <?php echo form_input('ovary_non_cancer_surgery_type'); ?>
                </td>
				 <td>
                    <?php echo $reason_for_non_cancer_surgery; ?>: 
                    <?php echo form_input('ovary_reason_for_non_cancer_surgery'); ?>
                </td>
				 <td>
                    <?php echo $date_of_non_cancer_surgery; ?>: 
					<?php echo form_input(array('name'=>'ovary_date_of_non_cancer_surgery','class'=>'datepicker')); ?>
                </td>
				 <td>
                    <?php echo $age_at_non_cancer_surgery; ?>: 
                    <?php echo form_input('ovary_age_at_non_cancer_surgery'); ?>
                </td>
			</tr>
            <tr>
				 <td>
                    <?php echo $non_cancer_surgery_comments; ?>: 
                    <?php
                    $data = array(
                        'name' => 'ovary_non_cancer_surgery_comments',
                        'id' => 'ovary_non_cancer_surgery_comments',
                        'rows' => '3',
                        'cols' => '7'
                    );
                    echo form_textarea($data);
                    ?>
                </td>
<!--                <td>
                    <input type="button" value="Add surgery" onClick="window.parent.addNonCancerSurgeryDetailsInput('add_record_form_section_mammo_non_cancer_surgery');
                            window.parent.calcHeight();">
                </td>-->
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
						 <?php echo form_input(array('name'=>'non_cancerous_benign_date','class'=>'datepicker')); ?>
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
						<?php echo form_input(array('name'=>'non_cancerous_complete_removal_date','class'=>'datepicker')); ?>
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
						<?php echo form_input(array('name'=>'physical_exam_date','class'=>'datepicker')); ?>
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
<!--        end-->
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
					<?php echo form_input(array('name'=>'surveillance_first_consultation_date','class'=>'datepicker')); ?>
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
					<?php echo form_input(array('name'=>'surveillance_due_date','class'=>'datepicker')); ?>
                </td>
                <td>
                    <?php echo $surveillance_reminder_sent_date; ?>: 
					<?php echo form_input(array('name'=>'surveillance_reminder_sent_date','class'=>'datepicker')); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $surveillance_done_date; ?>: 
					<?php echo form_input(array('name'=>'surveillance_done_date','class'=>'datepicker')); ?>
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




