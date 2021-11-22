// set dropdown value to hidden field
function setDropdownValue(e, value, className) {
  if (value == 0) {
    $('.' + className).val('');
  } else {
    $('.' + className).val(value);
  }
}
$('#rclk').on('bind', 'rightclick', function() {
  alert('right mouse button is pressed');
});

//TODO: on city click type/city
// if no type only /city
function mainCity(e, city) {
  $('#loader').addClass('loading');
  var url1 = window.search_url + '/';
  var type = $('#menu_type').val();
  if (type) {
    url1 += type + '/';
  }
  url1 += city + '/';
  e.setAttribute('href', url1);
}

//TODO: on city click type/location
function mainLocation(e, location) {
  $('#loader').addClass('loading');
  var url1 = window.search_url + '/';

  var type = $('#menu_type').val();
  if (type) {
    url1 += type + '/';
  }
  url1 += location + '/';

  e.setAttribute('href', url1);
}

//TODO: on city click type/lake/
// type null lake/location

function locationLake(e, location, lake) {
  $('#loader').addClass('loading');
  var url1 = window.search_url + '/';

  var type = $('#menu_type').val();
  if (type) {
    url1 += type + '/';
  }
  url1 += lake + '/';
  if (type == '') {
    url1 += location + '/';
  }
  e.setAttribute('href', url1);
}

//TODO: type/river
//type null river/location
function locationRiver(e, location, river) {
  $('#loader').addClass('loading');
  var url1 = window.search_url + '/';

  var type = $('#menu_type').val();
  if (type) {
    url1 += type + '/';
  }
  url1 += river + '/';
  if (type == '') {
    url1 += location + '/';
  }
  e.setAttribute('href', url1);
}

//TODO: on city(type) click ->
// lake ? type/lake/
//lake null reiver ? type/river
// sea ? type/sea
//lake river sea null -> type/location
//lake river sea location null -> type/city
function mainType(e, type) {
  $('#loader').addClass('loading');
  var url1 = window.search_url + '/' + type + '/';
  var lake = $('#menu_lake').val();
  if (lake) {
    url1 += lake + '/';
  }
  var river = $('#menu_river').val();
  if (river) {
    url1 += river + '/';
  }

  var sea = $('#menu_sea').val();
  if (sea) {
    url1 += sea + '/';
  }

  var location = $('#menu_location').val();
  if (location) {
    if (lake == '' && river == '') {
      url1 += location + '/';
    }
  }
  var city = $('#menu_city').val();
  if (city) {
    if (lake == '' && river == '' && location == '') {
      url1 += city + '/';
    }
  }
  e.setAttribute('href', url1);
}

//TODO: type/sea
//type null /sea
function mainSea(e, sea) {
  $('#loader').addClass('loading');
  var url1 = window.search_url + '/';
  var type = $('#menu_type').val();
  if (type) {
    url1 += type + '/';
  }
  url1 += sea + '/';
  e.setAttribute('href', url1);
}

$(document).on('submit', '#mainSearchForm', function(e) {
  var val = $('#mainSearchName').val();
  if ($.trim(val) == '') {
    return false;
  }
});

$(document).on('keyup', '#mainSearchName', function() {
  var val = $(this).val();
  if ($.trim(val.length) > 2) {
    var data = new FormData();
    data.append('val', val);
    data.append('_token', window.csrf_token);
    $.ajax({
      processData: false,
      contentType: false,
      data: data,
      type: 'POST',
      url: window.mainSearchSuggestion,
      success: function(response) {
        if ($.trim(response) == '') {
          $('.input-search-box').hide();
        } else {
          $('.put-main-suggestion').html(response);
          $('.input-search-box').show();
        }
      },
    });
  } else {
    $('.input-search-box').hide();
  }
});

function putSuggestion(title) {
  $('#mainSearchName').val(title);
  $('#mainSearchForm').submit();
}

// main city click

