<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class FilesController extends Controller
{
    public function getPoster($poster)
    {
        $poster = Str::of($poster)->basename();

        $path = 'images/movies/' . $poster;

        if (Storage::exists($path)) {
            $file = Storage::get($path);
            $mime = File::mimeType(storage_path($path));
            return response($file, 200, [
                'Content-type' => $mime
            ]);
        } else abort(404);
    }
    public function getBackground($background)
    {
        $background = Str::of($background)->basename();

        $path = 'backgrounds/' . $background;

        if (Storage::exists($path)) {
            $file = Storage::get($path);
            $mime = File::mimeType(storage_path($path));
            return response($file, 200, [
                'Content-type' => $mime
            ]);
        } else abort(404);
    }
}
