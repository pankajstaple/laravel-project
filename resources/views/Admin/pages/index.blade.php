@extends('layouts.admin')
@section('content')
<div class="page-content fade-in-up">
    <div class="ibox">
        @include('elements.printerror')
        <div class="ibox-head">
            <div class="ibox-title">Pages List</div>
        </div>
        <div class="ibox-body">
            <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="users-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Views</th>
                        <th>Url</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($pages) > 0)
                	@foreach($pages as $page)
                	<tr>
                        <td>{{ $page->title }}</td>
                        <td>{{ $page->slug }}</td>
                        <td>{{ ($page->visit_count == 0)?"":$page->visit_count }}</td>
                        <td>{{ $page->url }}</td>
                        <td>
                            <a href="{{route('pages.edit', base64_encode($page->id))}}" title="Edit">
                        		<i class="fa fa-edit"></i>
                        	</a>
                            <form action="{{action('PagesController@destroy', base64_encode($page->id))}}" method="post" class="BlogDeleteForm disp-inline">
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
            {{ $pages->appends($_GET)->links() }}
        </div>

    </div>
</div>
@endsection
@section('scripts')
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.min.css') }}">
<script src="{{ asset('js/jquery-ui.min.js') }}" type="text/javascript"></script>

<link href="{{ asset('admintheme/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" />
<link href="{{ asset('admintheme/vendors/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" />
<script src="{{ asset('admintheme/vendors/moment/min/moment.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('admintheme/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('admintheme/vendors/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}" type="text/javascript"></script>
@stop