@extends('layouts.admin')
@section('content')
<div class="page-content fade-in-up">
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-success color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">{{$new_users}}</h2>
                    <div class="m-b-5">NEW USERS</div><i class="ti-user widget-stat-icon"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-info color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">{{$membership_users}}</h2>
                    <div class="m-b-5">MEMBERSHIP USERS</div><i class="ti-bar-chart widget-stat-icon"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-warning color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">${{$total_income}}</h2>
                    <div class="m-b-5">TOTAL INCOME</div><i class="fa fa-money widget-stat-icon"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-danger color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">{{$total_users}}</h2>
                    <div class="m-b-5">TOTAL USERS</div><i class="ti-user widget-stat-icon"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="ibox">
                <div class="ibox-body">
                    <div class="flexbox mb-4">
                        <div>
                            <h3 class="m-0">Payment Statistics</h3>
                            <div>Your shop sales analytics</div>
                        </div>
                        <div class="d-inline-flex">
                            <div class="px-3">
                                <div class="text-muted">WEEKLY INCOME</div>
                                <div>
                                    <span class="h2 m-0">${{$total_week_payment}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <canvas id="bar_chart" style="height:260px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">USER Statistics</div>
                </div>
                <div class="ibox-body">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <canvas id="doughnut_chart" style="height:160px;"></canvas>
                        </div>
                       <div class="col-md-6">
                            <div class="m-b-20" style="color:rgb(255, 99, 132);"><i class="fa fa-circle-o m-r-10"></i>Desktop {{round($desktop_percent)}}%</div>
                            <div class="m-b-20" style="color:rgb(54, 162, 235);"><i class="fa fa-circle-o m-r-10"></i>Mobile {{round($mobile_percent, 2)}}%</div>
                            
                                          </div>
                    </div>
                    <ul class="list-group list-group-divider list-group-full">
                        @foreach($user_browser as $browser_name => $percent)
                        <li class="list-group-item">{{$browser_name}}
                            <span class="float-right text-success">{{number_format($percent, 2)}}%</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Visitors Statistics</div>
                </div>
                <div class="ibox-body">
                    <div id="world-map" style="height: 300px;"></div>
                    <table class="table table-striped m-t-20 visitors-table">
                        <thead>
                            <tr>
                                <th>Country</th>
                                <th>Visits</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <img class="m-r-10" src="{{ asset('admintheme/img/flags/us.png') }}" />USA</td>
                                <td>755</td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" role="progressbar" style="width:52%; height:5px;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="progress-parcent">52%</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img class="m-r-10" src="{{ asset('admintheme/img/flags/Canada.png') }}" />Canada</td>
                                <td>700</td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" style="width:48%; height:5px;" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="progress-parcent">48%</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img class="m-r-10" src="{{ asset('admintheme/img/flags/India.png') }}" />India</td>
                                <td>410</td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" style="width:37%; height:5px;" aria-valuenow="37" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="progress-parcent">37%</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img class="m-r-10" src="{{ asset('admintheme/img/flags/Australia.png') }}" />Australia</td>
                                <td>304</td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-info" role="progressbar" style="width:36%; height:5px;" aria-valuenow="36" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="progress-parcent">36%</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img class="m-r-10" src="{{ asset('admintheme/img/flags/Singapore.png') }}" />Singapore</td>
                                <td>203</td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar" role="progressbar" style="width:35%; height:5px;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="progress-parcent">35%</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img class="m-r-10" src="{{ asset('admintheme/img/flags/uk.png') }}" />UK</td>
                                <td>202</td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-info" role="progressbar" style="width:35%; height:5px;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="progress-parcent">35%</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img class="m-r-10" src="{{ asset('admintheme/img/flags/UAE.png') }}" />UAE</td>
                                <td>180</td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" style="width:30%; height:5px;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="progress-parcent">30%</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <!--<div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Tasks</div>
                    <div>
                        <a class="btn btn-info btn-sm" href="javascript:;">New Task</a>
                    </div>
                </div>
                <div class="ibox-body">
                    <ul class="list-group list-group-divider list-group-full tasks-list">
                        <li class="list-group-item task-item">
                            <div>
                                <label class="ui-checkbox ui-checkbox-gray ui-checkbox-success">
                                    <input type="checkbox">
                                    <span class="input-span"></span>
                                    <span class="task-title">Meeting with Eliza</span>
                                </label>
                            </div>
                            <div class="task-data"><small class="text-muted">10 July 2018</small></div>
                            <div class="task-actions">
                                <a href="javascript:;"><i class="fa fa-edit text-muted m-r-10"></i></a>
                                <a href="javascript:;"><i class="fa fa-trash text-muted"></i></a>
                            </div>
                        </li>
                        <li class="list-group-item task-item">
                            <div>
                                <label class="ui-checkbox ui-checkbox-gray ui-checkbox-success">
                                    <input type="checkbox" checked="">
                                    <span class="input-span"></span>
                                    <span class="task-title">Check your inbox</span>
                                </label>
                            </div>
                            <div class="task-data"><small class="text-muted">22 May 2018</small></div>
                            <div class="task-actions">
                                <a href="javascript:;"><i class="fa fa-edit text-muted m-r-10"></i></a>
                                <a href="javascript:;"><i class="fa fa-trash text-muted"></i></a>
                            </div>
                        </li>
                        <li class="list-group-item task-item">
                            <div>
                                <label class="ui-checkbox ui-checkbox-gray ui-checkbox-success">
                                    <input type="checkbox">
                                    <span class="input-span"></span>
                                    <span class="task-title">Create Financial Report</span>
                                </label>
                                <span class="badge badge-danger m-l-5"><i class="ti-alarm-clock"></i> 1 hrs</span>
                            </div>
                            <div class="task-data"><small class="text-muted">No due date</small></div>
                            <div class="task-actions">
                                <a href="javascript:;"><i class="fa fa-edit text-muted m-r-10"></i></a>
                                <a href="javascript:;"><i class="fa fa-trash text-muted"></i></a>
                            </div>
                        </li>
                        <li class="list-group-item task-item">
                            <div>
                                <label class="ui-checkbox ui-checkbox-gray ui-checkbox-success">
                                    <input type="checkbox" checked="">
                                    <span class="input-span"></span>
                                    <span class="task-title">Send message to Mick</span>
                                </label>
                            </div>
                            <div class="task-data"><small class="text-muted">04 Apr 2018</small></div>
                            <div class="task-actions">
                                <a href="javascript:;"><i class="fa fa-edit text-muted m-r-10"></i></a>
                                <a href="javascript:;"><i class="fa fa-trash text-muted"></i></a>
                            </div>
                        </li>
                        <li class="list-group-item task-item">
                            <div>
                                <label class="ui-checkbox ui-checkbox-gray ui-checkbox-success">
                                    <input type="checkbox">
                                    <span class="input-span"></span>
                                    <span class="task-title">Create new page</span>
                                </label>
                                <span class="badge badge-success m-l-5">2 Days</span>
                            </div>
                            <div class="task-data"><small class="text-muted">07 Dec 2018</small></div>
                            <div class="task-actions">
                                <a href="javascript:;"><i class="fa fa-edit text-muted m-r-10"></i></a>
                                <a href="javascript:;"><i class="fa fa-trash text-muted"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>-->
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Messages</div>
                </div>
                <div class="ibox-body">
                    <ul class="media-list media-list-divider m-0">
                        @foreach($contact_queries as $query)
                        <li class="media">
                            <div class="media-body">
                                <div class="media-heading">{{$query->name}} <small class="float-right text-muted">{{Carbon\Carbon::parse($query->created_at)->diffForHumans()}}</small></div>
                                <div class="font-13">{{str_limit($query->message, 100, '...')}}</div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="ibox-footer text-center">
                    <a href="{{route('all_messages')}}">View All Messages</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Latest Payments</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                       
                    </div>
                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Invoice ID</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th width="91px">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $status_class = config('constants.status_box');?>
                            @foreach($latest_payments as $payment)
                            <tr>
                                <td>
                                   <a href="{{route('invoice', base64_encode($payment->payId))}}">{{$payment->invoice_no}}</a>
                                </td>
                                <td>{{ $payment->first_name." ".$payment->last_name }}</td>
                                <td>${{ $payment->paid_amount }}</td>
                                <td>
                                    <span class="badge {{$status_class[$payment->status]}}">{{ $payment->status }}</span>
                                </td>
                                <td>{{ (!empty($payment->payment_created)?\Carbon\Carbon::parse($payment->payment_created)->format('m/d/Y'):"")}}</td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Top 5 visitors</div>
                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Visit Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($top_visitors as $log)
                            <tr>
                                <td>
                                   <a href="{{route('users.show', base64_encode($log->user_id))}}">{{ $log->first_name." ".$log->last_name }}</a>
                                </td>
                                <td>{{ $log->visit_count }}</td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <style>
        .visitors-table tbody tr td:last-child {
            display: flex;
            align-items: center;
        }

        .visitors-table .progress {
            flex: 1;
        }

        .visitors-table .progress-parcent {
            text-align: right;
            margin-left: 10px;
        }
    </style>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
 var data = {
            labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            datasets: [{
                label: "Income",
                borderColor: 'rgba(52,152,219,1)',
                backgroundColor: 'rgba(52,152,219,1)',
                pointBackgroundColor: 'rgba(52,152,219,1)',
                data: <?php echo json_encode($lastweek_payments);?>
            }]
        },
        options = {
            responsive: !0,
            maintainAspectRatio: !1
        };
var ctx = document.getElementById("bar_chart").getContext('2d');
var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: options
});