$(document).on('click', '.main-city', function() {
  $('#loader').addClass('loading');
  var city_id = $(this).attr('city-id');
  $('.m_city_id').val(city_id);
  var text = $(this).text();
  $('.m_city').val(text);

  $('.m_location_id').val('');
  $('.m_location').val('');

  $('.m_lake_id').val('');
  $('.m_lake').val('');

  $('.m_river_id').val('');
  $('.m_river').val('');

  $('.m_sea_id').val('');
  $('.m_sea').val('');

  $.ajax({
    url: window.locationLakeRiver + '?city_id=' + city_id,
    type: 'get',
    beforeSend: function() {},
  })
    .done(function(response) {
      $('.location_lake').html(response.location_lake);
      $('.location_river').html(response.location_river);

      // 	var current_url = window.location.href;
      // 	if (current_url.indexOf("?") >= 0) {
      //          var current_url = current_url.split('?')[0];
      //     }

      // 	var new_url = current_url+'?city_id='+city_id;
      // window.history.pushState("object or string", "Title", new_url);
      $('#searchForm').submit();
    })
    .fail(function(jqXHR, ajaxOptions, thrownError) {});
});

$(document).on('click', '.main-location', function() {
  $('#loader').addClass('loading');
  var location_id = $(this).attr('location-id');
  $('.m_location_id').val(location_id);
  var text = $(this).text();
  $('.m_location').val(text);

  $('.m_lake_id').val('');
  $('.m_lake').val('');

  $('.m_river_id').val('');
  $('.m_river').val('');

  $('.m_sea_id').val('');
  $('.m_sea').val('');

  $.ajax({
    url: window.locationLakeRiver + '?location_id=' + location_id,
    type: 'get',
    beforeSend: function() {},
  })
    .done(function(response) {
      $('.location_lake').html(response.location_lake);
      $('.location_river').html(response.location_river);

      // 	var current_url = window.location.href;
      // 	if (current_url.indexOf("?") >= 0) {
      //          var current_url = current_url.split('?')[0];
      //     }
      // 	var new_url = current_url+'?location_id='+location_id;
      // window.history.pushState("object or string", "Title", new_url);

      $('#searchForm').submit();
    })
    .fail(function(jqXHR, ajaxOptions, thrownError) {});
});

$(document).on('click', '.second-location', function() {
  $('#loader').addClass('loading');
  var location_id = $(this).attr('location-id');
  $('.m_location_id').val(location_id);
  var text = $(this).text();
  $('.m_location').val(text);

  $('.m_lake_id').val('');
  $('.m_lake').val('');

  $('.m_river_id').val('');
  $('.m_river').val('');

  $('.m_sea_id').val('');
  $('.m_sea').val('');

  $('#searchForm').submit();
});

$(document).on('click', '.main-lake', function() {
  $('#loader').addClass('loading');
  var lake_id = $(this).attr('lake-id');
  $('.m_lake_id').val(lake_id);
  var text = $(this).text();
  $('.m_lake').val(text);
  $('#searchForm').submit();
});

$(document).on('click', '.third-location', function() {
  $('#loader').addClass('loading');
  var location_id = $(this).attr('location-id');
  $('.m_location_id').val(location_id);
  var text = $(this).text();
  $('.m_location').val(text);
  $('.m_lake_id').val('');
  $('.m_lake').val('');

  $('.m_river_id').val('');
  $('.m_river').val('');

  $('.m_sea_id').val('');
  $('.m_sea').val('');

  $('#searchForm').submit();
});

$(document).on('click', '.main-river', function() {
  $('#loader').addClass('loading');
  var river_id = $(this).attr('river-id');
  var text = $(this).text();
  $('.m_river_id').val(river_id);
  $('.m_river').val(text);
  $('#searchForm').submit();
});

$(document).on('click', '.main-type-id', function() {
  $('#loader').addClass('loading');
  var type_id = $(this).attr('type-id');
  var text = $(this).text();
  $('.m_type_id').val(type_id);
  $('.m_type').val(text);
  $('#searchForm').submit();
});

