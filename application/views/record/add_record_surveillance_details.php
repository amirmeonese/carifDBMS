<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>Add Surveillance Details</p>
    </div>
    <?php echo form_open_multipart("record/surveillance_insertion"); ?>
    <div class="container" id="add_record_form_section_studies">
        <div height="30px">&nbsp;</div>
        <?php
        echo form_fieldset('Surveillance Details');
        ?>
        <table>
             <tr> 
                <td>
                    <?php echo $IC_no; ?>: 
                    <?php echo form_input('IC_no'); ?>

                </td>
                <td>
                    <?php echo $studies_name; ?>: 
                    <?php echo form_dropdown('studies_name', $studies_name_lists); ?>
                    <?php echo '<br/>'; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $surveillance_recruitment_center; ?>: 
                    <?php echo form_dropdown('surveillance_recruitment_center', $surveillance_recruitment_center_lists); ?>
                </td>
                <td>
                    <?php echo $surveillance_type; ?>: 
                    <?php echo form_dropdown('surveillance_type', $surveillance_type_lists); ?>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $surveillance_first_consultation_date; ?>: 
                    <?php echo form_input('surveillance_first_consultation_date'); ?>
                </td>
                <td>
                    <?php echo $surveillance_first_consultation_place; ?>: 
                    <?php echo form_input('surveillance_first_consultation_place'); ?>
                </td>
                <td>
                    <?php echo $surveillance_interval; ?>: 
                    <?php echo form_input('surveillance_interval'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $surveillance_diagnosis; ?>: 
                    <?php echo form_input('surveillance_diagnosis'); ?>
                </td>
                <td>
                    <?php echo $surveillance_due_date; ?>: 
                    <?php echo form_input('surveillance_due_date'); ?>
                </td>
                <td>
                    <?php echo $surveillance_reminder_sent_date; ?>: 
                    <?php echo form_input('surveillance_reminder_sent_date'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $surveillance_done_date; ?>: 
                    <?php echo form_input('surveillance_done_date'); ?>
                </td>
                <td>
                    <?php echo $surveillance_reminded_by; ?>: 
                    <?php echo form_input('surveillance_reminded_by'); ?>
                </td>
                <td>
                    <?php echo $surveillance_timing; ?>: 
                    <?php echo form_input('surveillance_timing'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $surveillance_symptoms; ?>: 
                    <?php
                    $data = array(
                        'name' => 'surveillance_symptoms',
                        'id' => 'surveillance_symptoms',
                        'rows' => '3',
                        'cols' => '7'
                    );
                    echo form_textarea($data);
                    ?>
                </td>
                <td>
                    <?php echo $surveillance_doctor_name; ?>: 
                    <?php echo form_input('surveillance_doctor_name'); ?>
                </td>
                <td>
                    <?php echo $surveillance_place; ?>: 
                    <?php echo form_input('surveillance_place'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $surveillance_outcome; ?>: 
                    <?php
                    $data = array(
                        'name' => 'surveillance_outcome',
                        'id' => 'surveillance_outcome',
                        'rows' => '3',
                        'cols' => '7'
                    );
                    echo form_textarea($data);
                    ?>
                </td>
                <td>
                    <?php echo $surveillance_comments; ?>: 
                    <?php
                    $data = array(
                        'name' => 'surveillance_comments',
                        'id' => 'surveillance_comments',
                        'rows' => '3',
                        'cols' => '7'
                    );
                    echo form_textarea($data);
                    ?>
                </td>
                <td>&nbsp;</td>
            </tr>
        </table>
        <?php echo form_fieldset_close(); ?>
    </div>
    <?php echo form_submit('mysubmit', 'Save'); ?>
    <?php echo form_close(); ?>
</div>




