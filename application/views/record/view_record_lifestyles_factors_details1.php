<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>Add Lifestyle Factors Details</p>
    </div>
    <div class="container" id="add_record_form_section_lifestyle">
        <div height="30px">&nbsp;</div>
        <table>
            <tr>
                <td id="label1">Patient Self Image</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr height="50px">
                <td  width="23%">
                    <?php echo $self_image_at_7years; ?></td>
                    <td>:</td>
                    <td width="13%"><?php echo @$patient_lifestyle['self_image_at_1years']; ?>
                </td>
                <td width="20%">
                    <?php echo $self_image_at_18years; ?></td>
                    <td>:</td>
                    <td width="13%"><?php echo @$patient_lifestyle['self_image_at_18years']; ?>
                </td>
                <td width="20%">
                    <?php echo $self_image_now; ?></td>
                    <td>:</td>
                    <td width="13%"><?php echo @$patient_lifestyle['self_image_now']; ?>
                </td>
            </tr>
            <tr>
                <td id="label1">Patient Physical Activities</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $pa_at_childhood; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['pa_sport_activity_childhood']; ?>
                </td>
                <td>
                    <?php echo $pa_at_adulthood; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['pa_sport_activity_adulthood']; ?>
                </td>
                <td>
                    <?php echo $pa_now; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['pa_sport_activity_now']; ?>
                </td>
            </tr>
            <tr>
                <td id="label1">Consumption Details</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $cigarettes_smoked_flag; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['cigarettes_smoked_flag']; ?>
                </td>
                <td>
                    <?php echo $cigarettes_still_smoked_flag; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['cigarettes_still_smoked_flag']; ?>
                </td>
                <td>
                    <?php echo $total_smoked_years; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['total_smoked_years']; ?>
                </td>
            </tr>
            <tr>
                <td id="label1">Average cigarettes smoked</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $cigarettes_count_at_teen; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['cigarrets_count_at_teen']; ?>
                </td>
                <td>
                    <?php echo $cigarettes_count_at_twenties; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['cigarrets_count_at_twenties']; ?>
                </td>
                <td>
                    <?php echo $cigarettes_count_at_thirties; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['cigarrets_count_at_thirties']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $cigarettes_count_at_forties; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['cigarettes_count_at_forties']; ?>
                </td>
                <td>
                    <?php echo $cigarettes_count_at_fifties; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['cigarettes_count_at_fifties']; ?>
                </td>
                <td>
                    <?php echo $cigarettes_count_at_sixties_and_above; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['cigarettes_count_at_sixties_and_above']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $cigarettes_count_one_year_before_diagnosed; ?>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['cigarettes_count_one_year_before_diagnosed']; ?>
                </td>
                <td>
                    &nbsp;
                </td>
                <td>
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td id="label1">Alcohol</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $alcohol_drunk_flag; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['alcohol_drunk_flag']; ?>
                </td>
                <td>
                    <?php echo $alcohol_average; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['alcohol_average']; ?>
                </td>
                <td>
                    <?php echo $alcohol_average_details; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['alcohol_average_details']; ?>
                </td>
            </tr>
            <tr>
                <td id="label1">Coffee</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $coffee_drunk_flag; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['coffee_drunk_flag']; ?>
                </td>
                <td>
                    <?php echo $coffee_age; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['coffee_age']; ?>
                </td>
                <td>
                    <?php echo $coffee_average; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['coffee_average']; ?>
                </td>
            </tr>
            <tr>
                <td id="label1">Tea</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $tea_drunk_flag; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['tea_drunk_flag']; ?>
                </td>
                <td>
                    <?php echo $tea_age; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['tea_age']; ?>
                </td>
                <td>
                    <?php echo $tea_average; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['tea_average']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $tea_type; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['tea_type']; ?>
                </td>
                <td>
                    &nbsp;
                </td>
                <td>
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td id="label1">Soy Bean</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $soya_bean_drunk_flag; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['soya_bean_drunk_flag']; ?>
                </td>
                <td>
                    <?php echo $soya_bean_average; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['soya_bean_average']; ?>
                </td>
                <td>
                    <?php echo $soya_products_flag; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['soya_products_flag']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $soya_products_average; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['soya_products_average']; ?>
                </td>
                <td>
                    &nbsp;
                </td>
                <td>
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td id="label1">Diabetes</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $diabetes_flag; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['diabetes_flag']; ?>
                </td>
                <td>
                    <?php echo $medicine_for_diabetes_flag; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['medicine_for_diabetes_flag']; ?>
                </td>
                <td>
                    <?php echo $diabates_medicine_name; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['diabates_medicine_name']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $soya_products_average; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['soya_products_average']; ?>
                </td>
                <td>
                    &nbsp;
                </td>
                <td>
                    &nbsp;
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $age_period_starts; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['age_period_starts']; ?>
                </td>
                <td>
                    <?php echo $still_period_flag; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['still_period_flag']; ?>
                </td>
                <td>
                    <?php echo $period_type; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['period_type']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $period_cycle_days; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['period_cycle_days']; ?>
                </td>
                <td>
                    <?php echo $period_cycle_days_other_details; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['period_cycle_days_other_details']; ?>
                </td>
                <td>
                    <?php echo $age_period_stops; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['age_period_stops']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $date_period_stops; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['date_period_stops']; ?>
                </td>
                <td>
                    <?php echo $reason_period_stops; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['reason_period_stops']; ?>
                </td>
                <td>
                    <?php echo $reason_period_stops_other_details; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['reason_period_stops_other_details']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $pregnant_flag; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['pregnant_flag']; ?>
                </td>
                <td>
                    <?php echo $pregnancy_type; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['pregnancy_type']; ?>
                </td>
                <td>
                    <?php echo $child_gender; ?></td>
                    <td>:</td>
                   <td> <?php echo @$patient_lifestyle['child_gender']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $child_birthyear; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['child_birthyear']; ?>
                </td>
                <td>
                    <?php echo $child_birthweight; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['child_birthweight']; ?>
                </td>
                <td>
                    <?php echo $child_breastfeeding_duration; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['child_breastfeeding_duration']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $infertility_testing_flag; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['infertility_testing_flag']; ?>
                </td>
                <td>
                    <?php echo $infertility_treatment_details; ?></td>
                    <td>:</td>
                   <td> <?php echo @$patient_lifestyle['infertiity_treatment_details']; ?>
                </td>
                <td>&nbsp;</td>
            <tr height="50px">
                <td>
                    <?php echo $contraceptive_pills_flag; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['contraceptive_pills_flag']; ?>
                </td>
                <td>
                    <?php echo $contraceptive_pills_details; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['contraceptive_pills_details']; ?>
                </td>
                <td>
                    <?php echo $currently_taking_contraceptive_pills_flag; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['currently_taking_contraceptive_pills_flag']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $contraceptive_start_date; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['contraceptive_start_date']; ?>
                </td>
                <td>
                    <?php echo $contraceptive_end_date; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['contraceptive_end_date']; ?>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $HRT_flag; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['HRT_flag']; ?>
                </td>
                <td>
                    <?php echo $HRT_details; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['HRT_details']; ?>
                </td>
                <td>
                    <?php echo $currently_using_HRT_flag; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['currently_using_HRT_flag']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $HRT_start_date; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['HRT_start_date']; ?>
                </td>
                <td>
                    <?php echo $HRT_end_date; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['HRT_end_date']; ?>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $had_gnc_surgery_flag; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['had_gnc_surgery_flag']; ?>
                </td>
                <td>
                    <?php echo $gnc_surgery_year; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['gnc_surgery_year']; ?>
                </td>
                <td>
                    <?php echo $gnc_treatment_name; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['gnc_treatment_name']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $gnc_treatment_name_other_details; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_lifestyle['gnc_treatment_name_other_details']; ?>
                </td>
                <td>
                    &nbsp;
                </td>
                <td>
                    &nbsp;
                </td>
            </tr>
        </table>
<!--                <a align="center" class="doneButton" href="<?php echo base_url(); ?>">Done</a>-->
    </div>
</div>




