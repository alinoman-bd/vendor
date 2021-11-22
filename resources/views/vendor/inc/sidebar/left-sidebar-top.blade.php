<div class="left-sidebar-top text-center">
	<div class="proile-img">
		@if(auth()->user()->image)
			<img src="{{asset('images/profile/'.auth()->user()->image)}}" alt="img">
		@else
			<img src="{{asset('images/profile/profile-img.jpg')}}" alt="img">
		@endif
		<form class="avatar" method="post" action="{{route('user.profile.image')}}" enctype="multipart/form-data" id="profileImageUploadForm">
			@csrf
			<i class="fas fa-camera"></i>
			<input type="file" name="file" onchange="avaterChange()" >
		</form>
	</div>
	<div class="side-top-txt d-flex">
		<div class="top-txt current-user-name">{{auth()->user()->name}} @if(auth()->user()->surname) {{auth()->user()->surname}} @endif</div>
	</div>
</div> 