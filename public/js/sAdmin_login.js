var Login = function() {

    var handleLogin = function() {

        $('.login-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {            	
                email: {
                    required: true
                },
                password: {
                    required: true
                }                
            },
            messages: {            	
                email: {
                    required: "Email is required.",
                    email:true
                },
                password: {
                    required: "Password is required."
                }
            },
            invalidHandler: function(event, validator) { //display error alert on form submit   
                $('.alert-danger', $('.login-form')).show();
            },

            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            
            unhighlight: function(element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },
            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },
            submitHandler: function(form) {
            	Main.appendLoader();
            	var form_data=$('.login-form').serialize();
            	var action=$('.login-form').attr('action');
            	$.ajax({
            		url:action,
            		data:form_data,
            		type:'POST',
            		dataType:'json',
            		success:function(res){
						if(res.error == 0)
						{
							toastr.success(res.msg, success, {
					            "timeOut": "3000",
					            "extendedTImeout": "0"
					        });
					        //window.location.href=base_url+"/company_dashboard";
						}
						else
						{
							toastr.error(res.msg, error, {
					            "timeOut": "3000",
					            "extendedTImeout": "0"
					        });
						}
					},
					error:function(){
						
					},
					complete:function()
					{
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

        $('.forget-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.forget-form').validate().form()) {
                    $('.forget-form').submit();
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
      
        
    };
    //Forget password validation
    var forgetpassword= function(){
		$('.forget-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                email: {
                    required: true
                }
                
                
            },

            messages: {
                email: {
                    required: "Email is required.",
                    email:true
                },
                
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   
               
            },

            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            
            unhighlight: function(element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            submitHandler: function(form) {
            	Main.appendLoader();
            	var email=$('.forget-form').serialize();
            	var action=$('.forget-form').attr('action');
            	$.ajax({
            		url:action,
            		data:email,
            		type:'POST',
            		dataType:'json',
            		success:function(res){
						console.log(res);
						if(res.error == 1)
						{
							toastr.error(res.msg, error, {
					            "timeOut": "3000",
					            "extendedTImeout": "0"
					        });
					       $('.company_forget_email').val('');
						}
						else
						{
							$('input[name="company_id"]').val(res.company_id);
							$('.forget-form').hide();
							$('.otp-form').show();
						}
					},
					error:function(){
						
					},
					complete:function()
					{
						Main.removeLoader();
					}
            	})
            	return false;
            	
            }
        });
	}
/*OTP form validation*/
var otp= function(){
		$('.otp-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                otp: {
                    required: true,
                    number:true
                }
                
                
            },

            messages: {
                otp: {
                    required: "OTP is required.",
                },
                
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   
               
            },

            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            
            unhighlight: function(element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            submitHandler: function(form) {
            	Main.appendLoader();
            	var action=$('.otp-form').attr('action');
            	var form_data=$('.otp-form').serialize();
            	$.ajax({
            		url:action,
            		data:form_data,
            		type:'POST',
            		dataType:'json',
            		success:function(res){
						if(res.error == 1)
						{
							toastr.error(res.msg, error, {
					            "timeOut": "3000",
					            "extendedTImeout": "0"
					        });
						}
						else
						{
							$('input[name="company_id_password"]').val(res.company_id);
							$('.forget-form').hide();
							$('.otp-form').hide();
							$('.change-password-form').show();
						}
					},
					error:function(){
						
					},
					complete:function(){
						Main.removeLoader();
					}
            	})
            	return false;
            	
            }
        });
	}
 /*
 Change password
 */
 var changepassword= function(){
		$('.change-password-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                new_password: {
                    required: true,
                },
                confirm_password:{
					required:true,
					equalTo:'#new_password'
				}
                
                
            },

            messages: {
                new_password: {
                    required: "New password is required.",
                },
                confirm_password: {
                    required: "Confirm password is required.",
                },
                
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   
               
            },

            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            
            unhighlight: function(element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            submitHandler: function(form) {
            	Main.appendLoader();
            	var action=$('.change-password-form').attr('action');
            	var form_data=$('.change-password-form').serialize();
            	$.ajax({
            		url:action,
            		data:form_data,
            		type:'POST',
            		dataType:'json',
            		success:function(res){
            			console.log(res);
						if(res.error == 1)
						{
							toastr.error(res.msg, error, {
					            "timeOut": "3000",
					            "extendedTImeout": "0"
					        });
						}
						else
						{
							toastr.success(res.msg, success, {
					            "timeOut": "3000",
					            "extendedTImeout": "0"
					        });
					        window.location.reload();
						}
					},
					error:function(){
						
					},
					complete:function(){
						Main.removeLoader();
					}
            	})
            	return false;
            	
            }
        });
	}
  

    return {
        //main function to initiate the module
        init: function() {

            handleLogin();
            forgetpassword();
            otp();
            changepassword();

            // init background slide images
            $('.login-bg').backstretch([
                "public/assets/pages/img/login/bg1.jpg",
                "public/assets/pages/img/login/bg2.jpg",
                "public/assets/pages/img/login/bg3.jpg"
                ], {
                  fade: 1000,
                  duration: 8000
                }
            );

            $('.forget-form').hide();
            $('.otp-form').hide();
			$('.change-password-form').hide();
        }

    };

}();

jQuery(document).ready(function() {
    Login.init();
});