<div class="search-result-cnt fav-content mb-5">
    @if (count($resources) > 0)
        <input type="hidden" id="fav-page-number" value="{{ $page }}">
        @foreach ($resources as $key => $resource)
            <div class="single-content count-fav-single-content">
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
                                <div class="single-content-tlt hotel-name">"{{ $resource->name }}"</div>
                                <div class="shop-name">"{{ $resource->short_title }}</div>
                            </a>
                        </div>
                        <div class="hotel-price d-flex align-items-baseline justify-content-end">
                            Nuo<span>$35</span>
                        </div>
                    </div>

                    <div class="shop-add"> <i class="fas fa-map-marker-alt"></i> {{ $resource->address }}</div>
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

                    <div class="hotel-contact d-flex align-items-center justify-content-between">
                        <div>
                            @if ($resource->phone)
                                <span class="contact-txt"><i class="fas fa-phone-volume"></i>
                                    {{ Helper::phoneModify($resource->phone) }}</span>
                            @endif
                        </div>
                        <a href="javascript:;" onclick="removeFavrite({{ $resource->id }},1,{{ $key }})"><i
                                class="far fa-heart heart-fav"></i>
                        </a>
                    </div>


                </div>
            </div>
        @endforeach
        <div class="r-pagination text-center">
            {{ $resources->links() }}
        </div>
    @else
        <div class="alert alert-primary" role="alert">
            @lang('vendor.label.favourite.message')
        </div>
    @endif
</div>
