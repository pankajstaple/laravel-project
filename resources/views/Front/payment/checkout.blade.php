@extends('layouts.front')
@section('title', 'payment checkout')
@section('content')
@php
$countries=config('constants.country_list');
$provinces=config('constants.province_list');
$states=config('constants.state_list');
$buttonText = "Join Game";
if(isset($is_membership))
$buttonText = "Buy Membership";
@endphp

@if(isset($is_membership))
<form action="{{ route('do_subscription')}}" method="post" id="PaymentForm">
@else
<form action="{{ route('do_payment')}}" method="post" id="PaymentForm">
	<input type="hidden" name="is_preauth" value="{{ isset($is_preauth)?$is_preauth:''}}">
@endif
	
	@csrf()
<div class="mt-5">
			 <div class="games-listings mb-5">
				<div class="payment_heads">
					<p>ITEM(S)</p>
					<p>AMOUNT</p>
				</div>
				@if(!isset($is_membership))
				<div class="row twenty">
					<div class="col-lg-4 col-md-8 col-sm-12 col-12">
						<div class="game_list_image">
							 @if(empty($challenge->challenge_image))
							<img src="{{ asset('fronttheme/images/no-blog.png') }}" alt="no image">
						 @else
							<img src="{{ config('constants.challenge_image_path').'/'.$challenge->challenge_image }}" alt="">
						 @endif
						</div>
					</div>
					<div class="col-lg-8 col-md-8 col-sm-12 col-12">
						<div class="game_list_content">
							<div class="payment_list">
								<h3>{{ isset($challenge->title)?$challenge->title:"" }}</h3>
								<h3>${{ number_format($challenge->amount, 0, ',', '.') }}</h3>
							</div>
							<div class="row mt-5 mb-3 games_detail">
								<div class="col-md-3 col-sm-6 col-xs-6 col-12">
									<div class="games_icon_section">
										<img src="{{ url('fronttheme/images/bet.png') }}">
										<p>BET:<strong>  ${{ number_format($challenge->amount, 0, ',', '.') }}</strong></p>
									</div>
								</div>
								<div class="col-md-3 col-sm-6 col-xs-6 col-12">
									<div class="games_icon_section">
										<img src="{{ url('fronttheme/images/playing.png') }}">
										<p>PLAYERS:<strong> {{$challenge->get_total_players_count }}</strong></p>
									</div>
								</div>
								<div class="col-md-3 col-sm-6 col-xs-6 col-12">
									<div class="games_icon_section">
										<img src="{{ url('fronttheme/images/pot.png') }}">
										<p>POT:<strong> ${{ number_format($challenge->get_total_players_count * $challenge->amount, 0, ',', '.') }}</strong></p>
									</div>
								</div>                     
							</div>                    
						</div>
					</div>
				</div>
				@else
				<div class="px-4 py-3 border-top">
					<div class="row">
						<div class="col-10">
							<div class="row align-items-center">
								<div class="col-auto d-none d-md-block">
									<img src="{{url('fronttheme/images/membership.png')}}" class="img-fluid member-icon" style="max-width:120px;">
								</div>
								<div class="col">
									<h4 class="mb-1">DadStrong Membership Program (Yearly)</h4>
									<p>Get huge prizes, smarter progress, and more accountability! Membership unlocks huge giveaways each week, extra verified weigh-ins, and effective progress-tracking tools. Membership will automatically renew yearly. </p>
								</div>
							</div>
						</div>
						<div class="col-2 text-right">
							<h4 class="mb-1">${{ number_format($subscription_amt, 0, ',', '.') }}</h4>
							<!--<a href="javascript:;" class="text-danger">Remove</a> -->
						</div>
					</div>
				</div>
				@endif

		<div class="promo_code">
			<div class="container">
				<div class="row">
					

					<div class="col-md-6 co-sm-12 pull-left">
						@if(!isset($is_membership) && ($is_preauth == 0))
						<h2 class="promo_ px-0 promo-code" style="cursor: pointer;">HAVE A PROMOCODE?</h2>
						<div class="promo_box" style="display: none;">
							<h4>Apply Promo code</h4>
							  <div class="form-group mr-sm-3 mb-2">
								 <label for="" class="sr-only">Promo</label>
								 <input type="text" name="coupon_code" class="form-control" id="" placeholder="Enter here..." value="">
							  </div>
							  <button type="button" class="btn btn-yellow mb-2 apply-coupon">Apply</button>
						</div>
						@endif
					</div>
					
					<div class="col-md-6 col-sm-12">
						<div class="form-row discount-block" style="display:none;">
							<div class="col-10 text-right">
								<h3 style="font-family: raleway;">DISCOUNT:</h3>                     
							</div>
							<div class="col-2">
								<h3 style="font-family: raleway;" class="discount-amt">$</h3>
							</div>
						</div>
						<div class="form-row">
							<div class="col-10 text-right">
								<h2 class="pr-0">PAYMENT TOTAL:</h2>                     
							</div>
							<div class="col-2">
								@if(!isset($is_membership))
								<h2 class="pr-0 total-amt">${{ number_format(($challenge->amount), 0, ',', '.') }}</h2>
								<input type="hidden" name="challenge" value="{{ base64_encode($challenge->id)}}">
								<input type="hidden" class="amount" name="amount" value="{{number_format(($challenge->amount), 0, ',', '.')}}">
								<input type="hidden" name="payment_for" value="Challenge"/>
								@else
								<h2 class="pr-0 total-amt">${{ number_format($subscription_amt, 0, ',', '.') }}</h2>
								<input type="hidden" name="challenge" value="0">
								<input type="hidden" class="amount" name="amount" value="{{number_format($subscription_amt, 0, ',', '.')}}">
								<input type="hidden" name="payment_for" value="Membership"/>
								@endif
								
								<input type="hidden" class="discount" name="discount" value="">
								<input type="hidden" name="payment_gateway" value="{{$card_gateway}}">
							</div>
						</div>
					</div>
				</div>
				<!-- alert -->
				<div class="alert alert-success alert-dismissible fade show promo-div" role="alert" style="display:none;">
				  <span class="promo-msg">You should check in on some of those fields below.<span>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					 <span aria-hidden="true">&times;</span>
				  </button>
				</div>
				<!-- /alert -->
			</div>
		</div>
	</div>
