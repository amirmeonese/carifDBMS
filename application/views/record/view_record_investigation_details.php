<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>Add Investigation Details</p>
    </div>
    <div class="container" id="add_record_form_section_studies">
        <div height="30px">&nbsp;</div>
        <table>
            <tr height="50px">
                <td width="13%">
                    <?php echo $date_test_ordered; ?></td>
                    <td>:</td>
                    <td width="13%"><?php echo @$patient_investigation['date_test_ordered']; ?>
                </td>
                <td width="15%">
                    <?php echo $test_ordered_by; ?></td>
                    <td>:</td>
                    <td width="13%"><?php echo @$patient_investigation['test_ordered_by']; ?>
                </td>
                <td width="13%">
                    <?php echo $testing_results_notification_flag; ?></td>
                    <td>:</td>
                    <td width="13%"><?php echo @$patient_investigation['testing_results_notification_flag']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $investigation_project_name; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_investigation['investigation_project_name']; ?>
                </td>
                <td>
                    <?php echo $investigation_project_batch; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_investigation['investigation_project_batch']; ?>
                </td>
                <td>
                    <?php echo $investigation_test_type; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_investigation['investigation_test_type']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $investigation_sample_type; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_investigation['investigation_sample_type']; ?>
                </td>
                <td>
                    <?php echo $investigation_test_reason; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_investigation['investigation_sample_type']; ?>
                </td>
                <td>
                    <?php echo $investigation_new_mutation_flag; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_investigation['investigation_new_mutation_flag']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $investigation_test_results; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_investigation['investigation_test_results']; ?>
                </td>
                <td>
                    <?php echo $investigation_test_results_other_details; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_investigation['investigation_sample_type']; ?>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $investigation_carrier_status; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_investigation['investigation_carrier_status']; ?>
                </td>
                <td>
                    <?php echo $investigation_mutation_nomenclature; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_investigation['investigation_mutation_nomenclature']; ?>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $investigation_reported_by; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_investigation['investigation_reported_by']; ?>
                </td>
                <td>
                    <?php echo $investigation_mutation_type; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_investigation['investigation_mutation_type']; ?>
                </td>
                <td>
                    <?php echo $investigation_mutation_pathogenicity; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_investigation['investigation_mutation_pathogenicity']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $investigation_sample_ID; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_investigation['investigation_sample_ID']; ?>
                </td>
                <td>
                    <?php echo $investigation_report_due; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_investigation['investigation_report_due']; ?>
                </td>
                <td>
                    <?php echo $investigation_report_date; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_investigation['investigation_report_date']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $investigation_date_notified; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_investigation['investigation_date_notified']; ?>
                </td>
                <td>
                    <?php echo $investigation_test_comment; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_investigation['investigation_sample_type']; ?>
                </td>
                </td>
                &nbsp;
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $investigation_conformation_attachment; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_investigation['investigation_conformation_attachment']; ?>
                </td>
                <td></td>
                </td>
                &nbsp;
            </tr>
        </table>
    </div>
</div>




