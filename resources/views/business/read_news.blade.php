@extends('business.fnt_layout.body')
@push('meta')
	<meta charset="utf-8" />
    <title>Unsilome | News</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Design for blank page layout" name="description" />
    <meta content="" name="author" />
@endpush
@push('style')
	{!! Html::style('public/assets/pages/css/blog.css') !!}
	{!! Html::style('public/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}
@endpush
@push('script')
	{!! Html::script('public/assets/global/plugins/moment.min.js') !!}
	{!! Html::script('public/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') !!}
	{!! Html::script('public/assets/global/plugins/autosize/autosize.min.js') !!}
	{!! Html::script('public/assets/global/plugins/jquery-validation/js/jquery.validate.js') !!}
	{!! Html::script('public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') !!}
	
	<script>
		$('.datepicker').datepicker({
            format: "dd-mm-yyyy",
            startDate : new Date(),
            autoclose: true
        });
        
        $(".newsform").validate({
	        errorElement: 'span',
	        errorClass: 'help-block help-block-error',
	        focusInvalid: false,
	        ignore: "",
	        rules: {
	            headline: {
	                required: true
	            },
	            describe: {
	                required: true
	            }
	        },

	        /*invalidHandler: function (event, validator) {       
	            success1.hide();
	            error1.show();
	            App.scrollTo(error1, -200);
	        },*/

	        errorPlacement: function (error, element) { // render error placement for each input type
	            var cont = $(element).parent('.input-group');
	            if (cont) {
	                cont.after(error);
	            } else {
	                element.after(error);
	            }
	        },

	        highlight: function (element) { // hightlight error inputs

	            $(element)
	                .closest('.form-group').addClass('has-error'); // set error class to the control group
	        },

	        unhighlight: function (element) { // revert the change done by hightlight
	            $(element)
	                .closest('.form-group').removeClass('has-error'); // set error class to the control group
	        },

	        success: function (label) {
	            label
	                .closest('.form-group').removeClass('has-error'); // set success class to the control group
	        },

	        submitHandler: function (form) {
	        	$(".newsform")[0].submit();
	        }
	    });
	</script>
@endpush
@push('header')
	@include('business.fnt_layout.header')
@endpush
@push('menu')
	@include('business.fnt_layout.menu')
@endpush

@push('footer')
	@include('business.fnt_layout.footer')
@endpush
@section('content')
	<!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <div class="blog-page blog-content-1">
                <div class="blog-post-lg bordered blog-container">
                @if($data['news'][0]['filename'] != "")
                    <div class="blog-img-thumb">
                        <a href="javascript:;">
                            <img src="{{asset($data['news'][0]['filepath'].$data['news'][0]['filename'])}}">
                        </a>
                    </div>
                @endif
                    <div class="blog-post-content">
                        <h2 class="blog-title blog-post-title">
                            <?php echo stripslashes($data['news'][0]['headline']);?>
                        </h2>
                        <p class="blog-post-desc"> <?php echo stripslashes($data['news'][0]['description']);?> </p>
                        <div class="blog-post-foot padding-bottom-15">
                        	<div class="pull-left">
                        		<a class="btn green btn-outline">0 <i class="fa fa-thumbs-o-up"></i></a>
                        		<a class="btn red btn-outline">0 <i class="fa fa-thumbs-o-down"></i></a>
                        	</div>
                            <div class="blog-post-meta">
                                <i class="icon-calendar font-red"></i>
                                <?php echo date('M-d Y', strtotime($data['news'][0]['news_date']));?>
                            </div>
                            <div class="blog-post-meta">
                                <i class="icon-bubble font-red"></i>
                                14 Comments
                            </div>
                        </div><hr/>
                        <div class="blog-content-2">
                        	<div class="blog-single-content padding-none">
		                        <div class="blog-comments">
		                            <h3 class="sbold blog-comments-title">Comments(14)</h3>
		                            <div class="c-comment-list">
		                                <div class="media">
		                                    <div class="media-left">
		                                        <a href="#">
		                                            <img class="media-object" alt="" src="public/assets/pages/img/avatars/team1.jpg"> </a>
		                                    </div>
		                                    <div class="media-body">
		                                        <h4 class="media-heading">
		                                            <a href="#">Sean</a> on
		                                            <span class="c-date">23 May 2015, 10:40AM</span>
		                                        </h4> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. </div>
		                                </div>
		                                <div class="media">
		                                    <div class="media-left">
		                                        <a href="#">
		                                            <img class="media-object" alt="" src="public/assets/pages/img/avatars/team3.jpg"> </a>
		                                    </div>
		                                    <div class="media-body">
		                                        <h4 class="media-heading">
		                                            <a href="#">Strong Strong</a> on
		                                            <span class="c-date">21 May 2015, 11:40AM</span>
		                                        </h4> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
		                                        <div class="media">
		                                            <div class="media-left">
		                                                <a href="#">
		                                                    <img class="media-object" alt="" src="public/assets/pages/img/avatars/team4.jpg"> </a>
		                                            </div>
		                                            <div class="media-body">
		                                                <h4 class="media-heading">
		                                                    <a href="#">Emma Stone</a> on
		                                                    <span class="c-date">30 May 2015, 9:40PM</span>
		                                                </h4> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. </div>
		                                        </div>
		                                    </div>
		                                </div>
		                                <div class="media">
		                                    <div class="media-left">
		                                        <a href="#">
		                                            <img class="media-object" alt="" src="public/assets/pages/img/avatars/team7.jpg"> </a>
		                                    </div>
		                                    <div class="media-body">
		                                        <h4 class="media-heading">
		                                            <a href="#">Nick Nilson</a> on
		                                            <span class="c-date">30 May 2015, 9:40PM</span>
		                                        </h4> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. </div>
		                                </div>
		                            </div>
		                        </div>
                        	</div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->      
@endsection