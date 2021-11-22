@extends('superadmin.layout')
@section('title')
	Entertainments
@endsection

@section('style')
	<style type="text/css">
		.rc-tbl{
			margin-top: 40px;
		}
		.pagination{
			display: inline-flex;
			margin-bottom: 20px;
			margin-top: 20px;
		}
		.r-pgi{
			background: #2c3034;
		}
		.alert-primary {
		    color: #fdfdfd;
		    background-color: #2c3034;
		    border-color: #b8daff;
		}
	</style>
@endsection
	
@section('content')
	<div class="container-fluid rc-tbl">
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-primary" role="alert">
  					All Entertainments 
				</div>
				<input type="hidden" name="page" id="rec-page" value="{{$page}}">
				<div class="all-resources">
					@include('superadmin.include.ent-table')
				</div>
			</div> 
		</div>
	</div>
	<div class="vipArea">
		@include('superadmin.include.vip-modal')
	</div>
	
@endsection

@section('script')
	<script src="{{asset('super-admin/ent.js')}}"></script>
@endsection