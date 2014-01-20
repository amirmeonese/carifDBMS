<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>View Mutation Analysis</p>
    </div>
    <?php
    $attributes = array('id' => 'mutation-analysis-details-form');
    echo form_open("record/investigation_update", $attributes);
    ?>
    <div class="container" id="add_record_form_mutation_analysis_div_1">
        <div height="30px">&nbsp;</div>
        <table>
        </table>
        <div height="30px">&nbsp;</div>
        <?php foreach ($patient_mutation_analysis as $list): ?>
            <?php
            echo form_fieldset('Mutation Analysis');
            ?>
            <table id="mutation_section_1">
                <tr>
                    <td id="label1">Analysis 1</td>
                </tr>
                <tr>
                    <td>
                        <?php echo $date_test_ordered; ?>: <br />
                        <?php echo form_input(array('name' => 'date_test_ordered[]', 'value' => $list['date_test_ordered'],'class' => 'datepicker')); ?>
                    </td>
                    <td>
                        <?php echo $test_ordered_by; ?>:  <br />
                        <?php echo form_input(array('name' => 'test_ordered_by[]', 'value' => $list['ordered_by'])) ?>
                    </td>
                    <?php if($list['testing_result_notification_flag'] == 1){?>
                    <td>
                        <?php echo $testing_results_notification_flag; ?>:  
                        <?php echo form_checkbox(array('name' => 'testing_results_notification_flag[]', 'value' => $list['testing_result_notification_flag'],'checked'=>"checked")) ?>
                    </td>
               <?php } else {?>
                <td>
                        <?php echo $testing_results_notification_flag; ?>:  
                        <?php echo form_checkbox(array('name' => 'testing_results_notification_flag[]', 'value' => $list['testing_result_notification_flag'])) ?>
                    </td>
               <?php } ?>
                </tr>
                <tr>
                    <td>
                        <?php echo $investigation_project_name; ?>:  <br />
                        <?php echo form_dropdown('investigation_project_name[]', $investigation_project_name_lists, $list['service_provider'], 'id="investigation_project_name_lists" preload_val="'.$list['service_provider'].'"'); ?>
                    </td>
                    <td>
                        <?php echo $investigation_project_batch; ?>:  <br />
                        <?php echo form_input(array('name' => 'investigation_project_batch[]', 'value' => $list['testing_batch'])) ?>
                    </td>
                    <td>
                        <?php echo $investigation_project_date; ?>:  <br />
                        <?php echo form_input(array('name' => 'investigation_project_date[]', 'value' => $list['testing_date'], 'class' => 'datepicker')); ?>
                    </td>
                    <td>
                        <?php echo $investigation_gene_tested; ?>:  <br />
                        <?php echo form_dropdown('investigation_gene_tested[]', $investigation_gene_tested_lists, $list['gene_tested'], 'id="investigation_gene_tested_lists" preload_val="'.$list['gene_tested'].'"'); ?>
                    </td>
                </tr>
                <tr>
