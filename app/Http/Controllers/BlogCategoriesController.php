<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Helpers\common;
use Auth;
use App\BlogCategory;
use App\Http\Requests\BlogCategoryRequest;

class BlogCategoriesController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}

	/**
	 * Display a listing of blog_category.
	*/
	public function index()
	{
		$active_menu = 'categories';
        $categories = BlogCategory::sortable()->orderBy('id', 'DESC');
        if(isset($_GET['search']) && !empty($_GET['search'])){
            $categories = $categories->where('name', 'like', '%'.$_GET['search'].'%');
        }
        $categories = $categories->paginate(config('constants.pagination.items_per_page'));
        return view('Admin.blogcategory.index', compact('categories', 'active_menu')); 
	}

	/*
	* Save blog category 
	*/
	public function saveblogcategory(BlogCategoryRequest $request){
		$data = $request->all();
		$loggedInUserId = Auth::user()->id;
		if(!empty($data['id'])){
            $id = base64_decode($data['id']);
            $blogcategory = BlogCategory::find($id);
            $blogcategory->name = $request->name;
            $blogcategory->slug = $this->createSlug($request->name, $id);
            $blogcategory->created_by = Auth::user()->id;
            $blogcategory->save();
            $request->session()->flash('success', 'Category updated successfully');
            return response()->json(['status' => 1]);
            
        }
        $data = $request->all();
        $data['slug'] = $this->createSlug($request->name);
        $data['created_by'] = Auth::user()->id;
        $blogcategory = BlogCategory::create($data);
		if($blogcategory->id){
			\LogActivity::addToLog('CREATE_NEW_BLOG_CATEGORY',$loggedInUserId, json_encode($data)); // store log
			$request->session()->flash('success', 'Category created successfully');
			return response()->json(['status' => 1]);
        }else{
			return response()->json(['status' => 0]);
            //return redirect()->back()->withInput()->with("error", "Something went wrong. Please, try again");    
        }
	}

	public function createSlug($title, $id = 0)
    {
        // Normalize the title
        $slug = str_slug($title);
        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }
        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
        throw new \Exception('Can not create a unique slug');
    }

    protected function getRelatedSlugs($slug, $id = 0)
    {
        return BlogCategory::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }

	/* Get Coupon details for display in edit popup */
	public function getcategory_details($id){
		$id = base64_decode($id);
        if(!empty($id) && $id > 0){
            $data = BlogCategory::find($id);
            return response()->json(['status' => 1, 'data' => $data]);
        }
        return response()->json(['status' => 0, 'data' => []]);
	}
	
	/* delete coupon using soft delete */
	public function deletecategory($id){
        $id = base64_decode($id);
        BlogCategory::find($id)->delete();
        return redirect()->action('BlogCategoriesController@index')
                         ->with('success','Category deleted successfully.');
    }

}
