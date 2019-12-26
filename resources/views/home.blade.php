<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="images/favicon.ico">
  @if(isset($pageTitle) && !empty($pageTitle))
  <title>{{$pageTitle}}</title>
  @else
  <title></title>
  @endif

   <!-- Bootstrap core CSS -->
    <link href="{{ asset('fronttheme/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Fontawesome CSS -->
    <link href="{{ asset('fronttheme/vendor/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    
    <link href="{{ asset('fronttheme/css/custom.css?v=01234006') }}" rel="stylesheet">
    <link href="{{ asset('fronttheme/css/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('fronttheme/cover.css') }}" rel="stylesheet">
    <link href="{{ asset('css/developer.css') }}" rel="stylesheet">
    <link href="{{ asset('fronttheme/vendor/owlcarousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{asset('fronttheme/vendor/owlcarousel/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('fronttheme/vendor/owlcarousel/css/owl.theme.default.min.css')}}">

  <!-- Custom styles for this template -->
  <!--<link href="cover.css" rel="stylesheet">-->
  <!-- PAGE LEVEL STYLES-->
  <script type="text/javascript">
  var siteurl = '{{ URL::to("/") }}';
  var show_login = '{{isset($show_login)?$show_login:0}}';
  </script>


</head>
<!-- boday starts here -->
<body class="landing-page">
  <div class="loader" style="display:none;">
    <div class="loader-div"><span class="loader-inner"></span></div>
  </div>

@if(!Auth::check())
  <div class="site-header">
    <nav class="navbar navbar-expand-lg navbar-dark navbar-home">
      <a class="navbar-brand" href="{{ URL::to('/') }}"><img src="{{ asset('fronttheme/images/logo-new.png') }}" alt="" class="img-fluid"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse mobile-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{route('howitworks')}}">How It Works</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('podcast', 'all')}}">Podcast</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('allblogs')}}">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('contact-us')}}">Contact Us</a>
          </li>
        </ul>
      </div>
      <div class="navbar-right navbar-btn-group ml-auto">
        <a href="javascript:;" class="btn btn-white sign-popup">Login</a>
        <a href="javascript:;" class="btn btn-outline-white join-now-game hide-on-mobile">Join Now</a>
      </div>
    </nav>
  </div>
  @endif



 @if(Auth::check())
  <div class="site-header">
    <nav class="navbar navbar-expand-xxl navbar-dark navbar-home">
      <a class="navbar-brand" href="{{ URL::to('/') }}"><img src="{{ asset('fronttheme/images/logo-new.png') }}" alt="" class="img-fluid"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse desktop-collapse" id="navbarSupportedContent">
         @include('elements.front_nav')
        <div class="dropdown-divider hide-on-desktop"></div>
        <ul class="navbar-nav hide-desktop-menu">
          <li class="nav-item">
            <a class="nav-link" href="{{route('howitworks')}}">How It Works</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('podcast', 'all')}}">Podcast</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('allblogs')}}">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('contact-us')}}">Contact Us</a>
          </li>
        </ul>
      </div>
      <div class="hide-on-mob nav-home-item">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{route('howitworks')}}">How It Works</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('podcast', 'all')}}">Podcast</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('allblogs')}}">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('contact-us')}}">Contact Us</a>
          </li>
        </ul>
      </div>
      <div class="navbar-right navbar-btn-group ml-auto">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              @if(Auth::user()->profile_image != '')
              <div class="user-avtar-dp" style="background-image: url({{ asset('profile_image/'.Auth::user()->profile_image)}});"></div>
              @else
              <div class="user-avtar-dp" style="background-image: url({{ asset('fronttheme/images/user.png')}});"></div>
              @endif
              <span class="hide-on-m text-white">{{Auth::user()->first_name}}</span>
            </a>
            <div class="dropdown-menu user-dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{url('/profile',Auth::user()->user_code)}}"><i class="fa fa-user" aria-hidden="true"></i> Profile</a>
              <a class="dropdown-item" href="{{url('/user_profile')}}"><i class="fa fa-id-badge" aria-hidden="true"></i> Edit Profile</a>
            <a class="dropdown-item" target="_blank" href="{{url('/profile_settings')}}#notification"><i class="fa fa-bell-o" aria-hidden="true"></i> Notification</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{url('/profile_settings')}}"><i class="fa fa-cog" aria-hidden="true"></i> Setting</a>
