<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=export_personal_data.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<p>Mammogram</p>
<div height="30px">&nbsp;</div>

<table border="1">
    <thead>
                <tr>
                    <th style="background-color:Crimson;">No</th>
                    <th style="background-color:Crimson;">Patient IC No</th>
                    <th style="background-color:Crimson;">Patient No</th>
                    <th style="background-color:Crimson;">Reason for mammogram</th>
                    <th style="background-color:Crimson;">Details of mammogram</th>
                    <th style="background-color:Crimson;">Date of first mammogram</th>
                    <th style="background-color:Crimson;">Age at first mammogram</th>
                    <th style="background-color:Crimson;">Screening center at first mammogram</th>
                    <th style="background-color:Crimson;">Motivaters at first mammogram</th>
                    <th style="background-color:Crimson;">Details at first mammogram</th>
                    <th style="background-color:Crimson;">Date of recent mammogram</th>
                    <th style="background-color:Crimson;">Age at recent mammogram</th>
                    <th style="background-color:Crimson;">Screening center at recent mammogram</th>
                    <th style="background-color:Crimson;">Motivaters at recent mammogram</th>
                    <th style="background-color:Crimson;">Details at recent mammogram</th>
                    <th style="background-color:Crimson;">Mammogram in SDMC,SJ</th>
                    <th style="background-color:Crimson;">Radiologist name</th>
                    <th style="background-color:Crimson;">Abnormalities detected</th>
                    <th style="background-color:Crimson;">Comments</th>
                    <th style="background-color:Crimson;">Total no. of mammogram</th>
                    <th style="background-color:Crimson;">Screening interval</th>
                    <th style="background-color:Crimson;">Left/right breast side:</th>
                    <th style="background-color:Crimson;">Upper/below breast side</th>
                    <th style="background-color:Crimson;">BIRADS clinical classification</th>
                    <th style="background-color:Crimson;">BIRADS density classification</th>
                    <th style="background-color:Crimson;">Percentage (%) of mammo density</th>
                    <th style="background-color:Crimson;">Action suggested on mammogram repor</th>
                    <th style="background-color:Crimson;">Reason of action suggested</th>
                    <th style="background-color:Crimson;">Cancer?</th>
                    <th style="background-color:Crimson;">Site effected</th>
                    <th style="background-color:Crimson;">Had ultrasound?</th>
                    <th style="background-color:Crimson;">Total no. of ultrasound</th>
                    <th style="background-color:Crimson;">Is abnormalities detected?</th>
                    <th style="background-color:Crimson;">Ultrasound date</th>
                    <th style="background-color:Crimson;">Comment</th>
                    <th style="background-color:Crimson;">Had MRI?</th>
                    <th style="background-color:Crimson;">Total no. of MRI</th>
                    <th style="background-color:Crimson;">Is abnormalities detected?</th>
                    <th style="background-color:Crimson;">MRI date</th>
                    <th style="background-color:Crimson;">Comment</th>
                    
                    
                </tr>
            </thead>
            <?php $no = 1; foreach ($patient_breast_screening as $list): ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $list['patient_ic_no']; ?></td>
                    <td><?php echo $list['private_no']; ?></td>
                    <td><?php echo $list['reason_of_mammogram']; ?></td>
                    <td><?php echo $list['reason_of_mammogram_details']; ?></td>
                    <td><?php echo $list['date_of_first_mammogram']; ?></td>
                    <td><?php echo $list['age_of_first_mammogram']; ?></td>
                    <td><?php echo $list['screening_center_of_first_mammogram']; ?></td>
                    <td><?php echo $list['motivaters_of_first_mammogram']; ?></td>
                    <td><?php echo $list['details_of_first_mammogram']; ?></td>
                    <td><?php echo $list['date_of_recent_mammogram']; ?></td>
                    <td><?php echo $list['age_of_recent_mammogram']; ?></td>
                    <td><?php echo $list['screening_center_of_recent_mammogram']; ?></td>
                    <td><?php echo $list['motivaters_of_recent_mammogram']; ?></td>
                    <td><?php echo $list['details_of_recent_mammogram']; ?></td>
                    <td><?php echo $checkbox_status[$list['mammogram_in_sdmc']]; ?></td>
                    <td><?php echo $list['name_of_radiologist']; ?></td>
                    <td><?php echo $checkbox_status[$list['abnormalities_mammo_flag']]; ?></td>
                    <td><?php echo $list['mammo_comments']; ?></td>
                    <td><?php echo $list['total_no_of_mammogram']; ?></td>
                    <td><?php echo $list['screening_interval']; ?></td>
                    <td><?php echo $site_breast[$list['left_breast']]; ?></td>
                    <td><?php echo $upperbelow_breast[$list['upper']]; ?></td>
                    <td><?php echo $list['BIRADS_clinical_classification']; ?></td>
                    <td><?php echo $list['BIRADS_density_classification']; ?></td>
                    <td><?php echo $list['percentage_of_mammo_density']; ?></td>
                    <td><?php echo $list['action_suggested_on_mammogram_report']; ?></td>
                    <td><?php echo $list['reason_of_action_suggested']; ?></td>
                    <td><?php echo $checkbox_status[$list['is_cancer_mammogram_flag']]; ?></td>
                    <td><?php echo $list['site_effected_of_mammogram']; ?></td>
                    <td><?php echo $checkbox_status[$list['had_ultrasound_flag']]; ?></td>
                    <td><?php echo $list['total_no_of_ultrasound']; ?></td>
                    <td><?php echo $checkbox_status[$list['abnormalities_ultrasound_flag']]; ?></td>
                    <td><?php echo $list['ultrasound_date']; ?></td>
                    <td><?php echo $list['ultrasound_comments']; ?></td>
                    <td><?php echo $checkbox_status[$list['had_mri_flag']]; ?></td>
                    <td><?php echo $list['total_no_of_mri']; ?></td>
                    <td><?php echo $checkbox_status[$list['abnormalities_MRI_flag']]; ?></td>
                    <td><?php echo $list['mri_date']; ?></td>
                    <td><?php echo $list['comments']; ?></td>
                </tr>
            <?php $no++; endforeach; ?>
        </table>
