@extends('layouts.admin')
<!-- PLUGINS STYLES-->
 <link href="{{ asset('admintheme/vendors/summernote/dist/summernote-bs4.css') }}" rel="stylesheet" />
 <link href="{{ asset('admintheme/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
@section('content')
<div class="page-content fade-in-up">

 <div class="row">
	<div class="col-md-12">
	    <div class="ibox">
	    	@if(session()->has('success'))
               <p class="alert alert-success  text-center md_top" style="width:100%">
                  {{ session()->get('success') }}
                  <i class="fa fa-close pull-right mar-top">
               </p>
           	@endif
           	@if(session()->has('error'))
               <p class="alert alert-error  text-center md_top" style="width:100%">
                  {{ session()->get('error') }}
                  <i class="fa fa-close pull-right mar-top">
               </p>
           	@endif
	        <div class="ibox-head">
	            <div class="ibox-title">Edit Testimonial</div>
	        </div>
	        <div class="ibox-body" style="">
	            <form method="post" id="EditTestimonialForm" action="{{action('TestimonialController@update', base64_encode($id))}}" enctype="multipart/form-data">
	                @csrf
	                <input name="_method" type="hidden" value="PATCH">
	                <div class="row">
	                    <div class="col-sm-4 form-group">
	                    	<label>Full name</label> <span class="req">*</span>
	                    	{{ Form::text('fullname', $testimonial->fullname, ['placeholder' => 'Enter full name', 'class' => 'form-control required'])}}
	                    	@if ($errors->has('fullname'))
                           		<span class="invalid-feedback" style="display:block;" role="alert">
                                	<strong>{{ $errors->first('fullname') }}</strong>
                           		</span>
                    		@endif
	                    </div>
		            </div>
		            <div class="form-group">
	                    {{ Form::label(__('Image'))}}
	                    <div>
			            <label class="custom-file" id="customFile">
						        <input type="file" class="custom-file-input" name="image">
						        <span class="custom-file-control form-control-file"></span>
						</label>
						<input type="hidden" name="old_image" value="{{ $testimonial->image }}">
						@if (!empty($testimonial->image))
		               		<img class="img-circle" src="{{ config('constants.testimonial_img_path').'/thumbnail/'.$testimonial->image}}" width="40">
	                   
		                @endif
						</div>
						@if ($errors->has('image'))
	                   		<span class="invalid-feedback" style="display:block;" role="alert">
	                        	<strong>{{ $errors->first('image') }}</strong>
	                   		</span>
	            		@endif
	                   
	                </div>
	               
					<div class="form-group">
	                    <label>Description</label> <span class="req">*</span>
	                    {{ Form::textarea('description', $testimonial->description, ['placeholder' => 'Enter description', 'class' => 'form-control', 'id' => 'summernote'])}}
	                    @if ($errors->has('description'))
                       		<span class="invalid-feedback" style="display:block;" role="alert">
                            	<strong>{{ $errors->first('description') }}</strong>
                       		</span>
                		@endif
	                </div>
	                <div class="form-group">
	                	{{ Form::button('Submit', ['class' => 'btn btn-default update-testimonial'])}}
	                </div>
	            {{ Form::close() }}
	            </div>
	                 
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
<!-- PAGE LEVEL PLUGINS-->
<script src="{{ asset('admintheme/vendors/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
 
<script type="text/javascript">
$(document).ready(function(){

	$('#summernote').summernote({
		height: 150,
   	});
	$('.update-testimonial').click(function(e){
	  	var ret = validateForm('EditTestimonialForm');
	  	if(ret){
	  		$('#EditTestimonialForm').submit();
	  	}
	});
	
});
</script>
@stop
