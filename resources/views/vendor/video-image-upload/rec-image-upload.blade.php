 <div class="form-cnt">
	<div class="form-title">
		<h2>@lang('vendor.label.upload') @lang('vendor.label.image')</h2>
	</div>
	<div class="all-form">
		<form method="post" action="{{ route('resource.uploadImage',['id'=>$resource->id]) }}" enctype="multipart/form-data" id="rcMultipleImage">
			@csrf
			@include('vendor.inc.form.apartment-form.multi-image')
		</form>
		<div class="uploadedImage"> 
			@include('vendor.inc.form.apartment-form.resource-images')
		</div>

	</div>
</div>