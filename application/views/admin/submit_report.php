<div class="container" id="submit_report_div">
	<div id="add_record_header" class="row">
		<p>Submit Report</p>
	</div>
	<?php echo form_open_multipart('admin/submit_report'); ?>
	<div class="container" id="report_form_section">
		<div height="20px">&nbsp;</div>
                <table >
                    <tr>
                        <td><?php echo 'To'; ?></td>
                        <td>:</td>
                        <td width="80"><?php echo form_input('sender'); ?></td>
                    </tr>
                    <tr><td>
                            <?php echo 'CC'; ?></td>
                        <td>: </td>
                        <td colspan="3"><?php echo form_input('cc'); ?></td>
                    </tr>
                    <tr><td>
                            <?php echo 'Subject'; ?></td>
                        <td>: </td>
                        <td colspan="3"><?php echo form_input('email_subject'); ?></td>
                    </tr>
                </table>	
		</div>
	<?php echo form_submit('mysubmit','Submit');  ?>
	<a class="submitCancel" href="<?php echo base_url(); ?>">Cancel</a>
	<?php echo form_close(); ?>


</div>




