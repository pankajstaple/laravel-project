
@extends('layouts.front')
@section('title', 'Invite Page')

@section('content')

<style type="text/css">
.btn-gmail {
  color: #fff;
  background-color: #e9ecef;
  border-color: #e9ecef;
}
.btn-gmail:hover {
    color: #fff;
    background-color: #e2e3e5;
    border-color: #e2e3e5;
}
.btn-gmail.focus, .btn-gmail:focus {
    box-shadow: 0 0 0 0.2rem rgba(233, 236, 239, .75);
}
.btn-gmail:not(:disabled):not(.disabled):active:focus {
    box-shadow: none;
    background-color: #ecf3f9;
    border-color: #ecf3f9;
}

.btn-yahoo {
    color: #fff;
    background-color: #7c4f8e;
    border-color: #7c4f8e;
}
.btn-yahoo:hover {
    color: #fff;
    background-color: #5a2d6c;
    border-color: #5a2d6c;
}
.btn-yahoo.focus, .btn-yahoo:focus {
    box-shadow: 0 0 0 0.2rem rgba(90, 45, 108, .25);
}
.btn-yahoo:not(:disabled):not(.disabled):active:focus {
    box-shadow: none;
    background-color: #6c3e7e;
    border-color: #6c3e7e;
}

.btn-outlook {
    color: #fff;
    background-color: #0072c5;
    border-color: #0072c5;
}
.btn-outlook:hover {
    color: #fff;
    background-color: #026ab6;
    border-color: #026ab6;
}
.btn-outlook.focus, .btn-outlook:focus {
    box-shadow: 0 0 0 0.2rem rgba(2, 106, 182, .25);
}
.btn-outlook:not(:disabled):not(.disabled):active:focus {
    box-shadow: none;
    background-color: #157dc8;
    border-color: #157dc8;
}

.btn-facebook {
    color: #fff;
    background-color: #4f6aa3;
    border-color: #4f6aa3;
}
.btn-facebook:hover {
    color: #fff;
    background-color: #496299;
    border-color: #496299;
}
.btn-facebook.focus, .btn-facebook:focus {
    box-shadow: 0 0 0 0.2rem rgba(73, 98, 153, .25);
}
.btn-facebook:not(:disabled):not(.disabled):active:focus {
    box-shadow: none;
    background-color: #3e5486;
    border-color: #3e5486;
}

.btn-twitter {
    color: #fff;
    background-color: #76c4f3;
    border-color: #76c4f3;
}
.btn-twitter:hover {
    color: #fff;
    background-color: #6bc1f5;
    border-color: #6bc1f5;
}
.btn-twitter.focus, .btn-twitter:focus {
    box-shadow: 0 0 0 0.2rem rgba(107, 193, 245, .25);
}
.btn-twitter:not(:disabled):not(.disabled):active:focus {
    box-shadow: none;
    background-color: #5eb7ed;
    border-color: #5eb7ed;
}

.invite-sent-item {
    border: 1px solid rgba(0,0,0,.125);
    padding: .5rem .75rem;
    display: flex;
    justify-content: space-between;
    border-radius: 4px;
    align-items: center;
}
.invite-sent-item:not(:last-child) {
	margin-bottom: .5rem;
}
.invite-sent-status {
	background-color: #b9ffd4;
	color: #00b345;
	padding: .1rem .5rem;
	border-radius: 4px;
}
</style>

<div class="container">
      
      <!--<nav aria-label="breadcrumb" class="p-0 mt-4">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Invite</li>
        </ol>
      </nav>-->
      
      <div class="card my-4" style="">
        <div class="card-body">
          <h5 class="card-title">Share on Social</h5>
          <div class="row">
            <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
              <a href="https://www.facebook.com/sharer/sharer.php?u=http://<?php echo $_SERVER['SERVER_NAME'];?>/invite_user/<?php echo  $user_code->user_code ?>" target="_blank" class="btn btn-block btn-facebook facebook-share-button"> <i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a>
            </div>



            <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
              <a href="https://twitter.com/intent/tweet?url=<?php echo url('/').'/invite_user/'. $user_code->user_code; ?>" class="btn btn-block btn-twitter" target="_blank"> <i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a>
            </div>
            <div class="col-md-4 col-sm-8 mb-2 mb-md-0">
              <input class="form-control copyCode" id="myInput" readonly value="<?php echo url('/').'/invite_user/'. $user_code->user_code; ?>">
            </div>
            <div class="col-md-2 col-sm-4">
              <a href="#" class="btn btn-block btn-secondary copyCodeToClipBoard"> <i class="fa fa-clone" aria-hidden="true"></i> Copy</a>
            </div>
          </div>          
         
        </div>
      </div>


      <div class="card my-4" style="">
        <div class="card-body">
          <h5 class="card-title">Share via Email</h5>
          <div class="invite-form">
            <div class="form-group">
              <label>Email address comma-separated</label>
              <input type="text" class="form-control removeErrorField" placeholder="Email address separated by comma" name="emails">
            </div>
            <div class="form-group">
              <label>Message</label>
              <textarea class="form-control message" rows="7" readonly="readonly" name="message">
