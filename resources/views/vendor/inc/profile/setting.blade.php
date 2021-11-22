<div class="dashboard-section">
	<form method="post" action="{{route('user.update',['id'=>$user->id])}}" id="user-update-form">
		<div class="row m-0">
			<div class="col-12 col-sm-6">
				<div class="form-group">
					<label class="">@lang('vendor.label.firstname') <sup>*</sup></label>
					<input type="text" class="form-control" name="name" required value="{{$user->name}}">
				</div>
			</div>
			<div class="col-12 col-sm-6">
				<div class="form-group">
					<label class="">@lang('vendor.label.lastname')</label>
					<input type="text" class="form-control" name="last_name" value="{{$user->surname}}">
				</div>
			</div>
			<div class="col-12 col-sm-6">
				<div class="form-group">
					<label class="">@lang('vendor.label.email') <sup>*</sup></label>
					<input type="email" class="form-control" name="email" required value="{{$user->email}}">
				</div>
			</div>
			<div class="col-12 col-sm-6">
				<div class="form-group">
					<label class="">@lang('vendor.label.phone') <sup>*</sup></label>
					<input type="number" class="form-control" name="phone" required value="{{$user->phone}}">
				</div>
			</div>
			<div class="col-12 col-sm-6">
				<div class="form-group">
					<label class="">@lang('vendor.label.register.code') </label>
					<input type="text" class="form-control" name="code" value="{{$user->code}}">
				</div>
			</div>
			<div class="col-12 col-sm-6">
				<div class="form-group">
					<label class="">@lang('vendor.label.pvm.code')</label>
					<input type="text" class="form-control" name="pvm_code" value="{{$user->pvm_code}}">
				</div>
			</div>
			<div class="col-12">
				<div class="form-group">
					<label class="">@lang('vendor.label.address')</label>
					<textarea class="form-control r-text-area" name="adderss">{{$user->address}}</textarea>
				</div>
			</div>
			<div class="col-12">
				<button class="btn btn-primary" type="submit" value="Login">@lang('vendor.button.update')</button>
			</div>
		</div>
	</form>
</div>