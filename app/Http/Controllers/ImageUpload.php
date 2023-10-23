<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ImageUpload extends Controller
{
    /**
     * Get the image file with the given filename from the storage directory.
     *
     * @param string $filename The name of the image file to retrieve.
     * @return \Illuminate\Http\Response The response containing the image file.
     */
    public function getImageFile(string $filename)
    {
        $file_path = Storage::disk('public')->path('images/' . $filename);

        if(Storage::disk('public')->exists('images/' . $filename)) {
            return response()->file($file_path);
        };

        return abort(404);

        // if (!File::exists($path)) {
        //     abort(404);
        // }

        // $file = File::get($path);
        // $type = File::mimeType($path);

        // $response = Response::make($file, 200);
        // $response->header("Content-Type", $type);

        // return $response;
    }
}
