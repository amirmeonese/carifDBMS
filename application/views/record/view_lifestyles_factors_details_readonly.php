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
        <?php
        echo form_fieldset('Lifestyle Details');
        ?>
        <table>
            <tr>
                <td>
                    <?php echo $questionnaire_date; ?>: 
                    <?php echo form_input(array('name' => 'questionnaire_date', 'value' => @$patient_lifestyle_factors['questionnaire_date'], 'class' => 'datepicker','readonly'=>'true'))?>
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
                    <?php echo form_dropdown('self_image_at_7years', $self_image_lists, @$patient_lifestyle_factors['self_image_at_7years'], 'id="self_image_lists" preload_val="'.@$patient_lifestyle_factors['self_image_at_7years'].'"'); ?>
                </td>
                <td>
                    <?php echo $self_image_at_18years; ?>: 
                    <?php echo form_dropdown('self_image_at_18years', $self_image_lists, @$patient_lifestyle_factors['self_image_at_18years'], 'id="self_image_lists" preload_val="'.@$patient_lifestyle_factors['self_image_at_18years'].'"'); ?>
                </td>
                <td>
                    <?php echo $self_image_now; ?>: 
                    <?php echo form_dropdown('self_image_now', $self_image_lists, @$patient_lifestyle_factors['self_image_now'], 'id="self_image_lists" preload_val="'.@$patient_lifestyle_factors['self_image_now'].'"'); ?>
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
                    <?php echo form_dropdown('pa_strenuous_exercise_childhood', $pa_activities_lists, @$patient_lifestyle_factors['pa_strenuous_exercise_childhood'], 'id="pa_activities_lists" preload_val="'.@$patient_lifestyle_factors['pa_strenuous_exercise_childhood'].'"'); ?>
                </td>
                <td>
                    Moderate Exercise: 
                    <?php echo form_dropdown('pa_moderate_exercise_childhood', $pa_activities_lists, @$patient_lifestyle_factors['pa_moderate_exercise_childhood'], 'id="pa_activities_lists" preload_val="'.@$patient_lifestyle_factors['pa_moderate_exercise_childhood'].'"'); ?>
                </td>
                <td>
                    Gentle Exercise: 
                    <?php echo form_dropdown('pa_gentle_exercise_childhood', $pa_activities_lists, @$patient_lifestyle_factors['pa_gentle_exercise_childhood'], 'id="pa_activities_lists" preload_val="'.@$patient_lifestyle_factors['pa_gentle_exercise_childhood'].'"'); ?>
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
                    <?php echo form_dropdown('pa_strenuous_exercise_adult', $pa_activities_lists, @$patient_lifestyle_factors['pa_strenuous_exercise_adult'], 'id="pa_activities_lists" preload_val="'.@$patient_lifestyle_factors['pa_strenuous_exercise_adult'].'"'); ?>
                </td>
                <td>
                    Moderate Exercise: 
                    <?php echo form_dropdown('pa_moderate_exercise_adult', $pa_activities_lists, @$patient_lifestyle_factors['pa_moderate_exercise_adult'], 'id="pa_activities_lists" preload_val="'.@$patient_lifestyle_factors['pa_moderate_exercise_adult'].'"'); ?>
                </td>
                <td>
                    Gentle Exercise: 
                    <?php echo form_dropdown('pa_gentle_exercise_adult', $pa_activities_lists, @$patient_lifestyle_factors['pa_gentle_exercise_adult'], 'id="pa_activities_lists" preload_val="'.@$patient_lifestyle_factors['pa_gentle_exercise_adult'].'"'); ?>
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
                    <?php echo form_dropdown('pa_strenuous_exercise_now', $pa_activities_lists, @$patient_lifestyle_factors['pa_strenuous_exercise_now'], 'id="pa_activities_lists" preload_val="'.@$patient_lifestyle_factors['pa_strenuous_exercise_now'].'"'); ?>
                </td>
                <td>
                    Moderate Exercise: 
                    <?php echo form_dropdown('pa_moderate_exercise_now', $pa_activities_lists, @$patient_lifestyle_factors['pa_moderate_exercise_now'], 'id="pa_activities_lists" preload_val="'.@$patient_lifestyle_factors['pa_moderate_exercise_now'].'"'); ?>
                </td>
                <td>
                    Gentle Exercise: 
                    <?php echo form_dropdown('pa_gentle_exercise_now', $pa_activities_lists, @$patient_lifestyle_factors['pa_gentle_exercise_now'], 'id="pa_activities_lists" preload_val="'.@$patient_lifestyle_factors['pa_gentle_exercise_now'].'"'); ?>
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
                <?php if($patient_lifestyle_factors['cigarrets_smoked_flag'] == 1){?>
                <td>
                    <?php echo $cigarettes_smoked_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'cigarettes_smoked_flag', 'value' => @$patient_lifestyle_factors['cigarrets_smoked_flag'],'checked'=>"checked",'readonly'=>'true'))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $cigarettes_smoked_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'cigarettes_smoked_flag', 'value' => @$patient_lifestyle_factors['cigarrets_smoked_flag'],'readonly'=>'true'))?>
                </td>
               <?php } ?>
                
                <?php if($patient_lifestyle_factors['cigarrets_still_smoked_flag'] == 1){?>
                <td>
                    <?php echo $cigarettes_still_smoked_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'cigarettes_still_smoked_flag', 'value' => @$patient_lifestyle_factors['cigarrets_still_smoked_flag'],'checked'=>"checked",'readonly'=>'true'))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $cigarettes_still_smoked_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'cigarettes_still_smoked_flag', 'value' => @$patient_lifestyle_factors['cigarrets_still_smoked_flag'],'readonly'=>'true'))?>
                </td>
               <?php } ?>
                <td>
                    <?php echo $total_smoked_years; ?>: 
                    <?php echo form_input(array('name' => 'total_smoked_years', 'value' => @$patient_lifestyle_factors['total_smoked_years'],'readonly'=>'true'))?>
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
                    <?php echo form_dropdown('cigarettes_count_at_teen', $cigarettes_average_count_lists, @$patient_lifestyle_factors['cigarrets_count_at_teen'], 'id="cigarettes_average_count_lists" preload_val="'.$patient_lifestyle_factors['cigarrets_count_at_teen'].'"'); ?>
                </td>
                <td>
                    <?php echo $cigarettes_count_at_twenties; ?>:  <br />
                    <?php echo form_dropdown('cigarettes_count_at_twenties', $cigarettes_average_count_lists, @$patient_lifestyle_factors['cigarrets_count_at_twenties'], 'id="cigarettes_average_count_lists" preload_val="'.$patient_lifestyle_factors['cigarrets_count_at_twenties'].'"'); ?>
                </td>
                <td>
                    <?php echo $cigarettes_count_at_thirties; ?>:  <br />
                    <?php echo form_dropdown('cigarettes_count_at_thirties', $cigarettes_average_count_lists, @$patient_lifestyle_factors['cigarrets_count_at_thirties'], 'id="cigarettes_average_count_lists" preload_val="'.$patient_lifestyle_factors['cigarrets_count_at_thirties'].'"'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $cigarettes_count_at_forties; ?>: <br />
                    <?php echo form_dropdown('cigarettes_count_at_forties', $cigarettes_average_count_lists, @$patient_lifestyle_factors['cigarrets_count_at_fourrties'], 'id="cigarettes_average_count_lists" preload_val="'.$patient_lifestyle_factors['cigarrets_count_at_fourrties'].'"'); ?>
                </td>
                <td>
                    <?php echo $cigarettes_count_at_fifties; ?>:  <br />
                    <?php echo form_dropdown('cigarettes_count_at_fifties', $cigarettes_average_count_lists, @$patient_lifestyle_factors['cigarrets_count_at_fifties'], 'id="cigarettes_average_count_lists" preload_val="'.$patient_lifestyle_factors['cigarrets_count_at_fifties'].'"'); ?>
                </td>
                <td>
                    <?php echo $cigarettes_count_at_sixties_and_above; ?>:  <br />
                    <?php echo form_dropdown('cigarettes_count_at_sixties_and_above', $cigarettes_average_count_lists, @$patient_lifestyle_factors['cigarrets_count_at_sixties_and_above'], 'id="cigarettes_average_count_lists" preload_val="'.$patient_lifestyle_factors['cigarrets_count_at_sixties_and_above'].'"'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $cigarettes_count_one_year_before_diagnosed; ?>:  <br />
                    <?php echo form_dropdown('cigarettes_count_one_year_before_diagnosed', $cigarettes_average_count_lists, @$patient_lifestyle_factors['cigarrets_count_one_year_before_diagnosed'], 'id="cigarettes_average_count_lists" preload_val="'.$patient_lifestyle_factors['cigarrets_count_one_year_before_diagnosed'].'"'); ?>
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
                <?php if($patient_lifestyle_factors['alcohol_drunk_flag'] == 1){?>
                <td>
                    <?php echo $alcohol_drunk_flag; ?>:
                    <?php echo form_checkbox(array('name' => 'alcohol_drunk_flag', 'value' => @$patient_lifestyle_factors['alcohol_drunk_flag'],'checked'=>"checked",'readonly'=>'true'))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $alcohol_drunk_flag; ?>:
                    <?php echo form_checkbox(array('name' => 'alcohol_drunk_flag', 'value' => @$patient_lifestyle_factors['alcohol_drunk_flag'],'readonly'=>'true'))?>
                </td>
               <?php } ?>
                <td>
                    <?php echo $alcohol_average; ?>:  <br />
                    <?php echo form_dropdown('alcohol_average', $alcohol_drink_average_lists, @$patient_lifestyle_factors['alcohol_frequency'], 'id="alcohol_drink_average_lists" preload_val="'.$patient_lifestyle_factors['alcohol_frequency'].'"'); ?>
                </td>
                <td>
                    <?php echo $alcohol_average_details; ?>:  <br />
                    <?php echo form_input(array('name' => 'alcohol_average_details', 'value' => @$patient_lifestyle_factors['alcohol_comments'],'readonly'=>'true'))?>
                </td>
            </tr>
            <tr>
                <td id="label1">Coffee</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <?php if($patient_lifestyle_factors['coffee_drunk_flag'] == 1){?>
                <td>
                    <?php echo $coffee_drunk_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'coffee_drunk_flag', 'value' => @$patient_lifestyle_factors['coffee_drunk_flag'],'checked'=>"checked",'readonly'=>'true'))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $coffee_drunk_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'coffee_drunk_flag', 'value' => @$patient_lifestyle_factors['coffee_drunk_flag'],'readonly'=>'true'))?>
                </td>
               <?php } ?>
                <td>
                    <?php echo $coffee_age; ?>: <br />
                    <?php echo form_input(array('name' => 'coffee_age', 'value' => @$patient_lifestyle_factors['coffee_age'],'readonly'=>'true'))?>
                </td>
                <td>
                    <?php echo $coffee_average; ?>: <br />
                    <?php echo form_dropdown('coffee_average', $coffee_tea_drink_average_lists, @$patient_lifestyle_factors['coffee_frequency'], 'id="coffee_tea_drink_average_lists" preload_val="'.$patient_lifestyle_factors['coffee_frequency'].'"'); ?>
                </td>
            </tr>
            <tr>
                <td id="label1">Tea</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <?php if($patient_lifestyle_factors['tea_drunk_flag'] == 1){?>
                <td>
                    <?php echo $tea_drunk_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'tea_drunk_flag', 'value' => @$patient_lifestyle_factors['tea_drunk_flag'],'checked'=>"checked",'readonly'=>'true'))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $tea_drunk_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'tea_drunk_flag', 'value' => @$patient_lifestyle_factors['tea_drunk_flag'],'readonly'=>'true'))?>
                </td>
               <?php } ?>
                <td>
                    <?php echo $tea_age; ?>: <br />
                    <?php echo form_input(array('name' => 'tea_age', 'value' => @$patient_lifestyle_factors['tea_age'],'readonly'=>'true'))?>
                </td>
                <td>
                    <?php echo $tea_average; ?>: <br />
                    <?php echo form_dropdown('tea_average', $coffee_tea_drink_average_lists, @$patient_lifestyle_factors['tea_frequency'], 'id="coffee_tea_drink_average_lists" preload_val="'.$patient_lifestyle_factors['tea_frequency'].'"'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $tea_type; ?>: <br />
                    <?php echo form_dropdown('tea_type', $tea_type_lists, @$patient_lifestyle_factors['tea_type'], 'id="tea_type_lists" preload_val="'.$patient_lifestyle_factors['tea_type'].'"'); ?>
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
                <?php if($patient_lifestyle_factors['soya_bean_drunk_flag'] == 1){?>
                <td>
                    <?php echo $soya_bean_drunk_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'soya_bean_drunk_flag', 'value' => @$patient_lifestyle_factors['soya_bean_drunk_flag'],'checked'=>"checked",'readonly'=>'true'))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $soya_bean_drunk_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'soya_bean_drunk_flag', 'value' => @$patient_lifestyle_factors['soya_bean_drunk_flag'],'readonly'=>'true'))?>
                </td>
               <?php } ?>
                <td>
                    <?php echo $soya_bean_average; ?>: <br />
                    <?php echo form_dropdown('soya_bean_average', $coffee_tea_drink_average_lists, @$patient_lifestyle_factors['soya_bean_frequency'], 'id="coffee_tea_drink_average_lists" preload_val="'.$patient_lifestyle_factors['soya_bean_frequency'].'"'); ?>
                </td>
                <?php if($patient_lifestyle_factors['soya_products_flag'] == 1){?>
                <td>
                    <?php echo $soya_products_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'soya_products_flag', 'value' => @$patient_lifestyle_factors['soya_products_flag'],'checked'=>"checked",'readonly'=>'true'))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $soya_products_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'soya_products_flag', 'value' => @$patient_lifestyle_factors['soya_products_flag'],'readonly'=>'true'))?>
                </td>
               <?php } ?>
            </tr>
            <tr>
                <td>
                    <?php echo $soya_products_average; ?>: <br />
                    <?php echo form_dropdown('soya_products_average', $soya_products_lists, @$patient_lifestyle_factors['soya_products_average'], 'id="soya_products_lists" preload_val="'.$patient_lifestyle_factors['soya_products_average'].'"'); ?>
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
                <?php if($patient_lifestyle_factors['diabetes_flag'] == 1){?>
                <td>
                    <?php echo $diabetes_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'diabetes_flag', 'value' => @$patient_lifestyle_factors['diabetes_flag'],'checked'=>"checked",'readonly'=>'true'))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $diabetes_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'diabetes_flag', 'value' => @$patient_lifestyle_factors['diabetes_flag'],'readonly'=>'true'))?>
                </td>
               <?php } ?>
                <?php if($patient_lifestyle_factors['medicine_for_diabetes_flag'] == 1){?>
                <td>
                    <?php echo $medicine_for_diabetes_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'medicine_for_diabetes_flag', 'value' => @$patient_lifestyle_factors['medicine_for_diabetes_flag'],'checked'=>"checked",'readonly'=>'true'))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $medicine_for_diabetes_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'medicine_for_diabetes_flag', 'value' => @$patient_lifestyle_factors['medicine_for_diabetes_flag'],'readonly'=>'true'))?>
                </td>
               <?php } ?>
                <td>
                    <?php echo $diabates_medicine_name; ?>: <br />
                    <?php echo form_input(array('name' => 'diabates_medicine_name', 'value' => @$patient_lifestyle_factors['diabetes_medicine_name'],'readonly'=>'true'))?>
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
                    <?php echo form_input(array('name' => 'age_period_starts', 'value' => @$patient_menstruation['age_period_starts'],'readonly'=>'true'))?>
                </td>
                <?php if($patient_menstruation['still_period_flag'] == 1){?>
                    <td>
                    <?php echo $still_period_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'still_period_flag', 'value' => @$patient_menstruation['still_period_flag'],'checked'=>"checked",'readonly'=>'true'))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $still_period_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'still_period_flag', 'value' => @$patient_menstruation['still_period_flag'],'readonly'=>'true'))?>
                </td>
               <?php } ?>
                <td>
                    <?php echo $period_type; ?>: 
                    <?php echo form_dropdown('period_type', $period_type_lists, @$patient_menstruation['period_type'], 'id="period_type_lists" preload_val="'.$patient_menstruation['period_type'].'"'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $period_cycle_days; ?>: <br />
                    <?php echo form_dropdown('period_cycle_days', $period_cycle_days_lists, @$patient_menstruation['period_cycle_days'], 'id="period_cycle_days_lists" preload_val="'.$patient_menstruation['period_cycle_days'].'"'); ?>
                </td>
                <td>
                    <?php echo $period_cycle_days_other_details; ?>: <br />
                    <?php echo form_input(array('name' => 'period_cycle_days_other_details', 'value' => @$patient_menstruation['period_cycle_days_other_details'],'readonly'=>'true'))?>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $age_period_stops; ?>: <br />
                    <?php echo form_input(array('name' => 'age_period_stops', 'value' => @$patient_menstruation['age_at_menopause'],'readonly'=>'true'))?>
                </td>
                <td>
                    <?php echo $date_period_stops; ?>: <br />
                    <?php echo form_input(array('name' => 'date_period_stops', 'value' => @$patient_menstruation['date_period_stops'], 'class' => 'datepicker','readonly'=>'true'))?>
                </td>
                <td>
                    <?php echo $reason_period_stops; ?>: <br />
                    <?php echo form_dropdown('reason_period_stops', $reason_period_stops_lists, @$patient_menstruation['reason_period_stops'], 'id="reason_period_stops_lists" preload_val="'.$patient_menstruation['reason_period_stops'].'"'); ?>
                </td>
                <td>
                    <?php echo $reason_period_stops_other_details; ?>: <br />
                    <?php echo form_input(array('name' => 'reason_period_stops_other_details', 'value' => @$patient_menstruation['reason_period_stops_other_details'],'readonly'=>'true'))?>
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
<!--                    <td>
                        <?php echo $never_been_pregnant_flag; ?>: 
                        <?php echo form_checkbox(array('name' => 'never_been_pregnant_flag', 'value' => @$patient_parity_table['never_been_pregnant_flag'],'readonly'=>'true'))?>
                    </td>-->
                        <?php if($patient_parity_table['pregnant_flag'] == 1){?>
                        <td>
                        <?php echo $pregnant_flag; ?>: 
                        <?php echo form_checkbox(array('name' => 'pregnant_flag', 'value' => @$patient_parity_table['pregnant_flag'],'checked'=>"checked",'readonly'=>'true'))?>
                    </td>
               <?php } else {?>
                <td>
                        <?php echo $pregnant_flag; ?>: 
                        <?php echo form_checkbox(array('name' => 'pregnant_flag', 'value' => @$patient_parity_table['pregnant_flag'],'readonly'=>'true'))?>
                    </td>
               <?php } ?>
                </tr>
                <tr>
                <td>
                    <?php echo $pregnancy_type; ?>: <br />
                    <?php echo form_dropdown('pregnancy_type', $pregnancy_type_lists, @$patient_parity_record['pregnancy_type'], 'id="pregnancy_type" preload_val="'.@$patient_parity_record['pregnancy_type'].'"'); ?>
                </td>
                <td>
                    <?php echo $child_gender; ?>: <br />
                    <?php echo form_dropdown('child_gender', $genderTypes, @$patient_parity_record['gender'], 'id="gender" preload_val="'.@$patient_parity_record['gender'].'"'); ?>
                </td>
                <td>
                    <?php echo $child_birthdate; ?>: <br />
                    <?php echo form_input(array('name' => 'child_birthdate', 'value' => @$patient_parity_record['date_of_birth'], 'class' => 'datepicker','readonly'=>'true'))?>
                </td>
                </tr>
                <tr>
                    <td>
                    <?php echo $child_age_at_consent; ?>: <br />
                    <?php echo form_input(array('name' => 'child_age_at_consent', 'value' => @$patient_parity_record['age_child_at_consent'],'readonly'=>'true'))?>
                </td>
                <td>
                    <?php echo $child_birthweight; ?>: <br />
                    <?php echo form_input(array('name' => 'child_birthweight', 'value' => @$patient_parity_record['birthweight'],'readonly'=>'true'))?>
                </td>
                <td>
                    <?php echo $child_breastfeeding_duration; ?>: <br />
                    <?php echo form_input(array('name' => 'breastfeeding_duration', 'value' => @$patient_parity_record['breastfeeding_duration'],'readonly'=>'true'))?>
                </td>
                <td>
                    <?php echo $child_birthyear; ?>: <br />
                    <?php echo form_input(array('name' => 'child_birthyear', 'value' => @$patient_parity_record['year_of_birth'],'readonly'=>'true'))?>
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
                <?php if($patient_infertility['infertility_testing_flag'] == 1){?>
                <td>
                    <?php echo $infertility_testing_flag; ?>:
                    <?php echo form_checkbox(array('name' => 'infertility_testing_flag', 'value' => @$patient_infertility['infertility_testing_flag'],'checked'=>"checked",'readonly'=>'true'))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $infertility_testing_flag; ?>:
                    <?php echo form_checkbox(array('name' => 'infertility_testing_flag', 'value' => @$patient_infertility['infertility_testing_flag'],'readonly'=>'true'))?>
                </td>
               <?php } ?>
                <td>
                    <?php echo $infertility_treatment_details; ?>: <br />
                    <?php echo form_input(array('name' => 'infertility_treatment_details', 'value' => @$patient_infertility['infertility_comments'],'readonly'=>'true'))?>
                </td>
                <td>
                    <?php echo $infertility_treatment_duration; ?>:  <br />
                    <?php echo form_input(array('name' => 'infertility_treatment_duration', 'value' => @$patient_infertility['infertility_treatment_duration'],'readonly'=>'true'))?>
                </td>
                <td>
                    <?php echo $infertility_treatment_comments; ?>: <br />
                    <?php echo form_textarea(array('name' => 'infertility_treatment_comments','id' => 'infertility_treatment_comments','rows' => '3','cols' => '7', 'value' => @$patient_infertility['infertility_comments'],'readonly'=>'true'))?>
                </td>
                <td>&nbsp;</td>
            <tr>
                <td id="label1">Contraceptive pills</td>
            </tr>
            <tr>
                <?php if($patient_infertility['contraceptive_pills_flag'] == 1){?>
                <td>
                    <?php echo $contraceptive_pills_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'contraceptive_pills_flag', 'value' => @$patient_infertility['contraceptive_pills_flag'],'checked'=>"checked",'readonly'=>'true'))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $contraceptive_pills_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'contraceptive_pills_flag', 'value' => @$patient_infertility['contraceptive_pills_flag'],'readonly'=>'true'))?>
                </td>
               <?php } ?>
                <td>
                    <?php echo $contraceptive_pills_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'contraceptive_pills_flag', 'value' => @$patient_infertility['contraceptive_pills_flag'],'readonly'=>'true'))?>
                </td>
