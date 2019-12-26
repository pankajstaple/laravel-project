@extends('layouts.front')
@section('content')

<style type="text/css">
.thank-you {
  background-color: #f4f4f4;
  position: relative;
  min-height: 70vh;
}
.thank-you-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
}
.thank-you-content h1 {
    color: #555;
    font-size: 36pt;
    margin: 0px 0px 30px;
    font-weight: bold;
}
.thank-you-content p {
    color: #888888;
    font-size: 12pt;
    line-height: 25px;
}

.go-home a{
    box-shadow: 5px 0px 30px rgba(0,0,0,0.21);
}
</style>
<div class="container">

    <input type="hidden" name="refenced_user" class="refenced_user" value="{{$user_id}}">
      
      <section class="thank-you">
        <div class="container">
          <div class="thanks">
            <div class="thank-you-content text-center">
              <h1>Bet on your health with Pp!</h1>
              <h4>You'll supercharge your willpower with Dadstrong.</h4>
              <p>Pp is having fun, losing weight, and making money in their Dadstrong - and wants you to play too!</p><br/>
            <div class="go-home">

              @if(Auth::check())
              <a href="javascript:;" class="btn btn-yellow text-dark">Join PP on Dadstrong!</a>
              @else
              <a href="#" class="btn btn-yellow text-dark acceptChallange">Join PP on Dadstrong!</a>
              @endif
            </div>
          </div>
        </div>
      </div>
    </section>

    </div>

    @endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function(){
  $(document).on('click','.acceptChallange',function(e){
    e.preventDefault();
    var refrenced_user = $('.refenced_user').val();
    $('.refrence_by').val(refrenced_user);
    $('#signupModal').modal('show');


  });
});
</script>

@endsection('scripts')    