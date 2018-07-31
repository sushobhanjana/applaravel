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
{!! Html::style('public/assets/global/plugins/datatables/datatables.min.css') !!}
{!! Html::style('public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!}
@endpush

@push('script')
    {!! Html::script('public/assets/global/plugins/moment.min.js') !!}
    {!! Html::script('public/assets/global/plugins/jquery-ui/jquery-ui.min.js') !!}
    {!! Html::script('public/assets/global/scripts/datatable.js') !!}
    {!! Html::script('public/assets/global/plugins/datatables/datatables.min.js') !!}
    {!! Html::script('public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}
    {!! Html::script('public/assets/pages/scripts/table-datatables-managed.min.js') !!}
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
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject bold uppercase"> Business Table</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                <thead>
                                    <tr>
                                        <th> Name </th>
                                        <th> Organization </th>
                                        <th> Email </th>
                                        <th> Status </th>
                                        <th> Contact </th>
                                        <th> Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @if(sizeof($data['get_company'])>0)
                                    @foreach($data['get_company'] as $company)  
                                    <tr class="odd gradeX">
                                        <td> {{$company['name']}} </td>
                                        <td> {{$company['organization']}}<br>
                                             <?php echo ($company['access_type'] == 1) ? "<span class='label label-sm label-success'> Individual </span>" : "<span class='label label-sm label-error'> Company </span>" ;
                                             ?>   
                                        </td>
                                        <td>
                                            <a href="mailto:{{$company['email']}}"> {{$company['email']}} </a>
                                        </td>
                                        <td>
                                           <?php echo ($company['status'] == 1) ? "<span class='label label-sm label-success'> Active </span>" : "<span class='label label-sm label-error'> Deactive </span>" ;?>  
                                        </td>
                                        <td class="center"> {{$company['find_us']}} </td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu pull-left" role="menu">
                                                    <li>
                                            <a href="{{url('admin_widgetaccess')}}/{{base64_encode($company['id'])}}">
                                                            <i class="icon-tag"></i> Set Widgets </a>
                                                    </li>
                                                    <!-- <li class="divider"> </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="icon-flag"></i> Comments
                                                            <span class="badge badge-success">4</span>
                                                        </a>
                                                    </li> -->
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                  @endif    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->      
@endsection

     