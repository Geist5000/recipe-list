@extends('recipes.showAll')


@section('title','Tag')


@section('main')
    <div class="container mt-3 mb-4">
        <h1>Tag: {{$tag->name}}</h1>
        <hr>
    </div>

    @parent
@endsection
