@extends('front.layout')
@extends('front.nav')
@section('content')

    @if(Session::has('message'))
        @if(is_array(Session::get('message')))
            @foreach(Session::get('message') as $message)
                <p>{{$message}}</p>
            @endforeach
        @else
            <p>{{Session::get('message')}}</p>
        @endif
    @endif
    <h1>Éditer ou supprimer un article</h1>
    <table class="table-striped table-bordered">
        <thead>
        <tr>
            <th>Titre</th>
            <th>Date de création</th>
            <th>Status</th>
            <th>Médias</th>
            <th>Catégories</th>
            <th>Tags</th>
            <th>Éditer</th>
            <th>Suppprimer</th>
        </tr>
        </thead>
        @foreach($posts as $post)
            <tr>
                <td><a href="{{ action('PostController@edit', $post->id) }}">{{ $post->title }}</a></td>
                <td>{{ $post->created_at }}</td>
                <td>{{ $post->status }}</td>
                <td>@if($post->picture)<img src="{{asset('uploads/'. $post->picture->uri)}}">@endif</td>
                <td>@if($category = $post->category ) {{$category->title}} @endif</td>
                <td>
                    <ul>
                        @foreach($post->tags as $tag)
                            <li>
                                {{ $tag->name }}
                            </li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <a href="{{action('PostController@edit', $post->id)}}" class="btn btn-warning">Éditer</a>
                </td>
                <td>
                    <form action="{{url('post', $post->id)}}" method="POST">
                        {{method_field('DELETE')}}
                        {{csrf_field()}}
                        <input class="btn btn-danger" type="submit" value="Supprimer">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection