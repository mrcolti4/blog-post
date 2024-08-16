<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class ImageUpload extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if ($request->hasFile("upload")) {
            $file = $request->file("upload");

            $filename = time() . '_' . $file->getClientOriginalName();

            $path = $file->storeAs('public/images/posts', $filename);

            $url = Storage::url($path);

            return response()->json(["url" => $url]);
        }

        return response()->json(["error" => "No image uploaded"], 400);
    }
}
