<div class="card">
  <div class="feed-top p-3">
    <div class="form-row align-items-center mb-2">
      <div class="col-auto">
        @if(Auth::check() && (Auth::user()->profile_image != ''))
        a
         <a href="{{url('/profile',Auth::user()->user_code)}}"> <div class="avtar avtar-xl rounded-circle" style="background-image: url({{ asset('profile_image/'.Auth::user()->profile_image)}});"></div></a>
        @else
          <a href="{{url('/profile',Auth::user()->user_code)}}"><div class="avtar avtar-xl rounded-circle" style="background-image: url({{ asset('fronttheme/images/admin-avatar.png')}});"></div></a>
        @endif
      
      </div>
      <div class="col">
        <a href="{{url('/profile',Auth::user()->user_code)}}"><div class="user_name">{{$post->getcreatedby->first_name.' '.$post->getcreatedby->last_name}}</div></a>
        <div class="feed_time"><time class="timeago" datetime="{{$post->created_at->format('Y-m-d H:i:s')}}"></time></div>
      </div>
      <!--<div class="col-auto">
        <div class="dropdown">
          <a class="btn btn-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #888;">
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </div>
      </div> -->
    </div>
    <div class="feed_short-description">
      {{$post->post_content }}
    </div>
  </div>
  @if($post->post_image != '')
  <div>
    <img src="{{config('constants.challenge_post_image_path').'/'.$post->post_image}}" class="img-fluid">
  </div>
  @endif
  <ul class="list-inline border-top border-bottom py-2 px-3 mb-0">
    <li class="list-inline-item">
      <a href="javascript:;" class="like-post" data-post="{{base64_encode($post->id)}}" data-challenge="{{base64_encode($post->challenge_id)}}"> 
        <i class="fa fa-thumbs-up" aria-hidden="true"></i> Like
      </a>
    </li>
    <li class="list-inline-item">
      &nbsp;
    </li>
    <li class="list-inline-item">
      <a href="javascript:;" class="comment-link">
        <i class="fa fa-comment-o" aria-hidden="true"></i> Comment
      </a>
    </li>
  </ul>
  @if(Auth::check())
  a
  <div class="add_comment py-2 px-3">
    <div class="form-row align-items-center comment-box">
      <div class="col-auto">
        @if(Auth::check() && (Auth::user()->profile_image != ''))
          <div class="avtar avtar-md rounded-circle" style="background-image: url({{ asset('profile_image/'.Auth::user()->profile_image)}});"></div>
        @else
          <div class="avtar avtar-md rounded-circle" style="background-image: url({{ asset('fronttheme/images/admin-avatar.png')}});"></div>
        @endif
      </div>
      <div class="col">
        <input type="text" name="comment" placeholder="Write a comment..." class="form-control">
      </div>
      <div class="col-auto">
        <button type="button" class="btn btn-yellow post-comment" data-post="{{base64_encode($post->id)}}" data-challenge="{{base64_encode($post->challenge_id)}}">Post</button>
      </div>
    </div>
  </div>
  @endif                            
</div>