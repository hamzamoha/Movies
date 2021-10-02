@extends('template.index')

@section('content')
<div class="text-center mb-3">
    <h1 class="display-3 text-success py-5">
        Latest
    </h1>
    <div class="movies row col-lg-10 mx-auto g-0 justify-content-center">
        @if (count($latest_movies) > 0)
        @foreach ($latest_movies as $movie)
        <div class="col-lg-15 col-md-3 col-sm-6 my-3 p-3 text-center justify-content-center">
            <a href="{{ route('movies.show', $movie->id) }}" class="movie-card-link" title="{{ $movie->title }} ({{ $movie->year }})">
                <div class="movie mb-2">
                    <img src="/images/movies/{{$movie->cover}}" alt="{{$movie->title}}" class="img-thumbnail bg-success border-success">
                    <h3 class="py-2">{{$movie->title}} ({{$movie->year}})</h3>
                    <span>{{$movie->rating}}/10</span>
                </div>
            </a>
        </div>
        @endforeach
        @endif
    </div>
</div>
<div class="text-center mb-3">
    <h1 class="display-3 text-success py-5">
        Top Rating
    </h1>
    <div class="movies row col-lg-10 mx-auto g-0 justify-content-center">
        @if (count($top_rating) > 0)
        @foreach ($top_rating as $movie)
        <div class="col-lg-15 col-md-3 col-sm-6 my-3 p-3 text-center justify-content-center">
            <a href="{{ route('movies.show', $movie->id) }}" class="movie-card-link" title="{{ $movie->title }} ({{ $movie->year }})">
                <div class="movie mb-2">
                    <img src="/images/movies/{{$movie->cover}}" alt="{{$movie->title}}" class="img-thumbnail bg-success border-success">
                    <h3 class="py-2">{{$movie->title}} ({{$movie->year}})</h3>
                    <span>{{$movie->rating}}/10</span>
                </div>
            </a>
        </div>
        @endforeach
        @endif
    </div>
</div>
<div class="text-center mb-3">
    <h1 class="display-3 text-success py-5">
        Last Added
    </h1>
    <div class="movies row col-lg-10 mx-auto g-0 justify-content-center">
        @if (count($last_added) > 0)
        @foreach ($last_added as $movie)
        <div class="col-lg-15 col-md-3 col-sm-6 my-3 p-3 text-center justify-content-center">
            <a href="{{ route('movies.show', $movie->id) }}" class="movie-card-link" title="{{ $movie->title }} ({{ $movie->year }})">
                <div class="movie mb-2">
                    <img src="/images/movies/{{$movie->cover}}" alt="{{$movie->title}}" class="img-thumbnail bg-success border-success">
                    <h3 class="py-2">{{$movie->title}} ({{$movie->year}})</h3>
                    <span>{{$movie->rating}}/10</span>
                </div>
            </a>
        </div>
        @endforeach
        @endif
    </div>
</div>
@endsection
