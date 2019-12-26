<?php
namespace App\Http\Controllers;
use Auth;
use App\Blog;
use App\BlogCategory;
use App\BlogComment;
use App\BlogLike;
use Illuminate\Http\Request;
use App\Helpers\common;
use Illuminate\Contracts\Filesystem\Filesystem;
use Image;
use DB;
use Session;
class BlogsController extends Controller {
    /*https://appdividend.com/2018/06/20/create-comment-nesting-in-laravel/*/
    public function __construct() {
        $this->middleware('auth')->except('blogdetail', 'allblogs');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $active_menu = 'blogs_index';
        $categories = BlogCategory::select('id', 'name')->pluck('name', 'id')->toArray(); // get blog categories list only
        $blogs = Blog::sortable()->with(['getblogcategory' => function ($query) {
            return $query->select('id', 'name');
        }, 'getcreatedby' => function ($query) {
            return $query->select('id', 'first_name', 'last_name');
        }
        ])->orderBy('id', 'DESC');
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $blogs->where('title', 'like', '%' . $_GET['search'] . '%');
        }
        if (isset($_GET['category_id']) && !empty($_GET['category_id'])) {
            $blogs->where('category_id', $_GET['category_id']);
        }
        if (isset($_GET['start_date']) && !empty($_GET['start_date'])) {
            $start_date = common::changeDateFormat($_GET['start_date']);
            $blogs->where('created_at', '>=', $start_date);
        }
        if (isset($_GET['end_date']) && !empty($_GET['end_date'])) {
            $end_date = common::changeDateFormat($_GET['end_date']);
            $blogs->where('created_at', '<=', $end_date);
        }
        $blogs = $blogs->paginate(config('constants.pagination.items_per_page'));
        //echo "<pre>";print_r($blogs);exit;
        return view('Admin.blogs.index', compact('blogs', 'active_menu', 'categories'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $active_menu = 'blogs_index';
        $categories = BlogCategory::get()->toArray();
        return view('Admin.blogs.create', compact('categories', 'active_menu'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $blog = new Blog();
        $blogData = $request->all();
        //dd($blogData);
        $blogData['created_by'] = Auth::user()->id;
        $blogData['slug'] = $this->createSlug($blogData['title']);
        $seo = $request->seo;
        $seo_arr = explode(',', $seo);
        $seo = json_encode($seo_arr);
        $blogData['seo'] = $seo;
        if ($request->hasFile('blog_image')) {
            $image = $request->file('blog_image');
            $fileName = time() . "." . $image->getClientOriginalExtension();
            $s3 = \Storage::disk('s3');
            /* Save original image */
            $filePath = '/blog/' . $fileName;
            $fullimage = $s3->put($filePath, file_get_contents($image), 'public');
            $img = Image::make($image->getRealPath());
            $saved = $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $newImage = $saved->stream();
            /* Save thumbnail image */
            $filePath = '/blog/thumbnail/' . $fileName;
            $thumbnail = $s3->put($filePath, (string)$newImage, 'public');
            $blogData['challenge_image'] = $fileName;
        } else {
            unset($blogData['blog_image']);
        }
        $ret = $blog->create($blogData);
        if ($ret) {
            \LogActivity::addToLog('CREATE_NEW_BLOG', Auth::user()->id, json_encode($blogData)); // store log
            return redirect()->route('blogs.index')->with('success', 'blog created successfully');
        } else {
            return redirect()->back()->withInput()->with("error", "Something went wrong. Please, try again");
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $active_menu = 'blog_index';
        $id = base64_decode($id);
        $data = Blog::with(['getblogcategory', 'getcreatedby'])->find($id);
        return view('Admin.blogs.show', ['blog' => $data, 'active_menu' => $active_menu]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $active_menu = 'blog_index';
        $id = base64_decode($id);
        $categories = BlogCategory::get()->toArray();
        $data = Blog::find($id);
        return view('Admin.blogs.edit', ['blog' => $data, 'id' => $id, 'categories' => $categories, 'active_menu' => $active_menu]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $blogData = $request->all();
        unset($blogData['_token']);
        unset($blogData['_method']);
        $blog_old_image = $blogData['blog_old_image'];
        unset($blogData['blog_old_image']);
        $id = base64_decode($id);
        if ($request->hasFile('blog_image')) {
            $image = $request->file('blog_image');
            $fileName = time() . "." . $image->getClientOriginalExtension();
            $s3 = \Storage::disk('s3');
            /* Save original image */
            $filePath = '/blog/' . $fileName;
            $fullimage = $s3->put($filePath, file_get_contents($image), 'public');
            $img = Image::make($image->getRealPath());
            $saved = $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $newImage = $saved->stream();
            /* Save thumbnail image */
            $filePath = '/blog/thumbnail/' . $fileName;
            $thumbnail = $s3->put($filePath, (string)$newImage, 'public');
            $blogData['blog_image'] = $fileName;
            /* Delete old image from s3 bucket */
            if (!empty($blog_old_image)) {
                $filePath = '/blog/' . $blog_old_image;
                $s3 = \Storage::disk('s3');
                if ($s3->exists($filePath)) {
                    $s3->delete($filePath);
                }
                $thumbfilePath = '/blog/thumbnail/' . $blog_old_image;
                if ($s3->exists($thumbfilePath)) {
                    $s3->delete($thumbfilePath);
                }
            }
        } else {
            unset($blogData['blog_image']);
        }
        $blogData['updated_by'] = Auth::user()->id;
        $ret = DB::table('blogs')->where('id', $id)->update($blogData);
        if ($ret) {
            \LogActivity::addToLog('UPDATE_BLOG', Auth::user()->id, json_encode($blogData)); // store log
            return redirect()->route('blogs.index')->with('success', 'blog updated successfully');
        } else {
            return redirect()->back()->withInput()->with("error", "Something went wrong. Please, try again");
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $id = base64_decode($id);
        $blog = Blog::find($id);
        if (!empty($blog->blog_image)) {
            $filePath = '/blog/' . $blog->blog_image;
            $s3 = \Storage::disk('s3');
            if ($s3->exists($filePath)) {
                $s3->delete($filePath);
            }
            $filePath = '/blog/thumbnail/' . $blog->blog_image;
            if ($s3->exists($filePath)) {
                $s3->delete($filePath);
            }
        }
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'blog delete successfully');
    }
    /**
     * Remove the comment from blogs.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function deletecomment($id) {
        $id = base64_decode($id);
        $blogcomment = BlogComment::find($id);
        $blogcomment->delete();
        return redirect()->back()->withInput()->with("success", "Comment delete successfully");
    }
    /*
     * Display blog comments listing
    */
    public function blogcomments(Request $request, $id) {
        $active_menu = 'blog_index';
        $id = base64_decode($id);
        $blogcomments = BlogComment::where('blog_id', $id)->sortable()->orderBy('id', 'DESC');
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $blogcomments = $blogcomments->where('comment', 'like', '%' . $_GET['search'] . '%');
        }
        $blogcomments = $blogcomments->paginate(config('constants.pagination.items_per_page'));
        return view('Admin.blogs.blogcomments', compact('blogcomments', 'active_menu'));
    }
    /*
     * This function is used to update published status of comment from comment listing
    */
    public function update_blogcomment(Request $request) {
        $data = $request->all();
        if (isset($data['id']) && !empty($data['id'])) {
            $id = base64_decode($data['id']);
            $blogcomment = BlogComment::find($id);
            if ($blogcomment) {
                $blogcomment->is_published = $data['is_published'];
                $blogcomment->save();
                echo json_encode(array('status' => 1));
                exit;
            } else {
                echo json_encode(array('status' => 0));
                exit;
            }
        } else {
            echo json_encode(array('status' => 0));
            exit;
        }
    }
    /*
     * Display blog details on front end site
    */
    public function ajax_save_blog_comment(Request $request) {
        if (!Auth::check()) {
            echo json_encode(array('status' => 0, 'message' => 'Login before post comment.'));
            exit;
        }
        $data = $request->all();
        if (isset($data['blog_id'])) {
            $blog_id = $data['blog_id'];
            $blogcomment = new BlogComment;
            $blogcomment->blog_id = $blog_id;
            $blogcomment->comment = $data['comment'];
            $blogcomment->commented_by = Auth::user()->id;

            if (isset($data['parent_id']) && !empty($data['parent_id'])) {
                $blogcomment->parent_id = $data['parent_id'];
            }

            
            $data = $blogcomment->save();
            $blogcomment->date = date('F d,Y', strtotime($blogcomment->created_at));
            $blogcomment->time = date('h:i A', strtotime($blogcomment->created_at));
            $blogcomment->name = strtoupper(Auth::user()->first_name . " " . Auth::user()->last_name);
            $loggedIn = Auth::user()->id;
            $user_profile = DB::table('user_profile')->where('user_id', Auth::user()->id)->select('profile_image')->first();
            if (!empty($user_profile->profile_image)) $blogcomment->profileimage = url('/') . '/' . config('constants.profile_image') . '/' . $user_profile->profile_image;
            else $blogcomment->profileimage = url('/') . '/' . config('constants.profile_image') . '/admin-avatar.png';
            if ($data) {
                echo json_encode(array('status' => 1, 'data' => $blogcomment, 'message' => 'Comment posted successfully.'));
            } else {
                echo json_encode(array('status' => 0, 'message' => 'Comment not saved.'));
            }
            exit;
        } else {
            echo json_encode(array('status' => 0, 'message' => 'Invalid blog id.'));
            exit;
        }
    }
    /*
     * Display blog details on front end site
    */
    public function blogdetail(Request $request, $slug) {
    //print_r(Auth::user());exit;
    if ($request->ajax()) {
        $blogdetail = Blog::where('slug', $slug)->where('is_published', 1)->first();
    } else {
    $blogdetail = Blog::where('slug', $slug)->where('is_published', 1)->with('getcreatedby')->first();
    }
        if (!empty($blogdetail->seo)) {
            $seo = json_decode($blogdetail->seo, true);
            $seo_tags = implode(",", $seo);
        } else {
            $seo_tags = null;
        }
        $blogcomments = array();
        if (!empty($blogdetail->id)) {
            $blogcomments = BlogComment::where('blog_id', $blogdetail->id)->whereNull('parent_id')->with(['getcreatedby' => function ($q) {
                return $q->select('id', 'first_name', 'last_name');
            }, 'reply'])->orderBy('created_at', 'DESC')->paginate(config('constants.load_more_limit'));;
        }
        if ($request->ajax()) {
            return view('elements.blogcomments', compact('blogcomments'));
        }
        $status = $this->isPostViewed($blogdetail);
        if (!$status) {
            $blogdetail->total_views = ($blogdetail->total_views + 1);
            $blogdetail->save();
            $this->storePost($blogdetail);
        }
        $page_adsense = \App\Setting::where('type','page_adsense')->where('name','blog')->first();
        $page_adsense_script = \App\Setting::where('type','page_adsense_script')->where('name','podcast')->first();

        $blogcategory = BlogCategory::all();
        return view('Front.blogs.blogdetail', compact('blogdetail', 'blogcategory', 'blogcomments', 'seo_tags','page_adsense','page_adsense_script'));
    }
    public function ajax_save_blog_like($blog_id) {
        $blog_id = base64_decode($blog_id);
        $response = array();
        if (!empty($blog_id)) {
            $likecount = DB::table('blog_likes')->where('user_id', Auth::user()->id)->where('blog_id', $blog_id)->count();
            if ($likecount == 0) {
                $bloglike = new BlogLike();
                $bloglike->user_id = Auth::user()->id;
                $bloglike->blog_id = $blog_id;
                $ret = $bloglike->save();
                DB::table('blogs')->where('id', $blog_id)->increment('total_likes');
            } else {
                $ret = BlogLike::where('blog_id', $blog_id)->where('user_id', Auth::user()->id)->delete();
                DB::table('blogs')->where('id', $blog_id)->decrement('total_likes');
            }
            $total_likes = Blog::where('id', $blog_id)->pluck('total_likes')->first();
            if ($ret) {
                $response = array('status' => 1, 'total_likes' => $total_likes);
            } else {
                $response = array('status' => 0, 'message' => "unable to like this comment.");
            }
        } else {
            $response = array('status' => 1, 'total_likes' => $total_likes);
        }
        echo json_encode($response);
        exit;
    }
    /*
     * This function is used to display all blogs list on front end side
    */
    public function allblogs(Request $request) {
        $pageTitle = common::getPageTitle('All Blogs');
        if (!$request->ajax()) {
            $blogcategory = BlogCategory::all();
        }
        $param = $_GET;
        $blogs = DB::table('blogs')->select(['blogs.id as blogId', 'blogs.*', 'users.id as userId', 'users.first_name', 'users.last_name', 'users.email', 'blogs.created_at as blog_created']);
        $blogs = $blogs->join('users', function ($join) {
            $join->on('users.id', '=', 'blogs.created_by');
        });


        if (isset($param['category']) && !empty($param['category'])) {
            $category_id = base64_decode($param['category']);
            $blogs = $blogs->where('blogs.category_id', $category_id);
        }
        if (isset($param['search']) && !empty($param['search'])) {
            $blogs = $blogs->orWhere('users.first_name', 'like', '%' . $param['search'] . '%');
            $blogs = $blogs->orWhere('blogs.title', 'like', '%' . $param['search'] . '%');
            $blogs = $blogs->orWhere('blogs.summary', 'like', '%' . $param['search'] . '%');
            $blogs = $blogs->orWhere('blogs.content', 'like', '%' . $param['search'] . '%');
        }

       
        $blogs = $blogs->orderBy('blogId', 'desc')->paginate(config('constants.load_more_limit'));
        $blogs->withPath('allblogs');
        if ($request->ajax()) {
            return view('elements.bloglist', compact('blogs','pageTitle'));
        } else {
            $page_adsense = \App\Setting::where('type','page_adsense')->where('name','blog')->first();
            $page_adsense_script = \App\Setting::where('type','page_adsense_script')->where('name','podcast')->first();

            return view('Front.blogs.allblogs', compact('blogcategory', 'blogs','pageTitle','page_adsense','page_adsense_script'));
        }
    }
    /*
     * This function is used to load more comments
    */
    public function ajax_load_more_comments() {
        $blogcategory = BlogCategory::all();
        $blogs = DB::table('blogs')->select(['blogs.id as blogId', 'blogs.*', 'users.id as userId', 'users.first_name', 'users.last_name', 'users.email', 'blogs.created_at as blog_created']);
        $blogs = $blogs->join('users', function ($join) {
            $join->on('users.id', '=', 'blogs.created_by');
        });
        if (isset($_GET['category']) && !empty($_GET['category'])) {
            $category_id = base64_decode($_GET['category']);
            $blogs = $blogs->where('blogs.category_id', $category_id);
        }
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $blogs = $blogs->orWhere('users.first_name', 'like', '%' . $_GET['search'] . '%');
            $blogs = $blogs->orWhere('blogs.title', 'like', '%' . $_GET['search'] . '%');
            $blogs = $blogs->orWhere('blogs.summary', 'like', '%' . $_GET['search'] . '%');
            $blogs = $blogs->orWhere('blogs.content', 'like', '%' . $_GET['search'] . '%');
        }
        $start = isset($_GET['start']) ? $_GET['start'] : "";
        if (!empty($start)) {
        }
        $blogs = $blogs->orderBy('blogId', 'desc')->limit(config('constants.load_more_limit'))->get();
        $moreBlogs = 0;
        return view('Front.blogs.allblogs', compact('blogcategory', 'blogs', 'moreBlogs'));
    }
    private function isPostViewed($post) {
        $viewed = Session::get('viewed_posts', []);
        // Check if the post id exists as a key in the array.
        if (!isset($post->id)) {
            abort(404);
        }
        return array_key_exists($post->id, $viewed);
    }
    private function storePost($post) {
        // First make a key that we can use to store the timestamp
        $key = 'viewed_posts.' . $post->id;
        // Then set that key on the session and set its value
        // to the current timestamp.
        Session::push($key, time());
    }
    public function createSlug($title, $id = 0) {
        // Normalize the title
        $slug = str_slug($title);
        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        // If we haven't used it before then we are all good.
        if (!$allSlugs->contains('slug', $slug)) {
            return $slug;
        }
        // Just append numbers like a savage until we find not used.
        for ($i = 1;$i <= 10;$i++) {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
        throw new \Exception('Can not create a unique slug');
    }
    protected function getRelatedSlugs($slug, $id = 0) {
        return Blog::select('slug')->where('slug', 'like', $slug . '%')->where('id', '<>', $id)->get();
    }
}
