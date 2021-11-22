<!DOCTYPE html>
<html>

<head>
	<title></title>
	<style type="text/css">
		table {
			border-collapse: collapse;
			width: 100%;
			font-weight: normal;
		}

		th,
		td {
			padding: 8px;
			text-align: left;
			border-bottom: 1px solid #ddd;
			font-weight: normal;
		}

		th {
			font-weight: bold;
		}

		p {
			margin: 6px;
		}
	</style>
</head>

<body>
	<div style="text-align: center;">
		<h1>Vendors</h1>
		<p>Date: {{date('Y-m-d',strtotime($data->created_at))}}</p>
		<p>Order: # {{$data->order_id}}</p>
	</div>
	<div style="margin-top: 80px;">
		<p>{{$data->user->name}} @if($data->user->surname) {{$data->user->surname}} @endif </p>
		@if($data->user->address)
		<p>{{$data->user->address}}</p>
		@endif
		@if($data->user->phone)
		<p>Phone: {{$data->user->phone}}</p>
		@endif
		@if($data->user->email)
		<p>Email: {{$data->user->email}}</p>
		@endif
		@if($data->user->code)
		<p>Code: {{$data->user->code}}</p>
		@endif
		@if($data->user->pvm_code)
		<p>PVM Code: {{$data->user->pvm_code}}</p>
		@endif
	</div>
	<div style="width: 100%; margin-top: 40px;">
		<table>
			<thead>
				<tr>
					<th>Name</th>
					<th>Package</th>
					<th>Duration</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th>Price</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>{{@$data->entertainment->name}} {{@$data->resource->name}}</td>
					<td>{{$data->package_name}}</td>
					<td>{{$data->duration}}</td>
					<td>{{date('Y-m-d',strtotime($data->start_date))}}</td>
					<td>{{date('Y-m-d',strtotime($data->end_date))}}</td>
					<td>{{number_format($data->price,2)}}</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div style="text-align:right; margin-right:15px">
		<p><b>Total: {{number_format($data->price,2)}}</b></p>
	</div>
</body>

</html>
Aa