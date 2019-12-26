   @extends('layouts.front')
@section('content')
<style type="text/css">
  .table-group_list th,
  .table-group_list td {
    vertical-align: top !important;
}
.table-games_list,
.table-group_list {
    table-layout: auto;
}
@media only screen and (max-width: 575px) {
  .h-mob {
    display: none;
  }
}
</style>

    <div class="container my-5">

    @include('elements.printerror')

      <div class="card">
        <!--  -->
        <div class="row">
          <div class="col-md-3">
            <div class="left-side-nav">
              <div class="nav flex-row flex-md-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <!-- <a class="nav-link active" id="profile-tab" data-toggle="pill" href="#profile" role="tab" aria-controls="profile" aria-selected="true"><i class="fa fa-user" aria-hidden="true"></i>Profile</a> -->


                <a class="nav-link active userProfileTab" id="profile-tab" data-toggle="pill" href="#profile1" role="tab" aria-controls="profile" aria-selected="true"><i class="fa fa-user" aria-hidden="true"></i><span class="h-mob">Profile</span></a>


                <a class="nav-link" id="games-tab" data-toggle="pill" href="#games" role="tab" aria-controls="games" aria-selected="false"><i class="fa fa-gamepad" aria-hidden="true"></i><span class="h-mob">Games</span></a>
                <!--<a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="fa fa-hand-pointer-o" aria-hidden="true"></i>Points</a>-->
                <a class="nav-link" id="groups-tab" data-toggle="pill" href="#groups" role="tab" aria-controls="groups" aria-selected="false"><i class="fa fa-users" aria-hidden="true"></i><span class="h-mob">Groups</span></a>
                <a class="nav-link" id="notification-tab" data-toggle="pill" href="#notification" role="tab" aria-controls="notification" aria-selected="false"><i class="fa fa-bell" aria-hidden="true"></i><span class="h-mob">Notification</span></a>
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <div class="right-side-content px-3 pl-md-0">
              <div class="tab-content" id="v-pills-tabContent">
                
                <div class="tab-pane fade show active userProfileTabDiv" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <form class="profileSettingsForm" id="profileSettingsForm" action="{{ url('/save_profile_changes') }}" >
                    <div class="content-right-bar">
                      <h3 class="my-2">Public profile <span class="text-muted ml-1">(These optional settings will appear on your public profile.)</span></h3>
                      <div class="w-lg-100 mx-auto">
                        <div class="row">
                          <!-- Input -->
                          <div class="col-lg-6">
                            <div class="row">
                            <div class="col-md-12 mb-1">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Nickname</label>
                                <input type="text" class="form-control" id="nick_name" aria-describedby="emailHelp" placeholder="Type your nick name(optional)" name="nick_name" value="{{$userProfileSettings['nick_name']}}">
                                <input type="hidden" name="login_user" value="{{$loggedInUserId}}"> 

                              </div>
                            </div>
                            <div class="col-md-12 mb-1">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Why are you trying to lose weight?</label>
                                <input type="text" class="form-control" id="weight_lose" aria-describedby="emailHelp" placeholder="Why are you dietbetting now? (This is optional)" name="trying_weight_lose" value="{{$userProfileSettings['trying_weight_lose']}}">
                              </div>
                            </div>
                            <div class="col-md-12 mb-1">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Favorite Health Food</label>
                                <input type="text" class="form-control" id="favorite_health_food" aria-describedby="emailHelp" placeholder="(optional)" name="favorite_health_food" value="{{$userProfileSettings['favorite_health_food']}}">
                              </div>
                            </div>
                            <div class="col-md-12 mb-1">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Favorite Sinful Food</label>
                                <input type="text" class="form-control" id="favorite_sinful_food" aria-describedby="emailHelp" placeholder="(optional)" name="favorite_sinful_food" value="{{$userProfileSettings['favorite_sinful_food']}}">
                              </div>
                            </div>
                            <div class="col-md-12 mb-1">
                              <div class="form-group">
                                <label for="exampleInputEmail1">My Preferred Method of Exercise</label>
                                <input type="text" class="form-control" id="exercise_method" aria-describedby="emailHelp" placeholder="(optional)" name="exercise_method" value="{{$userProfileSettings['exercise_method']}}">
                              </div>
                            </div>
                            <div class="col-md-12 mb-1">
                              <div class="form-group">
                                <label for="exampleInputEmail1">My Approach to Weight Loss</label>
                                <input type="text" class="form-control" id="approach_weight_lose" aria-describedby="emailHelp" placeholder="(optional)" name="approach_weight_lose" value="{{$userProfileSettings['approach_weight_lose']}}">
                              </div>
                            </div>
                          </div>

                          </div>
                          <!-- End Input -->
                          <!-- Input -->
                          <div class="col-lg-6">

                            <div class="row">

                            <div class="col-md-12 mb-1">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Long Term Goal Weight</label>
                                <label class="switch">
                               

                                  <input type="checkbox" name="long_term_goal_weight" value="1" <?php if($userProfileSettings['long_term_goal_weight'] == '1' ) {  echo 'checked="checked"' ;} ?>>
                                  <span class="slider round"></span>
                                </label>
                                <span class="text-muted">This weight only appears if you've chosen to share your weight with others.</span>
                              </div>
                            </div>
                              
                            <div class="col-md-12 mb-1">
                              <div class="form-group">
                                <label for="exampleFormControlSelect1">Which commercial weight loss program (if any) are you currently following?</label>
                                <?php 
                                    $commercial_weight_loss_program = config('constants.commercial_weight_loss_program');
                                  ?>
                                <select class="form-control" id="commercial_weight_loss_program" name="commercial_weight_loss_program">
                                  <option value="">Select one</option>
                                  @foreach ($commercial_weight_loss_program as $key => $value)
                                    <option value="{{$key}}" <?php if($userProfileSettings['commercial_weight_loss_program'] == $key ) {  echo 'selected="selected"' ;} ?> >{{$value}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>

                            <div class="col-md-12 mb-1">
                              <div class="form-group">
                                <label for="exampleFormControlSelect1">Which diet plan(if any)are you currently following?</label>
                                <?php 
                                    $current_diet_plan = config('constants.current_diet_plan');
                                ?>
                                <select class="form-control" id="current_diet_plan" name="current_diet_plan">
                                  <option value="">Select one</option>
                                  @foreach ($current_diet_plan as $key => $value)
                                    <option value="{{$key}}" <?php if($userProfileSettings['current_diet_plan'] == $key ) {  echo 'selected="selected"' ;} ?> >{{$value}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>

                            <div class="col-md-12 mb-1">
                              <div class="form-group">
                                <label for="exampleFormControlSelect1">Which wearable fitness device (any)do you currently use?</label>
                                <?php 
                                    $wearable_fitness_device = config('constants.wearable_fitness_device');
                                ?>
                                <select class="form-control" id="wearable_fitness_device" name="wearable_fitness_device">
                                  <option value="">Select one</option>
                                  @foreach ($wearable_fitness_device as $key => $value)
                                    <option value="{{$key}}" <?php if($userProfileSettings['wearable_fitness_device'] == $key ) {  echo 'selected="selected"' ;} ?> >{{$value}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>


                            <div class="col-md-12">
                              <div class="form-group mb-0">
                                <label for="exampleFormControlSelect1">Which fitness or exercise apps (if any) do you currently use?</label>
                              </div>
                            </div>

                            <?php 
                             $fitness_exercise_app = config('constants.fitness_exercise_app');
                             $fitness = json_decode($userProfileSettings['fitness_exercise_app']);

                            ?>

                            @foreach ($fitness_exercise_app as $key => $value)
                            <div class="col-md-6 mb-1">
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input fitness_exercise_app" name="fitness_exercise_app[]" id="customCheck-{{$key}}" value="{{$key}}"  <?php

                                if(!empty($fitness)) {
                                  if(in_array($key, $fitness)) {
                                    echo 'checked = checked';
                                  }
                                }

                                ?> >
                                <label class="custom-control-label" for="customCheck-{{$key}}">{{$value}}</label>
                              </div>
                            </div>
                            @endforeach

                            <div class="col-md-6 mb-1">
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input dont_use_fitness_exercise_app" id="customCheck9" name="fitness_exercise_app[]" value="none"  <?php 
                                if(!empty($fitness)) {
                                  if(in_array('none', $fitness)) {
                                    echo 'checked = checked';
                                  }
                                }

                                ?> >
                                <label class="custom-control-label" for="customCheck9">I don't use any app</label>
                              </div>
                            </div>

                            <!-- <div class="col-md-6 mb-1">
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck10">
                                <label class="custom-control-label" for="customCheck10">Other</label>
                              </div>
                            </div> -->
                          </div>
                          </div>

                          <div class="col-lg-12 my-4">
                            <button type="submit" class="btn btn-yellow" name="save_profile_changes" id="save_profile_changes">Save Changes</button>
                          </div>

                        </div>
                      </div>
                    </div>
                  </form>
                </div>

                <div class="tab-pane fade" id="games" role="tabpanel" aria-labelledby="games-tab">
                  <div class="content-right-bar">
                    <h3 class="my-2">Previous Games</h3>                      
                  </div>
                  <div class="table-responsive">
                    <table class="table mt-2 table-games_list">
                      <thead>
                        <tr>
                          <th scope="col">Name (ID)</th>
                          <th scope="col">Type</th>
                          <th scope="col">Bet</th>
                          <th scope="col">Pot</th>
                          <th scope="col">Start/End</th>
                          <th scope="col">Status</th>
                          <th scope="col">Action</th>
                          <!--   -->
                        </tr>
                      </thead>
                      <tbody>

                      @if(!empty($gamesChallenges))
                        @foreach($gamesChallenges as $games=>$challange)
                        <tr>
                          <td>{{$challange['get_game_challange']['title']}}</td>
                          <td>{{$challange['get_game_challange']['challenge_access']}}</td>
                          <td>${{$challange['get_game_challange']['amount']}}</td>
                          <td>
                          <?php
                          $challengeId = $challange['challenge_id'];
                          $totalPlayers = isset($playerCount[$challengeId])?$playerCount[$challengeId]:0;
                          echo "$".$pot = $totalPlayers * $challange['get_game_challange']['amount'];
                          ?>
                          </td>
                          <td>{{date("M d  ",strtotime($challange['get_game_challange']['start_date']))}} - {{date("M d  ",strtotime($challange['get_game_challange']['end_date']))}}</td>
                          <td>{{$challange['get_game_challange']['status']}}</td>
                          <td><a href="@if($challange['get_game_challange']['status'] == 'Active'){{url('/')}}/weighin/{{base64_encode($challengeId)}} @else javascript:void('0'); @endif" class="Weigh-in btn btn-yellow">Add Weigh-In</a></td>
                          <!-- <td><a href="#">Promote</a></td> -->
                        </tr>
                        @endforeach
                        @else
                        <tr><td colspan="7" align="center">No record found</td></tr>
                      @endif
                        
                      </tbody>
                    </table>
                  </div>
                </div>

                <!--<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">

                  <div class="content-right-bar">
                    <h3 class="my-2">Points</h3>                      
                  </div>

                  <section class="grey-bg p-3">
                    <h3>Your Points</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus lorem ac vulputate ultricies. Mauris a suscipit metus, ac auctor massa. Sed sagittis nunc in nunc laoreet, nec interdum sapien auctor. Ut vel convallis tellus.</p>

                    <div class="card border-0 rounded-0 mb-5">
                      <div class="card-header yellow-bg points-header rounded-0">
                        Points Wallet
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-5">
                            <h5 class="card-title">WayBetter Points: 0.00</h5>
                          </div>
                          <div class="col-md-2 text-center">
                            <img src="images/wallet-icon.png" class="img-fluid">
                          </div>
                          <div class="col-md-5">
                            <h5 class="card-title">Available for Payout: 0.00</h5>
                            <a href="#" class="btn btn-paypal w-100 rounded-0">Payout via PayPal</a>                            
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="d-flex flex-column align-items-center mb-4">
                      <h3>You have not received any points.</h3>
                      <a href="#" class="btn btn-game rounded-0">Join a Game</a>
                    </div>

                  </section>

                </div> -->

                <div class="tab-pane fade" id="groups" role="tabpanel" aria-labelledby="groups-tab">

                  <div class="content-right-bar">
                    <h3 class="my-2">Groups</h3>                      
                  </div>

                  <div class="table-responsive">
                    <table class="table mt-2 table-group_list">
                      <thead>
                        <tr>
                          <th scope="col">Group Name</th>
                          <th scope="col">Image</th>
                          <th scope="col">Start Date</th>
                          <th scope="col">Status</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>

                      @if(!empty($userGroups))
                        @foreach($userGroups as $group => $groupName)
                        <tr class="group_member_row_{{$groupName['id']}}">
                          <td>{{$groupName['group_name']['title']}}</td>
                          <td><img src = "{{config('constants.group_img_path').'/thumbnail/'.$groupName['group_name']['profile_image']}}" width="50" height="50"></td>
                          <td>{{date("M d Y ",strtotime($groupName['created_at']))}}</td>
                          <td class="group_status_{{$groupName['id']}}">{{$groupName['join_status']}}</td>
                          <td class="sub_unsubscribe_{{$groupName['id']}}">
                          @if($groupName['join_status']=='Yes')
                          <a href="#" class="subUnsubscribeGroup" subUnsb="unsubscribe" group_member_id="{{$groupName['id']}}">Unsubscribe</a>
                          @else
                          <a href="#" class="subUnsubscribeGroup" subUnsb="subscribe" group_member_id="{{$groupName['id']}}" >Subscribe</a>
                          @endif
                          </td>
                        </tr>
                        @endforeach
                        @else
                        <tr><td colspan="5" align="center"><a class="btn btn-yellow" href="{{url('/groups')}}">Create New Group</a></td></tr>

                      @endif
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="tab-pane fade" id="notification" role="tabpanel" aria-labelledby="notification-tab">

                  <div class="content-right-bar">
                    <h3 class="my-2">Notification</h3>                      
                  </div>

                  <section class="grey-bg p-3">

                    <h5>Your Notification</h5>

                    <div class="card-notifications notification_ajax_div">
                    @include('Front.users.notification_ajax')
                   
                    </div>                 

                  </section>

                </div>


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  
@endsection


@section('scripts')

<script type="text/javascript">
$(document).ready(function(){



    var hash = window.location.hash;
    if(hash){
      
        $(".nav-link").removeClass('active');
        // $(".nav-link").addClass('active');
        var elementID = hash.replace('#', '');
        $("#"+elementID+'-tab').click();
        // $("#"+elementID).show();
    }
    //  else {
    //     $('#tabs div:first').show();
    //     $('#tabs ul li:first').addClass('active');
    // }
    



    $(document).on('click','#save_profile_changes',function(e){
      e.preventDefault();
      var data = $('form.profileSettingsForm').serialize();
      var url = $('form.profileSettingsForm').attr('action');
      var token = $('meta[name="csrf_token"]').attr('content');
      $('.loader').show();
      $.ajax({
          url: url,
          data: data,
          type: 'post',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
          success: function(data) {
            $('.loader').hide();
            $('.success-message').show();

            $('html, body').animate({ scrollTop: 0 }, 'slow', function () {
            });

            window.setTimeout(function() {
              $('.success-message').hide();
            }, 3000);
          },
          error: function(error){
            $('.loader').hide();
          }
        });
    });

    $(document).on('click','.userProfileTab',function(e){
      e.preventDefault();
      $('div.tab-pane').removeClass('active show');
      var site_url = "{{url('/')}}/"+"profile_settings";
      var login_user = $('input[name="login_user"]').val();
      $.ajax({
          url: site_url,
          data: {'login_user':login_user},
          type: 'get',
          dataType: 'JSON',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
          success: function(data) {
            $('.fitness_exercise_app').prop("checked", false);
            $('.dont_use_fitness_exercise_app').prop("checked", false);


            if(data.fitness_exercise_app !=''){
              var obj = jQuery.parseJSON( data.fitness_exercise_app );
              $.each(obj, function(i, val){
               $("input[value='" + val + "']").prop('checked', true);
              });
            }

            $('input[name="nick_name"]').val(data.nick_name);
            $('input[name="trying_weight_lose"]').val(data.trying_weight_lose);
            $('input[name="favorite_health_food"]').val(data.favorite_health_food);
            $('input[name="favorite_sinful_food"]').val(data.favorite_sinful_food);
            $('input[name="exercise_method"]').val(data.exercise_method);
            $('input[name="approach_weight_lose"]').val(data.approach_weight_lose);

            //alert(data.commercial_weight_loss_program);
            if(data.long_term_goal_weight ==1){
              $('input[name="long_term_goal_weight"]').prop("checked", true);
            }else{
              $('input[name="long_term_goal_weight"]').prop("checked", false);
            }

            $('select[name="commercial_weight_loss_program"] option')
             .removeAttr('selected')
             .filter('[value="'+data.commercial_weight_loss_program+'"]')
                 .prop('selected', true);

            $('select[name="current_diet_plan"] option')
             .removeAttr('selected')
             .filter('[value="'+data.current_diet_plan+'"]')
                 .prop('selected', true);

            $('select[name="wearable_fitness_device"] option')
             .removeAttr('selected')
             .filter('[value="'+data.wearable_fitness_device+'"]')
                 .prop('selected', true);

            $('div.userProfileTabDiv').addClass('active show');

          },
          error: function(error){
          }
        });
    });
    //dont_use_fitness_exercise_app

    $(document).on('click','.dont_use_fitness_exercise_app',function(e){
      $('.fitness_exercise_app').prop('checked', false);
    });

    $(document).on('click','.fitness_exercise_app',function(e){
      $('.dont_use_fitness_exercise_app').prop('checked', false);
    });



    //Subscribe/Unsubscribe group

    //subUnsubscribeGroup
    $(document).on('click','.subUnsubscribeGroup',function(e){
      e.preventDefault();
      var group_member_id = $(this).attr('group_member_id');
      var subUnsub = $(this).attr('subunsb');
      var site_url = "{{url('/')}}/"+"sub_unsubscribe/group";
      $('.loader').show();
      $.ajax({
          url: site_url,
          data: {'group_member_id':group_member_id,'subUnsub':subUnsub},
          type: 'post',
          dataType: 'JSON',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
          success: function(data) {
            $('.loader').hide();
            if(data.yesNo=='Yes'){
              var subUnsub = 'Unsubscribe';
              var subUnsbAttr= 'unsubscribe';
            }else{
              var subUnsub = 'Subscribe';
              var subUnsbAttr= 'subscribe';
            }
            var SubUnSubCribeTd = '<a href="#" class="subUnsubscribeGroup" subunsb="'+subUnsbAttr+'" group_member_id="'+group_member_id+'">'+subUnsub+'</a>';
            $('.group_status_'+group_member_id).html(data.yesNo);
            $('.sub_unsubscribe_'+group_member_id).html(SubUnSubCribeTd);

            $('.success-message').show();

            $('html, body').animate({ scrollTop: 0 }, 'slow', function () {
            });

            window.setTimeout(function() {
              $('.success-message').hide();
            }, 3000);
            

          },
          error: function(error){
            $('.loader').hide();
          }
        });






    });

    
    $(document).on('click','.pagination li a',function(e){
      e.preventDefault();
      var page_no=$(this).attr('href').split('page=')[1]; 
      var uri="{{url('notification_paginate')}}";
      $.ajax({
            url :uri+'?page=' + page_no,  
        }).done(function (data) {
            $('.notification_ajax_div').html(data);  
        }).fail(function () {
            alert('Error in Loading Posts.');
        });
  });




   window.setInterval(function() {
      var site_url = "{{url('/')}}/"+"get/notification";
      var currentTime = $('input[name="currentTime"]').val();
      var login_user = $('input[name="login_user"]').val();

      var currentPage = $('li.active span').html();
      //$('.loader').show();
      $.ajax({
          url: site_url+'?page=' + currentPage,
          data: {'currentTime':currentTime,'login_user':login_user},
          type: 'get',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
          success: function(data) {
            //$('.loader').hide();
            if(data==0){
            }else{
              $('.notification_ajax_div').html(data);
            }

          },
          error: function(error){
            //$('.loader').hide();
          }
        });
    }, 15000);



});

//userProfileTab
</script>
@endsection('scripts')
