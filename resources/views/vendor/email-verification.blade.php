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
</style>
@endsection
@section('content')
<section class="information-section fag-section">
	<div class="row m-0">
		<div class="col-12 col-lg-12 pl-0">
			<div class="form-cnt">
				<div class="form-title">
					<h2>@lang('vendor.label.verifyyour') @lang('vendor.label.email')</h2>
				</div>
				<div class="all-form faq-form">
					<form method="post" action="{{route('register.verified')}}" id="matchVCode">
						@csrf
						<div class="row">
							<div class="col-lg-6 col-6">
								<p>{{@$msg}}</p>
								<a href="javascript:;" class="resend" onclick="resendVCode('{{@$email}}')">@lang('vendor.label.resend')</a>
							</div>
							<div class="col-lg-4 col-4">
								<div class="form-group">
									<label class="">@lang('vendor.label.enter.v.code')</label>
									<input type="text" class="form-control" name="v_code" autofocus required>
									<input type="hidden" name="email" value="{{@$email}}" class="ex-user-email">
									</br>
									<button type="submit" class="btn btn-primary">@lang('vendor.button.submit')</button>
								</div>
							</div>
							<div class="col-lg-4 col-4"></div>
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