<div class="dashboard-section">
	<div class="row m-0">
		<div class="col-12 col-md-6 p-0">
			<div class="tz-2-main-2">
				<img src="{{asset('vendor/img/d1.png')}}" alt="img">
				<h1>@lang('vendor.label.resources')</h1>
				<p>@lang('vendor.label.totalno') @lang('vendor.label.resources')</p>
				<h2>{{@$data['total_rec']}}</h2>
			</div>
		</div>
		<div class="col-12 col-md-6 p-0">
			<div class="tz-2-main-2">
				<img src="{{asset('vendor/img/d2.png')}}" alt="img">
				<h1>@lang('vendor.label.entertainments')</h1>
				<p>@lang('vendor.label.totalno') @lang('vendor.label.entertainments')</p>
				<h2>{{$data['total_ent']}}</h2>
			</div>
		</div>
		{{-- <div class="col-12 col-md-4 p-0">
			<div class="tz-2-main-2">
				<img src="{{asset('vendor/img/d1.png')}}" alt="img">
		<h1>Messages</h1>
		<p>Total no of messages</p>
		<h2>53</h2>
	</div>
</div> --}}
</div>
</div>