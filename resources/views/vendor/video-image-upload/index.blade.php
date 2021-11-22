@extends('vendor.layouts.app')
@section('meta')
<title>Upload Video and Image</title>
<meta name="description" content="Upload Video and Image">
<meta name="keywords" content="Upload Video and Image">
@endsection

@section('style')
@endsection
<style type="text/css">
	.mulImg {
		margin-bottom: 10px;
	}

	.removeImg {
		text-align: center;
		position: absolute;
		top: -13px;
		right: 2px;
	}

	.removeImg i {
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

	#app-submit-btn {
		display: none;
	}

	.to-link,
	.to-video,
	.to-link1,
	.to-video1 {
		text-decoration: underline;
		font-weight: bold;
		cursor: pointer;
	}

	.embed-video-section,
	.embed-video-section1 {
		display: none;
	}

	.btn-mg {
		margin-top: 27px;
	}

	.mdl-dle {
		cursor: pointer;
	}
</style>
@section('content')
<section class="information-section">
	<div class="row m-0">
		<div class="col-12 col-lg-9 pl-0 pr-0 pr-lg-3">
			@if($rec_ent == 'rec')
			@include('vendor.video-image-upload.rec-image-upload')
			@else
			@include('vendor.video-image-upload.ent-image-upload')
			@endif
			@include('vendor.video-image-upload.main-video-upload')
			@include('vendor.video-image-upload.multi-video-upload')

			<div class="form-group mt-3 text-right">
				<a href="{{route('payment.index',['rec_or_ent'=>$rec_ent,'id'=>$resource->id])}}" class="btn ctm-btn inf-brn">Next</a>
			</div>

		</div>

		<div class="col-12 col-lg-3 pr-0 pl-0 pl-lg-3">
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