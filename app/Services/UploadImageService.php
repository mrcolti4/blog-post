<?php

namespace App\Services;

use App\Models\Image;
use Cloudinary\Cloudinary;
use Cloudinary\Api\Exception\ApiError;
use App\Exceptions\ImageUploadException;

class UploadImageService
{
    public function upload($file, $alt)
    {
        $cloudinary = new Cloudinary();
        $uploadApi = $cloudinary->uploadApi();
        $uploadedFile = null;
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
        } catch (ApiError $th) {
            throw ImageUploadException("Failed to upload image", $th);
        }
    }

    public function destroy($publicId)
    {
        $cloudinary = new Cloudinary();
        $uploadApi = $cloudinary->uploadApi();
        try {
            //code...
            $message = $uploadApi->destroy($publicId);

            Image::where("public_id", $publicId)->delete();

            return $message;
        } catch (ApiError $th) {
            throw ImageUploadException("Failed to destroy image", $th);
        }
    }
}
