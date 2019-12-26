@extends('layouts.admin')
@section('content')
<div class="page-content fade-in-up">
    <div class="ibox">
        @include('elements.printerror')
        <div class="ibox-head">
            <div class="ibox-title">Groups List</div>
        </div>
        <div class="ibox-body">
            {!! Form::open(['method'=>'get']) !!}
            <div class="row">
                <div class="col-sm-5 form-group">
                    <div class="input-group">
                        <input class="form-control" id="search"
                               value="{{ request('search') }}"
                               placeholder="Search Title " name="search"
                               type="text" id="search"/>
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-warning">
                                Search
                            </button>
                        </div>
                    </div>
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
                        <th>@sortablelink('profile_image', "Profile Image")</th>
                        <th>@sortablelink('about', "About")</th>
                        <th>@sortablelink('slug', "Slug")</th>
                        <th>@sortablelink('created_by', "Created By")</th>
                        <th>@sortablelink('Created Date', "Created Date")</th>
                        <th>@sortablelink('status', "Status")</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($groups))
                	@foreach($groups as $group)
                	<tr>
                        <td>{{ $group->title }}</td>
                        <td>@if (!empty($group->profile_image))
                            <img class="img-circle" src="{{ config('constants.group_img_path').'/thumbnail/'.$group->profile_image}}" width="40">
                       
                        @endif</td>
                        <td>{{ str_limit(strip_tags(htmlspecialchars_decode($group->about))) }}</td>
                        <td>{{ $group->slug }}</td>
                        <td>{{ $group->first_name.' '. $group->last_name }}</td>
                        <td>{{ $group->created_at->format('m/d/Y')}}</td>
                        <td>{{ $group->status }}</td>
                        <td>
                        	<a href="{{route('groups.edit', base64_encode($group->id))}}" title="Edit">
                        		<i class="fa fa-edit"></i>
                        	</a>
                            <a href="{{route('groups.show', base64_encode($group->id))}}" title="View">
                                <i class="fa fa-eye"></i>
                            </a>
                            <form action="{{action('GroupController@destroy', base64_encode($group->id))}}" method="post" class="UserDeleteForm disp-inline">
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
               
        </div>

    </div>
</div>
@endsection
