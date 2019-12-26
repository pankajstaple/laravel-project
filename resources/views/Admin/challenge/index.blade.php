@extends('layouts.admin')
@section('content')
<div class="page-content fade-in-up">
    <div class="ibox">
        @include('elements.printerror')
        <div class="ibox-head">
            <div class="ibox-title">Challenge List</div>
        </div>
        <div class="ibox-body">
            {!! Form::open(['method'=>'get']) !!}
            <div class="row">
                <div class="col-sm-8 form-group">
                    <div class="input-group">
                        <input class="form-control" id="search"
                               value="{{ request('search') }}"
                               placeholder="Search by title" name="search"
                               type="text" id="search"/>
                               &nbsp;&nbsp;&nbsp;
                        <select class="form-control challenge-type" name="type_id">
                            <option value="">---Search by challenge group---</option>
                        @foreach($challenge_types as $k => $type)
                            @if(isset($_GET['type_id']) && ($k == $_GET['type_id']))
                            <option selected="selected" value="{{ $k }}">{{ $type}}</option>
                            @else
                            <option value="{{ $k }}">{{ $type}}</option>
                            @endif
                        @endforeach;
                        </select>
                        &nbsp;&nbsp;
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-warning"
                            >
                                Search
                            </button>

                        </div>
                         &nbsp;&nbsp;
                         <div class="input-group-btn">
                           <a class="btn btn-info reset-link" href="{{ action('ChallengeController@index')}}">
                              Reset
                            </a>

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
                        <th>@sortablelink('title', "Title")</th>
                        <th>@sortablelink('gettype.title', "Challenge Type")</th>
                        <th>@sortablelink('start_date', "Start Date")</th>
                        <th>@sortablelink('status', "Status")</th>
                        <th>@sortablelink('getcreatedby.first_name', "Created By")</th>
                        <th>@sortablelink('created_at', "Created Date")</th>
                        <th>Participants</th> 
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!$challenges->isEmpty())
                	@foreach($challenges as $challenge)
                	<tr>
                        <td>{{ $challenge->title }}</td>
                        <td>{{ isset($challenge->gettype->title)?$challenge->gettype->title:"" }}</td>
                        <td>{{ \Carbon\Carbon::parse($challenge->start_date)->format('m/d/Y')}}</td>
                        <td>{{ $challenge->status}}</td>
                        <td>{{  isset($challenge->getcreatedby->first_name)?$challenge->getcreatedby->first_name:"" }} {{isset($challenge->getcreatedby->last_name)?$challenge->getcreatedby->last_name:"" }}</td>
                        <td>{{ $challenge->created_at->format('m/d/Y') }}</td>
                        <td><a href="@if($challenge->get_participant_count > 0) {{url('/')}}/admin/challenge/participant/{{base64_encode($challenge->id)}} @else # @endif" title="View Participants" style="cursor: pointer;"> {{$challenge->get_participant_count}}</a></td>
                        <td>
                        	<a href="{{route('challenge.edit', base64_encode($challenge->id))}}" title="Edit">
                        		<i class="fa fa-edit"></i>
                        	</a>
                            <a href="{{route('challenge.show', base64_encode($challenge->id))}}" title="View">
                                <i class="fa fa-eye"></i>
                            </a>
                            <form action="{{action('ChallengeController@destroy', base64_encode($challenge->id))}}" method="post" class="ChallengeDeleteForm disp-inline">
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
            {{ $challenges->appends($_GET)->links() }}
        </div>

    </div>
</div>
@endsection
