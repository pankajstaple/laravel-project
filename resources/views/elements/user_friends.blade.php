@if(!$friends->isEmpty())
  <div class="sn-friends">
    @foreach($friends  as $friend)
      @if($friend->from_user_id == $login_user_id)
        <div class="sn-friend-wrap">
          <a href="{{url('profile',$friend['touser']->user_code)}}">
            <div class="sn-friend sn-friend-dp" data-toggle="tooltip" data-placement="top" title="{{ucfirst($friend['touser']->first_name.' '.$friend['touser']->last_name)}}" @if(empty($friend['touser']->profile_image)) style="background-image: url({{ asset('fronttheme/images/g-1.jpg') }});" @else style="background-image: url({{ asset('/profile_image/'.$friend['touser']->profile_image)}});"  @endif></div>
          </a>
        </div>
      @endif
      @if($friend->to_user_id == $login_user_id)
        <div class="sn-friend-wrap">
          <a href="{{url('profile',$friend['fromuser']->user_code)}}">
            <div class="sn-friend sn-friend-dp" data-toggle="tooltip" data-placement="top" title="{{ucfirst($friend['fromuser']->first_name.' '.$friend['fromuser']->last_name)}}" @if(empty($friend['fromuser']->profile_image)) style="background-image: url({{ asset('fronttheme/images/g-1.jpg') }});" @else style="background-image: url({{ asset('/profile_image/'.$friend['fromuser']->profile_image)}});"  @endif></div>
          </a>
        </div>
      @endif
    @endforeach

    @if ($friends->hasMorePages())
      <div class="sn-view-more-wrap friend-load-more">
        <a href="javascript:;" class="sn-view-more load-friends" data-url="{{ $friends->appends($_GET)->nextPageUrl() }}">Show More <i class="fa fa-caret-right"></i></a>
      </div>
    @endif
  </div>
  @else
    @if($login_user_id!==Auth::user()->id && $is_logged_user==0 )
    <div class="sn-group">
      <div class="sn-group-detail">
        <div class="sn-group-member">There have no friends</div>
      </div>     
    </div>
    @else 
    <div class="sn-group">
      <div class="sn-group-detail">
        <div class="sn-group-member">You have no friends</div>
      </div>     
    </div>
  @endif

@endif
