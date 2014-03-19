<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>View Screenings & Surveillance</p>
    </div>
    <?php
    $attributes = array('id' => 'screenings-details-form');
    echo form_open("record/studies_set_one_update", $attributes);
    ?>
    <div class="container" id="add_record_form_section_mammo">
        <div height="30px">&nbsp;</div>
        <?php foreach ($patient_breast_screening as $breast_screening): ?>
        <?php
        echo form_fieldset('Mammogram');
        ?>
        <table id="mammo_first_section">
            <tr>
                <td>
                    <?php echo $reason_of_mammogram; ?>:
                    <?php echo form_dropdown('reason_of_mammogram[]', $reason_mammo, $breast_screening['reason_of_mammogram'], 'id="reason_mammo" preload_val="'.$breast_screening['reason_of_mammogram'].'"'); ?>
                </td>
                <td>
                    <?php echo $details_for_mammogram; ?>: 
                    <?php echo form_input(array('name' => 'details_for_mammogram[]', 'value' => $breast_screening['reason_of_mammogram_details'])) ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $date_of_first_mammogram; ?>: 
                    <?php echo form_input(array('name' => 'date_of_first_mammogram[]', 'value' => $breast_screening['date_of_first_mammogram'] == '0000-00-00' ? '00-00-0000'  : date('d-m-Y', strtotime($breast_screening['date_of_first_mammogram'])), 'class' => 'datepicker')) ?>
                </td>
                <td>
                    <?php echo $age_at_first_mammogram; ?>: 
                    <?php echo form_input(array('name' => 'age_of_first_mammogram[]', 'value' => $breast_screening['age_of_first_mammogram'])) ?>
                </td>
                <td>
                    <?php echo $screening_center_at_first_mammogram; ?>: 
                    <?php echo form_input(array('name' => 'screening_center_of_first_mammogram[]', 'value' => $breast_screening['screening_center_of_first_mammogram'])) ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $motivaters_at_first_mammogram; ?>: 
                    <?php echo form_input(array('name' => 'motivaters_at_first_mammogram[]', 'value' => $breast_screening['motivaters_of_first_mammogram'])) ?>
                </td>
                <td>
                    <?php echo $details_at_first_mammogram; ?>: 
                    <?php echo form_input(array('name' => 'details_at_first_mammogram[]', 'value' => $breast_screening['details_of_first_mammogram'])) ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $date_of_recent_mammogram; ?>: 
                    <?php echo form_input(array('name' => 'date_of_recent_mammogram[]', 'value' => $breast_screening['date_of_recent_mammogram'] == '0000-00-00' ? '00-00-0000'  : date('d-m-Y', strtotime($breast_screening['date_of_recent_mammogram'])), 'class' => 'datepicker')) ?>
                </td>
