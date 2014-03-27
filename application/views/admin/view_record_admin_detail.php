<div class="container" id="submit_report_div">
    <div id="add_record_header" class="row">
        <p>Create User</p>
    </div>
    <?php echo form_open('admin/user_updated'); ?>
    <div class="container" id="add_record_form_section_1">
        <div height="30px">&nbsp;</div>
        
        <?php foreach ($user_details as $list): ?>
        <table>
            <tr>
                
                <td>
                    <?php echo 'First Name'; ?></td>
                <td>:</td> 
                <td>
                    <?php echo form_input(array('name' => 'admin_firstname', 'value' => $list['first_name']))?>
                </td>
                <td>
                    <?php echo 'Last Name'; ?></td>
                <td>:</td>
                <td>
                    <?php echo form_input(array('name' => 'admin_lastname', 'value' => $list['last_name']))?>
                </td>
                
            </tr>
            <tr>
                <td>
                    <?php echo 'Email'; ?>
                </td>
                <td>:</td>
                <td>
                    <?php echo form_input(array('name' => 'admin_email', 'value' => $list['email']))?>
                </td>
                <td>
                    <?php echo 'Login ID'; ?>
                </td>
                <td>:</td>
                <td>
                    <?php echo form_input(array('name' => 'username', 'value' => $list['username'], 'readonly'=>'true'))?>
                </td>
                <tr>
            </tr>
            <tr><td>
                    <?php echo 'Privillage'; ?>
                <td></td> 
                <?php if ($list['add_privilege'] == 1) { ?>
                    <td><?php echo form_checkbox(array('name' => 'add_privilege', 'value' => $list['add_privilege'], 'checked' => "checked")) ?> Add</td>
                <?php } else { ?>
                    <td><?php echo form_checkbox('add_privilege', '1', false); ?> Add</td>
                    <?php } ?>
                <?php if ($list['view_privilege'] == 1) { ?>
                <tr><td></td><td></td><td><?php echo form_checkbox(array('name' => 'view_privilege', 'value' => $list['view_privilege'], 'checked' => "checked")) ?> View</td></tr>
            <?php } else {?>
            <tr><td></td><td></td><td><?php echo form_checkbox('view_privilege', '1', false); ?>View</td></tr>
                <?php } ?>
                <?php if ($list['edit_privilege'] == 1) { ?>
                <tr><td></td><td></td><td><?php echo form_checkbox(array('name' => 'edit_privilege', 'value' => $list['edit_privilege'], 'checked' => "checked")) ?>Edit/modify</td></tr>
            <?php } else {?>
            <tr><td></td><td></td><td><?php echo form_checkbox('edit_privilege', '1', false); ?>Edit/modify</td></tr>
                <?php } ?>
                <?php if ($list['delete_privilege'] == 1) { ?>
                <tr><td></td><td></td><td><?php echo form_checkbox(array('name' => 'delete_privilege', 'value' => $list['delete_privilege'], 'checked' => "checked")) ?>Delete</td></tr>
            <?php } else {?>
            <tr><td></td><td></td><td><?php echo form_checkbox('delete_privilege', '1', false); ?>Delete</td></tr>
                <?php } ?>
                <td></tr>
        </table>
        <?php endforeach; ?>
    <?php if(!empty($mesagge)){ ?>
            <a class="submitCancel" href="<?php echo base_url() . 'admin/'; ?>">Cancel</a>
       <?php } else {?>
        <?php echo form_submit('mysubmit', 'Update'); ?>
        <a class="submitCancel" href="<?php echo base_url() . 'admin/'; ?>">Cancel</a> 
    <?php   } ?>
    <?php if(!empty($mesagge)){ ?>
        <?php  echo $mesagge; ?>
     <?php   }?>
    <?php echo form_close(); ?>
</div>
    </div>