$(document).on('click', '.main-sea-id', function() {
  $('#loader').addClass('loading');
  var sea_id = $(this).attr('sea-id');
  $('.m_sea_id').val(sea_id);
  var text = $(this).text();
  $('.m_sea').val(text);

  $('.m_river_id').val('');
  $('.m_river').val('');

  $('.m_location_id').val('');
  $('.m_location').val('');

  $('.m_lake_id').val('');
  $('.m_lake').val('');

  $('.m_city_id').val('');
  $('.m_city').val('');

  $('#searchForm').submit();
});

//login

$(document).on('submit', '#loginForm', function(event) {
  event.preventDefault();
  $('#loader').addClass('loading');
  var data = new FormData($('form#loginForm')[0]);
  $.ajax({
    processData: false,
    contentType: false,
    data: data,
    type: 'POST',
    url: window.vendor_login_url,
    success: function(response) {
      if (response.error) {
        $('#loader').removeClass('loading');
        toastr['error'](response.error);
      } else {
        window.location = response;
      }
    },
  });
});

function makeFavrite(rec_id, status) {
  var data = new FormData();
  data.append('rec_id', rec_id);
  data.append('status', status);
  data.append('_token', window.csrf_token);
  $.ajax({
    processData: false,
    contentType: false,
    data: data,
    type: 'POST',
    url: window.resourceMakeFavorite,
    success: function(response) {
      //$('.add-fav_color').css('color','red');
    },
  });
}

$(document).on('click', '.add-to-my-fav', function() {
  var status = $(this).attr('status');
  var rec_id = $(this).attr('fav-id');
  $(this).addClass('add-fav-color');
  $(this).addClass('remove-from-fav');
  $(this).removeClass('add-to-my-fav');
  makeFavrite(rec_id, status);
});

$(document).on('click', '.remove-from-fav', function() {
  var status = $(this).attr('status');
  var rec_id = $(this).attr('fav-id');
  $(this).removeClass('add-fav-color');
  $(this).addClass('add-to-my-fav');
  $(this).removeClass('remove-from-fav');
  var data = new FormData();
  data.append('rec_id', rec_id);
  data.append('status', status);
  data.append('_token', window.csrf_token);
  $.ajax({
    processData: false,
    contentType: false,
    data: data,
    type: 'POST',
    url: window.deleteFavrite,
    success: function(response) {},
  });
});

function removeFavrite(rec_id, status, item_number) {
  var data = new FormData();
  var page = $('#page-number').val();
  data.append('rec_id', rec_id);
  data.append('status', status);
  data.append('page', page);
  data.append('_token', window.csrf_token);
  $.ajax({
    processData: false,
    contentType: false,
    data: data,
    type: 'POST',
    url: window.deleteFavrite,
    success: function(response) {
      getFavoriteData(item_number, status);
    },
  });
}
function getFavoriteData(item_number, status) {
  var page = $('#fav-page-number').val();
  if (status == 1) {
    var numItems = $('.count-fav-single-content').length;
    if (page) {
      if (numItems == 1 && page > 1) {
        page = page - 1;
      }
    }
  }
  if (status == 2) {
    var page = $('#ent-fav-page-number').val();
    var numItems = $('.ent-count-fav-single-content').length;
    if (page) {
      if (numItems == 1 && page > 1) {
        page = page - 1;
      }
    }
  }
  if (page) {
    var t_url = window.getFavorite + '?status=' + status + '&page=' + page;
  } else {
    var t_url = window.getFavorite + '?status=' + status;
  }
  $.ajax({
    url: t_url,
    type: 'get',
    beforeSend: function() {},
  })
    .done(function(response) {
      $('.fav-content').html(response);
    })
    .fail(function(jqXHR, ajaxOptions, thrownError) {});
}
function viewedResource(rec_id, status) {
  var data = new FormData();
  data.append('rec_id', rec_id);
  data.append('status', status);
  data.append('_token', window.csrf_token);
  $.ajax({
    processData: false,
    contentType: false,
    data: data,
    type: 'POST',
    url: window.resourceViewed,
    success: function(response) {},
  });
}

