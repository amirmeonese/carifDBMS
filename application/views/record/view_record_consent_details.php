<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>View Patient</p>
    </div>
    <?php
    $attributes = array('id' => 'personal-details-form');
    echo form_open("record/patient_consent_update", $attributes);
    ?>
<?php foreach ($patient_consent_detail as $list): ?>
        <div class="container" id="add_consent_details_section">
            <div height="30px">&nbsp;</div>
            <?php
            echo form_fieldset('Consent Details');
            ?>
            <table>
                <tr>
                    <td>
                        <label for="studies_name"> <?php echo $studies_name; ?>:</label>
                        <?php echo form_dropdown('studies_name[]', $studies_name_lists, @$studies_id[$list['studies_id']], 'id="studies_name" preload_val="' . @$studies_id[$list['studies_id']] . '"'); ?>                                                                                
                    </td>
                    <td>
                        <?php echo $private_patient_no; ?>: 
                        <?php echo form_input(array('name' => 'private_patient_no[]', 'value' => $list['private_no'])) ?>
                    </td>
                    <td>
                        <?php echo $date_at_consent; ?>:
                        <?php echo form_input(array('name' => 'date_at_consent[]', 'value' => $list['date_at_consent'] == '0000-00-00' ? '00-00-0000' : date('d-m-Y', strtotime($list['date_at_consent'])), 'class' => 'datepicker')) ?>                    
                    </td>
                    <td>
                        <?php echo $age_at_consent; ?>: 
                        <?php echo form_input(array('name' => 'age_at_consent[]', 'value' => $list['age_at_consent'])) ?>                    
                    </td>
                    </tr>
                <tr>
                    <?php if($list['double_consent_flag'] == 1){?>
                <td>
                        <?php echo $is_double_consent_flag; ?>: 
                        <input type="checkbox" name="is_double_consent_flag[]" checked="checked" value="<?php print $list['patient_studies_id']; ?>" />
                </td>
               <?php } else {?>
                <td>
                        <?php echo $is_double_consent_flag; ?>: 
                        <input type="checkbox" name="is_double_consent_flag[]" value="<?php print $list['patient_studies_id']; ?>" />
                </td>
               <?php } ?>
                    <td>
                        <?php echo $consent_given_by; ?>: 
                        <?php echo form_input(array('name' => 'consent_given_by[]', 'value' => $list['consent_given_by'])) ?>                   
                    </td>
                    <td>
                        <?php echo $consent_response; ?>: 
                        <?php echo form_input(array('name' => 'consent_response[]', 'value' => $list['consent_response'])) ?>
                    </td>
                    <td>
                        <?php echo $consent_version; ?>: 
                        <?php echo form_input(array('name' => 'consent_version[]', 'value' => $list['consent_version'])) ?>
                    </td>
                    </tr>
                <tr>
                    <td>
                        <?php echo $relations_to_study; ?>: 
                        <?php echo form_input(array('name' => 'relations_to_study[]', 'value' => $list['relation_to_study'])) ?>
                    </td>
                    <td>
                        <?php echo $referral_to; ?>: 
                        <?php echo form_input(array('name' => 'referral_to[]', 'value' => $list['referral_to'])) ?>                    
                    </td>
                    <td>
                        <?php echo $referral_date; //referral to genetic counselling ?>:
                        <?php echo form_dropdown('referral_date[]', $referral_to_genetic_counselling, $list['referral_to_genetic_counselling'], 'id="referral_to_genetic_counselling" preload_val="' . $list['referral_to_genetic_counselling'] . '"'); ?>
                    </td>
                    <td>
                        <?php echo $referral_source; ?>: 
                        <?php echo form_input(array('name' => 'referral_source[]', 'value' => $list['referral_source'])) ?>                    
                    </td>
                </tr>
                <input type="hidden" name="patient_private_no_id[]" value="<?php print $list['patient_private_no_id']; ?>"/>
                <input type="hidden" name="patient_studies_id[]" value="<?php print $list['patient_studies_id']; ?>"/>
                <input type="hidden" name="patient_ic_no" value="<?php print $list['patient_ic_no']; ?>"/>
            </table>

        <?php echo form_fieldset_close(); ?>	
        </div>
    <?php endforeach; ?>
    <?php if ($userprivillage['edit_privilege'] == 1) { ?>
        <?php echo form_submit('mysubmit', 'Update'); ?>
    <?php } else { ?>
    <?php } ?>
<?php echo form_close(); ?>
</div>




