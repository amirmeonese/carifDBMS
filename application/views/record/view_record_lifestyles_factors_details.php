<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>Add Lifestyle Factors Details</p>
    </div>
    <?php
    $attributes = array('id' => 'lifestyle-details-form');
    echo form_open("record/lifestyle_insertion", $attributes);
    ?>
    <div class="container" id="add_record_form_section_lifestyle">      
        <div height="30px">&nbsp;</div>
        <?php foreach ($patient_lifestyle_factors as $list): ?>
        <?php
        echo form_fieldset('Lifestyle Details');
        ?>
        <table>
            <tr>
                <td>
                    <?php echo $questionnaire_date; ?>: 
                    <?php echo form_input(array('name' => 'questionnaire_date', 'value' => $list['questionnaire_date'], 'class' => 'datepicker'))?>
                </td>
            </tr>
            <tr>
                <td id="label1">Patient Self Image</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3"><img src="<?php echo base_url(); ?>img/dropdown/patient_self_image.png"></td>
            </tr>
            <tr>
                <td>
                    <?php echo $self_image_at_7years; ?>: 
                    <?php echo form_dropdown('self_image_at_7years', $self_image_lists, $list['self_image_at_7years']); ?>
                </td>
                <td>
                    <?php echo $self_image_at_18years; ?>: 
                    <?php echo form_dropdown('self_image_at_18years', $self_image_lists, $list['self_image_at_18years']); ?>
                </td>
                <td>
                    <?php echo $self_image_now; ?>: 
                    <?php echo form_dropdown('self_image_now', $self_image_lists, $list['self_image_now']); ?>
                </td>
            </tr>
        </table>
        <div height="30px">&nbsp;</div>
        <table>
            <tr>
                <td id="label1">Patient Physical Activities</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td id="label1">Childhood (before 18-years of age</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    Strenuous Exercise: 
                    <?php echo form_dropdown('pa_at_childhood', $pa_activities_lists, $list['pa_sports_activitiy_childhood']); ?>
                </td>
                <td>
                    Moderate Exercise: 
                    <?php echo form_dropdown('pa_at_adulthood', $pa_activities_lists, $list['pa_sports_activitiy_adult']); ?>
                </td>
                <td>
                    Gentle Exercise: 
                    <?php echo form_dropdown('pa_now', $pa_activities_lists, $list['pa_sports_activitiy_now']); ?>
                </td>
            </tr>
            <tr>
                <td id="label1">18-30 years old</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    Strenuous Exercise: 
                    <?php echo form_dropdown('pa_at_childhood', $pa_activities_lists, $list['mother_cancer_name']); ?>
                </td>
                <td>
                    Moderate Exercise: 
                    <?php echo form_dropdown('pa_at_adulthood', $pa_activities_lists, $list['mother_cancer_name']); ?>
                </td>
                <td>
                    Gentle Exercise: 
                    <?php echo form_dropdown('pa_now', $pa_activities_lists, $list['mother_cancer_name']); ?>
                </td>
            </tr>
            <tr>
                <td id="label1">The most recent years</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    Strenuous Exercise: 
                    <?php echo form_dropdown('pa_at_childhood', $pa_activities_lists, $list['mother_cancer_name']); ?>
                </td>
                <td>
                    Moderate Exercise: 
                    <?php echo form_dropdown('pa_at_adulthood', $pa_activities_lists, $list['mother_cancer_name']); ?>
                </td>
                <td>
                    Gentle Exercise: 
                    <?php echo form_dropdown('pa_now', $pa_activities_lists, $list['mother_cancer_name']); ?>
                </td>
            </tr>
        </table>
        <div height="30px">&nbsp;</div>
        <table>
            <tr>
                <td id="label1">Smoking</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $cigarettes_smoked_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'cigarettes_smoked_flag', 'value' => $list['cigarettes_smoked_flag']))?>
                </td>
                <td>
                    <?php echo $cigarettes_still_smoked_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'cigarettes_still_smoked_flag', 'value' => $list['cigarettes_still_smoked_flag']))?>
                </td>
                <td>
                    <?php echo $total_smoked_years; ?>: 
