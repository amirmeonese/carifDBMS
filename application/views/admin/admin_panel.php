<div class="container" id="admin_panel_div">
    <div id="add_record_header" class="row">
        <p>Admin Panel</p>
    </div>
    <div class="container" id="add_record_form_section_one">
        <div height="50px">&nbsp;</div>
            <div class="span3">

                <form name="submit_report" action="admin/submit_report_form" method="post">
                    <input type ="image" src="<?php echo base_url(); ?>img/submit_report.png" alt="submit_report_button" height="120px"></input>
                </form> 
            </div>
            <div class="span3">

                <form name="add_record" action="admin/create_new_user" method="post">
                    <input type ="image" src="<?php echo base_url(); ?>img/create_user.png" alt="add_new_form_button" height="120px"></input>
                </form>        
            </div>
            <div class="span3">

                <form name="add_record" action="admin/create_new_report" method="post">
                    <input type ="image" src="<?php echo base_url(); ?>img/add_new_form.png" alt="add_new_form_button" height="120px"></input>
                </form>
            </div>
            <div class="span3">

                <form name="add_record" action="admin/list_record_locked_item" method="post">
                    <input type ="image" src="<?php echo base_url(); ?>img/view_locked_item.png" alt="add_new_form_button" height="120px"></input>
                </form> 
            </div>
            <div class="span3">

                <form name="add_record" action="admin/list_error_locked_item" method="post">
                    <input type ="image" src="<?php echo base_url(); ?>img/view_error_log.png" alt="add_new_form_button" height="120px"></input>
                </form> 
            </div>
            <div class="span3">

                <form name="add_record" action="admin/list_error_locked_item" method="post">
                    <input type ="image" src="<?php echo base_url(); ?>img/deletion_history.png" alt="add_new_form_button" height="120px"></input>
                </form> 
            </div>
    </div>
    
        </div>




