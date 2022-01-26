@if (Auth::user())
  
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    {{-- <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> --}}
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('home')}}">Admin</a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li> --}}
        {{-- @role('admin') --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Danh Mục
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{route('category.create')}}">Thêm danh mục</a></li>
            <li><a class="dropdown-item" href="{{route('category.index')}}">Liệt kê danh mục</a></li>
            {{-- <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Sách truyện
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{route('truyen.create')}}">Thêm sách truyện</a></li>
            <li><a class="dropdown-item" href="{{route('truyen.index')}}">Liệt kê sách truyện</a></li>
            {{-- <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Truyện tranh
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{route('truyen-tranh.create')}}">Thêm truyện</a></li>
            <li><a class="dropdown-item" href="{{route('truyen-tranh.index')}}">Liệt kê truyện</a></li>
            {{-- <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
          </ul>
        </li>
        {{-- @endrole --}}

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Chapter
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{route('chapter.create')}}">Thêm chapter</a></li>
            <li><a class="dropdown-item" href="{{route('chapter-truyen-tranh.create')}}">Thêm chapter truyện tranh</a></li>
            <li><a class="dropdown-item" href="{{route('chapter.index')}}">Liệt kê chapter</a></li>
            {{-- <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            User
          </a>
          
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{route('user.create')}}">Thêm chapter</a></li>
            <li><a class="dropdown-item" href="{{route('user.index')}}">Liệt kê chapter</a></li>
            {{-- <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
          </ul>
        </li>
        
        {{-- <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li> --}}
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

@endif