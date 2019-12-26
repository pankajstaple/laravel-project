   @extends('layouts.front')
   

@section('content')
    <div class="container space-2 space-md-3 mt-5" style="max-width: 800px !important;">
      <!-- Title -->
         <div class="w-md-80 w-lg-50 text-center mx-md-auto mb-9">
          <span class="u-label u-label--sm u-label--success mb-2">Leave a Message</span>
          <h2 class=" font-weight-normal">Tell us about <span class="font-weight-semi-bold">yourself</span></h2>
         <p>Whether you have questions or you would just like to say hello, contact us.</p>
         <p class="thanks-message" style="display:none;">Thank you for contacting us!</p>
         <p class="thanks-message-failed" style="display:none;">Something went wrong. Please try again!</p>
         <p class="captcha-message-failed" style="display:none;color:red;">The Recaptcha field is required!</p>
        </div>
      <!-- End Title -->

      <div class="w-lg-80 mx-auto">
        <!-- Contacts Form -->
        <form class="js-validate" action="{{route('ajax_send_contact')}}" novalidate="novalidate" id="AddContactForm">
          @csrf()
          <div class="row">
            <!-- Input -->
            <div class="col-sm-6 mb-6">
              <div class="js-form-message">
                <label class="form-label">
                  Your name
                  <span class="text-danger">*</span>
                </label>

                <input type="text" maxlength="100" class="form-control required" name="name" placeholder="Jack Wayley" aria-label="Jack Wayley" required="" data-msg="Please enter your name." data-error-class="u-has-error" data-success-class="u-has-success">
              </div>
            </div>
            <!-- End Input -->

            <!-- Input -->
            <div class="col-sm-6 mb-6">
              <div class="js-form-message">
                <label class="form-label">
                  Your email address
                  <span class="text-danger">*</span>
                </label>

                <input type="email" maxlength="200" class="form-control required email" name="email" placeholder="jackwayley@gmail.com" aria-label="jackwayley@gmail.com" required="" data-msg="Please enter a valid email address." data-error-class="u-has-error" data-success-class="u-has-success">
              </div>
            </div>
            <!-- End Input -->

            <div class="w-100"></div>

            <!-- Input -->
            <div class="col-sm-6 mb-6">
              <div class="js-form-message mt-3">
                <label class="form-label">
                  Subject
                  <span class="text-danger">*</span>
                </label>

                <input type="text" maxlength="250" class="form-control required" name="subject" placeholder="Subject" aria-label="Web design" required="" data-msg="Please enter a subject." data-error-class="u-has-error" data-success-class="u-has-success">
              </div>
            </div>
            <!-- End Input -->

            <!-- Input -->
            <div class="col-sm-6 mb-6">
              <div class="js-form-message mt-3">
                <label class="form-label">
                  Your Phone Number
                  <span class="text-danger">*</span>
                </label>

                <input type="text" maxlength="15" class="form-control required" name="phone" placeholder="1-800-643-4500" aria-label="1-800-643-4500" required="" data-msg="Please enter a valid phone number." data-error-class="u-has-error" data-success-class="u-has-success">
              </div>
            </div>
            <!-- End Input -->
          </div>

          <!-- Input -->
          <div class="js-form-message mb-6">
            <label class="form-label mt-3">
              How can we help you?
              <span class="text-danger">*</span>
            </label>

            <div class="input-group">
              <textarea class="form-control required" rows="4" name="message" placeholder="Hi there, I would like to ..." aria-label="Hi there, I would like to ..." required="" data-msg="Please enter a reason." data-error-class="u-has-error" data-success-class="u-has-success"></textarea>
            </div>
          </div>
          <div class="js-form-message mb-6" style="margin-top: 2.0rem;"> 
          <div class="g-recaptcha" 
           data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
          </div>
          </div>
          <!-- End Input -->

          <div class="mt-4">
            <button type="button" class="btn btn-yellow btn-wide transition-3d-hover mb-4 contact-submit">Submit</button>
          </div>
        </form>
        <!-- End Contacts Form -->
      </div>
      
      <div class="clearfix space-2 mt-4">
      <div class="row no-gutters">
        <div class="col-sm-6 col-lg-3 u-ver-divider u-ver-divider--none-lg">

          <div class="text-center py-5 cns">
            <i class="fa fa-map-marker" aria-hidden="true"></i>
            <figure id="icon8" class="ie-height-56 max-width-8 mx-auto mb-3" style="">
            
            </figure>
            <h2 class="h6 mb-0">Address</h2>
            <p class="mb-0">{{$setting->address}}</p>
          </div>
       
        </div>

        <div class="col-sm-6 col-lg-3 u-ver-divider u-ver-divider--none-lg">
     
          <div class="text-center py-5 cns">
            <i class="fa fa-envelope" aria-hidden="true"></i>
            <figure id="icon15" class="ie-height-56 max-width-8 mx-auto mb-3" style="">
              
            </figure>
            <h3 class="h6 mb-0">Email</h3>
            <p class="mb-0">{{$setting->email}}</p>
          </div>
      
        </div>

        <div class="col-sm-6 col-lg-3 u-ver-divider u-ver-divider--none-lg">
    
          <div class="text-center py-5 cns">
            <i class="fa fa-phone-square" aria-hidden="true"></i>
            <figure id="icon16" class="ie-height-56 max-width-8 mx-auto mb-3" style="">
      
            </figure>
            <h3 class="h6 mb-0">Phone Number</h3>
            <p class="mb-0">{{$setting->telephone}}</p>
          </div>
   
        </div>

        <div class="col-sm-6 col-lg-3">
          
          <div class="text-center py-5 cns">
            <i class="fa fa-fax" aria-hidden="true"></i>
            <figure id="icon17" class="ie-height-56 max-width-8 mx-auto mb-3" style="">
            </figure>
            <h3 class="h6 mb-0">Fax</h3>
            <p class="mb-0">{{$setting->fax}}</p>
          </div>
        
        </div>
      </div>
    </div>
    </div>
    <!-- map section -->
    <div class="map-section mt-3">
      <iframe
      width="100%" height="450" frameborder="0" style="border:0" allowfullscreen
      src="https://www.google.com/maps/embed/v1/place?key={{$setting->google_map_key}}
        &q={{$setting->address}}">
      }
    </iframe>
    </div>

  
