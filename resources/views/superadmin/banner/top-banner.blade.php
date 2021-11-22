@if(count($banner_top) > 0)
	<div class="row">
		<div class="col-lg-12">
			<p class="b-heading">Top Banners</p>
		</div>
		<div class="col-lg-12">
			<div class="row">
				@foreach($banner_top as $banner)
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