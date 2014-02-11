<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<p>Report</p>
<div height="30px">&nbsp;</div>

<table border="1">
    <thead>
                <tr>
                    <th style="background-color:Crimson;">No</th>
                    <?php if (in_array('given_name',$patient_field)) echo '<th style="background-color:Crimson;">Given Name</th>'; ?>
                    <?php if (in_array('sur_name',$patient_field)) echo '<th style="background-color:Crimson;">Sur Name</th>'; ?>
                    <?php if (in_array('f_ic_no',$patient_field)) echo '<th style="background-color:Crimson;">IC No</th>'; ?>
                    <?php if (in_array('f_ethnic',$patient_field)) echo '<th style="background-color:Crimson;">Ethnicity</th>'; ?>
                    <?php if (in_array('f_date_diagnosis',$patient_field)) echo '<th style="background-color:Crimson;">Date of Diagnosis</th>'; ?>
                    <?php if (in_array('f_age_diagnosis',$patient_field)) echo '<th style="background-color:Crimson;">Age of Diagnosis</th>'; ?>
                </tr>
            </thead>
<?php $no = 1; foreach ($patient as $list): ?>
        <tr>
                    <td><?php echo $no; ?></td>
                    <?php if (in_array('given_name',$patient_field)) echo '<td>'.$list['given_name'].'</td>'; ?>
                    <?php if (in_array('sur_name',$patient_field)) echo '<td>'.$list['surname'].'</td>'; ?>
                    <?php if (in_array('f_ic_no',$patient_field)) echo '<td>'.$list['ic_no'].'</td>'; ?>
                    <?php if (in_array('f_ethnic',$patient_field)) echo '<td>'.$list['ethnicity'].'</td>'; ?>
                    <?php if (in_array('f_date_diagnosis',$patient_field)) echo '<td>'.$list['date_of_diagnosis'].'</td>'; ?>
                    <?php if (in_array('f_age_diagnosis',$patient_field)) echo '<td>'.$list['age_of_diagnosis'].'</td>'; ?>
                </tr>  
<?php $no++; endforeach; ?>

</table>