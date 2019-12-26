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
	            <div class="ibox-title">Contact Us</div>
	        </div>
	        <div class="ibox-body" style="">
	            {{ Form::open(array('url' => 'admin/pages/save_contact_us', 'id' => 'SettingForm', 'files'=>true)) }}
	                
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input class="form-control required" name="email" placeholder="" type="text" value="{{isset($setting->email)?$setting->email:''}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <input class="form-control required" name="address" placeholder="" type="text" value="{{isset($setting->address)?$setting->address:''}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Telephone</label>
                            <div class="col-sm-10">
                                <input class="form-control required" name="telephone" placeholder="" type="text" value="{{isset($setting->telephone)?$setting->telephone:''}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Fax</label>
                            <div class="col-sm-10">
                                <input class="form-control required" name="fax" placeholder="" type="text" value="{{isset($setting->fax)?$setting->fax:''}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Google Map API Key</label>
                            <div class="col-sm-10">
                                <input class="form-control required" name="google_map_key" placeholder="" type="text" value="{{isset($setting->google_map_key)?$setting->google_map_key:''}}">
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