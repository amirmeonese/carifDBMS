<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>View Lock Items</p>
    </div>
    <div class="container" id="add_record_form_section_one">
        <div height="30px">&nbsp;</div>
        <table border="1" align="center" width="50%">
        <thead>
            <tr>
                <th style="background-color:Crimson;">Date</th>
                <th style="background-color:Crimson;">Item</th>
                <th style="background-color:Crimson;">Action</th>
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
    </div>
<?php echo form_submit('mysubmit', 'Done'); ?>
    <div>




