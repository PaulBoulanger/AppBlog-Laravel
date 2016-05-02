@extends('front.layout')
@extends('front.nav')

@section('content')
    @forelse($posts as $post)
        <p class="category">Tous les articles de la catégorie : {{$category->title}}</p>
        <div class="article">
            <h2><a href=" {{url('post/'.$post->id)}}">{{ $post->title }}</a></h2>
            @if($tags = $post->tags)
                <ul>
                    @foreach($tags as $tag)
                        <li>{{ $tag->name}}</li>
                    @endforeach
                </ul>
            @endif
            @if($user = $post->user)
                <p class="auteur">Écrit par : <a href="{{Action('FrontController@userPost', $user->id)}}">{{$user->name}}</a></p>
            @else
                <p>Anonyme</p>
            @endif
            <p class="description">{{ $post->excerpt(10) }}</p>
            <p><a class="btn" href="{{url('post/'.$post->id)}}">Lire la suite</a></p>
        </div>
    @empty
        <p>Aucun article</p>
    @endforelse
    {{$posts->links()}}
@stop

@section('sidebar')
@endsection
