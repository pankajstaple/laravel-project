@if($post_comments)
@foreach($post_comments as $comment)

   @if(isset($login_user_id) && isset($is_logged_user))
  @if($login_user_id==Auth::user()->id && $is_logged_user==1)
<div class="all_comment py-2 px-3 border-top">
  <div class="form-row">
    <a href="{{url('/profile',$comment->getcommenteddby->user_code)}}">
    <div class="col-auto">
      @if(isset($comment->getcommenteddby->profile_image) && ($comment->getcommenteddby->profile_image != ''))
        <div class="avtar avtar-md rounded-circle" style="background-image: url({{ asset('profile_image/'.$comment->getcommenteddby->profile_image)}});"></div>
      @else
        <div class="avtar avtar-md rounded-circle" style="background-image: url({{ asset('fronttheme/images/admin-avatar.png')}});"></div>
      @endif
    </div>
    </a>
    <div class="col">
      <a href="{{url('/profile',$comment->getcommenteddby->user_code)}}">
      <div class="user_name">{{$comment->getcommenteddby->first_name." ".$comment->getcommenteddby->last_name}}</div></a>

      <div>{{$comment->comment}}</div> 
    </div>
  </div>
</div> 
@endif
  @if($login_user_id!==Auth::user()->id && $is_logged_user==0)
  <div class="all_comment py-2 px-3 border-top">
  <div class="form-row">
    <a href="{{url('/profile',$comment->getcommenteddby->user_code)}}">
    <div class="col-auto">
      @if(isset($comment->getcommenteddby->profile_image) && ($comment->getcommenteddby->profile_image != ''))
        <div class="avtar avtar-md rounded-circle" style="background-image: url({{ asset('profile_image/'.$comment->getcommenteddby->profile_image)}});"></div>
      @else
        <div class="avtar avtar-md rounded-circle" style="background-image: url({{ asset('fronttheme/images/admin-avatar.png')}});"></div>
      @endif
    </div>
    </a>
    <div class="col">
      <a href="{{url('/profile',$comment->getcommenteddby->user_code)}}">
      <div class="user_name">{{$comment->getcommenteddby->first_name." ".$comment->getcommenteddby->last_name}}</div></a>

      <div>{{$comment->comment}}</div> 
    </div>
  </div>
</div> 
  @endif
@else
<div class="all_comment py-2 px-3 border-top">
  <div class="form-row">
    <a href="{{url('/profile',$comment->getcommenteddby->user_code)}}">
    <div class="col-auto">
      @if(isset($comment->getcommenteddby->profile_image) && ($comment->getcommenteddby->profile_image != ''))
            <a href="{{url('/profile',$comment->getcommenteddby->user_code)}}">
<div class="avtar avtar-md rounded-circle" style="background-image: url({{ asset('profile_image/'.$comment->getcommenteddby->profile_image)}});"></div></a>
      @else
           <a href="{{url('/profile',$comment->getcommenteddby->user_code)}}">
 <div class="avtar avtar-md rounded-circle" style="background-image: url({{ asset('fronttheme/images/admin-avatar.png')}});"></div></a>
      @endif
    </div>
    </a>
    <div class="col">
      <a href="{{url('/profile',$comment->getcommenteddby->user_code)}}">
      <div class="user_name">{{$comment->getcommenteddby->first_name." ".$comment->getcommenteddby->last_name}}</div></a>

      <div>{{$comment->comment}}</div> 
    </div>
  </div>
</div> 
@endif
@endforeach
@endif