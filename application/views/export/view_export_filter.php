<div class="container" id="report_div">
    <div id="report_header" class="row">
        <p>Report Manager</p>
    </div>
    <?php echo form_open('record/export_record_list'); ?>
    <div class="container" id="report_form_section">
        <div height="30px">&nbsp;</div>
        <table>
            <tr>
                <td>
                    Tab Name:
                </td>
                <td id="label2">

                    <?php echo form_dropdown('tab_name', $export_tab, NULL); ?>
                </td>
            </tr>
            <input type="hidden" name="icno" value="<?php print $ic_no; ?>"/>
            <input type="hidden" name="patient_studies_id" value="<?php print $patient_studies_id; ?>"/>
        </table>
    </div>
    <?php echo form_submit('mysubmit', 'Export'); ?>
    <a class="submitCancel" href="<?php echo base_url(); ?>">Cancel</a>
    <?php echo form_close(); ?>
</div>




