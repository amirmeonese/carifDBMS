 <div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>Add Risk Assessment</p>
    </div>
	<?php 
	$attributes = array('id' => 'risk-assessment-details-form');
	echo form_open("record/risk_assessment_insertion", $attributes);
	?>
	<div class="container" id="add_record_form_section_risk_assessment">
        <div height="30px">&nbsp;</div>
		<div height="30px">&nbsp;</div>
		<table>
		<tr> 
			<td>
				<label for="IC_no"><?php echo $IC_no; ?>: </label>
                    <?php echo form_input('IC_no'); ?>
			</td>
		</tr>
		</table>
        <div class="container" id="add_record_form_manchester_score1">
        <div height="30px">&nbsp;</div>
        <?php
        echo form_fieldset('Risk Assessment');
        ?>
        <table id="manchester_score_1">
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
                    <?php echo form_input('ms_adjusted_gc_BRCA1'); ?>
                </td>
               <td>
                    <?php echo $ms_adjusted_BRCA2; ?>: 
                    <?php echo form_input('ms_adjusted_gc_BRCA2'); ?>
                </td>
               <td>
                    <?php echo $ms_adjusted_Total; ?>: 
                    <?php echo form_input('ms_adjusted_gc_Total'); ?>
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
            <tr>
            <td>
                                <input type="button" value="Add Manchester Score " onClick="window.parent.addManchesterScoreInput('add_record_form_manchester_score1'); window.parent.calcHeight();">
                            </td>
            </tr>
		</table>
        </div>
        <div class="container" id="add_record_form_BOADICEA1">
        <div height="30px">&nbsp;</div>
		<table id="BOADICEA_1">
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
            <tr>
            <td>
                                <input type="button" value="Add BOADICEA" onClick="window.parent.addBOADICEAInput('add_record_form_BOADICEA1'); window.parent.calcHeight();">
                            </td>
            </tr>
        </table>
        </div>
		<div class="container" id="add_record_form_Gail_model_1">
        <div height="30px">&nbsp;</div>
		<table id="Gail_model_1">
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
            <tr>
            <td>
                                <input type="button" value="Add Gail Model" onClick="window.parent.addGailModelInput('add_record_form_Gail_model_1'); window.parent.calcHeight();">
                            </td>
            </tr>
        </table>
        </div>
		 <?php echo form_fieldset_close(); ?>
		 <?php echo form_submit('mysubmit', 'Save'); ?>
        <?php echo form_close(); ?> 
</div>
     <?php echo form_submit('mysubmit', 'Save'); ?>
     <?php echo form_close(); ?>
</div>