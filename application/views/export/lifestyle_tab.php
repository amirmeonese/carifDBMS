<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=export_lifestyle1_data.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<p>Lifestyle Factor</p>
<div height="30px">&nbsp;</div>

<table border="1">
    <thead>
        <tr>
                    <th colspan="3" style="background-color:Crimson;"></th>
                    <th colspan="3" style="background-color:Crimson;">Patient Self Image</th>
                    <th colspan="3" style="background-color:Crimson;">Childhood (before 18-years of age</th>
                    <th colspan="3" style="background-color:Crimson;">18-30 years old</th>
                    <th colspan="3" style="background-color:Crimson;">The most recent years</th>
                    <th colspan="3" style="background-color:Crimson;">Smoking</th>
                    <th colspan="7" style="background-color:Crimson;">Average cigarettes smoked</th>
                    <th colspan="3" style="background-color:Crimson;">Alcohol</th>
                    <th colspan="3" style="background-color:Crimson;">Coffee</th>
                    <th colspan="5" style="background-color:Crimson;">Tea</th>
                    <th colspan="5" style="background-color:Crimson;">Soy Products</th>
                    <th colspan="3" style="background-color:Crimson;">Diabetes</th>
        </tr>
                <tr>
                    <th style="background-color:Crimson;">No</th>
                    <th style="background-color:Crimson;">IC No</th>
                    <th style="background-color:Crimson;">Questionnaire Date</th>
                    <th style="background-color:Crimson;">Self image at 7 years old</th>
                    <th style="background-color:Crimson;">Self image at 18 years old</th>
                    <th style="background-color:Crimson;">Self image now</th>
                    <th style="background-color:Crimson;">Strenuous Exercise</th>
                    <th style="background-color:Crimson;">Moderate Exercise</th>
                    <th style="background-color:Crimson;">Gentle Exercise</th>
                    <th style="background-color:Crimson;">Strenuous Exercise</th>
                    <th style="background-color:Crimson;">Moderate Exercise</th>
                    <th style="background-color:Crimson;">Gentle Exercise</th>
                    <th style="background-color:Crimson;">Strenuous Exercise</th>
                    <th style="background-color:Crimson;">Moderate Exercise</th>
                    <th style="background-color:Crimson;">Gentle Exercise</th>
                    <th style="background-color:Crimson;">Patient has ever smoked cigarettes?</th>
                    <th style="background-color:Crimson;">Patient still smoking</th>
                    <th style="background-color:Crimson;">Total years of smoking</th>
                    <th style="background-color:Crimson;">Before 20 years old</th>
                    <th style="background-color:Crimson;">20 - 29 years</th>
                    <th style="background-color:Crimson;">30-39 years</th>
                    <th style="background-color:Crimson;">40 - 49 years</th>
                    <th style="background-color:Crimson;">50 - 59 years</th>
                    <th style="background-color:Crimson;">60 year and more</th>
                    <th style="background-color:Crimson;">1 year prior to cancer diagnosis</th>
                    <th style="background-color:Crimson;">Consumption more than once a month on average?</th>
                    <th style="background-color:Crimson;">Alcohol frequency</th>
                    <th style="background-color:Crimson;">Comments</th>
                    <th style="background-color:Crimson;">Regular consumptions?</th>
                    <th style="background-color:Crimson;">Start age</th>
                    <th style="background-color:Crimson;">Coffee frequency</th>
                    <th style="background-color:Crimson;">Regular consumption?</th>
                    <th style="background-color:Crimson;">Start age</th>
                    <th style="background-color:Crimson;">Tea frequency</th>
                    <th style="background-color:Crimson;">Tea type</th>
                    <th style="background-color:Crimson;">If there's other tea type, please specify</th>
                    <th style="background-color:Crimson;">Regular consumption?</th>
                    <th style="background-color:Crimson;">Soya bean frequency</th>
                    <th style="background-color:Crimson;">Soya product frequency</th>
                    <th style="background-color:Crimson;">Soya products average</th>
                    <th style="background-color:Crimson;">If there's other soya products average, please specify</th>
                    <th style="background-color:Crimson;">Patient has diabetes?</th>
                    <th style="background-color:Crimson;">Current taking any diabetes medication?</th>
                    <th style="background-color:Crimson;">Medicine name</th>
                </tr>
            </thead>
            <?php if (!empty($patient_lifestyle_factors)){ ?>
            <?php $no = 1;?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $patient_lifestyle_factors['patient_ic_no']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['questionnaire_date']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['self_image_at_7years']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['self_image_at_18years']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['self_image_now']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['pa_strenuous_exercise_childhood']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['pa_moderate_exercise_childhood']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['pa_gentle_exercise_childhood']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['pa_strenuous_exercise_adult']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['pa_moderate_exercise_adult']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['pa_gentle_exercise_adult']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['pa_strenuous_exercise_now']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['pa_moderate_exercise_now']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['pa_gentle_exercise_now']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['cigarrets_smoked_flag']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['cigarrets_still_smoked_flag']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['total_smoked_years']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['cigarrets_count_at_teen']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['cigarrets_count_at_twenties']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['cigarrets_count_at_thirties']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['cigarrets_count_at_fourrties']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['cigarrets_count_at_fifties']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['cigarrets_count_at_sixties_and_above']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['cigarrets_count_one_year_before_diagnosed']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['alcohol_drunk_flag']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['alcohol_frequency']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['alcohol_comments']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['coffee_drunk_flag']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['coffee_age']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['coffee_frequency']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['tea_drunk_flag']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['tea_age']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['tea_frequency']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['tea_type']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['soya_bean_drunk_flag']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['soya_bean_frequency']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['soya_products_flag']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['soya_products_average']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['diabetes_flag']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['medicine_for_diabetes_flag']; ?></td>
                    <td><?php echo $patient_lifestyle_factors['diabetes_medicine_name']; ?></td>
                </tr>
            <?php $no++; ?>
        <?php } else { ?>
                <tr>
                </tr>
                <?php } ?>
        </table>
