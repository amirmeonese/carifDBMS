<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>View Risk Assessment</p>
    </div>
    <?php
    $attributes = array('id' => 'risk-assessment-details-form');
    echo form_open("record/risk_assessment_insertion", $attributes);
    ?>
    <div class="container" id="add_record_form_section_risk_assessment">
        <div height="30px">&nbsp;</div>
        <div height="30px">&nbsp;</div>
       <?php foreach ($patient_risk_assessment as $list): ?>
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
                        <?php echo form_input(array('name' => 'ms_at_consent_BRCA1', 'value' => $list['at_consent_mach_brca1']))?>
                    </td>
                    <td>
                        <?php echo $ms_at_consent_BRCA2; ?>: 
                        <?php echo form_input(array('name' => 'ms_at_consent_BRCA2', 'value' => $list['at_consent_mach_brca2']))?>
                    </td>
                    <td>
                        <?php echo $ms_at_consent_Total; ?>: 
                        <?php echo form_input(array('name' => 'ms_at_consent_Total', 'value' => $list['at_consent_mach_total']))?>
                    </td>
                </tr>
                <tr>
                    <td id="label2" colspan="3">Adjusted</td>
                </tr>
                <tr>
                    <td>
                        <?php echo $ms_adjusted_BRCA1; ?>: 
                        <?php echo form_input(array('name' => 'ms_adjusted_gc_BRCA1', 'value' => $list['adjusted_mach_brca1']))?>
                    </td>
                    <td>
                        <?php echo $ms_adjusted_BRCA2; ?>: 
                        <?php echo form_input(array('name' => 'ms_adjusted_gc_BRCA2', 'value' => $list['adjusted_mach_brca2']))?>
                    </td>
                    <td>
                        <?php echo $ms_adjusted_Total; ?>: 
                        <?php echo form_input(array('name' => 'ms_adjusted_gc_Total', 'value' => $list['adjusted_mach_total']))?>
                    </td>
                </tr>
                <tr>
                    <td id="label2" colspan="3">After GC</td>
                </tr>
                <tr>
                    <td>
                        <?php echo $ms_after_gc_BRCA1; ?>: 
                        <?php echo form_input(array('name' => 'ms_after_gc_BRCA1', 'value' => $list['after_gc_brca1']))?>
                    </td>
                    <td>
                        <?php echo $ms_after_gc_BRCA2; ?>: 
                        <?php echo form_input(array('name' => 'ms_after_gc_BRCA2', 'value' => $list['after_gc_brca2']))?>
                    </td>
                    <td>
                        <?php echo $ms_after_gc_Total; ?>: 
                        <?php echo form_input(array('name' => 'ms_after_gc_Total', 'value' => $list['after_gc_total']))?>
                    </td>               
                </tr>
                <tr>
                    <td>
                        <input type="button" value="View Manchester Score " onClick="window.parent.addManchesterScoreInput('add_record_form_manchester_score1');
                                        window.parent.calcHeight();">
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
                        <?php echo form_input(array('name' => 'BOADICEA_at_consent_BRCA1', 'value' => $list['at_consent_boadicea_brca1']))?>
                    </td>
                    <td>
                        <?php echo $BOADICEA_at_consent_BRCA2; ?>: 
                        <?php echo form_input(array('name' => 'BOADICEA_at_consent_BRCA2', 'value' => $list['at_consent_boadicea_brca2']))?>
                    </td>
                    <td>
                        <?php echo $BOADICEA_at_consent_no_mutation; ?>: 
                        <?php echo form_checkbox(array('name' => 'BOADICEA_at_consent_no_mutation', 'value' => $list['at_consent_boadicea_no_mutation']))?>
                    </td>
                </tr>
                <tr>
                    <td id="label2" colspan="3">Adjusted</td>
                </tr>
                <tr>
                    <td>
                        <?php echo $BOADICEA_adjusted_BRCA1; ?>: 
                        <?php echo form_input(array('name' => 'BOADICEA_adjusted_BRCA1', 'value' => $list['adjusted_boadicea_brca1']))?>
                    </td>
                    <td>
                        <?php echo $BOADICEA_adjusted_BRCA2; ?>: 
                        <?php echo form_input(array('name' => 'BOADICEA_adjusted_BRCA2', 'value' => $list['adjusted_boadicea_brca2']))?>
                    </td>
                    <td>
                        <?php echo $BOADICEA_adjusted_no_mutation; ?>: 
                        <?php echo form_checkbox(array('name' => 'BOADICEA_adjusted_no_mutation', 'value' => $list['adjusted_boadicea_no_mutation']))?>
                    </td>
                </tr>
                <tr>
                    <td id="label2" colspan="3">After GC</td>
                </tr>
                <tr>
                    <td>
                        <?php echo $BOADICEA_after_gc_BRCA1; ?>: 
                        <?php echo form_input(array('name' => 'BOADICEA_after_gc_BRCA1', 'value' => $list['after_gc_boadicea_brca1']))?>
                    </td>
                    <td>
                        <?php echo $BOADICEA_after_gc_BRCA2; ?>: 
                        <?php echo form_input(array('name' => 'BOADICEA_after_gc_BRCA2', 'value' => $list['after_gc_boadicea_brca2']))?>
                    </td>
                    <td>
                        <?php echo $BOADICEA_after_gc_no_mutation; ?>: 
                        <?php echo form_checkbox(array('name' => 'BOADICEA_after_gc_no_mutation', 'value' => $list['after_gc_boadicea_no_mutation']))?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="button" value="View BOADICEA" onClick="window.parent.addBOADICEAInput('add_record_form_BOADICEA1');
                                        window.parent.calcHeight();">
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
                        <?php echo form_input(array('name' => 'gail_model_at_consent_5years', 'value' => $list['at_consent_gail_model_5years']))?>
                    </td>
                    <td>
                        <?php echo $gail_model_at_consent_10years; ?>: 
                        <?php echo form_input(array('name' => 'gail_model_at_consent_10years', 'value' => $list['at_consent_gail_model_10years']))?>
                </tr>
                <tr>
                    <td id="label2" colspan="2">First mammogram</td>
                </tr>
                <tr>
                    <td>
                        <?php echo $gail_model_first_mammo_5years; ?>: 
                        <?php echo form_input(array('name' => 'gail_model_first_mammo_5years', 'value' => $list['first_mammo_gail_model_5years']))?>
                    </td>
                    <td>
                        <?php echo $gail_model_first_mammo_10years; ?>: 
                        <?php echo form_input(array('name' => 'gail_model_first_mammo_10years', 'value' => $list['first_mammo_gail_model_10years']))?>
                </tr>
                <tr>
                    <td>
                        <input type="button" value="View Gail Model" onClick="window.parent.addGailModelInput('add_record_form_Gail_model_1');
                                        window.parent.calcHeight();">
                    </td>
                </tr>
            </table>
        </div>
        <?php echo form_fieldset_close(); ?>
        <?php endforeach; ?>
    </div>
    <?php echo form_submit('mysubmit', 'Save'); ?>
    <?php echo form_close(); ?>
</div>