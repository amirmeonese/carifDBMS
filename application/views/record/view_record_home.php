<div class="container" id="report_div">
    <div id="report_header" class="row">
        <p>View Personal Information</p>
    </div>
    <div class="container" id="report_form_section" >
        <div height="10px">&nbsp;</div>
        <table border="1" width="50%" style="margin-left:180px;">
            <thead>
                <tr>
                    <th id="view-patient-tr">Patient Forms</th>
                    <th id="view-patient-tr">Action</th>
                </tr>
            </thead>
                <tr>
                    <td id="view-patient-td">Personal Information</td>
                    <td id="view-patient-td" width="15%" align='center'>
                        <a href="<?php echo site_url('record/patient_record_list')?>">
                        <img src="<?php echo base_url(); ?>img/view.png" alt="view_patient_detail" width="18" height="18"></a>
                    </td>
                </tr>
                <tr>
                    <td id="view-patient-td">Pathology</td>
                    <td id="view-patient-td" width="15%" align='center'>
                        <a href="<?php echo site_url('record/patient_record_list')?>">
                        <img src="<?php echo base_url(); ?>img/view.png" alt="view_patient_detail" width="18" height="18"></a>
                    </td>
                </tr>
                <tr>
                    <td id="view-patient-td">Investigations</td>
                    <td id="view-patient-td" width="15%" align='center'>
                        <a href="<?php echo site_url('record/patient_record_list')?>">
                        <img src="<?php echo base_url(); ?>img/view.png" alt="view_patient_detail" width="18" height="18"></a>
                    </td>
                </tr>
                <tr>
                    <td id="view-patient-td">Surveillance</td>
                    <td id="view-patient-td" width="15%" align='center'>
                        <a href="<?php echo site_url('record/patient_record_list')?>">
                        <img src="<?php echo base_url(); ?>img/view.png" alt="view_patient_detail" width="18" height="18"></a>
                    </td>
                </tr>
                <tr>
                    <td id="view-patient-td">Treatment</td>
                    <td id="view-patient-td" width="15%" align='center'>
                        <a href="<?php echo site_url('record/patient_record_list')?>">
                        <img src="<?php echo base_url(); ?>img/view.png" alt="view_patient_detail" width="18" height="18"></a>
                    </td>
                </tr>
        </table>
        </br>
        <a style="margin-left:180px;" class="submitCancel" href="<?php echo base_url(); ?>">Done</a>
    </div>
</div>

