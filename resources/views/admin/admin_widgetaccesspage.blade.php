@extends('admin.fnt_layout.body')
@push('meta')
    <meta charset="utf-8" />
    <title>Unsilome | Widgets</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Design for blank page layout" name="description" />
    <meta content="" name="author" />
@endpush
@push('style')
    {!! Html::style('public/assets/global/plugins/jquery-nestable/jquery.nestable.css') !!}
@endpush
@push('script')
    {!! Html::script('public/assets/global/plugins/moment.min.js') !!}
    {!! Html::script('public/assets/global/plugins/jquery-ui/jquery-ui.min.js') !!}
    {!! Html::script('public/assets/global/plugins/jquery-nestable/jquery.nestable.js') !!}
    {{--!! Html::script('public/assets/pages/scripts/ui-nestable.min.js') !!--}}
@endpush
@push('header')
    @include('admin.fnt_layout.header')
@endpush
@push('menu')
    @include('admin.fnt_layout.menu')
@endpush

@push('footer')
    @include('admin.fnt_layout.footer')
@endpush
@push('script')
<script>
    var b_id = {{$data['get_id']}};
    var action = $("#action").val();
    var UINestable = function () {

    var updateOutput = function (e) {
        var list = e.length ? e : $(e.target),
            output = list.data('output');
         console.log(output);   
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };

    return {
        //main function to initiate the module
        init: function () {    
            // activate Nestable for list 1
            $('#nestable_list_1').nestable({
                 group: 0,
                 maxDepth: 1,
                 dropCallback: function(details) {
                    //alert(b_id);
                    var st="delete";
                    $.ajax({
                        type:"post",
                        url:action,
                        data:{"wid":details.sourceId,"bid":b_id,"st":st},
                        success:function(result){
                            console.log(result);
                        },
                        error:function(result){
                            console.log(result);
                        },
                    }) 
                  }
            })
                .on('change', updateOutput);

            // activate Nestable for list 2
            $('#nestable_list_2').nestable({
                 group: 0,
                 maxDepth: 1,
                 dropCallback: function(details) {
                    alert();
                    $.ajax({
                        type:"post",
                        url:action,
                        data:{"wid":details.sourceId,"bid":b_id},
                        success:function(result){
                            console.log(result);
                        },
                        error:function(result){
                            console.log(result);
                        },
                    })    

                  }
            })
                .on('change', updateOutput);

            // output initial serialised data
            updateOutput($('#nestable_list_1').data('output', $('#nestable_list_1_output')));
            updateOutput($('#nestable_list_2').data('output', $('#nestable_list_2_output')));

            $('#nestable_list_menu').on('click', function (e) {
                var target = $(e.target),
                    action = target.data('action');
                if (action === 'expand-all') {
                    $('.dd').nestable('expandAll');
                }
                if (action === 'collapse-all') {
                    $('.dd').nestable('collapseAll');
                }
            });

            $('#nestable_list_3').nestable();

        }

    };

}();

jQuery(document).ready(function() {    
   UINestable.init();
});
</script>
@endpush
@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <h3>{{$data['business_details'][0]['name']}}</h3>
            <input type="hidden" id="action" value="{{url('admin_widgetaccess')}}">

            @if(sizeof($data['user_widget_list'])>0)
                <div class="row">
                            <div class="col-md-6">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-bubble font-green"></i>
                                            <span class="caption-subject font-green sbold uppercase">Reserved Widgets</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body ">
                                        <div class="dd" id="nestable_list_1">
                                            <ol class="dd-list">
                                                @foreach($data['user_widget_list'] as $uwidget)
                                                <li class="dd-item" data-id="{{$uwidget['fk_widget_id']}}">
                                                    <div class="dd-handle">
                                                    {{$uwidget['widget_name']}}
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-bubble font-red"></i>
                                            <span class="caption-subject font-red sbold uppercase">Available Widgets</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="dd" id="nestable_list_2">
                                         @if(sizeof($data['company_available_widget'])>0)       
                                                <ol class="dd-list">
                                            @foreach($data['company_available_widget'] as $awidget)
                                                <li class="dd-item" data-id="{{$awidget['id']}}">
                                                        <div class="dd-handle"> {{$awidget['widget_name']}} </div>
                                                </li>
                                            @endforeach
                                                </ol>
                                            @else
                                            <div class="dd-empty"></div>    
                                         @endif       
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            @else
                <div class="row">
                            <div class="col-md-6">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-bubble font-green"></i>
                                            <span class="caption-subject font-green sbold uppercase">Reserved Widgets</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body ">
                                        <div class="dd" id="nestable_list_1">
                                            <div class="dd-empty"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-bubble font-red"></i>
                                            <span class="caption-subject font-red sbold uppercase">Available Widgets</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="dd" id="nestable_list_2">
                                            <ol class="dd-list">
                                                @if(sizeof($data['widget_list'])>0)
                                                @foreach($data['widget_list'] as $widget)
                                                <li class="dd-item" data-id="{{$widget['id']}}">
                                                    <div class="dd-handle"> {{$widget['widget_name']}} </div>
                                                </li>
                                                @endforeach
                                                @endif
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            @endif            
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->      
@endsection

     