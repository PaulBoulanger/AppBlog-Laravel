@extends('front.layout')
@extends('front.nav')

@section('content')
    <h3>Connexion</h3>
    <form class="form-horizontal" method="POST" action="{{url('login')}}">
        {{csrf_field()}}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Mot de passe</label>
            <div class="col-sm-10">
                <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Mot de passe">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <input type="checkbox"> Se souvenir de moi
                    </label>
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Valider</button>
            </div>
        </div>
    </form>
@endsection
@section('sidebar')


@endsection