<div class="form-group">
    <label class="">@lang('vendor.label.amount')</label>
    <input type="text" class="form-control" name="amount" readonly value="{{$payment_info->price}} Eur">
</div>
<div class="form-group">
    <label class="">@lang('vendor.label.duration')</label>
    <input type="text" class="form-control" name="duration" readonly value="{{$payment_info->duration}}">
</div>