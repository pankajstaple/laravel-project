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
	            <div class="ibox-title">Add New Blog</div>
	        </div>
	        <div class="ibox-body" style="">
	        	<form class="form-vertical" action="{{route('blogs.store')}}" method="post" role="form"
                  id="AddBlogForm" enctype="multipart/form-data">
                {{csrf_field()}}
	           
	            	<div class="form-group">
	                    <label>Title</label> <span class="req">*</span>
	                    {{ Form::text('title', null, ['placeholder' => 'Enter Title', 'class' => 'form-control required'])}}
	                    @if ($errors->has('title'))
                       		<span class="invalid-feedback" style="display:block;" role="alert">
                            	<strong>{{ $errors->first('title') }}</strong>
                       		</span>
                		@endif
	                </div>
	                <div class="form-group">
	                    <label>Summary</label>
	                    {{ Form::text('summary', null, ['placeholder' => 'Enter Summary', 'class' => 'form-control'])}}
	                    @if ($errors->has('summary'))
                       		<span class="invalid-feedback" style="display:block;" role="alert">
                            	<strong>{{ $errors->first('summary') }}</strong>
                       		</span>
                		@endif
	                </div>
	               

	                 <div class="form-group">
	                    <label>Seo Description</label>
	                    {{ Form::text('seo_desc', null, ['placeholder' => '', 'class' => 'form-control'])}}
	                   <!--  @if ($errors->has('summary'))
                       		<span class="invalid-feedback" style="display:block;" role="alert">
                            	<strong>{{ $errors->first('summary') }}</strong>
                       		</span>
                		@endif -->
	                </div>

	                 <div class="form-group">
	                    <label>Seo Keywords</label>
	                    {{ Form::text('seo', null, ['placeholder' => 'Add Mutiple tag use comma like tag1,tag2', 'class' => 'form-control'])}}
	                   <!--  @if ($errors->has('summary'))
                       		<span class="invalid-feedback" style="display:block;" role="alert">
                            	<strong>{{ $errors->first('summary') }}</strong>
                       		</span>
                		@endif -->
	                </div>
	                <div class="row">
	                    <div class="col-sm-6 form-group">
		                    <label>Category</label>
		                    <select class="form-control category-id" name="category_id">
		                    	<option value="0">---Select category---</option>
		                    @foreach($categories as $cat)
		                    	<option value="{{ $cat['id']}}">{{ $cat['name']}}</option>
		                    @endforeach;
		                    </select>
		                  
		                </div>
	                	<div class="col-sm-6 form-group">
	                      	<label>Is published</label>
	                    	{{ Form::select('is_published', ['1' => 'Yes', '0' => 'No'], null ,['class' => 'form-control'])}}
	               		</div>
	                </div>
	   
	                

	                <div class="form-group">
	                    <label>Blog Image</label>
	                    <div>
			            <label class="custom-file" id="customFile">
						        <input type="file" class="custom-file-input" name="blog_image">
						        <span class="custom-file-control form-control-file"></span>
						</label>
						</div>
						@if ($errors->has('blog_image'))
	                   		<span class="invalid-feedback" style="display:block;" role="alert">
	                        	<strong>{{ $errors->first('blog_image') }}</strong>
	                   		</span>
	            		@endif
	                    
	                </div>
	               
	                 <div class="form-group">
	                    <label>Content</label>
	                    {{ Form::textarea('content', null, ['placeholder' => 'Enter content', 'class' => 'form-control', 'id' => 'summernote'])}}
	                    @if ($errors->has('content'))
                       		<span class="invalid-feedback" style="display:block;" role="alert">
                            	<strong>{{ $errors->first('content') }}</strong>
                       		</span>
                		@endif
	                </div>
	               
	                <div class="form-group">
	                	{{ Form::button('Submit', ['class' => 'btn btn-default add-blog'])}}
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
	 	 // toolbar: [
    //     ['style', ['bold', 'italic', 'underline']],
    //     ['fontsize', ['fontsize']],
    //     ['color', ['color']],
    //     ['para', ['ul', 'ol', 'paragraph']],
    //     ["table", ["table"]],
    //     ["insert", ["link", "picture", "video"]],
    //     ["view", ["fullscreen", "codeview", "help"]]
    // ],
		height: 150,
		fontSizes: ['1','2', '3', '4','5','6','7','8','9','10','11','12','13','14','15','16','17']
    });
    $('.note-popover').css({
        'display': 'none'
    });
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
	   
	  $('.add-blog').click(function(e){
	  	var ret = validateForm('AddBlogForm');
	  	if(ret){
	  		$('#AddBlogForm').submit();
	  	}
	  });

	 
});
</script>
@stop