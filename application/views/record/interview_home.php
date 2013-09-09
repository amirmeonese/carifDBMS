<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>Interview Manager</p>
    </div>
    <?php echo form_open('record/interview_home_insersion'); ?>
    <div class="container" id="interview_form_section">
        <div height="30px">&nbsp;</div>
        <?php
        echo form_fieldset('Interview Note 1');
        ?>
        <table id="add_interview_form_section_1">
            <tr>
                <td>
                    <?php echo $IC_no; ?>: 
                    <?php echo form_input('IC_no'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Interview date
                    <?php echo form_input('interview_date'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Setup next interview date
                    <?php echo form_input('interview_next_date'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Send email reminder to officer?
                    <?php echo form_checkbox('is_send_email_reminder', 'no', FALSE); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Set officer email addresses
                    <?php echo form_input('officer_email_addresses'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Interview note
                    <?php
                    $data = array(
                        'name' => 'interview_note',
                        'id' => 'interview_note',
                        'rows' => '10',
                        'cols' => '15'
                    );
                    echo form_textarea($data);
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="button" value="Add interview note" onClick="window.parent.addInterviewNoteInput('interview_form_section');
                            window.parent.calcHeight();">
                </td>
            </tr>
        </table>
    <?php echo form_fieldset_close(); ?>	
    </div>
<?php echo form_submit('mysubmit', 'Save'); ?>
<?php echo form_close(); ?>
</div>




