@php
$viewed_status = 1;
if (@$items['ent_cat']) {
    $viewed_status = 2;
}
@endphp

@if (count($resources) > 0)
    @foreach ($resources as $resource)
        <div class="single-content">
            <div class="content-img">
                <a href="{{ route('vendors.all', ['p1' => $resource->slug]) }}"
                    onclick="viewedResource({{ $resource->id }},{{ $viewed_status }})">
                    <img src="{{ asset('images/resource/ex-small/' . $resource->image) }}" alt="img">
                </a>
            </div>
            <div class="single-content-txt">
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="{{ route('vendors.all', ['p1' => $resource->slug]) }}"
                            onclick="viewedResource({{ $resource->id }},{{ $viewed_status }})">
                            <div class="single-content-tlt hotel-name">"{{ $resource->name }}"</div>
                            <div class="shop-name">"{{ $resource->short_title }}</div>
                        </a>
                    </div>
                    <div class="hotel-price d-flex align-items-baseline justify-content-end">
                        Nuo<span>${{ $resource->min_price }}</span>
                    </div>
                </div>

                <div class="shop-add"> <i class="fas fa-map-marker-alt"></i> {{ $resource->address }}</div>
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
                    @php
                        $star = Helper::getRating($resource->comments);
                    @endphp
                    <div>
                        @if ($resource->phone)
                            <span class="contact-txt"><i class="fas fa-phone-volume"></i>
                                {{ Helper::phoneModify($resource->phone) }}</span>
                        @endif
                        <span class="star-like">
                            <span class="h-star">
                                @for ($num = 1; $num <= $star; $num++) <i
                                        class="fas fa-star"></i>
                                @endfor
                            </span>
                            <span class="h-like"><i class="fas fa-thumbs-up"></i></span>
                        </span>
                        <span class="user-rating">{{ $star }} / 10</span>
                    </div>
                    <a href="javascript:;"><i
                            class="far fa-heart global-fav-icon {{ Helper::checkFavorite($viewed_status, $resource->id) }}"
                            status="{{ $viewed_status }}" fav-id="{{ $resource->id }}"></i>
                    </a>
                    {{-- <i class="far fa-heart add-fav_color global-fav-icon"></i> --}}
                </div>
            </div>
        </div>
    @endforeach
    <div class="r-pagination text-center">
        {{ $resources->appends(request()->input())->links() }}
    </div>
@else
    <div class="alert alert-primary" role="alert">
        No Result Found :)
    </div>
@endif
<div class="page-des">
    {!! @$meta['page_des'] !!}
    @if (@$items['ent_type'])
        {!! @$items['ent_type']->seo_description !!}
    @else
        {!! @$items['ent_cat']->seo_description !!}
    @endif
</div>
