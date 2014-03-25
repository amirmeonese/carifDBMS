<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>View Family</p>
    </div>
	
    <?php 
	$attributes = array('id' => 'family-details-form');
	echo form_open("record/patient_family_record_update", $attributes);
	?>
	 <div class="container" id="add_record_form_section_1">
        <div height="30px">&nbsp;</div>
		 <div height="30px">&nbsp;</div>
        <?php foreach ($patient_family_mother as $list): ?>
        <?php
        echo form_fieldset('Mother');
        ?>
        <table>
            <tr>
                <td>
                    <label for="IC_no"><?php echo $mother_fullname; ?>: </label>
                    <?php echo form_input(array('name' => 'mother_fullname[]', 'value' => $list['full_name']))?>
                </td>
                <td>
                    <?php echo $mother_maiden_name; ?>: 
                    <?php echo form_input(array('name' => 'mother_maiden_name[]', 'value' => $list['maiden_name']))?>
                </td>
                <?php if($list['is_adopted'] == 1){?>
               <td>
                    <?php echo $mother_unknown_reason_is_adopted; ?>: 
               <input type="checkbox" name="mother_unknown_reason_is_adopted[]" checked="checked" value="<?php print $list['patient_relatives_id']; ?>" /> 
               </td>
               <?php } else {?>
                <td>
                    <?php echo $mother_unknown_reason_is_adopted; ?>: 
                <input type="checkbox" name="mother_unknown_reason_is_adopted[]" value="<?php print $list['patient_relatives_id']; ?>" />
                </td>
               <?php } ?>
               
                   <?php if($list['is_in_other_country'] == 1){?>
                <td>
                    <?php echo $mother_unknown_reason_in_other_countries; ?>: 
                <input type="checkbox" name="mother_unknown_reason_in_other_countries[]" checked="checked" value="<?php print $list['patient_relatives_id']; ?>" />
                </td>
               <?php } else {?>
                <td>
                    <?php echo $mother_unknown_reason_in_other_countries; ?>: 
                <input type="checkbox" name="mother_unknown_reason_in_other_countries[]" value="<?php print $list['patient_relatives_id']; ?>" />
                </td>
               <?php } ?>
            </tr>
            <tr>
                <td>
                    <?php echo $mother_ethnicity; ?>: 
                    <?php echo form_input(array('name' => 'mother_ethnicity[]', 'value' => $list['ethnicity']))?>
                </td>
                <td>
                    <?php echo $mother_town_residence; ?>: 
                    <?php echo form_input(array('name' => 'mother_town_residence[]', 'value' => $list['town_of_residence']))?>
                </td>
                <td>
                    <?php echo $mother_DOB; ?>: 
                    <?php echo form_input(array('name' => 'mother_DOB[]', 'value' => $list['d_o_b'] == '0000-00-00' ? '00-00-0000'  : date('d-m-Y', strtotime($list['d_o_b'])),'class'=>'datepicker'))?>
                </td>
                <?php if($list['is_alive_flag'] == 1){?>
                 <td>
                    <?php echo $mother_still_alive_flag; ?>: 
                    <input type="checkbox" name="mother_still_alive_flag[]" checked="checked" value="<?php print $list['patient_relatives_id']; ?>" />
                </td>
               <?php } else {?>
                <td>
                    <?php echo $mother_still_alive_flag; ?>: 
                    <input type="checkbox" name="mother_still_alive_flag[]" value="<?php print $list['patient_relatives_id']; ?>" />
                </td>
               <?php } ?>
            </tr>
            <tr>
                <td>
                    <?php echo $mother_DOD; ?>: 
		    <?php echo form_input(array('name'=>'mother_DOD[]','value' => $list['d_o_d'] == '0000-00-00' ? '00-00-0000'  : date('d-m-Y', strtotime($list['d_o_d'])),'class'=>'datepicker')); ?>
                </td>
                 <?php if($list['is_cancer_diagnosed'] == 1){?>
                 <td>
                    <?php echo $mother_is_cancer_diagnosed; ?>: 
                <input type="checkbox" name="mother_is_cancer_diagnosed[]" checked="checked" value="<?php print $list['patient_relatives_id']; ?>" />
                 </td>
               <?php } else {?>
                <td>
                    <?php echo $mother_is_cancer_diagnosed; ?>: 
                <input type="checkbox" name="mother_is_cancer_diagnosed[]" value="<?php print $list['patient_relatives_id']; ?>" />
                </td>
               <?php } ?>
            </tr>
        </table>
        </div>
        <div class="container" id="add_record_mother_cancer_record_1">
        <div height="30px">&nbsp;</div>
		<table>
                    <tr>
				 <td>
                    <?php echo $mother_cancer_name; ?>: 
                    <?php echo form_dropdown('mother_cancer_name[]', $patient_cancer_name_lists, $cancer_name[$list['cancer_type_id']], 'id="patient_cancer_name_lists" preload_val="'.$cancer_name[$list['cancer_type_id']].'"'); ?>
                </td>  
