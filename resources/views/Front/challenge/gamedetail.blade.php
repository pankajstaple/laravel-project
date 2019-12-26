@extends('layouts.front')
@section('title', 'Game Detail')
@section('content')
<link rel="stylesheet" type="text/css" href="{{url('css/jquery.Jcrop.min.css')}}">
<link rel="stylesheet" href="{{asset('fronttheme/vendor/owlcarousel/css/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('fronttheme/vendor/owlcarousel/css/owl.theme.default.min.css')}}">
<script src="{{asset('js/jquery.timeago.js')}}"></script>
<div class="container">
   <div class="games-listings my-5 ">
      <div class="row">
         <div class="col-lg-5 col-md-6 col-sm-12 col-12">
            <div class="game_list_image">
               @if(empty($challenge->challenge_image))
                  <img src="{{ asset('fronttheme/images/no-blog.png') }}" alt="no image">
                @else
                  <img src="{{ config('constants.challenge_image_path').'/'.$challenge->challenge_image }}" alt="">
                @endif
            </div>
         </div>

         <div class="col-lg-7 col-md-6 col-sm-12 col-12">
            <div class="game_list_content">
               <!--<span>LOSE 4% IN 4 WEEKS!</span> -->
               <h3>{{ $challenge->title }}</h3>
               <p style="text-transform:none !important;">{{ $challenge->description }}</p>
               <?php /*<p class="my-3"><img src="{{ url('fronttheme/images/calendar.png') }}">{{Carbon\Carbon::parse($challenge->start_date)->format('M d')}} - {{Carbon\Carbon::parse($challenge->end_date)->format('M d')}}</p>
               */ ?><ul class="mt-4">
                  <li>BET: <strong>${{ number_format($challenge->amount, 0, ',', '.') }}</strong></li>
                  <li>PLAYERS: <strong>{{$challenge->get_total_players_count }}</strong></li>
                  <li>POT: <strong>${{ number_format($challenge->get_total_players_count * $challenge->amount, 0, ',', '.') }}</strong></li>
               </ul>
               <div class="join_game-btn">
                  <?php  
                  $timestr = \Carbon\Carbon::parse($challenge->start_date)->diffForHumans(); 
                  $timestr = str_replace('from now', '', $timestr);
                  ?>
                  <p class="my-3"><img src="{{ url('fronttheme/images/time.png') }}">Starts in {{$timestr}}</p>
                  @if($alreadyEnrolled == 0)
                  <span><a href="javascript:;" data-href="{{route('checkout', base64_encode($challenge->id))}}" class="checkout-game"><img src="{{ url('fronttheme/images/play-now.png') }}"></a></span>
                  @endif
               </div>
            </div>
         </div>
      </div>
      <div class="row mt-5 mb-3 games_detail">
         <div class="col-md-3 col-sm-6 col-xs-6 col-12">
            <div class="games_icon_section">
               <img src="{{ url('fronttheme/images/bet.png') }}">
               <p>BET:<strong>  ${{ number_format($challenge->amount, 0, ',', '.') }}</strong></p>
            </div>
         </div>
         <div class="col-md-3 col-sm-6 col-xs-6 col-12">
            <div class="games_icon_section">
               <img src="{{ url('fronttheme/images/playing.png') }}">
               <p>PLAYERS:<strong> {{$challenge->get_total_players_count }}</strong></p>
            </div>
         </div>
         <div class="col-md-3 col-sm-6 col-xs-6 col-12">
            <div class="games_icon_section">
               <img src="{{ url('fronttheme/images/pot.png') }}">
               <p>POT:<strong> ${{ number_format($challenge->get_total_players_count * $challenge->amount, 0, ',', '.') }}</strong></p>
            </div>
         </div>
         <div class="col-md-3 col-sm-6 col-xs-6 col-12">
            <div class="games_icon_section">
               <img src="{{ url('fronttheme/images/calendar1.png') }}">
               <p>{{Carbon\Carbon::parse($challenge->start_date)->format('M d')}}:<strong> START DATE</strong></p>
            </div>
         </div>
      </div>
   </div>
   <div class="guranty_section">
      <div class="row">
         <div class="col-md-4 col-sm-6 col-12">
            <img src="{{ url('fronttheme/images/money.png') }}">
            <p><strong>GURANTEE</strong></p>
            <span>7- DAYS MONEY BACK</span>
         </div>
         <div class="col-md-4 col-sm-6 col-12">
            <img src="{{ url('fronttheme/images/s-calendar.png') }}">
            <p>GAME BEGINS: <strong> {{Carbon\Carbon::parse($challenge->start_date)->format('M d')}}</strong></p>
            <span>LAST DAY TO JOIN : <strong>{{Carbon\Carbon::parse($challenge->bet_close_date)->format('M d')}}</strong>  </span>
         </div>
         <div class="col-md-4 col-sm-6 col-12">
            <img src="{{ url('fronttheme/images/weigh.png') }}">
            <p>FINAL WEIGH-IN:</p>
            @php
              $challenge_end_date = Carbon\Carbon::parse($challenge->end_date);
              $days = config('constants.final_weigh_ins_days');
            @endphp 
            <span><strong>{{$challenge_end_date->addDays($days)->format('M d')}} - {{$challenge_end_date->addDays(1)->format('M d')}}</strong>
         </div>
      </div>
   </div>
   <!--******** Three icons section completed ******* -->
   <div class="how-it-works mt-5">
      <ul class="nav nav-tabs" role="tablist">
         <li class="nav-item">
            <a class="nav-link active" href="#profile" role="tab" data-toggle="tab">HOW IT WORKS</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" href="#buzz" role="tab" data-toggle="tab">ACTIVITY</a>
         </li>
      </ul>
   </div>
   <!-- Tab panes -->
   <div class="tab-content">
      <div role="tabpanel" class="tab-pane fade in active show" id="profile">
         <div class="heading_section_games">
            <h3>HOW DO YOU PLAY?</h3>
            <h5>GET STARTED IN 3 EASY STEPS</h5>
         </div>
         <div class="tabing_content">
            <div class="row">
               <div class="col-md-4 col-sm-6 col-12">
                  <img src="{{ url('fronttheme/images/bet1.png') }}">
                  <h4>BET ${{ number_format($challenge->amount, 0, ',', '.') }}</h4>
                  <span>TO START</span>
               </div>
               <div class="col-md-4 col-sm-6 col-12 seconds">
                  <img src="{{ url('fronttheme/images/lose.png') }}">
                  <!--<h4>LOSE 4%</h4>
                    IN 4 WEEKS -->
                  {!!$challenge->tagline!!}
               </div>
               <div class="col-md-4 col-sm-6 col-12">
                  <img src="{{ url('fronttheme/images/win.png') }}">
                  <h4>WIN</h4>
                  <span>SPLIT THE SPOT</span>
               </div>
            </div>
         </div>

         <!-- full page section start -->
         <div class="weight_verify my-4">
            <div class="container">
               <div class="row">
                  <div class="col-md-7 col-sm-7 col-12">
                     @if($howitWorks)
                        {!!$howitWorks!!}
                     @endif
                  </div>
                  <div class="col-md-5 col-sm-5 col-12">
                     <img src="{{ url('fronttheme/images/weight-man.png') }}">
                  </div>
               </div>
            </div>
         </div>
         <!-- full page section complete -->


         <!-- FAQ section start -->
         <div class="container">
            <div class="privcay-faq-section">
               <h2>PRIVACY FAQ</h2>
               <div class="row">
                  <div class="col-12 mx-auto mt-1 mb-5">
                     <div class="accordion privacy-games" id="accordionExample">
                      @if(count($gamefaq) > 0)
                       @foreach($gamefaq as $faq)
                        @php
                          $varid = 'heading_'.$faq->id;
                        @endphp 
                        <div class="card accord">
                           <div class="card-header" id="{{$varid}}">
                              <h5 class="mb-0">
                                 <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse_{{$varid}}" aria-expanded="true" aria-controls="collapseOne">
                                 <i><img src="{{ url('fronttheme/images/plus.png') }}"></i>
                                   @if(strlen($faq->question) > 83)
                                     {{substr($faq->question,0,83)}}..
                                   @else
                                     {{$faq->question}}
                                   @endif
                                 </button>
                              </h5>
                           </div>
                           <div id="collapse_{{$varid}}" class="collapse fade" aria-labelledby="{{$varid}}" data-parent="#accordionExample">
                              <div class="card-body"> 
                                {!!$faq->answer !!}
                              </div>
                           </div>
                        </div>
                        @endforeach
                       @endif 
                       
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- ******* accordion section complete ******* -->
         <!-- ******* accordion section complete ******* -->

      </div>
      <div role="tabpanel" class="tab-pane fade" id="buzz">
        <div class="group-feed-box" style="max-width:800px;margin:20px auto 0;">
          @if(Auth::user())
                @include('elements.create_comment_box')
          @endif
                
                <section class="group-feeds">
                  <div class="feed-cards">   
                      @include('elements.challenge_activities')
                  </div>
                </section>

        </div>
      </div>

   </div>
