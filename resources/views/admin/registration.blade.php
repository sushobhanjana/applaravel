<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Unsilome | User Login </title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        {!!Html::style('public/assets/global/plugins/font-awesome/css/font-awesome.min.css')!!}
        {!!Html::style('public/assets/global/plugins/simple-line-icons/simple-line-icons.min.css')!!}
        {!!Html::style('public/assets/global/plugins/bootstrap/css/bootstrap.min.css')!!}
        {!!Html::style('public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')!!}
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        {!!Html::style('public/assets/global/plugins/select2/css/select2.min.css')!!}
        {!!Html::style('public/assets/global/plugins/select2/css/select2-bootstrap.min.css')!!}
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        {!!Html::style('public/assets/global/css/components.min.css')!!}
        {!!Html::style('public/assets/global/css/plugins.min.css')!!}
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        {!!Html::style('public/assets/pages/css/login-5.min.css')!!}
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> 
    </head>
        <style>
        .user-login-5 .login-container>.login-content {
            margin-top: 25% !important;
        }
        </style>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN : LOGIN PAGE 5-1 -->
        <div class="user-login-5">
            <div class="row bs-reset">
                <?php
                $bg=url('public/assets/pages/img/login/bg1.jpg');
                ?>
                <div class="col-md-6 bs-reset mt-login-5-bsfix">
                    <div class="login-bg" style="background-image:url('<?php echo $bg;?>')">
                        <img class="login-logo" src="{{url('public/assets/pages/img/login/logo.png')}}" /> </div>
                </div>
                <div class="col-md-6 login-container bs-reset mt-login-5-bsfix">
                    <div class="login-content">
                        <h1><?php echo Lang::get('language_company.registration');?></h1>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        <form action="javascript:;" class="login-form" method="post" style="margin-top: 40px">
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                <span><?php echo Lang::get('language_company.blank_error_msg');?> </span>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="email" class="form-control"  name="email">
                                        <label for="form_control_1"><?php echo Lang::get('language_company.email');?></label>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="password" class="form-control"  name="password">
                                        <label for="form_control_1"><?php echo Lang::get('language_company.password');?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    &nbsp;
                                </div>
                                <div class="col-sm-8 text-right">
                                    
                                    <button class="btn green" type="submit"><?php echo Lang::get('language_company.submit');?></button>
                                    
                                </div>
                            </div>
                        </form>
                   
                    </div>
                    <div class="login-footer">
                        <div class="row bs-reset">
                            <div class="col-xs-5 bs-reset">
                                <ul class="login-social">
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-social-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-social-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-social-dribbble"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xs-7 bs-reset">
                                <div class="login-copyright text-right">
                                    <p>Copyright &copy; Keenthemes 2015</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END : LOGIN PAGE 5-1 -->
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<script src="../assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script>
        var base_url="<?php echo url('/')?>/public/";
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
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        {!!Html::script('public/assets/global/scripts/app.min.js')!!}
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        {!!Html::script('public/assets/pages/scripts/user-login.js')!!}
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>