@extends('layouts.front')
@section('title', 'Blog Detail')
@section('content')
<div class="container">
<div class="row">

                <!-- Post Content Column -->
                <div class="col-lg-8 mt-4">

                  {!! CustomHelper::display_ads('Top') !!}

                    <!-- Preview Image -->
                    @if(empty($blogdetail->blog_image))
                    	<img class="img-fluid rounded" src="{{ asset('fronttheme/images/no-blog.png') }}" alt="no image">
                    @else
                    	<img class="img-fluid rounded" src="{{ config('constants.blog_img_path').'/'.$blogdetail->blog_image }}" alt="">
                    @endif

                 

                    <!-- Post Content -->
                    <p class="lead">{{ $blogdetail->title}}</p>
                    <div class="post_details mt-2">
                         <ul>
                            <li>POST BY {{strtoupper($blogdetail->getcreatedby->first_name." ".$blogdetail->getcreatedby->last_name)}}</li>
                            <li>{{ \Carbon\Carbon::parse($blogdetail->created_at)->format('F d, Y')}}</li>
                            <li><a href="javascript:;" class="like-blog" data-blogid="{{base64_encode($blogdetail->id)}}"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
                        
                            <span data-count="{{$blogdetail->total_likes}}" href="javascript:;" class="total-likes" style="display: {{ ($blogdetail->total_likes > 0)?'':'none' }}">
                            ({{$blogdetail->total_likes}})LIKES
                            </span></li>
                         </ul>
                         <ul>
                            <li>{{$seo_tags}}</li>
                         </ul>
                      </div>
                    <div class="details_boxx">
                        <p>{!! $blogdetail->content!!}</p>                        
                    </div>

                     
                    <hr>
                    <div class="social_icon_blog">
                         <ul>
                            <li><a class="facebook-share-button fb" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(url()->full()); ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a></li>
                            <li><a class="twitt" href="https://twitter.com/intent/tweet?url=<?php echo urlencode(url()->full()); ?>"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a></li>
                         </ul>
                      </div>
                    @if(!Auth::user())
                    <!-- Comments Form -->
                    <div class="login_section text-right mb-3">
                        <a href="javascript:;" class="sign-popup">Sign in to comment</a>
                    </div>
                    @endif
                    @auth
                    <div class="card my-4 leave-comment">
                        <div class="alert alert-success alert-dismissible fade show comment-message" role="alert" style="display:none;">
                            <strong>Success!</strong> Comment posted successfully
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <h5 class="card-header">Leave a Comment:</h5>
                        <div class="card-body">
                            <form class="form-vertical" action="{{route('ajax_save_blog_comment')}}" method="post" role="form"
                  id="AddCommentForm">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" name="blog_id" value="{{$blogdetail->id}}">
                                    <textarea class="form-control comment" rows="3" placeholder="Type your comment here" name="comment"></textarea>
                                </div>
                                <button type="button" class="btn btn-primary blog_btns comment-btn">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                    @endauth
<!-- Single Comment -->
                   <div class="form-group reply-div" style="display:none;">
                       <input type="hidden" name="parent_id" value="">
                       <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Add your reply.." rows="3" name="comment"></textarea>
                       <button type="button" data-blogid="{{$blogdetail->id}}" class="btn btn-primary blog_btns mt-3 reply-submit">SUBMIT</button>
                   </div>
                   
                   @if(!$blogcomments->isEmpty())
                    <div class="comment_section " id="comment-listings">
                      @include('elements.blogcomments')
                    </div>
                   @endif
                  <!--<div class="media mb-4 comments_reply">
                     <img class="d-flex mr-3" src="{{ asset('fronttheme/images/blog-comment.png')}}" alt="">
                     <div class="media-body">
                        <div class="reply-section clearfix">
                           <span class="mt-0 name-left">John Doe</span>
                          
                        </div>
                        <p class="blog-comments my-1">AUGUST 31, 2018<span> 06:23 pm</span></p>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                     </div>
                  </div>-->

                

                    <!-- Comment with nested comments -->
                    
                </div>

                <!-- Sidebar Widgets Column -->
                <div class="col-lg-4">

                    <!-- Search Widget -->
                    <div class="card my-4">
                        <h5 class="card-header">Search</h5>
                        <div class="card-body search_box">
                            <form action="{{route('allblogs')}}"> 
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Type your search here">
                           
                 <!--  <button class="btn btn-secondary" type="button">Go!</button> -->
                 <i class="fa fa-search" aria-hidden="true"></i>
                
                            </div>
                            </form>
                        </div>
                        </div>

                        <!-- add-section -->
                        {!! CustomHelper::display_ads('Right') !!}

                        <!-- add-section -->

                        <!-- newsletter -->
                            @if(isset($page_adsense) && $page_adsense->value != '')
                            <div class="advertising-wrap text-center">
                            @php echo $page_adsense->value; @endphp
                            </div>
                            @endif

                        <!--  -->

                    <!-- Categories Widget -->
                    <div class="card my-4">
                        <h5 class="card-header">Categories</h5>
                        <div class="card-body text-left  px-3 py-0 ">
                            <div class="row">
                                <div class="col-lg-12 px-0">
                                    <ul class="list-unstyled mb-0 side_category">
                                        @foreach($blogcategory as $cat)
                        <li>
                            <a href="{{route('allblogs').'?category='.base64_encode($cat->id)}}">{{$cat->name}}</a>
                        </li>
                        @endforeach
                                    </ul>
                                </div>
                                

                            </div>

                        </div>

                    </div>

                 
                    <!--<div class="card my-4  px-0">
                        <h5 class="card-header">Archives</h5>
                        <div class="card-body px-0 py-0">
                          <ul class="list-unstyled mb-0 side_category">
                                        <li>
                                            <a href="#">October 2018</a>
                                        </li>
                                        <li>
                                            <a href="#">September 2018</a>
                                        </li>
                                        <li>
                                            <a href="#">August 2018</a>
                                        </li>
                                         <li>
                                            <a href="#">July 2018</a>
                                        </li>
                                        <li>
                                            <a href="#">June 2018</a>
                                        </li>
                                        <li>
                                            <a href="#">May 2018</a>
                                        </li>
                                         <li>
                                            <a href="#">Older</a>
                                        </li>
                                    </ul>
                        
                        </div>
                    </div> -->
                </div>

                <!-- Side Widget -->

            </div>
            </div>


