<?php

namespace App\Http\Controllers;

use App\Picture;

;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class PictureController extends Controller
{
    public function show(Picture $picture)
    {
        $fileName = $picture["path-to-picture"];
        if (Storage::exists($fileName)) {
            $file = Storage::get($fileName);
            $type = Storage::mimeType($fileName);
            return Response::make($file, 200)->header("Content-Type", $type);
        } else {
            abort(404);
        }
    }
}
