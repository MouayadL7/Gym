<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileHelper
{
    /**
     * Store an uploaded file in the specified directory.
     *
     * @param UploadedFile $file The file to be stored.
     * @param string $directory The directory where the file should be stored.
     * @param string|null $disk The storage disk to use (default is 'local').
     * @return string The path to the stored file.
     */
    public static function storeFile(UploadedFile $file, string $directory, string $disk = 'local'): string
    {
        // Generate a unique filename with the original extension
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();

        // Store the file on the specified disk in the specified directory
        return Storage::disk($disk)->putFileAs($directory, $file, $filename);
    }
}
