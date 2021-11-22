@extends('vendor.layouts.app')
@section('meta')
<title>{{@$main_search}}</title>
<meta name="description" content="{{@$main_search}}">
<meta name="keywords" content="{{@$main_search}}">
@endsection
@section('style')
<style type="text/css">
	.heart-fav {
		color: red;
	}

	.pagination {
		display: inline-flex;
	}
</style>
@endsection
@section('content')
<section class="search-section">
	<div class="row m-0">
		<div class="col-12 col-md-12 p-0">
			<div class="search-result-cnt fav-content">
				@include('vendor.inc.search-content')
			</div>
		</div>
	</div>
	<div class="relative-content mt-5">
		<div class="content-list">
			<div class="row -0">
				@include('vendor.inc.vip-resources.fav-page-rec-vip1')
			</div>
		</div>
	</div>
</section>
@endsection
@section('script')
@endsection