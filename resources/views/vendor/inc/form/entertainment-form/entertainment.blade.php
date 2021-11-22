<div class="single-form">
	@if (Session::has('success'))
		<div class="alert alert-primary alert-dismissible fade show" role="alert">
		  	{{ Session::get('success')}}
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	@endif	

	<div class="single-form-title s-f-t">
		<h3><img src="{{asset('vendor/img/post-add1.png')}}" alt="post-add" class="img-fluid">Please fill up all required field</h3>
		<a href="{{route('apartment.show')}}" class="btn btn-primary">Add Resource</a> 
	</div>
	@include('vendor.inc.form.entertainment-form.type')
	@include('vendor.inc.form.apartment-form.city')
	<div class="set-location">
		@include('vendor.inc.form.apartment-form.location')
	</div>
	<div class="form-group row">
		<label class="col-sm-3 col-form-label text-left text-sm-right">Pavadinimas/ antraštė<sup>*</sup></label>
		<div class="col-sm-9">
			<input type="text" class="form-control app_resource_name" name="name" value="{{ @$resource->name }}">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-3 col-form-label text-left text-sm-right">Sort Title<sup>*</sup></label>
		<div class="col-sm-9">
			<input type="text" class="form-control app_sort_title" name="short_title" value="{{ @$resource->short_title }}">
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-3 col-form-label text-left text-sm-right">Price<sup>*</sup></label>
		<div class="col-sm-9">
			<input type="text" class="form-control app_min_price" name="min_price" value="{{ @$resource->min_price }}">
		</div>
	</div>

	<div class="form-group row text-right">
		<label class="col-sm-3 col-form-label text-left text-sm-right">Description<sup>*</sup></label>
		<div class="col-sm-9"> 
			<textarea class="form-control app_description" name="description" >{{ @$resource->description }}</textarea>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-3 col-form-label text-left text-sm-right">Adresas<sup>*</sup></label>
		<div class="col-sm-9">
			<input type="text" class="form-control app_address" name="address" id="app_address_auto" value="{{ @$resource->address }}">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-3 col-form-label text-left text-sm-right">Telefonai <sup>*</sup></label>
		<div class="col-sm-9">
			<input type="text" class="form-control app_phone" name="phone" value="{{ @$resource->phone }}">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-3 col-form-label text-left text-sm-right">El. pašto adresai <sup>*</sup></label>
		<div class="col-sm-9">
			<input type="email" class="form-control app_email" name="email" value="{{ @$resource->email }}">
		</div>
	</div>
	@include('vendor.inc.form.apartment-form.season')
	<div class="form-group row"> 
		<label class="col-sm-3 col-form-label text-left text-sm-right">Main Image<sup>*</sup></label>
	   {{-- <label style="width: 100%;" for="title" class="control-label img-label">Main Image:</label> --}}
	   <div class="col-sm-9">
	   <div class="pre-img-box">
	      <div class="input-f">
	         <input style="display: none;" name="main_image" type="file" id="main_file"/>
	         <label for="main_file" class="btn-3 inf-brn">
	         <samp><i class="fa fa-upload"></i></samp>
	         <span>Main Image  </span>
	         </label>
	         <span class="image-s"><span id="main_width">1080</span> X <span id="main_height">720</span>
	         px</span>
	      </div>
	      <div class="pre-img pre-thumb"><img id="main_preview" src="@if(@$resource->image) {{asset('images/resource/ex-small/'.$resource->image)}} @else {{asset('images/choose-logo.png')}} @endif" alt="your image" /></div>
	   </div>
	</div>
</div>
</div>