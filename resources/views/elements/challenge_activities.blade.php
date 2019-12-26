@if(!$challenge_posts->isEmpty())
@foreach($challenge_posts as $post)

<div class="card">
  <div class="feed-top p-3">
    <div class="form-row align-items-center mb-2">
      <div class="col-auto">
        @if($post->getcreatedby->profile_image != '')
          <div class="avtar avtar-xl rounded-circle" style="background-image: url({{ asset('profile_image/'.$post->getcreatedby->profile_image)}});"></div>
        @else
          <div class="avtar avtar-xl rounded-circle" style="background-image: url({{ asset('fronttheme/images/admin-avatar.png')}});"></div>
        @endif
       
      </div>
      <div class="col">
        <div class="user_name">{{$post->getcreatedby->first_name.' '.$post->getcreatedby->last_name}}</div>
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
  <div class="text-center">
    <img src="{{config('constants.challenge_post_image_path').'/'.$post->post_image}}" class="img-fluid">
  </div>
  @endif
  @php
  $all_users = array();
  foreach($post->likes as $liked_user){
    $user_id = $liked_user->likedby->id;
    $name = $liked_user->likedby->first_name." ".$liked_user->likedby->last_name;
    $all_users[$user_id] = $name;
  }
  $loggedInUserId = (Auth::check())?Auth::user()->id:0;
  $first_username = '';
  $first_userid = '';
  $thumbs = '';
  if(isset($all_users[$loggedInUserId])){
      $first_username = "You";
      $first_userid = $loggedInUserId;
      $thumbs = 'liked';
  }else{
      $first_username = reset($all_users);
      $first_userid = key($all_users);
  }
  $total = count($all_users);
  @endphp
  <ul class="list-inline border-top border-bottom py-2 px-3 mb-0">
    <li class="list-inline-item">
      <a href="javascript:;" class="like-post {{$thumbs}}" data-post="{{base64_encode($post->id)}}" data-challenge="{{base64_encode($post->challenge_id)}}"> 
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


  @if($total > 1)
  <div class="feed_likes py-2 px-3 border-bottom">
    <a href="#">{{$first_username}}</a> and <a href="#">{{($total-1)}} others</a> likes
  </div>
  @elseif($total == 1)
  <div class="feed_likes py-2 px-3 border-bottom">
    <a href="#">{{$first_username}}</a> like
  </div>
  @endif

  @if(Auth::check())
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
  @php
  $post_comments = $post->comments;
  @endphp
  @include('elements.challenge_post_comments')
                        
</div>

@endforeach
@else
<div class="no-data"><center>There is no activity to show.</center></div>
@endif
@if ($challenge_posts->hasMorePages())
<div class="post-load-more">
  <a href="javascript:;" class="load-challenge-post" data-url="{{ $challenge_posts->appends($_GET)->nextPageUrl() }}"> <span class="blog_btns1 ">Load More</span></a>
</div>
@endif