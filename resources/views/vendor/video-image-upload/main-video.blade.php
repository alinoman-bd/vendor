<div class="embed-responsive embed-responsive-16by9">
	@if($resource->video_status == 1)
		<video poster="{{asset('videos/'.$resource->video_thumb)}}" src="{{asset('videos/'.$resource->video)}}" controls allowfullscreen></video>
	@else 
		<iframe class="embed-responsive-item" src="{{$resource->video}}" allowfullscreen></iframe>
	@endif
</div>
