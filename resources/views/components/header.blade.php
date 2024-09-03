<header class="w3l-header">
    <div class="container">

        <nav class="navbar navbar-expand-lg navbar-light fill px-lg-0 py-0 px-sm-3 px-0">
            <a class="navbar-brand" href="{{route('main')}}">
                <span class="fa fa-newspaper-o"></span> Forum</a>
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="Toggle navigation">

                    <span class="fa icon-expand fa-bars"></span>
                    <span class="fa icon-close fa-times"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <nav class="mx-auto">
                    <div class="search-bar">
                        <form class="search" action="{{ route('search') }}" method="GET">
                            <input type="search" class="search__input" name="query" placeholder="Discover topics, posts and more"  onload="equalWidth()" required>
                            <button type="submit" class="search__button">
                                <span class="fa fa-search search__icon"></span>
                            </button>
                        </form>
                    </div>
                </nav>
                <ul class="navbar-nav">

                    @auth
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('home')}}">Home</a>
                    </li>
                    @endauth

                    <li class="nav-item dropdown @@pages__active">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            More <span class="fa fa-angle-down"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach($categories as $category)
                                @if($loop->first)
                                    <a class="dropdown-item @@b__active"
                                       href="{{ route('topics', ['category' => $category->slug]) }}">
                                        {{$category->name}}
                                    </a>
                                @else
                                    <a class="dropdown-item @@fa__active"
                                       href="{{ route('topics', ['category' => $category->slug]) }}">
                                        {{$category->name}}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </li>

                    @guest()
                    <li class="nav-item @@contact__active">
                        <a class="nav-link" href="{{route('register')}}">Register</a>
                    </li>
                    <li class="nav-item @@contact__active">
                        <a class="nav-link" href="{{route('login')}}">Login</a>
                    </li>
                    @endguest

                    @auth
                        <li class="nav-item @@contact__active">
                            <form action="{{ route('logout') }}" method="POST" class="form-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-transparent">Logout</button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>

            <div class="mobile-position">
                <nav class="navigation">
                    <div class="theme-switch-wrapper">
                        <label class="theme-switch" for="checkbox">
                            <input type="checkbox" id="checkbox">
                            <div class="mode-container">
                                <i class="gg-sun"></i>
                                <i class="gg-moon"></i>
                            </div>
                        </label>
                    </div>
                </nav>
            </div>

        </nav>
    </div>
</header>
