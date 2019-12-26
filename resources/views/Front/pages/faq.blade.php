@extends('layouts.front')
@section('content')
<div class='headings text-center my-5'>
  <h2>FAQ</h2>
</div>
<div class="privacy_content mb-5">
  @if(count($faqs) > 0)
    <?php
      $i =0 ;
    ?>
    @foreach($faqs as $faq)
    <?php $i++;?>
      <h5>{{$i}}. {!!$faq->question!!}?</h5>
      <p>{!!$faq->answer!!}</p>
    @endforeach
  @endif
  @endsection
</div>