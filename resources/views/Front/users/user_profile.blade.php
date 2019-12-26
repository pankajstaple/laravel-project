@extends('layouts.front')
@section('content')

@php
$countries=config('constants.country_list');
$provinces=config('constants.province_list');
$states=config('constants.state_list');

@endphp


<link rel="stylesheet" type="text/css" href="{{url('css/jquery.Jcrop.min.css')}}">
<div class="container mb-5">
@include('elements.printerror')

    <div class="card">
      <div class="card-body">
        <!--  -->
        <div class="row">
          
          <?php 
          $year = '';
          $month = '';
          $day = '';

          $dob = $user['profile']['dob'];
          if(!empty($dob)){
          	$dob = explode('-',$dob);
          	$year = $dob[0];
          	$month = $dob[1];
          	$day = $dob[2];
          }
          ?>

          
          <div class="col-12">
            <div class="content-right-bar">
              <h3 class="my-2 text-center mb-5">Basic Settings</h3>
              <div class="w-lg-100 mx-auto">
               <form class="saveUserProfileForm"  id="saveUserProfileForm"  action="{{ url('/save_user_profile') }}">
                <div class="row">
                  <!-- Input -->
                  <div class="col-md-3">
                    <div class="profile-img-box text-center">

                    <?php
                      if(empty($user['profile_image'])){
                        $profile_image = url('/').'/profile_image/admin-avatar.png';  
                      }else{
                        $profile_image = url('/').'/profile_image/'.$user['profile_image'];
                      }
                     ?>

                      <div class="profile-img mb-2" style="background-image: url({{$profile_image}});"></div>

                      <!-- <button class="btn btn btn-outline-secondary mb-2" type="button" data-toggle="modal" data-target="#editPhotoModal"><i class="fa fa-camera"></i> Edit Profile</button> -->

                      <button class="btn btn btn-outline-secondary mb-2 showPhotoModal" type="button"><i class="fa fa-camera"></i> Edit profile image</button>

                      <!-- <input type="file" name="profile_image" class="form-control"> -->

                      <br>
                      <a href="javascript:;" data-toggle="modal" data-target="#changePasswordModal" >Change password</a>


                    </div>
                  </div>
                  <div class="col-md-9">
                    <div class="row">
                    <div class="col-md-6 mb-1">
                      <div class="form-group">
                        <label for="">First Name</label>
                        <input type="text" class="form-control removeErrorField" id="first_name" name="first_name" value="{{$user['first_name']}}" >
                      </div>
                    </div>
                    <div class="col-md-6 mb-1">
                      <div class="form-group">
                        <label for="">Last Name</label>
                          <input type="text" class="form-control removeErrorField" id=""  name="last_name" value="{{$user['last_name']}}" >
                      </div>
                    </div>
                    <div class="col-md-6 mb-1">
                      <div class="form-group">
                      <label for="">Email</label>
                                <input type="email" class="form-control" id="" name="email" value="{{$user['email']}}" disabled="disabled">
                      </div>
                    </div>

                    <div class="col-md-6 mb-1">
                      <div class="form-group">
                        <label for="">Birthday</label>
                        <div class="form-row">
                          <div class="col-4">
                         <select class="form-control" name="month">
                          <?php  $monthDetail = config('constants.month'); ?>
                            @foreach ($monthDetail as $key => $value)
                            	<option value="{{$key}}" <?php if($month ==$key){echo 'selected=selected';}?>  >{{$value}}</option>
                          	@endforeach
                            </select>
                          </div>
                          <div class="col-4">
						<select class="form-control" name="day">
						<?php for($i=1;$i<=31;$i++){ 
						if($i<10){
							$i='0'.$i;
						}
						?>
						<option value="{{$i}}" <?php if($i ==$day){echo 'selected=selected';}?> >{{$i}}</option>
						<?php } ?>
						</select>
                          </div>
	                      <div class="col-4">
	                   		<select class="form-control" name="year">
	                        <?php for($i=1960;$i<=2080;$i++){ ?>
	                          <option value="{{$i}}" <?php if($i ==$year){echo 'selected=selected';}?> >{{$i}}</option>
	                         <?php } ?>
	                        </select>
	                      </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12 mb-1">
                      <div class="form-group">
                        <label for="">Address</label>
                        <div class="form-row">
                       	  <div class="col-sm-8 mb-2">
	                        <input type="text" class="form-control" id="" placeholder="Address" name="address" value="{{$user['profile']['address']}}">
	                      </div>
                          <div class="col-sm-4 mb-2">
                            <input type="text" class="form-control" id="" placeholder="City" name="city" value="{{$user['profile']['city']}}">
                          </div>
                          <div class="col-sm-4 mb-2">

                            <div id="state_field" class="customer-state form-field" style="display: none;">
                            <span class="field-data">
                            <select name="" autocomplete="off" placeholder="State" id="state" class="select state-select form-control" autofocus>
                            <option value="" selected="selected">- Select State -</option>
                            @foreach($states as $code => $state )
                              <option value="{{$code}}" <?php if($user['profile']['state'] ==$code){echo 'selected=selected';}?> >{{$state}}</option>
                            @endforeach
                            </select>
                            <div class="field-errors">
                            </div>
                          </span>
                        </div>



                          <div id="province_field" class="customer-province form-field" style="display: none;">
                            <span class="field-data">
                            <select name="province" autocomplete="off" placeholder="Province" id="province" class="select province-select form-control" autofocus>
                              <option value="" selected="selected">- Select Province -</option>
                              @foreach($provinces as $code => $province )
                              <option value="{{$code}}" <?php if($user['profile']['state'] ==$code){echo 'selected=selected';}?> >{{$province}}</option>
                              @endforeach
                            </select>
                            <div class="field-errors">
                            </div>
                          </span>
                        </div>

                        <div id="state_custom_field" class="customer-state-custom form-field" style="">
                            <span class="field-data">
                              <input name="state_custom_field" placeholder="State" id="state_custom" value="{{$user['profile']['state']}}" class="form-control state_text" type="text" autofocus/>
                              <div class="field-errors"></div>
                            </span>
                          </div>
                          <input type="hidden" value="{{$user['profile']['state']}}" class="required hidden-state" name="state" id="HiddenState">

                            <!-- <input type="text" class="form-control" id="" placeholder="State" name="state" value="{{$user['profile']['state']}}"> -->


                          </div>
                          <div class="col-sm-4 mb-2">

                            <select name="country" autocomplete="off" placeholder="Country" id="Card_country" class="select custom-select " autofocus>
                              <option value="">- Select Country -</option>
                              @foreach($countries as $code => $country)
                              @if($country == "optgroup")
                              <optgroup></optgroup>
                              @else
                              <option value="{{$code}}" <?php if($user['profile']['country'] ==$code){echo 'selected=selected';}?> >{{$country}}</option>
                              @endif
                              @endforeach
                            </select>


                            <!-- <input type="text" class="form-control" id="" placeholder="Country" name="country" value="{{$user['profile']['country']}}"> -->
                          </div>
                          <div class="col-sm-4 mb-2">
                            <input type="text" class="form-control" id="" placeholder="Zip" name="zip" value="{{$user['profile']['zip']}}">
                          </div>
                        </div>
                      </div>
                    </div>

                    
                    <div class="col-md-6 mb-1">
                      <div class="form-group">
                        <label for="">Gender</label>
                        <div class="form-row">
                          <div class="col-4">
                            <div class="custom-control custom-radio">
                               <input type="radio" id="customRadio21" name="gender" class="custom-control-input" <?php if($user['profile']['gender'] =='male'){echo 'checked=checked';}?> value="male">
                              <label class="custom-control-label" for="customRadio21">Male</label>
                           </div>
                          </div>
                          <div class="col-4">
                            <div class="custom-control custom-radio">
                               <input type="radio" id="customRadio22" name="gender" class="custom-control-input" <?php if($user['profile']['gender'] =='female'){echo 'checked=checked';}?> value="female">
                              <label class="custom-control-label" for="customRadio22">Female</label>
                           </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 mb-1">
                      <div class="form-group">
                        <label for="">Height</label>
                        <div class="form-row">
                          <div class="col-3">
                            <select class="form-control" name="height_feet">
                            <?php for($i=1;$i<=7;$i++){ ?>
                              <option value="{{$i}}" <?php if($user['profile']['height_feet'] ==$i){echo 'selected=selected';}?>>{{$i}}</option>
                             <?php } ?>
                            </select>
                          </div>
                          <div class="col-3">
                              <select class="form-control" name="height_inch">
                              <?php for($i=0;$i<=11;$i++){ ?>
                              <option value="{{$i}}" <?php if($user['profile']['height_inch'] ==$i){echo 'selected=selected';}?>>{{$i}}</option>
                             <?php } ?>
                            </select>
                          </div>                               
                      </div>
                    </div>

                  </div>

                  <div class="col-md-12 mb-1">
                      <div class="form-group">
                        <label for="">Unit of Measure</label>
                        <div class="form-row">
                          <div class="col-md-3 col-sm-4">
                            <div class="custom-control custom-radio">
                             <input type="radio" id="customRadio24" name="weight_unit" class="custom-control-input" value="Lbs" <?php if($user['profile']['weight_unit'] =='Lbs'){echo 'checked=checked';}?>>
                              <label class="custom-control-label" for="customRadio24">Pounds</label>
                           </div>
                          </div>
                          <div class="col-md-3 col-sm-4">
                            <div class="custom-control custom-radio">
                               <input type="radio" id="customRadio25" name="weight_unit" class="custom-control-input" value="Kg" <?php if($user['profile']['weight_unit'] =='Kg'){echo 'checked=checked';}?>>
                              <label class="custom-control-label" for="customRadio25">Kilograms</label>
                           </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-yellow mb-2 saveUserProfileButton">Save Changes</button>
                    </div>


                      <input type="hidden" name="user_id" value="{{$user['id']}}">
                      <input type="hidden" name="profile_image_uploaded" value="">
                    




                  </div>
                  <!-- End Input -->
                  


                </div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
        </div>
      </div>
    </div>

    </div>

        <!-- Modal -->
    <div class="modal fade" id="editPhotoModal" tabindex="-1" role="dialog" aria-labelledby="editPhotoModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="">Edit Picture</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form class="uploadProfileImageForm" id="uploadProfileImageForm" action="{{ url('/save_user_profile_image') }}" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="post_img_section" style="width: 100%;">
              <div class="post_img_privew">
               <div class="image-section p-2 text-center ">            
                    <img id="PostImage" class="crop" src="{{url('profile_image/admin-avatar.png')}}" alt="your image">
                </div>
              </div>
              <div class="post_img_details">
                <input type="file" name="post_image" class="sr-only" id="imgInp">
                <label for="imgInp" style="color:#faa828;cursor: pointer;"><i class="fa fa-camera"></i> Change Photo</label>
                <p>JPG or PNG, 10MB limits</p>
                <p>A photo uploaded here will be visible to all players and is not a official weigh-in photo.</p>
                <div class="remove_icon"><i class="fa fa-times"></i> Remove Photo</div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-yellow saveUserProfileImageButton">Save changes</button>
          </div>

          <input type="hidden" class="image-uploaded" name="image_uploaded" />
          <input type="hidden" id="x" name="x" value=""/>
          <input type="hidden" id="y" name="y" />
          <input type="hidden" id="w" name="w" />
          <input type="hidden" id="h" name="h" />



          </form>
        </div>
      </div>
    </div>
    <!-- /modal -->

    <!-- Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="">Change Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form class="updateUserPasswordForm" id="updateUserPasswordForm" action="{{ url('user/changepassword') }}">
          <div class="modal-body">

            <div class="form-group">
              <label for="">Current Password</label>
              <input type="password" class="form-control removeErrorField" id="" name="old_password" value="" >
            </div>

            <div class="form-group">
              <label for="">New Password</label>
              <input type="password" class="form-control removeErrorField" id="" name="password" value="" >
            </div>

            <div class="form-group">
              <label for="">Confirm New Password</label>
              <input type="password" class="form-control removeErrorField" id="" name="password_confirmation" value="" >
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-yellow saveUserPasswordButton">Save changes</button>
          </div>


          </form>
        </div>
      </div>
    </div>
    <!-- /modal -->

    
    <style type="text/css">

