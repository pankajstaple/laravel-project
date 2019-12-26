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
	            <div class="ibox-title">Edit- HOW IT WORK Tab Content</div>
	        </div>
	        <div class="ibox-body" style="">
	            	 <form method="post" id="EditPageForm" action="{{route('admin_how-it-works')}}" enctype="multipart/form-data">
	                @csrf
	                
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
<script src="{{ asset('js/summernote-image-attributes.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/popover.js') }}" type="text/javascript"></script>



<script type="text/javascript">
$(document).ready(function(){
	 $('#summernote').summernote({
        height: 150,
        imageAttributes:{
            imageDialogLayout:'default', // default|horizontal
            icon:'<i class="note-icon-pencil"/>',
            removeEmpty:false // true = remove attributes | false = leave empty if present
        },
        displayFields:{
            imageBasic:true,  // show/hide Title, Source, Alt fields
            imageExtra:true, // show/hide Alt, Class, Style, Role fields
            linkBasic:true,   // show/hide URL and Target fields for link
            linkExtra:true   // show/hide Class, Rel, Role fields for link
        }
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