@extends('layouts.admin')
@section('content')
<div class="page-content fade-in-up">
    <div class="ibox">
        @include('elements.printerror')
        <div class="ibox-head">
            <div class="ibox-title">Email Templates</div>
        </div>
        <div class="ibox-body">
             <!--<div class="row">
                <div class="col-sm-12 form-group">
                    <div class="input-group">
                        <a class="btn btn-primary add-coupon-btn" href="">+ ADD NEW</a>
                    </div>
                </div>
             </div>-->
            <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="users-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>@sortablelink('name', "Name")</th>
                        <th>@sortablelink('subject', "Subject")</th>
                        <th>@sortablelink('content', "Content")</th>
                        <th>@sortablelink('updated_at', "Updated")</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($templates) > 0)
                    @foreach($templates as $templ)
                    <tr>
                        <td>{{ str_limit($templ->name, 30, '...') }}</td>
                        <td>{{ str_limit(strip_tags($templ->subject), 30, '...') }}</td>
                        <td>{{ str_limit(strip_tags($templ->content), 30, '...') }}</td>
                        <td>{{ ($templ->udpated_at)?$templ->udpated_at->format('d/m/Y'):"" }}</td>
                        <td>
                            <a href="{{ route('emailtemplates.edit', base64_encode($templ->id))}}"  class="edittemplate">
                                <i class="fa fa-edit"></i>
                            </a>
                            
                        </td>
                    </tr>
                  
                    @endforeach
                    @else
                        <tr><td colspan="6">No record to display.</td></tr>
                    @endif
                    
                </tbody>
            </table>
            </div>
            {{ $templates->appends($_GET)->links() }}
        </div>

    </div>
</div>

@endsection