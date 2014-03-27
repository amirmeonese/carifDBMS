<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>Add Patient</p>
    </div>
    <?php
    $attributes = array('id' => 'personal-details-form');
    echo form_open("record/patient_consent_insert", $attributes);
    ?>
	<div class="container" id="add_consent_details_section">
        <div height="30px">&nbsp;</div>
        <table>
		<tr> 
			<td>
				 <label for="IC_no"><?php echo $IC_no; ?>: </label>
                    <?php echo form_input('IC_no'); ?>
			</td>
		</tr>
		</table>
        <?php
        echo form_fieldset('Consent Details');
        ?>
        <table>
            <tr>
                <td>
                    <?php echo $studies_name; ?>: 
                    <?php echo form_dropdown('studies_name', $studies_name_lists, NULL, 'id="studies_name"'); ?>
                </td>
		<td>
                    <?php echo $private_patient_no; ?>: 
                    <?php echo form_input('private_patient_no'); ?>
		</td>
                <td>
                    <?php echo $date_at_consent; ?>: 
					<?php echo form_input(array('name'=>'date_at_consent','class'=>'datepicker')); ?>
                </td>
                <td>
                    <?php echo $age_at_consent; ?>: 
                    <?php echo form_input('age_at_consent'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $is_double_consent_flag; ?>: 
                    <?php echo form_checkbox('is_double_consent_flag', '1', FALSE); ?>
                </td>
                <td>
                    <?php echo $consent_given_by; ?>: 
                    <?php echo form_input('consent_given_by'); ?>
                </td>
                <td>
                    <?php echo $consent_response; ?>: 
                    <?php echo form_input('consent_response'); ?>
                </td>
                <td>
                    <?php echo $consent_version; ?>: 
                    <?php echo form_input('consent_version'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $relations_to_study; ?>: 
                    <?php echo form_input('relations_to_study');?>
                </td>
                <td>
                    <?php echo $referral_to; ?>: 
                    <?php
                    echo form_input('referral_to');
                    ?>
                </td>
                <td>
                    <?php echo $referral_date; //referral to genetic counselling ?>:
                    <?php echo  form_dropdown('referral_date',$referral_to_genetic_counselling, NULL, 'id="referral_to_genetic_counselling"'); ?>
                </td>
                <td>
                    <?php echo $referral_source; ?>: 
                    <?php
                    echo form_input('referral_source');
                    ?>
                </td>
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




