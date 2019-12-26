<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title></title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="{{ asset('admintheme/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admintheme/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admintheme/vendors/themify-icons/css/themify-icons.css') }}" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="{{ asset('admintheme/vendors/jvectormap/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="{{ asset('admintheme/css/main.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/developer.css?v=1') }}" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <script type="text/javascript">
        var siteurl = '{{ URL::to("/") }}';
    </script>
</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <header class="header">
            <div class="page-brand">
                <a class="link" href="{{ route('dashboard')}}">
                   
                </a>
            </div>
            <div class="flexbox flex-1">
                <!-- START TOP-LEFT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li>
                        <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
                    </li>
                </ul>
                <!-- END TOP-LEFT TOOLBAR-->
                <!-- START TOP-RIGHT TOOLBAR-->
                <ul class="nav navbar-toolbar">


                <!-- ===================================== -->
                 <li class="dropdown dropdown-notification">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell-o rel"><span class="notify-signal noti_read" style="display: none;"></span></i></a>
                        <ul class="dropdown-menu dropdown-menu-right dropdown-menu-media">
                            <li class="dropdown-menu-header">
                                <div>
                                    <span><strong> <span class="noti_read noti_new" style="display: none;">  </span> </strong> Notifications</span>
                                    <a class="pull-right read_all_notification" data-url="{{route('readnotification')}}" data-get_url="{{route('getAdminNotification')}}" href="javascript:;">Read all</a>
                                </div>
                            </li>
                            
                            <li class="list-group list-group-divider scroller" data-height="240px" data-color="#71808f">
                                <div class="all_notification">
                                  
                                  <!-- 
                                    <a class="list-group-item">
                                        <div class="media">
                                            <div class="media-img">
                                                <span class="badge badge-default badge-big"><i class="fa fa-shopping-basket"></i></span>
                                            </div>
                                            <div class="media-body">
                                                <div class="font-13"></div><small class="text-muted"></small></div>
                                        </div>
                                    </a> -->
                                   
                                    
                                </div>
                            </li>
                         
                        </ul>
                    </li>
                <!-- ============================================ -->
                    <li class="dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                            @if(!empty(Auth::user()->profile_image))
                            <img src="{{ url('/').'/'.config('constants.profile_image').'/'.Auth::user()->profile_image}}" width="60">
                            @else
                            <img src="{{ url('/').'/'.config('constants.profile_image').'/admin-avatar.png'}}" width="60">
                            @endif
                            <span></span>{{ Auth::user()->first_name }}<i class="fa fa-angle-down m-l-5"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="javascript:;"><i class="fa fa-user"></i>Profile</a>
                            <a class="dropdown-item" href="{{route('general_settings')}}"><i class="fa fa-cog"></i>Settings</a>
                            <li class="dropdown-divider"></li>
                            <a class="dropdown-item" href="{{ route('adminlogout')}}"><i class="fa fa-power-off"></i>Logout</a>
                        </ul>
                    </li>
                </ul>
                <!-- END TOP-RIGHT TOOLBAR-->
            </div>
        </header>
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
        @include('elements.nav')
        <!-- END SIDEBAR-->
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            @yield('content')
            <!-- END PAGE CONTENT-->
            <footer class="page-footer">
                <div class="font-13">2018 © <b>BeDadStrong</b> - All rights reserved.</div>
                <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
            </footer>
        </div>
    </div>
    
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop loader">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS-->
    <script src="{{ asset('admintheme/vendors/jquery/dist/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admintheme/vendors/popper.js/dist/umd/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admintheme/vendors/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admintheme/vendors/metisMenu/dist/metisMenu.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admintheme/vendors/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <script src="{{ asset('admintheme/vendors/chart.js/dist/Chart.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admintheme/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admintheme/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admintheme/vendors/jvectormap/jquery-jvectormap-us-aea-en.js') }}" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="{{ asset('admintheme/js/main.js?v=1') }}" type="text/javascript"></script>
    <script src="{{ asset('js/validation.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admintheme/js/app.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 2000);
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
        $(document).ready(function(){ 
            $("html, body").animate({ scrollTop: 0 }, "fast"); 
            setTimeout(function(){
                $(document).find('.note-editor').find('.note-codable').addClass('aa');
                $(document).find('.note-editor').find('.note-codable').on('blur', function() {
                    var codeviewHtml        = $(this).val();
                    $(this).closest('.note-editor').siblings('textarea').val(
                            codeviewHtml
                    );
                });
            }, 100);
            
        });
        
    </script>

    @yield('scripts')


</body>

</html>