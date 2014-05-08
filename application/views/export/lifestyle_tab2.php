<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=export_lifestyle2_data.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<p>Hormonal Details</p>
<div height="30px">&nbsp;</div>

<table border="1">
    <thead>
                <tr>
                    <th style="background-color:Crimson;">No</th>
                    <th style="background-color:Crimson;">Patient IC No</th>
                    <th style="background-color:Crimson;">Patient No</th>
                    <th style="background-color:Crimson;">Studies Name</th>
                    <th style="background-color:Crimson;">Age of menarche</th>
                    <th style="background-color:Crimson;">Still having period?</th>
                    <th style="background-color:Crimson;">Period regularity</th>
                    <th style="background-color:Crimson;">Period cycle days</th>
                    <th style="background-color:Crimson;">Comment</th>
                    <th style="background-color:Crimson;">Age at menopause</th>
                    <th style="background-color:Crimson;">Date period stops</th>
                    <th style="background-color:Crimson;">Reason period stops</th>
                    <th style="background-color:Crimson;">Specify other reason why period stops</th>
                </tr>
            </thead>
            <?php if (!empty($patient_menstruation)){ ?>
            <?php $no = 1; foreach ($patient_menstruation as $lifestyle_factors){ ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $lifestyle_factors['patient_ic_no']; ?></td>
                    <td><?php echo $lifestyle_factors['private_no']; ?></td>
                    <td><?php echo $studies_id[$patient_studies_id[$lifestyle_factors['patient_studies_id']]]; ?></td>
                    <td><?php echo $lifestyle_factors['age_period_starts']; ?></td>
                    <td><?php echo $checkbox_status[$lifestyle_factors['still_period_flag']]; ?></td>
                    <td><?php echo $lifestyle_factors['period_type']; ?></td>
                    <td><?php echo $lifestyle_factors['period_cycle_days']; ?></td>
                    <td><?php echo $lifestyle_factors['period_cycle_days_other_details']; ?></td>
                    <td><?php echo $lifestyle_factors['age_at_menopause']; ?></td>
                    <td><?php echo $lifestyle_factors['date_period_stops']; ?></td>
                    <td><?php echo $lifestyle_factors['reason_period_stops']; ?></td>
                    <td><?php echo $lifestyle_factors['reason_period_stops_other_details']; ?></td>
                </tr>
            <?php $no++; } ?>
                       <?php } else { ?>
                <tr>
                </tr>
                <?php } ?>
        </table>
