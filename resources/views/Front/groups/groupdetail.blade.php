@extends('layouts.front')
@section('title', 'Group Detail')
@section('content')
<script src="{{asset('js/jquery.timeago.js')}}"></script>
@if(empty($groupdetail->banner_image))
<div class="sub-header py-5 mb-5" style="background-image: url({{ asset('fronttheme/images/group-cover.jpg')}});height: 300px;">
   &nbsp;
</div>
@else
<div class="sub-header py-5 mb-5" style="background-image: url({{config('constants.group_img_path').'/'.$groupdetail->banner_image}});height: 300px;">
   &nbsp;
</div>
@endif
<div class="container">
   <section class="group-profile mb-5">
      <div class="row align-items-center">
         <div class="col-6">
            <div class="group-profile-box" style="align-items: flex-end;">
               @if(empty($groupdetail->profile_image))
               <div class="avtar avtar-xxl rounded-circle mr-3" style="background-image: url({{ asset('fronttheme/images/g-8.jpg')}});"></div>
               @else
               <div class="avtar avtar-xxl rounded-circle mr-3" style="background-image: url({{config('constants.group_img_path').'/'.$groupdetail->profile_image}});">
               </div>
               @endif
               <div class="group-profile-info mb-4">
                  @if(isset($groupdetail->title))
                  <h2>{{$groupdetail->title}}</h2>
                  @endif
                  @if (Auth::check())
                  @if($already_member=='0')
                  <a href="javascript:;" class="btn btn-black mb-2 join_group" data-userid="{{base64_encode(Auth::user()->id)}}" data-groupid="{{base64_encode($groupdetail->id)}}">Join Group</a>
                  @endif
                  @endif
               </div>
            </div>
         </div>
         <div class="col-6 text-right">
            <a class="btn btn-yellow">@if(!empty($groupdetail->members_count)){{$groupdetail->members_count}}@endif {{$groupdetail->members_count>1?'Members':'Member'}}

            </a>
         </div>
      </div>
   </section>
   <section class="group-feed-section">
      <div class="row">
         <div class="col-lg-8">
            <div class="group-feed-box">
               @if (Auth::check())
        <!----Post created message-------------->
 <div class="alert alert-success alert-dismissible fade show post-create-message" role="alert" style="display:none;">
                  <strong>Success!</strong>Post created  successfully
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
          <!------------------>
               <div class="alert alert-success alert-dismissible fade show group-join-message" role="alert" style="display:none;">
                  <strong>Success!</strong> Group join successfully
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               @include('elements.create_comment_box')
               @endif
               <section class="group-feeds">
                  <h6>New Activity</h6>
                    <div class="alert alert-danger alert-dismissible fade show feed-cards-error" role="alert" id="feed-cards-error" style="display:none;">
                  <strong>Error!</strong> Invalid Member,Please join group first
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>

                  <div class="feed-cards">

                     @include('elements.group_activities')
                  </div>
               </section>
            </div>
         </div>
         <div class="col-lg-4">
            <div class="side-bar">
               <div class="group_about mb-5">
                  <h5>About</h5>
                  @if(!empty($groupdetail->about))
                  <p>{!!html_entity_decode($groupdetail->about) !!}</p>
                  @else
                  <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                  @endif
                  <h6>Founded: @if(isset($groupdetail->created_at)){{$groupdetail->created_at->format('d-m-y')}}@endif</h6>
                  <h6>Founder: @if(isset($groupdetail->getcreatedby)){{ucfirst($groupdetail->getcreatedby['first_name']).' '.ucfirst($groupdetail->getcreatedby['last_name'])}}@endif</h6>
               </div>
               @if (Auth::check())
               <div class="alert alert-success alert-dismissible fade show comment-message" role="alert" style="display:none;">
                  <strong>Success!</strong> Request sent successfully
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>

               <div class="alert alert-danger alert-dismissible fade show message-alredy-friend" role="alert" style="display:none;">
                  <strong>Alert!</strong> You are already friend
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>

               <div class="alert alert-danger alert-dismissible fade show message-alredy-request" role="alert" style="display:none;">
                  <strong>Alert!</strong> Friend request already sent
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>

               <div class="add_member">
                  <h5>Search Member</h5>
                  <input type="hidden" name="" class="group_id" value="{{$groupdetail->id}}">
                  <input type="text" name="text" placeholder="Enter name" class="form-control search_member">
                  <div class="members_list py-3">
                     <div class="members_list_inner" style="max-height: 560px;overflow-y:auto;overflow-x:hidden;"></div>
                     <!---button type="button" class="btn">See more</button--->
                  </div>
               </div>
               @endif
            </div>
         </div>
      </div>
   </section>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
   $( document ).ready(function() {
   
   $(".timeago").timeago();
   memberlist();
   });
         
         $(document).on('click', '.comment-link', function(){
             $(this).parents('.card').find('input[name="comment"]').focus();
         });
   
   
   /* This will post comment under group post and save it */
         $(document).on('click', '.post-comment', function(){
               $('.loader').show();
               $.ajaxSetup({
                 headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                   }
               });
               var currObj = $(this);
               var comment = $(this).parents('.add_comment').find('input[name="comment"]').val();
               var group_post_id = $(this).attr('data-post');
               var group_id = $(this).attr('data-group');
               if(comment =='')
               {
                   $(this).parents('.card').find('input[name="comment"]').focus();
                    $('.loader').hide();
                   return;
                   }
               $.ajax({
                   url: siteurl+'/save_group_comment',
                   type: 'POST',              
                   data: {group_post_id,group_id, comment},
                   dataType : 'json',
                   success: function(result)
                   {
                       if(result.status == 0){
                           var target = $('.group-feed-box');
                                if( target.length ) {
                                    event.preventDefault();
                                    $('html, body').stop().animate({
                                        scrollTop: target.offset().top
                                    }, 1000);
                                }

                            $('.feed-cards-error').show();
                            setTimeout(function(){
                           $('.feed-cards-error').hide();
                           },5000);
   
                           //currObj.parents('.add_comment').after("<font color='red';>Unknown Member,Please join group first</font>");
                          
   
   
                       currObj.parents('.add_comment').find('input[name="comment"]').val("");
                            $('.loader').hide();
                            return false;
                       }
                     if(result.status == 1){
                       currObj.parents('.add_comment').find('input[name="comment"]').val("");
                       var commentHtml = '<div class="all_comment py-2 px-3 border-top"><div class="form-row"><div class="col-auto"><div class="avtar avtar-md rounded-circle" style="background-image: url('+result.data.profile_image+');"></div></div><div class="col"><div class="user_name">'+result.data.name+'</div><div>'+result.data.comment+'</div></div></div></div>';
                       currObj.parents('.add_comment').after(commentHtml);
                       
                     }
                    
                     $('.loader').hide();
                   },
                   error: function(data)
                   {
                     $('.loader').hide();
                     alert('Please refresh the page or try again');
                   }
               });
         });
   
   
   /*
   $(document).on('keyup','.search_member', function(e){
    /*get input field value and groupid */ /*
   var value=$(this).val();
   var group_id=$('.group_id').val();
   var url = siteurl+'/groups/search_users';
   if(value==''){
   
   }
   var currentRequest = null;    
   
           $.ajax({
               url: url,
               data: { search: value, group_id:group_id} ,
               type: 'get',
               dataType:'html',
               beforeSend : function(){           
                   if(currentRequest != null) {
                   currentRequest.abort();
                   }
               },
               success: function(response) {
             $('.members_list_inner').html(response);
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

 $(document).on('keyup','.search_member', function(e){
    /*get input field value and groupid */
   var value=$(this).val();
   var group_id=$('.group_id').val();
   var url = siteurl+'/groups/search_members';
   if(value==''){
   memberlist();
   }
   var currentRequest = null;    
   
           $.ajax({
               url: url,
               data: { search: value, group_id:group_id} ,
               type: 'get',
               dataType:'html',
               beforeSend : function(){           
                   if(currentRequest != null) {
                   currentRequest.abort();
                   }
               },
               success: function(response) {
             $('.members_list_inner').html(response);
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


function memberlist(){
    /*get input field value and groupid */
   var group_id=$('.group_id').val();
   var url = siteurl+'/groups/memberlist';
   if(group_id==''){
   alert();
   }
   var currentRequest = null;    
   
           $.ajax({
               url: url,
               data: {group_id:group_id} ,
               type: 'get',
               dataType:'html',
               success: function(response) {
             $('.members_list_inner').html(response);
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
       
   };

   /*Add group member to friendlist*/
   $(document).on('click','.add_new_friend', function(e){
   /*get userid and groupid using attribuite*/ 
   var group_id=$(this).attr('data-groupid');
   var user_id=$(this).attr('data-userid');
   var id =$(this).attr("id");
   /*route url */
   if(user_id==''){
   
       alert('user not select');
   }
   var url = siteurl+'/groups/add_friend';
   /*Send ajax request to route
   */
     $.ajax({
               url: url,
               data: { user_id: user_id, group_id:group_id} ,
               type: 'get',
               dataType:'json',
               success: function(response) {
               
                if(response.status==1){
                   $('.Member_'+id).hide();
                   $('.comment-message').show();
                        setTimeout(function(){
                           $('.comment-message').hide();
                       },2000);
                        return;
               }
                else if(response.status==0){
                      $('.message-alredy-friend').show();
                        setTimeout(function(){
                           $('.message-alredy-friend').hide();
                       },5000);                    
               }
                else if(response.status==2){
                    $('.message-alredy-request').show();
                        setTimeout(function(){
                           $('.message-alredy-request').hide();
                       },5000); 
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

   
   /* Add member in group after search the members
   */
   /*
   $(document).on('click','.add_new_member', function(e){
   
   /*get userid and groupid using attribuite*/ 
   /*
   var group_id=$(this).attr('data-groupid');
   var user_id=$(this).attr('data-userid');
   var id =$(this).attr("id");
   /*route url *//*
   if(user_id==''){
   
       alert('user not select');
   }
   var url = siteurl+'/groups/add_group_member';
   /*Send ajax request to route
   *//*
     $.ajax({
               url: url,
               data: { user_id: user_id, group_id:group_id} ,
               type: 'get',
               dataType:'json',
               success: function(response) {
                if(response.status==1){
                   $('.Member_'+id).hide();
                   $('.comment-message').show();
                        setTimeout(function(){
                           $('.comment-message').hide();
                       },2000);
               }else{
                      alert('already member');
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
   /*
   Join group function 
   for cuurent user
   */
   
   $(document).on('click','.join_group', function(e){
   
   /*get userid and groupid using attribuite*/
   var group_id=$(this).attr('data-groupid');
   var user_id=$(this).attr('data-userid');
   /*route url */
   if(user_id==''){
   
       alert('user not select');
   }
   var url = siteurl+'/groups/add_group_member';
   /*Send ajax request to route
   */
     $.ajax({
               url: url,
               data: { user_id: user_id, group_id:group_id} ,
               type: 'get',
               dataType:'json',
               success: function(response) {
                if(response.status==1){
                   $('.join_group').hide();
                   $('.group-join-message').show();
                        setTimeout(function(){
                           $('.group-join-message').hide();
                       },5000);
               }else{
                      alert('already member');
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
   /* This code is used for Load more  Group post */
   $(document).on('click', '.load-group-post', function(){
           $('.loader').show();
           var currObj = $(this);
             $.ajax({
                 type: 'GET',
                 url:$(this).data("url"),
                 success: function (response) {
                    $(".feed-cards").append(response);
                   $(".timeago").timeago();
                    currObj.parents('.post-load-more').remove();
                    $('.loader').hide();
                 },
                 error: function (error) {
                   $('.loader').hide();
                   alert('Please refresh the page or try again');
                  
                 }
             });
           
         });
   
   /* This code is used for like Group post and saved it */
         $(document).on('click', '.like-post', function(){
               $('.loader').show();
               $.ajaxSetup({
                 headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                   }
               });
               var currObj = $(this);
               var group_post_id = $(this).attr('data-post');
               var group_id = $(this).attr('data-group');
               $.ajax({
                   url: siteurl+'/save_group_post_like/'+group_post_id+'/'+group_id,
                   type: 'GET',              
                   dataType : 'json',
                   success: function(result)
                   {
                       if(result.status == 0){
                        var target = $('.group-feed-box');
                                if( target.length ) {
                                    event.preventDefault();
                                    $('html, body').stop().animate({
                                        scrollTop: target.offset().top
                                    }, 1000);
                                }
                           $('.feed-cards-error').show();
                            setTimeout(function(){
                           $('.feed-cards-error').hide();
                           },5000);
   
   
                       }
                     if(result.status == 1){
                       if(result.likestatus == 1)
                         currObj.addClass('liked');
                       else
                         currObj.removeClass('liked');
                     }
                     $('.loader').hide();
                   },
                   error: function(data)
                   {
                     $('.loader').hide();
                     alert('Please refresh the page or try again');
                   }
               });
         });
   
</script>
@stop