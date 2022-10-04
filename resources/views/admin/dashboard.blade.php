@extends('layouts.master')

@section('content')
    <div class="row widget-row">

        <div class="col-md-3">
            <!-- BEGIN WIDGET THUMB -->
            <a href="{{url('admin/users')}}">
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                <h4 class="widget-thumb-heading">Total Users</h4>

                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-green icon-users"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-body-stat count" data-counter="counterup">{{$users}}</span>
                        </div>
                    </div>


            </div>
            </a>
            <!-- END WIDGET THUMB -->
        </div>
        <div class="col-md-3">
            <!-- BEGIN WIDGET THUMB -->
            <a href="{{url('admin/item')}}">
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                <h4 class="widget-thumb-heading">Total Items</h4>

                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-red icon-layers"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-body-stat count" data-counter="counterup">{{$items}}</span>
                    </div>
                </div>

            </div>
            </a>
            <!-- END WIDGET THUMB -->
        </div>
        <div class="col-md-3">
            <!-- BEGIN WIDGET THUMB -->
            <a href="{{url('admin/department')}}">
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                <h4 class="widget-thumb-heading">Departments</h4>

                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-purple icon-screen-desktop"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-body-stat count">{{$department}}</span>
                    </div>
                </div>

            </div>
            </a>
            <!-- END WIDGET THUMB -->
        </div>
        <div class="col-md-3">
            <a href="{{url('admin/service-category')}}">
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                <h4 class="widget-thumb-heading">Services</h4>

                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-blue icon-bar-chart"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-body-stat count">{{$categories}}</span>
                    </div>
                </div>

            </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{url('admin/report/download-history')}}">
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                <h4 class="widget-thumb-heading">Downloads</h4>

                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-purple icon-cloud-download"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-body-stat count">{{$downloads}}</span>
                    </div>
                </div>

            </div>
            </a>
        </div>
        <div class="col-md-3">
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                <h4 class="widget-thumb-heading">Views</h4>
                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-yellow fa fa-eye"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-body-stat count">{{$views}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <a href="{{url('admin/sister-concern')}}">
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                <h4 class="widget-thumb-heading">Concern</h4>

                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-green icon-bar-chart"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-body-stat count">{{$concern}}</span>
                    </div>
                </div>

            </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{url('admin/issue-tracking')}}">
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                    <h4 class="widget-thumb-heading">Number of Issue Tracking</h4>

                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-green icon-note"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-body-stat count">{{$issueTracking}}</span>
                        </div>
                    </div>

                </div>
            </a>
        </div>
    </div>
        <div class="row widget-row">
        <div class="col-md-3">
            <!-- BEGIN WIDGET THUMB -->
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                    <h4 class="widget-thumb-heading">Current Month Total Users</h4>
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-green icon-users"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-body-stat count" data-counter="counterup">{{$current_months_user}}</span>
                        </div>
                    </div>
                </div>
            <!-- END WIDGET THUMB -->
        </div>
        <div class="col-md-3">
                            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                    <h4 class="widget-thumb-heading">Current Month Total Downloads</h4>

                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-purple icon-cloud-download"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-body-stat count">{{$current_months_download}}</span>
                        </div>
                    </div>

                </div>
                    </div>
    </div>

    <div class="clear"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{url('/')}}">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Dashboard</span>
                    </li>
                </ul>
            </div>
            <div class="col-md-12">
                <div id="chartdiv"></div>
            </div>
            <div class="col-md-12">
                <div id="department"></div>
                </div>
            </div>
        </div>

    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h4>Today Upload</h4>
                    <div class="table-responsive">
                        <table class="table table-borderless file-upload">
                            <thead>
                            <tr>
                                <th>Sl.No</th>
                                <th>Name</th>
                                <th>Count</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($itemToday as $key => $user)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$user->displayName}}</td>
                                    <td>{{$user->item_count}}</td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-md-offset-2">
            <div class="card">
                <div class="card-body">
                    <h4>Total Upload</h4>
                    <div class="table-responsive">
                        <table class="table table-borderless file-upload">
                            <thead>
                            <tr>
                                <th>Sl.No</th>
                                <th>Name</th>
                                <th>Count</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($itemUsers as $key => $user)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$user->displayName}}</td>
                                    <td>{{$user->item_count}}</td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-5 ">
            <div class="card">
                <div class="card-body">
                    <h4>Current Month Upload</h4>
                    <div class="table-responsive">
                        <table class="table table-borderless file-upload">
                            <thead>
                            <tr>
                                <th>Sl.No</th>
                                <th>Name</th>
                                <th>Count</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($itemCurrentMonth as $key => $user)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$user->displayName}}</td>
                                    <td>{{$user->item_count}}</td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5 col-md-offset-2">
            <div class="card">
                <div class="card-body">
                    <h4>Previous Month Upload</h4>
                    <div class="table-responsive">
                        <table class="table table-borderless file-upload">
                            <thead>
                            <tr>
                                <th>Sl.No</th>
                                <th>Name</th>
                                <th>Count</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($itemPreviousMonth as $key => $user)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$user->displayName}}</td>
                                    <td>{{$user->item_count}}</td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
    
    
       <div class="row">
        <div class="col-md-5 ">
            <div class="card">
                <div class="card-body">
                    <h4>Month wise User Registration</h4>
                    <div class="table-responsive">
                        <table class="table table-borderless file-upload">
                            <thead>
                            <tr>
                                <th>Month</th>
                                <th>Total Users</th>
                            
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($monty_wise_users as $key => $user)
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>{{$monty_wise_users[$key]->count()}}</td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5 col-md-offset-2">
            <div class="card">
                <div class="card-body">
                    <h4>Month wise Book Downloads</h4>
                    <div class="table-responsive">
                        <table class="table table-borderless file-upload">
                            <thead>
                            <tr>
                                
                                <th>Month</th>
                                <th>Per Month Downloads</th>
                                <th>Total Download</th>
                            </tr>
                            
                            </thead>
                            <tbody>
                                     @php
                                        $total_download = 0;
                                     @endphp


 @foreach($month_wise_downloads as $key => $download)
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>{{$month_wise_downloads[$key]->count()}}</td>
                                    
                                    @php
                                        $total_download +=$month_wise_downloads[$key]->count();
                                     @endphp
                                     <td>{{$total_download}}</td>
                                </tr>
                                
                            @endforeach
                 

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    



