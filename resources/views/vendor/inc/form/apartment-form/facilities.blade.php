
@if(@$resource)
@php $fac = Helper::facilities(@$resource); @endphp
@else
@php $fac = []; @endphp
@endif
<div class="modal fade ctm-modal" id="facilityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="text-transform: capitalize;" >@lang('vendor.label.facilities')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          @if(count($facilities) > 0)
          @foreach ($facilities as $facility)
          <div class="col-md-3">
            <label class="ctm-container"> {{ $facility->name }}
              <input type="checkbox" type="checkbox" value="{{$facility->id}}" id="defaultCheck_{{$facility->id}}" name="facilities[]" @if(in_array($facility->id,$fac)) checked @endif class="app-faclitites">
              <span class="checkmark"></span>
            </label>
          </div>
          @endforeach
          @endif
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">@lang('vendor.button.done')</button>
      </div>

    </div>
  </div>
</div>
