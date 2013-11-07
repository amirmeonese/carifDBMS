<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>Add Mutation Analysis</p>
    </div>
	 <?php 
	$attributes = array('id' => 'mutation-analysis-details-form');
	echo form_open("record/investigation_insertion", $attributes);
	?>
    <div class="container" id="add_record_form_mutation_analysis_div_1">
        <div height="30px">&nbsp;</div>
		<table>
		</table>
		<div height="30px">&nbsp;</div>
        <?php
        echo form_fieldset('Mutation Analysis');
        ?>
        <table id="mutation_section_1">
			<tr>
                <td id="label1">Analysis 1</td>
				<td><input type="button" value="Add mutation analysis" onClick="window.parent.addMutationAnalysis('add_record_form_mutation_analysis_div_1');
                            window.parent.calcHeight();"></td>
            </tr>
            <tr>
                <td>
                    <?php echo $date_test_ordered; ?>: <br />
		    <?php echo form_input(array('name'=>'date_test_ordered','class'=>'datepicker')); ?>
                </td>
                <td>
                    <?php echo $test_ordered_by; ?>:  <br />
                    <?php echo form_input(array('name' => 'test_ordered_by', 'value' => $patient_mutation_analysis['test_ordered_by']))?>
                </td>
                <td>
                    <?php echo $testing_results_notification_flag; ?>:  
                    <?php echo form_checkbox(array('name' => 'testing_results_notification_flag', 'value' => $patient_mutation_analysis['testing_results_notification_flag']))?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $investigation_project_name; ?>:  <br />
                    <?php echo form_dropdown('investigation_project_name', $investigation_project_name_lists, $patient_mutation_analysis['mother_cancer_name']); ?>
                </td>
                <td>
                    <?php echo $investigation_project_batch; ?>:  <br />
                    <?php echo form_input(array('name' => 'investigation_project_batch', 'value' => $patient_mutation_analysis['investigation_project_batch']))?>
                </td>
				<td>
                    <?php echo $investigation_project_date; ?>:  <br />
		    <?php echo form_input(array('name'=>'investigation_project_date','class'=>'datepicker')); ?>
                </td>
               <td>
                    <?php echo $investigation_gene_tested; ?>:  <br />
                    <?php echo form_dropdown('investigation_gene_tested', $investigation_gene_tested_lists, $patient_mutation_analysis['mother_cancer_name']); ?>
                </td>
            </tr>
            <tr>
				<td>
                    <?php echo $investigation_gene_tested_other; ?>:  <br />
                    <?php echo form_input(array('name' => 'investigation_gene_tested_other', 'value' => $patient_mutation_analysis['investigation_gene_tested_other']))?>
                </td>
				<td>
                    <?php echo $investigation_test_type; ?>:  <br />
                    <?php echo form_dropdown('investigation_test_type', $investigation_test_type_lists, $patient_mutation_analysis['mother_cancer_name']); ?>
                </td>
                <td>
                    <?php echo $investigation_sample_type; ?>:  <br />
                    <?php echo form_dropdown('investigation_sample_type', $investigation_sample_type_lists, $patient_mutation_analysis['mother_cancer_name']); ?>
                </td>
            </tr>
			<tr>
				<td>
                    <?php echo $investigation_test_reason; ?>:  <br />
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
                    <?php echo form_checkbox(array('name' => 'investigation_new_mutation_flag', 'value' => $patient_mutation_analysis['investigation_new_mutation_flag']))?>
                </td>
			</tr>
            <tr>
                <td>
                    <?php echo $investigation_test_results; ?>:  <br />
                    <?php echo form_dropdown('investigation_test_results', $investigation_test_results_lists, $patient_mutation_analysis['mother_cancer_name']); ?>
                </td>
                <td>
                    <?php echo $investigation_test_results_other_details; ?>:  <br />
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
                    <?php echo $investigation_mutation_pathogenicity; ?>:  <br />
                    <?php echo form_dropdown('investigation_mutation_pathogenicity', $investigation_mutation_pathogenicity_lists, $patient_mutation_analysis['mother_cancer_name']); ?>
                </td>
                <td>
                    <?php echo $investigation_mutation_nomenclature; ?>:  <br />
                    <?php echo form_dropdown('investigation_mutation_nomenclature', $investigation_mutation_nomenclature_lists, $patient_mutation_analysis['mother_cancer_name']); ?>
                </td>
                <td>
                    <?php echo $investigation_mutation_name; ?>: </br>
                    <?php echo form_input(array('name' => 'investigation_mutation_name', 'value' => $patient_mutation_analysis['investigation_mutation_name']))?>
                </td>
                </td>
                <td>
                    <?php echo $investigation_mutation_type; ?>: </br>
                    <?php echo form_input(array('name' => 'investigation_mutation_type', 'value' => $patient_mutation_analysis['investigation_mutation_type']))?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $investigation_exon; ?>: </br>
                    <?php echo form_input(array('name' => 'investigation_exon', 'value' => $patient_mutation_analysis['investigation_exon']))?>
                </td>
                <td>
                    <?php echo $investigation_carrier_status; ?>:  <br />
                    <?php echo form_dropdown('investigation_carrier_status', $investigation_carrier_status_lists, $patient_mutation_analysis['mother_cancer_name']); ?>
                </td>
                <td>
                    <?php echo $investigation_report_date; ?>: </br>
                    <?php echo form_input(array('name' => 'investigation_report_date', 'value' => $patient_mutation_analysis['investigation_project_batch'], 'class' => 'datepicker'))?>
                </td>
                <td>
                    <?php echo $investigation_date_notified; ?>:  <br />
                    <?php echo form_input(array('name' => 'investigation_date_notified', 'value' => $patient_mutation_analysis['investigation_date_notified'], 'class' => 'datepicker'))?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $mutation_is_counselling_flag; ?>:  
                    <?php echo form_checkbox(array('name' => 'mutation_is_counselling_flag', 'value' => $patient_mutation_analysis['mutation_is_counselling_flag']))?>
                </td>
                <td>
                    <?php echo $investigation_test_comment; ?>:  <br />
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
                <td>
                    <?php echo $investigation_conformation_attachment; ?>: 	
                    <?php echo form_checkbox(array('name' => 'investigation_conformation_attachment', 'value' => $patient_mutation_analysis['investigation_conformation_attachment']))?>
                </td>
                <td>
                    <input type="file" name="userfile" size="100000" />
                </td>
            </tr>
        </table>
        <?php echo form_fieldset_close(); ?>
    </div>
    <?php echo form_submit('mysubmit', 'Save'); ?>
    <?php echo form_close(); ?>
</div>




