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
        <base href="<?=$base_url?>" target="">
        
        
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="assets/fonts/Open-Sans/css/fonts.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/bootstrap-loading/lada.min.css" rel="stylesheet" type="text/css"/>
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <?=isset($pageLevelStyles) ? $pageLevelStyles : ''?>
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME STYLES -->
        <link href="assets/global/css/components2.css" id="style_components" rel="stylesheet" type="text/css"/>
        <link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
        <link href="assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
        <link href="assets/admin/layout/css/themes/grey.css" rel="stylesheet" type="text/css" id="style_color"/>
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="assets/images/favicon.png">
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script type="text/javascript">
        	var base_url = "<?=$base_url?>";
        	var site_url = "<?=$site_url?>";
        	var banner_status = "<?=$banner['banner_status']?>";
        </script>
    </head>
    <body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo" style="zoom:0.8">
    
    <div class="page-header navbar navbar-fixed-top">
    	<!-- BEGIN HEADER INNER -->
    	<div class="page-header-inner">
    		<!-- BEGIN LOGO -->
    		<div class="page-logo">
    			<img src="assets/images/logo_app_top.png" alt="logo" class="logo-default" style="margin: 8px 0 0 0;"/>
    			<!--<div class="menu-toggler sidebar-toggler">-->
    			</div>
    		</div>
    		<!-- END LOGO -->
    		<!-- BEGIN RESPONSIVE MENU TOGGLER 
    		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
    		</a>-->
    		<!-- END RESPONSIVE MENU TOGGLER -->
    		<!-- BEGIN TOP NAVIGATION MENU -->
    		<div class="top-menu">
    			<ul class="nav navbar-nav pull-right">
    				<!-- BEGIN USER LOGIN DROPDOWN -->
    				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
    				<?php if ($banner['banner_status'] == 1) { ?>
    				<li class="dropdown dropdown-extended">
    					<ul id="webticker">
    					    <li><?=$banner['banner_text']?></li> 
    					</ul>
    				</li>
    				<?php } ?>
    				<!-- BEGIN LANGUAGE BAR -->
					<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <?php if ($session['role_id'] != 1 ) { ?>
					<li class="dropdown dropdown-language">
						<a href="<?=$engnya?>" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<img alt="" src="assets/global/img/flags/gb.png">
						<span class="langname">
						English </span>
						<i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu dropdown-menu-default">
							<li>
                            <!--
                                Ditunda tunggu selesai semuanya baru phase bahasa
								<a href="<?=$indonya?>">
								<img alt="" src="assets/global/img/flags/id.png"> Indonesian </a>
                            -->
                                <a><img alt="" src="assets/global/img/flags/id.png"> Indonesian </a>
							</li>
						</ul>
					</li>
                    <?php } ?>
					<!-- END LANGUAGE BAR -->
    				<li class="dropdown dropdown-user">
    					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
    					<span class="username username-hide-on-mobile" style="color: white;">
    					Welcome, <?=$session['display_name']?> </span>
    					<i class="fa fa-angle-down"></i>
    					</a>
    					<ul class="dropdown-menu dropdown-menu-default" style="width: inherit; min-width: 195px;">
							<li>
								<a href="javascript:;">
								<i class="fa fa-user"></i><?=$session['username']?></a>
							</li>
							<li>
								<a href="javascript:;">
								<i class="fa fa-sitemap"></i><?=$session['division_name']?></a>
							</li>
							
							<li>
								<a href="javascript:;">
								<i class="fa fa-gear"></i><?=$session['role_name']?><? =$session['role_id'] ?>
								</a>
							</li>
							<li class="divider"></li>
							<?php if ($session['role_status'] == 'PR (PIC Division - RAC)' ) { ?>
							
							
							<li>
								<a target="_self" href="<?=$site_url."/main/mainrac/switchTo/pic"?>">
								<i class="fa fa-gear"></i>Switch As PIC
								</a>
							</li>
                            <li>
                            
                                <a target="_self" href="<?=$site_url."/main/mainrac/switchTo/rac"?>">
                                <i class="fa fa-gear"></i>Switch to RAC
                                </a>
                            </li>
							<?php }?>
							<?php if ($session['role_status'] == 'HR (Head Division - RAC)' ) { ?>
							<li>
								<a target="_self" href="<?=$site_url."/main/mainrac/switchTo/head"?>">
								<i class="fa fa-gear"></i>Switch As Division Head
								</a>
							</li>
                            <li>
                            
                                <a target="_self" href="<?=$site_url."/main/mainrac/switchTo/rac"?>">
                                <i class="fa fa-gear"></i>Switch to RAC
                                </a>
                            </li>
                            <?php }?>
                            <?php if ($session['role_status'] == 'COO (Chief Operating - User)' ) { ?>
                            <li>
                                <a target="_self" href="<?=$site_url."/main/mainrac/switchTo/user"?>">
                                <i class="fa fa-gear"></i>Switch As User
                                </a>
                            </li>
                            <li>
                            
                                <a target="_self" href="<?=$site_url."/main/mainrac/switchTo/coo"?>">
                                <i class="fa fa-gear"></i>Switch to Chief Operating
                                </a>
                            </li>
                           <?php }?>
                            <?php if ($session['role_status'] == 'CEO (Chief Executive - User)' ) { ?>
                            <li>
                                <a target="_self" href="<?=$site_url."/main/mainrac/switchTo/user"?>">
                                <i class="fa fa-gear"></i>Switch As User
                                </a>
                            </li>
                            <li>
                            
                                <a target="_self" href="<?=$site_url."/main/mainrac/switchTo/ceo"?>">
                                <i class="fa fa-gear"></i>Switch to Chief Executive
                                </a>
                            </li>
                           


							<?php }?>
                            <?php if ($session['role_status'] == 'CF (Chief Finance - User)' ) { ?>
                            <li>
                                <a target="_self" href="<?=$site_url."/main/mainrac/switchTo/user"?>">
                                <i class="fa fa-gear"></i>Switch As User
                                </a>
                            </li>
                            <li>
                            
                                <a target="_self" href="<?=$site_url."/main/mainrac/switchTo/cf"?>">
                                <i class="fa fa-gear"></i>Switch to Chief Finance
                                </a>
                            </li>
                            <?php } ?>
                            
                            <?php if ($session['role_status'] == 'UR (User - RAC)' ) { ?>
							<li>
								<a target="_self" href="<?=$site_url."/main/mainrac/switchTo/user"?>">
								<i class="fa fa-gear"></i>Switch As User Role
								</a>
							</li>
                            <li>
                            
                                <a target="_self" href="<?=$site_url."/main/mainrac/switchTo/rac"?>">
                                <i class="fa fa-gear"></i>Switch to RAC
                                </a>
                            </li>
							<?php } ?>
						</ul>
    					
    				</li>
    				<!-- END USER LOGIN DROPDOWN -->
    				<!-- BEGIN QUICK SIDEBAR TOGGLER -->
    				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
    				<li class="dropdown dropdown-quick-sidebar-toggler">
    					<a href="<?=$site_url?>" target="_self" class="dropdown-toggle">
    					<i class="icon-logout"></i> <span style="color: white;">Sign Out</span>
    					</a>
    				</li>
    				<!-- END QUICK SIDEBAR TOGGLER -->
    			</ul>
    		</div>
    		<!-- END TOP NAVIGATION MENU -->
    	</div>
    	<!-- END HEADER INNER -->
    </div>
    <div class="clearfix">
    </div>

