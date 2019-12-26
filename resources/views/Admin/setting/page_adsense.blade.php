@extends('layouts.admin')
@section('content')
<div class="page-content fade-in-up">
 <div class="row">
  <div class="col-md-12">
      <div class="ibox">
        @if(session()->has('success'))
               <p class="alert alert-success  text-center md_top" style="width:100%">
                  {{ session()->get('success') }}
                  <i class="fa fa-close pull-right mar-top"></i>
               </p>
            @endif
            @if(session()->has('error'))
               <p class="alert alert-danger  text-center md_top" style="width:100%">
                  {{ session()->get('error') }}
                  <i class="fa fa-close pull-right mar-top"></i>
               </p>
            @endif
          <div class="ibox-head">
              <div class="ibox-title">Page Ad Sense</div>
          </div>
          <div class="ibox-body col-md-9" style="">
              {{ Form::open(array('url' => 'admin/setting/pageadsense', 'id' => 'PageadsenseForm', 'files'=>true)) }}

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Type</label>
                            <div class="col-sm-10">
                               <select class="form-control required adsense_type" name="name">
                               @foreach($page_adsense as $p)
                              <option value="{{$p['name']}}">{{ucfirst($p['name'])}}</option>
                              @endforeach
                              </select>
                            </div>
                        </div>

                         <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Adsense Content</label>
                            <div class="col-sm-10">
                              <textarea class="form-control textarea_value" style="height: auto;" name="value" rows="3" value="">{{$page_adsense[0]['value']}}</textarea>
                            </div>
                        </div>

                         <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Adsense Script</label>
                            <div class="col-sm-10">
                              <textarea class="form-control textarea_value_script" style="height: auto;" name="script_value" rows="3" value="">{{$page_adsense_script[0]['value']}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 ml-sm-auto">
                                <button class="btn btn-info PageadsenseFormBtn" type="submit">Submit</button>
                            </div>
                        </div>
                    <div></div>
                {{ Form::close() }}
          </div>
      </div>
  </div>
 </div>
</div>

@endsection
@section('scripts')


<script type="text/javascript">
var page_adsense = <?php echo json_encode($page_adsense); ?>;
var page_adsense_script = <?php echo json_encode($page_adsense_script); ?>;



$(function(){
 $('.adsense_type').change(function(e){
  var type = $(this).val();
     $.each(page_adsense, function (i, v) {
                    if(v.name == type){
                      $(".textarea_value").val(v.value);
                    }
                  
                        });
       $.each(page_adsense_script, function (i, v) {
                    if(v.name == type){
                      $(".textarea_value_script").val(v.value);
                    }
                  
                        });

 });
});

$(document).on('click','.PageadsenseFormBtn',function(e){
    var data = new FormData($('form.PageadsenseForm')[0]);
    var url = $('form.PageadsenseForm').attr('action');
    var token = $('meta[name="csrf_token"]').attr('content');
    $('.loader').show();
    $.ajax({
      url: url,
      data: data,
      type: 'post',
      processData: false,
      contentType: false,
      dataType : 'JSON',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
      success: function(data) {
        $('.loader').hide();
      
      }
    });

  });



</script>
@stop
