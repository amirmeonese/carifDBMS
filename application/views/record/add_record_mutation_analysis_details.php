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
		<tr> 
			<td>
				 <label for="IC_no"><?php echo $IC_no; ?>: </label>
                    <?php echo form_input('IC_no'); ?>
			</td>
			<td>
				<label for="studies_name"><?php echo $studies_name; ?>: </label>
				<?php echo form_dropdown('studies_name', $studies_name_lists, NULL, 'id="studies_name"'); ?>
				<?php echo '<br/>'; ?>
			</td>
		</tr>
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
                    <?php echo form_input('test_ordered_by'); ?>
                </td>
                <td>
                    <?php echo $testing_results_notification_flag; ?>:  
                    <?php echo form_checkbox('testing_results_notification_flag', '1', FALSE); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $investigation_project_name; ?>:  <br />
					<?php echo form_dropdown('investigation_project_name',$investigation_project_name_lists, NULL, 'id="investigation_project_name_lists"'); ?>
                </td>
                <td>
                    <?php echo $investigation_project_batch; ?>:  <br />
                    <?php echo form_input('investigation_project_batch'); ?>
                </td>
				<td>
                    <?php echo $investigation_project_date; ?>:  <br />
					<?php echo form_input(array('name'=>'investigation_project_date','class'=>'datepicker')); ?>
                </td>
               <td>
                    <?php echo $investigation_gene_tested; ?>:  <br />
					<?php echo form_dropdown('investigation_gene_tested',$investigation_gene_tested_lists, NULL, 'id="investigation_gene_tested_lists"'); ?>
                </td>
            </tr>
            <tr>
				<td>
                    <?php echo $investigation_gene_tested_other; ?>:  <br />
                    <?php echo form_input('investigation_gene_tested_other'); ?>
                </td>
				<td>
                    <?php echo $investigation_test_type; ?>:  <br />
                    <?php echo form_dropdown('investigation_test_type',$investigation_test_type_lists, NULL, 'id="investigation_test_type_lists"'); ?>
                </td>
                <td>
                    <?php echo $investigation_sample_type; ?>:  <br />
                    <?php echo form_dropdown('investigation_sample_type',$investigation_sample_type_lists, NULL, 'id="investigation_sample_type_lists"'); ?>
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
                    <?php echo form_checkbox('investigation_new_mutation_flag', '1', FALSE); ?>
                </td>
			</tr>
            <tr>
                <td>
                    <?php echo $investigation_test_results; ?>:  <br />
					<?php echo form_dropdown('investigation_test_results',$investigation_test_results_lists, NULL, 'id="investigation_test_results_lists"'); ?>
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
					<?php echo form_dropdown('investigation_mutation_pathogenicity',$investigation_mutation_pathogenicity_lists, NULL, 'id="investigation_mutation_pathogenicity_lists"'); ?>
                </td>
                <td>
                    <?php echo $investigation_mutation_nomenclature; ?>:  <br />
                    <?php echo form_dropdown('investigation_mutation_nomenclature',$investigation_mutation_nomenclature_lists, NULL, 'id="investigation_mutation_nomenclature_lists"'); ?>
                </td>
                <td>
                    <?php echo $investigation_mutation_name; ?>: </br>
                    <?php echo form_input('investigation_mutation_name'); ?>
                </td>
                </td>
                <td>
                    <?php echo $investigation_mutation_type; ?>: </br>
                    <?php echo form_input('investigation_mutation_type'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $investigation_exon; ?>: </br>
                    <?php echo form_input('investigation_exon'); ?>
                </td>
                <td>
                    <?php echo $investigation_carrier_status; ?>:  <br />
                    <?php echo form_dropdown('investigation_carrier_status',$investigation_carrier_status_lists, NULL, 'id="investigation_carrier_status_lists"'); ?>
                </td>
                <td>
                    <?php echo $investigation_report_date; ?>: </br>
                    <?php echo form_input(array('name' => 'investigation_report_date', 'class' => 'datepicker')); ?>
                </td>
                <td>
                    <?php echo $investigation_date_notified; ?>:  <br />
                    <?php echo form_input(array('name' => 'investigation_date_notified', 'class' => 'datepicker')); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $mutation_is_counselling_flag; ?>:  
                    <?php echo form_checkbox('mutation_is_counselling_flag', '1', FALSE); ?>
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
                    <?php echo form_checkbox('investigation_conformation_attachment', '1', FALSE); ?>
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




