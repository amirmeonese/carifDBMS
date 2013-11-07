<div class="container" id="view_record_div">
    <div id="report_header" class="row">
        <p>View Personal Information</p>
    </div>
    <?php //echo form_open['report/process_report']; ?>
    <div class="container" id="report_form_section">
        <div height="30px">&nbsp;</div>
        <table>
            <tr height="50px"><td width="10%" >
                    <?php echo $fullname; ?></td>
                <td>: </td>
                <td width="25%"><?php echo form_input(array('name' => 'surname', 'value' => $patient_detail['surname'])) ?></td>
                <td width="10%">
                    <?php echo $surname; ?></td>
                <td>:</td> 
                <td  width="25%"><?php echo $patient_detail['surname']; ?>
                </td><td width="10%">
                    <?php echo $maiden_name; ?></td>
                <td>:</td>  
                <td width="30%"><?php echo $patient_detail['maiden_name']; ?>
                </td></tr>
            <tr height="50px"><td>
                    <?php echo $IC_no; ?></td>
                <td>:</td>  
                <td><?php echo $patient_detail['ic_no']; ?>
                </td><td>
                    <?php echo $nationality; ?> </td>
                <td>:</td>
                <td><?php echo $patient_detail['nationality']; ?>
                </td><td>
                    <?php echo $DOB; ?></td>
                <td>:</td> 
                <td><?php echo $patient_detail['d_o_b']; ?>
                </td></tr>


            <tr height="50px"><td>
                    <?php echo $pedigree_label; ?></td>
                <td>:</td> 
                <td><?php echo $patient_detail['padigree_labelling']; ?>
                </td>
                <td>
                    <?php echo $gender; ?></td>
                <td>:</td> 
                <td><?php echo $patient_detail['gender']; ?>
                </td><td>
                    <?php echo $ethinicity; ?></td>
                <td>:</td>
                <td><?php echo $patient_detail['ethnicity']; ?>
                </td></tr>
            <tr height="50px"><td>
                    <?php echo $blood_group; ?></td>
                <td>:</td> 
                <td><?php echo $patient_detail['blood_group']; ?>

                </td><td>
                    <?php echo $comment; ?></td>
                <td>:</td>
                <td><?php echo $patient_detail['comment']; ?>

                </td><td>
                    <?php echo $hospital_no; ?></td>
                <td>:</td> 
                <td> <?php echo $patient_detail['hospital_no']; ?>                    
                </td></tr>

            <tr height="50px"><td>
                    <?php echo $family_no; ?></td>
                <td>:</td>
                <td><?php echo $patient_detail['family_no']; ?>
                </td>
                <td>
                    <?php echo $place_of_birth; ?></td>
                <td>:</td>
                <td><?php echo $patient_detail['place_of_birth']; ?>
                </td>
                <td>
                    <?php echo $income_level; ?></td>
                <td>:</td>
                <td><?php echo $patient_detail['income_level']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $home_phone; ?></td>
                <td>:</td>
                <td><?php echo $patient_detail['home_phone']; ?>
                </td>
                <td>
                    <?php echo $cell_phone; ?></td>
                <td>:</td>
                <td><?php echo $patient_detail['cell_phone']; ?>
                </td>
                <td>
                    <?php echo $work_phone; ?></td>
                <td>:</td>
                <td><?php echo $patient_detail['work_phone']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $height; ?></td>
                <td>:</td>
                <td><?php echo $patient_detail['height']; ?>
                </td>
                <td>
                    <?php echo $weight; ?></td>
                <td>:</td>
                <td><?php echo $patient_detail['weight']; ?>
                </td>
                <td>
                    <?php echo $BMI; ?></td>
                <td>:</td>
                <td><?php echo $patient_detail['bmi']; ?>
                </td>

            </tr>
            <tr height="50px">
                <td>
                    <?php echo $still_alive_flag; ?></td>
                <td>:</td>
                <td><?php echo $patient_detail['is_dead'];?>
                </td>
                <td>
                    <?php echo $DOD; ?></td>
                <td>:</td>
                <td><?php //echo $patient_detail['d_o_d'];?>
                </td>
                <td>
                    <?php echo $reason_of_death; ?></td>
                <td>:</td>
                <td><?php
                    echo $patient_detail['reason_of_death'];
                    ?>
                </td>
            </tr>

            <tr height="50px">
                <td>
                    <?php echo $marital_status; ?></td>
                <td>:</td>
                <td><?php echo $patient_detail['marital_status']; ?>
                </td>
                <td>
                    <?php echo $is_blood_card_exist; ?></td>
                <td>:</td>
                <td><?php echo $patient_detail['blood_card']; ?>
                </td>
                <td>
                    <?php echo $blood_card_location; ?></td>
                <td>:</td>
                <td><?php echo $patient_detail['blood_card_location']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $status_source; ?></td>
                <td>:</td>
                <td><?php echo @$patient_detail['status_source']; ?>
                </td>
                <td>
                    <?php echo $alive_status; ?></td>
                <td>:</td>
                <td><?php echo @$patient_detail['alive_status']; ?>
                </td>
                <td>
                    <?php echo $status_gathered_date; ?></td>
                <td>:</td>
                <td><?php echo @$patient_detail['status_gathered_date']; ?>
                </td>

            </tr>
            <tr height="50px">

                <td>
                    <?php echo $private_patient_no; ?></td>
                <td>:</td>
                <td><?php echo @$patient_detail['private_patient_no']; ?>
                </td>
                <td>
                    <?php echo $address; ?></td>
                <td>:</td>
                <td><?php echo $patient_detail['address']; ?>
                </td>
            </tr>

        </table>
        </br>
    </div>
</div>


