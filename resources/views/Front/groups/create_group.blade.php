@extends('layouts.front')
 <link href="{{ asset('admintheme/vendors/summernote/dist/summernote-bs4.css') }}" rel="stylesheet" />
 <link href="{{ asset('admintheme/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
@section('title', 'Create Group')
@section('content')
<div class="container mb-5" style="max-width: 800px!important;">
   <div class="card">
      <div class="card-body">
         <div class="row">
            <div class="col-12">
               <div class="content-right-bar">
                  <h3 class="my-2 text-center mb-5">Create Group</h3>
                  <div class="w-lg-100 mx-auto">
                     <div class="row">
                        <!-- Input -->
                        <div class="col-md-12">
                           {{ Form::open(array('url' => '/groups/save_new_group', 'id' => 'AddGroupForm', 'files'=>true)) }}
                           <div class="row">
                              <div class="col-md-12 mb-1">
                                 <div class="form-group">
                                   {{ Form::label(__('messages.title'))}} <span class="req">*</span>
                       {{ Form::text('title', null, ['placeholder' => 'Title', 'class' => 'form-control required'])}}
                       @if ($errors->has('title'))
                        <span class="invalid-feedback" style="display:block;" role="alert">
                              <strong>{{ $errors->first('title') }}</strong>
                           </span>
                     @endif
                                 </div>
                              </div>
        

                              <div class="col-md-6 mb-1">
                                 <div class="form-group">
                                   {{ Form::label(__('banner_image'))}}
                                    <div class="custom-file">
                                       <input type="file" class="custom-file-input" name="banner_image">
                                        <span class="custom-file-label custom-file-control form-control-file"></span>
                                    </div>
                                 </div>
                              </div>

                              <div class="col-md-6 mb-1">
                                 <div class="form-group">
                                   {{ Form::label(__('messages.profile_image'))}}
                                    <div class="custom-file">
                                       <input type="file" class="custom-file-input" name="profile_image">
                                        <span class="custom-file-label custom-file-control form-control-file"></span>
                                    </div>
                                 </div>
                              </div>


                              <div class="col-md-12 mb-1" style="display: none;">
                                 <div class="form-group">
                                    <label for="">Add members</label>
                                 <select class="form-control users" name="members[]" multiple="">
                                </select>
                                 </div>
                              </div>

                      <div class="col-md-12 mb-1">
                          <div class="form-group">
                                    {{ Form::label(__('about'))}}
                                   {{ Form::textarea('about', null, ['placeholder' => 'Enter Description', 'class' => 'form-control','id' => 'summernote'])}}
                                   @if ($errors->has('about'))
                                       <span class="invalid-feedback" style="display:block;" role="alert">
                                          <strong>{{ $errors->first('about') }}</strong>
                                       </span>
                                 @endif
                                 </div>
                              </div>
                              <div class="col-md-12">
                      {{ Form::button('Submit', ['class' => 'btn btn-default add-group'])}}
                              </div>
                           </div>

                           {{ Form::close() }}
                           <!-- End Input -->
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('scripts')
<style type="text/css">
.form-control, select.form-control:not([size]):not([multiple]) {
   height: calc(2.25rem + 2px);
}
</style>
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.min.css') }}">
<script src="{{ asset('js/jquery-ui.min.js') }}" type="text/javascript"></script>

<link href="{{ asset('admintheme/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" />
<link href="{{ asset('admintheme/vendors/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" />

<link href="{{ asset('css/select2.css')}}" rel="stylesheet" />


<script src="{{ asset('admintheme/vendors/moment/min/moment.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('admintheme/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('admintheme/vendors/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/select2.js')}}" type="text/javascript"></script>
<script src="{{ asset('admintheme/js/main.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/validation.js') }}" type="text/javascript"></script>

<script src="{{ asset('admintheme/vendors/summernote/dist/summernote-bs4.js') }}" type="text/javascript"></script>
<script src="{{ asset('admintheme/vendors/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function(){

   $('#summernote').summernote({
     // toolbar: [
    //     ['style', ['bold', 'italic', 'underline']],
    //     ['fontsize', ['fontsize']],
    //     ['color', ['color']],
    //     ['para', ['ul', 'ol', 'paragraph']],
    //     ["table", ["table"]],
    //     ["insert", ["link", "picture", "video"]],
    //     ["view", ["fullscreen", "codeview", "help"]]
    // ],
    height: 150,
    });

   $('.users').select2({
  ajax: {
    url: siteurl+'/get/users',
    dataType: 'json'
    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
  }
});