</div>

<div class="client-says">
   <div class="client_heading">
      <h2>DONT'T TAKE OUR WORD FOR IT</h2>
   </div>
   <section class="py-5">
      <div class="container">
        <!-- Testimonial slider -->
         <div class="owl-carousel owl-theme" id="owl-carousel-testimonials">
              @if(!$testimonials->isEmpty())
              @foreach($testimonials as $testimonial)
              <div class="item">
                 <div class="card border-0">
                    <div class="card-body">

                       <div class="row">
                          <div class="col-md-5">
                             <div class="img_wrap">
                                <img src="{{config('constants.testimonial_img_path').'/'.$testimonial->image}}" class="img-fluid" alt="">
                             </div>                                 
                          </div>
                          <div class="col-md-7">
                             <div class="text_content py-3">
                                <h3>{!!$testimonial->description!!}</h3>
                                <h4><b>{{$testimonial->fullname}}</b></h4>
                             </div>                                 
                          </div>
                       </div>

                    </div>
                 </div>
              </div>
              @endforeach
              @endif

              <div class="item">
                 <div class="card border-0">
                    <div class="card-body">

                       <div class="row">
                          <div class="col-md-5">
                             <div class="img_wrap">
                                <img src="{{url('fronttheme/images/story_001.jpg')}}" class="img-fluid" alt="">
                             </div>                                 
                          </div>
                          <div class="col-md-7">
                             <div class="text_content py-3">
                                <h3>&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin tincidunt auctor rhoncus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nullam aliquam sem libero, quis ullamcorper odio mollis eget. Vivamus sed fermentum purus. Aenean consequat lacus a facilisis sollicitudin. Nulla tincidunt eleifend aliquam.&quot;</h3>
                                <h4><b>Natasha</b></h4>
                             </div>                                 
                          </div>
                       </div>

                    </div>
                 </div>
              </div>
           </div>
           <!-- Testimonial end slider -->
      </div>
   </section>
