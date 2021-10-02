@extends('template.index')

@section('content')
<div class="movies row col-lg-10 mx-auto g-0 justify-content-center">
    @if(count($movies) > 0)
    @foreach ($movies as $movie)
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
    {{ $movies->links('template.pagination') }}
    @endif
</div>
@endsection
