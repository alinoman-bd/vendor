@extends('vendor.layouts.app')
@section('meta')
	<title>{{ $resource->name }}</title>
	<meta name="description" content="{{ $resource->name }}">
  	<meta name="keywords" content="{{ $resource->name }}">
@endsection

@section('style')
@endsection
<style type="text/css">
	.mulImg{
		margin-bottom: 10px;
	}
	.removeImg {
		text-align: center;
		position: absolute;
		top: -13px;
		right: 2px;
	}
	.removeImg i{
		/*background: #736dd4;*/
		padding: 8px;
		background: #EB3941;
		border-radius: 50%;
		cursor: pointer;
		color: white;
	}
	.modal-header .close {
		position: static !important;
	}
	#app-submit-btn{
		display: none;
	}
</style>
@section('content')
<section class="information-section">
	<div class="back-ul">
		{{-- <ul>
			<li><a href="#">Home</a> -</li>
			<li class="active">Post A Add</li>
		</ul> --}}
	</div>
	<div class="row m-0">
		<div  class="col-12 col-lg-9 pl-0 pr-0 pr-lg-3">
			<div class="form-cnt">
				<div class="form-title">
					<h2>Edit Resource</h2>
				</div>
				<div class="all-form">
					<form action="{{Route('resource.update',['id'=>@$resource->id])}}" method="post" enctype="multipart/form-data" id="apartment-form">
						@csrf
						<input type="hidden" class="main_rec_id" value="{{ @$resource->id }}">
						<input type="hidden" class="main_rec_city_id" value="{{ @$resource->city->id }}">
						<input type="hidden" class="main_rec_location_id" value="{{ @$resource->location->id }}">

						<input type="hidden" class="main_rec_location_name" value="{{ @$resource->location->name }}">
						<input type="hidden" class="main_rec_lake_name" value="{{ @$resource->lake->name }}">
						<input type="hidden" class="main_rec_river_name" value="{{ @$resource->river->name }}">

						<input type="hidden" class="main_rec_lake_id" value="{{ @$resource->lake_id }}">
						<input type="hidden" class="main_rec_river_id" value="{{ @$resource->river_id }}">

						@include('vendor.inc.form.apartment-form.apartment')
						<div class="form-group mt-3 text-right">
							<button type="submit" class="btn ctm-btn inf-brn">@lang('vendor.button.save.next')</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div  class="col-12 col-lg-3 pr-0 pl-0 pl-lg-3">
			@include('vendor.inc.vip-resources.sidebar-rec-vip1')
		</div>
	</div> 
</section>
@endsection
@section('script')
<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="{{asset('vendor/js/js_r/apartment.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyAnMJd489Qa_hRJXPon9VFHHFpGchq8Ib4"></script>
@endsection