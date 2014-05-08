<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=export_screening3_data.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<p>Risk Reducing Surgery</p>
<div height="30px">&nbsp;</div>

<table border="1">
    <thead>
                <tr>
                    <th style="background-color:Crimson;">No</th>
                    <th style="background-color:Crimson;">Patient IC No</th>
                    <th style="background-color:Crimson;">Patient No</th>
                    <th style="background-color:Crimson;">Studies Name</th>
                    <th style="background-color:Crimson;">Had new lesion surgery?</th>
                    <th style="background-color:Crimson;">Select site</th>
                    <th style="background-color:Crimson;">Date</th>
                    <th style="background-color:Crimson;">Had complete removal?</th>
                    <th style="background-color:Crimson;">Select site</th>
                    <th style="background-color:Crimson;">Date</th>
                    <th style="background-color:Crimson;">Reason</th>
                </tr>
            </thead>
            <?php $no = 1; foreach ($patient_risk_reducing_surgery as $list): ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $list['patient_ic_no']; ?></td>
                    <td><?php echo $list['private_no']; ?></td>
                    <td><?php echo $studies_id[$patient_studies_id[$list['patient_studies_id']]]; ?></td>
                    <td><?php echo $checkbox_status[$list['had_new_lesion_surgery_flag']]; ?></td>
                    <td><?php echo @$non_cancerous_site[$list['lesion_non_cancerous_site_id']]; ?></td>
                    <td><?php echo $list['lesion_surgery_date']; ?></td>
                    <td><?php echo $checkbox_status[$list['had_complete_removal_surgery_flag']]; ?></td>
                    <td><?php echo $non_cancerous_site[$list['non_cancerous_site_id']]; ?></td>
                    <td><?php echo $list['surgery_date']; ?></td>
                    <td><?php echo $list['surgery_reason']; ?></td>
                </tr>
            <?php $no++; endforeach; ?>
        </table>
