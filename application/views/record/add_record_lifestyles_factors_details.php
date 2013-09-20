<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>Add Lifestyle Factors Details</p>
    </div>
    <?php echo form_open_multipart("record/lifestyle_insertion"); ?>
    <div class="container" id="add_record_form_section_lifestyle">
        <div height="30px">&nbsp;</div>
        <?php
        echo form_fieldset('Lifestyle Details');
        ?>
        <table>
            <tr>
                <td id="label1">Patient Self Image</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
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
            <tr>
                <td>
                    <?php echo $self_image_at_7years; ?>: 
                    <?php echo form_dropdown('self_image_at_7years', $self_image_lists); ?>
                </td>
                <td>
                    <?php echo $self_image_at_18years; ?>: 
                    <?php echo form_dropdown('self_image_at_18years', $self_image_lists); ?>
                </td>
                <td>
                    <?php echo $self_image_now; ?>: 
                    <?php echo form_dropdown('self_image_now', $self_image_lists); ?>
                </td>
            </tr>
            <tr>
                <td id="label1">Patient Physical Activities</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $pa_at_childhood; ?>: 
                    <?php echo form_dropdown('pa_at_childhood', $pa_activities_lists); ?>
                </td>
                <td>
                    <?php echo $pa_at_adulthood; ?>: 
                    <?php echo form_dropdown('pa_at_adulthood', $pa_activities_lists); ?>
                </td>
                <td>
                    <?php echo $pa_now; ?>: 
                    <?php echo form_dropdown('pa_now', $pa_activities_lists); ?>
                </td>
            </tr>
            <tr>
                <td id="label1">Consumption Details</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $cigarettes_smoked_flag; ?>: 
                    <?php echo form_checkbox('cigarettes_smoked_flag', '1', FALSE); ?>
                </td>
                <td>
                    <?php echo $cigarettes_still_smoked_flag; ?>: 
                    <?php echo form_checkbox('cigarettes_still_smoked_flag', '1', FALSE); ?>
                </td>
                <td>
                    <?php echo $total_smoked_years; ?>: 
                    <?php echo form_input('total_smoked_years'); ?>
                </td>
            </tr>
            <tr>
                <td id="label1">Average cigarettes smoked</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $cigarettes_count_at_teen; ?>: 
                    <?php echo form_dropdown('cigarettes_count_at_teen', $cigarettes_average_count_lists); ?>
                </td>
                <td>
                    <?php echo $cigarettes_count_at_twenties; ?>: 
                    <?php echo form_dropdown('cigarettes_count_at_twenties', $cigarettes_average_count_lists); ?>
                </td>
                <td>
                    <?php echo $cigarettes_count_at_thirties; ?>: 
                    <?php echo form_dropdown('cigarettes_count_at_thirties', $cigarettes_average_count_lists); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $cigarettes_count_at_forties; ?>: <br />
                    <?php echo form_dropdown('cigarettes_count_at_forties', $cigarettes_average_count_lists); ?>
                </td>
                <td>
                    <?php echo $cigarettes_count_at_fifties; ?>: 
                    <?php echo form_dropdown('cigarettes_count_at_fifties', $cigarettes_average_count_lists); ?>
                </td>
                <td>
                    <?php echo $cigarettes_count_at_sixties_and_above; ?>: 
                    <?php echo form_dropdown('cigarettes_count_at_sixties_and_above', $cigarettes_average_count_lists); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $cigarettes_count_one_year_before_diagnosed; ?>: 
                    <?php echo form_dropdown('cigarettes_count_one_year_before_diagnosed', $cigarettes_average_count_lists); ?>
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
            <tr>
                <td>
                    <?php echo $alcohol_drunk_flag; ?>: <br />
                    <?php echo form_checkbox('alcohol_drunk_flag', '1', FALSE); ?>
                </td>
                <td>
                    <?php echo $alcohol_average; ?>: 
                    <?php echo form_dropdown('alcohol_average', $alcohol_drink_average_lists); ?>
                </td>
                <td>
                    <?php echo $alcohol_average_details; ?>: 
                    <?php echo form_input('alcohol_average_details'); ?>
                </td>
            </tr>
            <tr>
                <td id="label1">Coffee</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $coffee_drunk_flag; ?>: <br />
                    <?php echo form_checkbox('coffee_drunk_flag', '1', FALSE); ?>
                </td>
                <td>
                    <?php echo $coffee_age; ?>: 
                    <?php echo form_input('coffee_age'); ?>
                </td>
                <td>
                    <?php echo $coffee_average; ?>: 
                    <?php echo form_dropdown('coffee_average', $coffee_tea_drink_average_lists); ?>
                </td>
            </tr>
            <tr>
                <td id="label1">Tea</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $tea_drunk_flag; ?>: <br />
                    <?php echo form_checkbox('tea_drunk_flag', '1', FALSE); ?>
                </td>
                <td>
                    <?php echo $tea_age; ?>: 
                    <?php echo form_input('tea_age'); ?>
                </td>
                <td>
                    <?php echo $tea_average; ?>: 
                    <?php echo form_dropdown('tea_average', $coffee_tea_drink_average_lists); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $tea_type; ?>: <br />
                    <?php echo form_dropdown('tea_type', $tea_type_lists); ?>
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
            <tr>
                <td>
                    <?php echo $soya_bean_drunk_flag; ?>: <br />
                    <?php echo form_checkbox('soya_bean_drunk_flag', '1', FALSE); ?>
                </td>
                <td>
                    <?php echo $soya_bean_average; ?>: 
                    <?php echo form_dropdown('soya_bean_average', $coffee_tea_drink_average_lists); ?>
                </td>
                <td>
                    <?php echo $soya_products_flag; ?>: 
                    <?php echo form_checkbox('soya_products_flag', '1', FALSE); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $soya_products_average; ?>: <br />
                    <?php echo form_dropdown('soya_products_average', $soya_products_lists); ?>
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
            <tr>
                <td>
                    <?php echo $diabetes_flag; ?>: <br />
                    <?php echo form_checkbox('diabetes_flag', '1', FALSE); ?>
                </td>
                <td>
                    <?php echo $medicine_for_diabetes_flag; ?>: 
                    <?php echo form_checkbox('medicine_for_diabetes_flag', '1', FALSE); ?>
                </td>
                <td>
                    <?php echo $diabates_medicine_name; ?>: 
                    <?php echo form_input('diabates_medicine_name'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td>
                    &nbsp;
                </td>
            </tr>
        </table>
        <?php echo form_fieldset_close(); ?>
        <?php
        echo form_fieldset('Menstruation Details');
        ?>
        <table>
            <tr>
                <td>
                    <?php echo $age_period_starts; ?>: <br />
                    <?php echo form_input('age_period_starts'); ?>
                </td>
                <td>
                    <?php echo $still_period_flag; ?>: 
                    <?php echo form_checkbox('still_period_flag', '1', FALSE); ?>
                </td>
                <td>
                    <?php echo $period_type; ?>: 
                    <?php echo form_dropdown('period_type', $period_type_lists); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $period_cycle_days; ?>: <br />
                    <?php echo form_dropdown('period_cycle_days', $period_cycle_days_lists); ?>
                </td>
                <td>
                    <?php echo $period_cycle_days_other_details; ?>: <br />
                    <?php echo form_input('period_cycle_days_other_details'); ?>
                </td>
                <td>
                    <?php echo $age_period_stops; ?>: <br />
                    <?php echo form_input('age_period_stops'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $date_period_stops; ?>: <br />
                    <?php echo form_input('date_period_stops'); ?>
                </td>
                <td>
                    <?php echo $reason_period_stops; ?>: <br />
                    <?php echo form_dropdown('reason_period_stops', $reason_period_stops_lists); ?>
                </td>
                <td>
                    <?php echo $reason_period_stops_other_details; ?>: <br />
                    <?php echo form_input('reason_period_stops_other_details'); ?>
                </td>
            </tr>
        </table>
        <?php echo form_fieldset_close(); ?>	
        <?php
        echo form_fieldset('Pregnancy Details');
        ?>
        <table id="pregnancy_section_1">
            <tr>
                <td>
                    <?php echo $pregnant_flag; ?>: <br />
                    <?php echo form_checkbox('pregnant_flag', '1', FALSE); ?>
                </td>
                <td>
                    <?php echo $pregnancy_type; ?>: 
                    <?php echo form_dropdown('pregnancy_type', $pregnancy_type_lists); ?>
                </td>
                <td>
                    <?php echo $child_gender; ?>: 
                    <?php echo form_dropdown('child_gender', $genderTypes); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $child_birthyear; ?>: <br />
                    <?php echo form_input('child_birthyear'); ?>
                </td>
                <td>
                    <?php echo $child_birthweight; ?>: <br />
                    <?php echo form_input('child_birthweight'); ?>
                </td>
                <td>
                    <?php echo $child_breastfeeding_duration; ?>: <br />
                    <?php echo form_input('child_breastfeeding_duration'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="button" value="Add more pregnancy details" onClick="window.parent.addPregnancyInput('add_record_form_section_lifestyle');
                            window.parent.calcHeight();">
                </td>
                <td>
                    &nbsp;
                </td>
                <td>
                    &nbsp;
                </td>
            </tr>
        </table>
        <?php echo form_fieldset_close(); ?>	
        <?php
        echo form_fieldset('Infertility, HRT & GNC Surgery Details');
        ?>
        <table id="infertility_section_1">
            <tr>
                <td>
                    <?php echo $infertility_testing_flag; ?>: <br />
                    <?php echo form_checkbox('infertility_testing_flag', '1', FALSE); ?>
                </td>
                <td>
                    <?php echo $infertility_treatment_details; ?>: 
                    <?php echo form_input('infertility_treatment_details'); ?>
                </td>
                <td>&nbsp;</td>
            <tr>
                <td>
                    <?php echo $contraceptive_pills_flag; ?>: 
                    <?php echo form_checkbox('contraceptive_pills_flag', '1', FALSE); ?>
                </td>
                <td>
                    <?php echo $contraceptive_pills_details; ?>: <br />
                    <?php echo form_input('contraceptive_pills_details'); ?>
                </td>
                <td>
                    <?php echo $currently_taking_contraceptive_pills_flag; ?>: <br />
                    <?php echo form_checkbox('currently_taking_contraceptive_pills_flag', '1', FALSE); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $contraceptive_start_date; ?>: <br />
                    <?php echo form_input('contraceptive_start_date'); ?>
                </td>
                <td>
                    <?php echo $contraceptive_end_date; ?>: <br />
                    <?php echo form_input('contraceptive_end_date'); ?>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $HRT_flag; ?>: <br />
                    <?php echo form_checkbox('HRT_flag', '1', FALSE); ?>
                </td>
                <td>
                    <?php echo $HRT_details; ?>: <br />
                    <?php echo form_input('HRT_details'); ?>
                </td>
                <td>
                    <?php echo $currently_using_HRT_flag; ?>: <br />
                    <?php echo form_checkbox('currently_using_hrt_flag', '1', FALSE); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $HRT_start_date; ?>: <br />
                    <?php echo form_input('hrt_start_date'); ?>
                </td>
                <td>
                    <?php echo $HRT_end_date; ?>: <br />
                    <?php echo form_input('hrt_end_date'); ?>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $had_gnc_surgery_flag; ?>: <br />
                    <?php echo form_checkbox('had_gnc_surgery_flag', '1', FALSE); ?>
                </td>
                <td>
                    <?php echo $gnc_surgery_year; ?>: <br />
                    <?php echo form_input('gnc_surgery_year'); ?>
                </td>
                <td>
                    <?php echo $gnc_treatment_name; ?>: <br />
                    <?php echo form_dropdown('gnc_treatment_name', $gnc_treatment_lists); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $gnc_treatment_name_other_details; ?>: <br />
                    <?php echo form_input('gnc_treatment_name_other_details'); ?>
                </td>
                <td>
                    &nbsp;
                </td>
                <td>
                    &nbsp;
                </td>
            </tr>
        </table>
        <?php echo form_fieldset_close(); ?>	
    </div>
    <?php echo form_submit('mysubmit', 'Save'); ?>
    <?php echo form_close(); ?>
</div>




