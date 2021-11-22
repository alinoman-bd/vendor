$(document).on('submit','#updateEntType',function(event){
	var data = new FormData( $( 'form#updateEntType' )[ 0 ]);
  	$.ajax({
      	processData: false,
      	contentType: false,
      	data: data,
      	type: 'POST',
      	url: window.super_enttype_update,
      	success: function(response) {
      		$('#entTypeModal').modal('hide');
      		toastr["success"]("Saved!");
      		getData();
      	}
    });
    return false;
});

function editEntType(id){
	var data = new FormData();
  	data.append('id',id);
  	data.append('_token',window.csrf_token);
  	$.ajax({
      	processData: false,
      	contentType: false,
      	data: data,
      	type: 'POST',
      	url: window.super_enttype_edit,
      	success: function(response) {
      		$('.edit-enttype-content').html(response);
      		assignEditor();
      		$('#entTypeModal').modal('show');
      	}
    });
}

function assignEditor(){
	$('#summernote').summernote({
	    tabsize: 2,
	    height: 100
	});
  $('#summernote1').summernote({
      tabsize: 2,
      height: 100
  });
	$('#form-tags-1').tagsInput();
}

function getData()
{ 
    var page = $('#ent-type-page').val();
    if(page){
        var target_url = window.super_enttype + '?page=' + page;
    }else{
        var target_url = window.super_enttype;
    }
    $.ajax({
        url: target_url,
        type: "get",
        beforeSend: function() {
      
        }
    })
    .done(function(response) {
        $('.all-ent-type').html(response);
    })
    .fail(function(jqXHR, ajaxOptions, thrownError) {

    });
}



