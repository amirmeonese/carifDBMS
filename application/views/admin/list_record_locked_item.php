<div class="container" id="report_div">
    <div id="add_record_header" class="row">
        <p>View Locked Items</p>
    </div>
    <div class="container" id="add_record_form_section_one">
        <div height="30px">&nbsp;</div>
        <table id="locked-items-table" width="80%">
        <thead>
            <tr>
                <th id="locked-items-tr">Date</th>
                <th id="locked-items-tr">Item</th>
                <th id="locked-items-tr">Action</th>
            </tr>
        </thead>
       <!-- <?php foreach ($patient_list as $list): ?>
            <tr>
                <td>
                	<td><?php echo $list['fullname']; ?></td>
                </td>
                <td><a href="<?php //echo site_url('academic/delete_intake') . '/' . $row['intakeid']; ?>" onclick="return confirm('Are you sure want to delete this intake? \nThis operation cannot be undone.');">Delete</a></td>
            </tr>
        <?php endforeach; ?>-->
                </table>
    </br>
	<a class="doneButton" href="<?php echo base_url(); ?>">Done</a>
    </div>
    </div>




