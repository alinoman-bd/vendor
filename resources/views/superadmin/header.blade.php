<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="{{route('vendors.all')}}"><img src="{{asset('vendor/img/map-logo.png')}}" style="width:23px;"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item @if(\Request::route()->getName() == 'superadmin') active @endif">
        <a class="nav-link" href="{{url('superadmin')}}">Dashboard <span class="sr-only">(current)</span></a>
      </li>

       <li class="nav-item dropdown @if(\Request::route()->getName() == 'sup.city.index') active @endif @if(\Request::route()->getName() == 'sup.location.index') active @endif @if(\Request::route()->getName() == 'sup.lake.index') active @endif @if(\Request::route()->getName() == 'sup.river.index') active @endif @if(\Request::route()->getName() == 'sup.sea.index') active @endif @if(\Request::route()->getName() == 'sup.type.index') active @endif">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Items
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item @if(\Request::route()->getName() == 'sup.city.index') active @endif" href="{{route('sup.city.index')}}">Cities</a>
          <a class="dropdown-item @if(\Request::route()->getName() == 'sup.location.index') active @endif" href="{{route('sup.location.index')}}">Locations</a>
          <a class="dropdown-item @if(\Request::route()->getName() == 'sup.lake.index') active @endif" href="{{route('sup.lake.index')}}">Lakes</a>
          <a class="dropdown-item @if(\Request::route()->getName() == 'sup.river.index') active @endif" href="{{route('sup.river.index')}}">Rivers</a>
          <a class="dropdown-item @if(\Request::route()->getName() == 'sup.sea.index') active @endif" href="{{route('sup.sea.index')}}">Seas</a>
          <a class="dropdown-item @if(\Request::route()->getName() == 'sup.type.index') active @endif" href="{{route('sup.type.index')}}">Types</a>
        </div>
      </li>
       <li class="nav-item dropdown @if(\Request::route()->getName() == 'sup.ent.index') active @endif @if(\Request::route()->getName() == 'sup.entcat.index') active @endif @if(\Request::route()->getName() == 'sup.enttype.index') active @endif">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Entertainment
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item @if(\Request::route()->getName() == 'sup.ent.index') active @endif" href="{{route('sup.ent.index')}}">Entertainment</a>
          <a class="dropdown-item @if(\Request::route()->getName() == 'sup.entcat.index') active @endif" href="{{route('sup.entcat.index')}}">Entertainment Categories</a>
          <a class="dropdown-item @if(\Request::route()->getName() == 'sup.enttype.index') active @endif" href="{{route('sup.enttype.index')}}">Entertainment Types</a>
        </div>
      </li>
       <li class="nav-item @if(\Request::route()->getName() == 'banner.index') active @endif">
        <a class="nav-link" href="{{route('banner.index')}}">Banners</a>
      </li>


     {{--  <li class="nav-item @if(\Request::route()->getName() == 'sup.city.index') active @endif">
        <a class="nav-link" href="{{route('sup.city.index')}}">Cities</a>
      </li>
      <li class="nav-item @if(\Request::route()->getName() == 'sup.location.index') active @endif">
        <a class="nav-link" href="{{route('sup.location.index')}}">Locations</a>
      </li>
      <li class="nav-item @if(\Request::route()->getName() == 'sup.lake.index') active @endif">
        <a class="nav-link" href="{{route('sup.lake.index')}}">Lakes</a>
      </li>
      <li class="nav-item @if(\Request::route()->getName() == 'sup.river.index') active @endif">
        <a class="nav-link" href="{{route('sup.river.index')}}">Rivers</a>
      </li>
      <li class="nav-item @if(\Request::route()->getName() == 'sup.sea.index') active @endif">
        <a class="nav-link" href="{{route('sup.sea.index')}}">Seas</a>
      </li>
      <li class="nav-item @if(\Request::route()->getName() == 'sup.type.index') active @endif">
        <a class="nav-link" href="{{route('sup.type.index')}}">Types</a>
      </li>
      <li class="nav-item @if(\Request::route()->getName() == 'sup.ent.index') active @endif">
        <a class="nav-link" href="{{route('sup.ent.index')}}">Entertainment</a>
      </li>
      <li class="nav-item @if(\Request::route()->getName() == 'sup.entcat.index') active @endif">
        <a class="nav-link" href="{{route('sup.entcat.index')}}">Entertainment Categories</a>
      </li>

       <li class="nav-item @if(\Request::route()->getName() == 'sup.enttype.index') active @endif">
        <a class="nav-link" href="{{route('sup.enttype.index')}}">Entertainment Types</a>
      </li> --}}



     {{--  <li class="nav-item">
        <a class="nav-link" href="{{route('vendors.all')}}">Home</a>
      </li> --}}

       <li class="nav-item">
          <a class="nav-link" href="{{url('logout')}}" onclick="event.preventDefault();document.getElementById('frm-logout').submit();">Logout</a>
          <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
          </form>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>