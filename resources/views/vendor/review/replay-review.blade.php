<form method="post" action="{{route('replay-comment')}}" id="replay-comment-form">
	@csrf
	<div class="modal fade" id="replayReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<div class="comment-box">
						<h2 class="ad-tlt">@lang('vendor.button.reply')</h2>
						<form>
							<div class="form-group">
								<label for="exampleInputEmail1">@lang('vendor.label.name'):</label>
								<input type="text" class="form-control" placeholder="Name" name="name" required value="@if(Auth::check()){{auth()->user()->name}}@endif">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">@lang('vendor.label.email'):</label>
								<input type="email" class="form-control" placeholder="Email" name="email" required value="@if(Auth::check()){{auth()->user()->email}}@endif">
							</div>
							<input type="hidden" class="form-control" name="status" value="{{$rec_type}}">
							<input type="hidden" class="form-control" name="rec_ent_id" value="{{$resource->id}}">
							<input type="hidden" class="form-control set-comment-id" name="comment_id" value="">
							<div class="form-group">
								<label class="" style="width: 100%;">@lang('vendor.button.reply')</label>
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