<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>Add Family</p>
    </div>
	
    <?php 
	$attributes = array('id' => 'family-details-form');
	echo form_open("record/patient_family_record_insertion", $attributes);
	?>
	 <div class="container" id="add_record_form_section_1">
        <div height="30px">&nbsp;</div>
		 <div height="30px">&nbsp;</div>
        <?php foreach ($patient_family as $list): ?>
        <?php
        echo form_fieldset('Mother');
        ?>
        <table>
            <tr>
                <td>
                    <label for="IC_no"><?php echo $mother_fullname; ?>: </label>
                    <?php echo form_input(array('name' => 'mother_fullname', 'value' => $list['full_name']))?>
                </td>
                <td>
                    <?php echo $mother_maiden_name; ?>: 
                    <?php echo form_input(array('name' => 'mother_maiden_name', 'value' => $list['maiden_name']))?>
                </td>
				<td>
                    <?php echo $mother_unknown_reason_is_adopted; ?>: 
                    <?php echo form_checkbox(array('name' => 'mother_unknown_reason_is_adopted', 'value' => $list['is_adopted']))?>
                </td>
				 <td>
                    <?php echo $mother_unknown_reason_in_other_countries; ?>: 
                    <?php echo form_checkbox(array('name' => 'mother_unknown_reason_in_other_countries', 'value' => $list['is_in_other_country']))?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $mother_ethnicity; ?>: 
                    <?php echo form_input(array('name' => 'mother_ethnicity', 'value' => $list['ethnicity']))?>
                </td>
                <td>
                    <?php echo $mother_town_residence; ?>: 
                    <?php echo form_input(array('name' => 'mother_town_residence', 'value' => $list['town_of_residence']))?>
                </td>
                <td>
                    <?php echo $mother_DOB; ?>: 
                    <?php echo form_input(array('name' => 'mother_DOB', 'value' => $list['d_o_b'],'class'=>'datepicker'))?>
                </td>
                <td>
                    <?php echo $mother_still_alive_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'mother_still_alive_flag', 'value' => $list['is_alive_flag']))?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $mother_DOD; ?>: 
		    <?php echo form_input(array('name'=>'mother_DOD','value' => $list['d_o_d'],'class'=>'datepicker')); ?>
                </td>
                <td>
                    <?php echo $mother_is_cancer_diagnosed; ?>: 
                    <?php echo form_checkbox(array('name' => 'mother_is_cancer_diagnosed', 'value' => $list['is_cancer_diagnosed']))?>
                </td>
            </tr>
        </table>
        </div>
        <div class="container" id="add_record_mother_cancer_record_1">
        <div height="30px">&nbsp;</div>
		<table>
                    <tr>
				 <td>
                    <?php echo $mother_cancer_name; ?>: 
                    <?php echo form_dropdown('mother_cancer_name', $patient_cancer_name_lists, $list['cancer_type_id']); ?>
                </td>  
<!--				<td>
                    <?php echo $mother_other_cancer_name; ?>: 
                    <?php echo form_input('mother_other_cancer_name'); ?>

                </td>				-->
				 <td>
                    <?php echo $mother_date_of_diagnosis; ?>: 
                    <?php echo form_input(array('name' => 'mother_date_of_diagnosis', 'value' => $list['date_of_diagnosis'],'class'=>'datepicker'))?>
                </td>
                <td>
                    <?php echo $mother_age_of_diagnosis; ?>: 
                    <?php echo form_input(array('name' => 'mother_age_of_diagnosis', 'value' => $list['age_of_diagnosis']))?>
                </td>
                <td>
                    <?php echo $mother_diagnosis_other_details; ?>: 
                    <?php echo form_textarea(array('name' => 'mother_diagnosis_other_details','id' => 'mother_diagnosis_other_details','rows' => '3','cols' => '7', 'value' => $list['other_detail']))?> 
                </td>
              </tr>
            <tr>
            <td>
            <input type="button" value="Add more" onClick="window.parent.addmotherDiagnosisInput('add_record_mother_cancer_record_1');window.parent.calcHeight();"></b
            </td>
            </tr>
            </table>
        </div>
        <div class="container" id="add_record_form_section_3">
        <div height="30px">&nbsp;</div>
         <table>
			<tr>
				<td>
                    <?php echo $mother_no_of_brothers; ?>: 
                    <?php echo form_input(array('name' => 'mother_no_of_brothers', 'value' => $list['no_of_brothers']))?>
                </td>
                <td>
                    <?php echo $mother_no_of_sisters; ?>: 
                    <?php echo form_input(array('name' => 'mother_no_of_sisters', 'value' => $list['no_of_sisters']))?>
                </td>
				<td>
                    <?php echo $mother_no_of_half_brothers; ?>: 
                    <?php echo form_input(array('name' => 'mother_no_of_half_brothers', 'value' => $list['total_half_brothers']))?>
                </td>
                <td>
                    <?php echo $mother_no_of_half_sisters; ?>: 
                    <?php echo form_input(array('name' => 'mother_no_of_half_sisters', 'value' => $list['total_half_sisters']))?>
                </td>
			</tr>
            <tr>
                <td>
                    <?php echo $mother_vital_status; ?>: 
                    <?php echo form_input(array('name' => 'mother_vital_status', 'value' => $list['vital_status']))?>
                </td>
				<td>
                    <?php echo form_textarea(array('name' => 'mother_comments','id' => 'mother_comments','rows' => '5','cols' => '10', 'value' => $patient_detail['comments']))?> 
                </td>
                </td>
            </tr>
        </table>
    </div>
    <div class="container" id="add_record_form_section_2">
        <div height="30px">&nbsp;</div>
        <?php
        echo form_fieldset('Father');
        ?>
        <table>
            <tr>
                <td>
                    <?php echo $father_fullname; ?>: 
                    <?php echo form_input(array('name' => 'father_fullname', 'value' => $list['full_name']))?>
                </td>
                <td>
                    <?php echo $father_maiden_name; ?>: 
                    <?php echo form_input(array('name' => 'father_maiden_name', 'value' => $list['maiden_name']))?>
                </td>
				<td>
                    <?php echo $father_unknown_reason_is_adopted; ?>: 
                    <?php echo form_checkbox(array('name' => 'father_unknown_reason_is_adopted', 'value' => $list['is_adopted']))?>
                </td>
				 <td>
                    <?php echo $father_unknown_reason_in_other_countries; ?>: 
                    <?php echo form_checkbox(array('name' => 'father_unknown_reason_in_other_countries', 'value' => $list['is_in_other_country']))?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $father_ethnicity; ?>: 
                    <?php echo form_input(array('name' => 'father_ethncity', 'value' => $list['ethnicity']))?>
                </td>
                <td>
                    <?php echo $father_town_residence; ?>: 
                    <?php echo form_input(array('name' => 'father_town_residence', 'value' => $list['town_of_residence']))?>
                </td>
                <td>
                    <?php echo $father_DOB; ?>: 
                    <?php echo form_input(array('name' => 'father_DOB', 'value' => $list['d_o_b'],'class'=>'datepicker'))?>
                </td>
				<td>
                    <?php echo $father_still_alive_flag; ?>: 
                    <?php echo form_checkbox(array('name' => 'father_still_alive_flag', 'value' => $list['is_alive_flag']))?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $father_DOD; ?>: 
                    <?php echo form_input(array('name' => 'father_DOD', 'value' => $list['d_o_d'],'class'=>'datepicker'))?>
                </td>
                <td>
                    <?php echo $father_is_cancer_diagnosed; ?>: 
                    <?php echo form_checkbox(array('name' => 'father_is_cancer_diagnosed', 'value' => $list['is_cancer_diagnosed']))?>
                </td>
            </tr>
            </table>
        </div>
        <div class="container" id="add_record_father_cancer_record_1">
        <div height="30px">&nbsp;</div>
		<table>
            <tr>
				 <td>
                    <?php echo $father_cancer_name; ?>: 
                    <?php echo form_dropdown('father_cancer_name', $patient_cancer_name_lists, $list['cancer_type_id']); ?>
