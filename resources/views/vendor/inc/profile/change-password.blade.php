<div class="dashboard-section">
	<form method="post" action="{{route('user.password.changed')}}" id="change-password-form">
		@csrf
		<div class="row m-0">
			@if ($errors->any())
				<div class="col-md-12">
				    @foreach ($errors->all() as $error)
				    	<div class="alert alert-danger" role="alert">
						  {{$error}}
						</div>
				    @endforeach
			    </div>
			 @endif
			 @if(Session::has('success'))
			 	<div class="col-md-12">
			 		<div class="alert alert-primary" role="alert">
			 			{{Session::get('success')}}
			 		</div>
			 	</div>
			 @endif
			<div class="col-12 col-sm-6">
	            <div class="form-group">
	                <label class="">@lang('vendor.label.password')</label>
	                <input type="password" class="form-control" name="password" required autofocus>
	            </div>
	        </div>
	        <div class="col-12 col-sm-6">
	            <div class="form-group">
	                <label class="">@lang('vendor.label.confirmpassword')</label>
	                <input type="password" class="form-control" name="password_confirmation" required>
	            </div>
	        </div>
	        
	        <div class="col-12">
	            <button class="btn btn-primary" type="submit">@lang('vendor.label.changepassword')</button>
	        </div>
		</div>
	</form>
</div>