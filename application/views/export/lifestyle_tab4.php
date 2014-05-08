<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=export_lifestyle4_data.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<p>Infertility, HRT & GNC Surgery</p>
<div height="30px">&nbsp;</div>

<table border="1">
    <thead>
                <tr>
                    <th style="background-color:Crimson;">No</th>
                    <th style="background-color:Crimson;">Patient IC No</th>
                    <th style="background-color:Crimson;">Patient No</th>
                    <th style="background-color:Crimson;">Studies Name</th>
                    <th style="background-color:Crimson;">Treatment for infertility?</th>
                    <th style="background-color:Crimson;">Type of treatment</th>
                    <th style="background-color:Crimson;">Duration</th>
                    <th style="background-color:Crimson;">Comment</th>
                    <th style="background-color:Crimson;">Contraceptive pills use?</th>
                    <th style="background-color:Crimson;">Active use?</th>
                    <th style="background-color:Crimson;">Start date</th>
                    <th style="background-color:Crimson;">End date</th>
                    <th style="background-color:Crimson;">Start age</th>
                    <th style="background-color:Crimson;">End Age</th>
                    <th style="background-color:Crimson;">Duration</th>
                    <th style="background-color:Crimson;">HRT use?</th>
                    <th style="background-color:Crimson;">Active use?</th>
                    <th style="background-color:Crimson;">Start date</th>
                    <th style="background-color:Crimson;">End date</th>
                    <th style="background-color:Crimson;">Start age</th>
                    <th style="background-color:Crimson;">End Age</th>
                    <th style="background-color:Crimson;">Duration</th>
                </tr>
            </thead>
            <?php if (!empty($patient_infertility)){ ?>
            <?php $no = 1; foreach ($patient_infertility as $infertility){ ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $infertility['patient_ic_no']; ?></td>
                    <td><?php echo $infertility['private_no']; ?></td>
                    <td><?php echo $studies_id[$patient_studies_id[$infertility['patient_studies_id']]]; ?></td>
                    <td><?php echo $checkbox_status[$infertility['infertility_testing_flag']]; ?></td>
                    <td><?php echo $infertility['infertility_treatment_type']; ?></td>
                    <td><?php echo $infertility['infertility_treatment_duration']; ?></td>
                    <td><?php echo $infertility['infertility_comments']; ?></td>
                    <td><?php echo $checkbox_status[$infertility['contraceptive_pills_flag']]; ?></td>
                    <td><?php echo $checkbox_status[$infertility['currently_taking_contraceptive_pills_flag']]; ?></td>
                    <td><?php echo $infertility['contraceptive_start_date']; ?></td>
                    <td><?php echo $infertility['contraceptive_end_date']; ?></td>
                    <td><?php echo $infertility['contraceptive_start_age']; ?></td>
                    <td><?php echo $infertility['contraceptive_end_age']; ?></td>
                    <td><?php echo $infertility['contraceptive_duration']; ?></td>
                    <td><?php echo $checkbox_status[$infertility['hrt_flag']]; ?></td>
                    <td><?php echo $checkbox_status[$infertility['currently_using_hrt_flag']]; ?></td>
                    <td><?php echo $infertility['hrt_start_date']; ?></td>
                    <td><?php echo $infertility['hrt_end_date']; ?></td>
                    <td><?php echo $infertility['hrt_start_age']; ?></td>
                    <td><?php echo $infertility['hrt_end_age']; ?></td>
                    <td><?php echo $infertility['hrt_duration']; ?></td>
                 </tr>
            <?php $no++; } ?>
                                    <?php } else { ?>
                <?php } ?>
        </table>
