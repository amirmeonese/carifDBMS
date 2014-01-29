<div class="container" id="report_div">
    <div id="report_header" class="row">
        <p>Report Manager</p>
    </div>
    <?php echo form_open('report/report'); ?>
    <div class="container" id="report_form_section">
        <div height="30px">&nbsp;</div>
        <table>
<!--            <tr>
                <td id="label1">
                    Search by: 
                </td>
                <td id="label2">
                    Patient name
                    <?php echo form_input('report_patient_name'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td id="label2">
                    IC No
                    <?php echo form_input('report_IC_no'); ?>
                </td>

            </tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td id="label2">
                    Gender
                    <?php echo form_input('report_gender'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td id="label2">
                    Age
                    <?php echo form_input('report_age'); ?>
                </td>
            </tr>-->
			<tr>
                <td>
                    Studies:
                </td>
                <td id="label2">
                    
					<?php 
					$options = array(
						'Dynamic Dropdown'  => 'Dynamic Dropdown'
					);
					echo form_dropdown('studies_name', $options, NULL, 'id="studies_name"'); ?>
				</td>
            </tr>
            <tr>
                <td>
                    Cancer Patient:
                </td>
                <td id="label2">
                    
					<?php 
					$cancer = array(
						'0'  => 'No',
                                                '1'  => 'Yes'
					);
					echo form_dropdown('cancer', $cancer, NULL); ?>
				</td>
            </tr>
<!--            <tr>
                <td id="label1">



                    Report Templates: 
                </td>
                <td id="label2">
                    <?php echo form_dropdown('report_templates', $reportTemplates); ?>
                </td>
            </tr>-->
<!--            <tr>
                <td id="label1">
                    Date
                </td>
                <td id="label2">
                    Category
                    <?php echo form_input('report_category'); ?>
                </td>
            </tr>-->
            <tr>
                <td>
                    Date of Diagnosis:
                </td>
                <td id="label2">
                    From
                    <?php echo form_input(array('name' => 'report_start_range_date', 'class' => 'datepicker')); ?> To <?php echo form_input(array('name' => 'report_end_range_date','class' => 'datepicker')); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Age of Diagnosis:
                </td>
                <td id="label2">
                    From
                    <?php echo form_input('report_start_range_age'); ?> To <?php echo form_input('report_end_range_age'); ?>
                </td>
            </tr>
        </table>
<!--		<table>
		<tr><td>Data Columns to Display:</td><td><textarea id="data_field_textarea" rows="1" cols="7"></textarea></td></tr>
	</table>-->
    </div>
    <?php echo form_submit('mysubmit', 'Generate Report'); ?>
    <a class="submitCancel" href="<?php echo base_url(); ?>">Cancel</a>
    <?php echo form_close(); ?>
</div>
<div height="30px">&nbsp;</div>
<?php if($submit):?>
<div class="container" id="report_div">
    <div id="report_header" class="row">
        <p>Search Result</p>
    </div>
    <?php echo form_open('report/toExcel'); ?>
    <div class="container" id="report_form_section" >
        <div height="30px">&nbsp;</div>
        <table border="1" width="50%" style="margin-left:180px;">
            <thead>
                <tr>
                    <th style="background-color:Crimson;">Given Name</th>
                    <th style="background-color:Crimson;">Sur Name</th>
                    <th style="background-color:Crimson;">IC No</th>
                    <th style="background-color:Crimson;">Ethnicity</th>
                    <th style="background-color:Crimson;">Date of Diagnosis</th>
                    <th style="background-color:Crimson;">Age of Diagnosis</th>
                </tr>
            </thead>
            <?php if($searched_result != NULL) {?>
            <?php foreach ($searched_result as $list): ?>
                <tr>
                    <td><?php echo $list['given_name']; ?></td>
                    <td><?php echo $list['surname']; ?></td>
                    <td><?php echo $list['ic_no']; ?></td>
                    <td><?php echo $list['ethnicity']; ?></td>
                    <td><?php echo $list['date_of_diagnosis']; ?></td>
                    <td><?php echo $list['age_of_diagnosis']; ?></td>
                </tr>                               
    <?php endforeach; ?>
            <?php } else { ?>
                
                <tr><td colspan="6" style="center"><?php echo "no data";?></td></tr>
                
            <?php } ?>
    
     <input type="hidden" name="patient_cancer" value="<?php echo $cancer_name;?>">
     <input type="hidden" name="patient_studies" value="<?php echo $studies;?>">
     <input type="hidden" name="date_start" value="<?php echo $date_start;?>">
     <input type="hidden" name="date_end" value="<?php echo $date_end;?>">
     <input type="hidden" name="age_start" value="<?php echo $age_start;?>">
     <input type="hidden" name="age_end" value="<?php echo $age_end;?>">

                
    <?php echo form_submit('export_excel', 'Export to XLS'); ?>
    <?php echo form_close(); ?>
                
        </table>
        </br>
        <a style="margin-left:180px;" class="submitCancel" href="<?php echo site_url('report/index');?>">Done</a>
    </div>
</div>
<?php endif;?>






