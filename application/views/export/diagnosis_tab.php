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
            <?php $no = 1; foreach ($patient_breast_cancer as $breast_cancer){ ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $breast_cancer['patient_ic_no']; ?></td>
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
                    <td><?php echo $breast_cancer['treatment_comments']; ?></td>
                </tr>
            <?php $no++; } ?>
                
        </table>
