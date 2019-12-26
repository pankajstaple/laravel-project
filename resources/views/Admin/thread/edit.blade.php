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
                <div class="ibox-title">Edit Forum</div>
            </div>
            <div class="ibox-body" style="">
             
                <form method="post" id="EditForumForm" action="{{action('ThreadController@update', base64_encode($thread['id']))}}" enctype="multipart/form-data">
                    @csrf
                    <input name="_method" type="hidden" value="PATCH">
                    
                    <div class="form-group">
                        <label>Subject</label>
                        {{ Form::text('subject', $thread['subject'], ['placeholder' => 'Enter Subject', 'class' => 'form-control required'])}}
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
                            @foreach($alltags as $tagId => $tagname)
                                <?php
                                $selected = "";
                                if(isset($selectedTags[$tagId])){
                                    $selected = "selected=selected";
                                }
                                ?>
                                <option {{$selected}} value="{{$tagId}}">{{$tagname}}</option>
                                
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
                    > {{$thread['content']}}</textarea>
                        @if ($errors->has('content'))
                            <span class="invalid-feedback" style="display:block;" role="alert">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                        @endif
                    </div>

                   
                    <div class="form-group">
                        {{ Form::button('Submit', ['class' => 'btn btn-default edit-forum'])}}
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
            $('.edit-forum').click(function(e){
                var ret = validateForm('EditForumForm');
                if(ret){
                    $('#EditForumForm').submit();
                }
              });
        })
    </script>
@endsection