/*28/12/2018*/
.profile-img-box {
    display: flex;
    flex-direction: column;
    align-items: center;
}
.profile-img {
    width: 170px;
    height: 170px;
    background-color: #e6e6e6;
    border: 1px solid #ececec;
    background-size: contain;
    background-position: top center;
    background-repeat: no-repeat;
 
}


 #PostImage {
    /*background-color: #FFF;
    width: 500px;
    height: auto;
    font-size: 24px;
    display: inline-block;*/
  }
.jcrop-vline, .jcrop-hline {
    background: #0F0F0F url(Jcrop.gif);
}
#imgInp {
    position: absolute;
    visibility: hidden;
}
.group-profile-box {
  display: flex;
  align-items: flex-start;
  flex-wrap: wrap;
}
.write_text {
    background-color: #fff;
    border: 1px solid #ececec;
    padding: .5rem;
}


.remove_icon {
    color: #f00;
    line-height: 1.2;
    font-size: 1rem;
    cursor: pointer;
}
.image-section {
  position: relative;
}
.jcrop-holder {
  margin-left: auto;
  margin-right: auto;
}
.crop {
  max-width: 100%;
}
.add_photo, .write_post {
  cursor: pointer;
}
.post_img_privew {
  width: 150px;
  display: inline-block;
  float: left;
}
.post_img_details {
    width: calc(100% - 150px);
    display: inline-block;
    float: left;
    padding: 1rem;
}
.post_img_section {
    background-color: #f6f6f6;
    display: inline-block;
}
</style>

