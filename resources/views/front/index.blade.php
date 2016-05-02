@extends('front.layout')
@extends('front.nav')

@section('content')
    @forelse($posts as $post)
        <h1>Tous les articles</h1>
        <div class="article">
            <h2><a href=" {{url('post/'.$post->id)}}">{{ $post->title }}</a></h2>
            @if($category = $post->category)
                <p class="category">Catégorie : {{$category->title}}</p>
            @else
                <p>Aucune categorie</p>
            @endif
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
            <div>@if($post->picture)<img src="{{asset('uploads/'. $post->picture->uri)}}">@endif</div>
            <p class="description">{{ $post->excerpt(10) }}</p>
            <p><a class="btn" href="{{url('post/'.$post->id)}}">Lire la suite</a></p>
        </div>
    @empty
        <p>Aucun article</p>
    @endforelse
    {{$posts->links()}}
@stop

@section('sidebar')

    <p>J'aimerai être une sidebar :'(</p>
@endsection
