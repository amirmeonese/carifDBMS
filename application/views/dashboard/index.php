
<div class="container">
	<div class="row" style="padding-top:20px;">
		<div class="row" style="padding-top: 25px; padding-bottom: 10px;">
			<div class="span3">
				<form name="add_record" action="record" method="post">
					<input type ="image" src="<?php echo base_url(); ?>img/add_record.png" alt="add_new_form_button" height="270px"></input>
				</form>
			</div>
			<div class="span3">
				<form name="auto_match" action="record/patient_record_list" method="post">
					<input type ="image" src="<?php echo base_url(); ?>img/view_record_page.png" alt="view_record_page_button" height="270px"></input>
				</form>
			</div>
			<div class="span3">
				<form name="show_instance" action="report" method="post">
					<input type ="image" src="<?php echo base_url(); ?>img/report_manager.png" alt="view_report_manager_button" height="270px"></input>
				</form>
			</div>
			<div class="span3">
				<form name="show_preview" action="admin" method="post">
					<input type ="image" src="<?php echo base_url(); ?>img/admin_panel.png" alt="admin_panel_button" height="270px"></input>
				</form>
			</div>
		</div>
	</div>
</div>