@if (count($vip1) > 0)
    <div class="cnt-l-tlt text-center"><span id="rec-head">-Resources-</span> </div>
    <div class="content-list">
        <div class="row -0">
            @foreach ($vip1 as $vip)
                <div class="col-12 col-lg-6">
                    <div class="single-content">
                        <div class="content-img">
                            <a href="{{ route('vendors.all', ['p1' => $vip->slug]) }}"
                                onclick="viewedResource({{ $vip->id }}, 1)"><img
                                    src="{{ asset('images/resource/ex-small/' . $vip->image) }}" alt="img"></a>
                        </div>
                        <div class="single-content-txt">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <a href="{{ route('vendors.all', ['p1' => $vip->slug]) }}"
                                        onclick="viewedResource({{ $vip->id }}, 1)">
                                        <div class="single-content-tlt">{{ $vip->name }}</div>
                                        <div class="shop-name">{{ $vip->short_title }}</div>
                                    </a>
                                </div>
                                <div class="hotel-price d-flex align-items-baseline justify-content-end">
                                    Nuo<span>${{ $vip->min_price }}</span>
                                </div>
                            </div>

                            <div class="shop-add"><i class="fas fa-map-marker-alt"></i> {{ $vip->address }}</div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div><i class="fas fa-phone-volume"></i> {{ Helper::phoneModify($vip->phone) }}</div>
                                <div>
                                    <a href="javascript:;">
                                        <i class="far fa-heart global-fav-icon {{ Helper::checkFavorite(1, $vip->id) }}"
                                            status="1" fav-id="{{ $vip->id }}"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
