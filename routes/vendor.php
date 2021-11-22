<?php

use Illuminate\Support\Facades\Route;

Route::post('image/store-cropper-temp-image', 'ImagesController@storeCropperTempImg')->name('cropper.temp');

Route::group(['namespace' => 'Vendor'], function () {
    Route::get('load-menu', 'ResourceController@loadMenu');
    Route::group(['middleware' => ['admin']], function () {
        Route::get('add-apartment', 'ApartmentInfoController@apartmentForm')->name('apartment.show');
        Route::get('resource/delete', 'ApartmentInfoController@delete')->name('resource.delete');
        Route::get('resource/edit/{id}', 'ApartmentInfoController@edit')->name('resource.edit');
        Route::post('resource/update/{id}', 'ApartmentInfoController@update')->name('resource.update');
        Route::post('resource/upload/image/{id}', 'ApartmentInfoController@uploadImage')->name('resource.uploadImage');
        Route::get('resource/image/delete', 'ApartmentInfoController@imageDelete')->name('resource.image.delete');
        Route::post('add-apartment', 'ApartmentInfoController@SaveApartmentForm')->name('apartment.add');
        Route::get('resource/edit/get-location', 'ApartmentInfoController@getLocation')->name('resource.edit.getLocation');
        Route::get('add-entertainment', 'EntertainmentController@entertainmentForm')->name('ent.add_form');
        Route::post('add-entertainment', 'EntertainmentController@saveEentertainmentForm')->name('ent.save');
        Route::get('entertainment/edit/{id}', 'EntertainmentController@edit')->name('ent.edit');
        Route::post('entertainment/update/{id}', 'EntertainmentController@update')->name('ent.update');
        Route::post('entertainment/upload/image/{id}', 'EntertainmentController@uploadImage')->name('ent.uploadImage');
        Route::get('entertainment/image/delete', 'EntertainmentController@imageDelete')->name('ent.image.delete');
        Route::get('ent_location_search', 'EntertainmentController@entLocationSearch')->name('ent.location.search');

        Route::get('rec-ent/edit/upload/{rec_or_ent?}/{id?}', 'UploadController@index')->name('rec_ent.upload');
        Route::post('rec-ent/edit/upload-main/{rec_or_ent?}/{id?}', 'UploadController@uploadMainVideo')->name('rec_ent.uploaded');
        Route::post('rec-ent/edit/upload-aditioan/{rec_or_ent?}/{id?}', 'UploadController@uploadAditionalVideo')->name('rec_ent.aditional.uploaded');
        Route::get('rec-ent/video/delete', 'UploadController@deleteVideo')->name('video.delete');

        Route::get('payment/{rec_or_ent}/{id}', 'PaymentController@index')->name('payment.index');
        Route::post('payment/get-package', 'PaymentController@getPackage')->name('payment.package');
        Route::post('payment/gotopayment', 'PaymentController@goToPayment')->name('payment.go');
        Route::get('payment/accepted', 'PaymentController@payseraAccept')->name('payment.accepetd');
        Route::get('payment/cancel', 'PaymentController@payseraCancel')->name('payment.cancel');

        Route::post('add-comment', 'CommentController@addComment')->name('add-comment');
        Route::post('replay-comment', 'CommentController@replay')->name('replay-comment');

    });
    Route::get('payment/callback', 'PaymentController@payseraCallback')->name('payment.callback');
    Route::get('testData', 'ResourceController@testData');
    Route::get('locations', 'ApartmentInfoController@getLocations')->name('location');
    Route::get('lakes', 'ApartmentInfoController@getLakes')->name('lakes');
    Route::get('rivers', 'ApartmentInfoController@getRivers')->name('rivers');





    Route::get('add-event', 'EventController@eventForm');
    Route::post('add-event', 'EventController@SasveEventForm');

    Route::get('resource', 'ResourceController@index')->name('resources');

    Route::get('resources/{p1?}/{p2?}/{p3?}/{p4?}/{p5?}', 'ResourceController@index')->name('resource');

    // Route::get('menu-filter','ResourceController@menuFilter')->name('menu.filter');

    //Route::get('filter-menu','ResourceController@filterMenu')->name('menu.filter');


    Route::get('resource/{name}/{id}', 'ResourceController@resourceDetails');

    // menu ajax data get
    Route::get('menu/location-lake-river', 'MainMenuController@LocationLakeRiver')->name('location.lake.river');

    Route::get('test', 'TestController@index');

    Route::get('search-result', 'ResourceController@searchResult');
    Route::get('/{p1?}/{p2?}/{p3?}', 'IndexController@index')->name('vendors.all');
});