<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>Add Family Details</p>
    </div>
    <?php echo form_open('record/patient_family_record_insertion'); ?>
    <div class="container" id="add_record_form_section_1">
        <div height="30px">&nbsp;</div>
        <?php
        echo form_fieldset('Father Details');
        ?>
        <table>
            <tr>
                <td>
                    <?php echo $father_fullname; ?>: 
                    <?php echo form_input('father_fullname'); ?>
                </td>
                <td>
                    <?php echo $father_surname; ?>: 
                    <?php echo form_input('father_surname'); ?>
                </td>
                <td>
                    <?php echo $father_maiden_name; ?>: 
                    <?php echo form_input('father_maiden_name'); ?>
                </td>
                <td>
                    <?php echo $family_no; ?>: 
                    <?php echo form_input('family_no'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $father_ethnicity; ?>: 
                    <?php echo form_input('father_ethncity'); ?>
                </td>
                <td>
                    <?php echo $father_town_residence; ?>: 
                    <?php echo form_input('father_town_residence'); ?>
                </td>
                <td>
                    <?php echo $father_DOB; ?>: 
                    <?php echo form_input('father_DOB'); ?>
                </td>
                 <td>
                    <?php echo $IC_no; ?>: 
                    <?php echo form_input('IC_no'); ?>

                </td>

            </tr>
            <tr>
                <td>
                    <?php echo $father_still_alive_flag; ?>: 
                    <?php echo form_checkbox('father_still_alive_flag', '1', TRUE); ?>
                </td>
                <td>
                    <?php echo $father_DOD; ?>: 
                    <?php echo form_input('father_DOD'); ?>
                </td>
                <td>
                    <?php echo $father_is_cancer_diagnosed; ?>: 
                    <?php echo form_checkbox('father_is_cancer_diagnosed', '1', FALSE); ?>
                </td>
                <td>
                    <?php echo $father_date_of_diagnosis; ?>: 
                    <?php echo form_input('father_date_of_diagnosis'); ?>
                </td>

            </tr>
            <tr>
                <td>
                    <?php echo $father_cancer_name; ?>: 
                    <?php echo form_input('father_cancer_name'); ?>
                </td>
                <td>
                    <?php echo $father_age_of_diagnosis; ?>: 
                    <?php echo form_input('father_age_of_diagnosis'); ?>
                </td>
                <td>
                    <?php echo $father_diagnosis_other_details; ?>: 
                    <?php
                    $data = array(
                        'name' => 'father_diagnosis_other_details',
                        'id' => 'father_diagnosis_other_details',
                        'rows' => '3',
                        'cols' => '7'
                    );
                    echo form_textarea($data);
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $father_no_of_brothers; ?>: 
                    <?php echo form_input('father_no_of_brothers'); ?>
                </td>
                <td>
                    <?php echo $father_no_of_sisters; ?>: 
                    <?php echo form_input('father_no_of_sisters'); ?>
                </td>
                <td>&nbsp;</td>
				<td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo $father_vital_status; ?>: 
                    <?php echo form_input('father_vital_status'); ?>
                </td>
                <td>
                    <?php echo $father_mach_score_at_consent; ?>: 
                    <?php echo form_input('father_mach_score_at_consent'); ?>
                </td>
                <td>
                    <?php echo $father_mach_score_past_consent; ?>: 
                    <?php echo form_input('father_mach_score_past_consent'); ?>
                </td>
                <td>
                    <?php echo $father_FH_category; ?>: 
                    <?php echo form_input('father_FH_category'); ?>
                </td>
            </tr>
        </table>
        <?php echo form_fieldset_close(); ?>		
    </div>
    <div class="container" id="add_record_form_section_2">
        <div height="30px">&nbsp;</div>
        <?php
        echo form_fieldset('Mother Details');
        ?>
        <table>
            <tr>
                <td>
                    <?php echo $mother_fullname; ?>: 
                    <?php echo form_input('mother_fullname'); ?>
                </td>
                <td>
                    <?php echo $mother_surname; ?>: 
                    <?php echo form_input('mother_surname'); ?>
                </td>
                <td>
                    <?php echo $mother_maiden_name; ?>: 
                    <?php echo form_input('mother_maiden_name'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $mother_ethnicity; ?>: 
                    <?php echo form_input('mother_ethnicity'); ?>
                </td>
                <td>
                    <?php echo $mother_town_residence; ?>: 
                    <?php echo form_input('mother_town_residence'); ?>
                </td>
                <td>
                    <?php echo $mother_DOB; ?>: 
                    <?php echo form_input('mother_DOB'); ?>
                </td>
                <td>
                    <?php echo $mother_still_alive_flag; ?>: 
                    <?php echo form_checkbox('mother_still_alive_flag', '1', TRUE); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $mother_DOD; ?>: 
                    <?php echo form_input('mother_DOD'); ?>
                </td>
                <td>
                    <?php echo $mother_is_cancer_diagnosed; ?>: 
                    <?php echo form_checkbox('mother_is_cancer_diagnosed', '1', FALSE); ?>
                </td>
                <td>
                    <?php echo $mother_date_of_diagnosis; ?>: 
                    <?php echo form_input('mother_date_of_diagnosis'); ?>
                </td>
                <td>
                    <?php echo $mother_cancer_name; ?>: 
                    <?php echo form_input('mother_cancer_name'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $mother_age_of_diagnosis; ?>: 
                    <?php echo form_input('mother_age_of_diagnosis'); ?>
                </td>
                <td>
                    <?php echo $mother_diagnosis_other_details; ?>: 
                    <?php
                    $data = array(
                        'name' => 'mother_diagnosis_other_details',
                        'id' => 'mother_diagnosis_other_details',
                        'rows' => '3',
                        'cols' => '7'
                    );
                    echo form_textarea($data);
                    ?>
                </td>
				<td>
                    <?php echo $mother_no_of_brothers; ?>: 
                    <?php echo form_input('mother_no_of_brothers'); ?>
                </td>
                <td>
                    <?php echo $mother_no_of_sisters; ?>: 
                    <?php echo form_input('mother_no_of_sisters'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $mother_vital_status; ?>: 
                    <?php echo form_input('mother_vital_status'); ?>
                </td>
                <td>
                    <?php echo $mother_mach_score_at_consent; ?>: 
                    <?php echo form_input('mother_mach_score_at_consent'); ?>
                </td>
                <td>
                    <?php echo $mother_mach_score_past_consent; ?>: 
                    <?php echo form_input('mother_mach_score_past_consent'); ?>
                </td>
                <td>
                    <?php echo $mother_FH_category; ?>: 
                    <?php echo form_input('mother_FH_category'); ?>
                </td>
            </tr>
        </table>
    </div>
    <input type="button" value="Add more relative record" onClick="window.parent.addInput('add_record_form_section_2');
            window.parent.calcHeight();"></br>
           <?php echo form_fieldset_close(); ?>	
           <?php echo form_submit('mysubmit', 'Save'); ?>
           <?php echo form_close(); ?>
</div>




