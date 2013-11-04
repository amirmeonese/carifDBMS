<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>Add Patient</p>
    </div>
    <?php
    $attributes = array('id' => 'personal-details-form');
    echo form_open("record/patient_record_insertion", $attributes);
    ?>
    <div class="container" id="add_record_form_section_personal">
        <div height="30px">&nbsp;</div>
        <?php
        echo form_fieldset('Patient');
        ?>
        <table>
            <tr>
                <td>
                    <label for="surname"><?php echo $surname; ?>: </label>
                   <?php echo ($isUpdate) ? form_input(array('name' => 'surname', 'value' => $patient_detail['surname'])) : form_input(array('name'=>'surname','value'=> set_value('surname')))?>
                </td>
                <td>
                    <label for="fullname"><?php echo $fullname; ?>: </label>
                    <?php echo ($isUpdate) ? form_input(array('name' => 'fullname', 'value' => $patient_detail['given_name'])) : form_input(array('name'=>'fullname','value'=> set_value('fullname')))?>
                </td>

                <td>
                    <?php echo $maiden_name; ?>: 
                    <?php echo ($isUpdate) ? form_input(array('name' => 'maiden_name', 'value' => $patient_detail['maiden_name'])) : form_input(array('name'=>'maiden_name','value'=> set_value('maiden_name')))?>
                </td>
                <td>
                    <label for="family_no"><?php echo $family_no; ?>: </label>
                    <?php echo ($isUpdate) ? form_input(array('name' => 'family_no', 'value' => $patient_detail['family_no'])) : form_input(array('name'=>'family_no','value'=> set_value('family_no')))?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $nationality; ?>: 
                    <?php echo ($isUpdate) ?  form_dropdown('nationality',$nationalities, $patient_detail['nationality']) : form_dropdown('nationality', $nationalities, NULL, 'id="nationality"'); ?>
                </td>
                <td>
                    <label for="IC_no"><?php echo $IC_no; ?>: </label>
                    <?php echo ($isUpdate) ? form_input(array('name' => 'IC_no', 'value' => $patient_detail['ic_no'])) : form_input(array('name'=>'IC_no','value'=> set_value('IC_no')))?>
                </td>
                <td>
                    <?php echo $gender; ?>: 
                    <?php echo ($isUpdate) ?  form_dropdown('gender',$genderTypes, $patient_detail['gender']) : form_dropdown('gender', $genderTypes, NULL, 'id="gender"'); ?>
                </td>
                <td>
                    <?php echo $ethinicity; ?>: 
                    <?php echo ($isUpdate) ? form_input(array('name' => 'ethnicity', 'value' => $patient_detail['ethnicity'])) : form_input(array('name'=>'ethnicity','value'=> set_value('ethnicity')))?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $DOB; ?>:
                    <?php echo ($isUpdate) ? form_input(array('name' => 'd_o_b', 'value' => $patient_detail['d_o_b'],'class' => 'datepicker')) : form_input(array('name' => 'd_o_b', 'class' => 'datepicker'))?>

                </td>
                <td>
                    <?php echo $place_of_birth; ?>: 
                    <?php echo ($isUpdate) ? form_input(array('name' => 'place_of_birth', 'value' => $patient_detail['place_of_birth'])) : form_input(array('name'=>'place_of_birth','value'=> set_value('place_of_birth')))?>
                    
                </td>
                <td>
                    <?php echo $marital_status; ?>:
                    <?php echo ($isUpdate) ?  form_dropdown('marital_status',$marital_status_lists, $patient_detail['marital_status']) : form_dropdown('marital_status', $marital_status_lists, NULL, 'id="marital_status"'); ?>                    
                </td>
                <td>
                    <?php echo $blood_group; ?>: 
                    <?php echo ($isUpdate) ? form_input(array('name' => 'blood_group', 'value' => $patient_detail['blood_group'])) : form_input(array('name'=>'blood_group','value'=> set_value('blood_group')))?>                  
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $still_alive_flag; ?>:
                    <?php echo ($isUpdate) ? form_checkbox(array('name' => 'still_alive_flag', 'value' => $patient_detail['is_dead'])) : form_checkbox('still_alive_flag', '1', TRUE)?>                    
                </td>
                <td>
                    <?php echo $DOD; ?>: 
                    <?php echo ($isUpdate) ? form_input(array('name' => 'd_o_d', 'value' => $patient_detail['d_o_d'],'class' => 'datepicker')) : form_input(array('name' => 'd_o_d', 'class' => 'datepicker'))?>
                </td>
                <td>
                    <?php echo $reason_of_death; ?>: 
                    <?php echo ($isUpdate) ? form_textarea(array('name' => 'reason_of_death','id' => 'reason_of_death','rows' => '3','cols' => '7', 'value' => $patient_detail['blood_group'])) : form_textarea(array('name'=>'reason_of_death','id' => 'reason_of_death','rows' => '3','cols' => '7','value'=> set_value('reason_of_death')))?>                                      
                </td>
            </tr>
        </table>
    </div>
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
                <?php echo ($isUpdate) ? form_input(array('name' => 'hospital_no', 'value' => @$patient_hospital_no['hospital_no'])) : form_input('hospital_no')?>
                </td>
                <td>
                    <input type="button" value="Add Hospital No." onClick="window.parent.addHospitalNoInput('add_record_form_section_personal2');
                                        window.parent.calcHeight();">
                </td>
            </tr>
        </table>
    </div>
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
                    <?php echo ($isUpdate) ? form_input(array('name' => 'private_patient_no', 'value' => @$patient_private_no['private_patient_no'])) : form_input('private_patient_no')?>
                </td>
                <td>
                    <input type="button" value="Add patient no." onClick="window.parent.addPatientPrivateNoInput('add_record_form_section_personal3');
                                        window.parent.calcHeight();">
                </td>
            </tr>
        </table>
    </div>
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
                    <?php echo ($isUpdate) ?  form_dropdown('COGS_study_id',$COGS_study_id_lists, $patient_cogs_studies['COGS_studies_id']) : form_dropdown('COGS_study_id', $COGS_study_id_lists, NULL, 'id="COGS_study_id"'); ?>                    
                </td>
                <td>
                    <?php echo 'Study no'; ?>: 
                    <?php echo ($isUpdate) ? form_input(array('name' => 'COGS_studies_no', 'value' => $patient_cogs_studies['COGS_studies_no'])) : form_input('COGS_studies_no')?>                    
                </td>
                <td>
                    <input type="button" value="Add" onClick="window.parent.addPatientStudyNoInput('add_record_form_section_personal6');
                                        window.parent.calcHeight();">
                </td>
            </tr>
        </table>
    </div>
    <div class="container" id="add_record_form_section_personal4">
        <div height="30px">&nbsp;</div>
        <table>
            <tr>
                <td>
                    <?php echo $is_blood_card_exist; ?>: 
                    <?php echo ($isUpdate) ? form_checkbox(array('name' => 'is_blood_card_exist', 'value' => $patient_detail['blood_card'])) : form_checkbox('is_blood_card_exist', '1', TRUE)?>                    
                </td>
                <td>
                    <?php echo $blood_card_location; ?>: 
                    <?php echo ($isUpdate) ? form_input(array('name' => 'blood_card_location', 'value' => $patient_detail['blood_card_location'])) : form_input('blood_card_location')?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $address; ?>: 
                    <?php echo ($isUpdate) ? form_textarea(array('name' => 'address','id' => 'address','rows' => '5','cols' => '10', 'value' => $patient_detail['address'])) : form_textarea(array('name'=>'address','id' => 'address','rows' => '5','cols' => '10'))?>                                      
                </td>
                <td>
                    <?php echo $home_phone; ?>: 
                    <?php echo ($isUpdate) ? form_input(array('name' => 'home_phone', 'value' => $patient_detail['home_phone'])) : form_input('home_phone')?>
                </td>
                <td>
                    <?php echo $cell_phone; ?>: 
                    <?php echo ($isUpdate) ? form_input(array('name' => 'cell_phone', 'value' => $patient_detail['cell_phone'])) : form_input('cell_phone')?>
                </td>
                <td>
                    <?php echo $work_phone; ?>: 
                    <?php echo ($isUpdate) ? form_input(array('name' => 'work_phone', 'value' => $patient_detail['work_phone'])) : form_input('work_phone')?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $other_phone; ?>: 
                    <?php echo ($isUpdate) ? form_input(array('name' => 'other_phone', 'value' => $patient_detail['other_phone'])) : form_input('other_phone')?>                    
                </td>
                <td>
                    <?php echo $fax; ?>: 
                    <?php echo ($isUpdate) ? form_input(array('name' => 'fax', 'value' => $patient_detail['fax'])) : form_input('fax')?>                                        
                </td>
                <td>
                    <?php echo $email; ?>: 
                    <?php echo ($isUpdate) ? form_input(array('name' => 'email', 'value' => $patient_detail['email'])) : form_input('email')?>                                        
                </td>
                <td>
                    <?php echo $highest_level_of_education; ?>: 
                    <?php echo ($isUpdate) ? form_textarea(array('name' => 'highest_level_of_education','id' => 'highest_level_of_education','rows' => '3','cols' => '7', 'value' => $patient_detail['highest_education_level'])) : form_textarea(array('name'=>'highest_level_of_education','id' => 'highest_level_of_education','rows' => '3','cols' => '7'))?>                                      
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $height; ?>: 
                    <?php echo ($isUpdate) ? form_input(array('name' => 'height', 'value' => $patient_detail['height'])) : form_input('height')?>                                                            
                </td>
                <td>
                    <?php echo $weight; ?>: 
                    <?php echo ($isUpdate) ? form_input(array('name' => 'weight', 'value' => $patient_detail['weight'])) : form_input('weight')?>                                                            
                </td>
                <td>
                    <?php echo $BMI; ?>: 
                    <?php echo ($isUpdate) ? form_input(array('name' => 'BMI', 'value' => $patient_detail['bmi'])) : form_input('BMI')?>                                                            
                </td>
                <td>
                    <?php echo $income_level; ?>:
                    <?php echo ($isUpdate) ?  form_dropdown('income_level',$income_level_lists, $patient_detail['income_level']) : form_dropdown('income_level', $income_level_lists, NULL, 'id="income_level"'); ?>                                        
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $contact_person_name; ?>: 
                    <?php echo ($isUpdate) ? form_input(array('name' => 'contact_person_name', 'value' => $patient_contact_person['contact_name'])) : form_input('contact_person_name')?>                    
                </td>
                <td>
                    <?php echo $contact_person_phone_number; ?>: 
                    <?php echo ($isUpdate) ? form_input(array('name' => 'contact_person_phone_number', 'value' => $patient_contact_person['contact_telephone'])) : form_input('contact_person_phone_number')?>                    
                </td>
                <td>
                    <?php echo $contact_person_relationship; ?>: 
                    <?php echo ($isUpdate) ? form_input(array('name' => 'contact_person_relationship', 'value' => $patient_contact_person['contact_relationship'])) : form_input('contact_person_relationship')?>                    
                </td>
                <td>
                    <?php echo $patient_comments; ?>: 
                    <?php echo ($isUpdate) ? form_textarea(array('name' => 'patient_comments','id' => 'patient_comments','rows' => '3','cols' => '7', 'value' => $patient_detail['comment'])) : form_textarea(array('name'=>'patient_comments','id' => 'patient_comments','rows' => '3','cols' => '7'))?>                                      
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
                    <?php echo ($isUpdate) ? form_input(array('name' => 'total_no_of_male_siblings', 'value' => $patient_relatives_summary['total_no_of_male_siblings'])) : form_input('total_no_of_male_siblings')?>                    
                </td>
                <td>
                    <?php echo $total_no_of_female_siblings; ?>:
                    <?php echo ($isUpdate) ? form_input(array('name' => 'total_no_of_female_siblings', 'value' => $patient_relatives_summary['total_no_of_female_siblings'])) : form_input('total_no_of_female_siblings')?>                    
                </td>
                <td>
                    <?php echo $total_no_of_affected_siblings; ?>:
                    <?php echo ($isUpdate) ? form_input(array('name' => 'total_no_of_affected_siblings', 'value' => $patient_relatives_summary['total_no_of_affected_siblings'])) : form_input('total_no_of_affected_siblings')?>                                        
                </td>
                <td>
                    <?php echo $total_no_of_siblings; ?>:
                    <?php echo ($isUpdate) ? form_input(array('name' => 'total_no_of_siblings', 'value' => $patient_relatives_summary['total_no_of_siblings'])) : form_input('total_no_of_siblings')?>                                                            
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $total_no_male_children; ?>:
                    <?php echo ($isUpdate) ? form_input(array('name' => 'total_no_male_children', 'value' => $patient_relatives_summary['total_no_of_male_children'])) : form_input('total_no_male_children')?>                                                                                
                </td>
                <td>
                    <?php echo $total_no_female_children; ?>:
                    <?php echo ($isUpdate) ? form_input(array('name' => 'total_no_female_children', 'value' => $patient_relatives_summary['total_no_of_female_children'])) : form_input('total_no_female_children')?>                                                                                                    
                </td>
                <td>
                    <?php echo $total_no_of_affected_children; ?>:
                    <?php echo ($isUpdate) ? form_input(array('name' => 'total_no_of_affected_children', 'value' => $patient_relatives_summary['total_no_of_affected_children'])) : form_input('total_no_of_affected_children')?>                                                                                                                        
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $total_no_of_first_degree; ?>:
                    <?php echo ($isUpdate) ? form_input(array('name' => 'total_no_of_first_degree', 'value' => $patient_relatives_summary['total_no_of_1st_degree'])) : form_input('total_no_of_first_degree')?>                                                                                                                        
                </td>
                <td>
                    <?php echo $total_no_of_second_degree; ?>:
                    <?php echo ($isUpdate) ? form_input(array('name' => 'total_no_of_second_degree', 'value' => $patient_relatives_summary['total_no_of_2nd_degree'])) : form_input('total_no_of_second_degree')?>                                                                                                                        
                </td>
                <td>
                    <?php echo $total_no_of_third_degree; ?>:
                    <?php echo ($isUpdate) ? form_input(array('name' => 'total_no_of_third_degree', 'value' => $patient_relatives_summary['total_no_of_3rd_degree'])) : form_input('total_no_of_third_degree')?>                                                                                                                        
                </td>
                <td>&nbsp;</td>
            </tr>
        </table>
    </div>

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
                    <?php echo ($isUpdate) ?  form_dropdown('status_source',$status_source_lists, $patient_survival_status['source']) : form_dropdown('status_source', $status_source_lists, NULL, 'id="status_source"'); ?>                                                            
                </td>
                <td>
                    <?php echo $alive_status; ?>:
                    <?php echo ($isUpdate) ?  form_dropdown('alive_status',$alive_status_lists, $patient_survival_status['alive_status']) : form_dropdown('alive_status', $alive_status_lists, NULL, 'id="alive_status"'); ?>                                                            
                </td>
                <td>
                    <?php echo $status_gathered_date; ?>: 
                    <?php echo form_input(array('name' => 'status_gathered_date', 'class' => 'datepicker')); ?>
                </td>
                <td>
                    <input type="button" value="Add more survival status" onClick="window.parent.addSurvivalStatusInput('add_record_form_section_personal_5');
                            window.parent.calcHeight();">
                </td>
            </tr>
        </table>
    </div>
    <div class="container" id="add_consent_details_section">
        <div height="30px">&nbsp;</div>
        <?php
        echo form_fieldset('Consent Details');
        ?>
        <table>
            <tr>
                <td>
                    <?php echo $studies_name; ?>:
                    <?php echo ($isUpdate) ?  form_dropdown('studies_name',$studies_name_lists, $patient_consent_detail['studies_id']) : form_dropdown('studies_name', $studies_name_lists, NULL, 'id="studies_name"'); ?>                                                                                
                </td>
                <td>
                    <?php echo $date_at_consent; ?>:
                    <?php echo ($isUpdate) ? form_input(array('name' => 'date_at_consent', 'value' => $patient_consent_detail['date_at_consent'],'class' => 'datepicker')) : form_input(array('name' => 'date_at_consent', 'class' => 'datepicker'))?>                    
                </td>
                <td>
                    <?php echo $age_at_consent; ?>: 
                    <?php echo ($isUpdate) ? form_input(array('name' => 'age_at_consent', 'value' => $patient_consent_detail['age_at_consent'])) : form_input(array('name'=>'age_at_consent'))?>                    
                </td>
                <td>
                    <?php echo $is_double_consent_flag; ?>: 
                    <?php echo ($isUpdate) ? form_checkbox(array('name' => 'is_double_consent_flag', 'value' => $patient_consent_detail['double_consent_flag'])) : form_checkbox('is_double_consent_flag', '1', FALSE)?>                    
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $consent_given_by; ?>: 
                    <?php echo ($isUpdate) ? form_input(array('name' => 'consent_given_by', 'value' => $patient_consent_detail['consent_given_by'])) : form_input(array('name'=>'consent_given_by'))?>                   
                </td>
                <td>
                    <?php echo $consent_response; ?>: 
                    <?php echo ($isUpdate) ? form_input(array('name' => 'consent_response', 'value' => $patient_consent_detail['consent_response'])) : form_input(array('name'=>'consent_response'))?>
                </td>
                <td>
                    <?php echo $consent_version; ?>: 
                    <?php echo ($isUpdate) ? form_input(array('name' => 'consent_version', 'value' => $patient_consent_detail['consent_version'])) : form_input(array('name'=>'consent_version'))?>
                </td>
                <td>
                    <?php echo $relations_to_study; ?>: 
                    <?php echo ($isUpdate) ? form_input(array('name' => 'relations_to_study', 'value' => $patient_consent_detail['relation_to_study'])) : form_input(array('name'=>'relations_to_study'))?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $referral_to; ?>: 
                    <?php echo ($isUpdate) ? form_input(array('name' => 'referral_to', 'value' => $patient_consent_detail['referral_to'])) : form_input(array('name'=>'referral_to'))?>                    
                </td>
                <td>
                    <?php echo $referral_date; //referral to genetic counselling ?>:
                    <?php echo ($isUpdate) ? form_input(array('name' => 'referral_date', 'value' => $patient_consent_detail['referral_to_genetic_counselling'],'class' => 'datepicker')) : form_input(array('name' => 'referral_date', 'class' => 'datepicker'))?>                                        
                </td>
                <td>
                    <?php echo $referral_source; ?>: 
                    <?php echo ($isUpdate) ? form_input(array('name' => 'referral_source', 'value' => $patient_consent_detail['referral_source'])) : form_input(array('name'=>'referral_source'))?>                    
                </td>
            </tr>
        </table>
        <?php echo form_fieldset_close(); ?>	
    </div>
    <?php echo form_submit('mysubmit', 'Save'); ?>
    <?php echo form_close(); ?>
</div>