</div>
<!-- /.row -->
@endsection
@section('scripts')
<script src="{{asset('fronttheme/vendor/owlcarousel/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('fronttheme/js/float-panel.js')}}"></script>
<script type="text/javascript" src="{{url('js/jquery.Jcrop.min.js')}}"></script>
<script type="text/javascript">
     $(document).ready(function() {
          $(".timeago").timeago();
          $(document).on('click', '.comment-link', function(){
              $(this).parents('.card').find('input[name="comment"]').focus();
          });

          /* This will post comment under challenge post and save it */
          $(document).on('click', '.post-comment', function(){
                $('.loader').show();
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                    }
                });
                var currObj = $(this);
                var comment = $(this).parents('.add_comment').find('input[name="comment"]').val();
                var challenge_post_id = $(this).attr('data-post');
                var challenge_id = $(this).attr('data-challenge');
                $.ajax({
                    url: siteurl+'/save_challenge_comment',
                    type: 'POST',              
                    data: {challenge_post_id,challenge_id, comment},
                    dataType : 'json',
                    success: function(result)
                    {
                      if(result.status == 1){
                        currObj.parents('.add_comment').find('input[name="comment"]').val("");
                        var commentHtml = '<div class="all_comment py-2 px-3 border-top"><div class="form-row"><div class="col-auto"><div class="avtar avtar-md rounded-circle" style="background-image: url('+result.data.profile_image+');"></div></div><div class="col"><div class="user_name">'+result.data.name+'</div><div>'+result.data.comment+'</div></div></div></div>';
                        currObj.parents('.add_comment').after(commentHtml);
                      }
                       $(".timeago").timeago();
                      $('.loader').hide();
                    },
                    error: function(data)
                    {
                      $('.loader').hide();
                      alert('Please refresh the page or try again');
                    }
                });
          });
          
          /* This code is used for like challenge post and saved it */
          $(document).on('click', '.like-post', function(){
                $('.loader').show();
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                    }
                });
                var currObj = $(this);
                var challenge_post_id = $(this).attr('data-post');
                var challenge_id = $(this).attr('data-challenge');
                $.ajax({
                    url: siteurl+'/save_like_post/'+challenge_post_id+'/'+challenge_id,
                    type: 'GET',              
                    dataType : 'json',
                    success: function(result)
                    {
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
        
          $(document).on('click', '.load-challenge-post', function(){
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


          $('.checkout-game').on('click', function(){
            var redirectUrl = $(this).attr('data-href');
            $.get(siteurl+'/loginstatus', function(data){
                if(data.status == 1){
                  location.href = redirectUrl;
                }else{
                  $(document).find('#signupModal').find('.email').val("");
                  $(document).find('#signupModal').find('.password').val("");
                  $(document).find('#signupModal').modal('show');
                }
            }, "json");
          });
     });
     </script>
@stop
