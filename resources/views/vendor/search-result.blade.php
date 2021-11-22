@extends('vendor.layouts.app')
@section('meta')
@php
if(@$items['ent_cat']){
$meta = Helper::entSeoMeta(@$items);

}else{
$meta = Helper::seoMeta(@$items);
}
@endphp
<title>{{@$meta['title']}} </title>
<meta name="description" content="{{@$meta['description']}}">
<meta name="keywords" content="{{@$meta['keyword']}}">
@endsection

@section('style')
<style type="text/css">
	.pagination {
		display: inline-flex;
	}

	#tp-title {
		margin-bottom: 22px;
	}

	.search-select {
		margin-bottom: 25px;
	}

	.search-select .search-input {
		padding: 10px;
		border-bottom: 1px dashed #000;
	}

	.search-select .search-input .form-control {
		border: 0;
		height: 40px;
	}

	.ctm-select .ctm-option-box {
		max-height: 273px;
	}

	.mg-btm {
		margin-top: 10px;
	}
</style>
@endsection

@section('content')
<section class="search-section">
	<div class="row m-0">
		<div class="col-12 col-md-3 p-0">
			@include('vendor.inc.filter-form')
		</div>
		<div class="col-12 col-md-9 p-0">
			<div class="search-result-cnt">
				<h4 id="tp-title">{{@$meta['tag1']}} </h4>
				@if($banner_top)
				<div class="single-content">
					<img src="{{asset('images/banner/'.$banner_top->image)}}" alt="img" class="img-fluid">
				</div>
				@endif
				@if(@$items['ent_cat'])
				@include('vendor.inc.ent-locations')
				@endif
				@include('vendor.inc.search-result.search-result-content')

				@if($banner_bottom)
				<div class="single-content mg-btm">
					<img src="{{asset('images/banner/'.$banner_bottom->image)}}" alt="img" class="img-fluid">
				</div>
				@endif

			</div>
		</div>
	</div>
	<div class="relative-content mt-5">
		@include('vendor.inc.relative-content')
	</div>
</section>
@endsection
@section('script')
@endsection