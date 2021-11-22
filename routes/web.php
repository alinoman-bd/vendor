<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('translate/{id}', 'TranslateController@translate');

//rasel routes


Route::get('filter-menu','Vendor\IndexController@filterMenu')->name('menu.filter');




Route::get('contact', 'Vendor\IndexController@contact')->name('contact');
Route::get('about-us', 'Vendor\IndexController@aboutUs')->name('about-us');
Route::get('about-us', 'Vendor\IndexController@aboutUs')->name('about-us');
Route::get('terms-and-conditions', 'Vendor\IndexController@termsAndCondition')->name('terms-condition');
Route::get('privacy-policy', 'Vendor\IndexController@privacyPolicy')->name('privacy-policy');
Route::post('contact', 'Vendor\IndexController@sendContact')->name('contact.submit');
Route::post('resource/makeFavrite', 'FavoriteController@makeFavrite')->name('resource.favorite');
Route::get('favorites', 'FavoriteController@index')->name('favorite');
//Route::get('ajax-favorites', 'FavoriteController@ajaxFavorites')->name('ajax.favorite');
Route::get('entertainment-favorites', 'FavoriteController@entFavorites')->name('ent.favorites');
Route::post('resource/deleteFavrite', 'FavoriteController@deleteFavrite')->name('favorite.delete');
Route::post('resource/viewed', 'ViewedResourceController@makeViewed')->name('resource.viewed');
Route::get('rooms/sinlge', 'Vendor\ResourceController@singleRoom')->name('room.single');

Route::get('languages/{language}', 'PublicController@language')->name('language');

Route::post('register', 'RegisterController@register')->name('user.register');
Route::get('register/verification/{email?}', 'RegisterController@verificationEmail')->name('register.verification');
Route::post('register/verification/re-send', 'RegisterController@reSendCode')->name('register.verification.resend');
Route::post('register/verification', 'RegisterController@verifiedEmail')->name('register.verified');

Route::post('login', 'LoginController@login')->name('user.login');


Route::get('rooms', 'PublicController@room');
//Route::get('about-us', 'PublicController@about');
Route::get('gallery', 'PublicController@gallery');
Route::get('elements', 'PublicController@elements');
Route::get('booking/checkout', 'PublicController@checkout')->name('checkout');
Route::post('booking/checkout', 'ChekoutController@checkoutPost')->name('checkout.post');
Route::get('booking/checkout/{room}/delete', 'PublicController@deletecheckout')->name('checkout.delete');
Route::get('room-details/{room}', 'PublicController@roomdetails')->name('room.details');
Route::get('attractions', 'PublicController@attractions');
Route::get('home', 'HomeController@index')->name('home');
Route::get('rooms', 'PublicController@room');
//Route::get('about-us', 'PublicController@about');
Route::get('contact-us', 'PublicController@contact');
Route::get('elements', 'PublicController@elements');
Route::get('checkout', 'PublicController@checkout');
Route::get('room-details/{room}', 'PublicController@roomdetails')->name('room.details');
Route::post('submit-contact-form', 'Admin\ContactController@submitContactForm')->name('submitContactForm');
Route::get('terms-and-condtions', 'PublicController@termsNCondition')->name('termsNCondition');



Route::get('booking/clear-session', 'BookingController@clearsession')->name('clearsession');
Route::post('rooms/{room}/booking', 'BookingController@store')->name('booking');


//admin

//payment
Route::get('paysera/accepted', 'ChekoutController@payseraAccept');
Route::get('paysera/cancel', 'ChekoutController@payseraCancel');
Route::get('paysera/callback', 'ChekoutController@payseraCallback');

Route::post('admin/get-calendar-date', 'Admin\CalendarController@getCalendarDate')->name('setting.admin.getCalendarDate');
Route::post('admin/get-current-calendar', 'Admin\CalendarController@getCurrentCalendar')->name('setting.admin.getCurrentCalendar');


