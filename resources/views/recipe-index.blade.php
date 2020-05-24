@extends('layout.app')

@section('title','Alle Rezepte')


@section('main')
    <div class="container">
        @foreach($recipes as $recipe)
            <div class="card w-25" style="cursor: pointer" onclick="document.location.href = '{{url('/',[1])}}'">

                <div class="card-body">
                    @isset($recipe->pictures)
                        <img class="card-img" src="{{asset($recipe->pictures[0]['path-to-picture'])}}">
                    @endif
                    <h2 class="card-title">{{$recipe->name}}</h2>
                    <div class="card-text">
                        <h3>Beschreibung:</h3>

                        <p class="overflow-hidden">{{$recipe->description}}</p>

                    </div>
                </div>


            </div>

        @endforeach
    </div>
@endsection
