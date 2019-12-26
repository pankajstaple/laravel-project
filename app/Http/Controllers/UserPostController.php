<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Group;
use App\Friends;
use App\GroupMember;
use App\UserPost;
use App\PostComment;
use App\UserProfile;
use App\PostActivityLike;
use Auth;
use App\Challenge;
use App\ChallengeType;
use App\UserChallenge;
use App\WeighInGallery;
use App\Helpers\common;
use Illuminate\Contracts\Filesystem\Filesystem;
use Image;
use DB;
class UserPostController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request,$id=0) {
        $pageTitle = common::getPageTitle('Profile');

        if(isset($id) && !empty($id)){
           $getUserByProfileCode = User::where('user_code', $id)->first();
           $login_user_id = $getUserByProfileCode->id;
        }else{
            abort(500);
        }

        $is_logged_user=0; // flag to check user visits other profile
        if($login_user_id== Auth::User()->id){
            $is_logged_user=1;

        }
        else{
            /* check whether both send request to each other */
            $check_friend = Friends::where(function($query1) use($login_user_id) {
                $query1->where('from_user_id', $login_user_id)
                         ->where('to_user_id',Auth::User()->id);
             })->orwhere(function($query1) use($login_user_id) {
                $query1->where('to_user_id', $login_user_id)
                         ->where('from_user_id',Auth::User()->id);
             })->pluck('status')->last();

             $request_sender=0;
            $request_sender = Friends::where('from_user_id',Auth::User()->id)
                        ->where('to_user_id', $login_user_id)
                        ->where('status','Pending')
                        ->pluck('id')->last();
                        if(!empty($request_sender)){
                           $request_sender=1;
                        }
           


            $is_friend = 0;
            $requestStatus = '';
            $friend_detail = User::where('id', $login_user_id)
                    ->get()
                    ->toArray();  
            if(!$check_friend==''){
                $requestStatus = $check_friend;
                if($check_friend=='Accepted'){
                    $is_friend=1;
                }
            }
        }

        if ($request->ajax()) {
            $user_posts = \App\UserPost::where('user_id', $login_user_id)->with('getcreatedby', 'comments', 'likes')
                ->orderBy('created_at', 'DESC')
                ->paginate(config('constants.group_post_limit'));
            return view('elements.userpost_activities', compact('user_posts','is_logged_user','is_friend','login_user_id'));
        }
        
        $user_posts = \App\UserPost::where('user_id', $login_user_id)->with('getcreatedby', 'comments', 'likes')
            ->orderBy('created_at', 'DESC')
            ->paginate(config('constants.group_post_limit'));
            $user_posts->withPath('profile/'.$login_user_id);

            /*Get quick facts */
        $Quickfacts=UserProfile::select('nick_name','trying_weight_lose','favorite_health_food','favorite_sinful_food','exercise_method','approach_weight_lose','long_term_goal_weight','commercial_weight_loss_program','current_diet_plan','wearable_fitness_device','fitness_exercise_app')->where('user_id',$login_user_id)->get()->toArray();
            $Quickfacts=$Quickfacts[0]; 

        /* Get groups count and mem*/
        
        $groups = GroupMember::with('group_name')->withCount('members')->where('user_id', $login_user_id)->orderBy('created_at', 'DESC')          
            ->paginate(config('constants.user_profile_group_limit'));
            $groups->withPath('more/'.$login_user_id);



            
        $groups_count = $groups->total();
        
            /*Get friend and count*/
        $friends = Friends::where('status', 'Accepted')->where(function ($query) use ($login_user_id)
        {
            $query->where('from_user_id', $login_user_id)->orWhere('to_user_id', $login_user_id);
        })->with('fromuser', 'touser')
            ->orderBy('created_at', 'DESC')
            ->paginate(config('constants.user_profile_friend_limit'));
        $friends->withPath('more/'.$login_user_id);
        $totalfriend = $friends->total();

