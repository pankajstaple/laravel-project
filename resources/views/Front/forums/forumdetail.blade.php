@extends('layouts.front')
@section('title', 'All Forums')
@section('content')
    <div class="container">
      <section class="forums-wrap py-5">
        <div class="forums-list">
          @if(!empty($forum))
          <div class="forums-item card mb-3">
              <div class="card-body">
                <div class="row">
                  @if(!empty($forum->user->profile_image))
                  <div class="col-auto">
                    <div class="avtar avtar-xl rounded-circle" style="background-image: url({{ asset('fronttheme/images/user.png')}});">
                    </div>
                  </div>
                  @endif
                  <div class="col">
                    <div>
                      <h3>{{ $forum->subject }}</h3>
                      <p class="mb-0">by {{ $forum->user->first_name .' '.$forum->user->last_name}} on {{$forum->created_at->format('F j, Y')}}</p>
                    </div>
                  </div>  
                  <div class="col-auto">
                    <input type="hidden" name="forum-id" id="forum-id" value="{{base64_encode($forum->id)}}">
                    <button type="button" class="btn btn-vote vote-forum @if($currentuserlike==1) {{'voted'}} @endif" id="vote-forum" data-forumid="{{base64_encode($forum->id)}}">
                      <i class="fa fa-star mr-2" aria-hidden="true"></i>{{ $currentuserlike==1 ? 'Voted' : 'Vote'}}</button>
                  </div>                
                </div>
              </div>
          </div>   
          <div class="forums-content mb-3">{{$forum->content}} </div> 
        </div>
        <div class="row">
          <div class="col-lg-8">
              <div class="card">
              <ul class="list-inline border-bottom py-2 px-3 mb-0">
                <li class="list-inline-item">
                  <b>{{ $forum->commentscount_count }} Answers</b>
                 
                </li>
              </ul>
               <div class="alert alert-success alert-dismissible fade show comment-message" role="alert" style="display:none;">
                            <strong>Success!</strong> Comment posted successfully
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>


              <div class="add_comment py-2 px-3 parent-comment" >
    <form class="form-vertical" action="{{route('ajax_save_forum_comment')}}" method="post" role="form"
                  id="AddCommentForm" enctype="multipart/form-data">
                                @csrf
                <div class="form-row align-items-center leave-comment">
                  <div class="col-auto">
                    <div class="avtar avtar-md rounded-circle" style="background-image: url({{$profileimage}});"></div>
                  </div>                  
                  <div class="col cm-icon-box">
                     <input type="hidden" name="forum_id" value="{{$forum->id}}">
                    <input type="text" name="comment" placeholder="Write a comment..." class="form-control comment">
                    <div class="add_photo">
                      <label class="camera_icon" for="comment_image">
                        <input type="file" name="comment_image" class="comment_image sr-only" value="" id="comment_image">
                        <i class="fa fa-camera" aria-hidden="true"></i>
                      </label>
                    </div>

                  </div>

                  <div class="col-auto">
                    <button type="button" class="btn btn-yellow comment-btn">Post</button>
                  </div> 

                </div>
               </form> 
              </div>
              <!-- preview-box -->
              <div class="comment_img_preview_wrap" style="display: none;">
                <div class="img_preview_box">
                    <img id="comment_img_preview" src="" alt="" class="img-fluid" />
                </div>
                <div class="img_preview_content">
                  <label for="comment_image" class="label_preview">Change Image</label>
                  <p>Image forment must be (jpg, jpeg, png)</p>
                  <div class="remove_image text-danger">Remove Image</div>
                </div>
              </div>
              <!-- /preview-box -->
              <div class="all_comment py-2 px-3 border-top ">
                    <div class="comment-section " id="comment-listings">
                      @include('elements.forumcomments')
                    </div>
              </div>  


            </div>
          </div>  
          <div class="col-lg-4">
            <div class="card">
              <div class="card-body">
                <h5>Tags</h5>
                <div class="tags mb-2">
                  @if(!empty($forum->tags))
                  @foreach($forum->tags as $tag)
                  <a href="javascript:;"><span class="tag">{{$tag['name']}}</span></a>
                 @endforeach 
                 @endif
                </div>
                <div class="row">
                  <div class="col">
                    <div class="d-flex flex-direction-row f-bullet-list flex-wrap">
                      <div class="w-100">{{ $forum->commentscount_count }} Answers</div>
                      <div class="w-100">{{ $forum->votescount_count}} Votes</div>
                      <div class="w-100">{{ $forum->total_views}} Views</div>
                    </div>
                  </div>                        
                </div>

              </div>
            </div>
          </div>  
        </div>
