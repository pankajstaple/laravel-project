<!-- Preview Image -->
@if( ! empty($blogs))
@foreach($blogs as $blog)
<div class="list_blog_page">
    @if(empty($blog->blog_image))
    <img class="img-fluid rounded my-4" src="{{ asset('fronttheme/images/no-blog.png') }}" alt="no image">
    @else
    <img class="img-fluid rounded my-4" src="{{ config('constants.blog_img_path').'/thumbnail/'.$blog->blog_image }}" alt="">
    @endif
   <!-- Post Content -->
   <p class="lead">{{$blog->title}}</p>
    <div class="post_details mt-2">
   <ul>
      <li><i class="fa fa-user-o" aria-hidden="true"></i>POST BY {{strtoupper($blog->first_name." ".$blog->last_name)}}</li>
      <li><i class="fa fa-calendar-o" aria-hidden="true"></i>{{ \Carbon\Carbon::parse($blog->blog_created)->format('F d, Y')}}</li>
      <li><span href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>({{$blog->total_likes}})LIKES</span></li>
   </ul>
</div>
   <p>{{$blog->summary}}</p>
   <a href="{{ route('blogdetail', $blog->slug)}}" class="blod_list_btns">Read More</a>
</div>
@endforeach
@endif
@if ($blogs->hasMorePages())
<div class="load_more_btns text-center mt-5 mb-2">
   <a id="view-more-listings" href="javascript:;" class="load_more" data-url="{{ $blogs->appends($_GET)->nextPageUrl() }}">LOAD MORE</a>
</div>
@endif