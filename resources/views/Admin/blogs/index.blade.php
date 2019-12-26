@extends('layouts.admin')

<link href="{{ asset('admintheme/vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet" />

@section('content')
<div class="page-content fade-in-up">
    <div class="ibox">
        @include('elements.printerror')
        <div class="ibox-head">
            <div class="ibox-title">Blogs List</div>
        </div>
        <div class="ibox-body">
            {!! Form::open(['method'=>'get']) !!}
            <div class="row">

       
                <div class="col-sm-9 form-group">
                    <div class="input-group flex-md-nowrap flex-wrap">
                        <div class="input-group">
                            <input class="form-control" id="search"
                               value="{{ request('search') }}"
                               placeholder="Search by title" name="search"
                               type="text" id="search"/>
                        </div>
                         &nbsp;&nbsp;
                        <div class="input-group date" id="start-date">
                            <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                            {{ Form::text('start_date', (isset($_GET['start_date']) && !empty($_GET['start_date']))?$_GET['start_date']:null, ['placeholder' => 'start date', 'class' => 'form-control', 'autocomplete' => 'off'])}}
                        </div>
                        &nbsp;&nbsp;
                        <div class="input-group date" id="end-date">
                            <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                            {{ Form::text('end_date', (isset($_GET['end_date']) && !empty($_GET['end_date']))?$_GET['end_date']:null, ['placeholder' => 'end date', 'class' => 'form-control', 'autocomplete' => 'off'])}}
                        </div>
                        &nbsp;&nbsp;
                        <div class="input-group date mb-md-0 mb-4" id="payment-status">
                            {{ Form::select('category_id', $categories, isset($_GET['category_id'])?$_GET['category_id']:"" ,['class' => 'form-control category', 'placeholder' => '--select category--'])}}
                        </div>
                        <div class="input-group-btn ml-0 ml-md-2">
                            <button type="submit" class="btn btn-warning"
                            >
                                Search
                            </button>
                        </div>
                        &nbsp;&nbsp;
                        <div class="input-group-btn">
                           <a class="btn btn-info reset-link" href="{{ action('BlogsController@index')}}">
                              Reset
                            </a>

                        </div>
                    </div>
                </div>
                <div class="col-sm-3 text-md-right text-left mb-3 mb-md-0">
                    <a class="btn btn-primary m-r-5" role="button" href="{{ route('blogs.create')}}">
                                    +Add New
                                    
                                </a>
                    
                </div>
                <input type="hidden" value="{{request('field')}}" name="field"/>
                <input type="hidden" value="{{request('sort')}}" name="sort"/>
            </div>
            {!! Form::close() !!}
            <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="users-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>@sortablelink('title', "Title")</th>
                        <th>@sortablelink('slug', "Slug")</th>
                        <th>@sortablelink('total_likes', "Likes")</th>
                        <th>@sortablelink('getblogcategory.name', "Category")</th>
                        <th>@sortablelink('getcreatedby.first_name', "Created By")</th>
                        <th>@sortablelink('created_at', "Created Date")</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($blogs) > 0)
                	@foreach($blogs as $blog)
                	<tr>
                        <td>{{ $blog->title }}</td>
                        <td>{{ $blog->slug }}</td>
                        <td>{{ ($blog->total_likes == 0)?"":$blog->total_likes }}</td>
                        <td>{{ $blog->getblogcategory['name'] }}</td>
                        <td>{{ $blog->getcreatedby['first_name']. " ". $blog->getcreatedby['last_name'] }}</td>
                        <td>{{ $blog->created_at->format('m/d/Y') }}</td>
                        <td>
                            <a href="{{route('blogcomments', base64_encode($blog->id))}}" title="Comments">
                                <i class="fa fa-comment-o"></i>
                            </a>
                        	<a href="{{route('blogs.edit', base64_encode($blog->id))}}" title="Edit">
                        		<i class="fa fa-edit"></i>
                        	</a>
                            <a href="{{route('blogs.show', base64_encode($blog->id))}}" title="View">
                                <i class="fa fa-eye"></i>
                            </a>
                            <form action="{{action('BlogsController@destroy', base64_encode($blog->id))}}" method="post" class="BlogDeleteForm disp-inline">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <a  href="javascript:;" class="delete-confirm" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </a>
                                
                            </form>
                        	
                        </td>
                    </tr>
                  
                	@endforeach
                    @else
                    <tr><td colspan="7">No record found.</td></tr>
                    @endif
                    
                </tbody>
            </table>
            </div>
            {{ $blogs->appends($_GET)->links() }}
        </div>

    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('admintheme//vendors/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.min.css') }}">
<script src="{{ asset('js/jquery-ui.min.js') }}" type="text/javascript"></script>

<link href="{{ asset('admintheme/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" />
<link href="{{ asset('admintheme/vendors/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" />
<script src="{{ asset('admintheme/vendors/moment/min/moment.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('admintheme/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('admintheme/vendors/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
         $(".category").select2({
            placeholder: "Select a category",
            allowClear: false
        });

        $('#start-date').datepicker({
            format: 'mm/dd/yyyy',
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        }).on('changeDate', function (selected) {
           var endDate = new Date(selected.date.valueOf());
           $('#end-date').datepicker('setStartDate', endDate);
        });
      $('#end-date').datepicker({
            format: 'mm/dd/yyyy',
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

    


    });
    

</script>
@stop