@extends('vendor.layouts.app')
@section('meta')
	<title>Favorites</title>
	<meta name="description" content="favorites">
  	<meta name="keywords" content="favorites">
@endsection
@section('style')
	<style type="text/css">
		.heart-fav{
			color:red;
			float: right;
		}
		.pagination{
			display: inline-flex;
		}
		.ent-btn{
			float: right;
		    padding: 10px;
		    background: lightseagreen;
		    margin-top: 10px;
		    color:white;
		}
	</style>
@endsection

@section('content')
<section class="search-section">
	<div class="row m-0">
		<div class="col-md-12">
			<a href="{{route('ent.favorites')}}" class="ent-btn">Entertainment favorites</a>
		</div>
		<div  class="col-12 col-md-12 p-0">
			@include('vendor.inc.favorite-content')
		</div>
	</div>
	<div class="relative-content">
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