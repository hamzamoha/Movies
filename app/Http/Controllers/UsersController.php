<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Throwable;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('settings', 'favorites', 'watch_later', 'update', 'add_favorite', 'add_watch_later', 'update_password');
        $this->middleware('guest')->only('login', 'register', 'postLogin', 'store');
        $this->middleware('admin')->only('count');
    }

    public function username()
    {
        return 'username';
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'username' => 'required|max:255|min:3|regex:/^[a-z0-9_]+$/i|unique:users',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'same:password'
        ]);

        $user = User::create([
            'name' => Str::of($request->name)->title(),
            'email' => Str::of($request->email)->lower(),
            'username' => Str::of($request->username)->lower(),
            'password' => Hash::make($request->password),
        ]);

        Auth::attempt(['username' => $user->username, 'password' => $request->password], $request->remember);

        return redirect()->route('home');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $id = Auth::user()->id;
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'username' => 'required|max:255|min:3|regex:/^[a-z0-9_]+$/i|unique:users,username,' . $id,
        ]);
        Auth::user()->update([
            'name' => Str::of($request->name)->title(),
            'email' => Str::of($request->email)->lower(),
            'username' => Str::of($request->username)->lower(),
        ]);
        return json_encode("done");
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);
        $user = User::find(Auth::user()->id);
        if(Hash::check($request->current_password, $user->password)){
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            return json_encode("done");
        }
        return json_encode([
            'message' => 'The Current Password is not Correct!'
        ]);
    }

    /**
     * Return the number of users.
     *
     * @return \Illuminate\Http\Response
     */
    public function count()
    {
        return User::count();
    }

    /**
     * Return the login form.
     *
     * @return view
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Log in the user
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        try {
            if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $request->remember))
                return redirect()->home();
            else
                return redirect()->back()->withInput()->with('error', 'Your informations are not correct !');
        } catch (Throwable $error) {
            return back()->withInput()->with('error', $error->getMessage());
        }
    }


    public function register()
    {
        return view('auth.register');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->home();
    }


    public function settings()
    {
        return view('auth.settings');
    }


    public function favorites()
    {
        $movies = Auth::user()->favorites;
        return view('auth.favorites')->with('movies', $movies);
    }


    public function watch_later()
    {
        return view('auth.watch_later')->with('movies', Auth::user()->watch_later);
    }


    public function add_watch_later(Request $request)
    {
        $movie_id = $request->movie_id;
        DB::table('watch_later')->insert([
            'movie_id' => $movie_id,
            'user_id' => Auth::user()->id,
            'watched' => false,
        ]);
        if(!$request->wantsJson()) return back();
    }


    public function add_favorite(Request $request)
    {
        $movie_id = $request->movie_id;
        DB::table('favorites')->insert([
            'movie_id' => $movie_id,
            'user_id' => Auth::user()->id,
        ]);
        if(!$request->wantsJson()) return back();
    }

    public function remove_watch_later(Request $request)
    {
        # code...
        $movie_id = $request->movie_id;
        $target = DB::table('watch_later')->select()->where('movie_id', $movie_id)->where('user_id', Auth()->user()->id)->first();
        DB::table('watch_later')->delete($target->id);
        if(!$request->wantsJson()) return back();
    }

    public function mark_as_watched(Request $request)
    {
        # code...
        $movie_id = $request->movie_id;
        $target = DB::table('watch_later')->select()->where('movie_id', $movie_id)->where('user_id', Auth()->user()->id)->first();
        DB::table('watch_later')->where('id', $target->id)->update(['watched' => true]);
        if(!$request->wantsJson()) return back();
    }

    public function mark_as_unwatched(Request $request)
    {
        # code...
        $movie_id = $request->movie_id;
        $target = DB::table('watch_later')->select()->where('movie_id', $movie_id)->where('user_id', Auth()->user()->id)->first();
        DB::table('watch_later')->where('id', $target->id)->update(['watched' => false]);
        if(!$request->wantsJson()) return back();
    }



    public function remove_favorite(Request $request)
    {
        # code...
        $movie_id = $request->movie_id;
        $target = DB::table('favorites')->select()->where('movie_id', $movie_id)->where('user_id', Auth()->user()->id)->first();
        DB::table('favorites')->delete($target->id);
        if(!$request->wantsJson()) return back();
    }
}
