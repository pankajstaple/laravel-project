@extends('layouts.admin')
@section('content')
<div class="page-content fade-in-up">
    <div class="ibox">
        @include('elements.printerror')
        <div class="ibox-head">
            <div class="ibox-title">Participant of {{$challenge_info->title}}</div>
        </div>
        <div class="ibox-body">
         
            <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="users-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>@sortablelink('first_name', "Name")</th>
                        <th>@sortablelink('email', "Email")</th>
                        <th>@sortablelink('profile.contact', "Contact")</th>
                        <th>@sortablelink('created_at', "Joining Date")</th>
                        <th>@sortablelink('type', "Type")</th>
                        <th>@sortablelink('status', "Status")</th>
                        <th>View Weigh In</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($users))
                	@foreach($users as $user)
                	<tr>
                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ isset($user->profile->contact)?$user->profile->contact:'' }}</td>
                        <td>{{ $user->created_at->format('m/d/Y') }}</td>
                        <td>{{ $user->type }}</td>
                        <td>{{ $user->status }}</td>
                        <td>
                        	<a href="{{url('/')}}/admin/challenge/participant/weighin/{{base64_encode($user->id)}}/{{base64_encode($challenge_info->id)}}" title="Edit"> View Weigh In
                        		
                        	</a>
                            
                                
                            
                        	
                        </td>
                    </tr>
                  
                	@endforeach
                    @else
                    <tr><td colspan="7">No record found.</td></tr>
                    @endif
                    
                </tbody>
            </table>
            </div>
            {{ $users->appends($_GET)->links() }}
        </div>

    </div>
</div>
@endsection
