<?php

namespace App\Services;

use Cloudinary\Cloudinary;

class UploadImageService
{
    public function upload($file, $alt)
    {
        $cloudinary = new Cloudinary();
        $uploadApi = $cloudinary->uploadApi();
        try {
            $uploadedFile = $uploadApi->upload($file->getRealPath(), [
                "folder" => "custom-cms",
            ]);

            $publicId = $uploadedFile["public_id"];
            $url = $uploadedFile["secure_url"];
            $fileName = $file->getClientOriginalName();

            return [
                "url" => $url,
                "alt" => $alt,
                "public_id" => $publicId,
                "file_name" => $fileName,
            ];
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }
}
