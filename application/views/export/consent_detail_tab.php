<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=export_personal2.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
<p>Consent Detail</p>
<div height="30px">&nbsp;</div>

<table border="1">
    <thead>
                <tr>
                    <th style="background-color:Crimson;">No</th>
                    <th style="background-color:Crimson;">IC No</th>
                    <th style="background-color:Crimson;">Studies Name</th>
                    <th style="background-color:Crimson;">Date at consent</th>
                    <th style="background-color:Crimson;">Age at consent</th>
                    <th style="background-color:Crimson;">Is double consent</th>
                    <th style="background-color:Crimson;">Consent given by</th>
                    <th style="background-color:Crimson;">Consent response</th>
                    <th style="background-color:Crimson;">Consent version</th>
                    <th style="background-color:Crimson;">Relations to study</th>
                    <th style="background-color:Crimson;">Referral to</th>
                    <th style="background-color:Crimson;">Referral to genetic counselling</th>
                    <th style="background-color:Crimson;">Referral source</th>
                </tr>
            </thead>
            <?php $no = 1; foreach ($patient_consent_detail as $list): ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $list['patient_ic_no']; ?></td>
                    <td><?php echo @$studies_id[$list['studies_id']]; ?></td>
                    <td><?php echo $list['date_at_consent']; ?></td>
                    <td><?php echo $list['age_at_consent']; ?></td>
                    <td><?php echo $list['double_consent_flag']; ?></td>
                    <td><?php echo $list['consent_given_by']; ?></td>
                    <td><?php echo $list['consent_response']; ?></td>
                    <td><?php echo $list['consent_version']; ?></td>
                    <td><?php echo $list['relation_to_study']; ?></td>
                    <td><?php echo $list['referral_to']; ?></td>
                    <td><?php echo $list['referral_to_genetic_counselling']; ?></td>
                    <td><?php echo $list['referral_source']; ?></td>
                </tr>
            <?php $no++; endforeach; ?>
        </table>
