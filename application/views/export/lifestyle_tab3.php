<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=export_lifestyle3_data.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<p>Pregnancy</p>
<div height="30px">&nbsp;</div>

<table border="1">
    <thead>
                <tr>
                    <th style="background-color:Crimson;">No</th>
                    <th style="background-color:Crimson;">Studies Name</th>
                    <th style="background-color:Crimson;">Parity</th>
                    <th style="background-color:Crimson;">Pregnancy type</th>
                    <th style="background-color:Crimson;">Gender</th>
                    <th style="background-color:Crimson;">Date of birth</th>
                    <th style="background-color:Crimson;">Year of birth</th>
                    <th style="background-color:Crimson;">Age child at consent</th>
                    <th style="background-color:Crimson;">Birthweight</th>
                    <th style="background-color:Crimson;">Duration of breastfeeding</th>
                </tr>
            </thead>
            <?php $no = 1;  ?>
                <tr>
                    <?php if (!empty($patient_parity_table)){ ?>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $patient_parity_table['patient_studies_id']; ?></td>
                    <td><?php echo $patient_parity_table['pregnant_flag']; ?></td>
                    <?php } else { ?>
                <?php } ?>
                    <?php if (!empty($patient_parity_record)){ ?>
                    <td><?php echo $patient_parity_record['pregnancy_type']; ?></td>
                    <td><?php echo $patient_parity_record['gender']; ?></td>
                    <td><?php echo $patient_parity_record['date_of_birth']; ?></td>
                    <td><?php echo $patient_parity_record['age_child_at_consent']; ?></td>
                    <td><?php echo $patient_parity_record['birthweight']; ?></td>
                    <td><?php echo $patient_parity_record['breastfeeding_duration']; ?></td>
                    <td><?php echo $patient_parity_record['year_of_birth']; ?></td>
                    <?php } else { ?>
                <?php } ?>
                </tr>
            <?php $no++; ?>
        </table>
