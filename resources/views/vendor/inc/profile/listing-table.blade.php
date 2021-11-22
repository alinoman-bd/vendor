<div class="listing-section">
	<div class="ds-boar-title">
		<div class="row">
			<div class="col-md-9">
				<h2>@lang('vendor.label.resources')</h2>
				<p>All the Lorem Ipsum generators on the All the Lorem Ipsum generators on the</p>
			</div>
			<div class="col-md-3">
				<a href="{{route('apartment.add')}}" class="btn btn-info">@lang('vendor.label.add') @lang('vendor.label.resources')</a>
			</div>
		</div>
	</div>
	<div class="db-list-com tz-db-table">
		@if(count($data['resources']) >0 )
		<table class="table">
			<thead>
				<tr>
					<th>Image</th>
					<th>Name</th>
					<th>Status</th>
					<th>Edit</th>
					<th>Delete</th>
					<th>Preview</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($data['resources'] as $resource)

				<tr>
					<td>
						<img src="{{asset('images/resource/ex-small/'.$resource->image)}}" alt="img" style="width: 40px; height=" 40px;">
					</td>
					<td>{{ $resource->name }}</td>
					<td>
						@if($resource->is_active == 1)
						<span class="db-list-status" onclick="changeStatus('0',{{$resource->id}})">Active</span>
						@else
						<span class="db-list-status-na" onclick="changeStatus('1',{{$resource->id}})">Inactive</span>
						@endif


					</td>
					<td>
						<a href="{{route('resource.edit', ['id' => $resource->id])}}" class="db-list-edit edit-i"><i class="fas fa-edit" title="Edit"></i></a>
						@if($resource->package_id == 1 || $resource->package_id == 2)
						@if( strtotime(date('Y-m-d H:i:s')) > strtotime($resource->end_date))
						<a href="{{route('payment.index',['rec_or_ent'=>'rec','id'=>$resource->id])}}" class="db-list-edit edit-i"><i class="far fa-money-bill-alt" title="Make VIP"></i></a>
						@endif
						@else
						<a href="{{route('payment.index',['rec_or_ent'=>'rec','id'=>$resource->id])}}" class="db-list-edit edit-i"><i class="far fa-money-bill-alt" title="Make VIP"></i></a>
						@endif

					</td>
					<td><a href="javascript:;" class="db-list-edit delete-i" onclick="deleteResource({{$resource->id}},{{$resource->user_id}})"><i class="fas fa-trash-alt" title="Delete"></i></a></td>
					<td>
						<a href="{{route('vendors.all',['p1'=>$resource->slug])}}" class="db-list-edit view-i" target="_blank"><i class="fa fa-eye" title="Preview"></i></a>

						<a href="{{route('setting.admin.room')}}?r={{$resource->id}}" class="db-list-edit view-i" target="_blank"><i class="fa fa-bed" title="Add Room"></i></a>

					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@else
		<div class="alert alert-primary" role="alert">
			No resources found!
		</div>
		@endif
	</div>
</div>