<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>Add Studies, Mammo, Cancer & Diagnosis Details</p>
    </div>
    <div class="container" id="add_record_form_section_studies">
        <div height="30px">&nbsp;</div>
        <table>
            <tr height="50px">
                <td width="15%">
                    <?php echo $studies_name; ?></td>
                <td>:</td>
                <td width="15%"><?php echo @$patient_studies['studies_name']; ?>
                </td>
                <td width="15%">
                    <?php echo $date_at_consent; ?></td>
                <td>:</td>
                <td width="15%"><?php echo @$patient_studies['date_at_consent']; ?>
                </td>
                <td width="15%">
                    <?php echo $age_at_consent; ?></td>
                <td>:</td>
                <td width="15%"><?php echo @$patient_studies['age_at_consent']; ?>
                </td>
                <td width="15%">
                    <?php echo $is_double_consent_flag; ?></td>
                <td>:</td>
                <td width="15%"><?php echo @$patient_studies['is_double_consent_flag']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $double_consent_details; ?></td>
                <td>:</td>
                <td><?php echo @$patient_studies['consent_given_by']; ?>
                </td>
                <td>
                    <?php echo $consent_given_by; ?></td>
                <td>:</td>
                <td><?php echo @$patient_studies['consent_given_by']; ?>
                </td>
                <td>
                    <?php echo $consent_response; ?></td>
                <td>:</td>
                <td><?php echo @$patient_studies['consent_response']; ?>
                </td>
                <td>
                    <?php echo $consent_version; ?></td>
                <td>:</td>
                <td><?php echo @$patient_studies['consent_version']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $relations_to_study; ?></td>
                <td>:</td>
                <td><?php
                    echo @$patient_studies['relations_to_study'];
                    ?>
                </td>
                <td>
                    <?php echo $referral_to; ?></td>
                <td>:</td>
                <td><?php
                    echo @$patient_studies['referral_to'];
                    ?>
                </td>
                <td>
                    <?php echo $referral_to_service; ?></td>
                <td>:</td>
                <td><?php echo @$patient_studies['referral_to_service']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $referral_date; ?></td>
                <td>:</td>
                <td><?php echo @$patient_studies['referral_date']; ?>
                </td>
                <td>
                    <?php echo $referral_source; ?></td>
                <td>:</td>
                <td><?php
                    echo @$patient_studies['referral_source'];
                    ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $year_of_first_mammogram; ?></td>
                <td>:</td>
                <td><?php echo @$patient_mammogram['year_of_first_mammogram']; ?>
                </td>
                <td>
                    <?php echo $age_at_first_mammogram; ?></td> 
                <td>:</td>
                <td><?php echo @$patient_mammogram['age_at_first_mammogram']; ?>
                </td>
                <td>
                    <?php echo $date_of_recent_mammogram; ?></td>
                <td>:</td>
                <td><?php echo @$patient_mammogram['date_of_recent_mammogram']; ?>
                </td>
                <td>
                    <?php echo $screening_center; ?></td>
                <td>:</td>
                <td><?php echo @$patient_mammogram['screening_center']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $name_of_radiologist; ?></td>
                <td>:</td>
                <td><?php echo @$patient_mammogram['name_of_radiologist']; ?>
                </td>
                <td>
                    <?php echo $action_suggested_on_mammo_report; ?></td>
                <td>:</td>
                <td><?php echo @$patient_mammogram['total_no_of_mammogram']; ?>					
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $total_no_of_mammogram; ?></td>
                <td>:</td>
                <td><?php echo @$patient_mammogram['total_no_of_mammogram']; ?>
                </td>
                <td>
                    <?php echo $screening_interval; ?></td>
                <td>:</td>
                <td><?php echo @$patient_mammogram['screening_interval']; ?>
                </td>
                <td>
                    <?php echo $abnormality_mammo_flag; ?></td>
                <td>:</td>
                <td><?php echo @$patient_mammogram['abnormality_mammo_flag']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $mammo_left_right_breast_side; ?></td>
                <td>:</td>
                <td><?php echo @$patient_mammogram['mammo_left_right_breast_side']; ?>
                </td>
                <td>
                    <?php echo $mammo_upper_below_breast_side; ?></td>
                <td>:</td>
                <td><?php echo @$patient_mammogram['mammo_upper_below_breast_side']; ?>
                </td>
                <td>
                    <?php echo $mammo_breast_other_descriptions; ?></td>
                <td>:</td>
                <td><?php echo @$patient_mammogram['mammo_upper_below_breast_side']; ?>
                </td>

            </tr>
            <tr height="50px">
                <td id="label1">Ultrasound Details</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $had_ultrasound_flag; ?></td>
                <td>:</td>
                <td><?php echo @$patient_mammogram['had_ultrasound_flag']; ?>
                </td>
                <td>
                    <?php echo $total_no_of_ultrasound; ?></td>
                <td>:</td>
                <td><?php echo @$patient_mammogram['total_no_of_ultrasound']; ?>
                </td>
                <td>
                    <?php echo $abnormality_ultrasound_flag; ?></td>
                <td>:</td>
                <td><?php echo @$patient_mammogram['abnormality_ultrasound_flag']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $mammo_ultrasound_details; ?></td>
                <td>:</td>
                <td><?php echo @$patient_mammogram['abnormality_ultrasound_flag']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td id="label1">MRI Details</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $had_MRI_flag; ?></td>
                <td>:</td>
                <td><?php echo @$patient_mammogram['had_MRI_flag']; ?>
                </td>
                <td>
                    <?php echo $total_no_of_MRI; ?></td>
                <td>:</td>
                <td><?php echo @$patient_mammogram['total_no_of_MRI']; ?>
                </td>
                <td>
                    <?php echo $abnormality_MRI_flag; ?></td>
                <td>:</td>
                <td><?php echo @$patient_mammogram['abnormality_MRI_flag']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $mammo_MRI_details; ?></td>
                <td>:</td>
                <td><?php echo @$patient_mammogram['abnormality_ultrasound_flag']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td id="label1">Surgery Details</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $had_surgery_for_benign_lump_or_cyst_flag; ?></td>
                <td>:</td>
                <td><?php echo @$patient_mammogram['had_surgery_for_benign_lump_or_cyst_flag']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $mammo_benign_lump_cyst_details; ?></td>
                <td>:</td>
                <td><?php echo @$patient_mammogram['abnormality_ultrasound_flag']; ?>
                </td>

            </tr>
            <tr height="50px">
                <td id="label1">Other Screenings Details</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $other_screening_flag; ?></td>
                <td>:</td>
                <td><?php echo @$patient_mammogram['other_screening_flag']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $screening_name; ?></td>
                <td>:</td>
                <td><?php echo @$patient_other_screening['screening_name']; ?>
                </td>
                <td>
                    <?php echo $total_no_of_screening; ?></td>
                <td>:</td>
                <td><?php echo @$patient_other_screening['total_no_of_screening']; ?>
                </td>
                <td>
                    <?php echo $age_at_screening; ?></td>
                <td>:</td>
                <td><?php echo @$patient_other_screening['age_at_screening']; ?>
                </td>
                <td>
                    <?php echo $place_of_screening; ?></td>
                <td>:</td>
                <td><?php echo @$patient_other_screening['place_of_screening']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $screening_results; ?></td>
                <td>:</td>
                <td><?php echo @$patient_mammogram['abnormality_ultrasound_flag']; ?>
                </td>

            </tr>
            <tr height="50px">
                <td>
                    <?php echo $breast_cancer_diagnosed_flag; ?></td>
                <td>:</td>
                <td><?php echo @$patient_cancer['breast_cancer_diagnosed_flag']; ?>
                </td>
                <td>
                    <?php echo @$patient_cancer_name; ?></td>
                <td>:</td>
                <td><?php echo @$patient_cancer['patient_cancer_name']; ?>
                </td>
                <td>
                    <?php echo $primary_diagnosis; ?></td>
                <td>:</td>
                <td><?php echo @$patient_cancer['primary_diagnosis']; ?>
                </td>
            </tr>
            <tr height="50px">
            <td>
                <?php echo $cancer_site; ?></td>
            <td>:</td>
            <td><?php echo @$patient_cancer['cancer_site']; ?>
            </td>
            <td>
                <?php echo $cancer_site_details; ?></td>
            <td>:</td>
            <td><?php echo @$patient_cancer['cancer_site']; ?>
            </td>

            </tr>
            <tr height="50px">
                <td>
                    <?php echo $age_of_diagnosis; ?></td>
                <td>:</td>
                <td><?php echo @$patient_cancer['age_of_diagnosis']; ?>
                </td>
                <td>
                    <?php echo $date_of_diagnosis; ?></td>
                <td>:</td>
                <td><?php echo @$patient_cancer['date_of_diagnosis']; ?>
                </td>
                <td>
                    <?php echo $cancer_diagnosis_center; ?></td>
                <td>:</td>
                <td><?php echo @$patient_cancer['cancer_diagnosis_center']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $cancer_doctor_name; ?></td>
                <td>:</td>
                <td><?php echo @$patient_cancer['cancer_doctor_name']; ?>
                </td>
                <td>
                    <?php echo $detected_by; ?></td>
                <td>:</td>
                <td><?php echo @$patient_cancer['detected_by']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo @$patient_cancer_treatment_name; ?></td>
                <td>:</td>
                <td><?php echo @$patient_cancer_treatment['patient_cancer_treatment_name']; ?>
                </td>
                <td>
                    <?php echo $treatment_start_date; ?></td>
                <td>:</td>
                <td><?php echo @$patient_cancer_treatment['treatment_start_date']; ?>
                </td>
                <td>
                    <?php echo $treatment_end_date; ?></td>
                <td>:</td>
                <td><?php echo @$patient_cancer_treatment['treatment_end_date']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $treatment_drug_dose; ?></td>
                <td>:</td>
                <td><?php echo @$patient_cancer_treatment['treatment_drug_dose']; ?>
                </td>

            </tr>
            <tr height="50px">
                <td>
                    <?php echo $is_recurrence_flag; ?></td>
                <td>:</td>
                <td><?php echo @$patient_cancer['is_recurrence_flag']; ?>
                </td>
                <td>
                    <?php echo $recurrence_site; ?></td>
                <td>:</td>
                <td><?php echo @$patient_cancer['recurrence_site']; ?>
                </td>
                <td>
                    <?php echo $recurrence_date; ?></td>
                <td>:</td>
                <td><?php echo @$patient_cancer['recurrence_date']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo @$patient_cancer_recurrence_treatment_name; ?></td>
                <td>:</td>
                <td><?php echo @$patient_cancer['patient_cancer_recurrence_treatment_name']; ?>
                </td>

            </tr>
            <tr height="50px">
                <td>
                    <?php echo $patient_other_diagnosis_name; ?></td>
                <td>:</td>
                <td><?php echo @$patient_diagnosis['diagnosis_name']; ?>
                </td>
                <td>
                    <?php echo $diagnosis_details; ?></td>
                <td>:</td>
                <td><?php echo @$patient_diagnosis['diagnosis_name']; ?>
                </td>
                <td>
                    <?php echo $diagnosis_age; ?></td>
                <td>:</td>
                <td><?php echo @$patient_diagnosis['diagnosis_age']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $year_of_diagnosis; ?></td>
                <td>:</td>
                <td><?php echo @$patient_diagnosis['year_of_diagnosis']; ?>
                </td>
                <td>
                    <?php echo $is_on_medication_flag; ?></td>
                <td>:</td>
                <td><?php echo @$patient_diagnosis['is_on_medication_flag']; ?>
                </td>
                <td>
                    <?php echo $medication_details; ?></td>
                <td>:</td>
                <td><?php echo @$patient_diagnosis['diagnosis_name']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $diagnosis_center; ?></td>
                <td>:</td>
                <td><?php echo @$patient_diagnosis['diagnosis_center']; ?>
                </td>
                <td>
                    <?php echo $diagnosis_doctor_name; ?></td>
                <td>:</td>
                <td><?php echo @$patient_diagnosis['diagnosis_doctor_name']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $pathology_tissue_site; ?></td>
                <td>:</td>
                <td><?php echo @$patient_pathology['diagnosis_name']; ?>
                </td>
                <td>
                    <?php echo $pathology_tissue_tumour_stage; ?></td>
                <td>:</td>
                <td><?php echo @$patient_pathology['pathology_tissue_tumour_stage']; ?>
                </td>
                <td>
                    <?php echo $pathology_morphology; ?></td>
                <td>:</td>
                <td><?php echo @$patient_pathology['pathology_morphology']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $pathology_node_stage; ?></td>
                <td>:</td>
                <td><?php echo @$patient_pathology['pathology_node_stage']; ?>
                </td>
                <td>
                    <?php echo $pathology_lymph_node; ?></td>
                <td>:</td>
                <td><?php echo @$patient_pathology['pathology_lymph_node']; ?>
                </td>
                <td>
                    <?php echo $pathology_total_lymph_nodes; ?></td>
                <td>:</td>
                <td><?php echo @$patient_pathology['pathology_total_lymph_nodes']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $pathology_ER_status; ?></td>
                <td>:</td>
                <td><?php echo @$patient_pathology['pathology_ER_status']; ?>
                </td>
                <td>
                    <?php echo $pathology_PR_status; ?></td>
                <td>:</td>
                <td><?php echo @$patient_pathology['pathology_PR_status']; ?>
                </td>
                <td>
                    <?php echo $pathology_HER2_status; ?></td>
                <td>:</td>
                <td><?php echo @$patient_pathology['pathology_HER2_status']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $pathology_number_of_tumours; ?></td>
                <td>:</td>
                <td><?php echo @$patient_pathology['pathology_number_of_tumours']; ?>
                </td>
                <td>
                    <?php echo $pathology_metastasis_stage; ?></td>
                <td>:</td>
                <td><?php echo @$patient_pathology['pathology_metastasis_stage']; ?>
                </td>
                <td>
                    <?php echo $pathology_side_affected; ?></td>
                <td>:</td>
                <td><?php echo @$patient_pathology['pathology_side_affected']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $pathology_tumour_stage; ?></td>
                <td>:</td>
                <td><?php echo @$patient_pathology['pathology_tumour_stage']; ?>
                </td>
                <td>
                    <?php echo $pathology_tumour_grade; ?></td>
                <td>:</td>
                <td><?php echo @$patient_pathology['pathology_tumour_grade']; ?>
                </td>
                <td>
                    <?php echo $pathology_tumour_size; ?></td>
                <td>:</td>
                <td><?php echo @$patient_pathology['pathology_tumour_size']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $pathology_doctor; ?></td>
                <td>:</td>
                <td><?php echo @$patient_pathology['pathology_doctor']; ?>
                </td>
                <td>
                    <?php echo $pathology_lab; ?></td>
                <td>:</td>
                <td><?php echo @$patient_pathology['pathology_lab']; ?>
                </td>
                <td>
                    <?php echo $pathology_lab_reference; ?></td>
                <td>:</td>
                <td><?php echo @$patient_pathology['pathology_lab_reference']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $pathology_path_report_date; ?></td> 
                <td>:</td>
                <td><?php echo @$patient_pathology['pathology_path_report_date']; ?>
                </td>
                <td>
                    <?php echo $pathology_path_report_type; ?></td>
                <td>:</td>
                <td><?php echo @$patient_pathology['pathology_path_report_type']; ?>
                </td>
                <td>
                    <?php echo $pathology_report_requested_date; ?></td>
                <td>:</td>
                <td><?php echo @$patient_pathology['pathology_report_requested_date']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $pathology_path_report_received_date; ?></td> 
                <td>:</td>
                <td><?php echo @$patient_pathology['pathology_path_report_received_date']; ?>
                </td>
                <td>
                    <?php echo $pathology_path_block_requested_date ?></td>
                <td>:</td>
                <td><?php echo @$patient_pathology['pathology_path_block_requested_date']; ?>
                </td>
                <td>
                    <?php echo $pathology_path_block_received_date ?></td>
                <td>:</td>
                <td><?php echo @$patient_pathology['pathology_path_block_received_date']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $pathology_tissue_path_comments; ?></td>
                <td>:</td>
                <td><?php echo @$patient_pathology['pathology_path_block_received_date']; ?>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table>
    </div>
</div>




