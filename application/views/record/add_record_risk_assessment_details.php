 <div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>Add Risk Assessment</p>
    </div>
    <?php echo form_open_multipart("record/risk_assessment_insertion"); ?>
	<div class="container" id="add_record_form_section_risk_assessment">
        <div height="30px">&nbsp;</div>
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
        <?php
        echo form_fieldset('Risk Assessment');
        ?>
        <table>
			<tr>
                <td id="label1">Manchester Score</td>
            </tr>
			<tr>
                <td id="label2" colspan="3">At consent</td>
            </tr>
            <tr>
                <td>
                    <?php echo $ms_at_consent_BRCA1; ?>: 
                     <?php echo form_input('ms_at_consent_BRCA1'); ?>
                </td>
               <td>
                    <?php echo $ms_at_consent_BRCA2; ?>: 
                    <?php echo form_input('ms_at_consent_BRCA2'); ?>
                </td>
                <td>
					<?php echo $ms_at_consent_Total; ?>: 
                    <?php echo form_input('ms_at_consent_Total'); ?>
				</td>
            </tr>
			<tr>
                <td id="label2" colspan="3">Adjusted</td>
            </tr>
            <tr>
                <td>
                    <?php echo $ms_adjusted_BRCA1; ?>: 
                    <?php echo form_input('ms_after_gc_BRCA1'); ?>
                </td>
               <td>
                    <?php echo $ms_adjusted_BRCA2; ?>: 
                    <?php echo form_input('ms_after_gc_BRCA2'); ?>
                </td>
               <td>
                    <?php echo $ms_adjusted_Total; ?>: 
                    <?php echo form_input('ms_after_gc_Total'); ?>
                </td>
            </tr>
			<tr>
                <td id="label2" colspan="3">After GC</td>
            </tr>
            <tr>
                <td>
                    <?php echo $ms_after_gc_BRCA1; ?>: 
                    <?php echo form_input('ms_after_gc_BRCA1'); ?>
                </td>
               <td>
                    <?php echo $ms_after_gc_BRCA2; ?>: 
                    <?php echo form_input('ms_after_gc_BRCA2'); ?>
                </td>
               <td>
                    <?php echo $ms_after_gc_Total; ?>: 
                    <?php echo form_input('ms_after_gc_Total'); ?>
                </td>
            </tr>
		</table>
		<div height="30px">&nbsp;</div>
		<table>
			<tr>
                <td id="label1">BOADICEA</td>
            </tr>
			<tr>
                <td id="label2" colspan="3">At consent</td>
            </tr>
            <tr>
                <td>
                    <?php echo $BOADICEA_at_consent_BRCA1; ?>: 
                    <?php echo form_input('BOADICEA_at_consent_BRCA1'); ?>
                </td>
                <td>
                    <?php echo $BOADICEA_at_consent_BRCA2; ?>: 
                    <?php echo form_input('BOADICEA_at_consent_BRCA2'); ?>
                </td>
                <td>
                    <?php echo $BOADICEA_at_consent_no_mutation; ?>: 
                     <?php echo form_checkbox('BOADICEA_at_consent_no_mutation', '1', FALSE); ?>
                </td>
            </tr>
			<tr>
                <td id="label2" colspan="3">Adjusted</td>
            </tr>
            <tr>
               <td>
                    <?php echo $BOADICEA_adjusted_BRCA1; ?>: 
                    <?php echo form_input('BOADICEA_adjusted_BRCA1'); ?>
                </td>
                <td>
                    <?php echo $BOADICEA_adjusted_BRCA2; ?>: 
                    <?php echo form_input('BOADICEA_adjusted_BRCA2'); ?>
                </td>
                <td>
                    <?php echo $BOADICEA_adjusted_no_mutation; ?>: 
                    <?php echo form_checkbox('BOADICEA_adjusted_no_mutation', '1', FALSE); ?>
                </td>
            </tr>
			<tr>
                <td id="label2" colspan="3">After GC</td>
            </tr>
            <tr>
                 <td>
                    <?php echo $BOADICEA_after_gc_BRCA1; ?>: 
                    <?php echo form_input('BOADICEA_after_gc_BRCA1'); ?>
                </td>
                <td>
                    <?php echo $BOADICEA_after_gc_BRCA2; ?>: 
                    <?php echo form_input('BOADICEA_after_gc_BRCA2'); ?>
                </td>
                <td>
                    <?php echo $BOADICEA_after_gc_no_mutation; ?>: 
					<?php echo form_checkbox('BOADICEA_after_gc_no_mutation', '1', FALSE); ?>
                </td>
            </tr>
        </table>
		<div height="30px">&nbsp;</div>
		<table>
			<tr>
                <td id="label1">Gail Model</td>
            </tr>
			<tr>
                <td id="label2" colspan="2">At consent</td>
            </tr>
            <tr>
                <td>
                    <?php echo $gail_model_at_consent_5years; ?>: 
                    <?php echo form_input('gail_model_at_consent_5years'); ?>
                </td>
                <td>
                    <?php echo $gail_model_at_consent_10years; ?>: 
                    <?php echo form_input('gail_model_at_consent_10years'); ?>
            </tr>
			<tr>
                <td id="label2" colspan="2">First mammogram</td>
            </tr>
            <tr>
                <td>
                    <?php echo $gail_model_first_mammo_5years; ?>: 
                    <?php echo form_input('gail_model_first_mammo_5years'); ?>
                </td>
                <td>
                    <?php echo $gail_model_first_mammo_10years; ?>: 
                    <?php echo form_input('gail_model_first_mammo_10years'); ?>
            </tr>
        </table>
        <?php echo form_fieldset_close(); ?>
    </div>
</div>