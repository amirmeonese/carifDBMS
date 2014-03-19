<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=export_lifestyle5_data.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<p>Patient gynaecological</p>
<div height="30px">&nbsp;</div>

<table border="1">
    <thead>
                <tr>
                    <th style="background-color:Crimson;">No</th>
                    <th style="background-color:Crimson;">Patient IC No</th>
                    <th style="background-color:Crimson;">Studies Name</th>
                    <th style="background-color:Crimson;">Has ever had gynaecological surgery?</th>
                    <th style="background-color:Crimson;">Surgery year</th>
                    <th style="background-color:Crimson;">Surgery type</th>
                    <th style="background-color:Crimson;">If there's other surgery type, please specify</th>
                </tr>
            </thead>
            <?php if (!empty($patient_gynaecological)){ ?>
            <?php $no = 1; foreach ($patient_gynaecological as $gynaecological){ ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $gynaecological['patient_ic_no']; ?></td>
                    <td><?php echo $studies_id[$patient_studies_id[$gynaecological['patient_studies_id']]]; ?></td>
                    <td><?php echo $checkbox_status[$gynaecological['had_gnc_surgery_flag']]; ?></td>
                    <td><?php echo $gynaecological['surgery_year']; ?></td>
                    <td><?php echo $gynaecological['treatment_id']; ?></td>
                    <td><?php echo $gynaecological['gnc_treatment_name_other_details']; ?></td>
                       </tr>
            <?php $no++; } ?>
                        <?php } else { ?>
                <?php } ?>
        </table>
