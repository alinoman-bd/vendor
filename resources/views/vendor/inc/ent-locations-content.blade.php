@if(count($ent_locations) > 0)
	@foreach($ent_locations as $location)
		<div class="ctm-option" onclick="SearchByEntLocation('{{$location->slug}}')">{{$location->name}}</div>
	@endforeach
@endif