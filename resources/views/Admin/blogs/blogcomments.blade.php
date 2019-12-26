@extends('layouts.admin')
@section('content')
<div class="page-content fade-in-up">
    <div class="ibox">
        @include('elements.printerror')
        <div class="ibox-head">
            <div class="ibox-title">Blog Comments List</div>
        </div>
        <div class="ibox-body">
           {!! Form::open(['method'=>'get']) !!}
            <div class="row">
                <div class="col-sm-5 form-group">
                    <div class="input-group">
                        <input class="form-control" id="search"
                               value="{{ request('search') }}"
                               placeholder="Search by comment" name="search"
                               type="text" id="search"/>
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-warning"
                            >
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
                        <th>@sortablelink('comment', "Comment")</th>
                        <th>@sortablelink('total_likes', "Total Likes")</th>
                        <th>@sortablelink('getcreatedby.first_name', "Commented By")</th>
                        <th>@sortablelink('created_at', "Created Date")</th>
                        <th>@sortablelink('is_published', "Is published")</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($blogcomments) > 0)
                    @foreach($blogcomments as $comment)
                    <tr>
                        <td>{{ $comment->comment }}</td>
                        <td>{{ $comment->total_likes }}</td>
                        <td>{{ $comment->getcreatedby['first_name']. " ". $comment->getcreatedby['last_name'] }}</td>
                        <td>{{ $comment->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="col-sm-10">
                            <select name="is_published" class="is_published form-control" data-id="{{base64_encode($comment->id)}}" >
                            <option value="1" {{($comment->is_published == 1)?"selected":""}}>Yes</option>
                            <option value="0" {{($comment->is_published == 0)?"selected":""}}>No</option>
                            </select>
                            </div>
                        </td>
                        <td>
                            <form action="{{ route('deletecomment', base64_encode($comment->id)) }}" method="get" class="TypeDeleteForm disp-inline">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <a onclick="$(this).closest('form').submit();" href="javascript:;">
                                    <i class="fa fa-trash"></i>
                                </a>
                                
                            </form>
                            
                        </td>
                    </tr>
                  
                    @endforeach
                    @else
                        <tr><td colspan="6">No record to display.</td></tr>
                    @endif
                    
                </tbody>
            </table>
            </div>
            {{ $blogcomments->appends($_GET)->links() }}
        </div>

    </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('.is_published').on('change', function(){
            $('.loader').show();
            $.ajax({
                url: siteurl+'/admin/blog/update_blogcomment',
                data:{id:$(this).attr('data-id'), is_published:$(this).find('option:selected').val(), _token: '{{csrf_token()}}'},
                type: 'post',
                dataType:'json',
                success: function(data) {
                    if(data.status==1){
                        $('.loader').hide();
                        $('.success-message').show();
                        $("html, body").animate({ scrollTop: 0 }, "fast");
                        setTimeout(function(){
                            $('.success-message').hide()
                        },2000);
                    }
                },
                error: function(error){
                    $('.loader').hide();
                    if(error.status === 422 ){
                        var err = error.responseJSON;
                        $.each(err.errors, function (i, v) {
                            $('input[name='+i+']').after('<p class="field-error order-10">'+v+'</p>');
                        });
                        $("html, body").animate({ scrollTop: 0 }, "fast");
                    }else{
                          alert('Please refresh the page or try again');
                    }
                }
            });
        });
    });
</script>
@stop