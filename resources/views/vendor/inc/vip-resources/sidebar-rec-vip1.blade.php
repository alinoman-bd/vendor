@if (count($vip1) > 0)
    @foreach ($vip1 as $vip)
        <div class="card mb-3">
            <a href="{{ route('vendors.all', ['p1' => $vip->slug]) }}"
                onclick="viewedResource({{ $vip->id }}, 1)">
                <img class="card-img-top" src="{{ asset('images/resource/small/' . $vip->image) }}"
                    alt="Card image cap">
            </a>
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title"><a href="{{ route('vendors.all', ['p1' => $vip->slug]) }}"
                                onclick="viewedResource({{ $vip->id }}, 1)">{{ $vip->name }}</a></h5>
                    </div>
                    <div class="hotel-price ent-htl-price d-flex align-items-baseline justify-content-end">
                        Nuo<span>${{ $vip->min_price }}</span>
                    </div>
                </div>
                <p class="card-text"><a href="{{ route('vendors.all', ['p1' => $vip->slug]) }}"
                        onclick="viewedResource({{ $vip->id }}, 1)">{{ $vip->short_title }}</a>
                </p>
                <div class="shop-add">
                    <i class="fas fa-map-marker-alt"></i> {{ $vip->address }}
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-phone-volume"></i> {{ Helper::phoneModify($vip->phone) }}
                    </div>
                    <div>
                        <a href="javascript:;">
                            <i class="far fa-heart global-fav-icon {{ Helper::checkFavorite(1, $vip->id) }}"
                                status="1" fav-id="{{ $vip->id }}">
                            </i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    @endforeach
@endif
