@extends('layouts.admin')
@section('content')
<div class="page-content fade-in-up">

 <div class="row">
	<div class="col-md-12">
	    <div class="ibox">
	    	@include('elements.printerror')
	        <div class="ibox-head">
	            <div class="ibox-title">Add New Challenge</div>
	        </div>
	        <div class="ibox-body" style="">
	            {{ Form::open(array('url' => 'admin/challenge', 'id' => 'AddChallengeForm', 'files'=>true)) }}
	                
	            	<div class="form-group">
	                    {{ Form::label(__('messages.title'))}} <span class="req">*</span>
	                    {{ Form::text('title', null, ['placeholder' => 'Enter Title', 'class' => 'form-control required'])}}
	                    @if ($errors->has('title'))
                       		<span class="invalid-feedback" style="display:block;" role="alert">
                            	<strong>{{ $errors->first('title') }}</strong>
                       		</span>
                		@endif
	                </div>
	                <div class="form-group">
	                    {{ Form::label(__('messages.tagline'))}}
	                    {{ Form::text('tagline', null, ['placeholder' => 'Enter tagline', 'class' => 'form-control'])}}
	                    @if ($errors->has('tagline'))
                       		<span class="invalid-feedback" style="display:block;" role="alert">
                            	<strong>{{ $errors->first('tagline') }}</strong>
                       		</span>
                		@endif
	                </div>


	            	<div class="form-group">
	                    {{ Form::label(__('messages.description'))}}
	                    {{ Form::textarea('description', null, ['placeholder' => 'Enter Description', 'class' => 'form-control', 'rows' => '4'])}}
	                    @if ($errors->has('description'))
                       		<span class="invalid-feedback" style="display:block;" role="alert">
                            	<strong>{{ $errors->first('description') }}</strong>
                       		</span>
                		@endif
	                </div>
	                <div class="row">
	                    <div class="col-sm-6 form-group">
		                    {{ Form::label(__('messages.challenge_type'))}}
		                    <select class="form-control challenge-type" name="challenge_type_id">
		                    	<option>---Select challenge group---</option>
		                    @foreach($challenge_types as $type)
		                    	<option data-amt="{{$type['amount']}}" data-days="{{$type['days']}}" value="{{ $type['id']}}">{{ $type['title']}}</option>
		                    @endforeach;
		                    </select>
		                  
		                </div>
	                	<div class="col-sm-6 form-group">
	                      	{{ Form::label(__('messages.status'))}}
	                    	{{ Form::select('status', config('constants.status'), null ,['class' => 'form-control'])}}
	               		</div>
	                </div>
	                <div class="row">
	                    <div class="col-sm-6 form-group" id="date_1">
	                    	{{ Form::label(__('messages.start_date'))}} <span class="req">*</span>
	                    	<div class="input-group date">
                                <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                            	{{ Form::text('start_date', null, ['placeholder' => 'mm/dd/yyyy', 'class' => 'form-control required start-date', 'autocomplete' => 'off'])}}
	                    	</div>
	                    	@if ($errors->has('start_date'))
                           		<span class="invalid-feedback" style="display:block;" role="alert">
                                	<strong>{{ $errors->first('start_date') }}</strong>
                           		</span>
                    		@endif
	                    </div>
	                    <div class="col-sm-6 form-group" id="date_2">
	                    	{{ Form::label(__('messages.end_date'))}} <span class="req">*</span>
	                    	<div class="input-group date">
                                <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                            	{{ Form::text('end_date', null, ['placeholder' => 'mm/dd/yyyy', 'class' => 'form-control required end-date', 'autocomplete' => 'off'])}}
	                    	</div>
	                    	@if ($errors->has('end_date'))
                           		<span class="invalid-feedback" style="display:block;" role="alert">
                                	<strong>{{ $errors->first('end_date') }}</strong>
                           		</span>
                    		@endif
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="col-sm-6 form-group">
	                    	{{ Form::label(__('messages.amount'))}} <span class="req">*</span>
	                    	{{ Form::text('amount', null, ['placeholder' => 'Enter amount', 'class' => 'form-control required amount'])}}
	                    	@if ($errors->has('amount'))
                           		<span class="invalid-feedback" style="display:block;" role="alert">
                                	<strong>{{ $errors->first('amount') }}</strong>
                           		</span>
                    		@endif
	                    </div>
	                    <div class="col-sm-6 form-group" id="date_3">
	                    	{{ Form::label(__('messages.bet_close_date'))}} <span class="req">*</span>
	                    	<div class="input-group date">
                                <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                            	{{ Form::text('bet_close_date', null, ['placeholder' => 'mm/dd/yyyy', 'class' => 'form-control required', 'autocomplete' => 'off'])}}
	                    	</div>
	                    	@if ($errors->has('bet_close_date'))
                           		<span class="invalid-feedback" style="display:block;" role="alert">
                                	<strong>{{ $errors->first('bet_close_date') }}</strong>
                           		</span>
                    		@endif

	                    </div>
	                </div>
	                

	                <div class="form-group">
	                    {{ Form::label(__('messages.challenge_image'))}}
	                    <div>
			            <label class="custom-file" id="customFile">
						        <input type="file" class="custom-file-input" name="challenge_image">
						        <span class="custom-file-control form-control-file"></span>
						</label>
						</div>
						@if ($errors->has('challenge_image'))
	                   		<span class="invalid-feedback" style="display:block;" role="alert">
	                        	<strong>{{ $errors->first('challenge_image') }}</strong>
	                   		</span>
	            		@endif
	                    
	                </div>
	               
	                <div class="form-group">
	                	{{ Form::button('Submit', ['class' => 'btn btn-default add-challenge'])}}
	                </div>
	            {{ Form::close() }}
	        </div>
	    </div>
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
	  $('#date_1 .input-group.date').datepicker({
	  		format: 'mm/dd/yyyy',
	        keyboardNavigation: false,
	        forceParse: false,
	        calendarWeeks: true,
	        autoclose: true
	    }).on('changeDate', function (selected, endDateVal) {
		    var startDate = new Date(selected.date.valueOf());
		    var days = $('.challenge-type').find('option:selected').attr('data-days');
		    if(days > 0){
		    	var endDateVal = new Date(selected.date);
		    	days = parseInt(days);
		    	endDateVal.setDate(endDateVal.getDate()+days);
		    	
		    	var dd = endDateVal.getDate();
			    var mm = endDateVal.getMonth() + 1;
			    var y = endDateVal.getFullYear();
			    if(dd < 10){
			    	dd = "0"+dd;
			    }
			    if(mm < 10){
			    	mm = "0"+mm;
			    }
			    var someFormattedDate = mm + '/' + dd + '/' + y;
		    	$('.end-date').val(someFormattedDate);
			}
			
		    $('#date_2 .input-group.date').datepicker('setStartDate', startDate);
		    $('#date_3 .input-group.date').datepicker('setStartDate', startDate);
		});
	   $('#date_2 .input-group.date').datepicker({
	  		format: 'mm/dd/yyyy',
	        keyboardNavigation: false,
	        forceParse: false,
	        calendarWeeks: true,
	        autoclose: true
	    }).on('changeDate', function (selected) {
		   var endDate = new Date(selected.date.valueOf());
		   $('#date_1 .input-group.date').datepicker('setEndDate', endDate);
		});
	   $('#date_3 .input-group.date').datepicker({
	  		format: 'mm/dd/yyyy',
	        keyboardNavigation: false,
	        forceParse: false,
	        calendarWeeks: true,
	        autoclose: true
	    });
	   
	  $('.add-challenge').click(function(e){
	  	var ret = validateForm('AddChallengeForm');
	  	if(ret){
	  		$('#AddChallengeForm').submit();
	  	}
	  });

	  $('.challenge-type').on('change', function(e){
	  	var amt = $(this).find('option:selected').attr('data-amt');
	  	var days = $(this).find('option:selected').attr('data-days');
	  	var end_date = $('.end-date').val();
	  	if((amt > 0) && ($('.amount').val() == '')){
	  		$('.amount').val(amt);
	  	}
	  	if((days > 0) && (end_date == '')){
		  	var endDateVal = $('#date_1 .input-group.date').datepicker("getDate");
		  	if(endDateVal){
			  	days = parseInt(days);
		    	endDateVal.setDate(endDateVal.getDate()+days);
		    	
		    	var dd = endDateVal.getDate();
			    var mm = endDateVal.getMonth() + 1;
			    var y = endDateVal.getFullYear();
			    if(dd < 10){
			    	dd = "0"+dd;
			    }
			    if(mm < 10){
			    	mm = "0"+mm;
			    }
			    var someFormattedDate = mm + '/' + dd + '/' + y;
		    	$('.end-date').val(someFormattedDate);
		    }
	  	}

	  });
});
</script>
@stop