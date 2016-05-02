<nav class="navbar navbar-default">
    <div class="container-fluid">
        @if(Auth::check())
            <ul class="nav navbar-nav">
                <li><a href="{{url('/')}}">Accueil</a></li>
                @forelse($categories as $id => $title)
                    <li><a href="{{ Action('FrontController@showPostByCat', $id)}}">{{$title}}</a></li>
                @empty
                @endforelse
            </ul>
            <ul class="nav navbar-nav Login">
                <li><a href="{{action('PostController@index')}}">Dashboard</a></li>
                <li><a href="{{action('PostController@create')}}">Créer un post</a></li>
                <li><a href="{{url('logout')}}">Logout</a></li>
            </ul>

        @else
            <ul class="nav navbar-nav">
                <li><a href="{{url('/')}}">Accueil</a></li>
                @forelse($categories as $id => $title)
                    <li><a href="{{ Action('FrontController@showPostByCat', $id)}}">{{$title}}</a></li>
                @empty
                @endforelse
            </ul>
            <ul class="nav navbar-nav Login">
                <li><a href="{{url('login')}}">Login</a></li>
            </ul>
        @endif
    </div>
</nav>
