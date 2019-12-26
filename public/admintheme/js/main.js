$(document).ready(function(){
	/* To expand side menu as per active menu item */
	$(document).find('nav').find('ul').removeClass('in');
	$(document).find('nav').find('a.active').closest('ul').addClass('in').parent('li').addClass('active');

	$('.custom-file-input').on('change',function(){
	  var fileName = $(this).val();
	  $(this).next('.form-control-file').addClass("selected").html(fileName);
	});

	$('.delete-confirm').on('click', function(){
		var url = $(this).closest('form').attr('action');
		$(document).find('.delete-pop-form').attr('action', url);
		$(document).find('.showDeleteModal').modal('show');
	});

});

// Get Admin Notification
$(document).ready(function(){
	getNotification();
	setInterval(getNotification, 10000);
  });



// Get Notification
function getNotification(){
	  var url = $('.read_all_notification').data('get_url');
    $.ajax({
      url: url,
      type: 'get',
      processData: false,
      contentType: false,
      dataType : 'JSON',
      success: function(data) {
      	var html = '';
      	var i = 0;
      	if(data.length == 0){
      		$(".all_notification").html('');
      		$(".noti_read").hide();
      			 html += '<a class="list-group-item no_notification_data">\n\
                    <div class="media">\n\
                        <div class="media-img">\n\
                            <span class="badge badge-default badge-big"><i class="fa fa-shopping-basket"></i></span>\n\
                        </div>\n\
                        <div class="media-body">\n\
                            <div class="font-13">No Result Found</div><small class="text-muted"></small></div>\n\
                    </div>\n\
                </a>';
            $(".all_notification").prepend(html);
            return false;
      	} else {
      		$(".no_notification_data").remove();
      	}

      	$.each(data,function(i,v){
      		if(v.is_seen == 0){
      				i = i+1;
      				$(".noti_new").text(i +' New');
      				$(".noti_read").show();	
      			}
      		if($(".all_notification").find(".noti_id_"+v.id).length == 0){
      			 html += '<a class="list-group-item noti_id_'+v.id+'">\n\
                    <div class="media">\n\
                        <div class="media-img">\n\
                            <span class="badge badge-default badge-big"><i class="fa fa-shopping-basket"></i></span>\n\
                        </div>\n\
                        <div class="media-body">\n\
                            <div class="font-13">'+v.message+'</div><small class="text-muted">'+v.created_at+'</small></div>\n\
                    </div>\n\
                </a>';
      		}
      	});
      	$(".all_notification").prepend(html);
      }
    });
}


//It used to Read All Notification
$(document).on('click','.read_all_notification',function(e){
   var url = $(this).data('url');
    $.ajax({
      url: url,
      type: 'get',
      processData: false,
      contentType: false,
      dataType : 'JSON',
      success: function(data) {
      	$(".noti_read").hide();
      }
    });

  });

$(window).on("load resize ", function() {
  var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
  $('.tbl-header').css({'padding-right':scrollWidth});
}).resize();