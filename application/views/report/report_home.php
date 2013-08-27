<div class="container" id="report_div">
	<div id="report_header" class="row">
		<p>Report Manager</p>
	</div>
	<?php echo form_open('report/process_report'); ?>
	<div class="container" id="report_form_section">
		<div height="30px">&nbsp;</div>
		<table>
            <tr>
				<td id="label1">
                    Search by: 
                </td>
                <td id="label2">
                   Patient name
                   <?php echo form_input('report_patient_name'); ?>
                </td>
			</tr>
			<tr>
				<td>
                    &nbsp;
                </td>
				<td id="label2">
					IC No
                    <?php echo form_input('report_IC_no'); ?>
                </td>
			</tr>
			<tr>
				<td id="label1">
                    Report Templates: 
                </td>
                <td id="label2">
                   <?php echo form_dropdown('report_templates', $reportTemplates); ?>
                </td>
			</tr>
			<tr>
				<td id="label1">
                    Filter options
                </td>
                <td id="label2">
                  Category
                   <?php echo form_input('report_category'); ?>
                </td>
			</tr>
			<tr>
				<td>
                    &nbsp;
                </td>
				<td id="label2">
					Date from
                    <?php echo form_input('report_start_range_date'); ?> to <?php echo form_input('report_end_range_date'); ?>
                </td>
			</tr>
		</table>
	</div>
	<?php echo form_submit('mysubmit','Generate Report');  ?>
	<a class="submitCancel" href="<?php echo base_url(); ?>">Cancel</a>
	<?php echo form_close(); ?>
</div>