<?php /*<a class="dropdown-item" href="#"><i class="fa fa-question-circle" aria-hidden="true"></i> Need Help?</a>*/ ?>              <a class="dropdown-item" href="{{route('logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </div>

  @endif


  <!--main panel starts here-->
  <div class="main-panel">
    <!--section home-one starts here-->
    <section class="landing-1 img-fluid">
      <div class="container-fluid">
        <div class="logo-block">
            

          <div class="text-center blcok-one">
            <h1>Want to lose 10%?</h1>
            <h4>Join our Weekly Transformer</h4>
            <div class="button-img"><a href="javascript:;" class="join-now-game"><img src="{{ asset('fronttheme/images/play.png') }}" alt=""></a></div>
          </div>
        </div>


        </div>
      </section>

      <!-- cloud-divider -->
      <div class="cloud-divider cloud-divider-top"></div>
      <!-- /cloud-divider -->


      <!--section how-it-works starts here-->
      <section class="how-it-works landing-2 text-center before-white-bg">
        <div class="container">
          <div class="before-white-content">
            <h1 class="heading-global">How it Works</h1>
            <p>Losing Weight Has Never Been So Simple</p>
            <div class="row icon-block">
              <div class="col-md-3 col-sm-6">
               <div class="icon-box">
                <img src="{{ asset('fronttheme/images/icon-1.png') }}" alt="">
                <h3>Calculate Your Prize</h3>
                <p>Use our calculator to enter 
                  your goal and calculate 
                  your winnings.</p>
                </div>

              </div>

              <div class="col-md-3 col-sm-6">
               <div class="icon-box">
                <img src="{{ asset('fronttheme/images/icon-2.png') }}" alt="">
                <h3>Make Your Bet</h3>
                <p>Increase your winnings by 
                  adjusting your goal weight, 
                  how much you contribute, 
                  and the time you expect.</p>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
               <div class="icon-box">
                <img src="{{ asset('fronttheme/images/icon-3.png') }}" alt="">
                <h3> Lose the Weight</h3>
                <p>Stay on track throughout the 
                  contest with weekly weigh-ins 
                  and support from 
                  other contestants.</p>
                </div>
              </div>


              <div class="col-md-3 col-sm-6">
               <div class="icon-box">
                <img src="{{ asset('fronttheme/images/icon-4.png') }}" alt="">
                <h3>Win Money!</h3>
                <p>Meet your goal and 
                  win your prize! It's 
                  that simple!</p>
                </div>
              </div>
            </div>
          </div>

        </div>
      </section>

      <!-- cloud-divider -->
      <div class="cloud-divider cloud-divider-bot"></div>
      <!-- /cloud-divider -->


      <!--section how-it-works ends here-->
      <section class="landing2">
        <div class="container">
         <div class="text-center  landing-2">
          <h1 class="heading-global">Featured Games</h1>
          <h4>Join our Weekly Transformer</h4>
        </div>

        <div class="three-blockd">
          <div class="row weekly-block">
            @if(!empty($challenges))
            @foreach($challenges as $challenge)
            <div class="col-md-4 col-sm-6 join-sec">
              <div class="blocking-sec">
                <div class="game-img">
                  @if(empty($challenge->challenge_image))
                  <img src="{{ asset('fronttheme/images/no-blog.png') }}" alt="no image">
                  @else
                  <img src="{{ config('constants.challenge_image_path').'/thumbnail/'.$challenge->challenge_image }}" alt="">
                  @endif
                  <h3></h3>
                </div>
                <div class="gmae-des">
                  <h4><a href="{{route('gamedetail', base64_encode($challenge->id))}}">{{strlen($challenge->title) > 80 ? substr($challenge->title,0,80)."..." : $challenge->title}}</a></h4>
                  <p>{{strlen($challenge->description) > 80 ? substr($challenge->description,0,80)."..." : $challenge->description}}</p>
                </div>
                  <ul>
                    <li><span class="width-block">PLEDGED:</span>   <strong>${{ ($challenge->get_total_players_count * $challenge->amount) }}</strong></li>
                    <li><span class="width-block">PLAYERS:  </span>   <strong>{{$challenge->get_total_players_count }}</strong></li>
                    <li><span class="width-block">BET:</span>   <strong>${{ number_format($challenge->amount, 0, ',', '.') }}</strong></li>
                  </ul>
                  <div class="text-center">
                    <h5>Starts Today!</h5>
                    <a href="{{route('gamedetail', base64_encode($challenge->id))}}" class="home-button">play game</a>

                  </div>
                </div>


              </div>
              @endforeach
              @endif

                  </div>
                </div>
                <div class="button-img"><a href="{{route('allgames')}}"><img src="{{ asset('fronttheme/images/view.png') }}" alt=""></a></div>
              </div>
            </section>

            <!-- cloud-divider -->
            <div class="cloud-divider cloud-divider-top"></div>
            <!-- /cloud-divider -->


            <section class="testimonials before-white-bg">

              <div class="container">
               <div class="section_header text-center py-5">
                  <div class="testi-con">
                    <h1>success story</h1>
                    <h5>Your Story Is Waiting...</h5>
                  </div>
                </div>

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
                   </div>

                   <!-- Testimonial end slider -->
              </div>

            </section>

            <!-- cloud-divider -->
            <div class="cloud-divider cloud-divider-bot"></div>
            <!-- /cloud-divider -->


            <section class="blog">
              <div class="container">
               <div class="text-center  landing-2">
                <h1 class="heading-global">our blogs</h1>
                <h4>Join our Weekly Transformer</h4>
              </div>

              <div class="three-blockd">
                <div class="row weekly-block">
                 @if( ! empty($blogs))
                 @foreach($blogs as $blog)
                  <div class="col-md-4 col-sm-6 join-sec">
                    <div class="blocking-sec">
                      <div class="game-img">
                        @if(empty($blog->blog_image))
                        <img src="{{ asset('fronttheme/images/no-blog.png') }}" alt="no image">
                        @else
                        <img src="{{ config('constants.blog_img_path').'/thumbnail/'.$blog->blog_image }}" alt="">
                        @endif
                        
                      </div>
                      <div class="gmae-des">
                        <h4><a href="{{ route('blogdetail', $blog->slug)}}">{{strlen($blog->title) > 80 ? substr($blog->title,0,80)."..." : $blog->title}}</a></h4>
                        <p>{{strlen($blog->summary) > 80 ? substr($blog->summary,0,80)."..." : $blog->summary}}</p>
                        <a href="{{ route('blogdetail', $blog->slug)}}" class="read text-right">Read more</a>
                      </div>

                    </div>


                  </div>
                  @endforeach
                  @endif

                  

                </div>
              </div>


              <div class="button-img"><a href="{{route('allblogs')}}"><img src="{{ asset('fronttheme/images/view.png') }}" alt=""></a></div>
            </div>
          </section>

  <!--   <footer class="footer text-center custom-footer">
      <div class="social">
        <ul>
          <li><a href="#"><img src="{{ asset('fronttheme/images/fb.png') }}" alt=""></a></li>
          <li><a href="#"><img src="{{ asset('fronttheme/images/twitter.png') }}" alt=""></a></li>
          <li><a href="#"><img src="{{ asset('fronttheme/images/instagram.png') }}" alt=""></a></li>
        </ul>
      </div>
      <div class="linkss">
        <ul>
                  <li><a href="#">Contact</a></li>
                  <li><a href="#">FAQs</a></li>
                  <li><a href="#">Privacy</a></li>
                  <li><a href="#">Terms</a></li>
    </ul>

      </div>
      <p>Copyright 2018 Dad Strong LLC. Disclaimer</p>
    </footer> -->

    <footer>
      <div class="footer_section">
        <div class="social-icons">
          <ul>
            <li> <a href="{{isset($settings->facebook_link)?$settings->facebook_link:'javascript:;'}}"><img src="{{ asset('fronttheme/images/facebook.png') }}"></a></li>
            <li> <a href="{{isset($settings->twitter_link)?$settings->twitter_link:'javascript:;'}}"><img src="{{ asset('fronttheme/images/twitter-f.png') }}"></a></li>
            <li> <a href="{{isset($settings->instagram_link)?$settings->instagram_link:'javascript:;'}}"><img src="{{ asset('fronttheme/images/insta.png') }}"></a></li>
          </ul>
        </div>


        <div class="footer_menus my-3">
          <ul>
             <li> <a href="{{route('contact-us')}}">CONTACT</a></li>
              <li> <a href="{{route('podcast', 'all')}}">PODCAST</a></li>
            <li> <a href="{{route('faq')}}">FAQS</a></li>
            <li> <a href="{{route('privacy')}}">PRIVACY</a></li>
             <li> <a href="{{route('terms-condition')}}">TERMS</a></li>
          </ul>

        </div>
        <p class="mt-3 text-center">copyright {{$settings->copyright_text}} {{$settings->powered_by}}</p>
        
        @php
        echo html_entity_decode(isset($settings->ga_script)?$settings->ga_script:'');
        @endphp

      </div>
    </footer>
  </div>


