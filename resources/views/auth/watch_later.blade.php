@extends('template.index')

@section('content')
<div class="my-3 col-md-8 mx-auto bg-dark-28 py-3">
    <h1 class="display-5 text-center text-light">Watch Later</h1>
    @if (count($movies) > 0)
    <div class="row g-0 my-2 justify-content-center">
        @foreach ($movies as $movie)
        <div class="col-lg-15 col-md-3 col-sm-6 my-3 p-3 text-center justify-content-center">
            <div>
                @if(auth()->user()->hasWatched($movie->id))
                <form class="d-inline-block mb-1" action="/movies/watch_later/unwatched" method="POST">
                    @csrf
                    <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                    <button class="btn btn-primary" type="submit" title="Unwatch"><i class="fas fa-eye-slash"></i></button>
                </form>
                @else
                <form class="d-inline-block mb-1" action="/movies/watch_later/watched" method="POST">
                    @csrf
                    <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                    <button class="btn btn-success" type="submit" title="Watched"><i class="fas fa-eye"></i></button>
                </form>
                @endif
                <form class="d-inline-block mb-1" action="/movies/watch_later/remove" method="POST">
                    @csrf
                    <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                    <button class="btn btn-danger" type="submit" title="Remove"><i class="fas fa-trash"></i></button>
                </form>
            </div>
            <a href="{{ route('movies.show', $movie->id) }}" class="movie-card-link" title="{{ $movie->title }} ({{ $movie->year }})">
                <div class="movie mb-2">
                    <div class="position-relative">
                        <img src="/images/movies/{{$movie->cover}}" alt="{{$movie->title}}" class="img-thumbnail bg-warning border-warning">
                        @if(auth()->user()->hasWatched($movie->id))
                        <div class="watched position-absolute top-0 right-0 left-0 bottom-0 w-100 h-100 d-grid align-content-center text-dark h4" style="background-color: rgba(255, 237, 74, 0.51)">Watched</div>
                        @endif
                    </div>
                    <h3 class="py-2">{{$movie->title}} ({{$movie->year}})</h3>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-4">
        <h4 class="text-light-8C h3">No Movies here</h4>
        <a href="{{ route('movies.index') }}" class="btn btn-success btn-sm my-2">Browse Movie</a>
    </div>
    @endif
</div>
@endsection
