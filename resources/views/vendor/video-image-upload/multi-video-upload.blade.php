<div class="form-cnt">
	<div class="form-title">
		<h2>@lang('vendor.label.upload') @lang('vendor.label.additional') @lang('vendor.label.video')</h2>
	</div>
	<div class="all-form">
		<form method="post" action="{{route('rec_ent.aditional.uploaded',['rec_or_ent'=>$rec_ent,'id'=>$id])}}" enctype="multipart/form-data" id="aditional-video-upload">
			<div class="row">
				<div class="col-4 col-lg-4">
					<div class="video-section1">
						<p class="note-text1">@lang('vendor.description.video.3')</p>
						<p class="to-link1">@lang('vendor.label.upload') Youtube @lang('vendor.label.video')</p>
					</div>
					<div class="embed-video-section1">
						<p class="note-text1">@lang('vendor.description.video.4')</p>
						<p class="to-video1">@lang('vendor.label.upload') @lang('vendor.label.video')</p>
					</div>
				</div>
				<div class="col-6 col-lg-6">
					<div class="form-group">
						<label for="exampleFormControlFile1">@lang('vendor.label.choose') Thumbnail</label>
						<input type="file" class="form-control-file thumb-img1" id="exampleFormControlFile1" name="image" required>
					</div>
					<div class="video-section1">
						<div class="form-group">
							<label for="exampleFormControlFile1">@lang('vendor.label.choose') @lang('vendor.label.additional') @lang('vendor.label.video')</label>
							<input type="file" class="form-control-file video_file1" id="exampleFormControlFile1" name="video">
						</div>
					</div>
					<div class="embed-video-section1">
						<div class="form-group">
							<label for="exampleInputEmail1">Youtube @lang('vendor.label.video') Link</label>
							<input type="text" class="form-control e_video1" id="exampleInputEmail1" aria-describedby="emailHelp" name="youtube_video">
						</div>
					</div>
				</div>
				<div class="col-2 col-lg-2">
					<button type="submit" class="btn btn-primary btn-mg">@lang('vendor.label.upload')</button>
				</div>
			</div>
			<div class="row additional-videos-area">
				@include('vendor.video-image-upload.multi-video')
			</div>
		</form>
	</div>
</div>