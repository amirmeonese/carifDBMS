<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=export_diagnosis1_data.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<p>Other Diseases</p>
<div height="30px">&nbsp;</div>

<table border="1">
    <thead>
                <tr>
                    <th style="background-color:Crimson;">No</th>
                    <th style="background-color:Crimson;">Studies Name</th>
                    <th style="background-color:Crimson;">Type of diseases</th>
                    <th style="background-color:Crimson;">Date of diagnosis</th>
                    <th style="background-color:Crimson;">Age at diagnosis</th>
                    <th style="background-color:Crimson;">Diagnosis centre</th>
                    <th style="background-color:Crimson;">Diagnosis doctor's name</th>
                    <th style="background-color:Crimson;">Is on medication?</th>
                    <th style="background-color:Crimson;">Type of medication</th>
                    <th style="background-color:Crimson;">Medication start date</th>
                    <th style="background-color:Crimson;">Medication end date</th>
                    <th style="background-color:Crimson;">Medication duration</th>
                    <th style="background-color:Crimson;">Comments</th>
                </tr>
            </thead>
            <?php $no = 1; foreach ($patient_other_disease as $list): ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $list['patient_studies_id']; ?></td>
                    <td><?php echo $list['diagnosis_id']; ?></td>
                    <td><?php echo $list['date_of_diagnosis']; ?></td>
                    <td><?php echo $list['diagnosis_age']; ?></td>
                    <td><?php echo $list['diagnosis_center']; ?></td>
                    <td><?php echo $list['doctor_name']; ?></td>
                    <td><?php echo $list['on_medication_flag']; ?></td>
                    <td><?php echo $list['medication_type']; ?></td>
                    <td><?php echo $list['start_date']; ?></td>
                    <td><?php echo $list['end_date']; ?></td>
                    <td><?php echo $list['duration']; ?></td>
                    <td><?php echo $list['comments']; ?></td>
                    
                </tr>
            <?php $no++; endforeach; ?>
        </table>
