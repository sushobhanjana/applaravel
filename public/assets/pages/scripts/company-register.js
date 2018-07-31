var Login = function() {

    var handleLogin = function() {
        $('.register-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {

                name:{
                    required:true
                },
                surname:{
                    required:true
                },
                organization:{
                    required:true
                },
                company_url:{
                    required:true
                },
                email: {
                    required: true,
                    email:true
                },
                password: {
                    required: true
                },
                cnf_password:{
                    required:true,
                    equalTo: "#password"
                }
            },

            messages: { // custom messages for radio buttons and checkboxes
                tnc: {
                    required: "Please accept TNC first."
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
                var action=$('.register-form').attr('action');
                var form_data=$('.register-form').serialize();
                Main.appendLoader();
                $.ajax({
                    url:action,
                    data:form_data,
                    dataType:'json',
                    type:'POST',
                    success:function(res){
                        if(res.error == 1)
                        {
                           Main.errorToastr(res.msg);
                        }
                        else
                        {
                            Main.successToastr(res.msg);
                            $('.register-form')[0].reset();
                            $('#url').html('');
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
    }

 
  

    return {
        //main function to initiate the module
        init: function() {

            handleLogin();

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

        },
        other:function(){
            $('input[name="email"]').on('change',function(){
                var email=$(this).val();
                var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
                if(!pattern.test(email))
                {

                    Main.errorToastr("Email is not valid");
                    $('input[name=email]').val(''); 
                }
                else
                {
                Main.appendLoader();
                $.ajax({
                    url:base_url+"check_business_email",
                    data:{email:email},
                    post:'GET',
                    dataType:'json',
                    success:function(res){
                        console.log(res)
                        if(res.total == 1)
                        {
                           $('input[name=email]').val(''); 
                           Main.errorToastr(res.msg);
                        }
                        else
                        {
                            Main.successToastr(res.msg);
                        }
                    },
                    error:function(){

                    },
                    complete:function(){
                        Main.removeLoader();
                    }
                })
                }
            })

        }

    };

}();

jQuery(document).ready(function() {
    Login.init();
    Login.other();
});