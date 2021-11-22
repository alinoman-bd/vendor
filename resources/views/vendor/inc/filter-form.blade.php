<div class="sidebar pl-0 pt-0">
	<nav class="side_nav">
		<ul class="side_ul">
			<li class="side_nav__items side_nav__items_out">
				<h3 class="mb-0">Poilsis prie ežero, upės</h3>
			</li>
			@if(count($ent_categories_types) > 0)
			@foreach($ent_categories_types as $ent_category)
			<li class="side_nav__items side_nav__items_out @if($ent_category->slug == @$items['ent_cat']->slug) active @endif">
				<span class="manu-show-btn"><i class="fas fa-chevron-down"></i></span>
				<a href="{{route('vendors.all',['p1'=>$ent_category->slug])}}" class="side_nav__links side_nav__links_out">{{$ent_category->name}}</a>
				<ul class="side_ul_in">
					@if(count($ent_category->ent_types) >0)
					@foreach($ent_category->ent_types as $type)
					<li class="side_nav__items side_nav__items_in">
						<a href="{{route('vendors.all',['p1'=>$ent_category->slug,'p2'=>$type->slug])}}" class="side_nav__links side_nav__links_in @if($type->slug == @$items['ent_type']->slug) active @endif">{{$type->name}}</a>
					</li>
					@endforeach
					@endif
				</ul>
			</li>
			@endforeach
			@endif
		</ul>
	</nav>
</div>