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
        <link href="assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
        <link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
        <link href="assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
        <link href="assets/admin/layout/css/themes/grey.css" rel="stylesheet" type="text/css" id="style_color"/>
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="assets/images/favicon.png">
        
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
                    <li class="dropdown dropdown-language">
                        <a href="<?php echo base_url();?>index.php/maini" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                        <img alt="" src="assets/global/img/flags/id.png"> 
                        <span class="langname">
                        Indonesia </span>
                        <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="<?php echo base_url();?>index.php/main">
                                <img alt="" src="assets/global/img/flags/gb.png">Inggris</a>
                                 </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END LANGUAGE BAR -->
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <span class="username username-hide-on-mobile" style="color: white;">
                        Selamat Datang, <?=$session['display_name']?> </span>
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
                                <i class="fa fa-gear"></i><?=$session['role_name']?><?=$session['role_id'] ?>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <?php if ($session['role_status'] == 'PR (PIC Division - RAC)' ) { ?>
                            
                            
                            <li>
                                <a target="_self" href="<?=$site_url."/maini/mainrac/switchTo/pic"?>">
                                <i class="fa fa-gear"></i>Ganti sebagai PIC
                                </a>
                            </li>
                            <li>
                            
                                <a target="_self" href="<?=$site_url."/maini/mainrac/switchTo/rac"?>">
                                <i class="fa fa-gear"></i>Ganti sebagai RAC
                                </a>
                            </li>
                            <?php }?>
                            <?php if ($session['role_status'] == 'HR (Head Division - RAC)' ) { ?>
                            <li>
                                <a target="_self" href="<?=$site_url."/maini/mainrac/switchTo/head"?>">
                                <i class="fa fa-gear"></i>Ganti sebagai Kepala Divisi
                                </a>
                            </li>
                            <li>
                            
                                <a target="_self" href="<?=$site_url."/maini/mainrac/switchTo/rac"?>">
                                <i class="fa fa-gear"></i>Ganti sebagai RAC
                                </a>
                            </li>
                            <?php } ?>
                            <?php if ($session['role_status'] == 'UR (User - RAC)' ) { ?>
                            <li>
                                <a target="_self" href="<?=$site_url."/maini/mainrac/switchTo/user"?>">
                                <i class="fa fa-gear"></i>Ganti sebagai User
                                </a>
                            </li>
                            <li>
                            
                                <a target="_self" href="<?=$site_url."/maini/mainrac/switchTo/rac"?>">
                                <i class="fa fa-gear"></i>Ganti sebagai RAC
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
                        <i class="icon-logout"></i> <span style="color: white;">Keluar</span>
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
                <?=$sidebarMenu?>
            </ul>
            <li class="start" style="background-color: none;">
                    <center><img src="assets/images/menu_app_logo2.png" width="100%" height="100%"/></center>
                </li>
            <!-- END SIDEBAR MENU -->
        </div>
    </div>
