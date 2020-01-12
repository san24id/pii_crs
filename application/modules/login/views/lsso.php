<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?=$app_config['APP_DISPLAY_NAME']?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="" name="description" />
        <meta content="dying_angel" name="author" />
        <base href="<?=$base_url?>" target="_blank">
        
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="assets/fonts/Open-Sans/css/fonts.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/bootstrap-loading/lada.min.css" rel="stylesheet" type="text/css"/>
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="assets/css/login.css" rel="stylesheet" type="text/css"/>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME STYLES -->
        <link href="assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
        <link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
        <link href="assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
        <link href="assets/admin/layout/css/themes/grey.css" rel="stylesheet" type="text/css" id="style_color"/>
        <link href="assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="assets/images/favicon.png">
        
        <script type="text/javascript">
        	var base_url = "<?=$base_url?>";
        	var site_url = "<?=$site_url?>";
        </script>
    </head>
    <body class="login">
    <!-- BEGIN LOGIN -->
    <div class="container">
    <div style="background-color: #FFF; padding: 5px; width: 103.2%;">    
              <div style="margin:-5px;"><img src="assets/images/header.png" width="100%" height="35px"></div>
        </div>
   
    	<div class="account-info" >
            <center><img src="assets/images/bg_iigf.png" width="240px"></center>
            <center><img src="assets/images/lines.png" width="200px" height="20px"></center>
           
            <!--
    		<center><img src="assets/images/login_logo2.png"></center>
    		<h3 style="color: #008cb9;">CORPORATE</h3>
    		<h3 style="color: #008cb9;">RISK MANAGEMENT</h3>
    		<h3 style="color: #008cb9;">SYSTEM</h3>
            -->
    		<!--<h5>-</h5>-->
    	</div>

    	<!-- BEGIN LOGIN FORM -->
    	<div class="account-form">
    		<!-- <div class="logo-mobile"><img src="assets/images/login_logo2.png"></div> -->

            <!-- FORM UNTUK AJAX LOADING LOGIN
    		<form class="login-form" action="index.html" method="post" id="auth-form">
    			<div class="alert alert-danger display-hide">
    				<button class="close" data-close="alert"></button>
    				<span id="alert-msg-container"></span>
    			</div>
    			<div class="form-group">
    				//ie8, ie9 does not support html5 placeholder, so we just show field title for that
    				<label class="control-label visible-ie8 visible-ie9">Username</label>
    				<input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username"/>
    			</div>
    			<div class="form-group">
    				<label class="control-label visible-ie8 visible-ie9">Password</label>
    				<input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
    			</div>
    			<div class="form-actions">
    				<button type="submit" id="submit-form" class="btn btn-submit uppercase ladda-button" data-style="expand-right">
    				<span class="ladda-label">Login</span>
    				</button>
    			</div>
    		</form>

            -->


           <!--  this form for no AJAX  -->
                <center><img src="assets/images/headlines.gif" width="300px" height="150px;"></center>
                </br>
                <form target="_self" action="<?=$site_url?>/login/authenticate" method="post" id="sso_login" role="form" class="login-form">
                   
                   <?php 
                            $status = $this->input->get('status');
                            if ($status == 'false'){
                     ?>
                            <div class="alert alert-danger">
                            <span id="">Invalid Username / Password !</span>
                            </div>
                    <?php
                            }else if ($status == 'device') {
                    ?>
                            <div class="alert alert-danger">
                            <span id="">Your Account still login at another device, Please Logout First</span>
                            </div>
                    <?php
                            }
                    ?>


                <?php 
                    $this->load->database();
                    $sql = "select username from m_user_sso
                             where computer_name = '".strtolower(gethostbyaddr($_SERVER['REMOTE_ADDR']))."' and on_login = 0";
                    $query = $this->db->query($sql);
                    if ($query->num_rows() > 0){
                        $hasil = $query->row();
                        $user = $hasil->username;
            
                    }
                ?>
                 <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" autofocus required oninvalid="this.setCustomValidity('please input username')" oninput="setCustomValidity('')" value="<?php error_reporting(0); echo $user; ?>" readonly/>
                    <input  type="hidden" autocomplete="off" name="password" />
                </div>    
                    
                <div class="form-actions">
                    <button type="submit" id="" class="btn btn-submit uppercase ladda-button" data-style="expand-right">
                    <span class="ladda-label">Login</span>
                    </button>
                </div>
                </form>
            <!-- end form -->
    	</div>
    	<div style="background-color: #FFF; padding: 15px; width: 103.2%;">
    		 <div style="float:left;"><img height="30px" src="assets/images/footer_iigf.png" width="275px"></div>
             <div style="clear:both;"></div>
             <div style="float:right;margin-top:-20px;margin-right:10px;"> Copyright © 2015 </div>
    	</div>
    	<!-- END LOGIN FORM
    	<div class="copyright">
    		 <span>Copyright © <?=date('Y')?> </span><span><?=$app_config['COPYRIGHT']?></span>.
    	</div> -->
    </div>
    
    <!-- END LOGIN -->
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
    <!--[if lt IE 9]>
    <script src="assets/global/plugins/respond.min.js"></script>
    <script src="assets/global/plugins/excanvas.min.js"></script> 
    <![endif]-->
    <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
    <script src="assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
    <script src="assets/global/plugins/bootstrap-loading/lada.min.js"></script>
    <script src="assets/scripts/login.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
    jQuery(document).ready(function() {     
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    Login.init();
    });
    
    document.getElementById('sso_login').submit(); // SUBMIT FORM
    </script>
    <!-- END JAVASCRIPTS -->
    </body>
    <!-- END BODY -->
    </html>