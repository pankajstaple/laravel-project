/* function to validate form data
	Date : 03-11-2017
	
 */
function validateForm(formId)
{
	$(document).find('.field-error').remove();
	var error = 0;
	$('form#'+formId).find('.required').each(function()
	{
		var val = $.trim($(this).val());
		if (val == ''){
			console.log("Error Field: ");
			console.log($(this));
			if ($(this).parent().hasClass('date') || $(this).parent().hasClass('after')){
				$(this).parent().after('<p class="field-error">This field is required</p>');
			} else {
				$(this).after('<p class="field-error">This field is required</p>');				
			}
			error = error+1;
		}
	});
	if (error != 0){
		return false;
	}

	$('form#'+formId).find('.alphanumeric').each(function()
	{
		var string = $.trim($(this).val());
		if (string != ''){
			if(!isalphanumeric(string)){
				$(this).after('<p class="field-error">only alpha value required</p>');
				error = error+1;
			}
		}	
	});
	if (error != 0){
		return false;
	}


	$('form#'+formId).find('.number').each(function(){
		var string = $.trim($(this).val());
		if (string != ''){
			if(!isNumber(string)){
				$(this).after('<p class="field-error">Number required</p>');
				error = error+1;
			}
		}	
	});

	if(error != 0){
		return false;
	}


	$('form#'+formId).find('.onlynumber').each(function(){
		var string = $.trim($(this).val());
		if (string != ''){
			if(!isOnlyNumber(string)){
				$(this).after('<p class="field-error">Number required</p>');
				error = error+1;
			}
		}	
	});

	if(error != 0){
		return false;
	}




	$('form#'+formId).find('.image').each(function(){
		var string = $.trim($(this).val());
		if (string != ''){
			var allowedFiles = [".jpg", ".jpeg", ".png", ".gif"];
			var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
			if (!regex.test(string.toLowerCase())) {
				$(this).after('<p class="field-error">only JPG,JPEG,PNG files allowed</p>');
				error = error+1
			}
		}	
	});

	if(error != 0){
		return false;
	}

	$('form#'+formId).find('.url').each(function(){
		var string = $.trim($(this).val());
		if (string != ''){
			if (!isValidUrl(string)) {
					$(this).after('<p class="field-error">invalid url</p>');
					error = error+1
				
			}	
		}
	});

	if(error != 0){
		return false;
	}


	$('form#'+formId).find('.userChangePassword').each(function()
	{	
		$(document).find('.field-error').remove();
		var password = $('#password').val();
		if ($('#password').val() != '' && $('#password-confirm').val() !='' ){
			var cnfirmPassword = checkPasswordMatch($('#password').val(),$('#password-confirm').val());
			if (password.length < 6) {
					$('#password').after('<p class="field-error">Password too short</p>');
				error = error+1;
				return false;
				}

				if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))
				{}else
				{
					$('#password').after('<p class="field-error">Password contains numbers and characters</p>');
				
				error = error+1;
				return false;
				}
				if(!password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))
				{
					$('#password').after('<p class="field-error">Password contains one special characters</p>');
					error = error+1;
				return false;
				}

			if (cnfirmPassword == 'false'){
				$('#password-confirm').after('<p class="field-error">Confirm Passwords do not match</p>');
				error = error+1;
				return false;
			}

			
		}
	});
	$('form#'+formId).find('.checkConfirmPassword').each(function()
	{
		$(document).find('.field-error').remove();
		var password = $('#password').val();
		if ($('#password').val() != '' && $('#password-confirm').val() !='' ){
			var cnfirmPassword = checkPasswordMatch($('#password').val(),$('#password-confirm').val());
			if (cnfirmPassword == 'false'){
				$('#password-confirm').after('<p class="field-error">Confirm Passwords do not match</p>');
				error = error+1;
				return false;
			}
		}
	});

	$('form#'+formId).find('.email').each(function()
	{
		var self = $(this);
		var email = $.trim(self.val());
		var index = email.search(",");
		if (index > 0){
			var emails = email.split(","); 
			var eError = 0;
			$.each(emails, function(key, em){
				if(!validateEmail($.trim(em)))
				{
					eError = eError+1;
					error = error+1;	
				}
				if(eError != 0){
					self.after('<p class="field-error">Enter valid email</p>');
					error = error+1;	
				}					
			});
		} else {
			if (email != ''){
				if(!validateEmail(email)){
					self.after('<p class="field-error">Enter valid email</p>');
					error = error+1;	
				}	
			}
		}
		
	});

	if (error == 0){
		return true;
	} else {
		return false;
	}




	$('form#'+formId).find('.email').each(function()
	{
		var self = $(this);
		var email = $.trim(self.val());
		var index = email.search(",");
		console.log(index); 
		if (index > 0){
			var emails = email.split(","); 
			var eError = 0;
			$.each(emails, function(key, em){
				if(!validateEmail($.trim(em)))
				{
					eError = eError+1;
					error = error+1;	
				}
				if(eError != 0){
					self.after('<p class="field-error">Enter valid email</p>');
					error = error+1;	
				}					
			});
		} else {
			console.log('else');
			if (email != ''){
				console.log(email);
				if(!validateEmail(email)){
					self.after('<p class="field-error">Enter valid email</p>');
					error = error+1;	
				}	
			}
		}
		
	});

	if (error != 0){
		return false;
	}

	$('form#'+formId).find('.userPassword').each(function()
	{	
		$(document).find('.field-error').remove();
		if ($('#userConfirmPassword').val() != '' && $('#userPassword').val() !='' ){
			var cnfirmPassword = checkPasswordMatch($('#userPassword').val(),$('#userConfirmPassword').val());
			if (cnfirmPassword == 'false'){
				$('#userConfirmPassword').after('<p class="field-error">Passwords do not match</p>');
				error = error+1;
			}else{
			}
		}
	});
	if (error == 0){
		return true;
	} else {
		return false;
	}


}

/* Email validate function */
function validateEmail(sEmail)
{
	var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if (filter.test(sEmail)) {
		return true;
	} else {
		return false;
	}
}

/* Phone number validation */
function isNumber(string)
{
	intRegex = /[0-9 -()+]+$/;
	if (!intRegex.test(string)){
		return false;
	} else {
		return true;
	}
}


/* only number validation */
function isOnlyNumber(string)
{
	intRegex = /^[0-9]+$/
	if (!intRegex.test(string)){
		return false;
	} else {
		return true;
	}
}


/* alpha numeric validation */
function isalphanumeric(string)
{
	alphaRegex = /[a-zA-Z +]+$/;
	if (!alphaRegex.test(string)){
		return false;
	} else {
		return true;
	}
}





/* function for check confirm passwors */
function checkPasswordMatch(password,confirmPassword)
{
	if (password != confirmPassword) {
    	return 'false';
    } else {
    return 'true';
   } 
}

function isValidUrl(url){

 	var myVariable = url;
    if(/^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i.test(myVariable)) {
      return true;
    } else {
      return false;
    }   
}


$(document).on('blur','.removeErrorField',function(e)
{
	if ($(this).val() !=''){
		$(this).next($('.field-error')).remove();
	}

});