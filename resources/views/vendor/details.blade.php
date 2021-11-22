@extends('vendor.layouts.app')
@section('meta')
    <title>{{ $resource->name }}</title>
    <meta name="description" content="{{ $resource->name }}">
    <meta name="keywords" content="{{ $resource->name }}">
@endsection
@section('style')
    <link href="{{ asset('vendor/css/viewed-resource.css') }}" rel="stylesheet">
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
        <div class="back-ul">
            {{-- <ul>
			<li><a href="#">Home</a></li>
			<li></li>
			<li class="active">Post A Add</li>
		</ul> --}}
        </div>

        <div class="row m-0">
            <div class="col-12 col-lg-9 pl-0">
                <div class="content-details bg-white">
                    <div class="dt-top-cnt d-flex align-items-center justify-content-between flex-wrap">
                        <div class="mb-2">
                            <span class="dt-name">{{ $resource->name }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="mr-3 mb-2">
                                @php
                                    $star = Helper::getRating($resource->comments);
                                @endphp
                                <span class="ratting-li-star">
                                    @for ($num = 1; $num <= $star; $num++) <i
                                            class="fas fa-star"></i>
                                    @endfor
                                </span>
                                <span class="ratting-li-like"><i class="fas fa-thumbs-up"></i></span>
                                <span class="user-rating">{{ $star }} / 10</span>
                            </div>

                            <div>
                                <span class="sh-lv  float-none  float-sm-right">
                                    <a href="javascript:;"><i
                                            class="far fa-heart global-fav-icon {{ Helper::checkFavorite(1, $resource->id) }}"
                                            status="1" fav-id="{{ $resource->id }}"></i></a>
                                    {{-- <a href=""><i class="fas fa-share-alt"></i></a> --}}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="s-tlt">{{ $resource->short_title }}</div>
                    <div class="address mt-2"><i class="fas fa-map-marker-alt"></i> {{ $resource->address }}</div>

                    <div class="gallery-slider">
                        <div class="swiper-container gallery-top gallery-top1">
                            <div class="swiper-wrapper">
                                @if ($resource->image)
                                    <div class="swiper-slide">
                                        <div class="slide-img">
                                            <img src="{{ asset('images/resource/medium/' . $resource->image) }}"
                                                class="cover" alt="img"
                                                onclick="openFancyboxItem('mainimage{{ $resource->id }}')">
                                        </div>
                                    </div>
                                @endif

                                @if (count($resource->recourceImage))
                                    @foreach ($resource->recourceImage as $image)
                                        <div class="swiper-slide">
                                            <div class="slide-img">
                                                <img src="{{ asset('images/resource/medium/' . $image->path) }}"
                                                    class="cover" alt="img"
                                                    onclick="openFancyboxItem('image{{ $image->id }}')">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif


                            </div>
                        </div>
                        <div class="swiper-container gallery-thumbs gallery-thumbs1">
                            <div class="swiper-wrapper">
                                @if ($resource->image)
                                    <div class="swiper-slide slide1">
                                        <div class="slide-img">
                                            <img src="{{ asset('images/resource/ex-small/' . $resource->image) }}"
                                                class="cover" alt="img">
                                        </div>
                                    </div>
                                @endif
                                @if (count($resource->recourceImage))
                                    @foreach ($resource->recourceImage as $image)
                                        <div class="swiper-slide">
                                            <div class="slide-img">
                                                <img src="{{ asset('images/resource/ex-small/' . $image->path) }}"
                                                    class="cover" alt="img">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            @if ($resource->image)
                                @if (count($resource->recourceImage) > 3)
                                    <div class="more-photos more-photos1"
                                        onclick="openFancyboxItem('mainimage{{ $resource->id }}')"
                                        style="cursor:pointer">
                                        <div class="m-img">+{{ count($resource->recourceImage) - 3 }} photos</div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="d-none">
                        @if ($resource->image)
                            <a href="{{ asset('images/resource/large/' . $resource->image) }}" data-fancybox="gallery"
                                data-fancy-id="mainimage{{ $resource->id }}">
                                mainimage{{ $resource->id }}
                            </a>
                        @endif
                        @if (count($resource->recourceImage))
                            @foreach ($resource->recourceImage as $image)
                                <a href="{{ asset('images/resource/large/' . $image->path) }}" data-fancybox="gallery"
                                    data-fancy-id="image{{ $image->id }}">
                                    image{{ $image->id }}
                                </a>
                            @endforeach
                        @endif
                    </div>
                    <div class="pop-faci">
                        <div class="pop-faci-tlt font-weight-bold">Description</div>
                        <div class="des-cnt">
                            <p>{{ $resource->description }}</p>
                        </div>
                    </div>

                    @if (count($resource->rooms) > 0)
                        @foreach ($resource->rooms as $room)
                            <div class="rooms-type-table">
                                <table class="table rooms-type-table-c table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="td-width-unc1">Room title</th>
                                            <th scope="col" class="td-width-cm">Sleeps</th>
                                            <th scope="col" class="td-width-cm">Price for</th>
                                            <th scope="col" class="td-width-unc2">Your choices</th>
                                            <th scope="col" class="td-width-cm"> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="td-width-unc1 td-width-unc211">
                                                <div class="room-tlt"><span>{{ $room->title }}</span></div>
                                                <div class="room-bed">{{ $room->total_bed }}
                                                    {{ $room->bedType->name }}<i class="fas fa-bed"></i></div>
                                                {{-- <div class="room-faci room-faci-1">
										<span><i class="fas fa-bed"></i> 28 m<sup>2</sup></span>
										<span><i class="fas fa-wifi"></i> Free-WiFi</span>
									</div>
									<div class="room-faci">
										<span><i class="fas fa-check"></i> Safe</span>
										<span><i class="fas fa-check"></i> Desk</span>
									</div> --}}
                                            </td>
                                            <td colspan="2" class="p-0">
                                                <table class="table price-tbl m-0 p-0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="in-td in-td1">
                                                                @for ($i = 1; $i <= $room->total_bed; $i++)
                                                                    <i class="fas fa-user"></i>
                                                                @endfor
                                                            </td>
                                                            <td class="in-td in-td2">€{{ $room->price }} <i
                                                                    class="fas fa-exclamation-circle"></i><br> includes
                                                                taxes and charges</td>
                                                        </tr>
                                                        {{-- <tr>
												<td class="in-td in-td1"><i class="fas fa-user"></i><i class="fas fa-user"></i></td>
												<td class="in-td in-td2">€180</td>
											</tr>
											<tr class="last-tr">
												<td class="in-td in-td1"><i class="fas fa-user"></i></td>
												<td class="in-td in-td2">€160</td>
											</tr> --}}
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td class="td-width-unc2">
                                                <div class="can-txt">
                                                    <span class="td-i-l"><i class="fas fa-check"></i></span> Free
                                                    Cansalation before 11:59 PM on July 25,2020 <span class="td-i-r"><i
                                                            class="fas fa-question-circle"></i></span>
                                                </div>
                                                <div class="can-txt">
                                                    <span class="td-i-l"><i class="fas fa-check"></i></span> Free
                                                    Cansalation before 11:59 PM on July 25,2020 <span class="td-i-r"><i
                                                            class="fas fa-question-circle"></i></span>
                                                </div>
                                            </td>
                                            <td class="td-width-cm p-2">
                                                {{-- <div><button class="btn ctm-btn td-btn" data-toggle="modal" data-target="#roomModal">More Details</button></div> --}}

                                                <div><button class="btn ctm-btn td-btn"
                                                        onclick="openRoom({{ $room->id }}, {{ $resource->id }})">More
                                                        Details</button></div>

                                                {{-- <div><button class="btn ctm-btn td-btn">Reservation</button></div> --}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    @endif


                    <div class="contact-info">
                        <div class="contact-tlt">Kontaktai</div>
                        {{-- <div class="con-txt1">Ezeras Vikoknise - 500</div> --}}
                        <div class="container">
                            <div class="con-info-all row">
                                <div class="col-12 col-lg-6">
                                    <div class="con-info"><span>Name: </span> {{ $resource->name }}</div>
                                    @if ($resource->short_title)
                                        <div class="con-info"><span>Sort Title: </span> {{ $resource->short_title }}
                                        </div>
                                    @endif
                                    @if ($resource->address)
                                        <div class="con-info"><span>Address: </span> {{ $resource->address }}</div>
                                    @endif
                                    @if ($resource->phone)
                                        <div class="con-info phone-prev"><span>Phone: </span>
                                            {{ Helper::phoneModify($resource->phone) }} <span
                                                class="pls-click-view-ph">Spustelkite, kad matytumėte numerį </span></div>
                                        <div class="con-info phone-next"><span>Phone: </span> {{ $resource->phone }}
                                        </div>
                                    @endif
                                    @if ($resource->city->name)
                                        <div class="con-info"><span>City: </span> {{ $resource->city->name }}</div>
                                    @endif
                                    @if ($resource->contact_person)
                                        <div class="con-info"><span>Contact: </span> {{ $resource->contact_person }}
                                        </div>
                                    @endif
                                    @if ($resource->note)
                                        <div class="con-info"><span>Note: </span> {{ $resource->note }}</div>
                                    @endif
                                    @if ($resource->location->name)
                                        <div class="con-info"><span>Location: </span> {{ $resource->location->name }}
                                        </div>
                                    @endif
                                    @if ($resource->nearest_locations)
                                        <div class="con-info"><span>Nearest Location:
                                            </span>{{ $resource->nearest_locations }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div id="user-map" style="height: 100%;padding-bottom: 100%;"></div>
                                </div>
                                <div class="map-resource">
                                    <input type="hidden" id="d-address" value="{{ $resource->address }}">
                                    <input type="hidden" id="rec-name" value="{{ $resource->name }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="contact-info">
                        <div class="contact-tlt">Nuomos Kainos</div>
                        <div class="con-info-all">
                            <div class="con-info"><span>Room: </span> Nuo {{ $resource->min_price }}Eu iki
                                {{ $resource->max_price }}Eu</div>
                            <div class="con-info"><span>Resources: </span> Nuo {{ $resource->total_min_price }}Eu iki
                                {{ $resource->total_max_price }}Eu</div>
                        </div>
                        @if ($resource->video)
                            <div class="contact-tlt">Videos</div>
                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <div class="embed-responsive embed-responsive-16by9" id="put-single-video">
                                        @if ($resource->video_status == 1)
                                            <video poster="{{ asset('videos/' . $resource->video_thumb) }}"
                                                src="{{ asset('videos/' . $resource->video) }}" controls
                                                allowfullscreen></video>
                                        @else
                                            <iframe class="embed-responsive-item" src="{{ $resource->video }}"
                                                allowfullscreen></iframe>
                                        @endif
                                    </div>
                                </div>
                                @if ($resource->videos)
                                    <div class="col-12 col-lg-12">
                                        <img src="{{ asset('videos/' . $resource->video_thumb) }}"
                                            class="img-fluid video-thumb-img" video-src="@if ($resource->video_status == 1) {{ asset('videos/' . $resource->video) }}@else{{ $resource->video }} @endif" video-status="{{ $resource->video_status }}">
                                        @foreach ($resource->videos as $video)
                                            <img src="{{ asset('videos/' . $video->video_thumb) }}"
                                                class="img-fluid video-thumb-img v-opcity" video-src="@if ($video->video_status == 1) {{ asset('videos/' . $video->video) }}@else{{ $video->video }} @endif" video-status="{{ $video->video_status }}">
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>

                    @if ($resource->distance_from_lake || $resource->distance_from_river || $resource->distance_from_sea)
                        <div class="room-side-info">
                            <div class="room-side-tlt">Distances</div>
                            @if ($resource->distance_from_lake)
                                <div class="row room-info-all m-0">
                                    <div class="col-12 col-md-12 pl-0">
                                        <div class="room-info">Distance Form Lake<span
                                                class="float-right">{{ $resource->distance_from_lake }} km</span>
                                        </div>
                                    </div>
                                    {{-- <div class="col-12 col-md-6 pl-0">
							<div class="room-info"><span class="side-type">Lake</span><span class="float-right">{{$resource->distance_from_lake}} km</span>
					</div>
				</div> --}}
                                </div>
                            @endif

                            @if ($resource->distance_from_river)
                                <div class="row room-info-all m-0">
                                    <div class="col-12 col-md-12 pl-0">
                                        <div class="room-info">Distance form River<span
                                                class="float-right">{{ $resource->distance_from_river }} km</span>
                                        </div>
                                    </div>
                                    {{-- <div class="col-12 col-md-6 pl-0">
							<div class="room-info"><span class="side-type">River</span><span class="float-right">{{$resource->distance_from_river}} km</span>
			</div>
		</div> --}}
                                </div>
                            @endif
                            @if ($resource->distance_from_sea)
                                <div class="row room-info-all m-0">
                                    <div class="col-12 col-md-12 pl-0">
                                        <div class="room-info">Distance form Sea<span
                                                class="float-right">{{ $resource->distance_from_sea }} km</span>
                                        </div>
                                    </div>
                                    {{-- <div class="col-12 col-md-6 pl-0">
							<div class="room-info"><span class="side-type">Sea</span><span class="float-right">{{$resource->distance_from_sea}} km</span>
	</div>
	</div> --}}
                                </div>
                            @endif
                        </div>
                    @endif

                    <div class="review_section">
                        {{-- <div class="comment-box">
						<h2 class="ad-tlt">Add Review</h2>
						<div class="add-review-all">
							<button data-toggle="modal" data-target="#reviewModal" class="btn add-review-btn">Add review</button>
						</div>
					</div> --}}
                        <div class="room-side-tlt">Reviews</div>
                        <div class="add-review-all">
                            <button data-toggle="modal" data-target="#reviewModal" class="btn add-review-btn">Add
                                review</button>
                        </div>
                        <div class="blog-card-all all-review-list">
                            @include('vendor.review.review')
                        </div>
                    </div>
                    {{-- <div class="room-side-info">
					<div class="room-side-tlt">Visi patogumai</div>
					<div class="row room-info-all m-0">

						<div class="col-12 col-md-6  col-md-4 pl-0">
							<div class="m-faci"><span class="tlt-txt d-flex">@include('vendor.inc.svg.bathroom-svg') Bathroom</div>
								<div class="room-info-all">
									<div class="room-info-s"><i class="fas fa-check"></i> Microwave</div>
									<div class="room-info-s"><i class="fas fa-check"></i> Microwave</div>
								</div>
							</div>

						</div>
					</div> --}}


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
    <div class="singleRoom">
        {{-- single room modal here come form ajax --}}
    </div>
    @include('vendor.review.add-review')
    @include('vendor.review.replay-review')

    {{-- @include('vendor.inc.modal.details-room-modal') --}}

@endsection
@section('script')

    <script src="{{ asset('vendor/js/js_r/rec-details.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyAnMJd489Qa_hRJXPon9VFHHFpGchq8Ib4">
    </script>
@endsection
