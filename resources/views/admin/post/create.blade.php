@extends('front.layout')
@extends('front.nav')

@section('content')
    @if(Session::has('message'))
        <p>{{ Session::get('message') }}</p>
    @endif
    <h1>Création d'un article</h1>
    <form class="form-horizontal" action="{{ action('PostController@store') }}" method="POST"
          enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <div class="form-select">
                <label for="title">Saisissez le titre</label>
                <p><input class="form-control" type="text" name="title" placeholder="Saisir le titre de l'article"></p>
                @if($errors->has('title')) <span class="error">{{ $errors->first('title') }}</span> @endif
            </div>
            <div class="form-select col-md-12 meta">
                <label for="status_id">Status de publication</label>
                <select class="form-control" name="status_id">
                    <option value="0">Closed</option>
                    @forelse($status as $id=>$title)
                        <option value="{{$id}}">{{$title}}</option>
                    @empty

                    @endforelse
                </select>
            </div>
            <div class="form-select col-md-4 meta">
                <label for="published_at">Ajoutez une date de publication</label>
                <input class="form-control" name="published_at" type="text"
                       value="{{Carbon\Carbon::now()->format('Y-m-d')}}">
            </div>

            <div class="form-select col-md-4 meta">
                <label for="category_id">Sélectionnez une catégorie</label>
                <select class="form-control" name="category_id">
                    <option value="0">Non catégorisé</option>
                    @forelse($categories as $id=>$title)
                        <option value="{{$id}}">{{$title}}</option>
                    @empty

                    @endforelse
                </select>
            </div>
            <div class="form-select col-md-4 meta">
                <label for="tag_id">Sélectionnez un mot clé</label>
                <select class="form-control" name="tag_id[]" multiple>
                    @foreach($tags as $id=>$title)
                        <option value="{{$id}}">{{$title}}</option>

                    @endforeach
                </select>
            </div>
            <div class="form-select">
                <label for="content">Saisissez le contenu</label>
                <textarea class="form-control" name="content"></textarea>
                @if($errors->has('content')) <span class="error">{{ $errors->first('content') }}</span> @endif
            </div>
            <div class="form-select">
                <label>Aoutez une image</label>
                <input type="file" name="picture" value="">
            </div>
        </div>
        <input class="btn btn-success validation" type="submit" value="Enregistrer">
    </form>
@stop
