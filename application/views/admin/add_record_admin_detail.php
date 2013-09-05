<div class="container" id="view_record_div">
	<div id="add_record_header" class="row">
		<p>Create User</p>
	</div>
	<?php echo form_open('admin/add_record_admin_detail'); ?>
	<div class="container" id="add_record_form_section_1">
		<div height="30px">&nbsp;</div>
		<table>
			<tr><td>
			<?php echo 'First Name'; ?></td>
			<td>:</td> 
			<td><?php echo form_input('admin_firstname'); ?>
			</td>
			<td>
			<?php echo 'Last Name'; ?></td>
			<td>:</td>
			<td><?php echo form_input('admin_lastname'); ?>
			</td></tr>
			<tr><td>
			<?php echo 'Email'; ?></td>
			<td>:</td>
			<td><?php echo form_input('admin_email'); ?>
			</td>
			<td>
			<?php echo 'Login ID'; ?></td>
			<td>:</td>
			<td><?php echo form_input('admin_log_id'); ?></td>
			</td></tr>
			<tr><td>
			<?php echo 'Privillage'; ?>
			<td></td> 
			<td><?php echo form_checkbox('add_privilege', '1'); ?> Add</td>
			<tr><td></td><td></td><td><?php echo form_checkbox('view_privilege', '1'); ?> View</td></tr>
			<tr><td></td><td></td><td><?php echo form_checkbox('edit_privilege', '1'); ?> Edit/modify</td></tr>
			<tr><td></td><td></td><td><?php echo form_checkbox('delete_privilege', '1'); ?> Delete</td></tr>

			<td></tr>
		</table>	
		</div>
	<?php echo form_submit('mysubmit','Create User');  ?>
	<a class="submitCancel" href="<?php echo base_url(); ?>">Cancel</a>

	<?php echo form_close(); ?>
</div>




