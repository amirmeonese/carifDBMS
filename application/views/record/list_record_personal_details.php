<div class="container" id="report_div">
	<div id="report_header" class="row">
        <p>View Personal Information</p>
	</div>
	<?php echo form_open('report/process_report'); ?>
	<div class="container" id="report_form_section">
		<div height="30px">&nbsp;</div>
		<table border="1" align="center" width="50%" >
           <thead>
            <tr>
                <th style="background-color:Crimson;">Date</th>
                <th style="background-color:Crimson;">Patient Name</th>
                <th style="background-color:Crimson;">Action</th>
            </tr>
        </thead>
        <?php foreach ($patient_list as $list): ?>
            <tr>
                <td></td>
                	<td><?php echo $list['fullname']; ?></td>
                <td><a href="<?php echo site_url('record/patient_record_view').'/'.'1'?>">View</a></td>
            </tr>
        <?php endforeach; ?>
		</table>
	</br>
	<a class="submitCancel" href="<?php echo base_url(); ?>">Done</a>
    </div>
