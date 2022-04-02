@extends('layout.app')

@section('title',$recipe->name)
@section('main')
    <div class="container mt-3 mb-3">

        <h1>{{$recipe->name}}</h1>
        <h6 class="mt-2 card-subtitle text-muted">Benötigte Zeit: {{$recipe->time}}</h6>
        <hr>



        @if($recipe->pictures->count() > 0)
            <div class="row">
                <div class="col-2"></div>
                <div id="pictures" class="carousel slide carousel-fade col-8" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($recipe->pictures as $picture)
                            <div class="carousel-item @if($loop->first) active @endif ">
                                <img class="w-100 bg-light" src="{{asset($picture['path-to-picture'])}}" alt="picture of recipe">
                            </div>
                        @endforeach
                    </div>

                    @if($recipe->pictures->count() > 1)
                        <a class="carousel-control-prev" href="#pictures" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#pictures" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    @endif
                </div>
                <div class="col-2"></div>
            </div>
        @endif


        <div class="mt-3 mb-3">
            <h2>Beschreibung:</h2>
            <p class="ml-4">{{$recipe->description}}</p>
        </div>


        <div class="mt-3 mb-3">
            <h2>Zutaten:</h2>
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th scope="col">Zutat</th>
                    <th scope="col">Menge</th>
                </tr>
                </thead>
                <tbody>
                @isset($recipe)
                    @foreach($recipe->ingredients as $ingredient)
                        <tr>
                            <td>{{$ingredient->name}}</td>
                            <td>{{$ingredient->amount . ' ' . $ingredient->unit->name}}</td>
                        </tr>
                    @endforeach
                @endisset
                </tbody>
            </table>
        </div>

        <div class="mt-3 mb-3">
            <h2>Arbeitsschritte:</h2>
            <p class="ml-4">{{$recipe->tasks}}</p>
        </div>
    </div>

@endsection
