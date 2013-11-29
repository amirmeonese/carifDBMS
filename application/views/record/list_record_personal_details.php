<div class="container" id="report_div">
    <div id="report_header" class="row">
        <p>View Personal Information</p>
    </div>
    <div class="container" id="report_form_section" >
        <div height="10px">&nbsp;</div>
        <?php echo form_open('record/patient_record_list'); ?>
        <table>
        <tr>
                <td id="label1">
                    Search by: 
                </td>
                <td id="label2">
                    Patient name</td>
                <td><?php echo form_input('patient_name'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td id="label2">
                    IC No</td>
                <td>    <?php echo form_input('IC_no'); ?>
                </td>

            </tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td id="label2">
                <?php echo $studies_name; ?></td>
                <td><?php echo form_dropdown('studies_name', $studies_name_lists, NULL, 'id="studies_name"'); ?>

                </td>

            </tr>
        </table>
        <?php echo form_submit('search','Search');  ?>
        
        <?php //if($submit):?>
        <div style="margin-left:180px;"><?php echo $total_results . " record(s) found. Showing ". ($start_from + 1 ). "-" . ($start_from + count($patient_list))?></div><br />
		<div style="margin-left:180px;"><?php echo $pagination_links; ?></div>
        <table border="1" width="50%" style="margin-left:180px;">
            <thead>
                <tr align='center'>
					<th style="background-color:Crimson;">&nbsp;</th>
                    <th style="background-color:Crimson;">Date</th>
					<th style="background-color:Crimson;">IC No</th>
                    <th style="background-color:Crimson;">Patient Name</th>
                    <th style="background-color:Crimson;">Studies</th>
                    <th style="background-color:Crimson;">Action</th>
                </tr>
            </thead>
            <?php if(!empty($patient_list)) { $patientCounter = $counter + 1;?>
            <?php foreach ($patient_list as $list): ?>
                <tr>
					<td><?php echo $patientCounter; ?></td>
                    <td><?php echo $list['created_on']; ?></td>
					<td><?php echo $list['ic_no']; ?></td>
                    <td><?php echo $list['given_name']; ?></td>
                    <td><?php echo $studies_name_list[$list['studies_id']]; ?></td>
                    <td width="15%" align='center'>
                        <a href="<?php echo site_url('record/patient_record_view') . '/' . $list['ic_no'] . '/' . $list['patient_studies_id'] ?>">
                        <img src="<?php echo base_url(); ?>img/view.png" alt="view_patient_detail" width="18" height="18"></a>
                        <a>&nbsp;</a>
                        <a href="<?php echo site_url('record/test') . '/' . $list['ic_no'] . '/' . $list['patient_studies_id'] ?>">
                        <img src="<?php echo base_url(); ?>img/edit.png" alt="view_patient_detail" width="18" height="18"></a>
                        <a>&nbsp;</a>
                        <a href="<?php echo site_url('record/patient_record_view') . '/' . $list['ic_no'] . '/' . $list['patient_studies_id'] ?>">
                        <img src="<?php echo base_url(); ?>img/delete.png" alt="view_patient_detail" width="18" height="18"></a>
<!--                            <form name="view_patient_detail" action="<?php echo site_url('record/patient_record_view') . '/' . $list['ic_no'] ?>" method="post">
                            <input type ="image" src="<?php echo base_url(); ?>img/view.png" alt="view_patient_detail" height="18px"></input>
                        </form>
                            <form name="view_patient_detail" action="<?php echo site_url('record/test') . '/' . $list['ic_no'] ?>" method="post">
                            <input type ="image" src="<?php echo base_url(); ?>img/edit.png" alt="view_patient_detail" height="18px"></input>
                        </form>
                            <form name="view_patient_detail" action="<?php echo site_url('record/patient_record_view') . '/' . $list['ic_no'] ?>" method="post">
                            <input type ="image" src="<?php echo base_url(); ?>img/delete.png" alt="view_patient_detail" height="18px"></input>
                        </form>-->
                    </td>
                </tr>
            <?php $patientCounter++; endforeach; ?>
                        <?php } else { ?>
                <tr><td colspan="6" style="center">
          <?php  echo 'no data';?>
            </td><tr>
   <?php     }
?>
        </table>        
        </br>
		<div style="margin-left:180px;"><?php echo $pagination_links; ?></div>
        <a style="margin-left:180px;" class="doneButton" href="<?php echo base_url(); ?>">Done</a>
        <?php //endif;?>
    </div>
</div>

