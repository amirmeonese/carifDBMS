<div class="container" id="report_div">
    <div id="add_record_header" class="row">
        <p>View Error Log</p>
    </div>
    <div class="container" id="add_record_form_section_one">
        <div height="50px">&nbsp;</div>
        <table id="error-log-table" width="80%">
        <thead>
            <tr>
                <th id="error-log-tr" colspan="3">10 recent error items</th>
            </tr>
        </thead>
		<tbody>
		<?php echo form_open_multipart("admin/process_error_log_form"); ?>
		<?php 
			$error_list = explode( "\n", $errorMSG );
			$i=1;
			foreach ($error_list as $list): 
			$list = addslashes($list);?>
            <tr>
				<td id="error-log-td"><?php echo $i ?></td>
				<td id="error-log-td"><input type="hidden" name="error_list<?php echo $i?>" value="<?php echo $list; ?>"> <?php echo $list; ?></input></td>
                <td id="error-log-td"><?php echo form_submit('logsubmit', 'Send error '. $i); ?></td>
            </tr>
        <?php  if($i==10) break; $i++;  endforeach; ?>
		<tr>
			<td colspan="3" id="error-log-td">
				<?php echo form_submit('downloadbtn', 'Download error log file'); ?>
				<a class="doneButton" href="<?php echo base_url() . '/admin/'; ?>">Back</a>
				<?php echo form_fieldset_close(); ?>
			</td>
		</tr>
		</tbody>
		</table>
	</br>
</div>
</div>




