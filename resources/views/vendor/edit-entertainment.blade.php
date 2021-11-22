@extends('vendor.layouts.app')
@section('meta')
	<title>{{ $resource->name }}</title>
	<meta name="description" content="{{ $resource->name }}">
  	<meta name="keywords" content="{{ $resource->name }}">
@endsection

@section('style')
	<style type="text/css">
		.modal-header .close {
		    position: static !important;
		}
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
		#ent-submit-btn{
			display: none;
		}
	</style>
@endsection 
 
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
					<h2>@lang('vendor.label.entertainments')</h2>
				</div>
				<input type="hidden" class="main_rec_city_id" value="{{@$resource->city_id}}">
				<input type="hidden" class="main_rec_location_id" value="{{@$resource->location_id}}">
				<input type="hidden" class="main_rec_location_name" value="{{@$resource->location->name}}">
				<div class="all-form">
					<form action="{{Route('ent.update',['id'=>@$resource->id])}}" method="post" enctype="multipart/form-data" id="ent-form">
						@csrf
						@include('vendor.inc.form.entertainment-form.entertainment')
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
<script src="{{asset('vendor/js/js_r/entertainment.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyAnMJd489Qa_hRJXPon9VFHHFpGchq8Ib4"></script>
@endsection