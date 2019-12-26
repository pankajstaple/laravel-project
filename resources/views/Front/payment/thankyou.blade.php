@extends('layouts.front')
@section('title', 'ThankYou')
@section('content')
<style type="text/css">
.thank_msg {
    background-color: #198a03;
    padding: .75rem;
    margin: 0;
    font-size: 18px;
    font-weight: 400;
    color: #fff;
    border-radius: 4px;
}

body {
    background-color: #e9ecef;
}
</style>
<div class="container" style="max-width: 700px !important;">


            <div class="thank_msg text-center mt-4">
              @if (session('emailerror'))
                <div class="alert alert-success">
                    {{ session('emailerror') }}
                </div>
              @endif
            @if(isset($cancelled) && $cancelled)

              <b>Cancel Order!</b> You have cancelled your enrollment.

            @elseif(isset($_GET['return']) && ($_GET['return'] == "membership"))

              <b>Thank you!</b> Your membership activated successfully.
            @elseif(isset($_GET['return']) && ($_GET['return'] == "capture"))

              <b>Thank you!</b> Your challenge submitted successfully.
            @else
              <b>Thank you!</b> You are enrolled in game successfully.
            @endif
          </div>


      
     @include('elements.share_on_email')
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
                           // window.location.href = "{{url('/')}}/profile/"+data;
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

});
</script>

@endsection('scripts')