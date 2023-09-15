<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\MovieGenre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class MoviesController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->only('store', 'update', 'destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::orderBy('year', 'desc')->paginate(10);
        if (request()->wantsJson())
            return $movies;
        else
            return view('movies.index')->with('movies', $movies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'imdb_code' => 'required|regex:/^t+[0-9]+$/i|unique:movies,imdb_code',
            'title' => 'required|max:255',
            'year' => 'required|numeric',
            'rating' => 'required|numeric',
            'runtime' => 'required|numeric',
            'summary' => 'required',
            'cover' => 'required',
        ]);


        $url = $request->cover;

        $movie_slug = Str::of($request->title)->slug('_');
        $movie_year = $request->year;
        $ext = pathinfo($url, PATHINFO_EXTENSION);

        $cover_name = $movie_slug . '_' . $movie_year . '.' . $ext;
        for ($n = 1; Storage::exists("images/movies/$cover_name"); ++$n) {
            $cover_name =  $movie_slug . '_' . $movie_year . '_' . $n . '.' . $ext;
        }

        $path = storage_path("images/movies/");

        Image::make($url)->save($path . $cover_name);

        $movie = new Movie();
        $movie->imdb_code = $request->imdb_code;
        $movie->title = $request->title;
        $movie->year = $request->year;
        $movie->rating = $request->rating;
        $movie->runtime = $request->runtime;
        $movie->summary = $request->summary;
        $movie->cover = $cover_name;
        $movie->trailer_code = ($request->trailer_code)?$request->trailer_code:'';


        if ($movie->save()) {
            $gens = $request->genres;
            foreach ($gens as $g) {
                if (!($genre = Genre::where('label', $g)->first())) {
                    $genre = new Genre();
                    $genre->label = $g;
                    $genre->save();
                }
                MovieGenre::create([
                    'movie_id' => $movie->id,
                    'genre_id' => $genre->id,
                ]);
            }
            return response('success');
        }
        Storage::delete("images/movies/$cover_name");
        return response(['error' => 'There was an error adding the movie']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return view(('movies.show'))->with('movie', $movie);
    }

    /**
     * Return the number of movies.
     *
     * @return \Illuminate\Http\Response
     */
    public function count()
    {
        return Movie::count();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Return the genres view.
     *
     */
    public function genres()
    {
        $genres = Genre::withCount('movies')->orderBy('movies_count', 'desc')->take(5)->get(); 
        return view('movies.genres')->with('genres', $genres);
    }
}
