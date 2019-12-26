@extends('layouts.admin')
@section('content')
<div class="page-content fade-in-up">
    <div class="ibox">
        @include('elements.printerror')
        <div class="ibox-head">
            <div class="ibox-title">Forum List</div>
        </div>
        <div class="ibox-body">
            {!! Form::open(['method'=>'get']) !!}
            <div class="row">
                <div class="col-sm-4 form-group">
                    <div class="input-group">
                        <input class="form-control" id="search"
                               value="{{ request('search') }}"
                               placeholder="Search by subject or content" name="search"
                               type="text" id="search"/>
                               &nbsp;&nbsp;&nbsp;
                        <?php /*<select class="form-control challenge-type" name="type_id">
                            <option value="">---Search by challenge group---</option>
                        @foreach($tags as $k => $type)
                            @if(isset($_GET['type_id']) && ($k == $_GET['type_id']))
                            <option selected="selected" value="{{ $k }}">{{ $type}}</option>
                            @else
                            <option value="{{ $k }}">{{ $type}}</option>
                            @endif
                        @endforeach;
                        </select>
                        &nbsp;&nbsp;*/ ?>
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-warning"
                            >
                                Search
                            </button>

                        </div>
                         
                        
                    </div>
                </div>
                <div class="col-sm-5 form-group">
                    <div class="input-group">
                    
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
                        <th>@sortablelink('subject', "Subject")</th>
                        <th>@sortablelink('user.first_name', "Created By")</th>
                        <th>@sortablelink('commentscount_count', "Comments")</th>
                        <th>@sortablelink('created_at', "Created Date")</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!$threads->isEmpty())
                	@foreach($threads as $thread)
                	<tr>
                        <td>{{ $thread->subject }}</td>
                         <td>{{ $thread->user->first_name.' '.$thread->user->last_name }}</td>
                         <td>{{ $thread->commentscount_count }}</td>
                        <td>{{ $thread->created_at->format('m/d/Y') }}</td>
                        <!--<td>0</td>-->
                        <td>
                        	<a href="{{route('thread.edit', base64_encode($thread->id))}}" title="Edit">
                        		<i class="fa fa-edit"></i>
                        	</a>
                            <!--<a href="{{route('thread.show', base64_encode($thread->id))}}" title="View">
                                <i class="fa fa-eye"></i>
                            </a>-->
                            <form action="{{action('ThreadController@destroy', base64_encode($thread->id))}}" method="post" class="ThreadDeleteForm disp-inline">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <a href="javascript:;" class="delete-confirm" title="Delete">
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
            {{ $threads->appends($_GET)->links() }}
        </div>

    </div>
</div>
@endsection
