<?php echo form_open('login', array('class' => 'form-inline pull-right'));?>
  <table cellspacing="0">
  <tbody>
  <tr>
  <td><label class="control-label">Email</label></td>
  <td><label class="control-label">Password</label></td>
  </tr>
  <tr>
  <td><?php echo form_input($identity);?></td>
  <td><?php echo form_input($password);?></td>
  <td><?php 
            $button_data = $data = array(
                            'name' => 'login_submit_btn',
                            'id' => 'login_submit_btn',
                            'type' => 'submit',
                            'value' => 'Login',
                            'class' => 'btn btn-login'
                        );
            //echo form_submit('submit', 'login_submit_btn', array('class' => 'btn btn-login'));
            echo form_submit($button_data);
        ?></td>
  <td>or
      
      <?php echo anchor('login/facebook', '<img class="logo" height="36" src="'.base_url().'img/facebook-logo.png" alt="fb" />');?>
      <?php echo anchor('login/linkedin', '<img class="logo" height="36" src="'.base_url().'img/linkedin-logo.png" alt="fb" />');?>
      <?php echo anchor('login/twitter', '<img class="logo" height="36" src="'.base_url().'img/twitter-logo.png" alt="fb" />');?>
      <?php echo anchor('login/google', '<img class="logo" height="36" src="'.base_url().'img/gplus-logo.png" alt="fb" />');?>
  </td></tr>
  <tr>
  <td>
  <div>
  <div>
  <label class="checkbox"><?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?><span><?php echo form_label('Remember me','remember', array('class'=> 'checkbox'))?></div>
  <td>
      <?php echo anchor("password/forget_password", "Forgot your password?",'style="color:#ffffff;"'); ?>
  </td></tr>
  </tbody></table>
<?php echo form_close();?>



