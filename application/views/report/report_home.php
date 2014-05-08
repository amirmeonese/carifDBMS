<div class="container" id="report_div">
    <div id="report_header" class="row">
        <p>Report Manager</p>
    </div>
    <?php echo form_open('report/report'); ?>
    <div class="container" id="report_form_section">
        <div height="30px">&nbsp;</div>
        <table>
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
          <td>Cancer Name*:</td>
          <td>
              <select name="cancer[]" multiple size="6">
             <?php foreach ($cancer as $list): 
            $name = $list['cancer_name'];
            $val = $list['cancer_id']; ?>
                 <option value=<?php echo $val; ?>><?php echo $name; ?></option>
                 <?php endforeach;?>
              </select>
              <br/>
          </td>
      </tr>
            <tr>
          <td>Ethnic*:</td>
          <td>
              <select name="ethnic[]" multiple size="6">
                  <?php foreach ($ethnic as $val): 
            $ethnic_name = $val['ethnicity'];?>
                 <option value=<?php echo $ethnic_name; ?>><?php echo $ethnic_name; ?></option>
                 <?php endforeach;?>
              </select>
              <br/>
          </td>
      </tr>
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
            <tr>
                <td>
                    Date of Consent:
                </td>
                <td id="label2">
                    From
                    <?php echo form_input(array('name' => 'report_consent_date_start', 'class' => 'datepicker')); ?> To <?php echo form_input(array('name' => 'report_consent_date_end', 'class' => 'datepicker')); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Creation Date:
                </td>
                <td id="label2">
                    From
                    <?php echo form_input(array('name' => 'report_creation_date_start', 'class' => 'datepicker')); ?> To <?php echo form_input(array('name' => 'report_creation_date_end', 'class' => 'datepicker')); ?>
                </td>
            </tr>
            <tr>
          <td>Field to Appear*:</td>
          <td>
              <select name="field[]" multiple size="6">
                  <option value="given_name" selected>Given Name</option>
                  <option value="sur_name" selected>Sur Name</option>
                  <option value="f_ic_no" selected>Ic No</option>
                  <option value="f_ethnic">Ethnicity</option>
                  <option value="f_date_diagnosis">Date of Diagnosis</option>
                  <option value="f_age_diagnosis">Age of Diagnosis</option>
                  <option value="f_date_consent">Date of Consent</option>
                  
              </select>
              <br/>
              <span small>*[hold CTRL + select item to select multiple item]</span>
          </td>
      </tr>
      <tr>
                <td>
                    Patient Start From:
                </td>
                <td>
                   <select name="patient_start">
                  <option value="0" selected>1 - 1000</option>
                  <option value="1001">1001 - 2000</option>
                  <option value="2001" >2001 - 3000</option>
                  <option value="3001">3001 - 4000</option>
                  <option value="4001">4001 - 5000</option>
                  <option value="5001">5001 - 6000</option>
              </select>
                </td>
      </tr>
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
    <?php echo form_open('report/export_record_list'); ?>
    <div class="container" id="report_form_section" >
        <div height="30px">&nbsp;</div>
        <table border="1" width="50%" style="margin-left:180px;">
            <thead>
                <tr>
                    <th style="background-color:Crimson;">No</th>
                    <?php if (in_array('given_name',$patient_field)) echo '<th style="background-color:Crimson;">Given Name</th>'; ?>
                    <?php if (in_array('sur_name',$patient_field)) echo '<th style="background-color:Crimson;">Sur Name</th>'; ?>
                    <?php if (in_array('f_ic_no',$patient_field)) echo '<th style="background-color:Crimson;">IC No</th>'; ?>
                    <?php if (in_array('f_ethnic',$patient_field)) echo '<th style="background-color:Crimson;">Ethnicity</th>'; ?>
                    <?php if (in_array('f_date_diagnosis',$patient_field)) echo '<th style="background-color:Crimson;">Date of Diagnosis</th>'; ?>
                    <?php if (in_array('f_age_diagnosis',$patient_field)) echo '<th style="background-color:Crimson;">Age of Diagnosis</th>'; ?>
                    <?php if (in_array('f_date_consent',$patient_field)) echo '<th style="background-color:Crimson;">Date of Consent</th>'; ?>
                    <th style="background-color:Crimson;">All<input type="checkbox" name="selectall" name="selectallnone" id="selectallnone"/></th>
                </tr>
            </thead>
            <?php if($searched_result != NULL) {?>
            <?php $no = $patient_start + 1; foreach ($searched_result as $list): ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <?php if (in_array('given_name',$patient_field)) echo '<td>'.$list['given_name'].'</td>'; ?>
                    <?php if (in_array('sur_name',$patient_field)) echo '<td>'.$list['surname'].'</td>'; ?>
                    <?php if (in_array('f_ic_no',$patient_field)) echo '<td>'.$list['ic_no'].'</td>'; ?>
                    <?php if (in_array('f_ethnic',$patient_field)) echo '<td>'.$list['ethnicity'].'</td>'; ?>
                    <?php if (in_array('f_date_diagnosis',$patient_field)) echo '<td>'.$list['date_of_diagnosis'].'</td>'; ?>
                    <?php if (in_array('f_age_diagnosis',$patient_field)) echo '<td>'.$list['age_of_diagnosis'].'</td>'; ?>
                    <?php if (in_array('f_date_consent',$patient_field)) echo '<td>'.$list['date_at_consent'].'</td>'; ?>
                    <td>
            <input type="checkbox" name="patient_studies_id[]" class="patientcheckbox" checked="checked" value="<?php echo $list['patient_studies_id']; ?>" />
<!--            <input type="hidden" name="patient_studies_id_all[]" value="<?php echo $list['patient_studies_id'];?>">-->
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
     
     <?php if (!empty ($patient_ethnic)){?>
     <?php foreach ($patient_ethnic as $ethnic_list): ?>
     <input type="hidden" name="ethnic_name[]" value="<?php echo $ethnic_list ;?>">
    <?php endforeach; ?>
     <?php }?>
     
     <?php if (!empty ($cancer_name)){?>
     <?php foreach ($cancer_name as $cancer_list): ?>
     <input type="hidden" name="cancer_name[]" value="<?php echo $cancer_list ;?>">
    <?php endforeach; ?>
     <?php }?>
     
     <?php if (!empty ($patient_field)){?>
     <?php foreach ($patient_field as $field_list): ?>
     <input type="hidden" name="field_name[]" value="<?php echo $field_list ;?>">
    <?php endforeach; ?>
     <?php }?>
     
    <?php echo form_dropdown('tab_name', $export_tab, NULL); ?>            
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




