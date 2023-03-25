@extends('layout.app')


@section('main')
    <div class="container-fluid mt-3">
        <div class="row justify-content-center">
            @foreach($recipes as $recipe)
                <div class="col-3 m-2" style="min-width: 20em">
                    <div class="card">
                        @if($recipe->pictures->count() > 0)

                            <img class="card-img-top" loading="lazy"
                                 src="{{route("pictures.show",$recipe->pictures[0])}}">
                        @endif
                        <div class="card-body">
                            <h3><a class="card-title stretched-link text-dark"
                                   href="{{route('recipes.show',[$recipe])}}">{{$recipe->name}}</a></h3>

                            <h6 class="card-subtitle text-muted">Benötigte
                                Zeit: {{$recipe->timeAsInterval()->forHumans()}}</h6>
                            <hr>

                            <div class="card-text">
                                <h4>Beschreibung:</h4>

                                <p class="overflow-hidden">{{$recipe->description}}</p>
                                @if($recipe->tags->count()  > 0)
                                    <h4>Tags:</h4>
                                    @foreach($recipe->tags as $tag)
                                        <a class="badge badge-pill badge-dark  pt-1 pb-1 pr-2 pl-2"
                                           style=" position:relative;z-index: 2"
                                           href="{{route('tags.show',[$tag])}}">{{$tag->name}}</a>
                                    @endforeach
                                @endif

                            </div>
                        </div>


                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
