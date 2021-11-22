@if(count($resource->comments) > 0)
	@foreach($resource->comments as $comment)
		<div class="blog-card">
			<div class="blog-img">
				<img class="photo" src="{{asset('images/profile/profile-img.jpg')}}">
			</div>
			<div class="description">
				<h1>{{$comment->name}} <span class="publish-d">{{$comment->created_at->diffForHumans()}}</span></h1>
				<div class="rates">
					@for($star = 1; $star <= 10; $star++)
						<span class="fa fa-star @if($star <= $comment->star) checked @endif"></span>
					@endfor	
				</div>
				<p>{{$comment->comment}}</p>
				@if(!$comment->replay)
					@if(Auth::check())
						@if(auth()->user()->id == $resource->user_id)
							<div><span class="re-btn rep-s-b" onclick="replayReviewModal('{{$comment->id}}')">Reply</span></div>
						@endif
					@endif		
				@endif
				@if($comment->replay)
					<div class="reply-box-cnt">
						<div class="blog-card">
							<div class="blog-img">
								@if($resource->user->image)
									<img class="photo" src="{{asset('images/profile/'.$resource->user->image)}}">
								@else
								 	<img class="photo" src="{{asset('images/profile/profile-img.jpg')}}">
								@endif	
							</div>
							<div class="description">
								<h1>{{$comment->replay->name}} <span class="publish-d">{{$comment->replay->created_at->diffForHumans()}}</span></h1>
								<p> {{$comment->replay->comment}}</p>
							</div>
						</div>
					</div>
				@endif	
			</div>
		</div>
	@endforeach
@endif		