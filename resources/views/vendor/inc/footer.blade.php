<section class="footer-section">
	<div class="footer-top">
		<div class="row m-0">
			<div class=" col-md-6 col-lg-5">
				<img src="{{asset('images/logo/logo.png')}}" alt="logo" class="img-fluid" width="114px">
				<br/>
				<br/>
				<p>@lang('vendor.description.about')</p>
			</div>
			<div class=" col-md-6 col-lg-4">
				<h5 class="mb-4 pb-4 footer-tlt">@lang('vendor.label.about')</h5>
				<ul class="p-0">
					<li class="pb-2">
						<a class=" pb-2" href="{{route('about-us')}}">@lang('vendor.label.about')</a>
					</li>
					<li class="pb-2">
						<a class="" href="{{route('contact')}}">@lang('vendor.label.contact')</a>
					</li>
					<li class="pb-2">
						<a class="" href="{{route('terms-condition')}}">@lang('vendor.label.terms')</a>
					</li>
					<li class="pb-2">
						<a class="" href="{{route('privacy-policy')}}">@lang('vendor.label.privacy')</a>
					</li>
					<li class="pb-2">
						<a class="" href="">@lang('vendor.label.sitemap')</a>
					</li>
				</ul>
			</div>
			<div class="col-md-6 col-lg-3">
				<h5 class="mb-4 pb-4 footer-tlt">@lang('vendor.label.follow')</h5>
				<div class="footer-mbl-img">
					<a target="_blank" href="#"><img class="mb-2" src="{{asset('vendor/img/google-play.png')}}" alt="img"></a>
					<a target="_blank" href="#"><img class="mb-2" src="{{asset('vendor/img/ios.png')}}" alt="img"></a>
				</div>
				<div class="social-menu pt-3">
					<a class="social-l fac" target="_blank" href="#"><i class="fab fa-facebook-f"></i></a>
					<a class="social-l tw" target="_blank" href="#"><i class="fab fa-twitter"></i></a>
					<a class="social-l you" target="_blank" href="#"><i class="fab fa-youtube"></i></a>
					<a class="social-l pin" target="_blank" href="#"><i class="fab fa-pinterest"></i></a>
					<a class="social-l in" target="_blank" href="#">in</a>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-bottom text-center">
		<span class="copy-txt-all"><span class="copy-txt">Copyright @ classipost</span><span class="copy-date">2020</span></span>
	</div>
</section>