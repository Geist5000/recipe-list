@extends('layout.app')

@section('title',$recipe->name)
@push('style')
    <link rel="stylesheet" href="{{asset('css/recipe-pictures.css')}}"/>
@endpush
@section('main')
    <div class="container mt-3 mb-3">
        <div class="position-relative w-100">
            <h1>{{$recipe->name}}</h1>
            <div class="top-right">
                <a class="btn btn-primary" href="{{route("recipes.edit",["recipe"=>$recipe])}}">Bearbeiten</a>
            </div>
        </div>
        <h6 class="mt-2 card-subtitle text-muted">Benötigte Zeit: {{$recipe->timeAsInterval()->forHumans()}}</h6>
        <hr>


        @if($recipe->pictures->count() > 0)
            <div class="row">
                <div class="col-2"></div>
                <div id="pictures" class="carousel slide col-8" data-ride="carousel" data-interval="false">
                    <ol class="carousel-indicators">
                        @for($i = 0; $i < $recipe->pictures->count(); $i++)
                            <li data-target="#carouselExampleIndicators"
                                data-slide-to="{{$i}}" @class(["active" => $i === 0])></li>
                        @endfor
                    </ol>
                    <div class="carousel-inner">
                        @foreach($recipe->pictures as $picture)

                            <div class="carousel-item carousel-picture @if($loop->first) active @endif ">
                                <a href="{{route("pictures.show",$picture)}}">
                                    <img class="bg-light" src="{{route("pictures.show",$picture)}}"
                                         alt="picture of recipe">
                                </a>
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
            <p class="ml-4">{!!nl2br(e($recipe->tasks))!!}</p>
        </div>

    </div>

@endsection
