@php
    $total_locations = 0;
    $menuArray = [];
    $colsize = 3;
    foreach ($menu['location_lakes_rivers'] as $location) {
        $total_locations += $location->lakes->count();
    }
    $per_col = (int) ceil($total_locations / $colsize);
    $count = 0;
    $col = 1;
@endphp
@foreach ($menu['location_lakes_rivers'] as $key => $location)
    @foreach($location->lakes as $key1 => $lake)
        @php
            if($loop->iteration == 1) {
                if ($location->lakes->count() > $per_col && $col < $colsize) {
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
            $menuArray[$col]['location'][$key]['slug'] = $location->slug;
            $menuArray[$col]['location'][$key]['name'] = $location->name;
            $menuArray[$col]['location'][$key]['lake'][$key1]['slug'] = $lake->slug;
            $menuArray[$col]['location'][$key]['lake'][$key1]['name'] = $lake->name;
        @endphp
    @endforeach
@endforeach
<div class="col-12">
    <div class="input-group search-input menu-search">
        <div class="input-group-prepend">
            <span class="input-group-text pr-0"><i class="fa fa-search"></i></span>
        </div>
        <input type="text" name="search_text" id="lake_location_cols" onkeyup="searchmenu('lake_location_cols')" class="form-control menu-search_input"  placeholder="Type to search..." value="" autocomplete="off">
        <div class="input-search-box put-main-suggestion">
        </div>
    </div>
</div>

@foreach ($menuArray as $menu)
    <div class="col-12 col-sm-6 col-md-4 lake_location_cols">
    @foreach ($menu['location'] as $location)
		<div class="cnt-tlt"><a href="javascript:;" data-urlfn="mainCity" data-urlslug="{{$location['slug']}}">{{ $location['name'] }}</a></div>
		<div class="cnt-link-all">
            @foreach($location['lake'] as $lake)
				<div class="cnt-link"><a href="javascript:;" data-urlfn="mainLocation" data-urlslug="{{$location_slug.$lake['slug']}}">{{ $lake['name'] }}</a></div>
			@endforeach
		</div>
    @endforeach
	</div>
@endforeach

