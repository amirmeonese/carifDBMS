<div class="container" id="submit_report_div">
	<div id="add_record_header" class="row">
		<p>Form Fields Customization</p>
	</div>
	<div class="container">
		<div height="30px">&nbsp;</div>
		<table border="1" align="lefts" width="30%">
			<tr>
                <td colspan="2" id="design-customized-form-table">Basic Field</td>
            </tr>
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
		<div height="30px">&nbsp;</div>
		<table>
			<tr><td id="label1">Dropdowns</td></tr>
			<tr>
				<td>
					<?php echo 'Nationalities'; ?>
					<?php echo form_dropdown('nationality', $nationalities, NULL, 'id="nationality"'); ?>
				</td>
				<td><button id="nationality" class="rename">Rename</button><button id="nationality" class="add-new">Add new</button><button id="nationality" class="delete">Delete</button></td>
			</tr>
			<tr>
				<td>
					<?php echo 'Gender'; ?>
					<?php echo form_dropdown('gender', $genderTypes, NULL, 'id="gender"'); ?>
				</td>
				<td><button id="gender" class="rename">Rename</button><button id="gender" class="add-new">Add new</button><button id="gender" class="delete">Delete</button></td>
			</tr>
		</table>	
		<p><a class="doneButton" href="<?php echo base_url(). '/admin/'; ?>">Back</a></p>
	</div>
 </div>


