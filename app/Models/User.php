<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function favorites()
    {
        return $this->belongsToMany(Movie::class, 'favorites');
    }

    public function watch_later()
    {
        return $this->belongsToMany(Movie::class, 'watch_later');
    }

    public function hasFavorite($id){
        return $this->favorites->contains($id); 
    }

    public function hasWatchLater($id){
        return $this->watch_later->contains($id);
    }

    public function watched(){
        return $this->watch_later()->where('watched', true);
    }

    public function hasWatched($id)
    {
        return $this->watched->contains($id);
    }
}
