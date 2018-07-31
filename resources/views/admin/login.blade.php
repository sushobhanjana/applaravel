<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>Unsilome | Admin Login </title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" type="text/css" />
        {!!Html::style('public/assets/global/plugins/font-awesome/css/font-awesome.min.css')!!}
        {!!Html::style('public/assets/global/plugins/simple-line-icons/simple-line-icons.min.css')!!}
        {!!Html::style('public/assets/global/plugins/bootstrap/css/bootstrap.min.css')!!}
        {!!Html::style('public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')!!}
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        {!!Html::style('public/assets/global/plugins/select2/css/select2.min.css')!!}
        {!!Html::style('public/assets/global/plugins/select2/css/select2-bootstrap.min.css')!!}
        {!!Html::style('public/assets/global/plugins/bootstrap-toastr/toastr.min.css')!!}
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        {!!Html::style('public/assets/global/css/components.css')!!}
        {!!Html::style('public/assets/global/css/plugins.min.css')!!}
        {!!Html::style('public/css/custom.css')!!}
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        {!!Html::style('public/assets/pages/css/login.css')!!}
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
        <style>
        .user-login-5 .login-container>.login-content {
            margin-top: 25% !important;
        }
        .login .content .form-actions{
            border-bottom: 0px !important;
        }
        </style>
        <style type="text/css">
            .login {
              width: 100%;
              height: 90vh;
              background: url('<?php echo url('public/assets/pages/img/login/unsilo-bg.jpg')?>') center center no-repeat !important;
              background-size: cover;
            }
        </style>
    <!-- END HEAD -->
    <body class="login">
        <div class="logo" style="position: relative;">
            <a href="index.html">
                <img  src="{{url('public/assets/pages/img/login/logo.png')}}" /></a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
                        <form action="<?php echo url('admin_authentication')?>" class="login-form" method="post" style="margin-top: 40px">
                            <h1 style="font-family:Nunito;font-weight:600;"><?php echo Lang::get('language_admin.admin_login');?></h1>
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                <span><?php echo Lang::get('language_admin.blank_error_msg');?> </span>
                            </div>
                                    <div class="form-group">
                                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                    <label class="control-label visible-ie8 visible-ie9"><?php echo Lang::get('language_admin.username');?></label>
                                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="<?php echo Lang::get('language_admin.username');?>" name="username" /> </div>
                                
                                    
                                    <div class="form-group">
                                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                    <label class="control-label visible-ie8 visible-ie9"><?php echo Lang::get('language_admin.password');?></label>
                                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="<?php echo Lang::get('language_admin.password');?>" name="password" /> </div>
                               
                               
                                <div class="form-actions">
                                   
                                    <button class="btn red btn-lg"  type="submit"><?php echo Lang::get('language_admin.sign_in');?></button>
                                    
                                </div>
                             
                        </form>
            
            <!-- END LOGIN FORM -->
            
                        <!-- END OTP FORM -->
                        
            
            <!-- END FORGOT PASSWORD FORM -->
            <!-- BEGIN REGISTRATION FORM -->
              
            <!-- END REGISTRATION FORM -->
        </div>
        <div class="copyright" style="position: relative;color:#fff"> 2017 © Unsilome. </div>
        
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<script src="../assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script>
        var base_url="<?php echo url('/')?>/public/";
        var base_url_main="<?php echo url('/')?>/";
        </script>
        {!!Html::script('public/assets/global/plugins/jquery.min.js')!!}
        {!!Html::script('public/assets/global/plugins/bootstrap/js/bootstrap.min.js')!!}
        {!!Html::script('public/assets/global/plugins/js.cookie.min.js')!!}
        {!!Html::script('public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')!!}
        {!!Html::script('public/assets/global/plugins/jquery.blockui.min.js')!!}
        {!!Html::script('public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')!!}
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        {!!Html::script('public/assets/global/plugins/jquery-validation/js/jquery.validate.min.js')!!}
        {!!Html::script('public/assets/global/plugins/jquery-validation/js/additional-methods.min.js')!!}
        {!!Html::script('public/assets/global/plugins/select2/js/select2.full.min.js')!!}
        {!!Html::script('public/assets/global/plugins/backstretch/jquery.backstretch.js')!!}
        <!-- END PAGE LEVEL PLUGINS -->
        {!!Html::script('public/assets/global/plugins/bootstrap-toastr/toastr.min.js')!!}
        {!!Html::script('public/assets/pages/scripts/ui-toastr.min.js')!!}
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        {!!Html::script('public/assets/global/scripts/app.js')!!}
        {!!Html::script('public/assets/pages/custom.js')!!}
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        {!!Html::script('public/assets/pages/scripts/admin-login.js')!!}
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>
</html>