@extends('layouts.front')
@section('title', 'All Games')
@section('content')

<script src="{{asset('js/jquery.timeago.js')}}"></script>


<section class="user-profile-section">
  <div class="container">
    @include('elements.printerror')
    <div class="user-profile-wrap">
      <div class="row">
        <div class="col-lg-3">
          <div class="user-profile-left-side">

            @if($login_user_id==Auth::user()->id && $is_logged_user==1)

            <!-- Edit Profile -->
            <div class="sn-edit-profile mb-2">
              <a href="{{url('/user_profile')}}" class="edit-link">
                <i class="fa fa-cog"></i> <span>Edit Profile</span>                
              </a>
            </div>
            <!-- /Edit Profile -->

            <!-- Profile DP -->
            <div class="sn-profile-wrap text-center mb-2">
              @if(empty(Auth::user()->profile_image))
                <div class="sn-profile-dp" style="background-image: url({{ asset('fronttheme/images/admin-avatar.png') }})" alt=""></div>
              @else
                <div class="sn-profile-dp" style="background-image: url({{ asset('/profile_image/'.Auth::user()->profile_image)}})" alt=""></div>
              @endif

          @if(!empty($Quickfacts['nick_name']))
            <div class="sn-user-name">{{ucwords($Quickfacts['nick_name'])}}
              </div>
            @else
              <div class="sn-user-name">{{ucwords(Auth::user()->first_name.' '.Auth::user()->last_name)}}</div>
              @endif
            </div>
            <!-- /Profile DP -->
            @if(!empty($Quickfacts['trying_weight_lose']))
            <!-- Quote -->
            <div class="sn-quote text-center mb-3">
              <span><i class="fa fa-quote-left"></i></span>
              <span class="sn-quote-text">{{$Quickfacts['trying_weight_lose']}}</span>
              <span><i class="fa fa-quote-right"></i></span>
            </div>
            <!-- /Quote -->
            @endif

            <!-- User-Button -->
            <div class="sn-user-button text-center" style="display: ;">
              @if(CustomHelper::checkPermission('create_new_challenge'))
               <a href="{{route('private_challenge')}}" class="btn btn-yellow mb-2 btn-block"><i class="fa fa-trophy"></i> Challenge a friend</a>
              @else
               <a href="{{route('membership')}}" class="btn btn-yellow mb-2 btn-block"><i class="fa fa-trophy"></i> Challenge a friend</a>
              @endif
                            
              <a href="{{url('/invite')}}" class="btn sn-btn-invite mb-2 btn-block"><i class="fa fa-user-plus"></i> Invite a friend</a>
            </div>
            <!-- /User Button -->
            @endif
            @if($login_user_id!==Auth::user()->id && $is_logged_user==0 )
            <!-- Profile DP -->
            <div class="sn-profile-wrap text-center mb-2">
              @if(empty($friend_detail[0]['profile_image']))
                <div class="sn-profile-dp" style="background-image: url({{ asset('fronttheme/images/g-1.jpg') }})" alt=""></div>
              @else
                <div class="sn-profile-dp" style="background-image: url({{ asset('/profile_image/'.$friend_detail[0]['profile_image'])}})" alt=""></div>
              @endif
            @if(!empty($Quickfacts['nick_name']))
            <div class="sn-user-name">{{$Quickfacts['nick_name']}}
              </div>
            @else
              <div class="sn-user-name">{{ucwords($friend_detail[0]['first_name'].' '.$friend_detail[0]['last_name'])}}
              </div>
              @endif
            </div>
            <!-- /Profile DP -->
            @if(!empty($Quickfacts['trying_weight_lose']))
            <!-- Quote -->
            <div class="sn-quote text-center mb-3">
            <span><i class="fa fa-quote-left"></i></span>
              <span class="sn-quote-text">{{$Quickfacts['trying_weight_lose']}}</span>
              <span><i class="fa fa-quote-right"></i></span>
            </div>
            <!-- /Quote -->
            @endif

            @if($requestStatus=='' or $requestStatus=='Rejected')
            <!-- User-friend-Button -->
            <div class="sn-user-button text-center" style="">
              <a href="javascript:;" class="btn btn-yellow mb-2 btn-block add_new_friend" data-userid="{{base64_encode($login_user_id)}}"><i class="fa fa-user-plus"></i> Add friend</a>
            </div>
            <!-- /User-friend-Button -->
            @endif



            @if($request_sender==1)
            <!-- User-friend-Button -->
            <div class="sn-user-button text-center" style="">
              <a href="javascript:;" class="btn btn-secondary mb-2 btn-block request-cancel1" data-userid="{{base64_encode($login_user_id)}}">Request Pending</a>
            </div>

          <div class="alert alert-danger alert-dismissible fade show request-cancel-message" role="alert" style="display:none;">
              <strong>Alert!</strong> Friend request cancel 
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
             </button>
          </div>
            <!-- /User-friend-Button -->
            @endif
            <!-- User-friend-request-Button -->
            <div class="sn-user-button text-center" style="display: none;">
              <a href="javascript:;" class="btn btn-success mb-2">Accept</a>
              <a href="javascript:;" class="btn btn-secondary mb-2">Ignore</a>
            </div>
            <!-- /User-friend-request-Button -->

            @endif

            <!-- divider -->
            <div class="sn-divider"></div>
            <!-- /divider -->

            <!-- common -->
            <div class="sn-common-wrap">
              <div class="sn-common-title">Friends @if(!$totalfriend==0)({{$totalfriend}}) @endif</div>
              <div class="sn-friends-wrap friend-list">
                 @include('elements.user_friends')                
              </div>

              <!-- <div class="sn-view-more-wrap">
                <a href="javascript:;" class="sn-view-more">Show More <i class="fa fa-caret-right"></i></a>
              </div> -->
            </div>
            <!-- /common -->

            <!-- divider -->
            <div class="sn-divider"></div>
            <!-- /divider -->

            <!-- common -->
            <div class="sn-common-wrap">
              <div class="sn-common-title">Groups  @if(!$groups_count==0)({{$groups_count}})@endif</div>
              <div class="sn-groups sn-member-groups group-list">
                @include('elements.user_groups')
              </div>
              <!-- <div class="sn-view-more-wrap">
                <a href="javascript:;" class="sn-view-more">Show More <i class="fa fa-caret-right"></i></a>
              </div> -->
            </div>
            <!-- /common -->

            <!-- divider -->
            <div class="sn-divider"></div>
            <!-- /divider -->

            @if($login_user_id==Auth::user()->id && $is_logged_user==1)
            <!-- common -->
    <div class="alert alert-success alert-dismissible fade show request-accept-message" role="alert" style="display:none;">
        <strong>Success!</strong> You are now friend
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <div class="alert alert-danger alert-dismissible fade show request-reject-message" role="alert" style="display:none;">
       <strong>Alert!</strong> Request rejected 
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
   </div>
            <div class="sn-common-wrap">
              <div class="sn-common-title">Friend Requests @if(!$total_request==0)({{$total_request}}) @endif</div>
              <div class="sn-groups friend-request-list">
                 @include('elements.user_friend_request')
              </div>
            </div>
            <!-- /common -->
            @endif


          </div>
        </div>
        
        <div class="col-lg-3 order-lg-3 mb-3 mb-lg-0">
          <div class="user-profile-right-side">

            <!-- common -->
            <div class="sn-common-wrap">
              <div class="sn-common-title">Rewards</div>
              <div class="sn-groups">
                <div class="sn-group">
                  <div class="sn-group-icon">
                    <i class="fa fa-trophy"></i>
                  </div>
                  <div class="sn-group-detail">
                    <div class="sn-group-name">You’ve Earned</div>
                    <div class="sn-group-member">
                      
                      ${{ number_format($reward_amt, 2) }}
                    </div>                    
                  </div>
                </div>
              </div>
            </div>
            <!-- /common -->

            <!-- divider -->
            <div class="sn-divider"></div>
            <!-- /divider -->



            @if(!empty($Quickfacts['favorite_health_food']) or
               !empty($Quickfacts['favorite_sinful_food']) or
               !empty($Quickfacts['exercise_method']) or
               !empty($Quickfacts['approach_weight_lose']) or
               !empty($Quickfacts['commercial_weight_loss_program']) or
               !empty($Quickfacts['current_diet_plan']) or
               !empty($Quickfacts['wearable_fitness_device']) or
               !empty($Quickfacts['fitness_exercise_app']))

            <!-- common -->
            <div class="sn-common-wrap">
              <div class="sn-common-title">Quick Facts</div>
              <div class="sn-groups">
                @if(!empty($Quickfacts['favorite_health_food']))
                <div class="sn-group">
                  <div class="sn-group-icon">
                    <i class="fa fa-heart"></i>
                  </div>
                  <div class="sn-group-detail">
                    <div class="sn-group-name">Favorite Health Food</div>
                    <div class="sn-group-member">{{$Quickfacts['favorite_health_food']}}</div>                    
                  </div>
                </div>
                @endif
                @if(!empty($Quickfacts['favorite_sinful_food']))
                <div class="sn-group">
                  <div class="sn-group-icon">
                    <i class="fa fa-star"></i>
                  </div>
                  <div class="sn-group-detail">
                    <div class="sn-group-name">Favorite Sinful Food</div>
                    <div class="sn-group-member">{{$Quickfacts['favorite_sinful_food']}}</div>                    
                  </div>
                </div>
                @endif
                @if(!empty($Quickfacts['exercise_method']))
                <div class="sn-group">
                  <div class="sn-group-icon">
                    <i class="fa fa-thumbs-o-up"></i>
                  </div>
                  <div class="sn-group-detail">
                    <div class="sn-group-name">Preferred Method of Exercise</div>
                    <div class="sn-group-member">{{$Quickfacts['exercise_method']}}</div>                    
                  </div>
                </div>
                @endif
                @if(!empty($Quickfacts['approach_weight_lose']))
                <div class="sn-group">
                  <div class="sn-group-icon">
                    <i class="fa fa-arrow-circle-o-down"></i>
                  </div>
                  <div class="sn-group-detail">
                    <div class="sn-group-name">Approach to Weight Loss</div>
                    <div class="sn-group-member">{{$Quickfacts['approach_weight_lose']}}</div>                    
                  </div>
                </div>
                @endif
                @if(!empty($Quickfacts['commercial_weight_loss_program']))
                <div class="sn-group">
                  <div class="sn-group-icon">
                    <i class="fa fa-tint"></i>
                  </div>
                  <div class="sn-group-detail">
                    <div class="sn-group-name">Weight Loss Program</div>
                    <div class="sn-group-member">{{str_replace('-'," ",$Quickfacts['commercial_weight_loss_program'])}}</div>                    
                  </div>
                </div>
                @endif
                @if(!empty($Quickfacts['current_diet_plan']))
                <div class="sn-group">
                  <div class="sn-group-icon">
                    <i class="fa fa-list-alt"></i>
                  </div>
                  <div class="sn-group-detail">
                    <div class="sn-group-name">Diet Plan</div>
                    <div class="sn-group-member">{{$Quickfacts['current_diet_plan']}}</div>                    
                  </div>
                </div>
                @endif
                @if(!empty($Quickfacts['wearable_fitness_device']))
                <div class="sn-group">
                  <div class="sn-group-icon">
                    <i class="fa fa-power-off"></i>
                  </div>
                  <div class="sn-group-detail">
                    <div class="sn-group-name">Fitness Devices</div>
                    <div class="sn-group-member">{{$Quickfacts['wearable_fitness_device']}}</div>                    
                  </div>
                </div>
                @endif

                @if(!empty($Quickfacts['fitness_exercise_app']))
                  @php
                  $fitness_exercise=$Quickfacts['fitness_exercise_app'];
                  $fitness_exercise=str_replace("]","",$fitness_exercise);
                  $fitness_exercise=str_replace("[","",$fitness_exercise);
                  $fitness_exercise=str_replace('_'," ",$fitness_exercise);
                  $fitness_exercise=str_replace('"',"",$fitness_exercise);

                  $fitness_exercise_app=explode(',',$fitness_exercise);
                  @endphp

                <div class="sn-group">
                  <div class="sn-group-icon">
                    <i class="fa fa-mobile"></i>
                  </div>
                  <div class="sn-group-detail">
                    <div class="sn-group-name">Fitness/Exercise Apps</div>
                    <div class="sn-group-member">
                      @foreach($fitness_exercise_app as $fitness)
                      <span class="badge badge-pill badge-app">{{ucfirst($fitness)}} </span>
                      @endforeach
                    </div>                    
                  </div>
                </div>
                @endif

              </div>
              <!-- <div class="sn-view-more-wrap">
                <a href="javascript:;" class="sn-view-more">Show More <i class="fa fa-caret-right"></i></a>
              </div> -->
            </div>
            <!-- /common -->


            <!-- divider -->
            <div class="sn-divider"></div>
            <!-- /divider -->

            @endif

            <!-- common -->
            <div class="sn-common-wrap">
              <div class="sn-common-title">Games @if(!$gamesChallenges_count==0)({{$gamesChallenges_count}}) @endif</div>
              <div class="sn-groups sn-member-groups game-list">
                @include('elements.user_games')
              </div>
            </div>
            <!-- /common -->


            @if($login_user_id==Auth::user()->id && $is_logged_user==1)
            @if(!$upcoming_games->isEmpty())
            
            <!-- divider -->
            <div class="sn-divider"></div>
            <!-- /divider -->
            
            <!-- common -->
            <div class="sn-common-wrap">
              <div class="sn-common-title">Upcoming Weigh-ins</div>
              <div class="sn-groups sn-member-groups upcoming-games">
                @include('elements.user_upcoming_games')                
              </div>
            </div>
            <!-- /common -->
            @endif
            @endif

          </div>
        </div>


        <div class="col-lg-6">
            <!----Post created message-------------->
            <div class="alert alert-success alert-dismissible fade show post-create-message" role="alert" style="display:none;">
              <strong>Success!</strong> Post created  successfully
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>

          <div class="user-profile-feed-side">
            @include('elements.create_comment_box')
            <div class="group-feed-box">
               <section class="group-feeds">
                  <div class="feed-cards">
                     @include('elements.userpost_activities')
                  </div>
               </section>
            </div>
          </div>
        </div>


      </div>
    </div>
  </div>
