<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>View Lifestyle Factors Details</p>
    </div>
    <?php
    $attributes = array('id' => 'lifestyle-details-form');
    echo form_open("record/lifestyle_update", $attributes);
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
                    <?php echo form_input(array('name' => 'questionnaire_date', 'value' => @$list['questionnaire_date'] == '' ? ''  : date('d-m-Y', strtotime(@$list['questionnaire_date'])), 'class' => 'datepicker'))?>
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
                    <?php echo form_dropdown('self_image_at_7years', $self_image_lists, @$list['self_image_at_7years'], 'id="self_image_lists" preload_val="'.@$list['self_image_at_7years'].'"'); ?>
                </td>
                <td>
                    <?php echo $self_image_at_18years; ?>: 
                    <?php echo form_dropdown('self_image_at_18years', $self_image_lists, @$list['self_image_at_18years'], 'id="self_image_lists" preload_val="'.@$list['self_image_at_18years'].'"'); ?>
                </td>
                <td>
                    <?php echo $self_image_now; ?>: 
                    <?php echo form_dropdown('self_image_now', $self_image_lists, @$list['self_image_now'], 'id="self_image_lists" preload_val="'.@$list['self_image_now'].'"'); ?>
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
                    <?php echo form_dropdown('pa_strenuous_exercise_childhood', $pa_activities_lists, $strenuous[$list['pa_strenuous_activity_childhood']], 'id="pa_activities_lists" preload_val="'.$strenuous[$list['pa_strenuous_activity_childhood']].'"'); ?>
                </td>
                <td>
                    Moderate Exercise: 
                    <?php echo form_dropdown('pa_moderate_exercise_childhood', $pa_activities_lists, $moderate[$list['pa_moderate_exercise_childhood']], 'id="pa_activities_lists" preload_val="'.$moderate[$list['pa_moderate_exercise_childhood']].'"'); ?>
                </td>
                <td>
                    Gentle Exercise: 
                    <?php echo form_dropdown('pa_gentle_exercise_childhood', $pa_activities_lists, $gentle[$list['pa_gentle_exercise_childhood']], 'id="pa_activities_lists" preload_val="'.$gentle[$list['pa_gentle_exercise_childhood']].'"'); ?>
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
                    <?php echo form_dropdown('pa_strenuous_exercise_adult', $pa_activities_lists, $strenuous[$list['pa_strenuous_activity_adult']], 'id="pa_activities_lists" preload_val="'.$strenuous[$list['pa_strenuous_activity_adult']].'"'); ?>
                </td>
                <td>
                    Moderate Exercise: 
                    <?php echo form_dropdown('pa_moderate_exercise_adult', $pa_activities_lists, $moderate[$list['pa_moderate_exercise_adult']], 'id="pa_activities_lists" preload_val="'.$moderate[$list['pa_moderate_exercise_adult']].'"'); ?>
                </td>
                <td>
                    Gentle Exercise: 
                    <?php echo form_dropdown('pa_gentle_exercise_adult', $pa_activities_lists, $gentle[$list['pa_gentle_exercise_adult']], 'id="pa_activities_lists" preload_val="'.$gentle[$list['pa_gentle_exercise_adult']].'"'); ?>
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
                    <?php echo form_dropdown('pa_strenuous_exercise_now', $pa_activities_lists, $strenuous[$list['pa_strenuous_activity_now']], 'id="pa_activities_lists" preload_val="'.$strenuous[$list['pa_strenuous_activity_now']].'"'); ?>
                </td>
                <td>
                    Moderate Exercise: 
                    <?php echo form_dropdown('pa_moderate_exercise_now', $pa_activities_lists, $moderate[$list['pa_moderate_exercise_now']], 'id="pa_activities_lists" preload_val="'.$moderate[$list['pa_moderate_exercise_now']].'"'); ?>
                </td>
                <td>
                    Gentle Exercise: 
                    <?php echo form_dropdown('pa_gentle_exercise_now', $pa_activities_lists, $gentle[$list['pa_gentle_exercise_now']], 'id="pa_activities_lists" preload_val="'.$gentle[$list['pa_gentle_exercise_now']].'"'); ?>
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
                <?php if($list['cigarrets_smoked_flag'] == 1){?>
                <td>
                    <?php echo $cigarettes_smoked_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'cigarettes_smoked_flag', 'value' => @$list['cigarrets_smoked_flag'],'checked'=>"checked"))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $cigarettes_smoked_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'cigarettes_smoked_flag', 'value' => @$list['cigarrets_smoked_flag']))?>
                </td>
               <?php } ?>
                
                <?php if($list['cigarrets_still_smoked_flag'] == 1){?>
                <td>
                    <?php echo $cigarettes_still_smoked_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'cigarettes_still_smoked_flag', 'value' => @$list['cigarrets_still_smoked_flag'],'checked'=>"checked"))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $cigarettes_still_smoked_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'cigarettes_still_smoked_flag', 'value' => @$list['cigarrets_still_smoked_flag']))?>
                </td>
               <?php } ?>
                <td>
                    <?php echo $total_smoked_years; ?>: 
                    <?php echo form_input(array('name' => 'total_smoked_years', 'value' => @$list['total_smoked_years']))?>
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
                    <?php echo form_dropdown('cigarettes_count_at_teen', $cigarettes_average_count_lists, @$list['cigarrets_count_at_teen'], 'id="cigarettes_average_count_lists" preload_val="'.$list['cigarrets_count_at_teen'].'"'); ?>
                </td>
                <td>
                    <?php echo $cigarettes_count_at_twenties; ?>:  <br />
                    <?php echo form_dropdown('cigarettes_count_at_twenties', $cigarettes_average_count_lists, @$list['cigarrets_count_at_twenties'], 'id="cigarettes_average_count_lists" preload_val="'.$list['cigarrets_count_at_twenties'].'"'); ?>
                </td>
                <td>
                    <?php echo $cigarettes_count_at_thirties; ?>:  <br />
                    <?php echo form_dropdown('cigarettes_count_at_thirties', $cigarettes_average_count_lists, @$list['cigarrets_count_at_thirties'], 'id="cigarettes_average_count_lists" preload_val="'.$list['cigarrets_count_at_thirties'].'"'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $cigarettes_count_at_forties; ?>: <br />
                    <?php echo form_dropdown('cigarettes_count_at_forties', $cigarettes_average_count_lists, @$list['cigarrets_count_at_fourrties'], 'id="cigarettes_average_count_lists" preload_val="'.$list['cigarrets_count_at_fourrties'].'"'); ?>
                </td>
                <td>
                    <?php echo $cigarettes_count_at_fifties; ?>:  <br />
                    <?php echo form_dropdown('cigarettes_count_at_fifties', $cigarettes_average_count_lists, @$list['cigarrets_count_at_fifties'], 'id="cigarettes_average_count_lists" preload_val="'.$list['cigarrets_count_at_fifties'].'"'); ?>
                </td>
                <td>
                    <?php echo $cigarettes_count_at_sixties_and_above; ?>:  <br />
                    <?php echo form_dropdown('cigarettes_count_at_sixties_and_above', $cigarettes_average_count_lists, @$list['cigarrets_count_at_sixties_and_above'], 'id="cigarettes_average_count_lists" preload_val="'.$list['cigarrets_count_at_sixties_and_above'].'"'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $cigarettes_count_one_year_before_diagnosed; ?>:  <br />
                    <?php echo form_dropdown('cigarettes_count_one_year_before_diagnosed', $cigarettes_average_count_lists, @$list['cigarrets_count_one_year_before_diagnosed'], 'id="cigarettes_average_count_lists" preload_val="'.$list['cigarrets_count_one_year_before_diagnosed'].'"'); ?>
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
                <?php if($list['alcohol_drunk_flag'] == 1){?>
                <td>
                    <?php echo $alcohol_drunk_flag; ?>:
                    <?php echo form_checkbox(array('name' => 'alcohol_drunk_flag', 'value' => @$list['alcohol_drunk_flag'],'checked'=>"checked"))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $alcohol_drunk_flag; ?>:
                    <?php echo form_checkbox(array('name' => 'alcohol_drunk_flag', 'value' => @$list['alcohol_drunk_flag']))?>
                </td>
               <?php } ?>
                <td>
                    <?php echo $alcohol_average; ?>:  <br />
                    <?php echo form_dropdown('alcohol_average', $alcohol_drink_average_lists, @$list['alcohol_frequency'], 'id="alcohol_drink_average_lists" preload_val="'.$list['alcohol_frequency'].'"'); ?>
                </td>
                <td>
                    <?php echo $alcohol_average_details; ?>:  <br />
                    <?php echo form_input(array('name' => 'alcohol_average_details', 'value' => @$list['alcohol_comments']))?>
                </td>
            </tr>
            <tr>
                <td id="label1">Coffee</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <?php if($list['coffee_drunk_flag'] == 1){?>
                <td>
                    <?php echo $coffee_drunk_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'coffee_drunk_flag', 'value' => @$list['coffee_drunk_flag'],'checked'=>"checked"))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $coffee_drunk_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'coffee_drunk_flag', 'value' => @$list['coffee_drunk_flag']))?>
                </td>
               <?php } ?>
                <td>
                    <?php echo $coffee_age; ?>: <br />
                    <?php echo form_input(array('name' => 'coffee_age', 'value' => @$list['coffee_age']))?>
                </td>
                <td>
                    <?php echo $coffee_average; ?>: <br />
                    <?php echo form_dropdown('coffee_average', $coffee_tea_drink_average_lists, @$list['coffee_frequency'], 'id="coffee_tea_drink_average_lists" preload_val="'.$list['coffee_frequency'].'"'); ?>
                </td>
            </tr>
            <tr>
                <td id="label1">Tea</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <?php if($list['tea_drunk_flag'] == 1){?>
                <td>
                    <?php echo $tea_drunk_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'tea_drunk_flag', 'value' => @$list['tea_drunk_flag'],'checked'=>"checked"))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $tea_drunk_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'tea_drunk_flag', 'value' => @$list['tea_drunk_flag']))?>
                </td>
               <?php } ?>
                <td>
                    <?php echo $tea_age; ?>: <br />
                    <?php echo form_input(array('name' => 'tea_age', 'value' => @$list['tea_age']))?>
                </td>
                <td>
                    <?php echo $tea_average; ?>: <br />
                    <?php echo form_dropdown('tea_average', $coffee_tea_drink_average_lists, @$list['tea_frequency'], 'id="coffee_tea_drink_average_lists" preload_val="'.$list['tea_frequency'].'"'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $tea_type; ?>: <br />
                    <?php echo form_dropdown('tea_type', $tea_type_lists, @$list['tea_type'], 'id="tea_type_lists" preload_val="'.$list['tea_type'].'"'); ?>
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
                <?php if($list['soya_bean_drunk_flag'] == 1){?>
                <td>
                    <?php echo $soya_bean_drunk_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'soya_bean_drunk_flag', 'value' => @$list['soya_bean_drunk_flag'],'checked'=>"checked"))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $soya_bean_drunk_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'soya_bean_drunk_flag', 'value' => @$list['soya_bean_drunk_flag']))?>
                </td>
               <?php } ?>
                <td>
                    <?php echo $soya_bean_average; ?>: <br />
                    <?php echo form_dropdown('soya_bean_average', $coffee_tea_drink_average_lists, @$list['soya_bean_frequency'], 'id="coffee_tea_drink_average_lists" preload_val="'.$list['soya_bean_frequency'].'"'); ?>
                </td>
                <?php if($list['soya_products_flag'] == 1){?>
                <td>
                    <?php echo $soya_products_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'soya_products_flag', 'value' => @$list['soya_products_flag'],'checked'=>"checked"))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $soya_products_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'soya_products_flag', 'value' => @$list['soya_products_flag']))?>
                </td>
               <?php } ?>
            </tr>
            <tr>
                <td>
                    <?php echo $soya_products_average; ?>: <br />
                    <?php echo form_dropdown('soya_products_average', $soya_products_lists, @$list['soya_products_average'], 'id="soya_products_lists" preload_val="'.$list['soya_products_average'].'"'); ?>
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
                <?php if($list['diabetes_flag'] == 1){?>
                <td>
                    <?php echo $diabetes_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'diabetes_flag', 'value' => @$list['diabetes_flag'],'checked'=>"checked"))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $diabetes_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'diabetes_flag', 'value' => @$list['diabetes_flag']))?>
                </td>
               <?php } ?>
                <?php if($list['medicine_for_diabetes_flag'] == 1){?>
                <td>
                    <?php echo $medicine_for_diabetes_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'medicine_for_diabetes_flag', 'value' => @$list['medicine_for_diabetes_flag'],'checked'=>"checked"))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $medicine_for_diabetes_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'medicine_for_diabetes_flag', 'value' => @$list['medicine_for_diabetes_flag']))?>
                </td>
               <?php } ?>
                <td>
                    <?php echo $diabates_medicine_name; ?>: <br />
                    <?php echo form_input(array('name' => 'diabates_medicine_name', 'value' => @$list['diabetes_medicine_name']))?>
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
            <input type="hidden" name="patient_ic_no" value="<?php print @$list['patient_ic_no']; ?>"/>
             <input type="hidden" name="patient_studies_id" value="<?php print @$list['patient_studies_id']; ?>"/>
            <input type="hidden" name="patient_lifestyle_factors_id" value="<?php print @$list['patient_lifestyle_factors_id']; ?>"/>
        </table>
        <?php echo form_fieldset_close(); ?>
        <?php endforeach; ?>
        <?php foreach ($patient_menstruation as $menstruation): ?>
        <?php
        echo form_fieldset('Hormonal Details');
        ?>
        <table>
            <tr>
                <td>
                    <?php echo $age_period_starts; ?>: <br />
                    <?php echo form_input(array('name' => 'age_period_starts', 'value' => @$menstruation['age_period_starts']))?>
                </td>
                <?php if($menstruation['still_period_flag'] == 1){?>
                    <td>
                    <?php echo $still_period_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'still_period_flag', 'value' => @$menstruation['still_period_flag'],'checked'=>"checked"))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $still_period_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'still_period_flag', 'value' => @$menstruation['still_period_flag']))?>
                </td>
               <?php } ?>
                <td>
                    <?php echo $period_type; ?>: 
                    <?php echo form_dropdown('period_type', $period_type_lists, @$menstruation['period_type'], 'id="period_type_lists" preload_val="'.$menstruation['period_type'].'"'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $period_cycle_days; ?>: <br />
                    <?php echo form_dropdown('period_cycle_days', $period_cycle_days_lists, @$menstruation['period_cycle_days'], 'id="period_cycle_days_lists" preload_val="'.$menstruation['period_cycle_days'].'"'); ?>
                </td>
                <td>
                    <?php echo $period_cycle_days_other_details; ?>: <br />
                    <?php echo form_input(array('name' => 'period_cycle_days_other_details', 'value' => @$menstruation['period_cycle_days_other_details']))?>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $age_period_stops; ?>: <br />
                    <?php echo form_input(array('name' => 'age_period_stops', 'value' => @$menstruation['age_at_menopause']))?>
                </td>
                <td>
                    <?php echo $date_period_stops; ?>: <br />
                    <?php echo form_input(array('name' => 'date_period_stops', 'value' => @$menstruation['date_period_stops'], 'class' => 'datepicker'))?>
                </td>
                <td>
                    <?php echo $reason_period_stops; ?>: <br />
                    <?php echo form_dropdown('reason_period_stops', $reason_period_stops_lists, @$menstruation['reason_period_stops'], 'id="reason_period_stops_lists" preload_val="'.$menstruation['reason_period_stops'].'"'); ?>
                </td>
                <td>
                    <?php echo $reason_period_stops_other_details; ?>: <br />
                    <?php echo form_input(array('name' => 'reason_period_stops_other_details', 'value' => @$menstruation['reason_period_stops_other_details']))?>
                </td>
            </tr>
            <input type="hidden" name="patient_menstruation_id" value="<?php print @$menstruation['patient_menstruation_id']; ?>"/>
        </table>
        <?php echo form_fieldset_close(); ?>
        <?php endforeach; ?>
        <div height="30px">&nbsp;</div>
        <?php foreach ($patient_parity_table as $patient_parity): ?>
        <?php
        echo form_fieldset('Pregnancy');
        ?>
        <div id='parity_section_div_1'>
            <table id="pregnancy_section_1">
                <tr>
<!--                    <td>
                        <?php echo $never_been_pregnant_flag; ?>: 
                        <?php echo form_checkbox(array('name' => 'never_been_pregnant_flag', 'value' => @$patient_parity['never_been_pregnant_flag']))?>
                    </td>-->
                        <?php if($patient_parity['pregnant_flag'] == 1){?>
                        <td>
                        <?php echo $pregnant_flag; ?>: 
                        <?php echo form_checkbox(array('name' => 'pregnant_flag[]', 'value' => @$patient_parity['pregnant_flag'],'checked'=>"checked"))?>
                    </td>
               <?php } else {?>
                <td>
                        <?php echo $pregnant_flag; ?>: 
                        <?php echo form_checkbox(array('name' => 'pregnant_flag[]', 'value' => @$patient_parity['pregnant_flag']))?>
                    </td>
               <?php } ?>
                </tr>
                <tr>
                <td>
                    <?php echo $pregnancy_type; ?>: <br />
                    <?php echo form_dropdown('pregnancy_type[]', $pregnancy_type_lists, @$patient_parity['pregnancy_type'], 'id="pregnancy_type" preload_val="'.@$patient_parity['pregnancy_type'].'"'); ?>
                </td>
                <td>
                    <?php echo $child_gender; ?>: <br />
                    <?php echo form_dropdown('child_gender[]', $genderTypes, @$patient_parity['gender'], 'id="gender" preload_val="'.@$patient_parity['gender'].'"'); ?>
                </td>
                <td>
                    <?php echo $child_birthdate; ?>: <br />
                    <?php echo form_input(array('name' => 'child_birthdate[]', 'value' => @$patient_parity['date_of_birth'] == '' ? ''  : date('d-m-Y', strtotime(@$patient_parity['date_of_birth'])), 'class' => 'datepicker'))?>
                </td>
                </tr>
                <tr>
                    <td>
                    <?php echo $child_age_at_consent; ?>: <br />
                    <?php echo form_input(array('name' => 'child_age_at_consent[]', 'value' => @$patient_parity['age_child_at_consent']))?>
                </td>
                <td>
                    <?php echo $child_birthweight; ?>: <br />
                    <?php echo form_input(array('name' => 'child_birthweight[]', 'value' => @$patient_parity['birthweight']))?>
                </td>
                <td>
                    <?php echo $child_breastfeeding_duration; ?>: <br />
                    <?php echo form_input(array('name' => 'child_breastfeeding_duration[]', 'value' => @$patient_parity['breastfeeding_duration']))?>
                </td>
                <td>
                    <?php echo $child_birthyear; ?>: <br />
                    <?php echo form_input(array('name' => 'child_birthyear[]', 'value' => @$patient_parity['year_of_birth']))?>
                </td>
                </tr>
                <input type="hidden" name="patient_parity_table_id[]" value="<?php echo @$patient_parity['patient_parity_id']; ?>"/>
                <input type="hidden" name="patient_parity_record_id[]" value="<?php echo @$patient_parity['patient_parity_record_id']; ?>"/>
            </table>
        </div>
        <?php echo form_fieldset_close(); ?>
        <?php endforeach; ?>
        <div height="30px">&nbsp;</div>
        <?php foreach ($patient_infertility as $infertility): ?>
        <?php
        echo form_fieldset('Infertility, HRT & GNC Surgery');
        ?>
        <table id="infertility_section_1">
            <tr>
                <td id="label1">Infertility</td>
            </tr>
            <tr>
                <?php if($infertility['infertility_testing_flag'] == 1){?>
                <td>
                    <?php echo $infertility_testing_flag; ?>:
                    <?php echo form_checkbox(array('name' => 'infertility_testing_flag', 'value' => @$infertility['infertility_testing_flag'],'checked'=>"checked"))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $infertility_testing_flag; ?>:
                    <?php echo form_checkbox(array('name' => 'infertility_testing_flag', 'value' => @$infertility['infertility_testing_flag']))?>
                </td>
               <?php } ?>
                <td>
                    <?php echo $infertility_treatment_details; ?>: <br />
                    <?php echo form_input(array('name' => 'infertility_treatment_details', 'value' => @$infertility['infertility_comments']))?>
                </td>
                <td>
                    <?php echo $infertility_treatment_duration; ?>:  <br />
                    <?php echo form_input(array('name' => 'infertility_treatment_duration', 'value' => @$infertility['infertility_treatment_duration']))?>
                </td>
                <td>
                    <?php echo $infertility_treatment_comments; ?>: <br />
                    <?php echo form_textarea(array('name' => 'infertility_treatment_comments','id' => 'infertility_treatment_comments','rows' => '3','cols' => '7', 'value' => @$infertility['infertility_comments']))?>
                </td>
                <td>&nbsp;</td>
            <tr>
                <td id="label1">Contraceptive pills</td>
            </tr>
            <tr>
                <?php if($infertility['contraceptive_pills_flag'] == 1){?>
                <td>
                    <?php echo $contraceptive_pills_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'contraceptive_pills_flag', 'value' => @$infertility['contraceptive_pills_flag'],'checked'=>"checked"))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $contraceptive_pills_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'contraceptive_pills_flag', 'value' => @$infertility['contraceptive_pills_flag']))?>
                </td>
               <?php } ?>
                <td>
                    <?php echo $contraceptive_pills_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'contraceptive_pills_flag', 'value' => @$infertility['contraceptive_pills_flag']))?>
                </td>