</div>
		 
		


<div class="payment-bg mt-5 pb-0">
	<div class="container">
					<!-- You can make it whatever width you want. I'm making it full width
						on <= small devices and 4/12 page width on >= medium devices -->
		<div class="panel-heading display-table" >
			<h3 class="payment-info">PAYMENT INFORMATION</h3>

			<div class="row border-btm">
				<div class="col-md-5 col-sm-12">
					<div class="custom-control custom-radio">
						<input type="radio" id="customRadio1" name="gateway" value="{{$card_gateway}}" class="custom-control-input gateway" checked="">
						<label class="custom-control-label" for="customRadio1">Pay with Credit card</label>
						<img class="img-fluid" src="{{url('fronttheme/images/cc.png')}}" alt="">
					</div>                                          
				</div>
				<div class="col-md-2">
					<h3 class="panel-title display-td or">
						<span>OR</span>
					</h3>               
				</div>
				<div class="col-md-5 col-sm-12">
					<div class="custom-control custom-radio">
						<input type="radio" id="customRadio2" name="gateway" value="paypal" class="custom-control-input gateway">
						<label class="custom-control-label ml-5" for="customRadio2">Pay with Paypal</label>
						<img src="{{ url('fronttheme/images/paypal.png')}}" class="img-fluid" alt="">
					</div>
				</div>
			</div>
		</div>

				@if($card_gateway == "")
				<section class="cc_box">
					<div class="row">
						<div class="col-xs-12 col-md-12 my-5 cc-info">
							<div class="row align-items-center">
								<div class="col">
									<p class="mb-0">Payment gateway is disabled for some reasons. Please contact administrator for further queries.</p>
								</div>
							</div>
						</div>
					</div>
				</section>
				@else
				<section class="cc_box">
					<div class="alert alert-danger card-error mt-4" role="alert" style="display:none;">
					  Something went wrong!
					</div>
					<div class="row">
						<div class="col-xs-12 col-md-6 my-5 cc-info">
							<!-- CREDIT CARD FORM STARTS HERE -->
							<label><strong>CARD INFORMATION</strong></label>
							<div class="panel panel-default credit-card-box ">
								<div class="panel-body">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group credit mt-3">
													<label for="cardNumber">CARD NUMBER</label>
													<div class="input-group">
														<input type="tel"class="form-control credit-card-number required" name="card_number" placeholder="**** **** **** ****"autocomplete="cc-number"required autofocus />
														<span class="input-group-addon cc-addon">
															<i class="fa fa-credit-card"></i>
															<span class="card-img"></span>
														</span>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group credit">
													<label for="cardNumber">CARD HOLDER NAME</label>
													<div class="input-group">
														<input type="text"class="billing-address-name form-control required" name="card_holder_name" placeholder="JOHN DOE" autocomplete="cc-number" autofocus />
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-7 col-md-7">
												<div class="form-group dates">
													<label for="cardExpiry">
														<span class="hidden-xs">CARD EXPIRY DATE</span><!-- <span class="visible-xs-inline">EXP</span> -->         <span class="input-group-addon dat"><i class="fa fa-calendar" ></i></span>
													</label>
													<input 
														type="tel" 
														class="form-control expiration-month-and-year required" 
														name="card_expiry"
														placeholder="MM / YYYY"
														autocomplete="cc-exp"
														size="9"
														id="emay"
														/>
												</div>
											</div>
											<div class="col-xs-5 col-md-5 pull-right">
												<div class="form-group">
													<label for="cardCVC">CV CODE</label>
													<input 
														type="tel" 
														class="form-control security-code required"
														name="card_cvc"
														placeholder="***"
														autocomplete="cc-csc"
														
														/>
												</div>
											</div>
												 <div class="form-check check_sec">
														 <input type="checkbox" class="form-check-input" id="exampleCheck1">
														 <label class="form-check-label" for="exampleCheck1">ABOVE ALL INFORMATION IS CORRECT?</label>
													  </div>
													  <input type="hidden" name="card_type" class="card-type-input">
													  <div class="card-type" style="display:none;"></div>
										</div> 
								</div>
							</div>
							<!-- CREDIT CARD FORM ENDS HERE -->
						</div>

						<!--  -->
						<div class="col-xs-12 col-md-6 my-5">
							<!-- CREDIT CARD FORM STARTS HERE -->
							<label><strong>BILLING ADDRESS</strong></label>
							<div class="panel panel-default credit-card-box">
								<div class="panel-body">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group credit mt-3">
													<label for="cardNumber">BILLING ADDRESS</label>
													<div class="input-group">
														<input type="text"class="form-control required" name="billing_Address" placeholder="STREET APARTMENT" autocomplete="cc-number" required="required" autofocus />
													</div>
												</div>
											</div>
										</div>
									 
										<div class="row">
											<div class="col-md-6">
												<label for="cardNumber">CITY</label>
												 <input type="text" class="form-control required" name="city" placeholder="CITY" required="required" autofocus/>
											</div>

											<div class="col-md-6">
												<label for="cardNumber">STATE</label>
		
													<div id="state_field" class="customer-state form-field" style="display: none;">
														<span class="field-data">
														<select name="" autocomplete="off" placeholder="State" id="state" class="select state-select form-control" autofocus>
														<option value="" selected="selected">- Select State -</option>
														@foreach($states as $code => $state )
															<option value="{{$code}}">{{$state}}</option>
														@endforeach
														</select>
														<div class="field-errors">
														</div>
													</span>
												</div>
												
													<div id="province_field" class="customer-province form-field" style="display: none;">
														<span class="field-data">
														<select name="province" autocomplete="off" placeholder="Province" id="province" class="select province-select form-control" autofocus>
															<option value="" selected="selected">- Select Province -</option>
															@foreach($provinces as $code => $province )
															<option value="{{$code}}">{{$province}}</option>
															@endforeach
														</select>
														<div class="field-errors">
														</div>
													</span>
												</div>
													<div id="state_custom_field" class="customer-state-custom form-field" style="">
														<span class="field-data">
															<input name="state_custom_field" placeholder="State" id="state_custom" value="" class="form-control state_text" type="text" autofocus/>
															<div class="field-errors"></div>
														</span>
													</div>
													<input type="hidden" value="" class="required hidden-state" name="state" id="HiddenState">
											</div>
											</div>

											<div class="row twenty">
											<div class="col-md-6">
												<label for="cardNumber">COUNTRY</label>
												<select name="country" autocomplete="off" placeholder="Country" id="Card_country" class="select custom-select required" required autofocus>
													<option value="">- Select Country -</option>
													@foreach($countries as $code => $country)
													@if($country == "optgroup")
													<optgroup></optgroup>
													@else
													<option value="{{$code}}">{{$country}}</option>
													@endif
													@endforeach
												</select>
											</div>

											<div class="col-md-6">
												<label for="cardNumber">PHONE</label>
												<div class="input-group">
														<input type="text" maxlength="15" class="form-control required" name="phone_number" placeholder="+1 (760) 756 7568" autocomplete="cc-number" required autofocus />
													</div>
												
											</div>
											</div>
										<div class="row twenty join_btns">
											<div class="col-xs-12 cards">
												<button class="btn btn-success btn-lg btn-block cc-submit-btn" style="background-color: #ffa93f;border: none;" type="button">{{$buttonText}}</button>
											</div>
										</div>
										</div>
								</div>
							
							<!-- CREDIT CARD FORM ENDS HERE -->
						</div>


					</div>

				</section>
				@endif

				<section class="pp_box py-4" style="display: none;">
					<div class="alert alert-danger pp-error mt-4" role="alert" style="display:none;">
					  Something went wrong!
					</div>
					@if(isset($is_paypal_active) && $is_paypal_active)
					<div class="row align-items-center">
						<div class="col-auto">
							<img src="{{ url('fronttheme/images/paypal.png')}}" alt="Money Back" style="max-width:160px;"> 
						</div>
						<div class="col">
							<p class="mb-0">You will now be taken to PayPal to complete your payment and will be returned to DietBet once successful.</p>
						</div>
						<div class="col-auto">
							<button class="btn btn-success btn-lg paypal-btn join_game" type="button">{{$buttonText}}</button>
						</div>
					</div>
					@else
					<div class="row align-items-center">
						This payment gateway temporary disable. Please contact administrator for further query.
					</div>
					@endif
				</section>
				</div>
			</div>
