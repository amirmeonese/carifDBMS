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
					<th id="locked-items-tr">Items</th>
					<th id="locked-items-tr">Value</th>
					<th id="locked-items-tr">Action</th>
				</tr>
			</thead>
			<tr>
				<td colspan="4" id="locked-items-td">
					<?php echo "No record found."; ?>
				</td>
			</tr>
			</table>
		</br>
		<a class="doneButton" href="<?php echo base_url(). '/admin/'; ?>">Back</a>
	</div>
</div>
		   <?php 
		  /*  if(!empty($locked_patient_lists))
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
						<?php echo $locked_patient_list->fullname; ?>
					</td>
					
					<td id="locked-items-td">
						<?php echo $locked_patient_list->hospital_no; ?>
					</td>
					<td id="locked-items-td"><a href="<?php echo site_url('admin/release_locked_items') . '/' . $locked_patient_list->ic_no; ?>">Release</a></td>
				</tr>
			<?php 
				endforeach; 
			}
			else
			{ ?> 
				<tr>
					<td colspan="4" id="locked-items-td">
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
    </div>*/




