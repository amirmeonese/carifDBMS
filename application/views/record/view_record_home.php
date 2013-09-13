<div class="container" id="report_div">
    <div id="report_header" class="row">
        <p>View Personal Information</p>
    </div>
    <div class="container" id="report_form_section" >
        <div height="10px">&nbsp;</div>
        <table border="1" width="50%" style="margin-left:180px;">
            <thead>
                <tr>
                    <th style="background-color:Crimson;">Patient Forms</th>
                    <th align='center' style="background-color:Crimson;">Action</th>
                </tr>
            </thead>
                <tr>
                    <td>Personal Information</td>
                    <td width="15%" align='center'>
                        <a href="<?php echo site_url('record/patient_record_list')?>">
                        <img src="<?php echo base_url(); ?>img/view.png" alt="view_patient_detail" width="18" height="18"></a>
                    </td>
                </tr>
                <tr>
                    <td>Clinical Data</td>
                    <td width="15%" align='center'>
                        <a href="<?php echo site_url('record/patient_record_list')?>">
                        <img src="<?php echo base_url(); ?>img/view.png" alt="view_patient_detail" width="18" height="18"></a>
                    </td>
                </tr>
                <tr>
                    <td>Clinical Measurement</td>
                    <td width="15%" align='center'>
                        <a href="<?php echo site_url('record/patient_record_list')?>">
                        <img src="<?php echo base_url(); ?>img/view.png" alt="view_patient_detail" width="18" height="18"></a>
                    </td>
                </tr>
                <tr>
                    <td>Investigation</td>
                    <td width="15%" align='center'>
                        <a href="<?php echo site_url('record/patient_record_list')?>">
                        <img src="<?php echo base_url(); ?>img/view.png" alt="view_patient_detail" width="18" height="18"></a>
                    </td>
                </tr>
                <tr>
                    <td>Treatment</td>
                    <td width="15%" align='center'>
                        <a href="<?php echo site_url('record/patient_record_list')?>">
                        <img src="<?php echo base_url(); ?>img/view.png" alt="view_patient_detail" width="18" height="18"></a>
                    </td>
                </tr>
        </table>
        </br>
        <a style="margin-left:180px;" class="submitCancel" href="<?php echo base_url(); ?>">Done</a>
    </div>
</div>

