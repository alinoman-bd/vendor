@extends('vendor.layouts.app')
@section('meta')
	<title>Add Resource</title>
	<meta name="description" content="Add Resource">
  	<meta name="keywords" content="Add Resource">
@endsection

@section('style')
	<style type="text/css">
		.modal-header .close {
		    position: static !important;
		}
		.only-sea-section{
			display: none;
		}
		.city-location-section{
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
					<h2>@lang('vendor.label.add') @lang('vendor.label.resources')</h2>
				</div>
				<div class="all-form">
					<form action="{{route('apartment.add')}}" method="post" enctype="multipart/form-data" id="apartment-form">
						@csrf
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
<script src="{{asset('vendor/js/js_r/apartment.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyAnMJd489Qa_hRJXPon9VFHHFpGchq8Ib4"></script>
@endsection