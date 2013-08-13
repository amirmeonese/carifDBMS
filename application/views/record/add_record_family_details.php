<div class="container" id="add_record_div">
	<div id="add_record_header" class="row">
		<p>Add Family Details</p>
	</div>
	<?php echo form_open('record/patient_family_record_insertion'); ?>
	<div class="container" id="add_record_form_section_one">
		<div height="30px">&nbsp;</div>
		<table>
			<tr><td>
			<?php echo $mother_fullname; ?>: 
			<?php echo form_input('mother_fullname'); ?>
			</td>
			<td>
			<?php echo $mother_surname; ?>: 
			<?php echo form_input('mother_surname'); ?>
			</td><td>
			<?php echo $mother_maiden_name; ?>: 
			<?php echo form_input('mother_maiden_name'); ?>
			</td></tr>
			<tr><td>
			<?php echo $mother_IC_no; ?>: 
			<?php echo form_input('mother_IC_no'); ?>
			
			</td><td>
			<?php echo $mother_nationality; ?>: 
			<?php echo form_dropdown('mother_nationality',$nationalities); ?>
			<?php //echo form_checkbox('available','yes',TRUE); ?>
			</td><td>
			<?php echo $mother_DOB; ?>: 
			<?php //echo form_textarea
			echo form_input('mother_DOB'); ?>
			</td></tr>
		</table>	
		</div>
	<?php echo form_submit('mysubmit','Save');  ?>
	<?php echo form_close(); ?>
<div>




