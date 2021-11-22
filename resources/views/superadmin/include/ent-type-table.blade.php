@if(count($ent_types) > 0)
	<input type="hidden" name="page" id="ent-type-page" value="{{$page}}">
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
	  			if($page > 1){
	  				$page = $page - 1;
	  				$number = $page * $item + 1;
	  			}
	  		@endphp
	  		@foreach ($ent_types as $type)
		    	<tr>
				    <th scope="row">{{ $number }}</th>
				    <td>{{$type->name}}</td>
				    <td>{{$type->slug}}</td>
				    <td>{{$type->seo_title}}</td>
				    <td>{{$type->seo_tag}}</td>
				    <td>{{$type->seo_keyword}}</td>
				    <td>
				    	<button class="btn btn-primary" onclick="editEntType({{$type->id}})"><i class="fas fa-edit"></i></button>
				    </td>
		    	</tr>
		    	@php
		    		$number++;
		    	@endphp
	    	@endforeach
	  	</tbody>
	</table>
	<div class="text-center r-pgi">
		{{ $ent_types->links() }}
	</div>
@endif	