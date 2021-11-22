
function openRoom(room_id,rec_id)
{
	$.ajax({
    	url: window.singleRoom + '?room_id=' + room_id+'&rec_id='+rec_id,
    	type: "get",
      	beforeSend: function() {
      
      	}
    }) 
    .done(function(response) {
    	$('.singleRoom').html(response);

      var galleryThumbs2 = new Swiper('.gallery-thumbs2', {
        spaceBetween: 10,
        slidesPerView: 5,
        loop: false,
        freeMode: true,
          loopedSlides: 5, //looped slides should be the same
          watchSlidesVisibility: true,
          watchSlidesProgress: true,
          breakpoints: {
            450: {
              slidesPerView: 2,
            },
            767: {
              slidesPerView: 3,
            },
            1200: {
              slidesPerView: 4,
            },
          }
      });
      var galleryTop2 = new Swiper('.gallery-top2', {
        spaceBetween: 10,
        loop: false,
          loopedSlides: 5, //looped slides should be the same
          thumbs: {
            swiper: galleryThumbs2,
          }
      });

      var more_ph2 = $(".gallery-thumbs2 .swiper-slide").width();
      $(".more-photos2").width(more_ph2);
      $('#details_modal').addClass('show-modal-d');

    })
    .fail(function(jqXHR, ajaxOptions, thrownError) {

    });
}

  $(document).on("click", ".d-close-m", function () {
      $("#details_modal").removeClass("show-modal-d");
  });

  $(document).on('click','.video-thumb-img',function(){
      var status = $(this).attr('video-status');
      var video = $(this).attr('video-src');
      var poster = $(this).attr('src');
      var source = '';
      if(status == 1){
        source +='<video poster="'+poster+'" src="'+video+'" controls allowfullscreen></video>';
      }else{
        source +='<iframe class="embed-responsive-item" src="'+video+'" allowfullscreen></iframe>';
      }
      $('#put-single-video').html(source);
      $('.video-thumb-img').addClass('v-opcity');
      $(this).removeClass('v-opcity');
  });


$(document).ready(function(){
  if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var s_lat = position.coords.latitude;
      var s_lng = position.coords.longitude;
      s_lat = 54.687157;
      s_lng = 25.279652;
      var geocoder = new google.maps.Geocoder();
      var d_address = $('#d-address').val();
      geocoder.geocode( { 'address': d_address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          var d_lat = results[0].geometry.location.lat();
          var d_lng = results[0].geometry.location.lng();
          var latlng = new google.maps.LatLng(s_lat, s_lng);
          var geocoder = geocoder = new google.maps.Geocoder();
          geocoder.geocode({ 'latLng': latlng }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
              if (results[1]) {
                var s_address = results[1].formatted_address;
                initMap(s_lat, s_lng, d_lat, d_lng, s_address, d_address);
              }
            }
          });
        }
      });
    },function() {
        var d_address = $('#d-address').val();
        initmap1(d_address);
    });
  } else {
    console.log("Sorry, your browser does not support HTML5 geolocation.");
  }
})


function initmap1(d_address){
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode( { 'address': d_address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var d_lat = results[0].geometry.location.lat();
            var d_lng = results[0].geometry.location.lng();
            var pointB = new google.maps.LatLng(d_lat, d_lng),
            myOptions = {
                zoom: 10,
                center: pointB
            },
            map = new google.maps.Map(document.getElementById('user-map'), myOptions),
            directionsService = new google.maps.DirectionsService,
            directionsDisplay = new google.maps.DirectionsRenderer({
                map: map,
                suppressMarkers: true
            }),
            markerB = new google.maps.Marker({
                position: pointB,
                title: d_address,
                label: "D",
                map: map
            });
            const contentString1 = '<div>'+$('#rec-name').val()+'</div><div>'+d_address+'</div>';
            const infowindow1 = new google.maps.InfoWindow({
                content: contentString1,
            });
            infowindow1.open(map, markerB);

        }
    });
}

function initMap(s_lat, s_lng, d_lat, d_lng, s_address, d_address) {
  var pointA = new google.maps.LatLng(s_lat, s_lng),
  pointB = new google.maps.LatLng(d_lat, d_lng),
  myOptions = {
    zoom: 10,
    center: pointB
  },
  map = new google.maps.Map(document.getElementById('user-map'), myOptions),
  // Instantiate a directions service.
  directionsService = new google.maps.DirectionsService,
  directionsDisplay = new google.maps.DirectionsRenderer({
    map: map,
    suppressMarkers: true
  }),
  markerA = new google.maps.Marker({
    position: pointA,
    title: s_address,
    label: "S",
    map: map
  }),
  markerB = new google.maps.Marker({
    position: pointB,
    title: d_address,
    label: "D",
    map: map
  });


  const contentString = s_address;
  const infowindow = new google.maps.InfoWindow({
    content: contentString,
  });
  // markerA.addListener("click", () => {
  //   infowindow.open(map, markerA);
  // });

  infowindow.open(map, markerA);


  const contentString1 = '<div>'+$('#rec-name').val()+'</div><div>'+d_address+'</div>';
  const infowindow1 = new google.maps.InfoWindow({
    content: contentString1,
  });
  // markerB.addListener("click", () => {
  //   infowindow1.open(map, markerB);
  // });
  infowindow1.open(map, markerB);

  calculateAndDisplayRoute(directionsService, directionsDisplay, pointA, pointB);
}

function calculateAndDisplayRoute(directionsService, directionsDisplay, pointA, pointB) {
  directionsService.route({
    origin: pointA,
    destination: pointB,
    avoidTolls: true,
    avoidHighways: false,
    travelMode: google.maps.TravelMode.DRIVING
  }, function (response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
    } else {
      console.log('Directions request failed due to ' + status);
    }
  });
}

$(document).on('click','.rating__input',function(){
  var star = $(this).val();
  $('.add-given-star').val(star);
})

$(document).on('submit','#add-comment-form',function(){
  var star = $('.add-given-star').val().trim();
  if(star == ''){
    toastr["error"]("Star is required");  
    return false;
  }
  var data = new FormData( $( 'form#add-comment-form' )[ 0 ] );
  var t_url = $(this).attr('action');
  $.ajax( {
      processData: false,
      contentType: false,
      data: data, 
      type: 'POST',
      url:t_url,
      success: function( response ){
          $('.all-review-list').html(response.all_comments);
          $('#add-comment-form').trigger("reset");
          $('#reviewModal').modal('hide');
          console.log(response.all_comments);
      },
      error: function (xhr) {
          toastr["error"]("Something went worng");
      },
  });
  return false;
})

function replayReviewModal(comment_id){
  $('.set-comment-id').val(comment_id);
  $('#replayReviewModal').modal('show');
}
$(document).on('submit','#replay-comment-form',function(){
  var data = new FormData( $( 'form#replay-comment-form' )[ 0 ] );
  var t_url = $(this).attr('action');
  $.ajax( {
      processData: false,
      contentType: false,
      data: data, 
      type: 'POST',
      url:t_url,
      success: function( response ){
          $('.all-review-list').html(response.all_comments);
          $('#replay-comment-form').trigger("reset");
          $('#replayReviewModal').modal('hide');
      },
      error: function (xhr) {
          toastr["error"]("Something went worng");
      },
  });
  return false;
})
