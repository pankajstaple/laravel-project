<nav class="page-sidebar" id="sidebar">
            <div id="sidebar-collapse">
                <div class="admin-block d-flex">
                    <div>
                        @if(!empty(Auth::user()->profile_image))
                            <img src="{{ url('/').'/'.config('constants.profile_image').'/'.Auth::user()->profile_image}}" width="45px">
                        @else
                        <img src="{{ url('/').'/'.config('constants.profile_image').'/admin-avatar.png'}}" width="45px">
                        @endif
                    </div>
                    <div class="admin-info">
                        <div class="font-strong">{{ Auth::user()->first_name }}</div><small>Administrator</small></div>
                </div>
                <ul class="side-menu metismenu">
                    <li>
                        <a class="active" href="{{ route('dashboard') }}"><i class="sidebar-item-icon fa fa-th-large"></i>
                            <span class="nav-label">Dashboard</span>
                        </a>
                    </li>
                    <li class="heading">FEATURES</li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-users"></i>
                            <span class="nav-label">Users</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a class="@if($active_menu == 'user_create')active @endif" href="{{ route('users.create')}}">Add New</a>
                            </li>
                            <li>
                                <a class="@if($active_menu == 'user_index')active @endif" href="{{ route('users.index')}}">List Users</a>
                            </li>
                        </ul>
                    </li>
					<li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-trophy"></i>
                            <span class="nav-label">Challenges</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a class="@if($active_menu == 'challenge_create')active @endif" href="{{ route('challenge.create')}}">Add New Challenge</a>
                            </li>
                            <li>
                                <a class="@if($active_menu == 'challenge_index')active @endif" href="{{ route('challenge.index') }}">List Challenges</a>
                            </li>
                            <li>
                                <a class="@if($active_menu == 'challenge_type')active @endif" href="{{ route('listtypes') }}">Challenge Types</a>
                            </li>
                        </ul>
                    </li>
                    <li class="@if($active_menu == 'gifts')active @endif">
                        <a href="{{ action('GiftController@index')}}"><i class="sidebar-item-icon fa fa-gift"></i>
                            <span class="nav-label">Gifts</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa  fa-credit-card"></i>
                            <span class="nav-label">Payments</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a class="@if($active_menu == 'payment_index')active @endif" href="{{ action('PaymentController@index')}}">Manage Payments</a>
                            </li>
                            <li>
                                <a class="@if($active_menu == 'payment_settings')active @endif" href="{{ route('gateway') }}">Payment Gateways</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-cogs"></i>
                            <span class="nav-label">Settings</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a class="@if($active_menu == 'general_settings')active @endif" href="{{ route('general_settings')}}">General Setting</a>
                            </li>
                            <li>
                                <a class="@if($active_menu == 'sociallinks')active @endif" href="{{ route('sociallinks') }}">Social Links</a>
                            </li>
                            <li>
                                <a class="@if($active_menu == 'pagetitles')active @endif" href="{{ route('pagetitles') }}">Page Titles</a>
                            </li>
                            <li>
                                <a class="@if($active_menu == 'page_adsense')active @endif" href="{{ route('pageadsense') }}">Page AdSense</a>
                            </li>
                            <li>
                                <a class="@if($active_menu == 'banner_add')active @endif" href="{{ route('bannerads') }}">Banner Ads</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-newspaper-o"></i>
                            <span class="nav-label">Blog</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a class="@if($active_menu == 'blogs_index')active @endif" href="{{  action('BlogsController@index') }}">Articles</a>
                            </li>
                            <li>
                                <a class="@if($active_menu == 'categories')active @endif" href="{{ action('BlogCategoriesController@index') }}">Categories</a>
                            </li>
                        </ul>
                    </li>
                    <li class="@if($active_menu == 'winner_index')active @endif">
                        <a href="{{ action('ChallengeController@winner')}}"><i class="sidebar-item-icon fa fa-gift"></i>
                            <span class="nav-label">Winners</span>
                        </a>
                    </li>
                     <li class="@if($active_menu == 'reward_list')active @endif">
                        <a href="{{ action('UserController@reward_list')}}"><i class="sidebar-item-icon fa fa-google-wallet"></i>
                            <span class="nav-label">Rewards</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"><i class="sidebar-item-icon fa fa-users"></i>
                            <span class="nav-label">Groups</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a class="@if($active_menu == 'group_create')active @endif" href="{{  action('GroupController@create') }}">Add New</a>
                            </li>
                            <li>
                                 <a class="@if($active_menu == 'group_index')active @endif" href="{{  action('GroupController@index') }}">List Groups</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);"><i class="sidebar-item-icon fa fa-comments-o"></i>
                            <span class="nav-label">Testimonials</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a class="@if($active_menu == 'testimonial_create')active @endif" href="{{  action('TestimonialController@create') }}">Add New</a>
                            </li>
                            <li>
                                 <a class="@if($active_menu == 'testimonial_index')active @endif" href="{{  action('TestimonialController@index') }}">List Testimonials</a>
                            </li>
                        </ul>
                    </li>
                     <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-forumbee"></i>
                            <span class="nav-label">Forums</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a class="@if($active_menu == 'add_forum')active @endif" href="{{  action('ThreadController@create') }}">Create Forum</a>
                            </li>
                            <li>
                                <a class="@if($active_menu == 'forum_index')active @endif" href="{{ action('ThreadController@index') }}">Manage Forums</a>
                            </li>
                            <li>
                                <a class="@if($active_menu == 'forum_tags')active @endif" href="{{ action('ThreadController@tags') }}">Manage Tags</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-podcast" aria-hidden="true"></i>
                            <span class="nav-label">Podcast</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a class="@if($active_menu == 'podcast_create')active @endif" href="{{  action('PodcastController@create') }}">Create Podcast</a>
                            </li>
                            <li>
                                <a class="@if($active_menu == 'podcast_index')active @endif" href="{{ action('PodcastController@index') }}">Manage Podcast</a>
                            </li>
                        </ul>
                    </li>



                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-list-alt"></i>
                            <span class="nav-label">Pages</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a class="@if($active_menu == 'terms')active @endif" href="{{  action('PagesController@terms') }}">Terms</a>
                            </li>
                            <li>
                                <a class="@if($active_menu == 'privacy')active @endif" href="{{ action('PagesController@privacy') }}">Privacy</a>
                            </li>
                             <li>
                                <a class="@if($active_menu == 'faq')active @endif" href="{{ action('PagesController@faq') }}">Faq</a>
                            </li>
                             <li>
                                <a class="@if($active_menu == 'contact_us')active @endif" href="{{ action('PagesController@contact_us') }}">Contact Us</a>
                            </li>
                            <li>
                                <a class="@if($active_menu == 'howitworks')active @endif" href="{{  action('PagesController@howitworks') }}">How it works</a>
                            </li>
                             <li>
                                <a class="@if($active_menu == 'gamefaq')active @endif" href="{{ action('PagesController@gameFaq') }}">Game Faq</a>
                            </li>
                        </ul>
                    </li>
                    <li class="@if($active_menu == 'email_templates')active @endif">
                        <a href="{{ action('EmailTemplatesController@index')}}"><i class="sidebar-item-icon fa fa-file-code-o"></i>
                            <span class="nav-label">Email Templates</span>
                        </a>
                    </li>
                    <li class="@if($active_menu == 'all_messages')active @endif">
                        <a href="{{ route('all_messages')}}"><i class="sidebar-item-icon fa fa-question-circle-o"></i>
                            <span class="nav-label">Contact Queries</span>
                        </a>
                    </li>
                    <?php /*<li class="@if($active_menu == 'queries')active @endif">
                        <a href="{{ action('EmailTemplatesController@queries')}}"><i class="sidebar-item-icon fa fa-question-circle-o"></i>
                            <span class="nav-label">Queries</span>
                        </a>
                    </li> */ ?>
                    
                    
			         <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-history"></i>
                            <span class="nav-label">User Logs</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a class="@if($active_menu == 'log_index')active @endif" href="{{ route('loglist')}}">Activities</a>
                            </li>
                            <li>
                                <a class="@if($active_menu == 'top_visitors')active @endif" href="{{ route('topvisitors') }}">Top Visitors</a>
                            </li>
                        </ul>
                    </li>
			
                </ul>
            </div>
        </nav>