<!--				<td>
                    <?php echo $mother_other_cancer_name; ?>: 
                    <?php echo form_input('mother_other_cancer_name[]'); ?>

                </td>				-->
				 <td>
                    <?php echo $mother_date_of_diagnosis; ?>: 
                    <?php echo form_input(array('name' => 'mother_date_of_diagnosis[]', 'value' => $list['date_of_diagnosis'] == '0000-00-00' ? '00-00-0000'  : date('d-m-Y', strtotime($list['date_of_diagnosis'])),'class'=>'datepicker'))?>
                </td>
                <td>
                    <?php echo $mother_age_of_diagnosis; ?>: 
                    <?php echo form_input(array('name' => 'mother_age_of_diagnosis[]', 'value' => $list['age_of_diagnosis']))?>
                </td>
                <td>
                    <?php echo $mother_diagnosis_other_details; ?>: 
                    <?php echo form_textarea(array('name' => 'mother_diagnosis_other_details[]','id' => 'mother_diagnosis_other_details','rows' => '3','cols' => '7', 'value' => $list['other_detail']))?> 
                </td>
              </tr>
            <tr>
            
            </tr>
            </table>
        </div>
        <div class="container" id="add_record_form_section_3">
        <div height="30px">&nbsp;</div>
         <table>
			<tr>
				<td>
                    <?php echo $mother_no_of_brothers; ?>: 
                    <?php echo form_input(array('name' => 'mother_no_of_brothers[]', 'value' => $list['no_of_brothers']))?>
                </td>
                <td>
                    <?php echo $mother_no_of_sisters; ?>: 
                    <?php echo form_input(array('name' => 'mother_no_of_sisters[]', 'value' => $list['no_of_sisters']))?>
                </td>
				<td>
                    <?php echo $mother_no_of_half_brothers; ?>: 
                    <?php echo form_input(array('name' => 'mother_no_of_half_brothers[]', 'value' => $list['total_half_brothers']))?>
                </td>
                <td>
                    <?php echo $mother_no_of_half_sisters; ?>: 
                    <?php echo form_input(array('name' => 'mother_no_of_half_sisters[]', 'value' => $list['total_half_sisters']))?>
                </td>
			</tr>
            <tr>
                <td>
                    <?php echo $mother_vital_status; ?>: 
                    <?php echo form_input(array('name' => 'mother_vital_status[]', 'value' => $list['vital_status']))?>
                </td>
		<td>
                    <?php echo $mother_comments; ?>: 
                    <?php echo form_textarea(array('name' => 'mother_comments[]','id' => 'mother_comments','rows' => '5','cols' => '10', 'value' => $list['comments']))?> 
                </td>
                </td>
            </tr>
            <input type="hidden" name="mother_relatives_id[]" value="<?php print $list['patient_relatives_id']; ?>"/>
        </table>
        <?php endforeach; ?>
    </div>
    <div class="container" id="add_record_form_section_2">
        <div height="30px">&nbsp;</div>
        <?php foreach ($patient_family_father as $father): ?>
        <?php
        echo form_fieldset('Father');
        ?>
        <table>
            <tr>
                <td>
                    <?php echo $father_fullname; ?>: 
                    <?php echo form_input(array('name' => 'father_fullname[]', 'value' => $father['full_name']))?>
                </td>
                <td>
                    <?php echo $father_maiden_name; ?>: 
                    <?php echo form_input(array('name' => 'father_maiden_name[]', 'value' => $father['maiden_name']))?>
                </td>
                <?php if($father['is_adopted'] == 1){?>
                <td>
                    <?php echo $father_unknown_reason_is_adopted; ?>: 
                <input type="checkbox" name="father_unknown_reason_is_adopted[]" checked="checked" value="<?php print $father['patient_relatives_id']; ?>" />
                </td>
               <?php } else {?>
                <td>
                    <?php echo $father_unknown_reason_is_adopted; ?>: 
                <input type="checkbox" name="father_unknown_reason_is_adopted[]" value="<?php print $father['patient_relatives_id']; ?>" />
                </td>
               <?php } ?>
                <?php if($father['is_in_other_country'] == 1){?>
                <td>
                    <?php echo $father_unknown_reason_in_other_countries; ?>: 
                <input type="checkbox" name="father_unknown_reason_in_other_countries[]" checked="checked" value="<?php print $father['patient_relatives_id']; ?>" />
                </td>
               <?php } else {?>
                <td>
                    <?php echo $father_unknown_reason_in_other_countries; ?>: 
                <input type="checkbox" name="father_unknown_reason_in_other_countries[]" value="<?php print $father['patient_relatives_id']; ?>" />
                </td>
               <?php } ?>
            </tr>
            <tr>
                <td>
                    <?php echo $father_ethnicity; ?>: 
                    <?php echo form_input(array('name' => 'father_ethncity[]', 'value' => $father['ethnicity']))?>
                </td>
                <td>
                    <?php echo $father_town_residence; ?>: 
                    <?php echo form_input(array('name' => 'father_town_residence[]', 'value' => $father['town_of_residence']))?>
                </td>
                <td>
                    <?php echo $father_DOB; ?>: 
                    <?php echo form_input(array('name' => 'father_DOB[]', 'value' => $father['d_o_b'] == '0000-00-00' ? '00-00-0000'  : date('d-m-Y', strtotime($father['d_o_b'])),'class'=>'datepicker'))?>
                </td>
                <?php if($list['is_alive_flag'] == 1){?>
                <td>
                    <?php echo $father_still_alive_flag; ?>: 
                <input type="checkbox" name="father_still_alive_flag[]" checked="checked" value="<?php print $father['patient_relatives_id']; ?>" />
                </td>
               <?php } else {?>
                <td>
                    <?php echo $father_still_alive_flag; ?>: 
                <input type="checkbox" name="father_still_alive_flag[]" value="<?php print $father['patient_relatives_id']; ?>" />
                </td>
               <?php } ?>
            </tr>
            <tr>
                <td>
                    <?php echo $father_DOD; ?>: 
                    <?php echo form_input(array('name' => 'father_DOD[]', 'value' => $father['d_o_d'] == '0000-00-00' ? '00-00-0000'  : date('d-m-Y', strtotime($father['d_o_d'])),'class'=>'datepicker'))?>
                </td>
                <?php if($father['is_cancer_diagnosed'] == 1){?>
                <td>
                    <?php echo $father_is_cancer_diagnosed; ?>: 
                <input type="checkbox" name="father_is_cancer_diagnosed[]" checked="checked" value="<?php print $father['patient_relatives_id']; ?>" />
                </td>
               <?php } else {?>
               <td>
                    <?php echo $father_is_cancer_diagnosed; ?>: 
               <input type="checkbox" name="father_is_cancer_diagnosed[]" value="<?php print $father['patient_relatives_id']; ?>" /> 
               </td>
               <?php } ?>
            </tr>
            </table>
        </div>
        <div class="container" id="add_record_father_cancer_record_1">
        <div height="30px">&nbsp;</div>
		<table>
            <tr>
				 <td>
                    <?php echo $father_cancer_name; ?>: 
                    <?php echo form_dropdown('father_cancer_name[]', $patient_cancer_name_lists, $cancer_name[$father['cancer_type_id']], 'id="patient_cancer_name_lists" preload_val="'.$cancer_name[$father['cancer_type_id']].'"'); ?>
