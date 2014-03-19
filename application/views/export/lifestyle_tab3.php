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
                    <th style="background-color:Crimson;">Patient IC No</th>
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
            <?php if (!empty($patient_parity_table)){ ?>
            <?php $no = 1; foreach ($patient_parity_table as $parity_table){ ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $parity_table['patient_ic_no']; ?></td>
                    <td><?php echo $studies_id[$patient_studies_id[$parity_table['patient_studies_id']]]; ?></td>
                    <td><?php echo $checkbox_status[$parity_table['pregnant_flag']]; ?></td>
                    <td><?php echo $parity_table['pregnancy_type']; ?></td>
                    <td><?php echo $parity_table['gender']; ?></td>
                    <td><?php echo $parity_table['date_of_birth']; ?></td>
                    <td><?php echo $parity_table['age_child_at_consent']; ?></td>
                    <td><?php echo $parity_table['birthweight']; ?></td>
                    <td><?php echo $parity_table['breastfeeding_duration']; ?></td>
                    <td><?php echo $parity_table['year_of_birth']; ?></td>
            <?php $no++; } ?>
                        <?php } else { ?>
                <?php } ?>
                </tr>
        </table>
