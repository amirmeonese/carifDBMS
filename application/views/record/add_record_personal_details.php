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
                    <?php echo $surname; ?>: 
                    <?php echo form_input('surname'); ?>
                </td>
				<td>
                    <?php echo $fullname; ?>: 
                    <?php echo form_input('fullname'); ?>
                </td>
                
                <td>
                    <?php echo $maiden_name; ?>: 
                    <?php echo form_input('maiden_name'); ?>
                </td>
                <td>
                    <?php echo $family_no; ?>: 
                    <?php echo form_input('family_no'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $nationality; ?>: 
		    <?php echo form_dropdown('nationality', $nationalities, NULL, 'id="nationality"'); ?>
                </td>
                <td>
                    <?php echo $IC_no; ?>: 
                    <?php echo form_input(array('name' => 'IC_no','id'=>'ic_no','onBlur'=>"check_duplicate_ic(this.value);")) ?>
                    <span id="duplicate-ic"></span>
                </td>
                <td>
                    <?php echo $old_IC_no; ?>: 
                    <?php echo form_input(array('name' => 'old_IC_no','id'=>'old_ic_no','onBlur'=>"check_duplicate_oldic(this.value);")) ?>
                    <span id="duplicate-oldic"></span>
                </td>
                <td>
                    <?php echo $gender; ?>: 
                    <?php echo form_dropdown('gender', $genderTypes, NULL, 'id="gender"'); ?>
                </td>
                </tr>
                <tr>
                <td>
                    <?php echo $ethinicity; ?>: 
                    <?php echo form_input('ethnicity'); ?>
                </td>
                <td>
                    <?php echo $DOB; ?>:
                    <?php echo form_input(array('name'=>'d_o_b','class'=>'datepicker')); ?>
                
                </td>
                <td>
                    <?php echo $place_of_birth; ?>: 
                    <?php
                    echo form_input('place_of_birth');
                    ?>
                </td>
                <td>
                    <?php echo $marital_status; ?>: 
                   <?php echo form_dropdown('marital_status', $marital_status_lists, NULL, 'id="marital_status"'); ?>
                </td>
                </tr>
                <tr>
                <td>
                    <?php echo $blood_group; ?>: 
                    <?php echo form_input('blood_group'); ?>
                </td>
                <td>
                    <?php echo $is_dead; ?>: 
                    <?php echo form_checkbox('is_dead', '1', TRUE); ?>
                </td>
                <td>
                    <?php echo $DOD; ?>: 
                    <?php echo form_input(array('name' => 'd_o_d', 'class' => 'datepicker')); ?>
                </td>
                <td>
                    <?php echo $reason_of_death; ?>: 
                    <?php
                    $data = array(
                        'name' => 'reason_of_death',
                        'id' => 'reason_of_death',
                        'rows' => '3',
                        'cols' => '7'
                    );
                    echo form_textarea($data);
                    ?>
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
                                <?php
                                //echo form_textarea
                                echo form_input('hospital_no');
                                ?>
                            </td>
                            <td>
                                <input type="button" value="Add Hospital No." onClick="window.parent.addHospitalNoInput('add_record_form_section_personal2'); window.parent.calcHeight();">
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
                    <?php echo form_dropdown('COGS_study_id', $COGS_study_id_lists, NULL, 'id="COGS_study_id"'); ?>
                </td>
                <td>
					<?php echo 'Study no'; ?>: 
					<?php echo form_input('COGS_studies_no'); ?>
                </td>
                <td>
				<input type="button" value="Add" onClick="window.parent.addPatientStudyNoInput('add_record_form_section_personal6'); window.parent.calcHeight(); applyDynamicDropdown()">
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
                    <?php echo form_checkbox('is_blood_card_exist', '1', TRUE); ?>
                </td>
                <td>
					<?php echo $blood_card_location; ?>: 
					<?php echo form_input('blood_card_location'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $address; ?>: 
                    <?php
                    $data = array(
                        'name' => 'address',
                        'id' => 'address',
                        'rows' => '5',
                        'cols' => '10'
                    );
                    echo form_textarea($data);
                    ?>
                </td>
                <td>
                    <?php echo $home_phone; ?>: 
                    <?php echo form_input('home_phone'); ?>
                </td>
                <td>
                    <?php echo $cell_phone; ?>: 
                    <?php echo form_input('cell_phone'); ?>
                </td>
                <td>
					<?php echo $work_phone; ?>: 
					<?php echo form_input('work_phone'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $other_phone; ?>: 
                    <?php echo form_input('other_phone'); ?>
                </td>
                <td>
                    <?php echo $fax; ?>: 
                    <?php echo form_input('fax'); ?>
                </td>
                <td>
					<?php echo $email; ?>: 
					<?php echo form_input('email'); ?>
                </td>
				 <td>
                    <?php echo $highest_level_of_education; ?>: 
                    <?php
                    $data = array(
                        'name' => 'highest_level_of_education',
                        'id' => 'highest_level_of_education',
                        'rows' => '3',
                        'cols' => '10'
                    );
                    echo form_textarea($data);
                    ?>
                </td>
            </tr>
            <tr>
				<td>
                    <?php echo $weight; ?>: 
                    <?php $data = array(
                        'name' => 'weight',
                        'id' => 'weight',
						'onkeypress' => 'window.parent.auto_calculate_bmi(event);'
                    );
					echo form_input($data); ?>
                </td>
                <td>
                    <?php echo $height; ?>: 
                    <?php $data = array(
                        'name' => 'height',
                        'id' => 'height',
						'onkeypress' => 'window.parent.auto_calculate_bmi(event);'
                    );
					echo form_input($data); ?>
                </td>
                <td>
                    <?php echo $BMI; ?>: 
                    <?php $data = array(
                        'name' => 'BMI',
                        'id' => 'BMI'
                    );
					echo form_input($data); ?>
                </td>
				<td>
                    <?php echo $income_level; ?>: 
                    <?php echo form_dropdown('income_level', $income_level_lists, NULL, 'id="income_level"'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $contact_person_name; ?>: 
                    <?php echo form_input('contact_person_name'); ?>
                </td>
                <td>
                    <?php echo $contact_person_phone_number; ?>: 
                    <?php echo form_input('contact_person_phone_number'); ?>
                </td>
                <td>
                    <?php echo $contact_person_relationship; ?>: 
                    <?php echo form_input('contact_person_relationship'); ?>
                </td>
                <td>
                    <?php echo $patient_comments; ?>: 
                    <?php
                    $data = array(
                        'name' => 'patient_comments',
                        'id' => 'patient_comments',
                        'rows' => '3',
                        'cols' => '7'
                    );
                    echo form_textarea($data);
                    ?>
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
                    <?php $data = array(
                        'name' => 'total_no_of_male_siblings',
                        'id' => 'total_no_of_male_siblings',
						'onkeypress' => 'window.parent.auto_calculate_total_siblings(event);'
                    );
					echo form_input($data); ?>
                </td>
                <td>
                    <?php echo $total_no_of_female_siblings; ?>: 
                    <?php $data = array(
                        'name' => 'total_no_of_female_siblings',
                        'id' => 'total_no_of_female_siblings',
						'onkeypress' => 'window.parent.auto_calculate_total_siblings(event);'
                    );
					echo form_input($data); ?>
                </td>
                <td>
                    <?php echo $total_no_of_affected_siblings; ?>: 
                    <?php echo form_input('total_no_of_affected_siblings'); ?>
                </td>
                <td>
                    <?php echo $total_no_of_siblings; ?>: 
                    <?php $data = array(
                        'name' => 'total_no_of_siblings',
                        'id' => 'total_no_of_siblings'
                    );
					echo form_input($data); ?>
                </td>
                </tr>
                <tr>
                              <td>
                                  <?php echo $total_no_male_children; ?>: 
                                  <?php echo form_input('total_no_male_children'); ?>
                              </td>
                              <td>
                    <?php echo $total_no_female_children; ?>: 
                    <?php echo form_input('total_no_female_children'); ?>
                </td>
				<td>
                    <?php echo $total_no_of_affected_children; ?>: 
                    <?php echo form_input('total_no_of_affected_children'); ?>
				</td>
				<td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $total_no_of_first_degree; ?>: 
                    <?php echo form_input('total_no_of_first_degree'); ?>
                </td>
                <td>
                    <?php echo $total_no_of_second_degree; ?>: 
                    <?php echo form_input('total_no_of_second_degree'); ?>
                </td>
                <td>
                    <?php echo $total_no_of_third_degree; ?>: 
                    <?php echo form_input('total_no_of_third_degree'); ?>
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
                    <?php echo form_dropdown('status_source', $status_source_lists, NULL, 'id="status_source"'); ?>
                </td>
                <td>
                    <?php echo $alive_status; ?>: 
                    <?php echo form_dropdown('alive_status', $alive_status_lists, NULL, 'id="alive_status"'); ?>

                </td>
                <td>
                    <?php echo $status_gathered_date; ?>: 
                    <?php echo form_input(array('name' => 'status_gathered_date', 'class' => 'datepicker')); ?>
                </td>
                <td>
                    <input type="button" value="Add more survival status" onClick="window.parent.addSurvivalStatusInput('add_record_form_section_personal_5');
                            window.parent.calcHeight();applyDynamicDropdown();">
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
                    <?php echo form_dropdown('studies_name', $studies_name_lists, NULL, 'id="studies_name"'); ?>
                </td>
		<td>
                    <?php echo $private_patient_no; ?>: 
                    <?php echo form_input('private_patient_no'); ?>
		</td>
                <td>
                    <?php echo $date_at_consent; ?>: 
					<?php echo form_input(array('name'=>'date_at_consent','class'=>'datepicker')); ?>
                </td>
                <td>
                    <?php echo $age_at_consent; ?>: 
                    <?php echo form_input('age_at_consent'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $is_double_consent_flag; ?>: 
                    <?php echo form_checkbox('is_double_consent_flag', '1', FALSE); ?>
                </td>
                <td>
                    <?php echo $consent_given_by; ?>: 
                    <?php echo form_input('consent_given_by'); ?>
                </td>
                <td>
                    <?php echo $consent_response; ?>: 
                    <?php echo form_input('consent_response'); ?>
                </td>
                <td>
                    <?php echo $consent_version; ?>: 
                    <?php echo form_input('consent_version'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $relations_to_study; ?>: 
                    <?php echo form_input('relations_to_study');?>
                </td>
                <td>
                    <?php echo $referral_to; ?>: 
                    <?php
                    echo form_input('referral_to');
                    ?>
                </td>
                <td>
                    <?php echo $referral_date; //referral to genetic counselling ?>:
                    <?php echo  form_dropdown('referral_date',$referral_to_genetic_counselling, NULL, 'id="referral_to_genetic_counselling"'); ?>
                </td>
                <td>
                    <?php echo $referral_source; ?>: 
                    <?php
                    echo form_input('referral_source');
                    ?>
                </td>
            </tr>
        </table>
        <?php echo form_fieldset_close(); ?>	
    </div>
    <?php if ($userprivillage['add_privilege']== 1){ ?>
    <?php echo form_submit('mysubmit', 'Save'); ?>
    <?php } else { ?>
    <?php }?>
    <?php echo form_close(); ?>
</div>

<script type="text/javascript">
function check_duplicate_ic(ic_no){
    $.post('<?php echo site_url('record/check_duplicate_ic_entry'); ?>', {'ic_no':ic_no}, function(data){
        if (data == 1){
            $("#duplicate-ic").html('IC/Passport Number Already Exist');
            $("#duplicate-ic").attr('class','error');
        } else {
            $("#duplicate-ic").html('');
            $("#duplicate-ic").attr('class','none');
        }
    });

}

function check_duplicate_oldic(old_ic_no){
    $.post('<?php echo site_url('record/check_duplicate_oldic_entry'); ?>', {'old_ic_no':old_ic_no}, function(data){
        if (data == 1){
            $("#duplicate-oldic").html('IC/Passport Number Already Exist');
            $("#duplicate-oldic").attr('class','error');
        } else {
            $("#duplicate-oldic").html('');
            $("#duplicate-oldic").attr('class','none');
        }
    });

}
</script>




