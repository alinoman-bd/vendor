<div class="notification mt-3 mt-lg-0">
	<h4 class="head-tlt">@lang('vendor.label.notifications')</h4>
	<ul>
		@for($i=1;$i < 5;$i++)
		{{-- <li>
			<a href="#"> 
				<img src="{{asset('vendor/img/db-profile.jpg')}}" alt="img">
				<h5>Joseph, write a review</h5>
				<p>All the Lorem Ipsum generators on the</p>
			</a>
		</li> --}}
		@endfor
	</ul>
</div>