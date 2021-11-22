<div class="listing-section">
	<div class="ds-boar-title">
		<div class="row">
			<div class="col-md-8">
				<h2>@lang('vendor.label.entertainments')</h2>
				<p>All the Lorem Ipsum generators on the All the Lorem Ipsum generators on the</p>
			</div>
			<div class="col-md-4">
				<a href="{{route('ent.add_form')}}" class="btn btn-info">@lang('vendor.label.add') @lang('vendor.label.entertainments')  </a>
			</div>
		</div>
		
	</div>
	<div class="db-list-com tz-db-table">
		@if(count($data['entertainments']) >0 )
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
					@foreach ($data['entertainments'] as $ent)
						
						<tr>
							<td>
								<img src="{{asset('images/resource/ex-small/'.$ent->image)}}" alt="img" style="width: 40px; height="40px;">
							</td>
							<td>{{ $ent->name }}</td>
							<td>
								@if($ent->is_active == 1)
									<span class="db-list-status" onclick="changeStatusEnt('0',{{$ent->id}})">Active</span>
								@else 
									<span class="db-list-status-na" onclick="changeStatusEnt('1',{{$ent->id}})">Inactive</span>
								@endif	
								
								
							</td>
							<td>
								<a href="{{route('ent.edit', ['id' => $ent->id])}}" class="db-list-edit edit-i"><i class="fas fa-edit"></i></a>
								@if($ent->package_id == 1 || $ent->package_id == 2)
									@if( strtotime(date('Y-m-d H:i:s')) > strtotime($ent->end_date))
										<a href="{{route('payment.index',['rec_or_ent'=>'ent','id'=>$ent->id])}}" class="db-list-edit edit-i"><i class="far fa-money-bill-alt" title="Make VIP"></i></a>
									@endif
								@else
									<a href="{{route('payment.index',['rec_or_ent'=>'ent','id'=>$ent->id])}}" class="db-list-edit edit-i"><i class="far fa-money-bill-alt" title="Make VIP"></i></a>
								@endif	
							</td>
							<td><a href="javascript:;" class="db-list-edit delete-i" onclick="deleteEnt({{$ent->id}},{{$ent->user_id}})"><i class="fas fa-trash-alt"></i></a></td>
							<td>
								<a href="{{route('vendors.all',['p1'=>$ent->slug])}}" class="db-list-edit view-i" target="_blank"><i class="fa fa-eye"></i></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else 
			<div class="alert alert-primary" role="alert">
			  	No data found!
			</div>
		@endif
	</div>
</div>