@extends('layouts.admin')
@section('content')
<div class="page-content fade-in-up">
    <div class="ibox">
        @include('elements.printerror')
        <div class="ibox-head">
            <div class="ibox-title">Testimonials List</div>
        </div>
        <div class="ibox-body">
            {!! Form::open(['method'=>'get']) !!}
            <div class="row">
                <div class="col-sm-5 form-group">
                    <div class="input-group">
                        <input class="form-control" id="search"
                               value="{{ request('search') }}"
                               placeholder="Search " name="search"
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
                        <th>@sortablelink('name', "Name")</th>
                        <th>Image</th>
                        <th>@sortablelink('description', "Description")</th>
                        <th>@sortablelink('Created Date', "Created Date")</th>
                        <th>@sortablelink('status', "Status")</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!$testimonials->isEmpty())
                	@foreach($testimonials as $testimonial)
                	<tr>
                        <td>{{ $testimonial->fullname }}</td>
                        <td>@if (!empty($testimonial->image))
                            <img class="img-circle" src="{{ config('constants.testimonial_img_path').'/thumbnail/'.$testimonial->image}}" width="40">
                       
                        @endif</td>
                        <td>{{ str_limit(strip_tags($testimonial->description), 120, '...') }}</td>
                        <td>{{ $testimonial->created_at }}</td>
                        <td>{{ $testimonial->status }}</td>
                        <td>
                        	<a href="{{route('testimonial.edit', base64_encode($testimonial->id))}}" title="Edit">
                        		<i class="fa fa-edit"></i>
                        	</a>
                            <?php /*<a href="{{route('testimonial.show', base64_encode($testimonial->id))}}" title="View">
                                <i class="fa fa-eye"></i>
                            </a> */ ?>
                            <form action="{{action('TestimonialController@destroy', base64_encode($testimonial->id))}}" method="post" class="TestimonialDeleteForm disp-inline">
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
            {{ $testimonials->appends($_GET)->links() }} 
        </div>

    </div>
</div>
@endsection