<div class="page-container">
    <div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
			<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
			<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
			<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<ul class="page-sidebar-menu page-sidebar-menu-hover-submenu" data-keep-expanded="false" data-auto-scroll="false" data-slide-speed="200">
				<li class="start" style="background-color: #FFF;">
					<center><img src="assets/images/menu_app_logo.png"/></center>
				</li>                
				<li><a href="<?=site_url('/main/maindireksirac/getmyDirectorate')?>"><span class="fa fa-institution" style="font-size: 16px;color: #b3b3b3;"></span>&nbsp;&nbsp;&nbsp;Home</a></li>
                <li><a href="<?=site_url('/main/newsdir/news_my_cf')?>"><span class="icon-feed" style="font-size: 16px;color: #bfbfbf;"></span>&nbsp;News</a></li>
                <li><a href="<?=site_url('/main/upload')?>"><span class="fa fa-file-pdf-o" style="font-size: 16px;color: #bfbfbf;"></span>&nbsp;&nbsp;&nbsp;View Report</a></li>
                <li><a href="<?=site_url('/main/main/policydir')?>"><span class="icon-book-open" style="font-size: 16px;color: #bfbfbf;"></span>&nbsp;Policy</a></li>
                <li><a href="<?=site_url('/main/main/policydir')?>"><span class="icon-info" style="font-size: 16px;color: #bfbfbf;"></span>&nbsp;Usermanual</a></li>
                <li><a><span class="fa fa-exchange" style="font-size: 16px;color: #bfbfbf;"></span>&nbsp;&nbsp;&nbsp;Change My Role</a>
                        <li><a>tes</a></li>
                        <li><a>tes2</a></li>
                </li>
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
    <?php 
        clearstatcache(); //celar cache 
        error_reporting(0);
    ?>
