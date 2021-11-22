<div class="modal fade" id="bannerModal" tabindex="-1" role="dialog" aria-labelledby="bannerModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-lg" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Edit Banner</h5>
        		
      		</div>
      		<form method="post" action="{{route('banner.update')}}" id="updateBanner" enctype="multipart/form-data">
      			@csrf
      			<input type="hidden" name="id" value="{{$banner->id}}">
	      		<div class="modal-body edit-banner-content">
	        		<div class="form-group">
					    <label for="exampleInputEmail1">Banner Link:</label>
					    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="link" required value="{{$banner->link}}">
					</div>
					<div class="form-group">
					    <label for="exampleFormControlSelect1">Banner Position</label>
					    <select class="form-control" id="exampleFormControlSelect1" name="position" required>
					      	<option value="top" @if($banner->position == 'top') selected @endif>Top</option>
					      	<option value="bottom" @if($banner->position == 'bottom') selected @endif>Bottom</option>
					    </select>
					</div>
					<div class="form-group">
					    <label for="exampleFormControlFile1">Image</label>
					    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="file">
					    <small id="emailHelp" class="form-text text-muted">Image must be jpg,pgn,gif,svg</small>
					</div>
	      		</div>
	      		<div class="modal-footer">
	        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        		<button type="submit" class="btn btn-primary btn-dis">
	        			Save
	        		</button>
	      		</div>
      		</form>
    	</div>
  	</div>
</div>