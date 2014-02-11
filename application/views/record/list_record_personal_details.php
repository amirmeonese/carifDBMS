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
                Patient No.</td>
                <td><?php echo form_input('patient_no'); ?>

                </td>

            </tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td id="label2">
                Hospital No.(MRN)</td>
                <td><?php echo form_input('hospital_no'); ?>

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
        <div style="margin-left:100px;"><?php echo $total_results . " record(s) found. Showing ". ($start_from + 1 ). "-" . ($start_from + count($patient_list))?></div><br />
		<div style="margin-left:100px;"><?php echo $pagination_links; ?></div>
        <table id="patient-display-table" border="1" width="60%" style="margin-left:100px;">
            <thead>
                <tr align='center'>
					<th id="view-page-tr">&nbsp;</th>
                    <th id="view-page-tr">Creation Date</th>
					<th id="view-page-tr">IC No</th>
                    <th id="view-page-tr">Patient Given Name</th>
					<th id="view-page-tr">Patient Surname</th>
                    <th id="view-page-tr">Studies</th>
                    <th id="view-page-tr">Action</th>
                </tr>
            </thead>
            <?php if(!empty($patient_list)) { $patientCounter = $counter + 1;?>
            <?php foreach ($patient_list as $list): 
			if($patientCounter % 2 == 0) 
				echo "<tr class=\"stripped-row\">";
			else
				echo "<tr>";?>
					<td><?php echo $patientCounter; ?></td>
                    <td><?php echo $list['created_on']; ?></td>
					<td><?php echo $list['ic_no']; ?></td>
                    <td><?php echo $list['given_name']; ?></td>
					<td><?php echo $list['surname']; ?></td>
                    <td><?php echo $studies_name_list[$list['studies_id']]; ?></td>
                    <td width="15%" align='center'>
                        <?php if ($userprivillage['view_privilege']== 1){ ?>
                        <a href="<?php echo site_url('record/patient_record_view') . '/' . $list['ic_no'] . '/' . $list['patient_studies_id'] ?>">
                        <img src="<?php echo base_url(); ?>img/view.png" alt="view_patient_detail" width="18" height="18"></a>
                        <?php } else { ?>
                        <?php }?>
                        
                        <a>&nbsp;</a>
                        <!-- <a href="<?php echo site_url('record/test') . '/' . $list['ic_no'] . '/' . $list['patient_studies_id'] ?>"> -->
                        <img src="<?php echo base_url(); ?>img/edit.png" alt="view_patient_detail" width="18" height="18"></a>
                        <a>&nbsp;</a>
                        <?php if ($userprivillage['delete_privilege']== 1){ ?>
                        <a href="<?php echo site_url('record/patient_record_delete') . '/' . $list['ic_no'] . '/' . $list['patient_studies_id'] ?>" class="confirmation"> 
                        <img src="<?php echo base_url(); ?>img/delete.png" alt="view_patient_detail" width="18" height="18"></a>
                        <?php } else { ?>
                        <?php }?>
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
                <tr><td colspan="7" style="center">
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

<script type="text/javascript">
    var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('Are you sure want to delete this patient?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
</script>