<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.5
Version: 4.1.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Lurningo | CRM</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/simple-line-icons/simple-line-icons.min.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/uniform/css/uniform.default.css');?>" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/layout3/css/lurningo.css');?>"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo base_url('assets/global/plugins/select2/select2.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/admin/pages/css/login3.css');?>" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url('assets/global/css/components-rounded.css');?>" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/css/plugins.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/admin/layout/css/layout.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/admin/layout/css/themes/default.css');?>" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo base_url('assets/admin/layout/css/custom.css');?>" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
    <a href="<?php echo base_url('Login');?>">
    <img src="<?php echo base_url('assets/images/logo.png');?>" alt="" height="40"/>
    </a>
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <?php 
                $attributes = array("class" => "login-form", "id" => "loginform", "name" => "loginform");
                echo form_open("login/index", $attributes);?>
        <h3 class="form-title">Login to your account</h3>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span>
            Enter any username and password. </span>
        </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" id="txt_username" name="txt_username"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" id="txt_password" name="txt_password"/>
            </div>
            <span class="help-block"><?php echo form_error('txt_username'); ?> </span>
            <span class="help-block"><?php echo form_error('txt_password'); ?> </span>
        </div>
        <div class="form-actions">
            <label class="checkbox">
            <input type="submit" class="btn green-haze pull-right m-icon-swapright m-icon-white" value="Login">
            </input>
        </div>
        
    </form>
    <!-- END LOGIN FORM -->
 </div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
     2016 &copy; Lurningo CRM.
</div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo  base_url('assets/global/plugins/jquery.min.js');?>" type="text/javascript"></script>
<script src="<?php echo  base_url('assets/global/plugins/jquery-migrate.min.js');?>" type="text/javascript"></script>
<script src="<?php echo  base_url('assets/global/plugins/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
<script src="<?php echo  base_url('assets/global/plugins/jquery.blockui.min.js');?>" type="text/javascript"></script>
<script src="<?php echo  base_url('assets/global/plugins/uniform/jquery.uniform.min.js');?>" type="text/javascript"></script>
<script src="<?php echo  base_url('assets/global/plugins/jquery.cokie.min.js');?>" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo  base_url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js');?>" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo  base_url('assets/global/plugins/select2/select2.min.js');?>"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo  base_url('assets/global/scripts/metronic.js');?>" type="text/javascript"></script>
<script src="<?php echo  base_url('assets/admin/layout/scripts/layout.js');?>" type="text/javascript"></script>
<script src="<?php echo  base_url('assets/admin/layout/scripts/demo.js');?>" type="text/javascript"></script>
<script src="<?php echo  base_url('assets/admin/pages/scripts/login.js');?>" type="text/javascript"></script>
<script>
$("#txt_username").focus();
</script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>



