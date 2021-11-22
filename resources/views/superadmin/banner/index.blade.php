@extends('superadmin.layout')
@section('title')
	Banner
@endsection

@section('style')
	<style type="text/css">
		.rc-tbl{
			margin-top: 40px;
		}
		.alert-primary {
		    color: #fdfdfd;
		    background-color: #2c3034;
		    border-color: #b8daff;
		}
		.b-heading{
			background: #c3bcbc;
		    padding: 10px;
		    margin-top: 20px;
		    margin-bottom: 20px;
		    font-weight: bold;
		}
		.removeImg {
		    text-align: center;
		    position: absolute;
		    top: -13px;
		    right: 2px;
		    cursor: pointer;
		    color: red;
		}
	</style>
@endsection
	
@section('content')
	<div class="container-fluid rc-tbl">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="alert alert-primary" role="alert">
  					Banners
				</div>
			</div>
			<div class="col-lg-6">
				<div class="card">
				  	<div class="card-header">
				    	Upload Banners
				  	</div>
				  	<div class="card-body">
					  	@if(Session::has('error'))
				    		<div class="alert alert-danger" role="alert">
							  	{{Session::get('error')}}
							</div>
						@endif

				    	<form action="{{route('banner.save')}}" method="post" enctype="multipart/form-data">
				    		@csrf
							<div class="form-group">
							    <label for="exampleInputEmail1">Banner Link:</label>
							    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="link" required value="{{old('link')}}">
							</div>
							<div class="form-group">
							    <label for="exampleFormControlSelect1">Banner Position</label>
							    <select class="form-control" id="exampleFormControlSelect1" name="position" required>
							      	<option value="top" @if(old('position') == 'top') selected @endif>Top</option>
							      	<option value="bottom" @if(old('position') == 'bottom') selected @endif>Bottom</option>
							    </select>
							</div>
							<div class="form-group">
							    <label for="exampleFormControlFile1">Images</label>
							    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="file[]" required>
							    <small id="emailHelp" class="form-text text-muted">Image must be jpg,pgn,gif,svg</small>
							</div>
							<div class="form-group text-right">
								<button type="submit" class="btn btn-primary">Save</button>
							</div>
						</form>	
				  	</div>
				</div>
			</div>
		</div>
		<div class="top-banner">
			@include('superadmin.banner.top-banner')
		</div>
		<div class="bottom-banner">
			@include('superadmin.banner.bottom-banner')
		</div>
		<div class="put-edit-banner-modal"></div>
			
		
	</div>
	
@endsection
@section('script')
	<script type="text/javascript" src="{{asset('super-admin/banner.js')}}"></script>
	@if(Session::has('success'))
		<script type="text/javascript">
			toastr["success"]("{{Session::get('success')}}");
		</script>
	@endif
@endsection