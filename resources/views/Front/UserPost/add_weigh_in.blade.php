@extends('layouts.front')
@section('title', 'All Games')
@section('content')
<!-- <div class="container mb-5" style="max-width: 800px!important;"> -->
    <div class="container">
      
   {{ Form::open(array('url' => '/weighin/'.base64_encode($challenge->id), 'id' => 'AddChallengeForm', 'files'=>true)) }}
      <h4 class="mt-4">Add {{$weighin_type}} Weigh In </h4>
      <div class="card mb-4" style="">
        <div class="card-body">
          <div class="invite-form">
            <div class="form-group add_image">
               <input type="file" name="images[]" accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf" multiple>
                  </div>
                  <span class="image_error" style="color:red; display: none;">Please use jpg,png,jpeg</span>
              <div class="form-group">
                <label>Message</label>
                  <textarea class="form-control description" name="description" rows="3"></textarea>
                  <span class="msg_error" style="color:red; display: none;">Please add some description</span>
                  <span class="type_error" style="color:red; display: none;">Final weigh ins will be uploaded within 2 days before game end date.</span>
              </div>
             
            <button type="submit" class="btn btn-yellow">Save</button>
            <a href="{{url('/')}}/profile_settings#games" class="btn btn-secondary">Cancel</a>
          </div>
         </div>
      </div>
    {{ Form::close()}}

    @if(count($weigh_ins) > 0)
    <h4> Recent Weigh In</h4>
    <div class="row">
    @foreach($weigh_ins as $p)
        <div class="col-md-4">
          <div class="card" style="height: calc(100% - 1.5rem);">
            <div class="card-body" style="height:100%;">
              <h5 class="card-title">{{date("jS F, Y", strtotime($p->created_at))}}</h5>
              @if($p->image)
              <div class="weigh-images-wrap mb-3">
                <?php  $images = explode(',', $p->image); ?>
                @foreach($images as $img)
                <?php $img_name = config('constants.weighin_image_path').'/'.Auth::user()->id.'/'.$img;  ?>
                <div class="weigh-image" style="background-image: url({{$img_name}});"></div>
                @endforeach
              </div>
              @endif
              <div class="weigh-description">
                 {{$p->description}}
              </div>
             
            </div>
          </div>
        </div>
        @endforeach
      </div>
      @endif
    </div>
@endsection

@section('scripts')
<link href="{{ asset('css/imageuploadify.min.css') }}" rel="stylesheet">

<style type="text/css">
.imageuploadify {
    border: none;
    position: relative;
    min-height: auto;
    min-width: 250px;
    max-width: 100%;
    margin: auto;
    display: flex;
    padding: 0;
    flex-direction: column;
    text-align: center;
    background-color: #fff;
    color: #3AA0FF;
}
.imageuploadify .imageuploadify-images-list button.btn-default {
    display: block;
    color: #495057;
    border-color: #ced4da;
    border-radius: 4px;
    width: 100%;
    max-width: 100%;
    margin: 0;
}
.imageuploadify-container {
    margin: 15px 7px 0 0 !important;
}
.weigh-images-wrap {
  display: flex;
  flex-direction: row;
  justify-content: flex-start;
}
.weigh-image {
    width: 3.5rem;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    overflow: hidden;
    border-radius: 6px;
    height: 3.5rem;
    margin-right: .5rem;
}
 </style>

   <script src="{{ asset('js/imageuploadify.js') }}" type="text/javascript"></script>
   <!-- <script src="{{ asset('imageuploadify.min.js') }}" type="text/javascript"></script> -->

        <script type="text/javascript">
            $(document).ready(function() {
                $('input[type="file"]').imageuploadify();

                $(".description").keydown(function(){
                  if($(".description").val() != ''){
               $(".msg_error").hide();
             }
            });
            });


        </script>
}
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
@stop