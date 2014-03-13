<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=export_screening6_data.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<p>Surveillance Details</p>
<div height="30px">&nbsp;</div>

<table border="1">
    <thead>
                <tr>
                    <th style="background-color:Crimson;">No</th>
                    <th style="background-color:Crimson;">Studies Name</th>
                    <th style="background-color:Crimson;">Recruitment centre</th>
                    <th style="background-color:Crimson;">Surveillance type</th>
                    <th style="background-color:Crimson;">Date of 1st consultation</th>
                    <th style="background-color:Crimson;">Place of 1st consultation</th>
                    <th style="background-color:Crimson;">Interval (months)</th>
                    <th style="background-color:Crimson;">Diagnosis</th>
                    <th style="background-color:Crimson;">Due date</th>
                    <th style="background-color:Crimson;">Reminder sent date</th>
                    <th style="background-color:Crimson;">Done date</th>
                    <th style="background-color:Crimson;">Reminded by</th>
                    <th style="background-color:Crimson;">Timing</th>
                    <th style="background-color:Crimson;">Symptoms</th>
                    <th style="background-color:Crimson;">Doctor's name</th>
                    <th style="background-color:Crimson;">Place</th>
                    <th style="background-color:Crimson;">Outcome</th>
                    <th style="background-color:Crimson;">Comments</th>
                </tr>
            </thead>
            <?php $no = 1; foreach ($patient_surveillance as $list): ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $studies_id[$patient_studies_id[$list['patient_studies_id']]]; ?></td>
                    <td><?php echo $list['recruitment_center']; ?></td>
                    <td><?php echo $list['type']; ?></td>
                    <td><?php echo $list['first_consultation_date']; ?></td>
                    <td><?php echo $list['first_consultation_place']; ?></td>
                    <td><?php echo $list['surveillance_interval']; ?></td>
                    <td><?php echo $list['diagnosis']; ?></td>
                    <td><?php echo $list['due_date']; ?></td>
                    <td><?php echo $list['reminder_sent_date']; ?></td>
                    <td><?php echo $list['surveillance_done_date']; ?></td>
                    <td><?php echo $list['reminded_by']; ?></td>
                    <td><?php echo $list['timing']; ?></td>
                    <td><?php echo $list['symptoms']; ?></td>
                    <td><?php echo $list['doctor_name']; ?></td>
                    <td><?php echo $list['surveillance_done_place']; ?></td>
                    <td><?php echo $list['outcome']; ?></td>
                    <td><?php echo $list['comments']; ?></td>
                </tr>
            <?php $no++; endforeach; ?>
        </table>
