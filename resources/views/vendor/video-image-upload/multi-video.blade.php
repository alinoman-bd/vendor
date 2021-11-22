@if(count($resource->videos) > 0)
	@foreach($resource->videos as $video)
		<div class="col-3 col-lg-3">
			<div class="embed-responsive embed-responsive-16by9">
				@if($video->video_status == 1)
					<video poster="{{asset('videos/'.$video->video_thumb)}}" src="{{asset('videos/'.$video->video)}}" controls allowfullscreen></video>

				@else 
					<iframe class="embed-responsive-item" src="{{$video->video}}" allowfullscreen></iframe>
				@endif
			</div>
			<p class="text-center mdl-dle" onclick="deleteVideo('{{$resource->id}}','{{$video->id}}','{{$rec_ent}}')">X</p>
		</div>
	@endforeach
@endif