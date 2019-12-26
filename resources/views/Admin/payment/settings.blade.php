@extends('layouts.admin')
@section('content')
<div class="page-content fade-in-up">
<div class="ibox">
    @include('elements.printerror')
    <div class="ibox-head">
        <div class="ibox-title">Payment Gateways</div>
    </div>
    <div class="ibox-body">
                <ul class="nav nav-tabs tabs-line">
                    <li class="nav-item">
                        <a class="nav-link active" href="#tab-1" data-toggle="tab"> Stripe</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-2" data-toggle="tab"> Paypal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-3" data-toggle="tab">Authorize.net</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-1">
                    	{{ Form::open(array('url' => route('save_gateway'), 'id' => '', 'files'=>true, 'class' => 'form-horizontal')) }}
                        	<input type="hidden" name="gateway" value="Stripe">
                            <div class="form-group">
                                <label>Notification Email</label>
                                <input class="form-control" name="notification_email" type="email" placeholder="" value="{{$stripeData['notification_email']}}">
                            </div>
                            <div class="form-group">
                                <label>Public Key</label>
                                <input class="form-control" name="public_key" type="text" placeholder="" value="{{$stripeData['public_key']}}">
                            </div>
                            <div class="form-group">
                                <label>Private Key</label>
                                <input class="form-control" name="secret_key" type="text" placeholder="" value="{{$stripeData['secret_key']}}">
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <label class="ui-radio ui-radio-inline">
                                        <input class="account_type" name="account_type" type="radio" value="Live" {{($stripeData['account_type'] == "Live")?"checked":""}}>
                                        <span class="input-span"></span>Live</label>
                                    <label class="ui-radio ui-radio-inline">
                                        <input class="account_type" name="account_type" type="radio" value="Test" {{($stripeData['account_type'] == "Test")?"checked":""}}>
                                        <span class="input-span"></span>Sandbox (Test Account)</label>
                                   
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Payment Method</label>
                                <div class="col-sm-9">
                                    <label class="ui-radio ui-radio-inline">
                                        <input class="status" name="status" type="radio" value="Active" {{($stripeData['status'] == "Active")?"checked":""}}>
                                        <span class="input-span"></span>Enable</label>
                                    <label class="ui-radio ui-radio-inline">
                                        <input class="status" name="status" type="radio" value="Inactive" {{($stripeData['status'] == "Inactive")?"checked":""}}>
                                        <span class="input-span"></span>Disable</label>
                                   
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-default save-gateway-btn" type="button">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="tab-2">
                        {{ Form::open(array('url' => route('save_gateway'), 'id' => '', 'files'=>true, 'class' => 'form-horizontal')) }}
                        	<input type="hidden" name="gateway" value="Paypal">
                            <div class="form-group">
                                <label>Merchant Account Id</label>
                                <input class="form-control" name="merchant_id" type="text" placeholder="" value="{{$paypalData['merchant_id']}}">
                            </div>
                            <div class="form-group">
                                <label>Notification Email</label>
                                <input class="form-control" name="notification_email" type="email" placeholder="" value="{{$paypalData['notification_email']}}">
                            </div>
                            <div class="form-group">
                                <label>API Username</label>
                                <input class="form-control" name="api_username" type="text" placeholder="" value="{{$paypalData['api_username']}}">
                            </div>
                            <div class="form-group">
                                <label>API Password</label>
                                <input class="form-control" name="api_password" type="text" placeholder="" value="{{$paypalData['api_password']}}" >
                            </div>
                            <div class="form-group">
                                <label>API Signature</label>
                                <input class="form-control" name="api_signature" type="text" placeholder="" value="{{$paypalData['api_signature']}}">
                            </div>
                        <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <label class="ui-radio ui-radio-inline">
                                        <input class="account_type" name="account_type" type="radio" value="Live" {{($paypalData['account_type'] == "Live")?"checked":""}}>
                                        <span class="input-span"></span>Live</label>
                                    <label class="ui-radio ui-radio-inline">
                                        <input class="account_type" name="account_type" type="radio" value="Test" {{($paypalData['account_type'] == "Test")?"checked":""}}>
                                        <span class="input-span"></span>Sandbox (Test Account)</label>
                                   
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Payment Method</label>
                                <div class="col-sm-9">
                                    <label class="ui-radio ui-radio-inline">
                                        <input class="status" name="status" type="radio" value="Active" {{($paypalData['status'] == "Active")?"checked":""}}>
                                        <span class="input-span"></span>Enable</label>
                                    <label class="ui-radio ui-radio-inline">
                                        <input class="status" name="status" type="radio" value="Inactive" {{($paypalData['status'] == "Inactive")?"checked":""}}>
                                        <span class="input-span"></span>Disable</label>
                                   
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-default save-gateway-btn" type="button">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="tab-3">
                        {{ Form::open(array('url' => route('save_gateway'), 'id' => '', 'files'=>true, 'class' => 'form-horizontal')) }}
                        	<input type="hidden" name="gateway" value="Authorize.net">
                            <div class="form-group">
                                <label>Notification Email</label>
                                <input class="form-control" name="notification_email" type="email" placeholder="" value="{{$authorizeData['notification_email']}}">
                            </div>
                            <div class="form-group">
                                <label>API Login ID</label>
                                <input class="form-control" name="api_login_id" type="text" placeholder="" value="{{$authorizeData['api_login_id']}}">
                            </div>
                            <div class="form-group">
                                <label>Transaction Key</label>
                                <input class="form-control" name="transaction_key" type="text" placeholder="" value="{{$authorizeData['transaction_key']}}">
                            </div>
                           <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <label class="ui-radio ui-radio-inline">
                                        <input class="account_type" name="account_type" type="radio" value="Live" {{($authorizeData['account_type'] == "Live")?"checked":""}}>
                                        <span class="input-span"></span>Live</label>
                                    <label class="ui-radio ui-radio-inline">
                                        <input class="account_type" name="account_type" type="radio" value="Test" {{($authorizeData['account_type'] == "Test")?"checked":""}}>
                                        <span class="input-span"></span>Sandbox (Test Account)</label>
                                   
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Payment Method</label>
                                <div class="col-sm-9">
                                    <label class="ui-radio ui-radio-inline">
                                        <input class="status" name="status" type="radio" value="Active" {{($authorizeData['status'] == "Active")?"checked":""}}>
                                        <span class="input-span"></span>Enable</label>
                                    <label class="ui-radio ui-radio-inline">
                                        <input class="status" name="status" type="radio" value="Inactive" {{($authorizeData['status'] == "Inactive")?"checked":""}}>
                                        <span class="input-span"></span>Disable</label>
                                   
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-default save-gateway-btn" type="button">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
$(document).ready(function(){
	$('.save-gateway-btn').on('click', function(){
			$('.loader').show();
			var formUrl = $(this).parents('form').attr('action');
            var formData = $(this).parents('form').serialize();
            $.ajax({
                url: formUrl,
                data: formData,
                type: 'post',
                dataType:'json',
                success: function(res){
                	$('.loader').hide();
                    if(res.status){
                        $('.success-message').show().focus();
                        
                    }else{
                    	$('.error-message').show().focus();
                    }
                    setTimeout(function(){
                        	 $('.success-message').hide();
                        },2000);
                },
                error: function(x,jqXHR){
                	$('.loader').hide();
                    $('.request-error').show().focus();
                }

            });
        
    });
});

</script>
@stop