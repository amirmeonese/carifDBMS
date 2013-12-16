<div class="container" id="report_div">
    <div id="add_record_header" class="row">
        <p>View Locked Items</p>
    </div>
    <div class="container" id="add_record_form_section_one">
        <div height="30px">&nbsp;</div>
        <table id="locked-items-table" width="80%">
			<thead>
				<tr>
					<th id="locked-items-tr">Lock Date</th>
					<th id="locked-items-tr">IC No.</th>
					<th id="locked-items-tr">Name</th>
					<th id="locked-items-tr">Action</th>
				</tr>
			</thead>
		   <?php 
		   if(!empty($locked_patient_lists))
			{
				foreach ($locked_patient_lists as $locked_patient_list): ?>
				<tr>
					<td id="locked-items-td">
						<?php echo $locked_patient_list->modified_on; ?>
					</td>
					<td id="locked-items-td">
						<?php echo $locked_patient_list->ic_no; ?>
					</td>
					<td id="locked-items-td">
						<?php echo $locked_patient_list->given_name; ?>
					</td>
					<td id="locked-items-td"><a href="<?php echo site_url('admin/release_locked_items') . '/' . $locked_patient_list->ic_no; ?>">Release</a></td>
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




