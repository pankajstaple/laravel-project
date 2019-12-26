<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Helpers\common;
use App\Podcast;
use Auth;
use DB;

class PodcastController extends Controller {

	public function __construct() {
        $this->middleware('auth')->except('podcast');
    }






    public function index(){
    	$active_menu = 'podcast_index';
        $podcast = Podcast::sortable()->orderBy('id', 'DESC');
    	$podcast = $podcast->paginate(config('constants.pagination.items_per_page'));
        return view('Admin.podcast.index', compact('podcast', 'active_menu'));

    }
    public function create(){
        $active_menu='podcast_create';
        return view('Admin.podcast.create',compact('active_menu'));


    }

    /**
     * Store a newly created podcast.
     */
    public function store(Request $request){
        $podcast = new Podcast();
        $podcastData = $request->all();
        //dd($podcastData);
        $podcastData['created_by'] = Auth::user()->id;
        if ($request->hasFile('podcast_image')) {
            $image = $request->file('podcast_image');
            $fileName = time() . "." . $image->getClientOriginalExtension();
            $s3 = \Storage::disk('s3');
            /* Save original image */
            $filePath = '/podcast/' . $fileName;
            $fullimage = $s3->put($filePath, file_get_contents($image), 'public');
            $podcastData['podcast_image'] = $fileName;
        } else {
            unset($podcastData['podcast_image']);
        }
        $ret = $podcast->create($podcastData);
        if ($ret) {
             return redirect()->route('podcast.index')->with('success', 'podcast episode created successfully');
        } else {
            return redirect()->back()->withInput()->with("error", "Something went wrong. Please, try again");
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $active_menu = 'podcast_index';
        $id = base64_decode($id);
        $podcast = Podcast::find($id);
        return view('Admin.podcast.edit', compact('podcast', 'id', 'active_menu'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $podcastData = $request->all();
        unset($podcastData['_token']);
        unset($podcastData['_method']);
        $podcast_old_image = $podcastData['podcast_old_image'];
        unset($podcastData['podcast_old_image']);
        $id = base64_decode($id);
        if ($request->hasFile('podcast_image')) {
            $image = $request->file('podcast_image');
            $fileName = time() . "." . $image->getClientOriginalExtension();
            $s3 = \Storage::disk('s3');
            /* Save original image */
            $filePath = '/podcast/' . $fileName;
            $fullimage = $s3->put($filePath, file_get_contents($image), 'public');
            $podcastData['podcast_image'] = $fileName;
            /* Delete old image from s3 bucket */
            if (!empty($podcast_old_image)) {
                $filePath = '/podcast/' . $podcast_old_image;
                $s3 = \Storage::disk('s3');
                if ($s3->exists($filePath)) {
                    $s3->delete($filePath);
                }
               
            }
        } else {
            unset($podcastData['podcast_image']);
        }
        $ret = DB::table('podcasts')->where('id', $id)->update($podcastData);
        if ($ret) {
             return redirect()->route('podcast.index')->with('success', 'podcast episode updated successfully');
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
        $podcast = Podcast::find($id);
        if (!empty($podcast->podcast_image)) {
            $filePath = '/podcast/' . $podcast->podcast_image;
            $s3 = \Storage::disk('s3');
            if ($s3->exists($filePath)) {
                $s3->delete($filePath);
            }
           
        }
        $podcast->delete();
        return redirect()->route('podcast.index')->with('success', 'podcast delete successfully');
    }

    public function podcast(Request $request, $id){


        $pageTitle = common::getPageTitle('Podcast');
    	$podcastDetail = null;
    	$podcasts = Podcast::orderBy('id', 'DESC')->get();
    	
    	if(!empty($id) && ($id != "all")){
    		$id = base64_decode($id);
    		$podcastDetail = Podcast::find($id);
    	}else{
    		$podcastDetail = isset($podcasts[0])?$podcasts[0]:"";
    	}

        $page_adsense = \App\Setting::where('type','page_adsense')->where('name','podcast')->first();
        $page_adsense_script = \App\Setting::where('type','page_adsense_script')->where('name','podcast')->first();

    	return view('Front.podcast.podcast', compact('podcasts', 'podcastDetail','pageTitle','page_adsense', 'page_adsense_script'));
    }

}
