@extends('admin.fnt_layout.body')
@push('meta')
    <meta charset="utf-8" />
    <title>Unsilome | Dashboard</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Design for blank page layout" name="description" />
    <meta content="" name="author" />
@endpush
@push('style')
    {!! Html::style('public/assets/global/plugins/fullcalendar/fullcalendar.min.css') !!}
@endpush
@push('script')
    {!! Html::script('public/assets/global/plugins/moment.min.js') !!}
    {!! Html::script('public/assets/global/plugins/fullcalendar/fullcalendar.min.js') !!}
    {!! Html::script('public/assets/global/plugins/jquery-ui/jquery-ui.min.js') !!}
    {!! Html::script('public/assets/apps/scripts/calendar.js') !!}

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
@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            
            <div class="portlet box red calendar">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject font-white uppercase">{{date('d')}}<br/>{{date('F')}}</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <!-- BEGIN DRAGGABLE EVENTS PORTLET-->
                            <h3 class="event-form-title margin-bottom-20">Draggable Events</h3>
                            <div id="external-events">
                                <form class="inline-form">
                                    <input type="text" value="" class="form-control" placeholder="Event Title..." id="event_title" />
                                    <br/>
                                    <a href="javascript:;" id="event_add" class="btn green"> Add Event </a>
                                </form>
                                <hr/>
                                <div id="event_box" class="margin-bottom-10"></div>
                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline" for="drop-remove"> remove after drop
                                    <input type="checkbox" class="group-checkable" id="drop-remove" />
                                    <span></span>
                                </label>
                                <hr class="visible-xs" /> </div>
                            <!-- END DRAGGABLE EVENTS PORTLET-->
                        </div>
                        <div class="col-md-9 col-sm-12">
                            <div id="calendar" class="has-toolbar"> </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-4">
                    <div class="portlet box red">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-white uppercase">Polls</span>
                            </div>
                            <div class="actions">
                                <a href="{{url('new_poll')}}" class="btn btn-circle btn-outline btn-default"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->      
@endsection

     