Route::get('search','SearchController@search')->name('search');
Route::post('search/suggestion','SearchController@suggestion')->name('search.suggestion');

//super admin
Route::group(['middleware' => ['superadmin'],'prefix' => 'superadmin', 'namespace' => 'Superadmin'], function () {

	Route::get('/','SuperadminController@index')->name('superadmin');
	Route::post('recource/status','SuperadminController@changeStatus')->name('superadmin.res.change');
	Route::post('recource/vip','SuperadminController@vipResource')->name('resource.vip');
	Route::post('recource/makeVip','SuperadminController@makeVip')->name('resource.makeVip');
	Route::get('login-as-admin/{user_id}','SuperadminController@loginAsAdmin')->name('loginasadmin');

	Route::get('cities','CityController@index')->name('sup.city.index');
	Route::post('cities/edit','CityController@getCityById')->name('sup.city.edit');
	Route::post('cities/update','CityController@updateCity')->name('sup.city.update');

	Route::get('locations','LocationController@index')->name('sup.location.index');
	Route::post('locations/edit','LocationController@getLocationById')->name('sup.location.edit');
	Route::post('locations/update','LocationController@updateLocation')->name('sup.location.update');

	Route::get('lakes','LakeController@index')->name('sup.lake.index');
	Route::post('lakes/edit','LakeController@getLakeById')->name('sup.lake.edit');
	Route::post('lakes/update','LakeController@updateLake')->name('sup.lake.update');

	Route::get('rivers','RiverController@index')->name('sup.river.index');
	Route::post('rivers/edit','RiverController@getRiverById')->name('sup.river.edit');
	Route::post('rivers/update','RiverController@updateRiver')->name('sup.river.update');



	Route::get('types','TypeController@index')->name('sup.type.index');
	Route::post('types/edit','TypeController@getTypeById')->name('sup.type.edit');
	Route::post('types/update','TypeController@updateType')->name('sup.type.update');

	Route::get('seas','SeaController@index')->name('sup.sea.index');
	Route::post('seas/edit','SeaController@getSeaById')->name('sup.sea.edit');
	Route::post('seas/update','SeaController@updateSea')->name('sup.sea.update');
	Route::post('slug/check','SlugController@checkSlug')->name('sup.check.slug');


	Route::get('ent_categories','EntCategoryController@index')->name('sup.entcat.index');
	Route::post('ent_categories/edit','EntCategoryController@getEntCategoryById')->name('sup.entcat.edit');
	Route::post('ent_categories/update','EntCategoryController@updateEntCategory')->name('sup.entcat.update');

	Route::get('ent_types','EntTypeController@index')->name('sup.enttype.index');
	Route::post('ent_types/edit','EntTypeController@getEntTypeById')->name('sup.enttype.edit');
	Route::post('ent_types/update','EntTypeController@updateEntType')->name('sup.enttype.update');

	Route::get('entertainments','EntController@index')->name('sup.ent.index');
	Route::post('entertainments/edit','EntController@getEntTypeById')->name('sup.ent.edit');
	Route::post('entertainments/update','EntController@updateEntType')->name('sup.ent.update');

	Route::post('entertainments/status','EntController@changeStatus')->name('ent.res.change');
	Route::post('entertainments/vip','EntController@vipResource')->name('ent.vip');
	Route::post('entertainments/makeVip','EntController@makeVip')->name('ent.makeVip');
	Route::get('banner','BannerController@index')->name('banner.index');
	Route::post('banner','BannerController@save')->name('banner.save');
	Route::post('banner/edit','BannerController@editBanner')->name('banner.edit');
	Route::post('banner/update','BannerController@updateBanner')->name('banner.update');
	Route::get('banner/delete','BannerController@deleteBanner')->name('banner.delete');


});



