@extends('layouts.admin')
<!-- PLUGINS STYLES-->
 <link href="{{ asset('admintheme/vendors/summernote/dist/summernote-bs4.css') }}" rel="stylesheet" />
 <link href="{{ asset('admintheme/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet" />

 
@section('content')
<div class="page-content fade-in-up">

 <div class="row">
	<div class="col-md-12">
	    <div class="ibox">
	    	@if(session()->has('success'))
               <p class="alert alert-success  text-center md_top" style="width:100%">
                  {{ session()->get('success') }}
                  <i class="fa fa-close pull-right mar-top">
               </p>
           	@endif
           	@if(session()->has('error'))
               <p class="alert alert-error  text-center md_top" style="width:100%">
                  {{ session()->get('error') }}
                  <i class="fa fa-close pull-right mar-top">
               </p>
           	@endif
	        <div class="ibox-head">
	            <div class="ibox-title">Create Group</div>
	        </div>
	        <div class="ibox-body" style="">
	            {{ Form::open(array('url' => 'admin/groups', 'id' => 'CreateGroupForm', 'files'=>true)) }}
	                <div class="row">
	                    <div class="col-sm-12 form-group">
	                    	{{ Form::label(__('messages.title'))}} <span class="req">*</span>
	                    	{{ Form::text('title', null, ['placeholder' => 'Title', 'class' => 'form-control required'])}}
	                    	@if ($errors->has('title'))
                           		<span class="invalid-feedback" style="display:block;" role="alert">
                                	<strong>{{ $errors->first('title') }}</strong>
                           		</span>
                    		@endif
	                    </div>
	                <div class="col-sm-6 form-group">
	                    {{ Form::label(__('seo_tags'))}} <span class="req">*</span>
	                    {{ Form::text('seo_tags', null, ['placeholder' => 'Seo tags', 'class' => 'form-control required'])}}
	                    @if ($errors->has('seo_tags'))
                       		<span class="invalid-feedback" style="display:block;" role="alert">
                            	<strong>{{ $errors->first('seo_tags') }}</strong>
                       		</span>
                		@endif
	                </div>
	                <div class="col-sm-6 form-group">
	                      	<label>Status</label>
	                    	<select class="form-control" name="status">
	                    		<option value="Active">Active</option>
	                    		<option value="Inactive">Inactive</option>
	                    	</select>
	               		</div>
	                 </div>
	               <div class="row">
					<div class="col-sm-6 form-group">
						{{ Form::label(__('banner_image'))}}
						<div>
							<label class="custom-file" id="customFile">
								<input type="file" class="custom-file-input" name="banner_image">
								<span class="custom-file-control form-control-file"></span>
							</label>
						</div>
							@if ($errors->has('banner_image'))
								<span class="invalid-feedback" style="display:block;" role="alert">
									<strong>{{ $errors->first('banner_image') }}</strong>
								</span>
						@endif
					</div>



	                <div class="col-sm-6 form-group">
	                    {{ Form::label(__('profile_image'))}}
	                    <div>
			            <label class="custom-file" id="customFile">
						        <input type="file" class="custom-file-input" name="profile_image">
						        <span class="custom-file-control form-control-file"></span>
						</label>
						</div>
						@if ($errors->has('profile_image'))
                       		<span class="invalid-feedback" style="display:block;" role="alert">
                            	<strong>{{ $errors->first('profile_image') }}</strong>
                       		</span>
                		@endif
	                    
	                </div>

	                <!--  <div class="col-sm-6 form-group">
                        <label>Add Member</label>

                        <select name="members[]" id="tag" class="form-control select2_demo_1" multiple="">
                            {{-- todo add from db--}}
                            @foreach($members as $member)
                                <option value="{{ $member->id }}">{{ $member->first_name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('members'))
                            <span class="invalid-feedback" style="display:block;" role="alert">
                                <strong>{{ $errors->first('members') }}</strong>
                            </span>
                        @endif
                       
                    </div> -->
                  	   <input type="hidden" id="member-ids" name="members" value="">
                    	
				       <div class="col-sm-12 form-group members-list" style="display: none;">
				            <label>Members</label>
				           	<div class="added_member">
				           				
				       		</div>
				        </div>
				        <div class="col-sm-12 form-group">
				            <input type="hidden" id="member-ids" name="members" value="">
				       			 <div class="form-group">                     
				        			<button type="button" class="btn btn-info" data-toggle="modal" data-target="#addMember-model">Add New Member</button> 
				      			 </div>
				        </div>

	           		</div>
	                 <div class="form-group">
	                    <label>About</label>
	                    {{ Form::textarea('about', null, ['placeholder' => 'Enter About Group', 'class' => 'form-control', 'id' => 'summernote'])}}
	                    @if ($errors->has('about'))
                       		<span class="invalid-feedback" style="display:block;" role="alert">
                            	<strong>{{ $errors->first('content') }}</strong>
                       		</span>
                		@endif
	                </div>
	                <div class="form-group">
	                	{{ Form::button('Submit', ['class' => 'btn btn-default create-group'])}}
	                </div>
	            {{ Form::close() }}
	        </div>
	    </div>
	</div>
 </div>
</div>


  

  <!-- Modal -->
  <div class="modal fade" id="addMember-model" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Search Member</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
             {{ Form::open(array('url' => route('search_member'), 'id' => 'SearchMemberForm', 'files'=>true)) }}
            <div class="row">
                <div class="col-sm-12 form-group mb-0">
                    <div class="input-group">
                        <input class="form-control" id="search"
                               value="{{ request('search') }}"
                               placeholder="Search By name and address " name="search"
                               type="text"/>
                       	 <div class="input-group-btn">
                            <button type="button" id="addmember" class="btn btn-warning">
                                Search
                            </button>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="{{request('field')}}" name="field"/>
                <input type="hidden" value="{{request('sort')}}" name="sort"/>
            </div>
          {!! Form::close() !!}
         
	        <div style="max-height: 340px;overflow: auto;">
				<table class="table table_addMember">
				  	<thead>
				  		<tr>
				  			<th><div id="checkboxdiv">
		          					<input type="checkbox" value="" class="ckbCheckAll mr-1">All
		          				</div></th>
				  			<th>Name</th>
				  			<th>Address</th>
				  		</tr>
		    	  	</thead>
		          	<tbody class="member-table">
		          	</tbody>
		        </table>
		    </div>
        </div>
        <div class="modal-footer">
        	<button type="button"  id="model-close" class="btn btn-default" data-dismiss="modal">Close</button>
        	<button type="button" id="append-members" class="btn btn-success">Add Member</button>
        </div>
      </div>
      
    </div>
  </div>
  



@endsection
@section('scripts')
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.min.css') }}">
<script src="{{ asset('js/jquery-ui.min.js') }}" type="text/javascript"></script>

<link href="{{ asset('admintheme/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" />

<link href="{{ asset('admintheme/vendors/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" />

<script src="{{ asset('admintheme/vendors/moment/min/moment.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('admintheme/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('admintheme/vendors/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}" type="text/javascript"></script>
<!-- PAGE LEVEL PLUGINS-->
<script src="{{ asset('admintheme/vendors/summernote/dist/summernote-bs4.js') }}" type="text/javascript"></script>
<!-- PAGE LEVEL PLUGINS-->
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


	  $('#date_1 .input-group.date').datepicker({
	  		format: 'mm/dd/yyyy',
	        keyboardNavigation: false,
	        forceParse: false,
	        calendarWeeks: true,
	        autoclose: true
	    });


	    $(".select2_demo_1").select2();
		  $('.create-group').click(function(e){
		  	var ret = validateForm('CreateGroupForm');
		  	if(ret){
		  		$('#CreateGroupForm').submit();
		  	}
		});


		  $("#checkboxdiv").hide();
        $('#addmember').click(function(e){
        	$('.loader').show();

        	 $( "#member-detail" ).empty();
        	var formURL = $(this).closest('form').attr('action');
  
        	
	        var data=$('#SearchMemberForm').serialize();
	         $.ajax({
                url: formURL,
                data: data,
                success: function(data) {
                	//alert(data);
                		//$("#member-detail").html($(data).append(data));
                		$('.member-table').html(data);
                		$('.loader').hide();
                		if(!data==''){
                		 $("#checkboxdiv").show();
                		}
                },
                error: function(error){
                    $('.loader').hide();
                    if(error.status === 422 ){
                        $("html, body").animate({ scrollTop: 0 }, "fast");
                    }else{
                          alert('Please refresh the page or try again');
                    }
                }
            });

        });
        	//Select all members click on select all //
	    $('input[type="checkbox"]').click(function(){
	        if($(this).prop("checked") == true){
	           $('.membercheckBox').prop('checked',true);
	        }

	        else if($(this).prop("checked") == false){
	           $('.membercheckBox').prop('checked',false);
	        }
	    });

	    		//Select members and append ids on hidden field//
	         $('#append-members').click(function(){
	         	var chkArray = [];
	         	var alreadyMemebers =$('#member-ids').val();
	         	if($.trim(alreadyMemebers) != ''){
	         		alreadyMemebers = JSON.parse($('#member-ids').val());
	         		chkArray = alreadyMemebers;
	         	}
	         	console.log(chkArray);
				/* declare an checkbox array */
				
				/* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
				var membersHtml = '';
				var checkedLen = 0;
				$(".membercheckBox:checked").each(function() {
					checkedLen++;
					var username = $(this).attr('data-name');
					var memeberid = $(this).val();
					if(chkArray.indexOf(memeberid) == -1){ // check if user already selected then not insert in array
						chkArray.push($(this).val());
						membersHtml += '<span class="member_item" data-userid="'+$(this).val()+'"><span class="remove_member">&times;</span><span class="member_name">'+username+'</span></span>';
					
					}
				});
				
				if(checkedLen === 0){
					alert('Please select atleast one member.');
					return;
				}

				$('.members-list').find('.added_member').append(membersHtml);
				$('.members-list').show();

				var jsonMembers = JSON.stringify(chkArray);
				$("#member-ids").val(jsonMembers);
				$(document).find("#addMember-model").modal('hide');
				$('.member-table').html("");
			});



	        /* On remove any member from members list */
	        $(document).on('click', '.remove_member', function(){
	        	var obj = $(this).parents('.member_item');
	        	var memeberid = obj.attr('data-userid');
	        	var alreadyMemebers = JSON.parse($('#member-ids').val());
	        	alreadyMemebers.splice(alreadyMemebers.indexOf(memeberid), 1);
	        	var jsonMembers = JSON.stringify(alreadyMemebers);
	        	$("#member-ids").val(jsonMembers);
	        	if(alreadyMemebers.length == 0){
	        		$('.members-list').hide();
	        		$(document).find("#member-ids").val("");	
	        	}
	        	obj.remove();
	        });



});
</script>
@stop