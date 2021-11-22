<div class="modal fade show" id="logModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <div class="title-default-bold mb-none log-tlt ">@lang('vendor.label.login')</div>
                <div class="title-default-bold mb-none reg-tlt d-none">@lang('vendor.label.register')</div>
            </div>
            <div class="modal-body p-0">
                <div class="login-form login-cnt">
                    <form action="{{ route('login') }}" method="POST" id="loginForm">
                        @csrf
                        <div class="form-group">
                            <label class="">@lang('vendor.label.username') <sup>*</sup></label>
                            <input type="text" class="form-control" placeholder="@lang('vendor.placeholder.username')" name="email" required>
                        </div>
                        <div class="form-group">
                            <label class="">@lang('vendor.label.password') <sup>*</sup></label>
                            <input type="password" placeholder="@lang('vendor.label.password')" class="form-control" name="password" required>
                        </div>
                        <div class="form-group">
                            <label class="ctm-container">@lang('vendor.label.rememberme')
                                <input type="checkbox" name="remember">
                                <span class="checkmark"></span>
                            </label>
                        </div>            
                        <div class="form-group d-flex mt-4">
                            <button class="btn ctm-btn log-btn" type="submit" value="Login">@lang('vendor.label.login')</button>
                            <button class="btn ctm-btn log-btn show-reg-form form-cancel" type="button"> @lang('vendor.button.backregister')</button>
                        </div>
                    </form>
                </div>

                <div class="login-form register-cnt  d-none">
                    <form action="{{route('user.register')}}" method="POST" id="regForm">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="">@lang('vendor.label.firstname') <sup>*</sup></label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="">@lang('vendor.label.lastname') </label>
                                    <input type="text" class="form-control" name="last_name" >
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="">@lang('vendor.label.email') <sup>*</sup></label>
                                    <input type="email" class="form-control" name="email"  required >
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="">@lang('vendor.label.phone') <sup>*</sup></label>
                                    <input type="number" class="form-control" name="phone" required>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="">@lang('vendor.label.password') <sup>*</sup></label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="">@lang('vendor.label.confirmpassword') <sup>*</sup></label>
                                    <input type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="">@lang('vendor.label.register.code') </label>
                                    <input type="text" class="form-control" name="code" >
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="">@lang('vendor.label.pvm.code')</label>
                                    <input type="text" class="form-control" name="pvm_code">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="">@lang('vendor.label.address')</label>
                                    <textarea class="form-control r-text-area" name="adderss"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4 d-flex">
                            <button class="btn ctm-btn log-btn" type="submit" value="Login">@lang('vendor.label.register')</button>
                            <button class="btn ctm-btn show-log-form log-btn form-cancel" type="button">@lang('vendor.button.backlogin')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>