@extends('layouts.admin')
 <!-- PLUGINS STYLES-->
 <link href="{{ asset('admintheme/vendors/summernote/dist/summernote.css') }}" rel="stylesheet" />
@section('content')
<div class="page-content fade-in-up">
    <div class="ibox">
        @include('elements.printerror')
        <div class="ibox-head">
            <div class="ibox-title">Top Visitors</div>
        </div>
        <div class="ibox-body">
            <div class="row">
                <div class="col-sm-12 form-group">
                    <div class="input-group">
                        <button class="btn btn-primary compose-btn">Compose mail</button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="users-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="select-all"></th>
                        <th>Rank</th>
                        <th>@sortablelink('first_name', "Bettor")</th>
                        <th>@sortablelink('registered_on', "Registered On")</th>
                        <th>@sortablelink('visit_count', "Total Visits")</th>
                        <th>@sortablelink('last_login', "Last Visit")</th>
                     
                    </tr>
                </thead>
                <tbody>
                    @if(count($top_visitors) > 0)
                    <?php $i = 1; ?>
                	@foreach($top_visitors as $log)
                	<tr>
                        <td><input type="checkbox" class="vistor-checkbox" name="email" value="{{$log->email}}"></td>
                        <td>{{ $i++ }}</td>
                        <td>{{ $log->first_name." ".$log->last_name }}</td>
                        <td>{{ (!empty($log->registered_on)?\Carbon\Carbon::parse($log->registered_on)->format('m/d/Y H:i:s'):"")}}</td>
                        <td>{{ $log->visit_count }}</td>
                        <td>{{ (!empty($log->last_login)?\Carbon\Carbon::parse($log->last_login)->format('m/d/Y H:i:s'):"")}}</td>
                    </tr>
                  
                	@endforeach
                    @else
                        <tr><td colspan="5">No record to display.</td></tr>
                    @endif
                    
                </tbody>
            </table>
            </div>
            {{ $top_visitors->appends($_GET)->links() }}
        </div>

    </div>
</div>
<!-- The Modal -->
<div class="modal" id="ComposeMail">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Compose mail</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="ibox-body">
                        {{ Form::open(array('url' => route('sendgift'), 'id' => 'ComposeEmailForm', 'files'=>true, 'class' => 'form-horizontal')) }}
                        <div class="row">
                        <div class="col-lg-12 col-md-12">
                        <div class="ibox" id="mailbox-container">
                            <div class="mailbox-header d-flex justify-content-between">
                                <!--<h5 class="inbox-title">Compose mail</h5>
                                <div class="inbox-toolbar m-l-20">
                                    <button class="btn btn-default btn-sm" data-action="reply" data-toggle="tooltip" data-original-title="Reply"><i class="fa fa-reply"></i></button>
                                    <button class="btn btn-default btn-sm" data-action="delete" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash-o"></i></button>
                                </div>-->
                            </div>
                            <div class="mailbox-body">
                                <form class="form-horizontal" action="javascript:void(0)" method="POST" if="compose_form">
                                    <div class="form-group row">
                                        <label class="col-sm-2 control-label">To:</label>
                                        <div class="col-sm-10">
                                            <input class="form-control to-email required" type="text" name="to" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 control-label">Subject:</label>
                                        <div class="col-sm-10">
                                            <input class="form-control subject required" type="text" name="subject">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 control-label">Message:</label>
                                        <div class="col-sm-10">
                                             <textarea id="summernote" class="message" name="message">
                                                <!--<h4>Thank you for your attention</h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur velit, corporis iste. Dolorem sapiente at, quibusdam fuga ea voluptatem iste. Cupiditate dignissimos, iure impedit, perferendis in beatae fuga
                                                    voluptate, sapiente pariatur, libero ab odit. Placeat saepe sunt ipsam laboriosam temporibus nostrum ea optio, dolore soluta.</p>-->
                                            </textarea>
                                        </div>
                                    </div>
                                   
                                </form>
                            </div>
                        </div>
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
        <button class="btn btn-success send-email" type="button">Send</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
@endsection
@section('scripts')
<!-- PAGE LEVEL PLUGINS-->
<script src="{{ asset('admintheme/vendors/summernote/dist/summernote.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
    
    $('.compose-btn').click(function(){
        var emailArr = [];
        $('.vistor-checkbox:checked').each(function(){
            emailArr.push($(this).val());
        });
        var allEmails = emailArr.join(",");
        $('.to-email').val(allEmails);
        $("#ComposeMail").modal('show');
    });
    $('#summernote').summernote({
        height: 150,
    });
    $('.note-popover').css({
        'display': 'none'
    });

    $(".select-all").click(function(e){
        if($(this).is(':checked'))
            $('.vistor-checkbox').prop('checked', true);
        else
            $('.vistor-checkbox').prop('checked', false);
    });

    $('.send-email').on('click', function(){
        $(document).find('.field-error').removeClass('order-10');
        var ret = validateForm('ComposeEmailForm');

        if(ret){
            /* Save Coupon code */
            $('.loader').show();
            $('#ComposeEmailForm').find('.field-error').remove();
            var url = $('#ComposeEmailForm').attr('action');
            var data = $('#ComposeEmailForm').serialize();
            $.ajax({
                url: url,
                data: data,
                type: 'post',
                dataType:'json',
                success: function(data) {
                    if(data.status==1){
                        $('.success-message').show();
                        $("#ComposeMail").find('.to-email').val("");
                        $("#ComposeMail").find('.subject').val("");
                        $("#ComposeMail").find('.message').text("");
                        $("#ComposeMail").modal('hide');
                        $('.loader').hide();
                        setTimeout(function(){
                             $('.success-message').hide();
                        },2000);
                        //location.reload();
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
