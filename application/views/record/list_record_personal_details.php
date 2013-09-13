<div class="container" id="report_div">
    <div id="report_header" class="row">
        <p>View Personal Information</p>
    </div>
    <div class="container" id="report_form_section" >
        <div height="10px">&nbsp;</div>
        <table border="1" width="50%" style="margin-left:180px;">
            <thead>
                <tr align='center'>
                    <th style="background-color:Crimson;">Date</th>
                    <th style="background-color:Crimson;">Patient Name</th>
                    <th style="background-color:Crimson;">Action</th>
                </tr>
            </thead>
            <?php foreach ($patient_list as $list): ?>
                <tr>
                    <td></td>
                    <td><?php echo $list['fullname']; ?></td>
                    <td width="15%" align='center'>
                        <a href="<?php echo site_url('record/patient_record_view') . '/' . $list['ic_no'] ?>">
                        <img src="<?php echo base_url(); ?>img/view.png" alt="view_patient_detail" width="18" height="18"></a>
                        <a>&nbsp;</a>
                        <a href="<?php echo site_url('record/test') . '/' . $list['ic_no'] ?>">
                        <img src="<?php echo base_url(); ?>img/edit.png" alt="view_patient_detail" width="18" height="18"></a>
                        <a>&nbsp;</a>
                        <a href="<?php echo site_url('record/patient_record_view') . '/' . $list['ic_no'] ?>">
                        <img src="<?php echo base_url(); ?>img/delete.png" alt="view_patient_detail" width="18" height="18"></a>
<!--                            <form name="view_patient_detail" action="<?php echo site_url('record/patient_record_view') . '/' . $list['ic_no'] ?>" method="post">
                            <input type ="image" src="<?php echo base_url(); ?>img/view.png" alt="view_patient_detail" height="18px"></input>
                        </form>
                            <form name="view_patient_detail" action="<?php echo site_url('record/test') . '/' . $list['ic_no'] ?>" method="post">
                            <input type ="image" src="<?php echo base_url(); ?>img/edit.png" alt="view_patient_detail" height="18px"></input>
                        </form>
                            <form name="view_patient_detail" action="<?php echo site_url('record/patient_record_view') . '/' . $list['ic_no'] ?>" method="post">
                            <input type ="image" src="<?php echo base_url(); ?>img/delete.png" alt="view_patient_detail" height="18px"></input>
                        </form>-->
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        </br>
        <a style="margin-left:180px;" class="doneButton" href="<?php echo base_url(); ?>">Done</a>
    </div>
</div>