$(".users").select2({
    // minimumInputLength: 2,
    // tags: [],
    // ajax: {
    //     url: siteurl+'/get/users',
    //     dataType: 'json',
    //     type: "GET",
    //     quietMillis: 50,
    //     data: function (term) {
    //         return {
    //             term: term
    //         };
    //     },
    //     results: function (data) {
    //         return {
    //             results: $.map(data, function (item) {
    //               console.log(itme.id);
    //                 return {
    //                     text: item.first_name,
    //                     slug: item.first_name,
    //                     id: item.id
    //                 }
    //             })
    //         };
    //     }
    // }

  //   ajax: {
  //   url: siteurl+'/get/users',
  //   processResults: function (data) {
  //     // Tranforms the top-level key of the response object from 'items' to 'results'
 
  //     return {
  //       results: data
  //     };
  //   }
  // }
minimumInputLength: 2,

  ajax: { 
   url: siteurl+'/get/users',
   type: "get",
   dataType: 'json',
   delay: 250,
   data: function (params) {
    return {
      searchTerm: params.term // search term
    };
   },
   processResults: function (response) {
     return {
        results: response
     };
   },
   cache: true
  }

});

   $(".one_to_one").change(function(){
      if ($(this).prop("checked")) {
         $(".users").removeAttr("multiple");
         $(".users").select2();
   
   }

}); 

   $(".one_to_many").change(function(){
      if ($(this).prop("checked")) {
         $(".users").attr("multiple", (this.checked) ? "multiple" : "");
         $(".users").select2();
     
   }
   });

     $('#date_1').datepicker({
         format: 'mm/dd/yyyy',
           keyboardNavigation: false,
           forceParse: false,
           calendarWeeks: true,
           autoclose: true
       }).on('changeDate', function (selected, endDateVal) {
          var startDate = new Date(selected.date.valueOf());
          var days = $('.challenge-type').find('option:selected').attr('data-days');
          if(days > 0){
            var endDateVal = new Date(selected.date);
            days = parseInt(days);
            endDateVal.setDate(endDateVal.getDate()+days);
            
            var dd = endDateVal.getDate();
             var mm = endDateVal.getMonth() + 1;
             var y = endDateVal.getFullYear();
             if(dd < 10){
               dd = "0"+dd;
             }
             if(mm < 10){
               mm = "0"+mm;
             }
             var someFormattedDate = mm + '/' + dd + '/' + y;
            $('.end-date').val(someFormattedDate);
         }
         
          $('#date_2').datepicker('setStartDate', startDate);
          $('#date_3').datepicker('setStartDate', startDate);
      });
      $('#date_2').datepicker({
         format: 'mm/dd/yyyy',
           keyboardNavigation: false,
           forceParse: false,
           calendarWeeks: true,
           autoclose: true
       }).on('changeDate', function (selected) {
         var endDate = new Date(selected.date.valueOf());
         $('#date_1').datepicker('setEndDate', endDate);
      });
      $('#date_3').datepicker({
         format: 'mm/dd/yyyy',
           keyboardNavigation: false,
           forceParse: false,
           calendarWeeks: true,
           autoclose: true
       });
      
     $('.add-group').click(function(e){
      var ret = validateForm('AddGroupForm');
      if(ret){
         $('#AddGroupForm').submit();
      }
     });

     $('.challenge-type').on('change', function(e){
      var amt = $(this).find('option:selected').attr('data-amt');
      var days = $(this).find('option:selected').attr('data-days');
      var end_date = $('.end-date').val();
      if((amt > 0) && ($('.amount').val() == '')){
         $('.amount').val(amt);
      }
      if((days > 0) && (end_date == '')){
         var endDateVal = $('#date_1').datepicker("getDate");
         if(endDateVal){
            days = parseInt(days);
            endDateVal.setDate(endDateVal.getDate()+days);
            
            var dd = endDateVal.getDate();
             var mm = endDateVal.getMonth() + 1;
             var y = endDateVal.getFullYear();
             if(dd < 10){
               dd = "0"+dd;
             }
             if(mm < 10){
               mm = "0"+mm;
             }
             var someFormattedDate = mm + '/' + dd + '/' + y;
            $('.end-date').val(someFormattedDate);
          }
      }

     });
});
</script>
@stop