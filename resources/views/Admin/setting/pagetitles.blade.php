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
              <div class="ibox-title">Page Titles</div>
          </div>
          <div class="ibox-body col-md-9" style="">
              {{ Form::open(array('url' => 'admin/setting/pagetitles', 'id' => 'PagetitleForm', 'files'=>true)) }}

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Select Page</label>
                            <div class="col-sm-10">
                                {{ Form::select('page_name', $pages, 0 ,['id' => 'page_name_id','class' => 'form-control required', 'placeholder' => '--select pages--'])}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Page Title</label>
                            <div class="col-sm-10">
                                <input class="form-control required" id="title" name="title" placeholder="" type="text" value="">
                                <input class="form-control " id="listdata" name="listdata"  type="hidden" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 ml-sm-auto">
                                <button class="btn btn-info add-pagetitle" type="button">Submit</button>
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
$(function(){
 $('.add-pagetitle').click(function(e){
  var ret = validateForm('PagetitleForm');
  if(ret){
    $('#PagetitleForm').submit();
  }
 });

 $('#page_name_id').on('change', function(){
  var pageId = $(this).val();
  var listdata = $('#listdata').val();
  if(pageId < 1){
    $('#title').attr("value",'');
  }
  if(listdata){
    $('.field-error').hide();
    var json = $.parseJSON(listdata);
        for (var i=0;i<json.length;++i)
        {
          var jsonId = json[i].id;
          if(jsonId == pageId){
            $('#title').attr("value",json[i].title);
          }
        }
  }
  if( !listdata ) {
    $('.field-error').hide();
    $.ajax({
                url: siteurl+'/admin/setting/ajax_search_page_title',
                data: {page_id:pageId, _token: '{{ csrf_token() }}'},
                type: 'post',
                dataType:'json',
                success: function(response) {
                    if(response.status==1){
                       $('#listdata').attr("value",response.list);
                       $('#title').attr("value",response.data.title);
                    }else{
                        $('#title').attr("value",'');
                    }
                    $('.loader').hide();
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
  }
 })
});
</script>
@stop
