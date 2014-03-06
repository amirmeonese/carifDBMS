<div class="container" id="report_div">
    <div id="report_header" class="row">
    </div>
    <div class="container" id="report_form_section" >
        <div height="30px">&nbsp;</div>
        <table width="50%" style="margin-left:180px;">
            <thead>
                <tr>
                    <th style="background-color:Crimson;">No</th>
                    <th style="background-color:Crimson;">Given Name</th>
                    <th style="background-color:Crimson;">Ic No</th>
                    <th style="background-color:Crimson;">Last Review Date</th>
                    <th style="background-color:Crimson;">Home Phone No</th>
                    <th style="background-color:Crimson;">Cell Phone No</th>
                    <th style="background-color:Crimson;">Note</th>
                </tr>
            </thead>
            <?php $no = 1; foreach ($searched_result as $list): ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $list['given_name']; ?></td>
                    <td><?php echo $list['patient_ic_no']; ?></td>
                    <td><?php echo $list['interview_date']; ?></td>
                    <td><?php echo $list['home_phone']; ?></td>
                    <td><?php echo $list['cell_phone']; ?></td>
                    <td><?php echo $list['comments']; ?></td>
                </tr>
            <?php $no++; endforeach; ?>
        </table>
        </br>
    </div>
</div>