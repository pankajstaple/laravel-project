@extends('layouts.admin')
@section('content')
<div class="page-content fade-in-up">
    <div class="ibox">
        @include('elements.printerror')
        <div class="ibox-head">
            <div class="ibox-title">Recent Weigh In</div>

        </div>
        <div class="ibox-body">
         
            <div class="row">
    @if(count($weigh_ins) > 0)        
    @foreach($weigh_ins as $p)
        <div class="col-md-4">
          <div class="card" style="height: calc(100% - 1.5rem);">
            <div class="card-body" style="height:100%;">
              <h5 class="card-title">{{date("jS F, Y", strtotime($p->created_at))}}</h5>
              @if($p->image)
              <div class="weigh-images-wrap mb-3">
                <?php  $images = explode(',', $p->image); ?>
                @foreach($images as $img)
                <?php $img_name = config('constants.weighin_image_path').'/'.$p->user_id.'/'.$img;  ?>
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
       @else 
       <div class="col">
       No Result Found
       </div>
       @endif 
      </div>
      @if($return_url == 'winner')
      <a href="{{route('winner',base64_encode($challenge_info->id))}}" class="btn btn-secondary">Back</a>
      @endif
        </div>

    </div>
</div>
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
@endsection
