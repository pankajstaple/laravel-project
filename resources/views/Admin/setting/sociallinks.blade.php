@extends('layouts.admin')
@section('content')
<div class="page-content fade-in-up">

 <div class="row">
	<div class="col-md-12">
	    <div class="ibox">
	    	@if(session()->has('success'))
               <p class="alert alert-success  text-center md_top" style="width:100%">
                  {{ session()->get('success') }}
                  <i class="fa fa-close pull-right mar-top"></i>
               </p>
           	@endif
           	@if(session()->has('error'))
               <p class="alert alert-danger  text-center md_top" style="width:100%">
                  {{ session()->get('error') }}
                  <i class="fa fa-close pull-right mar-top"></i>
               </p>
           	@endif
	        <div class="ibox-head">
	            <div class="ibox-title">Social URL</div>
	        </div>
	        <div class="ibox-body" style="">
	            {{ Form::open(array('url' => 'admin/setting/sociallinks', 'id' => 'SocialLinkForm', 'files'=>true)) }}
	                
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Facebook</label>
                            <div class="col-sm-10">
                                <input class="form-control url" name="facebook_link" placeholder="" type="text" value="{{isset($setting->facebook_link)?$setting->facebook_link:''}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Twitter</label>
                            <div class="col-sm-10">
                                <input class="form-control url" name="twitter_link" placeholder="" type="text" value="{{isset($setting->twitter_link)?$setting->twitter_link:''}}">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Youtube</label>
                            <div class="col-sm-10">
                                <input class="form-control url" name="youtube_link" placeholder="" type="text" value="{{isset($setting->youtube_link)?$setting->youtube_link:''}}">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Instagram</label>
                            <div class="col-sm-10">
                                <input class="form-control url" name="instagram_link" placeholder="" type="text" value="{{isset($setting->instagram_link)?$setting->instagram_link:''}}">
                            </div>
                        </div>
                        
                        
                        <div class="form-group row">
                            <div class="col-sm-10 ml-sm-auto">
                                <button class="btn btn-info add-sociallink" type="button">Submit</button>
                            </div>
                        </div>
                    <div></div>
  	            {{ Form::close() }}
	        </div>
	    </div>
	</div>
 </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
$(function(){


 $('.add-sociallink').click(function(e){
	var ret = validateForm('SocialLinkForm');
	if(ret){
		$('#SocialLinkForm').submit();
	}
 });
});
</script>
@stop