@endif
      </section>
    </div>
 
@endsection
@section('scripts')
    <script type="text/javascript">
      
$(document).ready(function(){
$(".comment-btn").click(function(){
            var formObj = $(this).closest('form');
             /* Save Coupon code */
            $('.comment-message').hide();
            var comment = formObj.find('.comment').val();
            //var comment_image = formObj.find('comment_image').val();
            var url = formObj.attr('action');
          //  var data = formObj.serialize();
            if($.trim(comment) == ""){
                 $('.comment').focus();
                return false;
            }
                $('.loader').show();
            var data1 = new FormData(document.getElementById('AddCommentForm'));
            $.ajax({
                url: url,
                data: data1,
                type: 'post',
                dataType:'json',
                cache: false,
                 contentType: false,
                 processData: false,
                success: function(response) {
                    if(response.status==1){
                        $('.comment_img_preview_wrap').hide();
                        $('.comment-message').show();
                        formObj.find('.comment').val("");
              var commentHTML='<div class="form-row border-bottom py-2"><div class="col-auto"><div class="avtar avtar-md rounded-circle" style="background-image: url('+response.data.profileimage+');"></div></div><div class="col"><div class="user_name">'+response.data.name+'</div><div>'+response.data.body+'</div>';

              if(response.data.comment_image){
                commentHTML += '<img class="commentimage img-fluid" src='+response.data.comment_image+'>';
              }

              commentHTML += '<div class="row"><div class="col"><ul class="list-inline mb-0"><li class="list-inline-item">'+response.data.date+'</li>  <li class="list-inline-item">|</li>    <li class="list-inline-item"><span class="like liked comment-like" data-commentid="'+response.last_id+'">Like </span></li><li class="list-inline-item">|</li><li class="list-inline-item"><a href="javascript:;" class="reply-btn" data-id="'+response.last_id+'">Reply </a></li> </ul></div></div></div></div>';


                 $(".comment-section").prepend(commentHTML);  
                 setTimeout(function(){
                            $('.comment-message').hide();
                             window.location.reload(1);
                        },2000);

                    }else{
                        $('.comment-message').html(response.message);
                    }
                    $('.loader').hide();

                },
                error: function(error){
                    $('.loader').hide();
                    if(error.status === 422 ){
                        var err = error.responseJSON;
                        $.each(err.errors, function (i, v) {
                            $('input[name='+i+']').after('<p class="field-error order-10">'+v+'</p>');
                        });
                        $("html, body").animate({ scrollTop: 0 }, "fast");
                    }else{
                          alert('Please refresh the page or try again');
                    }
                }
            });
      });

        /* Reply to comment */
        $(document).on('click', '.reply-btn', function(e){
          var parent_id = $(this).attr('data-id');
          //alert(parent_id);
          $(this).closest('.comment_box').find('.reply-div').show();
          $(this).closest('.comment_box').find('.reply-div').find('input[name="parent_id"]').val(parent_id);
        });

        /* Save replied comment with parent comment id */
        $(document).on('click','.reply-submit', function(){
             $('.loader').show();
          var comment__id = $(this).data('parent_id');     
          var formObj = $(this).closest('form');
            
            var url = formObj.attr('action');
          var parentObj = $(this).parents('.replay_box');
          var comment = parentObj.find('.reply-comments').val();
          var parent_id = parentObj.find('input[name="parent_id"]').val();
          var forum_id = $(this).attr('data-forumid');
          if($.trim(comment) == ''){
            $('.reply-comments').focus();
            return;
          }
          var data1 = new FormData(document.getElementById('ReplyCommentForm_'+comment__id));
          $.ajax({
                url: url,
                data:  data1,
                type: 'post',
                dataType:'json',
                cache: false,
                 contentType: false,
                 processData: false,
                success: function(response) {
                 // alert(response.status);
                    if(response.status==1){
                      $('.reply_img_preview_wrap').hide();
                      $('.reply-comments').val("");
                        $('.comment-message').show();
                        var commentHtml = '<div class="comment_box_child px-5"><div class="form-row py-2 mb-2"><div class="col-auto"><div class="avtar avtar-md rounded-circle" style="background-image: url('+response.data.profileimage+');"></div></div><div class="col"><div class="user_name">'+response.data.name+'</div><div>'+response.data.body+'</div>';

                        if(response.data.comment_image){
                commentHtml += '<div class="replyimage py-3"> <img class="commentimage img-fluid" src='+response.data.comment_image+'> </div>';
              }

                        commentHtml+='<div class="row"><div class="col"><ul class="list-inline mb-0"><li class="list-inline-item">'+response.data.date+'</li><li class="list-inline-item"></li></ul></div></div></div></div></div>';
                        parentObj.after(commentHtml);
                        parentObj.find('.reply-div').find('input[name="comments"]').val("");
                        parentObj.find('.reply-div').hide();
                        setTimeout(function(){
                            $('.comment-message').hide();
                            $('.reply-div').hide();
                        },2000);
                    }else{
                        $('.comment-message').html(response.message);
                    }
                    $('.loader').hide();
                },
                error: function(error){
                    $('.loader').hide();
                    if(error.status === 422 ){
                        var err = error.responseJSON;
                        $.each(err.errors, function (i, v) {
                            $('input[name='+i+']').after('<p class="field-error order-10">'+v+'</p>');
                        });
                        $("html, body").animate({ scrollTop: 0 }, "fast");
                    }else{
                          alert('Please refresh the page or try again');
                    }
                }
            });
        });

        
      /*votes  for forum */
       $('.vote-forum').on('click', function(e){
            $('.loader').show();
            var forumid = $(this).attr('data-forumid');
            var commentid = '0';
            if($.trim(forumid) == ""){
                return false;
            }
            var url = siteurl+'/forum/ajax_save_forum_like/'+forumid+'/'+commentid;
            $.ajax({
                url: url,
                type: 'get',
                dataType:'json',
                success: function(response) {
                 // alert(response);
                    if(response.status == 1){
                      $(".vote-forum").addClass("voted");
                      location.reload();
                    }else{
                      $(".vote-forum").removeClass("voted");
                      location.reload();
                    }
                  $('.loader').hide();
                },
                error: function(error){
                    $('.loader').hide();
                    if(error.status == 401){
                        $('#signinModal').modal('show');
                        return;
                    }else{
                        alert('Please refresh the page or try again');
                    }
                }
            });
        });
         /*Like forum comments */
         /*
       $('.comment-like').on('click', function(e){
            $('.loader').show();
            var commentid =  $(this).attr('data-commentid');
             var forumid = $('#forum-id').val();
            if($.trim(commentid) == ""){
                return false;
            }
            var url = siteurl+'/forum/ajax_save_forum_like/'+forumid+'/'+commentid;
            $.ajax({
                url: url,
                type: 'get',
                dataType:'json',
                success: function(response) {
                   $('.loader').hide();
                  //alert(response.total_likes);
                    if(response.status == 1){
                    $('.like-show-'+commentid).html('Like('+response.total_likes+')');
                     
                    $(this).attr('data-commentid').focus();
                 
                    }else{
                       $('.like-show-'+commentid).html('Like('+response.total_likes+')');
                    }
                  
                },
                error: function(error){
                    $('.loader').hide();
                    if(error.status == 401){
                        $('#signinModal').modal('show');
                        return;
                    }else{
                        alert('Please refresh the page or try again');
                    }
                }
            });
        });
        */

                        /*Like forum comments --------*/
       $(document).on('click', '.comment-like', function(e){
            $('.loader').show();
            var commentid =  $(this).attr('data-commentid');
             var forumid = $('#forum-id').val();
            if($.trim(commentid) == ""){
                return false;
            }
            var url = siteurl+'/forum/ajax_save_forum_like/'+forumid+'/'+commentid;
            $.ajax({
                url: url,
                type: 'get',
                dataType:'json',
                success: function(response) {
                    $('.loader').hide();
                  //alert(response.total_likes);
                    if(response.status == 1){
                        $('.like-show-'+commentid).html('Like('+response.total_likes+')');
                   
                    $(this).attr('data-commentid').focus();
                    
                    }else{
                       $('.like-show-'+commentid).html('Like('+response.total_likes+')');
                    }
                  
                },
                error: function(error){
                    $('.loader').hide();
                    if(error.status == 401){
                        $('#signinModal').modal('show');
                        return;
                    }else{
                        alert('Please refresh the page or try again');
                    }
                }
            });
        });

/*Load blog forum comments*/
       $(document).on('click', '.load-blog-comments', function(){
              $('.loader').show();
              var currObj = $(this);
                $.ajax({
                    type: 'GET',
                    url:$(this).data("url"),
                    success: function (response) {
                       $("#comment-listings").append(response);
                       currObj.parent().remove();
                       $('.loader').hide();

                    $(".reply_image").change(function() {
                    var comment__id = $(this).data('parent_id');     

                    // alert(comment__id);       
                    readURLS(this,comment__id);
                    // $(this).closest('.reply-div').find('.reply_img_preview_wrap').show();

                    });



                    },
                    error: function (error) {
                      $('.loader').hide();
                      alert('Please refresh the page or try again');
                     
                    }
                });
              
            });

          /*Perview comment image */
            function readURL(input) {
                if (input.files && input.files[0]) {
                  var reader = new FileReader();
                  reader.onload = function(e) {
                    $('.comment_img_preview_wrap').show();
                  $('#comment_img_preview').attr('src', e.target.result);
                  }
                  reader.readAsDataURL(input.files[0]);
                }
            }
             $("#comment_image").change(function() {
                readURL(this);
             });

             /*Remove comment image after select*/
              $(document).on('click', '.remove_image', function(){
                  $('#comment_image').remove();
                   $('.comment_img_preview_wrap').remove();
              });



              /*Remove reply image after select*/
              $(document).on('click', '.remove_reply_image', function(){
                 var comment__id = $(this).data('parent_id');     
                  $('#reply_image_'+comment__id).val('');
                  $('#img_preview_'+comment__id).hide();
              });


                /* Perview reply image */
            function readURLS(input,comment__id) {
                if (input.files && input.files[0]) {
                  var reader = new FileReader();
                  reader.onload = function(e) {
                
                    
                      $('#img_preview_'+comment__id).show();
                   $('#reply_img_preview_'+comment__id).attr('src', e.target.result);
                  }
                  reader.readAsDataURL(input.files[0]);
                }
            }

             $(".reply_image").change(function() {
                var comment__id = $(this).data('parent_id');            
                readURLS(this,comment__id);
               // $(this).closest('.reply-div').find('.reply_img_preview_wrap').show();
              
             });

     });
        /*Automatic refresh page after 10 sec */
      function autoRefreshPage(){
          window.location = window.location.href;
         }
        //setInterval('autoRefreshPage()', 10000);
    </script>
  @stop