var desktop_percent = <?php echo $desktop_percent?>;
var mobile_percent = <?php echo $mobile_percent?>;
var doughnutData = {
      labels: ["Desktop","Mobile" ],
      datasets: [{
          data: [desktop_percent,mobile_percent],
          backgroundColor: ["rgb(255, 99, 132)","rgb(54, 162, 235)"]
      }]
  } ;


  var doughnutOptions = {
      responsive: true,
      legend: {
        display: false
      },
  };


  var ctx4 = document.getElementById("doughnut_chart").getContext("2d");
  new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});



  $('#world-map').vectorMap({
    map: 'world_mill_en',
    backgroundColor: 'transparent',
    regionStyle: {
        initial: {
            fill: '#DADDE0',
        }
    },
    showTooltip: true,
    onRegionTipShowx: function(e, el, code){
        el.html(el.html()+' (Visits - '+mapData[code]+')');
    },
    markerStyle: {
      initial: {
        fill  : '#3498db',
        stroke: '#333'
      }
    },
    markers: [
      {
        latLng: [1.3, 103.8],
        name: 'Singapore : 203'
      },
      {
        latLng: [38, -105],
        name: 'USA : 755',
      },
      {
        latLng: [58, -115],
        name: 'Canada : 700',
      },
      {
        latLng: [-25, 140],
        name: 'Australia : 304',
      },
      {
        latLng: [55.00, -3.50],
        name: 'UK : 202',
      },
      {
        latLng: [21, 78],
        name: 'India : 410',
      },
      {
        latLng: [25.00, 54.00],
        name: 'UAE : 180',
      }
    ]
  });

</script>
<?php /*<script src="{{ asset('admintheme/js/scripts/dashboard_1_demo.js') }}" type="text/javascript"></script>*/?>
@stop