<div class="row">
	<div class="col-md-12">
		<div class="row">
			<input type="hidden" name="id" value="{{$sea->id}}">
			<div class="col-md-6">
				<div class="form-group">
				    <label for="exampleInputEmail1">Name</label>
				    <input type="text" class="form-control" id="name" name="name" value="{{$sea->name}}" required>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
				    <label for="exampleInputEmail1">Slug</label>
				    <input type="text" class="form-control" id="slug" name="slug" value="{{$sea->slug}}" ed-id="{{$sea->id}}" model="App\Sea" required>
				    <span class="slug-div"></span>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
				    <label for="exampleInputEmail1">Seo title</label>
				    <input type="text" class="form-control" id="seo_title" name="seo_title" value="{{$sea->seo_title}}" required>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
				    <label for="exampleInputEmail1">Seo Tag</label>
				    <input type="text" class="form-control" id="seo_tag" name="seo_tag" value="{{$sea->seo_tag}}">
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
		    <label for="exampleInputEmail1">Keywords</label>
		    <input type="text" class="form-control" id="form-tags-1" name="seo_keyword" type="text" value="{{$sea->seo_keyword}}">
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
	    	<label for="seo_description">Description</label>
	    	<textarea class="form-control" id="summernote" rows="3" name="seo_description">{{$sea->seo_description}}</textarea>
	  	</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
	    	<label for="seo_description">Page Description</label>
	    	<textarea class="form-control" id="summernote1" rows="3" name="page_description">{{$sea->page_description}}</textarea>
	  	</div>
	</div>
	

</div>