<!--                </td>
				 <td>
                    <?php echo $father_other_cancer_name; ?>: 
                    <?php echo form_input(array('name' => 'father_other_cancer_name[]', 'value' => $father['other_cancer_name']))?>
                </td>-->
               <td>
                    <?php echo $father_date_of_diagnosis; ?>: 
                    <?php echo form_input(array('name' => 'father_date_of_diagnosis[]', 'value' => $father['date_of_diagnosis'] == '0000-00-00' ? '00-00-0000'  : date('d-m-Y', strtotime($father['date_of_diagnosis'])),'class'=>'datepicker'))?>

               </td>
                <td>
                    <?php echo $father_age_of_diagnosis; ?>: 
                    <?php echo form_input(array('name' => 'father_age_of_diagnosis[]', 'value' => $father['age_of_diagnosis']))?>
                </td>
                <td>
                    <?php echo $father_diagnosis_other_details; ?>: 
                    <?php echo form_textarea(array('name' => 'father_diagnosis_other_details[]','id' => 'father_diagnosis_other_details','rows' => '3','cols' => '7', 'value' => $father['other_detail']))?> 
                </td>
            </tr>
            <tr>
            
            </tr>
        </table>
        </div>
        <div class="container" id="add_record_form_section_4">
        <div height="30px">&nbsp;</div>
         <table>
            <tr>
                <td>
                    <?php echo $father_no_of_brothers; ?>: 
                    <?php echo form_input(array('name' => 'father_no_of_brothers[]', 'value' => $father['no_of_brothers']))?>
                </td>
                <td>
                    <?php echo $father_no_of_sisters; ?>: 
                    <?php echo form_input(array('name' => 'father_no_of_sisters[]', 'value' => $father['no_of_sisters']))?>
                </td>
                <td>
                    <?php echo $father_no_of_half_brothers; ?>: 
                    <?php echo form_input(array('name' => 'father_no_of_half_brothers[]', 'value' => $father['total_half_brothers']))?>
                </td>
                <td>
                    <?php echo $father_no_of_half_sisters; ?>: 
                    <?php echo form_input(array('name' => 'father_no_of_half_sisters[]', 'value' => $father['total_half_sisters']))?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $father_vital_status; ?>: 
                    <?php echo form_input(array('name' => 'father_vital_status[]', 'value' => $father['vital_status']))?>
                </td>
				<td>
                                    <?php echo $father_comments; ?>: 
                    <?php echo form_textarea(array('name' => 'father_comments[]','id' => 'father_comments','rows' => '5','cols' => '10', 'value' => $father['comments']))?> 
                </td>
            </tr>
            <input type="hidden" name="patient_ic_no" value="<?php print $father['patient_ic_no']; ?>"/>
            <input type="hidden" name="father_relatives_id[]" value="<?php print $father['patient_relatives_id']; ?>"/>
        </table>
        <?php echo form_fieldset_close(); ?>
        <?php endforeach; ?>
    </div>
    <div class="container" id="add_record_form_section_2">
        <div height="30px">&nbsp;</div>
        <?php foreach ($patient_family_others as $others): ?>
        <?php
        echo form_fieldset('Others');
        ?>
        <table>
            <tr>
                <?php if($others['is_paternal'] == 1){?>
                <td>
                    <?php echo 'Paternal/Maternal status' ?>: 
                    <?php echo form_dropdown('paternal_status[]', $paternal_status, 'paternal', 'id="paternal_status" preload_val="'."paternal".'"'); ?>
                </td>
                <?php } if($others['is_maternal'] == 1) {?>
                <td>
                    <?php echo 'Paternal/Maternal status' ?>: 
                    <?php echo form_dropdown('paternal_status[]', $paternal_status, 'maternal', 'id="paternal_status" preload_val="'.'maternal'.'"'); ?>
                </td>
                <?php } if($others['is_paternal'] == 0 && ($others['is_maternal'] == 0)) {?>
                <td>
                    <?php echo 'Paternal/Maternal status' ?>: 
                    <?php echo form_dropdown('paternal_status[]', $paternal_status, NULL, 'id="paternal_status" preload_val="'.NULL.'"'); ?>
                </td>
                <?php } ?>
                <td>
                    <?php echo 'Relationship' ?>: 
                    <?php echo form_dropdown('relativeTypeLists[]', $relationship, $others['relatives_id'], 'id="relativeTypeLists" preload_val="'.$others['relatives_id'].'"'); ?>
                </td>
                <td>
                    <?php echo 'Degree of relativeness' ?>: 
                    <?php echo form_dropdown('degreeOfRelativeness[]', $relative_degrees, $others['degree_of_relativeness'], 'id="degreeOfRelativeness" preload_val="'.$others['degree_of_relativeness'].'"'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $father_fullname; ?>: 
                    <?php echo form_input(array('name' => 'relative_fullname[]', 'value' => $others['full_name']))?>
                </td>
                <td>
                    <?php echo $father_maiden_name; ?>: 
                    <?php echo form_input(array('name' => 'relative_maiden_name[]', 'value' => $others['maiden_name']))?>
                </td>
                <td>
                    <?php echo 'Gender' ?>: 
                <?php echo form_dropdown('relative_gender[]', $genderTypes, $others['sex'], 'id="gender" preload_val="'.$others['sex'].'"'); ?>
                
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $father_ethnicity; ?>: 
                    <?php echo form_input(array('name' => 'relative_ethnicity[]', 'value' => $others['ethnicity']))?>
                </td>
                <td>
                    <?php echo $father_town_residence; ?>: 
                    <?php echo form_input(array('name' => 'relative_town_residence[]', 'value' => $others['town_of_residence']))?>
                </td>
                <td>
                    <?php echo $father_DOB; ?>: 
                    <?php echo form_input(array('name' => 'relative_DOB[]', 'value' => $others['d_o_b'] == '0000-00-00' ? '00-00-0000'  : date('d-m-Y', strtotime($others['d_o_b'])),'class'=>'datepicker'))?>
                </td>
                </tr>
                <tr>
                <?php if($others['is_alive_flag'] == 1){?>
                <td>
                    <?php echo $father_still_alive_flag; ?>:
                    <input type="checkbox" name="relative_still_alive_flag[]" checked="checked" value="<?php print $others['patient_relatives_id']; ?>" />
                </td>
               <?php } else {?>
                <td>
                    <?php echo $father_still_alive_flag; ?>: 
                    <input type="checkbox" name="relative_still_alive_flag[]" value="<?php print $others['patient_relatives_id']; ?>" />
                </td>
               <?php } ?>
                <td>
                    <?php echo $father_DOD; ?>: 
                    <?php echo form_input(array('name' => 'relative_DOD[]', 'value' => $others['d_o_d'] == '0000-00-00' ? '00-00-0000'  : date('d-m-Y', strtotime($others['d_o_d'])),'class'=>'datepicker'))?>
                </td>
                <?php if($others['is_cancer_diagnosed'] == 1){?>
                <td>
                    <?php echo $father_is_cancer_diagnosed; ?>: 
                    <input type="checkbox" name="relative_is_cancer_diagnosed[]" checked="checked" value="<?php print $others['patient_relatives_id']; ?>" />
                </td>
               <?php } else {?>
               <td>
                    <?php echo $father_is_cancer_diagnosed; ?>:
                    <input type="checkbox" name="relative_is_cancer_diagnosed[]"  value="<?php print $others['patient_relatives_id']; ?>" />
                </td>
               <?php } ?>
            </tr>
            </table>
        </div>
        <div class="container" id="add_record_father_cancer_record_1">
        <div height="30px">&nbsp;</div>
		<table>
            <tr>
				 <td>
                    <?php echo $father_cancer_name; ?>: 
                    <?php echo form_dropdown('relative_cancer_name[]', $patient_cancer_name_lists, $cancer_name[$others['cancer_type_id']], 'id="patient_cancer_name_lists" preload_val="'.$cancer_name[$others['cancer_type_id']].'"'); ?>
               <td>
                    <?php echo $father_date_of_diagnosis; ?>: 
                    <?php echo form_input(array('name' => 'relative_date_of_diagnosis[]', 'value' => $others['date_of_diagnosis'] == '0000-00-00' ? '00-00-0000'  : date('d-m-Y', strtotime($others['date_of_diagnosis'])),'class'=>'datepicker'))?>

               </td>
                <td>
                    <?php echo $father_age_of_diagnosis; ?>: 
                    <?php echo form_input(array('name' => 'relative_age_of_diagnosis[]', 'value' => $others['age_of_diagnosis']))?>
                </td>
            </tr>
            <tr>
            
            </tr>
        </table>
        </div>
        <div class="container" id="add_record_form_section_4">
        <div height="30px">&nbsp;</div>
         <table>
            <tr>
                <td>
                    <?php echo $father_vital_status; ?>: 
                    <?php echo form_input(array('name' => 'relative_vital_status[]', 'value' => $others['vital_status']))?>
                </td>
				<td>
                    <?php echo $father_comments; ?>: 
                    <?php echo form_textarea(array('name' => 'relative_comment[]','id' => 'relative_comment','rows' => '5','cols' => '10', 'value' => $others['comments']))?> 
                </td>
            </tr>
            <input type="hidden" name="patient_ic_no" value="<?php print $others['patient_ic_no']; ?>"/>
            <input type="hidden" name="others_relatives_id[]" value="<?php print $others['patient_relatives_id']; ?>"/>
        </table>
        <?php echo form_fieldset_close(); ?>
        <?php endforeach; ?>
    </div>
    </br>
           <?php echo form_fieldset_close(); ?>	
            <?php if ($userprivillage['edit_privilege']== 1 && !$isLocked){ ?>
    <?php echo form_submit('mysubmit', 'Update'); ?>
    <?php } else { ?>
    <?php }?>
           <?php echo form_close(); ?>
</div>




