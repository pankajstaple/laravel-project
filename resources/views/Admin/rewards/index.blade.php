@extends('layouts.admin')
@section('content')
<div class="page-content fade-in-up">
    <div class="ibox">
        @include('elements.printerror')
        <div class="ibox-head">
            <div class="ibox-title">Rewards User List</div>
        </div>
        <div class="ibox-body">
          
            <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="users-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>@sortablelink('user.first_name', "User")</th>
                        <th>@sortablelink('reward_amt', "Amount")</th>
                        <th>@sortablelink('referuser.first_name', "Referal User")</th>
                        <th>@sortablelink('created_at', "Created Date")</th>
                        <!--<th>Action</th>-->
                    </tr>
                </thead>
                <tbody>
                    @if(count($rewards) > 0)
                    @foreach($rewards as $reward)
                    <tr>
                        <td><a href="{{route('users.show', base64_encode($reward->user->id))}}">{{ $reward->user->first_name." ".$reward->user->last_name }}</a></td>
                        <td>${{ $reward->reward_amt }}</td>
                        <td><a href="{{route('users.show', base64_encode($reward->referuser->id))}}">{{ $reward->referuser->first_name." ".$reward->referuser->last_name }}</a></td>
                        
                        <td>{{ $reward->created_at->format('d/m/Y') }}</td>
                        <!--<td>
                            <a href="javascript:;" data-couponid="{{base64_encode($reward->id)}}" class="paid">
                               PAY
                            </a> |
                            <a href="javascript:;" data-couponid="{{base64_encode($reward->id)}}" class="txns">
                               ALL TXN
                            </a>
                        </td>-->
                    </tr>
                  
                    @endforeach
                    @else
                        <tr><td colspan="6">No record to display.</td></tr>
                    @endif
                    
                </tbody>
            </table>
            </div>
            {{ $rewards->appends($_GET)->links() }}
        </div>

    </div>
</div>
<!-- The Modal -->
<div class="modal" id="AddCoupon">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Coupon</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="ibox-body">
                        {{ Form::open(array('url' => route('savecoupon'), 'id' => 'AddCouponForm', 'files'=>true, 'class' => 'form-horizontal')) }}
                            <input type="hidden" name="id" value="" class="editcoupon_id">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Code <span class="req">*</span></label>
                                <div class="col-sm-8 input-group flex-wrap">
                                    <input class="form-control required code" placeholder="Enter code" type="text" name="code">
                                    <span class="input-group-addon generate-code " title="Generate random code">
                                        <span class="fa fa-cogs"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Description</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control description" rows="15" cols="15" placeholder="Enter description" type="text" name="description"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Discount type</label>
                                <div class="col-sm-8">
                                    <label class="ui-radio ui-radio-inline">
                                        <input class="status" name="is_fixed" type="radio" value="1" checked>
                                        <span class="input-span"></span>Fixed Amount</label>
                                    <label class="ui-radio ui-radio-inline">
                                        <input class="status" name="is_fixed" type="radio" value="0">
                                        <span class="input-span"></span>Percentage</label>
                                   
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Discount value <span class="req">*</span></label>
                                <div class="col-sm-8 input-group flex-wrap">
                                    <span class="input-group-addon dollar">
                                        <span class="fa fa-dollar"></span>
                                    </span>
                                    <input class="form-control required"  placeholder="Enter value" type="text" name="discount">
                                    <span style="display:none;"  class="input-group-addon percent" >
                                        <span class="fa fa-percent"></span>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Max use</label>
                                <div class="col-sm-8">
                                    <input class="form-control"  placeholder="Enter max use" type="text" name="max_uses">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Max use per user</label>
                                <div class="col-sm-8">
                                    <input class="form-control"  placeholder="Enter max uses" type="text" name="max_uses_user">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Status</label>
                                <div class="col-sm-8">
                                    {{ Form::select('status', config('constants.status'), null, ['class' => 'form-control status'])}}
                                    
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
        <button class="btn btn-success save-coupon" type="button">Submit</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
@endsection
@section('scripts')

<script type="text/javascript">

$(document).ready(function(){
    $('.add-coupon-btn').click(function(){
        $("#AddCoupon").modal('show');
    });

    $('.save-coupon').on('click', function(){
        $(document).find('.field-error').removeClass('order-10');
        var ret = validateForm('AddCouponForm');

        if(ret){
            /* Save Coupon code */
            $('.loader').show();
            $('#AddCouponForm').find('.field-error').remove();
            var url = $('#AddCouponForm').attr('action');
            var data = $('#AddCouponForm').serialize();
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
    
    
});
</script>
@stop
