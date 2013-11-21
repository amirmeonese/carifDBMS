<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>Add Diagnosis & Treatment</p>
    </div>
	 <?php 
	$attributes = array('id' => 'diagnosis-treatment-details-form');
	echo form_open("record/patient_diagnosis_treatment_record_insertion", $attributes);
	?>
    <div class="container" id="add_record_form_section_breast_cancer">
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
					<?php echo form_dropdown('cancer_site', $patient_cancer_site_lists, NULL, 'id="cancer_site"'); ?>
                </td>
                <td>
					<?php echo $cancer_invasive_type; ?>: 
					<?php echo form_dropdown('cancer_invasive_type', $cancer_invasive_type_lists, NULL, 'id="cancer_invasive_type"'); ?>
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
                    <?php echo form_input(array('name' => 'date_of_diagnosis', 'class' => 'datepicker')); ?>
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
					<?php echo form_dropdown('detected_by', $detected_by_lists, NULL, 'id="detected_by"'); ?>
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
        <table id="breast_cancer_pathology_section">
            <tr>
                <td id="label1">Pathology</td>
                <td><input type="button" value="Add pathology" onClick="window.parent.addBreastCancerPathology('add_record_form_section_breast_cancer_pathology_section_1');
                window.parent.calcHeight();"></td>
            </tr>
            <tr>
                <td>
                    <?php echo $breast_pathology_tissue_site; ?>: <br />
					<?php echo form_dropdown('breast_pathology_tissue_site', $patient_cancer_site_lists, NULL, 'id="cancer_site"'); ?>
                </td>
                <td>
                    <?php echo $breast_pathology_path_report_type; ?>: <br />
                    <?php echo form_dropdown('breast_pathology_path_report_type', $pathology_path_report_type_lists, NULL, 'id="pathology_path_report_type_lists"'); ?>
                </td>
                <td>
                    <?php echo $breast_pathology_path_report_date; ?>: <br />
                    <?php echo form_input(array('name' => 'breast_pathology_path_report_date', 'class' => 'datepicker')); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $breast_pathology_lab; ?>: <br />
                    <?php echo form_input('breast_pathology_lab'); ?>
                </td>
                <td>
                    <?php echo $breast_pathology_doctor; ?>: <br />
                    <?php echo form_input('breast_pathology_doctor'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $breast_pathology_morphology; ?>: <br />
                    <?php echo form_dropdown('breast_pathology_morphology', $pathology_morphology_lists, NULL, 'id="pathology_morphology_lists"'); ?>
                </td>
                <td>
                    <?php echo $breast_pathology_tissue_tumour_stage; ?>: <br />
					<?php echo form_dropdown('breast_pathology_tissue_tumour_stage', $pathology_tissue_tumour_stage_lists, NULL, 'id="pathology_tissue_tumour_stage_lists"'); ?>
                </td>
                <td>
                    <?php echo $breast_pathology_node_stage; ?>: <br />
					<?php echo form_dropdown('breast_pathology_node_stage', $pathology_node_stage_lists, NULL, 'id="pathology_node_stage_lists"'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $breast_pathology_metastasis_stage; ?>: <br />
                    <?php echo form_dropdown('breast_pathology_metastasis_stage', $pathology_metastasis_stage_lists, NULL, 'id="pathology_metastasis_stage_lists"'); ?>
                </td>
                <td>
                    <?php echo $breast_pathology_tumour_stage; ?>: <br />
                    <?php echo form_dropdown('breast_pathology_tumour_stage', $pathology_tumour_stage_lists, NULL, 'id="pathology_tumour_stage_lists"'); ?>
                </td>
                <td>
                    <?php echo $breast_pathology_tumour_grade; ?>: <br />
                    <?php echo form_dropdown('breast_pathology_tumour_grade', $pathology_tumour_grade_lists, NULL, 'id="pathology_tumour_grade_lists"'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $breast_pathology_total_lymph_nodes; ?>: <br />
                    <?php echo form_input('breast_pathology_total_lymph_nodes'); ?>
                </td>
                <td>
                    <?php echo $breast_pathology_tumour_size; ?>: <br />
                    <?php echo form_input('breast_pathology_tumour_size'); ?>
                </td>
            </tr>
        </table>
        <div id="breast_cancer_staining_status_div_1">
            <table id="breast_cancer_staining_status_section_1">
                <tr>
                    <td>
                        <?php echo $breast_pathology_ER_status; ?>: <br />
                        <?php echo form_input('breast_pathology_ER_status'); ?>
                    </td>
                    <td>
                        <?php echo $breast_pathology_PR_status; ?>: <br />
                        <?php echo form_input('breast_pathology_PR_status'); ?>
                    </td>
                    <td>
                        <?php echo $breast_pathology_HER2_status; ?>: <br />
                        <?php echo form_input('breast_pathology_HER2_status'); ?>
                    </td>
                    <td>
                        <input type="button" value="Add staining status" onClick="window.parent.addBreastCancerStainingStatusInput('breast_cancer_staining_status_div_1');
                window.parent.calcHeight();">
                    </td>
                </tr>
            </table>
        </div>
        <table>
            <tr>
                <td>
                    <?php echo $breast_pathology_tissue_path_comments; ?>: <br />
                    <?php
                    $data = array(
                        'name' => 'breast_pathology_tissue_path_comments',
                        'id' => 'breast_pathology_tissue_path_comments',
                        'rows' => '3',
                        'cols' => '7'
                    );
                    echo form_textarea($data);
                    ?>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table>
        <div id="add_breast_cancer_treatment_div_1" >
            <table id="breast_cancer_treatment_1">
            <tr>
                <td id="label1">Treatment</td>
            </tr>
                <tr>
                    <td>
                        <?php echo $patient_cancer_treatment_name; ?>: 
                        <?php echo form_dropdown('patient_cancer_treatment_name', $patient_cancer_treatment_name_lists, NULL, 'id="patient_cancer_treatment_name_lists"'); ?>
                    </td>
                    <td>
                        <?php echo $treatment_details; ?>: 
                        <?php echo form_input('treatment_details'); ?>
                    </td>
                    <td>
                        <?php echo $treatment_start_date; ?>: 
                        <?php echo form_input(array('name' => 'treatment_start_date', 'class' => 'datepicker')); ?>
                    </td>
                    <td>
                        <?php echo $treatment_end_date; ?>: 
                        <?php echo form_input(array('name' => 'treatment_end_date', 'class' => 'datepicker')); ?>
                    </td>
                    </tr>
                    <tr>
                    <td>
                        <?php echo $treatment_duration; ?>: 
                        <?php echo form_input('treatment_duration'); ?>
                    </td>               
                <td>
                        <?php echo $treatment_drug_dose; ?>: 
                        <?php echo form_input('treatment_drug_dose'); ?>
                    </td>
                    <td>
                        <?php echo $treatment_cycle; ?>: 
                        <?php echo form_input('treatment_cycle'); ?>
                    </td>
                    <td>
                        <?php echo $treatment_route; ?>: 
                        <?php echo form_input('treatment_route'); ?>
                    </td>
                     </tr>
                     <tr>
                    <td>
                        <?php echo $treatment_visidual_desease; ?>: 
                        <?php echo form_input('treatment_visidual_desease'); ?>
                    </td>
                    <td>
                        <?php echo $treatment_primary_therapy_outcome; ?>: 
                        <?php echo form_input('treatment_primary_therapy_outcome'); ?>
                    </td>
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
                    <?php echo form_dropdown('ovary_cancer_site', $patient_cancer_site_lists, NULL, 'id="cancer_site"'); ?>
                </td>
                <td>
                    <?php echo $ovary_cancer_invasive_type; ?>: 
                    <?php echo form_dropdown('ovary_cancer_invasive_type', $cancer_invasive_type_lists, NULL, 'id="cancer_invasive_type"'); ?>
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
                    <?php echo form_input(array('name' => 'ovary_date_of_diagnosis', 'class' => 'datepicker')); ?>
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
					<?php echo form_dropdown('ovary_detected_by', $detected_by_lists, NULL, 'id="detected_by"'); ?>
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
        <div class="container" id="add_record_form_section_ovary_cancer_pathology_section_1">
            <div height="30px">&nbsp;</div>
            <table id="ovary_cancer_pathology_section">
                <tr>
                    <td id="label1">Pathology</td>
                    <td><input type="button" value="Add pathology" onClick="window.parent.addOvaryCancerPathology('add_record_form_section_ovary_cancer_pathology_section_1');
                window.parent.calcHeight();"></td>
                </tr>
                <tr>
                    <td>
                        <?php echo $ovary_pathology_tissue_site; ?>: <br />
						<?php echo form_dropdown('ovary_pathology_tissue_site', $patient_cancer_site_lists, NULL, 'id="cancer_site"'); ?>
                    </td>
                    <td>
                        <?php echo $ovary_pathology_path_report_type; ?>: <br />
                        <?php echo form_dropdown('ovary_pathology_path_report_type', $pathology_path_report_type_lists, NULL, 'id="pathology_path_report_type_lists"'); ?>
                    </td>
                    <td>
                        <?php echo $ovary_pathology_path_report_date; ?>: <br />
                        <?php echo form_input(array('name' => 'ovary_pathology_path_report_date', 'class' => 'datepicker')); ?>
                    </td>
                    <td>
                        <?php echo $ovary_pathology_report_no; ?>: <br />
                        <?php echo form_input('ovary_pathology_report_no'); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $ovary_pathology_lab; ?>: <br />
                        <?php echo form_input('ovary_pathology_lab'); ?>
                    </td>
                    <td>
                        <?php echo $ovary_pathology_doctor; ?>: <br />
                        <?php echo form_input('ovary_pathology_doctor'); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $ovary_pathology_morphology; ?>: <br />
                        <?php echo form_input('ovary_pathology_morphology'); ?>
                    </td>
                    <td>
                        <?php echo $ovary_stage_classification; ?>: <br />
                        <?php echo form_dropdown('ovary_stage_classification', $ovary_stage_classification_lists, NULL, 'id="ovary_stage_classification_lists"'); ?>
                    </td>
                    <td>
                        <?php echo $ovary_pathology_tumour_stage; ?>: <br />
                        <?php echo form_dropdown('ovary_pathology_tumour_stage', $pathology_tumour_stage_lists, NULL, 'id="pathology_tumour_stage_lists"'); ?>
                    </td>
                    <td>
                        <?php echo $ovary_tumor_subtypes; ?>: <br />
                        <?php echo form_dropdown('ovary_tumor_subtypes', $ovary_stage_classification_lists, NULL, 'id="ovary_stage_classification_lists"'); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $ovary_pathology_tumour_grade; ?>: <br />
                        <?php echo form_dropdown('ovary_pathology_tumour_grade', $pathology_tumour_grade_lists, NULL, 'id="pathology_tumour_grade_lists"'); ?>
                    </td>
                    <td>
                        <?php echo $ovary_pathology_tumour_size; ?>: <br />
                        <?php echo form_input('ovary_pathology_tumour_size'); ?>
                    </td>
                    <td>
                        <?php echo $ovary_tumor_behavior; ?>: <br />
                        <?php echo form_dropdown('ovary_tumor_behavior', $ovary_stage_classification_lists, NULL, 'id="ovary_stage_classification_lists"'); ?>
                    </td>
                    <td>
                        <?php echo $ovary_tumor_differentiation; ?>: <br />
                        <?php echo form_dropdown('ovary_tumor_differentiation', $ovary_stage_classification_lists, NULL, 'id="ovary_stage_classification_lists"'); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $ovary_pathology_tissue_path_comments; ?>: <br />
                        <?php
                        $data = array(
                            'name' => 'ovary_pathology_tissue_path_comments',
                            'id' => 'ovary_pathology_tissue_path_comments',
                            'rows' => '3',
                            'cols' => '7'
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
        <div id="add_ovary_cancer_treatment_div_1" >
            <table id="ovary_cancer_treatment_1">
            <tr>
                <td id="label1">Treatment</td>
            </tr>
                <tr>
                    <td>
                        <?php echo $ovary_patient_cancer_treatment_name; ?>: 
						<?php echo form_dropdown('ovary_patient_cancer_treatment_name', $patient_cancer_treatment_name_lists, NULL, 'id="patient_cancer_treatment_name_lists"'); ?>
                    </td>
                    <td>
                        <?php echo $treatment_details; ?>: 
                        <?php echo form_input('ovary_treatment_details'); ?>
                    </td>
                    <td>
                        <?php echo $ovary_treatment_start_date; ?>: 
                        <?php echo form_input(array('name' => 'ovary_treatment_start_date', 'class' => 'datepicker')); ?>
                    </td>
                    <td>
                        <?php echo $ovary_treatment_end_date; ?>: 
                        <?php echo form_input(array('name' => 'ovary_treatment_end_date', 'class' => 'datepicker')); ?>
                    </td>
                     </tr>
                     <tr>
                    <td>
                        <?php echo $ovary_treatment_duration; ?>: 
                        <?php echo form_input('ovary_treatment_duration'); ?>
                    </td>
               
                <td>
                        <?php echo $treatment_drug_dose; ?>: 
                        <?php echo form_input('ovary_treatment_drug_dose'); ?>
                    </td>
                    <td>
                        <?php echo $treatment_cycle; ?>: 
                        <?php echo form_input('ovary_treatment_cycle'); ?>
                    </td>
                    <td>
                        <?php echo $treatment_route; ?>: 
                        <?php echo form_input('ovary_treatment_route'); ?>
                    </td>
                     </tr>
                     <tr>
                    <td>
                        <?php echo $treatment_visidual_desease; ?>: 
                        <?php echo form_input('ovary_treatment_visidual_desease'); ?>
                    </td>
                    <td>
                        <?php echo $treatment_primary_therapy_outcome; ?>: 
                        <?php echo form_input('treatment_privacy_outcome'); ?>
                    </td>
                    <td>
                        <?php echo $treatment_cal125_pretreatment; ?>: 
                        <?php echo form_input('ovary_cal125_pretreatment'); ?>
                    </td>
                    <td>
                        <?php echo $treatment_cal125_posttreatment; ?>: 
                        <?php echo form_input('ovary_cal125_posttreatment'); ?>
                    </td>
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
						<?php echo form_dropdown('other_cancer_type', $patient_cancer_name_lists, NULL, 'id="patient_cancer_name_lists"'); ?>
                    </td>
                    <td>
                    <?php echo $cancer_site; ?>: 
                    <?php echo form_dropdown('other_cancer_site', $patient_cancer_site_lists); ?>
                    </td>
                    <td>
                        <?php echo $other_date_of_diagnosis; ?>: 
                        <?php echo form_input(array('name' => 'other_date_of_diagnosis', 'class' => 'datepicker')); ?>
                    </td>
                    <td>
                        <?php echo $other_age_of_diagnosis; ?>: <br />
                        <?php echo form_input('other_age_of_diagnosis'); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $other_cancer_diagnosis_center; ?>: 
                        <?php echo form_input('other_cancer_diagnosis_center'); ?>
                    </td>
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
            <div class="container" id="add_record_form_section_other_cancer_pathology_section_1">
        <div height="30px">&nbsp;</div>
        <table id="other_cancer_pathology_section">
			<tr>
                <td id="label1">Other Cancer Tumor Pathology</td>
				<td><input type="button" value="Add pathology" onClick="window.parent.addOtherCancerPathology('add_record_form_section_other_cancer_pathology_section_1');
                            window.parent.calcHeight();"></td>
            </tr>
            <tr>
                <td>
                    <?php echo $other_pathology_tissue_site; ?>: <br />
                    <?php echo form_dropdown('other_pathology_tissue_site', $patient_cancer_site_lists, NULL, 'id="cancer_site"'); ?>
                </td>
				<td>
                    <?php echo $other_pathology_path_report_type; ?>: <br />
					<?php echo form_dropdown('other_pathology_path_report_type', $pathology_path_report_type_lists, NULL, 'id="pathology_path_report_type_lists"'); ?>
                </td>
				 <td>
                    <?php echo $other_pathology_path_report_date; ?>: <br />
					<?php echo form_input(array('name'=>'other_pathology_path_report_date','class'=>'datepicker')); ?>
                </td>
            </tr>
			<tr>
				 <td>
                    <?php echo $other_pathology_lab; ?>: <br />
                    <?php echo form_input('other_pathology_lab'); ?>
                </td>
				<td>
                    <?php echo $other_pathology_doctor; ?>: <br />
                    <?php echo form_input('other_pathology_doctor'); ?>
                </td>
			</tr>
			<tr>
				<td>
					<?php echo $other_pathology_tissue_path_comments; ?>: <br />
					<?php
					$data = array(
						'name' => 'other_pathology_tissue_path_comments',
						'id' => 'other_pathology_tissue_path_comments',
						'rows' => '3',
						'cols' => '7'
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
            <div id="add_other_cancer_treatment_div_1" >
                <table id="other_cancer_treatment_1">
                    <tr>
                           <td id="label1">Treatment</td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $other_patient_cancer_treatment_name; ?>: 
                            <?php echo form_dropdown('other_patient_cancer_treatment_name', $patient_cancer_treatment_name_lists, NULL, 'id="patient_cancer_treatment_name_lists"'); ?>
                        </td>
                        <td>
                        <?php echo $treatment_details; ?>: 
                        <?php echo form_input('other_treatment_details'); ?>
                    </td>
                        <td>
                            <?php echo $other_treatment_start_date; ?>: 
                            <?php echo form_input(array('name' => 'other_treatment_start_date', 'class' => 'datepicker')); ?>
                        </td>
                        <td>
                            <?php echo $other_treatment_end_date; ?>: 
                            <?php echo form_input(array('name' => 'other_treatment_end_date', 'class' => 'datepicker')); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $other_treatment_duration; ?>: 
                            <?php echo form_input('other_treatment_duration'); ?>
                        </td>
                        <td>
                            <?php echo $treatment_drug_dose; ?>: 
                            <?php echo form_input('other_treatment_drug_dose'); ?>
                    </td>
                    <td>
                        <?php echo $treatment_cycle; ?>: 
                        <?php echo form_input('other_treatment_cycle'); ?>
                    </td>
                    <td>
                        <?php echo $treatment_route; ?>: 
                        <?php echo form_input('other_treatment_route'); ?>
                    </td>
                     </tr>
                     <tr>
                    <td>
                        <?php echo $treatment_visidual_desease; ?>: 
                        <?php echo form_input('other_treatment_visidual_desease'); ?>
                    </td>
                    <td>
                        <?php echo $treatment_primary_therapy_outcome; ?>: 
                        <?php echo form_input('other_treatment_primary_therapy_outcome'); ?>
                    </td>
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
                        <?php echo form_dropdown('diagnosis_name', $diagnosis_name_lists, NULL, 'id="diagnosis_name_lists"'); ?>
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
                            <?php echo form_input(array('name' => 'medication_start_date', 'class' => 'datepicker')); ?>
                        </td>
                        <td>
                            <?php echo $medication_end_date; ?>: 
                            <?php echo form_input(array('name' => 'medication_end_date', 'class' => 'datepicker')); ?>
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
        </div>
    </div>
</div>
    <?php echo form_fieldset_close(); ?>	
           <?php echo form_submit('mysubmit', 'Save'); ?>
           <?php echo form_close(); ?>
</div>