<!--                <td>
                    <?php echo $age_at_recent__mammogram; ?>: 
                    <?php echo form_input(array('name' => 'age_at_recent__mammogram[]', 'value' => $breast_screening['age_of_diagnosis'])) ?>
                </td>-->
                <td>
                    <?php echo $screening_center_at_recent_mammogram; ?>: 
                    <?php echo form_input(array('name' => 'screening_center_of_recent_mammogram[]', 'value' => $breast_screening['screening_center_of_recent_mammogram'])) ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $motivaters_at_recent_mammogram; ?>: 
                    <?php echo form_input(array('name' => 'motivaters_at_recent_mammogram[]', 'value' => $breast_screening['motivaters_of_recent_mammogram'])) ?>
                </td>
                <td>
                    <?php echo $details_at_recent_mammogram; ?>: 
                    <?php echo form_input(array('name' => 'details_at_recent_mammogram[]', 'value' => $breast_screening['details_of_recent_mammogram'])) ?>
                </td>
                <?php if($breast_screening['mammogram_in_sdmc'] == 1){?>
                <td>
                    <?php echo $mammogram_in_sdmc; ?>: 
                    <?php echo form_checkbox(array('name' => 'mammogram_in_sdmc[]', 'value' => $breast_screening['mammogram_in_sdmc'],'checked'=>"checked"))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $mammogram_in_sdmc; ?>: 
                    <?php echo form_checkbox(array('name' => 'mammogram_in_sdmc[]', 'value' => $breast_screening['mammogram_in_sdmc']))?>
                </td>
               <?php } ?>
            </tr>
            <tr>
                <td>
                    <?php echo $name_of_radiologist; ?>: 
                    <?php echo form_input(array('name' => 'name_of_radiologist[]', 'value' => $breast_screening['name_of_radiologist'])) ?>
                </td>
                <?php if($breast_screening['breast_is_abnormality_detected'] == 1){?>
                <td>
                    <?php echo $abnormalities_mammo_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'abnormality_mammo_flag[]', 'value' => $breast_screening['breast_is_abnormality_detected'],'checked'=>"checked"))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $abnormalities_mammo_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'abnormality_mammo_flag[]', 'value' => $breast_screening['breast_is_abnormality_detected']))?>
                </td>
               <?php } ?>
                <td>
                    <?php echo $mammo_comments; ?>: 
                    <?php echo form_textarea(array('name' => 'mammo_comments[]','id' => 'mammo_comments','rows' => '3','cols' => '7', 'value' => $breast_screening['mammo_comments']))?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $total_no_of_mammogram; ?>: 
                    <?php echo form_input(array('name' => 'total_no_of_mammogram[]', 'value' => $breast_screening['total_no_of_mammogram'])) ?>
                </td>
                <td>
                    <?php echo $screening_interval; ?>: 
                    <?php echo form_input(array('name' => 'screening_interval[]', 'value' => $breast_screening['screening_interval'])) ?>
                </td>

            </tr>
        </table>
        <table id="mammo_second_section_1">
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $mammo_left_right_breast_side; ?>: 
                    <?php echo form_dropdown('mammo_left_right_breast_side[]', $mammo_left_right_breast_side_lists, $site_breast[$breast_screening['left_breast']], 'id="mammo_left_right_breast_side_lists" preload_val="'.$site_breast[$breast_screening['left_breast']].'"'); ?>
                </td>
          
                <td>
                    <?php echo $mammo_upper_below_breast_side; ?>: 
                    <?php echo form_dropdown('mammo_upper_below_breast_side[]', $mammo_upper_below_breast_side_lists, $upperbelow_breast[$breast_screening['upper']], 'id="mammo_upper_below_breast_side_lists" preload_val="'.$upperbelow_breast[$breast_screening['upper']].'"'); ?>
                </td>
<!--                <td>
                    <?php echo $mammo_is_abnormality_detected; ?>: 
                    <?php echo form_checkbox(array('name' => 'mammo_is_abnormality_detected[]', 'value' => $breast_screening['mammo_is_abnormality_detected']))?>
                </td>-->
            </tr>           
        </table>
        <?php echo form_fieldset_close(); ?>	
    </div>
    <div height="30px">&nbsp;</div>
    <table>
        <tr>
            <td>
                <?php echo $BIRADS_clinical_classification; ?>: 
                <?php echo form_input(array('name' => 'BIRADS_clinical_classification[]', 'value' => $breast_screening['BIRADS_clinical_classification'])) ?>
            </td>
            <td>
                <?php echo $BIRADS_density_classification; ?>: 
                <?php echo form_input(array('name' => 'BIRADS_density_classification[]', 'value' => $breast_screening['BIRADS_density_classification'])) ?>
            </td>
            <td>
                <?php echo $percentage_of_mammo_density; ?>: 
                <?php echo form_input(array('name' => 'percentage_of_mammo_density[]', 'value' => $breast_screening['percentage_of_mammo_density'])) ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo $action_suggested_on_mammogram_report; ?>: 
                <?php echo form_input(array('name' => 'action_suggested_on_mammogram_report[]', 'value' => $breast_screening['action_suggested_on_mammogram_report'])) ?>
            </td>
            <td>
                <?php echo $reason_of_action_suggested; ?>: 
                <?php echo form_input(array('name' => 'reason_of_action_suggested[]', 'value' => $breast_screening['reason_of_action_suggested'])) ?>
            </td>
            <?php if($breast_screening['is_cancer_mammogram_flag'] == 1){?>
            <td>
                <?php echo $is_cancer; ?>: 
                <?php echo form_checkbox(array('name' => 'is_cancer_mammogram_flag[]', 'value' => $breast_screening['is_cancer_mammogram_flag'],'checked'=>"checked"))?>
            </td>
               <?php } else {?>
                <td>
                <?php echo $is_cancer; ?>: 
                <?php echo form_checkbox(array('name' => 'is_cancer_mammogram_flag[]', 'value' => $breast_screening['is_cancer_mammogram_flag']))?>
            </td>
               <?php } ?>
            
            <td>
                <?php echo $side_effected; ?>: 
                <?php echo form_dropdown('site_effected_of_mammogram[]', $mammo_report_site, $breast_screening['site_effected_of_mammogram'], 'id="cancer_site" preload_val="'.$breast_screening['site_effected_of_mammogram'].'"'); ?>
            </td>

            <td>&nbsp;</td>
        </tr>
    </table>