</body>
            <!-- Modal -->
@include('elements.login-modal')
@include('elements.signup_modal')
<!-- boday starts here -->

<!-- Bootstrap core JavaScript-->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{asset('fronttheme/vendor/owlcarousel/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('fronttheme/js/float-panel.js')}}"></script>
<script src="{{ asset('fronttheme/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('fronttheme/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('fronttheme/vendor/owlcarousel/js/owl.carousel.js') }}"></script>
<script  src="{{ asset('fronttheme/js/index.js') }}"></script>
<script src="{{ asset('fronttheme/js/aos.js') }}"></script>
<script src="{{ asset('fronttheme/js/float-panel.js') }}"></script>
<script src="{{ asset('fronttheme/js/script.js') }}"></script>
<script src="{{ asset('js/validation.js') }}" type="text/javascript"></script>

<script>
AOS.init({
  easing: 'ease-in-out-sine'
});
</script>
<script>
$(document).ready(function(){
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){

        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });

});

</script>

<script type="text/javascript">
$(function() {
  /* Open login */
  $('.sign-popup').on('click', function(){
      $('#signup-form').find('.field-error').remove();
      $('#signinModal').modal('show');
  });
  $('.join-now-game').on('click', function(){
    $('#signinModal').modal('hide');
  $.get(siteurl+'/loginstatus', function(data){
              if(data.status == 1){
                location.href = siteurl+'/games/allgames';
              }else{
                $('#signinModal').modal('hide');
                $(document).find('#signupModal').find('.email').val("");
                $(document).find('#signupModal').find('.password').val("");
                $(document).find('#signupModal').modal('show');
              }
    }, "json");
  
  });
    
  $('.signup-modal').on('click', function(){
    $('#signup-form').find('.field-error').remove();
    $('#signinModal').modal('hide');
    $('#signupModal').modal('show');
  });
  
  $('.sign-in').on('click', function(){
    $('#signup-form').find('.field-error').remove();
    $('#signupModal').modal('hide');
    $('#signinModal').modal('show');
  });
   $('.toggle-wrap').on('click', function() {
    $('.custom_side_bar').show();
            //$(this).toggleClass('active');
            //$('aside').animate({width: 'toggle'}, 200);
   });

  /* Create account via ajax */
          $(document).on('click', '.create-account', function(e){
            e.preventDefault(); 
            var currObj = $(this);
            var url = $('#signup-form').attr('action');
            
            $('#signup-form').find('.field-error').remove();
            var ret = validateForm('signup-form');
            if(!ret){
                return;
            }

            var termsChecked = $(document).find('.agree').is(':checked');
            if(!termsChecked){
                alert("Please accept terms and conditions to continue.");
                return;
            }
            $('.loader').show();
            $.ajax({
                type: 'post',
                url: url,
                data: $('#signup-form').serialize(),
                dataType: 'json',
                success: function (response) {
                   $('.loader').hide();
                   if(response.status == 1) {
                    if(response.profileId){
                     window.location = siteurl+'/profile/'+response.profileId;
                    }else{
                     location.reload();
                    }
                   }else if(response.status == 'email_error'){
                      //$('.signup-message').html(response.message);
                      alert(response.message);
                      if(response.profileId){
                       window.location = siteurl+'/profile/'+response.profileId;
                      }else{
                       location.reload();
                      }
                   }else{
                     $('.signup-message').html('<center>Something went wrong.</center>');
                   }
                },
                error: function (error) {
                  $('.loader').hide();
                    if((error.status === 422) || (error.status === 429) ){
                        var err = error.responseJSON;
                        $('.signup-message').html('<center>'+error.message+'</center>');
                        $.each(err.errors, function (i, v) {
                            $('input[name='+i+']').after('<p class="field-error order-10">'+v+'</p>');
                        });
                    }else{
                          alert('Please refresh the page or try again');
                    }
                 
                }
            });
          });


           $('form.login:first').on('submit', function(e){
                e.preventDefault(); 
                $('.login-message').hide();
                var $this = $(this);
                $('.loader').show();
                $('.login').find('.field-error').remove();
                $.ajax({
                    type: $this.attr('method'),
                    url: $this.attr('action'),
                    data: $this.serializeArray(),
                    dataType: $this.data('type'),
                    success: function (response) {
                       $('.loader').hide();
                       if(response.auth) {
                          var profileurl = siteurl+'/profile/'+response.user.user_code
                          window.location.replace(profileurl);

                       }else{
                            $('.login-message').html('<center>Something went wrong.</center>');
                       }
                    },
                    error: function (error) {
                      $('.loader').hide();
                        if((error.status === 422) || (error.status === 429) ){
                            var err = error.responseJSON;
                            $('.login-message').html('<center>'+error.message+'</center>');
                            $.each(err.errors, function (i, v) {
                                $('input[name='+i+']').after('<p class="field-error order-10">'+v+'</p>');
                            });
                        }else{
                              alert('Please refresh the page or try again');
                        }
                     
                    }
                });
              });
});