        /* get friendrequest and count */
        $friendrequests = Friends::where('to_user_id', $login_user_id)->where('status', 'Pending')
            ->with('fromuser')
            ->paginate(config('constants.user_profile_friend_request_limit'));
        $friendrequests->withPath('more/'.$login_user_id);


        $total_request = $friendrequests->total();
        $challenges=array();

        $gamesChallenges = UserChallenge::with(['Challange'])->withCount('members')->where('user_id', $login_user_id)->orderBy('created_at', 'DESC')
            ->paginate(config('constants.user_profile_game_limit'));
        $gamesChallenges->withPath('more/'.$login_user_id);

        $gamesChallenges_count = $gamesChallenges->total();

        /* find upcoming games that user joins for profile page */
        $query = DB::table('challenges as ch');
        $query->where('ch.status', 'Active');
        $query->where(function ($query1)
        {
            $query1->where('ch.start_date', '<=', date("Y-m-d", strtotime("+5 days")))
            ->where('ch.start_date', '>=', date("Y-m-d"));
        });
        $query->join('user_challenges AS uc', 'uc.challenge_id', '=', 'ch.id', 'left outer');
        $query->where('uc.user_id', '=', $login_user_id);
        $query->leftjoin('users AS u', 'u.id', '=', 'uc.user_id');

        $upcoming_games = $query->select('ch.*')
            ->orderBy('start_date', 'ASC')
            ->paginate(config('constants.user_profile_upcomig_games_limit'));
        
        /* get games members count */
        $allgamesIds = array();
        foreach($upcoming_games as $game){
            $allgamesIds[$game->id] = $game->id;
        }
        $gamesMembers = array();
        if(!empty($allgamesIds)){
            $gamesMembers = Challenge::withCount('getParticipant')->whereIn('id', $allgamesIds)->pluck('get_participant_count', 'id');
        }

        $upcoming_games->withPath('more/'.$login_user_id);

        /* fetch rewards earn amount */
        $reward_amt = \App\UserReward::get_reward_amount();
        
