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
        
       
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="assets/images/favicon.png">
        
        <script type="text/javascript">
            var base_url = "<?=$base_url?>";
            var site_url = "<?=$site_url?>";
            var banner_status = "<?=$banner['banner_status']?>";
        </script>
    </head>
    <body  style="zoom:0.8">
    

    
<div class="page-container">

    <?php clearstatcache(); //celar cache ?>