<!--                </td>
				 <td>
                    <?php echo $father_other_cancer_name; ?>: 
                    <?php echo form_input(array('name' => 'father_other_cancer_name', 'value' => $list['other_cancer_name']))?>
                </td>-->
               <td>
                    <?php echo $father_date_of_diagnosis; ?>: 
                    <?php echo form_input(array('name' => 'father_date_of_diagnosis', 'value' => $list['date_of_diagnosis'],'class'=>'datepicker'))?>

               </td>
                <td>
                    <?php echo $father_age_of_diagnosis; ?>: 
                    <?php echo form_input(array('name' => 'father_age_of_diagnosis', 'value' => $list['age_of_diagnosis']))?>
                </td>
                <td>
                    <?php echo $father_diagnosis_other_details; ?>: 
                    <?php echo form_textarea(array('name' => 'father_diagnosis_other_details','id' => 'father_diagnosis_other_details','rows' => '3','cols' => '7', 'value' => $patient_detail['other_detail']))?> 
                </td>
            </tr>
            <tr>
            <td>
            <input type="button" value="Add more" onClick="window.parent.addfatherDiagnosisInput('add_record_father_cancer_record_1');window.parent.calcHeight();"></b
            </td>
            </tr>
        </table>
        </div>
        <div class="container" id="add_record_form_section_4">
        <div height="30px">&nbsp;</div>
         <table>
            <tr>
                <td>
                    <?php echo $father_no_of_brothers; ?>: 
                    <?php echo form_input(array('name' => 'father_no_of_brothers', 'value' => $list['no_of_brothers']))?>
                </td>
                <td>
                    <?php echo $father_no_of_sisters; ?>: 
                    <?php echo form_input(array('name' => 'father_no_of_sisters', 'value' => $list['no_of_sisters']))?>
                </td>
                <td>
                    <?php echo $father_no_of_half_brothers; ?>: 
                    <?php echo form_input(array('name' => 'father_no_of_half_brothers', 'value' => $list['total_half_brothers']))?>
                </td>
                <td>
                    <?php echo $father_no_of_half_sisters; ?>: 
                    <?php echo form_input(array('name' => 'father_no_of_half_sisters', 'value' => $list['total_half_sisters']))?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $father_vital_status; ?>: 
                    <?php echo form_input(array('name' => 'father_vital_status', 'value' => $list['vital_status']))?>
                </td>
				<td>
                    <?php echo form_textarea(array('name' => 'father_comments','id' => 'father_comments','rows' => '5','cols' => '10', 'value' => $patient_detail['comments']))?> 
                </td>
            </tr>
        </table>
        <?php echo form_fieldset_close(); ?>
        <?php endforeach; ?>
    </div>
    <input type="button" value="Add relative" onClick="window.parent.addInput('add_record_form_section_4');
            window.parent.calcHeight();"></br>
           <?php echo form_fieldset_close(); ?>	
           <?php echo form_submit('mysubmit', 'Save'); ?>
           <?php echo form_close(); ?>
</div>