<!--    <div class="container" id="add_record_form_section_mammo_attach_raw_processed_images">
        <div height="30px">&nbsp;</div>
        <?php
        echo form_fieldset('Attach raw images');
        ?>
        <table id="mammo_images_section">
            <tr>
                <td>
                    <?php echo $upload_raw_images_one; ?>: 

                    <input type="file" name="raw_images_one[]" size="100000" />

                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $upload_raw_images_two; ?>: 
                    <input type="file" name="raw_images_two[]" size="100000" />
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $upload_raw_images_three; ?>: 
                    <input type="file" name="raw_images_three[]" size="100000" />
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $upload_raw_images_four; ?>: 

                    <input type="file" name="raw_images_four[]" size="100000" />
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
                    <input type="file" name="processed_images_one[]" size="100000" />
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $upload_processed_images_two; ?>: 
                    <input type="file" name="processed_images_two[]" size="100000" />
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $upload_processed_images_three; ?>: 
                    <input type="file" name="processed_images_three[]" size="100000" />
                </td>
            </tr><tr>
                <td>
                    <?php echo $upload_processed_images_four; ?>: 
                    <input type="file" name="processed_images_four[]" size="100000" />
                </td>
            </tr>
        </table>
    </div>-->
    <div class="container" id="add_record_form_section_mammo_ultrasound">
        <div height="30px">&nbsp;</div>
        <table id="mammo_third_section">
            <tr>
                <td id="label1">Ultrasound</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr><?php if($breast_screening['had_ultrasound_flag'] == 1){?>
                <td>
                    <?php echo $had_ultrasound_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'had_ultrasound_flag[]', 'value' => $breast_screening['had_ultrasound_flag'],'checked'=>"checked"))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $had_ultrasound_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'had_ultrasound_flag[]', 'value' => $breast_screening['had_ultrasound_flag']))?>
                </td>
               <?php } ?>
                <td>
                    <?php echo $total_no_of_ultrasound; ?>: 
                    <?php echo form_input(array('name' => 'total_no_of_ultrasound[]', 'value' => $breast_screening['total_no_of_ultrasound'])) ?>
                </td>
                <?php if($breast_screening['abnormalities_ultrasound_flag'] == 1){?>
                <td>
                    <?php echo $abnormalities_ultrasound_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'abnormality_ultrasound_flag[]', 'value' => $breast_screening['abnormalities_ultrasound_flag'],'checked'=>"checked"))?>
                </td>
               <?php } else {?>
               <td>
                    <?php echo $abnormalities_ultrasound_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'abnormality_ultrasound_flag[]', 'value' => $breast_screening['abnormalities_ultrasound_flag']))?>
                </td>
               <?php } ?>
            </tr>
        </table>
        <table id="mammo_ultrasound_second_section_1">
            <tr>
                <td>
                    <?php echo $mammo_ultrasound_date; ?>: 
                    <?php echo form_input(array('name' => 'mammo_ultrasound_date[]', 'value' => $breast_screening['ultrasound_date'] == '0000-00-00' ? '00-00-0000'  : date('d-m-Y', strtotime($breast_screening['ultrasound_date'])), 'class' => 'datepicker')) ?>
                </td>
                <td>
                    <?php echo $mammo_ultrasound_details; ?>: 
                    <?php echo form_textarea(array('name' => 'mammo_ultrasound_details[]','id' => 'mammo_ultrasound_details','rows' => '3','cols' => '7', 'value' => $breast_screening['ultrasound_comments']))?>
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
                <?php if($breast_screening['had_mri_flag'] == 1){?>
                <td>

                    <?php echo $had_MRI_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'had_mri_flag[]', 'value' => $breast_screening['had_mri_flag'],'checked'=>"checked"))?>
                </td>
               <?php } else {?>
               <td>

                    <?php echo $had_MRI_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'had_mri_flag[]', 'value' => $breast_screening['had_mri_flag']))?>
                </td>
               <?php } ?>
                
                <td>
                    <?php echo $total_no_of_MRI; ?>: 
                    <?php echo form_input(array('name' => 'total_no_of_mri[]', 'value' => $breast_screening['total_no_of_mri'])) ?>
                </td>
                <?php if($breast_screening['abnormalities_MRI_flag'] == 1){?>
                <td>
                    <?php echo $abnormalities_MRI_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'abnormalities_MRI_flag[]', 'value' => $breast_screening['abnormalities_MRI_flag'],'checked'=>"checked"))?>
                </td>
               <?php } else {?>
               <td>
                    <?php echo $abnormalities_MRI_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'abnormalities_MRI_flag[]', 'value' => $breast_screening['abnormalities_MRI_flag']))?>
                </td>
               <?php } ?>
                
            </tr>
        </table>
        <table id="mammo_MRI_second_section_1">
            <tr>
                <td>
                    <?php echo $mammo_MRI_date; ?>: 
                    <?php echo form_input(array('name' => 'mammo_mri_date[]', 'value' => $breast_screening['mri_date'] == '0000-00-00' ? '00-00-0000'  : date('d-m-Y', strtotime($breast_screening['mri_date'])), 'class' => 'datepicker')) ?>
                </td>
                <td>
                    <?php echo $mammo_MRI_details; ?>: 
                    <?php echo form_textarea(array('name' => 'mammo_MRI_details[]','id' => 'mammo_MRI_details','rows' => '3','cols' => '7', 'value' => $breast_screening['comments']))?>
                </td>
            </tr>
            <input type="hidden" name="patient_ic_no" value="<?php print $breast_screening['patient_ic_no']; ?>"/>
            <input type="hidden" name="patient_breast_screening_id[]" value="<?php print $breast_screening['patient_breast_screening_id']; ?>"/>
            <input type="hidden" name="patient_breast_abnormality_side_id[]" value="<?php print $breast_screening['patient_breast_abnormality_side_id']; ?>"/>
            <input type="hidden" name="patient_ultra_abn[]" value="<?php print $breast_screening['patient_ultra_abn']; ?>"/>
            <input type="hidden" name="patient_mri_abnormality_id[]" value="<?php print $breast_screening['patient_mri_abnormlity_id']; ?>"/>
