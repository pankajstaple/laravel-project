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
	            <div class="ibox-title">General Settings</div>
	        </div>
	        <div class="ibox-body" style="">
	            {{ Form::open(array('url' => 'admin/setting/general_settings', 'id' => 'SettingForm', 'files'=>true)) }}
	                
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Site URL</label>
                            <div class="col-sm-10">
                                <input class="form-control url" name="site_url" placeholder="" type="text" value="{{isset($setting->site_url)?$setting->site_url:''}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Logo Image</label>
                            <div class="col-sm-4">
						            <label class="custom-file w-100" id="customFile">
									        <input class="custom-file-input image logo-image" name="logo_image" type="file">
									        <span class="custom-file-control form-control-file selected"></span>
									</label>
									<input type="hidden" name="old_logo_image" value="{{ isset($setting->logo_image)?$setting->logo_image:''}}">
                            </div>
                            <div class="col-sm-4">
                            	<div class="img-preview">
                            		<img src="{{(!empty($setting->logo_image)?url('/').'/img/'.$setting->logo_image:url('/').'/admintheme/img/no-image.png')}}" id="img-preview">
                            	</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Comission (%)</label>
                            <div class="col-sm-10">
                                <input class="form-control onlynumber" name="comission" placeholder="" type="text" value="{{isset($setting->comission)?$setting->comission:''}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Membership Amount</label>
                            <div class="col-sm-10">
                                <input class="form-control onlynumber" name="plan_amount" placeholder="" type="text" value="{{isset($subscription_amt)?$subscription_amt:''}}">
                                <input class="form-control onlynumber" name="old_plan_amount" placeholder="" type="hidden" value="{{isset($subscription_amt)?$subscription_amt:''}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Google Analytics Script</label>
                            <div class="col-sm-10">
                            	<textarea class="form-control" name="ga_script" rows="3">{{isset($setting->ga_script)?$setting->ga_script:''}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Copyright</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="copyright_text" placeholder="" type="text" value="{{isset($setting->copyright_text)?$setting->copyright_text:''}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Powered By</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="powered_by" placeholder="" type="text" value="{{isset($setting->powered_by)?$setting->powered_by:''}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 ml-sm-auto">
                                <button class="btn btn-info add-setting" type="button">Submit</button>
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


 $('.add-setting').click(function(e){
	var ret = validateForm('SettingForm');
	if(ret){
		$('#SettingForm').submit();
	}
 });

 $(".logo-image").change(function() {
	  readURL(this);
 });

});
function readURL(input) {
	console.log(input);
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#img-preview').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
 }
</script>
@stop