@extends('superadmin.layout')
@section('title')
	Entertainment Categories
@endsection

@section('style')
	<link href="{{asset('super-admin/taginput.css')}}" rel="stylesheet">
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
  					All Entertainment categories
				</div>
				<div class="all-ent-categories">
					@include('superadmin.include.ent-category-table')
				</div>
			</div>
		</div>
	</div>
	<div class="city-modal-area">
		<div class="modal fade" id="entCatModal" tabindex="-1" role="dialog" aria-labelledby="entCatModalLabel" aria-hidden="true">
		  	<div class="modal-dialog modal-lg" role="document">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<h5 class="modal-title" id="exampleModalLabel">Edit Entertainment Category</h5>
		        		
		      		</div>
		      		<form method="post" action="{{route('sup.entcat.update')}}" id="updateEntCat">
		      			@csrf
			      		<div class="modal-body edit-entcat-content">
			        		{{-- put city content --}}
			      		</div>
			      		<div class="modal-footer">
			        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        		<button type="submit" class="btn btn-primary btn-dis">
			        			Save
			        		</button>
			      		</div>
		      		</form>
		    	</div>
		  	</div>
		</div>
	</div>
@endsection
@section('script')
	<script src="{{asset('super-admin/taginput.js')}}"></script>
	<script src="{{asset('super-admin/entcat.js')}}"></script>
@endsection