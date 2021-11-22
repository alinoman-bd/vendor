<div class="listing-section">
	<div class="ds-boar-title">
		<div class="row">
			<div class="col-md-12">
				<h2>@lang('vendor.label.entertainments') @lang('vendor.label.payments')</h2>
				<p>All the Lorem Ipsum generators on the All the Lorem Ipsum generators on the</p>
			</div>
		</div>
	</div>
	<div class="db-list-com tz-db-table">
		@if(count($data['ent_payments']) >0 )
		<table class="table">
			<thead>
				<tr>
					<th>Image</th>
					<th>Name</th>
					<th>Package</th>
					<th>Duration</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th>Day Left</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($data['ent_payments'] as $rec)
				<tr>
					<td>
						<img src="{{asset('images/resource/ex-small/'.$rec->entertainment->image)}}" alt="img" style="width: 40px; height=" 40px;">
					</td>
					<td>{{ $rec->entertainment->name }}</td>
					<td>{{$rec->package_name}}</td>
					<td>{{$rec->duration}}</td>
					<td>{{date('Y-m-d',strtotime($rec->start_date))}}</td>
					<td>{{date('Y-m-d',strtotime($rec->end_date))}}</td>
					<td>{{Helper::dayLeft(date('Y-m-d H:i:s'), $rec->end_date)}} days</td>
					<td>
						<a href="{{route('payment.pdf.download',['rec_or_ent'=>'ent','id'=>$rec->id])}}"><i class="fas fa-download" title="downlaod"></i></a>
						{{-- <a href="{{route('payment.index',['rec_or_ent'=>'ent','id'=>$rec->id])}}"> | <i class="fas fa-edit" title="Upgrade Payment"></i></a> --}}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@else
		<div class="alert alert-primary" role="alert">
			@lang('vendor.label.nodata.message')
		</div>
		@endif
	</div>
</div>