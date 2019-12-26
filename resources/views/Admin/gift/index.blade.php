@extends('layouts.admin')
@section('content')
<div class="page-content fade-in-up">
    <div class="ibox">
        @include('elements.printerror')
        <div class="ibox-head">
            <div class="ibox-title">Gift/Coupons List</div>
        </div>
        <div class="ibox-body">
             <div class="row">
                <div class="col-sm-12 form-group">
                    <div class="input-group">
                        <button class="btn btn-primary add-coupon-btn">+ ADD NEW</button>
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
                        <th>@sortablelink('code', "Code")</th>
                        <th>@sortablelink('discount', "Discount")</th>
                        <th>@sortablelink('max_uses', "Max Use")</th>
                        <th>@sortablelink('created_at', "Created Date")</th>
                        <th>@sortablelink('status', "Status")</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($gifts) > 0)
                    @foreach($gifts as $gift)
                    <tr>
                        <td>{{ $gift->code }}</td>
                        <td>
                            @if($gift->is_fixed == 1)
                            ${{ $gift->discount }}
                            @else
                            {{ $gift->discount }}%
                            @endif
                        </td>
                        <td>{{ $gift->max_uses }}</td>
                        <td>{{ $gift->created_at->format('d/m/Y') }}</td>
                        <td>{{ $gift->status }}</td>
                        <td>
                            <a href="javascript:;" data-couponid="{{base64_encode($gift->id)}}" class="editcoupon">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('deletecoupon', base64_encode($gift->id)) }}" method="get" class="TypeDeleteForm disp-inline">
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
            {{ $gifts->appends($_GET)->links() }}
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
function randomString() {
    var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
    var string_length = 8;
    var randomstring = '';
    for (var i=0; i<string_length; i++) {
        var rnum = Math.floor(Math.random() * chars.length);
        randomstring += chars.substring(rnum,rnum+1);
    }
    return randomstring;
}
$(document).ready(function(){
    $('.generate-code').click(function(){
        var randomCode = randomString();
        $('.code').val(randomCode);
    });
    $('.add-coupon-btn').click(function(){
        $('.editcoupon_id').val("");
        $('#AddCouponForm').find('.field-error').remove();
        $('#AddCouponForm').find('input[type="text"]').val("");
        $('#AddCouponForm').find('textarea').val("");
        $("#AddCoupon").find('.modal-title').html('Add Coupon');
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
    
    $('input[type=radio][name=is_fixed]').change(function() {
        if (this.value == '1') {
            $('.dollar').show();
            $('.percent').hide();
        }
        else{
            $('.dollar').hide();
            $('.percent').show();
        }
    });

    $('.editcoupon').on('click', function(){
        var couponid = $(this).attr('data-couponid');
        if(couponid){
            $.ajax({
                url: siteurl+'/admin/gift/getcoupon_details/'+couponid,
                dataType: 'json',
                success: function(res){
                    if(res.status == 1){
                        $('#AddCouponForm').find('input[name="code"]').val(res.data.code);
                        $('#AddCouponForm').find('textarea[name="description"]').val(res.data.description);
                        $('#AddCouponForm').find('input[name="discount"]').val(res.data.discount);
                        $('#AddCouponForm').find('input[name="max_uses"]').val(res.data.max_uses);
                        $('#AddCouponForm').find('input[name="max_uses_user"]').val(res.data.max_uses_user);
                        if(res.data.is_fixed == 1){
                            $(document).find('.ui-radio').find('input[value="1"]').attr('checked', true);
                        }else{
                            $(document).find('.ui-radio').find('input[value="0"]').attr('checked', true);
                        }
                        $('.status option[value="'+res.data.status+'"]').attr('selected','selected');
                        $('.editcoupon_id').val(couponid);
                        $("#AddCoupon").find('.modal-title').html('Edit Coupon');
                        $("#AddCoupon").modal('show');

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
