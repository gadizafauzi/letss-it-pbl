<?php

namespace App\Services\Shared;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class FileUploadService
{
    /**
     * Upload an image with Intervention Image handling.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $folder The folder name inside storage/app/public
     * @param int $width Cover width
     * @param int $height Cover height
     * @return string The relative path to the saved file
     */
    public function uploadImage($file, string $folder, int $width = 300, int $height = 300): string
    {
        $manager = new ImageManager(new Driver());
        $image = $manager->decode($file);
        $image->cover($width, $height);

        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $directory = storage_path('app/public/' . $folder);

        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $image->save($directory . '/' . $filename);
        
        return $folder . '/' . $filename;
    }

    /**
     * Delete a file from public storage.
     *
     * @param string|null $path
     * @return bool
     */
    public function deleteImage(?string $path): bool
    {
        if ($path && Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }
        return false;
    }
}
