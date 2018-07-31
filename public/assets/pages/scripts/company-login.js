var Login = function() {

    var handleLogin = function() {

        $('.login-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // do not focus the last invalid input
            rules: {
                email: {
                    required: true,
                    email:true
                },
                password: {
                    required: true
                },
                
            },

            messages: {
                email: {
                    required: "Email is required."
                },
                password: {
                    required: "Password is required."
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   

            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                if (element.attr("name") == "tnc") { // insert checkbox errors after the container                  
                    error.insertAfter($('#register_tnc_error'));
                } else if (element.closest('.input-icon').size() === 1) {
                    error.insertAfter(element.closest('.input-icon'));
                } else {
                    error.insertAfter(element);
                }
            },

            submitHandler: function(form) {
                var form_data=$('.login-form').serialize();
                Main.appendLoader();
                $.ajax({
                    url:base_url_main+"business_authentication",
                    data:form_data,
                    type:'POST',
                    success:function(res){
                        console.log(res);
                        if(res.error == 1)
                        {
                           Main.errorToastr(res.msg);
                        }
                        else
                        {
                            Main.successToastr(res.msg);
                            window.location.href=base_url_main+"business_dashboard"
                        }
                    },
                    error:function(){

                    },
                    complete:function(){
                        Main.removeLoader();
                    }
                })
            }
        });

        $('.login-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.login-form').validate().form()) {
                    $('.login-form').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });

        

        $('#forget-password').click(function(){
            $('.login-form').hide();
            $('.forget-form').show();
        });

        $('#back-btn').click(function(){
            $('.login-form').show();
            $('.forget-form').hide();
        });
    },
    forgetpassword=function(){
        $('.forget-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // do not focus the last invalid input
            rules: {
                company_forget_email: {
                    required: true,
                    email:true
                }
                
            },

            messages: {
                company_forget_email: {
                    required: "Email is required."
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   

            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                if (element.attr("name") == "tnc") { // insert checkbox errors after the container                  
                    error.insertAfter($('#register_tnc_error'));
                } else if (element.closest('.input-icon').size() === 1) {
                    error.insertAfter(element.closest('.input-icon'));
                } else {
                    error.insertAfter(element);
                }
            },

            submitHandler: function(form) {
                var form_data=$('.forget-form').serialize();
                Main.appendLoader();
                $.ajax({
                    url:base_url_main+"business_forget_password",
                    data:form_data,
                    type:'POST',
                    success:function(res){
                        console.log(res);
                        if(res.error == 1)
                        {

                            Main.errorToastr(res.msg);

                        }
                        else
                        {
                            Main.successToastr(res.msg);
                            $('#company_email').val($('.forget-form input[name="company_forget_email"]').val());
                            $('.otp-form').show();
                            $('.forget-form').hide();
                        }
                    },
                    error:function(res){
                        console.log(res);
                    },
                    complete:function(){
                        Main.removeLoader();
                    }
                })
            }
        });
        $('.forget-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.forget-form').validate().form()) {
                    $('.forget-form').submit();
                }
                return false;
            }
        });
    },
    otpform=function(){
        $('.otp-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // do not focus the last invalid input
            rules: {
                otp: {
                    required: true,
                    number:true,
                },
                
                
            },

            messages: {
                otp: {
                    required: "OTP is required."
                },
                
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   

            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                if (element.attr("name") == "tnc") { // insert checkbox errors after the container                  
                    error.insertAfter($('#register_tnc_error'));
                } else if (element.closest('.input-icon').size() === 1) {
                    error.insertAfter(element.closest('.input-icon'));
                } else {
                    error.insertAfter(element);
                }
            },

            submitHandler: function(form) {
                var form_data=$('.otp-form').serialize();
                Main.appendLoader();
                $.ajax({
                    url:base_url_main+"check_otp",
                    data:form_data,
                    type:'POST',
                    success:function(res){
                        console.log(res);
                        if(res.error == 1)
                        {
                            Main.errorToastr(res.msg);
                        }
                        else
                        {
                            Main.successToastr(res.msg);
                            $('#company_email_data').val($('#company_email').val());
                            $('.reset-form').show();
                            $('.otp-form').hide();
                        }
                    },
                    error:function(res){
                        console.log(res);
                    },
                    complete:function(){
                        Main.removeLoader();
                    }
                })
            }
        });
        $('.otp-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.otp-form').validate().form()) {
                    $('.otp-form').submit();
                }
                return false;
            }
        });
    },
    resetform=function(){
        $('.reset-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // do not focus the last invalid input
            rules: {
                new_password: {
                    required: true,
                },
                cnf_password:{
                    required:true,
                    equalTo: "#new_password"
                }
                
            },

            messages: {
                new_password: {
                    required: "New password is required."
                },
                cnf_password:{
                    required:"Confirm password is required."
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   

            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            submitHandler: function(form) {
                var form_data=$('.reset-form').serialize();
                Main.appendLoader();
                $.ajax({
                    url:base_url_main+"business_reset_password",
                    data:form_data,
                    type:'POST',
                    success:function(res){
                        console.log(res);
                        if(res.error == 1)
                        {
                            
                            Main.errorToastr(res.msg);

                        }
                        else
                        {
                            Main.successToastr(res.msg);
                            setTimeout(function(){ window.location.reload(); }, 2000);
                            
                        }
                    },
                    error:function(res){
                        console.log(res);
                    },
                    complete:function(){
                        Main.removeLoader();
                    }
                })
            }
        });
        $('.reset-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.reset-form').validate().form()) {
                    $('.reset-form').submit();
                }
                return false;
            }
        });
    }

 
  

    return {
        //main function to initiate the module
        init: function() {

            handleLogin();
            forgetpassword();
            otpform();
            resetform();

            // init background slide images
            $('.login-bg').backstretch([base_url+'/assets/pages/img/login/bg1.jpg',
                base_url+'/assets/pages/img/login/bg2.jpg',
                base_url+'/assets/pages/img/login/bg3.jpg'
                ], {
                  fade: 1000,
                  duration: 8000
                }
            );

            $('.forget-form').hide();
            $('.otp-form').hide();
            $('.reset-form').hide();

        }

    };

}();

jQuery(document).ready(function() {
    Login.init();
});