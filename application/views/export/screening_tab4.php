<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=export_screening4_data.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<p>Ovarian Screening</p>
<div height="30px">&nbsp;</div>

<table border="1">
    <thead>
                <tr>
                    <th style="background-color:Crimson;">No</th>
                    <th style="background-color:Crimson;">Studies Name</th>
                    <th style="background-color:Crimson;">Ovarian screening type</th>
                    <th style="background-color:Crimson;">Date</th>
                    <th style="background-color:Crimson;">Is abnormality detected?</th>
                    <th style="background-color:Crimson;">Additional Info:</th>
                </tr>
            </thead>
            <?php $no = 1; foreach ($patient_ovarian_screening as $list): ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $list['patient_studies_id']; ?></td>
                    <td><?php echo $ovarian_screening[$list['ovarian_screening_type_id']]; ?></td>
                    <td><?php echo $list['screening_date']; ?></td>
                    <td><?php echo $list['is_abnormality_detected']; ?></td>
                    <td><?php echo $list['additional_info']; ?></td>
                </tr>
            <?php $no++; endforeach; ?>
        </table>
