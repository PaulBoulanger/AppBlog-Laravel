@extends('front.layout')
@extends('front.nav')
@section('content')

        @if(Session::has('message'))
            <p>{{ Session::get('message') }}</p>
        @endif
        <h1>{{$post->title}}</h1>
        <form class="form-horizontal" action="{{ url('post', $post->id)  }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{method_field('PUT')}}
            <div class="form-group">
                <input type="hidden" name="_method" value="PUT">
                <p><input class="form-control" type="text" name="title" placeholder="Votre titre" value="{{ $post->title }}"></p>
                @if($errors->has('title')) <span class="error">{{ $errors->first('title') }}</span> @endif
                <div class="form-select col-md-4 meta">
                    <label for="published_at">Ajoutez une date de publication</label>
                    <input class="form-control" name="published_at" type="date" value="{{Carbon\Carbon::now()->format('d/m/Y')}}">
                    </select>
                </div>
                <div class="form-select col-md-4 meta">
                    <label for="category_id">Sélectionnez une catégorie</label>
                    <select class="form-control" name="category_id">
                        <option value="0">Sans catégorie</option>
                        @forelse($categories as $id=>$title)
                            <option value="{{$id}}" {{$post->category_id==$id? 'selected' : ''}}>{{$title}}</option>
                        @empty

                        @endforelse
                    </select>
                </div>
                <div class="form-select col-md-4 meta">
                    <label for="tag_id">Sélectionnez un mot clé</label>
                    <select class="form-control" name="tag_id[]" multiple>
                        @foreach($tags as $id=>$title)
                            <option {{$post->hasTag($id)? 'selected' : ''}} value="{{$id}}">{{$title}}</option>

                        @endforeach
                    </select>
                </div>
                <textarea class="form-control" name="content" value="Saisissez le contenu">{{ $post->content }}</textarea>
                @if($errors->has('content')) <span class="error">{{ $errors->first('content') }}</span> @endif
            </div>
            <div class="form-select">
                <label>Aoutez une image</label>
                <input type="file" name="picture" value="">
                <p class="image">@if($post->picture)<img src="{{asset('uploads/'. $post->picture->uri)}}">@endif</p>
                <input class="btn btn-default" type="checkbox" name="deletePicture" value="supprimer"> Supprimer l'image
            </div>

            <input class="btn btn-success validation" type="submit" value="Enregistrer">
        </form>
@endsection