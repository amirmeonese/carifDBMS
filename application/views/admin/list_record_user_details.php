<div class="container" id="report_div">
    <div id="report_header" class="row">
        <p>View User Information</p>
    </div>
    <div class="container" id="report_form_section" >
        <div height="10px">&nbsp;</div>
        <?php echo form_open('admin/user_list_record'); ?>
        <table>
        <tr>
                <td id="label1">
                    Search by: 
                </td>
                <td id="label2">
                    Username</td>
                <td><?php echo form_input('user_name'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td id="label2">
                Email</td>
                <td><?php echo form_input('user_email'); ?>

                </td>

            </tr>
        </table>
        <?php echo form_submit('search','Search');  ?>
        <a class="submit" href="<?php echo base_url() . 'admin/create_new_user'; ?>">Create New User </a>
        <?php //if($submit):?>
        <div style="margin-left:100px;"></div>
		<div style="margin-left:100px;"></div>
        <table id="patient-display-table" border="1" width="60%" style="margin-left:100px;">
            <thead>
                <?php if(!empty($message)){ ?>
        <?php  echo $message; ?>
     <?php   }?>
                <tr align='center'>
                    <th id="view-page-tr">&nbsp;</th>
                    <th id="view-page-tr">First Name</th>
                    <th id="view-page-tr">Last Name</th>
                    <th id="view-page-tr">Email</th>
                    <th id="view-page-tr">Login Id</th>
                    <th id="view-page-tr">Action</th>
                </tr>
            </thead>
            <?php if(!empty($user_details)) { $patientCounter = 1;?>
            <?php
                foreach ($user_details as $list):
                    if ($patientCounter % 2 == 0)
                        echo "<tr class=\"stripped-row\">";
                    else
                        echo "<tr>";
                    ?>
                    <td><?php echo $patientCounter; ?></td>
                    <td><?php echo $list['first_name']; ?></td>
                    <td><?php echo $list['last_name']; ?></td>
                    <td><?php echo $list['email']; ?></td>
                    <td><?php echo $list['username']; ?></td>
                    <td width="15%" align='center'>
                    
                            <a href="<?php echo site_url('admin/view_user') . '/' . $list['username'] ?>">
                                <img src="<?php echo base_url(); ?>img/view.png" alt="view_patient_detail" width="18" height="18"></a>
                        <a>&nbsp;</a>
                        <a>&nbsp;</a>
                            <a href="<?php echo site_url('admin/user_deleted') . '/' . $list['username'] ?>" class="confirmation"> 
                                <img src="<?php echo base_url(); ?>img/delete.png" alt="view_patient_detail" width="18" height="18"></a>
                    </td>
        <?php $patientCounter++;
    endforeach; ?>
                        <?php } else { ?>
                <tr><td colspan="7" style="center">
          <?php  echo 'no data';?>
            </td><tr>
   <?php     }
?>
        </table>              
    </div>
</div>

<script type="text/javascript">
    var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('Are you sure want to delete this user?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
</script>