<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>View Family Details</p>
    </div>
    <div class="container" id="add_record_form_section_1">
        <div height="30px">&nbsp;</div>
        <table>
            <tr height="50px">
                <td width="15%">
                    <?php echo $fullname; ?></td>
                <td>:</td>
                <td width="13%"><?php echo @$patient_family['full_name']; ?>
                </td>
                <td width="15%">
                    <?php echo $surname; ?></td>
                <td>:</td>
                <td width="13%"><?php echo @$patient_family['sur_name']; ?>
                </td>
                <td width="15%">
                    <?php echo $maiden_name; ?></td>
                <td>:</td>
                <td width="13%"><?php echo @$patient_family['maiden_name']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo 'Ethnicity'; ?></td>
                <td>:</td>
                <td>	<?php echo @$patient_family['ethnicity']; ?>
                </td>
                <td>
                    <?php echo 'Town Residence'; ?></td>
                <td>:</td>
                <td>	<?php echo @$patient_family['town_of_residence']; ?>
                </td>
                <td>
                    <?php echo $DOB; ?></td>
                <td>:</td>
                <td>	<?php echo @$patient_family['d_o_b']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $still_alive_flag; ?></td>
                <td>:</td>
                <td>	<?php echo @$patient_family['is_alive_flag']; ?>
                </td>
                <td>
                    <?php echo $DOD; ?></td> 
                <td>:</td>
                <td>	<?php echo @$patient_family['d_o_d']; ?>
                </td>
                <td>
                    <?php echo 'Is Cancer Diagnosed'; ?></td> 
                <td>:</td>
                <td>	<?php echo @$patient_family['is_cancer_diagnosed']; ?>
                </td>
                
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $date_of_diagnosis; ?></td>
                <td>:</td>
                <td>	<?php echo @$patient_family['date_of_diagnosis']; ?>
                </td>
                <td>
                    <?php echo 'Cancer Name'; ?></td>
                <td>:</td>
                <td>	<?php echo @$patient_family['cancer_type_id']; ?>
                </td>
                <td>
                    <?php echo $age_of_diagnosis; ?></td> 
                <td>:</td>
                <td>	<?php echo @$patient_family['age_of_diagnosis']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo 'Diagnosis Other Details'; ?></td>
                <td>:</td>
                <td>	<?php echo @$patient_family['other_detail']; ?>
                </td>
                <td>
                    <?php echo 'No of Brothers'; ?></td>
                <td>:</td>
                <td>	<?php echo @$patient_family['no_of_brothers']; ?>
                </td>
                <td>
                    <?php echo 'No of Sisters'; ?></td> 
                <td>:</td>
                <td>	<?php echo @$patient_family['no_of_sisters']; ?>
                </td>
                
            </tr>
            
            <tr height="50px">
              
                <td>
                    <?php echo 'Vital Status'; ?></td> 
                <td>:</td>
                <td>	<?php echo @$patient_family['vital_status']; ?>
                </td>
                <td>
                    <?php echo 'Mach Score at Consent'; ?></td>
                <td>:</td>
                <td>	<?php echo @$patient_family['match_score_at_consent']; ?>
                </td>
                <td>
                    <?php echo 'Mach Score Past Consent'; ?></td> 
                <td>:</td>
                <td>	<?php echo @$patient_family['match_score_past_consent']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo 'FH Category'; ?></td> 
                <td>:</td>
                <td>	<?php echo @$patient_family['fh_category']; ?>
                </td>
            </tr>
        </table>
<!--                <a align="center" class="doneButton" href="<?php echo base_url(); ?>">Done</a>-->
    </div>

</div>




