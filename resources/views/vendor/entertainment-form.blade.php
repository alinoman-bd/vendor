@extends('vendor.layouts.app')
@section('meta')
	<title>Add Entertainment</title>
	<meta name="description" content="Add entertainment">
  	<meta name="keywords" content="Add entertainment">
@endsection

@section('style')
	<style type="text/css">
		.modal-header .close {
		    position: static !important;
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
					<h2>@lang('vendor.label.add') @lang('vendor.label.entertainment')</h2>
				</div>
				<div class="all-form">
					<form action="{{Route('ent.save')}}" method="post" enctype="multipart/form-data" id="ent-form">
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