\                    <?php echo form_input(array('name' => 'total_smoked_years', 'value' => $list['total_smoked_years']))?>
                </td>
            </tr>
            <tr>
                <td id="label1">Average cigarettes smoked</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $cigarettes_count_at_teen; ?>: <br />
                    <?php echo form_dropdown('cigarettes_count_at_teen', $cigarettes_average_count_lists, $list['mother_cancer_name']); ?>
                </td>
                <td>
                    <?php echo $cigarettes_count_at_twenties; ?>:  <br />
                    <?php echo form_dropdown('cigarettes_count_at_twenties', $cigarettes_average_count_lists, $list['mother_cancer_name']); ?>
                </td>
                <td>
                    <?php echo $cigarettes_count_at_thirties; ?>:  <br />
                    <?php echo form_dropdown('cigarettes_count_at_thirties', $cigarettes_average_count_lists, $list['mother_cancer_name']); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $cigarettes_count_at_forties; ?>: <br />
                    <?php echo form_dropdown('cigarettes_count_at_forties', $cigarettes_average_count_lists, $list['mother_cancer_name']); ?>
                </td>
                <td>
                    <?php echo $cigarettes_count_at_fifties; ?>:  <br />
                    <?php echo form_dropdown('cigarettes_count_at_fifties', $cigarettes_average_count_lists, $list['mother_cancer_name']); ?>
                </td>
                <td>
                    <?php echo $cigarettes_count_at_sixties_and_above; ?>:  <br />
                    <?php echo form_dropdown('cigarettes_count_at_sixties_and_above', $cigarettes_average_count_lists, $list['mother_cancer_name']); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $cigarettes_count_one_year_before_diagnosed; ?>:  <br />
                    <?php echo form_dropdown('cigarettes_count_one_year_before_diagnosed', $cigarettes_average_count_lists, $list['mother_cancer_name']); ?>
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
                    <?php echo $alcohol_drunk_flag; ?>:
                    <?php echo form_checkbox(array('name' => 'alcohol_drunk_flag', 'value' => $list['alcohol_drunk_flag']))?>
                </td>
                <td>
                    <?php echo $alcohol_average; ?>:  <br />
                    <?php echo form_dropdown('alcohol_average', $alcohol_drink_average_lists, $list['mother_cancer_name']); ?>
                </td>
                <td>
                    <?php echo $alcohol_average_details; ?>:  <br />
                    <?php echo form_input(array('name' => 'alcohol_average_details', 'value' => $list['alcohol_average_details']))?>
                </td>
            </tr>
            <tr>
                <td id="label1">Coffee</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $coffee_drunk_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'coffee_drunk_flag', 'value' => $list['coffee_drunk_flag']))?>
                </td>
                <td>
                    <?php echo $coffee_age; ?>: <br />
                    <?php echo form_input(array('name' => 'coffee_age', 'value' => $list['coffee_age']))?>
                </td>
                <td>
                    <?php echo $coffee_average; ?>: <br />
                    <?php echo form_dropdown('coffee_average', $coffee_tea_drink_average_lists, $list['mother_cancer_name']); ?>
                </td>
            </tr>
            <tr>
                <td id="label1">Tea</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $tea_drunk_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'tea_drunk_flag', 'value' => $list['tea_drunk_flag']))?>
                </td>
                <td>
                    <?php echo $tea_age; ?>: <br />
                    <?php echo form_input(array('name' => 'tea_age', 'value' => $list['tea_age']))?>
                </td>
                <td>
                    <?php echo $tea_average; ?>: <br />
                    <?php echo form_dropdown('tea_average', $coffee_tea_drink_average_lists, $list['mother_cancer_name']); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $tea_type; ?>: <br />
                    <?php echo form_dropdown('tea_type', $tea_type_lists, $list['mother_cancer_name']); ?>
                </td>
                <td>
                    <?php echo $tea_type_other; ?>: <br />
                    <?php echo form_input(array('name' => 'tea_type_other', 'value' => $list['tea_type_other']))?>
                </td>
                <td>
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td id="label1">Soy Products</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $soya_bean_drunk_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'soya_bean_drunk_flag', 'value' => $list['soya_bean_drunk_flag']))?>
                </td>
                <td>
                    <?php echo $soya_bean_average; ?>: <br />
                    <?php echo form_dropdown('soya_bean_average', $coffee_tea_drink_average_lists, $list['mother_cancer_name']); ?>
                </td>
                <td>
                    <?php echo $soya_products_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'soya_products_flag', 'value' => $list['soya_products_flag']))?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $soya_products_average; ?>: <br />
                    <?php echo form_dropdown('soya_products_average', $soya_products_lists, $list['mother_cancer_name']); ?>
                </td>
                <td>
                    <?php echo $soya_products_average_other; ?>: <br />
                    <?php echo form_input('soya_products_average_other'); ?>
                    <?php echo form_input(array('name' => 'soya_products_average_other', 'value' => $list['soya_products_average_other']))?>
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
                    <?php echo $diabetes_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'diabetes_flag', 'value' => $list['diabetes_flag']))?>
                </td>
                <td>
                    <?php echo $medicine_for_diabetes_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'medicine_for_diabetes_flag', 'value' => $list['medicine_for_diabetes_flag']))?>
                </td>
                <td>
                    <?php echo $diabates_medicine_name; ?>: <br />
                    <?php echo form_input(array('name' => 'diabates_medicine_name', 'value' => $list['diabates_medicine_name']))?>
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
        echo form_fieldset('Hormonal Details');
        ?>
        <table>
            <tr>
                <td>
                    <?php echo $age_period_starts; ?>: <br />
                    <?php echo form_input(array('name' => 'age_period_starts', 'value' => $list['age_period_starts']))?>
                </td>
                <td>
                    <?php echo $still_period_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'still_period_flag', 'value' => $list['still_period_flag']))?>
                </td>
                <td>
                    <?php echo $period_type; ?>: 
                    <?php echo form_dropdown('period_type', $period_type_lists, $list['mother_cancer_name']); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $period_cycle_days; ?>: <br />
                    <?php echo form_dropdown('period_cycle_days', $period_cycle_days_lists, $list['mother_cancer_name']); ?>
                </td>
                <td>
                    <?php echo $period_cycle_days_other_details; ?>: <br />
                    <?php echo form_input(array('name' => 'period_cycle_days_other_details', 'value' => $list['period_cycle_days_other_details']))?>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $age_period_stops; ?>: <br />
                    <?php echo form_input(array('name' => 'age_period_stops', 'value' => $list['age_period_stops']))?>
                </td>
                <td>
                    <?php echo $date_period_stops; ?>: <br />
                    <?php echo form_input(array('name' => 'date_period_stops', 'value' => $list['date_period_stops'], 'class' => 'datepicker'))?>
                </td>
                <td>
                    <?php echo $reason_period_stops; ?>: <br />
                    <?php echo form_dropdown('reason_period_stops', $reason_period_stops_lists, $list['mother_cancer_name']); ?>
                </td>
                <td>
                    <?php echo $reason_period_stops_other_details; ?>: <br />
                    <?php echo form_input(array('name' => 'reason_period_stops_other_details', 'value' => $list['reason_period_stops_other_details']))?>
                </td>
            </tr>
        </table>
        <?php echo form_fieldset_close(); ?>	
        <div height="30px">&nbsp;</div>
        <?php
        echo form_fieldset('Pregnancy');
        ?>
        <div id='parity_section_div_1'>
            <table id="pregnancy_section_1">
                <tr>
                    <td>
                        <?php echo $never_been_pregnant_flag; ?>: 
                        <?php echo form_checkbox(array('name' => 'never_been_pregnant_flag', 'value' => $list['never_been_pregnant_flag']))?>
                    </td>
                    <td>
                        <?php echo $pregnant_flag; ?>: 
                        <?php echo form_checkbox(array('name' => 'pregnant_flag', 'value' => $list['pregnant_flag']))?>
                    </td>
                    <td>
                        <input type="button" value="Add parity" onClick="window.parent.addPregnancyInput('parity_section_div_1');
                            window.parent.calcHeight();">
                    </td>
                </tr>
            </table>
        </div>
        <?php echo form_fieldset_close(); ?>	
        <div height="30px">&nbsp;</div>
        <?php
        echo form_fieldset('Infertility, HRT & GNC Surgery');
        ?>
        <table id="infertility_section_1">
            <tr>
                <td id="label1">Infertility</td>
            </tr>
            <tr>

                <td>
                    <?php echo $infertility_testing_flag; ?>:
                    <?php echo form_checkbox(array('name' => 'infertility_testing_flag', 'value' => $list['infertility_testing_flag']))?>
                </td>
                <td>
                    <?php echo $infertility_treatment_details; ?>: <br />
                    <?php echo form_input(array('name' => 'infertility_treatment_details', 'value' => $list['infertility_treatment_details']))?>
                </td>
                <td>
                    <?php echo $infertility_treatment_duration; ?>:  <br />
                    <?php echo form_input(array('name' => 'infertility_treatment_duration', 'value' => $list['infertility_treatment_duration']))?>
                </td>
                <td>
                    <?php echo $infertility_treatment_comments; ?>: <br />
                    <?php
                    $data = array(
                        'name' => 'infertility_treatment_comments',
                        'id' => 'infertility_treatment_comments',
                        'rows' => '3',
                        'cols' => '7'
                    );
                    echo form_textarea($data);
                    ?>
                </td>
                <td>&nbsp;</td>
            <tr>
                <td id="label1">Contraceptive pills</td>
            </tr>
            <tr>
                <td>
                    <?php echo $contraceptive_pills_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'contraceptive_pills_flag', 'value' => $list['contraceptive_pills_flag']))?>
                </td>
                <td>
                    <?php echo $contraceptive_pills_details; ?>: <br />
                    <?php echo form_input(array('name' => 'contraceptive_pills_details', 'value' => $list['contraceptive_pills_details']))?>
                </td>
                <td>
                    <?php echo $currently_taking_contraceptive_pills_flag; ?>: <br />
                    <?php echo form_checkbox(array('name' => 'currently_taking_contraceptive_pills_flag', 'value' => $list['currently_taking_contraceptive_pills_flag']))?>
                </td>
                <td>
                    <?php echo $contraceptive_start_date; ?>: <br />
                    <?php echo form_input(array('name' => 'contraceptive_start_date', 'value' => $list['contraceptive_start_date'], 'class' => 'datepicker'))?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $contraceptive_end_date; ?>: <br />
                    <?php echo form_input(array('name' => 'contraceptive_end_date', 'value' => $list['contraceptive_end_date'], 'class' => 'datepicker'))?>
                </td>
                <td>
                    <?php echo $contraceptive_start_age; ?>: <br />
                    <?php echo form_input(array('name' => 'contraceptive_start_age', 'value' => $list['contraceptive_start_age']))?>
                </td>
                <td>
                    <?php echo $contraceptive_end_age; ?>: <br />
                    <?php echo form_input(array('name' => 'contraceptive_end_age', 'value' => $list['contraceptive_end_age']))?>
                </td>
                <td>
                    <?php echo $contraceptive_duration; ?>: <br />
                    <?php echo form_input(array('name' => 'contraceptive_duration', 'value' => $list['contraceptive_duration']))?>
                </td>
            </tr>
            <tr>
                <td id="label1">Hormonal Replacement Therapy</td>
            </tr>
            <tr>
                <td>
                    <?php echo $HRT_flag; ?>: 
                    <?php echo form_checkbox('HRT_flag', '1', FALSE); ?>
                    <?php echo form_checkbox(array('name' => 'HRT_flag', 'value' => $list['HRT_flag']))?>
                </td>
                <td>
                    <?php echo $HRT_details; ?>: <br />
                    <?php echo form_input(array('name' => 'HRT_details', 'value' => $list['HRT_details']))?>
                </td>
                <td>
                    <?php echo $currently_using_HRT_flag; ?>: <br />
                    <?php echo form_checkbox(array('name' => 'currently_using_hrt_flag', 'value' => $list['currently_using_hrt_flag']))?>
                </td>
                <td>
                    <?php echo $HRT_start_date; ?>: <br />
                    <?php echo form_input(array('name' => 'hrt_start_date', 'value' => $list['hrt_start_date'], 'class' => 'datepicker'))?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $HRT_end_date; ?>: <br />
                    <?php echo form_input(array('name' => 'hrt_end_date', 'value' => $list['hrt_end_date'], 'class' => 'datepicker'))?>
                </td>
                <td>
                    <?php echo $HRT_start_age; ?>: <br />
                    <?php echo form_input(array('name' => 'hrt_start_age', 'value' => $list['hrt_start_age']))?>
                </td>
                <td>
                    <?php echo $HRT_end_age; ?>: <br />
                    <?php echo form_input(array('name' => 'hrt_end_age', 'value' => $list['hrt_end_age']))?>
                </td>
                <td>
                    <?php echo $HRT_duration; ?>: <br />
                    <?php echo form_input(array('name' => 'HRT_duration', 'value' => $list['HRT_duration']))?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $had_gnc_surgery_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'had_gnc_surgery_flag', 'value' => $list['had_gnc_surgery_flag']))?>
                </td>
                <td>
                    <?php echo $gnc_surgery_year; ?>: <br />
                    <?php echo form_input(array('name' => 'gnc_surgery_year', 'value' => $list['gnc_surgery_year']))?>
                </td>
                <td>
                    <?php echo $gnc_treatment_name; ?>: <br />
                    <?php echo form_dropdown('gnc_treatment_name', $gnc_treatment_lists, $list['mother_cancer_name']); ?>
                </td>
                <td>
                    <?php echo $gnc_treatment_name_other_details; ?>: <br />
                    <?php echo form_input(array('name' => 'gnc_treatment_name_other_details', 'value' => $list['gnc_treatment_name_other_details']))?>
                </td>
            </tr>
        </table>
        <?php echo form_fieldset_close(); ?>
        <?php endforeach; ?>
    </div>
    <?php echo form_submit('mysubmit', 'Save'); ?>
    <?php echo form_close(); ?>
</div>




