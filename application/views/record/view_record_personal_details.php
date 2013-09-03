<div class="container" id="report_div">
	<div id="report_header" class="row">
        <p>View Personal Information</p>
	</div>
	<?php echo form_open('report/process_report'); ?>
	<div class="container" id="report_form_section">
		<div height="30px">&nbsp;</div>
		<table>
           <tr height="50px"><td width="10%" >
                    <?php echo $fullname; ?></td>
                    <td>: </td>
                    <td width="25%"><?php echo $patient_detail['fullname']; ?></td>
                <td width="10%">
                    <?php echo $surname; ?></td>
                    <td>:</td> 
                    <td  width="25%"><?php echo $patient_detail['surname']; ?>
                </td><td width="10%">
                    <?php echo $maiden_name; ?></td>
                    <td>:</td>  
                    <td width="30%"><?php echo $patient_detail['maiden_name']; ?>
                </td></tr>
            <tr height="50px"><td>
                    <?php echo $IC_no; ?></td>
                    <td>:</td>  
                    <td><?php echo $patient_detail['ic_no']; ?>
                </td><td>
                    <?php echo $nationality; ?> </td>
                    <td>:</td>
                    <td><?php echo $patient_detail['nationality']; ?>
                </td><td>
                    <?php echo $DOB; ?></td>
                    <td>:</td> 
                    <td><?php echo $patient_detail['d_o_b']; ?>
                </td></tr>


            <tr height="50px"><td>
                    <?php echo $pedigree_label; ?></td>
                    <td>:</td> 
                    <td><?php echo $patient_detail['padigree_labelling']; ?>
                </td>
                <td>
                    <?php echo $gender; ?></td>
                    <td>:</td> 
                    <td><?php echo $patient_detail['gender']; ?>
                </td><td>
                    <?php echo $ethinicity; ?></td>
                    <td>:</td>
                    <td><?php echo $patient_detail['ethnicity']; ?>
                </td></tr>
            <tr height="50px"><td>
                    <?php echo $blood_group; ?></td>
                    <td>:</td> 
                    <td><?php echo $patient_detail['blood_group']; ?>

                </td><td>
                    <?php echo $comment; ?></td>
                    <td>:</td>
                	<td><?php echo $patient_detail['comment']; ?>
 
                </td><td>
                    <?php echo $hospital_no; ?></td>
                    <td>:</td> 
                   <td> <?php echo $patient_detail['hospital_no']; ?>                    
                </td></tr>
		</table>
	</br>
	<a class="submitCancel" href="<?php echo base_url(); ?>">Done</a>
    </div>


