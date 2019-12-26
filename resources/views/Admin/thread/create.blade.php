@extends('layouts.admin')
 <!-- PLUGINS STYLES-->
 <link href="{{ asset('admintheme/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
@section('content')

<div class="page-content fade-in-up">

 <div class="row">
    <div class="col-md-12">
        <div class="ibox">
            @include('elements.printerror')
            <div class="ibox-head">
                <div class="ibox-title">Add New Forum</div>
            </div>
            <div class="ibox-body" style="">
                 <form class="form-vertical" action="{{route('thread.store')}}" method="post" role="form"
                  id="AddForumForm">
                {{csrf_field()}}
                    
                    <div class="form-group">
                        <label>Subject</label>
                        {{ Form::text('subject', null, ['placeholder' => 'Enter Subject', 'class' => 'form-control required'])}}
                        @if ($errors->has('subject'))
                            <span class="invalid-feedback" style="display:block;" role="alert">
                                <strong>{{ $errors->first('subject') }}</strong>
                            </span>
                        @endif
                    </div>
                     <div class="form-group">
                        <label>Tag</label>

                        <select name="tags[]" id="tag" class="form-control select2_demo_1 required" multiple="">
                            {{-- todo add from db--}}
                            @foreach($tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('tags'))
                            <span class="invalid-feedback" style="display:block;" role="alert">
                                <strong>{{ $errors->first('tags') }}</strong>
                            </span>
                        @endif
                       
                    </div>
                     <div class="form-group">
                        <label>Content</label>
                        <textarea class="form-control required" name="content" id="" placeholder="Enter Content"
                    > {{old('content')}}</textarea>
                        @if ($errors->has('content'))
                            <span class="invalid-feedback" style="display:block;" role="alert">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                        @endif
                    </div>

                   
                    <div class="form-group">
                        {{ Form::button('Submit', ['class' => 'btn btn-default add-forum'])}}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
 </div>
</div>

@endsection
@section('scripts')

<!-- PAGE LEVEL PLUGINS-->
<script src="{{ asset('admintheme/vendors/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script>

        $(function () {
            $(".select2_demo_1").select2();
            $('.add-forum').click(function(e){
                var ret = validateForm('AddForumForm');
                if(ret){
                    $('#AddForumForm').submit();
                }
              });
        })
    </script>
@endsection