<div class="container" id="report_div">
    <div id="report_header" class="row">
        <p>Report Manager</p>
    </div>
    <?php echo form_open('record/export_record_list'); ?>
    <div class="container" id="report_form_section">
        <div height="30px">&nbsp;</div>
        <table>
            <tr>
                <td>
                    Tab Name:
                </td>
                <td id="label2">

                    <?php echo form_dropdown('tab_name', $export_tab, NULL); ?>
                </td>
            </tr>
            <input type="hidden" name="icno" value="<?php print $ic_no; ?>"/>
            <input type="hidden" name="patient_studies_id" value="<?php print $patient_studies_id; ?>"/>
        </table>
    </div>
    <?php echo form_submit('mysubmit', 'Export'); ?>
    <a class="submitCancel" href="<?php echo base_url(); ?>">Cancel</a>
    <?php echo form_close(); ?>
</div>

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
                    <th style="background-color:Crimson;">No</th>
                    <th style="background-color:Crimson;">No</th>
                    
                    <th style="background-color:Crimson;">All<input type="checkbox" name="selectall" name="selectallnone" id="selectallnone"/></th>
                </tr>
            </thead>
            <?php if($searched_result != NULL) {?>
            <?php $no = 1; foreach ($searched_result as $list): ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <?php if (in_array('given_name',$patient_field)) echo '<td>'.$list['given_name'].'</td>'; ?>
                    <?php if (in_array('sur_name',$patient_field)) echo '<td>'.$list['surname'].'</td>'; ?>
                    <?php if (in_array('f_ic_no',$patient_field)) echo '<td>'.$list['ic_no'].'</td>'; ?>
                    <?php if (in_array('f_ethnic',$patient_field)) echo '<td>'.$list['ethnicity'].'</td>'; ?>
                    <?php if (in_array('f_date_diagnosis',$patient_field)) echo '<td>'.$list['date_of_diagnosis'].'</td>'; ?>
                    <?php if (in_array('f_age_diagnosis',$patient_field)) echo '<td>'.$list['age_of_diagnosis'].'</td>'; ?>
                    <td>
            <input type="checkbox" name="ic_no[]" class="patientcheckbox" value="<?php echo $list['ic_no']; ?>" />
<!--            <input type="hidden" name="ethnic_name[]" value="<?php echo $list['ethnicity'];?>">-->
        </td>
                </tr>                               
    <?php $no++; endforeach; ?>
            <?php } else { ?>
                
                <tr><td colspan="6" style="center"><?php echo "no data";?></td></tr>
                
            <?php } ?>
    
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

<script type="text/javascript">
$('#selectallnone').click(function(){
if(this.checked){
$('.patientcheckbox').attr('checked', true);
}else{
$('.patientcheckbox').attr('checked', false);
}
})

</script>




