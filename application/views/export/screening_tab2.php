<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=export_screening2_data.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<p>Surgery for Non-Cancer</p>
<div height="30px">&nbsp;</div>

<table border="1">
    <thead>
                <tr>
                    <th style="background-color:Crimson;">No</th>
                    <th style="background-color:Crimson;">Patient IC No</th>
                    <th style="background-color:Crimson;">Patient No</th>
                    <th style="background-color:Crimson;">Studies Name</th>
                    <th style="background-color:Crimson;">Surgery type</th>
                    <th style="background-color:Crimson;">Reason for surgery</th>
                    <th style="background-color:Crimson;">Date of surgery</th>
                    <th style="background-color:Crimson;">Age at surgery</th>
                    <th style="background-color:Crimson;">Comments</th>
                    <th style="background-color:Crimson;">Surgery type</th>
                    <th style="background-color:Crimson;">Reason for surgery</th>
                    <th style="background-color:Crimson;">Date of surgery</th>
                    <th style="background-color:Crimson;">Age at surgery</th>
                    <th style="background-color:Crimson;">Comments</th>
                </tr>
            </thead>
            <?php $no = 1; foreach ($patient_non_cancer as $list): ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $list['patient_ic_no']; ?></td>
                    <td><?php echo $list['private_no']; ?></td>
                    <td><?php echo $studies_id[$patient_studies_id[$list['patient_studies_id']]]; ?></td>
                    <td><?php echo $list['breast_surgery_type']; ?></td>
                    <td><?php echo $list['breast_reason_of_surgery']; ?></td>
                    <td><?php echo $list['breast_date_of_surgery']; ?></td>
                    <td><?php echo $list['breast_age_of_surgery']; ?></td>
                    <td><?php echo $list['breast_comments']; ?></td>
                    <td><?php echo $list['surgery_type']; ?></td>
                    <td><?php echo $list['reason_for_surgery']; ?></td>
                    <td><?php echo $list['date_of_surgery']; ?></td>
                    <td><?php echo $list['age_at_surgery']; ?></td>
                    <td><?php echo $list['comments']; ?></td>
                </tr>
            <?php $no++; endforeach; ?>
        </table>
