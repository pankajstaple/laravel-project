
function updatestatuslocation(id,status,companyid,companynumber){
	

var confirmation = confirm('Do you want to change status ?' );
	if (confirmation) {

	if(id !='' && status !=''){ 
		
		var route =$('#rooturl').val();

		//e.preventDefault();
		$.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
        });

		$.ajax({ 
                  url: route + '/clientcompany/updatestatuslocation',
                  method: 'post',
                  data: {
                     id: $.trim(id),
                     status: status,
                     company_id : companyid,
                     company_number : companynumber
                  },
			      dataType: 'json',
					beforeSend: function () {
						$("#row_"+id).LoadingOverlay('show');
					},
                  success: function(response){
                  
					  $("#row_"+id).LoadingOverlay('hide');
					  if(response.flag == 'success'){
						  $("#modal-msg").html(response.msg);
						  $("#statusModal").modal('show');

						  if(status == 'active'){	
							    strStatus="'de-active'";
							    $('#status_'+id).html('<span class="cls-active">Active</span>');						  	
							  	$('#row_'+id+' td:last a.cls-status').replaceWith("<a href=\"javascript:void(0);\" class=\"cls-status\" onclick=\"updatestatuslocation('"+id+"',"+strStatus+",'"+companyid+"','"+companynumber+"')\"><span class=\"unlock-icon\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"De-Active\"><i class=\"fa fa-unlock-alt\" aria-hidden=\"true\"></i></span></a>");
							  }
						  else{
							  	strStatus="'active'";
							  	$('#status_'+id).html('<span class="cls-deactive">De-active</span>');		
								$('#row_'+id+' td:last a.cls-status').replaceWith("<a href=\"javascript:void(0);\" class=\"cls-status\" onclick=\"updatestatuslocation('"+id+"',"+strStatus+",'"+companyid+"','"+companynumber+"')\"><span class=\"lock-icon\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Active\"><i class=\"fa fa-lock\" aria-hidden=\"true\"></i></span></a>");
							  }

						  window.setTimeout(function () {
							  $("#statusModal").modal('hide');
						  	  //window.location = route + '/employees';
						}, 2000);
					  }
					  else if(response.flag == 'failure'){
						   alert(response.msg);
					  }					  
                  }
		});	
		 
	}
	else{
		   
		return false;
	}

  }

} 