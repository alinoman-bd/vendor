@extends('vendor.layouts.app')
@section('meta')
<title>{{auth()->user()->name}}</title>
<meta name="description" content="{{auth()->user()->name}}">
<meta name="keywords" content="{{auth()->user()->name}}">
@endsection
@section('style')
<style type="text/css">
	label,
	button {
		float: left;
	}
</style>
@endsection

@section('content')
<section class="profile-section">
	<div class="row m-0">
		<div class="col-12 col-md-4 col-lg-3 pl-0 pr-0 pr-md-3">
			@include('vendor.inc.sidebar.left-sidebar')
		</div>
		<div class="col-12 col-md-8  col-lg-6 p-0">
			<div class="profile-content">
				<h4 class="head-tlt">Setting</h4>
				@include('vendor.inc.profile.setting')
			</div>
		</div>
		<div class="col-12 col-lg-3 pr-0 pl-0 pl-md-3">
			@include('vendor.inc.sidebar.notification')
		</div>
	</div>
</section>
@endsection
@section('script')
<script src="{{asset('vendor/js/js_r/profile.js')}}"></script>
@endsection