<div class="modal fade newsletterModal" id="adsense-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close newsletterModalClose" data-dismiss="modal" aria-label="Close"><img src="{{ asset('fronttheme/images/close-icon.png') }}" alt="Close" /></button>
         @if(isset($page_adsense) && $page_adsense->value != '')
                <div class="advertising-wrap text-center podcast-adsense" id="podcast-adsense">
             @php echo $page_adsense->value; @endphp
               </div>
             @endif
      </div>
    </div>
  </div>
</div>

@if(isset($page_adsense_script) && $page_adsense_script->value != '')
@php echo $page_adsense_script->value; @endphp
@endif
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
    if ($(window)) {      
        var poppy = localStorage.getItem('myPopup');
        //if(!poppy){
            setTimeout(function(){
            $('#adsense-model').modal('show'); 
            },5000); // 1000 to load it after 1 second from page load
            localStorage.setItem('myPopup','true');
        //}         
    }
    });

    $(function(){
        $('.comment-btn').on('click', function(e){
            var formObj = $(this).closest('form');
             /* Save Coupon code */
            $('.loader').show();
            $('.comment-message').hide();
            var comment = formObj.find('.comment').val();
            var url = formObj.attr('action');
            var data = formObj.serialize();
            if($.trim(comment) == ""){

                formObj.find('textarea[name="comment"]').focus();
                return false;
            }
            $.ajax({
                url: url,
                data: data,
                type: 'post',
                dataType:'json',
                success: function(response) {
                    if(response.status==1){
                        $('.comment-message').show();
                        formObj.find('.comment').val("");
                        var commentHtml = '<div class="media mb-4"> <img class="d-flex mr-3" src="'+response.data.profileimage+'" alt=""> <div class="media-body"> <div class="reply-section clearfix"> <span class="mt-0 name-left">'+response.data.name+'</span><a href="#"> <span class="mt-0 reply-right">Reply</span></a> </div><p class="blog-comments my-1">'+response.data.date+'<span> '+response.data.time+'</span></p>'+response.data.comment+' </div></div>';
                        var lengthComment = $(document).find('.comment_section').length;
                        if(lengthComment == 0){
                          $(document).find('.leave-comment').after('<div class="comment_section " id="comment-listings"></div>');  
                        }
                        $(document).find('.comment_section').prepend(commentHtml);
                        setTimeout(function(){
                            $('.comment-message').hide();
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
            var replySectionClone = $('.reply-div:first').clone();
            replySectionClone.find('input[name="parent_id"]').val(parent_id);
             $("#comment-listings").find('.reply-div').remove();
            $(this).closest('.comment').after(replySectionClone);
            $("#comment-listings").find('.reply-div').show();
            $("#comment-listings").find('.reply-div').find('textarea').focus();
        });
        /* Save replied comment with parent comment id */
        $(document).on('click','.reply-submit', function(){
          var parentObj = $(this).parents('.reply-div');
          var commentText = parentObj.find('textarea[name="comment"]').val();
          var parent_id = parentObj.find('input[name="parent_id"]').val();
          var blog_id = $(this).attr('data-blogid');
          if($.trim(commentText) == ''){
            parentObj.find('textarea[name="comment"]').focus();
            return;
          }
          $.ajax({
                url: siteurl+'/blog/ajax_save_blog_comment',
                data: {parent_id:parent_id, blog_id:blog_id,comment:commentText, type: 'reply', _token: $('meta[name="csrf_token"]').attr('content')},
                type: 'post',
                dataType:'json',
                success: function(response) {
                    if(response.status==1){
                        $('.comment-message').show();
                        var commentHtml = '<div class="media mb-4 comments_reply"> <img class="d-flex mr-3" src="'+response.data.profileimage+'" alt=""> <div class="media-body"> <div class="reply-section clearfix"> <span class="mt-0 name-left">'+response.data.name+'</span></div><p class="blog-comments my-1">'+response.data.date+'<span> '+response.data.time+'</span></p>'+response.data.comment+' </div></div>';
                        parentObj.after(commentHtml);
                        parentObj.remove();
                        setTimeout(function(){
                            $('.comment-message').hide();
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

        /*Like comment and update total likes for blog */
        $('.like-blog').on('click', function(e){
            $('.loader').show();
            var blogid = $(this).attr('data-blogid');
            if($.trim(blogid) == ""){
                return false;
            }
            var url = siteurl+'/blog/ajax_save_blog_like/'+blogid;
            $.ajax({
                url: url,
                type: 'get',
                dataType:'json',
                success: function(response) {
                    if(response.status == 1){
                        $('.total-likes').html("("+response.total_likes+")LIKES");
                        if(response.total_likes > 0){
                            $('.total-likes').show();
                        }else{
                            $('.total-likes').hide();
                        }
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
