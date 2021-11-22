@extends('vendor.layouts.app')
@section('meta')
<title>{{$resource->name}}</title>
<meta name="description" content="{{$resource->name}}">
<meta name="keywords" content="{{$resource->name}}">
@endsection
@section('style')
<link href="{{asset('vendor/css/viewed-resource.css')}}" rel="stylesheet">
<style>
	.phone-next {
		display: none;
		-webkit-touch-callout: none;
		/* iOS Safari */
		-webkit-user-select: none;
		/* Safari */
		-khtml-user-select: none;
		/* Konqueror HTML */
		-moz-user-select: none;
		/* Old versions of Firefox */
		-ms-user-select: none;
		/* Internet Explorer/Edge */
		user-select: none;
		/* Non-prefixed version, currently
        supported by Chrome, Edge, Opera and Firefox */
	}

	.phone-prev {
		cursor: pointer;
	}

	.pls-click-view-ph {
		font-size: 10px;
	}

	.video-thumb-img {
		float: left;
		width: 18.95%;
		margin-top: 11px;
		margin-right: 10px;
		height: 100%;
	}

	.v-opcity {
		opacity: 0.6;
	}
</style>
@endsection

@section('content')
<section class="details-section">
	<div class="row m-0">
		<div class="col-12 col-lg-9 pl-0">
			<div class="content-details bg-white">
				<div class="dt-top-cnt">
					<span class="dt-name">{{ $resource->name }}</span>
					@php
					$star = Helper::getRating($resource->comments);
					@endphp
					<span class="ratting-li-star">
						@for($num = 1; $num <= $star; $num++) <i class="fas fa-star"></i>
							@endfor
					</span>
					<span class="ratting-li-like"><i class="fas fa-thumbs-up"></i></span>
					<span class="user-rating">{{$star}} / 10</span>
					<span class="sh-lv  float-none  float-sm-right">
						<a href="javascript:;"><i class="far fa-heart global-fav-icon {{Helper::checkFavorite(2, $resource->id)}}" status="2" fav-id="{{$resource->id}}"></i></a>

						{{-- <a href=""><i class="fas fa-share-alt"></i></a> --}}
					</span>
				</div>
				<div class="s-tlt">{{ $resource->short_title }}</div>
				<div class="address"><i class="fas fa-map-marker-alt"></i> {{ $resource->address }}</div>

				<div class="gallery-slider">
					<div class="swiper-container gallery-top gallery-top1">
						<div class="swiper-wrapper">
							@if($resource->image)
							<div class="swiper-slide">
								<div class="slide-img">
									<img src="{{asset('images/resource/medium/'.$resource->image)}}" class="cover" alt="img" onclick="openFancyboxItem('mainimage{{$resource->id}}')">
								</div>
							</div>
							@endif

							@if(count($resource->recourceImage))
							@foreach ($resource->recourceImage as $image)
							<div class="swiper-slide">
								<div class="slide-img">
									<img src="{{asset('images/resource/medium/'.$image->path)}}" class="cover" alt="img" onclick="openFancyboxItem('image{{$image->id}}')">
								</div>
							</div>
							@endforeach
							@endif


						</div>
					</div>
					<div class="swiper-container gallery-thumbs gallery-thumbs1">
						<div class="swiper-wrapper">
							@if($resource->image)
							<div class="swiper-slide slide1">
								<div class="slide-img">
									<img src="{{asset('images/resource/ex-small/'.$resource->image)}}" class="cover" alt="img">
								</div>
							</div>
							@endif
							@if(count($resource->recourceImage))
							@foreach ($resource->recourceImage as $image)
							<div class="swiper-slide">
								<div class="slide-img">
									<img src="{{asset('images/resource/ex-small/'.$image->path)}}" class="cover" alt="img">
								</div>
							</div>
							@endforeach
							@endif
						</div>
						@if($resource->image)
						@if(count($resource->recourceImage) > 3)
						<div class="more-photos more-photos1" onclick="openFancyboxItem('mainimage{{$resource->id}}')" style="cursor:pointer">
							<div class="m-img">+{{count($resource->recourceImage) - 3}} photos</div>
						</div>
						@endif
						@endif
					</div>
				</div>
				<div class="d-none">
					@if($resource->image)
					<a href="{{asset('images/resource/large/'.$resource->image)}}" data-fancybox="gallery" data-fancy-id="mainimage{{$resource->id}}">
						mainimage{{$resource->id}}
					</a>
					@endif
					@if(count($resource->recourceImage))
					@foreach ($resource->recourceImage as $image)
					<a href="{{asset('images/resource/large/'.$image->path)}}" data-fancybox="gallery" data-fancy-id="image{{$image->id}}">
						image{{$image->id}}
					</a>
					@endforeach
					@endif
				</div>
				<div class="pop-faci">
					<div class="pop-faci-tlt font-weight-bold">Description</div>
					<div class="des-cnt">
						<p>{{$resource->description}}</p>
					</div>
				</div>

				<div class="contact-info">
					<div class="contact-tlt">Kontaktai</div>
					{{-- <div class="con-txt1">Ezeras Vikoknise - 500</div> --}}
					<div class="con-info-all row">
						<div class="col-6 col-lg-6">
							<div class="con-info"><span>Name: </span> {{$resource->name}}</div>
							@if($resource->price)
							<div class="con-info"><span>Price: </span> {{$resource->min_price}}</div>
							@endif
							@if($resource->short_title)
							<div class="con-info"><span>Sort Title: </span> {{$resource->short_title}}</div>
							@endif
							@if($resource->address)
							<div class="con-info"><span>Address: </span> {{$resource->address}}</div>
							@endif
							@if($resource->phone)
							<div class="con-info phone-prev"><span>Phone: </span> {{Helper::phoneModify($resource->phone)}} <span class="pls-click-view-ph">Spustelkite, kad matytumėte numerį </span></div>
							<div class="con-info phone-next"><span>Phone: </span> {{$resource->phone}}</div>
							@endif
							@if($resource->city->name)
							<div class="con-info"><span>City: </span> {{$resource->city->name}}</div>
							@endif
							@if($resource->location->name)
							<div class="con-info"><span>Location: </span> {{$resource->location->name}}</div>
							@endif
						</div>
						<div class="col-6 col-lg-6">
							<div id="user-map" style="height: 100%"></div>
						</div>
						<div class="map-resource">
							<input type="hidden" id="d-address" value="{{$resource->address}}">
							<input type="hidden" id="rec-name" value="{{$resource->name}}">
						</div>
					</div>
					@if($resource->video)
					<div class="contact-tlt">Videos</div>
					<div class="row">
						<div class="col-12 col-lg-12">
							<div class="embed-responsive embed-responsive-16by9" id="put-single-video">
								@if($resource->video_status == 1)
								<video poster="{{asset('videos/'.$resource->video_thumb)}}" src="{{asset('videos/'.$video->video)}}" controls allowfullscreen></video>
								@else
								<iframe class="embed-responsive-item" src="{{$resource->video}}" allowfullscreen></iframe>
								@endif
							</div>
						</div>
						@if($resource->videos)
						<div class="col-12 col-lg-12">
							<img src="{{asset('videos/'.$resource->video_thumb)}}" class="img-fluid video-thumb-img" video-src="@if($resource->video_status == 1){{asset('videos/'.$resource->video)}}@else{{$resource->video}}@endif" video-status="{{$resource->video_status}}">
							@foreach($resource->videos as $video)
							<img src="{{asset('videos/'.$video->video_thumb)}}" class="img-fluid video-thumb-img v-opcity" video-src="@if($video->video_status == 1){{asset('videos/'.$video->video)}}@else{{$video->video}}@endif" video-status="{{$video->video_status}}">
							@endforeach
						</div>
						@endif
					</div>
					@endif

					<div class="review_section">
						<div class="room-side-tlt">Reviews</div>
						<div class="add-review-all">
							<button data-toggle="modal" data-target="#reviewModal" class="btn add-review-btn">Add review</button>
						</div>
						<div class="blog-card-all all-review-list">
							@include('vendor.review.review')
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-lg-3 pr-0 d-right-cnt">
			@include('vendor.inc.vip-resources.sidebar-rec-vip1')
		</div>
	</div>
</section>
<section class="content-list-section">
	<div class="content-list">
		<div class="row -0">
			@include('vendor.inc.vip-resources.detail-page-rec-vip2')
		</div>
	</div>
</section>
<section class="all-viewed-resource">
	@include('vendor.inc.viewed-resource')
</section>
@include('vendor.review.add-review')
@include('vendor.review.replay-review')

@endsection
@section('script')
<script src="{{asset('vendor/js/js_r/rec-details.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyAnMJd489Qa_hRJXPon9VFHHFpGchq8Ib4"></script>
@endsection