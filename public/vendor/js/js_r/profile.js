function deleteResource(rec_id,user_id)
{
	$.ajax({
    	url: window.resourceDelete + '?rec_id=' + rec_id +'&user_id='+user_id+'&status=1',
    	type: "get",
      	beforeSend: function() {
      		return confirm("Are you sure to delete this item?");
      	}
    })
    .done(function(response) {
    	$('.resourceListing').html(response);
    	 toastr["success"]("Deleted!");
    })
    .fail(function(jqXHR, ajaxOptions, thrownError) {

    });
}


function changeStatus(status, resource)
{
    $.ajax({
      url: window.resourceUserChange + '?status=' + status +'&resource='+resource+'&indentifier=1',
      type: "get",
        beforeSend: function() {
        }
    })
    .done(function(response) {
        $('.resourceListing').html(response);
    })
    .fail(function(jqXHR, ajaxOptions, thrownError) {

    });
}

function changeStatusEnt(status, resource)
{
    $.ajax({
      url: window.resourceUserChange + '?status=' + status +'&resource='+resource+'&indentifier=2',
      type: "get",
        beforeSend: function() {
        }
    })
    .done(function(response) {
        $('.entListing').html(response);
    })
    .fail(function(jqXHR, ajaxOptions, thrownError) {

    });
}

function deleteEnt(rec_id,user_id)
{
  $.ajax({
      url: window.resourceDelete + '?rec_id=' + rec_id +'&user_id='+user_id+'&status=2',
      type: "get",
        beforeSend: function() {
          return confirm("Are you sure to delete this item?");
        }
    })
    .done(function(response) {
      $('.entListing').html(response);
       toastr["success"]("Deleted!");
    })
    .fail(function(jqXHR, ajaxOptions, thrownError) {

    });
}