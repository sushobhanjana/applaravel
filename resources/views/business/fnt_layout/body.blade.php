<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html>
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        @stack('meta')
       <link rel="shortcut icon" href="{{asset('public/assets/pages/img/login/fevicon.png')}}" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css" />
        {!! Html::style('public/assets/global/plugins/font-awesome/css/font-awesome.min.css') !!}
	    {!! Html::style('public/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') !!}
	    {!! Html::style('public/assets/global/plugins/bootstrap/css/bootstrap.min.css') !!}
	    {!! Html::style('public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') !!}
	     <!-- END GLOBAL MANDATORY STYLES -->
		{!! Html::style('public/assets/global/plugins/bootstrap-toastr/toastr.min.css') !!}
		<!-- BEGIN PAGE LEVEL PLUGINS -->
	     @stack('style')
	     <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
	    {!! Html::style('public/assets/global/css/components.css') !!}
	    {!! Html::style('public/assets/global/css/plugins.min.css') !!}
	    <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
	    {!! Html::style('public/assets/layouts/layout/css/layout.css') !!}
		{!! Html::style('public/assets/layouts/layout/css/themes/darkblue.css') !!}
		{!! Html::style('public/assets/layouts/layout/css/custom.css') !!}
		<!-- END THEME LAYOUT STYLES -->
		<script>
			var base_url = "{{url('')}}";
		</script>
	</head>
	<body class="page-header-fixed page-content-white">
		<div class="page-wrapper">
			@stack('header')
			<!-- BEGIN CONTAINER -->
            <div class="page-container">
			 	@stack('menu')
				@yield('content')
			</div>
	        @stack('footer')
		</div>
		
		<!-- BEGIN CORE PLUGINS -->
	    {!! Html::script('public/assets/global/plugins/jquery.min.js') !!}
	    {!! Html::script('public/assets/global/plugins/bootstrap/js/bootstrap.min.js') !!}
	    {!! Html::script('public/assets/global/plugins/js.cookie.min.js') !!}
	    {!! Html::script('public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') !!}
	    {!! Html::script('public/assets/global/plugins/jquery.blockui.min.js') !!}
	    {!! Html::script('public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}
	    <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
	    {!! Html::script('public/assets/global/scripts/app.js') !!}
	    <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
	    {!! Html::script('public/assets/pages/scripts/ui-toastr.min.js') !!}
	    <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
	    {!! Html::script('public/assets/layouts/layout/scripts/layout.min.js') !!}
	    {!! Html::script('public/assets/layouts/layout/scripts/demo.min.js') !!}
	    {!! Html::script('public/assets/layouts/global/scripts/quick-sidebar.min.js') !!}
	    {!! Html::script('public/assets/layouts/global/scripts/quick-nav.min.js') !!}
	    <!-- END THEME LAYOUT SCRIPTS -->
	    @stack('script')
	    
	    @if(isset($data['mnuactive']))
	    <script>
			$("#<?php echo $data['mnuactive'];?>").addClass('active');
		</script>
		@endif
		
		@if (session()->has('success'))
		<script>
			Command: toastr['success']("<?php echo session('success');?>", "")

			toastr.options = {
			  "closeButton": true,
			  "debug": false,
			  "positionClass": "toast-top-right",
			  "onclick": null,
			  "showDuration": "1000",
			  "hideDuration": "1000",
			  "timeOut": "5000",
			  "extendedTimeOut": "1000",
			  "showEasing": "swing",
			  "hideEasing": "linear",
			  "showMethod": "fadeIn",
			  "hideMethod": "fadeOut"
			}
		</script>
		@endif
		
		@if (session()->has('error'))
		<script>
			Command: toastr['error']("<?php echo session('error');?>", "")

			toastr.options = {
			  "closeButton": true,
			  "debug": false,
			  "positionClass": "toast-top-right",
			  "onclick": null,
			  "showDuration": "1000",
			  "hideDuration": "1000",
			  "timeOut": "5000",
			  "extendedTimeOut": "1000",
			  "showEasing": "swing",
			  "hideEasing": "linear",
			  "showMethod": "fadeIn",
			  "hideMethod": "fadeOut"
			}
		</script>
		@endif
	</body>
</html>