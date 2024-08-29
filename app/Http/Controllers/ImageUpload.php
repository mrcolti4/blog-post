<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Cloudinary\Cloudinary;
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
            $cloudinary = new Cloudinary();
            $uploadApi = $cloudinary->uploadApi();

            $uploadedFile = $uploadApi->upload($request->file("upload")->getRealPath(), [
                "folder" => "custom-cms",
            ]);

            return response()->json(["url" => $uploadedFile->getSecurePath()]);
        }

        return response()->json(["error" => "No image uploaded"], 400);
    }
}
