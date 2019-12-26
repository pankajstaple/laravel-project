/*
	function perfom when Select The Role in manage Permission Group
	Date : 22-11-2017
	
*/

$(document).on('change','.user_role',function(e)
{
	e.preventDefault();

	var role_id = $(this).val();
	var route = $('#managePermissionGroup').attr('action');
	
		
		var data = $('form.managePermissionGroup').serialize();
		$(".divLoading1").show();
		$(".permissions").attr('checked',false);
		$.ajax({
		    url: route,
		    data: data,
			type: 'post',
	    	dataType: 'json',
	    	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		    success: function(data) {

					$.each(data, function(i, v) {
						$('#per_'+v).attr('checked',true);
					});
					$(".divLoading1").hide();
					return false;
				

		    	$(".divLoading1").hide();
		  
		    },
		    
		});
	
});

$(document).on('change','.role_wise_permission',function(e)
{
	e.preventDefault();

	var role_id = $(this).val();
	var route = $('#managePermissionGroup').attr('action');
	
		
		var data = $('form.managePermissionGroup').serialize();
		$(".divLoading1").show();
		$(".permissions").attr('checked',false);
		$.ajax({
		    url: route,
		    data: "role_id="+role_id,
			type: 'post',
	    	dataType: 'json',
	    	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		    success: function(data) {

					$.each(data, function(i, v) {
						$('#per_'+v).attr('checked',true);
					});
					$(".divLoading1").hide();
					return false;
				

		    	$(".divLoading1").hide();
		  
		    },
		    
		});
	
});

$(document).on('change','.user_wise_permission',function(e)
{
	e.preventDefault();

	var user_id = $(this).val();
	var route = $('#managePermissionGroup').attr('action');

	var token = $('input[name="_token"]').val();
	
		
		var data = $('form.managePermissionGroup').serialize();
		$(".divLoading1").show();
		$(".permissions").attr('checked',false);
		$.ajax({
		    url: route,
		    data: "user_id="+user_id+"_token="+token,
			type: 'post',
	    	dataType: 'json',
	    	headers: {'X-CSRF-TOKEN': token},
		    success: function(data) {

					$.each(data, function(i, v) {
						$('#per_'+v).attr('checked',true);
					});
					$(".divLoading1").hide();
					return false;
				

		    	$(".divLoading1").hide();
		  
		    },
		    
		});
	
});



$(document).on('change','.all_default_permissions',function(e)
{
	e.preventDefault();
	if($(this). prop("checked") == true){
		$(".default_permissions").attr('checked',true);
		$('input.default_permissions').prop('checked',true);
	}
	else
	{
		$(".default_permissions").attr('checked',false);
		$('input.default_permissions').prop('checked',false);
	}

});

$(document).on('change','.all_custom_permissions',function(e)
{
	e.preventDefault();
	if($(this). prop("checked") == true){
		$(".custom_permissions").attr('checked',true);
		$('input.custom_permissions').prop('checked',true);
	}
	else
	{
		$(".custom_permissions").attr('checked',false);
		$('input.custom_permissions').prop('checked',false);
	}

});

$(document).on('change','.custom_permissions',function(){
	
	if ($('.custom_permissions:checked').length == $('.custom_permissions').length) {
		$('.all_custom_permissions').prop('checked',true);
    }else{
    	$('.all_custom_permissions').prop('checked',false);
    }
});
$(document).on('change','.default_permissions',function(){
	
	if ($('.default_permissions:checked').length == $('.default_permissions').length) {
		$('.all_default_permissions').prop('checked',true);
    }else{
    	$('.all_default_permissions').prop('checked',false);
    }
});

$(document).on('click','.permission_delete',function(e){
	
    var deleteId = $(this).attr('delete-id');
	$('.showDeleteModal .deleteid').val(deleteId);
    $(document).find('.showDeleteModal').modal('show');
});

function deleteRecord()
{
	var deleteId = $('.showDeleteModal .deleteid').val();
	$(document).find('.showDeleteModal').modal('hide');
	$(".delete_id_"+deleteId).click();
}