<!--                <td>
                    <?php echo $contraceptive_pills_details; ?>: <br />
                    <?php echo form_input(array('name' => 'contraceptive_pills_details', 'value' => @$infertility['contraceptive_pills_details']))?>
                </td>-->
                    <?php if($infertility['currently_taking_contraceptive_pills_flag'] == 1){?>
                    <td>
                    <?php echo $currently_taking_contraceptive_pills_flag; ?>: <br />
                    <?php echo form_checkbox(array('name' => 'currently_taking_contraceptive_pills_flag', 'value' => @$infertility['currently_taking_contraceptive_pills_flag'],'checked'=>"checked"))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $currently_taking_contraceptive_pills_flag; ?>: <br />
                    <?php echo form_checkbox(array('name' => 'currently_taking_contraceptive_pills_flag', 'value' => @$infertility['currently_taking_contraceptive_pills_flag']))?>
                </td>
               <?php } ?>
                <td>
                    <?php echo $contraceptive_start_date; ?>: <br />
                    <?php echo form_input(array('name' => 'contraceptive_start_date', 'value' => @$infertility['contraceptive_start_date'] == '' ? ''  : date('d-m-Y', strtotime(@$infertility['contraceptive_start_date'])), 'class' => 'datepicker'))?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $contraceptive_end_date; ?>: <br />
                    <?php echo form_input(array('name' => 'contraceptive_end_date', 'value' => @$infertility['contraceptive_end_date'] == '' ? ''  : date('d-m-Y', strtotime(@$infertility['contraceptive_end_date'])), 'class' => 'datepicker'))?>
                </td>
                <td>
                    <?php echo $contraceptive_start_age; ?>: <br />
                    <?php echo form_input(array('name' => 'contraceptive_start_age', 'value' => @$infertility['contraceptive_start_age']))?>
                </td>
                <td>
                    <?php echo $contraceptive_end_age; ?>: <br />
                    <?php echo form_input(array('name' => 'contraceptive_end_age', 'value' => @$infertility['contraceptive_end_age']))?>
                </td>
                <td>
                    <?php echo $contraceptive_duration; ?>: <br />
                    <?php echo form_input(array('name' => 'contraceptive_duration', 'value' => @$infertility['contraceptive_duration']))?>
                </td>
            </tr>
            <tr>
                <td id="label1">Hormonal Replacement Therapy</td>
            </tr>
            <tr>
                <?php if($infertility['hrt_flag'] == 1){?>
                <td>
                    <?php echo $HRT_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'HRT_flag', 'value' => @$infertility['hrt_flag'],'checked'=>"checked"))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $HRT_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'HRT_flag', 'value' => @$infertility['hrt_flag']))?>
                </td>
               <?php } ?>
                <?php if($infertility['currently_using_hrt_flag'] == 1){?>
                    <td>
                    <?php echo $currently_using_HRT_flag; ?>: <br />
                    <?php echo form_checkbox(array('name' => 'currently_using_hrt_flag', 'value' => @$infertility['currently_using_hrt_flag'],'checked'=>"checked"))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $currently_using_HRT_flag; ?>: <br />
                    <?php echo form_checkbox(array('name' => 'currently_using_hrt_flag', 'value' => @$infertility['currently_using_hrt_flag']))?>
                </td>
               <?php } ?>
                <td>
                    <?php echo $HRT_start_date; ?>: <br />
                    <?php echo form_input(array('name' => 'hrt_start_date', 'value' => @$infertility['hrt_start_date'] == '' ? ''  : date('d-m-Y', strtotime(@$infertility['hrt_start_date'])), 'class' => 'datepicker'))?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $HRT_end_date; ?>: <br />
                    <?php echo form_input(array('name' => 'hrt_end_date', 'value' =>@$infertility['hrt_end_date'] == '' ? ''  : date('d-m-Y', strtotime(@$infertility['hrt_end_date'])), 'class' => 'datepicker'))?>
                </td>
                <td>
                    <?php echo $HRT_start_age; ?>: <br />
                    <?php echo form_input(array('name' => 'hrt_start_age', 'value' => @$infertility['hrt_start_age']))?>
                </td>
                <td>
                    <?php echo $HRT_end_age; ?>: <br />
                    <?php echo form_input(array('name' => 'hrt_end_age', 'value' => @$infertility['hrt_end_age']))?>
                </td>
                <td>
                    <?php echo $HRT_duration; ?>: <br />
                    <?php echo form_input(array('name' => 'HRT_duration', 'value' => @$infertility['hrt_duration']))?>
                </td>
                                <td>
                    <?php echo $HRT_details; ?>: <br />
                    <?php echo form_input(array('name' => 'hrt_details', 'value' => @$infertility['htr_details']))?>
                </td>
            </tr>
            <input type="hidden" name="patient_infertility_id" value="<?php print @$infertility['patient_infertility_id']; ?>"/>
            <?php endforeach; ?>
            <?php foreach ($patient_gynaecological as $gynaecological): ?>
            <tr>
                <?php if($gynaecological['had_gnc_surgery_flag'] == 1){?>
                <td>
                    <?php echo $had_gnc_surgery_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'had_gnc_surgery_flag', 'value' => @$gynaecological['had_gnc_surgery_flag'],'checked'=>"checked"))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $had_gnc_surgery_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'had_gnc_surgery_flag', 'value' => @$gynaecological['had_gnc_surgery_flag']))?>
                </td>
               <?php } ?>
                <td>
                    <?php echo $gnc_surgery_year; ?>: <br />
                    <?php echo form_input(array('name' => 'gnc_surgery_year', 'value' => @$gynaecological['surgery_year']))?>
                </td>
                <td>
                    <?php echo $gnc_treatment_name; ?>: <br />
                    <?php echo form_dropdown('gnc_treatment_name', $gnc_treatment_lists, @$gynaecological['treatment_id'], 'id="gnc_treatment_lists" preload_val="'.$gynaecological['treatment_id'].'"'); ?>
                </td>
                <td>
                    <?php echo $gnc_treatment_name_other_details; ?>: <br />
                    <?php echo form_input(array('name' => 'gnc_treatment_name_other_details', 'value' => @$gynaecological['gnc_treatment_name_other_details']))?>
                </td>
            </tr>
            <input type="hidden" name="patient_gynaecological_surgery_history_id" value="<?php print @$gynaecological['patient_gynaecological_surgery_history_id']; ?>"/>
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




