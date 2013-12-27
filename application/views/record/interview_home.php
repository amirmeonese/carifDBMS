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
        <?php
        echo form_fieldset('Counselling note 1');
        ?>
        <table id="add_interview_form_section_1">
            <tr>
                <td>
                   <label for="IC_no"><?php echo $IC_no; ?>: </label>
                    <?php echo form_input('IC_no'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Counselling date
					<?php echo form_input(array('name'=>'interview_date','class'=>'datepicker')); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Setup next counselling date
					<?php echo form_input(array('name'=>'interview_next_date','class'=>'datepicker')); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Send email reminder to officer?
                    <?php echo form_checkbox('is_send_email_reminder', '1', FALSE); ?>
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
                    Counselling note
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
                    <input type="button" value="Add note" onClick="window.parent.addInterviewNoteInput('interview_form_section');
                            window.parent.calcHeight();">
                </td>
            </tr>
        </table>
    <?php echo form_fieldset_close(); ?>	
    </div>
<?php echo form_submit('mysubmit', 'Save'); ?>
<?php echo form_close(); ?>
</div>




