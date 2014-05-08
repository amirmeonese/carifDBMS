<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=export_diagnosis_data.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<p>Pathology</p>
<div height="30px">&nbsp;</div>

<table border="1">
    <thead>
                <tr>
                    <th style="background-color:Crimson;">No</th>
                    <th style="background-color:Crimson;">Patient Ic No</th>
                    <th style="background-color:Crimson;">Studies Name</th>
                    <th style="background-color:Crimson;">Cancer Type</th>
                    <th style="background-color:Crimson;">Site</th>
                    <th style="background-color:Crimson;">Type of report</th>
                    <th style="background-color:Crimson;">Date of report</th>
                    <th style="background-color:Crimson;">Pathology lab</th>
                    <th style="background-color:Crimson;">Name of doctor</th>
                    <th style="background-color:Crimson;">Morphology</th>
                    <th style="background-color:Crimson;">T Staging</th>
                    <th style="background-color:Crimson;">N staging</th>
                    <th style="background-color:Crimson;">M staging</th>
                    <th style="background-color:Crimson;">Tumour stage</th>
                    <th style="background-color:Crimson;">Tumour grade</th>
                    <th style="background-color:Crimson;">No. of lymph nodes</th>
                    <th style="background-color:Crimson;">Size of tumor</th>
                    <th style="background-color:Crimson;">ER status</th>
                    <th style="background-color:Crimson;">PR status</th>
                    <th style="background-color:Crimson;">HER2 status</th>
                    <th style="background-color:Crimson;">Comments</th>
                </tr>
            </thead>
            <?php $no = 1; foreach ($patient_pathology as $breast_cancer){ ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $breast_cancer['patient_ic_no']; ?></td>
                    <td><?php echo $breast_cancer['private_no']; ?></td>
                    <td><?php echo $studies_id[$patient_studies_id[$breast_cancer['patient_studies_id']]]; ?></td>
                    <td><?php echo @$cancer_name[$breast_cancer['cancer_id']]; ?></td>
                    <td><?php echo $breast_cancer['tissue_site']; ?></td>
                    <td><?php echo $breast_cancer['type_of_report']; ?></td>
                    <td><?php echo $breast_cancer['date_of_report']; ?></td>
                    <td><?php echo $breast_cancer['pathology_lab']; ?></td>
                    <td><?php echo $breast_cancer['name_of_doctor']; ?></td>
                    <td><?php echo $breast_cancer['morphology']; ?></td>
                    <td><?php echo $breast_cancer['t_staging']; ?></td>
                    <td><?php echo $breast_cancer['n_staging']; ?></td>
                    <td><?php echo $breast_cancer['m_staging']; ?></td>
                    <td><?php echo $breast_cancer['tumour_stage']; ?></td>
                    <td><?php echo $breast_cancer['tumour_grade']; ?></td>
                    <td><?php echo $breast_cancer['total_lymph_nodes']; ?></td>
                    <td><?php echo $breast_cancer['tumour_size']; ?></td>
                    <td><?php echo $breast_cancer['ER_status']; ?></td>
                    <td><?php echo $breast_cancer['PR_status']; ?></td>
                    <td><?php echo $breast_cancer['HER2_status']; ?></td>
                    <td><?php echo $breast_cancer['comments']; ?></td>
                </tr>
            <?php $no++; } ?>
                
        </table>
