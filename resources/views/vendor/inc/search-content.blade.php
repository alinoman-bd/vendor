@if (count($searches) > 0)
    @foreach ($searches as $search)
        @if (count($search->resources) > 0)
            @foreach ($search->resources as $resource)
                <div class="single-content">
                    <div class="content-img">
                        <a href="{{ route('vendors.all', ['p1' => $resource->slug]) }}"
                            onclick="viewedResource({{ $resource->id }}, 1)">
                            <img src="{{ asset('images/resource/ex-small/' . $resource->image) }}" alt="img">
                        </a>
                    </div>

                    <div class="single-content-txt">
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="{{ route('vendors.all', ['p1' => $resource->slug]) }}"
                                    onclick="viewedResource({{ $resource->id }}, 1)">

                                    <div class="single-content-tlt hotel-name">{{ $resource->name }}</div>
                                    <div class="shop-name">{{ $resource->short_title }}</div>
                                </a>
                            </div>
                            <div class="hotel-price ent-htl-price d-flex align-items-baseline justify-content-end">
                                Nuo<span>$35</span>
                            </div>
                        </div>
                        <div class="shop-add"><i class="fas fa-map-marker-alt"></i> {{ $resource->address }}</div>
                        @if ($resource->distance_from_lake || $resource->distance_from_river || $resource->distance_from_sea)
                            <div class="hotel-distance">
                                @if ($resource->distance_from_lake)
                                    <span class="d-km">Ezerus Gilugis - {{ $resource->distance_from_lake }}m</span> ,
                                @endif
                                @if ($resource->distance_from_river)
                                    <span class="d-m">Upe Neris - {{ $resource->distance_from_river }}m</span> ,
                                @endif
                                @if ($resource->distance_from_sea)
                                    <span class="d-m">Sea Neris - {{ $resource->distance_from_sea }}m</span> ,
                                @endif
                            </div>
                        @endif

                        <div class="hotel-contact d-flex align-items-center justify-content-between">
                            <div>
                                @if ($resource->phone)
                                    <span class="contact-txt"><i class="fas fa-phone-volume"></i>
                                        {{ Helper::phoneModify($resource->phone) }}</span>
                                @endif
                            </div>
                            <div>
                                <a href="javascript:;"><i
                                        class="far fa-heart global-fav-icon {{ Helper::checkFavorite(1, $resource->id) }}"
                                        status="1" fav-id="{{ $resource->id }}"></i>
                                </a>
                            </div>
                            {{-- <span class="star-like">
								<span class="h-star">
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
								</span>
								<span class="h-like"><i class="fas fa-thumbs-up"></i></span>
							</span> --}}
                        </div>

                    </div>
                </div>
            @endforeach
        @elseif(count($search->entertainments) > 0)
            @foreach ($search->entertainments as $resource)
                <div class="single-content">
                    <div class="content-img">
                        <a href="{{ route('vendors.all', ['p1' => $resource->slug]) }}"
                            onclick="viewedResource({{ $resource->id }}, 2)">
                            <img src="{{ asset('images/resource/ex-small/' . $resource->image) }}" alt="img">
                        </a>
                    </div>

                    <div class="single-content-txt">
                        <div class="hotel-price"> Nuo<span>$35</span></div>
                        <a href="{{ route('vendors.all', ['p1' => $resource->slug]) }}"
                            onclick="viewedResource({{ $resource->id }}, 1)">
                            <div class="single-content-tlt hotel-name"> "{{ $resource->name }}"</div>
                            <div class="shop-name">"{{ $resource->short_title }}</div>
                        </a>
                        <div class="shop-add"><i class="fas fa-map-marker-alt"></i> {{ $resource->address }}</div>
                        <div class="hotel-contact">
                            @if ($resource->phone)
                                <span class="contact-txt"><i class="fas fa-phone-volume"></i>
                                    {{ Helper::phoneModify($resource->phone) }}</span>
                            @endif
                            <a href="javascript:;"><i
                                    class="far fa-heart global-fav-icon {{ Helper::checkFavorite(2, $resource->id) }}"
                                    status="2" fav-id="{{ $resource->id }}"></i></a>
                            {{-- <span class="star-like">
								<span class="h-star">
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
								</span>
								<span class="h-like"><i class="fas fa-thumbs-up"></i></span>

							</span> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    @endforeach
    <div class="r-pagination text-center">
        {{ $searches->appends(request()->input())->links() }}
    </div>
@endif
