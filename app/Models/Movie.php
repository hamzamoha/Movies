<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = [
        'imdb_code',
        'title',
        'year',
        'rating',
        'runtime',
        'summary',
        'background',
        'cover',
        'language'
    ];
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'movies_genres');
    }
}
