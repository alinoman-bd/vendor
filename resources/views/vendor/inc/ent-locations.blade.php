<input type="hidden" class="ent-category-slug" value="{{@$items['ent_cat']->slug}}">
<input type="hidden" class="ent-type-slug" value="{{@$items['ent_type']->slug}}">
<input type="hidden" class="ent-main-url" value="{{route('vendors.all')}}">
<div class="search-select">
	<div class="ctm-select" ctm-slt-n="cat_name">
		<div class="ctm-select-txt pad-l-10">
			<span class="select-txt set-lake-name" id="category">@if(@$items['ent_exist_location']->name) {{@$items['ent_exist_location']->name}} @else Search @endif</span>
			<span class="select-arr"><i class="fa fa-chevron-down"></i></span>
		</div>
		<input type="hidden" name="app_lake" class="app_lake" value="">
		<div class="ctm-option-box">
			<div class="input-group search-input m-0">
				<div class="input-group-prepend">
					<span class="input-group-text pr-0"><i class="fa fa-search"></i></span>
				</div>
				<input type="text" name="q" class="form-control" placeholder="Search..." value="" onkeyup="entSearchLocation(this.value)">
				<div class="input-search-box">
				</div>
			</div>
			<div class="ent-location-content">
				@include('vendor.inc.ent-locations-content')
			</div>
		</div>
	</div>
</div>