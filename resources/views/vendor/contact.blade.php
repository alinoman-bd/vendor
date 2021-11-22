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
		background: #149e82;;
		color: #fff;
	}
</style>
@endsection

@section('content')
<section class="information-section fag-section">
	<!-- <div class="back-ul">
		<ul>
			<li><a href="#">Home</a> -</li>
			<li class="active">Post A Add</li>
		</ul>
	</div> -->
	<div class="row m-0">
		<div  class="col-12 col-lg-9 pl-0">
			<div class="form-cnt">
				<div class="form-title">
					<h2>@lang('vendor.label.contact')</h2>
				</div>
				<form action="{{route('contact.submit')}}" method="post" id="contact-vendor">
					@csrf
					<div class="all-form faq-form">
						<div class="row">
							@if(session()->has('message'))
								<div class="col-md-12">
								    <div class="alert alert-success">
								        {{ session()->get('message') }}
								    </div>
							    </div>
							@endif
							<div  class="col-12 col-lg-6">
								<div class="form-group">
									<input type="text" class="form-control" name="name" placeholder="@lang('vendor.label.name')" required>
								</div>
							</div>
							<div  class="col-12 col-lg-6">
								<div class="form-group">
									<input type="email" class="form-control" name="email" placeholder="@lang('vendor.label.email')" required>
								</div>
							</div>
							<div  class="col-12">
								<div class="form-group">
									<input type="text" class="form-control" name="subject" placeholder="@lang('vendor.label.subject')" required>
								</div>
							</div>
							<div  class="col-12">
								<div class="form-group">
									<textarea class="form-control" name="message" placeholder="@lang('vendor.label.message')" required></textarea>
								</div>
							</div>
							<div  class="col-12 ">
								<div class="form-group pt-3">
									<button type="submit" class="btn ctm-btn inf-brn">@lang('vendor.button.submitnow') !</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>

		<div  class="col-12 col-lg-3 pr-0">
			<div class="con-m-info">
				<div class="con-tlt">@lang('vendor.label.contact')</div> 
				<div class="con-tlt1">
					buvo įprastas pramonės fiktyvus tekstas
				</div> 
				<div class="con-txt">
					<i class="fas fa-phone"></i>+5114400379191
				</div> 
				<div class="con-txt">
					<i class="fa fa-envelope"></i>benny.kuhlman@example.com
				</div> 
				<div class="con-txt">
					<i class="fas fa-map-marker-alt"></i>Stiklių gatvė, Vilnius, Lietuva
				</div>
			</div>
			<div class="con-m-info">
				<div class="con-tlt">@lang('vendor.label.follow')</div> 
				<div class="social-ul">
					<ul>
						<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
						<li><a href="#"><i class="fab fa-twitter"></i></a></li>
						<li><a href="#"><i class="fab fa-instagram"></i></a></li>
						<li><a href="#"><i class="fab fa-youtube"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
@section('script')
<script type="text/javascript">
	$(document).on('submit','#contact-vendor',function(){
		$('#loader').addClass('loading');
	})
</script>
@endsection