<!--                <td>
                    <?php echo $contraceptive_pills_details; ?>: <br />
                    <?php echo form_input(array('name' => 'contraceptive_pills_details', 'value' => @$patient_infertility['contraceptive_pills_details'],'readonly'=>'true'))?>
                </td>-->
                    <?php if($patient_infertility['currently_taking_contraceptive_pills_flag'] == 1){?>
                    <td>
                    <?php echo $currently_taking_contraceptive_pills_flag; ?>: <br />
                    <?php echo form_checkbox(array('name' => 'currently_taking_contraceptive_pills_flag', 'value' => @$patient_infertility['currently_taking_contraceptive_pills_flag'],'checked'=>"checked",'readonly'=>'true'))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $currently_taking_contraceptive_pills_flag; ?>: <br />
                    <?php echo form_checkbox(array('name' => 'currently_taking_contraceptive_pills_flag', 'value' => @$patient_infertility['currently_taking_contraceptive_pills_flag'],'readonly'=>'true'))?>
                </td>
               <?php } ?>
                <td>
                    <?php echo $contraceptive_start_date; ?>: <br />
                    <?php echo form_input(array('name' => 'contraceptive_start_date', 'value' => @$patient_infertility['contraceptive_start_date'], 'class' => 'datepicker','readonly'=>'true'))?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $contraceptive_end_date; ?>: <br />
                    <?php echo form_input(array('name' => 'contraceptive_end_date', 'value' => @$patient_infertility['contraceptive_end_date'], 'class' => 'datepicker','readonly'=>'true'))?>
                </td>
                <td>
                    <?php echo $contraceptive_start_age; ?>: <br />
                    <?php echo form_input(array('name' => 'contraceptive_start_age', 'value' => @$patient_infertility['contraceptive_start_age'],'readonly'=>'true'))?>
                </td>
                <td>
                    <?php echo $contraceptive_end_age; ?>: <br />
                    <?php echo form_input(array('name' => 'contraceptive_end_age', 'value' => @$patient_infertility['contraceptive_end_age'],'readonly'=>'true'))?>
                </td>
                <td>
                    <?php echo $contraceptive_duration; ?>: <br />
                    <?php echo form_input(array('name' => 'contraceptive_duration', 'value' => @$patient_infertility['contraceptive_duration'],'readonly'=>'true'))?>
                </td>
            </tr>
            <tr>
                <td id="label1">Hormonal Replacement Therapy</td>
            </tr>
            <tr>
                <?php if($patient_infertility['hrt_flag'] == 1){?>
                <td>
                    <?php echo $HRT_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'HRT_flag', 'value' => @$patient_infertility['hrt_flag'],'checked'=>"checked",'readonly'=>'true'))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $HRT_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'HRT_flag', 'value' => @$patient_infertility['hrt_flag'],'readonly'=>'true'))?>
                </td>
               <?php } ?>
