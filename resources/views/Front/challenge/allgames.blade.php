@extends('layouts.front')
@section('title', 'All Games')
@section('content')
<div class="container">

<div class="search_section text-center my-5">
   <h5>FIND A GAME THAT’S RIGHT FOR YOU -OR <strong>START YOUR OWN! </strong></h5>
    <form action="{{route('allgames')}}"> 
	   <div class="input-group game_list_search my-4 ">
	      <input type="text" name="search" class="form-control search-bar" aria-label="Amount (to the nearest dollar)" placeholder="Type your search here" value="{{ isset($_GET['search'])?$_GET['search']:''}}">
	         <a href="#"> <span class=""><i class="fa fa-search" aria-hidden="true"></i></span></a>
	   </div>
	</form>
</div>
	<div id="listings">
	@include('elements.gameslist')
	</div>



<div class="start_more my-5 text-center">
  @if(CustomHelper::checkPermission('create_new_challenge'))
  <a href="{{route('private_challenge')}}"><img  src="{{ asset('fronttheme/images/start-own.png') }}"></a>
  @elseif(Auth::check())
  <a href="{{route('membership')}}"><img  src="{{ asset('fronttheme/images/start-own.png') }}"></a>
  @else
  <a href="javascript:;" class="join-now-game"><img  src="{{ asset('fronttheme/images/start-own.png') }}"></a>
  @endif
</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
  $(function(){

    $(document).on('click', '#view-more-listings', function(){
      $('.loader').show();
      var currObj = $(this);
        $.ajax({
            type: 'GET',
            url:$(this).data("url"),
            success: function (response) {
               $("#listings").append(response);
               currObj.parent().remove();
               $('.loader').hide();
            },
            error: function (error) {
              $('.loader').hide();
              alert('Please refresh the page or try again');
             
            }
        });
      
    });
    

  });

</script>
@stop