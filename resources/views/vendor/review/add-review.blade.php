<form method="post" action="{{route('add-comment')}}" id="add-comment-form">
	@csrf
	<div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<div class="comment-box">
						<h2 class="ad-tlt">@lang('vendor.label.add') @lang('vendor.label.review')</h2>
						<form>
							<div class="form-group">
								<label for="exampleInputEmail1">@lang('vendor.label.name'):</label>
								<input type="text" class="form-control" placeholder="Name" name="name" required value="@if(Auth::check()){{auth()->user()->name}}@endif">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">@lang('vendor.label.email'):</label>
								<input type="email" class="form-control" placeholder="Email" name="email" required value="@if(Auth::check()){{auth()->user()->email}}@endif">
							</div>
							<input type="hidden" class="form-control add-given-star" name="star">
							<input type="hidden" class="form-control" name="status" value="{{$rec_type}}">
							<input type="hidden" class="form-control" name="rec_ent_id" value="{{$resource->id}}">
							<div class="form-group">
								<label class="" style="width: 100%;">@lang('vendor.label.rating'):</label>
								<div id="full-stars-example-two">
									<div class="rating-group">
										<input disabled checked class="rating__input rating__input--none" name="rating3" id="rating3-none" value="0" type="radio">
										<label aria-label="1 star" class="rating__label" for="rating3-1"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
										<input class="rating__input" name="rating3" id="rating3-1" value="1" type="radio">
										<label aria-label="2 stars" class="rating__label" for="rating3-2"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
										<input class="rating__input" name="rating3" id="rating3-2" value="2" type="radio">
										<label aria-label="3 stars" class="rating__label" for="rating3-3"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
										<input class="rating__input" name="rating3" id="rating3-3" value="3" type="radio">
										<label aria-label="4 stars" class="rating__label" for="rating3-4"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
										<input class="rating__input" name="rating3" id="rating3-4" value="4" type="radio">


										<label aria-label="5 stars" class="rating__label" for="rating3-5"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
										<input class="rating__input" name="rating3" id="rating3-5" value="5" type="radio">

										<label aria-label="6 stars" class="rating__label" for="rating3-6"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
										<input class="rating__input" name="rating3" id="rating3-6" value="6" type="radio">

										<label aria-label="7 stars" class="rating__label" for="rating3-7"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
										<input class="rating__input" name="rating3" id="rating3-7" value="7" type="radio">

										<label aria-label="8 stars" class="rating__label" for="rating3-8"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
										<input class="rating__input" name="rating3" id="rating3-8" value="8" type="radio">

										<label aria-label="9 stars" class="rating__label" for="rating3-9"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
										<input class="rating__input" name="rating3" id="rating3-9" value="9" type="radio">

										<label aria-label="10 stars" class="rating__label" for="rating3-10"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
										<input class="rating__input" name="rating3" id="rating3-10" value="10" type="radio">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="" style="width: 100%;">@lang('vendor.label.comments')</label>
								<textarea name="comment" id="reviewComments" class="form-control" required></textarea>
							</div>
							<div class="form-group text-center">
								<button class="btn">@lang('vendor.button.submit')</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>