Hi!

I just joined Dadstrong to kick those extra pounds to the curb, and I want you to do it with me! Let's have fun, lose weight, and win some money together. Are you in?


              </textarea>
            </div>
            <input type="button" class="btn btn-yellow sendEmailInvitation" value="Send Invite">
          </div>

          <!-- <a name="fb_share" type="button" href="https://www.facebook.com/sharer.php?u=https://www.getdadstrong.com/user_profile">share on Facebook</a> -->

          <!-- <div class="row my-4">
            <div class="col-lg-3 col-md-12 mb-3 md-lg-0">
              Send to contacts from your...
            </div>
            <div class="col-lg-3 col-md-4 col-sm-4 mb-3 mb-md-0">
              <a href="#" class="btn btn-block btn-gmail"> <img src="images/gmail-btn.png" alt="" style="width: auto;height: 20px;"> </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-4 mb-3 mb-md-0">
              <a href="#" class="btn btn-block btn-yahoo"> <img src="images/yahoo-btn.png" alt="" style="width: auto;height: 20px;"> </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-4">
              <a href="#" class="btn btn-block btn-outlook"> <img src="images/outlook-btn.png" alt="" style="width: auto;height: 20px;"> </a>
            </div>
          </div>  -->         
         
        </div>
      </div>

      <div class="card my-4" style="">
        <div class="card-body">
          <h5 class="card-title">Invitations Sent ({{count($getSentEmailUsers)}})</h5>
          <div class="invite-sent-wrap">
          	<div class="invite-sent-list">
          		@if(count($getSentEmailUsers)>0)
          			@foreach($getSentEmailUsers as $email)
		          		<div class="invite-sent-item">
		          			<div class="invite-sent-email">{{$email->email_id}}</div>
		          			<div class="invite-sent-status">sent</div>
		          		</div>
		          	@endforeach
          		@endif

          	</div>
          </div>
        </div>
      </div>

    </div>

@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function(){
	$(document).on('click','.sendEmailInvitation',function(e){
		e.preventDefault();
		var email = $('input[name="emails"]').val();
		$('input[name="message"]').prop('readonly',false);
		var textMessage = $('.message').val();
		$('input[name="message"]').prop('readonly',true);
		if(email==''){
			$('input[name="emails"]').after('<p class="field-error">This field is required</p>');
      		$('html, body').animate({ scrollTop: 0 }, 'slow', function () {
            });
      		return false;
		}

		var checkValidEmail = validateEmail(email);
		if(checkValidEmail >0){
			$('input[name="emails"]').after('<p class="field-error">One of the email is invalid. Please check.</p>');
			return false;
		}
		
		

		var site_url = "{{url('/')}}/"+"send/email/invite";
		$('.loader').show();
	    $.ajax({
			url: site_url,
			data: {'email':email,'textMessage':textMessage},
			type: 'post',
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
			success: function(data) {
				$('.loader').hide();
				setTimeout(function(){
                            window.location.href = "{{url('/')}}/invite";
                    },1000);
			},
			error: function(error){
				$('.loader').hide();

			}
	    });

	});

	function validateEmail(emails){
		var mails = emails.split(",");
		var count = 0;
		for(i=0;i<=mails.length-1;i++){
			if(mails[i]!=""){
				var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  			if(!regex.test(mails[i])){
	  				count++;
	  			}
	  		}
		}
		return count;
	}


	$(document).on('blur','.removeErrorField',function(e){
  		if ($(this).val() !=''){
    		$(this).next($('.field-error')).remove();
  		}
	});


	$(document).on('click','.copyCodeToClipBoard',function(e){
		e.preventDefault();
		var copyCode = document.getElementById("myInput");
		copyCode.select();
		document.execCommand("copy");
	});
});
</script>

@endsection('scripts')