</form>
<div class="img_sec_bg">
	<div class="container">
		<div class="hundred">
			<p style="font-weight: bold;"><img src="{{ url('fronttheme/images/hund.png')}}"> NO LOSE GUARANATEE</p>
			<p style="text-transform: uppercase;">If you win your bet, you won't lose money. We guarantee it. Even if<br>
			everyone in your game wins, we'll forfeit our cut so winners never lose money.</p>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('fronttheme/js/creditly.js')}}"></script>

@if($card_gateway == "Stripe")
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
	
Stripe.setPublishableKey('{{$stripe_public_key}}');

</script>
@endif

<script type="text/javascript">
$('.loader').show();
	$(document).ready(function(){
		$('.loader').hide();
		var selVal = $('input[name="gateway"]:checked').val();
		if(selVal == "paypal"){
			$('.cc_box').hide();
			$('.pp_box').show();
		}else{
			$('.cc_box').show();
			$('.pp_box').hide();
	 
		}
		$('.promo-code').on('click', function(){
			$(this).next('.promo_box').show();
		});

		/* Show hide credit card form as per radio selection */
		$('.gateway').click(function(){
			var selVal = $('input[name="gateway"]:checked').val();
			$('input[name="payment_gateway"]').val(selVal);
			if(selVal == "paypal"){
				$('.cc_box').hide();
				$('.pp_box').show();
			}else{
				$('.cc_box').show();
				$('.pp_box').hide();
		 
			}
		});


		/* Form submission for payment check */
		$('.paypal-btn').on('click', function(){
			var formData = $('#PaymentForm').serialize();
			var url = $('#PaymentForm').attr('action');
			var selVal = $('input[name="gateway"]:checked').val();
			if(selVal != "paypal"){
				return;
			}else{
				$('.loader').show();
			  $.ajax({
					  url: url,
					  data: formData,
					  type: 'post',
					  dataType: 'json',
					  success: function(res){
							if(res.status == 1){
								//$('.loader').hide();
								window.location = res.url;
							
							}else{
								$('.pp-error').html(res.messsage).show();
								$('html, body').animate({
							        scrollTop: $(".pp-error").offset().top
							    }, 1000);
							  	$('.loader').hide();
							}
					  },
					  error: function(x,f){
					  		$('.loader').hide();
					  		alert("Something went wrong. Please refresh and try again!");
					  }

				 });
			}
		});

		/* Apply coupon and deduct amount from total */
		$('.apply-coupon').on('click', function(){
			var coupon_code = $('input[name="coupon_code"]').val();
			var amt = $('.amount').val();
			if(coupon_code == ""){
				return;
			}
		  var discountAmt = 0;
		  $('.loader').show();
		  $.ajax({
				  url: siteurl+'/apply_coupon/'+coupon_code,
				  dataType: 'json',
				  success: function(res){
						$('.promo-div').hide();
						if(res.status == 1){
							$('.discount-block').show();
							if(res.data.is_fixed == 1){
								discountAmt = res.data.discount;
							}else{
								discountAmt = parseFloat((amt*res.data.discount)/100);
							}
							amt = (amt - discountAmt);
							if(amt < 0){
								amt = 0;
							}
							$('.discount').val(discountAmt);
							$('.discount-amt').html('$'+discountAmt);
							$('.total-amt').html('$'+amt);
							$('.loader').hide();

						}else{
						  $('.promo-msg').html(res.message);
						  $('.promo-div').show();
						}
						$('.loader').hide();
				  },
				  error: function(x,f){
						$('.loader').hide();
						alert("Something went wrong. Please refresh and try again!");
				  }

			 });
		});

		/* Credit card information validation */
		var creditly = Creditly.initialize(
			 '.cc-info .expiration-month-and-year',
			 '.cc-info .credit-card-number',
			 '.cc-info .security-code',
			 '.cc-info .card-type');

		/* Credit card payment submission and do payment */
		$('.cc-submit-btn').click(function(){
			$(document).find('.card-error').hide();
			 var ret = validateForm('PaymentForm');
        
			  var output = creditly.validate();
			  if (output) {
			  	var formData = $('#PaymentForm').serialize();
				var url = $('#PaymentForm').attr('action');
				var selVal = $('input[name="gateway"]:checked').val();
				
				$('input[name="payment_gateway"]').val(selVal);
					if(ret){
						/* Check form check input*/
						if(!$('.form-check-input').is(':checked')){
							$(document).find('.card-error').html("Please check below information is correct.").show();
								$('html, body').animate({
							        scrollTop: $(".card-error").offset().top
							    }, 1000);
								return;
						}else{ 
							/* check if payment gateway stripe*/
							if(selVal == "Stripe"){
								manageStripe();

							}else{

							$('.loader').show();
							 // Your validated credit card output
							  $.ajax({
								  url: url,
								  data: formData,
								  type: 'post',
								  dataType: 'json',
								  success: function(res){
								  	//console.log(res);
								  	//alert($.trim(res.status));
										if(res.status == 1){
											$('.loader').hide();
											window.location = res.url;
										
										}else if($.trim(res.status) == "email_sent_error"){
											$('.card-error').html(res.message).show();
											$('#PaymentForm').find('input[type="text"]').val("");
											$('#PaymentForm').find('input[type="tel"]').val("");
											$('#PaymentForm').find('.form-check-input').prop("checked", false);
											$('html, body').animate({
										        scrollTop: $(".card-error").offset().top
										    }, 1000);

											$('.loader').hide();

										}else{
											$('.card-error').html(res.message).show();
											$('html, body').animate({
										        scrollTop: $(".card-error").offset().top
										    }, 1000);
											//alert(res.message);
										  	$('.loader').hide();
										}
								  },
								  error: function(x,f){
										$('.loader').hide();
										alert("Something went wrong. Please refresh and try again!");
								  }

							 });
							}
						}
				}else{
					console.log('Unable to submit form. Validation failed !');
				}
			 }else{
			 	$(document).find('.has-error:first').focus();
			 	console.log(output);
			  	console.log('no-validate');
			  	//alert('no-validate');
			  }

		});

	function manageStripe(){
		var expire = $('input[name="card_expiry"]').val();
		var datearr = expire.split('/');
		$('.loader').show();
		Stripe.card.createToken({
		  number: $('input[name="card_number"]').val(),
		  cvc: $('input[name="card_cvc"]').val(),
		  exp_month: $.trim(datearr[0]),
		  exp_year: $.trim(datearr[1]),
		  name: $('input[name="card_holder_name"]').val(),
		  address_line1: $('input[name="billing_Address"]').val(),
		  address_city: $('input[name="city"]').val(),
		  address_state: $('input[name="state"]').val(),
		  address_country: $('input[name="country"]').val(),
		}, stripeResponseHandler);
	}


	function stripeResponseHandler(status, response) {
	  // Grab the form:
	  var $form = $('#PaymentForm');
	  if (response.error) { // Problem!
	    // Show the errors on the form
	    $form.find('.card-error').html(response.error.message);
	    $form.find('.card-error').show();
	    $('.loader').hide();
	    //$form.find('.cc-submit-btn').prop('disabled', false); // Re-enable submission
	  } else { // Token was created!
	    // Get the token ID:
	    var token = response.id;
	    $form.find('input[name="stripeToken"]').remove();
	    // Insert the token into the form so it gets submitted to the server:
	    $form.append($('<input type="hidden" name="stripeToken" />').val(token));
	    // Submit the form via ajax:
	    var url = $('#PaymentForm').attr('action');
	    var formData = $('#PaymentForm').serialize();
				
	    $.ajax({
				  url: url,
				  data: formData,
				  type: 'post',
				  dataType: 'json',
				  success: function(res){
						if(res.status == 1){
							$('.loader').hide();
							window.location = res.url;
						
						}else if($.trim(res.status) == "email_sent_error"){
							$('.card-error').html(res.messsage).show();
							$('#PaymentForm').find('input[type="text"]').val("");
							$('#PaymentForm').find('input[type="tel"]').val("");
							$('#PaymentForm').find('.form-check-input').prop("checked", false);
							$('#PaymentForm').find('.discount').val("0");
							var actualAmt = $('#PaymentForm').find('.amount').val();
							$('#PaymentForm').find('.total-amt').html("$"+actualAmt);
							$('#PaymentForm').find('.discount-block').hide();
							$('#PaymentForm').find('.promo_box').hide();
							$('html, body').animate({
						        scrollTop: $(".card-error").offset().top
						    }, 1000);

							$('.loader').hide();

						}else{
							$('.card-error').html(res.messsage).show();
							$('html, body').animate({
						        scrollTop: $(".card-error").offset().top
						    }, 1000);
							//alert(res.message);
						  	$('.loader').hide();
						}
				  },
				  error: function(x,f){
						$('.loader').hide();
						alert("Something went wrong. Please refresh and try again!");
				  }

			 });
	  }
	}


	/* Change State box as per selected country */
	$("#Card_country").change(function(){
		$('.hidden-state').val("");
	 	var country= $( "#Card_country" ).val();
	 		if(country=='US'){
		 		$("#province_field").hide();
		 		$("#state_custom_field").hide();
		 		$("#state_field").show();
		 		//$('#province').addClass('required');
		 		//$('#testID').removeClass('nameOfClass');


		 	}
		 	else if(country=='CA'){
		 		$("#state_field").hide();
		 		$("#state_custom_field").hide();
		 		$("#province_field").show();
		 	}else{
		 		$("#state_field").hide();
		 		$("#province_field").hide();
		 		$("#state_custom_field").show();
		 		$("#state_custom").val("");
		 	}
	});

	
	$(".credit-card-number").on('keyup', function(){
		var cardType = $('.card-type').html().toLowerCase();
		$('.card-type-input').val(cardType);
		cardType = cardType.split(' ').join('');
		$('.cc-addon').removeClass('visa discover americanexpress mastercard');
		$('.cc-addon').addClass(cardType);
	});	

	$(".state-select").on('change', function(){
		var selState = $(".state-select").find('option:selected').val();
		$('.hidden-state').val(selState);
	});

	$(".province-select").on('change', function(){
		var selState = $(".province-select").find('option:selected').val();
		$('.hidden-state').val(selState);
	});

	$(".state_text").on('blur', function(){
		var selState = $(".state_text").val();
		$('.hidden-state').val(selState);
	});

	});
</script>
@stop
