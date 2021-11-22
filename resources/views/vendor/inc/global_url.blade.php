<script>
    window.base_url = '<?= url("/") ?>';
	window.getLocationUrl = '<?= Route("location") ?>';
	window.getLakesUrl = '<?= Route("lakes") ?>';
	window.getRiversUrl = '<?= Route("rivers") ?>';
	window.locationLakeRiver= '<?= Route("location.lake.river") ?>';
	window.csrf_token = '<?= csrf_token() ?>';
	window.cropper_tmp_img = "<?= route('cropper.temp')?>";
	window.vendor_login_url = "<?= route('user.login')?>";
	window.resourceDelete = "<?= route('resource.delete')?>";
	window.resourceImageDelete = "<?= route('resource.image.delete')?>";
	window.resourceMakeFavorite = "<?= route('resource.favorite')?>";
	window.deleteFavrite = "<?= route('favorite.delete')?>";
	window.resourceViewed = "<?= route('resource.viewed')?>";
	window.singleRoom = "<?= route('room.single')?>";
	window.resourceStatus = "<?= route('superadmin.res.change')?>";
	window.superadmin = "<?= route('superadmin')?>";
	window.resourceVip = "<?= route('resource.vip')?>";
	window.makVip = "<?= route('resource.makeVip')?>";
	window.searchResource = "<?= route('resource')?>";
	window.menuFilter = "<?= route('menu.filter')?>";
	window.resourceUserChange = "<?= route('resource.status.change')?>";
	window.resourceEditLocation = "<?= route('resource.edit.getLocation')?>";
	window.mainSearchSuggestion = "<?= route('search.suggestion')?>";
	window.search_url = "<?= route('vendors.all')?>";
	window.entImageDelete = "<?= route('ent.image.delete')?>";
	window.getFavorite = "<?= route('favorite')?>";
	window.ent_location_search = "<?= route('ent.location.search')?>";
	window.verification_resend = "<?= route('register.verification.resend')?>";
	window.payment_package = "<?= route('payment.package')?>";
	window.delete_video = "<?= route('video.delete')?>";

	
</script>