<!--            <input type="hidden" name="patient_mammo_raw_images_id[]" value="<?php print $breast_screening['patient_mammo_raw_images_id']; ?>"/>
            <input type="hidden" name="patient_mammo_processed_images_id[]" value="<?php print $breast_screening['patient_mammo_processed_images_id']; ?>"/>-->
        </table>
        <?php endforeach; ?>
    </div>
    <div class="container" id="add_record_form_section_mammo_non_cancer_surgery">
        <div height="30px">&nbsp;</div>
        <?php foreach ($patient_non_cancer as $non_cancer): ?>
        <table id="mammo_non_cancer_surgery_section_1">
            <tr>
                <td id="label1">Breast Surgery for non-cancer</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $non_cancer_surgery_type; ?>: 
                    <?php echo form_input(array('name' => 'non_cancer_surgery_type[]', 'value' => $non_cancer['breast_surgery_type'])) ?>
                </td>
                <td>
                    <?php echo $reason_for_non_cancer_surgery; ?>: 
                    <?php echo form_input(array('name' => 'reason_for_non_cancer_surgery[]', 'value' => $non_cancer['breast_reason_of_surgery'])) ?>
                </td>
                <td>
                    <?php echo $date_of_non_cancer_surgery; ?>: 
                    <?php echo form_input(array('name' => 'date_of_non_cancer_surgery[]', 'value' => $non_cancer['breast_date_of_surgery'] == '0000-00-00' ? '00-00-0000'  : date('d-m-Y', strtotime($non_cancer['breast_date_of_surgery'])), 'class' => 'datepicker')) ?>
                </td>
                <td>
                    <?php echo $age_at_non_cancer_surgery; ?>: 
                    <?php echo form_input(array('name' => 'age_at_non_cancer_surgery[]', 'value' => $non_cancer['breast_age_of_surgery'])) ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $non_cancer_surgery_comments; ?>: 
                    <?php echo form_textarea(array('name' => 'non_cancer_surgery_comments[]','id' => 'non_cancer_surgery_comments','rows' => '3','cols' => '7', 'value' => $non_cancer['breast_comments']))?>
                </td>
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
                    <?php echo form_input(array('name' => 'ovary_non_cancer_surgery_type[]', 'value' => $non_cancer['surgery_type'])) ?>
                </td>
                <td>
                    <?php echo $reason_for_non_cancer_surgery; ?>: 
                    <?php echo form_input(array('name' => 'ovary_reason_for_non_cancer_surgery[]', 'value' => $non_cancer['reason_for_surgery'])) ?>
                </td>
                <td>
                    <?php echo $date_of_non_cancer_surgery; ?>: 
                    <?php echo form_input(array('name' => 'ovary_date_of_non_cancer_surgery[]', 'value' => $non_cancer['date_of_surgery'] == '0000-00-00' ? '00-00-0000'  : date('d-m-Y', strtotime($non_cancer['date_of_surgery'])), 'class' => 'datepicker')) ?>
                </td>
                <td>
                    <?php echo $age_at_non_cancer_surgery; ?>: 
                    <?php echo form_input(array('name' => 'ovary_age_at_non_cancer_surgery[]', 'value' => $non_cancer['age_at_surgery'])) ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $non_cancer_surgery_comments; ?>: 
                    <?php echo form_textarea(array('name' => 'ovary_non_cancer_surgery_comments[]','id' => 'ovary_non_cancer_surgery_comments','rows' => '3','cols' => '7', 'value' => $non_cancer['comments']))?>
                </td>
            </tr>
            <input type="hidden" name="patient_non_cancer_surgery_id[]" value="<?php print $non_cancer['patient_non_cancer_surgery_id']; ?>"/>
        </table>
        <?php endforeach; ?>
    </div>
    <div class="container" id="add_record_form_risk_reducing_surgery_div" >
        <div height="30px">&nbsp;</div>
        <?php foreach ($patient_risk_reducing_surgery as $risk_reducing_surgery): ?>
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
                    <?php if($risk_reducing_surgery['had_new_lesion_surgery_flag'] == 1){?>
                    <td>
                        <?php echo $had_new_risk_reducing_surgery; ?>: 
                        <?php echo form_checkbox(array('name' => 'had_new_risk_reducing_surgery[]', 'value' => $risk_reducing_surgery['had_new_lesion_surgery_flag'],'checked'=>"checked"))?>
                    </td>
               <?php } else {?>
               <td>
                        <?php echo $had_new_risk_reducing_surgery; ?>: 
                        <?php echo form_checkbox(array('name' => 'had_new_risk_reducing_surgery[]', 'value' => $risk_reducing_surgery['had_new_lesion_surgery_flag']))?>
                    </td>
               <?php } ?>
                </tr>
            </table>
            <table id="non_cancerous_benign_info_table_1">
                <tr>
                    <td>
                        <?php echo $non_cancerous_benign_site; ?>: 
                        <?php echo form_dropdown('non_cancerous_benign_site[]', $non_cancerous_benign_site_lists, @$non_cancerous_site[$risk_reducing_surgery['lesion_non_cancerous_site_id']], 'id="non_cancerous_benign_site_lists" preload_val="'.@$non_cancerous_site[$risk_reducing_surgery['lesion_non_cancerous_site_id']].'"'); ?>
                    </td>
                    <td>
                        <?php echo $non_cancerous_benign_date; ?>: 
                        <?php echo form_input(array('name' => 'non_cancerous_benign_date[]', 'value' => $risk_reducing_surgery['lesion_surgery_date'] == '0000-00-00' ? '00-00-0000'  : date('d-m-Y', strtotime($risk_reducing_surgery['lesion_surgery_date'])), 'class' => 'datepicker')) ?>
                    </td>
                </tr>
            </table>
        </div>
        <div id="non_cancerous_complete_removal_section_1">
            <table id="non_cancerous_complete_removal_table_1">
                <tr>
                    <?php if($risk_reducing_surgery['had_complete_removal_surgery_flag'] == 1){?>
                    <td>
                        <?php echo $had_new_complete_removal_surgery; ?>: 
                        <?php echo form_checkbox(array('name' => 'had_new_complete_removal_surgery[]', 'value' => $risk_reducing_surgery['had_complete_removal_surgery_flag'],'checked'=>"checked"))?>
                    </td>
               <?php } else {?>
               <td>
                        <?php echo $had_new_complete_removal_surgery; ?>: 
                        <?php echo form_checkbox(array('name' => 'had_new_complete_removal_surgery[]', 'value' => $risk_reducing_surgery['had_complete_removal_surgery_flag']))?>
                    </td>
               <?php } ?>
                </tr>
            </table>
            <table id="non_cancerous_complete_removal_info_table_1">
                <tr>
                    <td>
                        <?php echo $non_cancerous_complete_removal_site; ?>: 
                        <?php echo form_dropdown('non_cancerous_complete_removal_site[]', $non_cancerous_benign_site_lists, @$non_cancerous_site[$risk_reducing_surgery['non_cancerous_site_id']], 'id="non_cancerous_benign_site_lists" preload_val="'.@$non_cancerous_site[$risk_reducing_surgery['non_cancerous_site_id']].'"'); ?>
                    </td>
                    <td>
                        <?php echo $non_cancerous_complete_removal_date; ?>: 
                        <?php echo form_input(array('name' => 'non_cancerous_complete_removal_date[]', 'value' => $risk_reducing_surgery['surgery_date'] == '0000-00-00' ? '00-00-0000'  : date('d-m-Y', strtotime($risk_reducing_surgery['surgery_date'])), 'class' => 'datepicker')) ?>
                    </td>
                    <td>
                        <?php echo $non_cancerous_complete_removal_reason; ?>: 
                        <?php echo form_dropdown('non_cancerous_complete_removal_reason[]', $non_cancerous_complete_removal_reason_lists, $risk_reducing_surgery['surgery_reason'], 'id="non_cancerous_complete_removal_reason_lists" preload_val="'.$risk_reducing_surgery['surgery_reason'].'"'); ?>
                    </td>
                </tr>
                    <input type="hidden" name="patient_risk_reducing_surgery_id[]" value="<?php print $risk_reducing_surgery['patient_risk_reducing_surgery_id']; ?>"/>
                    <input type="hidden" name="patient_risk_reducing_surgery_complete_removal_id[]" value="<?php print $risk_reducing_surgery['patient_risk_reducing_surgery_complete_removal_id']; ?>"/>
                    <input type="hidden" name="patient_risk_reducing_surgery_lesion_id[]" value="<?php print $risk_reducing_surgery['patient_risk_reducing_surgery_lesion_id']; ?>"/>
            </table>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="container" id="add_record_form_section_mammo_ovarian_screenings" >
        <div height="30px">&nbsp;</div>
        <?php foreach ($patient_ovarian_screening as $ovarian_screening): ?>
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
                        <?php echo form_dropdown('ovarian_screening_type_name[]', $ovarian_screening_type_name_lists, $ovarian_screening_type[$ovarian_screening['ovarian_screening_type_id']], 'id="ovarian_screening_type_name_lists" preload_val="'.$ovarian_screening_type[$ovarian_screening['ovarian_screening_type_id']].'"'); ?>
                    </td>
                    <td>
                        <?php echo $physical_exam_date; ?>:
                        <?php echo form_input(array('name' => 'physical_exam_date[]', 'value' => $ovarian_screening['screening_date'] == '0000-00-00' ? '00-00-0000'  : date('d-m-Y', strtotime($ovarian_screening['screening_date'])), 'class' => 'datepicker')) ?>
                    </td>
                    <?php if($ovarian_screening['is_abnormality_detected'] == 1){?>
                    <td>
                        <?php echo $physical_exam_is_abnormality_detected; ?>: 
                        <?php echo form_checkbox(array('name' => 'physical_exam_is_abnormality_detected[]', 'value' => $ovarian_screening['is_abnormality_detected'],'checked'=>"checked"))?>
                    </td>
               <?php } else {?>
               <td>
                        <?php echo $physical_exam_is_abnormality_detected; ?>: 
                        <?php echo form_checkbox(array('name' => 'physical_exam_is_abnormality_detected[]', 'value' => $ovarian_screening['is_abnormality_detected']))?>
                    </td>
               <?php } ?>
                </tr>
                <tr>
                    <td>
                        <?php echo $physical_exam_additional_info; ?>: <br />
                        <?php echo form_textarea(array('name' => 'physical_exam_additional_info[]','id' => 'physical_exam_additional_info','rows' => '3','cols' => '7', 'value' => $ovarian_screening['additional_info']))?>
                    </td>
                </tr>
                <input type="hidden" name="patient_ovarian_screening_id" value="<?php print $ovarian_screening['patient_ovarian_screening_id']; ?>"/>
            </table>
        </div>
        <?php endforeach; ?>
    </div>
    <!--        end-->
    <div class="container" id="add_record_form_section_mammo_other_screenings">
        <div height="30px">&nbsp;</div>
        <?php foreach ($patient_other_screening as $other_screening): ?>
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
                    <?php echo form_dropdown('screening_name[]', $screening_name_lists, $other_screening['screening_type'], 'id="screening_name_lists" preload_val="'.$other_screening['screening_type'].'"'); ?>
                </td>
                <td>
                    <?php echo $age_at_screening; ?>: 
                    <?php echo form_input(array('name' => 'age_at_screening[]', 'value' => $other_screening['age_at_screening'])) ?>
                </td>
                <td>
                    <?php echo $place_of_screening; ?>: 
                    <?php echo form_input(array('name' => 'place_of_screening[]', 'value' => $other_screening['screening_center'])) ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $screening_results; ?>: 
                    <?php echo form_textarea(array('name' => 'screening_results[]','id' => 'screening_results','rows' => '3','cols' => '7', 'value' => $other_screening['screening_result']))?>
                </td>
            </tr>
            <input type="hidden" name="patient_other_screening_id[]" value="<?php print $other_screening['patient_other_screening_id']; ?>"/>
        </table>
        <?php endforeach; ?>
    </div>
    <div class="container" id="add_record_form_section_studies">
        <div height="30px">&nbsp;</div>
        <?php foreach ($patient_surveillance as $surveillance): ?>
        <?php
        echo form_fieldset('Surveillance Details');
        ?>
        <table>
            <tr>
                <td>
                    <?php echo $surveillance_recruitment_center; ?>: 
                    <?php echo form_dropdown('surveillance_recruitment_center[]', $surveillance_recruitment_center_lists, $surveillance['recruitment_center'], 'id="surveillance_recruitment_center_lists" preload_val="'.$surveillance['recruitment_center'].'"'); ?>
                </td>
                <td>
                    <?php echo $surveillance_type; ?>: 
                    <?php echo form_dropdown('surveillance_type[]', $surveillance_type_lists, $surveillance['type'], 'id="surveillance_type_lists" preload_val="'.$surveillance['type'].'"'); ?>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $surveillance_first_consultation_date; ?>: 
                    <?php echo form_input(array('name' => 'surveillance_first_consultation_date[]', 'value' => $surveillance['first_consultation_date'] == '0000-00-00' ? '00-00-0000'  : date('d-m-Y', strtotime($surveillance['first_consultation_date'])), 'class' => 'datepicker')) ?>
                </td>
                <td>
                    <?php echo $surveillance_first_consultation_place; ?>: 
                    <?php echo form_input(array('name' => 'surveillance_first_consultation_place[]', 'value' => $surveillance['first_consultation_place'])) ?>
                </td>
                <td>
                    <?php echo $surveillance_interval; ?>: 
                    <?php echo form_input(array('name' => 'surveillance_interval[]', 'value' => $surveillance['surveillance_interval'])) ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $surveillance_diagnosis; ?>: 
                    <?php echo form_input(array('name' => 'surveillance_diagnosis[]', 'value' => $surveillance['diagnosis'])) ?>
                </td>
                <td>
                    <?php echo $surveillance_due_date; ?>: 
                    <?php echo form_input(array('name' => 'surveillance_due_date[]', 'value' => $surveillance['due_date'] == '0000-00-00' ? '00-00-0000'  : date('d-m-Y', strtotime($surveillance['due_date'])), 'class' => 'datepicker')) ?>
                </td>
                <td>
                    <?php echo $surveillance_reminder_sent_date; ?>: 
                    <?php echo form_input(array('name' => 'surveillance_reminder_sent_date[]', 'value' => $surveillance['reminder_sent_date'] == '0000-00-00' ? '00-00-0000'  : date('d-m-Y', strtotime($surveillance['reminder_sent_date'])), 'class' => 'datepicker')) ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $surveillance_done_date; ?>: 
                    <?php echo form_input(array('name' => 'surveillance_done_date[]', 'value' => $surveillance['surveillance_done_date'] == '0000-00-00' ? '00-00-0000'  : date('d-m-Y', strtotime($surveillance['surveillance_done_date'])), 'class' => 'datepicker')) ?>
                </td>
                <td>
                    <?php echo $surveillance_reminded_by; ?>: 
                    <?php echo form_input(array('name' => 'surveillance_reminded_by[]', 'value' => $surveillance['reminded_by'])) ?>
                </td>
                <td>
                    <?php echo $surveillance_timing; ?>: 
                    <?php echo form_input(array('name' => 'surveillance_timing[]', 'value' => $surveillance['timing'])) ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $surveillance_symptoms; ?>: 
                    <?php echo form_textarea(array('name' => 'surveillance_symptoms[]','id' => 'surveillance_symptoms','rows' => '3','cols' => '7', 'value' => $surveillance['symptoms']))?>
                </td>
                <td>
                    <?php echo $surveillance_doctor_name; ?>: 
                    <?php echo form_input(array('name' => 'surveillance_doctor_name[]', 'value' => $surveillance['doctor_name'])) ?>
                </td>
                <td>
                    <?php echo $surveillance_place; ?>: 
                    <?php echo form_input(array('name' => 'surveillance_place[]', 'value' => $surveillance['surveillance_done_place'])) ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $surveillance_outcome; ?>: 
                    <?php echo form_textarea(array('name' => 'surveillance_outcome[]','id' => 'surveillance_outcome','rows' => '3','cols' => '7', 'value' => $surveillance['outcome']))?>
                </td>
                <td>
                    <?php echo $surveillance_comments; ?>: 
                    <?php echo form_textarea(array('name' => 'surveillance_comments[]','id' => 'surveillance_comments','rows' => '3','cols' => '7', 'value' => $surveillance['comments']))?>
                </td>
                <td>&nbsp;</td>
            </tr>
            <input type="hidden" name="patient_surveillance_id[]" value="<?php print $surveillance['patient_surveillance_id']; ?>"/>
        </table>
        <?php echo form_fieldset_close(); ?>
        <?php endforeach; ?>
    </div>
     <?php if ($userprivillage['edit_privilege']== 1 && !$isLocked){ ?>
    <?php echo form_submit('mysubmit', 'Update'); ?>
    <?php } else { ?>
    <?php }?>
    <?php echo form_close(); ?>

</div>




