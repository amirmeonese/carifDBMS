<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=export_diagnosis_data.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<p>Treatment</p>
<div height="30px">&nbsp;</div>

<table border="1">
    <thead>
                <tr>
                    <th style="background-color:Crimson;">No</th>
                    <th style="background-color:Crimson;">Patient Ic No</th>
                    <th style="background-color:Crimson;">Patient No</th>
                    <th style="background-color:Crimson;">Studies Name</th>
                    <th style="background-color:Crimson;">Cancer Type</th>
                    <th style="background-color:Crimson;">Treatment type</th>
                    <th style="background-color:Crimson;">Treatment details</th>
                    <th style="background-color:Crimson;">Treatment start date</th>
                    <th style="background-color:Crimson;">Treatment end date</th>
                    <th style="background-color:Crimson;">Treatment duration</th>
                    <th style="background-color:Crimson;">Treatment drug dose</th>
                    <th style="background-color:Crimson;">Treatment cycle</th>
                    <th style="background-color:Crimson;">Treatment frequency</th>
                    <th style="background-color:Crimson;">Treatment visidual desease</th>
                    <th style="background-color:Crimson;">Primary therapy outcome</th>
                    <th style="background-color:Crimson;">Comments</th>
                </tr>
            </thead>
            <?php $no = 1; foreach ($patient_treatment as $breast_cancer){ ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $breast_cancer['patient_ic_no']; ?></td>
                    <td><?php echo $breast_cancer['private_no']; ?></td>
                    <td><?php echo $studies_id[$patient_studies_id[$breast_cancer['patient_studies_id']]]; ?></td>
                    <td><?php echo @$cancer_name[$breast_cancer['cancer_id']]; ?></td>
                    <td><?php echo $treatment_type[$breast_cancer['treatment_id']]; ?></td>
                    <td><?php echo $breast_cancer['treatment_details']; ?></td>
                    <td><?php echo $breast_cancer['treatment_start_date']; ?></td>
                    <td><?php echo $breast_cancer['treatment_end_date']; ?></td>
                    <td><?php echo $breast_cancer['treatment_durations']; ?></td>
                    <td><?php echo $breast_cancer['treatment_drug_dose']; ?></td>
                    <td><?php echo $breast_cancer['treatment_cycle']; ?></td>
                    <td><?php echo $breast_cancer['treatment_frequency']; ?></td>
                    <td><?php echo $breast_cancer['treatment_visidual_desease']; ?></td>
                    <td><?php echo $breast_cancer['treatment_primary_outcome']; ?></td>
                    <td><?php echo $breast_cancer['comments']; ?></td>
                </tr>
            <?php $no++; } ?>
                
        </table>
