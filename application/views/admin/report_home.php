<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            <?php
            echo "Carif Database Management System";
            ?>
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/bootstrap-responsive.min.css" rel="stylesheet">


        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>img/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>img/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>img/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>img/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>img/favicon.ico">

        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.js"></script>
    </head>
    <body>

        <!-- /navigation bar starts here -->
        <div class="container">
            <div class="row" style="padding-top:20px;">
                <div class="row">
                    <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>img/Carif_logo.jpg" alt="logo" width="100%"/></a>
                </div>
                <div id="header" class="row">
                    <table border="0" width="60%">
                        <tr>
                            <td>
                                <a class="btn btn-large btn-info home_btn" href="<?php echo base_url(); ?>">Home</a>
                            </td>
                            <td>
                                <span class="welcome_msg">Welcome to CARIF database system</span>
                            </td>
                            <td>
                                <a class="btn btn-large btn-info logout_btn" href="<?php echo site_url('auth/logout'); ?>">
                                    Logout
                                </a>
                            </td>
                        <tr>
                    </table>
                </div>
                <div>
                    <!--<a class="add_record_tab_btn" href="<?php echo site_url('record/view_list/personal'); ?>" target="iframe_record_home" >
                        Personal
                    </a>
                    <a class="add_record_tab_btn" href="<?php echo site_url('record/view_list/family'); ?>" target="iframe_record_home" >
                        Family
                    </a>-->
                    <iframe src="<?php echo site_url('admin/admin_panel/home'); ?>" name="iframe_record_home" width="100%" height="400px" scrolling="no"></iframe>
                </div>
                <div id="footer" class="row">
                    <p>Copyright. @2013. Carif.</p>
                </div>
            </div>
        </div>
        <div height="10px"> &nbsp;</div>
    </body>
</html>
