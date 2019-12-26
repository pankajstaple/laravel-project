@extends('layouts.admin')
 <!-- PLUGINS STYLES-->
 <link href="{{ asset('admintheme/vendors/summernote/dist/summernote-bs4.css') }}" rel="stylesheet" />
@section('content')
<div class="page-content fade-in-up">

 <div class="row">
	<div class="col-md-12">
	    <div class="ibox">
	    	@include('elements.printerror')
	        <div class="ibox-head">
	            <div class="ibox-title">Add New Faq</div>
	        </div>
	        <div class="ibox-body" style="">
	        	@if(isset($faq->id))
	        	<form class="form-vertical" action="{{URL('/admin/pages/updatefaq/'.base64_encode($faq->id))}}" method="post" role="form"
                  id="AddFaqForm" enctype="multipart/form-data">
                  @method('PATCH')
                @else
                      	<form class="form-vertical" action="{{URL('/admin/pages/addfaq')}}" method="post" role="form"
                  id="AddFaqForm" enctype="multipart/form-data">
                  @method('PUT')
      			@endif
                {{csrf_field()}}
	           			
	            	<div class="form-group">
	                    <label>Question</label> <span class="req">*</span>
	                    {{ Form::text('question', isset($faq->question)?$faq->question:"", ['placeholder' => 'Enter question', 'class' => 'form-control required'])}}
	                    @if ($errors->has('question'))
                       		<span class="invalid-feedback" style="display:block;" role="alert">
                            	<strong>{{ $errors->first('question') }}</strong>
                       		</span>
                		@endif
	                </div>
	                <div class="form-group">
	                    <label>Answer</label>
	                    {{ Form::textarea('answer', isset($faq->answer)?$faq->answer:"", ['placeholder' => 'Enter answer', 'class' => 'form-control', 'id' => 'summernote'])}}
	                    @if ($errors->has('answer'))
                       		<span class="invalid-feedback" style="display:block;" role="alert">
                            	<strong>{{ $errors->first('answer') }}</strong>
                       		</span>
                		@endif
	                </div>
	               
	                <div class="form-group">
	                	{{ Form::button('Submit', ['class' => 'btn btn-default add-faq'])}}
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
<!-- PAGE LEVEL PLUGINS-->
<script src="{{ asset('admintheme/vendors/summernote/dist/summernote-bs4.js') }}" type="text/javascript"></script>



<script type="text/javascript">
$(document).ready(function(){
	 $('#summernote').summernote({
        height: 150,
    });
    $('.note-popover').css({
        'display': 'none'
    });
	 
	   
	  $('.add-faq').click(function(e){
	  	var ret = validateForm('AddFaqForm');
	  	if(ret){
	  		$('#AddFaqForm').submit();
	  	}
	  });

	 
});
</script>
@stop