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
					<?php //echo form_checkbox('available','yes',TRUE); ?>
				</td>
				<td>
					<?php echo $IC_no; ?>: 
					<?php echo form_input('IC_no'); ?>

				</td>
				<td>
					<?php echo $gender; ?>: 
					<?php echo form_dropdown('gender', $genderTypes); ?>
					<?php //echo form_checkbox('available','yes',TRUE); ?>
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
					<?php echo form_input('income_level'); ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo $still_alive_flag; ?>: 
					<?php echo form_checkbox('still_alive_flag','yes',TRUE); ?>
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
							'name'        => 'reason_of_death',
							'id'          => 'reason_of_death',
							'rows'        => '3',
							'cols'        => '7'
						  );
						echo form_textarea($data); ?>
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
					<?php //echo form_textarea
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
					<?php echo $marital_status; ?>: 
					<?php echo form_dropdown('marital_status', $marital_status_lists); ?>
				</td>
				<td>
					<?php echo $is_blood_card_exist; ?>: 
					<?php echo form_checkbox('is_blood_card_exist','yes',TRUE); ?>
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
							'name'        => 'address',
							'id'          => 'address',
							'rows'        => '5',
							'cols'        => '10'
						  );
						echo form_textarea($data); ?>
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
							'name'        => 'highest_level_of_education',
							'id'          => 'highest_level_of_education',
							'rows'        => '3',
							'cols'        => '10'
						  );
						echo form_textarea($data); ?>
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
			</tr>
        </table>
	</div>
	<?php echo form_fieldset_close(); ?>	
	<?php echo form_submit('mysubmit', 'Save'); ?>
	<?php echo form_close(); ?>
	
</div>




