@extends('layouts.front')
@section('title', 'All Games')
@section('content')
<div class="container my-5" style="max-width: 800px!important;">
   <div class="card">
      <div class="card-body">
         <div class="row">
            <div class="col-12">
              @include('elements/printerror')
               <div class="content-right-bar">
                  <h3 class="my-2 text-center mb-5">Create Your Own Challenge</h3>
                  <div class="w-lg-100 mx-auto">
                     <div class="row">
                        <!-- Input -->
                        <div class="col-md-12">
                           {{ Form::open(array('url' => 'front/challenge', 'id' => 'AddChallengeForm', 'files'=>true)) }}
                           <div class="row">
                              <div class="col-md-6 mb-1">
                                 <div class="form-group">
                                   {{ Form::label(__('messages.title'))}} <span class="req">*</span>
                       {{ Form::text('title', null, ['placeholder' => 'Enter Title', 'class' => 'form-control required'])}}
                       @if ($errors->has('title'))
                        <span class="invalid-feedback" style="display:block;" role="alert">
                              <strong>{{ $errors->first('title') }}</strong>
                           </span>
                     @endif
                                 </div>
                              </div>
                              <div class="col-md-6 mb-1">
                                 <div class="form-group">
                              {{ Form::label(__('messages.tagline'))}}
                                {{ Form::text('tagline', null, ['placeholder' => 'Enter tagline', 'class' => 'form-control'])}}
                                @if ($errors->has('tagline'))
                                    <span class="invalid-feedback" style="display:block;" role="alert">
                                       <strong>{{ $errors->first('tagline') }}</strong>
                                    </span>
                              @endif
                                 </div>
                              </div>
                              <div class="col-md-12 mb-1">
                                 <div class="form-group">
                                    {{ Form::label(__('messages.description'))}}
                                   {{ Form::textarea('description', null, ['placeholder' => 'Enter Description', 'class' => 'form-control', 'rows' => '4'])}}
                                   @if ($errors->has('description'))
                                       <span class="invalid-feedback" style="display:block;" role="alert">
                                          <strong>{{ $errors->first('description') }}</strong>
                                       </span>
                                 @endif
                                 </div>
                              </div>
                              <div class="col-md-6 mb-1">
                                 <div class="form-group date_1">
                                    {{ Form::label(__('messages.start_date'))}} <span class="req">*</span>
                                    {{ Form::text('start_date', null, ['placeholder' => 'mm/dd/yyyy', 'id' => 'date_1', 'class' => 'form-control required start-date', 'autocomplete' => 'off'])}}
                                 </div>
                              </div>
                              <div class="col-md-6 mb-1">
                                 <div class="form-group">
                                    {{ Form::label(__('messages.end_date'))}} <span class="req">*</span>
                                    {{ Form::text('end_date', null, ['placeholder' => 'mm/dd/yyyy', 'id' => 'date_2', 'class' => 'form-control required end-date', 'autocomplete' => 'off'])}}
                                 </div>
                              </div>
                              <div class="col-md-6 mb-1">
                                 <div class="form-group">
                                  {{ Form::label(__('messages.amount'))}} <span class="req">*</span>
                                 {{ Form::text('amount', null, ['placeholder' => 'Enter amount', 'class' => 'form-control required amount'])}}
                                 @if ($errors->has('amount'))
                                          <span class="invalid-feedback" style="display:block;" role="alert">
                                          <strong>{{ $errors->first('amount') }}</strong>
                                          </span>
                                 @endif
                                 </div>
                              </div>
                              <div class="col-md-6 mb-1">
                                 <div class="form-group">
                                   {{ Form::label(__('messages.challenge_image'))}}
                                    <div class="custom-file">
                                       <input type="file" class="custom-file-input" name="challenge_image">
                                        <span class="custom-file-label custom-file-control form-control-file"></span>
                                    </div>

                                    


                                 </div>
                              </div>

                              <!--  <div class="col-md-6 mb-1">
                                 <div class="form-group">
                                    <label for="">Challenge Type</label>
                                    <div class="form-row">
                                       <div class="col-4">
                                          <div class="custom-control custom-radio">
                                             <input type="radio" id="customRadio31" name="customRadio" checked="" class="custom-control-input one_to_one">
                                             <label class="custom-control-label" for="customRadio31">One to one</label>
                                          </div>
                                       </div>
                                       <div class="col-4">
                                          <div class="custom-control custom-radio">
                                             <input type="radio" id="customRadio32" name="customRadio" class="custom-control-input one_to_many">
                                             <label class="custom-control-label " for="customRadio32">Group</label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div> -->

                              <div class="col-md-6 mb-1">
                                 <div class="form-group">
                                    <label for="">Challenge Type</label>
                                    <div class="form-row">
                                       <div class="col-4">
                                          <div class="custom-control custom-radio">
                                             <input type="radio" id="customRadio31" name="challenge_access" checked="" class="custom-control-input" value="private">
                                             <label class="custom-control-label" for="customRadio31">Private</label>
                                          </div>
                                       </div>
                                       <div class="col-4">
                                          <div class="custom-control custom-radio">
                                             <input type="radio" id="customRadio32" name="challenge_access" class="custom-control-input" value="public">
                                             <label class="custom-control-label" for="customRadio32">Public</label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>

                              <div class="col-md-6 mb-1">
                                 <div class="form-group">
                                    <label for="">Challenge Fee</label>
                                    <div class="form-row">
                                     
                                       <div class="col-4">
                                          <div class="custom-control custom-radio">
                                             <input type="radio" id="customRadio34" name="is_paid" checked="" class="custom-control-input fee" value="1">
                                             <label class="custom-control-label" for="customRadio34">Paid</label>
                                          </div>
                                       </div>

                                       <div class="col-4">
                                          <div class="custom-control custom-radio">
                                             <input type="radio" id="customRadio33" name="is_paid"  class="custom-control-input fee" value="0">
                                             <label class="custom-control-label" for="customRadio33">Free</label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>


                              <div class="col-md-12 mb-1">
                                 <div class="form-group">
                                    <label for="">Invite Users</label>
                                 <select class="form-control users" name="users[]" multiple="">
                                      
                                       <!-- <option value="0"></option> -->
                                       
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                <!--  <button type="submit" class="btn btn-yellow mb-2">Create</button> -->
                                {{ Form::button('Submit', ['class' => 'btn btn-yellow add-challenge'])}}
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

<script type="text/javascript">
$(document).ready(function(){

   // $(".users").select2();

   $('.users').select2({
      ajax: {
        url: siteurl+'/get/users',
        dataType: 'json'
        // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
      }
    });


$(".users").select2({
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

  $(document).find('.fee').on('click', function(){
    $('input.amount').removeClass('required');
      
      if($(this).val() == "1"){

        $('input.amount').addClass('required');
        $('input.amount').prop("disabled", false);
      }else{
        $('input.amount').attr('disabled', true).val("");
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
      
     $('.add-challenge').click(function(e){
      var ret = validateForm('AddChallengeForm');
      if(ret){
         /* check amount is greater equal 20 */
         var amt = $.trim($('#AddChallengeForm').find('.amount').val());
         if(amt >= 20){
          $('#AddChallengeForm').submit();
         }
         else{
          $('#AddChallengeForm').find('.amount').after('<p class="field-error">Enter minimum amount $20</p>');
          return;
         } 
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