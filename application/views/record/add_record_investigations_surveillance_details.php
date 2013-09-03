<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>Add Investigation & Surveillance Factors Details</p>
    </div>
    <?php echo form_open_multipart("record/investigation_surveillanve_insertion"); ?>
    <div class="container" id="add_record_form_section_studies">
        <div height="30px">&nbsp;</div>
		<?php
		echo form_fieldset('Investigation Details');
		?>
		<?php echo form_fieldset_close(); ?>	
	</div>
	<?php echo form_submit('mysubmit', 'Save'); ?>
	<?php echo form_close(); ?>
</div>




