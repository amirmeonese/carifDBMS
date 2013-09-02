<div class="container" id="add_record_div">
	<div id="add_record_header" class="row">
		<p>Create User</p>
	</div>
	<?php echo form_open('report/add_record_admin_detail'); ?>
	<div class="container" id="add_record_form_section_one">
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
			<p align="center"><?php echo form_submit('submit','Save Form');  ?>  <?php echo form_submit('submit','Cancel');  ?></p>

	<p></p>
	<p align="center">Select Field</p>
	<table border="1" align="center" width="30%">
        <thead>
        	<tr>
                <th colspan="2" align="center" style="background-color:Crimson;">Basic Filed</th>
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




