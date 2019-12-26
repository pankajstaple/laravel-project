@extends('layouts.admin')

<link href="{{ asset('admintheme/vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet" />

@section('content')
<div class="page-content fade-in-up">
    <div class="ibox">
        @include('elements.printerror')
        <div class="ibox-head">
            <div class="ibox-title">Podcast Episode List</div>
        </div>
        <div class="ibox-body">
            <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="users-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>@sortablelink('title', "Title")</th>
                        <th>@sortablelink('summary', "summary")</th>
                        <th>@sortablelink('created_at', "Created Date")</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($podcast) > 0)
                	@foreach($podcast as $pod)
                	<tr>
                        <td>{{ $pod->title }}</td>
                        <td>{{ $pod->summary }}</td>
                        <td>{{ $pod->created_at->format('m/d/Y') }}</td>
                        <td>
                        	<a href="{{route('podcast.edit', base64_encode($pod->id))}}" title="Edit">
                        		<i class="fa fa-edit"></i>
                        	</a>
                            <a target="_blank" href="{{route('podcast', base64_encode($pod->id))}}" title="View">
                                <i class="fa fa-eye"></i>
                            </a>
                            <form action="{{action('PodcastController@destroy', base64_encode($pod->id))}}" method="post" class="PodcastDeleteForm disp-inline">
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
            {{ $podcast->appends($_GET)->links() }}
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