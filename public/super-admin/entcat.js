$(document).on('submit','#updateEntCat',function(event){
	var data = new FormData( $( 'form#updateEntCat' )[ 0 ]);
  	$.ajax({
      	processData: false,
      	contentType: false,
      	data: data,
      	type: 'POST',
      	url: window.super_entcat_update,
      	success: function(response) {
      		$('#entCatModal').modal('hide');
      		toastr["success"]("Saved!");
      		$('.all-ent-categories').html(response);
      	} 
    });
    return false;
});

function editEntCat(id){
	var data = new FormData();
  	data.append('id',id);
  	data.append('_token',window.csrf_token);
  	$.ajax({
      	processData: false,
      	contentType: false,
      	data: data,
      	type: 'POST',
      	url: window.super_entcat_edit,
      	success: function(response) {
      		$('.edit-entcat-content').html(response);
      		assignEditor();
      		$('#entCatModal').modal('show');
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




