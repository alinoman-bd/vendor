function editBanner(id)
{
	var data = new FormData();
  	data.append('id',id);
  	data.append('_token',window.csrf_token);
  	$.ajax({
      	processData: false,
      	contentType: false,
      	data: data,
      	type: 'POST',
      	url: window.edit_banner,
      	success: function(response) {
      		$('.put-edit-banner-modal').html(response);
      		$('#bannerModal').modal('show');
      	}
    });
}

$(document).on('submit','#updateBanner',function(event){
	var data = new FormData( $( 'form#updateBanner' )[ 0 ]);
	var t_action = $(this).attr('action');
  	$.ajax({
      	processData: false,
      	contentType: false,
      	data: data,
      	type: 'POST',
      	url: t_action,
      	success: function(response) {
      		if(response.error){
      			toastr["error"](response.error);
      		}
      		if(response.success){
      			toastr["success"](response.success);
      			$('.top-banner').html(response.top);
      			$('.bottom-banner').html(response.bottom);
      			$('#bannerModal').modal('hide');
      		}
      	}
    });
    return false;
});

function removeBanner(id)
{
	$.ajax({
    	url: window.delete_banner + '?id=' + id,
    	type: "get",
    	beforeSend: function() {
      		return confirm("Are you sure to delete this item?");
    	}
  	})
  	.done(function(response) {
    	if(response.success){
  			toastr["success"](response.success);
  			$('.top-banner').html(response.top);
  			$('.bottom-banner').html(response.bottom);
  		}
  	})
  	.fail(function(jqXHR, ajaxOptions, thrownError) {
  		toastr["error"]("Something went worng!");
  	});
}