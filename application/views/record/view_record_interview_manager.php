<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>Interview Manager</p>
    </div>
    <div class="container" id="interview_form_section">
        <div height="30px">&nbsp;</div>
        <table id="add_interview_form_section_1">
            <tr height="50px">
                <td >Interview date</td>
                <td>:</td>
                <td><?php echo @$patient_interview_manager['interview_date']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    Setup next interview date</td>
                    <td>:</td>
                    <td><?php echo @$patient_interview_manager['interview_next_date']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    Send email reminder to officer</td>
                    <td>:</td>
                    <td><?php echo @$patient_interview_manager['is_send_email_reminder']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    Set officer email addresses</td>
                    <td>:</td>
                    <td><?php echo @$patient_interview_manager['officer_email_addresses']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    Interview note</td>
                    <td>:</td>
                    <td><?php echo @$patient_interview_manager['officer_email_addresses']; ?>
                </td>
            </tr>
            <tr>
                
            </tr>
        </table>
<!--                <a align="center" class="doneButton" href="http://localhost/carifDBMS/index.php/record/patient_record_list">Done</a>-->
    </div>
</div>




