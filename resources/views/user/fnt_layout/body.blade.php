<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html>
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        @stack('meta')
       
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        {!! Html::style('public/assets/global/plugins/font-awesome/css/font-awesome.min.css') !!}
	    {!! Html::style('public/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') !!}
	    {!! Html::style('public/assets/global/plugins/bootstrap/css/bootstrap.min.css') !!}
	    {!! Html::style('public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') !!}
	     <!-- END GLOBAL MANDATORY STYLES -->
	     <!-- BEGIN PAGE LEVEL PLUGINS -->
	    {!! Html::style('public/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') !!}
	    {!! Html::style('public/assets/global/plugins/morris/morris.css') !!}
	    {!! Html::style('public/assets/global/plugins/fullcalendar/fullcalendar.min.css') !!}
	    {!! Html::style('public/assets/global/plugins/jqvmap/jqvmap/jqvmap.css') !!}
	    <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
	    {!! Html::style('public/assets/global/css/components.min.css') !!}
	    {!! Html::style('public/assets/global/css/plugins.min.css') !!}
	    <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
	    {!! Html::style('public/assets/layouts/layout4/css/layout.min.css') !!}
		{!! Html::style('public/assets/layouts/layout4/css/themes/default.min.css') !!}
		{!! Html::style('public/assets/layouts/layout4/css/custom.min.css') !!}
		<!-- END THEME LAYOUT STYLES -->
		@stack('style')
	</head>
	<body>
		@stack('header')
	 	@stack('menu')
		@yield('content')
        @stack('footer')
		<div id="scroll-top">
			<i class="fa fa-angle-up"></i>
		</div>
		 <!-- BEGIN CORE PLUGINS -->
	    {!! Html::script('public/assets/global/plugins/jquery.min.js') !!}
	    {!! Html::script('public/assets/global/plugins/bootstrap/js/bootstrap.min.js') !!}
	    {!! Html::script('public/assets/global/plugins/js.cookie.min.js') !!}
	    {!! Html::script('public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') !!}
	    {!! Html::script('public/assets/global/plugins/jquery.blockui.min.js') !!}
	    {!! Html::script('public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}
	    <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
	    {!! Html::script('public/assets/global/plugins/moment.min.js') !!}
	    {!! Html::script('public/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') !!}
	    {!! Html::script('public/assets/global/plugins/morris/morris.min.js') !!}
	    {!! Html::script('public/assets/global/plugins/morris/raphael-min.js') !!}
	    {!! Html::script('public/assets/global/plugins/counterup/jquery.waypoints.min.js') !!}
	    {!! Html::script('public/assets/global/plugins/counterup/jquery.counterup.min.js') !!}
	    {!! Html::script('public/assets/global/plugins/amcharts/amcharts/amcharts.js') !!}
	    {!! Html::script('public/assets/global/plugins/amcharts/amcharts/serial.js') !!}
	    {!! Html::script('public/assets/global/plugins/amcharts/amcharts/pie.js') !!}
	    {!! Html::script('public/assets/global/plugins/amcharts/amcharts/radar.js') !!}
	    {!! Html::script('public/assets/global/plugins/amcharts/amcharts/themes/light.js') !!}
	    {!! Html::script('public/assets/global/plugins/amcharts/amcharts/themes/patterns.js') !!}
	    {!! Html::script('public/assets/global/plugins/amcharts/amcharts/themes/chalk.js') !!}
	    {!! Html::script('public/assets/global/plugins/amcharts/ammap/ammap.js') !!}
	    <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
	    {!! Html::script('public/assets/global/scripts/app.min.js') !!}
	    <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
	    {!! Html::script('public/assets/pages/scripts/dashboard.min.js') !!}
	    <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
	    {!! Html::script('public/assets/layouts/layout4/scripts/layout.min.js') !!}
	    {!! Html::script('public/assets/layouts/layout4/scripts/demo.min.js') !!}
	    {!! Html::script('public/assets/layouts/global/scripts/quick-sidebar.min.js') !!}
	    {!! Html::script('public/assets/layouts/global/scripts/quick-nav.min.js') !!}
	    <!-- END THEME LAYOUT SCRIPTS -->
	    @stack('script')
	</body>
</html>