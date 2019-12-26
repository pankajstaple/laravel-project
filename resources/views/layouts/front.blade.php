<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml"
      xmlns:fb="http://ogp.me/ns/fb#">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <meta name="author" content="">

    @if(isset($Accept))
    <meta property="og:title" content="Have Fun. Lose Weight. Make Money. Set Up A Free Private Game With Friends Today." />
    <meta property="og:url" content="{{url()->full()
      }}"/>
  
    <meta property="og:image:type"       content="image/jpg">
    <meta property="og:image:width"      content="600">
    <meta property="og:image:height"     content="602">
    @endif

    @if(isset($share))
    <meta property="og:url" content="{{url()->full()
      }}"/>
 
    <meta property="og:image:type"       content="image/jpg">
    <meta property="og:image:width"      content="600">
    <meta property="og:image:height"     content="602">
    @endif

  @if(isset($blogdetail))

    @if($blogdetail->seo != '')
    @php
    $seoTags = json_decode($blogdetail->seo);
    if(is_array($seoTags))
    $seoTags = implode(',', $seoTags);
    @endphp
    <meta name="keywords" content="<?php echo $seoTags; ?>">
    @endif

     @if($blogdetail->seo_desc != '')
    <meta name="description" content="{{$blogdetail->seo_desc}}">
    @endif

  <meta property="og:url"           content="{{url()->full()
}}" />
  <meta property="og:type"          content="{{$blogdetail['title']}}" />
  <meta property="og:title"         content="{{$blogdetail['title']}}" />
  <meta property="og:description"   content="{{$blogdetail['summary']}}" />
  <meta property="og:image"         content="{{ config('constants.blog_img_path').'/'.$blogdetail['blog_image'] }}" />

  <meta name="twitter:card" content="{{$blogdetail['summary']}}">
<meta name="twitter:site" content="{{url()->full()
}}">
<meta name="twitter:title" content="{{$blogdetail['title']}}">
<meta name="twitter:description" content="{{$blogdetail['content']}}">
<meta name="twitter:image" content="{{ config('constants.blog_img_path').'/'.$blogdetail['blog_image'] }}">
  @endif
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
    
    <link href="{{ asset('fronttheme/css/custom.css?ver=1.18022019.02') }}" rel="stylesheet">
    <link href="{{ asset('fronttheme/css/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('css/developer.css') }}" rel="stylesheet">
    <link href="{{ asset('fronttheme/vendor/owlcarousel/css/owl.carousel.min.css') }}">
     <script type="text/javascript">
        var siteurl = '{{ URL::to("/") }}';
        
    </script>
    <script src="{{ asset('fronttheme/vendor/jquery/jquery.min.js')}}"></script>
    <!-- Custom styles for this template -->
   <style type="text/css">
    .nav-cus .nav-link {
    display: block;
    padding: .5rem 1rem;
    color: #fff;
    font-weight: bolder;
}
  </style>

</head>
<!-- boday starts here -->

<body>
  <div class="loader" style="display:none;">
    <div class="loader-bg"><span class="loader-inner"></span></div>
  </div>


  @if(!Auth::check())
  <div class="site-header" style="background-color: #000;position: relative;">
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
   <div class="site-header" style="background-color: #000;position: relative;">
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
              <a class="dropdown-item" href="{{url('/profile_settings')}}#notification"><i class="fa fa-bell-o" aria-hidden="true"></i> Notification</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{url('/profile_settings')}}"><i class="fa fa-cog" aria-hidden="true"></i> Setting</a>
              <?php /*<a class="dropdown-item" href="#"><i class="fa fa-question-circle" aria-hidden="true"></i> Need Help?</a>*/ ?>
              <a class="dropdown-item" href="{{route('logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </div>

  @endif

    <!--main panel starts here-->
    <div class="main-panel blog_detail">
      
     

        <div class="content-area">
            @yield('content')
            <!-- Modal -->
@include('elements.login-modal')
@include('elements.signup_modal')
        </div>
    </div>
    <!-- /.row -->
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






<!-- Bootstrap core JavaScript -->
<script src="{{ asset('fronttheme/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('fronttheme/vendor/owlcarousel/js/owl.carousel.js') }}"></script>
 <script  src="{{ asset('fronttheme/js/index.js')}}"></script>

<script src="{{ asset('fronttheme/js/aos.js')}}"></script>
<script src="{{ asset('fronttheme/js/float-panel.js')}}"></script>
<script src="{{ asset('fronttheme/js/script.js')}}"></script>
<script src="{{ asset('js/validation.js') }}" type="text/javascript"></script>

<script type="text/javascript">
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));


/******* fb login and logout ********/
window.fbAsyncInit = function() {


    // Check whether the user already logged in
    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
               //getFbUserData();
        }
    });
};



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
</script>
@yield('scripts')
</body>

</html>