<!--                    <td>
                        <?php echo $investigation_gene_tested_other; ?>:  <br />
                        <?php echo form_input(array('name' => 'investigation_gene_tested_other[]', 'value' => $list['investigation_gene_tested_other'])) ?>
                    </td>-->
                    <td>
                        <?php echo $investigation_test_type; ?>:  <br />
                        <?php echo form_dropdown('investigation_test_type[]', $investigation_test_type_lists, $list['types_of_testing'], 'id="investigation_test_type_lists" preload_val="'.$list['types_of_testing'].'"'); ?>
                    </td>
                    <td>
                        <?php echo $investigation_sample_type; ?>:  <br />
                        <?php echo form_dropdown('investigation_sample_type[]', $investigation_sample_type_lists, $list['type_of_sample'], 'id="investigation_sample_type_lists" preload_val="'.$list['type_of_sample'].'"'); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $investigation_test_reason; ?>:  <br />
                        <?php echo form_textarea(array('name' => 'investigation_test_reason[]','id' => 'investigation_test_reason','rows' => '3','cols' => '7', 'value' => $list['reasons']))?>
                    </td>
                    <?php if($list['new_mutation_flag'] == 1){?>
                        <td>
                        <?php echo $investigation_new_mutation_flag; ?>:  
                        <?php echo form_checkbox(array('name' => 'investigation_new_mutation_flag[]', 'value' => $list['new_mutation_flag'],'checked'=>"checked")) ?>
                    </td>
               <?php } else {?>
                    <td>
                        <?php echo $investigation_new_mutation_flag; ?>:  
                        <?php echo form_checkbox(array('name' => 'investigation_new_mutation_flag[]', 'value' => $list['new_mutation_flag'])) ?>
                    </td>
                    <?php } ?>
                </tr>
                <tr>
                    <td>
                        <?php echo $investigation_test_results; ?>:  <br />
                        <?php echo form_dropdown('investigation_test_results[]', $investigation_test_results_lists, $list['test_result'], 'id="investigation_test_results_lists" preload_val="'.$list['test_result'].'"'); ?>
                    </td>
                    <td>
                        <?php echo $investigation_test_results_other_details; ?>:  <br />
                        <?php echo form_textarea(array('name' => 'investigation_test_results_other_details[]','id' => 'investigation_test_results_other_details','rows' => '3','cols' => '7', 'value' => $list['investigation_test_results_other_details']))?>
                    </td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <?php echo $investigation_mutation_pathogenicity; ?>:  <br />
                        <?php echo form_dropdown('investigation_mutation_pathogenicity[]', $investigation_mutation_pathogenicity_lists, $list['mutation_pathogenicity'], 'id="investigation_mutation_pathogenicity_lists" preload_val="'.$list['mutation_pathogenicity'].'"'); ?>
                    </td>
                    <td>
                        <?php echo $investigation_mutation_nomenclature; ?>:  <br />
                        <?php echo form_dropdown('investigation_mutation_nomenclature[]', $investigation_mutation_nomenclature_lists, $list['mutation_nomenclature'], 'id="investigation_mutation_nomenclature_lists" preload_val="'.$list['mutation_nomenclature'].'"'); ?>
                    </td>
                    <td>
                        <?php echo $investigation_mutation_name; ?>: </br>
                        <?php echo form_input(array('name' => 'investigation_mutation_name[]', 'value' => $list['mutation_name'])) ?>
                    </td>
                    </td>
                    <td>
                        <?php echo $investigation_mutation_type; ?>: </br>
                        <?php echo form_input(array('name' => 'investigation_mutation_type[]', 'value' => $list['mutation_type'])) ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $investigation_exon; ?>: </br>
                        <?php echo form_input(array('name' => 'investigation_exon[]', 'value' => $list['exon'])) ?>
                    </td>
                    <td>
                        <?php echo $investigation_carrier_status; ?>:  <br />
                        <?php echo form_dropdown('investigation_carrier_status[]', $investigation_carrier_status_lists, $list['carrier_status'], 'id="investigation_carrier_status_lists" preload_val="'.$list['carrier_status'].'"'); ?>
                    </td>
                    <td>
                        <?php echo $investigation_report_date; ?>: </br>
                        <?php echo form_input(array('name' => 'investigation_report_date[]', 'value' => $list['report_date'], 'class' => 'datepicker')) ?>
                    </td>
                    <td>
                        <?php echo $investigation_date_notified; ?>:  <br />
                        <?php echo form_input(array('name' => 'investigation_date_notified[]', 'value' => $list['date_client_notified'], 'class' => 'datepicker')) ?>
                    </td>
                </tr>
                <tr>
                    <?php if($list['is_counselling_flag'] == 1){?>
                    <td>
                        <?php echo $mutation_is_counselling_flag; ?>:  
                        <?php echo form_checkbox(array('name' => 'mutation_is_counselling_flag[]', 'value' => $list['is_counselling_flag'],'checked'=>"checked")) ?>
                    </td>
               <?php } else {?>
                    <td>
                        <?php echo $mutation_is_counselling_flag; ?>:  
                        <?php echo form_checkbox(array('name' => 'mutation_is_counselling_flag[]', 'value' => $list['is_counselling_flag'])) ?>
                    </td>
                    <?php } ?>
                    <td>
                        <?php echo $investigation_test_comment; ?>:  <br />
                        <?php echo form_textarea(array('name' => 'investigation_test_comment[]','id' => 'investigation_test_comment','rows' => '3','cols' => '7', 'value' => $list['comments']))?>
                    </td>
                     <?php if($list['is_counselling_flag'] == 1){?>
                    <td>
                        <?php echo $investigation_conformation_attachment; ?>: 	
                        <?php echo form_checkbox(array('name' => 'investigation_conformation_attachment[]', 'value' => $list['conformation_attachment'],'checked'=>"checked")) ?>
                    </td>
               <?php } else {?>
                    <td>
                        <?php echo $investigation_conformation_attachment; ?>: 	
                        <?php echo form_checkbox(array('name' => 'investigation_conformation_attachment[]', 'value' => $list['conformation_attachment'])) ?>
                    </td>
                    <?php } ?>
                    <td>
                        <input type="file" name="userfile" size="100000" />
                    </td>
                </tr>
                <input type="hidden" name="patient_studies_id" value="<?php print $list['patient_studies_id']; ?>"/>
                <input type="hidden" name="patient_investigations_id[]" value="<?php print $list['patient_investigations_id']; ?>"/>
            </table>
            <?php echo form_fieldset_close(); ?>
        <?php endforeach; ?>
    </div>
     <?php if ($userprivillage['edit_privilege']== 1){ ?>
    <?php echo form_submit('mysubmit', 'Update'); ?>
    <?php } else { ?>
    <?php }?>
    <?php echo form_close(); ?>
</div>




