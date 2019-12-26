@extends('layouts.front')
@section('content')
<div class='headings text-center my-5'>
          <h2>{{$page->title}}</h2>
        </div>
        <div class="privacy_content mb-5" style="max-width: 800px; margin: 0 auto;">
          {!! $page->content !!}

        </div>

@endsection

