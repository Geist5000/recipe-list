@extends('layout.app')


@section('title','Login')


@section('main')
    <div class="container-sm">

        <div class="w-50 m-auto">
            <h1>Login</h1>
            <form method="POST" action="{{ route('login') }}">

                @csrf

                <div class="row">
                    <div class="mb col-12">
                        <label for="email" class="form-label"></label>
                        <input type="text" class="form-control" id="email" name="username" placeholder="Benutzername">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-12">
                        <label for="password" class="form-label"></label>
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="Passwort">
                    </div>
                </div>
                @if($errors->isNotEmpty())
                    <div class="alert alert-danger">
                        {{$errors}}
                    </div>
                @endif
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
@endsection
