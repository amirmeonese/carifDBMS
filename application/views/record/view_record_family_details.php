<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>View Family Details</p>
    </div>
    <div class="container" id="add_record_form_section_1">
        <div height="30px">&nbsp;</div>
        <table>
            <tr height="50px">
                <td width="15%">
                    <?php echo $father_fullname; ?></td>
                <td>:</td>
                <td width="13%"><?php echo @$patient_family['full_name']; ?>
                </td>
                <td width="15%">
                    <?php echo $father_surname; ?></td>
                <td>:</td>
                <td width="13%">	<?php echo @$patient_family['sur_name']; ?>
                </td>
                <td width="15%">
                    <?php echo $father_maiden_name; ?></td>
                <td>:</td>
                <td width="13%">	<?php echo @$patient_family['maiden_name']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $father_ethnicity; ?></td>
                <td>:</td>
                <td>	<?php echo @$patient_family['ethnicity']; ?>
                </td>
                <td>
                    <?php echo $father_town_residence; ?></td>
                <td>:</td>
                <td>	<?php echo @$patient_family['town_of_residence']; ?>
                </td>
                <td>
                    <?php echo $father_DOB; ?></td>
                <td>:</td>
                <td>	<?php echo @$patient_family['d_o_b']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $father_still_alive_flag; ?></td>
                <td>:</td>
                <td>	<?php echo @$patient_family['is_alive_flag']; ?>
                </td>
                <td>
                    <?php echo $father_DOD; ?></td> 
                <td>:</td>
                <td>	<?php echo @$patient_family['d_o_d']; ?>
                </td>
                <td>
                    <?php echo $father_is_cancer_diagnosed; ?></td> 
                <td>:</td>
                <td>	<?php echo @$patient_family['is_cancer_diagnosed']; ?>
                </td>
                
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $father_date_of_diagnosis; ?></td>
                <td>:</td>
                <td>	<?php echo @$patient_family['date_of_diagnosis']; ?>
                </td>
                <td>
                    <?php echo $father_cancer_name; ?></td>
                <td>:</td>
                <td>	<?php echo @$patient_family['cancer_type_id']; ?>
                </td>
                <td>
                    <?php echo $father_age_of_diagnosis; ?></td> 
                <td>:</td>
                <td>	<?php echo @$patient_family['age_of_diagnosis']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $father_diagnosis_other_details; ?></td>
                <td>:</td>
                <td>	<?php echo @$patient_family['other_detail']; ?>
                </td>
                <td>
                    <?php echo $father_no_of_brothers; ?></td>
                <td>:</td>
                <td>	<?php echo @$patient_family['no_of_brothers']; ?>
                </td>
                <td>
                    <?php echo $father_no_of_sisters; ?></td> 
                <td>:</td>
                <td>	<?php echo @$patient_family['no_of_sisters']; ?>
                </td>
                
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $father_no_female_children; ?></td>
                <td>:</td>
                <td>	<?php echo @$patient_family['no_female_children']; ?>
                </td>
                <td>
                    <?php echo $father_no_male_children; ?></td> 
                <td>:</td>
                <td>	<?php echo @$patient_family['no_male_children']; ?>
                </td>
                <td>
                    <?php echo $father_no_of_first_degree; ?></td> 
                <td>:</td>
                <td>	<?php echo @$patient_family['no_of_first_degree']; ?>
                </td>
                
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $father_no_of_second_degree; ?></td>
                <td>:</td>
                <td>	<?php echo @$patient_family['total_no_of_second_degree']; ?>
                </td>
                <td>
                    <?php echo $father_no_of_third_degree; ?></td>
                <td>:</td>
                <td>	<?php echo @$patient_family['total_no_of_third_degree']; ?>
                </td>
                <td>
                    <?php echo $father_vital_status; ?></td> 
                <td>:</td>
                <td>	<?php echo @$patient_family['vital_status']; ?>
                </td>
                
            </tr>
            <tr height="50px">
            <td>
                    <?php echo $father_mach_score_at_consent; ?></td>
                <td>:</td>
                <td>	<?php echo @$patient_family['match_score_at_consent']; ?>
                </td>
                <td>
                    <?php echo $father_mach_score_past_consent; ?></td> 
                <td>:</td>
                <td>	<?php echo @$patient_family['match_score_past_consent']; ?>
                </td>
                <td>
                    <?php echo $father_FH_category; ?></td> 
                <td>:</td>
                <td>	<?php echo @$patient_family['fh_category']; ?>
                </td>
            </tr>
        </table>
<!--                <a align="center" class="doneButton" href="<?php echo base_url(); ?>">Done</a>-->
    </div>

</div>




