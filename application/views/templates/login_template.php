<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            <?php
            if (empty($title)) {
                echo "Carif Database Management System";
            } else {
                echo $title;
            }
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
	
        <?php
        //adding extra css if needs to load
        //a specific view
        if (!empty($css)) {
            echo $css;
        }

        //lood some extra js if needed
        if (!empty($js)) {
            echo $js;
        }
        ?>
    </head>
    <body>

        <!-- /navigation bar starts here -->
		<div class="container">
			<div class="row" style="padding-top:20px;">
				<div class="row">
					<img src="<?php echo base_url(); ?>img/Carif_logo.jpg" alt="logo" width="100%"/>
				</div>
				<?php $this->load->view($main_content);?>
			</div>
			<div>&nbsp;</div>
		</div>
		<div id="login_footer" class="row">
				<p>Copyright. @2013. Carif.</p>
		</div>
    </body>
</html>
