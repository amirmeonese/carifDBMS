<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>View Patient</p>
    </div>
    <?php
    $attributes = array('id' => 'personal-details-form');
    echo form_open("record/patient_record_update", $attributes);
    ?>
    <div class="container" id="add_record_form_section_personal">
        <div height="30px">&nbsp;</div>
        <?php
        echo form_fieldset('Patient');
        ?>
        <table> 
            <tr>
                <td>
                    <label for="surname"><?php echo $surname; ?>:</label>
                   <?php echo form_input(array('name' => 'surname', 'value' => $patient_detail['surname']))?>
                </td>
                <td>
                    <label for="fullname"><?php echo $fullname; ?>: </label>
                    <?php echo form_input(array('name' => 'fullname', 'value' => $patient_detail['given_name']))?>
                </td>

                <td>
                    <?php echo $maiden_name; ?>: 
                    <?php echo form_input(array('name' => 'maiden_name', 'value' => $patient_detail['maiden_name']))?>
                </td>
                <td>
                    <label for="family_no"><?php echo $family_no; ?>: </label>
                    <?php echo form_input(array('name' => 'family_no', 'value' => $patient_detail['family_no']))?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $nationality; ?>:
                    <?php echo  form_dropdown('nationality',$nationalities, $patient_detail['nationality'], 'id="nationality" preload_val="'.$patient_detail['nationality'].'"'); ?>
                </td>
                <td>
                    <label for="IC_no"><?php echo $IC_no; ?>: </label>
                    <?php echo form_input(array('name' => 'IC_no', 'value' => $patient_detail['ic_no']))?>
                </td>
                <td>
                    <label for="old_IC_no"><?php echo $old_IC_no; ?>: </label>
                    <?php echo form_input(array('name' => 'old_IC_no', 'value' => $patient_detail['old_ic_no']))?>
                </td>
                <td>
                    <?php echo $gender; ?>: 
                    <?php echo  form_dropdown('gender',$genderTypes, $patient_detail['gender'], 'id="gender" preload_val="'.$patient_detail['gender'].'"') ?>
                </td>
                    </tr>
            <tr>
                <td>
                    <?php echo $ethinicity; ?>: 
                    <?php echo form_input(array('name' => 'ethnicity', 'value' => $patient_detail['ethnicity']))?>
                </td>
                <td>
                    <?php echo $DOB; ?>:
                    <?php echo form_input(array('name' => 'd_o_b', 'value' => $patient_detail['d_o_b'],'class' => 'datepicker'))?>

                </td>
                <td>
                    <?php echo $place_of_birth; ?>: 
                    <?php echo form_input(array('name' => 'place_of_birth', 'value' => $patient_detail['place_of_birth']))?>
                    
                </td>
                <td>
                    <?php echo $marital_status; ?>:
                    <?php echo  form_dropdown('marital_status',$marital_status_lists, $patient_detail['marital_status'], 'id="marital_status" preload_val="'.$patient_detail['marital_status'].'"')?>                    
                </td>
                          </tr>
            <tr>
                <td>
                    <?php echo $blood_group; ?>: 
                    <?php echo form_input(array('name' => 'blood_group', 'value' => $patient_detail['blood_group']))?>                  
                </td>
  
               <?php if($patient_detail['is_dead'] == 1){?>
                <td>
                    <?php echo $is_dead; ?>:
                    <?php echo form_checkbox(array('name' => 'is_dead', 'value' => $patient_detail['is_dead'],'checked'=>"checked"))?>                    
                </td>
               <?php } else {?>
                <td>
                    <?php echo $is_dead; ?>:
                    <?php echo form_checkbox(array('name' => 'is_dead', 'value' => $patient_detail['is_dead']))?>                    
                </td>
               <?php } ?>
                <td>
                    <?php echo $DOD; ?>: 
                    <?php echo form_input(array('name' => 'd_o_d', 'value' => $patient_detail['d_o_d'],'class' => 'datepicker'))?>
                </td>
                <td>
                    <?php echo $reason_of_death; ?>: 
                    <?php echo form_textarea(array('name' => 'reason_of_death','id' => 'reason_of_death','rows' => '3','cols' => '7', 'value' => $patient_detail['reason_of_death']))?>                                      
                </td>
            </tr>
        </table>
    </div>
    <?php foreach ($patient_hospital_no as $hospital): ?>
    <div class="container" id="add_record_form_section_personal2">
        <table id="hospital_no_section_1">
            <tr>
                <td id="label1">Hospital numbers</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                <?php echo $hospital_no; ?>: 
                <?php echo form_input(array('name' => 'hospital_no', 'value' => @$hospital['hospital_no']))?>
                </td>
                
            </tr>
        </table>
    </div>
    <?php endforeach; ?>
    <?php foreach ($patient_private_no as $private_no): ?>
    <div class="container" id="add_record_form_section_personal3">
        <div height="30px">&nbsp;</div>
        <table id="add_private_patient_no_section_1">
            <tr>
                <td id="label1">Private patient numbers</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $private_patient_no; ?>: 
                    <?php echo form_input(array('name' => 'private_patient_no', 'value' => @$private_no['private_no']))?>
                </td>
                
            </tr>
        </table>
    </div>
    <?php endforeach; ?>
    <?php foreach ($patient_cogs_studies as $cogs): ?>
    <div class="container" id="add_record_form_section_personal6">
        <div height="30px">&nbsp;</div>
        <table id="add_study_no_section_1">
            <tr>
                <td id="label1">COGS study numbers</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $COGS_study_id; ?>:
                    <?php echo form_dropdown('COGS_study_id',$COGS_study_id_lists, $cogs['COGS_studies_name'], 'id="COGS_study_id" preload_val="'.$cogs['COGS_studies_name'].'"')?>                    
                </td>
                <td>
                    <?php echo 'Study no'; ?>: 
                    <?php echo form_input(array('name' => 'COGS_studies_no', 'value' => $cogs['COGS_studies_no']))?>                    
                </td>
                <input type="hidden" name="COGS_studies_id" value="<?php print $cogs['COGS_studies_id']; ?>"/>
            </tr>
        </table>
    </div>
    <?php endforeach; ?>
    <div class="container" id="add_record_form_section_personal4">
        <div height="30px">&nbsp;</div>
        <table>
            <tr>
                <?php if($patient_detail['is_dead'] == 1){?>
                <td>
                    <?php echo $is_blood_card_exist; ?>: 
                    <?php echo form_checkbox(array('name' => 'is_blood_card_exist', 'value' => $patient_detail['blood_card'],'checked'=>"checked"))?>                    
                </td>
               <?php } else {?>
                <td>
                    <?php echo $is_blood_card_exist; ?>: 
                    <?php echo form_checkbox(array('name' => 'is_blood_card_exist', 'value' => $patient_detail['blood_card']))?>                    
                </td>
               <?php } ?>
                <td>
                    <?php echo $blood_card_location; ?>: 
                    <?php echo form_input(array('name' => 'blood_card_location', 'value' => $patient_detail['blood_card_location']))?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $address; ?>: 
                    <?php echo form_textarea(array('name' => 'address','id' => 'address','rows' => '5','cols' => '10', 'value' => $patient_detail['address']))?>                                      
                </td>
                <td>
                    <?php echo $home_phone; ?>: 
                    <?php echo form_input(array('name' => 'home_phone', 'value' => $patient_detail['home_phone']))?>
                </td>
                <td>
                    <?php echo $cell_phone; ?>: 
                    <?php echo form_input(array('name' => 'cell_phone', 'value' => $patient_detail['cell_phone']))?>
                </td>
                <td>
                    <?php echo $work_phone; ?>: 
                    <?php echo form_input(array('name' => 'work_phone', 'value' => $patient_detail['work_phone']))?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $other_phone; ?>: 
                    <?php echo form_input(array('name' => 'other_phone', 'value' => $patient_detail['other_phone']))?>                    
                </td>
                <td>
                    <?php echo $fax; ?>: 
                    <?php echo form_input(array('name' => 'fax', 'value' => $patient_detail['fax']))?>                                        
                </td>
                <td>
                    <?php echo $email; ?>: 
                    <?php echo form_input(array('name' => 'email', 'value' => $patient_detail['email']))?>                                        
                </td>
                <td>
                    <?php echo $highest_level_of_education; ?>: 
                    <?php echo form_textarea(array('name' => 'highest_level_of_education','id' => 'highest_level_of_education','rows' => '3','cols' => '7', 'value' => $patient_detail['highest_education_level']))?>                                      
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $height; ?>: 
                    <?php echo form_input(array('name' => 'height', 'value' => $patient_detail['height']))?>                                                            
                </td>
                <td>
                    <?php echo $weight; ?>: 
                    <?php echo form_input(array('name' => 'weight', 'value' => $patient_detail['weight']))?>                                                            
                </td>
                <td>
                    <?php if(!empty($patient_detail['weight']) && ($patient_detail['height'] )) {
                        $bmi = $patient_detail['weight']/($patient_detail['height']*$patient_detail['height']); ?>
                        
                    <?php echo $BMI; ?>: 
                    <?php echo form_input(array('name' => 'BMI', 'value' => round($bmi,1)))?>   
                    <?php } else {?>
                    
                    <?php echo $BMI; ?>: 
                    <?php echo form_input(array('name' => 'BMI', 'value' => ''))?>    
                    
                    <?php } ?>
                </td>
                <td>
                    <?php echo $income_level; ?>:
                    <?php echo  form_dropdown('income_level',$income_level_lists, $patient_detail['income_level'], 'id="income_level" preload_val="'.$patient_detail['income_level'].'"');?>                                        
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $contact_person_name; ?>: 
                    <?php echo form_input(array('name' => 'contact_person_name', 'value' => $patient_contact_person['contact_name']))?>                    
                </td>
                <td>
                    <?php echo $contact_person_phone_number; ?>: 
                    <?php echo form_input(array('name' => 'contact_person_phone_number', 'value' => $patient_contact_person['contact_telephone']))?>                    
                </td>
                <td>
                    <?php echo $contact_person_relationship; ?>: 
                    <?php echo form_input(array('name' => 'contact_person_relationship', 'value' => $patient_contact_person['contact_relationship']))?>                    
                </td>
                <td>
                    <?php echo $patient_comments; ?>: 
                    <?php echo form_textarea(array('name' => 'patient_comments','id' => 'patient_comments','rows' => '3','cols' => '7', 'value' => $patient_detail['comment']))?>                                      
                </td>
            </tr>
            <tr>
                <td id="label1">Relative summary details</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $total_no_of_male_siblings; ?>:
                    <?php echo form_input(array('name' => 'total_no_of_male_siblings', 'value' => $patient_relatives_summary['total_no_of_male_siblings']))?>                    
                </td>
                <td>
                    <?php echo $total_no_of_female_siblings; ?>:
                    <?php echo form_input(array('name' => 'total_no_of_female_siblings', 'value' => $patient_relatives_summary['total_no_of_female_siblings']))?>                    
                </td>
                <td>
                    <?php echo $total_no_of_affected_siblings; ?>:
                    <?php echo form_input(array('name' => 'total_no_of_affected_siblings', 'value' => $patient_relatives_summary['total_no_of_affected_siblings']))?>                                        
                </td>
                <td>
                   <?php $total_sibling = $patient_relatives_summary['total_no_of_male_siblings'] + $patient_relatives_summary['total_no_of_female_siblings'];?>
                    <?php echo $total_no_of_siblings; ?>:
                    <?php echo form_input(array('name' => 'total_no_of_siblings', 'value' => $total_sibling))?>                                                            
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $total_no_male_children; ?>:
                    <?php echo form_input(array('name' => 'total_no_male_children', 'value' => $patient_relatives_summary['total_no_of_male_children']))?>                                                                                
                </td>
                <td>
                    <?php echo $total_no_female_children; ?>:
                    <?php echo form_input(array('name' => 'total_no_female_children', 'value' => $patient_relatives_summary['total_no_of_female_children']))?>                                                                                                    
                </td>
                <td>
                    <?php echo $total_no_of_affected_children; ?>:
                    <?php echo form_input(array('name' => 'total_no_of_affected_children', 'value' => $patient_relatives_summary['total_no_of_affected_children']))?>                                                                                                                        
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $total_no_of_first_degree; ?>:
                    <?php echo form_input(array('name' => 'total_no_of_first_degree', 'value' => $patient_relatives_summary['total_no_of_1st_degree']))?>                                                                                                                        
                </td>
                <td>
                    <?php echo $total_no_of_second_degree; ?>:
                    <?php echo form_input(array('name' => 'total_no_of_second_degree', 'value' => $patient_relatives_summary['total_no_of_2nd_degree']))?>                                                                                                                        
                </td>
                <td>
                    <?php echo $total_no_of_third_degree; ?>:
                    <?php echo form_input(array('name' => 'total_no_of_third_degree', 'value' => $patient_relatives_summary['total_no_of_3rd_degree']))?>                                                                                                                        
                </td>
                <td>&nbsp;</td>
            </tr>
        </table>
    </div><?php foreach ($patient_survival_status as $survival): ?>

    <?php echo form_fieldset_close(); ?>
    
    <div class="container" id="add_record_form_section_personal_5">
        <div height="30px">&nbsp;</div>
        <table id="survival_section_1">
            <tr>
                <td id="label1">Survival status</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $status_source; ?>:
                    <?php echo  form_dropdown('status_source',$status_source_lists, $survival['source'], 'id="status_source" preload_val="'.$survival['source'].'"'); ?>                                                            
                </td>
                <td>
                    <?php echo $alive_status; ?>:
                    <?php echo  form_dropdown('alive_status',$alive_status_lists, @$alive_id[$survival['alive_status']], 'id="alive_status" preload_val="'.@$alive_id[$survival['alive_status']].'"'); ?>                                                            
                </td>
                <td>
                    <?php echo $status_gathered_date; ?>: 
                    <?php echo form_input(array('name' => 'status_gathered_date', 'value' => $survival['status_gathering_date'],'class' => 'datepicker')); ?>
                </td>
                <input type="hidden" name="patient_survival_status_id" value="<?php print $survival['patient_survival_status_id']; ?>"/>
                
            </tr>
            
                <input type="hidden" name="patient_contact_person_id" value="<?php print $patient_contact_person['patient_contact_person_id']; ?>"/>
                <input type="hidden" name="patient_hospital_no_id" value="<?php print @$patient_hospital_no['patient_hospital_no_id']; ?>"/>
                <input type="hidden" name="patient_private_no_id" value="<?php print @$patient_private_no['patient_private_no_id']; ?>"/>
                <input type="hidden" name="patient_relatives_summary_id" value="<?php print $patient_relatives_summary['patient_relatives_summary_ID']; ?>"/>
        </table>
    </div>
    <?php endforeach; ?>
    <?php foreach ($patient_consent_detail as $list): ?>
    <div class="container" id="add_consent_details_section">
        <div height="30px">&nbsp;</div>
        <?php
        echo form_fieldset('Consent Details');
        ?>
        <table>
            <tr>
                <td>
                    <?php echo $studies_name; ?>:
                    <?php echo  form_dropdown('studies_name[]',$studies_name_lists, @$studies_id[$list['studies_id']], 'id="studies_name" preload_val="'.@$studies_id[$list['studies_id']].'"'); ?>                                                                                
                </td>
                <td>
                    <?php echo $date_at_consent; ?>:
                    <?php echo form_input(array('name' => 'date_at_consent[]', 'value' => $list['date_at_consent'],'class' => 'datepicker'))?>                    
                </td>
                <td>
                    <?php echo $age_at_consent; ?>: 
                    <?php echo form_input(array('name' => 'age_at_consent[]', 'value' => $list['age_at_consent']))?>                    
                </td>
                <td>
                    <?php echo $is_double_consent_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'is_double_consent_flag[]', 'value' => $list['double_consent_flag']))?>                    
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $consent_given_by; ?>: 
                    <?php echo form_input(array('name' => 'consent_given_by[]', 'value' => $list['consent_given_by']))?>                   
                </td>
                <td>
                    <?php echo $consent_response; ?>: 
                    <?php echo form_input(array('name' => 'consent_response[]', 'value' => $list['consent_response']))?>
                </td>
                <td>
                    <?php echo $consent_version; ?>: 
                    <?php echo form_input(array('name' => 'consent_version[]', 'value' => $list['consent_version']))?>
                </td>
                <td>
                    <?php echo $relations_to_study; ?>: 
                    <?php echo form_input(array('name' => 'relations_to_study[]', 'value' => $list['relation_to_study']))?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $referral_to; ?>: 
                    <?php echo form_input(array('name' => 'referral_to[]', 'value' => $list['referral_to']))?>                    
                </td>
                <td>
                    <?php echo $referral_date; //referral to genetic counselling ?>:
                    <?php echo form_input(array('name' => 'referral_date[]', 'value' => $list['referral_to_genetic_counselling'],'class' => 'datepicker'))?>                                        
                </td>
                <td>
                    <?php echo $referral_source; ?>: 
                    <?php echo form_input(array('name' => 'referral_source[]', 'value' => $list['referral_source']))?>                    
                </td>
            </tr>
            <input type="hidden" name="patient_studies_id[]" value="<?php print $list['patient_studies_id']; ?>"/>
        </table>
        <?php echo form_fieldset_close(); ?>	
    </div>
    <?php endforeach; ?>
    <?php if ($userprivillage['edit_privilege']== 1){ ?>
    <?php echo form_submit('mysubmit', 'Update'); ?>
    <?php } else { ?>
    <?php }?>
    <?php echo form_close(); ?>
</div>




