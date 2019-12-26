<?php

namespace App\Http\Controllers;

use App\Testimonial;
use Illuminate\Http\Request;
use Image;
use Auth;
use DB;
class TestimonialController extends Controller
{


    function __construct()
    {
        return $this->middleware('auth')->except('index');
    }
    
    /**
     * Display a listing of testimonials.
    */
    public function index()
    {
        $active_menu = 'testimonial_index';
        $testimonials = Testimonial::sortable()->orderBy('id', 'DESC');
        if(isset($_GET['search']) && !empty($_GET['search'])){
            $testimonials->where('description', 'like', '%'.$_GET['search'].'%');
        }
        $testimonials = $testimonials->paginate(config('constants.pagination.items_per_page'));
        return view('Admin.testimonial.index', compact('active_menu','testimonials'));
    }

    /**
     * Show the form for creating a new testimonial.
    */
    public function create()
    {
        $active_menu = 'testimonial_create';
        return view('Admin.testimonial.create', compact('active_menu'));
    }

    /**
     * Store a newly created testimonial in storage.
     */
    public function store(Request $request)
    {
        $testimonial = new Testimonial();
        $testimonialData = $request->all();
        //echo "<pre>";
        //print_r($testimonialData);exit;
        $testimonialData['created_by'] = Auth::user()->id;
        if( $request->hasFile('image') ) {
            $image = $request->file('image');
            $fileName = time().".".$image->getClientOriginalExtension();
            $s3 = \Storage::disk('s3');
            /* Save original image */
            $filePath = '/testimonial/' . $fileName;
            $fullimage = $s3->put($filePath, file_get_contents($image), 'public');

            $img = Image::make($image->getRealPath());
         
            $saved = $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $newImage = $saved->stream();
            /* Save thumbnail image */
            $filePath = '/testimonial/thumbnail/' . $fileName;
            $thumbnail = $s3->put($filePath, (string)$newImage, 'public');
            $testimonialData['image'] = $fileName;
        }
        $ret = $testimonial->create($testimonialData);
        
        if($ret){
            return redirect()->route('testimonial.index')
                     ->with('success','testimonial created successfully');
        }else{
            return redirect()->back()->withInput()->with("error", "Something went wrong. Please, try again");    
        }        
    }

    /**
     * Display the specified testimonial details.
     * @param  \App\Testimonial  $testimonial
     */
    public function show($id)
    {
        $active_menu = 'testimonial_create';
        $id = base64_decode($id);
        $testimonial = Testimonial::with('getcreatedby')->find($id);
        return view('Admin.testimonial.show', compact('testimonial', 'active_menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $active_menu = 'testimonial_create';
        $id = base64_decode($id);
        $testimonial = Testimonial::find($id);
        return view('Admin.testimonial.edit', compact('testimonial', 'id', 'active_menu'));
  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $testimonialData = $request->all();
        unset($testimonialData['_token']);
        unset($testimonialData['_method']);
        $old_image = $testimonialData['old_image'];
        unset($testimonialData['old_image']);
        $id = base64_decode($id);
       
        if( $request->hasFile('image') ) {
            $image = $request->file('image');
            $fileName = time().".".$image->getClientOriginalExtension();
            $s3 = \Storage::disk('s3');
            /* Save original image */
            $filePath = '/testimonial/' . $fileName;
            $fullimage = $s3->put($filePath, file_get_contents($image), 'public');

            $img = Image::make($image->getRealPath());
         
            $saved = $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $newImage = $saved->stream();
            /* Save thumbnail image */
            $filePath = '/testimonial/thumbnail/' . $fileName;
            $thumbnail = $s3->put($filePath, (string)$newImage, 'public');
            $testimonialData['image'] = $fileName;

            /* Delete old image from s3 bucket */
            if(!empty($old_image)){
                $filePath = '/testimonial/' . $old_image;
                $s3 = \Storage::disk('s3');
                if($s3->exists($filePath)) {
                    $s3->delete($filePath);
                }
                $thumbfilePath = '/testimonial/thumbnail/' . $old_image;
                if($s3->exists($thumbfilePath)) {
                    $s3->delete($thumbfilePath);
                }
            }

        }

        $ret = DB::table('testimonials')->where('id', $id)->update($testimonialData);
        
        if($ret){
            return redirect()->route('testimonial.index')
                     ->with('success','testimonial updated successfully');
        }else{
            return redirect()->back()->withInput()->with("error", "Something went wrong. Please, try again");    
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = base64_decode($id);
        $testimonial = Testimonial::find($id);
        if(!empty($testimonial->image)){
            $filePath = '/testimonial/' . $testimonial->image;
            $s3 = \Storage::disk('s3');
            if($s3->exists($filePath)) {
                $s3->delete($filePath);
            }
            $filePath = '/testimonial/thumbnail/' . $testimonial->image;
            if($s3->exists($filePath)) {
                $s3->delete($filePath);
            }
        }
        $testimonial->delete();
        return redirect()->route('testimonial.index')
                         ->with('success','testimonial delete successfully');
    }
}
