@extends('vendor.layouts.app')
@section('meta')
<title>Home</title>
<meta name="description" content="home">
<meta name="keywords" content="home">
@endsection

@section('style')
<style type="text/css">
	#rec-head {
		margin-top: 12px;
	}
</style>
@endsection

@section('content')
<section class="content-list-section">
	{{-- vip1 resource --}}
	@if($banner_top)
	<div class="content-list">
		<div class="row -0">
			<div class="col-12 col-lg-12">
				<div class="single-content">
					<a href="{{$banner_top->link}}" target="_blank"><img src="{{asset('images/banner/'.$banner_top->image)}}" class="img-fluid"></a>
				</div>
			</div>
		</div>
	</div>
	@endif

	@include('vendor.inc.vip-resources.rec-vip1')

	{{-- vip1 Entertainment --}}
	@include('vendor.inc.vip-resources.ent-vip1')

	{{-- vip2 resource --}}
	@include('vendor.inc.vip-resources.rec-vip2')

	{{-- vip2 Entertainment --}}
	@include('vendor.inc.vip-resources.ent-vip2')

	@if($banner_bottom)
	<div class="content-list">
		<div class="row -0">
			<div class="col-12 col-lg-12">
				<div class="single-content">
					<a href="{{$banner_bottom->link}}" target="_blank"><img src="{{asset('images/banner/'.$banner_bottom->image)}}" class="img-fluid"></a>
				</div>
			</div>
		</div>
	</div>
	@endif

</section>
@endsection

@section('script')
@endsection