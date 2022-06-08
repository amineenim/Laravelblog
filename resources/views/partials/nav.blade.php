    <!-- Default bootstrap navbar-->
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Laravel Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('/') ? "active": ""}}" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('blog') ? "active": ""}}" aria-current="page" href="/blog">Blog</a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ Request::is('about') ? "active": ""}}" href="/about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('contact') ? "active": ""}}" href="/contact">Contact</a>
        <li class="nav-item dropdown mx-3 navbar-right">
          @if(Auth::check())

          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           Hello {{ Auth::user()->name }}
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('posts.index')}}">Posts</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('logout')}}">Logout</a></li>
          </ul>

          @else

          <li><a href="{{ route('login') }}" class="btn btn-outline-success">Login</a></li>

          @endif
        </li>
      </ul>
      </div>
      </div>
    </nav>