<div class="left-sidebar-menu text-center">
	<ul>
		<li>
			<a href="{{route('profile',['id'=>auth()->user()->id])}}" class="@if(\Request::route()->getName() == 'profile') active @endif"><img src="{{asset('vendor/img/menu-i.png')}}" alt="img"> @lang('vendor.label.dashboard')</a>
		</li>
		<li>
			<a href="{{route('user.setting')}}" class="@if(\Request::route()->getName() == 'user.setting') active @endif"><img src="{{asset('vendor/img/setting-icon.png')}}" alt="img"> @lang('vendor.label.setting')</a>
		</li>
		<li>
			<a href="{{route('payment.history.index')}}" class="@if(\Request::route()->getName() == 'payment.history.index') active @endif"><img src="{{asset('vendor/img/add-icon.png')}}" alt="img">@lang('vendor.label.payments')</a>
		</li>
		<li>
			<a href="{{route('user.password.change')}}" class="@if(\Request::route()->getName() == 'user.password.change') active @endif"><img src="{{asset('vendor/img/add-icon.png')}}" alt="img">@lang('vendor.label.changepassword')</a>
		</li>
		<li>
			@if(Session::has('superadmin'))
			<a href="{{route('admin.superadmin.logout')}}"><img src="{{asset('vendor/img/log-out-icon.png')}}" alt="img">@lang('vendor.label.logout')</a>
			@else
			<a href="{{url('logout')}}" onclick="event.preventDefault();document.getElementById('frm-logout').submit();"><img src="{{asset('vendor/img/log-out-icon.png')}}" alt="img"> @lang('vendor.label.logout')</a>
			<form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
				{{ csrf_field() }}
			</form>
			@endif

		</li>
	</ul>
</div>