@endsection



@section('scripts')
<script type="text/javascript" src="{{url('js/jquery.Jcrop.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(document).on('click','.saveUserProfileButton',function(e){
		e.preventDefault();
		if($('input[name="first_name"]').val()=='') {

      $('input[name="first_name"]').after('<p class="field-error">This field is required</p>');

			$('html, body').animate({ scrollTop: 0 }, 'slow', function () {
		        });
			return false;
		}

    if($('input[name="last_name"]').val()==''){
      $('input[name="last_name"]').after('<p class="field-error">This field is required</p>');
      $('html, body').animate({ scrollTop: 0 }, 'slow', function () {
            });
      return false;
    }
		var data = $('form.saveUserProfileForm').serialize();
		var url = $('form.saveUserProfileForm').attr('action');
		var token = $('meta[name="csrf_token"]').attr('content');
		$('.loader').show();
		$.ajax({
		  url: url,
		  data: data,
		  type: 'post',
		  headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
		  success: function(data) {
		    $('.loader').hide();
		    $('.success-message').show();

		    $('html, body').animate({ scrollTop: 0 }, 'slow', function () {
		    });

		    window.setTimeout(function() {
		      $('.success-message').hide();
		    }, 3000);
		  },
		  error: function(error){
        if(error.status === 422 ){
          $('.field-error').remove();
              var err = error.responseJSON;
                  $.each(err.errors, function (i, v) {                   
                      $('input[name='+i+']').after('<p class="field-error">'+v+'</p>');
                      $('select[name='+i+']').after('<p class="field-error">'+v+'</p>');
                  });
                  $("html, body").animate({ scrollTop: 0 }, "slow");
          }else{
              alert('Please refresh the page or try again');
              //$('.alertModal').modal('show');
          }



		    $('.loader').hide();
		  }
		});

	});


  $(document).on('blur','.removeErrorField',function(e)
{
  if ($(this).val() !=''){
    $(this).next($('.field-error')).remove();
  }

});

  var jcrop_api = null;

