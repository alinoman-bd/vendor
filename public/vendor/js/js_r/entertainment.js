//get location 
$(function(){
  var container = $('.container-d'), inputFile = $('#file'), img, btn, txt = 'Browse picture', txtAfter = 'Browse another pic';

  if(!container.find('#upload').length){
    container.find('.input').append('<input type="button" value="'+txt+'" id="upload">');
    btn = $('#upload');
    container.append('<img src="" class="hidden" alt="Uploaded file" id="uploadImg" width="100">');
    img = $('#uploadImg');
  }

  btn.on('click', function(){
    img.animate({opacity: 0}, 300);
    inputFile.click();
  });

  inputFile.on('change', function(e){
    container.find('label').html( inputFile.val() );

    var i = 0;
    for(i; i < e.originalEvent.srcElement.files.length; i++) {
      var file = e.originalEvent.srcElement.files[i], 
      reader = new FileReader();

      reader.onloadend = function(){
        img.attr('src', reader.result).animate({opacity: 1}, 700);
      }
      reader.readAsDataURL(file);
      img.removeClass('hidden');
    }

    btn.val( txtAfter );
  });
});

function getLocation(city_id)
{
  $.ajax({
    url: window.getLocationUrl + '?city_id=' + city_id,
    type: "get",
    beforeSend: function() {
      
    }
  })
  .done(function(response) {
    $('.set-location').html('');
    $('.set-location').html(response.locations);

    var city_id = $('.main_rec_city_id').val();
    if(city_id){
      $('.app_location').val($('.main_rec_location_id').val());
      $('.set-location-name').text($('.main_rec_location_name').val());
    }

    

  })
  .fail(function(jqXHR, ajaxOptions, thrownError) {

  });
}
//get lakes

function getLakes(location_id)
{
  if(location_id == 0)
  {
    $('.app_lake').val('');
  }
  $.ajax({
    url: window.getLakesUrl + '?location_id=' + location_id,
    type: "get",
    beforeSend: function() {
      
    }
  })
  .done(function(response) {
    $('.set-lakes').html('');
    $('.set-lakes').html(response);

    var lake_name = $('.main_rec_lake_name').val();
    if(lake_name){
      $('.set-lake-name').text(lake_name);
      $('.app_lake').val($('.main_rec_lake_id').val());
      $('.main_rec_lake_name').val('');
    } 
    

  })
  .fail(function(jqXHR, ajaxOptions, thrownError) {

  });
}
//get rivers
function getRivers(location_id)
{
  if(location_id == 0)
  {
    $('.app_river').val('');
  }
  $.ajax({
    url: window.getRiversUrl + '?location_id=' + location_id,
    type: "get",
    beforeSend: function() {
      
    }
  })
  .done(function(response) {
    $('.set-rivers').html('');
    $('.set-rivers').html(response);
    var river_name = $('.main_rec_river_name').val(); 
    if(river_name){
      $('.set-river-name').text(river_name);
      $('.app_river').val($('.main_rec_river_id').val());
      $('.main_rec_river_name').val('');
    }
  })
  .fail(function(jqXHR, ajaxOptions, thrownError) {

  });
}
// autocomplet address
$(function() {
  var autocomplete;
  autocomplete = new google.maps.places.Autocomplete((document.getElementById('app_address_auto')), {
    types: ['geocode'],
  });
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    
  });

});


// Appartment form validation
$(document).on('submit','#ent-form',function(){
	//block 1 validation
	var message = ' is required';
	if ($('.app_type:checked').length < 1) {
   toastr["error"]("Apgyvendinimo tipas"+message);
   return false;
 }
 if ($.trim($('.app_city').val()) == '') {
   toastr["error"]("Miestas/ rajonas"+message);
   return false;
 }
 if ($.trim($('.app_location').val()) == '') {
   toastr["error"]("Location"+message);
   return false;
 }
 
 if ($.trim($('.app_resource_name').val()) == '') {
   toastr["error"]("Pavadinimas/ antraštė"+message);
   return false;
 }
 if ($.trim($('.app_sort_title').val()) == '') {
   toastr["error"]("Sort title"+message);
   return false;
 }
  if ($.trim($('.app_min_price').val()) == '') {
   toastr["error"]("Price"+message);
   return false;
 }
 if ($.trim($('.app_description').val()) == '') {
   toastr["error"]("Description"+message);
   return false;
 }
 if ($.trim($('.app_address').val()) == '') {
   toastr["error"]("Adresas"+message);
   return false;
 }
 if ($.trim($('.app_phone').val()) == '') {
   toastr["error"]("Telefonai"+message);
   return false;
 }
 if ($.trim($('.app_email').val()) == '') {
   toastr["error"]("El. pašto adresai"+message);
   return false;
 }

 
 if ($.trim($('.app_seasion').val()) == '') {
   toastr["error"]("Dirba"+message);
   return false;
 }
  var main_file = $.trim($('#main_preview').attr('src')).split("/")[4];
  if(main_file == 'choose-logo.png'){
    toastr["error"]("Image"+message);
    return false;
  }

});

$(document).on('submit','#rcMultipleImage',function(e){
  $('#loader').addClass('loading');
  var link = $(this).attr('action');
  var data = new FormData( $( 'form#rcMultipleImage' )[ 0 ] );
  $.ajax({
    processData: false,
    contentType: false,
    data: data,
    type: 'POST',
    url: link,
    success: function(response) {
      $('.uploadedImage').html(response.image);
      $('#rcMultipleImage').trigger("reset");
      $('#loader').removeClass('loading');
      console.log(response);
    }
  });
  return false;
})

// $(document).ready(function(){

//   $('#rcMultipleImage').ajaxForm({
//     beforeSend:function(){
//       $('#success').empty();
//     },
//     uploadProgress:function(event, position, total, percentComplete)
//     {
//       $('.progress-bar').text(percentComplete + '%');
//       $('.progress-bar').css('width', percentComplete + '%');
//     },
//     success:function(data)
//     {
//       if(data.errors)
//       {
//         $('.progress-bar').text('0%');
//         $('.progress-bar').css('width', '0%');
//         $('#success').html('<span class="text-danger"><b>'+data.errors+'</b></span>');
//       }
//       if(data.success)
//       {
//         $('.progress-bar').text('Uploaded');
//         $('.progress-bar').css('width', '100%');
//           //$('#success').html('<span class="text-success"><b>'+data.success+'</b></span><br /><br />');
//           $('.uploadedImage').html(data.image);
//           $('#rcMultipleImage').trigger("reset");
//         }
//       }
//     });

// });


function removeRecImage(rec_id,img_id)
{
  $.ajax({
    url: window.entImageDelete + '?rec_id=' + rec_id +'&img_id='+img_id,
    type: "get",
    beforeSend: function() {
      return confirm("Are you sure to delete this item?");
    }
  })
  .done(function(response) {
    $('.uploadedImage').html(response);
    console.log(response);
  })
  .fail(function(jqXHR, ajaxOptions, thrownError) {

  });
}

$(document).ready(function(){
  
  var city_id = $('.main_rec_city_id').val();
  if(city_id){
    getLocation(city_id);
  }
  
  


});