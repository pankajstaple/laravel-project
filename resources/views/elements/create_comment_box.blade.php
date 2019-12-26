<style type="text/css">
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

/*.remove_icon {
  width: 30px;
  height: 30px;
  background-color: #f6f6f6;
  color: #f00;
  line-height: 30px;
  font-size: 2rem;
  position: absolute;
  right: .5rem;
  border-radius: 50%;
  cursor: pointer;
}*/

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
  width: 280px;
  display: inline-block;
  float: left;
}
.post_img_details {
    width: calc(100% - 280px);
    display: inline-block;
    float: left;
    padding: 1rem;
}
.post_img_section {
    background-color: #f6f6f6;
    display: inline-block;
}
</style>

<div class="alert alert-danger alert-dismissible fade show message-notfriend" role="alert" style="display:none;">
       <strong>Alert!</strong> Please send friend request 
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
   </div>

<div id="info"></div>
@if(isset($challenges))
<form id="PostComment" action="{{route('save_user_post')}}" method="post" runat="server" enctype="multipart/form-data">
@elseif(isset($groupdetail->id))
<form id="PostComment" action="{{route('save_group_post')}}" method="post" runat="server" enctype="multipart/form-data">
  @elseif(isset($challenge_posts))
<form id="PostComment" action="{{route('save_challenge_post')}}" method="post" runat="server" enctype="multipart/form-data">
  @endif
@csrf()
@if(isset($challenge_posts))
<input type="hidden" name="challenge_id" value="@if(isset($challenge->id)){{base64_encode($challenge->id)}}@endif"/>
@endif
@if(isset($groupdetail->id))
<input type="hidden" name="group_id" value="{{base64_encode($groupdetail->id)}}"/>
@endif

 <section class="add-feed mb-4">
  <ul class="list-inline border-bottom py-2 px-3 mb-0">
    <li class="list-inline-item">
      <span class="write_post">
        <i class="fa fa-pencil mr-2 write-post" aria-hidden="true"></i> Write Post
      </span>
    </li>
    <li class="list-inline-item">|</li>
    <li class="list-inline-item">
      <input type='file' id="imgInp" name="post_image"/>
      <label for="imgInp" class="add_photo">
        <i class="fa fa-camera mr-2" aria-hidden="true"></i> Add Photo
      </label>
    </li>

    <li class="list-inline-item post-error-msg text-danger" style="display:none;"></li>
  </ul>
  <div class="group-profile-box p-3">
    @if(Auth::check() && (Auth::user()->profile_image != ''))
      <div class="avtar avtar-xl rounded-circle mr-3" style="background-image: url({{ asset('profile_image/'.Auth::user()->profile_image)}});"></div>
    @else
      <div class="avtar avtar-xl rounded-circle mr-3" style="background-image: url({{ asset('fronttheme/images/admin-avatar.png')}});"></div>
    @endif
    <div class="group-profile-info mb-0" style="width: calc(100% - 4rem - 1rem)">
      @if(isset($login_user_id) && isset($is_logged_user))
        @if($login_user_id!==Auth::user()->id)
          <textarea name="post_content" rows="2" placeholder="Leave some words of encouragement for {{$friend_detail[0]['first_name']}} {{$friend_detail[0]['last_name']}}..." class="w-100 write_text comment"></textarea>
          <input type="hidden" name="created_by" value="{{base64_encode($login_user_id)}}">
          @else

      <textarea name="post_content" rows="2" placeholder="Write something here..." class="w-100 write_text comment"></textarea>
       @endif
      @else
      <textarea name="post_content" rows="2" placeholder="Write something here..." class="w-100 write_text comment"></textarea>
      @endif
       
    </div>
  </div>
   <div class="submit_wrap text-right px-3 pb-3 border-bottom">
      <button type="submit" class="btn btn-yellow">Post</button>
    </div>

    <div class="post_img_section" style="display:none;width:100%;">
      <div class="post_img_privew">
       <div class="image-section p-2 text-center ">            
            <img id="PostImage" class="crop" src="#" alt="your image" />
        </div>
      </div>
      <div class="post_img_details">
        <label for="imgInp" style="color:#faa828;cursor: pointer;">Change Photo</label>
        <p>JPG or PNG, 10MB limits</p>
        <p>A photo uploaded here will be visible to all players and is not a official weigh-in photo.</p>
        <div class="remove_icon">Remove Photo</div>
      </div>
    </div>
    <input type="hidden" class="image-uploaded" name="image_uploaded" />
    
    <input type="hidden" id="x" name="x" value=""/>
    <input type="hidden" id="y" name="y" />
    <input type="hidden" id="w" name="w" />
    <input type="hidden" id="h" name="h" />
