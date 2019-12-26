@extends('layouts.front')
@section('title', 'Podcast')
@section('content')
<div class="container">
 <div class="row">
        <div class="col-lg-8 mt-4">
           @if(!empty($podcastDetail))
          <section class="podcast">
              {!! CustomHelper::display_ads('Top') !!}
            <div class="row mb-5">
              <div class="col-md-3 col-8">
                @php
                $podcast_image = '';
                if(isset($podcastDetail->podcast_image))
                $podcast_image = $podcastDetail->podcast_image;
                @endphp
                <div class="podcast_avtar" style="background-image: url({{config('constants.podcast_image_path').'/'.$podcast_image}});"></div>
              </div>
              <div class="col-md-9 col-12">
                <div class="podcast_details">
                  <div class="episode_wrap mt-2 mb-3">
                    <span class="episode">{{isset($podcastDetail->title)?$podcastDetail->title:""}}</span>
                  </div>
                  <h2 class="podcast_title mb-3">{{isset($podcastDetail->summary)?$podcastDetail->summary:""}}</h2>              
                  <div class="create_on mb-3">
                    <span class="date">Publish on {{isset($podcastDetail->created_at)?$podcastDetail->created_at->format('M d, Y'):""}}</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-12">
                <div class="podcast_description mb-5">
                  {!!isset($podcastDetail->content)?$podcastDetail->content:"" !!}

                </div>
                <div class="podcast_audio mb-5">
                  {!!isset($podcastDetail->audio_code)?$podcastDetail->audio_code:"" !!}
                  </div> 
                <div class="podcast_video mb-5">
                  <iframe width="100%" height="420" src="{{isset($podcastDetail->youtube)?$podcastDetail->youtube:''}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>              
                </div>
              </div>
              <div class="col-lg-12">
                <section class="podcast_audio_wrap">                           
                  <div class="podcast_listen_wrap border p-4">
                    <div class="podcast_listen_heading mb-3">Listen Podcast On</div>
                    <div class="podcast_listen_list">

                      <div class="podcast_listen">
                        <a href="{{isset($podcastDetail->spotify)?$podcastDetail->spotify:'javascript:;'}}"><div class="podcast_listen_logo spotify"></div></a>
                        <a href="{{isset($podcastDetail->spotify)?$podcastDetail->spotify:'javascript:;'}}"><div class="podcast_listen_title">Spotify</div></a>
                      </div>

                      <div class="podcast_listen">
                        <a href="{{isset($podcastDetail->apple_podcast)?$podcastDetail->apple_podcast:'javascript:;'}}"><div class="podcast_listen_logo applePodcasts"></div></a>
                        <a href="{{isset($podcastDetail->apple_podcast)?$podcastDetail->apple_podcast:'javascript:;'}}"><div class="podcast_listen_title">Apple Podcasts</div></a>
                      </div>

                      <div class="podcast_listen">
                        <a href="{{isset($podcastDetail->play_music)?$podcastDetail->play_music:'javascript:;'}}"><div class="podcast_listen_logo playMusic"></div></a>
                        <a href="{{isset($podcastDetail->play_music)?$podcastDetail->play_music:'javascript:;'}}"><div class="podcast_listen_title">Play Music</div></a>
                      </div>

                      <div class="podcast_listen">
                        <a href="{{isset($podcastDetail->stitcher_link)?$podcastDetail->stitcher_link:'javascript:;'}}"><div class="podcast_listen_logo stitcher"></div></a>
                        <a href="{{isset($podcastDetail->stitcher_link)?$podcastDetail->stitcher_link:'javascript:;'}}"><div class="podcast_listen_title">Stitcher</div></a>
                      </div>

                    </div>
                  </div>              
                </section>
              </div>
            </div>

          </section>
          @else
          <section class="podcast py-5">
          <div class="row mb-5"><center>There is no podcast episode to view.</center></div>
          </section>
          @endif
        </div>
        <div class="col-lg-4 mt-4">
          <div class="episodes_list mb-4">
          {!! CustomHelper::display_ads('Right') !!}
            
            @if(!$podcasts->isEmpty())
            @foreach($podcasts as $podcast)
            <div class="form-row mb-0 episodes_item">
              <div class="col-md-3 col-8">
                <a href="javascript:;"><div class="podcast_avtar" style="background-image: url({{config('constants.podcast_image_path').'/'.$podcast->podcast_image}});"></div></a>
              </div>
              <div class="col-md-9 col-12">


                <div class="podcast_details">
                  <div class="episode_wrap mt-2 mb-2">
                    <span class="episode">{{$podcast->title}}</span>
                  </div>
                  <h2 class="podcast_title mb-2" style="font-size: 18px;"><a href="{{route('podcast', base64_encode($podcast->id))}}">{{$podcast->summary}}</a></h2>            
                </div>
              </div>
            </div>
            @endforeach
            @endif

             </div>


             @if(isset($page_adsense) && $page_adsense->value != '')
                <div class="advertising-wrap text-center">
             @php echo $page_adsense->value; @endphp
               </div>
             @endif

        </div>
      </div>
</div>


<!--Newsletter model-->
<div class="modal fade newsletterModal" id="adsense-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close newsletterModalClose" data-dismiss="modal" aria-label="Close"><img src="{{ asset('fronttheme/images/close-icon.png') }}" alt="Close" /></button>
         @if(isset($page_adsense) && $page_adsense->value != '')
                <div class="advertising-wrap text-center podcast-adsense" id="podcast-adsense">
             @php try{echo $page_adsense->value;}catch(\Exception $e){} @endphp
               </div>
             @endif
      </div>
    </div>
  </div>
</div>
@if(isset($page_adsense_script) && $page_adsense_script->value != '')
@php echo $page_adsense_script->value; @endphp
@endif
<div style="display:none" id="popup"></div>

@endsection
@section('scripts')

<script type="text/javascript">
  $(document).ready(function(){
    if($(document).find('#google_ads_frame1').length) {
      var google_sandbox = $(document).find('iframe').attr('sandbox')
      google_sandbox += ' allow-modals'
      $(document).find('#google_ads_frame1').attr('sandbox', google_sandbox)
    }
    if ($(window)) {      
    var poppy = localStorage.getItem('myPopup');
      //if(!poppy){
      setTimeout(function(){
      $('#adsense-model').modal('show'); 
      $('#adsense-model').find('#mc_embed_signup').css('background', '#111 !important');
      },5000); // 1000 to load it after 1 second from page load
      localStorage.setItem('myPopup','true');
      //}         
    }
  });
</script>
@stop
