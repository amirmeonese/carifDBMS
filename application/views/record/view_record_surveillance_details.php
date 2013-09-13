<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>Add Surveillance Details</p>
    </div>
    <div class="container" id="add_record_form_section_studies">
        <div height="30px">&nbsp;</div>
        <table>
            <tr height="50px">
                <td width="15%">
                    <?php echo $surveillance_recruitment_center; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_surveillance['surveillance_recruitment_center']; ?>
                </td>
                <td width="15%">
                    <?php echo $surveillance_type; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_surveillance['surveillance_type']; ?>
                </td>
                <td width="15%">&nbsp;</td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $surveillance_first_consultation_date; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_surveillance['surveillance_first_consultation_date']; ?>
                </td>
                <td>
                    <?php echo $surveillance_first_consultation_place; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_surveillance['surveillance_first_consultation_place']; ?>
                </td>
                <td>
                    <?php echo $surveillance_interval; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_surveillance['surveillance_interval']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $surveillance_diagnosis; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_surveillance['surveillance_diagnosis']; ?>
                </td>
                <td>
                    <?php echo $surveillance_due_date; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_surveillance['surveillance_due_date']; ?>
                </td>
                <td>
                    <?php echo $surveillance_reminder_sent_date; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_surveillance['surveillance_reminder_sent_date']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $surveillance_done_date; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_surveillance['surveillance_done_date']; ?>
                </td>
                <td>
                    <?php echo $surveillance_reminded_by; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_surveillance['surveillance_reminded_by']; ?>
                </td>
                <td>
                    <?php echo $surveillance_timing; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_surveillance['surveillance_timing']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $surveillance_symptoms; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_surveillance['surveillance_timing']; ?>
                </td>
                <td>
                    <?php echo $surveillance_doctor_name; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_surveillance['surveillance_doctor_name']; ?>
                </td>
                <td>
                    <?php echo $surveillance_place; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_surveillance['surveillance_place']; ?>
                </td>
            </tr>
            <tr height="50px">
                <td>
                    <?php echo $surveillance_outcome; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_surveillance['surveillance_timing']; ?>
                </td>
                <td>
                    <?php echo $surveillance_comments; ?></td>
                    <td>:</td>
                    <td><?php echo @$patient_surveillance['surveillance_timing']; ?>
                </td>
                <td>&nbsp;</td>
            </tr>
        </table>
<!--                <a align="center" class="doneButton" href="<?php echo base_url(); ?>">Done</a>-->
    </div>
</div>




