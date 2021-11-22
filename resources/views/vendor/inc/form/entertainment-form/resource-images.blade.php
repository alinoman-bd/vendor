<div class="row">
	@if(count($resource->recourceImage) > 0)
		@foreach ($resource->recourceImage as $image)
    		<div class="col-md-3 mulImg">
    			<img src="{{asset('images/resource/ex-small/'.$image->path)}}" class="img-fluid">
    			<div class="removeImg">
    				<i class="fas fa-trash-alt" onclick="removeEntImage({{$resource->id}},{{$image->id}})"></i>
    			</div>
    			
    		</div>
		@endforeach
	@endif	 
</div> 