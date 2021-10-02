@extends('template.index')

@section('content')
<div class="my-4">
    @if (count($genres) > 0)
    @foreach ($genres as $genre)
    <div class="movies row col-lg-10 mx-auto g-0 justify-content-center">
        <h4 class="px-3">{{ $genre->label . ': ' . count($genre->movies)}} </h4>
        @if(count($genre->movies) > 0)
        @foreach ($genre->movies()->withCount('genres')->orderBy('genres_count')->take(5)->get() as $movie)
        <div class="col-lg-15 col-md-3 col-sm-6 p-3 text-center justify-content-center">
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
    @endforeach
    @else

    @endif
</div>
@endsection
