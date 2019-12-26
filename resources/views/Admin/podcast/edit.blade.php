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
	            <div class="ibox-title">Edit Podcast episode</div>
	        </div>
	        <div class="ibox-body" style="">
	            	 <form method="post" id="EditPodcastForm" action="{{action('PodcastController@update', base64_encode($id))}}" enctype="multipart/form-data">
	                @csrf
	                <input name="_method" type="hidden" value="PATCH">
	                
	            	<div class="form-group">
	                    <label>Title</label> <span class="req">*</span>
	                    {{ Form::text('title', $podcast->title, ['placeholder' => 'Enter Title (eg. Episode 1)', 'class' => 'form-control required'])}}
	                    @if ($errors->has('title'))
                       		<span class="invalid-feedback" style="display:block;" role="alert">
                            	<strong>{{ $errors->first('title') }}</strong>
                       		</span>
                		@endif
	                </div>
	                <div class="form-group">
	                    <label>Profile Image</label>
	                    <div>
			            <label class="custom-file" id="customFile">
						        <input type="file" class="custom-file-input" name="podcast_image">
						        <span class="custom-file-control form-control-file"></span>
						</label>
						<input type="hidden" name="podcast_old_image" value="{{ $podcast->podcast_image }}">
						@if (!empty($podcast->podcast_image))
		               		<img class="img-circle" src="{{ config('constants.podcast_image_path').'/'.$podcast->podcast_image}}" width="40">
	                   
		                @endif
						</div>
						@if ($errors->has('podcast_image'))
	                   		<span class="invalid-feedback" style="display:block;" role="alert">
	                        	<strong>{{ $errors->first('podcast_image') }}</strong>
	                   		</span>
	            		@endif
	            		
					
	                    
	                </div>
	               
	                <div class="form-group">
	                    <label>Summary</label><span class="req">*</span>
	                    {{ Form::text('summary', $podcast->summary, ['placeholder' => 'Enter Summary', 'class' => 'form-control required'])}}
	                    @if ($errors->has('summary'))
                       		<span class="invalid-feedback" style="display:block;" role="alert">
                            	<strong>{{ $errors->first('summary') }}</strong>
                       		</span>
                		@endif
	                </div>
	                <div class="form-group">
	                    <label>Content</label>
	                    {{ Form::textarea('content', $podcast->content, ['placeholder' => 'Enter Content', 'class' => 'form-control required', 'id' => 'content'])}}
	                   @if ($errors->has('content_top'))
                       		<span class="invalid-feedback" style="display:block;" role="alert">
                            	<strong>{{ $errors->first('content_top') }}</strong>
                       		</span>
                		@endif
	                </div>
	               	<div class="form-group">
	                    <label>Audio Embed Code</label>
	                    {{ Form::textarea('audio_code', $podcast->audio_code, ['placeholder' => 'Enter Audio embed code', 'class' => 'form-control'])}}
	                    @if ($errors->has('audio_code'))
                       		<span class="invalid-feedback" style="display:block;" role="alert">
                            	<strong>{{ $errors->first('audio_code') }}</strong>
                       		</span>
                		@endif
	                </div>
	                <div class="form-group">
	                    <label>Youtube URL</label>
	                    {{ Form::text('youtube', $podcast->youtube, ['placeholder' => 'Enter Youtube Link', 'class' => 'form-control '])}}
	                    @if ($errors->has('youtube'))
                       		<span class="invalid-feedback" style="display:block;" role="alert">
                            	<strong>{{ $errors->first('youtube') }}</strong>
                       		</span>
                		@endif
	                </div>
	                <div class="form-group">
	                    <label>Spotify</label>
	                    {{ Form::text('spotify', $podcast->spotify, ['placeholder' => 'Enter Spotify Link', 'class' => 'form-control '])}}
	                    @if ($errors->has('spotify'))
                       		<span class="invalid-feedback" style="display:block;" role="alert">
                            	<strong>{{ $errors->first('spotify') }}</strong>
                       		</span>
                		@endif
	                </div>
	                <div class="form-group">
	                    <label>Apple Podcast</label>
	                    {{ Form::text('apple_podcast', $podcast->apple_podcast, ['placeholder' => 'Enter Apple Podcast Link', 'class' => 'form-control '])}}
	                    @if ($errors->has('apple_podcast'))
                       		<span class="invalid-feedback" style="display:block;" role="alert">
                            	<strong>{{ $errors->first('apple_podcast') }}</strong>
                       		</span>
                		@endif
	                </div>
	                <div class="form-group">
	                    <label>Play Music</label>
	                    {{ Form::text('play_music', $podcast->play_music, ['placeholder' => 'Enter Play Music Link', 'class' => 'form-control '])}}
	                    @if ($errors->has('play_music'))
                       		<span class="invalid-feedback" style="display:block;" role="alert">
                            	<strong>{{ $errors->first('play_music') }}</strong>
                       		</span>
                		@endif
	                </div>
	                <div class="form-group">
	                    <label>Stitcher</label>
	                    {{ Form::text('stitcher_link', $podcast->stitcher_link, ['placeholder' => 'Enter Stitcher link', 'class' => 'form-control '])}}
	                    @if ($errors->has('stitcher_link'))
                       		<span class="invalid-feedback" style="display:block;" role="alert">
                            	<strong>{{ $errors->first('stitcher_link') }}</strong>
                       		</span>
                		@endif
	                </div>
	                <div class="form-group">
	                	{{ Form::button('Submit', ['class' => 'btn btn-default edit-podcast'])}}
	                </div>
	            {{ Form::close() }}
	        </div>
	    </div>
	</div>
 </div>
</div>

@endsection
@section('scripts')
<!-- PAGE LEVEL PLUGINS-->
<script src="{{ asset('admintheme/vendors/summernote/dist/summernote-bs4.js') }}" type="text/javascript"></script>



<script type="text/javascript">
$(document).ready(function(){
	 $('#content').summernote({
        height: 150,
    });
    $('.note-popover').css({
        'display': 'none'
    });
		   
	  $('.edit-podcast').click(function(e){
	  	var ret = validateForm('EditPodcastForm');
	  	if(ret){
	  		$('#EditPodcastForm').submit();
	  	}
	  });

});
</script>
@stop