        return view('Front.UserPost.index', compact('challenges', 'user_posts', 'groups', 'groups_count', 'friends', 'totalfriend', 'friendrequests', 'total_request', 'gamesChallenges', 'gamesChallenges_count', 'upcoming_games','login_user_id','is_logged_user','is_friend','friend_detail','requestStatus','Quickfacts','request_sender', 'gamesMembers', 'reward_amt'));
    }


    /* This function is used to get more groups/games/friends on profile page */
    function getProfileMoreContent(Request $request,$id=0){

        if(isset($id) && !empty($id)){
           $login_user_id = $id;
        }else{

            abort(500);
        }
         /* load more content*/
         if ($request->ajax()) {
            if ($request->get('type') == 'groups') {

                $groups = GroupMember::with('group_name')->withCount('members')->where('user_id', $login_user_id)->orderBy('created_at', 'DESC')
                ->paginate(config('constants.user_profile_group_limit'));
                return view('elements.user_groups', compact('groups'));
            }

            if ($request->get('type') == 'games')
            {

                $gamesChallenges = UserChallenge::with(['Challange'])->withCount('members')->where('user_id', $login_user_id)->orderBy('created_at', 'DESC')
                    ->paginate(config('constants.user_profile_game_limit'));
                return view('elements.user_games', compact('gamesChallenges'));
            }

            if ($request->get('type') == 'friends'){
                
                $friends = Friends::where('status', 'Accepted')->where(function ($query) use ($login_user_id)
                {
                $query->where('from_user_id', $login_user_id)->orWhere('to_user_id', $login_user_id);
                })->with('fromuser', 'touser')
                ->orderBy('created_at', 'DESC')
                ->paginate(config('constants.user_profile_friend_limit'));

                return view('elements.user_friends', compact('friends','login_user_id'));
            }

            if ($request->get('type') == 'friend-request')
            {
                $friendrequests = Friends::where('to_user_id', $login_user_id)->where('status', 'Pending')
                    ->with('fromuser')
                    ->paginate(config('constants.user_profile_friend_request_limit'));
                return view('elements.user_friend_request', compact('friendrequests'));

            }

            if ($request->get('type') == 'upcoming')
            {
                
        /* find upcoming games that user joins for profile page */
        $query = DB::table('challenges as ch');
        $query->where('ch.status', 'Active');
        $query->where(function ($query1)
        {
            $query1->where('ch.start_date', '<=', date("Y-m-d", strtotime("+5 days")))
            ->where('ch.start_date', '>=', date("Y-m-d"));
        });
        $query->join('user_challenges AS uc', 'uc.challenge_id', '=', 'ch.id', 'left outer');
        $query->where('uc.user_id', '=', $login_user_id);
        $query->leftjoin('users AS u', 'u.id', '=', 'uc.user_id');

        $upcoming_games = $query->select('ch.*')
            ->orderBy('start_date', 'ASC')
            ->paginate(config('constants.user_profile_upcomig_games_limit'));
        
        /* get games members count */
        $allgamesIds = array();
        foreach($upcoming_games as $game){
            $allgamesIds[$game->id] = $game->id;
        }
        $gamesMembers = array();
        if(!empty($allgamesIds)){
            $gamesMembers = Challenge::withCount('getParticipant')->whereIn('id', $allgamesIds)->pluck('get_participant_count', 'id');
        }

                return view('elements.user_upcoming_games', compact('upcoming_games','gamesMembers'));

            }
        }


        $totalfriend = Friends::where('status', 'Accepted')->where(function ($query) use ($login_user_id) {
            $query->where('from_user_id', $login_user_id)->orWhere('to_user_id', $login_user_id);
        })->with('fromuser', 'touser')->count();
        $friendrequests = Friends::where('to_user_id', $login_user_id)->where('status', 'Pending')->with('fromuser')->paginate(3);
        $total_request = Friends::where('to_user_id', $login_user_id)->where('status', 'Pending')->with('fromuser')->count();
        $gamesChallenges = UserChallenge::with(['Challange'])->where('user_id', $login_user_id)->paginate(3);
        $gamesChallenges_count = UserChallenge::with(['Challange'])->where('user_id', $login_user_id)->count();
        $upcomingChallenges = UserChallenge::with(['upcomingChallange'])->where('user_id', $login_user_id)->get();
        //echo '<pre>';
        //  print_r($upcomingChallenges);
        //die;
        return view('Front.UserPost.index', compact('challenges', 'user_posts', 'groups', 'friends', 'totalfriend', 'friendrequests', 'total_request', 'gamesChallenges', 'gamesChallenges_count','pageTitle'));

    }


    /*Cancel friend request by sender if request is not accepted yet*/
    public function request_cancel(Request $request){

        $to_user_id = base64_decode($request->user_id);
        $from_user_id = Auth::User()->id;
        $request_sender=0;
            $id = Friends::where('from_user_id',Auth::User()->id)
                        ->where('to_user_id', $to_user_id)
                        ->where('status','Pending')
                        ->pluck('id')->last();
                        if(!empty($id)){
                           $request_sender=1;
                        }

        if($request_sender==1){
        Friends::where('id', $id)->delete();
        echo json_encode(array('status' => 1, 'message' => 'Request delete successfully.'));
        }else{

            echo json_encode(array('status' => 0, 'message' => 'Request Not  delete.'));
        }

    }







    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsers(Request $request)
    {
        $keyword = $request->searchTerm;

        if ($keyword != '')
        {
            $users = User::where('type', 'Bettor')->where('id', '!=', Auth::user()
                ->id)
                ->where('status', 'Active')->where(function ($query) use ($keyword)
            {
                $query->where('first_name', 'LIKE', '%' . $keyword . '%')->orWhere('last_name', 'LIKE', '%' . $keyword . '%')->orWhere('email', 'LIKE', '%' . $keyword . '%');
            })->get();
        }
        $data = array();
        foreach ($users as $u)
        {
            $data[] = array(
                "id" => $u->id,
                "text" => $u->first_name . ' ' . $u->last_name
            );
        }
        echo json_encode($data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createChallenge()
    {
        if(!common::checkPermission('create_new_challenge')){
            return redirect()->route('userpost', Auth::user()->user_code)
                             ->with('error','You are not authorised person to view this page.');
        }
        $challenges = array();
        $users = User::where('type', 'Bettor')->get();
        return view('Front.UserPost.create_challenge', compact('challenges', 'users'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        
    }
    public function ajax_save_post(Request $request)
    {
        $response = array();
        $comment = new UserPost();
        $commentData = $request->all();

      // echo '<pre>';
       //print_r($commentData['created_by']);

       //die;
        if ($request->hasFile('post_image') && ($request->input('image_uploaded') == "1"))
        {
            // open file a image resource
            $image = $request->file('post_image');
            $this->validate($request, ['post_image' => 'image|mimes:jpeg,png,jpg|max:10240', ]);
            $fileName = time() . "." . $image->getClientOriginalExtension();
            $s3 = \Storage::disk('s3');
            /*$x = $request->input('x');
            $y = $request->input('y');
            $w = $request->input('w');
            $h = $request->input('h');
            /* Save original image */
            /* $filePath = '/challenge_post/' . $fileName;
            $img = Image::make($image->getRealPath());
            // crop image
            $saved = $img->crop($w, $h, $x, $y);
            $newImage = $saved->stream();
            $fullimage = $s3->put($filePath, (string)$newImage, 'public');
            
            /* Save original image */
            $filePath = '/user_post/' . $fileName;
            $fullimage = $s3->put($filePath, file_get_contents($image) , 'public');
            $commentData['post_image'] = $fileName;
        }
        else
        {
            $commentData['post_image'] = '';
        }
        
        if(isset($commentData['created_by'])){
         $commentData['user_id'] = base64_decode($commentData['created_by']);
         $commentData['created_by'] = Auth::user()->id;
        }else{
        $commentData['created_by'] = Auth::user()->id;
        $commentData['user_id'] = Auth::user()->id;
         }
        $postData = $comment->create($commentData);
        $post = UserPost::where('id', $postData->id)
            ->with('getcreatedby')
            ->first();
        $type = 'user_post';
        return view('elements.single_group_post', compact('post', 'type'));
    }
    public function ajax_save_post_comment(Request $request)
    {
        $response = array();
        $comment = new PostComment();
        $commentData = $request->all();
        $commentData['post_id'] = base64_decode($commentData['post_id']);
        $commentData['commented_by'] = Auth::user()->id;
        $ret = $comment->create($commentData);
        $name = Auth::user()->first_name . " " . Auth::user()->last_name;
        $profile_image = Auth::user()->profile_image;
        if (empty($profile_image))
        {
            $profile_image = 'admin-avatar.png';
        }
        $data = ['comment' => $commentData['comment'], 'name' => $name, 'profile_image' => url('/profile_image') . '/' . $profile_image];
        $response = array(
            'status' => 1,
            'data' => $data
        );
        echo json_encode($response);
    }
    /*This function Save post like*/
    public function ajax_save_like_post($postId)
    {
        $challengeLike = array();
        $postId = base64_decode($postId);
        $likeCount = PostActivityLike::where('likable_id', $postId)->where('likable_type', 'Post')
            ->where('user_id', Auth::user()
            ->id)
            ->count();
        $likestatus = 0;
        if ($likeCount == 0)
        {
            /*save like*/
            $likeData = array();
            $likeData['post_id'] = $postId;
            $likeData['likable_id'] = $postId;
            $likeData['user_id'] = Auth::user()->id;
            $likeData['likable_type'] = 'Post';
            $activity = new PostActivityLike();
            $activity->create($likeData);
            $likestatus = 1;
        }
        else
        {
            $activity = PostActivityLike::where('likable_id', $postId)->where('likable_type', 'Post')
                ->where('user_id', Auth::user()
                ->id);
            $activity->delete();
        }
        echo json_encode(array(
            'status' => 1,
            'likestatus' => $likestatus
        ));
    }

    /**
     * Add Weigh In
     *
     * @return \Illuminate\Http\Response
     */
    public function addWeighIn($c_id)
    {

        $c_id = base64_decode($c_id);
        $challenge = Challenge::find($c_id);

        $weigh_ins = WeighInGallery::where('challenge_id',$c_id)->orderBy('id','desc')->get();

        if($challenge->status == 'Inactive'){
        return redirect('profile_settings#games')->with("error", "Something went wrong. Please, try again");   
        exit; 
        }

        $query = Challenge::where('id',$c_id);
        $query->where('status', 'Active');
        $query->where(function($query1) {
        $query1->where('end_date',date("Y-m-d",strtotime("+2 days")))
               ->orWhere('end_date',date("Y-m-d",strtotime("+1 days")))
               ->orWhere('end_date',date("Y-m-d"));
        });


        $check_type = $query->first();
        if(isset($check_type)){
              $add_weighin_final = 1;
        } else {
            $add_weighin_final = 0;
        } 

        if($challenge->start_date <= date("Y-m-d")){
            $weighin_type = 'Final';
        } else {
            $weighin_type = 'Initial';
        }
        
       return view('Front.UserPost.add_weigh_in', compact('challenge','weigh_ins','weighin_type','add_weighin_final'));

    }

    /**
     * Add Weigh In
     *
     * @return \Illuminate\Http\Response
     */
    public function saveWeighIn(Request $request, $c_id)
    {
        
        $challenge_id = base64_decode($c_id);
        // if user submit final weighin then check its right time to submit final weigh in.
        // check Final weigh in before two day of the end date

        $challenge_info = Challenge::find($challenge_id);

        if($challenge_info->start_date <= date("Y-m-d")){
            $query = Challenge::where('id',$challenge_id);
        $query->where('status', 'Active');
        $query->where(function($query1) {
        $query1->where('end_date',date("Y-m-d",strtotime("+2 days")))
               ->orWhere('end_date',date("Y-m-d",strtotime("+1 days")))
               ->orWhere('end_date',date("Y-m-d"));
        });

        $check_type = $query->first();
            if(isset($check_type)){
                $weighin_type = 'final';
            } else {
                echo $error = 1;
                exit;
            }


            
        } else {
            $weighin_type = 'Initial';
        }

   
        $p = $request->all();
        $weigh_in = new WeighInGallery();
        $images = array();
        $image_name = '';
        $supported_image = array(
            'gif',
            'jpg',
            'jpeg',
            'png',
            'GIF',
            'JPG',
            'JPEG',
            'PNG'
        );

        if ($request->images[0] != '')
        {
            foreach ($request->images as $key => $img)
            {
                $image = $img;
                if (in_array($image->getClientOriginalExtension() , $supported_image))
                {
                    $fileName = time() . "." . $image->getClientOriginalExtension();
                    $s3 = \Storage::disk('s3');
                    /* Save original image */
                    $filePath = '/weighin/' . Auth::user()->id . '/' . $fileName;
                    $fullimage = $s3->put($filePath, file_get_contents($image) , 'public');
                    $images[] = $fileName;
                }

            }

            $image_name = implode(',', $images);
        }


       $weigh_in->image = $image_name;
       $weigh_in->description = $request->description;
       $weigh_in->challenge_id = $challenge_id;
       $weigh_in->user_id = Auth::user()->id;
       $weigh_in->weighin_type = $weighin_type;
       $weigh_in->save();

       DB::table('user_challenges')->where('challenge_id',$challenge_id)->where('user_id',Auth::user()->id)->update(['last_weighin_type' => $weighin_type]);

       return redirect('weighin/'.$c_id);


        // die;
        // $challenge = Challenge::find($c_id);
        // return view('Front.UserPost.add_weigh_in', compact('challenge'));
        
    }
}

