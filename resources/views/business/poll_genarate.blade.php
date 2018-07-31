@extends('business.fnt_layout.body')
@push('meta')
	<meta charset="utf-8" />
    <title>Unsilome | Poll</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Design for blank page layout" name="description" />
    <meta content="" name="author" />
@endpush
@push('style')
	{!! Html::style('public/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}
	{!! Html::style('public/assets/global/plugins/datatables/datatables.min.css') !!}
    {!! Html::style('public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!}
    {!! Html::style('public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') !!}
    {!!Html::style('public/assets/global/plugins/bootstrap-toastr/toastr.min.css')!!}
    {!!Html::style('public/assets/global/plugins/bootstrap-sweetalert/sweetalert.css')!!}
@endpush
@push('script')
    <script type="text/javascript">
        var base_url_main="<?php echo url('/')?>";
        var base_url="<?php echo url('/')?>/public/";
    </script>
	{!! Html::script('public/assets/global/plugins/moment.min.js') !!}
	{!! Html::script('public/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') !!}
	{!! Html::script('public/assets/global/plugins/jquery-validation/js/jquery.validate.js') !!}
	{!! Html::script('public/assets/global/scripts/datatable.js') !!}
    {!! Html::script('public/assets/global/plugins/datatables/datatables.min.js') !!}
    {!! Html::script('public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}
    {!! Html::script('public/assets/pages/scripts/table-datatables-managed.min.js') !!}
    {!! Html::script('public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}
    {!! Html::script('public/assets/pages/scripts/components-bootstrap-switch.min.js') !!}
    {!! Html::script('public/assets/pages/custom.js')!!}
    {!!Html::script('public/assets/global/plugins/bootstrap-toastr/toastr.min.js')!!}
    {!!Html::script('public/assets/pages/scripts/ui-toastr.min.js')!!}
    {!!Html::script('public/assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js')!!}
	
	<script>

		$('.datepicker').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        });
        
        $("#moreoption").click(function(){
        	var html = '<div class="input-group margin-bottom-5">'+
                    		'<input type="text" class="form-control" name="option[]" placeholder="Option">'+
                    		'<span class="input-group-btn">'+
                                '<a class="btn red" id="removeOption"><i class="fa fa-close"></i></a>'+
                            '</span>'+
                        '</div>';
            $('#option').append(html);
        });
        $("#moreoption1").click(function(){
            var html = '<div class="input-group margin-bottom-5">'+
                            '<input type="text" class="form-control" name="option[]" placeholder="Option">'+
                            '<input type="hidden" value="0" name="option_id[]">'+
                            '<span class="input-group-btn">'+
                                '<a class="btn red removeOption" id="removeOption"><i class="fa fa-close"></i></a>'+
                            '</span>'+
                        '</div>';
            $('#option1').append(html);
        });
        $("#option").delegate('#removeOption', 'click', function(){
        	$(this).parents('.input-group').remove();
        });
        $(".updatepollform").validate({
            errorElement: 'span',
            errorClass: 'help-block help-block-error',
            focusInvalid: false,
            ignore: "",
            rules: {
                question_title: {
                    required: true
                },
                "option[]": {
                    required: true
                },
                validity: {
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
                $(".updatepollform")[0].submit();
            }
        });
        $(".pollform").validate({
	        errorElement: 'span',
	        errorClass: 'help-block help-block-error',
	        focusInvalid: false,
	        ignore: "",
	        rules: {
	            question_title: {
	                required: true
	            },
	            "option[]": {
	                required: true
	            },
	            validity: {
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
	        	$(".pollform")[0].submit();
	        }
	    });
        $('.make-switch').on('switchChange.bootstrapSwitch', function (event, state) {
            var id=$(this).attr('data-id');
            var status='N';
            if(state)
            {
                status='Y';
            }
            $.ajax({
                url:"<?php echo url('poll_status')?>",
                type:'GET',
                data:{status:status,id:id},
                beforeSend:function(){
                    Main.appendLoader();
                },
                success:function(res){
                    if(res.error)
                    {
                        Main.errorToastr(res.msg);
                    }
                    else
                    {
                        Main.successToastr(res.msg)
                    }
                },
                complete:function(){
                    Main.removeLoader();
                }
            })
        });
        $('#option').on('click','.removeOption',function(){
            $(this).parent('div').remove();
        })
        $('#option1').on('click','.removeOption',function(){
            var attr=$(this).attr('data-id');
            if(typeof attr !== typeof undefined && attr !== false)
            {
               var id=$(this).attr('data-id');
            swal({
                      title: "<?php echo Lang::get('language_business.delete_msg')?>",
                      text: '',
                      type: "warning",
                      allowOutsideClick: false,
                      showConfirmButton: true,
                      showCancelButton: true,
                      confirmButtonClass: 'btn-success',
                      cancelButtonClass: 'btn-danger',
                      closeOnConfirm: true,
                      closeOnCancel: true,
                      confirmButtonText: '<?php echo Lang::get('language_business.yes')?>',
                      cancelButtonText: '<?php echo Lang::get('language_business.cancel')?>',
                    },
                    function(isConfirm){
                        if (isConfirm){
                            $.ajax({
                                url:"<?php echo url('delete_poll_option')?>",
                                data:{id:id},
                                type:'GET',
                                beforeSend:function(){
                                    Main.appendLoader();
                                },
                                success:function(res){
                                    if(res.error)
                                    {
                                        Main.errorToastr(res.msg);
                                    }
                                    else
                                    {
                                        Main.successToastr(res.msg);
                                        $('#option_data'+id).remove();
                                    }
                                },
                                complete:function(){
                                    Main.removeLoader();
                                }
                            })
                        } else {
                            
                        }
                    }); 
            }
            else
            {
                //console.log($(this).parent('a').parent('span').parent('div'));
                $(this).parent('span').parent('div').remove();
            }
            

        })
        $('.edit').on('click',function(){
            var id=$(this).attr('data-id');
            var poll_data=JSON.parse($(this).attr('data-poll'));
            var poll_title=$(this).attr('data-poll-title');
            var validity=$(this).attr('data-validity');
            $('#poll_validity').val(validity);
            $('.insert-poll').css('display','none');
            $('.edit-poll').css('display','block');
            $('#poll_id').val(id);
            $('#poll_title').val(poll_title);
            $('#option1').html('');
            $(poll_data).each(function(i){
                var html = '<div class="input-group margin-bottom-5" id="option_data'+poll_data[i].id+'">'+
                            '<input type="text" class="form-control" name="option[]" placeholder="Option" value="'+poll_data[i].option_value+'">'+
                            '<input type="hidden" name="option_id[]" value="'+poll_data[i].id+'">'+
                            '<span class="input-group-btn">'+
                                '<a class="btn red removeOption"  data-id="'+poll_data[i].id+'"><i class="fa fa-close"></i></a>'+
                            '</span>'+
                        '</div>';
                $('#option1').append(html);
            })
        })
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
        	<div class="row">
        		<div class="col-sm-4">
		            <div class="portlet box red insert-poll">
		                <div class="portlet-title">
		                    <div class="caption">
		                        <span class="caption-subject font-white uppercase"><?php echo Lang::get('language_business.new_poll')?></span>
		                    </div>
		                    
		                </div>
		                <div class="portlet-body">
		                	{!! Form::open(array('url'=>'save_poll', 'class'=>'pollform')) !!}
		                		<div class="form-body">
		                			<div class="form-group">
		                                <label class="control-label"><?php echo Lang::get('language_business.poll_title')?></label>
		                            	<input type="text" class="form-control" name="question_title" placeholder="<?php echo Lang::get('language_business.poll_title')?>">
		                            </div>
		                            <div class="form-group" id="option">
		                                <label class="control-label"><?php echo Lang::get('language_business.poll_options')?></label>
		                                <div class="input-group margin-bottom-5">
		                            		<input type="text" class="form-control" name="option[]" placeholder="<?php echo Lang::get('language_business.poll_options')?>">
		                            		<span class="input-group-btn">
                                                <a class="btn red removeOption" id="removeOption"><i class="fa fa-close"></i></a>
                                            </span>
                                        </div>
		                            </div>
		                            <div class="form-group">
		                            	<a class="btn red" id="moreoption"><?php echo Lang::get('language_business.more_option')?></a>
		                            </div>
		                            <div class="form-group">
		                                <label class="control-label"><?php echo Lang::get('language_business.validity');?></label>
		                            	<input type="text" class="form-control datepicker" name="validity" placeholder="dd-mm-yyyy">
		                            </div><hr/>
		                            <div class="form-actions">
		                            	<button type="submit" class="btn red uppercase"><?php echo Lang::get('language_business.save');?></button>
		                            </div>
		                		</div>
		                	{!! Form::close() !!}
		                </div>
		            </div>
                    <div class="portlet box edit-poll red" style="display: none">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-white uppercase"><?php echo Lang::get('language_business.update_poll')?></span>
                            </div>
                            
                        </div>
                        <div class="portlet-body">
                            {!! Form::open(array('url'=>'updatepollform', 'class'=>'updatepollform')) !!}
                            <input type="hidden" name="poll_id" id="poll_id">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo Lang::get('language_business.poll_title')?></label>
                                        <input type="text" class="form-control" name="question_title" id="poll_title" placeholder="<?php echo Lang::get('language_business.poll_title')?>">
                                    </div>
                                    <div class="form-group" id="option1">
                                        <label class="control-label"><?php echo Lang::get('language_business.poll_options')?></label>
                                        
                                    </div>
                                    <div class="form-group">
                                        <a class="btn red" id="moreoption1"><?php echo Lang::get('language_business.more_option')?></a>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?php echo Lang::get('language_business.validity');?></label>
                                        <input type="text" class="form-control datepicker" name="validity" id="poll_validity" placeholder="dd-mm-yyyy">
                                    </div><hr/>
                                    <div class="form-actions">
                                        <button type="submit" class="btn red uppercase"><?php echo Lang::get('language_business.save');?></button>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
            	</div>
            	<div class="col-sm-8">
            		<div class="portlet box red">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-layers font-white"></i>
                                <span class="caption-subject font-white uppercase"><?php echo Lang::get('language_business.all_poll');?></span>
                            </div>
                            
                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_4">
                                <thead>
                                    <tr>
                                        <th style="width:30%;text-align: left;padding-left: 10px"> <?php echo Lang::get('language_business.poll_title');?> </th>
                                        <th> <?php echo Lang::get('language_business.poll_options');?> </th>
                                        <th style="width:20%"> <?php echo Lang::get('language_business.status');?> </th>
                                        <th style="width:8%"> <?php echo Lang::get('language_business.action')?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
                                	foreach($data['poll'] as $poll)
                                	{
                                	?>

                                    <tr class="odd gradeX">
                                        <td style="text-align: left;padding-left: 10px"> <?php echo $poll['poll_title']?> </td>
                                        <td>
                                            <?php 
                                            $poll_data=App\Http\Controllers\Business\PollController::get_option($poll['id']);
                                            $total_poll_answer=App\Http\Controllers\Business\PollController::total_poll_vote($poll['id']);
                                            $r=1;
                                            foreach($poll_data as $da)
                                            {
                                                $total_poll_answer=App\Http\Controllers\Business\PollController::poll_vote($da['id']);
                                            	echo $r .") ".$da['option_value']."<br>";
                                            	$r++;
                                            }
                                            $all_poll_data=json_encode($poll_data);
                                            ?>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="make-switch" <?php echo $poll['status'] == 'Y'?'checked':''?> data-on-text="&nbsp;<?php echo Lang::get('language_business.active')?>&nbsp;" data-off-text="&nbsp;<?php echo Lang::get('language_business.inactive')?>&nbsp;" data-id="<?php echo $poll['id']?>">
                                        	
                                            
                                        </td>
                                        <td>
                                            <a href="javascript:;" class="btn btn-icon-only red edit" data-poll-title="<?php echo $poll['poll_title']?>"  data-id="<?php echo $poll['id']?>" data-poll='<?php echo $all_poll_data?>' data-validity="<?php echo date('d-m-Y',strtotime($poll['valid_through']))?>"><i class="fa fa-edit"></i> </a>
                                        </td>
                                    </tr>
                                   <?php
                                	}
                                	?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
            	</div>
            </div>
            
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->      
@endsection