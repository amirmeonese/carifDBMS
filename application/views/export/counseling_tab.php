<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=export_counselling_data.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<p>Counseling</p>
<div height="30px">&nbsp;</div>

<table border="1">
    <thead>
                <tr>
                    <th style="background-color:Crimson;">No</th>
                    <th style="background-color:Crimson;">IC No</th>
                    <th style="background-color:Crimson;">Counseling Date</th>
                    <th style="background-color:Crimson;">Setup Next Counseling Date</th>
                    <th style="background-color:Crimson;">Send Email Reminder To Officer</th>
                    <th style="background-color:Crimson;">Officer Email Address</th>
                    <th style="background-color:Crimson;">Counseling Note</th>
                </tr>
            </thead>
            <?php $no = 1; foreach ($patient_interview_manager as $list): ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $list['patient_ic_no']; ?></td>
                    <td><?php echo $list['interview_date']; ?></td>
                    <td><?php echo $list['next_interview_date']; ?></td>
                    <td><?php echo $email_reminder[$list['is_send_email_reminder_to_officers']]; ?></td>
                    <td><?php echo $list['officer_email_addresses']; ?></td>
                    <td><?php echo $list['comments']; ?></td>
                </tr>
            <?php $no++; endforeach; ?>
        </table>
