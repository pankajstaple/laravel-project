@extends('layouts.admin')
@section('content')
<div class="page-content fade-in-up">
    <div class="ibox">
        @include('elements.printerror')
        <div class="ibox-head">
            <div class="ibox-title">Activities List</div>
        </div>
        <div class="ibox-body">
           
            {!! Form::open(['method'=>'get']) !!}
            <div class="row">

       
                <div class="col-sm-9 form-group">
                    <div class="input-group flex-md-nowrap flex-wrap">
                        <div class="input-group">
                            <input class="form-control" id="search"
                               value="{{ request('search') }}"
                               placeholder="Search name or email" name="search"
                               type="text" id="search"/>
                        </div>
                         &nbsp;&nbsp;
                        <div class="input-group date" id="start-date">
                            <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                            {{ Form::text('start_date', (isset($_GET['start_date']) && !empty($_GET['start_date']))?$_GET['start_date']:null, ['placeholder' => 'start date', 'class' => 'form-control', 'autocomplete' => 'off'])}}
                        </div>
                        &nbsp;&nbsp;
                        <div class="input-group date" id="end-date">
                            <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                            {{ Form::text('end_date', (isset($_GET['end_date']) && !empty($_GET['end_date']))?$_GET['end_date']:null, ['placeholder' => 'end date', 'class' => 'form-control', 'autocomplete' => 'off'])}}
                        </div>
                        &nbsp;&nbsp;
                        <!--<div class="input-group date mb-md-0 mb-4" id="payment-status">

                            {{ Form::select('status', config('constants.payment_status'), isset($_GET['status'])?$_GET['status']:"" ,['class' => 'form-control', 'placeholder' => '--select status--'])}}
                        </div>-->
                        <div class="input-group-btn ml-0 ml-md-2">
                            <button type="submit" class="btn btn-warning"
                            >
                                Search
                            </button>
                        </div>
                        &nbsp;&nbsp;
                        <div class="input-group-btn">
                           <a class="btn btn-info reset-link" href="{{ action('LogActivityController@index')}}">
                              Reset
                            </a>

                        </div>
                    </div>
                </div>
                <!--<div class="col-sm-3 text-md-right text-left mb-3 mb-md-0">
                    <button type="submit" name="submit_btn" value="Export" class="btn btn-info m-r-5">
                                    <span class="active-hidden"><i class="fa fa-download"></i> Export to csv</span>
                                    
                                </button>
                    
                </div>-->
                <input type="hidden" value="{{request('field')}}" name="field"/>
                <input type="hidden" value="{{request('sort')}}" name="sort"/>
            </div>
            {!! Form::close() !!}
            <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="users-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>@sortablelink('description', "Description")</th>
                        <th>@sortablelink('url', "Page URL")</th>
                        <th>@sortablelink('ip', "IP")</th>
                        <th>@sortablelink('first_name', "User")</th>
                        <th>@sortablelink('type', "User Type")</th>
                        <th>@sortablelink('agent', "Agent")</th>
                        <th>@sortablelink('created_at', "Created Date")</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($log_activities) > 0)
                    <?php $i = 1; ?>
                	@foreach($log_activities as $log)
                	<tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $log->description }}</td>
                        <td>{{ $log->url }}</td>
                        <td>{{ $log->ip }}</td>
                        <td>{{ $log->first_name." ".$log->last_name }}</td>
                        <td>{{ $log->usertype }}</td>
                        <td>{{ $log->agent }}</td>
                        <td>{{ (!empty($log->log_created)?\Carbon\Carbon::parse($log->log_created)->format('m/d/Y H:i:s'):"")}}</td>
                        
                    </tr>
                  
                	@endforeach
                    @else
                        <tr><td colspan="8">No record to display.</td></tr>
                    @endif
                    
                </tbody>
            </table>
            </div>
            {{ $log_activities->appends($_GET)->links() }}
        </div>

    </div>
</div>

@endsection
@section('scripts')
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.min.css') }}">
<script src="{{ asset('js/jquery-ui.min.js') }}" type="text/javascript"></script>

<link href="{{ asset('admintheme/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" />
<link href="{{ asset('admintheme/vendors/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" />
<script src="{{ asset('admintheme/vendors/moment/min/moment.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('admintheme/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('admintheme/vendors/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
      $('#start-date').datepicker({
            format: 'mm/dd/yyyy',
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        }).on('changeDate', function (selected) {
           var endDate = new Date(selected.date.valueOf());
           $('#end-date').datepicker('setStartDate', endDate);
        });
      $('#end-date').datepicker({
            format: 'mm/dd/yyyy',
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

});
</script>
@stop
