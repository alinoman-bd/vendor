function changeStatus(rec_id, status)
{
	  var data = new FormData();
  	data.append('rec_id',rec_id);
  	data.append('status',status);
  	data.append('_token',window.csrf_token);
  	$.ajax({
      	processData: false,
      	contentType: false,
      	data: data,
      	type: 'POST',
      	url: window.ent_change_status,
      	success: function(response) {
      		getData();
      	}
    });
} 

function makeVip(rec_id)
{
	var data = new FormData();
  	data.append('rec_id',rec_id);
  	data.append('_token',window.csrf_token);
  	$.ajax({
      	processData: false,
      	contentType: false,
      	data: data,
      	type: 'POST',
      	url: window.ent_vip,
      	success: function(response) {
      		$('.vip-modal-content').html(response);
      	}
    });
}

function saveVip()
{
	var vipId = $('#vipId').find(":selected").val();
	var rec_id = $('#selected_rec_id').val();
	var data = new FormData();
  	data.append('vipId',vipId);
  	data.append('rec_id',rec_id);
  	data.append('_token',window.csrf_token);
  	$.ajax({
      	processData: false,
      	contentType: false,
      	data: data,
      	type: 'POST',
      	url: window.ent_make_vip,
      	success: function(response) {
      		$('#makVipModal').modal('hide');
      		getData();
      	}
    });
}

function getData()
{	
  var page = $('#rec-page').val();
	if(page){
		var target_url = window.ent + '?page=' + page;
	}else{
		var target_url = window.ent;
	}
  	$.ajax({
    	url: target_url,
    	type: "get",
      	beforeSend: function() {
      
      	}
    })
    .done(function(response) {
     	$('.all-resources').html(response);
    })
    .fail(function(jqXHR, ajaxOptions, thrownError) {

    });
}