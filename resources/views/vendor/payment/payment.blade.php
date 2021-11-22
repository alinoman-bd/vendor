@extends('vendor.layouts.app')
@section('style')
<style>
	.faq-form .form-control {
		padding: 10px 15px;
		border-radius: 0;
	}

	.con-m-info {
		margin-bottom: 10px;
	}

	.con-tlt1 {
		margin-bottom: 10px;
	}

	.con-tlt {
		font-size: 20px;
		margin-bottom: 8px;
	}

	.con-txt {
		font-size: 14px;
		margin-bottom: 5px;
	}

	.con-txt i {
		margin-right: 5px;
		color: #149e82;
	}

	.social-ul li {
		display: inline-block;
	}

	.social-ul li a {
		display: inline-block;
		background: #fff;
		height: 30px;
		width: 30px;
		border-radius: 50%;
		line-height: 30px;
		text-align: center;
		color: #149e82;
		transition: ease .2s;
	}

	.social-ul li a:hover {
		background: #149e82;
		;
		color: #fff;
	}

	.resend {
		text-decoration: underline;
		color: #ec6262;
	}

	.alert-success {
		margin-bottom: 40px;
	}
</style>
@endsection

@section('content')
<section class="information-section fag-section">
	<div class="row m-0">
		<div class="col-12 col-lg-12 pl-0">
			<div class="form-cnt">
				<div class="form-title">
					<h2>@lang(vendor.label.payments)</h2>
				</div>
				<div class="all-form faq-form">
					<form action="{{route('payment.go')}}" method="post" id="payment-form">
						@csrf
						<input type="hidden" name="id" value="{{@$id}}">
						<input type="hidden" name="rec_or_ent" value="{{@$rec_or_ent}}">
						<div class="row">
							@if($done)
							<div class="col-lg-12 col-12">
								<div class="alert alert-success" role="alert">
									<h4 class="alert-heading">Well done!</h4>
									<p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
									<hr>
									<p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
								</div>
							</div>
							@endif
							<div class="col-lg-3 col-3">
								<div class="card mb-3">
									<img class="card-img-top" src="{{asset('images/resource/small/'.$item->image)}}" alt="Card image cap">
									<div class="card-body">
										<h5 class="card-title">{{$item->name}}</h5>
										<p class="card-text">{{$item->short_title}}</p>
										<div class="shop-add"><i class="fas fa-map-marker-alt"></i> {{$item->address}}</div>
										<div class=""><i class="fas fa-phone-volume"></i> {{Helper::phoneModify($item->phone)}}</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-4">
								<div class="form-group">
									<label for="exampleFormControlSelect1">Choose package</label>
									<select class="form-control" id="exampleFormControlSelect1" onchange="getPackageDetails(this.value)" name="pkg_id">
										@if(count($pkgs) > 0)
										@foreach($pkgs as $pkg)
										@if($pkg->name != 'Free')
										<option value="{{$pkg->id}}">{{$pkg->name}}</option>
										@endif
										@endforeach
										@endif
									</select>
								</div>
								<div class="payment-add-info">
									@include('vendor.payment.amount-duration')
								</div>
							</div>
							<div class="col-lg-4 col-4">
								<div class="payment-explanation">
									@include('vendor.payment.description')
								</div>
							</div>
							<div class="col-lg-12 col-12 text-right">
								<a href="{{route('profile',['id'=>auth()->user()->id])}}" class="btn btn-info">Skip</a>
								<button class="btn btn-primary" type="submit" onclick="loader()">Pay Now</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
@section('script')
@endsection