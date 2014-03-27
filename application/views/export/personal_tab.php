<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=export_personal_data.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<p>Personal Detail</p>
<div height="30px">&nbsp;</div>

<table border="1">
    <thead>
                <tr>
                    <th style="background-color:Crimson;">No</th>
                    <th style="background-color:Crimson;">Surname</th>
                    <th style="background-color:Crimson;">Given name</th>
                    <th style="background-color:Crimson;">Maiden name</th>
                    <th style="background-color:Crimson;">Family No</th>
                    <th style="background-color:Crimson;">Nationality</th>
                    <th style="background-color:Crimson;">IC No</th>
                    <th style="background-color:Crimson;">Old IC No</th>
                    <th style="background-color:Crimson;">Gender</th>
                    <th style="background-color:Crimson;">Ethnicity</th>
                    <th style="background-color:Crimson;">Date of birth</th>
                    <th style="background-color:Crimson;">Place of birth</th>
                    <th style="background-color:Crimson;">Marital status</th>
                    <th style="background-color:Crimson;">Blood group</th>
                    <th style="background-color:Crimson;">Is dead</th>
                    <th style="background-color:Crimson;">Date of death</th>
                    <th style="background-color:Crimson;">Reason of death</th>
                    <th style="background-color:Crimson;">Hospital No (MRN)</th>
                    <th style="background-color:Crimson;">Private Patient No</th>
                    <th style="background-color:Crimson;">COGS Study no</th>
                    <th style="background-color:Crimson;">COGS Study no</th>
                    <th style="background-color:Crimson;">Blood card exist</th>
                    <th style="background-color:Crimson;">Blood card location</th>
                    <th style="background-color:Crimson;">Address</th>
                    <th style="background-color:Crimson;">Home phone</th>
                    <th style="background-color:Crimson;">Mobile phone</th>
                    <th style="background-color:Crimson;">Work phone</th>
                    <th style="background-color:Crimson;">Other phone</th>
                    <th style="background-color:Crimson;">Fax</th>
                    <th style="background-color:Crimson;">Email</th>
                    <th style="background-color:Crimson;">Highest level of education</th>
                    <th style="background-color:Crimson;">Weight</th>
                    <th style="background-color:Crimson;">Height</th>
                    <th style="background-color:Crimson;">Income level</th>
                    <th style="background-color:Crimson;">Contact person's name</th>
                    <th style="background-color:Crimson;">Contact person's phone</th>
                    <th style="background-color:Crimson;">Contact person's relationship</th>
                    <th style="background-color:Crimson;">Comments</th>
                    <th style="background-color:Crimson;">Total male siblings</th>
                    <th style="background-color:Crimson;">Total female siblings</th>
                    <th style="background-color:Crimson;">Total of affected siblings</th>
                    <th style="background-color:Crimson;">Total of male children</th>
                    <th style="background-color:Crimson;">Total of female children</th>
                    <th style="background-color:Crimson;">Total of affected children</th>
                    <th style="background-color:Crimson;">Total of first degree</th>
                    <th style="background-color:Crimson;">Total of second degree</th>
                    <th style="background-color:Crimson;">Total of third degree</th>
                    <th style="background-color:Crimson;">Source</th>
                    <th style="background-color:Crimson;">Status</th>
                    <th style="background-color:Crimson;">Status collected on</th>
                </tr>
            </thead>
            <?php $no = 1; foreach ($patient_detail as $list): ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $list['surname']; ?></td>
                    <td><?php echo $list['given_name']; ?></td>
                    <td><?php echo $list['maiden_name']; ?></td>
                    <td><?php echo $list['family_no']; ?></td>
                    <td><?php echo $list['nationality']; ?></td>
                    <td><?php echo $list['ic_no']; ?></td>
                    <td><?php echo $list['old_ic_no']; ?></td>
                    <td><?php echo $list['gender']; ?></td>
                    <td><?php echo $list['ethnicity']; ?></td>
                    <td><?php echo $list['d_o_b']; ?></td>
                    <td><?php echo $list['place_of_birth']; ?></td>
                    <td><?php echo $list['marital_status']; ?></td>
                    <td><?php echo $list['blood_group']; ?></td>
                    <td><?php echo $alive_id[$list['is_dead']]; ?></td>
                    <td><?php echo $list['d_o_d']; ?></td>
                    <td><?php echo $list['reason_of_death']; ?></td>
                    <td><?php echo $list['hospital_no']; ?></td>
                    <td><?php echo $list['private_no']; ?></td>
                    <td><?php echo $list['COGS_studies_name']; ?></td>
                    <td><?php echo $list['COGS_studies_no']; ?></td>
                    <td><?php echo $checkbox_status[$list['blood_card']]; ?></td>
                    <td><?php echo $list['blood_card_location']; ?></td>
                    <td><?php echo $list['address']; ?></td>
                    <td><?php echo $list['home_phone']; ?></td>
                    <td><?php echo $list['cell_phone']; ?></td>
                    <td><?php echo $list['work_phone']; ?></td>
                    <td><?php echo $list['other_phone']; ?></td>
                    <td><?php echo $list['fax']; ?></td>
                    <td><?php echo $list['email']; ?></td>
                    <td><?php echo $list['highest_education_level']; ?></td>
                    <td><?php echo $list['height']; ?></td>
                    <td><?php echo $list['weight']; ?></td>
                    <td><?php echo $list['income_level']; ?></td>
                    <td><?php echo $list['contact_name']; ?></td>
                    <td><?php echo $list['contact_telephone']; ?></td>
                    <td><?php echo $list['contact_relationship']; ?></td>
                    <td><?php echo $list['comment']; ?></td>
                    <td><?php echo $list['total_no_of_male_siblings']; ?></td>
                    <td><?php echo $list['total_no_of_female_siblings']; ?></td>
                    <td><?php echo $list['total_no_of_affected_siblings']; ?></td>
                    <td><?php echo $list['total_no_of_male_children']; ?></td>
                    <td><?php echo $list['total_no_of_female_children']; ?></td>
                    <td><?php echo $list['total_no_of_affected_children']; ?></td>
                    <td><?php echo $list['total_no_of_1st_degree']; ?></td>
                    <td><?php echo $list['total_no_of_2nd_degree']; ?></td>
                    <td><?php echo $list['total_no_of_3rd_degree']; ?></td>
                    <td><?php echo $list['source']; ?></td>
                    <td><?php echo @$alive_id[$list['alive_status']]; ?></td>
                    <td><?php echo $list['status_gathering_date']; ?></td>
                </tr>
            <?php $no++; endforeach; ?>
        </table>
