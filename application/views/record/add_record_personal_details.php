<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>Add Personal Details</p>
    </div>
    <?php echo form_open("record/patient_record_insertion"); ?>
    <div class="container" id="add_record_form_section_personal">
        <div height="30px">&nbsp;</div>
        <?php
        echo form_fieldset('Patient Details');
        ?>
        <table>
            <tr>
                <td>
                    <?php echo $fullname; ?>: 
                    <?php echo form_input('fullname'); ?>
                </td>
                <td>
                    <?php echo $surname; ?>: 
                    <?php echo form_input('surname'); ?>
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
                    <?php echo form_dropdown('nationality', $nationalities); ?>
                </td>
                <td>
                    <?php echo $IC_no; ?>: 
                    <?php echo form_input('IC_no'); ?>


                </td>
                <td>
                    <?php echo $gender; ?>: 
                    <?php echo form_dropdown('gender', $genderTypes); ?>
                </td>
                <td>
                    <?php echo $ethinicity; ?>: 
                    <?php echo form_input('ethnicity'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $DOB; ?>: 
                    <?php
                    echo form_input('d_o_b');
                    ?>
                </td>
                <td>
                    <?php echo $place_of_birth; ?>: 
                    <?php
                    echo form_input('place_of_birth');
                    ?>
                </td>
                <td>
                    <?php echo $income_level; ?>: 
                    <?php echo form_dropdown('income_level', $income_level_lists); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $still_alive_flag; ?>: 
                    <?php echo form_checkbox('still_alive_flag', '1', TRUE); ?>
                </td>
                <td>
                    <?php echo $DOD; ?>: 
                    <?php
                    echo form_input('d_o_d');
                    ?>
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
            <tr>
                <td>
                    <?php echo $pedigree_label; ?>: 
					<?php echo form_input('padigree_labelling'); ?>
                </td>
                <td>
                    <?php echo $blood_group; ?>: 
					<?php echo form_input('blood_group'); ?>
                </td>
                <td>
                    <?php echo $hospital_no; ?>: 
                    <?php
                    //echo form_textarea
                    echo form_input('hospital_no');
                    ?>
                </td>
                <td>
					<?php echo $private_patient_no; ?>: 
					<?php echo form_input('private_patient_no'); ?>
                </td>
            </tr>
            <tr>
                <td>
					<?php echo $COGS_study_id; ?>:
                    <?php echo form_dropdown('COGS_study_id', $COGS_study_id_lists); ?>
                </td>
                <td>
					<?php echo $marital_status; ?>: 
                    <?php echo form_dropdown('marital_status', $marital_status_lists); ?>
                </td>
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
            </tr>
            <tr>
                <td>
                    <?php echo $height; ?>: 
                    <?php echo form_input('height'); ?>
                </td>
                <td>
                    <?php echo $weight; ?>: 
                    <?php echo form_input('weight'); ?>
                </td>
                <td>
                    <?php echo $BMI; ?>: 
                    <?php echo form_input('BMI'); ?>
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
				<td>&nbsp;</td>
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
                    <?php echo form_input('total_no_of_male_siblings'); ?>
                </td>
                <td>
                    <?php echo $total_no_of_female_siblings; ?>: 
                    <?php echo form_input('total_no_of_female_siblings'); ?>
                </td>
				<td>
                    <?php echo $total_no_of_affected_siblings; ?>: 
                    <?php echo form_input('total_no_of_affected_siblings'); ?>
				</td>
				<td>&nbsp;</td>
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
			<tr>
                <td id="label1">Do not know because</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
			<tr>
                <td>
                    <?php echo $unknown_reason_is_adopted; ?>: 
                    <?php echo form_checkbox('unknown_reason_is_adopted','1',FALSE); ?>
                </td>
                <td>
                    <?php echo $unknown_reason_in_other_countries; ?>: 
                   <?php echo form_checkbox('unknown_reason_in_other_countries','1',FALSE); ?>
                </td>
                <td>&nbsp;</td>
				<td>&nbsp;</td>
            </tr>
        </table>
    </div>

<?php echo form_fieldset_close(); ?>	
    <div class="container" id="add_record_form_section_personal_2">
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
                    <?php echo form_dropdown('status_source', $status_source_lists); ?>
                </td>
                <td>
                    <?php echo $alive_status; ?>: 
                    <?php echo form_dropdown('alive_status', $alive_status_lists); ?>
                </td>
                <td>
                           <?php echo $status_gathered_date; ?>: 
                           <?php echo form_input('status_gathered_date'); ?>
                </td>
                <td>
                    <input type="button" value="Add more survival status" onClick="window.parent.addSurvivalStatusInput('add_record_form_section_personal_2');
                            window.parent.calcHeight();">
                </td>
            </tr>
        </table>
    </div>
<?php echo form_submit('mysubmit', 'Save'); ?>
<?php echo form_close(); ?>



</div>




