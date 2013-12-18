<div class="container" id="report_div">
    <div id="add_record_header" class="row">
        <p>Deletion History</p>
    </div>
    <div class="container" id="deletion_history">
        <div height="30px">&nbsp;</div>
        <table id="locked-items-table" width="80%">
			<thead>
				<tr>
					<th id="locked-items-tr">Deleted date</th>
					<th id="locked-items-tr">IC no</th>
					<th id="locked-items-tr">Patient name</th>
					<th id="locked-items-tr">Action</th>
				</tr>
			</thead>
			<?php 
		   if(!empty($deleted_patient_lists))
			{
				foreach ($deleted_patient_lists as $deleted_patient_list): ?>
				<tr>
					<td id="locked-items-td">
						<?php echo $deleted_patient_list->modified_on; ?>
					</td>
					<td id="locked-items-td">
						<?php echo $deleted_patient_list->ic_no; ?>
					</td>
					<td id="locked-items-td">
						<?php echo $deleted_patient_list->given_name; ?>
					</td>
					<td id="locked-items-td"><a href="<?php echo site_url('admin/restore_deleted_items') . '/' . $deleted_patient_list->ic_no; ?>">Restore</a></td>
				</tr>
			<?php 
				endforeach; 
			}
			else
			{ ?>
				<tr>
					<td colspan="5" id="locked-items-td">
						<?php echo "No record found."; ?>
					</td>
				</tr>
			<?php
			}
			?>
			</table>
		</br>
		<a class="doneButton" href="<?php echo base_url(). '/admin/'; ?>">Back</a>
	</div>
</div>




