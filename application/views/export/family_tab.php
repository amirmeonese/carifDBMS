<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=export_family.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<p>Family Detail</p>
<div height="30px">&nbsp;</div>

<table border="1">
    <thead>
                <tr>
                    <th style="background-color:Crimson;">No</th>
                    <th style="background-color:Crimson;">IC No</th>
                    <th style="background-color:Crimson;">Family No</th>
                    <th style="background-color:Crimson;">Paternal status</th>
                    <th style="background-color:Crimson;">Maternal status</th>
                    <th style="background-color:Crimson;">Relationship</th>
                    <th style="background-color:Crimson;">Degree of relativeness</th>
                    <th style="background-color:Crimson;">Fullname</th>
                    <th style="background-color:Crimson;">Maiden name</th>
                    <th style="background-color:Crimson;">Adoption</th>
                    <th style="background-color:Crimson;">In other country</th>
                    <th style="background-color:Crimson;">Ethnicity</th>
                    <th style="background-color:Crimson;">Town of residence</th>
                    <th style="background-color:Crimson;">Date of birth</th>
                    <th style="background-color:Crimson;">Is still alive</th>
                    <th style="background-color:Crimson;">Date of death</th>
                    <th style="background-color:Crimson;">Is diagnosed with cancer</th>
                    <th style="background-color:Crimson;">Type of cancer</th>
                    <th style="background-color:Crimson;">Date of diagnosis</th>
                    <th style="background-color:Crimson;">Age at diagnosis</th>
                    <th style="background-color:Crimson;">Diagnosis details</th>
                    <th style="background-color:Crimson;">Total no. of brothers</th>
                    <th style="background-color:Crimson;">Total no. of sisters</th>
                    <th style="background-color:Crimson;">Total no. of half brothers</th>
                    <th style="background-color:Crimson;">Total no. of half sisters</th>
                    <th style="background-color:Crimson;">Vital status</th>
                    <th style="background-color:Crimson;">Comments</th>
                    
                </tr>
            </thead>
            <?php $no = 1; foreach ($patient_family as $list): ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $list['patient_ic_no']; ?></td>
                    <td><?php echo $list['family_no']; ?></td>
                    <td><?php echo $list['is_paternal']; ?></td>
                    <td><?php echo $list['is_maternal']; ?></td>
                    <td><?php echo $list['relatives_id']; ?></td>
                    <td><?php echo $list['degree_of_relativeness']; ?></td>
                    <td><?php echo $list['full_name']; ?></td>
                    <td><?php echo $list['maiden_name']; ?></td>
                    <td><?php echo $list['is_adopted']; ?></td>
                    <td><?php echo $list['is_in_other_country']; ?></td>
                    <td><?php echo $list['ethnicity']; ?></td>
                    <td><?php echo $list['town_of_residence']; ?></td>
                    <td><?php echo $list['d_o_b']; ?></td>
                    <td><?php echo $list['is_alive_flag']; ?></td>
                    <td><?php echo $list['d_o_d']; ?></td>
                    <td><?php echo $list['is_cancer_diagnosed']; ?></td>
                    <td><?php echo $cancer_name[$list['cancer_type_id']]; ?></td>
                    <td><?php echo $list['date_of_diagnosis']; ?></td>
                    <td><?php echo $list['age_of_diagnosis']; ?></td>
                    <td><?php echo $list['other_detail']; ?></td>
                    <td><?php echo $list['no_of_brothers']; ?></td>
                    <td><?php echo $list['no_of_sisters']; ?></td>
                    <td><?php echo $list['total_half_brothers']; ?></td>
                    <td><?php echo $list['total_half_sisters']; ?></td>
                    <td><?php echo $list['vital_status']; ?></td>
                    <td><?php echo $list['comments']; ?></td>
                </tr>
            <?php $no++; endforeach; ?>
        </table>
