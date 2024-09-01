<?php

namespace App\Services;

use App\Models\Image;
use Cloudinary\Cloudinary;
use Cloudinary\Api\Exception\ApiError;
use App\Exceptions\ImageUploadException;
use Cloudinary\Api\Admin\AdminApi;

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
                "type" => $alt
            ];
        } catch (ApiError $th) {
            throw ImageUploadException("Failed to upload image", $th);
        }
    }

    public function destroy(array $publicIds)
    {
        // $uploadApi = $cloudinary->uploadApi();
        $api = new AdminApi();
        try {
            $api->deleteAssets($publicIds);
            Image::whereIn("public_id", $publicIds)->delete();
        } catch (ApiError $th) {
            throw ImageUploadException("Failed to destroy image", $th);
        }
    }
}
