<input type="hidden" name="menu_city" id="menu_city" value="{{@$items['city']->slug}}">
<input type="hidden" name="menu_location" id="menu_location" value="{{@$items['location']->slug}}">
<input type="hidden" name="menu_city_id" id="menu_city_id" value="{{@$items['city']->id}}">
<input type="hidden" name="menu_location_id" id="menu_location_id" value="{{@$items['location']->id}}">
<input type="hidden" name="menu_lake" id="menu_lake" value="{{@$items['lake']->slug}}">
<input type="hidden" name="menu_river" id="menu_river" value="{{@$items['river']->slug}}">
<input type="hidden" name="menu_type" id="menu_type" value="{{@$items['type']->slug}}">
<input type="hidden" name="menu_sea" id="menu_sea" value="{{@$items['sea']->slug}}">
<div class="main-menu">
	<ul class="nav nav-pills nav-fill">
		<li class="nav-item">
			<a class="nav-link li-cnt-show" href="javascript:void(0)"><i class="fas fa-map-marker-alt"></i>
				@if(@$items['location']->name)
					{{$items['location']->name}}
                    <span class="search-close-button" onclick="resetFilter('{{$items['location']->slug}}')">
                        <i class="fas fa-times"></i>
                    </span>
				@elseif(@$items['city']->name)
					{{$items['city']->name}}
                    <span class="search-close-button" onclick="resetFilter('{{$items['city']->slug}}')">
                        <i class="fas fa-times"></i>
                    </span>
				@else
                Pasirinkite Vietovę
				@endif
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link li-cnt-show" href="javascript:void(0)"><i class="fas fa-bars"></i>
				@if(@$items['lake']->name)
					{{$items['lake']->name}}
                    <span class="search-close-button" onclick="resetFilter('{{$items['lake']->slug}}')">
                        <i class="fas fa-times"></i>
                    </span>
				@else
                Pasirinkite ežerą
				@endif
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link li-cnt-show" href="javascript:void(0)"><i class="fas fa-text-width"></i>
				@if(@$items['river']->name)
					{{$items['river']->name}}
                    <span class="search-close-button" onclick="resetFilter('{{$items['river']->slug}}')">
                        <i class="fas fa-times"></i>
                    </span>
				@else
                Pasirinkite upę
				@endif
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link li-cnt-show" href="javascript:void(0)"><i class="fas fa-text-width"></i>
				@if(@$items['sea']->name)
					{{$items['sea']->name}}
                    <span class="search-close-button" onclick="resetFilter('{{$items['sea']->slug}}')">
                        <i class="fas fa-times"></i>
                    </span>
				@else
                Pasirinkite Jūrą
				@endif
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link li-cnt-show" href="javascript:void(0)"><i class="fas fa-text-width"></i>
				@if(@$items['type']->name)
					{{$items['type']->name}}
                    <span class="search-close-button" onclick="resetFilter('{{$items['type']->slug}}')">
                        <i class="fas fa-times"></i>
                    </span>
				@else
                Pasirinkite tipą
				@endif
			</a>
		</li>
	</ul>
</div>
<div class="main-menu-content">
	<div class="main-menu-content-nav main-cnt-show d-none">
		<div class="row m-0 city_location">
			{{-- put city location --}}
		</div>
	</div>

	<div class="main-menu-content-nav main-cnt-show d-none">
		<div class="row m-0 location_lake">
			{{-- put location lake --}}
		</div>
	</div>
	<div class="main-menu-content-nav main-cnt-show d-none">
		<div class="row m-0 location_river">
			{{-- put location river --}}
		</div>
	</div>
	<div class="main-menu-content-nav main-cnt-show d-none">
		<div class="row m-0">
			<div class="col-12 col-sm-6 col-md-4">
				<div class="cnt-tlt"><a href=""></a></div>
				<div class="cnt-link-all">
					@foreach ($seas as $key => $sea)
						@if($key < 14)
							<div class="cnt-link"><a href="javascript:;" data-urlfn="mainSea" data-urlslug="{{$sea->slug}}">{{ $sea->name }}</a></div>
						@endif
					@endforeach
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4">
				<div class="cnt-tlt"><a href=""></a></div>
				<div class="cnt-link-all">
					@foreach ($seas as $key => $sea)
						@if($key > 13 && $key < 28)
							<div class="cnt-link"><a href="javascript:;" data-urlfn="mainSea" data-urlslug="{{$sea->slug}}">{{ $sea->name }}</a></div>
						@endif
					@endforeach
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4">
				<div class="cnt-tlt"><a href=""></a></div>
				<div class="cnt-link-all">
					@foreach ($seas as $key => $sea)
						@if($key > 27)
							<div class="cnt-link"><a href="javascript:;" data-urlfn="mainSea" data-urlslug="{{$sea->slug}}">{{ $sea->name }}</a></div>
						@endif
					@endforeach
				</div>
			</div>
		</div>
	</div>


	<div class="main-menu-content-nav main-cnt-show d-none">
		<div class="row m-0">
			<div class="col-12 col-sm-6 col-md-4">
				<div class="cnt-tlt"><a href=""></a></div>
				<div class="cnt-link-all">
					@foreach ($types as $key => $type)
						@if($key < 5)
							<div class="cnt-link"><a href="javascript:;" data-urlfn="mainType" data-urlslug="{{$type->slug}}">{{ $type->name }}</a></div>
						@endif
					@endforeach
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4">
				<div class="cnt-tlt"><a href=""></a></div>
				<div class="cnt-link-all">
					@foreach ($types as $key => $type)
						@if($key > 4 && $key < 10)
							<div class="cnt-link"><a href="javascript:;" data-urlfn="mainType" data-urlslug="{{$type->slug}}">{{ $type->name }}</a></div>
						@endif
					@endforeach
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4">
				<div class="cnt-tlt"><a href=""></a></div>
				<div class="cnt-link-all">
					@foreach ($types as $key => $type)
						@if($key > 9)
							<div class="cnt-link"><a href="javascript:;" data-urlfn="mainType" data-urlslug="{{$type->slug}}">{{ $type->name }}</a></div>
						@endif
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
