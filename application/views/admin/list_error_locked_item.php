<div class="container" id="report_div">
    <div id="add_record_header" class="row">
        <p>View Error Log</p>
    </div>
    <div class="container" id="add_record_form_section_one">
        <div height="50px">&nbsp;</div>
        <table border="1" style="margin-left:180px;" width="50%" >
        <thead>
            <tr>
                <th width="50px" style="background-color:Crimson;">Date</th>
                <th width="100px" style="background-color:Crimson;">Items</th>
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
	<a style="margin-left:180px;" class="doneButton" href="<?php echo base_url(); ?>">Done</a>
</div>
</div>