$(document).on('keyup', '#slug', function() {
  var item = $(this).val();
  var id = $(this).attr('ed-id');
  var model = $(this).attr('model');
  var data = new FormData();
  data.append('item', item);
  data.append('id', id);
  data.append('model', model);
  data.append('_token', window.csrf_token);
  if ($.trim(item)) {
    $.ajax({
      processData: false,
      contentType: false,
      data: data,
      type: 'POST',
      url: window.check_slug,
      success: function(response) {
        if (response == 'exist') {
          $('.slug-div').html('Slug nama already exist please try another');
          $('.slug-div').addClass('exist-slug');
          $('.btn-dis').prop('disabled', true);
        } else {
          $('.slug-div').removeClass('exist-slug');
          $('.slug-div').html('Your slug name is: ' + response);
          $('.btn-dis').prop('disabled', false);
        }
      },
    });
  }
});

$(document).on('submit', '#user-update-form', function() {
  $('#loader').addClass('loading');
  var data = new FormData($('form#user-update-form')[0]);
  var t_url = $(this).attr('action');
  $.ajax({
    processData: false,
    contentType: false,
    data: data,
    type: 'POST',
    url: t_url,
    success: function(response) {
      $('#loader').removeClass('loading');
      toastr['success'](response.success);
      $('.current-user-name').text(response.username);
    },
    error: function(xhr) {
      $('#loader').removeClass('loading');
      $.each(xhr.responseJSON.errors, function(key, value) {
        toastr['error'](value);
      });
    },
  });
  return false;
});

function entSearchLocation(value) {
  value = $.trim(value);
  var t_url = window.ent_location_search + '?keyword=' + value;
  $.ajax({
    url: t_url,
    type: 'get',
    beforeSend: function() {},
  })
    .done(function(response) {
      $('.ent-location-content').html(response);
    })
    .fail(function(jqXHR, ajaxOptions, thrownError) {});
}

$(document).on('submit', '#matchVCode', function() {
  $('#loader').addClass('loading');
  var data = new FormData($('form#matchVCode')[0]);
  var t_url = $(this).attr('action');
  $.ajax({
    processData: false,
    contentType: false,
    data: data,
    type: 'POST',
    url: t_url,
    success: function(response) {
      $('#loader').removeClass('loading');
      if (response.error) {
        toastr['error'](response.error);
      }
      if (response.url) {
        window.location.href = response.url;
      }
    },
    error: function(xhr) {
      $('#loader').removeClass('loading');
      toastr['error']('Something went worng');
    },
  });
  return false;
});
function entSearchLocation(value) {
  value = $.trim(value);
  var t_url = window.ent_location_search + '?keyword=' + value;
  $.ajax({
    url: t_url,
    type: 'get',
    beforeSend: function() {},
  })
    .done(function(response) {
      $('.ent-location-content').html(response);
    })
    .fail(function(jqXHR, ajaxOptions, thrownError) {});
}

function SearchByEntLocation(location) {
  var url = $('.ent-main-url').val() + '/';
  var category = $('.ent-category-slug').val();
  var type = $('.ent-type-slug').val();
  url = url + category + '/';
  if (type) {
    url = url + type + '/';
  }
  url = url + location;
  window.location.href = url;
}

function resendVCode(email) {
  $('#loader').addClass('loading');
  var data = new FormData();
  data.append('email', email);
  data.append('_token', window.csrf_token);
  $.ajax({
    processData: false,
    contentType: false,
    data: data,
    type: 'POST',
    url: window.verification_resend,
    success: function(response) {
      $('#loader').removeClass('loading');
      if (response.success) {
        toastr['success'](response.success);
      }
      if (response.error) {
        toastr['success'](response.error);
      }
    },
    error: function(xhr) {
      $('#loader').removeClass('loading');
      toastr['error']('Something worng happend');
    },
  });
}
function avaterChange() {
  $('.loader').addClass('loading');
  $('#profileImageUploadForm').submit();
}

