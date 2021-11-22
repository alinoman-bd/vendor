@if(count($ent_categories) > 0)
	<table class="table table-striped table-dark rc-tbl">
		<thead>
		    <tr>
			    <th scope="col">Sl</th>
			    <th scope="col">Name</th>
			    <th scope="col">Slug</th>
			    <th scope="col">Seo Title</th>
			    <th scope="col">Tag</th>
			    <th scope="col">Keyword</th>
			    <th scope="col">Action</th>
		    </tr>
		</thead>
	  	<tbody>
	  		@php
	  			$number = 1;
	  		@endphp
	  		@foreach ($ent_categories as $category)
		    	<tr>
				    <th scope="row">{{ $number }}</th>
				    <td>{{$category->name}}</td>
				    <td>{{$category->slug}}</td>
				    <td>{{$category->seo_title}}</td>
				    <td>{{$category->seo_tag}}</td>
				    <td>{{$category->seo_keyword}}</td>
				    <td>
				    	<button class="btn btn-primary" onclick="editEntCat({{$category->id}})"><i class="fas fa-edit"></i></button>
				    </td>
		    	</tr>
		    	@php
		    		$number++;
		    	@endphp
	    	@endforeach
	  	</tbody>
	</table>
@endif	