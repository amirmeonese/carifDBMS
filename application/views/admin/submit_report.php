<div class="container" id="submit_report_div">
	<div id="add_record_header" class="row">
		<p>Submit Report</p>
	</div>
	<?php echo form_open('admin/submit_report'); ?>
	<div class="container" id="add_record_form_section_one">
		<div height="20px">&nbsp;</div>
		<table >
			<tr>
			<td><?php echo 'To'; ?></td>
			<td>:</td>
			<td colspan="2"><?php echo form_input('sender'); ?></td>
			</tr>
			<tr><td>
			<?php echo 'CC'; ?></td>
			<td>: </td>
			<td><?php echo form_input('cc'); ?></td>
			</tr>
			<tr><td>
			<?php echo 'Subject'; ?></td>
			<td>: </td>
			<td><?php echo form_input('email_subject'); ?></td>
			</tr>
			<tr><td>
                    <?php echo 'Message'; ?></td>
                    <td>: </td>
                    <td><?php 
                    $data = array(
                        'name'        => 'message_contain',
                        'id'          => 'message_contain',
                        'rows'        => '10',
                        'cols'        => '10'
                      );
                    echo form_textarea($data); ?>
                </td></tr>
		</table>	
		</div>
	<?php echo form_submit('submit','Submit');  ?>
	<?php echo form_close(); ?>


</div>




