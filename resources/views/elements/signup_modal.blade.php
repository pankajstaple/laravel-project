<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create new account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <img src="{{ asset('fronttheme/images/close-icon.png') }}" alt="Close" />
        </button>
      </div>
      <div class="modal-body">      

         	<div class="signup-message" style="display: none;"></div>
            <form id="signup-form" action="{{route('ajax_create_account')}}" method="post">
            	@csrf()
			   <div class="form-content">

			      <div class="form-group">
			         <label class="form-label">First Name</label>
			         <input type="text" name="first_name" class="form-control required" placeholder="Enter first name">
			      </div>
			      <div class="form-group">
			         <label class="form-label">Last Name</label>
			         <input type="text" name="last_name" class="form-control" placeholder="Enter last name">
			      </div>
		          <div class="form-group">
			         <label class="form-label">Email address</label>
			         <input type="email" name="email" class="form-control required email" placeholder="Enter email" autocomplete="off">
			      </div>
			      <div class="form-group">
			         <label class="form-label">
			            Password			            
			         </label>
			         <input name="password" type="password" class="form-control required password" placeholder="Password"  autocomplete="off">
			      </div>
			      <div class="form-group">
			         <div class="custom-control custom-checkbox">
			            <input type="checkbox" class="custom-control-input required agree" name="term" value="1" id="agree">
			            <label class="custom-control-label" for="agree">Agree the</label> <a href="javascript:;">terms and policy</a>
			         </div>
			      </div>

			      <div class="form-footer">
			         <button type="button" class="btn btn-yellow btn-block create-account">Sign Up</button>
			         <input type="hidden" name="refrence_by" class="refrence_by" value="0">
			      </div>
			      <div class="or-sec text-center mt-3 mb-3">
                      <span>or</span>
                    </div> 
                    <div id="status"></div>
                    <!-- Facebook login or logout button -->
                    <a href="javascript:void(0);" onclick="fbLogin()" id="fbLink" class="fb-btn">
                      <img src="{{ asset('fronttheme/images/facebook-emblem.png') }}" style="width: 20px;margin-right: 10px;" /> Login with Facebook
                    </a>
			   </div>
			</form>

		</div>
		<div class="modal-footer justify-content-center">
			<div class="text-muted">
			   Already have account? <a href="javascript:;" class="sign-in">Log in</a>
			</div>         
      </div>
    </div>
  </div>
</div>