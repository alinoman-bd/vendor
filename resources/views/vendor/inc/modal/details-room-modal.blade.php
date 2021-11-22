<div class="details-modal" id="details_modal">
	<div class="details-modal-cnt">
		<div class="m-room-name">Relax Room <span class="float-right close-m d-close-m" data-dismiss="modal">X</span></div>
		<div class="row m-0">
			<div class="col-12 col-md-6 pl-0">
				<div class="gallery-slider">
					<div class="swiper-container gallery-top gallery-top2">
						<div class="swiper-wrapper">
							@if(count($room->images)>0)
								@foreach ($room->images as $image)
									@if($image->is_main == 1)
									<div class="swiper-slide">
										<div class="slide-img">
											<img src="{{asset('images/rooms/medium/'.$image->image_path)}}" class="cover" alt="img" onclick="openFancyboxItem('mainimage{{$image->id}}')">
										</div>
									</div>
									@endif
								@endforeach
							@endif

							@if(count($room->images)>0)
								@foreach ($room->images as $image)
									@if($image->is_main != 1)
									<div class="swiper-slide">
										<div class="slide-img">
											<img src="{{asset('images/rooms/medium/'.$image->image_path)}}" class="cover" alt="img" onclick="openFancyboxItem('image{{$image->id}}')">
										</div>
									</div>
									@endif
								@endforeach
							@endif	

							
						</div>
					</div>
					<div class="swiper-container gallery-thumbs gallery-thumbs2">
						<div class="swiper-wrapper">
							@if(count($room->images)>0)
								@foreach ($room->images as $image)
									@if($image->is_main == 1)
										<div class="swiper-slide slide1">
											<div class="slide-img">
												<img src="{{asset('images/rooms/ex-small/'.$image->image_path)}}" class="cover" alt="img">
											</div>
										</div>
									@endif
								@endforeach		
							@endif	
							@if(count($room->images)>0)
								@foreach ($room->images as $image)
									@if($image->is_main != 1)
										<div class="swiper-slide">
											<div class="slide-img">
												<img src="{{asset('images/rooms/ex-small/'.$image->image_path)}}" class="cover" alt="img">
											</div>
										</div>
									@endif	
								@endforeach
							@endif	
						</div>
						<div class="more-photos more-photos2" onclick="openFancyboxItem('mainimage{{$room->images[0]->id}}')">
							<div class="m-img">+{{count($room->images)}} photos</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-6 pr-0">
				<div class="m-faci">
					<p><b>Bed Type : </b>{{$room->bedType->name}}</p>
					<p><b>Total Room : </b>{{$room->total_rooms}}</p>
					<p><b>Total Bed : </b>{{$room->total_bed}}</p>
					<p><b>Allowed Person : </b>{{$room->allowed_person}}</p>
				</div>
				@if(count($resource->facilities) > 0)
				<div class="m-faci"><span class="tlt-txt">Available room facilities:</span></div>
				<div class="m-faci">
					<div class="row m-0">
						@foreach ($resource->facilities as $fac)
							<div class="col-4 col-md-4 pl-0">
								<i class="fas fa-check"></i> {{$fac->name}}
							</div>
						@endforeach
					</div>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>


{{-- fancy box --}}

<div class="d-none">
	@if(count($room->images)>0)
		@foreach ($room->images as $image)
			@if($image->is_main == 1)
				<a href="{{asset('images/rooms/medium/'.$image->image_path)}}" data-fancybox="gallery-1" data-fancy-id="mainimage{{$image->id}}">
					mainimage{{$image->id}}
				</a>
			@endif
		@endforeach
	@endif

	@if(count($room->images)>0)
		@foreach ($room->images as $image)
			@if($image->is_main != 1)
				<a href="{{asset('images/rooms/medium/'.$image->image_path)}}" data-fancybox="gallery-1" data-fancy-id="image{{$image->id}}">
					mainimage{{$image->id}}
				</a>
			@endif
		@endforeach
	@endif
</div>