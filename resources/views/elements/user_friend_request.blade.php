@if (Auth::check())
  @if(!$friendrequests->isEmpty())
     @foreach($friendrequests  as $friendrequest)
<div class="sn-group sn-friend-request-wrap request-{{base64_encode($friendrequest['id'])}}">
    <a href="{{url('/profile',$friendrequest->fromuser->user_code)}}">
      <div class="sn-group-image sn-friend-request-img" @if(empty($friendrequest['fromuser']->profile_image)) style="background-image: url({{ asset('fronttheme/images/g-1.jpg') }});" @else style="background-image: url({{ asset('/profile_image/'.$friendrequest['fromuser']->profile_image)}});"  @endif></div>
    </a>
    <div class="sn-group-detail">
      <a href="{{url('/profile',$friendrequest->fromuser->user_code)}}"><div class="sn-group-name">{{ucfirst($friendrequest['fromuser']->first_name.' '.$friendrequest['fromuser']->last_name)}}</div></a>
      <!-- User-friend-request-Button -->
      <div class="sn-user-button">
        <a href="javascript:;" class="btn btn-success mb-2 btn-sm Accept request-reply" data-id="{{base64_encode($friendrequest['id'])}}" data-value="Accepted">Accept</a>
        <a href="javascript:;" class="btn btn-secondary mb-2 btn-sm reject request-reply" data-id="{{base64_encode($friendrequest['id'])}}" data-value="Rejected">Ignore</a>
      </div>
      <!-- /User-friend-request-Button -->                   
    </div>
  </div>
  @endforeach
  @if ($friendrequests->hasMorePages())
    <div class="sn-view-more-wrap friend-request-load-more">
        <a href="javascript:;" class="sn-view-more load-friend-request" data-url="{{$gamesChallenges->appends($_GET)->nextPageUrl()}}" data-url="{{ $friendrequests->appends($_GET)->nextPageUrl() }}">Show More <i class="fa fa-caret-right"></i></a>
      </div>

  @endif
  @else
    <div class="sn-group">
      <div class="sn-group-detail">
        <div class="sn-group-member">You have no friend request</div>
      </div>     
    </div>
  @endif
@endif