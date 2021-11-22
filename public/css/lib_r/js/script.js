function openTotalBed()
{
	var text = $("#bed_type option:selected").text();
	if(text != 'Select bed type'){
		$('.bed_type_name').text('Total '+text);
		$('.bed_type_name_open').show();
	}else{
		$('.bed_type_name_open').hide();
	}
}

$(document).on('submit','.roomAddForm',function(event){
    
    var des = $('.addRoomModalDes').val();
    if(des == ''){
      toastr["error"]("Description is required");
      return false;
    }

    var img = $('.checkImageValid').attr('src');
    if(img == '#'){
      toastr["error"]("Image is required");
      return false;
    }

    $('.roomAddForm').submit();
})





$(document).on('submit','#roomImageUpload',function(e){
  $('#loader').addClass('loading');
  var link = $(this).attr('action');
  var data = new FormData( $( 'form#roomImageUpload' )[ 0 ] );
  $.ajax({
    processData: false,
    contentType: false,
    data: data,
    type: 'POST',
    url: link,
    success: function(response) {
      $('.allAllRoomImg').html(response.image);
      $('#roomImageUpload').trigger("reset");
      $('#loader').removeClass('loading');
      console.log(response);
    }
  });
  return false;
})

function removeRoomImg(room_id, img_id){
	$.ajax({
      url: window.room_img_delete + '?room_id=' + room_id +'&img_id='+img_id,
      type: "get",
        beforeSend: function() {
          return confirm("Are you sure to delete this item?");
        }
    })
    .done(function(response) {
      //$('.uploadedImage').html(response);
      // console.log(response);
      $('.allAllRoomImg').html(response);
    })
    .fail(function(jqXHR, ajaxOptions, thrownError) {

    });
}