$("#imgInp").change(function(){
        $('.post-error-msg').html("").hide();
        if (jcrop_api !== null)
        jcrop_api.destroy();

        var input = this;
        var fileErrorMsg = '';

        console.log(this.files);
        //alert(this.files.naturalHeight);
        //alert(this.files.naturalWidth);

        if (this.files && this.files[0] && this.files[0].name.match(/\.(jpg|jpeg|png)$/) ) {
            if(this.files[0].size>10485760) {
              fileErrorMsg = 'File size is larger than 10MB!';
            }
        } else { 
          fileErrorMsg = 'Upload correct image format (jpg, jpeg, png) file!';
        }

        if(fileErrorMsg != ''){
          $('.post-error-msg').html(fileErrorMsg).show();
          alert(fileErrorMsg);
          return;
        }

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#PostImage').attr('src', e.target.result);

                /*var h = document.querySelector('#PostImage').naturalHeight;
                var w = document.querySelector('#PostImage').naturalWidth;*/



                 window.setTimeout(function() {
                    var domElement = $('.crop')[0]; // or document.getElementById('yourImageId');
                    var h = (domElement.naturalHeight);
                    var w = (domElement.naturalWidth);
                    /*alert(h);
                    alert(w);*/
                    $(document).find('.crop').Jcrop({  
                          onSelect: updateCoords,
                          bgOpacity:   0.4,
                          setSelect:   [ 788, 824, 0, 0 ],
                          trueSize: [w,h]
                      },function(){ jcrop_api=this});
                  }, 500);

                
            }
            $('.image-uploaded').val("1");
            reader.readAsDataURL(input.files[0]);
        }
    });


