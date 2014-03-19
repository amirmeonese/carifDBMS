<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=export_personal_data.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<p>Other Screening</p>
<div height="30px">&nbsp;</div>

<table border="1">
    <thead>
                <tr>
                    <th style="background-color:Crimson;">No</th>
                    <th style="background-color:Crimson;">Patient IC No</th>
                    <th style="background-color:Crimson;">Studies Name</th>
                    <th style="background-color:Crimson;">Screening type</th>
                    <th style="background-color:Crimson;">Age at screening</th>
                    <th style="background-color:Crimson;">Screening center</th>
                    <th style="background-color:Crimson;">Screening results</th>
                </tr>
            </thead>
            <?php $no = 1; foreach ($patient_other_screening as $list): ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $list['patient_ic_no']; ?></td>
                    <td><?php echo $studies_id[$patient_studies_id[$list['patient_studies_id']]]; ?></td>
                    <td><?php echo $list['screening_type']; ?></td>
                    <td><?php echo $list['age_at_screening']; ?></td>
                    <td><?php echo $list['screening_center']; ?></td>
                    <td><?php echo $list['screening_result']; ?></td>
                </tr>
            <?php $no++; endforeach; ?>
        </table>