<!--                <td>
                    <?php echo $HRT_details; ?>: <br />
                    <?php echo form_input(array('name' => 'HRT_details', 'value' => @$patient_infertility['HRT_details'],'readonly'=>'true'))?>
                </td>-->
                <?php if($patient_infertility['currently_using_hrt_flag'] == 1){?>
                    <td>
                    <?php echo $currently_using_HRT_flag; ?>: <br />
                    <?php echo form_checkbox(array('name' => 'currently_using_hrt_flag', 'value' => @$patient_infertility['currently_using_hrt_flag'],'checked'=>"checked",'readonly'=>'true'))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $currently_using_HRT_flag; ?>: <br />
                    <?php echo form_checkbox(array('name' => 'currently_using_hrt_flag', 'value' => @$patient_infertility['currently_using_hrt_flag'],'readonly'=>'true'))?>
                </td>
               <?php } ?>
                <td>
                    <?php echo $HRT_start_date; ?>: <br />
                    <?php echo form_input(array('name' => 'hrt_start_date', 'value' => @$patient_infertility['hrt_start_date'], 'class' => 'datepicker','readonly'=>'true'))?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $HRT_end_date; ?>: <br />
                    <?php echo form_input(array('name' => 'hrt_end_date', 'value' => @$patient_infertility['hrt_end_date'], 'class' => 'datepicker','readonly'=>'true'))?>
                </td>
                <td>
                    <?php echo $HRT_start_age; ?>: <br />
                    <?php echo form_input(array('name' => 'hrt_start_age', 'value' => @$patient_infertility['hrt_start_age'],'readonly'=>'true'))?>
                </td>
                <td>
                    <?php echo $HRT_end_age; ?>: <br />
                    <?php echo form_input(array('name' => 'hrt_end_age', 'value' => @$patient_infertility['hrt_end_age'],'readonly'=>'true'))?>
                </td>
                <td>
                    <?php echo $HRT_duration; ?>: <br />
                    <?php echo form_input(array('name' => 'HRT_duration', 'value' => @$patient_infertility['hrt_duration'],'readonly'=>'true'))?>
                </td>
            </tr>
            <tr>
                <?php if($patient_gynaecological['had_gnc_surgery_flag'] == 1){?>
                <td>
                    <?php echo $had_gnc_surgery_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'had_gnc_surgery_flag', 'value' => @$patient_gynaecological['had_gnc_surgery_flag'],'checked'=>"checked",'readonly'=>'true'))?>
                </td>
               <?php } else {?>
                <td>
                    <?php echo $had_gnc_surgery_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'had_gnc_surgery_flag', 'value' => @$patient_gynaecological['had_gnc_surgery_flag'],'readonly'=>'true'))?>
                </td>
               <?php } ?>
                <td>
                    <?php echo $gnc_surgery_year; ?>: <br />
                    <?php echo form_input(array('name' => 'gnc_surgery_year', 'value' => @$patient_gynaecological['surgery_year'],'readonly'=>'true'))?>
                </td>
                <td>
                    <?php echo $gnc_treatment_name; ?>: <br />
                    <?php echo form_dropdown('gnc_treatment_name', $gnc_treatment_lists, @$patient_gynaecological['treatment_id'], 'id="gnc_treatment_lists" preload_val="'.$patient_gynaecological['treatment_id'].'"'); ?>
                </td>
                <td>
                    <?php echo $gnc_treatment_name_other_details; ?>: <br />
                    <?php echo form_input(array('name' => 'gnc_treatment_name_other_details', 'value' => @$patient_gynaecological['gnc_treatment_name_other_details'],'readonly'=>'true'))?>
                </td>
            </tr>
             <input type="hidden" name="patient_ic_no" value="<?php print @$patient_lifestyle_factors['patient_ic_no']; ?>"/>
            <input type="hidden" name="patient_lifestyle_factors_id" value="<?php print @$patient_lifestyle_factors['patient_lifestyle_factors_id']; ?>"/>
            <input type="hidden" name="patient_menstruation_id" value="<?php print @$patient_menstruation['patient_menstruation_id']; ?>"/>
            <input type="hidden" name="patient_parity_table_id" value="<?php print @$patient_parity_table['patient_parity_table_id']; ?>"/>
            <input type="hidden" name="patient_infertility_id" value="<?php print @$patient_infertility['patient_infertility_id']; ?>"/>
            <input type="hidden" name="patient_gynaecological_surgery_history_id" value="<?php print @$patient_gynaecological['patient_gynaecological_surgery_history_id']; ?>"/>
        </table>
        <?php echo form_fieldset_close(); ?>
    </div>
    <?php echo form_close(); ?>
</div>




