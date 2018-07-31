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
	{!! Html::style('public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') !!}
	{!! Html::style('public/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}
	{!! Html::style('public/assets/global/plugins/bootstrap-sweetalert/sweetalert.css') !!}
@endpush
@push('script')
	{!! Html::script('public/assets/global/plugins/moment.min.js') !!}
	{!! Html::script('public/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') !!}
	{!! Html::script('public/assets/global/plugins/autosize/autosize.min.js') !!}
	{!! Html::script('public/assets/global/plugins/jquery-validation/js/jquery.validate.js') !!}
	{!! Html::script('public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') !!}
	{!! Html::script('public/assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') !!}
	
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
	    // Delete 
	    $(".masonry").delegate("#deletenews", 'click', function(){
	    	var rowid = $(this).attr('data-rowid');
	    	var sa_title = $(this).data('title');
    		var sa_confirmButtonText = $(this).data('confirm-button-text');
    		var sa_cancelButtonText = $(this).data('cancel-button-text');
    	
    		swal({
			  title: sa_title,
			  text: '',
			  type: 'warning',
			  allowOutsideClick: false,
			  showConfirmButton: true,
			  showCancelButton: true,
			  confirmButtonClass: 'green',
			  cancelButtonClass: 'red',
			  closeOnConfirm: false,
			  closeOnCancel: true,
			  confirmButtonText: sa_confirmButtonText,
			  cancelButtonText: sa_cancelButtonText,
			},
			function(isConfirm){
		        if (isConfirm){
		        	window.location.href=base_url+"/deletenews?d="+rowid
		        }
			});
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
            <div class="portlet box red">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject font-white uppercase"><?php echo Lang::get('language_business.news_post');?></span>
                    </div>
                </div>
                <div class="portlet-body">
                	{!! Form::open(array('url'=>'save_news', 'class'=>'newsform', 'files'=>true)) !!}
                		<div class="form-body">
                			<div class="form-group">
                            	<div class="fileinput fileinput-new" data-provides="fileinput">
                                	<label class="control-label"><?php echo Lang::get('language_business.photo');?></label>
                                    <div class="input-group">
                                        <div class="form-control uneditable-input " data-trigger="fileinput">
                                            <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                            <span class="fileinput-filename"> </span>
                                        </div>
                                        <span class="input-group-addon btn default btn-file">
                                            <span class="fileinput-new"> <?php echo Lang::get('language_business.file');?> </span>
                                            <span class="fileinput-exists"> <i class="fa fa-edit"></i> </span>
                                            <input type="file" name="post_photo"> </span>
                                        <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> <i class="fa fa-trash"></i> </a>
                                    </div>
                                </div>
                            </div>
                			<div class="form-group">
                                <label class="control-label"><?php echo Lang::get('language_business.news_headline');?></label>
                            	<input type="text" class="form-control" name="headline" placeholder="<?php echo Lang::get('language_business.news_headline');?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?php echo Lang::get('language_business.describe');?></label>
                                <textarea class="form-control autosizeme" name="describe" rows="5" placeholder="<?php echo Lang::get('language_business.describe');?>"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?php echo Lang::get('language_business.validity');?></label>
                                <input type="text" name="validity" class="form-control datepicker" placeholder="<?php echo Lang::get('language_business.date_format');?>">
                            </div><hr/>
                            <div class="form-actions">
                            	<button type="submit" class="btn red uppercase"><?php echo Lang::get('language_business.publish');?></button>
                            </div>
                		</div>
                	{!! Form::close() !!}
                </div>
            </div>
            
        	<div class="portlet box red">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject font-white uppercase"><?php echo Lang::get('language_business.news_post_list');?></span>
                    </div>
                </div>
                <div class="portlet-body">
    				<div class="masonry masonry-columns-3">
    				@foreach($data['news'] as $news)
    					<div class="masonry-item">
    					@if($news['filename'] != "")
						    <div class="media">
						      <img src="{{asset($news['filepath'].'/'.$news['filename'])}}" class="img-responsive center-block" alt="photo">
						    </div>
						@endif
						    <h2 class="post-title"><?php echo stripslashes($news['headline']);?></h2>
						    <h6 class="post-info"><?php echo date('F-d Y', strtotime($news['news_date']))?> : Posted by Admin</h6>
						    <p><?php echo str_limit(stripslashes($news['description']), $limit = 150, $end = '...');?></p>
						    <a href="{{url('newsread?s='.Crypt::encrypt($news['id']))}}" class="font-red">Read More</a>
						    <div class="tag-comment">
						    	<span class="pull-left">
						    		<a class="btn red btn-outline btn-sm"><i class="fa fa-pencil"></i></a>
						    		<a class="btn red btn-outline btn-sm" id="deletenews" data-rowid="<?php echo Crypt::encrypt($news['id']);?>" data-title="<?php echo Lang::get('language_business.delete_msg');?>" data-cancel-button-text="<?php echo Lang::get('language_business.cancel');?>" data-confirm-button-text="<?php echo Lang::get('language_business.delete_msg');?>"><i class="fa fa-trash"></i></a>
						    	</span>
						      	<span class="pull-right"><i class="fa fa-comments"></i> no comments</span>
						    </div>
						</div>
					@endforeach
    				</div>
                </div>
            </div>
            
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->      
@endsection