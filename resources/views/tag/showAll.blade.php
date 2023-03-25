@extends('layout.app')


@section('title','Tags')


@section('main')
    <div class="container mt-3 mb-4">
        <h1>Tags</h1>
        <hr>
    </div>

    <div class="container mt-3 mb-4">
        @isset($tags)
            <div class="mt-3">
                @forelse($tags as $start => $currentTags)
                    <h1>{{$start}}</h1>
                    <hr>
                    <ul>
                        @foreach($currentTags as $tag)
                            <li>
                                <a href="{{route('tags.show',[$tag])}}">{{$tag->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                @empty
                    <p>Keine Tags vorhanden</p>
                @endforelse
            </div>
        @endisset
        <hr>
    </div>

@endsection