/******* fb login and logout ********/
window.fbAsyncInit = function() {
    // FB JavaScript SDK configuration and setup
    FB.init({
      appId      : '375862669858229', // FB App ID
      cookie     : true,  // enable cookies to allow the server to access the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v3.2' // use graph api version 2.8
    });
    
    // Check whether the user already logged in
    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            //display user data
            //getFbUserData();
        }
    });
};

// Load the JavaScript SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Facebook login with JavaScript SDK
function fbLogin() { 
    FB.login(function (response) {
        if (response.authResponse) {
            // Get and display the user profile data
            getFbUserData();
        } else {
            document.getElementById('status').innerHTML = 'User cancelled login or did not fully authorize.';
        }
    }, {scope: 'email'});
}

// Fetch the user profile data from facebook
function getFbUserData(){ 
    FB.api('/me', {locale: 'en_US', fields: 'id,first_name,last_name,email,link,gender,locale,picture'},
    function (response) {
      //=====================
      //send ajax form here
      if(response)
      {
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
          $.ajax({
                  type:'post',
                  url: siteurl+'/loginwithfb',
                  data: response,
                  dataType: 'json',
                  cache: false,
                  success: function (response) {                     
                    if(response.profileId){
                     window.location = siteurl+'/profile/'+response.profileId;
                    }else{
                     location.reload();
                    }                      
                  },
                  error: function (error) {
                    $('.loader').hide();
                    alert('Please refresh the page or try again');
                     
                  }
              });

      }


    });
}

// Logout from facebook
function fbLogout() {
    FB.logout(function() { alert('logout');
        document.getElementById('fbLink').setAttribute("onclick","fbLogin()");
        document.getElementById('fbLink').innerHTML = '<img src="fblogin.jpeg"/>';
        document.getElementById('userData').innerHTML = '';
        document.getElementById('status').innerHTML = 'You have successfully logout from Facebook.';
    });
}

/******* fb login and logout end  ********/

//===============Challenge Invition accept login========//
  $(document).ready(function() {
    if(show_login == 1){
       $("#signinModal").modal('show');
    }
    });

  






</script>


</body>
</html>