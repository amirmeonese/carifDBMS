<div class="container" id="report_div">
    <div id="report_header" class="row">
        <p>Report Manager</p>
    </div>
    <?php echo form_open('report/report'); ?>
    <div class="container" id="report_form_section">
        <div height="30px">&nbsp;</div>
        <table>
            <tr>
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
            </tr>
            <tr>
                <td id="label1">



                    Report Templates: 
                </td>
                <td id="label2">
                    <?php echo form_dropdown('report_templates', $reportTemplates); ?>
                </td>
            </tr>
            <tr>
                <td id="label1">
                    Filter options
                </td>
                <td id="label2">
                    Category
                    <?php echo form_input('report_category'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td id="label2">
                    Date from
                    <?php echo form_input('report_start_range_date'); ?> to <?php echo form_input('report_end_range_date'); ?>
                </td>
            </tr>
        </table>
		<table>
		<tr><td>Data Columns to Display:</td><td><textarea id="data_field_textarea" rows="1" cols="7"></textarea></td></tr>
	</table>
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
                    <th style="background-color:Crimson;">Full Name</th>
                    <th style="background-color:Crimson;">Sur Name</th>
                    <th style="background-color:Crimson;">IC</th>
                </tr>
            </thead>
            <?php foreach ($searched_result as $list): ?>
                <tr>
                    <td><?php echo $list['fullname']; ?></td>
                    <td><?php echo $list['surname']; ?></td>
                    <td><?php echo $list['ic_no']; ?></td>
                </tr>                               
    <?php endforeach; ?>
    
     <input type="hidden" name="patient_name" value="<?php echo $a;?>">

                
    <?php echo form_submit('export_excel', 'Export to XLS'); ?>
    <?php echo form_close(); ?>
                
        </table>
        </br>
        <a style="margin-left:180px;" class="submitCancel" href="<?php echo site_url('report/index');?>">Done</a>
    </div>
</div>
<?php endif;?>