@endsection
@push('style_plugins')
    <link rel="stylesheet" href="{{url('assets/admin/amcharts_3.21.13/amcharts/plugins/export/export.css')}}"
          type="text/css" media="all"/>
    <style>
        #chartdiv {
            width: 100%;
            height: 500px;
            font-size: 11px;
        }

        #department {
            width: 100%;
            height: 500px;
            font-size: 11px;
        }

    </style>

@endpush


@push('styles')
    <link rel="stylesheet" type="text/css" href="{{url('assets/datatable/css/material.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/datatable/css/dataTables.material.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/datatable/css/buttons.dataTables.min.css')}}"/>
     <style>
        .dataTables_filter{text-align: left!important}
    </style>
@endpush

@push('scripts_plugins')
    <script src="{{url('assets/admin/amcharts_3.21.13/amcharts/amcharts.js')}}"></script>
    <script src="{{url('assets/admin/amcharts_3.21.13/amcharts/pie.js')}}"></script>
    <script src="{{url('assets/admin/amcharts_3.21.13/amcharts/serial.js')}}"></script>
    <script src="{{url('assets/admin/amcharts_3.21.13/amcharts/plugins/export/export.min.js')}}"></script>
    <script src="{{url('assets/admin/amcharts_3.21.13/amcharts/themes/light.js')}}"></script>
@endpush
@push('scripts')
    <script type="text/javascript" src="{{url('assets/datatable/js/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/datatable/js/dataTables.material.min.js')}}"></script>


    <script type="text/javascript" src="{{url('assets/datatable/js/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/datatable/js/dataTables.material.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/datatable/js/buttons.flash.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/datatable/js/jszip.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/datatable/js/pdfmake.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/datatable/js/vfs_fonts.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/datatable/js/buttons.html5.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/datatable/js/buttons.print.min.js')}}"></script>


    <script>
        $(document).ready(function() {
            $('.file-upload').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf'
                ]
            } );
        } );

        var visitor = <?php echo $visitor; ?>;
        var departments = <?php echo $departments; ?>;


        var chart = AmCharts.makeChart("chartdiv", {

            "type": "pie",
            "startDuration": 0,
            "theme": "light",
            "titles": [{
                "text": "Item Download Statistics",
                "size": 16
            }],
            "addClassNames": true,
            "legend": {
                "position": "right",
                "marginRight": 100,
                "autoMargins": false
            },
            "innerRadius": "30%",
            "defs": {
                "filter": [{
                    "id": "shadow",
                    "width": "200%",
                    "height": "200%",
                    "feOffset": {
                        "result": "offOut",
                        "in": "SourceAlpha",
                        "dx": 0,
                        "dy": 0
                    },
                    "feGaussianBlur": {
                        "result": "blurOut",
                        "in": "offOut",
                        "stdDeviation": 5
                    },
                    "feBlend": {
                        "in": "SourceGraphic",
                        "in2": "blurOut",
                        "mode": "normal"
                    }
                }]
            },

            "dataProvider": visitor,
            "valueField": "counts",
            "titleField": "service",
            "startEffect": "elastic",
            "startDuration": 2,
            "labelRadius": 15,
            "innerRadius": "50%",
            "depth3D": 10,
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
            "angle": 15,
            "export": {
                "enabled": true
            }
        });


        var department = AmCharts.makeChart("department", {
            "theme": "light",
            "type": "serial",
            "startDuration": 2,
            "titles": [{
                "text": "Department Item Upload Statistics",
                "size": 16
            }],
            "dataProvider": departments,
            "valueAxes": [{
                "position": "left",
                "axisAlpha": 0,
                "gridAlpha": 0
            }],
            "graphs": [{
                "balloonText": "[[category]]: <br> <b>[[value]]</b>",
                "colorField": "color",
                "fillAlphas": 0.85,
                "lineAlpha": 0.1,
                "type": "column",
                "topRadius": 1.3,
                "valueField": "counts",
                "labelText": "[[value]]"
            }],
            "depth3D": 40,
            "angle": 30,
            "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "departmentName",
            "categoryAxis": {
                "gridPosition": "start",
                "labelRotation": 90

            },
            "export": {
                "enabled": true,
                "title": "Export chart to JPG",
            }

        }, 0);
        //counting
        $('.count').each(function () {
            $(this).prop('Counter', 0).animate({
                Counter: $(this).text()
            }, {
                duration: 4000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });
    </script>
@endpush