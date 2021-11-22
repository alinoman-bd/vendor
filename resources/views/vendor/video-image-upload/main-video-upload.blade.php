<div class="form-cnt">
	<div class="form-title">
		<h2>@lang('vendor.label.upload') @lang('vendor.label.main') @lang('vendor.label.video')</h2>
	</div>
	<div class="all-form">
		<form method="post" action="{{route('rec_ent.uploaded',['rec_or_ent'=>$rec_ent,'id'=>$id])}}" enctype="multipart/form-data" id="main-video-upload">
			@csrf()
			<div class="row">
				<div class="col-4 col-lg-4">
					<div class="video-section">
						<p class="note-text">@lang('vendor.description.video.1')</p>
						<p class="to-link">@lang('vendor.label.upload') Youtube @lang('vendor.label.video')</p>
					</div>
					<div class="embed-video-section">
						<p class="note-text">@lang('vendor.description.video.2')</p>
						<p class="to-video">@lang('vendor.label.upload') @lang('vendor.label.video')</p>
					</div>
				</div>
				<div class="col-6 col-lg-6">
					<div class="form-group">
						<label for="exampleFormControlFile1">@lang('vendor.label.choose') Thumbnail</label>
						<input type="file" class="form-control-file thumb-img" id="exampleFormControlFile1" name="image" required>
					</div>
					<div class="video-section">
						<div class="form-group">
							<label for="exampleFormControlFile1">@lang('vendor.label.choose') @lang('vendor.label.main') @lang('vendor.label.video')</label>
							<input type="file" class="form-control-file video_file" id="exampleFormControlFile1" name="video">
						</div>
					</div>
					<div class="embed-video-section">
						<div class="form-group">
							<label for="exampleInputEmail1">Youtube @lang('vendor.label.video') Link</label>
							<input type="text" class="form-control e_video" id="exampleInputEmail1" aria-describedby="emailHelp" name="youtube_video">
						</div>
					</div>
				</div>
				<div class="col-2 col-lg-2">
					<button type="submit" class="btn btn-primary btn-mg">@lang('vendor.label.upload')</button>
				</div>

				<div class="col-4 col-lg-4">
					<div class="main-videos-area">
						@include('vendor.video-image-upload.main-video');
					</div>
				</div>
			</div>
		</form>
	</div>
</div>