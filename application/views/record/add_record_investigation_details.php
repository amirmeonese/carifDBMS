<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>Add Investigation Details</p>
    </div>
    <?php echo form_open_multipart("record/investigation_insertion"); ?>
    <div class="container" id="add_record_form_section_studies">
        <div height="30px">&nbsp;</div>
        <?php
        echo form_fieldset('Investigation Details');
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
                    <?php echo $date_test_ordered; ?>: 
                    <?php echo form_input('date_test_ordered'); ?>
                </td>
                <td>
                    <?php echo $test_ordered_by; ?>: 
                    <?php echo form_input('test_ordered_by'); ?>
                </td>
                <td>
                    <?php echo $testing_results_notification_flag; ?>: 
                    <?php echo form_checkbox('testing_results_notification_flag', '1', FALSE); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $investigation_project_name; ?>: 
                    <?php echo form_dropdown('investigation_project_name', $investigation_project_name_lists); ?>
                </td>
                <td>
                    <?php echo $investigation_project_batch; ?>: 
                    <?php echo form_input('investigation_project_batch'); ?>
                </td>
                <td>
                    <?php echo $investigation_test_type; ?>: 
                    <?php echo form_dropdown('investigation_test_type', $investigation_test_type_lists); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $investigation_sample_type; ?>: 
                    <?php echo form_dropdown('investigation_sample_type', $investigation_sample_type_lists); ?>
                </td>
                <td>
                    <?php echo $investigation_test_reason; ?>: 
                    <?php
                    $data = array(
                        'name' => 'investigation_test_reason',
                        'id' => 'investigation_test_reason',
                        'rows' => '3',
                        'cols' => '7'
                    );
                    echo form_textarea($data);
                    ?>
                </td>
                <td>
                    <?php echo $investigation_new_mutation_flag; ?>: 
                    <?php echo form_checkbox('investigation_new_mutation_flag', '1', FALSE); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $investigation_test_results; ?>: 
                    <?php echo form_dropdown('investigation_test_results', $investigation_test_results_lists); ?>
                </td>
                <td>
                    <?php echo $investigation_test_results_other_details; ?>: 
                    <?php
                    $data = array(
                        'name' => 'investigation_test_results_other_details',
                        'id' => 'investigation_test_results_other_details',
                        'rows' => '3',
                        'cols' => '7'
                    );
                    echo form_textarea($data);
                    ?>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $investigation_carrier_status; ?>: 
                    <?php echo form_dropdown('investigation_carrier_status', $investigation_carrier_status_lists); ?>
                </td>
                <td>
                    <?php echo $investigation_mutation_nomenclature; ?>: 
                    <?php echo form_dropdown('investigation_mutation_nomenclature', $investigation_mutation_nomenclature_lists); ?>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $investigation_reported_by; ?>: 
                    <?php echo form_input('investigation_reported_by'); ?>
                </td>
                <td>
                    <?php echo $investigation_mutation_type; ?>: </br>
                    <?php echo form_input('investigation_mutation_type'); ?>
                </td>
                <td>
                    <?php echo $investigation_mutation_pathogenicity; ?>: 
                    <?php echo form_input('investigation_mutation_pathogenicity'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $investigation_sample_ID; ?>: </br>
                    <?php echo form_input('investigation_sample_ID'); ?>
                </td>
                <td>
                    <?php echo $investigation_report_due; ?>: 
                    <?php echo form_input('investigation_report_due'); ?>
                </td>
                <td>
                    <?php echo $investigation_report_date; ?>: </br>
                    <?php echo form_input('investigation_report_date'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $investigation_date_notified; ?>: 
                    <?php echo form_input('investigation_date_notified'); ?>
                </td>
                <td>
                    <?php echo $investigation_test_comment; ?>: 
                    <?php
                    $data = array(
                        'name' => 'investigation_test_comment',
                        'id' => 'investigation_test_comment',
                        'rows' => '3',
                        'cols' => '7'
                    );
                    echo form_textarea($data);
                    ?>
                </td>
                </td>
                &nbsp;
            </tr>
            <tr>
                <td>
                    <?php echo $investigation_conformation_attachment; ?>: 
                    <?php echo form_checkbox('investigation_conformation_attachment', '1', FALSE); ?>
                </td>
                <td>
                    <input type="file" name="userfile" size="100000" />
                    
                </td>
                &nbsp;
            </tr>
        </table>
        <?php echo form_fieldset_close(); ?>
    </div>
    <?php echo form_submit('mysubmit', 'Save'); ?>
    <?php echo form_close(); ?>
</div>




