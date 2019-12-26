@extends('layouts.admin')
@section('content')
<div class="page-content fade-in-up">
    <div class="ibox">
        @include('elements.printerror')
        <div class="ibox-head">
            <div class="ibox-title">Challenge Types List</div>
        </div>
        <div class="ibox-body">
             <div class="row">
                <div class="col-sm-12 form-group">
                    <div class="input-group">
                        <button class="btn btn-primary add-type-btn">+ ADD NEW</button>
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
                        <th>@sortablelink('title', "Title")</th>
                        <th>@sortablelink('amount', "Amount")</th>
                        <th>@sortablelink('days', "Total Days")</th>
                        <th>@sortablelink('created_at', "Created Date")</th>
                        <th>@sortablelink('status', "Status")</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($challengeTypes) > 0)
                	@foreach($challengeTypes as $type)
                	<tr>
                        <td>{{ $type->title }}</td>
                        <td>{{ $type->amount }}</td>
                        <td>{{ $type->days }}</td>
                        <td>{{ $type->created_at->format('d/m/Y') }}</td>
                        <td>{{ $type->status }}</td>
                        <td>
                        	<a href="javascript:;" data-typeid="{{base64_encode($type->id)}}" class="editype">
                        		<i class="fa fa-edit"></i>
                        	</a>
                            <form action="{{ route('deletetype', base64_encode($type->id)) }}" method="get" class="TypeDeleteForm disp-inline">
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
            {{ $challengeTypes->appends($_GET)->links() }}
        </div>

    </div>
</div>
<!-- The Modal -->
<div class="modal" id="AddType">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Challenge Type</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="ibox-body">
                        {{ Form::open(array('url' => 'admin/challenge/addtype', 'id' => 'AddChallengeTypeForm', 'files'=>true, 'class' => 'form-horizontal')) }}
                            <input type="hidden" name="id" value="" class="edittype_id">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Title <span class="req">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control required title" placeholder="Enter title" type="text" name="title">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Amount</label>
                                <div class="col-sm-9">
                                    <input class="form-control amount"  placeholder="Enter amount" type="text" name="amount">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Days</label>
                                <div class="col-sm-9">
                                    <input class="form-control days" placeholder="Enter days" type="text" name="days">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    {{ Form::select('status', config('constants.status'), null, ['class' => 'form-control status'])}}
                                    
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <label class="ui-radio ui-radio-inline">
                                        <input class="status" name="is_paid" type="radio" value="1" checked>
                                        <span class="input-span"></span>Paid</label>
                                    <label class="ui-radio ui-radio-inline">
                                        <input class="status" name="is_paid" type="radio" value="0">
                                        <span class="input-span"></span>Free</label>
                                   
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
        <button class="btn btn-success save-type" type="button">Submit</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
@endsection
@section('scripts')

<script type="text/javascript">
$(document).ready(function(){
    $('.add-type-btn').click(function(){
        $('.title').val("");
        $('.amount').val("");
        $('.days').val("");
        $('.edittype_id').val("");
        $('.status input[value="1"]').prop('checked', true);
        $("#AddType").modal('show');
    });
    $('.save-type').on('click', function(){
        var ret = validateForm('AddChallengeTypeForm');
        if(ret){
            $('#AddChallengeTypeForm').submit();
        }
    });
    $('.editype').on('click', function(){
        var typeId = $(this).attr('data-typeid');
        if(typeId){
            $.ajax({
                url: siteurl+'/admin/challenge/gettype_details/'+typeId,
                dataType: 'json',
                success: function(res){
                    if(res.status){
                        $('.title').val(res.data.title);
                        $('.amount').val(res.data.amount);
                        $('.days').val(res.data.days);
                        $('.status option[value="'+res.data.status+'"]').attr('selected','selected');
                        $('.edittype_id').val(typeId);
                        if(res.data.is_paid == 1){
                            $(document).find('.ui-radio').find('input[value="1"]').attr('checked', true);
                        }else{
                            $(document).find('.ui-radio').find('input[value="0"]').attr('checked', true);
                        }
                        $("#AddType").modal('show');

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
