@extends('front.layout')
@extends('front.nav')

@section('title', $title)

@section('content')
    <h2>{{ $post->title }}</h2>
@stop


@stop

