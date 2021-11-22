<div class="form-cnt">
	<div class="form-title">
		<h2>@lang('vedor.label.upload') @lang('vedor.label.image')</h2>
	</div>
	<div class="all-form">
		<form method="post" action="{{ route('ent.uploadImage',['id'=>$resource->id]) }}" enctype="multipart/form-data" id="rcMultipleImage">
			@csrf
			@include('vendor.inc.form.entertainment-form.multi-image')
		</form>
		<div class="uploadedImage"> 
			@include('vendor.inc.form.entertainment-form.resource-images')
		</div>

	</div>
</div>