<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>Add Pathology</p>
    </div>
    <?php echo form_open_multipart("record/surveillance_insertion"); ?>
    <div class="container" id="add_record_form_section_breast_cancer_pathology_section_1">
        <div height="30px">&nbsp;</div>
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
		</table>
		<div height="30px">&nbsp;</div>
        <?php
        echo form_fieldset('Pathology');
        ?>
        <table id="breast_cancer_pathology_section">
			<tr>
                <td id="label1">Breast Cancer Tumor Pathology</td>
				<td><input type="button" value="Add pathology" onClick="window.parent.addBreastCancerPathology('add_record_form_section_breast_cancer_pathology_section_1');
                            window.parent.calcHeight();"></td>
            </tr>
            <tr>
                <td>
                    <?php echo $breast_pathology_tissue_site; ?>: <br />
                     <?php echo form_dropdown('breast_pathology_tissue_site', $patient_cancer_site_lists); ?>
                </td>
				<td>
                    <?php echo $breast_pathology_path_report_type; ?>: <br />
                    <?php echo form_dropdown('breast_pathology_path_report_type', $pathology_path_report_type_lists); ?>
                </td>
				 <td>
                    <?php echo $breast_pathology_path_report_date; ?>: <br />
					<?php echo form_input(array('name'=>'breast_pathology_path_report_date','class'=>'datepicker')); ?>
                </td>
            </tr>
			<tr>
				 <td>
                    <?php echo $breast_pathology_lab; ?>: <br />
                    <?php echo form_input('breast_pathology_lab'); ?>
                </td>
				<td>
                    <?php echo $breast_pathology_doctor; ?>: <br />
                    <?php echo form_input('breast_pathology_doctor'); ?>
                </td>
			</tr>
            <tr>
				<td>
                    <?php echo $breast_pathology_morphology; ?>: <br />
                    <?php echo form_dropdown('breast_pathology_morphology', $pathology_morphology_lists); ?>
                </td>
				 <td>
                    <?php echo $breast_pathology_tissue_tumour_stage; ?>: <br />
                    <?php echo form_dropdown('breast_pathology_tissue_tumour_stage', $pathology_tissue_tumour_stage_lists); ?>
                </td>
                <td>
                    <?php echo $breast_pathology_node_stage; ?>: <br />
                    <?php echo form_dropdown('breast_pathology_node_stage', $pathology_node_stage_lists); ?>
                </td>
            </tr>
			<tr>
				 <td>
                    <?php echo $breast_pathology_metastasis_stage; ?>: <br />
                    <?php echo form_dropdown('breast_pathology_metastasis_stage', $pathology_metastasis_stage_lists); ?>
                </td>
				 <td>
                    <?php echo $breast_pathology_tumour_stage; ?>: <br />
                    <?php echo form_dropdown('breast_pathology_tumour_stage', $pathology_tumour_stage_lists); ?>
                </td>
				 <td>
                    <?php echo $breast_pathology_tumour_grade; ?>: <br />
                    <?php echo form_dropdown('breast_pathology_tumour_grade', $pathology_tumour_grade_lists); ?>
                </td>
			</tr>
			<tr>
				<td>
                    <?php echo $breast_pathology_total_lymph_nodes; ?>: <br />
                    <?php echo form_input('breast_pathology_total_lymph_nodes'); ?>
                </td>
				 <td>
                    <?php echo $breast_pathology_tumour_size; ?>: <br />
                    <?php echo form_input('breast_pathology_tumour_size'); ?>
                </td>
			</tr>
		</table>
		<div id="breast_cancer_staining_status_div_1">
			<table id="breast_cancer_staining_status_section_1">
				<tr>
					<td>
						<?php echo $breast_pathology_ER_status; ?>: <br />
						<?php echo form_input('breast_pathology_ER_status'); ?>
					</td>
					<td>
						<?php echo $breast_pathology_PR_status; ?>: <br />
						<?php echo form_input('breast_pathology_PR_status'); ?>
					</td>
					<td>
						<?php echo $breast_pathology_HER2_status; ?>: <br />
						<?php echo form_input('breast_pathology_HER2_status'); ?>
					</td>
					 <td>
						<input type="button" value="Add staining status" onClick="window.parent.addBreastCancerStainingStatusInput('breast_cancer_staining_status_div_1');
								window.parent.calcHeight();">
					</td>
				</tr>
			</table>
		</div>
		<table>
			<tr>
				<td>
					<?php echo $breast_pathology_tissue_path_comments; ?>: <br />
					<?php
					$data = array(
						'name' => 'breast_pathology_tissue_path_comments',
						'id' => 'breast_pathology_tissue_path_comments',
						'rows' => '3',
						'cols' => '7'
					);
					echo form_textarea($data);
					?>
				</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>
        <?php echo form_fieldset_close(); ?>	
    </div>
	<div class="container" id="add_record_form_section_ovary_cancer_pathology_section_1">
        <div height="30px">&nbsp;</div>
        <table id="ovary_cancer_pathology_section">
			<tr>
                <td id="label1">Ovarian Cancer Tumor Pathology</td>
				<td><input type="button" value="Add pathology" onClick="window.parent.addOvaryCancerPathology('add_record_form_section_ovary_cancer_pathology_section_1');
                            window.parent.calcHeight();"></td>
            </tr>
            <tr>
                <td>
                    <?php echo $ovary_pathology_tissue_site; ?>: <br />
                     <?php echo form_dropdown('ovary_pathology_tissue_site', $patient_cancer_site_lists); ?>
                </td>
				<td>
                    <?php echo $ovary_pathology_path_report_type; ?>: <br />
                    <?php echo form_dropdown('ovary_pathology_path_report_type', $pathology_path_report_type_lists); ?>
                </td>
				 <td>
                    <?php echo $ovary_pathology_path_report_date; ?>: <br />
					<?php echo form_input(array('name'=>'ovary_pathology_path_report_date','class'=>'datepicker')); ?>
                </td>
            </tr>
			<tr>
				 <td>
                    <?php echo $ovary_pathology_lab; ?>: <br />
                    <?php echo form_input('ovary_pathology_lab'); ?>
                </td>
				<td>
                    <?php echo $ovary_pathology_doctor; ?>: <br />
                    <?php echo form_input('ovary_pathology_doctor'); ?>
                </td>
			</tr>
            <tr>
				<td>
                    <?php echo $ovary_pathology_morphology; ?>: <br />
                    <?php echo form_dropdown('ovary_pathology_morphology', $pathology_morphology_lists); ?>
                </td>
				<td>
                    <?php echo $ovary_stage_classification; ?>: <br />
                    <?php echo form_dropdown('ovary_stage_classification', $ovary_stage_classification_lists); ?>
                </td>
				 <td>
                    <?php echo $ovary_pathology_tumour_stage; ?>: <br />
                    <?php echo form_dropdown('ovary_pathology_tumour_stage', $pathology_tumour_stage_lists); ?>
                </td>
            </tr>
			<tr>
				<td>
					<?php echo $ovary_pathology_tumour_grade; ?>: <br />
					<?php echo form_dropdown('ovary_pathology_tumour_grade', $pathology_tumour_grade_lists); ?>
				</td>
				<td>
					<?php echo $ovary_pathology_tumour_size; ?>: <br />
					<?php echo form_input('ovary_pathology_tumour_size'); ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo $ovary_pathology_tissue_path_comments; ?>: <br />
					<?php
					$data = array(
						'name' => 'ovary_pathology_tissue_path_comments',
						'id' => 'ovary_pathology_tissue_path_comments',
						'rows' => '3',
						'cols' => '7'
					);
					echo form_textarea($data);
					?>
				</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>
        <?php echo form_fieldset_close(); ?>	
    </div>
	<div class="container" id="add_record_form_section_other_cancer_pathology_section_1">
        <div height="30px">&nbsp;</div>
        <table id="other_cancer_pathology_section">
			<tr>
                <td id="label1">Other Cancer Tumor Pathology</td>
				<td><input type="button" value="Add pathology" onClick="window.parent.addOtherCancerPathology('add_record_form_section_other_cancer_pathology_section_1');
                            window.parent.calcHeight();"></td>
            </tr>
            <tr>
                <td>
                    <?php echo $other_pathology_tissue_site; ?>: <br />
                     <?php echo form_dropdown('other_pathology_tissue_site', $patient_cancer_site_lists); ?>
                </td>
				<td>
                    <?php echo $other_pathology_path_report_type; ?>: <br />
                    <?php echo form_dropdown('other_pathology_path_report_type', $pathology_path_report_type_lists); ?>
                </td>
				 <td>
                    <?php echo $other_pathology_path_report_date; ?>: <br />
					<?php echo form_input(array('name'=>'other_pathology_path_report_date','class'=>'datepicker')); ?>
                </td>
            </tr>
			<tr>
				 <td>
                    <?php echo $other_pathology_lab; ?>: <br />
                    <?php echo form_input('other_pathology_lab'); ?>
                </td>
				<td>
                    <?php echo $other_pathology_doctor; ?>: <br />
                    <?php echo form_input('other_pathology_doctor'); ?>
                </td>
			</tr>
			<tr>
				<td>
					<?php echo $other_pathology_tissue_path_comments; ?>: <br />
					<?php
					$data = array(
						'name' => 'other_pathology_tissue_path_comments',
						'id' => 'other_pathology_tissue_path_comments',
						'rows' => '3',
						'cols' => '7'
					);
					echo form_textarea($data);
					?>
				</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>
        <?php echo form_fieldset_close(); ?>	
    </div>
	<?php if ($userprivillage['add_privilege']== 1){ ?>
    <?php echo form_submit('mysubmit', 'Save'); ?>
    <?php } else { ?>
    <?php }?>
    <?php echo form_close(); ?>
</div>




