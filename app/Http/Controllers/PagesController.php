<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class PagesController extends Controller
{
    public function home()
    {
        $last_added = Movie::orderBy('id', 'desc')->limit(5)->get();
        $latest_movies = Movie::orderBy('year', 'desc')->limit(5)->get();
        $top_rating = Movie::orderBy('rating', 'desc')->limit(5)->get();

        return view('home')->with([
            'latest_movies' => $latest_movies,
            'last_added' => $last_added,
            'top_rating' => $top_rating,
        ]);
    }
}
