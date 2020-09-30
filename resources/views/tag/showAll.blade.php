@extends('layout.app')


@section('title','Tags')


@section('main')
    <div class="container mt-3 mb-4">
        @isset($tags)
            @foreach($tags as $start => $currentTags)
                <div class="mt-3">
                    <h1>{{$start}}</h1>
                    <hr>

                    <ul>
                    @foreach($currentTags as $tag)

                        <li >
                            <a href="{{route('tags.show',[$tag])}}">{{$tag->name}}</a>
                        </li>
                    @endforeach
                    </ul>

                </div>
            @endforeach
        @endisset
        <hr>
    </div>


@endsection
