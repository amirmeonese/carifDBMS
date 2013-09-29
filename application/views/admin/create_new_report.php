<div class="container" id="submit_report_div">
	<div id="add_record_header" class="row">
		<p>Create New Report</p>
	</div>
	<?php echo form_open('report/add_record_admin_detail'); ?>
	<div class="container" id="report_form_section">
		<div height="30px">&nbsp;</div>
		<table>
			<tr><td>
			<?php echo 'Form Title'; ?></td>
			<td>:</td> 
			<td><?php echo form_input('mother_fullname'); ?>
			</td>
			</tr>
			<tr><td>
			<?php echo $fullname; ?></td>
			<td>:</td>
			<td><?php echo form_input('mother_maiden_name'); ?>
			</td>
			<td>
			<?php echo $surname; ?></td>
			<td>:</td>
			<td><?php echo form_input('mother_DOB'); ?></td>
			</td></tr>
		
		</table>	
			<p><?php echo form_submit('submit','Save Form');  ?> </p>

	<p></p>
	<p align="center">Select Field</p>
	<table border="1" align="center" width="30%">
        <thead>
        	<tr>
                <th colspan="2" id="design-customized-form-table">Basic Field</th>
            </tr>
        </thead>
            <tr>
                <td>Text Box</td>
                <td>Text Area</td>
            </tr>
            <tr>
                <td>Number</td>
                <td>Dropdown</td>
            </tr>
            <tr>
                <td>Radio Button</td>
                <td>Checkbox</td>
            </tr>
                </table>
                </div>
                	<p></p>

	<p align="center"><?php echo form_submit('submit','Submit');  ?></p>

	<?php echo form_close(); ?>
	<a class="doneButton" href="<?php echo base_url(). '/admin/'; ?>">Back</a>
 </div>