</section> 

   
</form>

@if(isset($login_user_id))
<input type="hidden" name="" class="login_user_id"  value="{{base64_encode($login_user_id)}}">
@endif
<!-- http://deepliquid.com/content/Jcrop_Download.html -->
<script type="text/javascript">
var jcrop_api = null;
$(document).ready(function(){
    $('.write_post').click(function(){
      $('.comment').focus();
    });
    $("#imgInp").change(function(){
        $('.post-error-msg').html("").hide();
        if (jcrop_api !== null)
        jcrop_api.destroy();

        var input = this;
        var fileErrorMsg = '';
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
            $('.post_img_section').show();
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#PostImage').attr('src', e.target.result);
                          $(document).find('.crop').Jcrop({  
                                onSelect: updateCoords,
                                bgOpacity:   0.4,
                                setSelect:   [ 788, 824, 0, 0 ]
                            },function(){ jcrop_api=this});
                
          
            }
            $('.image-uploaded').val("1");
            reader.readAsDataURL(input.files[0]);
        }
    });

    $(document).find('#PostComment').submit(function(event) {
        event.preventDefault();
@php
if(isset($login_user_id)){
if($login_user_id!== Auth::user()->id){
@endphp
  var user_id= $('.login_user_id').val();
        /* check user is logged in or not */
    if(typeof(user_id) != "undefined" && user_id !== null) {
      var url = siteurl+'/checkuserStatus';
         $.ajax({
              url: url,
              type: 'get', 
              data:{login_user_id:user_id},            
              dataType : 'json',
              success: function(response){
              if(response.status=='not_logged_in'){
                 $('#signinModal').modal('show');
              }else if(response.status=='not_friend'){
                 $('.message-notfriend').show();
                  setTimeout(function(){
                            $('.message-notfriend').hide();
                    },5000);
               }


              },
              error: function(data)
              {
                $('.loader').hide();
                alert('Please refresh the page or try again');
              }
          });

  }

  @php
  }
  }
  @endphp

        var commentText = $('textarea[name="post_content"]').val();
        if($.trim(commentText) == ''){
          $('textarea[name="post_content"]').focus();
          return;
        }
     
        var formData = new FormData($(this)[0]);
          $('.loader').show();
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
              }
          });

          
          $.ajax({
              url: $(this).attr('action'),
              type: 'POST',              
              data: formData,
              processData: false,
              contentType: false,
              dataType : 'html',
              success: function(response)
              {
                
              if(response=='')
                {
                  $('.feed-cards-error').show();

                  setTimeout(function(){
                            $('.feed-cards-error').hide();
                    },5000);
                   
                }
                //if(result.status == 1){
                  $('textarea[name="post_content"]').val("");
                  $(document).find('.post_img_section').hide();
                  $('.image-uploaded').val("");
                  $('.feed-cards').prepend(response);
                  $(".timeago").timeago();

                  $('.post-create-message').show();
                  setTimeout(function(){
                            $('.post-create-message').hide();
                    },5000);
                  
                $('.loader').hide();
              },
              error: function(data)
              {
                $('.loader').hide();
                alert('Please refresh the page or try again');
              }
          });

    });

    $('.remove_icon').click(function(){
      $('.image-uploaded').val("");
      var $el = $('.add_photo');
      $el.val("");
      $el.wrap('<form>').closest('form').get(0).reset();
      $el.unwrap();
      $(this).closest('.post_img_section').hide();
      $('.comment').focus();
    });
    function updateCoords(c)
    {
    	$('#info').text(JSON.stringify(c));
    	$('#x').val(c.x);
    	$('#y').val(c.y);
    	$('#w').val(c.w);
    	$('#h').val(c.h);
    };
});
</script>