</section>


@endsection
@section('scripts')
<script type="text/javascript">
$(document).ready(function(){

      /*Cancel friend request if pending*/
   $(document).on('click','.request-cancel', function(e){
   /*get userid and groupid using attribuite*/ 
   var user_id=$(this).attr('data-userid');
   /*route url */
   if(user_id==''){
   
       alert('user not select');
   }

  var url = siteurl+'/request_cancel';

   /*Send ajax request to route
   */
     $.ajax({
               url: url,
               data: { user_id: user_id} ,
               type: 'get',
               dataType:'json',
               success: function(response) {
                if(response.status==1){
                  $('.request-cancel').hide();
                   $('.request-cancel-message').show();
                        setTimeout(function(){
                         $('.request-cancel-message').hide();
                       },5000);
                        return;
               }else if(response.status==0){
                    alert(response.message);  
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



    /*Add group member to friendlist*/
   $(document).on('click','.add_new_friend', function(e){
   /*get userid and groupid using attribuite*/ 
   var user_id=$(this).attr('data-userid');
   /*route url */
   if(user_id==''){
   
       alert('user not select');
   }
   var url = siteurl+'/groups/add_friend';
   /*Send ajax request to route
   */
     $.ajax({
               url: url,
               data: { user_id: user_id} ,
               type: 'get',
               dataType:'json',
               success: function(response) {
               
                if(response.status==1){
                   $('.add_new_friend').hide();
                   $('.add_friend-message').show();
                        setTimeout(function(){
                         $('.add_friend-message').hide();
                       },2000);
                        return;
               }else if(response.status==0){
                 $('.add_new_friend').hide();
                      $('.add_friend-message').show(response.status);
                        setTimeout(function(){
                         $('.add_friend-message').hide();
                       },2000);
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

/*Load friend requests*/
       $(document).on('click', '.load-upcomig', function(){
              $('.loader').show();
              var currObj = $(this);
                $.ajax({
                    type: 'GET',
                    url:$(this).data("url"),
                    data:{type:'upcoming'},
                    success: function (response) {
                       $(".upcoming-games").append(response);
                       currObj.parent().remove();
                       $('.loader').hide();

                    },
                    error: function (error) {
                      $('.loader').hide();
                      alert('Please refresh the page or try again');
                     
                    }
                });
              
            });

/*Load friend requests*/
       $(document).on('click', '.load-friend-request', function(){
              $('.loader').show();
              var currObj = $(this);
                $.ajax({
                    type: 'GET',
                    url:$(this).data("url"),
                    data:{type:'friend-request'},
                    success: function (response) {
                       $(".friend-request-list").append(response);
                       currObj.parent().remove();
                       $('.loader').hide();

                    },
                    error: function (error) {
                      $('.loader').hide();
                      alert('Please refresh the page or try again');
                     
                    }
                });
              
            });

/*Load friends*/
       $(document).on('click', '.load-friends', function(){
              $('.loader').show();
              var currObj = $(this);
                $.ajax({
                    type: 'GET',
                    url:$(this).data("url"),
                    data:{type:'friends'},
                    success: function (response) {
                       $(".friend-list").append(response);
                       currObj.parent().remove();
                       $('.loader').hide();

                    },
                    error: function (error) {
                      $('.loader').hide();
                      alert('Please refresh the page or try again');
                     
                    }
                });
              
            });



/*Load game*/
       $(document).on('click', '.load-games', function(){
              $('.loader').show();
    
              var currObj = $(this);

                $.ajax({
                    type: 'GET',
                    url:$(this).data("url"),
                    data:{type:'games'},
                    success: function (response) {
                       $(".game-list").append(response);
                       currObj.parent().remove();
                       $('.loader').hide();

                    },
                    error: function (error) {
                      $('.loader').hide();
                      alert('Please refresh the page or try again');
                     
                    }
                });
              
            });

/*Load Groups*/
       $(document).on('click', '.load-groups', function(){
         //var url = siteurl+'/groups/add_friend';
              $('.loader').show();
              var currObj = $(this);
                $.ajax({
                    type: 'GET',
                    url:$(this).data("url"),
                    data:{type:'groups'},
                    success: function (response) {
                       $(".group-list").append(response);
                       currObj.parent().remove();
                       $('.loader').hide();
                       
                    },
                    error: function (error) {
                      $('.loader').hide();
                      alert('Please refresh the page or try again');
                     
                    }
                });

              
              
            });




  $(document).on('click','.request-reply',function(e){
  var request_id =$(this).attr('data-id');
   var value =$(this).attr('data-value');
   var url = siteurl+'/groups/friend_request_accept';
  // $('.loader').show();
          $.ajax({
               url: url,
               data: { status:value,request_id:request_id} ,
               type: 'post',
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
               dataType:'json',
               success: function(response) {
                if(response.status==1){
                 //$('.request-'+request_id).hide();
                 //$('.Member_'+id).hide();
                    if(response.message=='Accepted'){
                  $('.request-accept-message').show();
                        setTimeout(function(){
                           $('.request-accept-message').hide();
                       },3000);
                        return;
                      }


                      if(response.message=='Rejected'){
                     //    $('.request-'+request_id).hide();
                         $('.request-reject-message').show();
                        setTimeout(function(){
                           $('.request-reject-message').hide();
                       },3000);
                        return;

                      }
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


   $(document).on('click', '.comment-link', function(){
             $(this).parents('.card').find('input[name="comment"]').focus();
         });
   
   /* This will post comment under User  post and save it */
         $(document).on('click', '.post-comment', function(){
               $('.loader').show();
               $.ajaxSetup({
                 headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                   }
               });
               var currObj = $(this);
               var comment = $(this).parents('.add_comment').find('input[name="comment"]').val();
               var post_id = $(this).attr('data-post');
   
               if(comment =='')
               {
                   $(this).parents('.card').find('input[name="comment"]').focus();
                    $('.loader').hide();
                   return;
                   }
               $.ajax({
                   url: siteurl+'/save_post_comment',
                   type: 'POST',              
                   data: {post_id, comment},
                   dataType : 'json',
                   success: function(result)
                   {
                     if(result.status == 1){
                       currObj.parents('.add_comment').find('input[name="comment"]').val("");
                       var commentHtml = '<div class="all_comment py-2 px-3 border-top"><div class="form-row"><a href="{{url('/profile',Auth::user()->user_code)}}"><div class="col-auto"><div class="avtar avtar-md rounded-circle" style="background-image: url('+result.data.profile_image+');"></div></a></div><div class="col"><a href="{{url('/profile',Auth::user()->user_code)}}"><div class="user_name">'+result.data.name+'</div></a><div>'+result.data.comment+'</div></div></div></div>';
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


            /* This code is used for like User post and saved it */
         $(document).on('click', '.like-post', function(){
               $('.loader').show();
               $.ajaxSetup({
                 headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                   }
               });
               var currObj = $(this);
               var post_id = $(this).attr('data-post');
               $.ajax({
                   url: siteurl+'/save_user_post_like/'+post_id,
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
   
   

      /* This code is used for Load more  Group post */
   $(document).on('click', '.load-user-post', function(){

    

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


});

</script>
@stop