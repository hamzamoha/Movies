@extends('template.index')

@section('content')
<div class="my-3" id="movie">
    <div class="col-sm-10 container-lg mx-auto bg-dark-28 shadow p-3">
        <div class="row g-0 justify-content-center">
            <div class="col-lg-3 col-md-4 col-sm-5 text-center">
                <img src="/images/movies/{{ $movie->cover }}" alt="{{ $movie->title }}" title="{{ $movie->title }} ({{ $movie->year }})" class="img-thumbnail bg-danger border-danger">
            </div>
            <div class="col-lg-9 col-md-8 col-sm-7 px-sm-3 px-2 py-3">
                <h3 class="py-3">{{ $movie->title }} ({{ $movie->year }})</h3>
                <table class="table table-dark table-striped table-bordered">
                    <tr>
                        <th>
                            Rating
                            </td>
                        <td>
                            {{ $movie->rating }}/10
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Genres
                        </th>
                        <td>
                            @foreach ($movie->genres as $genre)
                            <a href="#">{{ $genre->label }}</a>@if (!$loop->last){{(',')}}@endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Runtime
                        </th>
                        <td>
                            {{ (($movie->runtime>=60)?(int)($movie->runtime/60).'h ':'').($movie->runtime%60).'m' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Links
                        </th>
                        <td>
                            <a href="https://www.imdb.com/title/{{ $movie->imdb_code }}" class="btn btn-warning btn-sm" target="_blank">IMDb</a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            @if(auth()->user()->hasFavorite($movie->id))
                            <button class="btn btn-dark me-2" @click='remove_favorite({{$movie->id}})'><i class='fas fa-trash'></i> Remove From Favorites</button>
                            @else
                            <button class="btn btn-dark me-2" @click='add_to_favorites({{$movie->id}})'><i class='fas fa-heart'></i> Add to Favorites</button>
                            @endif
                            @if(auth()->user()->hasWatchLater($movie->id))
                            @if(auth()->user()->hasWatched($movie->id))
                            <button class="btn btn-dark" @click='mark_as_unwatched({{$movie->id}})'><i class='fas fa-check'></i> Mark as Unwatched</button>
                            @else
                            <button class="btn btn-dark" @click='mark_as_watched({{$movie->id}})'><i class='fas fa-check'></i> Mark as Watched</button>
                            @endif
                            <button class="btn btn-dark" @click='remove_watch_later({{$movie->id}})'><i class='fas fa-times'></i> Remove From Watch Later</button>
                            @else
                            <button class="btn btn-dark" @click='add_to_watch_later({{$movie->id}})'><i class='fas fa-clock'></i> Watch Later</button>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div>
            <div class="card bg-dark-18 text-light my-3">
                <div class="card-header py-2 h5">Summary</div>
                <div class="card-body">
                    <div class="card-text text-indent">
                        {{ $movie->summary }}
                    </div>
                </div>
            </div>
        </div>
        @if ($movie->trailer_code && $movie->trailer_code != '')
        <div class="my-2">
            <h4 class="px-3 py-2">Trailer</h4>
            <iframe width="100%" height="400" src="https://www.youtube.com/embed/{{$movie->trailer_code}}" frameborder="0" allowfullscreen></iframe>
        </div>
        @endif
    </div>
</div>
<script src="/js/movie.js"></script>
@endsection
