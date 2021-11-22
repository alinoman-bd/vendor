@php
	$exist_ent_type = Helper::entTypeList(@$resource);
@endphp

<div class="form-group row">
	<label for="tips" class="col-sm-3 col-form-label text-left text-sm-right">Pramogos tipas<sup>*</sup></label>
	<div class="col-sm-9">
		<div class="info-form-check">
			@if(count($ent_categories) > 0)
				@foreach($ent_categories as $ent_cat)
					<div class="row m-0 pb-3">
						<div class="col-12"><label class="font-weight-bold">{{$ent_cat->name}}:</label></div>
						@if(count($ent_cat->ent_types) > 0)
							@foreach($ent_cat->ent_types as $type)
								<div class="col-12 col-md-6">
									<label class="ctm-container">{{$type->name}}
										<input type="checkbox" class="app_type" name="types[]" value="{{$type->id}}" @if(in_array($type->id, $exist_ent_type)) checked @endif>
										<span class="checkmark"></span>
									</label>
								</div>
							@endforeach	
						@endif		
					</div>
				@endforeach	
			@endif
		</div>
	</div>
</div>