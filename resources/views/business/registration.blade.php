<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Unsilo | Signup </title>
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
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        {!!Html::style('public/assets/global/css/components.css')!!}
        {!!Html::style('public/assets/global/css/plugins.min.css')!!}
        {!!Html::style('public/assets/global/plugins/bootstrap-toastr/toastr.min.css')!!}
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        {!!Html::style('public/assets/pages/css/login.css')!!}
        {!!Html::style('public/css/custom.css')!!}
        {!!Html::style('public/assets/global/plugins/icheck/skins/all.css')!!}
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
        <style type="text/css">
            .login {
              width: 100%;
              height: 100%;
            }
            @media(min-width:1024px)
            {
                .width-50{
                    width:50% !important;
                }
            }
        </style>
    <!-- END HEAD -->

    <body class="login">
        <!-- BEGIN : LOGIN PAGE 5-1 -->
       <div class="logo" style="margin-top: 10px;position: relative">
            <a href="index.html">
                <img  src="{{url('public/assets/pages/img/login/logo.png')}}" /></a>
        </div>
                
                <div class="content width-50" >
                        <h1 style="font-family: Nunito;font-weight:600"><?php echo Lang::get('language_business.register');?></h1> 
                        <hr>
                        <form action="<?php echo url('register_business_data')?>" class="register-form" method="post" style="margin-top: 40px;display: block">
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                <span><?php echo Lang::get('language_business.blank_error_msg');?> </span>
                            </div>
                               <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label visible-ie8 visible-ie9"><?php echo Lang::get('language_business.name');?></label>
                                        <input type="text" class="form-control"  name="name"  placeholder="<?php echo Lang::get('language_business.name');?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label visible-ie8 visible-ie9"><?php echo Lang::get('language_business.surname');?></label>
                                        <input type="text" class="form-control"  name="surname" placeholder="<?php echo Lang::get('language_business.surname');?>">
                                    </div>
                                
                                    <div class="form-group">
                                        <label class="control-label visible-ie8 visible-ie9"><?php echo Lang::get('language_business.organization');?></label>
                                        <input type="text" class="form-control"  name="organization" placeholder="<?php echo Lang::get('language_business.organization');?>">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label visible-ie8 visible-ie9"><?php echo Lang::get('language_business.find_us');?></label>
                                        <select class="form-control" name="find_us">
                                            <option value=""><?php echo Lang::get('language_business.find_us');?></option>
                                            <option value="Email">Email</option>
                                            <option value="Linkedin">Linkedin</option>
                                            <option value="Facebook">Facebook</option>
                                            <option value="Instagram">Instagram</option>
                                            <option value="Google">Google</option>
                                            <option value="Word of mouth">Word of mouth</option>
                                        </select>
                                    </div>
                                    <a href="<?php echo url('business')?>"  class="pull-left forget-password"><?php echo Lang::get('language_business.alreadey_have_account')?> <?php echo Lang::get('language_business.login')?></a>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label visible-ie8 visible-ie9"><?php echo Lang::get('language_business.email');?></label>
                                        <input type="email" class="form-control"  name="email" placeholder="<?php echo Lang::get('language_business.email');?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label visible-ie8 visible-ie9"><?php echo Lang::get('language_business.password');?></label>
                                        <input type="password" class="form-control"  name="password" id="password" placeholder="<?php echo Lang::get('language_business.password');?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label visible-ie8 visible-ie9"><?php echo Lang::get('language_business.cnf_password');?></label>
                                        <input type="password" class="form-control"  name="cnf_password" placeholder="<?php echo Lang::get('language_business.cnf_password');?>">
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="icheck-inline">
                                                <label>
                                                    <input type="radio" name="access_type" value="1" checked class="icheck"> <?php echo Lang::get('language_business.for_individual')?> </label>
                                                <label>
                                                    <input type="radio" name="access_type" value="2"  class="icheck"> <?php echo Lang::get('language_business.for_company')?> </label>
                                                
                                            </div>
                                        </div>
                                    </div>
                                   <div class="form-actions text-right">
                                    
                                    <button class="btn red border-none btn-lg" type="submit"><?php echo Lang::get('language_business.confirm');?></button>
                                    <button class="btn red border-none btn-lg" type="reset"><?php echo Lang::get('language_business.reset');?></button>
                                </div>
                                </div>
                                </div>
                                    
                        </form>
                   
                    
                </div>
        <!-- END : LOGIN PAGE 5-1 -->
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<script src="../assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script>
        var base_url="<?php echo url('/')?>";
        var base_url_main="<?php echo url('/')?>";
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
        {!!Html::script('public/assets/global/plugins/icheck/icheck.min.js')!!}
        {!!Html::script('public/assets/pages/scripts/form-icheck.min.js')!!}

        {!!Html::script('public/assets/global/plugins/bootstrap-toastr/toastr.min.js')!!}
        {!!Html::script('public/assets/pages/scripts/ui-toastr.min.js')!!}
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        {!!Html::script('public/assets/global/scripts/app.js')!!}
        {!!Html::script('public/assets/pages/custom.js')!!}
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        {!!Html::script('public/assets/pages/scripts/company-register.js')!!}
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
        
    </body>

</html>