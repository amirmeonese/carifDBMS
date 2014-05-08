<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=export_diagnosis_data.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<p>Diagnosis</p>
<div height="30px">&nbsp;</div>

<table border="1">
    <thead>
                <tr>
                    <th style="background-color:Crimson;">No</th>
                    <th style="background-color:Crimson;">Patient Ic No</th>
                    <th style="background-color:Crimson;">Patient No</th>
                    <th style="background-color:Crimson;">Studies Name</th>
                    <th style="background-color:Crimson;">Cancer Type</th>
                    <th style="background-color:Crimson;">Select site</th>
                    <th style="background-color:Crimson;">Cancer type (invasive/non-invasive)</th>
                    <th style="background-color:Crimson;">Is primary diagnosis?</th>
                    <th style="background-color:Crimson;">Date of diagnosis</th>
                    <th style="background-color:Crimson;">Age at diagnosis</th>
                    <th style="background-color:Crimson;">Diagnosis centre</th>
                    <th style="background-color:Crimson;">Doctor's name</th>
                    <th style="background-color:Crimson;">Detected by</th>
                    <th style="background-color:Crimson;">Bilateral</th>
                    <th style="background-color:Crimson;">Recurrent</th>
                </tr>
            </thead>
            <?php $no = 1; foreach ($patient_breast_cancer as $breast_cancer){ ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $breast_cancer['patient_ic_no']; ?></td>
                    <td><?php echo $breast_cancer['private_no']; ?></td>
                    <td><?php echo $studies_id[$patient_studies_id[$breast_cancer['patient_studies_id']]]; ?></td>
                    <td><?php echo @$cancer_name[$breast_cancer['cancer_id']]; ?></td>
                    <td><?php echo $site_cancer[$breast_cancer['cancer_site_id']]; ?></td>
                    <td><?php echo $breast_cancer['cancer_invasive_type']; ?></td>
                    <td><?php echo $checkbox_status[$breast_cancer['is_primary']]; ?></td>
                    <td><?php echo $breast_cancer['date_of_diagnosis']; ?></td>
                    <td><?php echo $breast_cancer['age_of_diagnosis']; ?></td>
                    <td><?php echo $breast_cancer['diagnosis_center']; ?></td>
                    <td><?php echo $breast_cancer['doctor_name']; ?></td>
                    <td><?php echo $breast_cancer['detected_by']; ?></td>
                    <td><?php echo $checkbox_status[$breast_cancer['bilateral_flag']]; ?></td>
                    <td><?php echo $checkbox_status[$breast_cancer['recurrence_flag']]; ?></td>
                </tr>
            <?php $no++; } ?>
                
        </table>
