<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>Counselling</p>
    </div>
    <?php
    $attributes = array('id' => 'interview-details-form');
    echo form_open("record/interview_home_insersion", $attributes);
    ?>
    <div class="container" id="interview_form_section">
        <div height="30px">&nbsp;</div>
        <?php foreach ($patient_interview_manager as $patient_counselling): ?>
        <?php
        echo form_fieldset('Counselling note 1');
        ?>
        <table id="add_interview_form_section_1">
            <tr>
                <td>
                    Counseling date
                    <?php echo form_input(array('name' => 'interview_date', 'value' => $patient_counselling['interview_date'], 'class' => 'datepicker'))?>
                </td>
            </tr>
            <tr>
                <td>
                    Setup next counseling date
                    <?php echo form_input(array('name' => 'interview_next_date', 'value' => $patient_counselling['next_interview_date'], 'class' => 'datepicker'))?>
                </td>
            </tr>
            <tr>
                <td>
                    Send email reminder to officer?
                    <?php echo form_checkbox(array('name' => 'is_send_email_reminder', 'value' => $patient_counselling['is_send_email_reminder_to_officers']))?>
                </td>
            </tr>
            <tr>
                <td>
                    Set officer email addresses
                    <?php echo form_input(array('name' => 'officer_email_addresses', 'value' => $patient_counselling['officer_email_addresses']))?>
                </td>
            </tr>
            <tr>
                <td>
                    Counseling note
                    <?php echo form_textarea(array('name' => 'interview_note','id' => 'interview_note','rows' => '10','cols' => '15', 'value' => $patient_counselling['comments']))?>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="button" value="Add note" onClick="window.parent.addInterviewNoteInput('interview_form_section');
                            window.parent.calcHeight();">
                </td>
            </tr>
        </table>
        <?php echo form_fieldset_close(); ?>
        <?php endforeach; ?>
    </div>
    <?php echo form_submit('mysubmit', 'Save'); ?>
    <?php echo form_close(); ?>
</div>