@endsection
@section('scripts')
<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#g-recaptcha-response").attr('required', true);
    $('.contact-submit').click(function(e){
      $(".thanks-message").hide();
      $(".thanks-message-failed").hide();
      $(".captcha-message-failed").hide();
      var ret = validateForm('AddContactForm');
      if(ret){
        $('.loader').show();
        var formData = $('#AddContactForm').serialize();
        var url = $('#AddContactForm').attr('action');
        $.ajax({
              url: url,
              data: formData,
              type: 'post',
              dataType: 'json',
              success: function(res){

                  if(res.status == 1){
                    $(this).removeAttr('disabled');
                      $('.loader').hide();
                      $(".thanks-message").show();
                      $('#AddContactForm').find('input').val("");
                      $('#AddContactForm').find('textarea').val("");
                  }else{
                   
                      $(this).removeAttr('disabled');
                      $('.loader').hide();
                      $(".captcha-message-failed").hide();  
                      $(".thanks-message-failed").show();  
                  }
              },
              error: function(xhr, status, error){
                var err = JSON.parse(xhr.status);
                 if(err == 422){
                      $('.loader').hide();
                      $(".captcha-message-failed").show();  
                    }else{
                      $('.loader').hide();
                      $(".thanks-message-failed").show();
                      $('.request-error').show().focus();    
                    }
                  
              }

          });
      }
    });
});
</script>

@stop