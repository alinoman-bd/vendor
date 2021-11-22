@php
    $total_locations = 0;
    $menuArray = [];
    $colsize = 3;
    foreach ($menu['city_location'] as $cities) {
        $total_locations += $cities->locations->count();
    }
    $per_col = (int) ceil($total_locations / $colsize);
    $count = 0;
    $col = 1;
@endphp
@foreach ($menu['city_location'] as $key => $city)
    @foreach($city->locations as $key1 => $location)
        @php
            if($loop->iteration == 1) {
                if ($city->locations->count() > $per_col && $col < $colsize) {
                    $count = 0;
                }
            }
            if ($count > $per_col) {
                $count = 0;
                if ($col < $colsize) {
                    $col += 1;
                }
            }
            $count += 1;

            $menuArray[$col]['city'][$key]['slug'] = $city->slug;
            $menuArray[$col]['city'][$key]['name'] = $city->name;
            $menuArray[$col]['city'][$key]['location'][$key1]['slug'] = $location->slug;
            $menuArray[$col]['city'][$key]['location'][$key1]['name'] = $location->name;
        @endphp
    @endforeach
@endforeach
<div class="col-12">
    <div class="input-group search-input menu-search">
        <div class="input-group-prepend">
            <span class="input-group-text pr-0"><i class="fa fa-search"></i></span>
        </div>
        <input type="text" name="search_text" id="city_location_cols" onkeyup="searchmenu('city_location_cols')" class="form-control menu-search_input"  placeholder="Type to search..." value="" autocomplete="off">
        <div class="input-search-box put-main-suggestion">
        </div>
    </div>
</div>
@foreach ($menuArray as $key => $menu)
    <div class="col-12 col-sm-6 col-md-4 city_location_cols" id="city_location_{{$key}}">
    @foreach ($menu['city'] as $city)
		<div class="cnt-tlt"><a href="javascript:;" id="rclk"  data-urlfn="mainCity" data-urlslug="{{$city['slug']}}">{{ $city['name'] }}</a></div>
		<div class="cnt-link-all">
            @foreach($city['location'] as $location)
				<div class="cnt-link"><a href="javascript:;"   data-urlfn="mainLocation" data-urlslug="{{$location['slug']}}">{{ $location['name'] }}</a></div>
			@endforeach
		</div>
    @endforeach
	</div>
@endforeach

