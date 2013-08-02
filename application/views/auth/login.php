<div class="container" id="login_form_div">
	<div class="container" id="login_form_inner_div">
		<div class="row login_form_title">
			<p>DATABASE SYSTEM LOGIN</p>
			<img class="form_title_line" src="<?php echo base_url(); ?>img/form_line.png" alt="form_title_line"/>
			
		</div>
		<?php echo form_open("auth/login");?>
		<p>
			<?php echo lang('login_identity_label', 'identity');?>
			<?php echo form_input($identity);?>
		</p>
		<p>
			<?php echo lang('login_password_label', 'password');?>
			<?php echo form_input($password);?>
		</p>
		<p>
			<?php echo lang('login_remember_label', 'remember');?>
			<?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
		</p>
		<p><?php echo form_submit('submit', lang('login_submit_btn'));?></p>
		<p class="use_windows_auth_label">
			<?php echo lang('use_windows_auth','is_use_windows_auth'); ?>
		</p>
		<p><?php echo form_submit('submit', lang('windows_auth_btn'));?></p>
		<?php echo form_close();?>
		<p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>
	<div>
</div>