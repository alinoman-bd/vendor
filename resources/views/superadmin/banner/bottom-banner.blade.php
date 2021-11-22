@if(count($banner_bottom) > 0)
	<div class="row">
		<div class="col-lg-12">
			<p class="b-heading">Bottom Banners</p>
		</div>
		<div class="col-lg-12">
			<div class="row">
				@foreach($banner_bottom as $banner)
					<div class="col-lg-3">
						<a href="javascript:;" onclick="editBanner('{{$banner->id}}')"><img src="{{asset('images/banner/'.$banner->image)}}" class="img-fluid" title="{{$banner->link}}"></a>
						<div class="removeImg">
		    				<i class="fas fa-trash-alt" onclick="removeBanner('{{$banner->id}}')"></i>
		    			</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
@endif