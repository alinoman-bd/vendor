<section class="header-section d-block d-lg-none">
	<div class="top-menu d-block">
		<div class="top-search mb-0">
			<div class="logo-img"><a href="{{route('vendors.all')}}"><img src="{{asset('images/logo/logo.png')}}" alt="img"></a></div>
			<span class="show-menu-btn show-menu-bar"><i class="fas fa-bars"></i></span>
		</div>
</section>
<section class="header-section show-mbl-sh">
	<div class="top-menu d-block d-lg-flex">
		<div class="top-search">
			<div class="logo-img d-none d-lg-inline-block"><a href="{{route('vendors.all')}}"><img src="{{asset('images/logo/logo.png')}}" alt="img"></a></div>
			@if(Auth::check())
			@if(Auth::user()->is_admin == 1)
			<div class="top-select">
				<div class="ctm-select" ctm-slt-n="cat_name">
					<div class="ctm-select-txt pad-l-10">
						<span class="select-txt" id="category">@lang('vendor.label.resources')</span>
						<span class="select-arr"><i class="fa fa-chevron-down"></i></span>
					</div>
					<div class="ctm-option-box">
						<div class="ctm-option"><a href="{{route('apartment.show')}}">@lang('vendor.label.add') @lang('vendor.label.resources')</a></div>
						<div class="ctm-option"><a href="{{route('ent.add_form')}}">@lang('vendor.label.add') @lang('vendor.label.entertainments')</a></div>
					</div>
				</div>
			</div>
			@endif
			@endif
			<form method="get" action="{{route('search')}}" id="mainSearchForm" style="width: 100%; display: flex;">
				<div class="input-group search-input">
					<div class="input-group-prepend">
						<span class="input-group-text pr-0"><i class="fa fa-search"></i></span>
					</div>
					<input type="text" name="q" class="form-control" id="mainSearchName" placeholder="@lang('vendor.placeholder.search')" value="{{@$main_search}}" autocomplete="off">
					<div class="input-search-box put-main-suggestion">

					</div>
				</div>
				<div class="search-btn">
					<button type="submit" class="btn ctm-btn "><i class="fa fa-search"></i></button>
				</div>
		</div>
		</form>

		<div class="top-ul">
			<span class="top-li wo-btn-li"><a href="{{route('favorite')}}"><img src="{{asset('images/favorite.png')}}" width="22px">@lang('vendor.label.favourite')</a></span>
			@if(!Auth::check())
			<span class="top-li"><a href="#"><button class="btn ctm-btn black-btn" data-toggle="modal" data-target="#logModal"><i class="fas fa-sign-in-alt"></i>@lang('vendor.button.signin')</button> </a></span>
			@else
			@if(Auth::user()->is_admin == 2)
			<span class="top-li"><a href="#"><button class="btn ctm-btn black-btn" data-toggle="modal" data-target="#logModal"><i class="fas fa-sign-in-alt"></i>@lang('vendor.button.signin')</button> </a></span>
			@endif
			@endif

			@if(Auth::check())
			@if(Auth::user()->is_admin == 1)
			<span class="top-li"><a href="{{route('profile', ['id' => Auth::user()->id])}}"><button class="btn ctm-btn black-btn"> @lang('vendor.label.profile')</button> </a></span>
			@endif
			@endif

			@if(Auth::check())
			@if(Auth::user()->is_admin == 1)
			<span class="top-li"><a href="{{route('apartment.show')}}"><button class="btn ctm-btn black-btn"><i class="fa fa-plus"></i> @lang('vendor.label.addlisting')</button></a></span>
			@endif
			@endif
		</div>
	</div>

	@include('vendor.inc.menu.menu')
</section>