$('.remove_icon').click(function(){
      $('.image-uploaded').val("");
      $('form.uploadProfileImageForm')[0].reset();
      $("#PostImage").attr("src","{{url('profile_image/admin-avatar.png')}}");
        jcrop_api.destroy();
      jcrop_api.destroy();
    });

function updateCoords(c)
    {
      
      $('#x').val(c.x);
      $('#y').val(c.y);
      $('#w').val(c.w);
      $('#h').val(c.h);
    };  

//saveUserProfileImageButton
$(document).on('click','.saveUserProfileImageButton',function(e){
    var data = new FormData($('form.uploadProfileImageForm')[0]);
    var url = $('form.uploadProfileImageForm').attr('action');
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
        var img  = "{{url('/')}}/profile_image/"+data.fileName;
        $(".profile-img").css("background-image", "url("+img+")");
        $('input[name="profile_image_uploaded"]').val(data.fileName);
        $('#editPhotoModal').modal('hide');
        $('form.uploadProfileImageForm')[0].reset();
        $("#PostImage").attr("src","{{url('profile_image/admin-avatar.png')}}");
        jcrop_api.destroy();
      },
      error: function(jqXHR, exception){
        $('.loader').hide();
        $('#editPhotoModal').modal('hide');
         var msg = '';
       if (jqXHR.status === 0) {
           msg = 'Not connect.\n Verify Network.';
       } else if (jqXHR.status == 404) {
           msg = 'Requested page not found. [404]';
       } else if (jqXHR.status == 500) {
           msg = 'Internal Server Error [500].\n' + jqXHR.responseText;
       } else if (exception === 'parsererror') {
           msg = 'Requested JSON parse failed.';
       } else if (exception === 'timeout') {
           msg = 'Time out error.';
       } else if (exception === 'abort') {
           msg = 'Ajax request aborted.';
       } else {
           msg = 'Uncaught Error.\n' + jqXHR.responseText;
       }
       //alert(msg);

      }
    });


});




