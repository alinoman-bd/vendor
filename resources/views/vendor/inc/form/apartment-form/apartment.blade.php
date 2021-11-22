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
		<h3><img src="{{asset('vendor/img/post-add1.png')}}" alt="post-add" class="img-fluid">@lang('vendor.label.required.message')</h3>
		<a href="{{route('ent.add_form')}}" class="btn btn-primary">@lang('vendor.label.add') @lang('vendor.label.entertainments')</a>
	</div> 
	@include('vendor.inc.form.apartment-form.type')
	<div class="form-group row">
		<label for="tips" class="col-sm-3 col-form-label text-left text-sm-right">Miestas/ rajonas OR Sea<sup>*</sup></label>
		<div class="col-sm-9">
			<div class="row m-0">
				<div class="col-12 col-md-6">
					<label class="ctm-container" onclick="hideSeaSite()"> Miestas/ rajonas
						<input type="radio" name="check_type_value" value="1" class="check_city_location" @if(@$resource->location_id) checked @endif>
						<span class="checkmark"></span>
					</label>
				</div>
				<div class="col-12 col-md-6">
					<label class="ctm-container" onclick="hideCityLocation()"> Sea site
						<input type="radio" name="check_type_value" value="2" class="check_sea_site" @if(@$resource->sea_id) checked @endif>
						<span class="checkmark"></span>
					</label>
				</div>
			</div>
		</div>
	</div>
	<div class="city-location-section">
		@include('vendor.inc.form.apartment-form.city')
		<div class="set-location">
			@include('vendor.inc.form.apartment-form.location')
		</div>
		<div class="form-group row">
			<label class="col-sm-3 col-form-label text-left text-sm-right">Ežerai/ upės<sup>*</sup></label>
			<div class="col-sm-9">
				<div class="form-row">
					<div class="form-group col-md-6 set-lakes">
						@include('vendor.inc.form.apartment-form.lakes')
					</div>

					<div class="form-group col-md-6 set-rivers">
						@include('vendor.inc.form.apartment-form.rivers')
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="set-sea only-sea-section">
		@include('vendor.inc.form.apartment-form.sea')
	</div>
	<div class="form-group row">
		<label class="col-sm-3 col-form-label text-left text-sm-right">Atstumas iki ežero/ upės</label>
		<div class="col-sm-9">
			<div class="input-group mb-3">
				<input type="text" class="form-control app_d_from_river" name="app_d_from_river" value="{{ @$resource->distance_from_river }}">
				<div class="input-group-append">
					<span class="input-group-text" id="basic-addon2">m</span>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-3 col-form-label text-left text-sm-right">Atstumas iki ežero/ Ežerai</label>
		<div class="col-sm-9">
			<div class="input-group mb-3">
				<input type="text" class="form-control app_d_from_lake" name="app_d_from_lake" value="{{ @$resource->distance_from_lake }}">
				<div class="input-group-append">
					<span class="input-group-text" id="basic-addon2">m</span>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-3 col-form-label text-left text-sm-right">Atstumas iki ežero/ Sea</label>
		<div class="col-sm-9">
			<div class="input-group mb-3">
				<input type="text" class="form-control app_d_from_sea" name="app_d_from_sea" value="{{ @$resource->distance_from_sea }}">
				<div class="input-group-append">
					<span class="input-group-text" id="basic-addon2">m</span>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-3 col-form-label text-left text-sm-right">Pavadinimas/ antraštė<sup>*</sup></label>
		<div class="col-sm-9">
			<input type="text" class="form-control app_resource_name" name="app_resource_name" value="{{ @$resource->name }}">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-3 col-form-label text-left text-sm-right">Sort Title<sup>*</sup></label>
		<div class="col-sm-9">
			<input type="text" class="form-control app_sort_title" name="app_sort_title" value="{{ @$resource->short_title }}">
		</div>
	</div>
	<div class="form-group row text-right">
		<label class="col-sm-3 col-form-label text-left text-sm-right">Description<sup>*</sup></label>
		<div class="col-sm-9"> 
			<textarea class="form-control app_description" name="app_description" >{{ @$resource->description }}</textarea>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-3 col-form-label text-left text-sm-right">Adresas<sup>*</sup></label>
		<div class="col-sm-9">
			<input type="text" class="form-control app_address" name="app_address" id="app_address_auto" value="{{ @$resource->address }}">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-3 col-form-label text-left text-sm-right">Nearest location <sup>*</sup></label>
		<div class="col-sm-9">
			<input type="text" class="form-control nearest_location" name="nearest_location" value="{{ @$resource->nearest_locations }}">
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-3 col-form-label text-left text-sm-right">Telefonai <sup>*</sup></label>
		<div class="col-sm-9">
			<input type="text" class="form-control app_phone" name="app_phone" value="{{ @$resource->phone }}">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-3 col-form-label text-left text-sm-right">El. pašto adresai <sup>*</sup></label>
		<div class="col-sm-9">
			<input type="email" class="form-control app_email" name="app_email" value="{{ @$resource->email }}">
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-3 col-form-label text-left text-sm-right">Kaina parai<sup>*</sup></label>
		<div class="col-sm-9">
			<div class="form-row">
				<div class="form-group col-md-4">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">nuo</span>
						</div>
						<input type="text" class="form-control app_single_min_price" aria-label="Amount (to the nearest dollar)" name="app_single_min_price" value="{{ @$resource->min_price}}">
						<div class="input-group-append">
							<span class="input-group-text">iki</span>
						</div>
					</div>
				</div>
				<div class="form-group col-md-4">
					<div class="input-group mb-3">
						<input type="text" class="form-control app_single_max_price" name="app_single_max_price" value="{{ @$resource->max_price}}">
						<div class="input-group-append">
							<span class="input-group-text" id="basic-addon2">€</span>
						</div>
					</div>
				</div>
				@include('vendor.inc.form.apartment-form.price-per-day')
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-3 col-form-label text-left text-sm-right">Viso komplekso nuomos kaina parai:<sup>*</sup></label>
		<div class="col-sm-9">
			<div class="form-row">
				<div class="form-group col-md-4">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">nuo</span>
						</div>
						<input type="text" class="form-control app_total_min_price" aria-label="Amount (to the nearest dollar)" name="app_total_min_price" value="{{ @$resource->total_min_price}}">
						<div class="input-group-append">
							<span class="input-group-text">iki</span>
						</div>
					</div>
				</div>
				<div class="form-group col-md-4">
					<div class="input-group mb-3">
						<input type="text" class="form-control app_total_max_price" name="app_total_max_price" value="{{ @$resource->total_max_price}}">
						<div class="input-group-append">
							<span class="input-group-text" id="basic-addon2">€</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-3 col-form-label text-left text-sm-right">Bendras numerių skaičus<sup>*</sup></label>
		<div class="col-sm-9">
			<div class="form-row">
				<div class="form-group col-md-12">
					<div class="input-group mb-3">
						<input type="text" class="form-control app_total_room" name="app_total_room" value="{{ @$resource->number_of_rooms }}">
						<div class="input-group-append">
							<span class="input-group-text">Kiek kambarių/ butų/ numerių nuomojate</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-3 col-form-label text-left text-sm-right">Bendras vietų skaičius<sup>*</sup></label>
		<div class="col-sm-9">
			<div class="form-row">
				<div class="form-group col-md-12">
					<div class="input-group mb-3">
						<input type="text" class="form-control app_total_people" name="app_total_people" value="{{ @$resource->number_of_people }}">
						<div class="input-group-append">
							<span class="input-group-text">Kiek svečių gali apsistoti vienu met</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('vendor.inc.form.apartment-form.season')
	@include('vendor.inc.form.apartment-form.payment')
	<div class="form-group row text-right">
		<label class="col-sm-3 col-form-label text-left text-sm-right">Pastabos, klausimai<sup>*</sup></label>
		<div class="col-sm-9">
			<textarea class="form-control app_note" name="app_note">{{ @$resource->note }}</textarea>
		</div>
	</div>
	<div class="form-group row text-right">
		<label class="col-sm-3 col-form-label text-left text-sm-right">Kontaktinis asmuo<sup>*</sup></label>
		<div class="col-sm-9"> 
			<textarea class="form-control app_contact_person" name="app_contact_person" >{{ @$resource->contact_person }}</textarea>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-3 col-form-label text-left text-sm-right"></label>
		<div class="col-sm-9">
			<a href="javascript:;" data-toggle="modal" data-target="#facilityModal"><i class="fas fa-edit"></i> @lang('vendor.label.add') @lang('vendor.label.facilities')</a>
		</div>
	</div>

	<div class="form-group row">

			<label class="col-sm-3 col-form-label text-left text-sm-right"> @lang('vendor.label.mainimage')<sup>*</sup></label>
				   {{-- <label style="width: 100%;" for="title" class="control-label img-label">@lang('vendor.label.mainimage'):</label> --}}

		<div class="col-sm-9">

	   <div class="pre-img-box p-img-box">
	      <div class="input-f">
	         <input style="display: none;" name="main_image" type="file" id="main_file"/>
	         <label for="main_file" class="btn-3 inf-brn">
	         <samp><i class="fa fa-upload"></i></samp>
	         <span>@lang('vendor.label.mainimage')  </span>
	         </label>
	         <span class="image-s"><span id="main_width">1080</span> X <span id="main_height">720</span>
	         px</span>
	      </div>
	      <div class="pre-img pre-thumb"><img id="main_preview" src="@if(@$resource->image) {{asset('images/resource/ex-small/'.$resource->image)}} @else {{asset('images/choose-logo.png')}} @endif" alt="your image" /></div>
	   </div>
	</div>
</div>
	@include('vendor.inc.form.apartment-form.facilities')
</div>