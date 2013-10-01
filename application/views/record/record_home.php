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
        <script type="text/javascript">
            function calcHeight()
            {
                document.getElementById('iframe_record_home').height = document.getElementById('iframe_record_home').contentDocument.documentElement.scrollHeight + 15; //Chrome
                document.getElementById('iframe_record_home').height = document.getElementById('iframe_record_home').contentWindow.document.body.scrollHeight + 15; //FF, IE
            }
        </script>
        <script src="<?php echo base_url(); ?>js/addFormsDynamicFields.js" language="Javascript" type="text/javascript"></script>
		 
    </head>
    <body>

        <!-- /navigation bar starts here -->
        <div class="container">
            <div class="row" style="padding-top:20px;">
                <div class="row">
                    <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>img/Carif_logo.jpg" alt="logo" width="100%"/></a>
                </div>
                <div id="header" class="row">
                    <table border="0" width="60%"><tr><td><a class="btn btn-large btn-info home_btn" href="<?php echo base_url(); ?>">Home</a></td><td><span class="welcome_msg">Welcome to CARIF database system</span></td><td><a class="btn btn-large btn-info logout_btn" href="templates/home.html">Logout</a></td><tr></table>
                </div>
                <div>
                    <a class="add_record_tab_btn" href="<?php echo site_url('record/view_list/personal'); ?>" target="iframe_record_home" >Personal</a>
                    <a class="add_record_tab_btn" href="<?php echo site_url('record/view_list/family'); ?>" target="iframe_record_home" >Family</a>
                    <a class="add_record_tab_btn" href="<?php echo site_url('record/view_list/studies_setOne'); ?>" target="iframe_record_home" >Screenings & Surveillance</a>
                     <a class="add_record_tab_btn" href="<?php echo site_url('record/view_list/mutation_analysis'); ?>" target="iframe_record_home" >Mutation Analysis</a>
                    <a class="add_record_tab_btn" href="<?php echo site_url('record/view_list/pathology'); ?>" target="iframe_record_home" >Pathology</a>
					<a class="add_record_tab_btn" href="<?php echo site_url('record/view_list/risk_assessment'); ?>" target="iframe_record_home" >Risk Assessment</a>
					<a class="add_record_tab_btn" href="<?php echo site_url('record/view_list/lifestyleFactors'); ?>" target="iframe_record_home" >Lifestyle Factors</a>
                    <a class="add_record_tab_btn" href="<?php echo site_url('record/view_list/counselling'); ?>" target="iframe_record_home" >Counselling</a>


                    <a class="add_record_tab_btn" href="<?php echo site_url('record/view_list/bulkImport'); ?>" target="iframe_record_home" >Bulk Import</a>

                    <iframe src="<?php echo site_url('record/view_list/personal'); ?>" id="iframe_record_home" name="iframe_record_home" onLoad="calcHeight();" width="100%" height="700px" scrolling="no"></iframe>
                </div>
                <div id="footer" class="row">
                    <p>Copyright. @2013. Carif.</p>
                </div>
            </div>
        </div>
        <div height="40px"> &nbsp;</div>
    </body>
</html>