Route::group(['middleware' => ['admin']], function () {

	Route::get('user/profile/{id}', 'UserController@index')->name('profile');
	Route::get('admin/superadmin/logout', 'UserController@superAdminLogout')->name('admin.superadmin.logout');
	Route::get('user/setting', 'UserController@setting')->name('user.setting');
	Route::post('user/update/{id}', 'UserController@updateUser')->name('user.update');

	Route::post('upload-profile-image', 'UserController@uploadProfileImage')->name('user.profile.image');
	Route::get('change-resource-status', 'UserController@resourceStatus')->name('resource.status.change');
	Route::get('user/change-password', 'UserController@changePassword')->name('user.password.change');
	Route::post('user/change-password', 'UserController@passwordChanged')->name('user.password.changed');
	Route::get('user/payments', 'PaymentHistoryController@index')->name('payment.history.index');
	Route::get('user/payment/pdf/{rec_or_ent}/{id}', 'PaymentHistoryController@downloadPdf')->name('payment.pdf.download');


});

Route::group(['middleware' => ['admin'], 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
	Route::get('setting/sliders', 'SettingsController@slider')->name('setting.admin.slider');
	Route::get('setting/rooms', 'SettingsController@room')->name('setting.admin.room');

	Route::get('setting/room/image-upload/{room_id}', 'SettingsController@uploadRoomImage')->name('setting.admin.image.upload');

	Route::post('setting/room/image-upload', 'SettingsController@roomImageUpload')->name('setting.admin.image.upload.room');
	Route::get('setting/room/delete-image', 'SettingsController@deleteImg')->name('setting.admin.image.delete');


	Route::post('setting/rooms/add-image', 'SettingsController@addimage')->name('room.addimage');
	Route::get('setting/contact', 'SettingsController@contact')->name('setting.admin.contact');
	Route::get('setting/about', 'SettingsController@about')->name('setting.admin.about');
	Route::get('setting/gallery', 'SettingsController@gallery')->name('setting.admin.gallery');
	Route::get('setting/attractions', 'SettingsController@attractions')->name('setting.admin.attractions');
	Route::post('setting/store-slider', 'SettingsController@storeSlider')->name('setting.admin.storeSlier');
	Route::post('setting/store-room', 'SettingsController@storeRoom')->name('setting.admin.storeRoom');
	Route::post('setting/store-about', 'SettingsController@storeAbout')->name('setting.admin.storeAbout');
	Route::post('setting/store-gallery', 'SettingsController@storeGallery')->name('setting.admin.storeGallery');
	Route::get('setting/user-list', 'SettingsController@userList')->name('setting.admin.userList');
	Route::get('setting/booking-list', 'SettingsController@bookingList')->name('setting.admin.bookingList');
	Route::post('setting/get-this-post-information', 'SettingsController@getPostInfo')->name('setting.admin.getPostInfo');
	Route::post('image/store-cropper-temp-image', 'ImagesController@storeCropperTempImg')->name('cropper.temp');
	Route::post('setting/store-attraction', 'AttractionController@storeAttraction')->name('setting.admin.storeAttraction');
	Route::post('setting/store-contact-info', 'ContactController@storeContactInfo')->name('setting.admin.storeContactInfo');
	Route::post('setting/check-contact-info', 'ContactController@checkContactInfo')->name('setting.admin.checkContact');
	Route::post('rooms/booking', 'RoomBookingController@store')->name('admin.room.booking');
	Route::get('setting/user-query', 'SettingsController@contactQuery')->name('setting.admin.contactQuery');
	Route::get('setting/social-setting', 'SettingsController@socialSetting')->name('setting.admin.socialSetting');
	Route::post('setting/store-social-url', 'SettingsController@storeSocialUrl')->name('setting.admin.storeSocialUrl');
	Route::get('setting/logo-setting', 'SettingsController@logoSetting')->name('setting.admin.logoSetting');
	Route::post('setting/store-logo', 'SettingsController@storeLogo')->name('setting.admin.storeLogo');
	Route::post('setting/delete-item', 'SettingsController@deleteItem')->name('setting.admin.deleteItem');
});