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
</style>
@endsection

@section('content')
<section class="information-section fag-section">
	<div class="row m-0">
		<div class="col-12 col-lg-12 pl-0">
			<div class="form-cnt">
				<div class="form-title">
					<h2>@lang('vendor.label.terms')</h2>
				</div>
				<div class="all-form faq-form">
					<div class="row">
						<div class="col-lg-12 col-12">
							<p>@lang('vendor.description.terms')</p>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>
@endsection
@section('script')
@endsection