$(document).on('click','.saveUserPasswordButton',function(e){
  //$('form.createNewuserForm').submit();
  //updateUserPasswordForm
  //return true;

  var data = $('form.updateUserPasswordForm').serialize();
    var url = $('form.updateUserPasswordForm').attr('action');
    var token = $('meta[name="csrf_token"]').attr('content');
    $('.loader').show();
    $.ajax({
      url: url,
      data: data,
      type: 'post',
      dataType: 'JSON',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
      success: function(data) {
        $('.loader').hide();
        if(data.error==1){
          $('input[name="old_password"]').after('<p class="field-error">'+data.msg+'</p>');

        }else{
          $('#changePasswordModal').modal('hide');
          $('form.updateUserPasswordForm')[0].reset();
          $('.success-message').show();
          $('html, body').animate({ scrollTop: 0 }, 'slow', function () {

        });

        window.setTimeout(function() {
          $('.success-message').hide();
        }, 2000);
        }

      },
      error: function(error){
        if(error.status === 422 ){
          $('.field-error').remove();
              var err = error.responseJSON;
                  $.each(err.errors, function (i, v) {
                      $('input[name='+i+']').after('<p class="field-error">'+v+'</p>');
                      
                  });
                  //$("html, body").animate({ scrollTop: 0 }, "slow");
          }else{
              alert('Please refresh the page or try again');
          }
        $('.loader').hide();
      }
    });



});


$("#Card_country").change(function(){
    $('.hidden-state').val("");
    var country= $( "#Card_country" ).val();
      if(country=='US'){
        $("#province_field").hide();
        $("#state_custom_field").hide();
        $("#state_field").show();
        //$('#province').addClass('required');
        //$('#testID').removeClass('nameOfClass');


      }
      else if(country=='CA'){
        $("#state_field").hide();
        $("#state_custom_field").hide();
        $("#province_field").show();
      }else{
        $("#state_field").hide();
        $("#province_field").hide();
        $("#state_custom_field").show();
        $("#state_custom").val("");
      }

      $(this).next($('.field-error')).remove();
  });



  $(".state-select").on('change', function(){
    var selState = $(".state-select").find('option:selected').val();
    $('.hidden-state').val(selState);
    $('.hidden-state').next($('.field-error')).remove();
  });

  $(".province-select").on('change', function(){
    var selState = $(".province-select").find('option:selected').val();
    $('.hidden-state').val(selState);
    $('.hidden-state').next($('.field-error')).remove();
  });

  $(".state_text").on('blur', function(){
    var selState = $(".state_text").val();
    $('.hidden-state').val(selState);
    $('.hidden-state').next($('.field-error')).remove();
  });



  //showPhotoModal editPhotoModal
  $(document).on('click','.showPhotoModal',function(e){
    e.preventDefault();
    $("#PostImage").attr("src","{{url('profile_image/admin-avatar.png')}}");

    //$("#PostImage").css('width','300px')

    $('#editPhotoModal').modal('show');
    if (jcrop_api !== null)
    jcrop_api.destroy();

  });

});


$(document).ready(function(){
  var state = $('select[name="country"]').val();
  if(state=='US'){
    $('div#state_field').show();
    $('div#province_field').hide();
    $('div#state_custom_field').hide();
  }else if(state=='CA'){
    $('div#state_field').hide();
    $('div#province_field').show();
    $('div#state_custom_field').hide();
  }else{
    $('div#state_field').hide();
    $('div#province_field').hide();
    $('div#state_custom_field').show();
  }
});

//userProfileTab
</script>

@endsection('scripts')