@extends('layouts.front')
@section('title', 'All Blogs')
@section('content')
<div class="container">
<div class="row">
     <!-- Post Content Column -->
     <div class="col-lg-8 mt-4" id="listings">
        {!! CustomHelper::display_ads('Top') !!}
        @include('elements.bloglist')
       
     </div>
     <!-- Sidebar Widgets Column -->
     <div class="col-lg-4 col-sm-12 col-12">
        <!-- Search Widget -->
        <div class="card my-4">
           <h5 class="card-header">Search</h5>
           <div class="card-body search_box">
            <form action="{{route('allblogs')}}"> 

              <div class="input-group">
                 <input type="text" name="search" class="form-control" placeholder="Type your search here" value="{{ isset($_GET['search'])?$_GET['search']:''}}">
                 <!--  <button class="btn btn-secondary" type="button">Go!</button> -->
                 <i class="fa fa-search" aria-hidden="true"></i>
              </div>
            </form>
           </div>
        </div>
        <!-- Categories Widget -->
        {!! CustomHelper::display_ads('Right') !!}
          
        @if(isset($page_adsense) && $page_adsense->value != '')
        <div class="advertising-wrap text-center">
          @php echo $page_adsense->value; @endphp
        </div>
        @endif

        <div class="card my-4 ">
           <h5 class="card-header">Categories</h5>
           <div class="card-body text-left px-3 py-0 ">
              <div class="row">
                 <div class="col-lg-12 px-0">
                    <ul class="list-unstyled mb-0 side_category" style="max-height: 287px;overflow-y: auto;">
                        @foreach($blogcategory as $cat)
                        <li>
                            <a href="{{route('allblogs').'?category='.base64_encode($cat->id)}}">{{$cat->name}}</a>
                        </li>
                        @endforeach
                    </ul>
                 </div>
              </div>
           </div>
        </div>
        <!--<div class="card my-4  px-0">
           <h5 class="card-header">Archives</h5>
           <div class="card-body px-0 py-0">
              <ul class="list-unstyled mb-0 side_category">
                 <li>
                    <a href="#">October 2018</a>
                 </li>
                 <li>
                    <a href="#">September 2018</a>
                 </li>
                 <li>
                    <a href="#">August 2018</a>
                 </li>
                 <li>
                    <a href="#">July 2018</a>
                 </li>
                 <li>
                    <a href="#">June 2018</a>
                 </li>
                 <li>
                    <a href="#">May 2018</a>
                 </li>
                 <li>
                    <a href="#">Older</a>
                 </li>
              </ul>
           </div>
        </div>-->
       

     </div>
     <!-- Side Widget -->
  </div>
  </div>

<div class="modal fade newsletterModal" id="adsense-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close newsletterModalClose" data-dismiss="modal" aria-label="Close"><img src="{{ asset('fronttheme/images/close-icon.png') }}" alt="Close" /></button>
         @if(isset($page_adsense) && $page_adsense->value != '')
                <div class="advertising-wrap text-center podcast-adsense" id="podcast-adsense">
             @php echo $page_adsense->value; @endphp
               </div>
             @endif
      </div>
    </div>
  </div>
</div>
@if(isset($page_adsense_script) && $page_adsense_script->value != '')
@php echo $page_adsense_script->value; @endphp
@endif
@endsection
@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    if ($(window)) { 
        
    var poppy = localStorage.getItem('myPopup');
      //if(!poppy){
      setTimeout(function(){
      $('#adsense-model').modal('show'); 
      },5000); // 1000 to load it after 1 second from page load
      localStorage.setItem('myPopup','true');
      //}         
    }
  });


  $(function(){

    $(document).on('click', '#view-more-listings', function(){

      var url = $(this).data("url");
        if(url.indexOf('https') == -1) {
            var url = url.replace('http', 'https');
        }
     //alert(newstr);
      $('.loader').show();
      var currObj = $(this);
        $.ajax({
            type: 'GET',
            url: url,
            success: function (response) {
               $("#listings").append(response);
               currObj.parent().remove();
               $('.loader').hide();
            },
            error: function (error) {
              $('.loader').hide();
              alert('Please refresh the page or try again');
             
            }
        });
      
    });
    

  });

</script>
@stop