function getPackageDetails(id) {
  var data = new FormData();
  data.append('id', id);
  data.append('_token', window.csrf_token);
  $.ajax({
    processData: false,
    contentType: false,
    data: data,
    type: 'POST',
    url: window.payment_package,
    success: function(response) {
      $('.payment-add-info').html(response.amount_duration);
      $('.payment-explanation').html(response.description);
    },
    error: function(xhr) {
      toastr['error']('Something went worng');
    },
  });
}
function loader() {
  $('#loader').addClass('loading');
}
$(document).on('click', '.to-link', function() {
  $('.e_video').val('');
  $('.video_file').val('');
  $('.video-section').hide();
  $('.embed-video-section').show();
  $('.thumb-img').val('');
});
$(document).on('click', '.to-video', function() {
  $('.e_video').val('');
  $('.video_file').val('');
  $('.embed-video-section').hide();
  $('.video-section').show();
  $('.thumb-img').val('');
});
$(document).on('click', '.to-link1', function() {
  $('.e_video1').val('');
  $('.video_file1').val('');
  $('.video-section1').hide();
  $('.thumb-img1').val('');
  $('.embed-video-section1').show();
});
$(document).on('click', '.to-video1', function() {
  $('.e_video1').val('');
  $('.video_file1').val('');
  $('.embed-video-section1').hide();
  $('.video-section1').show();
  $('.thumb-img1').val('');
});

$(document).on('submit', '#main-video-upload', function(e) {
  e.preventDefault();
  $('#loader').addClass('loading');
  var data = new FormData($('form#main-video-upload')[0]);
  var t_url = $(this).attr('action');
  $.ajax({
    processData: false,
    contentType: false,
    data: data,
    type: 'POST',
    url: t_url,
    success: function(response) {
      $('#loader').removeClass('loading');
      if (response.error) {
        toastr['error'](response.error);
      }
      if (response.success) {
        toastr['success'](response.success);
        $('.main-videos-area').html(response.video);
        $('.e_video').val('');
        $('.video_file').val('');
        $('.thumb-img').val('');
      }
    },
    error: function(xhr) {
      $('#loader').removeClass('loading');
      toastr['error']('Something went worng');
    },
  });
  return false;
});

$(document).on('submit', '#aditional-video-upload', function() {
  $('#loader').addClass('loading');
  var data = new FormData($('form#aditional-video-upload')[0]);
  var t_url = $(this).attr('action');
  $.ajax({
    processData: false,
    contentType: false,
    data: data,
    type: 'POST',
    url: t_url,
    success: function(response) {
      $('#loader').removeClass('loading');
      if (response.error) {
        toastr['error'](response.error);
      }
      if (response.success) {
        toastr['success'](response.success);
        $('.additional-videos-area').html(response.video);
        $('.e_video1').val('');
        $('.video_file1').val('');
        $('.thumb-img1').val('');
      }
    },
    error: function(xhr) {
      $('#loader').removeClass('loading');
      toastr['error']('Something went worng');
    },
  });
  return false;
});

function deleteVideo(rc_id, video_id, type) {
  $.ajax({
    url:
      window.delete_video +
      '?rc_id=' +
      rc_id +
      '&video_id=' +
      video_id +
      '&type=' +
      type,
    type: 'get',
    beforeSend: function() {
      return confirm('Are you sure to delete this item?');
    },
  })
    .done(function(response) {
      toastr['success'](response.success);
      $('.additional-videos-area').html(response.video);
    })
    .fail(function(jqXHR, ajaxOptions, thrownError) {
      //toastr["error"]("Something went worng");
    });
}
$(document).on('submit', '#regForm', function() {
  $('#loader').addClass('loading');
  var data = new FormData($('form#regForm')[0]);
  var t_url = $(this).attr('action');
  $.ajax({
    processData: false,
    contentType: false,
    data: data,
    type: 'POST',
    url: t_url,
    success: function(response) {
      $('#loader').removeClass('loading');
      window.location.href = response;
    },
    error: function(xhr) {
      $('#loader').removeClass('loading');
      $.each(xhr.responseJSON.errors, function(key, value) {
        toastr['error'](value);
      });
    },
  });
  return false;
});
