@extends('layouts.admin')
@section('content')
<div class="page-content fade-in-up">
    <div class="ibox">
        @include('elements.printerror')
        <div class="ibox-head">
            <div class="ibox-title">Forum Tags List</div>
        </div>
        <div class="ibox-body">
             <div class="row">
                <div class="col-sm-12 form-group">
                    <div class="input-group">
                        <button class="btn btn-primary add-tag-btn">+ ADD NEW</button>
                    </div>
                </div>
             </div>
            <!--{!! Form::open(['method'=>'get']) !!}
            <div class="row">
                <div class="col-sm-5 form-group">
                    <div class="input-group">
                        <input class="form-control" id="search"
                               value="{{ request('search') }}"
                               placeholder="Search name or email" name="search"
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
            {!! Form::close() !!}-->
            <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="users-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>@sortablelink('name', "Tag Name")</th>
                        <th>@sortablelink('created_at', "Created Date")</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($tags) > 0)
                    @foreach($tags as $tag)
                    <tr>
                        <td>{{ $tag->name }}</td>
                        <td>{{ (!empty($tag->created_at))?$tag->created_at->format('d/m/Y'):"" }}</td>
                        <td>
                            <a href="javascript:;" data-tagid="{{base64_encode($tag->id)}}" class="edittag">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('deletetag', base64_encode($tag->id)) }}" method="get" class="TypeDeleteForm disp-inline">
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
            {{ $tags->appends($_GET)->links() }}
        </div>

    </div>
</div>
<!-- The Modal -->
<div class="modal" id="AddTag">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Tag</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="ibox-body">
                        {{ Form::open(array('url' => route('savetag'), 'id' => 'AddTagForm', 'files'=>true, 'class' => 'form-horizontal')) }}
                            <input type="hidden" name="id" value="" class="edittag_id">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Tag Name <span class="req">*</span></label>
                                <div class="col-sm-8 input-group flex-wrap">
                                    <input class="form-control required name" placeholder="Enter tag name" type="text" name="name">
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button class="btn btn-success save-tag" type="button">Submit</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
@endsection
@section('scripts')

<script type="text/javascript">

$(document).ready(function(){
    $('.add-tag-btn').click(function(){
        $('.edittag_id').val("");
        $('#AddTagForm').find('.field-error').remove();
        $('#AddTagForm').find('input[type="text"]').val("");
        $("#AddTag").find('.modal-title').html('Add Tag');
        $("#AddTag").modal('show');
    });

    $('.save-tag').on('click', function(){
        $(document).find('.field-error').removeClass('order-10');
        var ret = validateForm('AddTagForm');

        if(ret){
            /* Save Coupon code */
            $('.loader').show();
            $('#AddTagForm').find('.field-error').remove();
            var url = $('#AddTagForm').attr('action');
            var data = $('#AddTagForm').serialize();
            $.ajax({
                url: url,
                data: data,
                type: 'post',
                dataType:'json',
                success: function(data) {
                    if(data.status==1){
                        location.reload();
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


        }else{
            $('.loader').hide();
            $(document).find('.field-error').addClass('order-10');
        }
    });
   
    $('.edittag').on('click', function(){
        var tagid = $(this).attr('data-tagid');
        if(tagid){
            $.ajax({
                url: siteurl+'/admin/thread/gettag_details/'+tagid,
                dataType: 'json',
                success: function(res){
                    if(res.status == 1){
                        $('#AddTagForm').find('input[name="name"]').val(res.data.name);
                        $('.edittag_id').val(tagid);
                        $("#AddTag").find('.modal-title').html('Edit Tag');
                        $("#AddTag").modal('show');

                    }
                },
                error: function(x,f){
                    $('.request-error').show().focus();
                }

            });
        }
    });


    



});
</script>
@stop
