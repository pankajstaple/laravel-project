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
	            <div class="ibox-title">Edit Page</div>
	        </div>
	        <div class="ibox-body" style="">
	            	 <form method="post" id="EditPageForm" action="{{action('PagesController@update', base64_encode($id))}}" enctype="multipart/form-data">
	                @csrf
	                <input name="_method" type="hidden" value="PATCH">
	                
	            	<div class="form-group">
	                    <label>Title</label> <span class="req">*</span>
	                    {{ Form::text('title', $page->title, ['placeholder' => 'Enter Title', 'class' => 'form-control required'])}}
	                    @if ($errors->has('title'))
                       		<span class="invalid-feedback" style="display:block;" role="alert">
                            	<strong>{{ $errors->first('title') }}</strong>
                       		</span>
                		@endif
	                </div>
	                
	                 <div class="form-group">
	                    <label>Content</label>
	                    {{ Form::textarea('content', $page->content, ['placeholder' => 'Enter content', 'class' => 'form-control', 'id' => 'summernote'])}}
	                    @if ($errors->has('content'))
                       		<span class="invalid-feedback" style="display:block;" role="alert">
                            	<strong>{{ $errors->first('content') }}</strong>
                       		</span>
                		@endif
	                </div>
	               
	                <div class="form-group">
	                	{{ Form::button('Submit', ['class' => 'btn btn-default edit-page'])}}
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

	   
	  $('.edit-page').click(function(e){
	  	var ret = validateForm('EditPageForm');
	  	if(ret){
	  		$('#EditPageForm').submit();
	  	}
	  });

});
</script>
@stop